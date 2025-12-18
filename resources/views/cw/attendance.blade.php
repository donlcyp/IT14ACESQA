<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Attendance - Construction Worker</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1f2937;
            --gray: #6b7280;
            --light: #f3f4f6;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        .main-content {
            min-height: 100vh;
            padding: 0;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) { .main-content { margin-left: 280px; } }
        @media (max-width: 768px) { .main-content { margin-left: 0; } }

        .header {
            background: var(--white);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-menu {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--dark);
            cursor: pointer;
            padding: 8px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        .content-area {
            padding: 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--white);
            color: var(--dark);
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .page-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: var(--primary);
        }

        .page-header p {
            color: var(--gray);
            margin-top: 4px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .stat-card i {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .stat-card.present i { color: var(--success); }
        .stat-card.absent i { color: var(--danger); }
        .stat-card.late i { color: var(--warning); }
        .stat-card.hours i { color: var(--primary); }

        .stat-card h4 {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-card p {
            font-size: 13px;
            color: var(--gray);
            margin-top: 4px;
        }

        /* Filter Row */
        .filter-row {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-input {
            padding: 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: var(--white);
        }

        .filter-btn {
            padding: 10px 20px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn:hover {
            background: #1e3a8a;
        }

        /* Attendance Table */
        .table-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: var(--light);
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: var(--light);
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-present { background: #d1fae5; color: #065f46; }
        .status-absent { background: #fee2e2; color: #991b1b; }
        .status-late { background: #fef3c7; color: #92400e; }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 16px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content">
            <header class="header">
                <button class="header-menu" id="menuToggle" aria-label="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">My Attendance</h1>
            </header>

            <div class="content-area">
                <div class="page-header">
                    <a href="{{ route('cw.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <h2><i class="fas fa-calendar-check"></i> Attendance History</h2>
                    <p>View your personal attendance records and statistics</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card present">
                        <i class="fas fa-check-circle"></i>
                        <h4>{{ $stats['present'] }}</h4>
                        <p>Days Present</p>
                    </div>
                    <div class="stat-card absent">
                        <i class="fas fa-times-circle"></i>
                        <h4>{{ $stats['absent'] }}</h4>
                        <p>Days Absent</p>
                    </div>
                    <div class="stat-card late">
                        <i class="fas fa-clock"></i>
                        <h4>{{ $stats['late'] }}</h4>
                        <p>Days Late</p>
                    </div>
                    <div class="stat-card hours">
                        <i class="fas fa-hourglass-half"></i>
                        <h4>{{ $stats['total_hours'] }}</h4>
                        <p>Total Hours</p>
                    </div>
                </div>

                <!-- Filters -->
                <form action="{{ route('cw.attendance') }}" method="GET" class="filter-row">
                    <input type="month" name="month" class="filter-input" value="{{ request('month', now()->format('Y-m')) }}">
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>

                <!-- Attendance Table -->
                <div class="table-card">
                    @if($attendanceRecords->count() > 0)
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Hours</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendanceRecords as $record)
                                        @php
                                            $hours = 0;
                                            if ($record->time_in && $record->time_out) {
                                                $timeIn = \Carbon\Carbon::parse($record->time_in);
                                                $timeOut = \Carbon\Carbon::parse($record->time_out);
                                                $hours = $timeOut->diffInHours($timeIn);
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                            <td>{{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->format('h:i A') : '--' }}</td>
                                            <td>{{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '--' }}</td>
                                            <td>{{ $hours > 0 ? $hours . 'h' : '--' }}</td>
                                            <td>
                                                <span class="status-badge status-{{ strtolower($record->status) }}">
                                                    {{ $record->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-wrapper">
                            {{ $attendanceRecords->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-calendar-times"></i>
                            <h3>No Records Found</h3>
                            <p>No attendance records for the selected period.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
