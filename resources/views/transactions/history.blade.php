<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Purchase History</title>
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

        .back-btn {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--accent);
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
        }

        .history-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .data-table thead {
            background: #f9fafb;
        }

        .data-table thead th {
            padding: 14px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }

        .data-table tbody td {
            padding: 14px 12px;
            font-size: 14px;
            color: var(--black-1);
            border-bottom: 1px solid #f3f4f6;
        }

        .data-table tbody tr:hover {
            background: #f9fafb;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.fail {
            background: #fee2e2;
            color: #991b1b;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a,
        .pagination span {
            display: block;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            color: var(--gray-700);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .pagination .active span {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }

        .pagination .disabled span {
            color: var(--gray-400);
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-500);
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

            .data-table {
                font-size: 12px;
            }

            .data-table thead th,
            .data-table tbody td {
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
                <a href="{{ route('transactions.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Transactions
                </a>
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">
                            <i class="fas fa-history"></i>
                            Purchase History
                        </h1>
                        <p class="page-subtitle">Complete log of all material purchases and transactions</p>
                    </div>
                </div>

                <div class="history-card">
                    @if($history->count() > 0)
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project</th>
                                    <th>Material Name</th>
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Cost</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $item)
                                    <tr>
                                        <td><strong>#{{ $item->id }}</strong></td>
                                        <td>{{ $item->projectRecord->title ?? 'N/A' }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->supplier ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity }} {{ $item->unit }}</td>
                                        <td>₱{{ number_format($item->price, 2) }}</td>
                                        <td><strong>₱{{ number_format($item->total, 2) }}</strong></td>
                                        <td>
                                            <span class="status-badge {{ strtolower($item->status) }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td>{{ $item->date_received ? date('M d, Y', strtotime($item->date_received)) : date('M d, Y', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="pagination-wrapper">
                            @include('custom.pagination', ['paginator' => $history])
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-history"></i>
                            <h3>No Purchase History</h3>
                            <p>There are no recorded purchases yet.</p>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>
</html>
