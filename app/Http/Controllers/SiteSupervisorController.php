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
     * Get the single assigned project for the current SS user
     */
    private function getAssignedProject()
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        if (!$employeeRecord) {
            return null;
        }
        
        // SS handles one project at a time - get the most recent active project
        return $employeeRecord->projects()
            ->where('archived', false)
            ->where('status', '!=', 'Completed')
            ->with(['client', 'assignedPM', 'employees', 'materials'])
            ->orderBy('date_started', 'desc')
            ->first();
    }
    
    /**
     * Site Supervisor Dashboard
     */
    public function index()
    {
        $user = auth()->user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Get the assigned project
        $assignedProject = $this->getAssignedProject();
        
        // Also get all assigned projects for reference
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
        $projectIds = $assignedProjects->pluck('id');
        
        // Get today's progress entries count
        $todayProgressCount = ProjectUpdate::whereIn('project_id', $projectIds)
            ->whereDate('created_at', $today)
            ->where('type', 'progress')
            ->count();
        
        // Pending issues count
        $pendingIssuesCount = ProjectUpdate::whereIn('project_id', $projectIds)
            ->where('type', 'issue')
            ->where('status', 'Open')
            ->count();
        
        // Tasks count
        $tasksCount = ProjectUpdate::whereIn('project_id', $projectIds)
            ->where('type', 'task')
            ->count();
        
        $completedTasksCount = ProjectUpdate::whereIn('project_id', $projectIds)
            ->where('type', 'task')
            ->where('status', 'Completed')
            ->count();
        
        // Get recent progress entries
        $recentProgress = ProjectUpdate::whereIn('project_id', $projectIds)
            ->where('type', 'progress')
            ->with(['project', 'material'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get recent issues
        $recentIssues = ProjectUpdate::whereIn('project_id', $projectIds)
            ->where('type', 'issue')
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get tasks for materials
        $tasks = collect();
        if ($assignedProject) {
            $tasks = ProjectUpdate::where('project_id', $assignedProject->id)
                ->where('type', 'task')
                ->with('material')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        }
        
        $summary = [
            'assigned_projects' => $assignedProjects->count(),
            'ongoing_tasks' => $tasksCount - $completedTasksCount,
            'completed_tasks' => $completedTasksCount,
            'today_progress' => $todayProgressCount,
            'pending_issues' => $pendingIssuesCount,
        ];
        
        return view('ss.dashboard', compact(
            'summary',
            'assignedProject',
            'assignedProjects',
            'recentProgress',
            'recentIssues',
            'tasks'
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
            'total_workers' => $project->employees->count(),
            'total_materials' => $project->materials->count(),
            'materials_received' => $project->materials->whereNotNull('date_received')->count(),
            'pending_materials' => $project->materials->whereNull('date_received')->count(),
            'progress_entries' => $project->updates->where('type', 'progress')->count(),
            'open_issues' => $project->updates->where('type', 'issue')->where('status', 'Open')->count(),
            'total_tasks' => $project->updates->where('type', 'task')->count(),
        ];
        
        // Get recent progress reports for this project
        $recentProgress = $project->updates()
            ->where('type', 'progress')
            ->with(['updatedBy', 'material'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get tasks for this project
        $tasks = $project->updates()
            ->where('type', 'task')
            ->with(['updatedBy', 'material'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('ss.project-view', compact('project', 'stats', 'recentProgress', 'tasks'));
    }
    
    /**
     * Daily Progress Reporting Page - Material Based
     */
    public function progressReports(Request $request)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return redirect()->route('ss.dashboard')->with('error', 'You are not assigned to any active project.');
        }
        
        // Get materials for this project (for creating tasks)
        $materials = $assignedProject->materials()->orderBy('item_description')->get();
        
        // Get tasks created for this project's materials
        $tasks = ProjectUpdate::where('project_id', $assignedProject->id)
            ->where('type', 'task')
            ->whereNotNull('material_id')
            ->with('material')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get progress reports with filters
        $query = ProjectUpdate::where('project_id', $assignedProject->id)
            ->where('type', 'progress')
            ->with(['material', 'updatedBy']);
        
        if ($request->filled('material_id')) {
            $query->where('material_id', $request->material_id);
        }
        
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        
        $progressReports = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Pass as $project for the view
        $project = $assignedProject;
        
        return view('ss.progress-reports', compact('project', 'materials', 'tasks', 'progressReports'));
    }
    
    /**
     * Create a task for a material
     */
    public function createTask(Request $request)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return back()->with('error', 'You are not assigned to any active project.');
        }
        
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
        ]);
        
        // Verify material belongs to the assigned project
        $material = Material::find($validated['material_id']);
        if (!$material || $material->project_id != $assignedProject->id) {
            return back()->with('error', 'Invalid material selected.');
        }
        
        ProjectUpdate::create([
            'project_id' => $assignedProject->id,
            'material_id' => $validated['material_id'],
            'updated_by' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => 'task',
            'status' => 'In Progress',
        ]);
        
        return redirect()->route('ss.progress-reports')
            ->with('success', 'Task created successfully for the material.');
    }
    
    /**
     * Submit daily progress report
     */
    public function submitProgress(Request $request)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return back()->with('error', 'You are not assigned to any active project.');
        }
        
        $validated = $request->validate([
            'material_id' => 'nullable|exists:materials,id',
            'task_id' => 'nullable|exists:project_updates,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
            'workers_present' => 'nullable|integer|min:0',
            'weather_condition' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        
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
            'project_id' => $assignedProject->id,
            'material_id' => $validated['material_id'] ?? null,
            'updated_by' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => 'progress',
            'status' => 'In Progress',
            'completion_percentage' => $validated['completion_percentage'] ?? 0,
            'workers_present' => $validated['workers_present'] ?? null,
            'weather_condition' => $validated['weather_condition'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'photos' => $photoPaths,
        ]);
        
        // Update task completion if task was selected
        if (!empty($validated['task_id'])) {
            $task = ProjectUpdate::find($validated['task_id']);
            if ($task && $task->type === 'task') {
                $completionPercent = $validated['completion_percentage'] ?? 0;
                if ($completionPercent >= 100) {
                    $task->update(['status' => 'Completed']);
                }
            }
        }
        
        return redirect()->route('ss.progress-reports')
            ->with('success', 'Daily progress report submitted successfully.');
    }
    
    /**
     * Issue/Incident Reporting Page
     */
    public function issues(Request $request)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return redirect()->route('ss.dashboard')->with('error', 'You are not assigned to any active project.');
        }
        
        // Get materials and tasks for dropdown
        $materials = $assignedProject->materials()->orderBy('item_description')->get();
        $tasks = ProjectUpdate::where('project_id', $assignedProject->id)
            ->where('type', 'task')
            ->orderBy('title')
            ->get();
        
        // Get issues with filters
        $query = ProjectUpdate::where('project_id', $assignedProject->id)
            ->where('type', 'issue')
            ->with(['material', 'updatedBy']);
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        
        $issues = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Pass as $project for the view
        $project = $assignedProject;
        
        return view('ss.issues', [
            'project' => $project,
            'materials' => $materials,
            'tasks' => $tasks,
            'issues' => $issues
        ]);
    }
    
    /**
     * Submit issue/incident report
     */
    public function submitIssue(Request $request)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return back()->with('error', 'You are not assigned to any active project.');
        }
        
        $validated = $request->validate([
            'material_id' => 'nullable|exists:materials,id',
            'task_id' => 'nullable|exists:project_updates,id',
            'issue_type' => 'required|in:delay,safety,material,quality,weather,equipment,other',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => 'required|in:low,medium,high,critical',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        
        // Handle photo uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('issue-photos', 'public');
                $photoPaths[] = $path;
            }
        }
        
        // Get material_id from task if task selected
        $materialId = $validated['material_id'] ?? null;
        if (!$materialId && !empty($validated['task_id'])) {
            $task = ProjectUpdate::find($validated['task_id']);
            $materialId = $task ? $task->material_id : null;
        }
        
        // Create issue entry
        ProjectUpdate::create([
            'project_id' => $assignedProject->id,
            'material_id' => $materialId,
            'updated_by' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => 'issue',
            'status' => 'Open',
            'issue_type' => $validated['issue_type'],
            'priority' => $validated['priority'],
            'photos' => $photoPaths,
        ]);
        
        return redirect()->route('ss.issues')
            ->with('success', 'Issue report submitted successfully. The Project Manager has been notified.');
    }
    
    /**
     * Attendance Verification Page - Single project, no project filter
     */
    public function attendanceVerification(Request $request)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return redirect()->route('ss.dashboard')->with('error', 'You are not assigned to any active project.');
        }
        
        // Get employees assigned to this project only
        $projectEmployees = $assignedProject->employees;
        
        // Get attendance records with filters
        $date = $request->filled('date') ? Carbon::parse($request->date) : Carbon::today();
        
        $attendanceQuery = EmployeeAttendance::whereIn('employee_id', $projectEmployees->pluck('id'))
            ->whereDate('date', $date)
            ->with(['employee', 'validator']);
        
        $attendance = $attendanceQuery->get();
        
        // Get pending verification requests (sent by HR)
        $pendingVerifications = EmployeeAttendance::whereIn('employee_id', $projectEmployees->pluck('id'))
            ->where('ss_verification_status', 'pending')
            ->whereNotNull('punch_in_time')
            ->with(['employee'])
            ->orderBy('date', 'desc')
            ->get();
        
        // Get verification history (already verified/denied records)
        $verificationHistory = EmployeeAttendance::whereIn('employee_id', $projectEmployees->pluck('id'))
            ->whereNotNull('ss_verification_status')
            ->where('ss_verification_status', '!=', 'pending')
            ->with(['employee'])
            ->orderBy('ss_verified_at', 'desc')
            ->limit(50)
            ->get();
        
        // Pass as $project for the view
        $project = $assignedProject;
        
        // Calculate stats
        $stats = [
            'total_today' => $attendance->count(),
            'pending_verification' => $pendingVerifications->count(),
            'verified' => $verificationHistory->where('ss_verification_status', 'verified')->count(),
            'denied' => $verificationHistory->where('ss_verification_status', 'denied')->count(),
        ];
        
        return view('ss.attendance-verification', [
            'project' => $project,
            'projectEmployees' => $projectEmployees,
            'pendingVerification' => $pendingVerifications,
            'verificationHistory' => $verificationHistory,
            'date' => $date,
            'stats' => $stats
        ]);
    }
    
    /**
     * Verify employee attendance (called by SS to confirm worker presence)
     */
    public function verifyAttendance(Request $request, EmployeeAttendance $attendance)
    {
        $user = auth()->user();
        $assignedProject = $this->getAssignedProject();
        
        if (!$assignedProject) {
            return back()->with('error', 'You are not assigned to any active project.');
        }
        
        // Verify the employee is in the assigned project
        $projectEmployeeIds = $assignedProject->employees->pluck('id')->toArray();
        if (!in_array($attendance->employee_id, $projectEmployeeIds)) {
            return back()->with('error', 'This employee is not assigned to your project.');
        }
        
        $action = $request->input('action', 'verify');
        
        if ($action === 'verify') {
            $attendance->update([
                'ss_verification_status' => 'verified',
                'ss_verified_by' => $user->id,
                'ss_verified_at' => now(),
                'attendance_status' => 'Present',
            ]);
            $message = 'Worker attendance verified successfully.';
        } else {
            $attendance->update([
                'ss_verification_status' => 'denied',
                'ss_verified_by' => $user->id,
                'ss_verified_at' => now(),
                'attendance_status' => 'Absent',
            ]);
            $message = 'Worker attendance denied. HR will be notified.';
        }
        
        return back()->with('success', $message);
    }
}
