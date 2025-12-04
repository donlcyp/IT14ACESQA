<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Material;
use App\Models\Invoice;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isEmployee = $user && Employee::where('user_id', $user->id)->exists();

        if ($isEmployee) {
            // EMPLOYEE VIEW - Show only their assigned projects
            $employee = Employee::where('user_id', $user->id)->firstOrFail();

            // Get projects this employee is assigned to
            $assignedProjects = $employee->projects()
                ->where('archived', false)
                ->with('client', 'assignedPM')
                ->get();

            $summary = [
                'total_projects' => $assignedProjects->count(),
                'complete_projects' => $assignedProjects->where('status', 'Completed')->count(),
                'ongoing_projects' => $assignedProjects->where('status', '!=', 'Completed')->count(),
            ];

            // Get today's attendance record for this employee
            $today = \Carbon\Carbon::today();
            $todayAttendance = EmployeeAttendance::where('employee_id', $employee->id)
                ->where('date', $today)
                ->first();

            // Recent attendance records
            $recentAttendance = EmployeeAttendance::where('employee_id', $employee->id)
                ->orderBy('date', 'desc')
                ->take(5)
                ->get();

            return view('dashboard', compact(
                'summary',
                'assignedProjects',
                'todayAttendance',
                'recentAttendance',
                'isEmployee'
            ));
        } else {
            // OWNER/PM VIEW - Show all projects
            // You can add logic here to fetch dashboard data from models
            // Dashboard now uses live data instead of static placeholders.

            // Project summary
            $totalProjects = Project::where('archived', false)->count();

            $completeProjects = Project::where('archived', false)
                ->where('status', 'Completed')
                ->count();

            $ongoingProjects = Project::where('archived', false)
                ->where('status', '!=', 'Completed')
                ->count();

            $summary = [
                'total_projects' => $totalProjects,
                'complete_projects' => $completeProjects,
                'ongoing_projects' => $ongoingProjects,
            ];

            // Active projects (latest 5) - all non-archived with client data
            $activeProjects = Project::where('archived', false)
                ->with('client', 'assignedPM')
                ->orderByDesc('created_at')
                ->take(5)
                ->get();

            // Recent materials (latest 5)
            $recentProjectRecords = Material::orderByDesc('created_at')
                ->take(5)
                ->get();

            // Materials that have failed status (need to be returned)
            $projectsToReturn = Material::where('status', 'Fail')
                ->orderByDesc('created_at')
                ->take(5)
                ->get();

            return view('dashboard', compact(
                'summary',
                'activeProjects',
                'recentProjectRecords',
                'projectsToReturn',
                'isEmployee'
            ));
        }
    }
}
