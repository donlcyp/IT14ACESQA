<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectRecord;
use App\Models\FinancialData;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
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

        // Active projects (latest 5) - all non-archived
        $activeProjects = Project::where('archived', false)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Recent project material records (latest 5)
        $recentProjectRecords = ProjectRecord::orderByDesc('created_at')
            ->take(5)
            ->get();

        // Projects that have materials to be returned (materials with status "Fail")
        $projectsToReturn = ProjectRecord::whereHas('materials', function ($query) {
                $query->where('status', 'Fail');
            })
            ->with(['materials' => function ($query) {
                $query->where('status', 'Fail');
            }])
            ->withCount(['materials as failed_count' => function ($query) {
                $query->where('status', 'Fail');
            }])
            ->orderByDesc('failed_count')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'summary',
            'activeProjects',
            'recentProjectRecords',
            'projectsToReturn'
        ));
    }
}
