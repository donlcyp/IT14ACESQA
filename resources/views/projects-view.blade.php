<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Project Details - AJJ CRISBER Engineering Services</title>
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

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }
        .main-content.sidebar-closed {
            margin-left: 0;
        }
        @media (min-width: 769px) {
            .main-content {
                margin-left: 280px;
            }
        }
        @media (max-width: 768px) {
            .main-content {
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

        .header-menu {
            display: none;
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 24px;
        }

        @media (max-width: 768px) {
            .header-menu {
                display: block;
            }
        }

        .header-title {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            flex: 1;
        }

        .back-button-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--accent);
            border: none;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 14px;
        }

        .back-button-nav:hover {
            background: #15803d;
        }

        .projects-header {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .projects-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .projects-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--black-1);
        }

        .projects-actions {
            display: flex;
            gap: 10px;
        }

        .detail-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid var(--accent);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .detail-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 16px;
            color: var(--black-1);
            font-weight: 500;
        }

        .tabs {
            display: flex;
            gap: 0;
            border-bottom: 2px solid var(--gray-400);
            margin-bottom: 0;
            overflow-x: auto;
            background: white;
            padding: 0;
            border-radius: 8px 8px 0 0;
        }

        .tab-button {
            padding: 12px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: var(--gray-600);
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .tab-button.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .updates-list {
            space-y: 20px;
        }

        .update-item {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid var(--gray-300);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
            position: relative;
        }

        .update-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .update-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, var(--accent), #15803d);
            border-radius: 12px 0 0 12px;
        }

        .update-date {
            font-size: 11px;
            color: var(--gray-600);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .update-title {
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 12px;
            font-size: 18px;
            line-height: 1.4;
        }

        .update-description {
            color: var(--gray-700);
            line-height: 1.8;
            margin-bottom: 16px;
            font-size: 15px;
        }

        .update-footer {
            display: flex;
            gap: 20px;
            padding-top: 12px;
            border-top: 1px solid var(--gray-300);
            font-size: 13px;
            color: var(--gray-600);
        }

        .update-footer strong {
            color: var(--black-1);
            font-weight: 600;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .image-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .image-card:hover {
            transform: translateY(-2px);
        }

        .image-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--sidebar-bg);
        }

        .image-info {
            padding: 12px;
            border-top: 1px solid var(--gray-400);
        }

        .image-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--black-1);
            word-break: break-word;
        }

        .image-date {
            font-size: 11px;
            color: var(--gray-600);
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--black-1);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--gray-400);
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: #15803d;
        }

        .btn-secondary {
            background: var(--gray-400);
            color: var(--black-1);
        }

        .btn-secondary:hover {
            background: var(--gray-300);
        }

        .report-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .report-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 15px;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-item {
            background: linear-gradient(135deg, var(--accent), #15803d);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
        }

        .stat-label {
            font-size: 12px;
            opacity: 0.9;
        }

        .project-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid var(--gray-400);
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
            color: #1f2937;
            font-size: 14px;
        }

        .filter-btn.active {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .filter-btn:hover {
            border-color: var(--accent);
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <main class="main-content" id="mainContent" style="margin-left: 0; width: 100%;">
            <header class="header">
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <!-- Back Button -->
                <a href="{{ route('projects') }}" class="back-button-nav">
                    <i class="fas fa-arrow-left"></i>
                    Back to Projects
                </a>

                <!-- Breadcrumb -->
                <nav style="margin-bottom: 20px; font-size: 14px; color: var(--gray-600);">
                    <a href="{{ route('dashboard') }}" style="color: var(--accent); text-decoration: none;">Dashboard</a>
                    <span style="margin: 0 8px;">></span>
                    <a href="{{ route('projects') }}" style="color: var(--accent); text-decoration: none;">Projects</a>
                    <span style="margin: 0 8px;">></span>
                    <span style="color: var(--gray-700);">Project Details</span>
                </nav>

                <!-- Project Header -->
                <div class="projects-header">
                    <div class="projects-content">
                        <div>
                            <div class="projects-title">{{ $project->project_name ?? $project->project_code }}</div>
                            <div style="font-size: 14px; color: var(--gray-600); margin-top: 5px;">Project ID: {{ $project->project_code }}</div>
                        </div>
                    </div>
                </div>

                <!-- Project Details -->
                <div class="project-details">
                    <div class="detail-card">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span style="background: #dbeafe; color: #0369a1; padding: 4px 12px; border-radius: 20px; font-size: 13px;">
                                {{ $project->status }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Client</div>
                        <div class="detail-value">
                            {{ $project->client?->company_name ?? trim($project->client_first_name . ' ' . $project->client_last_name) }}
                        </div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Project Manager</div>
                        <div class="detail-value">{{ $project->assignedPM?->name ?? 'Unassigned' }}</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Location</div>
                        <div class="detail-value">{{ $project->location ?? 'Not specified' }}</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Industry</div>
                        <div class="detail-value">{{ $project->industry ?? 'Not specified' }}</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Budget</div>
                        <div class="detail-value">₱{{ number_format($project->allocated_amount, 2) }}</div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab-button active" onclick="switchTab('overview')">Overview</button>
                    <button class="tab-button" onclick="switchTab('employees')">Employees</button>
                    <button class="tab-button" onclick="switchTab('materials')">Materials</button>
                    <button class="tab-button" onclick="switchTab('updates')">Project Updates</button>
                    <button class="tab-button" onclick="switchTab('images')">Documentation</button>
                    <button class="tab-button" onclick="switchTab('report')">Reports</button>
                </div>

                <!-- Overview Tab -->
                <div id="overview" class="tab-content active">
                    <div class="report-section">
                        <div class="report-title">Project Information</div>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                            <div>
                                <div class="detail-label">Description</div>
                                <div class="detail-value" style="font-size: 14px; color: var(--gray-700); font-weight: normal;">
                                    {{ $project->description ?? 'No description provided' }}
                                </div>
                            </div>
                            <div>
                                <div class="detail-label">Target Timeline</div>
                                <div class="detail-value">
                                    {{ $project->target_timeline ? $project->target_timeline->format('M d, Y') : 'Not set' }}
                                </div>
                            </div>
                            <div>
                                <div class="detail-label">Created On</div>
                                <div class="detail-value">
                                    {{ $project->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="report-section">
                        <div class="report-title">Project Team</div>
                        @if ($project->employees && $project->employees->count() > 0)
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Employee</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Position</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Role Title</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Assigned From</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Assigned To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->employees as $employee)
                                            <tr style="border-bottom: 1px solid var(--gray-400);">
                                                <td style="padding: 12px; color: var(--black-1);">{{ $employee->full_name ?? ($employee->f_name . ' ' . $employee->l_name) }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->position ?? 'N/A' }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->pivot->role_title ?? '—' }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->pivot->assigned_from ? \Carbon\Carbon::parse($employee->pivot->assigned_from)->format('M d, Y') : '—' }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->pivot->assigned_to ? \Carbon\Carbon::parse($employee->pivot->assigned_to)->format('M d, Y') : '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                <i class="fas fa-users" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>No employees assigned to this project yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Employees Tab -->
                <div id="employees" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Project Employees</div>
                        <div style="display: flex; gap: 12px; margin-bottom: 20px;">
                            <button class="btn btn-primary" onclick="openEmployeeModal()">
                                <i class="fas fa-plus"></i> Add Employee
                            </button>
                        </div>

                        @if ($project->employees && $project->employees->count() > 0)
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Employee</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Position</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Role Title</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Assigned From</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Assigned To</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Days Worked</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Daily Rate</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Labor Cost</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($project->employees as $employee)
                                            @php
                                                // Calculate days worked and labor cost based on attendance
                                                $attendanceRecords = \App\Models\EmployeeAttendance::where('employee_id', $employee->id)
                                                    ->whereBetween('date', [
                                                        $employee->pivot->assigned_from ?? $project->created_at,
                                                        $employee->pivot->assigned_to ?? now()
                                                    ])
                                                    ->where('attendance_status', 'Present')
                                                    ->count();
                                                
                                                // Get daily rate from salary (assuming it's stored as monthly salary)
                                                $monthlySalary = $employee->pivot->salary ?? 0;
                                                $dailyRate = $monthlySalary > 0 ? round($monthlySalary / 22, 2) : 0; // Assuming 22 working days per month
                                                $laborCost = $attendanceRecords * $dailyRate;
                                            @endphp
                                            <tr style="border-bottom: 1px solid var(--gray-400);">
                                                <td style="padding: 12px; color: var(--black-1);">{{ $employee->full_name ?? ($employee->f_name . ' ' . $employee->l_name) }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->position ?? 'N/A' }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->pivot->role_title ?? '—' }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->pivot->assigned_from ? \Carbon\Carbon::parse($employee->pivot->assigned_from)->format('M d, Y') : '—' }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->pivot->assigned_to ? \Carbon\Carbon::parse($employee->pivot->assigned_to)->format('M d, Y') : '—' }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">{{ $attendanceRecords }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($dailyRate, 2) }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600; background: #f0f9ff; border-radius: 4px;">₱{{ number_format($laborCost, 2) }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">
                                                    <form method="POST" action="{{ route('projects.employees.remove', [$project->id, $employee->id]) }}" style="display: inline;" onsubmit="return confirm('Remove this employee?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Employees Summary -->
                            <div style="margin-top: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                                <div style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); padding: 15px; border-radius: 8px;">
                                    <div style="font-size: 12px; color: #0369a1; opacity: 0.8;">Total Employees</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #0369a1;">
                                        {{ $project->employees->count() }}
                                    </div>
                                </div>
                                <div style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); padding: 15px; border-radius: 8px;">
                                    <div style="font-size: 12px; color: #059669; opacity: 0.8;">Total Days Worked</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #059669;">
                                        @php
                                            $totalDaysWorked = 0;
                                            foreach($project->employees as $emp) {
                                                $totalDaysWorked += \App\Models\EmployeeAttendance::where('employee_id', $emp->id)
                                                    ->whereBetween('date', [
                                                        $emp->pivot->assigned_from ?? $project->created_at,
                                                        $emp->pivot->assigned_to ?? now()
                                                    ])
                                                    ->where('attendance_status', 'Present')
                                                    ->count();
                                            }
                                            echo $totalDaysWorked;
                                        @endphp
                                    </div>
                                </div>
                                <div style="background: linear-gradient(135deg, #fce7f3, #fbcfe8); padding: 15px; border-radius: 8px;">
                                    <div style="font-size: 12px; color: #be185d; opacity: 0.8;">Total Labor Cost</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #be185d;">
                                        ₱@php
                                            $totalLaborCost = 0;
                                            foreach($project->employees as $emp) {
                                                $empDays = \App\Models\EmployeeAttendance::where('employee_id', $emp->id)
                                                    ->whereBetween('date', [
                                                        $emp->pivot->assigned_from ?? $project->created_at,
                                                        $emp->pivot->assigned_to ?? now()
                                                    ])
                                                    ->where('attendance_status', 'Present')
                                                    ->count();
                                                $monthlySalary = $emp->pivot->salary ?? 0;
                                                $dailyRate = $monthlySalary > 0 ? round($monthlySalary / 22, 2) : 0;
                                                $totalLaborCost += $empDays * $dailyRate;
                                            }
                                            echo number_format($totalLaborCost, 2);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        @else
                            <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                <i class="fas fa-users" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>No employees assigned to this project yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Materials Tab -->
                <div id="materials" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Project Materials</div>
                        <div style="display: flex; gap: 12px; margin-bottom: 20px;">
                            <button class="btn btn-primary" onclick="openMaterialModal()">
                                <i class="fas fa-plus"></i> Add Material
                            </button>
                        </div>

                        <!-- Material Status Filter -->
                        <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                            <button onclick="filterMaterials('all')" class="filter-btn active" data-filter="all" style="padding: 8px 16px; border: 1px solid var(--gray-400); background: white; border-radius: 6px; cursor: pointer; transition: all 0.2s ease;">
                                All Materials
                            </button>
                            <button onclick="filterMaterials('pending')" class="filter-btn" data-filter="pending" style="padding: 8px 16px; border: 1px solid var(--gray-400); background: white; border-radius: 6px; cursor: pointer; transition: all 0.2s ease;">
                                Pending
                            </button>
                            <button onclick="filterMaterials('approved')" class="filter-btn" data-filter="approved" style="padding: 8px 16px; border: 1px solid var(--gray-400); background: white; border-radius: 6px; cursor: pointer; transition: all 0.2s ease;">
                                Approved
                            </button>
                            <button onclick="filterMaterials('failed')" class="filter-btn" data-filter="failed" style="padding: 8px 16px; border: 1px solid var(--gray-400); background: white; border-radius: 6px; cursor: pointer; transition: all 0.2s ease;">
                                Failed
                            </button>
                        </div>

                        @if ($project->materials && $project->materials->count() > 0)
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Item Description</th>
                                            <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1);">Qty</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Unit</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Unit Rate</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Total</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Status</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="materialsTableBody">
                                        @foreach ($project->materials as $material)
                                            <tr class="material-row" data-status="{{ $material->status ?? 'pending' }}" style="border-bottom: 1px solid var(--gray-400);">
                                                <td style="padding: 12px; color: var(--black-1);">{{ $material->item_description ?? '—' }}</td>
                                                <td style="padding: 12px; text-align: center; color: var(--gray-700);">{{ $material->quantity ?? 0 }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $material->unit ?? '—' }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($material->unit_rate ?? 0, 2) }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">₱{{ number_format(($material->quantity ?? 0) * ($material->unit_rate ?? 0), 2) }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">
                                                    @php
                                                        $statusColor = match($material->status ?? 'pending') {
                                                            'approved' => '#dcfce7',
                                                            'failed' => '#fee2e2',
                                                            'pending' => '#fef3c7',
                                                            default => '#f3f4f6'
                                                        };
                                                        $statusTextColor = match($material->status ?? 'pending') {
                                                            'approved' => '#166534',
                                                            'failed' => '#991b1b',
                                                            'pending' => '#92400e',
                                                            default => '#374151'
                                                        };
                                                    @endphp
                                                    <span style="padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; background-color: {{ $statusColor }}; color: {{ $statusTextColor }};">
                                                        {{ ucfirst($material->status ?? 'Pending') }}
                                                    </span>
                                                </td>
                                                <td style="padding: 12px; color: var(--gray-700);">
                                                    <div style="display: flex; gap: 6px;">
                                                        <button class="btn" style="background: #dbeafe; color: #0369a1; padding: 6px 12px; font-size: 12px;" onclick="editMaterial({{ $material->id }})">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form method="POST" action="{{ route('projects.materials.delete', [$project->id, $material->id]) }}" style="display: inline;" onsubmit="return confirm('Delete this material?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn" style="background: #fee2e2; color: #991b1b; padding: 6px 12px; font-size: 12px;">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Materials Summary -->
                            <div style="margin-top: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                                <div style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); padding: 15px; border-radius: 8px;">
                                    <div style="font-size: 12px; color: #166534; opacity: 0.8;">Approved Materials</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #166534;">
                                        ₱{{ number_format($project->materials->where('status', 'approved')->sum(fn($m) => $m->quantity * $m->unit_rate), 2) }}
                                    </div>
                                </div>
                                <div style="background: linear-gradient(135deg, #fef3c7, #fde047); padding: 15px; border-radius: 8px;">
                                    <div style="font-size: 12px; color: #92400e; opacity: 0.8;">Pending Materials</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #92400e;">
                                        ₱{{ number_format($project->materials->where('status', 'pending')->sum(fn($m) => $m->quantity * $m->unit_rate), 2) }}
                                    </div>
                                </div>
                                <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); padding: 15px; border-radius: 8px;">
                                    <div style="font-size: 12px; color: #991b1b; opacity: 0.8;">Failed Materials</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #991b1b;">
                                        ₱{{ number_format($project->materials->where('status', 'failed')->sum(fn($m) => $m->quantity * $m->unit_rate), 2) }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                <i class="fas fa-box" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>No materials added to this project yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Updates Tab -->
                <div id="updates" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Add Project Update</div>
                        <form method="POST" action="{{ route('projects.updates.store', $project->id) }}" style="margin-bottom: 30px;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Update Title</label>
                                <input type="text" name="title" class="form-input" placeholder="Enter update title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-textarea" name="description" placeholder="Enter update details..." required style="min-height: 180px;"></textarea>
                                <small style="color: var(--gray-600); display: block; margin-top: 6px;">Max 5000 characters</small>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Update
                            </button>
                        </form>

                        <div class="report-title">Recent Updates</div>
                        <div class="updates-list">
                            @forelse($project->updates as $update)
                                <div class="update-item">
                                    <div class="update-date">{{ $update->created_at->format('M d, Y H:i') }}</div>
                                    <div class="update-title">{{ $update->title }}</div>
                                    <div class="update-description">{{ $update->description }}</div>
                                    <div class="update-footer">
                                        <div>
                                            <strong>Status:</strong>
                                            <span style="padding: 4px 10px; border-radius: 6px; margin-left: 6px; font-weight: 600;
                                                @if($update->status === 'Completed') background-color: #dcfce7; color: #166534;
                                                @else background-color: #bfdbfe; color: #1e40af;
                                                @endif
                                            ">{{ $update->status === 'Completed' ? 'Complete' : 'Ongoing' }}</span>
                                        </div>
                                        <div>
                                            <strong>By:</strong> {{ $update->updatedBy?->name ?? 'Unknown' }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="update-item">
                                    <div class="update-date">{{ $project->created_at->format('M d, Y H:i') }}</div>
                                    <div class="update-title">Project Created</div>
                                    <div class="update-description">Project has been successfully created and is ready for work.</div>
                                    <div class="update-footer">
                                        <div>
                                            <strong>Status:</strong>
                                            <span style="padding: 4px 10px; border-radius: 6px; margin-left: 6px; font-weight: 600; background-color: #f3f4f6; color: #1f2937;">Created</span>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Images Tab -->
                <div id="images" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Upload Documentation Images</div>
                        <form method="POST" action="{{ route('projects.documents.store', $project->id) }}" enctype="multipart/form-data" style="margin-bottom: 30px;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Image Title</label>
                                <input type="text" name="title" class="form-input" placeholder="Enter image title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Upload Image</label>
                                <div style="padding: 10px 12px; border: 2px dashed var(--gray-400); border-radius: 6px;">
                                    <input type="file" name="image" style="width: 100%;" accept="image/*" required>
                                </div>
                                <small style="color: var(--gray-600); display: block; margin-top: 8px;">
                                    Accepted formats: JPEG, PNG, JPG, GIF, WebP (Max 5MB)
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">
                                <i class="fas fa-cloud-upload-alt"></i> Upload Image
                            </button>
                        </form>

                        <div class="report-title">Upload Documentation Files</div>
                        <form method="POST" action="{{ route('projects.documents.store', $project->id) }}" enctype="multipart/form-data" style="margin-bottom: 30px;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Attachments (Optional)</label>
                                <div style="padding: 12px; border: 2px dashed var(--gray-400); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" id="dropZone">
                                    <input type="file" name="attachments[]" id="attachmentInput" style="width: 100%; cursor: pointer;" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif,.zip">
                                    <small style="color: var(--gray-600); display: block; margin-top: 8px;">
                                        <i class="fas fa-cloud-upload-alt"></i> Drag files here or click to upload<br>
                                        Accepted: PDF, DOC, DOCX, XLS, XLSX, Images, ZIP (Max 50MB total)
                                    </small>
                                </div>
                                <div id="attachmentPreview" style="margin-top: 12px;"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Files
                            </button>
                        </form>

                        <div class="report-title">Documentation Gallery</div>
                        @if($project->documents && $project->documents->count() > 0)
                            <div class="images-grid">
                                @foreach($project->documents as $doc)
                                    <div class="image-card">
                                        <div style="height: 200px; background: var(--gray-200); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; border-radius: 6px 6px 0 0;">
                                            <img src="{{ asset('storage/' . $doc->file_path) }}" alt="{{ $doc->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            <div style="position: absolute; top: 8px; right: 8px; display: flex; gap: 6px;">
                                                <button onclick="viewImage('{{ asset('storage/' . $doc->file_path) }}', '{{ $doc->title }}')" style="background: rgba(255,255,255,0.9); border: none; border-radius: 4px; padding: 6px 10px; cursor: pointer; color: #16a34a; font-size: 14px;">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <form method="POST" action="{{ route('projects.documents.delete', [$project->id, $doc->id]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background: rgba(255,255,255,0.9); border: none; border-radius: 4px; padding: 6px 10px; cursor: pointer; color: #dc2626; font-size: 14px;">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="image-info">
                                            <div class="image-name">{{ $doc->title }}</div>
                                            <div class="image-date">{{ $doc->created_at->format('M d, Y H:i') }}</div>
                                            <div style="font-size: 12px; color: var(--gray-600);">By {{ $doc->uploader?->name ?? 'Unknown' }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="images-grid">
                                <div class="image-card">
                                    <div style="height: 200px; background: linear-gradient(135deg, var(--accent), #15803d); display: flex; align-items: center; justify-content: center; color: white; border-radius: 6px 6px 0 0;">
                                        <i class="fas fa-image fa-3x" style="opacity: 0.3;"></i>
                                    </div>
                                    <div class="image-info">
                                        <div class="image-name">Documentation Gallery</div>
                                        <div class="image-date">No images uploaded yet</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reports Tab -->
                <div id="report" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Project Summary Report</div>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-value">{{ $project->employees->count() }}</div>
                                <div class="stat-label">Assigned Employees</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $project->purchaseOrders->count() ?? 0 }}</div>
                                <div class="stat-label">Purchase Orders</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">₱{{ number_format($project->used_amount ?? 0, 2) }}</div>
                                <div class="stat-label">Amount Used</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $project->allocated_amount > 0 ? round((($project->used_amount ?? 0) / $project->allocated_amount) * 100, 2) : 0 }}%</div>
                                <div class="stat-label">Budget Utilized</div>
                            </div>
                        </div>
                    </div>

                    <div class="report-section">
                        <div class="report-title">Project Timeline</div>
                        <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px;">
                            <p style="margin-bottom: 10px;"><strong>Start Date:</strong> {{ $project->date_started?->format('M d, Y') ?? 'Not set' }}</p>
                            <p style="margin-bottom: 10px;"><strong>End Date:</strong> {{ $project->date_ended?->format('M d, Y') ?? 'Not set' }}</p>
                            <p style="margin-bottom: 10px;"><strong>Target Timeline:</strong> {{ $project->target_timeline?->format('M d, Y') ?? 'Not set' }}</p>
                            <p><strong>Created:</strong> {{ $project->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="report-section">
                        <div class="report-title">Download Report</div>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <a href="{{ route('pdf.project.download', $project->id) }}" class="btn btn-primary">
                                <i class="fas fa-file-pdf"></i> Download PDF Report
                            </a>
                            <a href="{{ route('csv.project.download', $project->id) }}" class="btn btn-secondary">
                                <i class="fas fa-file-csv"></i> Download CSV Report
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        function viewImage(imageSrc, imageTitle) {
            // Create modal
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                animation: fadeIn 0.2s ease-in;
            `;

            const container = document.createElement('div');
            container.style.cssText = `
                position: relative;
                max-width: 90vw;
                max-height: 90vh;
                background: white;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            `;

            const img = document.createElement('img');
            img.src = imageSrc;
            img.alt = imageTitle;
            img.style.cssText = `
                width: 100%;
                height: 100%;
                object-fit: contain;
                max-height: 85vh;
            `;

            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '<i class="fas fa-times"></i>';
            closeBtn.style.cssText = `
                position: absolute;
                top: 15px;
                right: 15px;
                background: rgba(255, 255, 255, 0.95);
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                color: #333;
                transition: all 0.2s;
            `;

            closeBtn.onmouseover = () => closeBtn.style.background = 'white';
            closeBtn.onmouseout = () => closeBtn.style.background = 'rgba(255, 255, 255, 0.95)';

            const title = document.createElement('div');
            title.innerHTML = imageTitle;
            title.style.cssText = `
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
                color: white;
                padding: 20px 15px 15px;
                font-weight: 500;
                font-size: 16px;
            `;

            const closeModal = () => {
                modal.style.animation = 'fadeOut 0.2s ease-out';
                setTimeout(() => modal.remove(), 200);
            };

            closeBtn.onclick = closeModal;
            modal.onclick = (e) => {
                if (e.target === modal) closeModal();
            };

            container.appendChild(img);
            container.appendChild(closeBtn);
            container.appendChild(title);
            modal.appendChild(container);
            document.body.appendChild(modal);

            // Add animation styles
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                @keyframes fadeOut {
                    from { opacity: 1; }
                    to { opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }

        // File upload preview
        const dropZone = document.getElementById('dropZone');
        const attachmentInput = document.getElementById('attachmentInput');
        const attachmentPreview = document.getElementById('attachmentPreview');

        if (dropZone && attachmentInput) {
            dropZone.addEventListener('click', () => attachmentInput.click());

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.style.borderColor = '#16a34a';
                    dropZone.style.backgroundColor = 'rgba(22, 163, 74, 0.05)';
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.style.borderColor = 'var(--gray-400)';
                    dropZone.style.backgroundColor = 'transparent';
                });
            });

            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                attachmentInput.files = files;
                updatePreview();
            });

            attachmentInput.addEventListener('change', updatePreview);

            function updatePreview() {
                attachmentPreview.innerHTML = '';
                const files = attachmentInput.files;

                if (files.length === 0) return;

                const fileList = document.createElement('div');
                fileList.style.cssText = 'display: grid; gap: 8px;';

                Array.from(files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.style.cssText = `
                        padding: 10px 12px;
                        background: #f3f4f6;
                        border-radius: 6px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        font-size: 13px;
                    `;

                    const fileName = document.createElement('span');
                    fileName.innerHTML = `<i class="fas fa-file"></i> ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                    fileName.style.cssText = 'color: #1f2937; font-weight: 500;';

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.style.cssText = `
                        background: none;
                        border: none;
                        color: #dc2626;
                        cursor: pointer;
                        padding: 0;
                        font-size: 16px;
                    `;

                    removeBtn.onclick = (e) => {
                        e.preventDefault();
                        const dt = new DataTransfer();
                        Array.from(attachmentInput.files).forEach((f, i) => {
                            if (i !== index) dt.items.add(f);
                        });
                        attachmentInput.files = dt.files;
                        updatePreview();
                    };

                    fileItem.appendChild(fileName);
                    fileItem.appendChild(removeBtn);
                    fileList.appendChild(fileItem);
                });

                attachmentPreview.appendChild(fileList);
            }
        }

        // Filter materials by status
        function filterMaterials(status) {
            const rows = document.querySelectorAll('.material-row');
            const buttons = document.querySelectorAll('.filter-btn');

            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            document.querySelector(`[data-filter="${status}"]`).classList.add('active');
            document.querySelector(`[data-filter="${status}"]`).style.background = 'var(--accent)';
            document.querySelector(`[data-filter="${status}"]`).style.color = 'white';

            // Filter rows
            rows.forEach(row => {
                if (status === 'all' || row.getAttribute('data-status') === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Reset other buttons
            buttons.forEach(btn => {
                if (!btn.classList.contains('active')) {
                    btn.style.background = 'white';
                    btn.style.color = '#1f2937';
                }
            });
        }

        // Modal functions for employees and materials
        function openEmployeeModal() {
            // This would open a modal to add employee
            alert('Employee management feature - will be implemented');
        }

        function openMaterialModal() {
            // This would open a modal to add material
            alert('Material management feature - will be implemented');
        }

        function editMaterial(materialId) {
            // This would open a modal to edit material
            alert('Edit material feature - Material ID: ' + materialId);
        }
    </script>
</body>

</html>
