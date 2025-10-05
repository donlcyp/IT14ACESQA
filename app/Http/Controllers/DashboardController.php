<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // You can add logic here to fetch dashboard data from models
        // For now, we'll use static data as shown in the image
        
        $dashboardData = [
            'total_projects' => 27,
            'complete_projects' => 21,
            'ongoing_projects' => 6,
        ];

        return view('dashboard', compact('dashboardData'));
    }
}
