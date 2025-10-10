<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Projects</title>
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

        /* Projects Header */
        .projects-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-md);
        }

        .projects-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .projects-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .projects-view-options {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .view-toggle {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .view-toggle:hover {
            background-color: var(--gray-100);
        }

        .projects-header-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .projects-search {
            flex: 1;
            max-width: 400px;
        }

        .search-container {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--blue-600);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 16px;
        }

        .projects-filters {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .filter-button {
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            color: var(--gray-700);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-button:hover {
            background: var(--gray-50);
        }

        .projects-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .action-button {
            padding: 10px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .action-button:hover {
            opacity: 0.9;
        }

        .action-button.primary {
            background: var(--blue-600);
            color: white;
        }

        .action-button.danger {
            background: var(--red-600);
            color: white;
        }

        /* Project Cards */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }

        .project-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-md);
            transition: transform 0.2s ease;
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-4px);
        }

        .project-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .project-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .project-icon.red {
            background: #8b0000;
        }

        .project-icon.blue {
            background: var(--blue-600);
        }

        .project-icon.pink {
            background: #ff69b4;
        }

        .project-info {
            flex: 1;
        }

        .project-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 18px;
            font-weight: var(--text-headline-small-bold-font-weight);
            margin-bottom: 4px;
        }

        .project-client {
            color: var(--gray-600);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            margin-bottom: 4px;
        }

        .project-location {
            color: var(--gray-600);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
        }

        .project-time {
            position: absolute;
            top: 20px;
            right: 20px;
            color: var(--gray-500);
            font-family: var(--text-sm-medium-font-family);
            font-size: 12px;
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

            .projects-header-bottom {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .projects-search {
                max-width: none;
            }

            .projects-filters {
                justify-content: space-between;
            }

            .projects-grid {
                grid-template-columns: 1fr;
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
                <a href="{{ route('projects') }}" class="nav-item active">
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
                <!-- Projects Header -->
                <div class="projects-header">
                    <div class="projects-header-top">
                        <h1 class="projects-title">Projects</h1>
                        <div class="projects-view-options">
                            <button class="view-toggle">
                                <i class="fas fa-th-large"></i>
                            </button>
                            <button class="view-toggle">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                    <div class="projects-header-bottom">
                        <div class="projects-search">
                            <div class="search-container">
                                <i class="search-icon fas fa-search"></i>
                                <input type="text" class="search-input" placeholder="Search">
                            </div>
                        </div>
                        <div class="projects-filters">
                            <button class="filter-button">
                                <i class="fas fa-filter"></i>
                                <span>Filters</span>
                            </button>
                        </div>
                        <div class="projects-actions">
                            <button class="action-button primary">
                                <i class="fas fa-plus"></i>
                                <span>New</span>
                            </button>
                            <button class="action-button danger">
                                <i class="fas fa-trash"></i>
                                <span>Delete</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Project Cards -->
                <div class="projects-grid">
                    <div class="project-card">
                        <div class="project-time">30 mins ago</div>
                        <div class="project-header">
                            <div class="project-icon red">AS</div>
                            <div class="project-info">
                                <h3 class="project-title">Assumption School</h3>
                                <div class="project-client">Client Name: Mrs. Maria Lopez</div>
                                <div class="project-location">Tagum</div>
                            </div>
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="project-time">30 mins ago</div>
                        <div class="project-header">
                            <div class="project-icon blue">AP</div>
                            <div class="project-info">
                                <h3 class="project-title">Dr. A.P Medical Center</h3>
                                <div class="project-client">Client Name: Dr. Arturo Pingoy</div>
                                <div class="project-location">Koronadal</div>
                            </div>
                        </div>
                    </div>

                    <div class="project-card">
                        <div class="project-time">30 mins ago</div>
                        <div class="project-header">
                            <div class="project-icon pink">FP</div>
                            <div class="project-info">
                                <h3 class="project-title">First Pacific Inn</h3>
                                <div class="project-client">Client Name: Mr. Ramon Cruz</div>
                                <div class="project-location">Davao</div>
                            </div>
                        </div>
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