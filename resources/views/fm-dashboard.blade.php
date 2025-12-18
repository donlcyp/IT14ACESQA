<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Finance Manager Dashboard - AJJ CRISBER Engineering Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --accent: #1e40af;
            --accent-light: #3b82f6;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d0d5dd;
            --gray-400: #9ca3af;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--gray-700);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            flex: 1;
        }

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
            background: #1e40af;
            padding: 16px 20px;
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

        @media (max-width: 768px) {
            .header-title {
                font-size: 18px;
            }
        }

        .content-area {
            padding: 20px;
            flex: 1;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: #059669;
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--gray-500);
            margin-top: 4px;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border: none;
        }

        .action-btn.primary {
            background: #059669;
            color: white;
        }
        .action-btn.primary:hover {
            filter: brightness(0.9);
        }

        .action-btn.secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }
        .action-btn.secondary:hover {
            filter: brightness(0.95);
        }

        .action-btn.danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .action-btn.danger:hover {
            filter: brightness(0.95);
        }

        /* KPI Cards */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .kpi-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .kpi-card.budget::before { background: linear-gradient(90deg, #059669, #10b981); }
        .kpi-card.spent::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .kpi-card.remaining::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .kpi-card.projects::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .kpi-card.replacement::before { background: linear-gradient(90deg, #ef4444, #f87171); }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .kpi-card.budget .kpi-icon { background: #dcfce7; color: #059669; }
        .kpi-card.spent .kpi-icon { background: #dbeafe; color: #3b82f6; }
        .kpi-card.remaining .kpi-icon { background: #fef3c7; color: #f59e0b; }
        .kpi-card.projects .kpi-icon { background: #ede9fe; color: #8b5cf6; }
        .kpi-card.replacement .kpi-icon { background: #fee2e2; color: #ef4444; }

        .kpi-label {
            font-size: 13px;
            color: var(--gray-500);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .kpi-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        .kpi-change {
            font-size: 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .kpi-change.positive { color: #059669; }
        .kpi-change.negative { color: #ef4444; }

        /* Notification Badge */
        .notification-badge {
            background: #ef4444;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
        }

        .chart-container {
            position: relative;
            height: 280px;
        }

        /* Projects Table */
        .projects-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--black-1);
        }

        .projects-table {
            width: 100%;
            border-collapse: collapse;
        }

        .projects-table th {
            background: var(--gray-100);
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .projects-table td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--gray-200);
            vertical-align: middle;
        }

        .projects-table tr:hover {
            background: #fafafa;
        }

        .project-name {
            font-weight: 600;
            color: var(--black-1);
        }

        .project-code {
            font-size: 12px;
            color: var(--gray-500);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.ongoing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-badge.completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.delayed {
            background: #fee2e2;
            color: #991b1b;
        }

        .budget-bar {
            width: 100%;
            height: 8px;
            background: var(--gray-200);
            border-radius: 4px;
            overflow: hidden;
        }

        .budget-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .budget-bar-fill.good { background: #10b981; }
        .budget-bar-fill.warning { background: #f59e0b; }
        .budget-bar-fill.danger { background: #ef4444; }

        .view-btn {
            padding: 6px 12px;
            background: #e0e7ff;
            color: var(--accent);
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .view-btn:hover {
            filter: brightness(0.95);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-400);
            margin-bottom: 16px;
        }

        /* Alert Box */
        .alert-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .alert-box.warning {
            background: #fffbeb;
            border-color: #fde68a;
        }

        .alert-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #ef4444;
            flex-shrink: 0;
        }

        .alert-box.warning .alert-icon {
            background: #fef3c7;
            color: #f59e0b;
        }

        .alert-content {
            flex: 1;
        }

        .alert-title {
            font-weight: 600;
            color: #991b1b;
            margin-bottom: 4px;
        }

        .alert-box.warning .alert-title {
            color: #92400e;
        }

        .alert-text {
            font-size: 14px;
            color: #b91c1c;
        }

        .alert-box.warning .alert-text {
            color: #b45309;
        }

        .alert-action {
            flex-shrink: 0;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content sidebar-closed" id="mainContent">
            <header class="header">
                <button class="header-menu" id="headerMenu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="page-title">
                            <i class="fas fa-chart-line"></i>
                            Finance Manager Dashboard
                        </h2>
                        <p class="page-subtitle">Financial overview and project budget monitoring</p>
                    </div>
                    <div class="quick-actions">
                        <a href="{{ route('fm.replacement-approvals') }}" class="action-btn {{ $pendingReplacements > 0 ? 'danger' : 'secondary' }}">
                            <i class="fas fa-exchange-alt"></i>
                            Replacement Approvals
                            @if($pendingReplacements > 0)
                                <span class="notification-badge">{{ $pendingReplacements }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Replacement Alert -->
                @if($pendingReplacements > 0)
                <div class="alert-box">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Pending Replacement Approvals</div>
                        <div class="alert-text">
                            You have {{ $pendingReplacements }} material replacement request(s) awaiting your approval. 
                            These requests are from Quality Assurance and require financial review.
                        </div>
                    </div>
                    <div class="alert-action">
                        <a href="{{ route('fm.replacement-approvals') }}" class="action-btn primary">
                            <i class="fas fa-arrow-right"></i> Review Now
                        </a>
                    </div>
                </div>
                @endif

                <!-- KPI Cards -->
                <div class="kpi-grid">
                    <div class="kpi-card budget">
                        <div class="kpi-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="kpi-label">Total Budget</div>
                        <div class="kpi-value">₱{{ number_format($summary['total_budget'], 2) }}</div>
                        <div class="kpi-change positive">
                            <i class="fas fa-chart-pie"></i>
                            {{ $summary['total_projects'] }} Active Projects
                        </div>
                    </div>

                    <div class="kpi-card spent">
                        <div class="kpi-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="kpi-label">Total Spent</div>
                        <div class="kpi-value">₱{{ number_format($summary['total_spent'], 2) }}</div>
                        <div class="kpi-change {{ $summary['budget_utilization'] > 80 ? 'negative' : 'positive' }}">
                            <i class="fas fa-percentage"></i>
                            {{ $summary['budget_utilization'] }}% of budget utilized
                        </div>
                    </div>

                    <div class="kpi-card remaining">
                        <div class="kpi-icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="kpi-label">Budget Remaining</div>
                        <div class="kpi-value">₱{{ number_format($summary['budget_remaining'], 2) }}</div>
                        <div class="kpi-change {{ $summary['budget_remaining'] < 0 ? 'negative' : 'positive' }}">
                            <i class="fas fa-{{ $summary['budget_remaining'] < 0 ? 'exclamation-triangle' : 'check-circle' }}"></i>
                            {{ $summary['budget_remaining'] < 0 ? 'Over budget!' : 'Within budget' }}
                        </div>
                    </div>

                    <div class="kpi-card projects">
                        <div class="kpi-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <div class="kpi-label">Ongoing Projects</div>
                        <div class="kpi-value">{{ $summary['ongoing_projects'] }}</div>
                        <div class="kpi-change positive">
                            <i class="fas fa-check-circle"></i>
                            {{ $summary['completed_projects'] }} Completed
                        </div>
                    </div>

                    <div class="kpi-card replacement">
                        <div class="kpi-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="kpi-label">Pending Replacements</div>
                        <div class="kpi-value">{{ $summary['pending_replacements'] }}</div>
                        <div class="kpi-change {{ $summary['pending_replacements'] > 0 ? 'negative' : 'positive' }}">
                            <i class="fas fa-{{ $summary['pending_replacements'] > 0 ? 'clock' : 'check-circle' }}"></i>
                            {{ $summary['pending_replacements'] > 0 ? 'Needs attention' : 'All processed' }}
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="charts-grid">
                    <!-- Budget vs Spending by Project -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title"><i class="fas fa-chart-bar" style="color: #3b82f6; margin-right: 8px;"></i>Budget vs Spending by Project</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="budgetChart"></canvas>
                        </div>
                    </div>

                    <!-- Monthly Spending Trend -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title"><i class="fas fa-chart-line" style="color: #10b981; margin-right: 8px;"></i>Monthly Spending Trend</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>

                    <!-- Cost Distribution -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title"><i class="fas fa-chart-pie" style="color: #8b5cf6; margin-right: 8px;"></i>Cost Distribution</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="costDistributionChart"></canvas>
                        </div>
                    </div>

                    <!-- Material Cost by Category -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title"><i class="fas fa-layer-group" style="color: #f59e0b; margin-right: 8px;"></i>Cost by Material Category</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Projects Overview Table -->
                <div class="projects-section">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-list" style="color: #059669; margin-right: 8px;"></i>Projects Financial Overview</h3>
                    </div>
                    
                    @if($budgetByProject->count() > 0)
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Budget</th>
                                <th>Spent</th>
                                <th>Remaining</th>
                                <th>Utilization</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgetByProject as $project)
                            @php
                                $utilization = $project['budget'] > 0 ? round(($project['spent'] / $project['budget']) * 100, 1) : 0;
                                $barClass = $utilization > 90 ? 'danger' : ($utilization > 70 ? 'warning' : 'good');
                            @endphp
                            <tr>
                                <td>
                                    <div class="project-name">{{ $project['name'] }}</div>
                                </td>
                                <td>
                                    <span class="status-badge {{ strtolower($project['status'] ?? 'ongoing') }}">
                                        {{ $project['status'] ?? 'Ongoing' }}
                                    </span>
                                </td>
                                <td>₱{{ number_format($project['budget'], 2) }}</td>
                                <td>₱{{ number_format($project['spent'], 2) }}</td>
                                <td style="color: {{ $project['remaining'] < 0 ? '#ef4444' : '#059669' }}; font-weight: 600;">
                                    ₱{{ number_format($project['remaining'], 2) }}
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div class="budget-bar" style="width: 80px;">
                                            <div class="budget-bar-fill {{ $barClass }}" style="width: {{ min($utilization, 100) }}%;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 600;">{{ $utilization }}%</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('fm.project.view', $project['id']) }}" class="view-btn">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h3>No Projects Found</h3>
                        <p>There are no active projects to display.</p>
                    </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <script>
        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar) {
                sidebar.classList.toggle('open');
                mainContent?.classList.toggle('sidebar-closed');
            }
        }

        // Chart Data
        const budgetData = @json($budgetByProject);
        const monthlyData = @json($monthlySpending);
        const categoryData = @json($materialBreakdown);
        const summary = @json($summary);

        // Budget vs Spending Chart
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        new Chart(budgetCtx, {
            type: 'bar',
            data: {
                labels: budgetData.map(p => p.name.length > 15 ? p.name.substring(0, 15) + '...' : p.name),
                datasets: [
                    {
                        label: 'Budget',
                        data: budgetData.map(p => p.budget),
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderColor: '#10b981',
                        borderWidth: 1
                    },
                    {
                        label: 'Spent',
                        data: budgetData.map(p => p.spent),
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: '#3b82f6',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Monthly Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: monthlyData.map(m => m.month),
                datasets: [{
                    label: 'Monthly Spending',
                    data: monthlyData.map(m => m.amount),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Cost Distribution (Material vs Labor)
        const costCtx = document.getElementById('costDistributionChart').getContext('2d');
        new Chart(costCtx, {
            type: 'doughnut',
            data: {
                labels: ['Material Cost', 'Labor Cost'],
                datasets: [{
                    data: [summary.material_cost, summary.labor_cost],
                    backgroundColor: ['#3b82f6', '#f59e0b'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ₱' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Category Cost Chart
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryColors = [
            '#3b82f6', '#10b981', '#f59e0b', '#ef4444', 
            '#8b5cf6', '#ec4899', '#14b8a6', '#f97316'
        ];
        new Chart(catCtx, {
            type: 'bar',
            data: {
                labels: categoryData.map(c => c.category),
                datasets: [{
                    label: 'Cost',
                    data: categoryData.map(c => c.total_cost),
                    backgroundColor: categoryColors,
                    borderColor: categoryColors.map(c => c),
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
