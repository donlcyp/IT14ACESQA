<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Attendance History</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
            --white: #ffffff;

            --gray-500: #667085;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: #dc2626;
            --green-600: #1e40af;

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
            font-family: 'Inter', sans-serif;
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
        
        .main-content.sidebar-closed { 
            margin-left: 0; 
        }
        
        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }
        
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
            background: var(--header-bg);
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
            background: transparent;
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
            background: transparent;
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Page Header */
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
        
        /* Filters */
        .filters-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-md);
        }
        .filters-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: flex-end;
        }
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .filter-group label {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
        }
        .filter-input {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            background: #ffffff;
            font-size: 14px;
            min-width: 180px;
            box-shadow: var(--shadow-xs);
            outline: none;
        }
        .filter-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
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
        .btn:hover {
            filter: brightness(0.95);
        }
        .btn-primary {
            background: var(--accent);
            color: #ffffff;
        }
        .btn-primary:hover {
            filter: brightness(0.9);
        }
        .btn-outline {
            border: 1px solid #d1d5db;
            background: #ffffff;
        }

        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border-radius: 14px;
            padding: 22px;
            box-shadow: var(--shadow-md);
        }
        .stat-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #ffffff;
        }
        .stat-text p {
            margin: 0;
            color: var(--gray-600);
            font-size: 14px;
        }
        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--black-1);
        }
        .stat-total .stat-icon { background: #3b82f6; }
        .stat-onsite .stat-icon { background: #1e40af; }
        .stat-absent .stat-icon { background: #ef4444; }
        .stat-leave .stat-icon { background: #f97316; }

        /* Table */
        .table-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }
        .history-table {
            width: 100%;
            border-collapse: collapse;
        }
        .history-table thead {
            background: var(--accent);
            color: #ffffff;
        }
        .history-table thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
        }
        .history-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--black-1);
            font-size: 14px;
        }
        .history-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badge Styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-idle {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }
        .status-on-site {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }
        .status-on-leave {
            background: #fed7aa;
            color: #92400e;
            border: 1px solid #fdba74;
        }
        .status-absent {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
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
            text-decoration: none;
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
        .page-btn.ellipsis {
            cursor: default;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .filters-row {
                flex-direction: column;
            }
            .filter-input {
                width: 100%;
                min-width: 100%;
            }
            .history-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
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
                <div class="page-header">
                    <h1 class="page-title">Attendance History</h1>
                    <a href="{{ route('my-attendance') }}" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Back to Current Attendance
                    </a>
                </div>

                <!-- Filters -->
                <form class="filters-container" method="GET" action="{{ route('employee-attendance.history') }}">
                    <div class="filters-row">
                        <div class="filter-group">
                            <label for="search">Search</label>
                            <input
                                type="text"
                                id="search"
                                name="search"
                                placeholder="Name or ID"
                                class="filter-input"
                                value="{{ $filters['search'] ?? '' }}"
                            />
                        </div>
                        <div class="filter-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="filter-input">
                                <option value="">All Statuses</option>
                                @foreach ($statusOptions as $statusOption)
                                    <option value="{{ $statusOption }}" @selected(($filters['status'] ?? '') === $statusOption)>
                                        {{ $statusOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="date_from">Date From</label>
                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                class="filter-input"
                                value="{{ $filters['date_from'] ?? '' }}"
                            />
                        </div>
                        <div class="filter-group">
                            <label for="date_to">Date To</label>
                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                class="filter-input"
                                value="{{ $filters['date_to'] ?? '' }}"
                            />
                        </div>
                        <button class="btn btn-primary" type="submit" style="margin-top: auto;">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                        @if (!empty($filters['search']) || !empty($filters['status']) || !empty($filters['date_from']) || !empty($filters['date_to']))
                            <a class="btn btn-outline" href="{{ route('employee-attendance.history') }}" style="margin-top: auto;">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card stat-total">
                        <div class="stat-left">
                            <div class="stat-icon"><i class="fas fa-history"></i></div>
                            <div class="stat-text">
                                <p>Total Records</p>
                            </div>
                        </div>
                        <span class="stat-value">{{ $records->total() }}</span>
                    </div>
                    <div class="stat-card stat-onsite">
                        <div class="stat-left">
                            <div class="stat-icon"><i class="fas fa-check"></i></div>
                            <div class="stat-text">
                                <p>On Site</p>
                            </div>
                        </div>
                        <span class="stat-value">{{ $stats['on_site'] }}</span>
                    </div>
                    <div class="stat-card stat-absent">
                        <div class="stat-left">
                            <div class="stat-icon"><i class="fas fa-user-times"></i></div>
                            <div class="stat-text">
                                <p>Absent</p>
                            </div>
                        </div>
                        <span class="stat-value">{{ $stats['absent'] }}</span>
                    </div>
                    <div class="stat-card stat-leave">
                        <div class="stat-left">
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                            <div class="stat-text">
                                <p>On Leave</p>
                            </div>
                        </div>
                        <span class="stat-value">{{ $stats['on_leave'] }}</span>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-card">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                                @php
                                    $statusClass = match ($record->status) {
                                        'Idle' => 'status-idle',
                                        'On Site' => 'status-on-site',
                                        'On Leave' => 'status-on-leave',
                                        'Absent' => 'status-absent',
                                        default => 'status-idle',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $record->date->format('M d, Y') }}</td>
                                    <td>{{ 'EMP' . str_pad($record->employee_id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $record->f_name }}</td>
                                    <td>{{ $record->l_name }}</td>
                                    <td>{{ $record->position ?? '—' }}</td>
                                    <td>
                                        <span class="status-badge {{ $statusClass }}">{{ $record->attendance_status }}</span>
                                    </td>
                                    <td>{{ optional($record->time_in)->format('h:i A') ?? '—' }}</td>
                                    <td>{{ optional($record->time_out)->format('h:i A') ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align:center; padding: 24px; color: #6b7280;">
                                        No attendance history found. Records will appear here after employees clock in.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($records->hasPages())
                    @php
                        $currentPage = $records->currentPage();
                        $lastPage = $records->lastPage();
                        $pageNumbers = [];

                        if ($lastPage <= 7) {
                            for ($i = 1; $i <= $lastPage; $i++) {
                                $pageNumbers[] = $i;
                            }
                        } else {
                            $pageNumbers[] = 1;
                            
                            if ($currentPage > 4) {
                                $pageNumbers[] = '...';
                            }
                            
                            $start = max(2, $currentPage - 1);
                            $end = min($lastPage - 1, $currentPage + 1);
                            
                            for ($i = $start; $i <= $end; $i++) {
                                $pageNumbers[] = $i;
                            }
                            
                            if ($currentPage < $lastPage - 3) {
                                $pageNumbers[] = '...';
                            }
                            
                            if ($lastPage > 1) {
                                $pageNumbers[] = $lastPage;
                            }
                        }
                    @endphp
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing {{ $records->firstItem() }} to {{ $records->lastItem() }}
                            of {{ $records->total() }} records
                        </div>
                        <div class="pagination-controls">
                            @if ($records->onFirstPage())
                                <span class="page-btn disabled">‹</span>
                            @else
                                <a class="page-btn" href="{{ $records->previousPageUrl() }}" rel="prev">‹</a>
                            @endif

                            <div class="pagination-nav">
                                @foreach ($pageNumbers as $page)
                                    @if ($page === '...')
                                        <span class="page-btn ellipsis">…</span>
                                    @elseif ($page == $currentPage)
                                        <span class="page-btn active">{{ $page }}</span>
                                    @else
                                        <a class="page-btn" href="{{ $records->url($page) }}">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($records->hasMorePages())
                                <a class="page-btn" href="{{ $records->nextPageUrl() }}" rel="next">›</a>
                            @else
                                <span class="page-btn disabled">›</span>
                            @endif
                        </div>
                    </div>
                @endif

            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>

</html>
