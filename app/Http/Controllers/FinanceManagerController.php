<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Material;
use App\Models\Invoice;
use App\Models\EmployeeList;
use Carbon\Carbon;

class FinanceManagerController extends Controller
{
    /**
     * FM Dashboard - Main overview with KPIs and charts
     */
    public function index()
    {
        $user = auth()->user();

        // Get all active projects (FM can see all projects for financial overview)
        $projects = Project::where('archived', false)
            ->with(['client', 'assignedPM', 'materials'])
            ->orderByDesc('created_at')
            ->get();

        // Calculate KPIs
        $totalBudget = $projects->sum('allocated_amount');
        
        $totalSpent = 0;
        $totalMaterialCost = 0;
        $totalLaborCost = 0;
        
        foreach ($projects as $project) {
            foreach ($project->materials as $material) {
                $mCost = ($material->material_cost ?? 0) * ($material->quantity ?? 0);
                $lCost = ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                $totalMaterialCost += $mCost;
                $totalLaborCost += $lCost;
                $totalSpent += $mCost + $lCost;
            }
        }

        $budgetRemaining = $totalBudget - $totalSpent;
        $budgetUtilization = $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 1) : 0;

        // Pending replacement requests count (needs FM attention)
        $pendingReplacements = Material::where('replacement_requested', true)
            ->where('replacement_status', 'pending')
            ->count();

        // Project statistics for charts
        $projectsByStatus = [
            'ongoing' => $projects->where('status', '!=', 'Completed')->count(),
            'completed' => $projects->where('status', 'Completed')->count(),
        ];

        // Budget distribution per project (top 10 by budget)
        $budgetByProject = $projects->sortByDesc('allocated_amount')
            ->take(10)
            ->map(function ($project) {
                $projectSpent = 0;
                foreach ($project->materials as $material) {
                    $projectSpent += (($material->material_cost ?? 0) + ($material->labor_cost ?? 0)) * ($material->quantity ?? 0);
                }
                return [
                    'id' => $project->id,
                    'name' => $project->project_name ?? $project->project_code,
                    'budget' => $project->allocated_amount ?? 0,
                    'spent' => $projectSpent,
                    'remaining' => ($project->allocated_amount ?? 0) - $projectSpent,
                    'status' => $project->status,
                ];
            })->values();

        // Monthly spending trend (last 6 months)
        $monthlySpending = $this->getMonthlySpending();

        // Material cost breakdown
        $materialBreakdown = Material::selectRaw('category, SUM((material_cost + labor_cost) * quantity) as total_cost')
            ->whereHas('project', function ($q) {
                $q->where('archived', false);
            })
            ->groupBy('category')
            ->orderByDesc('total_cost')
            ->take(8)
            ->get()
            ->map(function ($item) {
                return [
                    'category' => $item->category ?? 'Uncategorized',
                    'total_cost' => $item->total_cost ?? 0,
                ];
            });

        // Summary stats
        $summary = [
            'total_projects' => $projects->count(),
            'ongoing_projects' => $projectsByStatus['ongoing'],
            'completed_projects' => $projectsByStatus['completed'],
            'total_budget' => $totalBudget,
            'total_spent' => $totalSpent,
            'budget_remaining' => $budgetRemaining,
            'budget_utilization' => $budgetUtilization,
            'material_cost' => $totalMaterialCost,
            'labor_cost' => $totalLaborCost,
            'pending_replacements' => $pendingReplacements,
        ];

