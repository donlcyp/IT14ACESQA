<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Tasks - Construction Worker</title>
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

        /* Filter Row */
        .filter-row {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: var(--white);
        }

        /* Task Cards */
        .task-grid {
            display: grid;
            gap: 16px;
        }

        .task-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .task-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .task-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
        }

        .task-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-in-progress { background: #dbeafe; color: #1e40af; }
        .status-completed { background: #d1fae5; color: #065f46; }

        .task-description {
            color: var(--gray);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .task-meta {
            display: flex;
            gap: 16px;
            font-size: 13px;
            color: var(--gray);
            flex-wrap: wrap;
        }

        .task-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .task-actions {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .complete-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--success);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .complete-btn:hover {
            background: #059669;
        }

        .complete-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

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
            margin-top: 24px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav {
            display: flex;
            gap: 8px;
        }

        .pagination-wrapper a, .pagination-wrapper span {
            padding: 8px 12px;
            background: var(--white);
            border-radius: 8px;
            text-decoration: none;
            color: var(--dark);
            font-size: 14px;
        }

        .pagination-wrapper a:hover {
            background: var(--primary);
            color: var(--white);
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
                <h1 class="header-title">My Tasks</h1>
            </header>

            <div class="content-area">
                <div class="page-header">
                    <a href="{{ route('cw.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <h2><i class="fas fa-tasks"></i> My Tasks & Assignments</h2>
                    <p>View and track your assigned tasks across all projects</p>
                </div>

                <!-- Filters -->
                <div class="filter-row">
                    <select class="filter-select" id="projectFilter" onchange="filterTasks()">
                        <option value="">All Projects</option>
                        @foreach($assignedProjects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->project_name }}
                            </option>
                        @endforeach
                    </select>
                    <select class="filter-select" id="statusFilter" onchange="filterTasks()">
                        <option value="">All Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Task List -->
                @if($tasks->count() > 0)
                    <div class="task-grid">
                        @foreach($tasks as $task)
                            <div class="task-card">
                                <div class="task-card-header">
                                    <h3 class="task-title">{{ $task->title }}</h3>
                                    <span class="task-status {{ $task->status === 'Completed' ? 'status-completed' : ($task->status === 'In Progress' ? 'status-in-progress' : 'status-pending') }}">
                                        {{ $task->status }}
                                    </span>
                                </div>
                                <p class="task-description">{{ Str::limit($task->description, 200) }}</p>
                                <div class="task-meta">
                                    <span><i class="fas fa-folder"></i> {{ $task->project->project_name ?? 'N/A' }}</span>
                                    <span><i class="fas fa-calendar"></i> {{ $task->created_at->format('M d, Y') }}</span>
                                    <span><i class="fas fa-clock"></i> {{ $task->created_at->diffForHumans() }}</span>
                                </div>
                                @if($task->status !== 'Completed')
                                    <div class="task-actions">
                                        <form action="{{ route('cw.tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="complete-btn" onclick="return confirm('Mark this task as completed?')">
                                                <i class="fas fa-check"></i> Mark Complete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper">
                        {{ $tasks->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <h3>No Tasks Found</h3>
                        <p>You don't have any tasks assigned at the moment.</p>
                    </div>
                @endif
            </div>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        function filterTasks() {
            const projectId = document.getElementById('projectFilter').value;
            const status = document.getElementById('statusFilter').value;
            
            let url = new URL(window.location.href);
            
            if (projectId) {
                url.searchParams.set('project_id', projectId);
            } else {
                url.searchParams.delete('project_id');
            }
            
            if (status) {
                url.searchParams.set('status', status);
            } else {
                url.searchParams.delete('status');
            }
            
            window.location.href = url.toString();
        }
    </script>
</body>
</html>
