<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Material;
use App\Models\Invoice;
use App\Models\EmployeeList;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isEmployee = $user && EmployeeList::where('user_id', $user->id)->exists();

        if ($isEmployee) {
            // EMPLOYEE VIEW - Show only their assigned projects
            $employee = EmployeeList::where('user_id', $user->id)->firstOrFail();

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

    /**
     * Get spending trend data based on filter (daily, weekly, monthly, yearly)
     * Supports navigation to previous periods
     */
    public function getSpendingTrend(Request $request)
    {
        $filter = $request->query('filter', 'day'); // Default to daily
        $offset = (int) $request->query('offset', 0); // Negative for previous periods
        $year = (int) $request->query('year', now()->year); // Year for context
        $month = (int) $request->query('month', now()->month); // Month for context

        $trendData = [];
        $labels = [];
        $title = '';
        $periodInfo = '';

        // Get materials based on filter
        $materials = Material::with(['project', 'projectRecord.project'])
            ->orderBy('created_at')
            ->get();

        switch ($filter) {
            case 'day':
                // Daily trend for the current month (31 days)
                $targetDate = Carbon::createFromDate($year, $month, 1)->addMonths($offset);
                $year = $targetDate->year;
                $month = $targetDate->month;
                $daysInMonth = $targetDate->daysInMonth;

                $trendData = array_fill(0, $daysInMonth, 0);
                $labels = array_map(fn($day) => "Day $day", range(1, $daysInMonth));

                foreach ($materials as $material) {
                    $materialDate = $material->created_at ? Carbon::parse($material->created_at) : null;
                    if ($materialDate && $materialDate->year == $year && $materialDate->month == $month) {
                        $day = $materialDate->day - 1;
                        $cost = ($material->material_cost ?? 0) * ($material->quantity ?? 0) +
                                ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                        $trendData[$day] += $cost;
                    }
                }

                $title = "Daily Spending Trend - " . $targetDate->format('F Y');
                $periodInfo = $targetDate->format('F Y');
                break;

            case 'week':
                // Weekly trend for the current month
                $targetDate = Carbon::createFromDate($year, $month, 1)->addMonths($offset);
                $year = $targetDate->year;
                $month = $targetDate->month;
                $daysInMonth = $targetDate->daysInMonth;

                // Calculate weeks in month
                $weeks = [];
                $currentWeek = 1;
                $weekDay = 1;
                $trendData = [];

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $weeks[$day] = $currentWeek;
                    $weekDay++;
                    if ($weekDay > 7) {
                        $currentWeek++;
                        $weekDay = 1;
                    }
                }

                $uniqueWeeks = array_unique(array_values($weeks));
                $trendData = array_fill(0, max($uniqueWeeks), 0);
                $labels = array_map(fn($w) => "Week $w", range(1, max($uniqueWeeks)));

                foreach ($materials as $material) {
                    $materialDate = $material->created_at ? Carbon::parse($material->created_at) : null;
                    if ($materialDate && $materialDate->year == $year && $materialDate->month == $month) {
                        $day = $materialDate->day;
                        if (isset($weeks[$day])) {
                            $weekNum = $weeks[$day] - 1;
                            $cost = ($material->material_cost ?? 0) * ($material->quantity ?? 0) +
                                    ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                            $trendData[$weekNum] += $cost;
                        }
                    }
                }

                $title = "Weekly Spending Trend - " . $targetDate->format('F Y');
                $periodInfo = $targetDate->format('F Y');
                break;

            case 'year':
                // Yearly trend - all 12 months
                $targetYear = $year + $offset;
                $trendData = array_fill(0, 12, 0);
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                foreach ($materials as $material) {
                    $materialDate = $material->created_at ? Carbon::parse($material->created_at) : null;
                    if ($materialDate && $materialDate->year == $targetYear) {
                        $month = $materialDate->month - 1;
                        $cost = ($material->material_cost ?? 0) * ($material->quantity ?? 0) +
                                ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                        $trendData[$month] += $cost;
                    }
                }

                $title = "Yearly Spending Trend - $targetYear";
                $periodInfo = "Year $targetYear";
                break;

            case 'day':
            default:
                // Daily trend for the current month (31 days)
                $targetDate = Carbon::createFromDate($year, $month, 1)->addMonths($offset);
                $year = $targetDate->year;
                $month = $targetDate->month;
                $daysInMonth = $targetDate->daysInMonth;

                $trendData = array_fill(0, $daysInMonth, 0);
                $labels = array_map(fn($day) => "Day $day", range(1, $daysInMonth));

                foreach ($materials as $material) {
                    $materialDate = $material->created_at ? Carbon::parse($material->created_at) : null;
                    if ($materialDate && $materialDate->year == $year && $materialDate->month == $month) {
                        $day = $materialDate->day - 1;
                        $cost = ($material->material_cost ?? 0) * ($material->quantity ?? 0) +
                                ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                        $trendData[$day] += $cost;
                    }
                }

                $title = "Daily Spending Trend - " . $targetDate->format('F Y');
                $periodInfo = $targetDate->format('F Y');
                break;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $trendData,
            'title' => $title,
            'periodInfo' => $periodInfo,
            'filter' => $filter,
            'year' => $year,
            'month' => $month,
        ]);
    }
}
