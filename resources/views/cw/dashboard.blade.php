<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - Worker Dashboard</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        /* Main Content Area */
        .main-content {
            min-height: 100vh;
            padding: 0;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { margin-left: 280px; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0; }
        }

        /* Header Styles */
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

        .header-menu:hover {
            color: var(--primary);
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }

        @media (max-width: 768px) {
            .header-title { font-size: 16px; }
        }

        /* Content Area */
        .content-area {
            padding: 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .content-area { padding: 16px; }
        }

        /* Dashboard Header */
        .dashboard-header {
            margin-bottom: 24px;
        }

        .dashboard-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-header h2 i {
            color: var(--primary);
        }

        .dashboard-header p {
            color: var(--gray);
            margin-top: 4px;
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* KPI Cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .kpi-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .kpi-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }

        .kpi-card .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .kpi-card.projects .kpi-icon { background: #dbeafe; color: #1e40af; }
        .kpi-card.active .kpi-icon { background: #d1fae5; color: #065f46; }
        .kpi-card.tasks .kpi-icon { background: #fef3c7; color: #92400e; }
        .kpi-card.days .kpi-icon { background: #e0e7ff; color: #4338ca; }

        .kpi-info h4 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
        }

        .kpi-info p {
            font-size: 13px;
            color: var(--gray);
        }

        /* Section Card */
        .section-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .section-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: var(--primary);
        }

        .section-body {
            padding: 20px;
        }

        /* Attendance Status Card */
        .attendance-status {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .attendance-status h3 {
            font-size: 18px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .attendance-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
        }

        .attendance-item {
            text-align: center;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .attendance-item label {
            font-size: 12px;
            opacity: 0.9;
            display: block;
            margin-bottom: 4px;
        }

        .attendance-item span {
            font-size: 18px;
            font-weight: 600;
        }

        .punch-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .punch-btn.in {
            background: var(--success);
            color: var(--white);
        }

        .punch-btn.out {
            background: var(--warning);
            color: var(--white);
        }

        .punch-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Project List */
        .project-list {
            list-style: none;
        }

        .project-item {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .project-item:last-child {
            border-bottom: none;
        }

        .project-info {
            flex: 1;
        }

        .project-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .project-meta {
            font-size: 13px;
            color: var(--gray);
        }

        .project-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-ongoing {
            background: #fef3c7;
            color: #92400e;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .view-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: var(--light);
            color: var(--dark);
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .view-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        /* Task List */
        .task-list {
            list-style: none;
        }

        .task-item {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-title {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .task-meta {
            font-size: 12px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
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
                <h1 class="header-title">Worker Dashboard</h1>
            </header>

            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="dashboard-header">
                    <h2><i class="fas fa-hard-hat"></i> Welcome, {{ $user->name }}</h2>
                    <p>{{ now()->format('l, F d, Y') }}</p>
                </div>

                <!-- Today's Attendance Status -->
                <div class="attendance-status">
                    <h3><i class="fas fa-clock"></i> Today's Attendance</h3>
                    <div class="attendance-info">
                        <div class="attendance-item">
                            <label>Status</label>
                            <span>{{ $todayAttendance ? ucfirst($todayAttendance->status) : 'Not Recorded' }}</span>
                        </div>
                        <div class="attendance-item">
                            <label>Time In</label>
                            <span>{{ $todayAttendance && $todayAttendance->time_in ? \Carbon\Carbon::parse($todayAttendance->time_in)->format('h:i A') : '--:--' }}</span>
                        </div>
                        <div class="attendance-item">
                            <label>Time Out</label>
                            <span>{{ $todayAttendance && $todayAttendance->time_out ? \Carbon\Carbon::parse($todayAttendance->time_out)->format('h:i A') : '--:--' }}</span>
                        </div>
                        <div class="attendance-item">
                            @if(!$todayAttendance || !$todayAttendance->time_in)
                                <form action="{{ route('punch.in.employee') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="punch-btn in">
                                        <i class="fas fa-sign-in-alt"></i> Punch In
                                    </button>
                                </form>
                            @elseif(!$todayAttendance->time_out)
                                <form action="{{ route('punch.out.employee') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="punch-btn out">
                                        <i class="fas fa-sign-out-alt"></i> Punch Out
                                    </button>
                                </form>
                            @else
                                <span style="color: rgba(255,255,255,0.9); font-size: 14px;">✓ Completed</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- KPI Cards -->
                <div class="kpi-grid">
                    <div class="kpi-card projects">
                        <div class="kpi-icon"><i class="fas fa-folder-open"></i></div>
                        <div class="kpi-info">
                            <h4>{{ $summary['assigned_projects'] }}</h4>
                            <p>Assigned Projects</p>
                        </div>
                    </div>
                    <div class="kpi-card active">
                        <div class="kpi-icon"><i class="fas fa-play-circle"></i></div>
                        <div class="kpi-info">
                            <h4>{{ $summary['active_projects'] }}</h4>
                            <p>Active Projects</p>
                        </div>
                    </div>
                    <div class="kpi-card tasks">
                        <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="kpi-info">
                            <h4>{{ $summary['completed_tasks'] }}</h4>
                            <p>Tasks Completed</p>
                        </div>
                    </div>
                    <div class="kpi-card days">
                        <div class="kpi-icon"><i class="fas fa-calendar-check"></i></div>
                        <div class="kpi-info">
                            <h4>{{ $summary['days_worked_this_month'] }}</h4>
                            <p>Days Worked (This Month)</p>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid">
                    <!-- Assigned Projects -->
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title"><i class="fas fa-folder-open"></i> My Projects</h3>
                            <a href="{{ route('cw.tasks') }}" class="view-btn">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="section-body" style="padding: 0;">
                            @if($assignedProjects->count() > 0)
                                <ul class="project-list">
                                    @foreach($assignedProjects->take(5) as $project)
                                        <li class="project-item">
                                            <div class="project-info">
                                                <div class="project-name">{{ $project->project_name }}</div>
                                                <div class="project-meta">
                                                    <i class="fas fa-user"></i> {{ $project->assignedPM->name ?? 'N/A' }}
                                                    &bull; {{ $project->location ?? 'No location' }}
                                                </div>
                                            </div>
                                            <span class="project-status {{ $project->status === 'Ongoing' ? 'status-ongoing' : 'status-completed' }}">
                                                {{ $project->status }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <p>No projects assigned yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Tasks -->
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title"><i class="fas fa-tasks"></i> Recent Tasks</h3>
                        </div>
                        <div class="section-body" style="padding: 0;">
                            @if($upcomingTasks->count() > 0)
                                <ul class="task-list">
                                    @foreach($upcomingTasks->take(5) as $task)
                                        <li class="task-item">
                                            <div class="task-title">{{ $task->title }}</div>
                                            <div class="task-meta">
                                                <span><i class="fas fa-folder"></i> {{ $task->project->project_name ?? 'N/A' }}</span>
                                                <span><i class="fas fa-clock"></i> {{ $task->created_at->diffForHumans() }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-tasks"></i>
                                    <p>No tasks available.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Attendance -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-calendar-alt"></i> Recent Attendance</h3>
                        <a href="{{ route('cw.attendance') }}" class="view-btn">
                            View Full History <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="section-body">
                        @if($recentAttendance->count() > 0)
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="text-align: left; border-bottom: 2px solid #e5e7eb;">
                                        <th style="padding: 12px; color: var(--gray); font-weight: 500;">Date</th>
                                        <th style="padding: 12px; color: var(--gray); font-weight: 500;">Time In</th>
                                        <th style="padding: 12px; color: var(--gray); font-weight: 500;">Time Out</th>
                                        <th style="padding: 12px; color: var(--gray); font-weight: 500;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentAttendance as $record)
                                        <tr style="border-bottom: 1px solid #e5e7eb;">
                                            <td style="padding: 12px;">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y (D)') }}</td>
                                            <td style="padding: 12px;">{{ $record->time_in ? \Carbon\Carbon::parse($record->time_in)->format('h:i A') : '--' }}</td>
                                            <td style="padding: 12px;">{{ $record->time_out ? \Carbon\Carbon::parse($record->time_out)->format('h:i A') : '--' }}</td>
                                            <td style="padding: 12px;">
                                                <span class="project-status {{ $record->status === 'Present' ? 'status-completed' : 'status-ongoing' }}">
                                                    {{ $record->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-calendar-times"></i>
                                <p>No attendance records found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
