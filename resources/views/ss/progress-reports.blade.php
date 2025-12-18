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
            color: var(--accent);
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
            border-color: var(--accent);
            background: #f0fdfa;
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

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-primary:disabled {
            background: var(--gray-400);
            cursor: not-allowed;
        }

        /* Reports List */
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
            color: var(--accent);
        }

        .filter-row {
            display: flex;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 13px;
            background: white;
        }

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
        }

        .badge-progress { background: #dbeafe; color: #1e40af; }

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
                    <p>Submit and track daily site progress for your assigned projects</p>
                </div>

                <div class="main-grid">
                    <!-- Submit Form -->
                    <div class="form-card">
                        <div class="form-header">
                            <h3 class="form-title">
                                <i class="fas fa-plus-circle"></i> Submit Progress Report
                            </h3>
                        </div>
                        <div class="form-body">
                            <form action="{{ route('ss.progress-reports.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label>Report Date <span class="required">*</span></label>
                                    <input type="date" name="report_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Title / Summary <span class="required">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="e.g., Foundation work completed" required>
                                </div>

                                <div class="form-group">
                                    <label>Work Accomplished <span class="required">*</span></label>
                                    <textarea name="description" class="form-control" placeholder="Describe what work was completed today..." required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Completion Percentage</label>
                                    <div class="completion-slider">
                                        <input type="range" name="completion_percentage" id="completionRange" min="0" max="100" value="0">
                                        <span class="completion-value" id="completionValue">0%</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Workers On-Site Today</label>
                                    <input type="number" name="workers_present" class="form-control" placeholder="Number of workers" min="0">
                                </div>

                                <div class="form-group">
                                    <label>Weather Conditions</label>
                                    <select name="weather" class="form-control">
                                        <option value="">Select weather</option>
                                        <option value="sunny">☀️ Sunny</option>
                                        <option value="cloudy">⛅ Cloudy</option>
                                        <option value="rainy">🌧️ Rainy</option>
                                        <option value="stormy">⛈️ Stormy</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Site Photos</label>
                                    <label class="file-upload">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <p>Click to upload photos (max 5)</p>
                                        <input type="file" name="photos[]" accept="image/*" multiple>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Additional Notes</label>
                                    <textarea name="notes" class="form-control" placeholder="Any additional observations or concerns..." rows="3"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Submit Report
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Reports List -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">
                                <i class="fas fa-history"></i> Previous Reports
                            </span>
                        </div>
                        <div class="filter-row">
                            <select class="filter-select" onchange="filterByProject(this.value)">
                                <option value="">All Projects</option>
                                @foreach($projects ?? [] as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name ?? $project->project_code }}</option>
                                @endforeach
                            </select>
                            <select class="filter-select">
                                <option value="">All Dates</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                        <div class="report-list">
                            @forelse($progressReports ?? [] as $report)
                                <div class="report-item">
                                    <div class="report-header">
                                        <div class="report-title">{{ $report->title ?? 'Progress Report' }}</div>
                                        <span class="report-badge badge-progress">
                                            {{ $report->completion_percentage ?? 0 }}%
                                        </span>
                                    </div>
                                    <div class="report-meta">
                                        {{ $report->project->project_name ?? 'Unknown Project' }} • 
                                        {{ $report->created_at->format('M d, Y - g:i A') }}
                                    </div>
                                    <div class="report-excerpt">
                                        {{ Str::limit($report->description ?? '', 150) }}
                                    </div>
                                    @if($report->photos && count(json_decode($report->photos, true) ?? []) > 0)
                                        <div class="report-photos">
                                            @foreach(array_slice(json_decode($report->photos, true), 0, 4) as $photo)
                                                <img src="{{ asset('storage/' . $photo) }}" alt="Progress photo" class="report-photo">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <h3>No Reports Yet</h3>
                                    <p>Submit your first daily progress report using the form on the left.</p>
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
        // Completion slider
        const completionRange = document.getElementById('completionRange');
        const completionValue = document.getElementById('completionValue');

        completionRange.addEventListener('input', function() {
            completionValue.textContent = this.value + '%';
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

        function filterByProject(projectId) {
            const url = new URL(window.location);
            if (projectId) {
                url.searchParams.set('project', projectId);
            } else {
                url.searchParams.delete('project');
            }
            window.location = url;
        }
    </script>
</body>
</html>
