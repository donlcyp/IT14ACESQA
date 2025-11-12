<style>
    /* Sidebar styles */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        transition: transform 0.3s ease;
        transform: translateX(-100%);
        background-color: #f1f5f9;
        width: 280px;
        height: 100vh;
        padding: 24px 16px;
        display: flex;
        flex-direction: column;
    }

    /* When open, slide into view */
    .sidebar.open {
        transform: translateX(0);
        background-color: #f8fafc;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .sidebar-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .logo {
        width: 64px;
        height: 64px;
        position: relative;
    }

    .logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        display: block;
    }

    .logo-fallback {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        background: #e5e7eb;
        color: #111827;
        font-weight: 700;
        font-family: "Inter", sans-serif;
    }

    .sidebar-title {
        font-family: "Inter", sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: #111827;
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
        font-family: "Inter", sans-serif;
        font-size: 14px;
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
        border-top: 1px solid #e5e7eb;
    }

    .logout-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 16px;
        border-radius: 8px;
        text-decoration: none;
        color: var(--gray-700);
        font-family: "Inter", sans-serif;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .logout-item:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
        }
    }
</style>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/aces-logo.png') }}" alt="ACES logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="logo-fallback">ACES</div>
        </div>
        <div class="sidebar-title">ACES</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-smile"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('quality-assurance') }}" class="nav-item {{ request()->routeIs('quality-assurance') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bolt"></i>
            <span>Project Material Management</span>
        </a>
        <a href="{{ route('audit') }}" class="nav-item {{ request()->routeIs('audit') ? 'active' : '' }}">
            <i class="nav-icon fas fa-gavel"></i>
            <span>Audit</span>
        </a>
        <a href="{{ route('finance') }}" class="nav-item {{ request()->routeIs('finance') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-bar"></i>
            <span>Finance</span>
        </a>
        <a href="{{ route('projects') }}" class="nav-item {{ request()->routeIs('projects') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tasks"></i>
            <span>Projects</span>
        </a>
        <a href="{{ route('employee-attendance') }}" class="nav-item {{ request()->routeIs('employee-attendance') ? 'active' : '' }}">
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
