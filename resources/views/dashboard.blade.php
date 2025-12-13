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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            --red-600: #dc2626;
            --green-600: #047857;

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
            gap: 12px;

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

        /* KPI Cards Styles */
        .kpi-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .kpi-card {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 6px rgba(30, 64, 175, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(30, 64, 175, 0.2);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 12px rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-projects {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-ongoing {
            background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .kpi-card.color-completed {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .kpi-card.color-delayed {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .kpi-card.color-workers {
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
            border: 1px solid rgba(190, 24, 93, 0.2);
        }

        .kpi-card.color-approvals {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1px solid rgba(217, 119, 6, 0.2);
        }

        .kpi-card.color-budget {
            background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);
            border: 1px solid rgba(168, 85, 247, 0.2);
        }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .kpi-card.color-projects .kpi-icon {
            background: rgba(30, 64, 175, 0.2);
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-icon {
            background: rgba(30, 64, 175, 0.2);
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-icon {
            background: rgba(16, 185, 129, 0.2);
            color: #047857;
        }

        .kpi-card.color-delayed .kpi-icon {
            background: rgba(220, 38, 38, 0.2);
            color: #991b1b;
        }

        .kpi-card.color-workers .kpi-icon {
            background: rgba(190, 24, 93, 0.2);
            color: #831843;
        }

        .kpi-card.color-approvals .kpi-icon {
            background: rgba(217, 119, 6, 0.2);
            color: #92400e;
        }

        .kpi-card.color-budget .kpi-icon {
            background: rgba(168, 85, 247, 0.2);
            color: #6b21a8;
        }

        .kpi-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.7;
        }

        .kpi-card.color-projects .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-label {
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-label {
            color: #047857;
        }

        .kpi-card.color-delayed .kpi-label {
            color: #991b1b;
        }

        .kpi-card.color-workers .kpi-label {
            color: #831843;
        }

        .kpi-card.color-approvals .kpi-label {
            color: #92400e;
        }

        .kpi-card.color-budget .kpi-label {
            color: #6b21a8;
        }

        .kpi-value {
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
        }

        .kpi-card.color-projects .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-value {
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-value {
            color: #047857;
        }

        .kpi-card.color-delayed .kpi-value {
            color: #991b1b;
        }

        .kpi-card.color-workers .kpi-value {
            color: #831843;
        }

        .kpi-card.color-approvals .kpi-value {
            color: #92400e;
        }

        .kpi-card.color-budget .kpi-value {
            color: #6b21a8;
        }

        .kpi-subtitle {
            font-size: 11px;
            opacity: 0.6;
            margin-top: 4px;
        }

        .kpi-card.color-projects .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-ongoing .kpi-subtitle {
            color: #1e3a8a;
        }

        .kpi-card.color-completed .kpi-subtitle {
            color: #047857;
        }

        .kpi-card.color-delayed .kpi-subtitle {
            color: #991b1b;
        }

        .kpi-card.color-workers .kpi-subtitle {
            color: #831843;
        }

        .kpi-card.color-approvals .kpi-subtitle {
            color: #92400e;
        }

        .kpi-card.color-budget .kpi-subtitle {
            color: #6b21a8;
        }

        /* Project Card Styles */
        .project-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .project-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(30, 64, 175, 0.15);
            border-color: #1e40af;
        }

        .project-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .project-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e3a8a;
            flex: 1;
            word-break: break-word;
        }

        .project-card-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .project-card-info {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
            color: #6b7280;
            padding-top: 8px;
            border-top: 1px solid #f3f4f6;
        }

        .project-card-info-item {
            flex: 1;
        }

        .project-card-info-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 4px;
        }

        .project-card-info-value {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        /* BOQ Item Card */
        .boq-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .boq-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .boq-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(30, 64, 175, 0.15);
            border-color: #1e40af;
        }

        .boq-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .boq-card-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e3a8a;
            flex: 1;
            word-break: break-word;
        }

        .boq-card-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .boq-card-project {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .boq-card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            font-size: 13px;
            padding-top: 8px;
            border-top: 1px solid #f3f4f6;
        }

        .boq-detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .boq-detail-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .boq-detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        /* Finance Card */
        .finance-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .finance-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .finance-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(30, 64, 175, 0.15);
            border-color: #1e40af;
        }

        .finance-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e3a8a;
        }

        .finance-card-budget {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .finance-budget-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .finance-budget-amount {
            font-size: 16px;
            font-weight: 700;
            color: #1e3a8a;
        }

        .finance-progress {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 12px 0;
        }

        .finance-progress-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .finance-progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .finance-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1e40af, #60a5fa);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .finance-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }

        .finance-status-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .finance-status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Attendance Card Styles */
        .attendance-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .attendance-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .attendance-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(30, 64, 175, 0.15);
            border-color: #1e40af;
        }

        .attendance-card-date {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .attendance-card-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .attendance-card-detail {
            font-size: 13px;
            color: #6b7280;
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
        }

        .attendance-card-detail-label {
            font-weight: 600;
        }

        .attendance-card-detail-value {
            color: #1f2937;
            font-weight: 600;
        }

        /* Empty State */
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.3;
        }

        .empty-state-text {
            font-size: 16px;
            font-weight: 500;
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
                <!-- KPI Summary Cards -->
                <div class="kpi-cards-container">
                    <!-- Total Projects Card -->
                    <a href="{{ route('projects') }}" class="kpi-card color-projects" title="View all projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Total Projects</div>
                                <div class="kpi-value">{{ number_format($summary['total_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">All projects in system</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Ongoing Projects Card -->
                    <a href="{{ route('projects') }}?status=Ongoing" class="kpi-card color-ongoing" title="View ongoing projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Ongoing Projects</div>
                                <div class="kpi-value">{{ number_format($summary['ongoing_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Currently in progress</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Completed Projects Card -->
                    <a href="{{ route('projects') }}?status=Completed" class="kpi-card color-completed" title="View completed projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Completed Projects</div>
                                <div class="kpi-value">{{ number_format($summary['complete_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Successfully finished</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Delayed Projects Card -->
                    <a href="{{ route('projects') }}?status=Delayed" class="kpi-card color-delayed" title="View delayed projects">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Delayed Projects</div>
                                <div class="kpi-value">{{ number_format($summary['delayed_projects'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Behind schedule</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Total Team Workers Card -->
                    <a href="{{ route('employee') }}" class="kpi-card color-workers" title="View all employees">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Team Workers</div>
                                <div class="kpi-value">{{ number_format($summary['total_workers'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Active employees</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </a>

                    <!-- Pending Approvals Card -->
                    <a href="{{ route('projects') }}" class="kpi-card color-approvals" title="View pending approvals">
                        <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                            <div>
                                <div class="kpi-label">Pending Approvals</div>
                                <div class="kpi-value">{{ number_format($summary['pending_approvals'] ?? 0) }}</div>
                                <div class="kpi-subtitle">Awaiting review</div>
                            </div>
                            <div class="kpi-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                    </a>
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

                            <div class="project-cards-container">
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
                                    <a href="{{ route('projects.show', $project->id) }}" class="project-card">
                                        <div class="project-card-header">
                                            <div class="project-card-title">{{ $project->project_name ?? $project->project_code }}</div>
                                            <span class="project-card-status status-badge {{ $badge['class'] }}">
                                                <i class="{{ $badge['icon'] }}"></i>
                                                {{ $projectDisplayStatus ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="project-card-info">
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Client</div>
                                                <div class="project-card-info-value">{{ $clientName }}</div>
                                            </div>
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Lead</div>
                                                <div class="project-card-info-value">{{ $leadName }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="empty-state-text">You are not assigned to any project</div>
                                    </div>
                                @endforelse
                            </div>
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
                                <div class="attendance-cards-container" style="grid-template-columns: 1fr;">
                                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px;">
                                        <div class="attendance-card-status" style="background: #dbeafe; color: #1e3a8a;">
                                            {{ $todayAttendance->attendance_status }}
                                        </div>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Status:</span>
                                            <span class="attendance-card-detail-value">{{ $todayAttendance->attendance_status }}</span>
                                        </div>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Punch In:</span>
                                            <span class="attendance-card-detail-value">{{ $todayAttendance->punch_in_time ? $todayAttendance->punch_in_time->format('H:i:s') : 'Not yet' }}</span>
                                        </div>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Punch Out:</span>
                                            <span class="attendance-card-detail-value">{{ $todayAttendance->punch_out_time ? $todayAttendance->punch_out_time->format('H:i:s') : '—' }}</span>
                                        </div>
                                        @if ($todayAttendance->is_late)
                                            <div class="attendance-card-detail" style="color: #dc2626;">
                                                <span class="attendance-card-detail-label">Late Arrival:</span>
                                                <span class="attendance-card-detail-value">{{ $todayAttendance->late_minutes }} min</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="empty-state-text">No attendance record for today yet</div>
                                    <a href="{{ $isEmployee ? route('my-attendance') : route('employee-attendance') }}" style="display: inline-block; margin-top: 12px; color: #1e40af; text-decoration: none; font-weight: 600;">Punch in now</a>
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

                            <div class="attendance-cards-container">
                                @forelse ($recentAttendance as $record)
                                    <div class="attendance-card">
                                        <div class="attendance-card-date">{{ $record->date->format('M d, Y') }}</div>
                                        <span class="attendance-card-status status-badge {{ strtolower(str_replace(' ', '-', $record->attendance_status)) }}">
                                            {{ $record->attendance_status }}
                                        </span>
                                        <div class="attendance-card-detail">
                                            <span class="attendance-card-detail-label">Punch In:</span>
                                            <span class="attendance-card-detail-value">{{ $record->punch_in_time ? $record->punch_in_time->format('H:i') : '—' }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-history"></i>
                                        </div>
                                        <div class="empty-state-text">No attendance records yet</div>
                                    </div>
                                @endforelse
                            </div>
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

                            <div class="project-cards-container">
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
                                    <a href="{{ route('projects.show', $project->id) }}" class="project-card">
                                        <div class="project-card-header">
                                            <div class="project-card-title">{{ $project->project_name ?? $project->project_code }}</div>
                                            <span class="project-card-status status-badge {{ $badge['class'] }}">
                                                <i class="{{ $badge['icon'] }}"></i>
                                                {{ $projectDisplayStatus ?? '—' }}
                                            </span>
                                        </div>
                                        <div class="project-card-info">
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Client</div>
                                                <div class="project-card-info-value">{{ $clientName }}</div>
                                            </div>
                                            <div class="project-card-info-item">
                                                <div class="project-card-info-label">Lead</div>
                                                <div class="project-card-info-value">{{ $leadName }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="empty-state-text">No active projects yet</div>
                                    </div>
                                @endforelse
                            </div>
                    </div>

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Financial Overview</div>
                                <div class="dashboard-card-subtitle">Budget and spending analysis</div>
                            </div>
                            <a class="view-link" href="{{ route('finance-graphs') }}" title="View detailed graphs">
                                <i class="fas fa-chart-bar"></i> Detailed View
                            </a>
                        </div>

                        <!-- Finance Summary Stats -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-bottom: 30px;">
                            <div style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #1e3a8a; font-weight: 600; margin-bottom: 8px;">Total Budget</div>
                                <div style="font-size: 20px; font-weight: 700; color: #1e3a8a;">₱{{ number_format($summary['total_budget'] ?? 0, 0) }}</div>
                            </div>
                            <div style="background: linear-gradient(135deg, #fce7f3, #fbcfe8); padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #be185d; font-weight: 600; margin-bottom: 8px;">Total Spent</div>
                                @php
                                    $totalSpent = 0;
                                    foreach($activeProjects as $project) {
                                        if ($project->materials && $project->materials->count() > 0) {
                                            foreach ($project->materials as $material) {
                                                $materialCost = $material->material_cost ?? 0;
                                                $laborCost = $material->labor_cost ?? 0;
                                                $quantity = $material->quantity ?? 0;
                                                $totalSpent += ($materialCost + $laborCost) * $quantity;
                                            }
                                        }
                                    }
                                @endphp
                                <div style="font-size: 20px; font-weight: 700; color: #be185d;">₱{{ number_format($totalSpent, 0) }}</div>
                            </div>
                            <div style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #1e40af; font-weight: 600; margin-bottom: 8px;">Remaining</div>
                                <div style="font-size: 20px; font-weight: 700; color: #1e40af;">₱{{ number_format(($summary['total_budget'] ?? 0) - $totalSpent, 0) }}</div>
                            </div>
                            <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 15px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 12px; color: #92400e; font-weight: 600; margin-bottom: 8px;">Usage</div>
                                <div style="font-size: 20px; font-weight: 700; color: #92400e;">{{ ($summary['total_budget'] ?? 0) > 0 ? round(($totalSpent / ($summary['total_budget'] ?? 1)) * 100, 1) : 0 }}%</div>
                            </div>
                        </div>

                        <!-- Charts Grid -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            <!-- Budget vs Spent Chart -->
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">Budget vs Spent</div>
                                <div style="height: 200px;">
                                    <canvas id="dashboardBudgetChart"></canvas>
                                </div>
                            </div>

                            <!-- Project Distribution Chart -->
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">Budget Distribution</div>
                                <div style="height: 200px;">
                                    <canvas id="dashboardDistributionChart"></canvas>
                                </div>
                            </div>

                            <!-- Project Spending Chart -->
                            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px;">
                                <div style="font-size: 14px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">Spending by Project</div>
                                <div style="height: 200px;">
                                    <canvas id="dashboardProjectChart"></canvas>
                                </div>
                            </div>
                        </div>
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

                        <div class="finance-cards-container">
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
                                    $percentageUsed = $projectBudget > 0 ? round(($totalSpent / $projectBudget) * 100, 1) : 0;
                                    
                                    // Determine status based on remaining budget
                                    if ($projectBudget == 0) {
                                        $budgetStatus = 'info';
                                        $statusText = 'No Budget';
                                        $statusColor = '#d1d5db';
                                    } elseif ($remainingBudget < 0) {
                                        $budgetStatus = 'fail';
                                        $statusText = 'Over Budget';
                                        $statusColor = '#dc2626';
                                    } elseif ($remainingBudget < ($projectBudget * 0.2)) {
                                        $budgetStatus = 'warning';
                                        $statusText = 'Critical';
                                        $statusColor = '#f59e0b';
                                    } else {
                                        $budgetStatus = 'success';
                                        $statusText = 'Healthy';
                                        $statusColor = '#1e40af';
                                    }
                                @endphp
                                <a href="{{ route('projects.show', $project->id) }}" class="finance-card">
                                    <div class="finance-card-title">
                                        {{ $project->project_name ?? $project->project_code }}
                                    </div>
                                    <div class="finance-card-budget">
                                        <span class="finance-budget-label">Budget</span>
                                        <span class="finance-budget-amount">₱{{ number_format($projectBudget, 0) }}</span>
                                    </div>
                                    <div class="finance-progress">
                                        <div class="finance-progress-label">
                                            Spent: <strong>₱{{ number_format($totalSpent, 0) }}</strong> ({{ $percentageUsed }}%)
                                        </div>
                                        <div class="finance-progress-bar">
                                            <div class="finance-progress-fill" style="width: {{ min($percentageUsed, 100) }}%; background: {{ $statusColor }};"></div>
                                        </div>
                                    </div>
                                    <div class="finance-status">
                                        <span class="finance-status-label">Remaining</span>
                                        <span class="finance-status-badge" style="background: {{ $statusColor }}20; color: {{ $statusColor }};">
                                            {{ $statusText }}
                                        </span>
                                    </div>
                                    <div style="padding-top: 8px; border-top: 1px solid #f3f4f6; font-size: 13px; display: flex; justify-content: space-between;">
                                        <span style="color: #6b7280;">Remaining Budget:</span>
                                        <strong style="color: {{ $remainingBudget < 0 ? '#dc2626' : '#1e3a8a' }};">₱{{ number_format($remainingBudget, 0) }}</strong>
                                    </div>
                                </a>
                            @empty
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <div class="empty-state-text">No active projects available</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Chart Colors
        const chartColors = {
            primary: '#1e40af',
            success: '#0369a1',
            warning: '#f59e0b',
            danger: '#ef4444',
            info: '#3b82f6',
            light: '#f3f4f6'
        };

        // Get data from page
        const projectsData = @json($activeProjects->map(function($p) {
            $totalSpent = 0;
            if ($p->materials && $p->materials->count() > 0) {
                foreach ($p->materials as $material) {
                    $materialCost = $material->material_cost ?? 0;
                    $laborCost = $material->labor_cost ?? 0;
                    $quantity = $material->quantity ?? 0;
                    $totalSpent += ($materialCost + $laborCost) * $quantity;
                }
            }
            return [
                'name' => $p->project_name ?? $p->project_code,
                'budget' => $p->allocated_amount ?? 0,
                'spent' => $totalSpent
            ];
        })->toArray() ?? []);

        const totalBudget = @json($summary['total_budget'] ?? 0);
        const totalSpent = (() => {
            let sum = 0;
            projectsData.forEach(p => sum += p.spent);
            return sum;
        })();

        // Chart 1: Budget vs Spent
        if (document.getElementById('dashboardBudgetChart')) {
            const budgetCtx = document.getElementById('dashboardBudgetChart').getContext('2d');
            new Chart(budgetCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Spent', 'Remaining'],
                    datasets: [{
                        data: [totalSpent, totalBudget - totalSpent],
                        backgroundColor: ['#1e40af', '#e5e7eb'],
                        borderColor: ['#fff', '#fff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Chart 2: Project Distribution
        if (document.getElementById('dashboardDistributionChart')) {
            const distributionCtx = document.getElementById('dashboardDistributionChart').getContext('2d');
            new Chart(distributionCtx, {
                type: 'pie',
                data: {
                    labels: projectsData.map(p => p.name),
                    datasets: [{
                        data: projectsData.map(p => p.budget),
                        backgroundColor: [
                            '#1e40af',
                            '#0369a1',
                            '#3b82f6',
                            '#f59e0b',
                            '#ef4444'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Chart 3: Project Spending
        if (document.getElementById('dashboardProjectChart')) {
            const projectCtx = document.getElementById('dashboardProjectChart').getContext('2d');
            new Chart(projectCtx, {
                type: 'bar',
                data: {
                    labels: projectsData.map(p => p.name),
                    datasets: [
                        {
                            label: 'Budget',
                            data: projectsData.map(p => p.budget),
                            backgroundColor: '#1e40af'
                        },
                        {
                            label: 'Spent',
                            data: projectsData.map(p => p.spent),
                            backgroundColor: '#f59e0b'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>

</html>