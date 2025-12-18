<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Project Details - Site Supervisor</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #0891b2;
            --accent-dark: #0e7490;
            --accent-light: #22d3ee;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: #0891b2;
            --main-bg: #f0fdfa;

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
            background: linear-gradient(135deg, var(--header-bg), #0e7490);
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

        .back-btn:hover {
            background: white;
            color: var(--accent);
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

        .project-status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-left: 12px;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-ongoing { background: #dbeafe; color: #1e40af; }
        .status-completed { background: #d1fae5; color: #065f46; }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 20px;
        }

        .info-card h3 {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card h3 i {
            color: var(--accent);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 13px;
            color: var(--gray-600);
        }

        .info-value {
            font-size: 13px;
            font-weight: 500;
            color: var(--black-1);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--black-1);
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
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
            padding: 12px 16px;
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

        .role-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }

        .role-ss { background: #cffafe; color: #0e7490; }
        .role-cw { background: #e5e7eb; color: #4b5563; }
        .role-other { background: #e0e7ff; color: #4338ca; }

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

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: var(--accent);
        }

        .read-only-notice {
            background: #fef3c7;
            color: #92400e;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .read-only-notice i {
            font-size: 16px;
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
                <div class="page-header">
                    <a href="{{ route('ss.projects') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Projects
                    </a>
                    <h2>
                        <i class="fas fa-folder-open"></i>
                        {{ $project->project_name ?? $project->project_code }}
                        <span class="project-status-badge status-{{ strtolower($project->status ?? 'pending') }}">
                            {{ $project->status ?? 'Pending' }}
                        </span>
                    </h2>
                </div>

                <div class="read-only-notice">
                    <i class="fas fa-info-circle"></i>
                    <span>You have read-only access to project details. Use the action buttons below to submit progress reports or report issues.</span>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('ss.progress-reports', ['project' => $project->id]) }}" class="btn btn-primary">
                        <i class="fas fa-chart-line"></i> Submit Progress Report
                    </a>
                    <a href="{{ route('ss.issues', ['project' => $project->id]) }}" class="btn btn-secondary">
                        <i class="fas fa-exclamation-triangle"></i> Report Issue
                    </a>
                    <a href="{{ route('ss.material-receipts', ['project' => $project->id]) }}" class="btn btn-secondary">
                        <i class="fas fa-truck"></i> Material Receipts
                    </a>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['total_workers'] ?? 0 }}</div>
                        <div class="stat-label">Workers Assigned</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['total_materials'] ?? 0 }}</div>
                        <div class="stat-label">Materials</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['progress_entries'] ?? 0 }}</div>
                        <div class="stat-label">Progress Entries</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $stats['open_issues'] ?? 0 }}</div>
                        <div class="stat-label">Open Issues</div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="info-grid">
                    <!-- Project Details -->
                    <div class="info-card">
                        <h3><i class="fas fa-info-circle"></i> Project Details</h3>
                        <div class="info-row">
                            <span class="info-label">Project Code</span>
                            <span class="info-value">{{ $project->project_code }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Client</span>
                            <span class="info-value">{{ $project->client->company_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Location</span>
                            <span class="info-value">{{ $project->site_location ?? 'Not specified' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value">{{ $project->status ?? 'Pending' }}</span>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="info-card">
                        <h3><i class="fas fa-calendar"></i> Timeline</h3>
                        <div class="info-row">
                            <span class="info-label">Start Date</span>
                            <span class="info-value">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d, Y') : 'TBD' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">End Date</span>
                            <span class="info-value">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M d, Y') : 'TBD' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Duration</span>
                            <span class="info-value">
                                @if($project->start_date && $project->end_date)
                                    {{ \Carbon\Carbon::parse($project->start_date)->diffInDays(\Carbon\Carbon::parse($project->end_date)) }} days
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Days Remaining</span>
                            <span class="info-value">
                                @if($project->end_date && \Carbon\Carbon::parse($project->end_date)->isFuture())
                                    {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($project->end_date)) }} days
                                @elseif($project->end_date)
                                    Overdue
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Assigned Workers -->
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-title">
                            <i class="fas fa-users"></i> Assigned Workers
                        </span>
                    </div>
                    <div class="table-container">
                        @if($project->employees->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->employees as $employee)
                                        <tr>
                                            <td>
                                                <strong>{{ $employee->fname ?? '' }} {{ $employee->lname ?? '' }}</strong>
                                            </td>
                                            <td>
                                                @php
                                                    $role = $employee->role ?? $employee->position ?? 'CW';
                                                    $roleClass = match(strtoupper($role)) {
                                                        'SS' => 'role-ss',
                                                        'CW' => 'role-cw',
                                                        default => 'role-other'
                                                    };
                                                @endphp
                                                <span class="role-badge {{ $roleClass }}">{{ $role }}</span>
                                            </td>
                                            <td>{{ $employee->contact_number ?? $employee->phone ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>No workers assigned to this project yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Materials -->
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-title">
                            <i class="fas fa-boxes"></i> Project Materials
                        </span>
                        <a href="{{ route('ss.material-receipts', ['project' => $project->id]) }}" style="font-size: 13px; color: var(--accent); text-decoration: none;">
                            View Material Receipts →
                        </a>
                    </div>
                    <div class="table-container">
                        @if($project->materials->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->materials->take(10) as $material)
                                        <tr>
                                            <td>{{ Str::limit($material->item_description ?? $material->material_name ?? 'Material', 50) }}</td>
                                            <td>{{ $material->quantity ?? 0 }}</td>
                                            <td>{{ $material->unit ?? 'pcs' }}</td>
                                            <td>
                                                <span class="role-badge {{ $material->received_by_ss ? 'role-ss' : 'role-cw' }}">
                                                    {{ $material->received_by_ss ? 'Received' : 'Pending' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($project->materials->count() > 10)
                                <div style="padding: 12px 16px; text-align: center; font-size: 13px; color: var(--gray-500);">
                                    And {{ $project->materials->count() - 10 }} more materials...
                                </div>
                            @endif
                        @else
                            <div class="empty-state">
                                <i class="fas fa-boxes"></i>
                                <p>No materials listed for this project yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Progress -->
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-title">
                            <i class="fas fa-chart-line"></i> Recent Progress Reports
                        </span>
                    </div>
                    <div class="table-container">
                        @if(isset($recentProgress) && $recentProgress->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Completion</th>
                                        <th>Reported By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentProgress as $progress)
                                        <tr>
                                            <td>{{ $progress->created_at->format('M d, Y') }}</td>
                                            <td>{{ Str::limit($progress->title ?? 'Progress Entry', 40) }}</td>
                                            <td>{{ $progress->completion_percentage ?? 0 }}%</td>
                                            <td>{{ $progress->user->name ?? 'Unknown' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <p>No progress reports submitted yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
