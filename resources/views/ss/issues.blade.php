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
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            margin-bottom: 12px;
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
            color: #dc2626;
        }

        .page-header p {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
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

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .form-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            background: none;
        }

        .form-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-title i {
            color: #dc2626;
        }

        .form-body {
            padding: 20px;
        }

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
            box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            background: white;
            cursor: pointer;
        }

        .file-upload {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-upload:hover {
            border-color: #dc2626;
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
            background: #dc2626;
            color: white;
        }
        .btn-danger:hover {
            filter: brightness(0.9);
        }

        /* Priority Select */
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

        /* Issues List */
        .section-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
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
            color: #dc2626;
        }

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
        }

        .filter-tab.active {
            background: var(--accent);
            color: white;
        }

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
                    <p>Report and track site issues, safety concerns, or delays</p>
                </div>

                <div class="main-grid">
                    <!-- Report Form -->
                    <div class="form-card">
                        <div class="form-header">
                            <h3 class="form-title">
                                <i class="fas fa-flag"></i> Report New Issue
                            </h3>
                        </div>
                        <div class="form-body">
                            <form action="{{ route('ss.issues.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Project <span class="required">*</span></label>
                                    <select name="project_id" class="form-control" required>
                                        <option value="">Select Project</option>
                                        @foreach($projects ?? [] as $project)
                                            <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                                                {{ $project->project_name ?? $project->project_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Issue Title <span class="required">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Brief description of the issue" required>
                                </div>

                                <div class="form-group">
                                    <label>Category <span class="required">*</span></label>
                                    <select name="category" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <option value="safety">🦺 Safety Concern</option>
                                        <option value="material">📦 Material Issue</option>
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
                                    <textarea name="description" class="form-control" placeholder="Provide full details of the issue, including location, affected work, and any immediate actions taken..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Photos/Evidence</label>
                                    <label class="file-upload">
                                        <i class="fas fa-camera"></i>
                                        <p>Click to upload photos (max 5)</p>
                                        <input type="file" name="photos[]" accept="image/*" multiple>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Suggested Action</label>
                                    <textarea name="suggested_action" class="form-control" rows="2" placeholder="What action do you recommend?"></textarea>
                                </div>

                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-flag"></i> Submit Issue Report
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Issues List -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">
                                <i class="fas fa-list"></i> Reported Issues
                            </span>
                            <div class="filter-tabs">
                                <button class="filter-tab active" onclick="filterIssues('all')">All</button>
                                <button class="filter-tab" onclick="filterIssues('open')">Open</button>
                                <button class="filter-tab" onclick="filterIssues('resolved')">Resolved</button>
                            </div>
                        </div>
                        <div class="issue-list">
                            @forelse($issues ?? [] as $issue)
                                <div class="issue-item">
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
                                        {{ $issue->project->project_name ?? 'Unknown Project' }} • 
                                        Reported {{ $issue->created_at->diffForHumans() }}
                                    </div>
                                    <div class="issue-excerpt">
                                        {{ Str::limit($issue->description ?? '', 150) }}
                                    </div>
                                    @if($issue->category)
                                        <span class="issue-category">
                                            {{ ucfirst($issue->category) }}
                                        </span>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-check-circle"></i>
                                    <h3>No Issues Reported</h3>
                                    <p>Great! No issues have been reported yet. Use the form to report any site concerns.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Priority selection
        document.querySelectorAll('.priority-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.priority-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // File upload feedback
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            const count = this.files.length;
            const label = this.closest('.file-upload').querySelector('p');
            if (count > 0) {
                label.textContent = count + ' file(s) selected';
            } else {
                label.textContent = 'Click to upload photos (max 5)';
            }
        });

        function filterIssues(status) {
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');
            // Filter implementation would go here
        }
    </script>
</body>
</html>