        return view('fm-dashboard', compact(
            'summary',
            'projects',
            'budgetByProject',
            'monthlySpending',
            'materialBreakdown',
            'pendingReplacements'
        ));
    }

    /**
     * FM Replacement Approvals Page
     */
    public function replacementApprovals()
    {
        $user = auth()->user();

        // Get all materials with replacement requests
        $pendingReplacements = Material::where('replacement_requested', true)
            ->where('replacement_status', 'pending')
            ->with(['project', 'qaInspector', 'replacementRequester'])
            ->orderByDesc('replacement_requested_at')
            ->get();

        $approvedReplacements = Material::where('replacement_requested', true)
            ->where('replacement_status', 'approved')
            ->with(['project', 'qaInspector', 'replacementRequester', 'replacementApprover'])
            ->orderByDesc('replacement_approved_at')
            ->take(20)
            ->get();

        $rejectedReplacements = Material::where('replacement_requested', true)
            ->where('replacement_status', 'rejected')
            ->with(['project', 'qaInspector', 'replacementRequester', 'replacementApprover'])
            ->orderByDesc('replacement_approved_at')
            ->take(20)
            ->get();

        // Calculate replacement costs
        $pendingReplacementCost = $pendingReplacements->sum(function ($m) {
            return (($m->material_cost ?? 0) + ($m->labor_cost ?? 0)) * ($m->quantity ?? 0);
        });

        $approvedReplacementCost = $approvedReplacements->sum(function ($m) {
            return (($m->material_cost ?? 0) + ($m->labor_cost ?? 0)) * ($m->quantity ?? 0);
        });

        return view('fm-replacement-approvals', compact(
            'pendingReplacements',
            'approvedReplacements',
            'rejectedReplacements',
            'pendingReplacementCost',
            'approvedReplacementCost'
        ));
    }

    /**
     * View specific project details (FM read-only view)
     */
    public function viewProject(Project $project)
    {
        $project->load(['client', 'assignedPM', 'materials.qaInspector', 'employees', 'documents', 'updates']);

        // Calculate project financials
        $totalMaterialCost = 0;
        $totalLaborCost = 0;
        $totalSpent = 0;

        foreach ($project->materials as $material) {
            $mCost = ($material->material_cost ?? 0) * ($material->quantity ?? 0);
            $lCost = ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
            $totalMaterialCost += $mCost;
            $totalLaborCost += $lCost;
            $totalSpent += $mCost + $lCost;
        }

        $budget = $project->allocated_amount ?? 0;
        $remaining = $budget - $totalSpent;
        $utilization = $budget > 0 ? round(($totalSpent / $budget) * 100, 1) : 0;

        // Material status breakdown
        $materialStats = [
            'total' => $project->materials->count(),
            'pending' => $project->materials->filter(fn($m) => !$m->qa_status || $m->qa_status === 'pending')->count(),
            'passed' => $project->materials->where('qa_status', 'passed')->count(),
            'failed' => $project->materials->where('qa_status', 'failed')->count(),
            'recheck' => $project->materials->where('qa_status', 'requires_recheck')->count(),
            'needs_replacement' => $project->materials->where('needs_replacement', true)->count(),
        ];

        // Replacement requests for this project
        $replacementRequests = $project->materials
            ->where('replacement_requested', true)
            ->values();

        $financials = [
            'budget' => $budget,
            'material_cost' => $totalMaterialCost,
            'labor_cost' => $totalLaborCost,
            'total_spent' => $totalSpent,
            'remaining' => $remaining,
            'utilization' => $utilization,
        ];

        return view('fm-project-view', compact(
            'project',
            'financials',
            'materialStats',
            'replacementRequests'
        ));
    }

    /**
     * Get project stats for AJAX charts
     */
    public function getProjectStats(Request $request)
    {
        $projectId = $request->get('project_id');
        
        if ($projectId) {
            $project = Project::with('materials')->find($projectId);
            if (!$project) {
                return response()->json(['error' => 'Project not found'], 404);
            }

            $totalSpent = 0;
            $materialCost = 0;
            $laborCost = 0;

            foreach ($project->materials as $material) {
                $mCost = ($material->material_cost ?? 0) * ($material->quantity ?? 0);
                $lCost = ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                $materialCost += $mCost;
                $laborCost += $lCost;
                $totalSpent += $mCost + $lCost;
            }

            return response()->json([
                'budget' => $project->allocated_amount ?? 0,
                'spent' => $totalSpent,
                'material_cost' => $materialCost,
                'labor_cost' => $laborCost,
                'remaining' => ($project->allocated_amount ?? 0) - $totalSpent,
            ]);
        }

        // Return all projects stats
        $projects = Project::where('archived', false)->with('materials')->get();
        
        $data = $projects->map(function ($project) {
            $totalSpent = 0;
            foreach ($project->materials as $material) {
                $totalSpent += (($material->material_cost ?? 0) + ($material->labor_cost ?? 0)) * ($material->quantity ?? 0);
            }
            return [
                'id' => $project->id,
                'name' => $project->project_name ?? $project->project_code,
                'budget' => $project->allocated_amount ?? 0,
                'spent' => $totalSpent,
            ];
        });

        return response()->json($data);
    }

    /**
     * Get monthly spending data for charts
     */
    private function getMonthlySpending()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = [
                'month' => $date->format('M Y'),
                'start' => $date->startOfMonth()->toDateString(),
                'end' => $date->copy()->endOfMonth()->toDateString(),
            ];
        }

        $spending = [];
        foreach ($months as $month) {
            // Get materials created/updated in this month
            $monthlyTotal = Material::whereBetween('created_at', [$month['start'], $month['end']])
                ->whereHas('project', function ($q) {
                    $q->where('archived', false);
                })
                ->get()
                ->sum(function ($m) {
                    return (($m->material_cost ?? 0) + ($m->labor_cost ?? 0)) * ($m->quantity ?? 0);
                });

            $spending[] = [
                'month' => $month['month'],
                'amount' => $monthlyTotal,
            ];
        }

        return $spending;
    }
}
