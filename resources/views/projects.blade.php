<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Projects</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #059669;

            --text-lg-medium-font-family: "Inter", sans-serif;
            --text-lg-medium-font-weight: 500;
            --text-lg-medium-font-size: 18px;
            --text-lg-medium-line-height: 28px;
            --text-md-normal-font-family: "Inter", sans-serif;
            --text-md-normal-font-weight: 400;
            --text-md-normal-font-size: 16px;
            --text-md-normal-line-height: 24px;
            --text-sm-medium-font-family: "Inter", sans-serif;
            --text-sm-medium-font-weight: 500;
            --text-sm-medium-font-size: 14px;
            --text-sm-medium-line-height: 20px;
            --text-headline-small-bold-font-family: "Inter", sans-serif;
            --text-headline-small-bold-font-weight: 700;
            --text-headline-small-bold-font-size: 18px;
            --text-headline-small-bold-line-height: 28px;

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
            font-family: var(--text-md-normal-font-family);
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
        .main-content.sidebar-closed {
            margin-left: 0;
        }
        @media (min-width: 769px) {
            .main-content {
                margin-left: 280px;
            }
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #16a34a);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
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

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
        }

        /* Projects Header */
        .projects-header {
            background: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            margin-bottom: 30px;
            padding: 20px;
        }

        .projects-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .projects-title {
            color: #101828;
            font-family: var(--text-lg-medium-font-family);
            font-size: var(--text-lg-medium-font-size);
            font-weight: var(--text-lg-medium-font-weight);
            line-height: var(--text-lg-medium-line-height);
        }

        .projects-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .projects-button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .projects-button-base {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 8px;
            background: #fff;
            box-shadow: var(--shadow-xs);
            border: 1px solid #e5e7eb;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .projects-button-base.primary {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .projects-button-base.primary:hover {
            background: #15803d;
        }

        /* Projects Table */
        .projects-table-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .projects-table {
            width: 100%;
            border-collapse: collapse;
        }

        .projects-table thead th {
            background: #f8fafc;
            color: #111827;
            font-weight: 600;
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .projects-table tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #111827;
        }

        .projects-table tbody tr:hover {
            background: #f9fafb;
        }

        .projects-table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-badge.success {
            background-color: transparent;
            color: #047857;
        }

        .status-badge.warning {
            background-color: transparent;
            color: #a16207;
        }

        .status-badge.info {
            background-color: transparent;
            color: #1d4ed8;
        }

        .status-badge.danger {
            background-color: transparent;
            color: #991b1b;
        }

        /* Modal Styles */
        .projects-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .projects-modal.active {
            display: flex;
            opacity: 1;
        }

        .projects-modal-content {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            padding: 24px;
            position: relative;
            box-shadow: var(--shadow-md);
        }

        .projects-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .projects-modal-title {
            font-weight: 700;
            font-size: 20px;
            color: #111827;
        }

        .projects-modal-close {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 6px;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .projects-modal-close:hover {
            background: #f3f4f6;
        }

        .projects-form-group {
            margin-bottom: 20px;
        }

        .projects-form-label {
            display: block;
            color: #374151;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .projects-form-input,
        .projects-form-select {
            width: 100%;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            color: #111827;
            transition: all 0.2s ease;
        }

        .projects-form-input:focus,
        .projects-form-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }

        .projects-form-error {
            color: #b91c1c;
            font-size: 12px;
            margin-top: 6px;
        }

        .projects-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
        }

        .projects-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .projects-btn-secondary {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .projects-btn-secondary:hover {
            background: #f9fafb;
        }

        .projects-btn-primary {
            background: var(--accent);
            color: #ffffff;
        }

        .projects-btn-primary:hover {
            background: #15803d;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Modern Pagination Styles */
        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 24px 0;
            user-select: none;
        }
        .pagination-info {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
        }
        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        .page-btn:hover:not(.disabled):not(.active):not(.ellipsis) {
            background: #f3f4f6;
            color: #111827;
        }
        .page-btn:active:not(.disabled):not(.ellipsis) {
            transform: scale(0.95);
        }
        .page-btn.active {
            background: var(--accent);
            color: #ffffff;
            font-weight: 600;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
        .page-btn.arrow {
            font-size: 20px;
            font-weight: 400;
        }
        .page-btn.ellipsis {
            cursor: default;
            pointer-events: none;
        }
        .page-btn.ellipsis:hover {
            background: transparent;
        }
        @media (max-width: 640px) {
            .page-btn {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }
            .page-btn.arrow {
                font-size: 18px;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .projects-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .projects-table {
                font-size: 12px;
            }

            .projects-table thead th,
            .projects-table tbody td {
                padding: 8px 6px;
            }
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
                <!-- Breadcrumb -->
                <nav style="margin-bottom: 20px; font-size: 14px; color: #6b7280;">
                    <a href="{{ route('dashboard') }}" style="color: var(--accent); text-decoration: none;">Dashboard</a>
                    <span style="margin: 0 8px;">></span>
                    <span style="color: #374151;">Projects</span>
                </nav>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-left: 16px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Projects Header -->
                <div class="projects-header">
                    <div class="projects-content">
                        <div class="projects-title">Projects</div>
                        <div class="projects-actions">
                            <button type="button" class="projects-button" aria-label="New Project" onclick="openProjectModal(true)">
                                <span class="projects-button-base primary">
                                    <i class="fas fa-plus"></i>
                                    <span>New</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Projects Table -->
                <div class="projects-table-card">
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Lead</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="projectsTableBody">
                            @forelse ($projects as $project)
                                @php
                                    $statusMap = [
                                        'On Track'   => ['class' => 'success', 'icon' => 'fas fa-check'],
                                        'In Review'  => ['class' => 'warning', 'icon' => 'fas fa-hourglass-half'],
                                        'Mobilizing' => ['class' => 'info', 'icon' => 'fas fa-bolt'],
                                        'On Hold'    => ['class' => 'danger', 'icon' => 'fas fa-pause'],
                                        'Completed'  => ['class' => 'success', 'icon' => 'fas fa-check-circle'],
                                    ];
                                    $badge = $statusMap[$project->status] ?? ['class' => 'info', 'icon' => 'fas fa-bolt'];
                                @endphp
                                <tr
                                    data-id="{{ $project->id }}"
                                    data-name="{{ $project->project_name }}"
                                    data-client="{{ $project->client_name }}"
                                    data-status="{{ $project->status }}"
                                    data-lead="{{ $project->lead }}"
                                >
                                    <td>{{ $project->project_name }}</td>
                                    <td>{{ $project->client_name }}</td>
                                    <td>
                                        <span class="status-badge {{ $badge['class'] }}">
                                            <i class="{{ $badge['icon'] }}"></i>
                                            {{ $project->status }}
                                        </span>
                                    </td>
                                    <td>{{ $project->lead }}</td>
                                    <td>{{ optional($project->created_at)->diffForHumans() ?? 'Just now' }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="projects-button"
                                            aria-label="Edit Project"
                                            onclick="openEditProjectModal(this)"
                                        >
                                            <span class="projects-button-base">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #6b7280; padding: 24px;">
                                        No projects found. Click the <strong>New</strong> button to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
                    @php
                        $currentPage = $projects->currentPage();
                        $lastPage = $projects->lastPage();
                        $pageNumbers = [];

                        if ($lastPage <= 7) {
                            for ($i = 1; $i <= $lastPage; $i++) {
                                $pageNumbers[] = $i;
                            }
                        } else {
                            $pageNumbers[] = 1;
                            if ($currentPage > 3) {
                                $pageNumbers[] = '...';
                            }
                            $start = max(2, $currentPage - 1);
                            $end = min($lastPage - 1, $currentPage + 1);
                            for ($i = $start; $i <= $end; $i++) {
                                $pageNumbers[] = $i;
                            }
                            if ($currentPage < $lastPage - 2) {
                                $pageNumbers[] = '...';
                            }
                            $pageNumbers[] = $lastPage;
                        }
                    @endphp
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }}
                            of {{ $projects->total() }} results
                        </div>
                        <div class="pagination-controls">
                            @if ($projects->onFirstPage())
                                <span class="page-btn arrow disabled">‹</span>
                            @else
                                <a class="page-btn arrow" href="{{ $projects->previousPageUrl() }}" rel="prev">‹</a>
                            @endif

                            <div class="pagination-nav">
                                @foreach ($pageNumbers as $page)
                                    @if ($page === '...')
                                        <span class="page-btn ellipsis">…</span>
                                    @elseif ($page == $currentPage)
                                        <span class="page-btn active">{{ $page }}</span>
                                    @else
                                        <a class="page-btn" href="{{ $projects->url($page) }}">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </div>

                            @if ($projects->hasMorePages())
                                <a class="page-btn arrow" href="{{ $projects->nextPageUrl() }}" rel="next">›</a>
                            @else
                                <span class="page-btn arrow disabled">›</span>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- New Project Modal -->
                <div class="projects-modal" id="projectModal" aria-hidden="true">
                    <div class="projects-modal-content" role="dialog" aria-modal="true">
                        <div class="projects-modal-header">
                            <div class="projects-modal-title">Add New Project</div>
                            <button class="projects-modal-close" onclick="closeProjectModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="projectForm" action="{{ route('projects.store') }}" method="POST">
                            @csrf
                            <div class="projects-form-group">
                                <label class="projects-form-label">Project Name</label>
                                <input
                                    type="text"
                                    class="projects-form-input"
                                    id="projectName"
                                    name="project_name"
                                    placeholder="Enter project name"
                                    value="{{ old('project_name') }}"
                                    required
                                />
                                @error('project_name')
                                    <p class="projects-form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Client Name</label>
                                <input
                                    type="text"
                                    class="projects-form-input"
                                    id="clientName"
                                    name="client_name"
                                    placeholder="Enter client name"
                                    value="{{ old('client_name') }}"
                                    required
                                />
                                @error('client_name')
                                    <p class="projects-form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Status</label>
                                <input
                                    type="text"
                                    class="projects-form-input"
                                    value="On Track"
                                    readonly
                                />
                                <input type="hidden" name="status" value="On Track" />
                            </div>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Lead</label>
                                <input
                                    type="text"
                                    class="projects-form-input"
                                    id="projectLead"
                                    name="lead"
                                    placeholder="Enter project lead"
                                    value="{{ old('lead') }}"
                                    required
                                />
                                @error('lead')
                                    <p class="projects-form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="projects-modal-footer">
                                <button type="button" class="projects-btn projects-btn-secondary" onclick="closeProjectModal()">Cancel</button>
                                <button type="submit" class="projects-btn projects-btn-primary">
                                    <i class="fas fa-save"></i>
                                    <span>Save Project</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Project Modal -->
                <div class="projects-modal" id="editProjectModal" aria-hidden="true">
                    <div class="projects-modal-content" role="dialog" aria-modal="true">
                        <div class="projects-modal-header">
                            <div class="projects-modal-title">Edit Project Status</div>
                            <button class="projects-modal-close" onclick="closeEditProjectModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="editProjectForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="projects-form-group">
                                <label class="projects-form-label">Project Name</label>
                                <input type="text" class="projects-form-input" id="editProjectName" readonly />
                            </div>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Client Name</label>
                                <input type="text" class="projects-form-input" id="editClientName" readonly />
                            </div>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Lead</label>
                                <input type="text" class="projects-form-input" id="editProjectLead" readonly />
                            </div>

                            <div class="projects-form-group">
                                <label class="projects-form-label">Status</label>
                                <select class="projects-form-select" id="editProjectStatus" name="status" required>
                                    <option value="On Track">On Track</option>
                                    <option value="In Review">In Review</option>
                                    <option value="Mobilizing">Mobilizing</option>
                                    <option value="On Hold">On Hold</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>

                            <div class="projects-modal-footer">
                                <button type="button" class="projects-btn projects-btn-secondary" onclick="closeEditProjectModal()">Cancel</button>
                                <button type="submit" class="projects-btn projects-btn-primary">
                                    <i class="fas fa-save"></i>
                                    <span>Save</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
    <script>
        const projectModal = document.getElementById('projectModal');
        const projectForm = document.getElementById('projectForm');
        const editProjectModal = document.getElementById('editProjectModal');
        const editProjectForm = document.getElementById('editProjectForm');
        const editProjectName = document.getElementById('editProjectName');
        const editClientName = document.getElementById('editClientName');
        const editProjectLead = document.getElementById('editProjectLead');
        const editProjectStatus = document.getElementById('editProjectStatus');

        function openProjectModal(shouldReset = false) {
            if (!projectModal) return;
            if (shouldReset && projectForm) {
                projectForm.reset();
            }
            projectModal.classList.add('active');
            projectModal.setAttribute('aria-hidden', 'false');
        }

        function closeProjectModal() {
            if (!projectModal) return;
            projectModal.classList.remove('active');
            projectModal.setAttribute('aria-hidden', 'true');
            if (projectForm) {
                projectForm.reset();
            }
        }

        function openEditProjectModal(buttonEl) {
            const row = buttonEl.closest('tr');
            if (!row) return;
            const projectId = row.getAttribute('data-id');
            const name = row.getAttribute('data-name') || '';
            const client = row.getAttribute('data-client') || '';
            const status = row.getAttribute('data-status') || '';
            const lead = row.getAttribute('data-lead') || '';

            if (editProjectForm) {
                editProjectForm.action = '{{ route('projects.update', ':id') }}'.replace(':id', projectId);
            }
            if (editProjectName) editProjectName.value = name;
            if (editClientName) editClientName.value = client;
            if (editProjectLead) editProjectLead.value = lead;
            if (editProjectStatus) editProjectStatus.value = status;

            if (editProjectModal) {
                editProjectModal.classList.add('active');
                editProjectModal.setAttribute('aria-hidden', 'false');
            }
        }

        function closeEditProjectModal() {
            if (!editProjectModal) return;
            editProjectModal.classList.remove('active');
            editProjectModal.setAttribute('aria-hidden', 'true');
            if (editProjectForm) editProjectForm.reset();
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (projectModal) {
                projectModal.addEventListener('click', function (event) {
                    if (event.target === projectModal) {
                        closeProjectModal();
                    }
                });
            }
            if (editProjectModal) {
                editProjectModal.addEventListener('click', function (event) {
                    if (event.target === editProjectModal) {
                        closeEditProjectModal();
                    }
                });
            }

            const shouldShowModal = {{ $errors->any() ? 'true' : 'false' }};
            if (shouldShowModal) {
                openProjectModal(false);
            }
        });
    </script>
</body>

</html>

