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
            --success: #10b981;
            --success-dark: #059669;
            --danger: #dc2626;
            --danger-dark: #b91c1c;
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
            color: var(--white);
            background: var(--accent);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            margin-bottom: 12px;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            background: var(--accent-dark);
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

        /* Project Info Bar */
        .project-info-bar {
            background: var(--accent);
            color: white;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .project-info-bar h3 {
            font-size: 18px;
            font-weight: 600;
        }

        .project-info-bar p {
            font-size: 13px;
            opacity: 0.9;
        }

        /* Info Banner */
        .info-banner {
            background: #ffffffff;
            border: 1px solid #e5e7eb;
            color: #000000ff;
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

        .summary-card.pending {
            background: #ffffffff;
            border: 1px solid #e5e7eb;
        }

        .summary-card.pending .summary-value {
            color: #000000ff;
        }

        /* Tabs */
        .tabs-container {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 0;
        }

        .tab-btn {
            padding: 12px 20px;
            border: none;
            background: transparent;
            color: var(--gray-600);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn:hover {
            color: var(--accent);
        }

        .tab-btn.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .tab-count {
            background: #ef4444;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--accent);
        }

        /* Attendance Cards Grid */
        .attendance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 16px;
            padding: 20px;
        }

        .attendance-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            transition: all 0.2s;
        }

        .attendance-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .attendance-card.pending {
            border-left: 4px solid #f59e0b;
        }

        .attendance-card.verified {
            border-left: 4px solid #10b981;
        }

        .attendance-card.denied {
            border-left: 4px solid #ef4444;
        }

        .attendance-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .employee-info h4 {
            font-size: 15px;
            font-weight: 600;
            color: var(--black-1);
            margin-bottom: 4px;
        }

        .employee-info p {
            font-size: 12px;
            color: var(--gray-500);
        }

        .verification-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-verified { background: #d1fae5; color: #065f46; }
        .status-denied { background: #fee2e2; color: #991b1b; }

        .attendance-times {
            display: flex;
            gap: 16px;
            margin-bottom: 12px;
            padding: 10px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .time-block {
            text-align: center;
            flex: 1;
        }

        .time-label {
            font-size: 10px;
            color: var(--gray-500);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .time-value {
            font-family: 'Source Code Pro', monospace;
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
        }

        .attendance-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }

        .attendance-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .att-present { background: #d1fae5; color: #065f46; }
        .att-late { background: #fef3c7; color: #92400e; }
        .att-absent { background: #fee2e2; color: #991b1b; }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            flex: 1;
        }

        .btn-verify {
            background: var(--success);
            color: white;
        }

        .btn-verify:hover {
            background: var(--success-dark);
        }

        .btn-deny {
            background: var(--danger);
            color: white;
        }

        .btn-deny:hover {
            background: var(--danger-dark);
        }

        /* Table for history */
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

        /* Empty State */
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

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
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

        /* No Project State */
        .no-project-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .no-project-state i {
            font-size: 64px;
            color: var(--gray-400);
            margin-bottom: 20px;
        }

        .no-project-state h3 {
            font-size: 18px;
            font-weight: 600;
            color: var(--black-1);
            margin-bottom: 8px;
        }

        .no-project-state p {
            color: var(--gray-500);
            font-size: 14px;
        }

        /* Date Filter */
        .date-filter {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-input {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 13px;
            background: white;
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
                    <p>Verify worker presence on-site for your assigned project</p>
                </div>

                @if($project)
                    <!-- Project Info Bar -->
                    <div class="project-info-bar">
                        <div>
                            <h3>{{ $project->project_name ?? $project->project_code }}</h3>
                            <p>{{ $project->location ?? 'Location not specified' }}</p>
                        </div>
                        <div class="date-filter">
                            <span style="font-size: 13px; opacity: 0.9;">Date:</span>
                            <input type="date" class="date-input" value="{{ request('date', date('Y-m-d')) }}" onchange="filterByDate(this.value)" style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.3); color: white;">
                        </div>
                    </div>

                    <!-- Info Banner -->
                    <div class="info-banner">
                        <i class="fas fa-info-circle"></i>
                        <span>HR sends verification requests when workers punch in. Confirm their physical presence on-site by clicking <strong>Verify</strong> or <strong>Deny</strong> if they're not actually present.</span>
                    </div>

                    <!-- Summary Stats -->
                    <div class="summary-row">
                        <div class="summary-card">
                            <div class="summary-value">{{ $stats['total_today'] ?? 0 }}</div>
                            <div class="summary-label">Total Records</div>
                        </div>
                        <div class="summary-card pending">
                            <div class="summary-value">{{ $stats['pending_verification'] ?? 0 }}</div>
                            <div class="summary-label">Pending Verification</div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-value">{{ $stats['verified'] ?? 0 }}</div>
                            <div class="summary-label">Verified</div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-value">{{ $stats['denied'] ?? 0 }}</div>
                            <div class="summary-label">Denied</div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="tabs-container">
                        <button class="tab-btn active" onclick="switchTab('pending')">
                            <i class="fas fa-clock"></i> Pending Verification
                            @if(($stats['pending_verification'] ?? 0) > 0)
                                <span class="tab-count">{{ $stats['pending_verification'] }}</span>
                            @endif
                        </button>
                        <button class="tab-btn" onclick="switchTab('history')">
                            <i class="fas fa-history"></i> Verification History
                        </button>
                    </div>

                    <!-- Pending Tab -->
                    <div id="pending-tab" class="tab-content active">
                        @if($pendingVerification->count() > 0)
                            <div class="attendance-grid">
                                @foreach($pendingVerification as $record)
                                    <div class="attendance-card pending">
                                        <div class="attendance-header">
                                            <div class="employee-info">
                                                <h4>
                                                    {{ $record->employee->fname ?? $record->f_name ?? '' }} 
                                                    {{ $record->employee->lname ?? $record->l_name ?? '' }}
                                                </h4>
                                                <p>{{ $record->employee->position ?? 'Construction Worker' }}</p>
                                            </div>
                                            <span class="verification-status status-pending">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        </div>
                                        
                                        <div class="attendance-times">
                                            <div class="time-block">
                                                <div class="time-label">Time In</div>
                                                <div class="time-value">
                                                    {{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->format('h:i A') : '--:--' }}
                                                </div>
                                            </div>
                                            <div class="time-block">
                                                <div class="time-label">Time Out</div>
                                                <div class="time-value">
                                                    {{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '--:--' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="attendance-meta">
                                            @php
                                                $status = strtolower($record->status ?? 'present');
                                                $attClass = match($status) {
                                                    'present' => 'att-present',
                                                    'late' => 'att-late',
                                                    'absent' => 'att-absent',
                                                    default => 'att-present'
                                                };
                                            @endphp
                                            <span class="attendance-status {{ $attClass }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                            <span style="font-size: 12px; color: var(--gray-500);">
                                                <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($record->attendance_date ?? $record->created_at)->format('M d, Y') }}
                                            </span>
                                        </div>

                                        <div class="action-buttons">
                                            <form action="{{ route('ss.attendance.verify', $record->id) }}" method="POST" style="flex: 1;">
                                                @csrf
                                                <input type="hidden" name="action" value="verify">
                                                <button type="submit" class="btn btn-verify" style="width: 100%;">
                                                    <i class="fas fa-check"></i> Verify
                                                </button>
                                            </form>
                                            <form action="{{ route('ss.attendance.verify', $record->id) }}" method="POST" style="flex: 1;">
                                                @csrf
                                                <input type="hidden" name="action" value="deny">
                                                <button type="submit" class="btn btn-deny" style="width: 100%;">
                                                    <i class="fas fa-times"></i> Deny
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card">
                                <div class="empty-state">
                                    <i class="fas fa-check-circle"></i>
                                    <h3>All Caught Up!</h3>
                                    <p>No pending attendance verifications at the moment.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- History Tab -->
                    <div id="history-tab" class="tab-content">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">
                                    <i class="fas fa-history"></i> Verification History
                                </span>
                            </div>
                            <div class="table-container">
                                @if($verificationHistory->count() > 0)
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Date</th>
                                                <th>Time In/Out</th>
                                                <th>Attendance</th>
                                                <th>Verification</th>
                                                <th>Verified At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($verificationHistory as $record)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $record->employee->fname ?? $record->f_name ?? '' }} {{ $record->employee->lname ?? $record->l_name ?? '' }}</strong>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($record->attendance_date ?? $record->created_at)->format('M d, Y') }}</td>
                                                    <td style="font-family: 'Source Code Pro', monospace; font-size: 12px;">
                                                        {{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->format('h:i A') : '--' }} - 
                                                        {{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '--' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $status = strtolower($record->status ?? 'present');
                                                            $attClass = match($status) {
                                                                'present' => 'att-present',
                                                                'late' => 'att-late',
                                                                'absent' => 'att-absent',
                                                                default => 'att-present'
                                                            };
                                                        @endphp
                                                        <span class="attendance-status {{ $attClass }}">{{ ucfirst($status) }}</span>
                                                    </td>
                                                    <td>
                                                        @if($record->ss_verification_status === 'verified')
                                                            <span class="verification-status status-verified">
                                                                <i class="fas fa-check"></i> Verified
                                                            </span>
                                                        @else
                                                            <span class="verification-status status-denied">
                                                                <i class="fas fa-times"></i> Denied
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td style="font-size: 12px; color: var(--gray-500);">
                                                        {{ $record->ss_verified_at ? \Carbon\Carbon::parse($record->ss_verified_at)->format('M d, h:i A') : '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h3>No History Yet</h3>
                                        <p>Verification history will appear here once you verify or deny attendance records.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                @else
                    <!-- No Project Assigned -->
                    <div class="no-project-state">
                        <i class="fas fa-folder-open"></i>
                        <h3>No Project Assigned</h3>
                        <p>You don't have any project assigned to you yet. Please contact your Project Manager.</p>
                    </div>
                @endif
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Tab switching
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

            document.getElementById(tabName + '-tab').classList.add('active');
            event.target.closest('.tab-btn').classList.add('active');
        }

        // Date filter
        function filterByDate(date) {
            const url = new URL(window.location);
            url.searchParams.set('date', date);
            window.location = url;
        }
    </script>
</body>
</html>
