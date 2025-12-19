<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - My Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
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
            --gray-900: #111827;
            --blue-600: #1e40af;
            --red-600: #dc2626;
            --green-600: #16a34a;
            --sidebar-bg: #f8fafc;
            --header-bg: #1e40af;
            --main-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
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
            .main-content { 
                margin-left: 280px; 
            }
        }
        
        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0; 
            }
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
            overflow-y: auto;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Punch Section */
        .punch-section {
            background: white;
            padding: 24px;
            border-radius: 10px;
            border: 1px solid var(--gray-300);
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .punch-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .punch-info h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
        }

        .punch-info p {
            font-size: 14px;
            color: var(--gray-600);
            margin: 4px 0 0;
        }

        .clock-display {
            text-align: right;
        }

        .clock-time {
            font-size: 32px;
            font-weight: 700;
            color: #16a34a;
            line-height: 1;
        }

        .clock-date {
            font-size: 12px;
            color: var(--gray-600);
            margin-top: 4px;
        }

        .punch-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .punch-btn {
            padding: 14px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .punch-btn-in {
            background: #1e40af;
            color: white;
        }
        .punch-btn-in:hover:not(:disabled) {
            filter: brightness(0.9);
        }

        .punch-btn-out {
            background: #dc2626;
            color: white;
        }
        .punch-btn-out:hover:not(:disabled) {
            filter: brightness(0.9);
        }

        .punch-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .status-display {
            background: #f9fafb;
            padding: 16px;
            border-radius: 6px;
            border-left: 4px solid #3b82f6;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
        }

        .status-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .status-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
        }

        .status-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--gray-900);
        }

        .status-value.punched-in {
            color: #16a34a;
        }

        .status-value.punched-out {
            color: var(--gray-600);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--gray-300);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .stat-icon.present { background: #16a34a; }
        .stat-icon.absent { background: #dc2626; }
        .stat-icon.late { background: #f59e0b; }
        .stat-icon.hours { background: #3b82f6; }

        .stat-content h3 {
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            margin: 0;
        }

        .stat-content p {
            font-size: 24px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 4px 0 0;
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
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            background: var(--white);
        }

        .filter-btn {
            padding: 10px 20px;
            background: var(--accent);
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

        /* Card Styles */
        .card {
            background: white;
            border-radius: 10px;
            border: 1px solid var(--gray-300);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 24px;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--gray-300);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
        }

        .card-body {
            padding: 0;
        }

        /* Attendance Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f9fafb;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-300);
        }

        td {
            padding: 12px;
            border-bottom: 1px solid var(--gray-300);
            font-size: 14px;
        }

        tr:hover {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-present { background: transparent; color: #166534; }
        .badge-absent { background: transparent; color: #991b1b; }
        .badge-late { background: transparent; color: #92400e; }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-600);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-300);
            margin-bottom: 16px;
            display: block;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
            animation: slideIn 0.3s ease;
            max-width: 400px;
        }

        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .notification.success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .notification.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 16px;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .content-area { padding: 20px; }
            .page-title { font-size: 22px; }
            .punch-header { flex-direction: column; gap: 16px; }
            .stats-grid { grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); }
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
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <div class="content-area">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Page Title -->
                <div class="page-header">
                    <h1 class="page-title">My Attendance</h1>
                    <p class="page-subtitle">Track your daily attendance, punch in/out times, and attendance history</p>
                </div>

                <!-- Punch In/Out Section -->
                <div class="punch-section">
                    <div class="punch-header">
                        <div class="punch-info">
                            <h2>Quick Punch In/Out</h2>
                            <p>{{ Auth::user()->f_name }} {{ Auth::user()->l_name }} • Construction Worker</p>
                        </div>
                        <div class="clock-display">
                            <div class="clock-time" id="clockTime">--:--:--</div>
                            <div class="clock-date" id="clockDate">Today</div>
                        </div>
                    </div>

                    <!-- Punch Buttons -->
                    <div class="punch-buttons">
                        <button id="punchInBtn" class="punch-btn punch-btn-in" onclick="performPunchIn()">
                            <i class="fas fa-arrow-right"></i> PUNCH IN
                        </button>
                        <button id="punchOutBtn" class="punch-btn punch-btn-out" onclick="performPunchOut()" disabled>
                            <i class="fas fa-arrow-left"></i> PUNCH OUT
                        </button>
                    </div>

                    <!-- Status Display -->
                    <div class="status-display">
                        <div class="status-item">
                            <span class="status-label">Status</span>
                            <span class="status-value" id="punchStatus">Idle</span>
                        </div>
                        <div class="status-item">
                            <span class="status-label">Punch In Time</span>
                            <span class="status-value" id="punchInDisplay">—</span>
                        </div>
                        <div class="status-item">
                            <span class="status-label">Punch Out Time</span>
                            <span class="status-value" id="punchOutDisplay">—</span>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon present">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h3>DAYS PRESENT</h3>
                            <p>{{ $stats['present'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon absent">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h3>DAYS ABSENT</h3>
                            <p>{{ $stats['absent'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon late">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h3>DAYS LATE</h3>
                            <p>{{ $stats['late'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon hours">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="stat-content">
                            <h3>TOTAL HOURS</h3>
                            <p>{{ $stats['total_hours'] }}</p>
                        </div>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attendance History</h3>
                    </div>
                    <div class="card-body">
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
                                                $status = $record->attendance_status ?? $record->status ?? 'Present';
                                            @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                                <td>{{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->format('h:i A') : '--' }}</td>
                                                <td>{{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '--' }}</td>
                                                <td>{{ $hours > 0 ? $hours . 'h' : '--' }}</td>
                                                <td>
                                                    <span class="badge badge-{{ strtolower($status) }}">
                                                        {{ $status }}
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
            </div>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Clock
        function updateClock() {
            const now = new Date();
            const timeEl = document.getElementById('clockTime');
            const dateEl = document.getElementById('clockDate');
            
            if (timeEl) {
                timeEl.textContent = now.toLocaleTimeString('en-US', { 
                    hour: '2-digit', 
                    minute: '2-digit', 
                    second: '2-digit',
                    hour12: true 
                });
            }
            if (dateEl) {
                dateEl.textContent = now.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
            }
        }
        
        setInterval(updateClock, 1000);
        updateClock();

        // Check today's punch status on load
        checkPunchStatus();

        async function checkPunchStatus() {
            try {
                const response = await fetch('/punch-status', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    updatePunchUI(data);
                }
            } catch (error) {
                console.log('Could not fetch punch status');
            }
        }

        function updatePunchUI(data) {
            const punchInBtn = document.getElementById('punchInBtn');
            const punchOutBtn = document.getElementById('punchOutBtn');
            const punchStatus = document.getElementById('punchStatus');
            const punchInDisplay = document.getElementById('punchInDisplay');
            const punchOutDisplay = document.getElementById('punchOutDisplay');

            if (data.punched_in) {
                punchInBtn.disabled = true;
                punchOutBtn.disabled = !data.punched_in || data.punched_out;
                punchStatus.textContent = data.punched_out ? 'Completed' : 'Punched In';
                punchStatus.className = 'status-value ' + (data.punched_out ? 'punched-out' : 'punched-in');
                
                if (data.time_in) {
                    punchInDisplay.textContent = formatTime(data.time_in);
                }
                if (data.time_out) {
                    punchOutDisplay.textContent = formatTime(data.time_out);
                }
            } else {
                punchInBtn.disabled = false;
                punchOutBtn.disabled = true;
                punchStatus.textContent = 'Not Punched In';
                punchStatus.className = 'status-value';
            }
        }

        function formatTime(timeString) {
            const time = new Date('2000-01-01 ' + timeString);
            return time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
        }

        async function performPunchIn() {
            const punchInBtn = document.getElementById('punchInBtn');
            punchInBtn.disabled = true;
            punchInBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            try {
                const response = await fetch('{{ route("punch.in.employee") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(data.message, 'success');
                    // Redirect to dashboard after successful punch-in
                    setTimeout(() => {
                        window.location.href = '{{ route("cw.dashboard") }}';
                    }, 1500);
                } else {
                    showNotification(data.message || 'Failed to punch in', 'error');
                    punchInBtn.disabled = false;
                }
            } catch (error) {
                showNotification('An error occurred. Please try again.', 'error');
                punchInBtn.disabled = false;
            }

            punchInBtn.innerHTML = '<i class="fas fa-arrow-right"></i> PUNCH IN';
        }

        async function performPunchOut() {
            const punchOutBtn = document.getElementById('punchOutBtn');
            punchOutBtn.disabled = true;
            punchOutBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            try {
                const response = await fetch('{{ route("punch.out.employee") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(data.message, 'success');
                    checkPunchStatus();
                } else {
                    showNotification(data.message || 'Failed to punch out', 'error');
                }
            } catch (error) {
                showNotification('An error occurred. Please try again.', 'error');
            }

            punchOutBtn.innerHTML = '<i class="fas fa-arrow-left"></i> PUNCH OUT';
        }

        function showNotification(message, type) {
            const existing = document.querySelector('.notification');
            if (existing) existing.remove();

            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
            document.body.appendChild(notification);

            setTimeout(() => notification.remove(), 5000);
        }
    </script>
</body>
</html>
