<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Financial Graphs - AJJ CRISBER Engineering Services</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --accent: #1e40af;
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
            .main-content {
                margin-left: 280px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        .header {
            background: var(--header-bg);
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
            background: transparent;
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
            padding: 25px;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
            background: transparent;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .page-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            letter-spacing: -0.5px;
        }

        .back-link {
            font-size: 15px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .back-link:hover {
            color: #1e3a8a;
            background-color: rgba(30, 64, 175, 0.05);
        }
        
        .back-link:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .graphs-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 16px;
        }

        .graph-card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            grid-column: span 12;
            transition: box-shadow 0.3s ease;
        }
        
        .graph-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .graph-card.half {
            grid-column: span 6;
        }

        .graph-card-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 12px;
        }

        .chart-container {
            position: relative;
            height: 280px;
            margin-bottom: 12px;
        }

        .chart-container.small {
            height: 220px;
        }

        .summary-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }

        .stat-box {
            background: white;
            border-left: 4px solid var(--accent);
            padding: 12px;
            border-radius: 8px;
        }

        .stat-label {
            font-size: 11px;
            color: var(--gray-600);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-800);
        }

        @media (max-width: 1024px) {
            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .graph-card.half {
                grid-column: span 12;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 12px 15px;
            }

            .header-title {
                font-size: 18px;
            }

            .content-area {
                padding: 15px;
            }

            .page-title {
                font-size: 20px;
            }

            .summary-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .chart-container {
                height: 240px;
            }

            .chart-container.small {
                height: 180px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Header -->
            <header class="header">
                <button class="header-menu" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <!-- Content Area -->
            <section class="content-area">
                <div class="page-header">
                    <h1 class="page-title">Financial Graphs & Analytics</h1>
                    <a href="{{ route('dashboard') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>

                <!-- Summary Statistics -->
                <div class="summary-stats">
                    <div class="stat-box">
                        <div class="stat-label">Total Budget</div>
                        <div class="stat-value">₱{{ number_format($totalBudget ?? 0, 2) }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Total Spent</div>
                        <div class="stat-value">₱{{ number_format($totalSpent ?? 0, 2) }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Remaining</div>
                        <div class="stat-value">₱{{ number_format(($totalBudget ?? 0) - ($totalSpent ?? 0), 2) }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Budget Usage</div>
                        <div class="stat-value">{{ $totalBudget ? round(($totalSpent / $totalBudget) * 100, 1) : 0 }}%</div>
                    </div>
                </div>

                <!-- Graphs Grid -->
                <div class="graphs-grid">
                    <!-- Budget vs Spent Overview -->
                    <div class="graph-card half">
                        <div class="graph-card-title">Budget vs Spent Overview</div>
                        <div class="chart-container small">
                            <canvas id="budgetChart"></canvas>
                        </div>
                    </div>

                    <!-- Budget Distribution -->
                    <div class="graph-card half">
                        <div class="graph-card-title">Project Budget Distribution</div>
                        <div class="chart-container small">
                            <canvas id="distributionChart"></canvas>
                        </div>
                    </div>

                    <!-- Spending Trend -->
                    <div class="graph-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <div class="graph-card-title" style="margin-bottom: 0;">
                                <span id="trendTitle">Monthly Spending Trend</span>
                            </div>
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <button id="prevPeriodBtn" style="padding: 8px 12px; background: #1e40af; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">← Previous</button>
                                
                                <select id="filterSelect" style="padding: 8px 12px; border: 1px solid #d0d5dd; border-radius: 4px; cursor: pointer; font-size: 12px;">
                                    <option value="day" selected>Daily</option>
                                    <option value="week">Weekly</option>
                                    <option value="year">Yearly</option>
                                </select>
                                
                                <button id="nextPeriodBtn" style="padding: 8px 12px; background: #1e40af; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;">Next →</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>

                    <!-- Project Spending Breakdown -->
                    <div class="graph-card">
                        <div class="graph-card-title">Spending by Project</div>
                        <div class="chart-container">
                            <canvas id="projectChart"></canvas>
                        </div>
                    </div>

                    <!-- Status Breakdown -->
                    <div class="graph-card half">
                        <div class="graph-card-title">Budget Status Breakdown</div>
                        <div class="chart-container small">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>

                    <!-- Material Cost Breakdown -->
                    <div class="graph-card half">
                        <div class="graph-card-title">Material vs Labor Costs</div>
                        <div class="chart-container small">
                            <canvas id="costTypeChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        // Chart Colors
        const chartColors = {
            primary: '#1e40af',
            success: '#0369a1',
            warning: '#f59e0b',
            danger: '#ef4444',
            info: '#3b82f6',
            light: '#f3f4f6'
        };

        // Data from backend
        const projectsData = @json($projectsData ?? []);
        const totalBudget = @json($totalBudget ?? 0);
        const totalSpent = @json($totalSpent ?? 0);

        // Chart 1: Budget vs Spent
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        new Chart(budgetCtx, {
            type: 'doughnut',
            data: {
                labels: ['Spent', 'Remaining'],
                datasets: [{
                    data: [totalSpent, totalBudget - totalSpent],
                    backgroundColor: [chartColors.primary, chartColors.light],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart 2: Project Distribution
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distributionCtx, {
            type: 'pie',
            data: {
                labels: projectsData.map(p => p.name),
                datasets: [{
                    data: projectsData.map(p => p.budget),
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.success,
                        chartColors.info,
                        chartColors.warning,
                        chartColors.danger
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart 3: Spending Trend (Dynamic)
        let trendChart = null;
        let currentFilter = 'day';
        let currentOffset = 0;
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth() + 1;

        async function loadSpendingTrend() {
            try {
                const response = await fetch(`/api/spending-trend?filter=${currentFilter}&offset=${currentOffset}&year=${currentYear}&month=${currentMonth}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                // Update title
                document.getElementById('trendTitle').textContent = data.title;

                // Update year/month for navigation
                currentYear = data.year;
                currentMonth = data.month;

                // Destroy existing chart if it exists
                if (trendChart) {
                    trendChart.destroy();
                }

                // Clear and reset canvas
                const canvas = document.getElementById('trendChart');
                const container = canvas.parentElement;
                canvas.remove();
                const newCanvas = document.createElement('canvas');
                newCanvas.id = 'trendChart';
                container.appendChild(newCanvas);

                // Ensure data is an array
                const chartData = Array.isArray(data.data) ? data.data : Object.values(data.data);

                // Create new chart
                const trendCtx = document.getElementById('trendChart').getContext('2d');
                trendChart = new Chart(trendCtx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: data.title.split(' - ')[0],
                            data: chartData,
                            borderColor: chartColors.primary,
                            backgroundColor: 'rgba(22, 163, 74, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: chartColors.primary,
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
                                display: true
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
            } catch (error) {
                console.error('Error loading spending trend:', error);
                // Fallback: show empty chart on error
                if (trendChart) {
                    trendChart.destroy();
                }
                const canvas = document.getElementById('trendChart');
                const container = canvas.parentElement;
                canvas.remove();
                const newCanvas = document.createElement('canvas');
                newCanvas.id = 'trendChart';
                container.appendChild(newCanvas);

                const trendCtx = document.getElementById('trendChart').getContext('2d');
                trendChart = new Chart(trendCtx, {
                    type: 'line',
                    data: {
                        labels: ['Error'],
                        datasets: [{
                            label: 'Error loading data',
                            data: [0],
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)'
                        }]
                    }
                });
            }
        }

        // Event listeners for filter controls
        const filterSelect = document.getElementById('filterSelect');
        const prevBtn = document.getElementById('prevPeriodBtn');
        const nextBtn = document.getElementById('nextPeriodBtn');

        if (filterSelect) {
            filterSelect.addEventListener('change', (e) => {
                currentFilter = e.target.value;
                currentOffset = 0; // Reset offset when changing filter
                loadSpendingTrend();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                currentOffset--;
                loadSpendingTrend();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                currentOffset++;
                loadSpendingTrend();
            });
        }

        // Load initial spending trend
        loadSpendingTrend();

        // Chart 4: Project Spending
        const projectCtx = document.getElementById('projectChart').getContext('2d');
        new Chart(projectCtx, {
            type: 'bar',
            data: {
                labels: projectsData.map(p => p.name),
                datasets: [
                    {
                        label: 'Budget',
                        data: projectsData.map(p => p.budget),
                        backgroundColor: chartColors.primary
                    },
                    {
                        label: 'Spent',
                        data: projectsData.map(p => p.spent),
                        backgroundColor: chartColors.warning
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
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

        // Chart 5: Status Breakdown
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Healthy', 'Critical', 'Over Budget'],
                datasets: [{
                    data: [
                        projectsData.filter(p => (p.budget - p.spent) > (p.budget * 0.2)).length,
                        projectsData.filter(p => (p.budget - p.spent) <= (p.budget * 0.2) && (p.budget - p.spent) > 0).length,
                        projectsData.filter(p => (p.budget - p.spent) < 0).length
                    ],
                    backgroundColor: [chartColors.success, chartColors.warning, chartColors.danger],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart 6: Cost Type Breakdown
        const costTypeCtx = document.getElementById('costTypeChart').getContext('2d');
        const totalMaterialCost = projectsData.reduce((sum, p) => sum + (p.materialCost || 0), 0);
        const totalLaborCost = projectsData.reduce((sum, p) => sum + (p.laborCost || 0), 0);

        new Chart(costTypeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Material Costs', 'Labor Costs'],
                datasets: [{
                    data: [totalMaterialCost, totalLaborCost],
                    backgroundColor: [chartColors.primary, chartColors.info],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>

</html>
