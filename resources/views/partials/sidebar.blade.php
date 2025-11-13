<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Dashboard Container */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        background-color: #f8fafc;
    }

    /* Sidebar Overlay */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.active {
        display: block;
        opacity: 1;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        width: 280px;
        height: 100vh;
        padding: 28px 22px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        background-color: #f8fafc;
        border-right: 1px solid #e2e8f0;
        transform: translateX(-100%);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow-y: auto;
    }

    /* When open, slide into view */
    .sidebar.open {
        transform: translateX(0);
        box-shadow: 8px 0 24px rgba(15, 23, 42, 0.08);
    }

    /* Sidebar Header */
    .sidebar-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .sidebar-title {
        font-family: "Inter", sans-serif;
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    /* Logo */
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 24px;
        font-family: "Inter", sans-serif;
    }

    /* Navigation Menu */
    .nav-menu {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 18px;
        border-radius: 12px;
        text-decoration: none;
        color: #1f2937;
        font-family: "Inter", sans-serif;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.4;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .nav-item:hover {
        background-color: rgba(255, 255, 255, 0.6);
        color: #111827;
    }

    .nav-item.active {
        background-color: #ffffff;
        color: #0f172a;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
        font-weight: 600;
    }

    .nav-icon {
        font-size: 18px;
        width: 22px;
        text-align: center;
        color: inherit;
    }

    .nav-item span {
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Logout Section */
    .logout-section {
        margin-top: auto;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
    }

    .logout-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 18px;
        border-radius: 12px;
        text-decoration: none;
        color: #ef4444;
        font-family: "Inter", sans-serif;
        font-size: 15px;
        font-weight: 500;
        transition: background-color 0.2s ease;
        cursor: pointer;
    }

    .logout-item:hover {
        background-color: rgba(239, 68, 68, 0.1);
    }

    /* Main Content */
    .main-content {
        flex: 1;
        transition: margin-left 0.3s ease;
    }
    /* When sidebar is hidden on desktop */
    .main-content.sidebar-closed { margin-left: 0; }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 280px;
        }
        /* On mobile, content should not be pushed; sidebar overlays */
        .main-content { margin-left: 0 !important; }
        .main-content.sidebar-closed { margin-left: 0 !important; }
    }

    @media (min-width: 769px) {
        .sidebar-overlay {
            display: none !important;
        }
        /* Reserve desktop space for the sidebar */
        .main-content { margin-left: 280px !important; }
        .main-content.sidebar-closed { margin-left: 0 !important; }
    }
</style>

<!-- Sidebar Overlay (for mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar open" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/aces-logo.png') }}" alt="ACES logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="logo-fallback">ACES</div>
        </div>
        <div class="sidebar-title">ACES</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('project-material-management') }}" class="nav-item {{ request()->routeIs('project-material-management*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bolt"></i>
            <span>Project Material Management</span>
        </a>
        <a href="{{ route('transaction') }}" class="nav-item {{ request()->routeIs('transaction') ? 'active' : '' }}">
            <i class="nav-icon fas fa-gavel"></i>
            <span>Transaction</span>
        </a>
        <a href="{{ route('finance') }}" class="nav-item {{ request()->routeIs('finance') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-bar"></i>
            <span>Finance</span>
        </a>
        <a href="{{ route('projects') }}" class="nav-item {{ request()->routeIs('projects') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tasks"></i>
            <span>Projects</span>
        </a>
        <a href="{{ route('employee') }}" class="nav-item {{ request()->routeIs('employee') ? 'active' : '' }}">
            <i class="nav-icon fas fa-hard-hat"></i>
            <span>Employee</span>
        </a>
        <a href="{{ route('employee-attendance') }}" class="nav-item {{ request()->routeIs('employee-attendance') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-check"></i>
            <span>Attendance</span>
        </a>
    </nav>

    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-item" style="width:100%; background:none; border:none;">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle') || document.getElementById('headerMenu');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.querySelector('.main-content');

        function applyState(open) {
            const isMobile = window.innerWidth <= 768;
            if (open) {
                sidebar.classList.add('open');
                if (!isMobile) {
                    if (mainContent) mainContent.classList.remove('sidebar-closed');
                    if (sidebarOverlay) sidebarOverlay.classList.remove('active');
                } else {
                    if (sidebarOverlay) sidebarOverlay.classList.add('active');
                }
            } else {
                sidebar.classList.remove('open');
                if (mainContent) mainContent.classList.add('sidebar-closed');
                if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            }
        }

        // Keep sidebar open by default on load (all pages)
        applyState(true);

        // Toggle sidebar
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                const nextOpen = !sidebar.classList.contains('open');
                applyState(nextOpen);
            });
        }

        // Close sidebar when clicking overlay (mobile)
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                applyState(false);
            });
        }

        // Maintain layout on resize
        window.addEventListener('resize', function() {
            // If sidebar is open, re-apply correct classes for current viewport
            const isOpen = sidebar.classList.contains('open');
            applyState(isOpen);
        });
    });
</script>