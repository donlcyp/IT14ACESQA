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

        html, body, input, select, textarea, button {
            font-family: 'Inter', sans-serif;
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
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
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
            border-bottom: 2px solid var(--accent);
            padding-bottom: 10px;
            margin-bottom: 5px;
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
            background: linear-gradient(135deg, var(--accent), #1e3a8a);
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
            background: linear-gradient(135deg, var(--accent), #1e3a8a);
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
            background: linear-gradient(to bottom, #1e40af, #3b82f6, #9ca3af);
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
        @include('partials.sidebar')

        <main class="main-content sidebar-closed" id="mainContent">
            <header class="header">
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
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

                <!-- Flash Messages (Hidden, will be shown via modal) -->
                @if(session('success'))
                    <div id="flashSuccessMessage" style="display: none;">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div id="flashErrorMessage" style="display: none;">{{ session('error') }}</div>
                @endif

                <!-- Project Header -->
                <style>
                    .projects-header { margin-bottom: 10px; }
                    .projects-content { display:flex; align-items:flex-end; justify-content:space-between; }
                    .projects-title { font-size: 26px; line-height: 1.2; font-weight: 800; color: var(--black-1); margin: 0; }
                    .projects-subtitle { font-size: 13px; color: var(--gray-600); margin-top: 4px; }
                    .header-divider { margin-top: 10px; height: 1px; background: var(--gray-300); opacity: 0.6; }
                    
                    /* Notification Toast Styling */
                    @keyframes toastIn {
                        from { opacity: 0; transform: translateY(-8px); }
                        to { opacity: 1; transform: translateY(0); }
                    }

                    @keyframes toastOut {
                        from { opacity: 1; transform: translateY(0); }
                        to { opacity: 0; transform: translateY(-8px); }
                    }

                    .notification-modal-show { animation: toastIn 0.35s ease-out forwards; }
                    .notification-modal-show .modal-content { animation: toastIn 0.35s ease-out forwards; }
                    .notification-modal-hide { animation: toastOut 0.2s ease-in forwards; }
                    .notification-modal-hide .modal-content { animation: toastOut 0.2s ease-in forwards; }

                    #notificationModal {
                        background: transparent;
                        align-items: flex-start;
                        justify-content: flex-end;
                        padding: 12px;
                        pointer-events: none;
                    }

                    #notificationModal .modal-content {
                        pointer-events: auto;
                        max-width: 360px;
                        width: 100%;
                        margin-top: 12px;
                        padding: 12px 14px;
                        border-radius: 12px;
                        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
                        border: 1px solid #e5e7eb;
                        background: #f8fafc;
                    }

                    #notificationModal .modal-header {
                        border: 0 !important;
                        background: transparent !important;
                        padding: 0;
                        margin: 0 0 6px 0;
                        align-items: flex-start;
                    }

                    #notificationModal .modal-title {
                        font-size: 15px;
                        font-weight: 700;
                        color: #111827;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    }

                    #notificationModal .modal-close {
                        color: #6b7280;
                        font-size: 16px;
                        padding: 4px;
                    }

                    #notificationModal .modal-close:hover { color: #111827; }
                    #notificationModal .modal-footer { display: none !important; }
                    #notificationMessage { font-size: 13px; color: #1f2937; margin: 0; }

                    #notificationModal .modal-content.toast-success { background: #f0fdf4; border-color: #bbf7d0; }
                    #notificationModal .modal-content.toast-success .modal-title,
                    #notificationModal .modal-content.toast-success #notificationMessage,
                    #notificationModal .modal-content.toast-success #notificationIcon { color: #166534; }

                    #notificationModal .modal-content.toast-error { background: #fef2f2; border-color: #fecdd3; }
                    #notificationModal .modal-content.toast-error .modal-title,
                    #notificationModal .modal-content.toast-error #notificationMessage,
                    #notificationModal .modal-content.toast-error #notificationIcon { color: #991b1b; }

                    #notificationModal .modal-content.toast-info { background: #eff6ff; border-color: #bfdbfe; }
                    #notificationModal .modal-content.toast-info .modal-title,
                    #notificationModal .modal-content.toast-info #notificationMessage,
                    #notificationModal .modal-content.toast-info #notificationIcon { color: #1d4ed8; }
                </style>
                <div class="projects-header">
                    <div class="projects-content">
                        <div>
                            <div class="projects-title">{{ $project->project_name ?? $project->project_code }}</div>
                            <div class="projects-subtitle">Project ID: {{ $project->project_code }}</div>
                        </div>
                        @php
                            $currentUser = auth()->user();
                            $isOwner = $currentUser && $currentUser->role === 'Owner';
                            $allMaterials = $project->materials ?? collect();
                            $totalMaterialItems = $allMaterials->count();
                            $approvedMaterialItems = $allMaterials->filter(fn($m) => strtolower($m->status ?? 'pending') === 'approved')->count();
                            $failedMaterialItems = $allMaterials->filter(fn($m) => strtolower($m->status ?? '') === 'fail')->count();
                            $clearedItems = $approvedMaterialItems + $failedMaterialItems;
                            $progressPercent = $totalMaterialItems > 0 ? round(($clearedItems / $totalMaterialItems) * 100, 1) : 0;
                            $canComplete = $progressPercent >= 100 && $project->status !== 'Completed' && $project->pm_confirmed_at;
                        @endphp
                        @if($isOwner && $project->status !== 'Completed')
                            <button type="button" class="btn {{ $canComplete ? 'btn-green' : 'btn-secondary' }}" 
                                    onclick="{{ $canComplete ? 'openCompleteProjectModal()' : 'showCannotCompleteMessage()' }}"
                                    style="display: flex; align-items: center; gap: 8px; {{ !$canComplete ? 'opacity: 0.6; cursor: not-allowed;' : '' }}">
                                <i class="fas fa-check-circle"></i>
                                Mark as Complete
                            </button>
                        @elseif($project->status === 'Completed')
                            <span style="display: flex; align-items: center; gap: 8px; padding: 10px 16px; background: #dcfce7; color: #166534; border-radius: 8px; font-weight: 600; font-size: 14px;">
                                <i class="fas fa-check-circle"></i> Project Completed
                            </span>
                        @endif
                    </div>
                    <div class="header-divider"></div>
                </div>

                <!-- Tabs (Styles) -->
                <style>
                    .info-item { padding: 8px 10px; border: 1px solid var(--gray-300); border-radius: 8px; background: #fff; }
                    .info-label { font-size: 12px; color: var(--gray-600); text-transform: uppercase; letter-spacing: .02em; }
                    .info-value { margin-top: 3px; font-size: 15px; color: var(--black-1); font-weight: 600; }
                    .badge-pill { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
                    .tabs { margin-top: 14px; border-bottom: 1px solid var(--gray-300); padding-bottom: 6px; }
                    .tab-button { margin-right: 8px; }
                </style>

                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab-button active" onclick="switchTab('overview')">Overview</button>
                    <button class="tab-button" onclick="switchTab('boq')">Bill of Quantity</button>
                    <button class="tab-button" onclick="switchTab('finance')">Finance & Transactions</button>
                    <button class="tab-button" onclick="switchTab('employees')">Team Workers</button>
                    <button class="tab-button" onclick="switchTab('images')">Documentation</button>
                    @if(auth()->user()->role === 'QA')
                    <button class="tab-button" onclick="switchTab('qa-inspections')">
                        <i class="fas fa-clipboard-check"></i> QA Inspections
                    </button>
                    @endif
                    <button class="tab-button" onclick="switchTab('report')">Reports</button>
                </div>

                <!-- Overview Tab -->
                <div id="overview" class="tab-content active">
                    <!-- Project Identification & Metadata -->
                    <div class="report-section">
                        <div class="report-title">Project Identification</div>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 12px;">
                            <div class="info-item">
                                <div class="info-label">Project Title</div>
                                <div class="info-value" style="font-size: 16px;">{{ $project->project_name ?? $project->project_code }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Project ID</div>
                                <div class="info-value">{{ $project->project_code }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Client/Stakeholder</div>
                                <div class="info-value">{{ $project->client?->company_name ?? trim($project->client_first_name . ' ' . $project->client_last_name) }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Project Manager</div>
                                <div class="info-value">{{ $project->assignedPM?->name ?? 'Unassigned' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Project Type</div>
                                <div class="info-value">{{ $project->project_type ?? 'Not specified' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Location/Site</div>
                                <div class="info-value">{{ $project->location ?? 'Not specified' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status and Performance Metrics (Mini-Dashboard) -->
                    <div class="report-section">
                        <div class="report-title">Performance Dashboard</div>
                        
                        @php
                            // Calculate project metrics
                            $materials = $project->materials ?? collect();
                            $totalExpenses = $materials->sum(function($m) {
                                return ($m->material_cost ?? 0) * ($m->quantity ?? 0) + ($m->labor_cost ?? 0) * ($m->quantity ?? 0);
                            });
                            $allocatedBudget = $project->allocated_amount ?? 0;
                            $budgetUtilized = $allocatedBudget > 0 ? round(($totalExpenses / $allocatedBudget) * 100, 1) : 0;
                            
                            // Calculate progress (based on approved BOQ items)
                            $totalItems = $materials->count();
                            $approvedItems = $materials->filter(function($m) { return strtolower($m->status ?? 'pending') === 'approved'; })->count();
                            $progressPercentage = $totalItems > 0 ? round(($approvedItems / $totalItems) * 100, 1) : 0;
                            
                            // Project health indicator (Green/Yellow/Red)
                            $healthScore = 'green';
                            if ($budgetUtilized > 90 || $progressPercentage < 50) {
                                $healthScore = 'red';
                            } elseif ($budgetUtilized > 75 || $progressPercentage < 75) {
                                $healthScore = 'yellow';
                            }
                            
                            $healthColor = match($healthScore) {
                                'green' => '#16a34a',
                                'yellow' => '#f59e0b',
                                'red' => '#dc2626',
                                default => '#6b7280'
                            };
                            
                            $healthBg = match($healthScore) {
                                'green' => '#dcfce7',
                                'yellow' => '#fef3c7',
                                'red' => '#fee2e2',
                                default => '#f3f4f6'
                            };
                            
                            // Calculate man-hours
                            $totalManHours = 0;
                            foreach($project->employees as $emp) {
                                $dateFrom = '2025-12-01';
                                $dateTo = '2025-12-31';
                                $attendanceRecords = \App\Models\EmployeeAttendance::where('employee_id', $emp->id)
                                    ->whereBetween('date', [$dateFrom, $dateTo])
                                    ->whereNotNull('punch_in_time')
                                    ->whereNotNull('punch_out_time')
                                    ->get();
                                $totalManHours += $attendanceRecords->sum(function($att) { return $att->getHoursWorked() ?? 0; });
                            }
                            
                            // Count overdue tasks (using project updates as tasks)
                            $overdueCount = $project->updates ? $project->updates->filter(function($update) {
                                return strtolower($update->status ?? '') !== 'completed';
                            })->count() : 0;
                        @endphp
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 20px;">
                            <div class="info-item" style="border-left: 4px solid {{ $healthColor }};">
                                <div class="info-label">Project Health</div>
                                <div class="info-value" style="display: flex; align-items: center; gap: 8px;">
                                    <span style="width: 12px; height: 12px; border-radius: 50%; background: {{ $healthColor }}; display: inline-block; box-shadow: 0 0 0 3px {{ $healthBg }};"></span>
                                    <span style="color: {{ $healthColor }};">{{ ucfirst($healthScore) }}</span>
                                </div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #0369a1;">
                                <div class="info-label">Current Status</div>
                                <div class="info-value" style="color: #0369a1;">{{ $project->status }}</div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #7c3aed;">
                                <div class="info-label">Progress</div>
                                <div class="info-value" style="color: #7c3aed;">{{ $progressPercentage }}% Complete</div>
                                <div style="margin-top: 8px; height: 6px; background: #e9d5ff; border-radius: 3px; overflow: hidden;">
                                    <div style="height: 100%; background: #7c3aed; width: {{ $progressPercentage }}%; transition: width 0.3s;"></div>
                                </div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #be185d;">
                                <div class="info-label">Budget Utilized</div>
                                <div class="info-value" style="color: #be185d;">{{ $budgetUtilized }}% Spent</div>
                                <div style="margin-top: 8px; height: 6px; background: #fce7f3; border-radius: 3px; overflow: hidden;">
                                    <div style="height: 100%; background: {{ $budgetUtilized > 90 ? '#dc2626' : '#be185d' }}; width: {{ min($budgetUtilized, 100) }}%; transition: width 0.3s;"></div>
                                </div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #16a34a;">
                                <div class="info-label">Total Man-Hours</div>
                                <div class="info-value" style="color: #16a34a;">{{ number_format($totalManHours, 1) }} hrs</div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid {{ $overdueCount > 0 ? '#dc2626' : '#6b7280' }};">
                                <div class="info-label">Pending Tasks</div>
                                <div class="info-value" style="color: {{ $overdueCount > 0 ? '#dc2626' : '#6b7280' }};">{{ $overdueCount }} Active</div>
                            </div>
                        </div>
                        
                        <!-- Timeline Section -->
                        <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid var(--gray-300);">
                            <h3 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 600; color: var(--black-1);">Timeline</h3>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                                <div>
                                    <div style="font-size: 11px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Start Date</div>
                                    <div style="font-size: 14px; font-weight: 600; color: var(--black-1);">{{ $project->date_started ? \Carbon\Carbon::parse($project->date_started)->format('M d, Y') : 'Not started' }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 11px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Target Completion</div>
                                    <div style="font-size: 14px; font-weight: 600; color: var(--black-1);">{{ $project->target_timeline ? $project->target_timeline->format('M d, Y') : 'Not set' }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 11px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Actual/Expected End</div>
                                    <div style="font-size: 14px; font-weight: 600; color: var(--black-1);">{{ $project->date_ended ? \Carbon\Carbon::parse($project->date_ended)->format('M d, Y') : 'In progress' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Key Deliverables and Milestones -->
                    <div class="report-section">
                        <div class="report-title">Key Deliverables & Financial Summary</div>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                            <!-- BOQ Summary Card -->
                            <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid var(--gray-300);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                                    <i class="fas fa-file-invoice" style="color: #7c3aed; font-size: 20px;"></i>
                                    <h3 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--black-1);">Bill of Quantity</h3>
                                </div>
                                <div style="display: grid; gap: 8px;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Total Items:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: var(--black-1);">{{ $totalItems }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Approved:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: #16a34a;">{{ $approvedItems }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Grand Total:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: #7c3aed;">₱{{ number_format($totalExpenses, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Budget Card -->
                            <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid var(--gray-300);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                                    <i class="fas fa-wallet" style="color: #be185d; font-size: 20px;"></i>
                                    <h3 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--black-1);">Budget Status</h3>
                                </div>
                                <div style="display: grid; gap: 8px;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Allocated:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: var(--black-1);">₱{{ number_format($allocatedBudget, 2) }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Spent:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: #dc2626;">₱{{ number_format($totalExpenses, 2) }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Remaining:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: {{ $allocatedBudget - $totalExpenses < 0 ? '#dc2626' : '#16a34a' }};">₱{{ number_format(max(0, $allocatedBudget - $totalExpenses), 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Team Card -->
                            <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid var(--gray-300);">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                                    <i class="fas fa-users" style="color: #0369a1; font-size: 20px;"></i>
                                    <h3 style="margin: 0; font-size: 14px; font-weight: 600; color: var(--black-1);">Team Summary</h3>
                                </div>
                                <div style="display: grid; gap: 8px;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Total Workers:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: var(--black-1);">{{ $project->employees->count() + 1 }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Project Manager:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: #0369a1;">{{ $project->assignedPM?->name ?? 'N/A' }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="font-size: 13px; color: var(--gray-600);">Total Hours:</span>
                                        <span style="font-size: 13px; font-weight: 600; color: #16a34a;">{{ number_format($totalManHours, 1) }} hrs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Description -->
                    <div class="report-section">
                        <div class="report-title">Project Description</div>
                        <div style="background: white; padding: 16px; border-radius: 8px; border: 1px solid var(--gray-300);">
                            <p style="margin: 0; font-size: 14px; color: var(--gray-700); line-height: 1.6;">
                                {{ $project->description ?? 'No description provided for this project.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bill of Quantity Tab -->
                <div id="boq" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Bill of Quantity</div>
                        
                        <div style="display: flex; gap: 12px; margin-bottom: 20px; align-items: center; flex-wrap: wrap;">
                            @if($project->status !== 'Completed')
                                <button type="button" class="btn btn-primary" onclick="return openBOQModal();">
                                    <i class="fas fa-plus"></i> Add BOQ Item
                                </button>
                            @else
                                <div style="padding: 10px 16px; background-color: #e5e7eb; color: #6b7280; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                    <i class="fas fa-lock"></i> Project Completed - No additions allowed
                                </div>
                            @endif
                            <button type="button" id="deleteSelectedBtn" class="btn" style="background: #dc2626; color: white; display: none;" onclick="confirmBulkDelete()">
                                <i class="fas fa-trash"></i> Delete Selected (<span id="selectedCount">0</span>)
                            </button>
                            <a href="{{ route('pdf.boq.download', $project->id) }}" class="btn btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-file-pdf"></i> Download BOQ PDF
                            </a>
                        </div>

                        @if ($project->materials && $project->materials->count() > 0)
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                            <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); font-size: 14px; width: 50px;">
                                                <input type="checkbox" id="selectAllBOQ" onchange="toggleAllBOQItems()" style="cursor: pointer; width: 18px; height: 18px;">
                                            </th>
                                            <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); font-size: 16px; width: 60px;">Item No.</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1); font-size: 16px;">Item Description</th>
                                            <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); font-size: 16px; width: 80px;">Qty</th>
                                            <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); font-size: 16px; width: 80px;">Unit</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); font-size: 16px; width: 120px;">Material</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); font-size: 16px; width: 120px;">Labor</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); font-size: 16px; width: 100px;">Unit Rate</th>
                                            <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); font-size: 16px; width: 120px;">Total</th>
                                            <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); font-size: 16px; width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="boqTableBody">
                                        @php
                                            $totalMaterial = 0;
                                            $totalLabor = 0;
                                            $grandTotal = 0;
                                        @endphp
                                        @foreach ($project->materials as $material)
                                            @php
                                                $materialCost = $material->material_cost ?? ($material->unit_rate ?? 0);
                                                $laborCost = $material->labor_cost ?? 0;
                                                $unitTotal = $materialCost + $laborCost;
                                                $itemTotal = $unitTotal * ($material->quantity ?? 0);
                                                $totalMaterial += $materialCost * ($material->quantity ?? 0);
                                                $totalLabor += $laborCost * ($material->quantity ?? 0);
                                                $grandTotal += $itemTotal;
                                            @endphp
                                            <tr class="boq-row" style="border-bottom: 1px solid var(--gray-400);">
                                                <td style="padding: 12px; text-align: center;">
                                                    <input type="checkbox" class="boq-checkbox" data-material-id="{{ $material->id }}" onchange="updateBOQSelection()" style="cursor: pointer; width: 18px; height: 18px;">
                                                </td>
                                                <td style="padding: 12px; text-align: center; color: var(--black-1); font-weight: 600; font-size: 14px;">{{ $material->item_no ?? '—' }}</td>
                                                <td style="padding: 12px; color: var(--black-1);">
                                                    <div style="font-weight: 500; white-space: pre-wrap; line-height: 1.6; font-size: 14px;">{{ $material->item_description ?? $material->material_name ?? '—' }}</div>
                                                    @if($material->category)
                                                        <div style="font-size: 12px; color: var(--gray-600); margin-top: 8px;"><strong>Category:</strong> {{ $material->category }}</div>
                                                    @endif
                                                    @if($material->notes)
                                                        <div style="font-size: 12px; color: var(--gray-600); margin-top: 4px;"><strong>Notes:</strong> {{ $material->notes }}</div>
                                                    @endif
                                                </td>
                                                <td style="padding: 12px; text-align: center; color: var(--gray-700); font-weight: 600; font-size: 14px;">{{ $material->quantity ?? 0 }}</td>
                                                <td style="padding: 12px; text-align: center; color: var(--gray-700); font-size: 14px;">{{ $material->unit ?? '—' }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600; font-size: 14px;">₱{{ number_format($materialCost, 2) }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600; font-size: 14px;">₱{{ number_format($laborCost, 2) }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600; font-size: 14px;">₱{{ number_format($unitTotal, 2) }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--black-1); font-weight: 700; font-size: 14px;">₱{{ number_format($itemTotal, 2) }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">
                                                    <div style="display: flex; gap: 6px; align-items: center; justify-content: center;">
                                                        @if($project->status !== 'Completed')
                                                            <button class="btn" style="background: #dbeafe; color: #0369a1; padding: 6px 10px; font-size: 12px; border: none; border-radius: 4px; cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" onclick="editBOQItem({{ $material->id }})">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @endif
                                                        <button class="btn" style="background: #e0e7ff; color: #4f46e5; padding: 6px 10px; font-size: 12px; border: none; border-radius: 4px; cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" onclick="viewBOQTasks({{ json_encode($material->item_description ?? '') }}, {{ $material->id }})">
                                                            <i class="fas fa-tasks"></i>
                                                        </button>
                                                        @if($project->status !== 'Completed')
                                                            <button type="button" class="btn" style="background: #fee2e2; color: #991b1b; padding: 6px 10px; font-size: 12px; border: none; border-radius: 4px; cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" onclick="confirmSingleDelete({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'this item') }}')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="border-top: 2px solid var(--accent); background: var(--sidebar-bg); font-weight: 700; font-size: 14px;">
                                            <td></td>
                                            <td colspan="4" style="padding: 14px 12px; text-align: right;">SUBTOTAL:</td>
                                            <td style="padding: 14px 12px; text-align: right; color: var(--black-1);">₱{{ number_format($totalMaterial, 2) }}</td>
                                            <td style="padding: 14px 12px; text-align: right; color: var(--black-1);">₱{{ number_format($totalLabor, 2) }}</td>
                                            <td colspan="1" style="padding: 14px 12px; text-align: right;"></td>
                                            <td style="padding: 14px 12px; text-align: right; color: var(--black-1);">₱{{ number_format($grandTotal, 2) }}</td>
                                            <td></td>
                                        </tr>
                                        @php
                                            $vat = $grandTotal * 0.12;
                                            $grandTotalWithVAT = $grandTotal + $vat;
                                        @endphp
                                        <tr style="font-weight: 700; font-size: 14px; border-top: 1px solid var(--gray-400);">
                                            <td></td>
                                            <td colspan="4" style="padding: 12px 12px; text-align: right;">VAT 12%:</td>
                                            <td colspan="3" style="padding: 12px 12px; text-align: right;"></td>
                                            <td style="padding: 12px 12px; text-align: right; color: var(--black-1);">₱{{ number_format($vat, 2) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr style="font-weight: 700; font-size: 16px; border-top: 2px solid var(--accent);">
                                            <td></td>
                                            <td colspan="4" style="padding: 14px 12px; text-align: right;">Grand Total w/ VAT:</td>
                                            <td colspan="3" style="padding: 14px 12px; text-align: right;"></td>
                                            <td style="padding: 14px 12px; text-align: right; color: var(--black-1);">₱{{ number_format($grandTotalWithVAT, 2) }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                <i class="fas fa-list" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>No BOQ items added to this project yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Finance & Transactions Tab -->
                <div id="finance" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Finance & Transactions Summary</div>
                        
                        <!-- Financial Summary (Compact Metrics) -->
                        <div style="margin-bottom: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px;">
                            @php
                                $materials = $project->materials ?? collect();
                                $totalExpenses = $materials->sum(function($m) {
                                    return ($m->material_cost ?? 0) * ($m->quantity ?? 0) + ($m->labor_cost ?? 0) * ($m->quantity ?? 0);
                                });
                                $approvedExpenses = $materials->filter(function($m) {
                                    return strtolower($m->status ?? 'pending') === 'approved';
                                })->sum(function($m) {
                                    return ($m->material_cost ?? 0) * ($m->quantity ?? 0) + ($m->labor_cost ?? 0) * ($m->quantity ?? 0);
                                });
                                $pendingExpenses = $materials->filter(function($m) {
                                    return strtolower($m->status ?? 'pending') === 'pending';
                                })->sum(function($m) {
                                    return ($m->material_cost ?? 0) * ($m->quantity ?? 0) + ($m->labor_cost ?? 0) * ($m->quantity ?? 0);
                                });
                                $failedExpenses = $materials->filter(function($m) {
                                    return strtolower($m->status ?? 'pending') === 'failed';
                                })->sum(function($m) {
                                    return ($m->material_cost ?? 0) * ($m->quantity ?? 0) + ($m->labor_cost ?? 0) * ($m->quantity ?? 0);
                                });
                                $approvedCount = $materials->filter(function($m) { return strtolower($m->status ?? 'pending') === 'approved'; })->count();
                                $pendingCount = $materials->filter(function($m) { return strtolower($m->status ?? 'pending') === 'pending'; })->count();
                                $failedCount = $materials->filter(function($m) { return strtolower($m->status ?? 'pending') === 'failed'; })->count();
                            @endphp
                            
                            <div class="info-item" style="border-left: 4px solid #a855f7;">
                                <div class="info-label" style="color:#7e22ce;">Total Expenses</div>
                                <div class="info-value" style="color:#7e22ce;">₱{{ number_format($totalExpenses, 2) }}</div>
                                <div style="font-size: 12px; color: #7e22ce; opacity: 0.8;">{{ $materials->count() }} items</div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #1e40af;">
                                <div class="info-label" style="color:#1e3a8a;">Approved</div>
                                <div class="info-value" style="color:#1e40af;">₱{{ number_format($approvedExpenses, 2) }}</div>
                                <div style="font-size: 12px; color: #1e3a8a; opacity: 0.8;">{{ $approvedCount }} items ready</div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #f59e0b;">
                                <div class="info-label" style="color:#92400e;">Pending</div>
                                <div class="info-value" style="color:#f59e0b;">₱{{ number_format($pendingExpenses, 2) }}</div>
                                <div style="font-size: 12px; color: #92400e; opacity: 0.8;">{{ $pendingCount }} under review</div>
                            </div>
                            
                            <div class="info-item" style="border-left: 4px solid #dc2626;">
                                <div class="info-label" style="color:#991b1b;">Failed/Returns</div>
                                <div class="info-value" style="color:#dc2626;">₱{{ number_format($failedExpenses, 2) }}</div>
                                <div style="font-size: 12px; color: #991b1b; opacity: 0.8;">{{ $failedCount }} for return</div>
                            </div>
                        </div>

                        <!-- Budget vs Actual -->
                        <div style="margin-bottom: 30px; background: white; padding: 20px; border-radius: 8px; border: 1px solid var(--gray-300);">
                            <div style="font-weight: 600; font-size: 15px; margin-bottom: 15px;">Budget vs Actual</div>
                            @php
                                $allocatedBudget = $project->allocated_amount ?? 0;
                                $percentageUsed = $allocatedBudget > 0 ? round(($totalExpenses / $allocatedBudget) * 100, 1) : 0;
                                $remaining = max(0, $allocatedBudget - $totalExpenses);
                            @endphp
                            <div style="margin-bottom: 15px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                                    <span>Allocated Budget: <strong>₱{{ number_format($allocatedBudget, 2) }}</strong></span>
                                    <span style="color: var(--gray-600);">Used: {{ $percentageUsed }}%</span>
                                </div>
                                <div style="height: 8px; background: var(--gray-300); border-radius: 4px; overflow: hidden;">
                                    <div style="height: 100%; background: {{ $percentageUsed > 100 ? '#dc2626' : ($percentageUsed > 80 ? '#f59e0b' : '#1e40af') }}; width: {{ min($percentageUsed, 100) }}%;"></div>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; font-size: 13px;">
                                <div>
                                    <div style="color: var(--gray-600); margin-bottom: 4px;">Total Expenses</div>
                                    <div style="font-size: 18px; font-weight: 700; color: var(--gray-900);">₱{{ number_format($totalExpenses, 2) }}</div>
                                </div>
                                <div>
                                    <div style="color: var(--gray-600); margin-bottom: 4px;">Remaining</div>
                                    <div style="font-size: 18px; font-weight: 700; color: {{ $remaining < 0 ? '#dc2626' : '#1e40af' }};">₱{{ number_format($remaining, 2) }}</div>
                                </div>
                                <div>
                                    <div style="color: var(--gray-600); margin-bottom: 4px;">Budget Status</div>
                                    <div style="font-size: 18px; font-weight: 700; color: {{ $percentageUsed > 100 ? '#dc2626' : ($percentageUsed > 80 ? '#f59e0b' : '#1e40af') }};">
                                        {{ $percentageUsed > 100 ? 'Over Budget' : ($percentageUsed > 80 ? 'Near Limit' : 'On Track') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Details Table -->
                        <div>
                            <div style="font-weight: 600; font-size: 15px; margin-bottom: 8px; display:flex; align-items:center; justify-content:space-between;">
                                <span>Transaction Details</span>
                                <style>
                                    .status-select {
                                        background: transparent;
                                        border: 1px solid var(--gray-300);
                                        border-radius: 6px;
                                        padding: 6px 10px;
                                        font-size: 12px;
                                        color: var(--gray-800);
                                        min-width: 120px;
                                        cursor: pointer;
                                    }
                                    .status-select:focus { outline: 2px solid var(--accent); outline-offset: 1px; }
                                    .status-select:disabled {
                                        background-color: #f3f4f6;
                                        color: #9ca3af;
                                        cursor: not-allowed;
                                        border-color: #d1d5db;
                                    }
                                    .status-select:disabled:hover {
                                        background-color: #f3f4f6;
                                    }
                                </style>
                            </div>

                            @if ($materials && $materials->count() > 0)
                                <div style="overflow-x: auto;">
                                    <table style="width: 100%; border-collapse: collapse; font-size: 17px;">
                                        <thead>
                                            <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                                <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Item Description</th>
                                                <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); width: 80px;">Qty</th>
                                                <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); width: 100px;">Unit Rate</th>
                                                <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); width: 100px;">Total Cost</th>
                                                <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); width: 100px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="transactionTableBody">
                                            @foreach ($materials as $material)
                                                @php
                                                    $itemTotal = ($material->material_cost ?? 0 + $material->labor_cost ?? 0) * ($material->quantity ?? 0);
                                                    $statusColor = match(strtolower($material->status ?? 'pending')) {
                                                        'approved' => ['#dbeafe', '#1e3a8a', '#1e40af'],
                                                        'pending' => ['#fef3c7', '#92400e', '#f59e0b'],
                                                        'failed' => ['#fee2e2', '#991b1b', '#dc2626'],
                                                        default => ['#f3f4f6', '#374151', '#6b7280']
                                                    };
                                                @endphp
                                                <tr style="border-bottom: 1px solid var(--gray-400);" data-transaction-id="{{ $material->id }}">
                                                    <td style="padding: 12px; color: var(--black-1);">
                                                        <div style="font-weight: 500; white-space: pre-wrap; line-height: 1.6; font-size: 15px;">{{ $material->item_description ?? 'N/A' }}</div>
                                                        @if($material->category)
                                                            <div style="font-size: 11px; color: var(--gray-600); margin-top: 6px;"><strong>Category:</strong> {{ $material->category }}</div>
                                                        @endif
                                                    </td>
                                                    <td style="padding: 12px; text-align: center; color: var(--gray-700);">{{ $material->quantity ?? 0 }}</td>
                                                    <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($material->material_cost ?? 0, 2) }}</td>
                                                    <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600; background: #f9fafb;">₱{{ number_format($itemTotal, 2) }}</td>
                                                    <td style="padding: 12px; text-align: center;">
                                                        @php
                                                            $qaStatus = $material->qa_status ?? 'pending';
                                                            $statusText = match($qaStatus) {
                                                                'passed' => 'Passed',
                                                                'failed' => 'Failed',
                                                                'requires_recheck' => 'Recheck',
                                                                default => 'Pending'
                                                            };
                                                            $badgeClass = match($qaStatus) {
                                                                'passed' => ['color' => '#065f46'],
                                                                'failed' => ['color' => '#991b1b'],
                                                                'requires_recheck' => ['color' => '#3730a3'],
                                                                default => ['color' => '#93a116ff']
                                                            };
                                                        @endphp
                                                        <span style="display: inline-block; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; color: {{ $badgeClass['color'] }};">
                                                            {{ $statusText }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                    <i class="fas fa-chart-line" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                    <p>No transactions recorded yet. Add BOQ items to begin tracking finances.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Team Workers Tab -->
                <div id="employees" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Team Workers</div>

                        <!-- Team Summary (Compact Metrics) -->
                        <div style="margin-bottom: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                            <div class="info-item" style="border-left: 4px solid #0369a1;">
                                <div class="info-label" style="color:#0369a1;">Total Workers</div>
                                <div class="info-value" style="color:#0369a1;">{{ $project->employees->count() + 1 }}</div>
                            </div>
                            <div class="info-item" style="border-left: 4px solid #1e40af;">
                                <div class="info-label" style="color:#1e40af;">Total Days Worked</div>
                                <div class="info-value" style="color:#1e40af;">
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
                            <div class="info-item" style="border-left: 4px solid #be185d;">
                                <div class="info-label" style="color:#be185d;">Total Labor Cost</div>
                                <div class="info-value" style="color:#be185d;">
                                    ₱@php
                                        $totalLaborCost = 0;
                                        $defaultRate = 700.00;
                                        
                                        foreach($project->employees as $emp) {
                                            // Get attendance records with punch times
                                            $dateFrom = '2025-12-01';
                                            $dateTo = '2025-12-31';
                                            
                                            $attendanceRecords = \App\Models\EmployeeAttendance::where('employee_id', $emp->id)
                                                ->whereBetween('date', [$dateFrom, $dateTo])
                                                ->whereNotNull('punch_in_time')
                                                ->whereNotNull('punch_out_time')
                                                ->get();
                                            
                                            // Calculate labor cost based on actual hours worked
                                            foreach($attendanceRecords as $attendance) {
                                                $totalLaborCost += $attendance->calculateLaborCost($defaultRate);
                                            }
                                        }
                                        echo number_format($totalLaborCost, 2);
                                    @endphp
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 12px; margin-bottom: 20px;">
                            @if($project->status !== 'Completed')
                                <button class="btn btn-primary" onclick="openEmployeeModal()">
                                    <i class="fas fa-plus"></i> Add Team Worker
                                </button>
                            @else
                                <div style="padding: 10px 16px; background-color: #e5e7eb; color: #6b7280; border-radius: 6px; font-size: 14px; font-weight: 500;">
                                    <i class="fas fa-lock"></i> Project Completed - No additions allowed
                                </div>
                            @endif
                        </div>

                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Worker</th>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Position</th>
                                        <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Days</th>
                                        <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Hours Worked</th>
                                        <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Hourly Rate</th>
                                        <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1);">Labor Cost</th>
                                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Define position hierarchy
                                        $positionHierarchy = [
                                            'Project Manager' => 1,
                                            'Finance Manager' => 2,
                                            'Site Supervisor' => 3,
                                            'Quality Assurance Officer' => 4,
                                            'HR/Timekeeper' => 5,
                                            'Construction Worker' => 6,
                                        ];
                                        
                                        // Collect all employees with PM first (use different variable name to avoid JS conflict)
                                        $teamWorkersList = [];
                                        
                                        // Add PM if exists
                                        if ($project->assignedPM) {
                                            $teamWorkersList[] = [
                                                'employee' => $project->assignedPM,
                                                'position' => 'Project Manager',
                                                'is_pm' => true,
                                                'hierarchy' => 1
                                            ];
                                        }
                                        
                                        // Add other employees sorted by hierarchy
                                        if ($project->employees && $project->employees->count() > 0) {
                                            $otherEmployees = $project->employees->map(function($emp) use ($positionHierarchy) {
                                                $position = $emp->position ?? 'Construction Worker';
                                                return [
                                                    'employee' => $emp,
                                                    'position' => $position,
                                                    'is_pm' => false,
                                                    'hierarchy' => $positionHierarchy[$position] ?? 5
                                                ];
                                            })->sortBy('hierarchy');
                                            
                                            $teamWorkersList = array_merge($teamWorkersList, $otherEmployees->toArray());
                                        }
                                    @endphp
                                    
                                    @foreach ($teamWorkersList as $item)
                                        @php
                                            $employee = $item['employee'];
                                            $position = $item['position'];
                                            $isPM = $item['is_pm'];
                                            $hierarchy = $item['hierarchy'];
                                            
                                            // Get attendance records with actual hours worked (for all workers including PM)
                                            $dateFrom = '2025-12-01';
                                            $dateTo = '2025-12-31';
                                            
                                            $empAttendanceRecords = \App\Models\EmployeeAttendance::where('employee_id', $employee->id)
                                                ->whereBetween('date', [$dateFrom, $dateTo])
                                                ->whereNotNull('punch_in_time')
                                                ->whereNotNull('punch_out_time')
                                                ->get();
                                            
                                            $daysWorked = $empAttendanceRecords->count();
                                            $totalHoursWorked = $empAttendanceRecords->sum(function($att) {
                                                return $att->getHoursWorked() ?? 0;
                                            });
                                            
                                            // Get daily rate based on employee's position
                                            $positionRate = \App\Models\PositionDailyRate::where('position', $position)->first();
                                            $dailyRate = $positionRate ? $positionRate->daily_rate : 700.00;
                                            $hourlyRate = \App\Models\EmployeeAttendance::calculateHourlyRate($dailyRate);
                                            
                                            // Calculate labor cost based on actual hours worked
                                            $laborCost = 0;
                                            foreach($empAttendanceRecords as $att) {
                                                $laborCost += $att->calculateLaborCost($dailyRate);
                                            }
                                            
                                            // Define icon for hierarchy
                                            $hierarchyIcon = [
                                                1 => 'fa-briefcase', // Project Manager
                                                2 => 'fa-money-bill-wave', // Finance Manager
                                                3 => 'fa-hard-hat', // Site Supervisor
                                                4 => 'fa-clipboard-check', // QA Officer
                                                5 => 'fa-clock', // HR/Timekeeper
                                                6 => 'fa-user-tie', // Construction Worker
                                            ];
                                            $icon = $hierarchyIcon[$hierarchy] ?? 'fa-user';
                                        @endphp
                                        
                                        <tr style="border-bottom: 1px solid var(--gray-400);">
                                            <td style="padding: 12px; color: var(--black-1); font-weight: 600;">
                                                @if ($isPM)
                                                    @if ($employee->name && !empty(trim($employee->name)))
                                                        {{ $employee->name }}
                                                    @elseif ($employee->f_name && $employee->l_name)
                                                        {{ $employee->f_name . ' ' . $employee->l_name }}
                                                    @else
                                                        Unassigned
                                                    @endif
                                                @else
                                                    {{ $employee->full_name ?? ($employee->f_name . ' ' . $employee->l_name) }}
                                                @endif
                                            </td>
                                            <td style="padding: 12px; color: var(--gray-700);">
                                                @php
                                                    $positionTextColors = [
                                                        'Project Manager' => '#166534',
                                                        'Finance Manager' => '#1e40af',
                                                        'Site Supervisor' => '#0369a1',
                                                        'Quality Assurance Officer' => '#6b21a8',
                                                        'HR/Timekeeper' => '#92400e',
                                                        'Construction Worker' => '#374151',
                                                    ];
                                                    $textColor = $positionTextColors[$position] ?? '#374151';
                                                @endphp
                                                <span style="background: none; color: {{ $textColor }}; padding: 4px 8px; border-radius: 6px; font-size: 15px; font-weight: 600;">
                                                    <i class="fas {{ $icon }}"></i> {{ $position }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700);">{{ $daysWorked }}</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">{{ number_format($totalHoursWorked, 2) }} hrs</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($hourlyRate, 2) }}/hr</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">₱{{ number_format($laborCost, 2) }}</td>
                                            @if ($isPM)
                                                <td style="padding: 12px; color: var(--gray-700); font-style: italic; font-size: 12px;">Auto-assigned</td>
                                            @else
                                                <td style="padding: 12px; color: var(--gray-700);">
                                                    <form method="POST" action="{{ route('projects.employees.remove', [$project->id, $employee->id]) }}" style="display: inline;" onsubmit="return confirm('Remove this employee?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="color: #991b1b; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @if (!($project->assignedPM || ($project->employees && $project->employees->count() > 0)))
                            <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                <i class="fas fa-users" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                <p>No team workers assigned yet. Click "Add Team Worker" to begin.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Updates Tab -->

                <!-- Images Tab -->
                <div id="images" class="tab-content">
                    <div class="report-section">
                        @if($project->status !== 'Completed')
                            <div class="report-title">Upload Documentation</div>
                            <form method="POST" action="{{ route('projects.documents.store', $project->id) }}" enctype="multipart/form-data" style="margin-bottom: 30px;">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-input" placeholder="Enter documentation title (e.g., Daily Activities - Dec 14)" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Attachments <span style="font-size: 12px; color: #6b7280;">(Optional - Files)</span></label>
                                    <div style="padding: 12px; border: 2px dashed var(--gray-400); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" id="dropZone">
                                        <input type="file" name="attachments[]" id="attachmentInput" style="width: 100%; cursor: pointer;" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif,.webp,.zip">
                                        <small style="color: var(--gray-600); display: block; margin-top: 8px;">
                                            <i class="fas fa-cloud-upload-alt"></i> Drag files here or click to upload<br>
                                            Accepted: PDF, DOC, DOCX, XLS, XLSX, Images, ZIP (Max 50MB total)
                                        </small>
                                    </div>
                                    <div id="attachmentPreview" style="margin-top: 12px;"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Documentation
                                </button>
                            </form>
                        @else
                            <div style="padding: 20px; background-color: #f3f4f6; border-radius: 6px; margin-bottom: 30px; border-left: 4px solid #dc2626;">
                                <div style="color: #6b7280; font-size: 14px;">
                                    <i class="fas fa-lock" style="color: #dc2626;"></i> <strong>Project Completed</strong> - Documentation uploads are no longer allowed
                                </div>
                            </div>
                        @endif

                        <div class="report-title">Documentation Gallery</div>

                        @if($project->documents && $project->documents->count() > 0)
                            <!-- Filter Controls -->
                            <div style="display: flex; gap: 8px; margin-bottom: 12px; flex-wrap: wrap; align-items: center;">
                                <span style="font-size: 13px; color: var(--gray-600);">Filter by type:</span>
                                <button type="button" class="btn" style="background: var(--sidebar-bg); color: var(--black-1); padding: 8px 12px; border-radius: 6px;" onclick="filterDocuments('all')">All</button>
                                <button type="button" class="btn" style="background: #dbeafe; color: #1e3a8a; padding: 8px 12px; border-radius: 6px;" onclick="filterDocuments('image')">Images</button>
                                <button type="button" class="btn" style="background: #fee2e2; color: #b91c1c; padding: 8px 12px; border-radius: 6px;" onclick="filterDocuments('pdf')">PDF</button>
                                <button type="button" class="btn" style="background: #e0f2fe; color: #0369a1; padding: 8px 12px; border-radius: 6px;" onclick="filterDocuments('excel')">XLS/XLSX</button>
                                <button type="button" class="btn" style="background: #f3f4f6; color: #374151; padding: 8px 12px; border-radius: 6px;" onclick="filterDocuments('other')">Other</button>
                            </div>

                            <div class="images-grid" id="documentationGrid">
                                @foreach($project->documents as $doc)
                                    @php
                                        $ext = strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                        $mimeType = $doc->mime_type ?? '';
                                        $fileExt = strtoupper($ext);
                                        $docType = $isImage ? 'image' : (in_array($ext, ['pdf']) ? 'pdf' : (in_array($ext, ['xls','xlsx']) ? 'excel' : 'other'));
                                    @endphp
                                    <div class="image-card" data-doc-type="{{ $docType }}">
                                        <div style="height: 200px; background: var(--gray-200); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; border-radius: 6px 6px 0 0;">
                                            @if($isImage)
                                                <img src="{{ asset('storage/' . $doc->file_path) }}" alt="{{ $doc->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                <div style="position: absolute; top: 8px; right: 8px; display: flex; gap: 6px;">
                                                    <button onclick="viewImage('{{ asset('storage/' . $doc->file_path) }}', '{{ $doc->title }}')" style="background: rgba(255,255,255,0.9); border: none; border-radius: 6px; padding: 8px 12px; cursor: pointer; color: #1e40af; font-size: 14px;" title="View Image">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <div style="width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, #e5e7eb, #d1d5db);">
                                                    @if(str_contains($mimeType, 'pdf'))
                                                        <i class="fas fa-file-pdf" style="font-size: 48px; color: #dc2626; margin-bottom: 10px;"></i>
                                                    @elseif(str_contains($mimeType, 'word') || str_contains($doc->file_name, 'docx') || str_contains($doc->file_name, 'doc'))
                                                        <i class="fas fa-file-word" style="font-size: 48px; color: #2563eb; margin-bottom: 10px;"></i>
                                                    @elseif(str_contains($mimeType, 'excel') || str_contains($mimeType, 'spreadsheet') || str_contains($doc->file_name, 'xlsx') || str_contains($doc->file_name, 'xls'))
                                                        <i class="fas fa-file-excel" style="font-size: 48px; color: #1e40af; margin-bottom: 10px;"></i>
                                                    @elseif(str_contains($mimeType, 'zip') || str_contains($doc->file_name, 'zip'))
                                                        <i class="fas fa-file-archive" style="font-size: 48px; color: #9333ea; margin-bottom: 10px;"></i>
                                                    @else
                                                        <i class="fas fa-file" style="font-size: 48px; color: #6b7280; margin-bottom: 10px;"></i>
                                                    @endif
                                                    <span style="color: #374151; font-weight: 600; font-size: 12px;">{{ $fileExt }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="image-info">
                                            <div class="image-name">{{ $doc->title }}</div>
                                            <div class="image-date">{{ $doc->created_at->format('M d, Y H:i') }}</div>
                                            <div style="font-size: 12px; color: var(--gray-600); margin-bottom: 10px;">{{ number_format($doc->file_size / 1024, 2) }} KB • By {{ $doc->uploader?->name ?? 'Unknown' }}</div>
                                            <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                                @if(!$isImage)
                                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" style="background: #1e40af; color: white; border: none; border-radius: 6px; padding: 8px 12px; cursor: pointer; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; flex: 1; justify-content: center;" title="Open Document">
                                                        <i class="fas fa-external-link-alt"></i> Open
                                                    </a>
                                                @endif
                                                <a href="{{ asset('storage/' . $doc->file_path) }}" download style="background: #0969a2; color: white; border: none; border-radius: 6px; padding: 8px 12px; cursor: pointer; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; flex: 1; justify-content: center;" title="Download">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                                <form method="POST" action="{{ route('projects.documents.delete', [$project->id, $doc->id]) }}" style="display: inline; flex: 1;" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background: #dc2626; color: white; border: none; border-radius: 6px; padding: 8px 12px; cursor: pointer; font-size: 13px; width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 4px;" title="Delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="images-grid">
                                <div class="image-card">
                                    <div style="height: 200px; background: linear-gradient(135deg, var(--accent), #1e3a8a); display: flex; align-items: center; justify-content: center; color: white; border-radius: 6px 6px 0 0;">
                                        <i class="fas fa-image fa-3x" style="opacity: 0.3;"></i>
                                    </div>
                                    <div class="image-info">
                                        <div class="image-name">Documentation Gallery</div>
                                        <div class="image-date">No documents uploaded yet</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- QA Inspections Tab (QA Role Only) -->
                @if(auth()->user()->role === 'QA')
                <div id="qa-inspections" class="tab-content">
                    <style>
                        .qa-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
                        .qa-title { font-size: 20px; font-weight: 700; color: var(--black-1); margin: 0; display: flex; align-items: center; gap: 10px; }
                        .qa-actions { display: flex; gap: 10px; flex-wrap: wrap; }
                        .qa-summary { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 28px; }
                        .qa-summary-card { padding: 18px; border: 1px solid var(--gray-300); border-radius: 10px; background: #fff; text-align: center; }
                        .qa-summary-card.pending { border-left: 4px solid #f59e0b; }
                        .qa-summary-card.passed { border-left: 4px solid #10b981; }
                        .qa-summary-card.failed { border-left: 4px solid #ef4444; }
                        .qa-summary-card.recheck { border-left: 4px solid #6366f1; }
                        .qa-summary-value { font-size: 28px; font-weight: 700; color: var(--black-1); }
                        .qa-summary-label { font-size: 13px; color: var(--gray-600); margin-top: 4px; }
                        .qa-table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 16px; }
                        .qa-table th { background: var(--sidebar-bg); padding: 14px 12px; text-align: left; font-weight: 600; color: var(--black-1); border-bottom: 2px solid var(--gray-300); }
                        .qa-table td { padding: 14px 12px; border-bottom: 1px solid var(--gray-300); color: var(--gray-700); vertical-align: middle; }
                        .qa-table tr:hover { background: #fafafa; }
                        .qa-status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
                        .qa-status-badge.pending { background: #fef3c7; color: #92400e; }
                        .qa-status-badge.passed { background: #d1fae5; color: #065f46; }
                        .qa-status-badge.failed { color: #991b1b; }
                        .qa-status-badge.requires_recheck { background: #e0e7ff; color: #3730a3; }
                        .qa-inspect-btn { background: var(--accent); color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; }
                        .qa-inspect-btn:hover { background: #1e3a8a; transform: translateY(-1px); }
                        .qa-bulk-actions { display: none; padding: 16px; background: var(--sidebar-bg); border-radius: 8px; margin-bottom: 20px; align-items: center; gap: 16px; flex-wrap: wrap; }
                        .qa-bulk-actions.show { display: flex; }
                        .qa-rating { display: flex; gap: 4px; }
                        .qa-rating-star { color: #fbbf24; font-size: 14px; }
                        .qa-rating-star.empty { color: #d1d5db; }
                    </style>

                    <div class="qa-header">
                        <h2 class="qa-title">
                            <i class="fas fa-clipboard-check" style="color: var(--accent);"></i>
                            Quality Assurance Inspections
                        </h2>
                        <div class="qa-actions">
                            <button type="button" class="btn btn-primary" onclick="openBulkQAModal()">
                                <i class="fas fa-check-double"></i> Bulk Inspection
                            </button>
                        </div>
                    </div>

                    @php
                        $pendingCount = $project->materials->whereNull('qa_status')->count() + $project->materials->where('qa_status', 'pending')->count();
                        $passedCount = $project->materials->where('qa_status', 'passed')->count();
                        $failedCount = $project->materials->where('qa_status', 'failed')->count();
                        $recheckCount = $project->materials->where('qa_status', 'requires_recheck')->count();
                        $totalItems = $project->materials->count();
                    @endphp

                    <!-- QA Summary Cards -->
                    <div class="qa-summary">
                        <div class="qa-summary-card pending">
                            <div class="qa-summary-value">{{ $pendingCount }}</div>
                            <div class="qa-summary-label">Pending Inspection</div>
                        </div>
                        <div class="qa-summary-card passed">
                            <div class="qa-summary-value">{{ $passedCount }}</div>
                            <div class="qa-summary-label">Passed</div>
                        </div>
                        <div class="qa-summary-card failed">
                            <div class="qa-summary-value">{{ $failedCount }}</div>
                            <div class="qa-summary-label">Failed</div>
                        </div>
                        <div class="qa-summary-card recheck">
                            <div class="qa-summary-value">{{ $recheckCount }}</div>
                            <div class="qa-summary-label">Requires Recheck</div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    @if($totalItems > 0)
                    <div style="margin-bottom: 24px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 14px; font-weight: 600; color: var(--black-1);">Inspection Progress</span>
                            <span style="font-size: 14px; color: var(--gray-600);">{{ $passedCount + $failedCount + $recheckCount }} / {{ $totalItems }} items inspected</span>
                        </div>
                        <div style="width: 100%; height: 12px; background: var(--gray-300); border-radius: 6px; overflow: hidden; display: flex;">
                            @if($passedCount > 0)
                            <div style="width: {{ ($passedCount / $totalItems) * 100 }}%; background: #10b981; height: 100%;"></div>
                            @endif
                            @if($failedCount > 0)
                            <div style="width: {{ ($failedCount / $totalItems) * 100 }}%; background: #ef4444; height: 100%;"></div>
                            @endif
                            @if($recheckCount > 0)
                            <div style="width: {{ ($recheckCount / $totalItems) * 100 }}%; background: #6366f1; height: 100%;"></div>
                            @endif
                        </div>
                        <div style="display: flex; gap: 20px; margin-top: 8px; font-size: 12px;">
                            <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #10b981; border-radius: 2px;"></span> Passed</span>
                            <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #ef4444; border-radius: 2px;"></span> Failed</span>
                            <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #6366f1; border-radius: 2px;"></span> Recheck</span>
                            <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #d1d5db; border-radius: 2px;"></span> Pending</span>
                        </div>
                    </div>
                    @endif

                    <!-- Bulk Actions Bar -->
                    <div id="qaBulkActions" class="qa-bulk-actions">
                        <span id="qaSelectedCount" style="font-weight: 600; color: var(--black-1);">0 items selected</span>
                        <button type="button" class="btn" style="background: #10b981; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;" onclick="bulkQAAction('passed')">
                            <i class="fas fa-check"></i> Mark Passed
                        </button>
                        <button type="button" class="btn" style="background: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;" onclick="bulkQAAction('failed')">
                            <i class="fas fa-times"></i> Mark Failed
                        </button>
                        <button type="button" class="btn" style="background: #6366f1; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;" onclick="bulkQAAction('requires_recheck')">
                            <i class="fas fa-redo"></i> Mark Recheck
                        </button>
                    </div>

                    <!-- QA Items Table -->
                    @if($project->materials->count() > 0)
                    <div style="overflow-x: auto; border: 1px solid var(--gray-300); border-radius: 8px;">
                        <table class="qa-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px; text-align: center;">
                                        <input type="checkbox" id="selectAllQA" onchange="toggleAllQAItems()" style="cursor: pointer; width: 18px; height: 18px;">
                                    </th>
                                    <th style="width: 80px;">Item #</th>
                                    <th>Item Description</th>
                                    <th style="width: 120px; text-align: center;">QA Status</th>
                                    <th style="width: 100px; text-align: center;">Rating</th>
                                    <th style="width: 200px;">Remarks</th>
                                    <th style="width: 140px;">Inspected</th>
                                    <th style="width: 120px; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->materials as $material)
                                <tr data-material-id="{{ $material->id }}">
                                    <td style="text-align: center;">
                                        <input type="checkbox" class="qa-checkbox" data-material-id="{{ $material->id }}" onchange="updateQASelection()" style="cursor: pointer; width: 18px; height: 18px;">
                                    </td>
                                    <td style="font-weight: 600;">{{ $material->item_no ?? '—' }}</td>
                                    <td>
                                        <div style="font-weight: 500;">{{ Str::limit($material->item_description ?? $material->material_name ?? 'Unnamed Item', 60) }}</div>
                                        @if($material->category)
                                        <div style="font-size: 12px; color: var(--gray-600); margin-top: 4px;">{{ $material->category }}</div>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $qaStatus = $material->qa_status ?? 'pending';
                                        @endphp
                                        <span class="qa-status-badge {{ $qaStatus }}">
                                            @if($qaStatus === 'passed')
                                                <i class="fas fa-check-circle"></i> Passed
                                            @elseif($qaStatus === 'failed')
                                                <i class="fas fa-times-circle"></i> Failed
                                            @elseif($qaStatus === 'requires_recheck')
                                                <i class="fas fa-redo"></i> Recheck
                                            @else
                                                <i class="fas fa-clock"></i> Pending
                                            @endif
                                        </span>
                                    </td>
                                    <td style="text-align: center;">
                                        @if($material->qa_rating)
                                        <div class="qa-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star qa-rating-star {{ $i <= $material->qa_rating ? '' : 'empty' }}"></i>
                                            @endfor
                                        </div>
                                        @else
                                        <span style="color: var(--gray-500); font-size: 12px;">Not rated</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($material->qa_remarks)
                                        <div style="font-size: 13px; color: var(--gray-700);">{{ Str::limit($material->qa_remarks, 50) }}</div>
                                        @else
                                        <span style="color: var(--gray-500); font-size: 12px;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($material->qa_inspected_at)
                                        <div style="font-size: 12px; color: var(--gray-700);">
                                            {{ \Carbon\Carbon::parse($material->qa_inspected_at)->format('M d, Y') }}
                                        </div>
                                        <div style="font-size: 11px; color: var(--gray-500);">
                                            by {{ $material->qaInspector?->name ?? 'Unknown' }}
                                        </div>
                                        @else
                                        <span style="color: var(--gray-500); font-size: 12px;">Not inspected</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" class="qa-inspect-btn" onclick="openQAInspectModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Item') }}', '{{ $material->qa_status ?? 'pending' }}', {{ $material->qa_rating ?? 0 }}, '{{ addslashes($material->qa_remarks ?? '') }}')">
                                            <i class="fas fa-clipboard-check"></i> Inspect
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div style="text-align: center; padding: 60px 20px; background: var(--sidebar-bg); border-radius: 12px;">
                        <i class="fas fa-clipboard-list" style="font-size: 48px; color: var(--gray-400); margin-bottom: 16px;"></i>
                        <h3 style="color: var(--gray-700); margin-bottom: 8px;">No BOQ Items to Inspect</h3>
                        <p style="color: var(--gray-600);">BOQ items need to be added before QA inspection can begin.</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Reports Tab -->
                <div id="report" class="tab-content">
                    <!-- Reports Page - Formal, Printable System Outputs -->
                    <style>
                        .report-container { background: #fff; padding: 20px 24px 20px 24px; margin: 0 -24px; }
                        .report-nav { display: flex; flex-wrap: wrap; gap: 10px; margin: 0 0 28px 0; margin-left: -24px; margin-right: -24px; padding: 20px 24px 20px 24px; border-bottom: 1px solid var(--gray-300); }
                        .report-nav-btn { padding: 12px 20px; border: 1px solid var(--gray-300); background: #fff; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500; color: var(--gray-700); transition: all 0.2s ease; display: flex; align-items: center; gap: 8px; }
                        .report-nav-btn:hover { background: var(--sidebar-bg); border-color: var(--accent); }
                        .report-nav-btn.active { background: var(--accent); color: #fff; border-color: var(--accent); }
                        .report-nav-btn i { font-size: 14px; }
                        .report-panel { display: none; padding: 8px 0; margin: 0 -24px; padding-left: 24px; padding-right: 24px; }
                        .report-panel.active { display: block; }
                        .report-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
                        .report-header-title { font-size: 20px; font-weight: 700; color: var(--black-1); margin: 0; }
                        .report-header-subtitle { font-size: 13px; color: var(--gray-600); margin-top: 6px; }
                        .report-actions { display: flex; gap: 10px; flex-wrap: wrap; }
                        .report-action-btn { padding: 10px 16px; border: 1px solid var(--gray-300); background: #fff; border-radius: 6px; cursor: pointer; font-size: 13px; font-weight: 500; color: var(--gray-700); transition: all 0.2s ease; display: flex; align-items: center; gap: 8px; }
                        .report-action-btn:hover { background: var(--sidebar-bg); }
                        .report-action-btn.pdf { color: #dc2626; border-color: #fecaca; }
                        .report-action-btn.pdf:hover { background: #fef2f2; }
                        .report-action-btn.excel { color: #166534; border-color: #bbf7d0; }
                        .report-action-btn.excel:hover { background: #f0fdf4; }
                        .report-action-btn.print { color: var(--accent); border-color: #bfdbfe; }
                        .report-action-btn.print:hover { background: #eff6ff; }
                        .report-table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 8px; }
                        .report-table th { background: var(--sidebar-bg); padding: 14px 16px; text-align: left; font-weight: 600; color: var(--black-1); border-bottom: 2px solid var(--gray-300); }
                        .report-table td { padding: 14px 16px; border-bottom: 1px solid var(--gray-300); color: var(--gray-700); line-height: 1.5; }
                        .report-table tr:hover { background: #fafafa; }
                        .report-table .text-right { text-align: right; }
                        .report-table .text-center { text-align: center; }
                        .report-footer { margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--gray-300); font-size: 13px; color: var(--gray-500); line-height: 1.8; }
                        .report-summary { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 28px; }
                        .report-summary-item { padding: 18px; border: 1px solid var(--gray-300); border-radius: 8px; background: #fff; }
                        .report-summary-label { font-size: 15px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.03em; margin-bottom: 6px; }
                        .report-summary-value { font-size: 18px; font-weight: 700; color: var(--black-1); }
                        .report-details-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px 32px; margin-top: 24px; margin-bottom: 32px; }
                        .report-detail-item { display: flex; flex-direction: column; }
                        .report-detail-label { font-size: 15px; color: var(--gray-600); text-transform: uppercase; letter-spacing: 0.03em; margin-bottom: 8px; font-weight: 600; }
                        .report-detail-value { font-size: 15px; color: var(--black-1); line-height: 1.6; padding-bottom: 12px; border-bottom: 1px solid var(--gray-200); }
                        .report-notice { padding: 16px 20px; background: #fffbeb; border: 1px solid #fcd34d; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; }
                        .report-notice i { color: #d97706; margin-top: 2px; font-size: 16px; }
                        .report-notice-text { font-size: 14px; color: #92400e; line-height: 1.5; }
                        .report-locked { padding: 50px 40px; text-align: center; background: var(--sidebar-bg); border-radius: 10px; }
                        .report-locked i { font-size: 52px; color: var(--gray-400); margin-bottom: 16px; }
                        .report-locked-title { font-size: 18px; font-weight: 600; color: var(--gray-700); margin-bottom: 10px; }
                        .report-locked-text { font-size: 14px; color: var(--gray-500); line-height: 1.6; }
                        @media print {
                            .report-nav, .report-actions, .sidebar, .header, .tabs { display: none !important; }
                            .report-panel { display: block !important; }
                            .main-content { margin: 0 !important; }
                            .report-table { font-size: 12px; }
                        }
                    </style>

                    <div class="report-container">
                        <!-- Report Navigation -->
                        <div class="report-nav">
                            <button class="report-nav-btn active" onclick="switchReport('status')">
                                <i class="fas fa-chart-line"></i> Project Status
                            </button>
                            <button class="report-nav-btn" onclick="switchReport('accomplishment')">
                                <i class="fas fa-check-double"></i> Accomplishment
                            </button>
                            <button class="report-nav-btn" onclick="switchReport('boq')">
                                <i class="fas fa-file-invoice-dollar"></i> BOQ / Cost
                            </button>
                            <button class="report-nav-btn" onclick="switchReport('timeline')">
                                <i class="fas fa-calendar-alt"></i> Timeline / Schedule
                            </button>
                            <button class="report-nav-btn" onclick="switchReport('labor')">
                                <i class="fas fa-users"></i> Team Workers / Labor
                            </button>
                            <button class="report-nav-btn" onclick="switchReport('activity')">
                                <i class="fas fa-history"></i> Activity Log
                            </button>
                            @if(in_array(auth()->user()->role, ['OWNER', 'PM', 'FM']))
                            <button class="report-nav-btn" onclick="switchReport('qa-failed')">
                                <i class="fas fa-exclamation-triangle"></i> QA Failed Items
                            </button>
                            <button class="report-nav-btn" onclick="switchReport('replacements')">
                                <i class="fas fa-exchange-alt"></i> Replacement Requests
                                @php
                                    $pendingReplacementsCount = $project->materials->where('replacement_requested', true)->where('replacement_status', 'pending')->count();
                                @endphp
                                @if($pendingReplacementsCount > 0)
                                <span style="background: #ef4444; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 6px;">{{ $pendingReplacementsCount }}</span>
                                @endif
                            </button>
                            @endif
                        </div>

                        <!-- 1. Project Status Report -->
                        <div id="report-status" class="report-panel active">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Project Status Report</h3>
                                    <p class="report-header-subtitle">Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                                <div class="report-actions">
                                    <button class="report-action-btn print" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <a href="{{ route('pdf.project.download', $project->id) }}" class="report-action-btn pdf">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                    <a href="{{ route('csv.project.download', $project->id) }}" class="report-action-btn excel">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </a>
                                </div>
                            </div>

                            @php
                                $startDate = $project->date_started ? \Carbon\Carbon::parse($project->date_started) : null;
                                $targetDate = $project->target_timeline ? \Carbon\Carbon::parse($project->target_timeline) : null;
                                $endDate = $project->date_ended ? \Carbon\Carbon::parse($project->date_ended) : null;
                                $isDelayed = $targetDate && now()->gt($targetDate) && $project->status !== 'Completed';
                                
                                // Calculate progress (based on approved BOQ items - same as Overview)
                                $reportMaterials = $project->materials ?? collect();
                                $totalItems = $reportMaterials->count();
                                $approvedItems = $reportMaterials->filter(function($m) { return strtolower($m->status ?? 'pending') === 'approved'; })->count();
                                $progress = $totalItems > 0 ? round(($approvedItems / $totalItems) * 100, 1) : 0;
                            @endphp

                            <div class="report-summary">
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Current Status</div>
                                    <div class="report-summary-value" style="color: {{ $project->status === 'Completed' ? '#166534' : ($project->status === 'Ongoing' ? '#0369a1' : '#374151') }};">{{ $project->status }}</div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Progress</div>
                                    <div class="report-summary-value">{{ $progress }}%</div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Delay Status</div>
                                    <div class="report-summary-value" style="color: {{ $isDelayed ? '#dc2626' : '#166534' }};">{{ $isDelayed ? 'Yes' : 'No' }}</div>
                                </div>
                            </div>

                            <div class="report-details-grid">
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Project Name</div>
                                    <div class="report-detail-value">{{ $project->project_name ?? $project->project_code }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Project Code</div>
                                    <div class="report-detail-value">{{ $project->project_code }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Client</div>
                                    <div class="report-detail-value">{{ $project->client?->company_name ?? trim($project->client_first_name . ' ' . $project->client_last_name) ?: 'Not specified' }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Project Manager</div>
                                    <div class="report-detail-value">{{ $project->assignedPM?->name ?? 'Unassigned' }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Start Date</div>
                                    <div class="report-detail-value">{{ $startDate ? $startDate->format('F d, Y') : 'Not set' }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Target Date</div>
                                    <div class="report-detail-value">{{ $targetDate ? $targetDate->format('F d, Y') : 'Not set' }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Current Status</div>
                                    <div class="report-detail-value">{{ $project->status }}</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Progress</div>
                                    <div class="report-detail-value">{{ $progress }}% ({{ $approvedItems }} of {{ $totalItems }} BOQ items approved)</div>
                                </div>
                                <div class="report-detail-item">
                                    <div class="report-detail-label">Delay</div>
                                    <div class="report-detail-value" style="color: {{ $isDelayed ? '#dc2626' : '#166534' }};">{{ $isDelayed ? 'Yes - Project is behind schedule' : 'No - On track' }}</div>
                                </div>
                            </div>

                            @php
                                $failedItems = $reportMaterials->filter(fn($m) => strtolower($m->status ?? '') === 'fail');
                            @endphp
                            @if($failedItems->count() > 0)
                            <div style="margin-top: 32px;">
                                <h4 style="font-size: 16px; font-weight: 600; color: #dc2626; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-exclamation-triangle"></i> Failed Items ({{ $failedItems->count() }})
                                </h4>
                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    @foreach($failedItems as $failedItem)
                                    <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 16px;">
                                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                            <div style="font-weight: 600; color: #991b1b;">{{ $failedItem->item_description ?? 'N/A' }}</div>
                                            <span style="background: #dc2626; color: white; padding: 2px 10px; border-radius: 999px; font-size: 11px; font-weight: 600;">FAILED</span>
                                        </div>
                                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 8px;">Item No: {{ $failedItem->item_no ?? 'N/A' }} | Qty: {{ $failedItem->quantity ?? 0 }} {{ $failedItem->unit ?? '' }}</div>
                                        @php
                                            $failureReason = null;
                                            $failureNotes = null;
                                            if ($failedItem->notes) {
                                                if (preg_match('/\[FAILED.*?\] Reason: ([^.]+)\./', $failedItem->notes, $matches)) {
                                                    $failureReason = trim($matches[1]);
                                                }
                                                if (preg_match('/Notes: (.+?)(?:\[|$)/s', $failedItem->notes, $notesMatch)) {
                                                    $failureNotes = trim($notesMatch[1]);
                                                }
                                            }
                                        @endphp
                                        @if($failureReason)
                                        <div style="background: white; padding: 12px; border-radius: 6px; margin-top: 8px;">
                                            <div style="font-size: 12px; color: #dc2626; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Reason for Failure</div>
                                            <div style="font-size: 14px; color: #1f2937;">{{ $failureReason }}</div>
                                            @if($failureNotes)
                                            <div style="font-size: 12px; color: #6b7280; margin-top: 8px; padding-top: 8px; border-top: 1px solid #e5e7eb;"><strong>Additional Notes:</strong> {{ $failureNotes }}</div>
                                            @endif
                                        </div>
                                        @else
                                        <div style="font-size: 13px; color: #9ca3af; font-style: italic;">No failure reason recorded</div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="report-footer">
                                <strong>Prepared for:</strong> Owner, Project Manager<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- 2. Accomplishment Report -->
                        <div id="report-accomplishment" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Accomplishment Report</h3>
                                    <p class="report-header-subtitle">Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                                @if($project->status === 'Completed')
                                <div class="report-actions">
                                    <button class="report-action-btn print" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <a href="{{ route('pdf.project.download', $project->id) }}" class="report-action-btn pdf">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                    <a href="{{ route('csv.project.download', $project->id) }}" class="report-action-btn excel">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </a>
                                </div>
                                @endif
                            </div>

                            @if($project->status !== 'Completed')
                                <div class="report-locked">
                                    <i class="fas fa-lock"></i>
                                    <div class="report-locked-title">Report Not Available</div>
                                    <div class="report-locked-text">The Accomplishment Report is only available after project completion.<br>Current Status: <strong>{{ $project->status }}</strong></div>
                                </div>
                            @else
                                <div class="report-notice">
                                    <i class="fas fa-check-circle" style="color: #166534;"></i>
                                    <div class="report-notice-text" style="color: #166534;">Project completed on {{ $project->date_ended ? \Carbon\Carbon::parse($project->date_ended)->format('F d, Y') : 'N/A' }}</div>
                                </div>

                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%;">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Project Name</strong></td>
                                            <td>{{ $project->project_name ?? $project->project_code }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4 style="margin: 24px 0 12px; font-size: 15px; color: var(--black-1);">Tasks Completed</h4>
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Date Completed</th>
                                            <th>Remarks</th>
                                            <th>Updated By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($project->updates->where('status', 'Completed') as $update)
                                            <tr>
                                                <td>{{ $update->title }}</td>
                                                <td>{{ $update->updated_at->format('M d, Y') }}</td>
                                                <td>{{ $update->description ?? '-' }}</td>
                                                <td>{{ $update->updatedBy?->name ?? 'System' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center; color: var(--gray-500);">No completed tasks recorded</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="report-footer">
                                    <strong>Approved By:</strong> {{ $project->assignedPM?->name ?? 'Project Manager' }}<br>
                                    <strong>Completion Date:</strong> {{ $project->date_ended ? \Carbon\Carbon::parse($project->date_ended)->format('F d, Y') : 'N/A' }}
                                </div>
                            @endif
                        </div>

                        <!-- 3. BOQ / Cost Report -->
                        <div id="report-boq" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Bill of Quantities / Cost Report</h3>
                                    <p class="report-header-subtitle">Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                                <div class="report-actions">
                                    <button class="report-action-btn print" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <a href="{{ route('pdf.boq.download', $project->id) }}" class="report-action-btn pdf">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                    <a href="{{ route('csv.project.download', $project->id) }}" class="report-action-btn excel">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </a>
                                </div>
                            </div>

                            @php
                                $boqItems = $project->materials ?? collect();
                                $reportTotalMaterial = 0;
                                $reportTotalLabor = 0;
                                $reportGrandTotal = 0;
                                $boqApprovedCount = $boqItems->filter(fn($m) => strtolower($m->status ?? 'pending') === 'approved')->count();
                                $boqFailedCount = $boqItems->filter(fn($m) => strtolower($m->status ?? '') === 'fail')->count();
                                $boqPendingCount = $boqItems->count() - $boqApprovedCount - $boqFailedCount;
                            @endphp

                            <div class="report-summary">
                                @php
                                    foreach($boqItems as $item) {
                                        $matCost = $item->material_cost ?? 0;
                                        $labCost = $item->labor_cost ?? 0;
                                        $qty = $item->quantity ?? 0;
                                        $reportTotalMaterial += $matCost * $qty;
                                        $reportTotalLabor += $labCost * $qty;
                                        $reportGrandTotal += ($matCost + $labCost) * $qty;
                                    }
                                    $reportVAT = $reportGrandTotal * 0.12;
                                    $reportGrandTotalWithVAT = $reportGrandTotal + $reportVAT;
                                @endphp
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Total Items</div>
                                    <div class="report-summary-value">{{ $boqItems->count() }}</div>
                                    <div style="font-size: 12px; margin-top: 6px; display: flex; gap: 12px;">
                                        <span style="color: #16a34a;"><i class="fas fa-check-circle"></i> {{ $boqApprovedCount }} Approved</span>
                                        @if($boqFailedCount > 0)
                                        <span style="color: #dc2626;"><i class="fas fa-times-circle"></i> {{ $boqFailedCount }} Failed</span>
                                        @endif
                                        @if($boqPendingCount > 0)
                                        <span style="color: #6b7280;"><i class="fas fa-clock"></i> {{ $boqPendingCount }} Pending</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Material Cost</div>
                                    <div class="report-summary-value">₱{{ number_format($reportTotalMaterial, 2) }}</div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Labor Cost</div>
                                    <div class="report-summary-value">₱{{ number_format($reportTotalLabor, 2) }}</div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Grand Total (w/ 12% VAT)</div>
                                    <div class="report-summary-value" style="color: var(--accent);">₱{{ number_format($reportGrandTotalWithVAT, 2) }}</div>
                                </div>
                            </div>

                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">Item No.</th>
                                        <th>Item Description</th>
                                        <th class="text-center" style="width: 80px;">Status</th>
                                        <th class="text-center" style="width: 60px;">Qty</th>
                                        <th class="text-center" style="width: 60px;">Unit</th>
                                        <th class="text-right" style="width: 100px;">Material</th>
                                        <th class="text-right" style="width: 100px;">Labor</th>
                                        <th class="text-right" style="width: 100px;">Unit Rate</th>
                                        <th class="text-right" style="width: 110px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($boqItems as $index => $item)
                                        @php
                                            $itemMatCost = $item->material_cost ?? 0;
                                            $itemLabCost = $item->labor_cost ?? 0;
                                            $itemUnitRate = $itemMatCost + $itemLabCost;
                                            $itemQty = $item->quantity ?? 0;
                                            $itemTotal = $itemUnitRate * $itemQty;
                                            $itemStatus = strtolower($item->status ?? 'pending');
                                            $statusColor = match($itemStatus) {
                                                'approved' => '#16a34a',
                                                'fail', 'failed' => '#dc2626',
                                                default => '#6b7280'
                                            };
                                            $statusBg = match($itemStatus) {
                                                'approved' => '#dcfce7',
                                                'fail', 'failed' => '#fef2f2',
                                                default => '#f3f4f6'
                                            };
                                        @endphp
                                        <tr style="{{ $itemStatus === 'fail' || $itemStatus === 'failed' ? 'background: #fef2f2;' : '' }}">
                                            <td class="text-center">{{ $item->item_no ?? ($index + 1) }}</td>
                                            <td>
                                                <div style="white-space: pre-wrap; line-height: 1.5;">{!! nl2br(e($item->item_description)) !!}</div>
                                                @if($item->category)
                                                    <div style="font-size: 12px; color: var(--gray-500); margin-top: 6px;"><strong>Category:</strong> {{ $item->category }}</div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span style="display: inline-block; font-size: 13px; font-weight: 500; color: {{ $statusColor }};">{{ ucfirst($itemStatus === 'fail' ? 'Failed' : $itemStatus) }}</span>
                                            </td>
                                            <td class="text-center">{{ $itemQty }}</td>
                                            <td class="text-center">{{ $item->unit ?? '—' }}</td>
                                            <td class="text-right">₱{{ number_format($itemMatCost, 2) }}</td>
                                            <td class="text-right">₱{{ number_format($itemLabCost, 2) }}</td>
                                            <td class="text-right">₱{{ number_format($itemUnitRate, 2) }}</td>
                                            <td class="text-right" style="font-weight: 600;">₱{{ number_format($itemTotal, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" style="text-align: center; color: var(--gray-500);">No BOQ items recorded</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr style="background: var(--sidebar-bg); font-weight: 600;">
                                        <td colspan="5" class="text-right">SUBTOTAL:</td>
                                        <td class="text-right">₱{{ number_format($reportTotalMaterial, 2) }}</td>
                                        <td class="text-right">₱{{ number_format($reportTotalLabor, 2) }}</td>
                                        <td class="text-right"></td>
                                        <td class="text-right">₱{{ number_format($reportGrandTotal, 2) }}</td>
                                    </tr>
                                    <tr style="font-weight: 600;">
                                        <td colspan="8" class="text-right">VAT 12%:</td>
                                        <td class="text-right">₱{{ number_format($reportVAT, 2) }}</td>
                                    </tr>
                                    <tr style="background: var(--sidebar-bg); font-weight: 700; font-size: 15px;">
                                        <td colspan="8" class="text-right">Grand Total w/ VAT:</td>
                                        <td class="text-right" style="color: var(--accent);">₱{{ number_format($reportGrandTotalWithVAT, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            @php
                                $boqFailedItems = $boqItems->filter(fn($m) => strtolower($m->status ?? '') === 'fail');
                            @endphp
                            @if($boqFailedItems->count() > 0)
                            <div style="margin-top: 32px;">
                                <h4 style="font-size: 16px; font-weight: 600; color: #dc2626; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-exclamation-triangle"></i> Failed Items Details ({{ $boqFailedItems->count() }})
                                </h4>
                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    @foreach($boqFailedItems as $boqFailedItem)
                                    <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 16px;">
                                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                            <div style="font-weight: 600; color: #991b1b;">{{ $boqFailedItem->item_description ?? 'N/A' }}</div>
                                            <span style="background: #dc2626; color: white; padding: 2px 10px; border-radius: 999px; font-size: 11px; font-weight: 600;">FAILED</span>
                                        </div>
                                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 8px;">
                                            Item No: {{ $boqFailedItem->item_no ?? 'N/A' }} | 
                                            Qty: {{ $boqFailedItem->quantity ?? 0 }} {{ $boqFailedItem->unit ?? '' }} |
                                            Value: ₱{{ number_format((($boqFailedItem->material_cost ?? 0) + ($boqFailedItem->labor_cost ?? 0)) * ($boqFailedItem->quantity ?? 0), 2) }}
                                        </div>
                                        @php
                                            $boqFailureReason = null;
                                            $boqFailureNotes = null;
                                            if ($boqFailedItem->notes) {
                                                if (preg_match('/\\[FAILED.*?\\] Reason: ([^.]+)\\./', $boqFailedItem->notes, $boqMatches)) {
                                                    $boqFailureReason = trim($boqMatches[1]);
                                                }
                                                if (preg_match('/Notes: (.+?)(?:\\[|$)/s', $boqFailedItem->notes, $boqNotesMatch)) {
                                                    $boqFailureNotes = trim($boqNotesMatch[1]);
                                                }
                                            }
                                        @endphp
                                        @if($boqFailureReason)
                                        <div style="background: white; padding: 12px; border-radius: 6px; margin-top: 8px;">
                                            <div style="font-size: 12px; color: #dc2626; text-transform: uppercase; font-weight: 600; margin-bottom: 4px;">Reason for Failure</div>
                                            <div style="font-size: 14px; color: #1f2937;">{{ $boqFailureReason }}</div>
                                            @if($boqFailureNotes)
                                            <div style="font-size: 12px; color: #6b7280; margin-top: 8px; padding-top: 8px; border-top: 1px solid #e5e7eb;"><strong>Additional Notes:</strong> {{ $boqFailureNotes }}</div>
                                            @endif
                                        </div>
                                        @else
                                        <div style="font-size: 13px; color: #9ca3af; font-style: italic;">No failure reason recorded</div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="report-footer">
                                <strong>Prepared for:</strong> Finance, Admin<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- 4. Timeline / Schedule Report -->
                        <div id="report-timeline" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Timeline / Schedule Report</h3>
                                    <p class="report-header-subtitle">Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                                <div class="report-actions">
                                    <button class="report-action-btn print" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <a href="{{ route('pdf.project.download', $project->id) }}" class="report-action-btn pdf">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                </div>
                            </div>

                            @php
                                $plannedStart = $project->date_started ? \Carbon\Carbon::parse($project->date_started) : null;
                                $plannedEnd = $project->target_timeline ? \Carbon\Carbon::parse($project->target_timeline) : null;
                                $actualEnd = $project->date_ended ? \Carbon\Carbon::parse($project->date_ended) : null;
                                
                                $varianceDays = 0;
                                if ($plannedEnd && $actualEnd) {
                                    $varianceDays = $plannedEnd->diffInDays($actualEnd, false);
                                } elseif ($plannedEnd && $project->status !== 'Completed') {
                                    $varianceDays = $plannedEnd->diffInDays(now(), false);
                                }
                            @endphp

                            <div class="report-summary">
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Planned Duration</div>
                                    <div class="report-summary-value">{{ $plannedStart && $plannedEnd ? $plannedStart->diffInDays($plannedEnd) : '-' }} days</div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Actual Duration</div>
                                    <div class="report-summary-value">{{ $plannedStart && $actualEnd ? $plannedStart->diffInDays($actualEnd) : ($plannedStart ? $plannedStart->diffInDays(now()) : '-') }} days</div>
                                </div>
                                <div class="report-summary-item">
                                    <div class="report-summary-label">Variance</div>
                                    <div class="report-summary-value" style="color: {{ $varianceDays > 0 ? '#dc2626' : '#166534' }};">
                                        {{ $varianceDays > 0 ? '+' : '' }}{{ $varianceDays }} days
                                    </div>
                                </div>
                            </div>

                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <th style="width: 35%;">Milestone</th>
                                        <th>Planned Date</th>
                                        <th>Actual Date</th>
                                        <th>Variance (Days)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Project Start</strong></td>
                                        <td>{{ $plannedStart ? $plannedStart->format('M d, Y') : 'Not set' }}</td>
                                        <td>{{ $plannedStart ? $plannedStart->format('M d, Y') : '-' }}</td>
                                        <td style="color: #166534;">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Project Completion</strong></td>
                                        <td>{{ $plannedEnd ? $plannedEnd->format('M d, Y') : 'Not set' }}</td>
                                        <td>{{ $actualEnd ? $actualEnd->format('M d, Y') : ($project->status === 'Completed' ? '-' : 'In Progress') }}</td>
                                        <td style="color: {{ $varianceDays > 0 ? '#dc2626' : '#166534' }};">
                                            {{ $varianceDays > 0 ? '+' : '' }}{{ $varianceDays }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            @if($varianceDays > 0)
                                <div class="report-notice" style="margin-top: 20px;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="report-notice-text">
                                        <strong>Delay Analysis:</strong> This project is {{ abs($varianceDays) }} day(s) behind the planned schedule.
                                    </div>
                                </div>
                            @endif

                            <div class="report-footer">
                                <strong>Used for:</strong> Delay Analysis<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- 5. Team Workers / Labor Report -->
                        <div id="report-labor" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Team Workers / Labor Report</h3>
                                    <p class="report-header-subtitle">Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                                <div class="report-actions">
                                    <button class="report-action-btn print" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <a href="{{ route('pdf.project.download', $project->id) }}" class="report-action-btn pdf">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                    <a href="{{ route('csv.project.download', $project->id) }}" class="report-action-btn excel">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </a>
                                </div>
                            </div>

                            @php
                                $laborReportTotal = 0;
                                $dateFrom = '2025-12-01';
                                $dateTo = '2025-12-31';
                            @endphp

                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <th>Worker Name</th>
                                        <th>Role</th>
                                        <th class="text-center">Work Days</th>
                                        <th class="text-right">Total Hours</th>
                                        <th class="text-right">Hourly Rate</th>
                                        <th class="text-right">Labor Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($project->assignedPM)
                                        @php
                                            $pmAttRecords = \App\Models\EmployeeAttendance::where('employee_id', $project->assignedPM->id)
                                                ->whereBetween('date', [$dateFrom, $dateTo])
                                                ->whereNotNull('punch_in_time')
                                                ->whereNotNull('punch_out_time')
                                                ->get();
                                            $pmDays = $pmAttRecords->count();
                                            $pmHours = $pmAttRecords->sum(fn($a) => $a->getHoursWorked() ?? 0);
                                            $pmPosRate = \App\Models\PositionDailyRate::where('position', 'Project Manager')->first();
                                            $pmDaily = $pmPosRate ? $pmPosRate->daily_rate : 700.00;
                                            $pmHourly = \App\Models\EmployeeAttendance::calculateHourlyRate($pmDaily);
                                            $pmLabor = 0;
                                            foreach($pmAttRecords as $att) { $pmLabor += $att->calculateLaborCost($pmDaily); }
                                            $laborReportTotal += $pmLabor;
                                        @endphp
                                        <tr>
                                            <td>{{ $project->assignedPM->name }}</td>
                                            <td>Project Manager</td>
                                            <td class="text-center">{{ $pmDays }}</td>
                                            <td class="text-right">{{ number_format($pmHours, 2) }} hrs</td>
                                            <td class="text-right">₱{{ number_format($pmHourly, 2) }}/hr</td>
                                            <td class="text-right">₱{{ number_format($pmLabor, 2) }}</td>
                                        </tr>
                                    @endif
                                    @forelse($project->employees as $emp)
                                        @php
                                            $empAttRecords = \App\Models\EmployeeAttendance::where('employee_id', $emp->id)
                                                ->whereBetween('date', [$dateFrom, $dateTo])
                                                ->whereNotNull('punch_in_time')
                                                ->whereNotNull('punch_out_time')
                                                ->get();
                                            $empDays = $empAttRecords->count();
                                            $empHours = $empAttRecords->sum(fn($a) => $a->getHoursWorked() ?? 0);
                                            $empPosition = $emp->position ?? 'Construction Worker';
                                            $empPosRate = \App\Models\PositionDailyRate::where('position', $empPosition)->first();
                                            $empDaily = $empPosRate ? $empPosRate->daily_rate : 700.00;
                                            $empHourly = \App\Models\EmployeeAttendance::calculateHourlyRate($empDaily);
                                            $empLabor = 0;
                                            foreach($empAttRecords as $att) { $empLabor += $att->calculateLaborCost($empDaily); }
                                            $laborReportTotal += $empLabor;
                                        @endphp
                                        <tr>
                                            <td>{{ $emp->full_name ?? ($emp->f_name . ' ' . $emp->l_name) }}</td>
                                            <td>{{ $empPosition }}</td>
                                            <td class="text-center">{{ $empDays }}</td>
                                            <td class="text-right">{{ number_format($empHours, 2) }} hrs</td>
                                            <td class="text-right">₱{{ number_format($empHourly, 2) }}/hr</td>
                                            <td class="text-right">₱{{ number_format($empLabor, 2) }}</td>
                                        </tr>
                                    @empty
                                        @if(!$project->assignedPM)
                                            <tr>
                                                <td colspan="6" style="text-align: center; color: var(--gray-500);">No team workers assigned</td>
                                            </tr>
                                        @endif
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr style="background: var(--sidebar-bg); font-weight: 700;">
                                        <td colspan="5" class="text-right">Total Labor Cost:</td>
                                        <td class="text-right">₱{{ number_format($laborReportTotal, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="report-footer">
                                <strong>Report Period:</strong> {{ \Carbon\Carbon::parse($dateFrom)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M d, Y') }}<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- 6. Activity / Transaction Report -->
                        <div id="report-activity" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Activity / Transaction Report</h3>
                                    <p class="report-header-subtitle">Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                                <div class="report-actions">
                                    <button class="report-action-btn print" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                    <a href="{{ route('pdf.project.download', $project->id) }}" class="report-action-btn pdf">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                </div>
                            </div>

                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <th style="width: 18%;">Date & Time</th>
                                        <th style="width: 15%;">User</th>
                                        <th style="width: 25%;">Action Performed</th>
                                        <th style="width: 15%;">Affected Module</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $activities = collect();
                                        
                                        // Add project updates as activities
                                        if ($project->updates) {
                                            foreach ($project->updates as $update) {
                                                $activities->push([
                                                    'date' => $update->created_at,
                                                    'user' => $update->updatedBy?->name ?? 'System',
                                                    'action' => 'Task ' . ($update->status === 'Completed' ? 'completed' : 'updated') . ': ' . $update->title,
                                                    'module' => 'Tasks',
                                                    'remarks' => $update->description ?? '-'
                                                ]);
                                            }
                                        }
                                        
                                        // Add project creation
                                        $activities->push([
                                            'date' => $project->created_at,
                                            'user' => 'System',
                                            'action' => 'Project created',
                                            'module' => 'Project',
                                            'remarks' => 'Initial project setup'
                                        ]);
                                        
                                        // Sort by date descending
                                        $activities = $activities->sortByDesc('date')->take(50);
                                    @endphp
                                    
                                    @forelse($activities as $activity)
                                        <tr>
                                            <td>{{ $activity['date']->format('M d, Y h:i A') }}</td>
                                            <td>{{ $activity['user'] }}</td>
                                            <td>{{ $activity['action'] }}</td>
                                            <td>{{ $activity['module'] }}</td>
                                            <td>{{ Str::limit($activity['remarks'], 50) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center; color: var(--gray-500);">No activity records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="report-footer">
                                <strong>Note:</strong> This report shows human-readable activity logs. Last 50 entries displayed.<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- 7. QA Failed Items Report (PM/FM/OWNER Only) -->
                        @if(in_array(auth()->user()->role, ['OWNER', 'PM', 'FM']))
                        <div id="report-qa-failed" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">QA Failed Items Report</h3>
                                    <p class="report-header-subtitle">Materials requiring replacement • Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>

                            @php
                                $failedMaterials = $project->materials->where('qa_status', 'failed');
                                $needsReplacementMaterials = $project->materials->where('needs_replacement', true);
                            @endphp

                            <!-- Summary Stats -->
                            <div class="report-summary" style="margin-bottom: 24px;">
                                <div class="report-summary-item" style="border-left: 4px solid #ef4444;">
                                    <div class="report-summary-label">Failed Items</div>
                                    <div class="report-summary-value" style="color: #ef4444;">{{ $failedMaterials->count() }}</div>
                                </div>
                                <div class="report-summary-item" style="border-left: 4px solid #f59e0b;">
                                    <div class="report-summary-label">Needs Replacement</div>
                                    <div class="report-summary-value" style="color: #f59e0b;">{{ $needsReplacementMaterials->count() }}</div>
                                </div>
                                <div class="report-summary-item" style="border-left: 4px solid #10b981;">
                                    <div class="report-summary-label">Passed Items</div>
                                    <div class="report-summary-value" style="color: #10b981;">{{ $project->materials->where('qa_status', 'passed')->count() }}</div>
                                </div>
                            </div>

                            @if($failedMaterials->count() > 0 || $needsReplacementMaterials->count() > 0)
                            <!-- Failed Items Table -->
                            <div style="margin-bottom: 24px;">
                                <h4 style="font-size: 16px; font-weight: 600; color: var(--black-1); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i>
                                    Failed Materials Requiring Replacement
                                </h4>
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Item #</th>
                                            <th>Material Description</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Failure Reason</th>
                                            <th>QA Remarks</th>
                                            <th>Inspected By</th>
                                            <th>Inspection Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($failedMaterials as $material)
                                        <tr style="background: #fef2f2;">
                                            <td style="font-weight: 600;">{{ $material->item_no ?? '—' }}</td>
                                            <td>{{ $material->item_description ?? $material->material_name ?? 'Unnamed' }}</td>
                                            <td>{{ $material->category ?? '—' }}</td>
                                            <td class="text-center">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</td>
                                            <td>
                                                <span style="color: #991b1b; padding: 4px 10px; border-radius: 12px; font-size: 14px; font-weight: 600;">
                                                    {{ $material->failure_reason ?? 'Not specified' }}
                                                </span>
                                            </td>
                                            <td style="max-width: 200px;">{{ $material->qa_remarks ?? '—' }}</td>
                                            <td>{{ $material->qaInspector->name ?? 'Unknown' }}</td>
                                            <td>{{ $material->qa_inspected_at ? $material->qa_inspected_at->format('M d, Y') : '—' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" style="text-align: center; color: var(--gray-500); padding: 30px;">
                                                <i class="fas fa-check-circle" style="font-size: 24px; color: #10b981; margin-bottom: 8px; display: block;"></i>
                                                No failed materials
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div style="text-align: center; padding: 60px 20px; background: #f0fdf4; border-radius: 12px; border: 1px solid #86efac;">
                                <i class="fas fa-check-circle" style="font-size: 48px; color: #10b981; margin-bottom: 16px;"></i>
                                <h3 style="color: #065f46; margin-bottom: 8px;">All Materials Passed QA</h3>
                                <p style="color: #047857;">No failed items requiring replacement in this project.</p>
                            </div>
                            @endif

                            <div class="report-footer">
                                <strong>Important:</strong> Failed materials should be coordinated with suppliers for replacement or refund.<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>

                        <!-- 8. Replacement Requests Report (PM/FM/OWNER Only) -->
                        <div id="report-replacements" class="report-panel">
                            <div class="report-header">
                                <div>
                                    <h3 class="report-header-title">Material Replacement Requests</h3>
                                    <p class="report-header-subtitle">Manage replacement requests from QA • Generated on {{ now()->format('F d, Y h:i A') }}</p>
                                </div>
                            </div>

                            @php
                                $pendingReplacements = $project->materials->where('replacement_requested', true)->where('replacement_status', 'pending');
                                $approvedReplacements = $project->materials->where('replacement_requested', true)->where('replacement_status', 'approved');
                                $rejectedReplacements = $project->materials->where('replacement_requested', true)->where('replacement_status', 'rejected');
                            @endphp

                            <!-- Summary Stats -->
                            <div class="report-summary" style="margin-bottom: 24px;">
                                <div class="report-summary-item" style="border-left: 4px solid #f59e0b;">
                                    <div class="report-summary-label">Pending Requests</div>
                                    <div class="report-summary-value" style="color: #f59e0b;">{{ $pendingReplacements->count() }}</div>
                                </div>
                                <div class="report-summary-item" style="border-left: 4px solid #10b981;">
                                    <div class="report-summary-label">Approved</div>
                                    <div class="report-summary-value" style="color: #10b981;">{{ $approvedReplacements->count() }}</div>
                                </div>
                                <div class="report-summary-item" style="border-left: 4px solid #ef4444;">
                                    <div class="report-summary-label">Rejected</div>
                                    <div class="report-summary-value" style="color: #ef4444;">{{ $rejectedReplacements->count() }}</div>
                                </div>
                            </div>

                            <!-- Pending Replacement Requests -->
                            @if($pendingReplacements->count() > 0)
                            <div style="margin-bottom: 32px;">
                                <h4 style="font-size: 16px; font-weight: 600; color: var(--black-1); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-clock" style="color: #f59e0b;"></i>
                                    Pending Approval ({{ $pendingReplacements->count() }})
                                </h4>
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Category</th>
                                            <th>Qty / Unit</th>
                                            <th>Failure Reason</th>
                                            <th>Replacement Reason</th>
                                            <th>Requested By</th>
                                            <th>Date</th>
                                            <th style="text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendingReplacements as $material)
                                        <tr style="background: #fffbeb;" id="replacement-row-{{ $material->id }}">
                                            <td style="font-weight: 600;">{{ $material->item_description ?? $material->material_name ?? 'Unnamed' }}</td>
                                            <td>{{ $material->category ?? '—' }}</td>
                                            <td class="text-center">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</td>
                                            <td>
                                                <span style="color: #991b1b; font-weight: 500;">{{ $material->failure_reason ?? 'Not specified' }}</span>
                                            </td>
                                            <td style="max-width: 200px; font-size: 13px;">{{ $material->replacement_reason ?? '—' }}</td>
                                            <td>{{ $material->replacementRequester->name ?? 'Unknown' }}</td>
                                            <td>{{ $material->replacement_requested_at ? $material->replacement_requested_at->format('M d, Y') : '—' }}</td>
                                            <td style="text-align: center;">
                                                <div style="display: flex; gap: 6px; justify-content: center;">
                                                    <button type="button" class="btn btn-success btn-sm" onclick="openReplacementActionModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Material') }}', 'approve')" style="padding: 6px 12px; font-size: 12px; background: #10b981; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="openReplacementActionModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Material') }}', 'reject')" style="padding: 6px 12px; font-size: 12px; background: #ef4444; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Approved Replacements -->
                            @if($approvedReplacements->count() > 0)
                            <div style="margin-bottom: 32px;">
                                <h4 style="font-size: 16px; font-weight: 600; color: var(--black-1); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-check-circle" style="color: #10b981;"></i>
                                    Approved Replacements ({{ $approvedReplacements->count() }})
                                </h4>
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Category</th>
                                            <th>Qty / Unit</th>
                                            <th>Original Failure</th>
                                            <th>Approval Notes</th>
                                            <th>Approved By</th>
                                            <th>Approval Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($approvedReplacements as $material)
                                        <tr style="background: #f0fdf4;">
                                            <td style="font-weight: 600;">{{ $material->item_description ?? $material->material_name ?? 'Unnamed' }}</td>
                                            <td>{{ $material->category ?? '—' }}</td>
                                            <td class="text-center">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</td>
                                            <td>{{ $material->failure_reason ?? 'Not specified' }}</td>
                                            <td style="max-width: 200px;">{{ $material->replacement_notes ?? '—' }}</td>
                                            <td>{{ $material->replacementApprover->name ?? 'Unknown' }}</td>
                                            <td>{{ $material->replacement_approved_at ? $material->replacement_approved_at->format('M d, Y h:i A') : '—' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Rejected Replacements -->
                            @if($rejectedReplacements->count() > 0)
                            <div style="margin-bottom: 32px;">
                                <h4 style="font-size: 16px; font-weight: 600; color: var(--black-1); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-times-circle" style="color: #ef4444;"></i>
                                    Rejected Requests ({{ $rejectedReplacements->count() }})
                                </h4>
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Category</th>
                                            <th>Qty / Unit</th>
                                            <th>Original Request Reason</th>
                                            <th>Rejection Reason</th>
                                            <th>Rejected By</th>
                                            <th>Rejection Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rejectedReplacements as $material)
                                        <tr style="background: #fef2f2;">
                                            <td style="font-weight: 600;">{{ $material->item_description ?? $material->material_name ?? 'Unnamed' }}</td>
                                            <td>{{ $material->category ?? '—' }}</td>
                                            <td class="text-center">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</td>
                                            <td style="max-width: 180px;">{{ $material->replacement_reason ?? '—' }}</td>
                                            <td style="max-width: 180px;">{{ $material->replacement_notes ?? 'No reason provided' }}</td>
                                            <td>{{ $material->replacementApprover->name ?? 'Unknown' }}</td>
                                            <td>{{ $material->replacement_approved_at ? $material->replacement_approved_at->format('M d, Y h:i A') : '—' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            @if($pendingReplacements->count() === 0 && $approvedReplacements->count() === 0 && $rejectedReplacements->count() === 0)
                            <div style="text-align: center; padding: 60px 20px; background: #f9fafb; border-radius: 12px; border: 1px solid #e5e7eb;">
                                <i class="fas fa-inbox" style="font-size: 48px; color: #9ca3af; margin-bottom: 16px;"></i>
                                <h3 style="color: #374151; margin-bottom: 8px;">No Replacement Requests</h3>
                                <p style="color: #6b7280;">No materials have been flagged for replacement in this project yet.</p>
                            </div>
                            @endif

                            <div class="report-footer">
                                <strong>Note:</strong> Approved replacements should be coordinated with procurement for new material acquisition.<br>
                                <strong>Report Date:</strong> {{ now()->format('F d, Y h:i A') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <script>
                        function switchReport(reportId) {
                            // Update nav buttons
                            document.querySelectorAll('.report-nav-btn').forEach(btn => btn.classList.remove('active'));
                            document.querySelector(`[onclick="switchReport('${reportId}')"]`).classList.add('active');
                            
                            // Update panels
                            document.querySelectorAll('.report-panel').forEach(panel => panel.classList.remove('active'));
                            document.getElementById('report-' + reportId).classList.add('active');
                        }
                    </script>
                </div>
            </section>
        </main>

        <!-- Replacement Action Modal (Approve/Reject) -->
        @if(in_array(auth()->user()->role, ['OWNER', 'PM', 'FM']))
        <div id="replacementActionModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 500px;">
                <div class="modal-header" id="replacementActionHeader" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <h2 class="modal-title" id="replacementActionTitle" style="color: white;">
                        <i class="fas fa-check-circle"></i> Approve Replacement
                    </h2>
                    <button class="modal-close" onclick="closeReplacementActionModal()" style="color: white;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="replacementActionForm" onsubmit="return submitReplacementAction(event)">
                    <div style="padding: 20px;">
                        <div id="replacementActionInfo" style="background: #f3f4f6; border-radius: 8px; padding: 12px; margin-bottom: 16px;">
                            <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; margin-bottom: 4px;">Material</div>
                            <div id="replacementActionMaterialName" style="font-weight: 600; color: #1f2937; font-size: 14px;"></div>
                        </div>

                        <input type="hidden" id="replacementActionMaterialId" value="">
                        <input type="hidden" id="replacementActionType" value="">

                        <div class="form-group">
                            <label class="form-label" id="replacementNotesLabel">Approval Notes (Optional)</label>
                            <textarea id="replacementActionNotes" name="replacement_notes" class="form-textarea" rows="3" placeholder="Add any notes regarding this decision..."></textarea>
                        </div>

                        <div id="replacementActionWarning" style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px; margin-top: 12px; display: none;">
                            <div style="display: flex; align-items: flex-start; gap: 10px;">
                                <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-top: 2px;"></i>
                                <div style="font-size: 12px; color: #92400e; line-height: 1.5;">
                                    Rejecting this request will notify the QA officer who submitted it. Please provide a reason for the rejection.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeReplacementActionModal()">Cancel</button>
                        <button type="submit" class="btn" id="replacementActionSubmitBtn" style="background: #10b981; color: white;">
                            <i class="fas fa-check"></i> Approve Replacement
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            let currentReplacementMaterialId = null;
            let currentReplacementAction = null;

            function openReplacementActionModal(materialId, materialName, action) {
                currentReplacementMaterialId = materialId;
                currentReplacementAction = action;
                
                document.getElementById('replacementActionMaterialId').value = materialId;
                document.getElementById('replacementActionType').value = action;
                document.getElementById('replacementActionMaterialName').textContent = materialName;
                document.getElementById('replacementActionNotes').value = '';

                const header = document.getElementById('replacementActionHeader');
                const title = document.getElementById('replacementActionTitle');
                const submitBtn = document.getElementById('replacementActionSubmitBtn');
                const notesLabel = document.getElementById('replacementNotesLabel');
                const warning = document.getElementById('replacementActionWarning');
                const infoBox = document.getElementById('replacementActionInfo');

                if (action === 'approve') {
                    header.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                    title.innerHTML = '<i class="fas fa-check-circle"></i> Approve Replacement';
                    submitBtn.innerHTML = '<i class="fas fa-check"></i> Approve Replacement';
                    submitBtn.style.background = '#10b981';
                    notesLabel.textContent = 'Approval Notes (Optional)';
                    warning.style.display = 'none';
                    infoBox.style.background = '#dcfce7';
                    infoBox.style.borderColor = '#86efac';
                } else {
                    header.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
                    title.innerHTML = '<i class="fas fa-times-circle"></i> Reject Replacement';
                    submitBtn.innerHTML = '<i class="fas fa-times"></i> Reject Request';
                    submitBtn.style.background = '#ef4444';
                    notesLabel.textContent = 'Rejection Reason';
                    warning.style.display = 'block';
                    infoBox.style.background = '#fee2e2';
                    infoBox.style.borderColor = '#fecaca';
                }

                document.getElementById('replacementActionModal').style.display = 'flex';
            }

            function closeReplacementActionModal() {
                document.getElementById('replacementActionModal').style.display = 'none';
                currentReplacementMaterialId = null;
                currentReplacementAction = null;
            }

            function submitReplacementAction(event) {
                event.preventDefault();

                const materialId = document.getElementById('replacementActionMaterialId').value;
                const action = document.getElementById('replacementActionType').value;
                const notes = document.getElementById('replacementActionNotes').value;

                const submitBtn = document.getElementById('replacementActionSubmitBtn');
                const originalText = submitBtn.innerHTML;
                
                // Disable button and form immediately to prevent double submissions
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;
                document.getElementById('replacementActionForm').style.opacity = '0.6';
                document.getElementById('replacementActionForm').style.pointerEvents = 'none';

                fetch(`/materials/${materialId}/replacement/process`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action: action,
                        replacement_notes: notes
                    })
                })
                .then(response => response.json())
                .then(data => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    document.getElementById('replacementActionForm').style.opacity = '1';
                    document.getElementById('replacementActionForm').style.pointerEvents = 'auto';

                    if (data.success) {
                        showNotification(data.message, 'success');
                        closeReplacementActionModal();
                        // Update the row or reload after delay
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification(data.message || 'Failed to process request', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    document.getElementById('replacementActionForm').style.opacity = '1';
                    document.getElementById('replacementActionForm').style.pointerEvents = 'auto';
                    showNotification('An error occurred while processing the request', 'error');
                });

                return false;
            }

            // Close modal when clicking outside
            document.getElementById('replacementActionModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeReplacementActionModal();
                }
            });
        </script>
        @endif

        <!-- BOQ Item Modal -->
        <div id="boqModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 750px;">
                <div class="modal-header">
                    <h2 class="modal-title" id="boqTitle">Add BOQ Item</h2>
                    <button class="modal-close" onclick="closeBOQModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="boqForm" method="POST" action="{{ route('projects.materials.store', $project->id) }}" onsubmit="return submitBOQForm(event)">
                    @csrf
                    <input type="hidden" id="boqIdField" name="material_id" value="">
                    
                    <div style="padding: 20px;">
                        <!-- Quick Category Selection -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; text-transform: uppercase; color: #6b7280;">Quick Category Selection</label>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 12px;">
                                <button type="button" class="category-preset-btn" onclick="selectQuickCategory(this, 'COLD & HOT WATER')">Cold & Hot Water</button>
                                <button type="button" class="category-preset-btn" onclick="selectQuickCategory(this, 'ELECTRICAL')">Electrical</button>
                                <button type="button" class="category-preset-btn" onclick="selectQuickCategory(this, 'PLUMBING')">Plumbing</button>
                                <button type="button" class="category-preset-btn" onclick="selectQuickCategory(this, 'MATERIALS')">Materials</button>
                                <button type="button" class="category-preset-btn" onclick="selectQuickCategory(this, 'LABOR')">Labor</button>
                                <button type="button" class="category-preset-btn" onclick="selectQuickCategory(this, 'EQUIPMENT')">Equipment</button>
                            </div>
                            <style>
                                .category-preset-btn {
                                    padding: 8px 12px;
                                    border: 1px solid #d1d5db;
                                    background: #fff;
                                    border-radius: 6px;
                                    font-size: 13px;
                                    font-weight: 500;
                                    cursor: pointer;
                                    transition: all 0.2s;
                                    color: #374151;
                                }
                                .category-preset-btn:hover {
                                    border-color: var(--accent);
                                    background: #eff6ff;
                                    color: var(--accent);
                                }
                                .category-preset-btn.active {
                                    background: var(--accent);
                                    color: white;
                                    border-color: var(--accent);
                                }
                            </style>
                        </div>

                        <!-- Category Input -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Category</label>
                            <input type="text" id="boqCategory" name="category" placeholder="Or type custom category..." 
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                        </div>

                        <!-- Quick Item Description Templates -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; text-transform: uppercase; color: #6b7280;">Quick Item Templates</label>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px;">
                                <button type="button" class="template-btn" onclick="useItemTemplate(this, 'PVC Pipe\n  - Specify diameter\n  - per meter')">PVC Pipe</button>
                                <button type="button" class="template-btn" onclick="useItemTemplate(this, 'Electrical Wire\n  - Specify gauge\n  - per meter')">Wire</button>
                                <button type="button" class="template-btn" onclick="useItemTemplate(this, 'Labor - Installation\n  - per unit\n  - hourly rate')">Labor</button>
                                <button type="button" class="template-btn" onclick="useItemTemplate(this, 'Fittings & Fixtures\n  - Specify type\n  - per piece')">Fittings</button>
                                <button type="button" class="template-btn" onclick="useItemTemplate(this, 'Cement/Adhesive\n  - Specify type\n  - per bag/liter')">Materials</button>
                            </div>
                            <style>
                                .template-btn {
                                    padding: 6px 12px;
                                    border: 1px solid #d1d5db;
                                    background: #f9fafb;
                                    border-radius: 6px;
                                    font-size: 12px;
                                    font-weight: 500;
                                    cursor: pointer;
                                    transition: all 0.2s;
                                    color: #374151;
                                }
                                .template-btn:hover {
                                    border-color: var(--accent);
                                    background: #eff6ff;
                                    color: var(--accent);
                                }
                            </style>
                        </div>

                        <!-- Item Description -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Item Description * <span style="font-size: 11px; color: #9ca3af; font-weight: 400;">Required</span></label>
                            <textarea id="boqItemDescription" name="item_description" placeholder="Enter item description&#10;Use line breaks for structure" required rows="4"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; font-family: 'Inter', sans-serif; box-sizing: border-box; white-space: pre-wrap;"></textarea>
                        </div>

                        <!-- Quantity & Unit -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                            <div>
                                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Quantity *</label>
                                <input type="number" id="boqQuantity" name="quantity" placeholder="0" step="0.01" min="0.01" required 
                                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Unit *</label>
                                <select id="boqUnit" name="unit" required
                                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
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
                                    <option value="lot">Lot</option>
                                    <option value="inch">Inch (in)</option>
                                    <option value="foot">Foot (ft)</option>
                                    <option value="yard">Yard (yd)</option>
                                    <option value="gram">Gram (g)</option>
                                    <option value="ton">Ton (t)</option>
                                    <option value="milliliter">Milliliter (ml)</option>
                                    <option value="cup">Cup</option>
                                    <option value="tablespoon">Tablespoon (tbsp)</option>
                                    <option value="teaspoon">Teaspoon (tsp)</option>
                                    <option value="bottle">Bottle</option>
                                    <option value="can">Can</option>
                                    <option value="carton">Carton</option>
                                    <option value="tube">Tube</option>
                                    <option value="spool">Spool</option>
                                    <option value="coil">Coil</option>
                                    <option value="pair">Pair</option>
                                    <option value="ream">Ream</option>
                                </select>
                            </div>
                        </div>

                        <!-- Cost Inputs -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                            <div>
                                <label style="display: block; margin-bottom: 6px; font-weight: 600;">Material Cost (₱)</label>
                                <input type="number" id="boqMaterialCost" name="material_cost" placeholder="0.00" step="0.01" min="0"
                                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box;" onchange="calculateLaborCost()">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #0369a1;">Labor Cost (Auto)</label>
                                <input type="number" id="boqLaborCost" name="labor_cost" placeholder="0.00" step="0.01" readonly
                                    style="width: 100%; padding: 10px; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 14px; background: #dbeafe; color: #0369a1; box-sizing: border-box;">
                            </div>
                        </div>

                        <!-- Notes -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 6px; font-weight: 600;">Notes (Optional)</label>
                            <textarea id="boqNotes" name="notes" placeholder="Additional remarks" rows="2"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; font-family: 'Inter', sans-serif; box-sizing: border-box;"></textarea>
                        </div>

                        <input type="hidden" id="boqStatus" name="status" value="pending">
                    </div>

                    <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn" style="background: #f3f4f6; color: #374151; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;" onclick="closeBOQModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">Save BOQ Item</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- QA Inspection Modal (QA Role Only) -->
        @if(auth()->user()->role === 'QA')
        <div id="qaInspectModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 550px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white;">
                    <h2 class="modal-title" style="color: white;">
                        <i class="fas fa-clipboard-check"></i> QA Inspection
                    </h2>
                    <button class="modal-close" onclick="closeQAInspectModal()" style="color: white;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="qaInspectForm" onsubmit="return submitQAInspection(event)">
                    @csrf
                    <input type="hidden" id="qaInspectMaterialId" name="material_id" value="">
                    
                    <div style="padding: 24px;">
                        <!-- Item Being Inspected -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 20px;">
                            <div style="font-size: 12px; color: #64748b; text-transform: uppercase; margin-bottom: 6px;">Inspecting Item</div>
                            <div id="qaInspectItemName" style="font-weight: 600; color: #1e293b; font-size: 15px;"></div>
                        </div>

                        <!-- QA Status Selection -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #374151;">Inspection Result <span style="color: #ef4444;">*</span></label>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                                <label class="qa-status-option" style="display: flex; flex-direction: column; align-items: center; padding: 16px 12px; border: 2px solid #d1d5db; border-radius: 10px; cursor: pointer; transition: all 0.2s; background: white;">
                                    <input type="radio" name="qa_status" value="passed" style="display: none;" onchange="selectQAStatus(this)">
                                    <i class="fas fa-check-circle" style="font-size: 28px; color: #10b981; margin-bottom: 8px;"></i>
                                    <span style="font-weight: 600; color: #065f46;">Passed</span>
                                </label>
                                <label class="qa-status-option" style="display: flex; flex-direction: column; align-items: center; padding: 16px 12px; border: 2px solid #d1d5db; border-radius: 10px; cursor: pointer; transition: all 0.2s; background: white;">
                                    <input type="radio" name="qa_status" value="failed" style="display: none;" onchange="selectQAStatus(this)">
                                    <i class="fas fa-times-circle" style="font-size: 28px; color: #ef4444; margin-bottom: 8px;"></i>
                                    <span style="font-weight: 600; color: #991b1b;">Failed</span>
                                </label>
                                <label class="qa-status-option" style="display: flex; flex-direction: column; align-items: center; padding: 16px 12px; border: 2px solid #d1d5db; border-radius: 10px; cursor: pointer; transition: all 0.2s; background: white;">
                                    <input type="radio" name="qa_status" value="requires_recheck" style="display: none;" onchange="selectQAStatus(this)">
                                    <i class="fas fa-redo" style="font-size: 28px; color: #6366f1; margin-bottom: 8px;"></i>
                                    <span style="font-weight: 600; color: #3730a3;">Recheck</span>
                                </label>
                            </div>
                            <style>
                                .qa-status-option:hover { border-color: var(--accent); background: #f0f9ff; }
                                .qa-status-option.selected { border-color: var(--accent); background: #eff6ff; box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1); }
                            </style>
                        </div>

                        <!-- Quality Rating -->
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #374151;">Quality Rating (Optional)</label>
                            <div id="qaRatingStars" style="display: flex; gap: 8px; align-items: center;">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" class="qa-rating-btn" data-rating="{{ $i }}" onclick="setQARating({{ $i }})" style="background: none; border: none; cursor: pointer; padding: 4px;">
                                    <i class="fas fa-star" style="font-size: 28px; color: #d1d5db; transition: color 0.2s;"></i>
                                </button>
                                @endfor
                                <span id="qaRatingText" style="margin-left: 10px; font-size: 14px; color: #64748b;">Not rated</span>
                            </div>
                            <input type="hidden" id="qaRatingValue" name="qa_rating" value="">
                        </div>

                        <!-- Remarks -->
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Inspection Remarks</label>
                            <textarea id="qaRemarks" name="qa_remarks" rows="3" placeholder="Enter any observations, issues, or notes about this item..." style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical; font-family: inherit; box-sizing: border-box;"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding: 16px 24px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 10px; background: #f8fafc;">
                        <button type="button" class="btn" style="background: #f3f4f6; color: #374151; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;" onclick="closeQAInspectModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-clipboard-check"></i> Submit Inspection
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- QA Bulk Inspection Modal -->
        <div id="qaBulkModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 500px;">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white;">
                    <h2 class="modal-title" style="color: white;">
                        <i class="fas fa-check-double"></i> Bulk QA Inspection
                    </h2>
                    <button class="modal-close" onclick="closeBulkQAModal()" style="color: white;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="qaBulkForm" onsubmit="return submitBulkQAInspection(event)">
                    @csrf
                    <div style="padding: 24px;">
                        <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 14px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
                            <i class="fas fa-info-circle" style="color: #92400e; font-size: 20px;"></i>
                            <div>
                                <div style="font-weight: 600; color: #92400e;">Bulk Inspection</div>
                                <div style="font-size: 13px; color: #a16207;">Select items in the table below, then choose a status to apply to all selected items.</div>
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 10px; font-weight: 600; color: #374151;">Apply Status to Selected Items</label>
                            <select id="bulkQAStatus" name="qa_status" required style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background: white;">
                                <option value="">-- Select Status --</option>
                                <option value="passed">✓ Passed</option>
                                <option value="failed">✗ Failed</option>
                                <option value="requires_recheck">↻ Requires Recheck</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Remarks (Applied to all)</label>
                            <textarea id="bulkQARemarks" name="qa_remarks" rows="2" placeholder="Optional remarks for all selected items..." style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical; font-family: inherit; box-sizing: border-box;"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding: 16px 24px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 10px; background: #f8fafc;">
                        <button type="button" class="btn" style="background: #f3f4f6; color: #374151; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;" onclick="closeBulkQAModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">
                            <i class="fas fa-check-double"></i> Apply to Selected
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- BOQ Tasks Modal -->
        <div id="boqTasksModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 700px;">
                <div class="modal-header">
                    <h2 class="modal-title" id="boqTasksTitle">Tasks for Item</h2>
                    <button class="modal-close" onclick="closeBOQTasksModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div style="padding: 20px;">
                    <div style="margin-bottom: 20px;">
                        <h4 style="margin: 0 0 10px 0; color: #1f2937;">Item Details:</h4>
                        <div id="boqItemDetails" style="background: #f3f4f6; padding: 12px; border-radius: 6px; font-size: 14px; color: #374151;">
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        @if($project->status !== 'Completed')
                            <button type="button" class="btn btn-primary" onclick="openAddTaskModal()" style="width: 100%; padding: 10px 16px;">
                                <i class="fas fa-plus"></i> Add Task for This Item
                            </button>
                        @else
                            <div style="width: 100%; padding: 10px 16px; background-color: #e5e7eb; color: #6b7280; border-radius: 6px; font-size: 14px; font-weight: 500; text-align: center;">
                                <i class="fas fa-lock"></i> Project Completed - No additions allowed
                            </div>
                        @endif
                    </div>

                    <div>
                        <h4 style="margin: 0 0 15px 0; color: #1f2937;">Related Project Tasks:</h4>
                        
                        <!-- Task Status Filter -->
                        <div style="margin-bottom: 15px; display: flex; gap: 8px; flex-wrap: wrap;">
                            <button type="button" class="task-filter-btn" data-filter="all" onclick="filterTasks('all')" 
                                style="padding: 6px 14px; border: 2px solid var(--accent); background: var(--accent); color: white; border-radius: 20px; cursor: pointer; font-size: 13px; font-weight: 600; transition: all 0.2s ease;">
                                <i class="fas fa-check"></i> All Tasks
                            </button>
                            <button type="button" class="task-filter-btn" data-filter="ongoing" onclick="filterTasks('ongoing')"
                                style="padding: 6px 14px; border: 2px solid #3b82f6; background: white; color: #3b82f6; border-radius: 20px; cursor: pointer; font-size: 13px; font-weight: 600; transition: all 0.2s ease;">
                                <i class="fas fa-hourglass-half"></i> Ongoing
                            </button>
                            <button type="button" class="task-filter-btn" data-filter="completed" onclick="filterTasks('completed')"
                                style="padding: 6px 14px; border: 2px solid #1e40af; background: white; color: #1e40af; border-radius: 20px; cursor: pointer; font-size: 13px; font-weight: 600; transition: all 0.2s ease;">
                                <i class="fas fa-check-circle"></i> Completed
                            </button>
                        </div>

                        <div id="boqTasksList" style="max-height: 400px; overflow-y: auto;">
                            <div class="updates-timeline">
                                @forelse($project->updates as $update)
                                    <div class="timeline-item task-item" data-status="{{ strtolower($update->status === 'Completed' ? 'completed' : 'ongoing') }}" style="margin-bottom: 15px;">
                                        <div class="timeline-marker" style="background-color: @if($update->status === 'Completed') #1e40af @else #3b82f6 @endif;"></div>
                                        <div class="timeline-content" style="padding: 12px; background: #f9fafb; border-radius: 6px; border-left: 2px solid #e5e7eb;">
                                            <div class="timeline-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                                                <div style="flex: 1;">
                                                    <h5 style="margin: 0 0 5px 0; color: #1f2937;">{{ $update->title }}</h5>
                                                </div>
                                                <select onchange="updateTaskStatus({{ $update->id }}, this.value)" @if($update->status === 'Completed') disabled @endif style="background-color: @if($update->status === 'Completed') #dcfce7; color: #166534; @else #bfdbfe; color: #1e40af; @endif; border: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; cursor: @if($update->status === 'Completed') not-allowed; opacity: 0.6; @else pointer; @endif font-weight: 600;">
                                                    <option value="ongoing" @if($update->status !== 'Completed') selected @endif>
                                                        <i class="fas fa-hourglass-half"></i> Ongoing
                                                    </option>
                                                    <option value="completed" @if($update->status === 'Completed') selected @endif>
                                                        <i class="fas fa-check-circle"></i> Completed
                                                    </option>
                                                </select>
                                            </div>
                                            <p style="margin: 8px 0; font-size: 13px; color: #6b7280;">{{ $update->description }}</p>
                                            <div style="font-size: 12px; color: #9ca3af; margin-top: 8px;">
                                                <i class="fas fa-calendar"></i> {{ $update->created_at->format('M d, Y') }}
                                                <i class="fas fa-user" style="margin-left: 10px;"></i> {{ $update->updatedBy?->name ?? 'Unknown' }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div style="text-align: center; padding: 20px; color: #9ca3af;">
                                        <i class="fas fa-tasks" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                                        <p>No tasks available for this project yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Task Modal for BOQ Item -->
        <div id="addTaskModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 600px;">
                <div class="modal-header">
                    <h2 class="modal-title">Add Task for Item</h2>
                    <button class="modal-close" onclick="closeAddTaskModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="addTaskForm" method="POST" action="{{ route('projects.updates.store', $project->id) }}" onsubmit="return submitAddTaskForm(event)">
                    @csrf
                    <input type="hidden" id="currentBOQItemId" name="material_id" value="">
                    <input type="hidden" id="currentBOQItemName" name="boq_item_name" value="">
                    <input type="hidden" name="status" value="Ongoing">
                    
                    <div style="padding: 20px;">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Task Title *</label>
                            <input type="text" id="taskTitle" name="title" placeholder="Enter task title" required 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description *</label>
                            <textarea id="taskDescription" name="description" placeholder="Enter task description" required rows="3"
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px; font-family: 'Inter', sans-serif;"></textarea>
                        </div>

                        <div style="margin-bottom: 15px; padding: 12px; background: #f0f9ff; border-left: 4px solid #0369a1; border-radius: 4px;">
                            <small style="color: #0369a1; display: block;">
                                <i class="fas fa-info-circle"></i> This task will be linked to: <strong id="linkedItemDisplay"></strong>
                            </small>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid var(--gray-400); display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn" style="background: var(--gray-400); color: var(--black-1); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;" onclick="closeAddTaskModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Add Task</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteConfirmModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 500px;">
                <div class="modal-header" style="background: #fee2e2; border-bottom: 2px solid #dc2626;">
                    <h2 class="modal-title" style="color: #991b1b; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span id="deleteModalTitle">Confirm Delete</span>
                    </h2>
                    <button class="modal-close" onclick="closeDeleteModal()" style="color: #991b1b;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div style="padding: 25px 20px;">
                    <p id="deleteModalMessage" style="color: var(--gray-700); font-size: 15px; line-height: 1.6; margin: 0;"></p>
                    <div id="deleteItemsList" style="margin-top: 15px; padding: 12px; background: var(--sidebar-bg); border-radius: 6px; max-height: 200px; overflow-y: auto; display: none;">
                        <!-- Will be populated with items to delete -->
                    </div>
                </div>
                <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid var(--gray-400); display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn" style="background: var(--gray-400); color: var(--black-1); padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;" onclick="closeDeleteModal()">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn" style="background: #dc2626; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;" onclick="executeDelete()">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Error Notification Modal -->
        <div id="notificationModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div id="notificationHeader" class="modal-header">
                    <h2 class="modal-title">
                        <i id="notificationIcon" class="fas"></i>
                        <span id="notificationTitle">Notification</span>
                    </h2>
                    <button class="modal-close" onclick="closeNotificationModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;">
                    <p id="notificationMessage"></p>
                </div>
            </div>
        </div>

        <!-- Failure Reason Modal for Finance & Transactions -->
        <div id="failureReasonModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 550px;">
                <div class="modal-header" style="background: #fef2f2; border-bottom: 2px solid #fecaca;">
                    <h2 class="modal-title" style="color: #991b1b; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Reason for Failure</span>
                    </h2>
                    <button class="modal-close" onclick="closeFailureReasonModal()" style="color: #991b1b;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div style="padding: 24px;">
                    <input type="hidden" id="failureMaterialId" value="">
                    
                    <p style="color: var(--gray-600); font-size: 14px; margin-bottom: 20px;">
                        Please select the reason for marking this item as failed and provide additional details if necessary.
                    </p>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--black-1);">Failure Reason *</label>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Defective/Damaged Materials" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Defective/Damaged Materials</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Wrong Specifications" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Wrong Specifications</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Incomplete Delivery" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Incomplete Delivery</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Quality Issue" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Quality Issue</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Budget Exceeded" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Budget Exceeded</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Supplier Issue" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Supplier Issue</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 12px 14px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; transition: all 0.2s ease;" class="failure-reason-option">
                                <input type="radio" name="failureReason" value="Other" style="width: 18px; height: 18px;">
                                <span style="color: var(--gray-700);">Other</span>
                            </label>
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--black-1);">Additional Notes</label>
                        <textarea id="failureNotes" rows="3" placeholder="Provide additional details about the failure..." 
                            style="width: 100%; padding: 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 14px; font-family: 'Inter', sans-serif; resize: vertical;"></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 16px 24px; border-top: 1px solid var(--gray-300); display: flex; justify-content: flex-end; gap: 12px;">
                    <button type="button" class="btn" style="background: var(--gray-200); color: var(--gray-700); padding: 10px 20px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; font-weight: 500;" onclick="closeFailureReasonModal()">Cancel</button>
                    <button type="button" class="btn" style="background: #dc2626; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;" onclick="submitFailureReason()">
                        <i class="fas fa-check"></i> Confirm Failure
                    </button>
                </div>
            </div>
        </div>
        <style>
            .failure-reason-option:hover { border-color: #fca5a5; background: #fef2f2; }
            .failure-reason-option:has(input:checked) { border-color: #dc2626; background: #fef2f2; }
        </style>

        <!-- Complete Project Confirmation Modal -->
        <div id="completeProjectModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 520px;">
                <div class="modal-header" style="background: #f0fdf4; border-bottom: 2px solid #bbf7d0;">
                    <h2 class="modal-title" style="color: #166534; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Mark Project as Complete</span>
                    </h2>
                    <button class="modal-close" onclick="closeCompleteProjectModal()" style="color: #166534;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div style="padding: 24px;">
                    <div style="text-align: center; margin-bottom: 24px;">
                        <div style="width: 80px; height: 80px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <i class="fas fa-flag-checkered" style="font-size: 36px; color: #16a34a;"></i>
                        </div>
                        <h3 style="margin: 0 0 8px 0; font-size: 18px; color: var(--black-1);">Complete This Project?</h3>
                        <p style="margin: 0; color: var(--gray-600); font-size: 14px; line-height: 1.6;">
                            You are about to mark <strong>{{ $project->project_name }}</strong> as completed.
                        </p>
                    </div>

                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                        <div style="font-size: 13px; font-weight: 600; color: #166534; margin-bottom: 12px;">
                            <i class="fas fa-clipboard-check"></i> Project Summary
                        </div>
                        <div style="display: grid; gap: 8px; font-size: 13px;">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--gray-600);">Total BOQ Items:</span>
                                <span style="font-weight: 600; color: var(--black-1);">{{ $totalMaterialItems ?? 0 }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--gray-600);">Approved Items:</span>
                                <span style="font-weight: 600; color: #16a34a;">{{ $approvedMaterialItems ?? 0 }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--gray-600);">Failed Items:</span>
                                <span style="font-weight: 600; color: #dc2626;">{{ $failedMaterialItems ?? 0 }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding-top: 8px; border-top: 1px solid #bbf7d0;">
                                <span style="color: var(--gray-600);">Progress:</span>
                                <span style="font-weight: 700; color: #166534;">{{ $progressPercent ?? 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <div style="background: #fffbeb; border: 1px solid #fcd34d; border-radius: 8px; padding: 12px 14px; font-size: 13px; color: #92400e; display: flex; align-items: flex-start; gap: 10px;">
                        <i class="fas fa-exclamation-triangle" style="margin-top: 2px;"></i>
                        <span>This action cannot be undone. Make sure all deliverables have been reviewed and approved before proceeding.</span>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 16px 24px; border-top: 1px solid var(--gray-300); display: flex; justify-content: flex-end; gap: 12px;">
                    <button type="button" class="btn" style="background: var(--gray-200); color: var(--gray-700); padding: 10px 20px; border: 1px solid var(--gray-300); border-radius: 6px; cursor: pointer; font-weight: 500;" onclick="closeCompleteProjectModal()">Cancel</button>
                    <form action="{{ route('projects.complete', $project->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn" style="background: #16a34a; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-check"></i> Yes, Complete Project
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Employee Assignment Modal -->
        <div id="employeeModal" class="modal">
            <div class="modal-content" style="max-width: 800px;">
                <div class="modal-header">
                    <h2 class="modal-title">Add Team Workers - {{ $project->project_name }}</h2>
                    <button class="modal-close" onclick="closeEmployeeModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div style="padding: 20px;">
                    <div id="modalWarning" class="info-banner" style="display: none; margin-bottom: 20px;">
                        <div class="info-banner-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="info-banner-content">
                            <h4 style="margin: 0;">Project Completed</h4>
                            <p style="margin: 0;">This project has been marked as completed. You can still reassign team workers.</p>
                        </div>
                    </div>

                    <p style="color: #6b7280; margin-bottom: 16px; font-size: 14px;">
                        <i class="fas fa-info-circle"></i> Select team workers by role. Only workers not assigned to other active projects are available.
                    </p>

                    <div id="employeeList" style="display: flex; flex-direction: column; gap: 20px;">
                        <!-- Populated by JavaScript with role groups -->
                    </div>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end; padding: 15px 20px; border-top: 1px solid #e5e7eb;">
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
        // Prevent infinite reload loops when showing notifications
        let skipNotificationReload = sessionStorage.getItem('notificationReloaded') === '1';
        if (skipNotificationReload) {
            sessionStorage.removeItem('notificationReloaded');
        }

        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
            
            // Store active tab in localStorage
            localStorage.setItem('activeTab', tabName);
        }

        // Restore active tab on page load
        document.addEventListener('DOMContentLoaded', function() {
            const activeTab = localStorage.getItem('activeTab') || 'overview';
            const tabElement = document.getElementById(activeTab);
            
            if (tabElement) {
                // Hide all tabs
                document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));
                
                // Show the stored tab
                tabElement.classList.add('active');
                
                // Mark the button as active
                const buttons = document.querySelectorAll('.tab-button');
                buttons.forEach(btn => {
                    if (btn.textContent.includes(activeTab === 'boq' ? 'Bill' : activeTab.charAt(0).toUpperCase() + activeTab.slice(1))) {
                        btn.classList.add('active');
                    }
                });
            }
            
            // Clear the stored tab so default works next time if not overridden
            localStorage.removeItem('activeTab');
        });

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
                display: flex;
                flex-direction: column;
            `;

            // Image wrapper for zooming
            const imageWrapper = document.createElement('div');
            imageWrapper.style.cssText = `
                flex: 1;
                overflow: auto;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f5f5f5;
                position: relative;
            `;

            let zoomLevel = 1;
            const maxZoom = 3;
            const minZoom = 0.5;
            let panX = 0;
            let panY = 0;
            let isPanning = false;
            let startX = 0;
            let startY = 0;

            const img = document.createElement('img');
            img.src = imageSrc;
            img.alt = imageTitle;
            img.style.cssText = `
                max-height: 85vh;
                object-fit: contain;
                transform: scale(${zoomLevel}) translate(${panX}px, ${panY}px);
                transition: transform 0.2s ease;
                cursor: grab;
                user-select: none;
            `;

            // Zoom controls
            const controlsBar = document.createElement('div');
            controlsBar.style.cssText = `
                background: rgba(0, 0, 0, 0.7);
                padding: 12px 15px;
                display: flex;
                gap: 10px;
                align-items: center;
                justify-content: center;
                border-top: 1px solid rgba(255,255,255,0.1);
            `;

            const zoomOutBtn = document.createElement('button');
            zoomOutBtn.innerHTML = '<i class="fas fa-minus"></i>';
            zoomOutBtn.style.cssText = `
                background: rgba(255,255,255,0.2);
                border: 1px solid rgba(255,255,255,0.3);
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: all 0.2s;
            `;
            zoomOutBtn.onmouseover = () => {
                zoomOutBtn.style.background = 'rgba(255,255,255,0.3)';
            };
            zoomOutBtn.onmouseout = () => {
                zoomOutBtn.style.background = 'rgba(255,255,255,0.2)';
            };

            const zoomDisplay = document.createElement('span');
            zoomDisplay.textContent = '100%';
            zoomDisplay.style.cssText = `
                color: white;
                font-size: 14px;
                min-width: 50px;
                text-align: center;
            `;

            const zoomInBtn = document.createElement('button');
            zoomInBtn.innerHTML = '<i class="fas fa-plus"></i>';
            zoomInBtn.style.cssText = `
                background: rgba(255,255,255,0.2);
                border: 1px solid rgba(255,255,255,0.3);
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: all 0.2s;
            `;
            zoomInBtn.onmouseover = () => {
                zoomInBtn.style.background = 'rgba(255,255,255,0.3)';
            };
            zoomInBtn.onmouseout = () => {
                zoomInBtn.style.background = 'rgba(255,255,255,0.2)';
            };

            const resetBtn = document.createElement('button');
            resetBtn.textContent = 'Reset';
            resetBtn.style.cssText = `
                background: rgba(255,255,255,0.2);
                border: 1px solid rgba(255,255,255,0.3);
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 13px;
                transition: all 0.2s;
            `;
            resetBtn.onmouseover = () => {
                resetBtn.style.background = 'rgba(255,255,255,0.3)';
            };
            resetBtn.onmouseout = () => {
                resetBtn.style.background = 'rgba(255,255,255,0.2)';
            };

            const updateZoom = () => {
                zoomLevel = Math.max(minZoom, Math.min(maxZoom, zoomLevel));
                img.style.transform = `scale(${zoomLevel}) translate(${panX}px, ${panY}px)`;
                zoomDisplay.textContent = Math.round(zoomLevel * 100) + '%';
                zoomOutBtn.disabled = zoomLevel <= minZoom;
                zoomInBtn.disabled = zoomLevel >= maxZoom;
                zoomOutBtn.style.opacity = zoomLevel <= minZoom ? '0.5' : '1';
                zoomInBtn.style.opacity = zoomLevel >= maxZoom ? '0.5' : '1';
                
                // Update cursor
                if (zoomLevel > 1) {
                    img.style.cursor = 'grabbing';
                } else {
                    img.style.cursor = 'grab';
                }
            };

            zoomInBtn.onclick = () => {
                zoomLevel += 0.2;
                updateZoom();
            };

            zoomOutBtn.onclick = () => {
                zoomLevel -= 0.2;
                updateZoom();
            };

            resetBtn.onclick = () => {
                zoomLevel = 1;
                panX = 0;
                panY = 0;
                updateZoom();
            };

            // Mouse wheel zoom
            imageWrapper.addEventListener('wheel', (e) => {
                e.preventDefault();
                if (e.deltaY < 0) {
                    zoomLevel += 0.1;
                } else {
                    zoomLevel -= 0.1;
                }
                updateZoom();
            }, { passive: false });

            // Pan with mouse drag
            img.addEventListener('mousedown', (e) => {
                if (zoomLevel > 1) {
                    isPanning = true;
                    startX = e.clientX - panX;
                    startY = e.clientY - panY;
                    img.style.cursor = 'grabbing';
                }
            });

            document.addEventListener('mousemove', (e) => {
                if (isPanning) {
                    panX = e.clientX - startX;
                    panY = e.clientY - startY;
                    
                    // Limit pan range based on zoom level
                    const maxPan = (zoomLevel - 1) * 50;
                    panX = Math.max(-maxPan, Math.min(maxPan, panX));
                    panY = Math.max(-maxPan, Math.min(maxPan, panY));
                    
                    img.style.transform = `scale(${zoomLevel}) translate(${panX}px, ${panY}px)`;
                }
            });

            document.addEventListener('mouseup', () => {
                if (isPanning) {
                    isPanning = false;
                    img.style.cursor = zoomLevel > 1 ? 'grab' : 'grab';
                }
            });

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
                z-index: 10000;
            `;

            closeBtn.onmouseover = () => closeBtn.style.background = 'white';
            closeBtn.onmouseout = () => closeBtn.style.background = 'rgba(255, 255, 255, 0.95)';

            const title = document.createElement('div');
            title.innerHTML = imageTitle;
            title.style.cssText = `
                position: absolute;
                bottom: 60px;
                left: 0;
                right: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
                color: white;
                padding: 20px 15px 15px;
                font-weight: 500;
                font-size: 16px;
                z-index: 10000;
            `;

            const closeModal = () => {
                modal.style.animation = 'fadeOut 0.2s ease-out';
                setTimeout(() => modal.remove(), 200);
            };

            closeBtn.onclick = closeModal;
            modal.onclick = (e) => {
                if (e.target === modal) closeModal();
            };

            imageWrapper.appendChild(img);
            controlsBar.appendChild(zoomOutBtn);
            controlsBar.appendChild(zoomDisplay);
            controlsBar.appendChild(zoomInBtn);
            controlsBar.appendChild(resetBtn);

            container.appendChild(closeBtn);
            container.appendChild(title);
            container.appendChild(imageWrapper);
            container.appendChild(controlsBar);
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
            dropZone.addEventListener('click', (e) => {
                if (e.target !== attachmentInput) {
                    attachmentInput.click();
                }
            });

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.style.borderColor = '#1e40af';
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
        // Employee Management Variables
        let currentProjectId = {{ $project->id }};
        let currentProjectStatus = '{{ $project->status }}';
        let allEmployees = {!! json_encode($allEmployees ?? []) !!};
        let projectEmployees = {!! json_encode($projectEmployees ?? []) !!};

        // Debug: Check if employees are loaded
        console.log('All Employees:', allEmployees);
        console.log('All Employees length:', allEmployees ? allEmployees.length : 0);
        console.log('Project Employees:', projectEmployees);
        
        // Validate allEmployees data structure
        if (allEmployees && allEmployees.length > 0) {
            console.log('First employee sample:', JSON.stringify(allEmployees[0]));
        }

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

            console.log('Loading employees for project:', projectId);
            console.log('Assigned IDs:', assignedEmployeeIds);
            console.log('Total employees available:', allEmployees ? allEmployees.length : 0);
            
            // Validate allEmployees
            if (allEmployees && allEmployees.length > 0) {
                console.log('Sample employee data:', JSON.stringify(allEmployees[0]));
                // Check what properties are available
                const sampleEmp = allEmployees[0];
                console.log('Available properties:', Object.keys(sampleEmp));
            }

            employeeList.innerHTML = '';

            if (!allEmployees || allEmployees.length === 0) {
                employeeList.innerHTML = `
                    <div style="text-align: center; padding: 40px 20px; color: #9ca3af;">
                        <i class="fas fa-users" style="font-size: 32px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                        <p style="margin: 0;">No employees available in the system.</p>
                        <p style="margin: 5px 0 0 0; font-size: 12px; color: #6b7280;">Please create employees first.</p>
                    </div>
                `;
                return;
            }

            // Filter out Project Managers and group employees by position
            const employeesByRole = {};
            allEmployees.forEach(employee => {
                const position = employee.position || 'Other';
                
                // Skip Project Managers entirely (but allow Finance Managers)
                if (position.toLowerCase().includes('project manager')) {
                    return;
                }
                
                if (!employeesByRole[position]) {
                    employeesByRole[position] = [];
                }
                employeesByRole[position].push(employee);
            });

            // Check if any non-manager employees exist
            if (Object.keys(employeesByRole).length === 0) {
                employeeList.innerHTML = `
                    <div style="text-align: center; padding: 40px 20px; color: #9ca3af;">
                        <i class="fas fa-hard-hat" style="font-size: 32px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                        <p style="margin: 0;">No team workers available.</p>
                        <p style="margin: 5px 0 0 0; font-size: 12px; color: #6b7280;">Only project managers found. Create workers with other positions.</p>
                    </div>
                `;
                return;
            }

            // Sort positions alphabetically
            const sortedPositions = Object.keys(employeesByRole).sort();

            sortedPositions.forEach((position, index) => {
                const employees = employeesByRole[position];
                
                // Create role group container
                const roleGroup = document.createElement('div');
                roleGroup.style.cssText = 'border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; background: white;';
                
                // Role header
                const roleHeader = document.createElement('div');
                roleHeader.style.cssText = 'background: #f9fafb; padding: 12px 16px; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;';
                roleHeader.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-user-hard-hat" style="color: var(--accent); font-size: 16px;"></i>
                        <h3 style="margin: 0; font-size: 14px; font-weight: 600; color: #111827;">${position}</h3>
                        <span style="background: #e5e7eb; color: #6b7280; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600;">${employees.length} available</span>
                    </div>
                    <button type="button" onclick="toggleRoleGroup(this)" style="background: none; border: none; color: #6b7280; cursor: pointer; font-size: 18px; padding: 0; transition: transform 0.2s;">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                `;
                
                // Role body (employee list)
                const roleBody = document.createElement('div');
                roleBody.className = 'role-body';
                roleBody.style.cssText = 'padding: 8px; display: grid; gap: 8px;';
                
                employees.forEach(employee => {
                    const isAssigned = assignedEmployeeIds.includes(employee.id);
                    const isAssignedToOtherProject = employee.assigned_to_other_project && !isAssigned;
                    
                    // Safely get employee properties with fallbacks
                    const empId = employee.id || 'N/A';
                    const empFirstName = employee.f_name || 'Unknown';
                    const empLastName = employee.l_name || 'Employee';
                    const empPosition = employee.position || 'Staff';

                    const employeeItem = document.createElement('div');
                    employeeItem.className = 'employee-item';
                    employeeItem.style.cssText = 'display: flex; align-items: center; gap: 12px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 6px; background: #fafafa; transition: all 0.2s;';
                    employeeItem.innerHTML = `
                        <input 
                            type="checkbox" 
                            value="${empId}"
                            ${isAssigned ? 'checked' : ''}
                            ${isAssignedToOtherProject ? 'disabled' : ''}
                            class="employee-checkbox"
                            style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent);"
                        >
                        <div style="flex: 1;">
                            <div style="font-weight: 500; color: #111827; font-size: 14px;">${empFirstName} ${empLastName}</div>
                            <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">EMP${String(empId).padStart(3, '0')}</div>
                            ${isAssignedToOtherProject ? '<div style="color: #dc2626; font-size: 11px; font-weight: 600; margin-top: 4px;"><i class="fas fa-exclamation-circle"></i> Assigned to other project</div>' : ''}
                        </div>
                    `;
                    
                    // Hover effect
                    employeeItem.addEventListener('mouseenter', function() {
                        if (!isAssignedToOtherProject) this.style.background = '#f3f4f6';
                    });
                    employeeItem.addEventListener('mouseleave', function() {
                        this.style.background = '#fafafa';
                    });
                    
                    roleBody.appendChild(employeeItem);
                });
                
                roleGroup.appendChild(roleHeader);
                roleGroup.appendChild(roleBody);
                employeeList.appendChild(roleGroup);
            });
        }

        // Toggle role group visibility
        function toggleRoleGroup(button) {
            const roleBody = button.closest('div').nextElementSibling;
            const icon = button.querySelector('i');
            
            if (roleBody.style.display === 'none') {
                roleBody.style.display = 'grid';
                icon.style.transform = 'rotate(0deg)';
            } else {
                roleBody.style.display = 'none';
                icon.style.transform = 'rotate(-90deg)';
            }
        }

        function saveEmployeeAssignments() {
            const checkboxes = document.querySelectorAll('.employee-checkbox:not(:disabled)');
            const selectedEmployeeIds = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => {
                    const value = parseInt(cb.value);
                    return !isNaN(value) ? value : null;
                })
                .filter(id => id !== null); // Remove any non-integer IDs

            if (selectedEmployeeIds.length === 0) {
                showNotification('Please select at least one valid employee to assign.', 'error');
                return;
            }

            console.log('Sending employee IDs:', selectedEmployeeIds);

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            if (!csrfToken) {
                showNotification('CSRF token not found. Please refresh the page and try again.', 'error');
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
                    showNotification('Employees assigned successfully!', 'success');
                    closeEmployeeModal();
                    setTimeout(() => location.reload(), 2000);
                } else {
                    showNotification('Error: ' + (data.message || 'Failed to assign employees'), 'error');
                }
            })
            .catch(error => {
                console.error('Full error:', error);
                showNotification('An error occurred: ' + error.message, 'error');
            });
        }

        function validateBOQForm() {
            const itemDescription = document.getElementById('boqItemDescription').value.trim();
            const quantity = parseInt(document.getElementById('boqQuantity').value) || 0;
            const unit = document.getElementById('boqUnit').value.trim();
            
            if (!itemDescription) {
                showNotification('Please enter an item description', 'error');
                document.getElementById('boqItemDescription').focus();
                return false;
            }
            
            if (quantity <= 0) {
                showNotification('Please enter a valid quantity (greater than 0)', 'error');
                document.getElementById('boqQuantity').focus();
                return false;
            }
            
            if (!unit) {
                showNotification('Please select a unit', 'error');
                document.getElementById('boqUnit').focus();
                return false;
            }
            
            return true;
        }

        // Quick Category Selection
        function selectQuickCategory(btn, categoryName) {
            event.preventDefault();
            
            // Remove active class from all buttons
            document.querySelectorAll('.category-preset-btn').forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            btn.classList.add('active');
            
            // Set the category input value
            document.getElementById('boqCategory').value = categoryName;
            
            // Focus on description field
            document.getElementById('boqItemDescription').focus();
        }

        // Use Item Template
        function useItemTemplate(btn, templateText) {
            event.preventDefault();
            
            // Set the textarea value with template
            document.getElementById('boqItemDescription').value = templateText;
            
            // Focus and select all for easy editing
            document.getElementById('boqItemDescription').focus();
            document.getElementById('boqItemDescription').select();
        }

        // Calculate Labor Cost (50% of material cost)
        function calculateLaborCost() {
            const materialCost = parseFloat(document.getElementById('boqMaterialCost').value) || 0;
            const laborCost = (materialCost / 2).toFixed(2);
            document.getElementById('boqLaborCost').value = laborCost;
        }

        function submitBOQForm(event) {
            event.preventDefault();
            
            if (!validateBOQForm()) {
                return false;
            }
            
            // Manually collect form data to ensure values are captured
            const formData = new FormData();
            
            // Add CSRF token
            const csrfToken = document.querySelector('input[name="_token"]');
            if (csrfToken) {
                formData.append('_token', csrfToken.value);
            }
            
            // Add method for updating if material_id is set
            const materialId = document.getElementById('boqIdField').value;
            if (materialId) {
                formData.append('_method', 'PUT');
            }
            
            // Manually add form fields with their values
            const itemDescription = document.getElementById('boqItemDescription').value.trim();
            const quantity = document.getElementById('boqQuantity').value.trim();
            const unit = document.getElementById('boqUnit').value.trim();
            const materialCost = document.getElementById('boqMaterialCost').value.trim();
            const laborCost = document.getElementById('boqLaborCost').value.trim();
            const category = document.getElementById('boqCategory').value.trim();
            const notes = document.getElementById('boqNotes').value.trim();
            
            // Add to FormData
            formData.append('item_description', itemDescription);
            formData.append('quantity', quantity);
            formData.append('unit', unit);
            formData.append('unit_rate', materialCost);
            formData.append('material_cost', materialCost);
            formData.append('labor_cost', laborCost);
            formData.append('category', category);
            formData.append('notes', notes);
            
            const form = document.getElementById('boqForm');
            const url = form.action;
            
            // Log all form data for debugging
            console.log('Submitting BOQ form to:', url);
            console.log('Material ID:', materialId);
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                console.log('Response content-type:', response.headers.get('content-type'));
                
                if (!response.ok) {
                    // Try to parse as JSON, fallback to text
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(err => {
                            console.error('JSON error response:', err);
                            throw new Error(err.message || 'HTTP ' + response.status);
                        });
                    } else {
                        return response.text().then(text => {
                            console.error('Text error response:', text);
                            throw new Error('HTTP ' + response.status + ': ' + (text || 'Unknown error'));
                        });
                    }
                }
                
                // Parse successful response
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    console.warn('Response is not JSON, but status is ok:', response.status);
                    return { success: true, message: 'Material saved successfully!' };
                }
            })
            .then(data => {
                console.log('Success response:', data);
                if (data.success) {
                    closeBOQModal();
                    
                    // Store current tab in localStorage before reload
                    localStorage.setItem('activeTab', 'boq');
                    
                    // Show success notification and reload
                    showNotification(data.message || 'Material added successfully!', 'success');
                    
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    showNotification('Error: ' + (data.message || 'Failed to save BOQ item'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error: ' + (error.message || 'Failed to save BOQ item'), 'error');
            });
            
            return false;
        }

        function openBOQModal() {
            try {
                console.log('openBOQModal called');
                
                const modal = document.getElementById('boqModal');
                const form = document.getElementById('boqForm');
                const title = document.getElementById('boqTitle');
                
                console.log('Modal:', modal);
                console.log('Form:', form);
                console.log('Title:', title);
                
                if (!modal) {
                    console.error('BOQ modal element not found');
                    showNotification('Error: BOQ modal not found. Please refresh the page.', 'error');
                    return false;
                }
                
                if (!form) {
                    console.error('BOQ form element not found');
                    showNotification('Error: BOQ form not found. Please refresh the page.', 'error');
                    return false;
                }
                
                if (!title) {
                    console.error('BOQ title element not found');
                    showNotification('Error: BOQ title not found. Please refresh the page.', 'error');
                    return false;
                }
                
                title.textContent = 'Add BOQ Item';
                form.reset();
                
                // Clear hidden ID field
                const boqIdField = document.getElementById('boqIdField');
                if (boqIdField) boqIdField.value = '';
                
                // Update form action
                form.action = `/projects/{{ $project->id }}/materials`;
                form.method = 'POST';
                
                // Remove PUT method field if exists
                const methodField = form.querySelector('input[name="_method"]');
                if (methodField) {
                    methodField.remove();
                }
                
                // Ensure labor cost is calculated
            setTimeout(() => {
                initializeBOQMaterialCostListener();
                updateLaborCostDisplay();
            }, 100);                modal.style.display = 'flex';
                console.log('Modal displayed');
                return false;
            } catch (error) {
                console.error('Error in openBOQModal:', error);
                showNotification('Error opening modal: ' + error.message, 'error');
                return false;
            }
        }

        function closeBOQModal() {
            const modal = document.getElementById('boqModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // BOQ Selection and Bulk Delete Functions
        function updateBOQSelection() {
            const checkboxes = document.querySelectorAll('.boq-checkbox');
            const checkedBoxes = document.querySelectorAll('.boq-checkbox:checked');
            const deleteBtn = document.getElementById('deleteSelectedBtn');
            const selectedCount = document.getElementById('selectedCount');
            const selectAllCheckbox = document.getElementById('selectAllBOQ');
            
            // Update count and button visibility
            if (selectedCount) {
                selectedCount.textContent = checkedBoxes.length;
            }
            
            if (deleteBtn) {
                deleteBtn.style.display = checkedBoxes.length > 0 ? 'inline-flex' : 'none';
            }
            
            // Update select all checkbox state
            if (selectAllCheckbox && checkboxes.length > 0) {
                selectAllCheckbox.checked = checkedBoxes.length === checkboxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
            }
        }

        function toggleAllBOQItems() {
            const selectAllCheckbox = document.getElementById('selectAllBOQ');
            const checkboxes = document.querySelectorAll('.boq-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            
            updateBOQSelection();
        }

        function confirmSingleDelete(materialId, itemDescription) {
            const modal = document.getElementById('deleteConfirmModal');
            const modalTitle = document.getElementById('deleteModalTitle');
            const modalMessage = document.getElementById('deleteModalMessage');
            const deleteItemsList = document.getElementById('deleteItemsList');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            
            if (modalTitle) modalTitle.textContent = 'Delete BOQ Item';
            if (modalMessage) modalMessage.innerHTML = `Are you sure you want to delete <strong>"${itemDescription}"</strong>?<br><br>This action cannot be undone.`;
            if (deleteItemsList) deleteItemsList.style.display = 'none';
            
            // Set up delete action
            if (confirmBtn) {
                confirmBtn.onclick = function() {
                    executeSingleDelete(materialId);
                };
            }
            
            if (modal) {
                modal.style.display = 'flex';
            }
        }

        function confirmBulkDelete() {
            const checkedBoxes = document.querySelectorAll('.boq-checkbox:checked');
            
            if (checkedBoxes.length === 0) {
                return;
            }
            
            const modal = document.getElementById('deleteConfirmModal');
            const modalTitle = document.getElementById('deleteModalTitle');
            const modalMessage = document.getElementById('deleteModalMessage');
            const deleteItemsList = document.getElementById('deleteItemsList');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            
            if (modalTitle) modalTitle.textContent = 'Delete Multiple BOQ Items';
            if (modalMessage) {
                modalMessage.innerHTML = `Are you sure you want to delete <strong>${checkedBoxes.length} item(s)</strong>?<br><br>This action cannot be undone.`;
            }
            
            // Show list of items to be deleted
            if (deleteItemsList) {
                deleteItemsList.style.display = 'block';
                deleteItemsList.innerHTML = '<div style="font-weight: 600; margin-bottom: 8px; color: var(--gray-700);">Items to be deleted:</div>';
                
                checkedBoxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const itemDescription = row.querySelector('td:nth-child(3) div')?.textContent || 'Unknown item';
                    const itemNo = row.querySelector('td:nth-child(2)')?.textContent || '—';
                    
                    const itemDiv = document.createElement('div');
                    itemDiv.style.cssText = 'padding: 6px 10px; margin-bottom: 4px; background: white; border-left: 3px solid #dc2626; border-radius: 4px; font-size: 13px;';
                    itemDiv.innerHTML = `<strong>#${itemNo}</strong> - ${itemDescription.substring(0, 60)}${itemDescription.length > 60 ? '...' : ''}`;
                    deleteItemsList.appendChild(itemDiv);
                });
            }
            
            // Set up bulk delete action
            if (confirmBtn) {
                confirmBtn.onclick = function() {
                    executeBulkDelete();
                };
            }
            
            if (modal) {
                modal.style.display = 'flex';
            }
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function executeDelete() {
            // This will be set dynamically by confirmSingleDelete or confirmBulkDelete
            // Should not be called directly
        }

        function executeSingleDelete(materialId) {
            // Create a form and submit it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/projects/{{ $project->id }}/materials/${materialId}`;
            
            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            // Add DELETE method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Store active tab before submission
            localStorage.setItem('activeTab', 'boq');
            
            document.body.appendChild(form);
            form.submit();
        }

        function executeBulkDelete() {
            const checkedBoxes = document.querySelectorAll('.boq-checkbox:checked');
            const materialIds = Array.from(checkedBoxes).map(cb => cb.dataset.materialId);
            
            if (materialIds.length === 0) {
                closeDeleteModal();
                return;
            }
            
            // Create a form and submit it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/projects/{{ $project->id }}/materials/bulk-delete`;
            
            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            // Add material IDs
            materialIds.forEach(id => {
                const idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.name = 'material_ids[]';
                idInput.value = id;
                form.appendChild(idInput);
            });
            
            // Store active tab before submission
            localStorage.setItem('activeTab', 'boq');
            
            document.body.appendChild(form);
            form.submit();
        }

        function confirmDeleteBOQ() {
            if (confirm('Delete this item?')) {
                localStorage.setItem('activeTab', 'boq');
                return true;
            }
            return false;
        }

        // Notification Modal Functions
        function showNotification(message, type = 'success') {
            const modal = document.getElementById('notificationModal');
            const header = document.getElementById('notificationHeader');
            const icon = document.getElementById('notificationIcon');
            const title = document.getElementById('notificationTitle');
            const messageEl = document.getElementById('notificationMessage');
            const content = modal ? modal.querySelector('.modal-content') : null;
            
            // Reset inline styles to let CSS drive the look
            if (header) {
                header.style.background = 'transparent';
                header.style.borderColor = 'transparent';
                header.style.color = 'inherit';
            }
            if (icon) {
                icon.removeAttribute('style');
            }
            if (title) {
                title.removeAttribute('style');
            }
            if (content) {
                content.classList.remove('toast-success', 'toast-error', 'toast-info');
            }

            let toastClass = 'toast-info';
            let iconClass = 'fas fa-info-circle';
            let titleText = 'Info';

            if (type === 'success') {
                toastClass = 'toast-success';
                iconClass = 'fas fa-check-circle';
                titleText = 'Success';
            } else if (type === 'error') {
                toastClass = 'toast-error';
                iconClass = 'fas fa-exclamation-circle';
                titleText = 'Error';
            }
            
            if (content) content.classList.add(toastClass);
            if (icon) icon.className = iconClass;
            if (title) title.textContent = titleText;
            
            if (messageEl) messageEl.textContent = message;
            
            if (modal) {
                // Remove any existing animation classes
                modal.classList.remove('notification-modal-hide', 'notification-modal-show');
                
                // Show modal and trigger fade-in animation
                modal.style.display = 'flex';
                modal.style.opacity = '0';
                
                // Force reflow to ensure animation plays
                void modal.offsetWidth;
                
                // Add animation class
                modal.classList.add('notification-modal-show');

                // Trigger a single reload shortly after showing the toast
                if (!skipNotificationReload) {
                    skipNotificationReload = true;
                    setTimeout(() => {
                        sessionStorage.setItem('notificationReloaded', '1');
                        location.reload();
                    }, 400);
                } else {
                    // Reset the guard so future notifications can reload after this pass
                    skipNotificationReload = false;
                }
            }
        }

        function closeNotificationModal() {
            const modal = document.getElementById('notificationModal');
            if (modal) {
                // Remove show class and add hide class
                modal.classList.remove('notification-modal-show');
                modal.classList.add('notification-modal-hide');
                
                // Wait for animation to complete before hiding
                setTimeout(() => {
                    modal.style.display = 'none';
                    modal.classList.remove('notification-modal-hide');
                }, 220);
            }
        }

        // Check for flash messages on page load
        document.addEventListener('DOMContentLoaded', function() {
            const successMsg = document.getElementById('flashSuccessMessage');
            const errorMsg = document.getElementById('flashErrorMessage');
            
            if (successMsg) {
                showNotification(successMsg.textContent, 'success');
            } else if (errorMsg) {
                showNotification(errorMsg.textContent, 'error');
            }
        });

        function editBOQItem(materialId) {
            const modal = document.getElementById('boqModal');
            const form = document.getElementById('boqForm');
            document.getElementById('boqTitle').textContent = 'Edit BOQ Item';
            
            // Fetch material data
            const url = `/projects/{{ $project->id }}/materials/${materialId}`;
            console.log('Fetching material from:', url);
            
            fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Material data received:', data);
                    document.getElementById('boqCategory').value = data.category || '';
                    document.getElementById('boqItemDescription').value = data.item_description || '';
                    document.getElementById('boqQuantity').value = data.quantity || '';
                    document.getElementById('boqUnit').value = data.unit || '';
                    document.getElementById('boqMaterialCost').value = data.material_cost || '';
                    document.getElementById('boqLaborCost').value = data.labor_cost || '';
                    document.getElementById('boqNotes').value = data.notes || '';
                    document.getElementById('boqIdField').value = materialId;
                    
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
                    console.error('Error fetching BOQ item:', error);
                    showNotification(`Error loading BOQ item data: ${error.message}`, 'error');
                });
        }

        // Auto-calculate labor cost when quantity changes
        function initializeBOQMaterialCostListener() {
            const materialCostField = document.getElementById('boqMaterialCost');
            if (materialCostField && !materialCostField.hasAttribute('data-listener-attached')) {
                materialCostField.setAttribute('data-listener-attached', 'true');
                materialCostField.addEventListener('input', function() {
                    const materialCost = parseFloat(this.value) || 0;
                    const laborCost = materialCost / 2;
                    document.getElementById('boqLaborCost').value = laborCost.toFixed(2);
                });
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeBOQMaterialCostListener);

        // Initialize labor cost on modal open
        function updateLaborCostDisplay() {
            const materialCost = parseFloat(document.getElementById('boqMaterialCost').value) || 0;
            const laborCost = materialCost / 2;
            document.getElementById('boqLaborCost').value = laborCost.toFixed(2);
        }

        // BOQ Tasks Modal Functions
        let currentBOQItem = {
            id: null,
            description: null
        };

        function viewBOQTasks(itemDescription, materialId) {
            try {
                const modal = document.getElementById('boqTasksModal');
                const title = document.getElementById('boqTasksTitle');
                const details = document.getElementById('boqItemDetails');
                
                if (!modal) {
                    showNotification('Tasks modal not found', 'error');
                    console.error('boqTasksModal element not found');
                    return;
                }
                
                if (!title) {
                    showNotification('Modal title element not found', 'error');
                    console.error('boqTasksTitle element not found');
                    return;
                }
                
                if (!details) {
                    showNotification('Modal details element not found', 'error');
                    console.error('boqItemDetails element not found');
                    return;
                }
                
                // Store current BOQ item for task creation
                currentBOQItem.id = materialId;
                currentBOQItem.description = itemDescription;
                
                title.textContent = 'Tasks for: ' + (itemDescription || 'Unknown Item');
                details.innerHTML = `
                    <strong>Item Description:</strong><br>
                    ${itemDescription || 'N/A'}<br><br>
                    <div style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                        <i class="fas fa-info-circle"></i> View all project tasks related to this BOQ item
                    </div>
                `;
                
                loadTasksForItem(materialId);
                modal.style.display = 'flex';
                console.log('BOQ Tasks modal opened for item:', itemDescription, 'ID:', materialId);
            } catch (error) {
                console.error('Error in viewBOQTasks:', error);
                showNotification('Error opening tasks modal: ' + error.message, 'error');
            }
        }

        function closeBOQTasksModal() {
            const modal = document.getElementById('boqTasksModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function loadTasksForItem(materialId) {
            const tasksList = document.getElementById('boqTasksList');
            
            if (!tasksList) {
                console.error('boqTasksList element not found');
                showNotification('Tasks list container not found', 'error');
                return;
            }
            
            // Show loading state
            tasksList.innerHTML = '<div style="text-align: center; padding: 20px;"><i class="fas fa-spinner fa-spin"></i> Loading tasks...</div>';
            
            // Filter the tasks based on material_id
            fetch(`/projects/{{ $project->id }}/tasks?material_id=${materialId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Tasks fetch response status:', response.status);
                if (!response.ok) throw new Error('Failed to load tasks (HTTP ' + response.status + ')');
                return response.json();
            })
            .then(data => {
                console.log('Tasks data received:', data);
                if (data.tasks && data.tasks.length > 0) {
                    let html = '<div class="updates-timeline">';
                    
                    data.tasks.forEach(task => {
                        const taskStatus = task.status === 'Completed' ? 'completed' : 'ongoing';
                        const statusBg = task.status === 'Completed' ? '#1e40af' : '#3b82f6';
                        const statusBgColor = task.status === 'Completed' ? '#dcfce7' : '#bfdbfe';
                        const statusTextColor = task.status === 'Completed' ? '#166534' : '#1e40af';
                        
                        html += `
                            <div class="timeline-item task-item" data-status="${taskStatus}" style="margin-bottom: 15px;">
                                <div class="timeline-marker" style="background-color: ${statusBg};"></div>
                                <div class="timeline-content" style="padding: 12px; background: #f9fafb; border-radius: 6px; border-left: 2px solid #e5e7eb;">
                                    <div class="timeline-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <div style="flex: 1;">
                                            <h5 style="margin: 0 0 5px 0; color: #1f2937;">${task.title}</h5>
                                        </div>
                                        <select onchange="updateTaskStatus(${task.id}, this.value)" ${task.status === 'Completed' ? 'disabled' : ''} style="background-color: ${statusBgColor}; color: ${statusTextColor}; border: none; padding: 4px 8px; border-radius: 4px; font-size: 12px; cursor: ${task.status === 'Completed' ? 'not-allowed; opacity: 0.6;' : 'pointer;'} font-weight: 600; margin-left: 10px;">
                                            <option value="ongoing" ${task.status !== 'Completed' ? 'selected' : ''}>
                                                Ongoing
                                            </option>
                                            <option value="completed" ${task.status === 'Completed' ? 'selected' : ''}>
                                                Completed
                                            </option>
                                        </select>
                                    </div>
                                    <p style="margin: 8px 0; font-size: 13px; color: #6b7280;">${task.description}</p>
                                    <div style="font-size: 12px; color: #9ca3af; margin-top: 8px;">
                                        <i class="fas fa-calendar"></i> ${new Date(task.created_at).toLocaleDateString()}
                                        <i class="fas fa-user" style="margin-left: 10px;"></i> ${task.updated_by_user?.name || 'Unknown'}
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    html += '</div>';
                    tasksList.innerHTML = html;
                    
                    // Reset filter to 'all' after loading
                    document.querySelectorAll('.task-filter-btn').forEach(btn => btn.style.background = 'white');
                    document.querySelectorAll('.task-filter-btn').forEach(btn => btn.style.color = 'inherit');
                    const allBtn = document.querySelector('.task-filter-btn[data-filter="all"]');
                    if (allBtn) {
                        allBtn.style.background = 'var(--accent)';
                        allBtn.style.color = 'white';
                    }
                } else {
                    tasksList.innerHTML = `
                        <div style="text-align: center; padding: 20px; color: #9ca3af;">
                            <i class="fas fa-tasks" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                            <p>No tasks assigned to this item yet. Click "Add Task for This Item" to create one.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading tasks:', error);
                tasksList.innerHTML = `
                    <div style="text-align: center; padding: 20px; color: #dc2626;">
                        <p>Error loading tasks. Please try again.</p>
                    </div>
                `;
            });
        }

        function filterTasks(filter) {
            // Update button styles
            document.querySelectorAll('.task-filter-btn').forEach(btn => {
                btn.style.background = 'white';
                btn.style.color = btn.getAttribute('data-filter') === 'ongoing' ? '#3b82f6' : 
                                   btn.getAttribute('data-filter') === 'completed' ? '#1e40af' : 'inherit';
            });
            
            // Highlight active filter
            const activeBtn = document.querySelector(`.task-filter-btn[data-filter="${filter}"]`);
            if (activeBtn) {
                if (filter === 'all') {
                    activeBtn.style.background = 'var(--accent)';
                    activeBtn.style.color = 'white';
                } else if (filter === 'ongoing') {
                    activeBtn.style.background = '#3b82f6';
                    activeBtn.style.color = 'white';
                } else if (filter === 'completed') {
                    activeBtn.style.background = '#1e40af';
                    activeBtn.style.color = 'white';
                }
            }
            
            // Filter task items
            const taskItems = document.querySelectorAll('.task-item');
            taskItems.forEach(item => {
                if (filter === 'all') {
                    item.style.display = 'block';
                } else {
                    const itemStatus = item.getAttribute('data-status');
                    item.style.display = itemStatus === filter ? 'block' : 'none';
                }
            });
        }

        function updateTaskStatus(taskId, newStatus) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                showNotification('CSRF token not found', 'error');
                return;
            }

            // Get the select element to check current status
            const selectElement = event.target;
            const currentStatus = selectElement.options[selectElement.selectedIndex === 1 ? 0 : 1].value;
            
            // Prevent changes from Completed status
            if (selectElement.disabled) {
                showNotification('This task is completed and cannot be changed', 'error');
                return;
            }

            const statusValue = newStatus === 'completed' ? 'Completed' : 'Ongoing';

            fetch(`/projects/{{ $project->id }}/updates/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _token: csrfToken,
                    status: statusValue
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to update task status');
                return response.json();
            })
            .then(data => {
                showNotification('Task status updated successfully', 'success');
                // Reload the tasks list to reflect the change
                setTimeout(() => {
                    location.reload();
                }, 500);
            })
            .catch(error => {
                console.error('Error updating task status:', error);
                showNotification('Failed to update task status', 'error');
            });
        }

        function openAddTaskModal() {
            const modal = document.getElementById('addTaskModal');
            if (!modal) {
                showNotification('Add task modal not found', 'error');
                return;
            }

            // Set the hidden fields with current BOQ item info
            document.getElementById('currentBOQItemId').value = currentBOQItem.id || '';
            document.getElementById('currentBOQItemName').value = currentBOQItem.description || '';
            document.getElementById('linkedItemDisplay').textContent = currentBOQItem.description || 'Unknown Item';
            
            // Reset form
            document.getElementById('addTaskForm').reset();
            
            modal.style.display = 'flex';
        }

        function closeAddTaskModal() {
            const modal = document.getElementById('addTaskModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function submitAddTaskForm(event) {
            event.preventDefault();
            
            const title = document.getElementById('taskTitle').value.trim();
            const description = document.getElementById('taskDescription').value.trim();
            const boqItemName = document.getElementById('currentBOQItemName').value;
            
            if (!title) {
                showNotification('Please enter a task title', 'error');
                document.getElementById('taskTitle').focus();
                return false;
            }
            
            if (!description) {
                showNotification('Please enter a task description', 'error');
                document.getElementById('taskDescription').focus();
                return false;
            }
            
            const form = document.getElementById('addTaskForm');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            if (!csrfToken) {
                showNotification('CSRF token not found. Please refresh the page.', 'error');
                return false;
            }
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers.get('content-type'));
                
                if (!response.ok) {
                    return response.text().then(text => {
                        try {
                            const json = JSON.parse(text);
                            throw new Error(json.message || `Server error: ${response.status}`);
                        } catch (e) {
                            throw new Error(`Server error: ${response.status}`);
                        }
                    });
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showNotification('Task added successfully!', 'success');
                    // Clear the form but keep modal open
                    document.getElementById('addTaskForm').reset();
                    document.getElementById('taskTitle').focus();
                    
                    // Reload only the tasks list for this item
                    if (currentBOQItem && currentBOQItem.id) {
                        loadTasksForItem(currentBOQItem.id);
                    }
                } else {
                    showNotification('Error: ' + (data.message || 'Failed to add task'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred: ' + error.message, 'error');
            });
            
            return false;
        }

        // Bulk status helpers for Finance & Transactions
        // Complete Project Modal Functions
        function openCompleteProjectModal() {
            document.getElementById('completeProjectModal').style.display = 'flex';
        }

        function closeCompleteProjectModal() {
            document.getElementById('completeProjectModal').style.display = 'none';
        }

        function showCannotCompleteMessage() {
            @php
                $pmRecommended = !empty($project->pm_confirmed_at);
                $progressComplete = ($progressPercent ?? 0) >= 100;
            @endphp
            
            let message = 'Cannot mark project as complete. ';
            const issues = [];
            
            @if(!$pmRecommended)
                issues.push('PM recommendation is required');
            @endif
            
            @if(!$progressComplete)
                issues.push('Progress must be at 100% (all items must be Approved or Failed)');
            @endif
            
            if (issues.length > 0) {
                message += issues.join('. ') + '.';
            }
            
            showNotification(message, 'error');
        }

        // View text content in modal
        function viewTextContent(docId) {
            fetch(`/projects/{{ $project->id }}/documents/${docId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to load document');
                return response.json();
            })
            .then(doc => {
                const modal = document.createElement('div');
                modal.id = 'textContentModal';
                modal.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.5);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 1000;
                `;

                const content = document.createElement('div');
                content.style.cssText = `
                    background: white;
                    border-radius: 8px;
                    padding: 32px;
                    max-width: 600px;
                    width: 90%;
                    max-height: 80vh;
                    overflow-y: auto;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                `;

                const title = document.createElement('h3');
                title.style.cssText = 'margin: 0 0 16px 0; color: #1f2937; font-size: 20px;';
                title.textContent = doc.title;

                const meta = document.createElement('div');
                meta.style.cssText = 'font-size: 12px; color: #6b7280; margin-bottom: 20px;';
                meta.innerHTML = `By ${doc.uploader} • ${new Date(doc.created_at).toLocaleString()}`;

                const textContent = document.createElement('div');
                textContent.style.cssText = `
                    background: #f9fafb;
                    border: 1px solid #e5e7eb;
                    border-radius: 6px;
                    padding: 16px;
                    line-height: 1.6;
                    color: #374151;
                    white-space: pre-wrap;
                    word-wrap: break-word;
                `;
                textContent.textContent = doc.content;

                const closeBtn = document.createElement('button');
                closeBtn.textContent = 'Close';
                closeBtn.style.cssText = `
                    background: #6b7280;
                    color: white;
                    border: none;
                    border-radius: 6px;
                    padding: 10px 20px;
                    margin-top: 20px;
                    cursor: pointer;
                    font-size: 14px;
                    width: 100%;
                `;
                closeBtn.onclick = () => {
                    modal.remove();
                };

                content.appendChild(title);
                content.appendChild(meta);
                content.appendChild(textContent);
                content.appendChild(closeBtn);
                modal.appendChild(content);
                document.body.appendChild(modal);

                modal.onclick = (e) => {
                    if (e.target === modal) modal.remove();
                };
            })
            .catch(error => {
                console.error('Error loading document:', error);
                showNotification('Failed to load document content', 'error');
            });
        }

        // ============================================
        // QA INSPECTION FUNCTIONS (QA Role Only)
        // ============================================
        
        let selectedQAItems = [];
        let currentQARating = 0;

        function openQAInspectModal(materialId, itemName, currentStatus, currentRating, currentRemarks) {
            const modal = document.getElementById('qaInspectModal');
            if (!modal) return;

            document.getElementById('qaInspectMaterialId').value = materialId;
            document.getElementById('qaInspectItemName').textContent = itemName;
            document.getElementById('qaRemarks').value = currentRemarks || '';
            
            // Reset status selection
            document.querySelectorAll('.qa-status-option').forEach(opt => opt.classList.remove('selected'));
            document.querySelectorAll('input[name="qa_status"]').forEach(input => input.checked = false);
            
            // Set current status if exists
            if (currentStatus && currentStatus !== 'pending') {
                const statusInput = document.querySelector(`input[name="qa_status"][value="${currentStatus}"]`);
                if (statusInput) {
                    statusInput.checked = true;
                    statusInput.closest('.qa-status-option').classList.add('selected');
                }
            }
            
            // Set rating
            currentQARating = currentRating || 0;
            setQARating(currentQARating, false);
            
            modal.style.display = 'flex';
        }

        function closeQAInspectModal() {
            const modal = document.getElementById('qaInspectModal');
            if (modal) modal.style.display = 'none';
        }

        function selectQAStatus(input) {
            document.querySelectorAll('.qa-status-option').forEach(opt => opt.classList.remove('selected'));
            input.closest('.qa-status-option').classList.add('selected');
        }

        function setQARating(rating, submit = false) {
            currentQARating = rating;
            document.getElementById('qaRatingValue').value = rating || '';
            
            const ratingTexts = ['Not rated', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
            document.getElementById('qaRatingText').textContent = ratingTexts[rating] || ratingTexts[0];
            
            document.querySelectorAll('.qa-rating-btn i').forEach((star, index) => {
                if (index < rating) {
                    star.style.color = '#fbbf24';
                } else {
                    star.style.color = '#d1d5db';
                }
            });
        }

        function submitQAInspection(event) {
            event.preventDefault();
            
            const form = document.getElementById('qaInspectForm');
            const materialId = document.getElementById('qaInspectMaterialId').value;
            const status = form.querySelector('input[name="qa_status"]:checked');
            
            if (!status) {
                showNotification('Please select an inspection result (Passed, Failed, or Recheck)', 'error');
                return false;
            }
            
            const formData = {
                qa_status: status.value,
                qa_rating: document.getElementById('qaRatingValue').value || null,
                qa_remarks: document.getElementById('qaRemarks').value || null
            };
            
            fetch(`/projects/{{ $project->id }}/materials/${materialId}/qa-inspect`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'QA inspection submitted successfully!', 'success');
                    closeQAInspectModal();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification(data.message || 'Failed to submit inspection', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred while submitting inspection', 'error');
            });
            
            return false;
        }

        // QA Selection Functions
        function toggleAllQAItems() {
            const selectAll = document.getElementById('selectAllQA');
            const checkboxes = document.querySelectorAll('.qa-checkbox');
            
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateQASelection();
        }

        function updateQASelection() {
            const checkboxes = document.querySelectorAll('.qa-checkbox:checked');
            selectedQAItems = Array.from(checkboxes).map(cb => parseInt(cb.dataset.materialId));
            
            const bulkActions = document.getElementById('qaBulkActions');
            const selectedCount = document.getElementById('qaSelectedCount');
            
            if (bulkActions) {
                bulkActions.classList.toggle('show', selectedQAItems.length > 0);
            }
            
            if (selectedCount) {
                selectedCount.textContent = `${selectedQAItems.length} item${selectedQAItems.length !== 1 ? 's' : ''} selected`;
            }
            
            // Update select all checkbox state
            const selectAll = document.getElementById('selectAllQA');
            const allCheckboxes = document.querySelectorAll('.qa-checkbox');
            if (selectAll && allCheckboxes.length > 0) {
                selectAll.checked = checkboxes.length === allCheckboxes.length;
                selectAll.indeterminate = checkboxes.length > 0 && checkboxes.length < allCheckboxes.length;
            }
        }

        function bulkQAAction(status) {
            if (selectedQAItems.length === 0) {
                showNotification('Please select at least one item', 'error');
                return;
            }
            
            const statusLabels = {
                'passed': 'PASSED',
                'failed': 'FAILED',
                'requires_recheck': 'REQUIRES RECHECK'
            };
            
            if (!confirm(`Mark ${selectedQAItems.length} item(s) as ${statusLabels[status]}?`)) {
                return;
            }
            
            submitBulkQA(status, '');
        }

        function openBulkQAModal() {
            const modal = document.getElementById('qaBulkModal');
            if (modal) {
                document.getElementById('bulkQAStatus').value = '';
                document.getElementById('bulkQARemarks').value = '';
                modal.style.display = 'flex';
            }
        }

        function closeBulkQAModal() {
            const modal = document.getElementById('qaBulkModal');
            if (modal) modal.style.display = 'none';
        }

        function submitBulkQAInspection(event) {
            event.preventDefault();
            
            if (selectedQAItems.length === 0) {
                showNotification('Please select items from the table first', 'error');
                return false;
            }
            
            const status = document.getElementById('bulkQAStatus').value;
            const remarks = document.getElementById('bulkQARemarks').value;
            
            if (!status) {
                showNotification('Please select a status to apply', 'error');
                return false;
            }
            
            submitBulkQA(status, remarks);
            return false;
        }

        function submitBulkQA(status, remarks) {
            fetch(`/projects/{{ $project->id }}/qa-bulk-inspect`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    material_ids: selectedQAItems,
                    qa_status: status,
                    qa_remarks: remarks || null
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'Bulk inspection submitted successfully!', 'success');
                    closeBulkQAModal();
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification(data.message || 'Failed to submit bulk inspection', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred during bulk inspection', 'error');
            });
        }

    </script>
</body>

</html>
