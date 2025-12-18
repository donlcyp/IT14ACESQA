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
        overflow-y: auto;
    }

    /* When open, slide into view */
    .sidebar.open {
        transform: translateX(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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

    /* Sidebar Overlay/Backdrop */
    .sidebar-overlay {
        display: none !important;
    }

    .sidebar-overlay.active {
        display: none !important;
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
</style>

<!-- Sidebar Overlay/Backdrop -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/aces.png') }}" alt="ACES logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="logo-fallback">ACES</div>
        </div>
        <div class="sidebar-title">ACES</div>
    </div>

    <nav class="nav-menu">
        <!-- Dashboard - Available to all roles (redirect to role-specific dashboard) -->
        @if(auth()->check() && in_array(auth()->user()->role, ['SS', 'CW', 'FM', 'HR']))
            {{-- These roles use their own dashboard links below --}}
        @else
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        @endif

        <!-- OWNER: All menu items visible -->
        @if(auth()->check() && auth()->user()->role === 'OWNER')
            <a href="{{ route('projects') }}" class="nav-item {{ request()->routeIs('projects') ? 'active' : '' }}">
                <i class="nav-icon fas fa-folder-open"></i>
                <span>Projects</span>
            </a>
            <a href="{{ route('archives') }}" class="nav-item {{ request()->routeIs('archives') ? 'active' : '' }}">
                <i class="nav-icon fas fa-archive"></i>
                <span>Archives</span>
            </a>
            <a href="{{ route('employee-attendance') }}" class="nav-item {{ request()->routeIs('employee-attendance') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-check"></i>
                <span>Attendance</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users-gear"></i>
                <span>Personnel</span>
            </a>
            <a href="{{ route('logs.index') }}" class="nav-item {{ request()->routeIs('logs.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-history"></i>
                <span>Activity Logs</span>
            </a>
            <a href="{{ route('settings.salary-rates') }}" class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-peso-sign"></i>
                <span>Salary Settings</span>
            </a>
            <a href="{{ route('finance-graphs') }}" class="nav-item {{ request()->routeIs('finance-graphs') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <span>Finance Graphs</span>
            </a>
        @endif

        <!-- PROJECT MANAGER: Full project control -->
        @if(auth()->check() && auth()->user()->role === 'PM')
            <a href="{{ route('projects') }}" class="nav-item {{ request()->routeIs('projects') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <span>Projects</span>
            </a>
            <a href="{{ route('archives') }}" class="nav-item {{ request()->routeIs('archives') ? 'active' : '' }}">
                <i class="nav-icon fas fa-archive"></i>
                <span>Archives</span>
            </a>
            <a href="{{ route('employee-attendance') }}" class="nav-item {{ request()->routeIs('employee-attendance') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-check"></i>
                <span>Attendance</span>
            </a>
            <a href="{{ route('employee-attendance.history') }}" class="nav-item {{ request()->routeIs('employee-attendance.history') ? 'active' : '' }}">
                <i class="nav-icon fas fa-history"></i>
                <span>Attendance History</span>
            </a>
        @endif

        <!-- HR/TIMEKEEPER: Attendance Validation -->
        @if(auth()->check() && auth()->user()->role === 'HR')
            <a href="{{ route('attendance-validation.dashboard') }}" class="nav-item {{ request()->routeIs('attendance-validation.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <span>HR Dashboard</span>
            </a>
            <a href="{{ route('attendance-validation.index') }}" class="nav-item {{ request()->routeIs('attendance-validation.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-check"></i>
                <span>Pending Reviews</span>
            </a>
            <a href="{{ route('attendance-validation.approved') }}" class="nav-item {{ request()->routeIs('attendance-validation.approved') ? 'active' : '' }}">
                <i class="nav-icon fas fa-check-circle"></i>
                <span>Approved</span>
            </a>
            <a href="{{ route('attendance-validation.rejected') }}" class="nav-item {{ request()->routeIs('attendance-validation.rejected') ? 'active' : '' }}">
                <i class="nav-icon fas fa-times-circle"></i>
                <span>Rejected</span>
            </a>
        @endif

        <!-- QA: Materials Inspection (QA Role Only) -->
        @if(auth()->check() && auth()->user()->role === 'QA')
            <a href="{{ route('qa.materials') }}" class="nav-item {{ request()->routeIs('qa.materials') ? 'active' : '' }}">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <span>QA Materials</span>
            </a>
        @endif

        <!-- SITE SUPERVISOR (SS): Site Operations -->
        @if(auth()->check() && auth()->user()->role === 'SS')
            <a href="{{ route('ss.dashboard') }}" class="nav-item {{ request()->routeIs('ss.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-helmet-safety"></i>
                <span>SS Dashboard</span>
            </a>
            <a href="{{ route('ss.projects') }}" class="nav-item {{ request()->routeIs('ss.projects', 'ss.project-view') ? 'active' : '' }}">
                <i class="nav-icon fas fa-folder-open"></i>
                <span>My Projects</span>
            </a>
            <a href="{{ route('ss.progress-reports') }}" class="nav-item {{ request()->routeIs('ss.progress-reports*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-line"></i>
                <span>Daily Progress</span>
            </a>
            <a href="{{ route('ss.issues') }}" class="nav-item {{ request()->routeIs('ss.issues*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-exclamation-triangle"></i>
                <span>Issues & Incidents</span>
            </a>
            <a href="{{ route('ss.attendance') }}" class="nav-item {{ request()->routeIs('ss.attendance*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-check"></i>
                <span>Attendance Verify</span>
            </a>
        @endif

        <!-- FM: Finance Manager Dashboard -->
        @if(auth()->check() && auth()->user()->role === 'FM')
            <a href="{{ route('fm.dashboard') }}" class="nav-item {{ request()->routeIs('fm.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <span>Finance Dashboard</span>
            </a>
            <a href="{{ route('fm.replacement-approvals') }}" class="nav-item {{ request()->routeIs('fm.replacement-approvals') ? 'active' : '' }}">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <span>Replacement Approvals</span>
                @php
                    $pendingCount = \App\Models\Material::where('replacement_requested', true)->where('replacement_status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span style="background: #ef4444; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; margin-left: auto;">{{ $pendingCount }}</span>
                @endif
            </a>
        @endif

        <!-- CONSTRUCTION WORKER (CW): Worker Dashboard -->
        @if(auth()->check() && auth()->user()->role === 'CW')
            <a href="{{ route('cw.dashboard') }}" class="nav-item {{ request()->routeIs('cw.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-hard-hat"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('cw.tasks') }}" class="nav-item {{ request()->routeIs('cw.tasks') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <span>My Tasks</span>
            </a>
            <a href="{{ route('cw.attendance') }}" class="nav-item {{ request()->routeIs('cw.attendance') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-check"></i>
                <span>My Attendance</span>
            </a>
        @endif

        <!-- EMPLOYEE: My Attendance (for employees who have employee profile, excluding OWNER, SS, CW, HR) -->
        @if(auth()->check() && !in_array(auth()->user()->role, ['OWNER', 'SS', 'CW', 'HR']) && \App\Models\EmployeeList::where('user_id', auth()->user()->id)->exists())
            <a href="{{ route('my-attendance') }}" class="nav-item {{ request()->routeIs('my-attendance') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-check"></i>
                <span>My Attendance</span>
            </a>
        @elseif(auth()->check() && !in_array(auth()->user()->role, ['OWNER', 'SS', 'CW', 'HR', 'FM']))
            <a href="{{ route('my-attendance') }}" class="nav-item {{ request()->routeIs('my-attendance') ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        @endif
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