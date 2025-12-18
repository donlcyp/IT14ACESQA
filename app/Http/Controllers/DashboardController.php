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
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Check if user is QA role - show QA-specific dashboard
        if ($user && $user->role === 'QA') {
            return $this->qaDashboard($user);
        }
        
        // Check if user is FM role - redirect to FM dashboard
        if ($user && $user->role === 'FM') {
            return redirect()->route('fm.dashboard');
        }
        
        // Check if user is SS role - redirect to Site Supervisor dashboard
        if ($user && $user->role === 'SS') {
            return redirect()->route('ss.dashboard');
        }
        
        // Get date filter parameters
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $filterType = $request->get('filter_type', 'all'); // all, this_month, this_year, custom
        
        // Set default date ranges based on filter type
        if ($filterType === 'this_month') {
            $dateFrom = Carbon::now()->startOfMonth()->format('Y-m-d');
            $dateTo = Carbon::now()->endOfMonth()->format('Y-m-d');
        } elseif ($filterType === 'this_year') {
            $dateFrom = Carbon::now()->startOfYear()->format('Y-m-d');
            $dateTo = Carbon::now()->endOfYear()->format('Y-m-d');
        } elseif ($filterType === 'last_month') {
            $dateFrom = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
            $dateTo = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        } elseif ($filterType === 'last_year') {
            $dateFrom = Carbon::now()->subYear()->startOfYear()->format('Y-m-d');
            $dateTo = Carbon::now()->subYear()->endOfYear()->format('Y-m-d');
        }
        
        // Check if user is an employee (but NOT a project manager)
        $employeeRecord = $user ? EmployeeList::where('user_id', $user->id)->first() : null;
        $isPM = $user ? Project::where('assigned_pm_id', $user->id)->exists() : false;
        
        // If user is a PM, show PM dashboard. Otherwise check if they're an employee
        $isEmployee = $employeeRecord && !$isPM;

        // Initialize all variables that will be passed to the view
        $summary = [];
        $assignedProjects = collect();
        $todayAttendance = null;
        $recentAttendance = collect();
        $activeProjects = collect();
        $recentProjectRecords = collect();
        $projectsToReturn = collect();

        if ($isEmployee) {
            // EMPLOYEE VIEW - Show only their assigned projects
            $employee = $employeeRecord;

            // Get projects this employee is assigned to
            $assignedProjects = $employee->projects()
                ->where('archived', false)
                ->with('client', 'assignedPM')
                ->get();

            $summary = [
                'total_projects' => $assignedProjects->count(),
                'complete_projects' => $assignedProjects->where('status', 'Completed')->count(),
                'ongoing_projects' => $assignedProjects->where('status', '!=', 'Completed')->count(),
                'delayed_projects' => $assignedProjects->filter(function($p) {
                    return $p->date_ended && ($p->date_ended < $p->date_started || $p->date_ended > now());
                })->count(),
                'total_workers' => EmployeeList::count(),
                'pending_approvals' => Material::where('status', 'pending')->whereHas('project', function($q) use ($assignedProjects) {
                    return $q->whereIn('id', $assignedProjects->pluck('id'));
                })->count(),
                'total_budget' => $assignedProjects->sum('allocated_amount'),
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
                'activeProjects',
                'recentProjectRecords',
                'projectsToReturn',
                'isEmployee'
            ));
        } else {
            // OWNER/PM VIEW - Show all projects
            // Dashboard now uses live data instead of static placeholders.
            
            // Build base query with optional date filtering
            $baseQuery = Project::where('archived', false);
            
            if ($dateFrom) {
                $baseQuery->where(function($q) use ($dateFrom) {
                    $q->whereDate('date_started', '>=', $dateFrom)
                      ->orWhereDate('created_at', '>=', $dateFrom);
                });
            }
            if ($dateTo) {
                $baseQuery->where(function($q) use ($dateTo) {
                    $q->whereDate('date_started', '<=', $dateTo)
                      ->orWhereDate('created_at', '<=', $dateTo);
                });
            }

            // Project summary (filtered)
            $totalProjects = (clone $baseQuery)->count();

            $completeProjects = (clone $baseQuery)
                ->where('status', 'Completed')
                ->count();

            $ongoingProjects = (clone $baseQuery)
                ->where('status', '!=', 'Completed')
                ->count();

            $summary = [
                'total_projects' => $totalProjects,
                'complete_projects' => $completeProjects,
                'ongoing_projects' => $ongoingProjects,
                'delayed_projects' => (clone $baseQuery)
                    ->whereNotNull('target_timeline')
                    ->where('status', '!=', 'Completed')
                    ->whereDate('target_timeline', '<', now())
                    ->count(),
                'total_workers' => EmployeeList::count(),
                'pending_approvals' => Material::where('status', 'pending')->count(),
                'total_budget' => (clone $baseQuery)->sum('allocated_amount'),
            ];

            // Active projects (ongoing, filtered) - latest 6
            $activeProjects = (clone $baseQuery)
                ->where('status', '!=', 'Completed')
                ->with(['client', 'assignedPM', 'materials'])
                ->orderByDesc('created_at')
                ->take(6)
                ->get();
            
            // Historical/Completed projects (separate section) - latest 6
            $historicalProjects = Project::where('archived', false)
                ->where('status', 'Completed')
                ->with(['client', 'assignedPM', 'materials'])
                ->orderByDesc('date_ended')
                ->take(6)
                ->get();
            
            // Monthly project statistics for charts
            $monthlyStats = $this->getMonthlyProjectStats();

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
                'historicalProjects',
                'monthlyStats',
                'recentProjectRecords',
                'projectsToReturn',
                'assignedProjects',
                'todayAttendance',
                'recentAttendance',
                'isEmployee',
                'dateFrom',
                'dateTo',
                'filterType'
            ));
        }
    }
    
    /**
     * Get monthly project statistics for charts
     */
    private function getMonthlyProjectStats()
    {
        $stats = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $created = Project::where('archived', false)
                ->whereDate('created_at', '>=', $monthStart)
                ->whereDate('created_at', '<=', $monthEnd)
                ->count();
                
            $completed = Project::where('archived', false)
                ->where('status', 'Completed')
                ->whereDate('date_ended', '>=', $monthStart)
                ->whereDate('date_ended', '<=', $monthEnd)
                ->count();
            
            $stats[] = [
                'month' => $month->format('M Y'),
                'month_short' => $month->format('M'),
                'created' => $created,
                'completed' => $completed,
            ];
        }
        
        return $stats;
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

    /**
     * QA Role Dashboard - Shows materials from assigned projects
     */
    private function qaDashboard($user)
    {
        // Get QA officer's employee record
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Get projects assigned to this QA officer
        $assignedProjects = collect();
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->with('client', 'assignedPM')
                ->get();
        }
        
        $projectIds = $assignedProjects->pluck('id');
        
        // Get materials from assigned projects
        $allMaterials = Material::whereIn('project_id', $projectIds)->with('project')->get();
        
        // Count materials by QA status
        $pendingMaterials = $allMaterials->filter(function($m) {
            return !$m->qa_status || $m->qa_status === 'pending';
        });
        $approvedMaterials = $allMaterials->where('qa_status', 'passed');
        $failedMaterials = $allMaterials->where('qa_status', 'failed');
        $recheckMaterials = $allMaterials->where('qa_status', 'requires_recheck');
        $needsReplacementMaterials = $allMaterials->where('needs_replacement', true);
        
        $qaSummary = [
            'total_materials' => $allMaterials->count(),
            'pending_count' => $pendingMaterials->count(),
            'approved_count' => $approvedMaterials->count(),
            'failed_count' => $failedMaterials->count(),
            'recheck_count' => $recheckMaterials->count(),
            'replacement_count' => $needsReplacementMaterials->count(),
            'assigned_projects' => $assignedProjects->count(),
        ];
        
        // Recent pending materials for quick access
        $recentPending = $pendingMaterials->sortByDesc('created_at')->take(5);
        $recentFailed = $failedMaterials->sortByDesc('qa_decision_at')->take(5);
        
        return view('dashboard', [
            'isQA' => true,
            'isEmployee' => false,
            'qaSummary' => $qaSummary,
            'assignedProjects' => $assignedProjects,
            'recentPending' => $recentPending,
            'recentFailed' => $recentFailed,
            'summary' => [
                'total_projects' => $assignedProjects->count(),
                'ongoing_projects' => $assignedProjects->where('status', '!=', 'Completed')->count(),
                'complete_projects' => $assignedProjects->where('status', 'Completed')->count(),
                'delayed_projects' => 0,
                'total_workers' => EmployeeList::count(),
            ],
            'activeProjects' => collect(),
            'recentProjectRecords' => collect(),
            'projectsToReturn' => collect(),
            'todayAttendance' => null,
            'recentAttendance' => collect(),
        ]);
    }

    /**
     * QA Materials Page - Shows all materials for QA inspection
     */
    public function qaMaterials(Request $request)
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== 'QA') {
            abort(403, 'Only Quality Assurance Officers can access this page.');
        }
        
        // Get QA officer's employee record
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();
        
        // Get projects assigned to this QA officer
        $assignedProjects = collect();
        if ($employeeRecord) {
            $assignedProjects = $employeeRecord->projects()
                ->where('archived', false)
                ->with('client', 'assignedPM')
                ->get();
        }
        
        $projectIds = $assignedProjects->pluck('id');
        
        // Filter by status if provided
        $statusFilter = $request->get('status', 'all');
        
        // Get materials from assigned projects
        $materialsQuery = Material::whereIn('project_id', $projectIds)->with('project', 'qaInspector');
        
        // Apply status filter
        if ($statusFilter === 'pending') {
            $materialsQuery->where(function($q) {
                $q->whereNull('qa_status')->orWhere('qa_status', 'pending');
            });
        } elseif ($statusFilter === 'approved') {
            $materialsQuery->where('qa_status', 'passed');
        } elseif ($statusFilter === 'failed') {
            $materialsQuery->where('qa_status', 'failed');
        } elseif ($statusFilter === 'recheck') {
            $materialsQuery->where('qa_status', 'requires_recheck');
        } elseif ($statusFilter === 'replacement') {
            // Show only materials that need replacement AND either have no request or have a pending request
            // Exclude approved/rejected replacements
            $materialsQuery->where('needs_replacement', true)
                ->where(function($q) {
                    $q->where('replacement_requested', false)
                      ->orWhere('replacement_status', 'pending');
                });
        }
        
        $materials = $materialsQuery->orderByDesc('created_at')->get();
        
        // Count for tabs
        $allMaterials = Material::whereIn('project_id', $projectIds)->get();
        $counts = [
            'all' => $allMaterials->count(),
            'pending' => $allMaterials->filter(fn($m) => !$m->qa_status || $m->qa_status === 'pending')->count(),
            'approved' => $allMaterials->where('qa_status', 'passed')->count(),
            'failed' => $allMaterials->where('qa_status', 'failed')->count(),
            'recheck' => $allMaterials->where('qa_status', 'requires_recheck')->count(),
            'replacement' => $allMaterials->where('needs_replacement', true)->filter(function($m) {
                // Count only if no request OR request is pending (exclude approved/rejected)
                return !$m->replacement_requested || $m->replacement_status === 'pending';
            })->count(),
        ];
        
        // Define failure reasons for dropdown
        $failureReasons = [
            'Damaged during delivery',
            'Does not meet specifications',
            'Wrong item delivered',
            'Quality below standard',
            'Expired or outdated',
            'Incomplete quantity',
            'Missing documentation',
            'Failed safety inspection',
            'Contaminated or defective',
            'Other (specify in remarks)',
        ];
        
        return view('qa-materials', [
            'materials' => $materials,
            'counts' => $counts,
            'statusFilter' => $statusFilter,
            'assignedProjects' => $assignedProjects,
            'failureReasons' => $failureReasons,
        ]);
    }

    /**
     * Submit QA Decision (Approve/Fail)
     */
    public function submitQADecision(Request $request, Material $material)
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== 'QA') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validate([
            'decision' => 'required|in:approved,failed',
            'failure_reason' => 'required_if:decision,failed|nullable|string',
            'remarks' => 'nullable|string|max:1000',
        ]);
        
        $material->qa_status = $validated['decision'] === 'approved' ? 'passed' : 'failed';
        $material->qa_inspected_by = $user->id;
        $material->qa_inspected_at = now();
        $material->qa_decision_at = now();
        $material->qa_remarks = $validated['remarks'] ?? null;
        
        if ($validated['decision'] === 'failed') {
            $material->failure_reason = $validated['failure_reason'];
            $material->needs_replacement = true;
        } else {
            $material->failure_reason = null;
            $material->needs_replacement = false;
        }
        
        $material->save();
        
        return response()->json([
            'success' => true,
            'message' => $validated['decision'] === 'approved' 
                ? 'Material approved successfully!' 
                : 'Material marked as failed. It has been added to the replacement list.',
        ]);
    }

    /**
     * Submit a replacement request for a failed material (QA role only).
     */
    public function requestReplacement(Request $request, Material $material)
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== 'QA') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        // Ensure material needs replacement
        if (!$material->needs_replacement) {
            return response()->json(['success' => false, 'message' => 'This material does not require replacement'], 400);
        }
        
        // Ensure not already requested
        if ($material->replacement_requested) {
            return response()->json(['success' => false, 'message' => 'Replacement has already been requested for this material'], 400);
        }
        
        $validated = $request->validate([
            'replacement_reason' => 'required|string|max:1000',
        ]);
        
        $material->replacement_requested = true;
        $material->replacement_requested_at = now();
        $material->replacement_requested_by = $user->id;
        $material->replacement_reason = $validated['replacement_reason'];
        $material->replacement_status = 'pending';
        $material->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Replacement request submitted successfully! Project managers will review your request.',
        ]);
    }

    /**
     * Get material details for modal view (QA role).
     */
    public function getMaterialDetails(Material $material)
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== 'QA') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
        $material->load(['project', 'qaInspector', 'replacementRequester', 'replacementApprover']);
        
        // Calculate unit cost (per unit) and total amount
        // Unit cost = material_cost + labor_cost (both are per unit)
        $materialCost = $material->material_cost ?? $material->unit_price ?? 0;
        $laborCost = $material->labor_cost ?? 0;
        $unitCost = $materialCost + $laborCost;
        $totalAmount = $unitCost * ($material->quantity ?? 1);
        
        return response()->json([
            'success' => true,
            'material' => [
                'id' => $material->id,
                'item_description' => $material->item_description ?? $material->material_name ?? 'Unnamed Item',
                'item_no' => $material->item_no,
                'category' => $material->category,
                'quantity' => $material->quantity,
                'unit' => $material->unit,
                'unit_cost' => $unitCost,
                'amount' => $totalAmount,
                'qa_status' => $material->qa_status,
                'failure_reason' => $material->failure_reason,
                'qa_remarks' => $material->qa_remarks,
                'qa_inspected_at' => $material->qa_inspected_at?->format('M d, Y h:i A'),
                'qa_inspector' => [
                    'name' => $material->qaInspector?->name
                ],
                'needs_replacement' => $material->needs_replacement,
                'replacement_requested' => $material->replacement_requested,
                'replacement_status' => $material->replacement_status,
                'replacement_reason' => $material->replacement_reason,
                'replacement_requested_at' => $material->replacement_requested_at?->format('M d, Y h:i A'),
                'replacement_requester' => [
                    'name' => $material->replacementRequester?->name
                ],
                'replacement_approved_at' => $material->replacement_approved_at?->format('M d, Y h:i A'),
                'replacement_approver' => [
                    'name' => $material->replacementApprover?->name
                ],
                'replacement_notes' => $material->replacement_notes,
                'project' => [
                    'id' => $material->project?->id,
                    'project_name' => $material->project?->project_name ?? $material->project?->project_code,
                    'location' => $material->project?->location,
                ],
            ],
        ]);
    }
}
