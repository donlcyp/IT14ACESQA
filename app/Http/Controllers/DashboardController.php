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
            $recentProjectRecords = Material::with('project')
                ->orderByDesc('created_at')
                ->take(5)
                ->get();

            // Materials that have failed status (need to be returned)
            $projectsToReturn = Material::with('project')
                ->where('status', 'Fail')
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

    public function financeGraphs()
    {
        // Get all active projects with their materials
        $activeProjects = Project::where('archived', false)
            ->with('materials')
            ->orderByDesc('created_at')
            ->get();

        // Calculate totals and prepare data for charts
        $totalBudget = $activeProjects->sum('allocated_amount');
        
        $totalSpent = 0;
        foreach ($activeProjects as $project) {
            foreach ($project->materials as $material) {
                $materialCost = $material->material_cost ?? 0;
                $laborCost = $material->labor_cost ?? 0;
                $quantity = $material->quantity ?? 0;
                $totalSpent += ($materialCost + $laborCost) * $quantity;
            }
        }

        // Prepare data for each project
        $projectsData = $activeProjects->map(function ($project) {
            $projectSpent = 0;
            $materialCost = 0;
            $laborCost = 0;
            
            foreach ($project->materials as $material) {
                $mCost = $material->material_cost ?? 0;
                $lCost = $material->labor_cost ?? 0;
                $qty = $material->quantity ?? 0;
                $itemTotal = ($mCost + $lCost) * $qty;
                $projectSpent += $itemTotal;
                $materialCost += $mCost * $qty;
                $laborCost += $lCost * $qty;
            }

            return [
                'name' => $project->project_name ?? $project->project_code,
                'budget' => $project->allocated_amount ?? 0,
                'spent' => $projectSpent,
                'materialCost' => $materialCost,
                'laborCost' => $laborCost,
            ];
        })->toArray();

        return view('finance-graphs', compact(
            'projectsData',
            'totalBudget',
            'totalSpent'
        ));
    }
}
