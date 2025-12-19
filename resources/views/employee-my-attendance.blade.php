<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - My Attendance</title>
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

        .card-subtitle {
            font-size: 13px;
            color: var(--gray-600);
            margin-top: 4px;
        }

        .card-body {
            padding: 20px;
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

        .status-value.late {
            color: #dc2626;
        }

        .status-value.on-time {
            color: #16a34a;
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

        .stat-icon.days { background: #3b82f6; }
        .stat-icon.on-site { background: #1e40af; }
        .stat-icon.absent { background: #dc2626; }
        .stat-icon.on-leave { background: #f59e0b; }
        .stat-icon.late { background: #ef4444; }

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

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .attendance-table thead {
            background: #f9fafb;
        }

        .attendance-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-300);
        }

        .attendance-table td {
            padding: 12px;
            border-bottom: 1px solid var(--gray-300);
            font-size: 14px;
            color: var(--gray-700);
        }

        .attendance-table tbody tr:hover {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-on-site {
            background: transparent;
            color: #166534;
        }

        .badge-absent {
            background: transparent;
            color: #991b1b;
        }

        .badge-on-leave {
            background: transparent;
            color: #92400e;
        }

        .badge-idle {
            background: transparent;
            color: #1e40af;
        }

        .badge-present {
            background: transparent;
            color: #166534;
        }

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

        .empty-state p {
            margin: 8px 0;
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
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
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

        .notification.warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .punch-header {
                flex-direction: column;
                gap: 16px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            }
        }

        /* Sidebar Styles */
        aside {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 280px;
            height: 100vh;
            padding: 28px 22px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            background-color: #f8fafc;
            border-right: 1px solid #e2e8f0;
            transform: translateX(-100%);
            overflow-y: auto;
        }

        aside.open {
            transform: translateX(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 8px 0 24px rgba(15, 23, 42, 0.08);
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
                            <p>{{ $currentEmployee->f_name }} {{ $currentEmployee->l_name }} • {{ $currentEmployee->position }}</p>
                            @if ($assignedProject)
                                <p>Assigned to: <strong>{{ $assignedProject->project_name }}</strong></p>
                            @endif
                        </div>
                        <div class="clock-display">
                            <div class="clock-time" id="clockTime">--:--:--</div>
                            <div class="clock-date" id="clockDate">Today</div>
                        </div>
                    </div>

                    <!-- Punch Buttons -->
                    <div class="punch-buttons">
                        <button id="punchInBtn" class="punch-btn punch-btn-in" onclick="performEmployeePunchIn()">
                            <i class="fas fa-arrow-right"></i> PUNCH IN
                        </button>
                        <button id="punchOutBtn" class="punch-btn punch-btn-out" onclick="performEmployeePunchOut()" disabled>
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
                        <div class="status-item">
                            <span class="status-label">Late Status</span>
                            <span class="status-value on-time" id="lateStatus">On Time</span>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon days">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Total Days</h3>
                            <p>{{ $stats['total_days'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon on-site">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="stat-content">
                            <h3>On Site</h3>
                            <p>{{ $stats['on_site'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon absent">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Absent</h3>
                            <p>{{ $stats['absent'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon on-leave">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <div class="stat-content">
                            <h3>On Leave</h3>
                            <p>{{ $stats['on_leave'] }}</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon late">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Late Arrivals</h3>
                            <p>{{ $stats['late_count'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Attendance History -->
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Attendance History</h3>
                            <p class="card-subtitle">Your recent attendance records</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($recentRecords->count() > 0)
                            <div class="table-container">
                                <table class="attendance-table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Punch In</th>
                                            <th>Punch Out</th>
                                            <th>Late?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentRecords as $record)
                                            <tr>
                                                <td>{{ $record->date->format('M d, Y') }}</td>
                                                <td>
                                                    @php
                                                        $status = strtolower(str_replace(' ', '-', $record->attendance_status));
                                                        $badgeClass = 'badge-' . $status;
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ $record->attendance_status }}
                                                    </span>
                                                </td>
                                                <td>{{ $record->punch_in_time ? $record->punch_in_time->format('H:i:s') : '—' }}</td>
                                                <td>{{ $record->punch_out_time ? $record->punch_out_time->format('H:i:s') : '—' }}</td>
                                                <td>
                                                    @if ($record->is_late)
                                                        <span style="color: #dc2626; font-weight: 600;">Yes ({{ $record->late_minutes }} min)</span>
                                                    @else
                                                        <span style="color: #16a34a; font-weight: 600;">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>No attendance records yet</p>
                                <p style="font-size: 12px; color: #999;">Your attendance records will appear here</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script>
        // Update clock display every second
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', { hour12: false });
            const dateStr = now.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
            
            document.getElementById('clockTime').textContent = timeStr;
            document.getElementById('clockDate').textContent = dateStr;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Load employee punch status on page load
        window.addEventListener('load', function() {
            loadEmployeePunchStatus();
        });

        function performEmployeePunchIn() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-in`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch in');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('✓ Punch In Successful!', data.message, 'success');
                    loadEmployeePunchStatus();
                    
                    if (data.is_late) {
                        setTimeout(() => {
                            showNotification('⚠️ Late Notice', `You are ${data.late_minutes} minutes late`, 'warning');
                        }, 500);
                    }
                } else {
                    showNotification('Error', data.message || 'Failed to punch in', 'error');
                }
            })
            .catch(error => {
                console.error('Punch in error:', error);
                showNotification('Error', error.message || 'An error occurred while punching in', 'error');
            });
        }

        function performEmployeePunchOut() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-out`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch out');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('✓ Punch Out Successful!', `Hours worked: ${data.hours_worked.toFixed(2)} hrs`, 'success');
                    loadEmployeePunchStatus();
                } else {
                    showNotification('Error', data.message || 'Failed to punch out', 'error');
                }
            })
            .catch(error => {
                console.error('Punch out error:', error);
                showNotification('Error', error.message || 'An error occurred while punching out', 'error');
            });
        }

        function loadEmployeePunchStatus() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-status`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load punch status');
                }
                return response.json();
            })
            .then(data => {
                updatePunchDisplay(data);
            })
            .catch(error => {
                console.error('Error loading punch status:', error);
            });
        }

        function updatePunchDisplay(data) {
            const punchStatus = document.getElementById('punchStatus');
            const punchInDisplay = document.getElementById('punchInDisplay');
            const punchOutDisplay = document.getElementById('punchOutDisplay');
            const lateStatus = document.getElementById('lateStatus');
            const punchInBtn = document.getElementById('punchInBtn');
            const punchOutBtn = document.getElementById('punchOutBtn');

            // Update punch in display
            if (data.punch_in_time) {
                punchInDisplay.textContent = data.punch_in_time;
                punchInBtn.disabled = true;
                punchOutBtn.disabled = false;
            } else {
                punchInDisplay.textContent = '—';
                punchInBtn.disabled = false;
                punchOutBtn.disabled = true;
            }

            // Update punch out display
            if (data.punch_out_time) {
                punchOutDisplay.textContent = data.punch_out_time;
                punchOutBtn.disabled = true;
            } else {
                punchOutDisplay.textContent = '—';
            }

            // Update status
            if (data.punch_in_time && data.punch_out_time) {
                punchStatus.textContent = 'Punched Out';
                punchStatus.style.color = '#6b7280';
            } else if (data.punch_in_time) {
                punchStatus.textContent = 'Punched In';
                punchStatus.style.color = '#16a34a';
            } else {
                punchStatus.textContent = 'Idle';
                punchStatus.style.color = '#1e40af';
            }

            // Update late status
            if (data.is_late) {
                lateStatus.textContent = `⚠️ LATE - ${data.late_minutes} min`;
                lateStatus.style.color = '#dc2626';
                lateStatus.classList.remove('on-time');
                lateStatus.classList.add('late');
            } else if (data.punch_in_time) {
                lateStatus.textContent = '✓ On Time';
                lateStatus.style.color = '#16a34a';
                lateStatus.classList.remove('late');
                lateStatus.classList.add('on-time');
            } else {
                lateStatus.textContent = 'On Time';
                lateStatus.style.color = '#6b7280';
                lateStatus.classList.remove('late');
            }
        }

        function showNotification(title, message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `<strong>${title}</strong><br>${message}`;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease forwards';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }
    </script>
    @include('partials.sidebar-js')
</body>

</html>

