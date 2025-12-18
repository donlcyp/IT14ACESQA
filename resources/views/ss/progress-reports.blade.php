<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daily Progress Reports - Site Supervisor</title>
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
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
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
        }

        .tab-btn:hover {
            color: var(--accent);
        }

        .tab-btn.active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Main Grid */
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
            color: #dc2626;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
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
            border-color: var(--accent);
            background: #eff6ff;
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
            width: 100%;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        /* Tasks List */
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 16px;
        }

        .task-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
            transition: all 0.2s;
        }

        .task-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .task-material {
            font-size: 11px;
            color: var(--accent);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #eff6ff;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .task-priority {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .priority-high { background: #fee2e2; color: #991b1b; }
        .priority-medium { background: #fef3c7; color: #92400e; }
        .priority-low { background: #d1fae5; color: #065f46; }

        .task-title {
            font-weight: 600;
            color: var(--black-1);
            font-size: 15px;
            margin-bottom: 8px;
        }

        .task-description {
            font-size: 13px;
            color: var(--gray-600);
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .task-progress {
            margin-bottom: 12px;
        }

        .progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent);
            border-radius: 4px;
            transition: width 0.3s;
        }

        .progress-text {
            font-size: 12px;
            color: var(--gray-500);
        }

        .task-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--gray-500);
        }

        /* Reports List */
        .report-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .report-item {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.2s;
        }

        .report-item:last-child {
            border-bottom: none;
        }

        .report-item:hover {
            background: #f9fafb;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .report-title {
            font-weight: 600;
            color: var(--black-1);
            font-size: 14px;
        }

        .report-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            background: #dbeafe;
            color: #1e40af;
        }

        .report-meta {
            font-size: 12px;
            color: var(--gray-500);
            margin-bottom: 8px;
        }

        .report-excerpt {
            font-size: 13px;
            color: var(--gray-600);
            line-height: 1.5;
        }

        .report-photos {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .report-photo {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #e5e7eb;
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

        /* Completion Slider */
        .completion-slider {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .completion-slider input[type="range"] {
            flex: 1;
            height: 8px;
            border-radius: 4px;
            background: #e5e7eb;
            appearance: none;
        }

        .completion-slider input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--accent);
            cursor: pointer;
        }

        .completion-value {
            min-width: 50px;
            font-weight: 600;
            color: var(--black-1);
            text-align: right;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--black-1);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--gray-500);
            cursor: pointer;
        }

        .modal-body {
            padding: 20px;
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
                        <i class="fas fa-chart-line"></i>
                        Daily Progress Reports
                    </h2>
                    <p>Manage tasks for materials and submit daily progress reports</p>
                </div>

                @if($project)
                    <!-- Project Info Bar -->
                    <div class="project-info-bar">
                        <div>
                            <h3>{{ $project->project_name ?? $project->project_code }}</h3>
                            <p>{{ $project->location ?? 'Location not specified' }}</p>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 24px; font-weight: 700;">{{ $materials->count() }}</div>
                            <div style="font-size: 12px; opacity: 0.9;">Materials</div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="tabs-container">
                        <button class="tab-btn active" onclick="switchTab('tasks')">
                            <i class="fas fa-tasks"></i> Tasks ({{ $tasks->count() }})
                        </button>
                        <button class="tab-btn" onclick="switchTab('progress')">
                            <i class="fas fa-file-alt"></i> Submit Progress
                        </button>
                        <button class="tab-btn" onclick="switchTab('reports')">
                            <i class="fas fa-history"></i> Previous Reports ({{ $progressReports->count() }})
                        </button>
                    </div>

                    <!-- Tasks Tab -->
                    <div id="tasks-tab" class="tab-content active">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h3 style="font-size: 18px; font-weight: 600; color: var(--black-1);">Material Tasks</h3>
                            <button class="btn btn-success" onclick="openCreateTaskModal()">
                                <i class="fas fa-plus"></i> Create Task
                            </button>
                        </div>

                        @if($tasks->count() > 0)
                            <div class="tasks-grid">
                                @foreach($tasks as $task)
                                    <div class="task-card">
                                        <div class="task-header">
                                            <span class="task-material">
                                                <i class="fas fa-box"></i> {{ $task->material->item_name ?? 'No Material' }}
                                            </span>
                                            <span class="task-priority priority-{{ $task->priority ?? 'medium' }}">
                                                {{ ucfirst($task->priority ?? 'Medium') }}
                                            </span>
                                        </div>
                                        <div class="task-title">{{ $task->title }}</div>
                                        <div class="task-description">{{ Str::limit($task->description, 100) }}</div>
                                        <div class="task-progress">
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ $task->completion_percentage ?? 0 }}%"></div>
                                            </div>
                                            <div class="progress-text">{{ $task->completion_percentage ?? 0 }}% Complete</div>
                                        </div>
                                        <div class="task-meta">
                                            <span><i class="fas fa-calendar"></i> {{ $task->created_at->format('M d, Y') }}</span>
                                            <span><i class="fas fa-user"></i> {{ $task->workers_present ?? 0 }} workers</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-tasks"></i>
                                <h3>No Tasks Yet</h3>
                                <p>Create tasks for materials to track installation progress.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Progress Report Tab -->
                    <div id="progress-tab" class="tab-content">
                        <div class="main-grid">
                            <!-- Submit Form -->
                            <div class="card" style="height: fit-content;">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-plus-circle"></i> Submit Progress Report
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('ss.progress-reports.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                                        <div class="form-group">
                                            <label>Select Task <span class="required">*</span></label>
                                            <select name="task_id" class="form-control" required id="taskSelect">
                                                <option value="">Select a task</option>
                                                @foreach($tasks as $task)
                                                    <option value="{{ $task->id }}" data-material="{{ $task->material->item_name ?? 'N/A' }}" data-completion="{{ $task->completion_percentage ?? 0 }}">
                                                        {{ $task->title }} ({{ $task->material->item_name ?? 'No Material' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Material</label>
                                            <input type="text" class="form-control" id="materialDisplay" readonly placeholder="Select a task first" style="background: #f9fafb;">
                                        </div>

                                        <div class="form-group">
                                            <label>Report Date</label>
                                            <input type="date" name="report_date" class="form-control" value="{{ date('Y-m-d') }}" readonly style="background: #f9fafb;">
                                        </div>

                                        <div class="form-group">
                                            <label>Title / Summary <span class="required">*</span></label>
                                            <input type="text" name="title" class="form-control" placeholder="e.g., Steel beam installation completed" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Work Accomplished Today <span class="required">*</span></label>
                                            <textarea name="description" class="form-control" placeholder="Describe what work was completed on this task today..." required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Task Completion Percentage</label>
                                            <div class="completion-slider">
                                                <input type="range" name="completion_percentage" id="completionRange" min="0" max="100" value="0">
                                                <span class="completion-value" id="completionValue">0%</span>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label>Workers On-Site</label>
                                                <input type="number" name="workers_present" class="form-control" placeholder="Number" min="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Weather Conditions</label>
                                                <select name="weather_condition" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="sunny">☀️ Sunny</option>
                                                    <option value="cloudy">⛅ Cloudy</option>
                                                    <option value="rainy">🌧️ Rainy</option>
                                                    <option value="stormy">⛈️ Stormy</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Site Photos (Optional)</label>
                                            <label class="file-upload">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <p id="photoLabel">Click to upload photos (max 5)</p>
                                                <input type="file" name="photos[]" accept="image/*" multiple id="photoInput">
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label>Additional Notes</label>
                                            <textarea name="notes" class="form-control" placeholder="Any additional observations..." rows="2"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane"></i> Submit Report
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Materials Overview -->
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title">
                                        <i class="fas fa-boxes"></i> Project Materials
                                    </span>
                                </div>
                                <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                                    @forelse($materials as $material)
                                        <div style="padding: 12px 0; border-bottom: 1px solid #f3f4f6;">
                                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                                <div>
                                                    <div style="font-weight: 600; color: var(--black-1);">{{ $material->item_name }}</div>
                                                    <div style="font-size: 12px; color: var(--gray-500);">{{ $material->unit ?? 'N/A' }} • Qty: {{ $material->quantity ?? 0 }}</div>
                                                </div>
                                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 500; 
                                                    @if($material->qa_status === 'passed') background: #d1fae5; color: #065f46;
                                                    @elseif($material->qa_status === 'failed') background: #fee2e2; color: #991b1b;
                                                    @elseif($material->qa_status === 'rechecking') background: #fef3c7; color: #92400e;
                                                    @else background: #f3f4f6; color: var(--gray-600); @endif">
                                                    {{ ucfirst($material->qa_status ?? 'Pending') }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-state">
                                            <i class="fas fa-boxes"></i>
                                            <p>No materials assigned to this project.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reports Tab -->
                    <div id="reports-tab" class="tab-content">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">
                                    <i class="fas fa-history"></i> Previous Reports
                                </span>
                            </div>
                            <div class="report-list">
                                @forelse($progressReports as $report)
                                    <div class="report-item">
                                        <div class="report-header">
                                            <div class="report-title">{{ $report->title ?? 'Progress Report' }}</div>
                                            <span class="report-badge">{{ $report->completion_percentage ?? 0 }}%</span>
                                        </div>
                                        <div class="report-meta">
                                            @if($report->material)
                                                <i class="fas fa-box"></i> {{ $report->material->item_name }} •
                                            @endif
                                            <i class="fas fa-calendar"></i> {{ $report->created_at->format('M d, Y - g:i A') }}
                                            @if($report->workers_present)
                                                • <i class="fas fa-users"></i> {{ $report->workers_present }} workers
                                            @endif
                                            @if($report->weather_condition)
                                                • {{ ucfirst($report->weather_condition) }}
                                            @endif
                                        </div>
                                        <div class="report-excerpt">{{ Str::limit($report->description ?? '', 200) }}</div>
                                        @if($report->photos && is_array($report->photos) && count($report->photos) > 0)
                                            <div class="report-photos">
                                                @foreach(array_slice($report->photos, 0, 4) as $photo)
                                                    <img src="{{ asset('storage/' . $photo) }}" alt="Progress photo" class="report-photo">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <h3>No Reports Yet</h3>
                                        <p>Submit your first daily progress report from the Progress tab.</p>
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

    <!-- Create Task Modal -->
    <div class="modal-overlay" id="createTaskModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-plus-circle"></i> Create New Task</h3>
                <button class="modal-close" onclick="closeCreateTaskModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ss.tasks.store') }}" method="POST">
                    @csrf
                    @if($project)
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    @endif

                    <div class="form-group">
                        <label>Select Material <span class="required">*</span></label>
                        <select name="material_id" class="form-control" required>
                            <option value="">Select material to create task for</option>
                            @foreach($materials ?? [] as $material)
                                <option value="{{ $material->id }}">{{ $material->item_name }} ({{ $material->unit ?? 'N/A' }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Task Title <span class="required">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="e.g., Install steel beams on floor 2" required>
                    </div>

                    <div class="form-group">
                        <label>Task Description <span class="required">*</span></label>
                        <textarea name="description" class="form-control" placeholder="Describe how the material should be installed or used..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Priority</label>
                        <select name="priority" class="form-control">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Task
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Tab switching
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.add('active');
            event.target.closest('.tab-btn').classList.add('active');
        }

        // Completion slider
        const completionRange = document.getElementById('completionRange');
        const completionValue = document.getElementById('completionValue');

        if (completionRange) {
            completionRange.addEventListener('input', function() {
                completionValue.textContent = this.value + '%';
            });
        }

        // Task select updates material display
        const taskSelect = document.getElementById('taskSelect');
        const materialDisplay = document.getElementById('materialDisplay');

        if (taskSelect) {
            taskSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                if (selected.value) {
                    materialDisplay.value = selected.dataset.material;
                    completionRange.value = selected.dataset.completion;
                    completionValue.textContent = selected.dataset.completion + '%';
                } else {
                    materialDisplay.value = '';
                }
            });
        }

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

        // Modal functions
        function openCreateTaskModal() {
            document.getElementById('createTaskModal').classList.add('active');
        }

        function closeCreateTaskModal() {
            document.getElementById('createTaskModal').classList.remove('active');
        }

        // Close modal on outside click
        document.getElementById('createTaskModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateTaskModal();
            }
        });
    </script>
</body>
</html>
