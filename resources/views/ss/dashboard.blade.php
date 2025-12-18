<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - Site Supervisor Dashboard</title>
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

        @media (min-width: 769px) {
            .main-content { margin-left: 280px; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0 !important; }
        }

        /* Header Styles */
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

        @media (max-width: 768px) {
            .header { padding: 16px 20px; }
            .header-title { font-size: 18px; }
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        @media (max-width: 768px) {
            .content-area { padding: 20px; }
        }

        /* Dashboard Header */
        .dashboard-header {
            margin-bottom: 24px;
        }

        .dashboard-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dashboard-header h2 i {
            color: var(--accent);
        }

        .dashboard-header p {
            color: var(--gray-600);
            font-size: 14px;
        }

        /* KPI Cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .kpi-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
            text-decoration: none;
            display: block;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--accent);
        }

        .kpi-card .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .kpi-card.projects .kpi-icon { background: #dbeafe; color: #1e40af; }
        .kpi-card.tasks .kpi-icon { background: #d1fae5; color: #065f46; }
        .kpi-card.progress .kpi-icon { background: #fef3c7; color: #92400e; }
        .kpi-card.issues .kpi-icon { background: #fee2e2; color: #991b1b; }
        .kpi-card.materials .kpi-icon { background: #e0e7ff; color: #4338ca; }

        .kpi-card .kpi-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 4px;
        }

        .kpi-card .kpi-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .kpi-card .kpi-subtitle {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 4px;
        }

        /* Section Card */
        .section-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
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

        .section-body {
            padding: 0;
        }

        /* List Items */
        .list-item {
            padding: 14px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-item:hover {
            background: #f9fafb;
        }

        .list-item-main {
            flex: 1;
        }

        .list-item-title {
            font-weight: 500;
            color: var(--black-1);
            margin-bottom: 4px;
        }

        .list-item-subtitle {
            font-size: 12px;
            color: var(--gray-600);
        }

        .list-item-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-pending { background: none; color: #92400e; }
        .badge-open { background: #fee2e2; color: #991b1b; }
        .badge-resolved { background: #d1fae5; color: #065f46; }
        .badge-progress { background: #dbeafe; color: #1e40af; }

        /* View All Link */
        .view-all {
            font-size: 13px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* Empty State */
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 32px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        /* Grid Layout */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .quick-action-btn:hover {
            filter: brightness(0.9);
        }

        .quick-action-btn.secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid #e5e7eb;
        }
        .quick-action-btn.secondary:hover {
            filter: brightness(0.95);
        }

        /* Project Card */
        .project-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .project-card:hover {
            border-color: var(--accent);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .project-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .project-card-name {
            font-weight: 600;
            color: var(--black-1);
            font-size: 15px;
        }

        .project-card-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

            .status-ongoing { background: none; color: #1e40af; }
        .status-completed { background: #d1fae5; color: #065f46; }

        .project-card-info {
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 8px;
        }

        .project-card-meta {
            display: flex;
            gap: 16px;
            font-size: 12px;
            color: var(--gray-500);
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
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

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

                <!-- Dashboard Header -->
                <div class="dashboard-header">
                    <h2>
                        <i class="fas fa-helmet-safety"></i>
                        Site Supervisor Dashboard
                    </h2>
                    <p>Monitor site activities, report progress, and manage on-site operations</p>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="{{ route('ss.progress-reports') }}" class="quick-action-btn">
                        <i class="fas fa-plus"></i> Submit Daily Progress
                    </a>
                    <a href="{{ route('ss.issues') }}" class="quick-action-btn secondary">
                        <i class="fas fa-exclamation-triangle"></i> Report Issue
                    </a>
                    <a href="{{ route('ss.material-receipts') }}" class="quick-action-btn secondary">
                        <i class="fas fa-truck"></i> Confirm Material Receipt
                    </a>
                </div>

                <!-- KPI Cards -->
                <div class="kpi-grid">
                    <a href="{{ route('ss.projects') }}" class="kpi-card projects">
                        <div class="kpi-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <div class="kpi-value">{{ $summary['assigned_projects'] ?? 0 }}</div>
                        <div class="kpi-label">Assigned Projects</div>
                        <div class="kpi-subtitle">Projects you monitor</div>
                    </a>

                    <div class="kpi-card tasks">
                        <div class="kpi-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="kpi-value">{{ $summary['ongoing_tasks'] ?? 0 }}</div>
                        <div class="kpi-label">Ongoing Tasks</div>
                        <div class="kpi-subtitle">Active projects</div>
                    </div>

                    <a href="{{ route('ss.progress-reports') }}" class="kpi-card progress">
                        <div class="kpi-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="kpi-value">{{ $summary['today_progress'] ?? 0 }}</div>
                        <div class="kpi-label">Today's Progress</div>
                        <div class="kpi-subtitle">Entries submitted today</div>
                    </a>

                    <a href="{{ route('ss.issues') }}" class="kpi-card issues">
                        <div class="kpi-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="kpi-value">{{ $summary['pending_issues'] ?? 0 }}</div>
                        <div class="kpi-label">Open Issues</div>
                        <div class="kpi-subtitle">Site concerns pending</div>
                    </a>

                    <a href="{{ route('ss.material-receipts') }}" class="kpi-card materials">
                        <div class="kpi-icon">
                            <i class="fas fa-boxes-stacked"></i>
                        </div>
                        <div class="kpi-value">{{ $summary['materials_today'] ?? 0 }}</div>
                        <div class="kpi-label">Materials Today</div>
                        <div class="kpi-subtitle">Received today</div>
                    </a>
                </div>

                <!-- Grid Layout -->
                <div class="grid-2">
                    <!-- Assigned Projects -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">
                                <i class="fas fa-folder-open"></i> My Assigned Projects
                            </span>
                            <a href="{{ route('ss.projects') }}" class="view-all">View All →</a>
                        </div>
                        <div class="section-body">
                            @forelse($assignedProjects->take(4) as $project)
                                <a href="{{ route('ss.project-view', $project->id) }}" class="project-card" style="display: block; margin: 12px; text-decoration: none;">
                                    <div class="project-card-header">
                                        <div class="project-card-name">{{ $project->project_name ?? $project->project_code }}</div>
                                        <span class="project-card-status {{ $project->status === 'Completed' ? 'status-completed' : 'status-ongoing' }}">
                                            {{ $project->status }}
                                        </span>
                                    </div>
                                    <div class="project-card-info">
                                        Client: {{ $project->client->company_name ?? 'N/A' }}
                                    </div>
                                    <div class="project-card-meta">
                                        <span><i class="fas fa-users"></i> {{ $project->employees->count() }} workers</span>
                                        <span><i class="fas fa-boxes"></i> {{ $project->materials->count() }} materials</span>
                                    </div>
                                </a>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-folder-open"></i>
                                    <p>No projects assigned to you yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Progress Entries -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">
                                <i class="fas fa-chart-line"></i> Recent Progress Reports
                            </span>
                            <a href="{{ route('ss.progress-reports') }}" class="view-all">View All →</a>
                        </div>
                        <div class="section-body">
                            @forelse($recentProgress ?? collect() as $entry)
                                <div class="list-item">
                                    <div class="list-item-main">
                                        <div class="list-item-title">{{ $entry->title ?? 'Progress Entry' }}</div>
                                        <div class="list-item-subtitle">
                                            {{ $entry->project->project_name ?? 'Unknown' }} • {{ $entry->created_at->format('M d, g:i A') }}
                                        </div>
                                    </div>
                                    <span class="list-item-badge badge-progress">
                                        {{ $entry->completion_percentage ?? 0 }}%
                                    </span>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>No progress reports yet. Submit your first daily report!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="grid-2">
                    <!-- Open Issues -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">
                                <i class="fas fa-exclamation-triangle"></i> Open Issues
                            </span>
                            <a href="{{ route('ss.issues') }}" class="view-all">View All →</a>
                        </div>
                        <div class="section-body">
                            @forelse($recentIssues ?? collect() as $issue)
                                <div class="list-item">
                                    <div class="list-item-main">
                                        <div class="list-item-title">{{ $issue->title }}</div>
                                        <div class="list-item-subtitle">
                                            {{ $issue->project->project_name ?? 'Unknown' }} • {{ $issue->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <span class="list-item-badge {{ $issue->status === 'resolved' ? 'badge-resolved' : 'badge-open' }}">
                                        {{ ucfirst($issue->status ?? 'open') }}
                                    </span>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-check-circle"></i>
                                    <p>No open issues. Great job!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pending Material Receipts -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">
                                <i class="fas fa-truck"></i> Pending Material Receipts
                            </span>
                            <a href="{{ route('ss.material-receipts') }}" class="view-all">View All →</a>
                        </div>
                        <div class="section-body">
                            @forelse($pendingMaterials ?? collect() as $material)
                                <div class="list-item">
                                    <div class="list-item-main">
                                        <div class="list-item-title">{{ Str::limit($material->item_description ?? $material->material_name ?? 'Material', 40) }}</div>
                                        <div class="list-item-subtitle">
                                            {{ $material->project->project_name ?? 'Unknown' }} • Expected: {{ $material->delivery_date ? \Carbon\Carbon::parse($material->delivery_date)->format('M d') : 'TBD' }}
                                        </div>
                                    </div>
                                    <span class="list-item-badge badge-pending">Pending</span>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <p>No pending material receipts.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
