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
            --gray-500: #667085;
            --white: #ffffff;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --blue-1: #1c57b6;
            --blue-600: #2563eb;
            --red-600: #dc2626;
            --green-600: #059669;
            --yellow-500: #eab308;
            --purple-600: #7c3aed;
            --purple-700: #6d28d9;
            --purple-800: #5b21b6;
            --purple-900: #4c1d95;
            --black-1: #313131;
            --sidebar-bg: #c4c4c4;
            --header-bg: #4a5568;
            --main-bg: #e2e8f0;
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

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: var(--sidebar-bg);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            color: #dc2626;
            position: relative;
        }

        .logo .aces-text {
            color: #dc2626;
        }

        .logo .aces-text:nth-child(2),
        .logo .aces-text:nth-child(4) {
            color: #2563eb;
        }

        .sidebar-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
            color: black;
        }

        .nav-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .hamburger-menu {
            background: none;
            border: none;
            font-size: 18px;
            color: var(--gray-700);
            cursor: pointer;
        }

        .chevron {
            font-size: 14px;
            color: var(--gray-700);
        }

        .nav-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--gray-700);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .nav-item.active {
            background-color: white;
            color: black;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-icon {
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .logout-section {
            margin-top: auto;
            padding-top: 20px;
        }

        .logout-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--gray-700);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            transition: all 0.2s ease;
        }

        .logout-item:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

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
            background: linear-gradient(135deg, var(--header-bg), #2d3748);
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
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            font-family: var(--text-md-normal-font-family);
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
            background: var(--purple-500);
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
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

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
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <span class="aces-text">A</span><span class="aces-text">C</span><span
                        class="aces-text">E</span><span class="aces-text">S</span>
                </div>
                <div class="sidebar-title">ACES</div>
            </div>

            <div class="nav-toggle">
                <button class="hamburger-menu" id="navToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="chevron">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </div>

            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item">
                    <i class="nav-icon fas fa-smile"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('quality-assurance') }}" class="nav-item">
                    <i class="nav-icon fas fa-bolt"></i>
                    <span>Project Material Management</span>
                </a>
                <a href="{{ route('audit') }}" class="nav-item">
                    <i class="nav-icon fas fa-gavel"></i>
                    <span>Audit</span>
                </a>
                <a href="{{ route('finance') }}" class="nav-item active">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <span>Finance</span>
                </a>
                <a href="{{ route('projects') }}" class="nav-item">
                    <i class="nav-icon fas fa-tasks"></i>
                    <span>Projects</span>
                </a>
                <a href="{{ route('employee-attendance') }}" class="nav-item">
                    <i class="nav-icon fas fa-hard-hat"></i>
                    <span>Employee Attendance</span>
                </a>
            </nav>

            <div class="logout-section">
                <a href="#" class="logout-item">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </aside>

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
                                    <div class="overview-item">Total Revenue: P5,718,923</div>
                                    <div class="overview-item">Total Expenses: P2,309,895</div>
                                </div>
                            </div>
                            <div class="overview-card net-profit-card">
                                <div class="net-profit-value">Net Profit: P999,999</div>
                                <div class="last-updated">Last Updated: 12:00 AM PST, September 27, 2025</div>
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
                                <div class="stat-value">23</div>
                            </div>
                            <div class="stat-card yellow">
                                <div class="stat-label">Avg. Profit Margin</div>
                                <div class="stat-value">15%</div>
                            </div>
                        </div>

                        <!-- Statistics Chart -->
                        <div class="chart-card">
                            <div class="chart-header">
                                <div>
                                    <div class="chart-title">Statistics</div>
                                    <div class="chart-subtitle">Overall Tracking</div>
                                </div>
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
                            </div>
                            <div class="chart-controls">
                                <button class="chart-button">7 days</button>
                                <button class="chart-button">30 days</button>
                                <button class="chart-button active">12 months</button>
                            </div>
                            <div class="chart-area">
                                Financial Chart Area (Revenue vs Expenses over 12 months)
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
                        <div class="finance-graphic"></div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Sidebar toggle functionality
        const headerMenu = document.getElementById('headerMenu');
        const navToggle = document.getElementById('navToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        headerMenu.addEventListener('click', toggleSidebar);
        navToggle.addEventListener('click', toggleSidebar);

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function (e) {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !headerMenu.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open', 'collapsed');
                mainContent.classList.remove('expanded');
            }
        });

        // Chart button functionality
        document.querySelectorAll('.chart-button').forEach(button => {
            button.addEventListener('click', function () {
                document.querySelectorAll('.chart-button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>