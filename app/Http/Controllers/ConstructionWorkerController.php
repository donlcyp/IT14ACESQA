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

class ConstructionWorkerController extends Controller
{
    /**
     * Construction Worker Dashboard
     */
    public function index()
    {
        $user = Auth::user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Get assigned projects
        $assignedProjects = collect();
        $todayAttendance = null;
        $recentAttendance = collect();
        $upcomingTasks = collect();
        
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->with('assignedPM', 'client')
                ->orderBy('date_started', 'desc')
                ->get();
            
            // Get today's attendance
            $todayAttendance = EmployeeAttendance::where('employee_id', $employeeRecord->id)
                ->whereDate('date', Carbon::today())
                ->first();
            
            // Get recent attendance (last 7 days)
            $recentAttendance = EmployeeAttendance::where('employee_id', $employeeRecord->id)
                ->orderBy('date', 'desc')
                ->take(7)
                ->get();
            
            // Get upcoming tasks from project updates
            $upcomingTasks = ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
                ->where('status', '!=', 'Completed')
                ->with('project')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        }
        
        // Calculate summary stats
        $summary = [
            'assigned_projects' => $assignedProjects->count(),
            'active_projects' => $assignedProjects->where('status', 'Ongoing')->count(),
            'completed_tasks' => $employeeRecord ? ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
                ->where('status', 'Completed')
                ->count() : 0,
            'days_worked_this_month' => $employeeRecord ? EmployeeAttendance::where('employee_id', $employeeRecord->id)
                ->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year)
                ->where('status', 'Present')
                ->count() : 0,
        ];
        
        return view('cw.dashboard', compact(
            'user',
            'employeeRecord',
            'assignedProjects',
            'todayAttendance',
            'recentAttendance',
            'upcomingTasks',
            'summary'
        ));
    }
    
    /**
     * View assigned tasks
     */
    public function tasks(Request $request)
    {
        $user = Auth::user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $tasks = collect();
        $assignedProjects = collect();
        
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->get();
            
            $query = ProjectUpdate::whereIn('project_id', $assignedProjects->pluck('id'))
                ->with('project');
            
            // Filter by project
            if ($request->filled('project_id')) {
                $query->where('project_id', $request->project_id);
            }
            
            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            
            $tasks = $query->orderBy('created_at', 'desc')->paginate(15);
        }
        
        return view('cw.tasks', compact('tasks', 'assignedProjects'));
    }
    
    /**
     * View personal attendance history
     */
    public function attendance(Request $request)
    {
        $user = Auth::user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        $attendanceRecords = collect();
        $stats = [
            'present' => 0,
            'absent' => 0,
            'late' => 0,
            'total_hours' => 0,
        ];
        
        if ($employeeRecord) {
            $query = EmployeeAttendance::where('employee_id', $employeeRecord->id);
            
            // Filter by date range
            if ($request->filled('date_from')) {
                $query->whereDate('date', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('date', '<=', $request->date_to);
            }
            
            // Filter by month
            if ($request->filled('month')) {
                $month = Carbon::parse($request->month);
                $query->whereMonth('date', $month->month)
                    ->whereYear('date', $month->year);
            } else {
                // Default to current month
                $query->whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year);
            }
            
            $attendanceRecords = $query->orderBy('date', 'desc')->paginate(31);
            
            // Calculate stats for the filtered period
            $statsQuery = EmployeeAttendance::where('employee_id', $employeeRecord->id);
            if ($request->filled('month')) {
                $month = Carbon::parse($request->month);
                $statsQuery->whereMonth('date', $month->month)
                    ->whereYear('date', $month->year);
            } else {
                $statsQuery->whereMonth('date', Carbon::now()->month)
                    ->whereYear('date', Carbon::now()->year);
            }
            
            $allRecords = $statsQuery->get();
            $stats['present'] = $allRecords->where('status', 'Present')->count();
            $stats['absent'] = $allRecords->where('status', 'Absent')->count();
            $stats['late'] = $allRecords->where('status', 'Late')->count();
            
            // Calculate total hours
            foreach ($allRecords as $record) {
                if ($record->time_in && $record->time_out) {
                    $timeIn = Carbon::parse($record->time_in);
                    $timeOut = Carbon::parse($record->time_out);
                    $stats['total_hours'] += $timeOut->diffInHours($timeIn);
                }
            }
        }
        
        return view('cw.attendance', compact('attendanceRecords', 'stats', 'employeeRecord'));
    }
    
    /**
     * Submit task completion status
     */
    public function submitTaskCompletion(Request $request, ProjectUpdate $task)
    {
        $user = Auth::user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Verify user is assigned to the project
        if (!$employeeRecord || !$employeeRecord->projects()->where('projects.id', $task->project_id)->exists()) {
            return back()->with('error', 'You are not assigned to this project.');
        }
        
        $validated = $request->validate([
            'completion_notes' => 'nullable|string|max:500',
        ]);
        
        $task->update([
            'status' => 'Completed',
            'description' => $task->description . "\n\n[Completed by: {$user->name} on " . now()->format('M d, Y H:i') . "]" . 
                ($validated['completion_notes'] ? "\nNotes: " . $validated['completion_notes'] : ''),
        ]);
        
        return back()->with('success', 'Task marked as completed.');
    }
    
    /**
     * View assigned project details (read-only)
     */
    public function viewProject(Project $project)
    {
        $user = Auth::user();
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Verify user is assigned to this project
        if (!$employeeRecord || !$employeeRecord->projects()->where('projects.id', $project->id)->exists()) {
            abort(403, 'You are not assigned to this project.');
        }
        
        $project->load('assignedPM', 'client', 'employees', 'updates', 'materials');
        
        return view('cw.project-view', compact('project'));
    }
}
