<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log - AJJ CRISBER Engineering Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            transition: margin-left 0.3s ease;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease, transform 0.3s ease;
            margin-left: 0;
            transform: translateX(0);
        }

        .main-content.sidebar-closed {
            margin-left: 0;
            transform: translateX(0);
        }

        /* When sidebar is open, shift main content */
        .sidebar.open ~ .main-content {
            margin-left: 280px;
            transform: translateX(0);
        }

        @media (min-width: 769px) {
            .main-content {
                margin-left: 0;
                transform: translateX(0);
            }
            
            .sidebar.open ~ .main-content {
                margin-left: 280px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
                transform: translateX(0);
            }
            
            .sidebar.open ~ .main-content {
                margin-left: 0;
                transform: translateX(280px);
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

        /* Content Container */
        .content-container {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Page Title Section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--accent);
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--gray-500);
            margin-bottom: 25px;
        }

        /* Filter Card */
        .filters-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            padding: 20px;
            margin-bottom: 25px;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 13px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .filter-group input,
        .filter-group select {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-family: var(--text-md-normal-font-family);
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background-color: #15803d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(22, 163, 74, 0.2);
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
            transform: translateY(-2px);
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
        }

        th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--gray-600);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: var(--gray-700);
        }

        tbody tr {
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Action Badge */
        .action-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .action-create {
            background-color: #d1fae5;
            color: #065f46;
        }

        .action-update {
            background-color: #dbeafe;
            color: #0c4a6e;
        }

        .action-delete {
            background-color: #fee2e2;
            color: #7c2d12;
        }

        .action-archive {
            background-color: #fef3c7;
            color: #7c2d12;
        }

        .action-unarchive {
            background-color: #c7d2fe;
            color: #3730a3;
        }

        .action-login,
        .action-logout {
            background-color: #c7d2fe;
            color: #3730a3;
        }

        .user-name {
            font-weight: 600;
            color: var(--accent);
        }

        .user-email {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .timestamp {
            color: var(--gray-600);
            font-size: 13px;
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background-color: #e5e7eb;
            color: var(--gray-700);
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-detail:hover {
            background-color: var(--accent);
            color: white;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .pagination {
            display: flex;
            gap: 8px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            text-decoration: none;
            color: var(--accent);
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .pagination .active {
            background-color: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 15px 0;
            color: var(--gray-700);
        }

        .empty-state p {
            font-size: 14px;
            color: var(--gray-500);
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            transform: translateX(-5px);
            color: #15803d;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-container {
                padding: 15px;
            }

            .page-title {
                font-size: 20px;
            }

            .filter-row {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            th, td {
                padding: 12px 10px;
                font-size: 13px;
            }

            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <div class="main-content" id="mainContent">
            <!-- Header -->
            <div class="header">
                <button class="header-menu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-title">
                    <i class="fas fa-history"></i> Activity Log
                </div>
            </div>

            <!-- Main Content -->
            <div class="content-container">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-file-alt"></i> Activity Log
                        </h1>
                        <p class="page-subtitle">Track all user activities and system events</p>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filters-card">
                    <form method="GET" action="{{ route('activity-log.index') }}">
                        <div class="filter-row">
                            <div class="filter-group">
                                <label>Action Type</label>
                                <select name="action">
                                    <option value="">All Actions</option>
                                    @foreach($actions as $action)
                                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                            {{ str_replace('_', ' ', $action) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>From Date</label>
                                <input type="date" name="from_date" value="{{ request('from_date') }}">
                            </div>

                            <div class="filter-group">
                                <label>To Date</label>
                                <input type="date" name="to_date" value="{{ request('to_date') }}">
                            </div>
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Apply Filters
                            </button>
                            <a href="{{ route('activity-log.index') }}" class="btn btn-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Activity Logs Table -->
                <div class="table-container">
                    @if($logs->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>User</th>
                                    <th>Date & Time</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>
                                            <span class="action-badge action-{{ strtolower(str_replace('_', '-', $log->action)) }}">
                                                {{ str_replace('_', ' ', $log->action) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($log->user)
                                                <div class="user-name">{{ $log->user->name }}</div>
                                                <div class="user-email">{{ $log->user->email }}</div>
                                            @else
                                                <div class="user-name">System</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="timestamp">
                                                {{ $log->log_date->format('M d, Y') }}
                                            </div>
                                            <div class="timestamp">
                                                {{ $log->log_date->format('H:i:s') }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('activity-log.show', $log->id) }}" class="btn-detail">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>No Activity Logs Found</h3>
                            <p>There are no activity logs matching your criteria.</p>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($logs->count() > 0)
                    <div class="pagination-container">
                        {{ $logs->render() }}
                    </div>
                @endif

                <!-- Back Link -->
                <a href="{{ route('dashboard') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.getElementById('mainContent');
            
            if (sidebar) {
                sidebar.classList.toggle('open');
                mainContent.classList.toggle('sidebar-closed');
            }
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.querySelector('.sidebar');
            const toggle = document.querySelector('.header-menu');
            
            if (window.innerWidth <= 768) {
                if (sidebar && sidebar.classList.contains('open') && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    toggleSidebar();
                }
            }
        });
    </script>
</body>
</html>
