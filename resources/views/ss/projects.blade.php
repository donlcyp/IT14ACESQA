<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Assigned Projects - Site Supervisor</title>
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

        .content-area {
            flex: 1;
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
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
        }

        /* Projects Grid */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .project-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.2s;
        }

        .project-card:hover {
            border-color: var(--accent);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .project-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .project-card-title {
            font-weight: 600;
            color: var(--black-1);
            font-size: 16px;
            margin-bottom: 4px;
        }

        .project-card-code {
            font-size: 12px;
            color: var(--gray-500);
            font-family: 'Source Code Pro', monospace;
        }

        .project-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending { background: none; color: #92400e; }
        .status-ongoing { background: none; color: #1e40af; }
        .status-completed { background: #d1fae5; color: #065f46; }

        .project-card-body {
            padding: 16px 20px;
        }

        .project-info {
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 12px;
        }

        .project-info strong {
            color: var(--gray-700);
        }

        .project-meta {
            display: flex;
            gap: 20px;
            font-size: 12px;
            color: var(--gray-500);
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }

        .project-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .project-card-footer {
            padding: 12px 20px;
            background: #f9fafb;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

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

        .btn-primary {
            background: var(--accent);
            color: white;
        }
        .btn-primary:hover {
            filter: brightness(0.9);
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid #e5e7eb;
        }
        .btn-secondary:hover {
            filter: brightness(0.95);
        }

        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 60px 20px;
            text-align: center;
            color: var(--gray-500);
            border: 1px solid #e5e7eb;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .pagination-wrapper {
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 4px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            text-decoration: none;
            color: var(--gray-700);
            background: white;
            border: 1px solid #e5e7eb;
        }

        .pagination a:hover {
            background: #f9fafb;
            border-color: var(--accent);
        }

        .pagination .active span {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .pagination .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
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
                    <div>
                        <a href="{{ route('ss.dashboard') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <h2>
                            <i class="fas fa-folder-open"></i>
                            My Assigned Projects
                        </h2>
                    </div>
                </div>

                @if($projects->count() > 0)
                    <div class="projects-grid">
                        @foreach($projects as $project)
                            <div class="project-card">
                                <div class="project-card-header">
                                    <div>
                                        <div class="project-card-title">{{ $project->project_name ?? 'Unnamed Project' }}</div>
                                        <div class="project-card-code">{{ $project->project_code }}</div>
                                    </div>
                                    <span class="project-status status-{{ strtolower($project->status ?? 'pending') }}">
                                        {{ $project->status ?? 'Pending' }}
                                    </span>
                                </div>
                                <div class="project-card-body">
                                    <div class="project-info">
                                        <strong>Client:</strong> {{ $project->client_name ?? 'N/A' }}
                                    </div>
                                    <div class="project-info">
                                        <strong>Location:</strong> {{ Str::limit($project->location ?? 'Not specified', 40) }}
                                    </div>
                                    <div class="project-info">
                                        <strong>Duration:</strong> 
                                        {{ $project->date_started ? \Carbon\Carbon::parse($project->date_started)->format('M d, Y') : 'TBD' }} 
                                        - 
                                        {{ $project->date_ended ? \Carbon\Carbon::parse($project->date_ended)->format('M d, Y') : 'TBD' }}
                                    </div>
                                    <div class="project-meta">
                                        <span><i class="fas fa-users"></i> {{ $project->employees->count() }} Workers</span>
                                        <span><i class="fas fa-boxes"></i> {{ $project->materials->count() }} Materials</span>
                                        <span><i class="fas fa-file-alt"></i> {{ $project->updates->count() }} Updates</span>
                                    </div>
                                </div>
                                <div class="project-card-footer">
                                    <a href="{{ route('ss.project-view', $project->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($projects->hasPages())
                        <div class="pagination-wrapper">
                            {{ $projects->links() }}
                        </div>
                    @endif
                @else
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h3>No Projects Assigned</h3>
                        <p>You don't have any projects assigned to you yet. Contact your Project Manager for assignment.</p>
                    </div>
                @endif
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
