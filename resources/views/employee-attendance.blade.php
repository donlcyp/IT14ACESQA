<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Employee Attendance</title>
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

        .sidebar.collapsed {
            transform: translateX(-100%);
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
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 0;
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

        /* Employee Management Header */
        .employee-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .employee-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .employee-options {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .employee-options:hover {
            background-color: var(--gray-100);
        }

        /* Employee Cards */
        .employee-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .employee-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        .employee-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .employee-card-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .employee-expand {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 16px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .employee-expand:hover {
            background-color: var(--gray-100);
        }

        /* Tables */
        .employee-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .employee-table thead {
            color: white;
        }

        .employee-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .employee-table tbody tr {
            border-bottom: 1px solid var(--gray-200);
        }

        .employee-table tbody tr:last-child {
            border-bottom: none;
        }

        .employee-table tbody td {
            padding: 12px 16px;
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
        }

        .employee-table.employees thead {
            background: var(--green-600);
        }

        .employee-table.attendance thead {
            background: var(--red-600);
        }

        /* Status badges */
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.on-leave {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.on-site {
            background: #d1fae5;
            color: #065f46;
        }

        /* Responsive Design */
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

            .employee-table {
                font-size: 14px;
            }

            .employee-table thead th,
            .employee-table tbody td {
                padding: 8px 12px;
            }

            .employee-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
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
                    <span>Quality Assurance</span>
                </a>
                <a href="{{ route('audit') }}" class="nav-item">
                    <i class="nav-icon fas fa-gavel"></i>
                    <span>Audit</span>
                </a>
                <a href="{{ route('finance') }}" class="nav-item">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    <span>Finance</span>
                </a>
                <a href="{{ route('projects') }}" class="nav-item">
                    <i class="nav-icon fas fa-tasks"></i>
                    <span>Projects</span>
                </a>
                <a href="{{ route('employee-attendance') }}" class="nav-item active">
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
                <!-- Employee Management Header -->
                <div class="employee-header">
                    <h1 class="employee-title">Employee Management</h1>
                    <button class="employee-options">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>

                <!-- Employee Cards -->
                <div class="employee-cards">
                    <!-- List of Employees Card -->
                    <div class="employee-card">
                        <div class="employee-card-header">
                            <h2 class="employee-card-title">List of Employees</h2>
                            <button class="employee-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="employee-table employees">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>User ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>EMP002</td>
                                    <td>PRM002</td>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>Project Manager</td>
                                </tr>
                                <tr>
                                    <td>EMP001</td>
                                    <td>-</td>
                                    <td>Mari</td>
                                    <td>Lou</td>
                                    <td>Construction Worker</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Attendance Tracking Card -->
                    <div class="employee-card">
                        <div class="employee-card-header">
                            <h2 class="employee-card-title">Attendance Tracking</h2>
                            <button class="employee-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="employee-table attendance">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                    <th>Attendance Status</th>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>EMP002</td>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>Project Manager</td>
                                    <td><span class="status-badge on-leave">On Leave</span></td>
                                    <td>2025-09-26</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>EMP001</td>
                                    <td>Mari</td>
                                    <td>Lou</td>
                                    <td>Construction Worker</td>
                                    <td><span class="status-badge on-site">On Site</span></td>
                                    <td>2025-09-26</td>
                                    <td>7:26 AM PST</td>
                                    <td>10:30 PM PST</td>
                                </tr>
                            </tbody>
                        </table>
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
    </script>
</body>

</html>