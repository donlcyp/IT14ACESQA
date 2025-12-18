<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Attendance Verification - Site Supervisor</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
            --accent-dark: #1e3a8a;
            --accent-light: #3b82f6;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: #1e40af;
            --main-bg: #f8fafc;

            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;
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

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { margin-left: 280px; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0 !important; }
        }

        .header {
            background: var(--header-bg);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
        }

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            margin-bottom: 12px;
        }

        .page-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: var(--accent);
        }

        .page-header p {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
        }

        .info-banner {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-banner i {
            font-size: 18px;
        }

        /* Filter Row */
        .filter-row {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-select {
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            min-width: 180px;
        }

        .date-input {
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        /* Section Card */
        .section-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .section-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--accent);
        }

        .count-badge {
            background: var(--accent);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 14px 16px;
            font-size: 13px;
            color: var(--gray-700);
            border-bottom: 1px solid #f3f4f6;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: #f9fafb;
        }

        .employee-name {
            font-weight: 500;
            color: var(--black-1);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-present { background: #d1fae5; color: #065f46; }
        .badge-absent { background: #fee2e2; color: #991b1b; }
        .badge-late { background: #fef3c7; color: #92400e; }
        .badge-pending { background: #e5e7eb; color: #4b5563; }
        .badge-verified { background: #dbeafe; color: #1e40af; }

        .time-text {
            font-family: 'Source Code Pro', monospace;
            font-size: 12px;
        }

        /* Action Button */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-verify {
            background: var(--accent);
            color: white;
        }
        .btn-verify:hover {
            filter: brightness(0.9);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .verified-text {
            color: #059669;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Summary Stats */
        .summary-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 14px 16px;
            border: 1px solid #e5e7eb;
            text-align: center;
        }

        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        .summary-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 4px;
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
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="page-header">
                    <a href="{{ route('ss.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <h2>
                        <i class="fas fa-user-check"></i>
                        Attendance Verification
                    </h2>
                    <p>Verify on-site attendance for workers in your assigned projects</p>
                </div>

                <div class="info-banner">
                    <i class="fas fa-info-circle"></i>
                    <span>As Site Supervisor, you can verify worker attendance to confirm their physical presence on-site. This helps HR validate attendance records.</span>
                </div>

                <!-- Summary Stats -->
                <div class="summary-row">
                    <div class="summary-card">
                        <div class="summary-value">{{ $stats['total_today'] ?? 0 }}</div>
                        <div class="summary-label">Total Today</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-value">{{ $stats['present'] ?? 0 }}</div>
                        <div class="summary-label">Present</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-value">{{ $stats['late'] ?? 0 }}</div>
                        <div class="summary-label">Late</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-value">{{ $stats['verified'] ?? 0 }}</div>
                        <div class="summary-label">Verified</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-value">{{ $stats['pending_verification'] ?? 0 }}</div>
                        <div class="summary-label">Pending</div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-row">
                    <select class="filter-select" onchange="filterAttendance()">
                        <option value="">All Projects</option>
                        @foreach($projects ?? [] as $project)
                            <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                                {{ $project->project_name ?? $project->project_code }}
                            </option>
                        @endforeach
                    </select>
                    <input type="date" class="date-input" value="{{ request('date', date('Y-m-d')) }}" onchange="filterByDate(this.value)">
                    <select class="filter-select" onchange="filterStatus(this.value)">
                        <option value="">All Status</option>
                        <option value="pending">Pending Verification</option>
                        <option value="verified">Verified</option>
                    </select>
                </div>

                <!-- Attendance Table -->
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-title">
                            <i class="fas fa-clipboard-list"></i> Attendance Records - {{ \Carbon\Carbon::parse(request('date', today()))->format('F d, Y') }}
                        </span>
                        <span class="count-badge">{{ count($attendance ?? []) }} records</span>
                    </div>
                    <div class="table-container">
                        @if(isset($attendance) && count($attendance) > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Project</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Status</th>
                                        <th>Verification</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendance as $record)
                                        <tr>
                                            <td>
                                                <div class="employee-name">
                                                    {{ $record->employee->fname ?? $record->f_name ?? '' }} {{ $record->employee->lname ?? $record->l_name ?? '' }}
                                                </div>
                                            </td>
                                            <td>{{ $record->employee->projects->first()->project_name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="time-text">
                                                    {{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->format('h:i A') : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="time-text">
                                                    {{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $status = strtolower($record->status ?? 'present');
                                                    $badgeClass = match($status) {
                                                        'present' => 'badge-present',
                                                        'absent' => 'badge-absent',
                                                        'late' => 'badge-late',
                                                        default => 'badge-pending'
                                                    };
                                                @endphp
                                                <span class="status-badge {{ $badgeClass }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($record->validation_status === 'approved')
                                                    <span class="status-badge badge-verified">Verified</span>
                                                @elseif($record->validation_status === 'rejected')
                                                    <span class="status-badge badge-absent">Rejected</span>
                                                @else
                                                    <span class="status-badge badge-pending">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($record->validation_status !== 'approved')
                                                    <form action="{{ route('ss.attendance.verify', $record->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-verify btn-sm">
                                                            <i class="fas fa-check"></i> Verify
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="verified-text">
                                                        <i class="fas fa-check-circle"></i>
                                                        {{ $record->validated_at ? \Carbon\Carbon::parse($record->validated_at)->format('h:i A') : '' }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-calendar-check"></i>
                                <h3>No Attendance Records</h3>
                                <p>No attendance records found for the selected date and project.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        function filterAttendance() {
            // Filter implementation
        }

        function filterByDate(date) {
            const url = new URL(window.location);
            url.searchParams.set('date', date);
            window.location = url;
        }

        function filterStatus(status) {
            // Filter implementation
        }
    </script>
</body>
</html>
