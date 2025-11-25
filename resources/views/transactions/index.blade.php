<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Transactions</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;
            --gray-500: #667085;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: #dc2626;
            --green-600: #059669;
            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;
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
            font-family: "Inter", sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
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
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }

        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0 !important; 
            }
        }

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

        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .page-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-title {
            color: var(--black-1);
            font-size: 24px;
            font-weight: 700;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
        }

        .action-btn {
            padding: 10px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s ease;
            text-decoration: none;
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        .action-btn.primary {
            background: var(--blue-600);
            color: white;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        .projects-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .projects-table thead {
            background: #f9fafb;
        }

        .projects-table thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }

        .projects-table tbody td {
            padding: 16px;
            font-size: 14px;
            color: var(--black-1);
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .projects-table tbody tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .projects-table tbody tr:hover {
            background: #f9fafb;
        }

        .projects-table tbody tr:last-child td {
            border-bottom: none;
        }

        .project-color-badge {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .project-name {
            display: flex;
            align-items: center;
            font-weight: 600;
        }

        .project-client-text {
            color: var(--gray-600);
            font-size: 12px;
            margin-top: 4px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge.danger {
            background: transparent;
            color: #991b1b;
            border: none;
            padding: 0;
            border-radius: 0;
        }

        .badge.success {
            background: transparent;
            color: #065f46;
            border: none;
            padding: 0;
            border-radius: 0;
        }

        .badge.info {
            background: transparent;
            color: #1e40af;
            border: none;
            padding: 0;
            border-radius: 0;
        }

        .empty-state {
            background: white;
            border-radius: 12px;
            padding: 60px 20px;
            text-align: center;
            box-shadow: var(--shadow-md);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-300);
            margin-bottom: 16px;
        }

        .empty-state h3 {
            color: var(--gray-700);
            font-size: 18px;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .table-card {
                padding: 16px;
                overflow-x: auto;
            }

            .projects-table {
                font-size: 12px;
            }

            .projects-table thead th,
            .projects-table tbody td {
                padding: 10px 8px;
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
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Transactions</h1>
                        <p class="page-subtitle">Select a project to view materials and invoices</p>
                    </div>
                    <a href="{{ route('transactions.history') }}" class="action-btn primary">
                        <i class="fas fa-history"></i>
                        Purchase History
                    </a>
                </div>

                @if($projects->count() > 0)
                    <div class="table-card">
                        <table class="projects-table">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Client</th>
                                    <th>Inspector</th>
                                    <th>Time</th>
                                    <th>Failed Materials</th>
                                    <th>Suppliers</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $project)
                                    <tr onclick="window.location.href='{{ route('transactions.show', $project->id) }}'" style="cursor: pointer;">
                                        <td>
                                            <div class="project-name">
                                                <span class="project-color-badge" style="background-color: {{ $project->color ?? '#16a34a' }};"></span>
                                                <span title="{{ $project->title ?? 'No Title' }}">{{ $project->title ?? 'Untitled Project' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span title="{{ $project->client ?? 'No Client' }}">{{ $project->client ?? '—' }}</span>
                                        </td>
                                        <td>
                                            <i class="fas fa-user" style="color: var(--accent); margin-right: 6px;"></i>
                                            <span title="{{ $project->inspector ?? 'No Inspector' }}">{{ $project->inspector ?? '—' }}</span>
                                        </td>
                                        <td>
                                            <span title="{{ $project->time ?? 'No Time' }}">{{ $project->time ?? '—' }}</span>
                                        </td>
                                        <td>
                                            @if($project->failed_count > 0)
                                                <span class="badge danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $project->failed_count }}
                                                </span>
                                            @else
                                                <span class="badge success">
                                                    <i class="fas fa-check-circle"></i>
                                                    0
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($project->suppliers && $project->suppliers->count() > 0)
                                                <span class="badge info" title="{{ $project->suppliers->implode(', ') }}">
                                                    <i class="fas fa-truck"></i>
                                                    {{ implode(', ', $project->suppliers->slice(0, 2)->toArray()) }}{{ $project->suppliers->count() > 2 ? '...' : '' }}
                                                </span>
                                            @else
                                                <span style="color: var(--gray-500); font-size: 12px;">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('transactions.show', $project->id) }}" class="action-btn primary" style="padding: 6px 12px; font-size: 12px;" onclick="event.stopPropagation();">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; padding: 40px; color: #6b7280;">
                                            <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                                            No project records found. Create a project with materials to see transactions here.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h3>No Projects Found</h3>
                        <p>There are no projects available for transactions yet.</p>
                    </div>
                @endif
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
