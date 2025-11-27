<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Finance Dashboard - AJJ CRISBER Engineering Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: #f7fafc;
            color: var(--gray-700);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open {
            margin-left: 0;
        }

        .main-wrapper {
            display: flex;
            flex: 1;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open .main-wrapper {
            margin-left: 250px;
        }

        .header {
            background: linear-gradient(135deg, var(--header-bg), #15803d);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: white;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        body.sidebar-open .header {
            margin-left: 250px;
        }

        .header-title {
            color: white;
            font-size: 24px;
            font-weight: 700;
            flex: 1;
        }

        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px 12px;
            margin-right: 15px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }

        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--gray-300);
            padding: 0;
            overflow-y: auto;
            position: fixed;
            left: 0;
            top: 80px;
            bottom: 0;
            height: auto;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 999;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-section {
            margin-bottom: 0;
            padding: 20px 0;
        }

        .sidebar-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            padding: 0 20px;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            font-size: 13px;
            font-weight: 500;
        }

        .sidebar-link:hover {
            background: rgba(22, 163, 74, 0.1);
            color: var(--accent);
        }

        .sidebar-link.active {
            background: rgba(22, 163, 74, 0.15);
            color: var(--accent);
            border-left-color: var(--accent);
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--black-1);
            margin-top: 30px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--accent);
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 4px;
        }

        .stat-subtext {
            font-size: 13px;
            color: var(--gray-500);
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--sidebar-bg);
            border-bottom: 2px solid var(--accent);
        }

        th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--gray-700);
        }

        td {
            padding: 12px;
            border-bottom: 1px solid var(--gray-300);
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-approved {
            background: #dcfce7;
            color: #166534;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-failed {
            background: #fee2e2;
            color: #991b1b;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-500);
        }

        .quick-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn:hover {
            background: #15803d;
        }

        .btn-secondary {
            background: var(--gray-300);
            color: var(--black-1);
        }

        .btn-secondary:hover {
            background: var(--gray-400);
        }

        .filters {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .filter-group label {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 13px;
        }

        .filter-group input,
        .filter-group select {
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 13px;
            background: white;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 18px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }

    </style>
</head>
<body>
    @include('partials.sidebar')

    <header class="header">
        <button id="sidebar-toggle" class="sidebar-toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
    </header>

    <div class="main-wrapper">
        <main class="content-area">
            <div class="page-title">
                <i class="fas fa-chart-pie"></i> Finance Dashboard
            </div>

            <!-- Key Financial Metrics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Expenses</div>
                    <div class="stat-value">₱{{ number_format($totalExpenses, 2) }}</div>
                    <div class="stat-subtext">All materials and transactions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Approved Expenses</div>
                    <div class="stat-value">₱{{ number_format($approvedExpenses, 2) }}</div>
                    <div class="stat-subtext">Ready for payment</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Pending Approval</div>
                <div class="stat-value">₱{{ number_format($pendingExpenses, 2) }}</div>
                <div class="stat-subtext">Under review</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Failed/Returns</div>
                <div class="stat-value">₱{{ number_format($failedExpenses, 2) }}</div>
                <div class="stat-subtext">For refund/return</div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <!-- Expense Status Breakdown Chart -->
            <div class="chart-card">
                <div class="chart-title">
                    <i class="fas fa-pie-chart"></i> Expense Status Breakdown
                </div>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Top Projects by Cost Chart -->
            <div class="chart-card">
                <div class="chart-title">
                    <i class="fas fa-bar-chart"></i> Top Projects by Cost
                </div>
                <div class="chart-container">
                    <canvas id="projectsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Project Cost Breakdown -->
        <div class="card">
            <div class="card-title">
                <span><i class="fas fa-project-diagram"></i> Cost per Project</span>
                <div class="quick-actions">
                    <a href="{{ route('finance.supplier-invoices') }}" class="btn btn-secondary">
                        <i class="fas fa-file-invoice"></i> Supplier Invoices
                    </a>
                    <a href="{{ route('finance.payment-summary') }}" class="btn btn-secondary">
                        <i class="fas fa-receipt"></i> Payment Summary
                    </a>
                </div>
            </div>

            @if($projectCosts->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Materials Count</th>
                            <th>Total Cost</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projectCosts as $cost)
                            <tr>
                                <td><strong>{{ $cost->project?->project_name ?? 'Unknown' }}</strong></td>
                                <td>{{ $cost->material_count }} items</td>
                                <td>₱{{ number_format($cost->total_cost, 2) }}</td>
                                <td>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ min(($cost->total_cost / $totalExpenses * 100), 100) }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>No project cost data available</p>
                </div>
            @endif
        </div>

        <!-- Recent Materials -->
        <div class="card">
            <div class="card-title">
                <i class="fas fa-history"></i> Recent Materials & Expenses
            </div>

            @if($materials->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Total Cost</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Project</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials->take(10) as $material)
                            <tr>
                                <td><strong>{{ $material->material_name ?? 'N/A' }}</strong></td>
                                <td>{{ $material->supplier ?? 'N/A' }}</td>
                                <td>{{ $material->quantity_received ?? 0 }} {{ $material->unit_of_measure ?? '' }}</td>
                                <td><strong>₱{{ number_format($material->total_cost ?? 0, 2) }}</strong></td>
                                <td>
                                    <span class="badge badge-{{ strtolower($material->status) }}">
                                        {{ $material->status ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>{{ $material->date_received?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>{{ $material->project?->project_name ?? $material->projectRecord?->project?->project_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>No materials found</p>
                </div>
            @endif
        </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const body = document.body;
            sidebar.classList.toggle('open');
            body.classList.toggle('sidebar-open');
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('open');
                document.body.classList.remove('sidebar-open');
            }
        });

        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            // Expense Status Breakdown Chart
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                const approvedExpenses = {{ $approvedExpenses ?? 0 }};
                const pendingExpenses = {{ $pendingExpenses ?? 0 }};
                const failedExpenses = {{ $failedExpenses ?? 0 }};
                const totalExpenses = approvedExpenses + pendingExpenses + failedExpenses;
                
                // Only show chart if there's data
                if (totalExpenses > 0) {
                    new Chart(statusCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Approved', 'Pending', 'Failed'],
                            datasets: [{
                                data: [approvedExpenses, pendingExpenses, failedExpenses],
                                backgroundColor: [
                                    '#16a34a',
                                    '#f59e0b',
                                    '#ef4444'
                                ],
                                borderColor: [
                                    '#15803d',
                                    '#d97706',
                                    '#dc2626'
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 12,
                                            weight: '600'
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const value = context.parsed || 0;
                                            const percentage = ((value / totalExpenses) * 100).toFixed(1);
                                            return `₱${value.toLocaleString('en-PH', {minimumFractionDigits: 2})} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    statusCtx.parentElement.innerHTML = '<p style="text-align: center; color: #999; padding: 40px;">No expense data available</p>';
                }
            }

            // Top Projects by Cost Chart
            const projectsCtx = document.getElementById('projectsChart');
            if (projectsCtx) {
                const projectData = [
                    @foreach($projectCosts->take(5) as $cost)
                        {
                            name: '{{ $cost->project?->project_name ?? 'Unknown' }}',
                            cost: {{ $cost->total_cost ?? 0 }}
                        },
                    @endforeach
                ];
                
                // Only show chart if there's data
                if (projectData.length > 0 && projectData[0].cost > 0) {
                    new Chart(projectsCtx, {
                        type: 'bar',
                        data: {
                            labels: projectData.map(p => p.name),
                            datasets: [{
                                label: 'Total Cost',
                                data: projectData.map(p => p.cost),
                                backgroundColor: '#16a34a',
                                borderColor: '#15803d',
                                borderWidth: 2,
                                borderRadius: 4
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return '₱' + context.parsed.x.toLocaleString('en-PH', {minimumFractionDigits: 2});
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '₱' + value.toLocaleString('en-PH');
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    projectsCtx.parentElement.innerHTML = '<p style="text-align: center; color: #999; padding: 40px;">No project data available</p>';
                }
            }
        });
    </script>
</body>
</html>
