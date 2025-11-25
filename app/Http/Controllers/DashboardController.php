<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Material;
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
            'projectsToReturn'
        ));
    }
}
