<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log - AJJ CRISBER Engineering Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .header {
            background: linear-gradient(135deg, #16a34a, #15803d);
            padding: 20px 30px;
            color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: white;
            color: #16a34a;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin: 20px 30px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            background-color: #f0f0f0;
            transform: translateX(-5px);
        }

        .content {
            padding: 30px;
        }

        .filters {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 13px;
            color: #666;
        }

        .filter-group input,
        .filter-group select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #16a34a;
            color: white;
        }

        .btn-primary:hover {
            background-color: #15803d;
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        .logs-table {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            overflow: hidden;
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
            color: #374151;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 12px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        .action-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
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

        .action-login,
        .action-logout {
            background-color: #c7d2fe;
            color: #3730a3;
        }

        .user-name {
            font-weight: 500;
            color: #16a34a;
        }

        .timestamp {
            color: #666;
            font-size: 13px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            padding: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #16a34a;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: #16a34a;
            color: white;
        }

        .pagination .active {
            background-color: #16a34a;
            color: white;
            border-color: #16a34a;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .no-logs {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .no-logs i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Activity Log</h1>
        <p>Track all user activities across the system</p>
    </div>

    <a href="{{ route('dashboard') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

    <div class="content">
        <div class="filters">
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

        @if($logs->count() > 0)
            <div class="logs-table">
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
                                        <span class="user-name">{{ $log->user->name }}</span>
                                        <br>
                                        <span class="timestamp">{{ $log->user->email }}</span>
                                    @else
                                        <span class="timestamp">System</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="timestamp">
                                        {{ $log->log_date->format('M d, Y') }}<br>
                                        {{ $log->log_date->format('H:i:s') }}
                                    </span>
                                </td>
                                <td>
                                    <button onclick="showDetails('{{ $log->id }}')" class="btn btn-secondary" style="font-size: 12px; padding: 4px 8px;">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $logs->render('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="no-logs">
                <i class="fas fa-inbox"></i>
                <h3>No Activity Logs Found</h3>
                <p>There are no activity logs matching your criteria.</p>
            </div>
        @endif
    </div>

    <script>
        function showDetails(logId) {
            // You can implement a modal or redirect to detail page
            window.location.href = `/activity-log/${logId}`;
        }
    </script>
</body>
</html>
