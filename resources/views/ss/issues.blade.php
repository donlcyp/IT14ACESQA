<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Issues & Incidents - Site Supervisor</title>
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
            color: var(--danger);
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

        /* Grid Layout */
        .main-grid {
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
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

        .card-body {
            padding: 20px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        .form-group label .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            background: white;
            cursor: pointer;
        }

        /* File Upload */
        .file-upload {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-upload:hover {
            border-color: var(--danger);
            background: #fef2f2;
        }

        .file-upload i {
            font-size: 24px;
            color: var(--gray-400);
            margin-bottom: 8px;
        }

        .file-upload p {
            font-size: 13px;
            color: var(--gray-500);
        }

        .file-upload input {
            display: none;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            width: 100%;
        }

        .btn-danger {
            background: var(--accent);
            color: white;
        }

        .btn-danger:hover {
            background: var(--accent-dark);
        }

        /* Priority Options */
        .priority-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .priority-option {
            text-align: center;
            padding: 10px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .priority-option:hover {
            border-color: var(--accent);
        }

        .priority-option.selected {
            border-color: var(--black-1);
            background: #f9fafb;
        }

        .priority-option input {
            display: none;
        }

        .priority-option.low { border-color: #10b981; }
        .priority-option.low.selected { background: #d1fae5; }
        .priority-option.medium { border-color: #f59e0b; }
        .priority-option.medium.selected { background: #fef3c7; }
        .priority-option.high { border-color: #dc2626; }
        .priority-option.high.selected { background: #fee2e2; }

        .priority-label {
            font-size: 12px;
            font-weight: 600;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 8px;
        }

        .filter-tab {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            background: #f3f4f6;
            color: var(--gray-600);
            border: none;
            transition: all 0.2s;
        }

        .filter-tab:hover {
            background: #e5e7eb;
        }

        .filter-tab.active {
            background: var(--accent);
            color: white;
        }

        /* Issue List */
        .issue-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .issue-item {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s;
        }

        .issue-item:last-child {
            border-bottom: none;
        }

        .issue-item:hover {
            background: #f9fafb;
        }

        .issue-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
            gap: 12px;
        }

        .issue-title {
            font-weight: 600;
            color: var(--black-1);
            font-size: 14px;
        }

        .issue-badges {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }

        .badge-open { background: #fee2e2; color: #991b1b; }
        .badge-in-progress { background: #fef3c7; color: #92400e; }
        .badge-resolved { background: #d1fae5; color: #065f46; }

        .badge-low { background: #d1fae5; color: #065f46; }
        .badge-medium { background: #fef3c7; color: #92400e; }
        .badge-high { background: #fee2e2; color: #991b1b; }

        .issue-meta {
            font-size: 12px;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .issue-task {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #eff6ff;
            color: var(--accent);
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            margin-right: 8px;
        }

        .issue-excerpt {
            font-size: 13px;
            color: var(--gray-600);
            line-height: 1.5;
        }

        .issue-category {
            display: inline-block;
            margin-top: 8px;
            padding: 4px 10px;
            background: #f3f4f6;
            border-radius: 4px;
            font-size: 11px;
            color: var(--gray-600);
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

        /* Task info display */
        .task-info {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
            margin-top: 8px;
            display: none;
        }

        .task-info.visible {
            display: block;
        }

        .task-info-label {
            font-size: 11px;
            color: var(--gray-500);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .task-info-value {
            font-size: 14px;
            color: var(--black-1);
            font-weight: 500;
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
                        <i class="fas fa-exclamation-triangle"></i>
                        Issues & Incidents
                    </h2>
                    <p>Report and track site issues, safety concerns, or task-related problems</p>
                </div>

                @if($project)
                    <!-- Project Info Bar -->
                    <div class="project-info-bar">
                        <div>
                            <h3>{{ $project->project_name ?? $project->project_code }}</h3>
                            <p>{{ $project->location ?? 'Location not specified' }}</p>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 24px; font-weight: 700;">{{ $issues->where('status', 'open')->count() }}</div>
                            <div style="font-size: 12px; opacity: 0.9;">Open Issues</div>
                        </div>
                    </div>

                    <div class="main-grid">
                        <!-- Report Form -->
                        <div class="card" style="height: fit-content;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-flag"></i> Report New Issue
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('ss.issues.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                                    <div class="form-group">
                                        <label>Related Task <span class="required">*</span></label>
                                        <select name="task_id" class="form-control" required id="taskSelect">
                                            <option value="">Select a task</option>
                                            @foreach($tasks as $task)
                                                <option value="{{ $task->id }}" 
                                                        data-material="{{ $task->material->item_name ?? 'N/A' }}"
                                                        data-description="{{ Str::limit($task->description, 100) }}">
                                                    {{ $task->title }} ({{ $task->material->item_name ?? 'No Material' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="task-info" id="taskInfo">
                                            <div class="task-info-label">Material</div>
                                            <div class="task-info-value" id="taskMaterial">-</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Issue Title <span class="required">*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Brief description of the issue" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Issue Type <span class="required">*</span></label>
                                        <select name="issue_type" class="form-control" required>
                                            <option value="">Select Type</option>
                                            <option value="safety">🦺 Safety Concern</option>
                                            <option value="material">📦 Material Defect/Issue</option>
                                            <option value="equipment">🔧 Equipment Problem</option>
                                            <option value="weather">🌧️ Weather Delay</option>
                                            <option value="manpower">👷 Manpower Issue</option>
                                            <option value="quality">✅ Quality Issue</option>
                                            <option value="delay">⏰ Schedule Delay</option>
                                            <option value="other">📝 Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Priority Level <span class="required">*</span></label>
                                        <div class="priority-options">
                                            <label class="priority-option low">
                                                <input type="radio" name="priority" value="low" required>
                                                <div class="priority-label">🟢 Low</div>
                                            </label>
                                            <label class="priority-option medium">
                                                <input type="radio" name="priority" value="medium">
                                                <div class="priority-label">🟡 Medium</div>
                                            </label>
                                            <label class="priority-option high">
                                                <input type="radio" name="priority" value="high">
                                                <div class="priority-label">🔴 High</div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Detailed Description <span class="required">*</span></label>
                                        <textarea name="description" class="form-control" placeholder="Provide full details of the issue, including specific location, affected work, and any immediate actions taken..." required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Photos/Evidence</label>
                                        <label class="file-upload">
                                            <i class="fas fa-camera"></i>
                                            <p id="photoLabel">Click to upload photos (max 5)</p>
                                            <input type="file" name="photos[]" accept="image/*" multiple id="photoInput">
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Suggested Action</label>
                                        <textarea name="notes" class="form-control" rows="2" placeholder="What action do you recommend to resolve this issue?"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-flag"></i> Submit Issue Report
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Issues List -->
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">
                                    <i class="fas fa-list"></i> Reported Issues
                                </span>
                                <div class="filter-tabs">
                                    <button class="filter-tab active" data-filter="all">All</button>
                                    <button class="filter-tab" data-filter="open">Open</button>
                                    <button class="filter-tab" data-filter="in-progress">In Progress</button>
                                    <button class="filter-tab" data-filter="resolved">Resolved</button>
                                </div>
                            </div>
                            <div class="issue-list">
                                @forelse($issues as $issue)
                                    <div class="issue-item" data-status="{{ $issue->status ?? 'open' }}">
                                        <div class="issue-header">
                                            <div class="issue-title">{{ $issue->title }}</div>
                                            <div class="issue-badges">
                                                <span class="badge badge-{{ $issue->status ?? 'open' }}">
                                                    {{ ucfirst(str_replace('-', ' ', $issue->status ?? 'open')) }}
                                                </span>
                                                <span class="badge badge-{{ $issue->priority ?? 'medium' }}">
                                                    {{ ucfirst($issue->priority ?? 'medium') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="issue-meta">
                                            @if($issue->relatedTask)
                                                <span class="issue-task">
                                                    <i class="fas fa-tasks"></i> {{ $issue->relatedTask->title ?? 'Unknown Task' }}
                                                </span>
                                            @endif
                                            <i class="fas fa-clock"></i> Reported {{ $issue->created_at->diffForHumans() }}
                                        </div>
                                        <div class="issue-excerpt">
                                            {{ Str::limit($issue->description ?? '', 150) }}
                                        </div>
                                        @if($issue->issue_type)
                                            <span class="issue-category">
                                                {{ ucfirst(str_replace('-', ' ', $issue->issue_type)) }}
                                            </span>
                                        @endif
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fas fa-check-circle"></i>
                                        <h3>No Issues Reported</h3>
                                        <p>Great! No issues have been reported yet. Use the form to report any task-related concerns.</p>
                                    </div>
                                @endforelse
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
        // Task select shows material info
        const taskSelect = document.getElementById('taskSelect');
        const taskInfo = document.getElementById('taskInfo');
        const taskMaterial = document.getElementById('taskMaterial');

        if (taskSelect) {
            taskSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                if (selected.value) {
                    taskMaterial.textContent = selected.dataset.material;
                    taskInfo.classList.add('visible');
                } else {
                    taskInfo.classList.remove('visible');
                }
            });
        }

        // Priority selection
        document.querySelectorAll('.priority-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.priority-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // File upload feedback
        const photoInput = document.getElementById('photoInput');
        const photoLabel = document.getElementById('photoLabel');

        if (photoInput) {
            photoInput.addEventListener('change', function() {
                const count = this.files.length;
                if (count > 0) {
                    photoLabel.textContent = count + ' file(s) selected';
                } else {
                    photoLabel.textContent = 'Click to upload photos (max 5)';
                }
            });
        }

        // Filter issues
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                document.querySelectorAll('.issue-item').forEach(item => {
                    if (filter === 'all' || item.dataset.status === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
