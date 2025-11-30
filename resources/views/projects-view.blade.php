<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* Timeline/Task Bar Styles */
        .updates-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
        }

        .updates-timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 40px;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #16a34a, #3b82f6, #9ca3af);
        }

        .timeline-item {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            position: relative;
            padding: 0;
        }

        .timeline-marker {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            z-index: 1;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 3px solid white;
        }

        .timeline-marker::after {
            content: '';
            width: 12px;
            height: 12px;
            background: white;
            border-radius: 50%;
        }

        .timeline-content {
            flex: 1;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 2px;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .timeline-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .timeline-description {
            font-size: 13px;
            color: #374151;
            margin: 8px 0;
            line-height: 1.5;
        }

        .timeline-meta {
            display: flex;
            gap: 20px;
            font-size: 12px;
            color: #6b7280;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
        }

        .timeline-date,
        .timeline-author {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .timeline-date i,
        .timeline-author i {
            color: var(--accent);
        }

        /* Modal Styles for Employee Assignment */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            align-items: center;
            justify-content: center;
        }
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }
        .modal-content {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: inherit;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-close:hover {
            color: #111827;
        }
        .info-banner {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            align-items: flex-start;
        }
        .info-banner-icon {
            color: #f59e0b;
            font-size: 20px;
            flex-shrink: 0;
        }
        .info-banner-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #92400e;
        }
        .info-banner-content p {
            font-size: 13px;
            color: #b45309;
            margin-top: 2px;
        }
        .employee-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 20px 0;
            max-height: 400px;
            overflow-y: auto;
        }
        .employee-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
            transition: all 0.2s ease;
        }
        .employee-item:hover {
            background: #f3f4f6;
        }
        .employee-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--accent);
        }
        .employee-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .employee-name {
            font-weight: 500;
            color: #111827;
        }
        .employee-code {
            font-size: 12px;
            color: #6b7280;
        }
        .employee-position {
            font-size: 12px;
            color: #6b7280;
        }
        .btn {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-outline {
            background: #f3f4f6;
            color: #374151;
        }
        .btn-outline:hover {
            background: #e5e7eb;
        }
        .btn-green {
            background: var(--accent);
            color: #ffffff;
        }
        .btn-green:hover {
            background: #15803d;
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
                        <div class="detail-label">Project Type</div>
                        <div class="detail-value">
                            @if($project->project_type)
                                <span style="background: @if($project->project_type === 'Plumbing Work') #dbeafe @else #fee2e2 @endif; color: @if($project->project_type === 'Plumbing Work') #0369a1 @else #991b1b @endif; padding: 4px 12px; border-radius: 20px; font-size: 13px;">
                                    {{ $project->project_type }}
                                </span>
                            @else
                                <span style="color: var(--gray-500);">Not specified</span>
                            @endif
                        </div>
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
                    <button class="tab-button" onclick="switchTab('updates')">Project Tasks</button>
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

                        <!-- Employees Summary Cards -->
                        <div style="margin-bottom: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
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
                        <div class="report-title">Add Project Task</div>
                        <form method="POST" action="{{ route('projects.updates.store', $project->id) }}" style="margin-bottom: 30px;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Task Title</label>
                                <input type="text" name="title" class="form-input" placeholder="Enter update title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-textarea" name="description" placeholder="Enter update details..." required style="min-height: 180px;"></textarea>
                                <small style="color: var(--gray-600); display: block; margin-top: 6px;">Max 5000 characters</small>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Task
                            </button>
                        </form>

                        <div class="report-title">Project Tasks</div>
                        <div class="updates-timeline">
                            @forelse($project->updates as $update)
                                <div class="timeline-item">
                                    <div class="timeline-marker" style="background-color: @if($update->status === 'Completed') #16a34a @else #3b82f6 @endif;"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h4 class="timeline-title">{{ $update->title }}</h4>
                                            <span class="timeline-status" style="background-color: @if($update->status === 'Completed') #dcfce7; color: #166534; @else #bfdbfe; color: #1e40af; @endif">
                                                @if($update->status === 'Completed')
                                                    <i class="fas fa-check-circle"></i> Complete
                                                @else
                                                    <i class="fas fa-hourglass-half"></i> Ongoing
                                                @endif
                                            </span>
                                        </div>
                                        <p class="timeline-description">{{ $update->description }}</p>
                                        <div class="timeline-meta">
                                            <span class="timeline-date"><i class="fas fa-calendar"></i> {{ $update->created_at->format('M d, Y') }} at {{ $update->created_at->format('H:i') }}</span>
                                            <span class="timeline-author"><i class="fas fa-user"></i> {{ $update->updatedBy?->name ?? 'Unknown' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="timeline-item">
                                    <div class="timeline-marker" style="background-color: #9ca3af;"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-header">
                                            <h4 class="timeline-title">Project Created</h4>
                                            <span class="timeline-status" style="background-color: #f3f4f6; color: #1f2937;">
                                                <i class="fas fa-calendar-plus"></i> Created
                                            </span>
                                        </div>
                                        <p class="timeline-description">Project has been successfully created and is ready for work.</p>
                                        <div class="timeline-meta">
                                            <span class="timeline-date"><i class="fas fa-calendar"></i> {{ $project->created_at->format('M d, Y') }} at {{ $project->created_at->format('H:i') }}</span>
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
                            <a href="{{ route('pdf.boq.download', $project->id) }}" class="btn btn-primary">
                                <i class="fas fa-list"></i> Download BOQ
                            </a>
                            <a href="{{ route('csv.project.download', $project->id) }}" class="btn btn-secondary">
                                <i class="fas fa-file-csv"></i> Download CSV Report
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Material Modal -->
        <div id="materialModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 600px;">
                <div class="modal-header">
                    <h2 class="modal-title" id="materialTitle">Add Material</h2>
                    <button class="modal-close" onclick="closeMaterialModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="materialForm" method="POST" action="{{ route('projects.materials.store', $project->id) }}">
                    @csrf
                    <input type="hidden" id="materialIdField" name="material_id" value="">
                    
                    <div style="padding: 20px;">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Item Description</label>
                            <input type="text" id="itemDescription" name="item_description" placeholder="Enter item description" required 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Quantity</label>
                                <input type="number" id="materialQuantity" name="quantity" placeholder="0" required 
                                    style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Unit</label>
                                <select id="materialUnit" name="unit" 
                                    style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                                    <option value="">-- Select Unit --</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                    <option value="set">Set</option>
                                    <option value="box">Box</option>
                                    <option value="pack">Pack</option>
                                    <option value="meter">Meter (m)</option>
                                    <option value="square_meter">Square Meter (m²)</option>
                                    <option value="cubic_meter">Cubic Meter (m³)</option>
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="liter">Liter (L)</option>
                                    <option value="gallon">Gallon (gal)</option>
                                    <option value="roll">Roll</option>
                                    <option value="sheet">Sheet</option>
                                    <option value="bag">Bag</option>
                                    <option value="bundle">Bundle</option>
                                    <option value="dozen">Dozen</option>
                                    <option value="unit">Unit</option>
                                </select>
                            </div>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Unit Rate (₱)</label>
                            <input type="number" id="materialUnitRate" name="unit_rate" placeholder="0.00" step="0.01" required 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Status</label>
                            <select id="materialStatus" name="status" 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Remarks</label>
                            <textarea id="materialRemarks" name="remarks" placeholder="Add any remarks" rows="3"
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px; font-family: Arial, sans-serif;"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid var(--gray-400); display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn" style="background: var(--gray-400); color: var(--black-1); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;" onclick="closeMaterialModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Save Material</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Employee Assignment Modal -->
        <div id="employeeModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Manage Employees - {{ $project->project_name }}</h2>
                    <button class="modal-close" onclick="closeEmployeeModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div id="modalWarning" class="info-banner" style="display: none; margin-bottom: 20px;">
                    <div class="info-banner-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="info-banner-content">
                        <h4 style="margin: 0;">Project Completed</h4>
                        <p style="margin: 0;">This project has been marked as completed. You can still reassign employees.</p>
                    </div>
                </div>

                <p style="color: #6b7280; margin-bottom: 16px;">
                    Select employees to assign to this project. Only employees not assigned to other active projects are available.
                </p>

                <div class="employee-list" id="employeeList">
                    <!-- Populated by JavaScript -->
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                    <button class="btn btn-outline" onclick="closeEmployeeModal()">Cancel</button>
                    <button class="btn btn-green" onclick="saveEmployeeAssignments()">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
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

        // Employee Management Variables
        let currentProjectId = {{ $project->id }};
        let currentProjectStatus = '{{ $project->status }}';
        let allEmployees = {!! json_encode($allEmployees ?? []) !!};
        let projectEmployees = {!! json_encode($projectEmployees ?? []) !!};

        function openEmployeeModal() {
            const modal = document.getElementById('employeeModal');
            if (!modal) {
                console.error('Employee modal not found');
                return;
            }

            // Show warning if project is completed
            if (currentProjectStatus.toLowerCase() === 'completed') {
                document.getElementById('modalWarning').style.display = 'flex';
            } else {
                document.getElementById('modalWarning').style.display = 'none';
            }

            loadEmployeesForModal(currentProjectId);
            modal.classList.add('active');
        }

        function closeEmployeeModal() {
            const modal = document.getElementById('employeeModal');
            if (modal) {
                modal.classList.remove('active');
            }
        }

        function loadEmployeesForModal(projectId) {
            const employeeList = document.getElementById('employeeList');
            const assignedEmployeeIds = projectEmployees[projectId] || [];

            employeeList.innerHTML = '';

            allEmployees.forEach(employee => {
                const isAssigned = assignedEmployeeIds.includes(employee.id);
                const isAssignedToOtherProject = employee.assigned_to_other_project && !isAssigned;

                const employeeItem = document.createElement('div');
                employeeItem.className = 'employee-item';
                employeeItem.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 12px; flex: 1;">
                        <input 
                            type="checkbox" 
                            value="${employee.id}"
                            ${isAssigned ? 'checked' : ''}
                            ${isAssignedToOtherProject ? 'disabled' : ''}
                            class="employee-checkbox"
                        >
                        <div class="employee-info">
                            <div class="employee-name">${employee.f_name} ${employee.l_name}</div>
                            <div class="employee-code">EMP${String(employee.id).padStart(3, '0')}</div>
                            <div class="employee-position">${employee.position || 'No Position'}</div>
                            ${isAssignedToOtherProject ? '<div style="color: #dc2626; font-size: 11px; font-weight: 600;">Assigned to other active project</div>' : ''}
                        </div>
                    </div>
                `;
                employeeList.appendChild(employeeItem);
            });
        }

        function saveEmployeeAssignments() {
            const checkboxes = document.querySelectorAll('.employee-checkbox:not(:disabled)');
            const selectedEmployeeIds = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => parseInt(cb.value));

            if (selectedEmployeeIds.length === 0) {
                alert('Please select at least one employee to assign.');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            if (!csrfToken) {
                alert('CSRF token not found. Please refresh the page and try again.');
                console.error('CSRF token missing');
                return;
            }

            fetch(`/api/projects/${currentProjectId}/employees`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    employee_ids: selectedEmployeeIds
                })
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        console.error('Non-JSON response received:', text);
                        throw new Error('Server returned non-JSON response. Status: ' + response.status);
                    });
                }
                
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || `HTTP error! status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Employees assigned successfully!');
                    closeEmployeeModal();
                    location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Failed to assign employees'));
                }
            })
            .catch(error => {
                console.error('Full error:', error);
                alert('An error occurred: ' + error.message);
            });
        }

        function openMaterialModal() {
            const modal = document.getElementById('materialModal');
            const form = document.getElementById('materialForm');
            document.getElementById('materialTitle').textContent = 'Add Material';
            
            // Reset form
            if (form) form.reset();
            
            // Clear hidden ID field
            const materialIdField = document.getElementById('materialIdField');
            if (materialIdField) materialIdField.value = '';
            
            // Update form action
            form.action = `/projects/{{ $project->id }}/materials`;
            form.method = 'POST';
            
            if (modal) {
                modal.style.display = 'flex';
            }
        }

        function closeMaterialModal() {
            const modal = document.getElementById('materialModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function editMaterial(materialId) {
            const modal = document.getElementById('materialModal');
            const form = document.getElementById('materialForm');
            document.getElementById('materialTitle').textContent = 'Edit Material';
            
            // Fetch material data
            fetch(`/projects/{{ $project->id }}/materials/${materialId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('itemDescription').value = data.item_description || '';
                    document.getElementById('materialQuantity').value = data.quantity || '';
                    document.getElementById('materialUnit').value = data.unit || '';
                    document.getElementById('materialUnitRate').value = data.unit_rate || '';
                    document.getElementById('materialStatus').value = data.status || 'pending';
                    document.getElementById('materialRemarks').value = data.remarks || '';
                    document.getElementById('materialIdField').value = materialId;
                    
                    // Update form action and method
                    form.action = `/projects/{{ $project->id }}/materials/${materialId}`;
                    form.method = 'POST';
                    
                    // Add hidden method field for PUT
                    let methodField = form.querySelector('input[name="_method"]');
                    if (!methodField) {
                        methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        form.appendChild(methodField);
                    }
                    methodField.value = 'PUT';
                    
                    if (modal) {
                        modal.style.display = 'flex';
                    }
                })
                .catch(error => {
                    console.error('Error fetching material:', error);
                    alert('Error loading material data');
                });
        }

        function saveMaterial() {
            const form = document.getElementById('materialForm');
            form.submit();
        }

        function filterMaterials(status) {
            const rows = document.querySelectorAll('.material-row');
            const buttons = document.querySelectorAll('.filter-btn');
            
            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.filter === status) {
                    btn.classList.add('active');
                    btn.style.background = 'var(--accent)';
                    btn.style.color = 'white';
                    btn.style.borderColor = 'var(--accent)';
                } else {
                    btn.style.background = 'white';
                    btn.style.color = 'inherit';
                    btn.style.borderColor = 'var(--gray-400)';
                }
            });
            
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
