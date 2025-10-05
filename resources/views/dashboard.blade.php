<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Dashboard</title>
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

        /* Summary Statistics Card */
        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .summary-item {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 20px;
            position: relative;
        }

        .summary-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 60px;
            background-color: #e5e7eb;
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            background-color: var(--blue-600);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .summary-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .summary-label {
            color: var(--gray-600);
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .summary-number {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: var(--text-headline-small-bold-font-weight);
            line-height: 1.2;
        }

        /* Main Content Card */
        .main-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--shadow-md);
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            font-size: 18px;
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

            .summary-card {
                flex-direction: column;
                gap: 20px;
            }

            .summary-item {
                width: 100%;
                padding: 16px 0;
            }

            .summary-item:not(:last-child)::after {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .summary-card {
                padding: 16px;
            }

            .summary-item {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }

            .summary-number {
                font-size: 20px;
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
                <a href="{{ route('dashboard') }}" class="nav-item active">
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
                <!-- Summary Statistics -->
                <div class="summary-card">
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-label">Total Projects</span>
                            <span class="summary-number">27</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-label">Complete Projects</span>
                            <span class="summary-number">21</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-label">Ongoing Projects</span>
                            <span class="summary-number">6</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content Card -->
                <div class="main-card">
                    <div>Main Dashboard Content Area</div>
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