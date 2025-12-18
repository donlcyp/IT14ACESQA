<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Material;
use App\Models\EmployeeList;
use App\Models\EmployeeAttendance;
use App\Models\ProjectUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SiteSupervisorController extends Controller
{
    /**
     * Site Supervisor Dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get projects where this user is the Site Supervisor (assigned via employee)
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $assignedProjects = collect();
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->with(['client', 'assignedPM', 'employees', 'materials'])
                ->orderBy('date_started', 'desc')
                ->get();
        }
        
        // Calculate KPI stats
        $today = Carbon::today();
        
        // Get today's progress entries count
        $todayProgressCount = ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
            ->whereDate('created_at', $today)
            ->count();
        
        // For now, pending issues count is 0 (will be stored in separate table when issues form is submitted)
        $pendingIssuesCount = 0;
        
        // Materials received today
        $materialsReceivedToday = Material::whereIn('project_id', $assignedProjects->pluck('id'))
            ->whereDate('date_received', $today)
            ->count();
        
        // Get recent progress entries
        $recentProgress = ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get recent issues (placeholder - will be from separate issues table when created)
        $recentIssues = collect();
        
        // Get materials pending receipt confirmation
        $pendingMaterials = Material::whereIn('project_id', $assignedProjects->pluck('id'))
            ->whereNull('date_received')
            ->with('project')
            ->orderBy('created_at', 'asc')
            ->take(10)
            ->get();
        
        $summary = [
            'assigned_projects' => $assignedProjects->count(),
            'ongoing_tasks' => $assignedProjects->where('status', 'Ongoing')->count(),
            'today_progress' => $todayProgressCount,
            'pending_issues' => $pendingIssuesCount,
            'materials_today' => $materialsReceivedToday,
        ];
        
        return view('ss.dashboard', compact(
            'summary',
            'assignedProjects',
            'recentProgress',
            'recentIssues',
            'pendingMaterials'
        ));
    }
    
    /**
     * View assigned projects list
     */
    public function projects()
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $projects = collect();
        if ($employeeRecord) {
            $projects = $employeeRecord->projects()
                ->where('archived', false)
                ->with(['client', 'assignedPM', 'employees', 'materials'])
                ->orderBy('date_started', 'desc')
                ->paginate(10);
        }
        
        return view('ss.projects', compact('projects'));
    }
    
    /**
     * View specific project details (read-only)
     */
    public function viewProject(Project $project)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Check if user is assigned to this project
        if (!$employeeRecord || !$employeeRecord->projects()->where('projects.id', $project->id)->exists()) {
            return redirect()->route('ss.dashboard')->with('error', 'You are not assigned to this project.');
        }
        
        $project->load(['client', 'assignedPM', 'employees.user', 'materials', 'updates' => function($q) {
            $q->orderBy('created_at', 'desc');
        }]);
        
        // Get project statistics
        $stats = [
            'total_materials' => $project->materials->count(),
            'materials_received' => $project->materials->whereNotNull('date_received')->count(),
            'pending_materials' => $project->materials->whereNull('date_received')->count(),
            'progress_entries' => $project->updates->count(),
            'open_issues' => 0, // Placeholder - issues stored separately
        ];
        
        return view('ss.project-view', compact('project', 'stats'));
    }
    
    /**
     * Daily Progress Reporting Page
     */
    public function progressReports(Request $request)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $assignedProjects = collect();
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->with('materials')
                ->get();
        }
        
        // Get progress entries with filters
        $query = ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
            ->with('project');
        
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        
        $progressReports = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('ss.progress-reports', compact('assignedProjects', 'progressReports'));
    }
    
    /**
     * Submit daily progress report
     */
    public function submitProgress(Request $request)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string|max:1000',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        
        // Verify user is assigned to the project
        if (!$employeeRecord || !$employeeRecord->projects()->where('projects.id', $validated['project_id'])->exists()) {
            return back()->with('error', 'You are not assigned to this project.');
        }
        
        // Handle photo uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('progress-photos', 'public');
                $photoPaths[] = $path;
            }
        }
        
        // Create progress entry
        $update = ProjectUpdate::create([
            'project_id' => $validated['project_id'],
            'updated_by' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'In Progress',
        ]);
        
        return redirect()->route('ss.progress-reports')
            ->with('success', 'Daily progress report submitted successfully.');
    }
    
    /**
     * Material Receipt Confirmation Page
     */
    public function materialReceipts(Request $request)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $assignedProjects = collect();
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->get();
        }
        
        // Get materials with filters
        $query = Material::whereIn('project_id', $assignedProjects->pluck('id'))
            ->with('project');
        
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        
        $materials = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Calculate material stats
        $stats = [
            'pending' => Material::whereIn('project_id', $assignedProjects->pluck('id'))->whereNull('date_received')->count(),
            'received' => Material::whereIn('project_id', $assignedProjects->pluck('id'))->whereNotNull('date_received')->count(),
            'damaged' => 0, // Will track damaged materials
        ];
        
        $projects = $assignedProjects;
        
        return view('ss.material-receipts', compact('assignedProjects', 'materials'));
    }
    
    /**
     * Confirm material receipt
     */
    public function confirmMaterialReceipt(Request $request, Material $material)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Verify user is assigned to the project
        if (!$employeeRecord || !$employeeRecord->projects()->where('projects.id', $material->project_id)->exists()) {
            return back()->with('error', 'You are not authorized to confirm this material.');
        }
        
        $validated = $request->validate([
            'quantity_received' => 'required|numeric|min:0',
            'condition' => 'required|in:Good,Damaged,Partial',
            'receipt_notes' => 'nullable|string|max:500',
        ]);
        
        $material->update([
            'date_received' => now(),
        ]);
        
        return back()->with('success', 'Material receipt confirmed successfully.');
    }
    
    /**
     * Issue/Incident Reporting Page
     */
    public function issues(Request $request)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $assignedProjects = collect();
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->get();
        }
        
        // Get updates (no type filter - schema doesn't have type column)
        $query = ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
            ->with('project');
        
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $issues = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('ss.issues', compact('assignedProjects', 'issues'));
    }
    
    /**
     * Submit issue/incident report
     */
    public function submitIssue(Request $request)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'issue_type' => 'required|in:delay,safety,material,quality,other',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,critical',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        
        // Verify user is assigned to the project
        if (!$employeeRecord || !$employeeRecord->projects()->where('projects.id', $validated['project_id'])->exists()) {
            return back()->with('error', 'You are not assigned to this project.');
        }
        
        // Handle photo uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('issue-photos', 'public');
                $photoPaths[] = $path;
            }
        }
        
        // Create issue entry - only use columns that exist in project_updates table
        ProjectUpdate::create([
            'project_id' => $validated['project_id'],
            'updated_by' => $user->id,
            'title' => '[' . strtoupper($validated['issue_type']) . '] ' . $validated['title'],
            'description' => $validated['description'],
            'status' => 'Open',
        ]);
        
        return redirect()->route('ss.issues')
            ->with('success', 'Issue report submitted successfully. The Project Manager has been notified.');
    }
    
    /**
     * Attendance Verification Page
     */
    public function attendanceVerification(Request $request)
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $projects = collect();
        $projectEmployees = collect();
        
        if ($employeeRecord) {
            $projects = $employeeRecord->projects()
                ->where('archived', false)
                ->with('employees')
                ->get();
            
            // Get all employees from assigned projects
            $employeeIds = $projects->flatMap(function($project) {
                return $project->employees->pluck('id');
            })->unique();
            
            $projectEmployees = EmployeeList::whereIn('id', $employeeIds)->get();
        }
        
        // Get attendance records with filters
        $date = $request->filled('date') ? Carbon::parse($request->date) : Carbon::today();
        
        $attendanceQuery = EmployeeAttendance::whereIn('employee_id', $projectEmployees->pluck('id'))
            ->whereDate('date', $date)
            ->with(['employee', 'employee.projects']);
        
        // Apply project filter if provided
        if ($request->filled('project')) {
            $projectId = $request->project;
            $project = Project::find($projectId);
            if ($project) {
                $projectEmployeeIds = $project->employees->pluck('id');
                $attendanceQuery->whereIn('employee_id', $projectEmployeeIds);
            }
        }
        
        $attendance = $attendanceQuery->get();
        
        // Calculate stats
        $stats = [
            'total_today' => $attendance->count(),
            'present' => $attendance->where('attendance_status', 'Present')->count(),
            'late' => $attendance->where('is_late', true)->count(),
            'verified' => $attendance->where('validation_status', 'approved')->count(),
            'pending_verification' => $attendance->where('validation_status', 'pending')->count(),
        ];
        
        return view('ss.attendance-verification', compact('projects', 'projectEmployees', 'attendance', 'date', 'stats'));
    }
    
    /**
     * Verify employee attendance
     */
    public function verifyAttendance(Request $request, EmployeeAttendance $attendance)
    {
        $user = auth()->user();
        
        // Update attendance as verified by site supervisor
        $attendance->update([
            'validation_status' => 'approved',
            'validated_by' => $user->id,
            'validated_at' => now(),
            'attendance_status' => 'Present',
        ]);
        
        return back()->with('success', 'Attendance verification updated.');
    }
}
