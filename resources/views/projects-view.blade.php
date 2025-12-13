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
                            <button type="button" class="btn btn-primary" onclick="return openBOQModal();">
                                <i class="fas fa-plus"></i> Add BOQ Item
                            </button>
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
                                                        <button class="btn" style="background: #dbeafe; color: #0369a1; padding: 6px 10px; font-size: 12px; border: none; border-radius: 4px; cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" onclick="editBOQItem({{ $material->id }})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn" style="background: #e0e7ff; color: #4f46e5; padding: 6px 10px; font-size: 12px; border: none; border-radius: 4px; cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" onclick="viewBOQTasks('{{ $material->item_description }}', {{ $material->id }})">>
                                                            <i class="fas fa-tasks"></i>
                                                        </button>
                                                        <button type="button" class="btn" style="background: #fee2e2; color: #991b1b; padding: 6px 10px; font-size: 12px; border: none; border-radius: 4px; cursor: pointer; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;" onclick="confirmSingleDelete({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'this item') }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
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
                                </style>
                            </div>

                            <!-- Bulk Status Update Controls -->
                            @if ($materials && $materials->count() > 0)
                            <div style="display: flex; gap: 12px; margin-bottom: 20px; align-items: center; flex-wrap: wrap;">
                                <select id="bulkStatusSelect" style="padding: 8px 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px; min-width: 160px;">
                                    <option value="">-- Change Status To --</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="failed">Failed</option>
                                </select>
                                <button type="button" id="applyBulkStatusBtn" class="btn btn-primary" style="display: none;" onclick="applyBulkTransactionStatus()">
                                    <i class="fas fa-check"></i> Apply to Selected (<span id="selectedTransactionCount">0</span>)
                                </button>
                            </div>
                            @endif

                            @if ($materials && $materials->count() > 0)
                                <div style="overflow-x: auto;">
                                    <table style="width: 100%; border-collapse: collapse; font-size: 17px;">
                                        <thead>
                                            <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                                <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); width: 50px;">
                                                    <input type="checkbox" id="selectAllTransactions" onchange="toggleAllTransactions()" style="cursor: pointer; width: 18px; height: 18px;">
                                                </th>
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
                                                    <td style="padding: 12px; text-align: center;">
                                                        <input type="checkbox" class="transaction-checkbox" data-material-id="{{ $material->id }}" onchange="updateTransactionSelectionCount()" style="cursor: pointer; width: 18px; height: 18px;">
                                                    </td>
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
                                                        <select class="status-select" data-material-id="{{ $material->id }}" onchange="updateMaterialStatus(this.dataset.materialId, this.value)">
                                                            <option value="pending" {{ strtolower($material->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="approved" {{ strtolower($material->status ?? 'pending') === 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="failed" {{ strtolower($material->status ?? 'pending') === 'failed' ? 'selected' : '' }}>Failed</option>
                                                        </select>
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
                            <button class="btn btn-primary" onclick="openEmployeeModal()">
                                <i class="fas fa-plus"></i> Add Team Worker
                            </button>
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
                                    @if ($project->assignedPM)
                                        @php
                                            // Calculate PM attendance data
                                            $dateFrom = '2025-12-01';
                                            $dateTo = '2025-12-31';
                                            
                                            $pmAttendanceRecords = \App\Models\EmployeeAttendance::where('employee_id', $project->assignedPM->id)
                                                ->whereBetween('date', [$dateFrom, $dateTo])
                                                ->whereNotNull('punch_in_time')
                                                ->whereNotNull('punch_out_time')
                                                ->get();
                                            
                                            $pmDaysWorked = $pmAttendanceRecords->count();
                                            $pmTotalHoursWorked = $pmAttendanceRecords->sum(function($att) {
                                                return $att->getHoursWorked() ?? 0;
                                            });
                                            
                                            // Get daily rate for Project Manager position
                                            $pmPositionRate = \App\Models\PositionDailyRate::where('position', 'Project Manager')->first();
                                            $pmDailyRate = $pmPositionRate ? $pmPositionRate->daily_rate : 700.00;
                                            $pmHourlyRate = \App\Models\EmployeeAttendance::calculateHourlyRate($pmDailyRate);
                                            
                                            // Calculate labor cost
                                            $pmLaborCost = 0;
                                            foreach($pmAttendanceRecords as $att) {
                                                $pmLaborCost += $att->calculateLaborCost($pmDailyRate);
                                            }
                                        @endphp
                                        <tr style="border-bottom: 1px solid var(--gray-400);">
                                            <td style="padding: 12px; color: var(--black-1);">{{ $project->assignedPM->name }}</td>
                                            <td style="padding: 12px; color: var(--gray-700);">Project Manager</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700);">{{ $pmDaysWorked }}</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">{{ number_format($pmTotalHoursWorked, 2) }} hrs</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($pmHourlyRate, 2) }}/hr</td>
                                            <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">₱{{ number_format($pmLaborCost, 2) }}</td>
                                            <td style="padding: 12px; color: var(--gray-700); font-style: italic; font-size: 12px;">Auto-assigned</td>
                                        </tr>
                                    @endif
                                    @if ($project->employees && $project->employees->count() > 0)
                                        @foreach ($project->employees as $employee)
                                            @php
                                                // Get attendance records with actual hours worked
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
                                                $position = $employee->position ?? 'Laborer';
                                                $positionRate = \App\Models\PositionDailyRate::where('position', $position)->first();
                                                $dailyRate = $positionRate ? $positionRate->daily_rate : 700.00;
                                                $hourlyRate = \App\Models\EmployeeAttendance::calculateHourlyRate($dailyRate);
                                                
                                                // Calculate labor cost based on actual hours worked
                                                $laborCost = 0;
                                                foreach($empAttendanceRecords as $att) {
                                                    $laborCost += $att->calculateLaborCost($dailyRate);
                                                }
                                            @endphp
                                            <tr style="border-bottom: 1px solid var(--gray-400);">
                                                <td style="padding: 12px; color: var(--black-1);">{{ $employee->full_name ?? ($employee->f_name . ' ' . $employee->l_name) }}</td>
                                                <td style="padding: 12px; color: var(--gray-700);">{{ $employee->position ?? 'N/A' }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700);">{{ $daysWorked }}</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">{{ number_format($totalHoursWorked, 2) }} hrs</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($hourlyRate, 2) }}/hr</td>
                                                <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600;">₱{{ number_format($laborCost, 2) }}</td>
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
                                <p>No team workers assigned yet. Click "Add Team Worker" to begin.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Updates Tab -->

                <!-- Images Tab -->
                <div id="images" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Upload Documentation</div>
                        <form method="POST" action="{{ route('projects.documents.store', $project->id) }}" enctype="multipart/form-data" style="margin-bottom: 30px;">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">File Title</label>
                                <input type="text" name="title" class="form-input" placeholder="Enter file title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Attachments</label>
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
                                <i class="fas fa-upload"></i> Upload Files
                            </button>
                        </form>

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

                <!-- Reports Tab -->
                <div id="report" class="tab-content">
                    <div class="report-section">
                        <div class="report-title">Project Summary Report</div>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-value">{{ $project->employees->count() }}</div>
                                <div class="stat-label">Assigned Employees</div>
                            </div>
                            @php
                                $effectiveUsedAmount = $project->getEffectiveUsedAmount();
                                $budgetUtilized = $project->allocated_amount > 0 ? round(($effectiveUsedAmount / $project->allocated_amount) * 100, 2) : 0;
                            @endphp
                            <div class="stat-item">
                                <div class="stat-value">₱{{ number_format($effectiveUsedAmount, 2) }}</div>
                                <div class="stat-label">Amount Used</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $budgetUtilized }}%</div>
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

        <!-- BOQ Item Modal -->
        <div id="boqModal" class="modal" style="display: none;">
            <div class="modal-content" style="max-width: 700px;">
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
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Category</label>
                            <input type="text" id="boqCategory" name="category" placeholder="e.g., COLD & HOT WATER" 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Item Description * <span style="font-size: 12px; color: #6b7280; font-weight: 400;">(Use line breaks for hierarchy)</span></label>
                            <textarea id="boqItemDescription" name="item_description" placeholder="Enter item description&#10;Example:&#10;PVC Pipe Schedule 40&#10;  - 50mm diameter&#10;  - per meter" required rows="4"
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 15px; white-space: pre-wrap;"></textarea>
                            <small style="color: #6b7280; display: block; margin-top: 6px;">💡 Tip: Use line breaks and indentation to create a structured format</small>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Quantity *</label>
                                <input type="number" id="boqQuantity" name="quantity" placeholder="0" step="1" min="1" required 
                                    style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Unit *</label>
                                <select id="boqUnit" name="unit" required
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

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Material Cost (₱)</label>
                            <input type="number" id="boqMaterialCost" name="material_cost" placeholder="0.00" step="0.01" 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                        </div>

                        <div style="margin-bottom: 15px; padding: 12px; background: #f0f9ff; border: 1px solid #bfdbfe; border-radius: 6px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #0369a1;">Labor Cost (Auto-calculated)</label>
                            <input type="number" id="boqLaborCost" name="labor_cost" placeholder="0.00" step="0.01" readonly
                                style="width: 100%; padding: 8px; border: 1px solid #bfdbfe; border-radius: 4px; font-size: 14px; background: #dbeafe; color: #0369a1;">
                            <small style="color: #0369a1; display: block; margin-top: 6px;">Calculated as: Material Cost ÷ 2</small>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Notes</label>
                            <textarea id="boqNotes" name="notes" placeholder="Additional notes or remarks" rows="2"
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px; font-family: var(--text-md-normal-font-family);"></textarea>
                        </div>

                        <input type="hidden" id="boqStatus" name="status" value="pending">
                    </div>

                    <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid var(--gray-400); display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn" style="background: var(--gray-400); color: var(--black-1); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;" onclick="closeBOQModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Save BOQ Item</button>
                    </div>
                </form>
            </div>
        </div>

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
                        <button type="button" class="btn btn-primary" onclick="openAddTaskModal()" style="width: 100%; padding: 10px 16px;">
                            <i class="fas fa-plus"></i> Add Task for This Item
                        </button>
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
                                            <div class="timeline-header">
                                                <h5 style="margin: 0 0 5px 0; color: #1f2937;">{{ $update->title }}</h5>
                                                <span class="timeline-status" style="background-color: @if($update->status === 'Completed') #dcfce7; color: #166534; @else #bfdbfe; color: #1e40af; @endif; display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                                    @if($update->status === 'Completed')
                                                        <i class="fas fa-check-circle"></i> Complete
                                                    @else
                                                        <i class="fas fa-hourglass-half"></i> Ongoing
                                                    @endif
                                                </span>
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

                <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid var(--gray-400); display: flex; justify-content: flex-end;">
                    <button type="button" class="btn" style="background: var(--gray-400); color: var(--black-1); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;" onclick="closeBOQTasksModal()">Close</button>
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
                    
                    <div style="padding: 20px;">
                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Task Title *</label>
                            <input type="text" id="taskTitle" name="title" placeholder="Enter task title" required 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description *</label>
                            <textarea id="taskDescription" name="description" placeholder="Enter task description" required rows="3"
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px; font-family: var(--text-md-normal-font-family);"></textarea>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Status</label>
                            <select id="taskStatus" name="status" 
                                style="width: 100%; padding: 8px; border: 1px solid var(--gray-400); border-radius: 4px; font-size: 14px;">
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="In Progress">In Progress</option>
                            </select>
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
        console.log('Project Employees:', projectEmployees);

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
            console.log('Total employees available:', allEmployees.length);

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
                
                // Skip Project Managers entirely
                if (position.toLowerCase().includes('project manager') || position.toLowerCase().includes('manager')) {
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

                    const employeeItem = document.createElement('div');
                    employeeItem.className = 'employee-item';
                    employeeItem.style.cssText = 'display: flex; align-items: center; gap: 12px; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 6px; background: #fafafa; transition: all 0.2s;';
                    employeeItem.innerHTML = `
                        <input 
                            type="checkbox" 
                            value="${employee.id}"
                            ${isAssigned ? 'checked' : ''}
                            ${isAssignedToOtherProject ? 'disabled' : ''}
                            class="employee-checkbox"
                            style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--accent);"
                        >
                        <div style="flex: 1;">
                            <div style="font-weight: 500; color: #111827; font-size: 14px;">${employee.f_name} ${employee.l_name}</div>
                            <div style="font-size: 11px; color: #6b7280; margin-top: 2px;">EMP${String(employee.id).padStart(3, '0')}</div>
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
                .map(cb => parseInt(cb.value));

            if (selectedEmployeeIds.length === 0) {
                showNotification('Please select at least one employee to assign.', 'error');
                return;
            }

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

        // Apply status select coloring
        function setStatusSelectColor(selectEl) {
            if (!selectEl) return;
            const val = (selectEl.value || '').toLowerCase();
            let color = '#1f2937';
            if (val === 'pending') color = '#d97706';
            else if (val === 'approved') color = '#16a34a';
            else if (val === 'failed') color = '#dc2626';
            selectEl.style.color = color;
        }

        function initStatusSelectColors() {
            document.querySelectorAll('.status-select').forEach(sel => {
                setStatusSelectColor(sel);
                sel.addEventListener('change', () => setStatusSelectColor(sel));
            });
        }

        // Check for flash messages on page load and init status colors
        document.addEventListener('DOMContentLoaded', function() {
            const successMsg = document.getElementById('flashSuccessMessage');
            const errorMsg = document.getElementById('flashErrorMessage');
            
            if (successMsg) {
                showNotification(successMsg.textContent, 'success');
            } else if (errorMsg) {
                showNotification(errorMsg.textContent, 'error');
            }

            initStatusSelectColors();
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
            const modal = document.getElementById('boqTasksModal');
            const title = document.getElementById('boqTasksTitle');
            const details = document.getElementById('boqItemDetails');
            
            if (!modal) {
                showNotification('Tasks modal not found', 'error');
                return;
            }
            
            // Store current BOQ item for task creation
            currentBOQItem.id = materialId;
            currentBOQItem.description = itemDescription;
            
            title.textContent = 'Tasks for: ' + itemDescription;
            details.innerHTML = `
                <strong>Item Description:</strong><br>
                ${itemDescription}<br><br>
                <div style="font-size: 12px; color: #6b7280; margin-top: 8px;">
                    <i class="fas fa-info-circle"></i> View all project tasks related to this BOQ item
                </div>
            `;
            
            loadTasksForItem(materialId);
            modal.style.display = 'flex';
        }

        function closeBOQTasksModal() {
            const modal = document.getElementById('boqTasksModal');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        function loadTasksForItem(materialId) {
            const tasksList = document.getElementById('boqTasksList');
            
            // Filter the tasks based on material_id
            fetch(`/projects/{{ $project->id }}/tasks?material_id=${materialId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to load tasks');
                return response.json();
            })
            .then(data => {
                if (data.tasks && data.tasks.length > 0) {
                    let html = '<div class="updates-timeline">';
                    
                    data.tasks.forEach(task => {
                        const taskStatus = task.status === 'Completed' ? 'completed' : 'ongoing';
                        const statusClass = task.status === 'Completed' 
                            ? '#dcfce7; color: #166534' 
                            : '#bfdbfe; color: #1e40af';
                        const statusBg = task.status === 'Completed' ? '#1e40af' : '#3b82f6';
                        
                        html += `
                            <div class="timeline-item task-item" data-status="${taskStatus}" style="margin-bottom: 15px;">
                                <div class="timeline-marker" style="background-color: ${statusBg};"></div>
                                <div class="timeline-content" style="padding: 12px; background: #f9fafb; border-radius: 6px; border-left: 2px solid #e5e7eb;">
                                    <div class="timeline-header">
                                        <h5 style="margin: 0 0 5px 0; color: #1f2937;">${task.title}</h5>
                                        <span class="timeline-status" style="background-color: ${statusClass}; display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                            ${task.status === 'Completed' ? '<i class="fas fa-check-circle"></i> Complete' : '<i class="fas fa-hourglass-half"></i> Ongoing'}
                                        </span>
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
            document.getElementById('taskStatus').value = 'Ongoing';
            
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
            const status = document.getElementById('taskStatus').value;
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
                const contentType = response.headers.get('content-type');
                
                if (!response.ok) {
                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(err => {
                            throw new Error(err.message || `Server error: ${response.status}`);
                        });
                    } else {
                        throw new Error(`Server error: ${response.status}`);
                    }
                }
                
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // If response is not JSON, assume success
                    return { success: true, message: 'Task added successfully' };
                }
            })
            .then(data => {
                if (data.success) {
                    showNotification('Task added successfully for: ' + boqItemName, 'success');
                    closeAddTaskModal();
                    
                    // Reload only the tasks list for this item
                    if (currentBOQItem.id) {
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
        function toggleAllTransactions() {
            const selectAll = document.getElementById('selectAllTransactions');
            const checkboxes = document.querySelectorAll('.transaction-checkbox');
            checkboxes.forEach(cb => { cb.checked = selectAll.checked; });
            updateTransactionSelectionCount();
        }

        function updateTransactionSelectionCount() {
            const selected = document.querySelectorAll('.transaction-checkbox:checked').length;
            const statusSelect = document.getElementById('bulkStatusSelect');
            const applyBtn = document.getElementById('applyBulkStatusBtn');
            const countSpan = document.getElementById('selectedTransactionCount');

            if (countSpan) countSpan.textContent = selected;
            if (applyBtn && statusSelect) {
                applyBtn.style.display = (selected > 0 && statusSelect.value) ? 'inline-flex' : 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const statusSelect = document.getElementById('bulkStatusSelect');
            if (statusSelect) {
                statusSelect.addEventListener('change', updateTransactionSelectionCount);
            }
        });

        function applyBulkTransactionStatus() {
            const statusSelect = document.getElementById('bulkStatusSelect');
            const newStatus = statusSelect?.value;
            const checked = Array.from(document.querySelectorAll('.transaction-checkbox:checked'));

            if (!newStatus) {
                showNotification('Please choose a status to apply.', 'info');
                return;
            }
            if (checked.length === 0) {
                showNotification('Please select at least one transaction.', 'info');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                showNotification('CSRF token missing. Refresh and try again.', 'error');
                return;
            }

            const updates = checked.map(cb => {
                const materialId = cb.dataset.materialId;
                return fetch(`/projects/{{ $project->id }}/materials/${materialId}`, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to load material data');
                    return response.json();
                })
                .then(material => {
                    const formData = new FormData();
                    formData.append('_method', 'PUT');
                    formData.append('_token', csrfToken);
                    formData.append('item_description', material.item_description || '');
                    formData.append('quantity', material.quantity || 1);
                    formData.append('unit', material.unit || '');
                    formData.append('material_cost', material.material_cost || 0);
                    formData.append('labor_cost', material.labor_cost || 0);
                    formData.append('category', material.category || '');
                    formData.append('notes', material.notes || '');
                    formData.append('status', newStatus);

                    return fetch(`/projects/{{ $project->id }}/materials/${materialId}`, {
                        method: 'POST',
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData
                    });
                });
            });

            Promise.allSettled(updates).then(results => {
                const completed = results.filter(r => r.status === 'fulfilled').length;
                const failed = results.length - completed;

                // Update UI selections and status colors
                checked.forEach(cb => {
                    cb.checked = false;
                    const row = cb.closest('tr');
                    const select = row?.querySelector('.status-select');
                    if (select) {
                        select.value = newStatus;
                        setStatusSelectColor(select);
                    }
                });

                const selectAll = document.getElementById('selectAllTransactions');
                if (selectAll) selectAll.checked = false;
                if (statusSelect) statusSelect.value = '';
                updateTransactionSelectionCount();

                if (failed === 0) {
                    showNotification(`Updated ${completed} transaction(s).`, 'success', true);
                } else {
                    showNotification(`Updated ${completed} transaction(s); ${failed} failed.`, 'error');
                }
            }).catch(error => {
                console.error('Bulk update error:', error);
                showNotification('Bulk update failed. Please try again.', 'error');
            });
        }

        // Update material status from Finance & Transactions table
        function updateMaterialStatus(materialId, newStatus) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken) {
                showNotification('CSRF token not found. Please refresh and try again.', 'error');
                return;
            }

            // First, fetch the existing material data
            fetch(`/projects/{{ $project->id }}/materials/${materialId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to load material data');
                return response.json();
            })
            .then(material => {
                // Now send the update with all required fields
                const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('_token', csrfToken);
                formData.append('item_description', material.item_description || '');
                formData.append('quantity', material.quantity || 1);
                formData.append('unit', material.unit || '');
                formData.append('material_cost', material.material_cost || 0);
                formData.append('labor_cost', material.labor_cost || 0);
                formData.append('category', material.category || '');
                formData.append('notes', material.notes || '');
                formData.append('status', newStatus);

                return fetch(`/projects/{{ $project->id }}/materials/${materialId}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
            })
            .then(response => {
                const contentType = response.headers.get('content-type') || '';
                if (!response.ok) {
                    if (contentType.includes('application/json')) {
                        return response.json().then(err => { throw new Error(err.message || 'Failed to update status'); });
                    }
                    return response.text().then(text => { throw new Error(text || 'Failed to update status'); });
                }
                if (contentType.includes('application/json')) {
                    return response.json();
                }
                return { success: true };
            })
            .then(data => {
                if (data.success) {
                    showNotification('Status updated successfully', 'success');
                } else {
                    showNotification(data.message || 'Failed to update status', 'error');
                }
            })
            .catch(error => {
                console.error('Status update error:', error);
                showNotification(error.message || 'Failed to update status', 'error');
            });
        }

        // Documentation filter
        function filterDocuments(type) {
            const cards = document.querySelectorAll('#documentationGrid .image-card');
            cards.forEach(card => {
                const docType = card.getAttribute('data-doc-type') || 'other';
                if (type === 'all' || docType === type) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

    </script>
</body>

</html>
