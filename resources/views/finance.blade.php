<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Finance</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
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
            --red-600: var(--accent);
            --green-600: #059669;
            --yellow-500: #eab308;
            --purple-600: #7c3aed;
            --purple-700: #6d28d9;
            --purple-800: #5b21b6;
            --purple-900: #4c1d95;

            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;

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
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar has been moved to partials/sidebar.blade.php */

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
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
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Finance Layout */
        .finance-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 30px;
            height: 100%;
        }

        .finance-main {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .finance-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Financial Overview Cards */
        .overview-cards {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .overview-card {
            background: var(--gray-800);
            border-radius: 12px;
            padding: 24px;
            color: white;
            box-shadow: var(--shadow-md);
        }

        .overview-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: var(--text-headline-small-bold-font-weight);
            margin-bottom: 16px;
        }

        .overview-content {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .overview-item {
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            line-height: 1.5;
        }

        .net-profit-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .net-profit-value {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 28px;
            font-weight: var(--text-headline-small-bold-font-weight);
            margin-bottom: 8px;
        }

        .last-updated {
            font-family: var(--text-sm-medium-font-family);
            font-size: 12px;
            opacity: 0.8;
        }

        /* Summary Statistics */
        .summary-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            border-radius: 12px;
            padding: 20px;
            color: white;
            text-align: center;
            box-shadow: var(--shadow-md);
        }

        .stat-card.green {
            background: var(--green-600);
        }

        .stat-card.blue {
            background: var(--blue-600);
        }

        .stat-card.yellow {
            background: var(--yellow-500);
            color: black;
        }

        .stat-label {
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .stat-value {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 32px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        /* Statistics Chart */
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            flex: 1;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            color: var(--gray-600);
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .chart-subtitle {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .chart-legend {
            display: flex;
            gap: 16px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
        }

        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .legend-dot.purple {
            background: var(--purple-600);
        }

        .legend-dot.red {
            background: var(--red-600);
        }

        .chart-controls {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .chart-button {
            padding: 6px 12px;
            border: 1px solid var(--gray-300);
            background: white;
            border-radius: 6px;
            font-family: var(--text-sm-medium-font-family);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .chart-button.active {
            background: var(--blue-600);
            color: white;
            border-color: var(--blue-600);
        }

        .chart-area {
            height: 300px;
            background: #f8fafc;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            position: relative;
            padding: 20px 20px 40px 50px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: var(--gray-500);
            font-family: var(--text-md-normal-font-family);
        }

        .chart-bars-container {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: calc(100% - 20px);
            gap: 8px;
            padding: 0 10px;
        }

        .chart-bar-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            flex: 1;
            max-width: 60px;
        }

        .chart-bars {
            display: flex;
            gap: 3px;
            width: 100%;
            align-items: flex-end;
            height: 100%;
        }

        .chart-bar {
            flex: 1;
            border-radius: 4px 4px 0 0;
            position: relative;
            transition: opacity 0.2s ease;
            min-height: 4px;
        }

        .chart-bar:hover {
            opacity: 0.8;
        }

        .chart-bar.revenue {
            background: linear-gradient(180deg, #9333ea 0%, #7c3aed 100%);
        }

        .chart-bar.expense {
            background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
        }

        .chart-bar-label {
            font-size: 10px;
            color: var(--gray-500);
            text-align: center;
            margin-top: 4px;
            font-weight: 500;
        }

        .chart-y-axis {
            position: absolute;
            left: 10px;
            top: 20px;
            bottom: 40px;
            width: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 0;
            font-size: 10px;
            color: var(--gray-500);
            text-align: right;
        }

        .chart-x-axis {
            position: absolute;
            bottom: 0;
            left: 40px;
            right: 0;
            height: 30px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0 10px;
            font-size: 10px;
            color: var(--gray-500);
        }

        .chart-tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 11px;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 10;
        }

        .chart-tooltip.show {
            opacity: 1;
        }

        /* Finance Sidebar */
        .finance-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .finance-action-button {
            background: var(--purple-600);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 16px 20px;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            cursor: pointer;
            transition: background-color 0.2s ease;
            text-align: left;
        }

        .finance-action-button:hover {
            background: var(--purple-700);
        }

        .finance-action-button:nth-child(1) {
            background: var(--purple-800);
        }

        .finance-action-button:nth-child(2) {
            background: var(--purple-700);
        }

        .finance-action-button:nth-child(3) {
            background: var(--purple-600);
        }

        .finance-action-button:nth-child(4) {
            background: var(--purple-600);
        }

        .finance-graphic {
            flex: 1;
            background: linear-gradient(45deg, rgba(124, 58, 237, 0.1), rgba(124, 58, 237, 0.05));
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .finance-graphic::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><path d="M0,20 Q25,5 50,10 T100,8 L100,20 Z" fill="rgba(124,58,237,0.1)"/></svg>') no-repeat;
            background-size: cover;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .finance-layout {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
            }

            .finance-sidebar {
                flex-direction: row;
                gap: 20px;
            }

            .finance-actions {
                flex: 1;
                flex-direction: row;
            }

            .finance-action-button {
                flex: 1;
                text-align: center;
            }

            .finance-graphic {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .header {
                padding: 15px 20px;
            }

            .header-title {
                font-size: 20px;
            }

            .content-area {
                padding: 20px;
            }

            .overview-cards {
                grid-template-columns: 1fr;
            }

            .summary-stats {
                grid-template-columns: 1fr;
            }

            .finance-sidebar {
                flex-direction: column;
            }

            .finance-actions {
                flex-direction: column;
            }
        }

        /* Financial Data Modal Styles */
        .financial-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .financial-modal.active {
            display: flex;
            opacity: 1;
        }

        .financial-modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .financial-modal.active .financial-modal-content {
            transform: scale(1);
        }

        .financial-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px;
            border-bottom: 1px solid var(--gray-300);
        }

        .financial-modal-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
            color: var(--gray-800);
        }

        .financial-modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--gray-500);
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .financial-modal-close:hover {
            background: var(--gray-400);
            color: var(--gray-700);
        }

        .financial-form-group {
            margin-bottom: 20px;
            padding: 0 24px;
        }

        .financial-form-label {
            display: block;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .financial-form-input,
        .financial-form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            color: var(--gray-800);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .financial-form-input:focus,
        .financial-form-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        .financial-form-input::placeholder {
            color: var(--gray-500);
        }

        .financial-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 24px;
            border-top: 1px solid var(--gray-300);
        }

        .financial-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .financial-btn-primary {
            background: var(--accent);
            color: white;
        }

        .financial-btn-primary:hover {
            background: #15803d;
        }

        .financial-btn-primary:disabled {
            background: var(--gray-400);
            cursor: not-allowed;
        }

        .financial-btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .financial-btn-secondary:hover {
            background: var(--gray-400);
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
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <!-- Content Area -->
            <section class="content-area">
                <div class="finance-layout">
                    <div class="finance-main">
                        <!-- Overview Cards -->
                        <div class="overview-cards">
                            <div class="overview-card">
                                <h2 class="overview-title">Financial Overview</h2>
                                <div class="overview-content">
                                    <div class="overview-item">Total Revenue: ₱{{ number_format($totalRevenue, 2) }}</div>
                                    <div class="overview-item">Total Expenses: ₱{{ number_format($totalExpenses, 2) }}</div>
                                </div>
                            </div>
                            <div class="overview-card net-profit-card">
                                <div class="net-profit-value">Net Profit: ₱{{ number_format($netProfit, 2) }}</div>
                                <div class="last-updated">Last Updated: {{ date('g:i A T, F d, Y') }}</div>
                            </div>
                        </div>

                        <!-- Summary Statistics -->
                        <div class="summary-stats">
                            <div class="stat-card green">
                                <div class="stat-label">Active Projects</div>
                                <div class="stat-value">5</div>
                            </div>
                            <div class="stat-card blue">
                                <div class="stat-label">Total Transactions</div>
                                <div class="stat-value">{{ $totalTransactions }}</div>
                            </div>
                            <div class="stat-card yellow">
                                <div class="stat-label">Avg. Profit Margin</div>
                                <div class="stat-value">{{ $avgProfitMargin }}%</div>
                            </div>
                        </div>

                        <!-- Statistics Chart -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Statistics</div>
                                    <div class="chart-subtitle">Overall Tracking</div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <div class="chart-legend">
                                        <div class="legend-item">
                                            <div class="legend-dot purple"></div>
                                            <span>Revenue</span>
                                        </div>
                                        <div class="legend-item">
                                            <div class="legend-dot red"></div>
                                            <span>Expenses</span>
                                        </div>
                                    </div>
                                    <button class="finance-action-button" onclick="openFinancialDataModal()" style="padding: 8px 16px; font-size: 12px; background: var(--accent);">
                                        <i class="fas fa-plus"></i> Add Data
                                    </button>
                                </div>
                            </div>
                            <div class="chart-controls">
                                <button class="chart-button">7 days</button>
                                <button class="chart-button">30 days</button>
                                <button class="chart-button active">12 months</button>
                            </div>
                            <div class="chart-area">
                                <div class="chart-y-axis">
                                    <span>₱600K</span>
                                    <span>₱450K</span>
                                    <span>₱300K</span>
                                    <span>₱150K</span>
                                    <span>₱0</span>
                                </div>
                                <div class="chart-bars-container" id="chartBarsContainer">
                                    @php
                                        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                        $maxValue = max($financialData->max('revenue'), $financialData->max('expenses'), 600000);
                                    @endphp
                                    @foreach($financialData as $data)
                                        @php
                                            $monthIndex = $data->month - 1;
                                            $revenueHeight = ($data->revenue / $maxValue) * 100;
                                            $expenseHeight = ($data->expenses / $maxValue) * 100;
                                        @endphp
                                        <div class="chart-bar-group">
                                            <div class="chart-bars">
                                                <div class="chart-bar revenue" style="height: {{ $revenueHeight }}%;" data-value="₱{{ number_format($data->revenue, 0) }}" data-label="Revenue"></div>
                                                <div class="chart-bar expense" style="height: {{ $expenseHeight }}%;" data-value="₱{{ number_format($data->expenses, 0) }}" data-label="Expenses"></div>
                                            </div>
                                            <div class="chart-bar-label">{{ $monthNames[$monthIndex] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="chart-tooltip" id="chartTooltip"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Finance Sidebar -->
                    <div class="finance-sidebar">
                        <div class="finance-actions">
                            <button class="finance-action-button">Project Budget Management</button>
                            <button class="finance-action-button">Revenue Recording</button>
                            <button class="finance-action-button">Expense Tracking</button>
                            <button class="finance-action-button">Purchase Order</button>
                        </div>
                    </div>
                </div>

                <!-- Add Financial Data Modal -->
                <div class="financial-modal" id="financialDataModal" aria-hidden="true">
                    <div class="financial-modal-content" role="dialog" aria-modal="true">
                        <div class="financial-modal-header">
                            <div class="financial-modal-title">Add Financial Data</div>
                            <button class="financial-modal-close" onclick="closeFinancialDataModal()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="financialDataForm">
                            <div class="financial-form-group">
                                <label class="financial-form-label">Year</label>
                                <input type="number" class="financial-form-input" id="financialYear" name="year" value="2025" required min="2020" max="2100" />
                            </div>

                            <div class="financial-form-group">
                                <label class="financial-form-label">Month</label>
                                <select class="financial-form-select" id="financialMonth" name="month" required>
                                    <option value="">Select Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11" selected>November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>

                            <div class="financial-form-group">
                                <label class="financial-form-label">Revenue (₱)</label>
                                <input type="number" class="financial-form-input" id="financialRevenue" name="revenue" placeholder="Enter revenue amount" step="0.01" min="0" required />
                            </div>

                            <div class="financial-form-group">
                                <label class="financial-form-label">Expenses (₱)</label>
                                <input type="number" class="financial-form-input" id="financialExpenses" name="expenses" placeholder="Enter expenses amount" step="0.01" min="0" required />
                            </div>

                            <div class="financial-modal-footer">
                                <button type="button" class="financial-btn financial-btn-secondary" onclick="closeFinancialDataModal()">Cancel</button>
                                <button type="submit" class="financial-btn financial-btn-primary">
                                    <i class="fas fa-save"></i>
                                    <span>Save Data</span>
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
        // Chart button functionality
        document.querySelectorAll('.chart-button').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.chart-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Chart tooltip functionality
        const chartTooltip = document.getElementById('chartTooltip');
        const chartBars = document.querySelectorAll('.chart-bar');

        chartBars.forEach(bar => {
            bar.addEventListener('mouseenter', function(e) {
                const value = this.getAttribute('data-value');
                const label = this.getAttribute('data-label');
                const rect = this.getBoundingClientRect();
                const chartArea = document.querySelector('.chart-area');
                const chartRect = chartArea.getBoundingClientRect();

                chartTooltip.textContent = `${label}: ${value}`;
                chartTooltip.style.left = (rect.left - chartRect.left + rect.width / 2) + 'px';
                chartTooltip.style.top = (rect.top - chartRect.top - 35) + 'px';
                chartTooltip.classList.add('show');
            });

            bar.addEventListener('mouseleave', function() {
                chartTooltip.classList.remove('show');
            });
        });

        // Financial Data Modal functions
        const financialDataModal = document.getElementById('financialDataModal');
        const financialDataForm = document.getElementById('financialDataForm');

        function openFinancialDataModal() {
            financialDataModal.classList.add('active');
            financialDataModal.setAttribute('aria-hidden', 'false');
            financialDataForm.reset();
            document.getElementById('financialYear').value = '2025';
            document.getElementById('financialMonth').value = '11';
        }

        function closeFinancialDataModal() {
            financialDataModal.classList.remove('active');
            financialDataModal.setAttribute('aria-hidden', 'true');
            financialDataForm.reset();
        }

        // Handle form submission
        financialDataForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = {
                year: document.getElementById('financialYear').value,
                month: document.getElementById('financialMonth').value,
                revenue: document.getElementById('financialRevenue').value,
                expenses: document.getElementById('financialExpenses').value,
                _token: '{{ csrf_token() }}'
            };

            // Show loading state
            const submitBtn = financialDataForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Saving...</span>';
            submitBtn.disabled = true;

            try {
                const response = await fetch('{{ route("finance.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': formData._token,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Financial data added successfully!');
                    closeFinancialDataModal();
                    // Reload page to show updated data
                    window.location.reload();
                } else {
                    alert(result.message || 'An error occurred while saving the data.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Network error occurred. Please try again.');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Close modal on outside click
        if (financialDataModal) {
            financialDataModal.addEventListener('click', (e) => {
                if (e.target === financialDataModal) {
                    closeFinancialDataModal();
                }
            });
        }
    </script>
</body>

</html>