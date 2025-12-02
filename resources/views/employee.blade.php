<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Employee</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;

            --gray-500: #667085;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #059669;

            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

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
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
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
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }
        .page-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }
        .page-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-box {
            position: relative;
            width: 320px;
            max-width: 40vw;
        }

        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 36px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: var(--shadow-xs);
            outline: none;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 14px;
        }

        .filter-select {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            background: #ffffff;
            font-size: 14px;
            min-width: 180px;
            box-shadow: var(--shadow-xs);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .filter-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }


        .modal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        .modal.active {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-content {
            background: #ffffff;
            border-radius: 16px;
            width: min(640px, 92vw);
            max-height: 90vh;
            overflow-y: auto;
            padding: 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.25);
        }
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--black-1);
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 18px;
            color: #6b7280;
            cursor: pointer;
        }
        .modal-close:hover {
            color: #111827;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }
        .form-card.hidden {
            display: none;
        }
        .form-card,
        .table-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            padding: 24px;
        }
        .form-card h2 {
            font-size: 20px;
            margin-bottom: 16px;
            color: var(--black-1);
        }
        .form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .form-field label {
            font-size: 13px;
            color: #374151;
            font-weight: 500;
        }
        .form-field input,
        .form-field select,
        .form-field textarea {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 14px;
            background: #ffffff;
            outline: none;
            font-size: 14px;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            background: #ffffff;
            color: #111827;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
            font-weight: 500;
        }
        .btn-outline {
            border: 1px solid #d1d5db;
        }
        .btn-green {
            background: var(--accent);
            color: #ffffff;
        }
        .btn-green:hover { filter: brightness(0.93); }

        .table-card h2 {
            font-size: 20px;
            margin-bottom: 16px;
            color: var(--black-1);
        }
        .employee-table {
            width: 100%;
            border-collapse: collapse;
        }
        .employee-table thead {
            background: var(--accent);
            color: #ffffff;
        }
        .employee-table thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
        }
        .employee-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--black-1);
            font-size: 14px;
        }
        .employee-table tbody tr:last-child td {
            border-bottom: none;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-on-site { background: #dcfce7; color: #166534; }
        .status-on-leave { background: #fef3c7; color: #92400e; }
        .status-absent { background: #fee2e2; color: #991b1b; }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Employees Toolbar */
        .employee-header {
            background: white;
            border-radius: 12px;
            padding: 16px 16px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .employee-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 20px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #111827;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
        }
        .btn:hover { background: #f9fafb; }
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .btn-primary:hover { background: #15803d; }

        .btn-success {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .btn-success:hover { background: #15803d; }

        /* Employee Cards */
        .employee-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .employee-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        /* Form Layout */
        .form-wrapper {
            display: none;
            flex-direction: column;
            gap: 20px;
        }
        .form-header {
            background: white;
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .back-btn {
            background: none;
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            color: #111827;
        }
        .section-card {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
        }
        .section-title {
            color: #111827;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .section-note {
            color: #ef4444;
            font-size: 12px;
            margin-bottom: 12px;
        }
        .grid {
            display: grid;
            gap: 12px;
        }
        .grid.cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        .grid.cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .field label {
            font-size: 13px;
            color: #374151;
        }
        .field input, .field select {
            height: 36px;
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #ffffff;
            outline: none;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-success { background: var(--accent); border-color: var(--accent); color: #fff; }
        .btn-success:hover { filter: brightness(0.95); }

        @media (max-width: 1024px) {
            .grid.cols-5, .grid.cols-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        .employee-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .employee-card-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .employee-expand {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 16px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .employee-expand:hover {
            background-color: var(--gray-100);
        }

        /* Tables */
        .employee-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .employee-table thead {
            color: white;
        }

        .employee-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .employee-table tbody tr {
            border-bottom: 1px solid var(--gray-200);
        }

        .employee-table tbody tr:last-child {
            border-bottom: none;
        }

        .employee-table tbody td {
            padding: 12px 16px;
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
        }

        .employee-table thead {
            background: var(--green-600);
        }
        .employee-table thead th:first-child { border-top-left-radius: 8px; }
        .employee-table thead th:last-child { border-top-right-radius: 8px; }
        .actions {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-700);
        }
        .actions i { cursor: pointer; }

        .employee-table.attendance thead {
            background: var(--red-600);
        }

        /* Status badges */
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.on-leave {
            background: transparent;
            color: #92400e;
        }

        .status-badge.on-site {
            background: transparent;
            color: #065f46;
        }

        /* Responsive Design */
        @media (max-width: 768px) {


            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .employee-table {
                font-size: 14px;
            }

            .employee-table thead th,
            .employee-table tbody td {
                padding: 8px 12px;
            }

            .employee-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
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
            justify-content: center;
            gap: 12px;
        }
        .pagination-nav {
            display: flex;
            align-items: center;
            justify-content: center;
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
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        /* Links - always underlined */
        a.page-btn {
            color: #374151;
            text-decoration: underline !important;
        }
        a.page-btn:hover {
            color: #111827;
            text-decoration: underline !important;
            background: transparent !important;
        }
        /* Spans - no underline */
        span.page-btn {
            text-decoration: none;
            color: #374151;
        }
        /* Active page - green background */
        span.page-btn.active {
            background: var(--accent) !important;
            color: white !important;
            font-weight: 600;
            text-decoration: none !important;
            border-radius: 8px;
            padding: 0 12px;
        }
        /* Disabled - light grey */
        span.page-btn.disabled {
            opacity: 0.5;
            color: #9ca3af !important;
            cursor: not-allowed;
            pointer-events: none;
            text-decoration: none !important;
        }
        /* Arrow styling */
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
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
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
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please fix the following:</strong>
                        <ul style="margin-top: 8px; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="page-header">
                    <h1 class="page-title">Employees</h1>
                    <form class="page-controls" method="GET" action="{{ route('employee') }}">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input
                                type="text"
                                name="search"
                                placeholder="Search by name or ID"
                                value="{{ request('search') }}"
                                aria-label="Search employees"
                            />
                        </div>
                        <select name="position" class="filter-select" aria-label="Filter by position">
                            <option value="">All Positions</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position }}" @selected(request('position') === $position)>{{ $position }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline" type="submit"><i class="fas fa-filter"></i> Apply</button>
                        @if (request()->filled('search') || request()->filled('position'))
                            <a class="btn btn-outline" href="{{ route('employee') }}">Reset</a>
                        @endif
                        <button class="btn btn-green" type="button" id="openEmployeeModal"><i class="fas fa-user-plus"></i> Add Employee</button>
                    </form>
                </div>

                <div class="table-card">
                    <h2>Employee Directory</h2>
                    <table class="employee-table">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>{{ 'EMP' . str_pad($employee->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $employee->f_name }}</td>
                                    <td>{{ $employee->l_name }}</td>
                                    <td>{{ $employee->position ?? '—' }}</td>
                                    <td>{{ $employee->user->email ?? '—' }}</td>
                                    <td>{{ $employee->user->phone ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding: 24px; color: #6b7280;">No employees yet. Add your first employee using the button above.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($employees instanceof \Illuminate\Pagination\LengthAwarePaginator && $employees->hasPages())
                        @php
                            $currentPage = $employees->currentPage();
                            $lastPage = $employees->lastPage();
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
                        <div class="pagination-container" style="display: flex; flex-direction: column; align-items: center; gap: 16px; padding: 20px 0;">
                            <div class="pagination-info" style="color: #6b7280; font-size: 14px; text-align: center;">
                                Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }}
                                of {{ $employees->total() }} employees
                            </div>
                            <div class="pagination-controls" style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                                @if ($employees->onFirstPage())
                                    <span class="page-btn arrow disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; text-decoration: none; font-size: 20px;">‹</span>
                                @else
                                    <a class="page-btn arrow" href="{{ $employees->previousPageUrl() }}" rel="prev" style="color: #374151; text-decoration: underline; font-size: 20px;">‹</a>
                                @endif

                                <div class="pagination-nav" style="display: flex; align-items: center; justify-content: center; gap: 4px;">
                                    <span class="page-btn active" style="background: var(--accent); color: white; font-weight: 600; text-decoration: none; border-radius: 8px; padding: 0 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">{{ $currentPage }}</span>
                                    @if ($currentPage < $lastPage)
                                        <a class="page-btn" href="{{ $employees->url($currentPage + 1) }}" style="color: #374151; text-decoration: underline; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">{{ $currentPage + 1 }}</a>
                                    @endif
                                </div>

                                @if ($employees->hasMorePages())
                                    <a class="page-btn arrow" href="{{ $employees->nextPageUrl() }}" rel="next" style="color: #374151; text-decoration: underline; font-size: 20px;">›</a>
                                    @if ($currentPage < $lastPage - 1)
                                        <a class="page-btn arrow" href="{{ $employees->url($lastPage) }}" rel="last" style="color: #374151; text-decoration: underline; font-size: 20px;">››</a>
                                    @endif
                                @else
                                    <span class="page-btn arrow disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; text-decoration: none; font-size: 20px;">›</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </section>
        </main>
    </div>

    <div class="modal" id="employeeModal" aria-hidden="true">
        <div class="modal-content" role="dialog" aria-modal="true">
            <div class="modal-header">
                <h2 class="modal-title">Add Employee</h2>
                <button class="modal-close" id="closeEmployeeModal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>

            <form action="{{ route('employee.store') }}" method="POST" id="employeeForm" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-field">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="position">Position</label>
                        <select id="position" name="position">
                            <option value="" {{ old('position') === null ? 'selected' : '' }}>Select position</option>
                            <option value="Project Manager" {{ old('position') === 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                            <option value="Site Supervisor" {{ old('position') === 'Site Supervisor' ? 'selected' : '' }}>Site Supervisor</option>
                            <option value="Finance Manager" {{ old('position') === 'Finance Manager' ? 'selected' : '' }}>Finance Manager</option>
                            <option value="HR/Timekeeper" {{ old('position') === 'HR/Timekeeper' ? 'selected' : '' }}>HR/Timekeeper</option>
                            <option value="Quality Assurance Officer" {{ old('position') === 'Quality Assurance Officer' ? 'selected' : '' }}>Quality Assurance Officer</option>
                            <option value="Construction Worker" {{ old('position') === 'Construction Worker' ? 'selected' : '' }}>Construction Worker</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-field">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+63-000-000-0000">
                    </div>
                </div>
                <div class="form-actions" style="margin-top: 24px;">
                    <button type="button" class="btn btn-outline" id="cancelEmployeeModal">Cancel</button>
                    <button type="submit" class="btn btn-green"><i class="fas fa-save"></i> Save Employee</button>
                </div>
            </form>
        </div>
    </div>

    @include('partials.sidebar-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openBtn = document.getElementById('openEmployeeModal');
            const closeBtn = document.getElementById('closeEmployeeModal');
            const cancelBtn = document.getElementById('cancelEmployeeModal');
            const modal = document.getElementById('employeeModal');
            const form = document.getElementById('employeeForm');
            const phoneInput = document.getElementById('phone');

            // Format phone number in real-time
            function formatPhoneNumber(value) {
                // Remove all non-numeric characters except +
                let cleaned = value.replace(/[^\d+]/g, '');
                
                // Remove leading + if present
                cleaned = cleaned.replace(/^\+/, '');
                
                // If starts with 0, replace with 63
                if (cleaned.startsWith('0')) {
                    cleaned = '63' + cleaned.substring(1);
                }
                
                // Remove all non-digits
                cleaned = cleaned.replace(/\D/g, '');
                
                // If it's 10 digits, prepend 63
                if (cleaned.length === 10) {
                    cleaned = '63' + cleaned;
                }
                
                // Format as +63-XXX-XXX-XXXX
                if (cleaned.length === 12) {
                    return '+' + cleaned.substring(0, 2) + '-' + cleaned.substring(2, 5) + '-' + cleaned.substring(5, 8) + '-' + cleaned.substring(8, 12);
                }
                
                return value;
            }

            if (phoneInput) {
                phoneInput.addEventListener('input', function (e) {
                    const formatted = formatPhoneNumber(e.target.value);
                    e.target.value = formatted;
                });

                phoneInput.addEventListener('blur', function (e) {
                    const formatted = formatPhoneNumber(e.target.value);
                    e.target.value = formatted;
                });
            }

            function openModal() {
                if (!modal) return;
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
            }

            function closeModal() {
                if (!modal) return;
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                if (form) form.reset();
            }

            if (openBtn) openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

            if (modal) {
                modal.addEventListener('click', function (event) {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            }

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });

            if ({!! $errors->any() ? 'true' : 'false' !!}) {
                openModal();
            }
        });
    </script>
</body>

</html>
