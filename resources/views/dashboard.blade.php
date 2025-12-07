<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #059669;

            --text-lg-medium-font-family: "Inter", sans-serif;
            --text-lg-medium-font-weight: 500;
            --text-lg-medium-font-size: 18px;
            --text-lg-medium-line-height: 28px;
            --text-md-normal-font-family: "Inter", sans-serif;
            --text-md-normal-font-weight: 400;
            --text-md-normal-font-size: 16px;
            --text-md-normal-line-height: 24px;
            --text-sm-medium-font-family: "Inter", sans-serif;
            --text-sm-medium-font-weight: 500;
            --text-sm-medium-font-size: 14px;
            --text-sm-medium-line-height: 20px;
            --text-headline-small-bold-font-family: "Inter", sans-serif;
            --text-headline-small-bold-font-weight: 700;
            --text-headline-small-bold-font-size: 18px;
            --text-headline-small-bold-line-height: 28px;

            --shadow-xs: 0 1px 2px rgba(16, 24, 40, 0.05);
            --shadow-md: 0 6px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: var(--text-md-normal-font-family);
            background-color: var(--main-bg);
            color: var(--gray-700);
        }

        /* Sidebar has been moved to partials/sidebar.blade.php */

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }
        
        /* When sidebar is hidden on desktop */
        .main-content.sidebar-closed { 
            margin-left: 0; 
        }
        
        /* Desktop: Reserve space for sidebar */
        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }
        
        /* Mobile: Sidebar overlays, no margin */
        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0 !important; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0 !important; 
            }
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #16a34a);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .header-menu:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
        }

        /* Summary Statistics Card */
        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .summary-item {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 20px;
            position: relative;
        }

        .summary-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 60px;
            background-color: #e5e7eb;
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            background-color: var(--blue-600);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .summary-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .summary-label {
            color: var(--gray-600);
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .summary-number {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: var(--text-headline-small-bold-font-weight);
            line-height: 1.2;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            color: var(--gray-700);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .dashboard-card.full {
            grid-column: span 12;
        }

        .dashboard-card.half {
            grid-column: span 6;
        }

        .dashboard-card.third {
            grid-column: span 4;
        }

        .dashboard-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .dashboard-card-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-800);
        }

        .dashboard-card-subtitle {
            font-size: 14px;
            color: var(--gray-500);
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-table tbody tr:not(:last-child) td {
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-table td {
            padding: 14px 12px;
            font-size: 14px;
            color: var(--gray-700);
            vertical-align: middle;
        }

        .dashboard-table td:nth-child(3),
        .dashboard-table td:nth-child(5),
        .dashboard-table td:nth-child(6),
        .dashboard-table td:nth-child(7) {
            text-align: right;
        }

        .dashboard-table td:nth-child(5) {
            text-align: center;
        }

        .dashboard-table td:nth-child(7) {
            font-weight: 600;
            text-align: center;
        }

        .dashboard-table thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-table thead th:nth-child(3),
        .dashboard-table thead th:nth-child(5),
        .dashboard-table thead th:nth-child(6),
        .dashboard-table thead th:nth-child(7) {
            text-align: right;
        }

        .dashboard-table thead th:nth-child(5) {
            text-align: center;
        }

        .dashboard-table thead th:nth-child(7) {
            text-align: center;
        }

        /* Center Status column in first dashboard card (Active Projects) */
        .dashboard-grid > .dashboard-card:nth-child(1) .dashboard-table td:nth-child(3),
        .dashboard-grid > .dashboard-card:nth-child(1) .dashboard-table thead th:nth-child(3) {
            text-align: center;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-badge.success {
            background-color: transparent;
            color: #047857;
        }

        .status-badge.warning {
            background-color: transparent;
            color: #a16207;
        }

        .status-badge.info {
            background-color: transparent;
            color: #1d4ed8;
        }


        .view-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-600);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-link i {
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .summary-card {
                flex-direction: column;
                gap: 20px;
            }

            .summary-item {
                width: 100%;
                padding: 16px 0;
            }

            .summary-item:not(:last-child)::after {
                display: none;
            }

            .dashboard-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }

            .dashboard-card,
            .dashboard-card.full,
            .dashboard-card.half,
            .dashboard-card.third {
                grid-column: span 1;
            }
        }

        @media (max-width: 480px) {
            .summary-card {
                padding: 16px;
            }

            .summary-item {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }

            .summary-number {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <!-- Content Area -->
            <section class="content-area">
                <!-- Summary Statistics -->
                <div class="summary-card">
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-label">@if($isEmployee ?? false)My Projects@else Total Projects @endif</span>
                            <span class="summary-number">{{ number_format($summary['total_projects'] ?? 0) }}</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-label">Complete Projects</span>
                            <span class="summary-number">{{ number_format($summary['complete_projects'] ?? 0) }}</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-label">Ongoing Projects</span>
                            <span class="summary-number">{{ number_format($summary['ongoing_projects'] ?? 0) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Detailed Insights -->
                <div class="dashboard-grid">
                    @if ($isEmployee ?? false)
                        <!-- EMPLOYEE VIEW -->
                        <div class="dashboard-card full">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">My Assigned Project</div>
                                    <div class="dashboard-card-subtitle">Project you are currently working on</div>
                                </div>
                            </div>

                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Client</th>
                                        <th>Status</th>
                                        <th>Lead</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($assignedProjects as $project)
                                        @php
                                            $projectDisplayStatus = $project->status === 'On Track' ? 'Ongoing' : $project->status;
                                            $statusMap = [
                                                'Ongoing'    => ['class' => 'success', 'icon' => 'fas fa-check'],
                                                'Under Review' => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                                'In Review'  => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                                'Mobilizing' => ['class' => 'info', 'icon' => 'fas fa-bolt'],
                                                'On Hold'    => ['class' => 'warning', 'icon' => 'fas fa-pause'],
                                                'Completed'  => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                            ];
                                            $badge = $statusMap[$projectDisplayStatus] ?? ['class' => 'info', 'icon' => 'fas fa-bolt'];
                                            
                                            // Get client name from relationship or fallback to project fields
                                            if ($project->client) {
                                                $clientName = $project->client->company_name ?? $project->client->name ?? 'N/A';
                                            } else {
                                                $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? '')) ?: 'N/A';
                                            }
                                            
                                            // Get lead name from PM relationship or fallback to lead field
                                            $leadName = $project->assignedPM?->name ?? $project->lead ?? 'N/A';
                                        @endphp
                                        <tr>
                                            <td>{{ $project->project_name }}</td>
                                            <td>{{ $clientName }}</td>
                                            <td>
                                                <span class="status-badge {{ $badge['class'] }}">
                                                    <i class="{{ $badge['icon'] }}"></i>
                                                    {{ $projectDisplayStatus ?? '—' }}
                                                </span>
                                            </td>
                                            <td>{{ $leadName }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="color:#6b7280; padding:12px 0;">You are not assigned to any project.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Today's Attendance -->
                        <div class="dashboard-card half">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">Today's Attendance</div>
                                    <div class="dashboard-card-subtitle">Your current attendance status</div>
                                </div>
                            </div>

                            @if ($todayAttendance)
                                <div style="padding: 20px;">
                                    <table class="dashboard-table">
                                        <tbody>
                                            <tr>
                                                <td><strong>Status</strong></td>
                                                <td>
                                                    <span class="status-badge {{ strtolower(str_replace(' ', '-', $todayAttendance->attendance_status)) }}">
                                                        {{ $todayAttendance->attendance_status }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Punch In</strong></td>
                                                <td>{{ $todayAttendance->punch_in_time ? $todayAttendance->punch_in_time->format('H:i:s') : 'Not yet punched in' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Punch Out</strong></td>
                                                <td>{{ $todayAttendance->punch_out_time ? $todayAttendance->punch_out_time->format('H:i:s') : '—' }}</td>
                                            </tr>
                                            @if ($todayAttendance->is_late)
                                                <tr>
                                                    <td><strong>Late Arrival</strong></td>
                                                    <td><span style="color: #dc2626; font-weight: 600;">Yes ({{ $todayAttendance->late_minutes }} minutes)</span></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div style="padding: 20px; color: #6b7280;">
                                    <p>No attendance record for today yet. <a href="{{ $isEmployee ? route('my-attendance') : route('employee-attendance') }}" style="color: #16a34a; text-decoration: none; font-weight: 600;">Punch in now</a></p>
                                </div>
                            @endif
                        </div>

                        <!-- Recent Attendance History -->
                        <div class="dashboard-card half">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">Recent Attendance</div>
                                    <div class="dashboard-card-subtitle">Last 5 attendance records</div>
                                </div>
                                <a class="view-link" href="{{ $isEmployee ? route('my-attendance') : route('employee-attendance') }}">
                                    View all
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Punch In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentAttendance as $record)
                                        <tr>
                                            <td>{{ $record->date->format('M d, Y') }}</td>
                                            <td>
                                                <span class="status-badge {{ strtolower(str_replace(' ', '-', $record->attendance_status)) }}">
                                                    {{ $record->attendance_status }}
                                                </span>
                                            </td>
                                            <td>{{ $record->punch_in_time ? $record->punch_in_time->format('H:i') : '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="color:#6b7280; padding:12px 0;">No attendance records yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- ADMIN/PM VIEW -->
                        <div class="dashboard-card full">
                            <div class="dashboard-card-header">
                                <div>
                                    <div class="dashboard-card-title">Active Projects</div>
                                    <div class="dashboard-card-subtitle">Projects currently in execution with status</div>
                                </div>
                                <a class="view-link" href="{{ route('projects') }}">
                                    View all
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>

                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Client</th>
                                        <th style="text-align: center;">Status</th>
                                        <th>Lead</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $statusMap = [
                                            'Ongoing'    => ['class' => 'success', 'icon' => 'fas fa-check'],
                                            'Under Review' => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                            'In Review'  => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                            'Mobilizing' => ['class' => 'info', 'icon' => 'fas fa-bolt'],
                                            'On Hold'    => ['class' => 'warning', 'icon' => 'fas fa-pause'],
                                            'Completed'  => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                        ];
                                    @endphp

                                    @forelse ($activeProjects as $project)
                                        @php
                                            $projectDisplayStatus = $project->status === 'On Track' ? 'Ongoing' : $project->status;
                                            $badge = $statusMap[$projectDisplayStatus] ?? ['class' => 'info', 'icon' => 'fas fa-bolt'];
                                            
                                            // Get client name from relationship or fallback to project fields
                                            if ($project->client) {
                                                $clientName = $project->client->company_name ?? $project->client->name ?? 'N/A';
                                            } else {
                                                $clientName = trim(($project->client_first_name ?? '') . ' ' . ($project->client_last_name ?? '')) ?: 'N/A';
                                            }
                                            
                                            // Get lead name from PM relationship or fallback to lead field
                                            $leadName = $project->assignedPM?->name ?? $project->lead ?? 'N/A';
                                        @endphp
                                        <tr>
                                            <td>{{ $project->project_name }}</td>
                                            <td>{{ $clientName }}</td>
                                            <td style="text-align: center;">
                                                <span class="status-badge {{ $badge['class'] }}">
                                                    <i class="{{ $badge['icon'] }}"></i>
                                                    {{ $projectDisplayStatus ?? '—' }}
                                                </span>
                                            </td>
                                            <td>{{ $leadName }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="color:#6b7280; padding:12px 0;">No active projects yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                    </div>

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Bill of Quantities (BOQ)</div>
                                <div class="dashboard-card-subtitle">Recent BOQ items from all projects</div>
                            </div>
                            <a class="view-link" href="{{ route('projects') }}">
                                View all
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Project</th>
                                    <th style="text-align: center;">Item Description</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Unit</th>
                                    <th style="text-align: center;">Material Cost</th>
                                    <th style="text-align: center;">Labor Cost</th>
                                    <th style="text-align: center;">Total</th>
                                    <th style="text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentProjectRecords as $record)
                                    @php
                                        $materialCost = $record->material_cost ?? ($record->unit_rate ?? 0);
                                        $laborCost = $record->labor_cost ?? 0;
                                        $unitTotal = $materialCost + $laborCost;
                                        $itemTotal = $unitTotal * ($record->quantity ?? 0);
                                    @endphp
                                    <tr>
                                        <td style="text-align: center;">
                                            @if ($record->project)
                                                <a href="{{ route('projects.show', $record->project->id) }}" style="color: var(--accent); text-decoration: none; font-weight: 500;">
                                                    {{ $record->project->project_name ?? $record->project->project_code }}
                                                </a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($record->project)
                                                <a href="{{ route('projects.show', $record->project->id) }}" style="color: #6b7280; text-decoration: none;">
                                                    {{ $record->item_description ?? $record->material_name ?? '—' }}
                                                </a>
                                            @else
                                                {{ $record->item_description ?? $record->material_name ?? '—' }}
                                            @endif
                                        </td>
                                        <td style="text-align: center;">{{ $record->quantity ?? '—' }}</td>
                                        <td style="text-align: center;">{{ $record->unit ?? '—' }}</td>
                                        <td style="text-align: center;">₱{{ number_format($materialCost, 2) }}</td>
                                        <td style="text-align: center;">₱{{ number_format($laborCost, 2) }}</td>
                                        <td style="text-align: center; font-weight: 600;">₱{{ number_format($itemTotal, 2) }}</td>
                                        <td style="text-align: center;">
                                            <span class="status-badge {{ strtolower($record->status) }}">
                                                {{ $record->status ?? '—' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="color:#6b7280; padding:12px 0;">No BOQ items available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Finance & Transactions Summary</div>
                                <div class="dashboard-card-subtitle">Project budgets and financial overview</div>
                            </div>
                            <a class="view-link" href="{{ route('finance-graphs') }}" title="View financial graphs">
                                <i class="fas fa-chart-bar"></i>
                            </a>
                        </div>

                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Project Name</th>
                                    <th style="text-align: center;">Project Budget</th>
                                    <th style="text-align: center;">Spent</th>
                                    <th style="text-align: center;">Remaining Budget</th>
                                    <th style="text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activeProjects as $project)
                                    @php
                                        $projectBudget = $project->allocated_amount ?? 0;
                                        // Calculate total spent from all materials in this project
                                        $totalSpent = 0;
                                        if ($project->materials && $project->materials->count() > 0) {
                                            foreach ($project->materials as $material) {
                                                $materialCost = $material->material_cost ?? 0;
                                                $laborCost = $material->labor_cost ?? 0;
                                                $quantity = $material->quantity ?? 0;
                                                $totalSpent += ($materialCost + $laborCost) * $quantity;
                                            }
                                        }
                                        $remainingBudget = $projectBudget - $totalSpent;
                                        
                                        // Determine status based on remaining budget
                                        if ($projectBudget == 0) {
                                            $budgetStatus = 'info';
                                            $statusText = 'No Budget';
                                        } elseif ($remainingBudget < 0) {
                                            $budgetStatus = 'fail';
                                            $statusText = 'Over Budget';
                                        } elseif ($remainingBudget < ($projectBudget * 0.2)) {
                                            $budgetStatus = 'warning';
                                            $statusText = 'Critical';
                                        } else {
                                            $budgetStatus = 'success';
                                            $statusText = 'Healthy';
                                        }
                                    @endphp
                                    <tr>
                                        <td style="text-align: center;">
                                            <a href="{{ route('projects.show', $project->id) }}" style="color: var(--accent); text-decoration: none; font-weight: 500;">
                                                {{ $project->project_name ?? $project->project_code }}
                                            </a>
                                        </td>
                                        <td style="text-align: center;">₱{{ number_format($projectBudget, 2) }}</td>
                                        <td style="text-align: center;">₱{{ number_format($totalSpent, 2) }}</td>
                                        <td style="text-align: center; font-weight: 600; white-space: nowrap;">₱{{ number_format($remainingBudget, 2) }}</td>
                                        <td style="text-align: center;">
                                            <span class="status-badge {{ $budgetStatus }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="color:#6b7280; padding:12px 0;">No active projects available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>

</html>