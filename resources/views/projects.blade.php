<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Projects</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
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
            --green-600: #1e40af;

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
            font-family: 'Inter', sans-serif;
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
            background: linear-gradient(135deg, var(--header-bg), #1e40af);
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
            padding: 40px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
        }

        /* Projects Header */
        .projects-header {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 28px;
            padding: 28px;
            border: 1px solid #e5e7eb;
        }

        .projects-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .projects-title {
            color: #101828;
            font-family: var(--text-lg-medium-font-family);
            font-size: var(--text-lg-medium-font-size);
            font-weight: var(--text-lg-medium-font-weight);
            line-height: var(--text-lg-medium-line-height);
        }

        .projects-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .projects-button {
            background: none;
            border: none;
            cursor: pointer;
        }

        /* Action button container */
        .projects-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .projects-button-base {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            font-size: 13px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 500;
        }
        
        .projects-button-base:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            border-color: #d1d5db;
        }
        
        .projects-button-base:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        /* Make action buttons inside table more compact */
        .projects-table .projects-button-base {
            padding: 6px 10px;
            font-size: 11px;
            gap: 4px;
        }
        .projects-table .projects-button-base i {
            font-size: 12px;
            line-height: 1;
        }

        .projects-button-base.primary {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
        }

        .projects-button-base.primary:hover {
            background: #1e3a8a;
            box-shadow: 0 6px 16px rgba(30, 64, 175, 0.3);
            transform: translateY(-2px);
        }
        
        .projects-button-base.primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.25);
        }

        /* Projects Table */
        .projects-table-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: box-shadow 0.3s ease;
        }
        
        .projects-table-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .projects-table {
            width: 100%;
            border-collapse: collapse;
        }

        .projects-table thead th {
            background: #f8fafc;
            color: #374151;
            font-weight: 700;
            padding: 16px 12px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 13px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .projects-table thead th:last-child {
            text-align: center;
        }

        .projects-table tbody td {
            padding: 16px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #374151;
        }

        .projects-table tbody td:last-child {
            text-align: center;
        }

        .projects-table tbody tr {
            transition: background-color 0.2s ease;
        }
        
        .projects-table tbody tr:hover {
            background: #f9fafb;
        }

        .projects-table tbody tr:last-child td {
            border-bottom: none;
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

        .status-badge.danger {
            background-color: transparent;
            color: #991b1b;
        }

        /* Modal Styles */
        .projects-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.2s ease;
            visibility: hidden;
            padding: 16px;
        }

        .projects-modal.active {
            display: flex !important;
            opacity: 1 !important;
            z-index: 2000 !important;
            visibility: visible !important;
        }

        .projects-modal-content {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            padding: 28px;
            position: relative;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            max-height: 90vh;
            overflow-y: auto;
            overflow-x: auto;
            animation: slideUp 0.3s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .projects-form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .projects-form-full {
            grid-column: 1 / -1;
        }

        /* Landscape orientation support */
        @media (min-width: 800px) and (min-height: 600px) {
            .projects-modal-content {
                max-width: 900px;
            }

            .projects-form-grid {
                grid-template-columns: 1fr 1fr;
            }

            .projects-form-full {
                grid-column: 1 / -1;
            }
        }

        /* Ensure modals fit within the viewport */
        @media (max-width: 640px) {
            .projects-modal-content {
                max-width: 95vw;
                padding: 16px;
            }
            .projects-modal-title {
                font-size: 18px;
            }
        }

        /* Landscape orientation support for mobile */
        @media (max-height: 600px) or (orientation: landscape) {
            .projects-modal-content {
                max-height: 95vh;
                overflow-y: auto;
                overflow-x: auto;
            }
            
            .projects-form-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
            
            .projects-form-full {
                grid-column: 1 / -1;
            }
        }

        .projects-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .projects-modal-title {
            font-weight: 700;
            font-size: 20px;
            color: #111827;
        }

        .projects-modal-close {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 6px;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .projects-modal-close:hover {
            background: #f3f4f6;
        }

        .projects-form-group {
            margin-bottom: 20px;
        }

        .projects-form-label {
            display: block;
            color: #374151;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .projects-form-input,
        .projects-form-select {
            width: 100%;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            color: #111827;
            transition: all 0.2s ease;
        }

        .projects-form-input:focus,
        .projects-form-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }

        .projects-form-error {
            color: #b91c1c;
            font-size: 12px;
            margin-top: 6px;
        }

        .projects-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
        }

        .projects-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
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
            background: #1e3a8a;
        }

        .projects-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .projects-btn-secondary {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .projects-btn-secondary:hover {
            background: #f9fafb;
        }

        .projects-btn-primary {
            background: var(--accent);
            color: #ffffff;
        }

        .projects-btn-primary:hover {
            background: #1e3a8a;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Modern Pagination Styles */
        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 20px 0;
            user-select: none;
        }
        .pagination-info {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
        }
        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        .page-btn:hover:not(.disabled):not(.active):not(.ellipsis) {
            background: #f3f4f6;
            color: #111827;
        }
        .page-btn:active:not(.disabled):not(.ellipsis) {
            transform: scale(0.95);
        }
        .page-btn.active {
            background: var(--accent);
            color: #ffffff;
            font-weight: 600;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
        .page-btn.arrow {
            font-size: 20px;
            font-weight: 400;
        }
        .page-btn.ellipsis {
            cursor: default;
            pointer-events: none;
        }
        .page-btn.ellipsis:hover {
            background: transparent;
        }
        @media (max-width: 640px) {
            .page-btn {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }
            .page-btn.arrow {
                font-size: 18px;
            }
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

            .projects-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .projects-table {
                font-size: 12px;
            }

            .projects-table thead th,
            .projects-table tbody td {
                padding: 8px 6px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <!-- Breadcrumb -->
                <nav style="margin-bottom: 20px; font-size: 14px; color: #6b7280;">
                    <a href="{{ route('dashboard') }}" style="color: var(--accent); text-decoration: none;">Dashboard</a>
                    <span style="margin: 0 8px;">></span>
                    <span style="color: #374151;">Projects</span>
                </nav>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-left: 16px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Projects Header -->
                <div class="projects-header">
                    <div class="projects-content">
                        <div class="projects-title">Projects</div>
                        <div class="projects-actions">
                            <a href="{{ route('archives') }}" class="projects-button" aria-label="View Archives" style="text-decoration: none;">
                                <span class="projects-button-base" style="background: #f3f4f6; color: #374151;">
                                    <i class="fas fa-archive"></i>
                                    <span>Archives</span>
                                </span>
                            </a>
                            <button type="button" id="newProjectBtn" class="projects-button" aria-label="New Project" onclick="window.openProjectModal(true)">
                                <span class="projects-button-base primary">
                                    <i class="fas fa-plus"></i>
                                    <span>New</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Projects Table -->
                <div class="projects-table-card">
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Client First Name</th>
                                <th>Client Last Name</th>
                                <th>Status</th>
                                <th>Assigned Project Manager</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="projectsTableBody">
                            @forelse ($projects as $project)
                                @php
                                    $statusMap = [
                                        'Ongoing'   => ['class' => 'success', 'icon' => 'fas fa-check'],
                                        'In Review'  => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                        'Mobilizing' => ['class' => 'info', 'icon' => 'fas fa-bolt'],
                                        'On Hold'    => ['class' => 'danger', 'icon' => 'fas fa-pause'],
                                        'Completed'  => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                    ];

                                    $displayStatus = $project->status === 'On Track' ? 'Ongoing' : $project->status;
                                    $badge = $statusMap[$displayStatus] ?? ['class' => 'info', 'icon' => 'fas fa-bolt'];
                                @endphp
                                <tr
                                    data-id="{{ $project->id }}"
                                    data-name="{{ $project->project_code }}"
                                    data-status="{{ $project->status }}"
                                >
                                    <td>
                                        <a href="{{ route('projects.show', $project) }}" style="color: var(--accent); text-decoration: none;">
                                            {{ $project->project_name }}
                                        </a>
                                    </td>
                                    <td>{{ $project->client_first_name ?: '—' }}</td>
                                    <td>{{ $project->client_last_name ?: '—' }}</td>
                                    <td>
                                        <span class="status-badge {{ $badge['class'] }}">
                                            <i class="{{ $badge['icon'] }}"></i>
                                            {{ $displayStatus }}
                                        </span>
                                    </td>
                                    <td>{{ $project->assignedPM?->name ?: '—' }}</td>
                                    <td>{{ optional($project->created_at)->diffForHumans() ?? 'Just now' }}</td>
                                    <td>
                                        <div class="projects-actions">
                                            <button
                                                type="button"
                                                class="projects-button"
                                                aria-label="View Project"
                                                onclick="window.location.href='{{ route('projects.show', $project->id) }}'"
                                            >
                                                <span class="projects-button-base" style="background: #dbeafe; color: #0369a1;">
                                                    <i class="fas fa-eye"></i>
                                                    <span>View</span>
                                                </span>
                                            </button>
                                            <button
                                                type="button"
                                                class="projects-button"
                                                aria-label="Edit Project"
                                                onclick="openEditProjectModal(this)"
                                            >
                                                <span class="projects-button-base">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </span>
                                            </button>
                                            <button
                                                type="button"
                                                class="projects-button"
                                                aria-label="Archive Project"
                                                onclick="openArchiveModal({{ $project->id }}, '{{ $project->project_name }}')"
                                            >
                                                <span class="projects-button-base" style="background: #fee2e2; color: #991b1b;">
                                                    <i class="fas fa-archive"></i>
                                                    <span>Archive</span>
                                                </span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" style="text-align: center; color: #6b7280; padding: 24px;">
                                        No projects found. Click the <strong>New</strong> button to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                    @php
                        $currentPage = $projects->currentPage();
                        $lastPage = $projects->lastPage();
                        $pageNumbers = [];

                        if ($lastPage <= 7) {
                            for ($i = 1; $i <= $lastPage; $i++) {
                                $pageNumbers[] = $i;
                            }
                        } else {
                            $pageNumbers[] = 1;
                            if ($currentPage > 3) {
                                $pageNumbers[] = '...';
                            }
                            $start = max(2, $currentPage - 1);
                            $end = min($lastPage - 1, $currentPage + 1);
                            for ($i = $start; $i <= $end; $i++) {
                                $pageNumbers[] = $i;
                            }
                            if ($currentPage < $lastPage - 2) {
                                $pageNumbers[] = '...';
                            }
                            $pageNumbers[] = $lastPage;
                        }
                    @endphp
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }}
                            of {{ $projects->total() }} results
                        </div>
                        <div class="pagination-controls">
                            @if ($projects->onFirstPage())
                                <span class="page-btn arrow disabled">‹</span>
                            @else
                                <a class="page-btn arrow" href="{{ $projects->previousPageUrl() }}" rel="prev">‹</a>
                            @endif

                            <div class="pagination-nav">
                                @foreach ($pageNumbers as $page)
                                    @if ($page === '...')
                                        <span class="page-btn ellipsis">…</span>
                                    @elseif ($page == $currentPage)
                                        <span class="page-btn active">{{ $page }}</span>
                                    @else
                                        <a class="page-btn" href="{{ $projects->url($page) }}">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($projects->hasMorePages())
                                <a class="page-btn arrow" href="{{ $projects->nextPageUrl() }}" rel="next">›</a>
                            @else
                                <span class="page-btn arrow disabled">›</span>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- New Project Modal -->
                <div class="projects-modal" id="projectModal" aria-hidden="true">
                    <div class="projects-modal-content" role="dialog" aria-modal="true">
                        <div class="projects-modal-header">
                            <div class="projects-modal-title">Add New Project</div>
                            <button class="projects-modal-close" onclick="closeProjectModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="projectForm" action="{{ route('projects.store') }}" method="POST">
                            @csrf
                            <div class="projects-form-grid">
                                <div class="projects-form-group">
                                    <label class="projects-form-label">Project Name</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="projectName"
                                        name="project_name"
                                        placeholder="Enter project name"
                                        value="{{ old('project_name') }}"
                                        required
                                    />
                                    @error('project_name')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group projects-form-full">
                                    <label class="projects-form-label">Description</label>
                                    <textarea
                                        class="projects-form-input"
                                        id="description"
                                        name="description"
                                        placeholder="Enter project description"
                                        rows="3"
                                    >{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label" for="clientFirstName">Client First Name</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="clientFirstName"
                                        name="client_first_name"
                                        placeholder="Enter client first name"
                                        value="{{ old('client_first_name') }}"
                                        required
                                    />
                                    @error('client_first_name')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label" for="clientLastName">Client Last Name</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="clientLastName"
                                        name="client_last_name"
                                        placeholder="Enter client last name"
                                        value="{{ old('client_last_name') }}"
                                        required
                                    />
                                    @error('client_last_name')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Location</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="location"
                                        name="location"
                                        placeholder="Enter project location"
                                        value="{{ old('location') }}"
                                    />
                                    @error('location')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Industry</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="industry"
                                        name="industry"
                                        placeholder="Enter industry"
                                        value="{{ old('industry') }}"
                                    />
                                    @error('industry')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Project Type <span style="color: #ef4444;">*</span></label>
                                    <select
                                        class="projects-form-input"
                                        id="projectType"
                                        name="project_type"
                                        required
                                    >
                                        <option value="">-- Select Project Type --</option>
                                        <option value="Plumbing Works" {{ old('project_type') === 'Plumbing Works' ? 'selected' : '' }}>Plumbing Works</option>
                                        <option value="Fire Safety" {{ old('project_type') === 'Fire Safety' ? 'selected' : '' }}>Fire Safety</option>
                                        <option value="Fire Detection Alarm System" {{ old('project_type') === 'Fire Detection Alarm System' ? 'selected' : '' }}>Fire Detection Alarm System</option>
                                        <option value="Gas Line Installation" {{ old('project_type') === 'Gas Line Installation' ? 'selected' : '' }}>Gas Line Installation</option>
                                        <option value="Air-Conditioning System Installation & Maintenance" {{ old('project_type') === 'Air-Conditioning System Installation & Maintenance' ? 'selected' : '' }}>Air-Conditioning System Installation & Maintenance</option>
                                        <option value="Ducting Works" {{ old('project_type') === 'Ducting Works' ? 'selected' : '' }}>Ducting Works</option>
                                    </select>
                                    @error('project_type')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Target Timeline</label>
                                    <input
                                        type="date"
                                        class="projects-form-input"
                                        id="targetTimeline"
                                        name="target_timeline"
                                        value="{{ old('target_timeline') }}"
                                    />
                                    @error('target_timeline')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Allocated Amount</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        class="projects-form-input"
                                        id="allocatedAmount"
                                        name="allocated_amount"
                                        placeholder="Enter allocated budget"
                                        value="{{ old('allocated_amount') }}"
                                    />
                                    @error('allocated_amount')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Status</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="status"
                                        name="status"
                                        value="Ongoing"
                                        readonly
                                    />
                                    <input type="hidden" name="status" value="Ongoing" />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Assigned PM</label>
                                    <select
                                        class="projects-form-input"
                                        id="assignedPmId"
                                        name="assigned_pm_id"
                                    >
                                        <option value="">-- Select a Project Manager --</option>
                                        @foreach($projectManagers as $pm)
                                            <option value="{{ $pm->id }}" {{ old('assigned_pm_id') == $pm->id ? 'selected' : '' }}>
                                                {{ $pm->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('assigned_pm_id')
                                        <p class="projects-form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="projects-modal-footer">
                                <button type="button" class="projects-btn projects-btn-secondary" onclick="closeProjectModal()">Cancel</button>
                                <button type="submit" class="projects-btn projects-btn-primary">
                                    <i class="fas fa-save"></i>
                                    <span>Save Project</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Project Modal -->
                <div class="projects-modal" id="editProjectModal" aria-hidden="true">
                    <div class="projects-modal-content" role="dialog" aria-modal="true">
                        <div class="projects-modal-header">
                            <div class="projects-modal-title">Edit Project</div>
                            <button class="projects-modal-close" onclick="closeEditProjectModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="editProjectForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="projects-form-grid">
                                <div class="projects-form-group">
                                    <label class="projects-form-label">Project Name</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="editProjectName"
                                        name="project_name"
                                        placeholder="Enter project name"
                                        required
                                    />
                                </div>

                                <div class="projects-form-group projects-form-full">
                                    <label class="projects-form-label">Description</label>
                                    <textarea
                                        class="projects-form-input"
                                        id="editDescription"
                                        name="description"
                                        placeholder="Enter project description"
                                        rows="3"
                                    ></textarea>
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Location</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="editLocation"
                                        name="location"
                                        placeholder="Enter project location"
                                    />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Industry</label>
                                    <input
                                        type="text"
                                        class="projects-form-input"
                                        id="editIndustry"
                                        name="industry"
                                        placeholder="Enter industry"
                                    />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Target Timeline</label>
                                    <input
                                        type="date"
                                        class="projects-form-input"
                                        id="editTargetTimeline"
                                        name="target_timeline"
                                    />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Date Started</label>
                                    <input
                                        type="date"
                                        class="projects-form-input"
                                        id="editDateStarted"
                                        name="date_started"
                                    />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Date Ended</label>
                                    <input
                                        type="date"
                                        class="projects-form-input"
                                        id="editDateEnded"
                                        name="date_ended"
                                    />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Allocated Amount</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        class="projects-form-input"
                                        id="editAllocatedAmount"
                                        name="allocated_amount"
                                        placeholder="Enter allocated budget"
                                    />
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Status</label>
                                    <select class="projects-form-select" id="editProjectStatus" name="status" required>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>

                                <div class="projects-form-group">
                                    <label class="projects-form-label">Assigned PM</label>
                                    <select
                                        class="projects-form-input"
                                        id="editAssignedPmId"
                                        name="assigned_pm_id"
                                    >
                                        <option value="">-- Select a Project Manager --</option>
                                        @foreach($projectManagers as $pm)
                                            <option value="{{ $pm->id }}">
                                                {{ $pm->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="projects-modal-footer">
                                <button type="button" class="projects-btn projects-btn-secondary" onclick="closeEditProjectModal()">Cancel</button>
                                <button type="submit" class="projects-btn projects-btn-primary">
                                    <i class="fas fa-save"></i>
                                    <span>Save Changes</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Archive Project Modal -->
                <div class="projects-modal" id="archiveModal" aria-hidden="true">
                    <div class="projects-modal-content" role="dialog" aria-modal="true">
                        <div class="projects-modal-header">
                            <div class="projects-modal-title">Archive Project</div>
                            <button class="projects-modal-close" onclick="closeArchiveModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="archiveForm" method="POST">
                            @csrf
                            <p style="margin-bottom: 20px; color: #374151; font-size: 14px;">
                                Are you sure you want to archive <strong id="archiveProjectName"></strong>?
                            </p>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Archive Reason</label>
                                <select class="projects-form-select" name="archive_reason" required>
                                    <option value="">Select reason</option>
                                    <option value="Finished">Finished</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="projects-modal-footer">
                                <button type="button" class="projects-btn projects-btn-secondary" onclick="closeArchiveModal()">Cancel</button>
                                <button type="submit" class="projects-btn" style="background: #dc2626; color: white;">
                                    <i class="fas fa-archive"></i>
                                    <span>Archive</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <!-- Employee Assignment Modal -->
        <div id="employeeModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Manage Employees - <span id="modalProjectName"></span></h2>
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

    @include('partials.sidebar-js')
    <script>
        const projectModal = document.getElementById('projectModal');
        const projectForm = document.getElementById('projectForm');
        const editProjectModal = document.getElementById('editProjectModal');
        const editProjectForm = document.getElementById('editProjectForm');
        const archiveModal = document.getElementById('archiveModal');
        const archiveForm = document.getElementById('archiveForm');
        const archiveProjectName = document.getElementById('archiveProjectName');
        const editProjectName = document.getElementById('editProjectName');
        const editDescription = document.getElementById('editDescription');
        const editLocation = document.getElementById('editLocation');
        const editIndustry = document.getElementById('editIndustry');
        const editTargetTimeline = document.getElementById('editTargetTimeline');
        const editDateStarted = document.getElementById('editDateStarted');
        const editDateEnded = document.getElementById('editDateEnded');
        const editAllocatedAmount = document.getElementById('editAllocatedAmount');
        const editProjectStatus = document.getElementById('editProjectStatus');
        const editAssignedPmId = document.getElementById('editAssignedPmId');

        // Employee Management Variables
        let currentProjectId = null;
        let currentProjectStatus = null;
        let allEmployees = {!! $allEmployees ? json_encode($allEmployees) : '[]' !!};
        let projectEmployees = {!! $projectEmployees ? json_encode($projectEmployees) : '[]' !!};
        let canManage = {{ auth()->user()->canManageProjectEmployees() ? 'true' : 'false' }};

        window.openProjectModal = function(shouldReset) {
            if (typeof shouldReset === 'undefined') shouldReset = false;
            const modal = document.getElementById('projectModal');
            
            if (!modal) {
                console.error('Project modal not found');
                return;
            }
            
            const form = document.getElementById('projectForm');
            if (shouldReset && form) {
                form.reset();
            }
            
            // Remove active class first to ensure it applies
            modal.classList.remove('active');
            
            // Use setTimeout to ensure the class is applied after removal
            setTimeout(function() {
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                console.log('Modal should be visible now');
            }, 10);
        };

        window.closeProjectModal = function() {
            const modal = document.getElementById('projectModal');
            const form = document.getElementById('projectForm');
            
            if (!modal) return;
            
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            if (form) {
                form.reset();
            }
        };

        function openEditProjectModal(buttonEl) {
            const row = buttonEl.closest('tr');
            if (!row) return;
            const projectId = row.getAttribute('data-id');
            
            // Fetch project data via API or use data attributes
            fetch(`/api/projects/${projectId}`)
                .then(response => response.json())
                .then(data => {
                    if (editProjectForm) {
                        editProjectForm.action = `/projects/${projectId}`;
                    }
                    if (editProjectName) editProjectName.value = data.project_name || '';
                    if (editDescription) editDescription.value = data.description || '';
                    if (editLocation) editLocation.value = data.location || '';
                    if (editIndustry) editIndustry.value = data.industry || '';
                    
                    // Format dates for HTML date inputs (YYYY-MM-DD)
                    const formatDateForInput = (dateString) => {
                        if (!dateString) return '';
                        const date = new Date(dateString);
                        if (isNaN(date)) return '';
                        return date.toISOString().split('T')[0];
                    };
                    
                    if (editTargetTimeline) editTargetTimeline.value = formatDateForInput(data.target_timeline) || '';
                    if (editDateStarted) editDateStarted.value = formatDateForInput(data.date_started) || '';
                    if (editDateEnded) editDateEnded.value = formatDateForInput(data.date_ended) || '';
                    if (editAllocatedAmount) editAllocatedAmount.value = data.allocated_amount || '';
                    if (editProjectStatus) editProjectStatus.value = data.status || 'Ongoing';
                    if (editAssignedPmId) editAssignedPmId.value = data.assigned_pm_id || '';

                    if (editProjectModal) {
                        editProjectModal.classList.add('active');
                        editProjectModal.setAttribute('aria-hidden', 'false');
                    }
                })
                .catch(error => {
                    console.error('Error fetching project data:', error);
                    alert('Error loading project data');
                });
        }

        function closeEditProjectModal() {
            if (!editProjectModal) return;
            editProjectModal.classList.remove('active');
            editProjectModal.setAttribute('aria-hidden', 'true');
            if (editProjectForm) editProjectForm.reset();
        }

        function openArchiveModal(projectId, projectName) {
            if (!archiveModal || !archiveForm) return;
            
            archiveForm.action = `/projects/${projectId}/archive`;
            if (archiveProjectName) {
                archiveProjectName.textContent = projectName;
            }
            
            archiveModal.classList.add('active');
            archiveModal.setAttribute('aria-hidden', 'false');
        }

        function closeArchiveModal() {
            if (!archiveModal) return;
            archiveModal.classList.remove('active');
            archiveModal.setAttribute('aria-hidden', 'true');
            if (archiveForm) archiveForm.reset();
        }

        document.addEventListener('DOMContentLoaded', function () {
            // New Project Button
            const newProjectBtn = document.getElementById('newProjectBtn');
            if (newProjectBtn) {
                newProjectBtn.addEventListener('click', function () {
                    openProjectModal(true);
                });
            }

            if (projectModal) {
                projectModal.addEventListener('click', function (event) {
                    if (event.target === projectModal) {
                        closeProjectModal();
                    }
                });
            }
            if (editProjectModal) {
                editProjectModal.addEventListener('click', function (event) {
                    if (event.target === editProjectModal) {
                        closeEditProjectModal();
                    }
                });
            }
            if (archiveModal) {
                archiveModal.addEventListener('click', function (event) {
                    if (event.target === archiveModal) {
                        closeArchiveModal();
                    }
                });
            }

            const shouldShowModal = {{ $errors->any() ? 'true' : 'false' }};
            if (shouldShowModal) {
                openProjectModal(false);
            }
        });

        // Employee Management Functions
        function openEmployeeModal(projectId, projectName, projectStatus) {
            if (!canManage) {
                alert('You do not have permission to manage project employees.');
                return;
            }

            currentProjectId = projectId;
            currentProjectStatus = projectStatus;
            document.getElementById('modalProjectName').textContent = projectName;

            if (projectStatus.toLowerCase() === 'completed') {
                document.getElementById('modalWarning').style.display = 'flex';
            } else {
                document.getElementById('modalWarning').style.display = 'none';
            }

            loadEmployeesForModal(projectId);
            document.getElementById('employeeModal').classList.add('active');
        }

        function closeEmployeeModal() {
            document.getElementById('employeeModal').classList.remove('active');
            currentProjectId = null;
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
    </script>
</body>

</html>

