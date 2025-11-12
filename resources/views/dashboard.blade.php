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
            --accent: #16a34a;
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

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: var(--accent);
            --green-600: #059669;

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
            color: var(--gray-700);
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
            transition: margin-left 0.3s ease;
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
            color: var(--gray-700);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .dashboard-card.full {
            grid-column: span 12;
        }

        .dashboard-card.half {
            grid-column: span 6;
        }

        .dashboard-card.third {
            grid-column: span 4;
        }

        .dashboard-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .dashboard-card-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-800);
        }

        .dashboard-card-subtitle {
            font-size: 14px;
            color: var(--gray-500);
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dashboard-table thead th {
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-table tbody tr:not(:last-child) td {
            border-bottom: 1px solid #e5e7eb;
        }

        .dashboard-table td {
            padding: 14px 0;
            font-size: 15px;
            color: var(--gray-700);
            vertical-align: middle;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-badge.success {
            background-color: rgba(34, 197, 94, 0.15);
            color: #047857;
        }

        .status-badge.warning {
            background-color: rgba(251, 191, 36, 0.18);
            color: #a16207;
        }

        .status-badge.info {
            background-color: rgba(59, 130, 246, 0.15);
            color: #1d4ed8;
        }

        .progress-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-bar {
            flex: 1;
            height: 6px;
            background-color: #e2e8f0;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-bar span {
            display: block;
            height: 100%;
            background: linear-gradient(135deg, var(--blue-600), #38bdf8);
        }

        .milestone-list,
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .milestone-item,
        .activity-item {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .milestone-icon,
        .activity-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue-600);
            font-size: 18px;
        }

        .milestone-content,
        .activity-content {
            flex: 1;
        }

        .milestone-title,
        .activity-title {
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 4px;
        }

        .milestone-meta,
        .activity-meta {
            font-size: 13px;
            color: var(--gray-500);
        }

        .team-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .team-member {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .team-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .team-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #22d3ee);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .team-role {
            font-size: 13px;
            color: var(--gray-500);
        }

        .utilization-rate {
            font-weight: 600;
            color: var(--gray-800);
            text-align: right;
        }

        .utilization-rate span {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--gray-500);
        }

        .view-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-600);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-link i {
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
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

            .dashboard-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }

            .dashboard-card,
            .dashboard-card.full,
            .dashboard-card.half,
            .dashboard-card.third {
                grid-column: span 1;
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

                <!-- Detailed Insights -->
                <div class="dashboard-grid">
                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Active Projects</div>
                                <div class="dashboard-card-subtitle">Projects currently in execution with status and progress</div>
                            </div>
                            <a class="view-link" href="{{ route('projects') }}">
                                View all
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Progress</th>
                                    <th>Lead</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>North Harbor Logistics Center</td>
                                    <td>TransPhil Industries</td>
                                    <td>
                                        <span class="status-badge warning">
                                            <i class="fas fa-hourglass-half"></i>
                                            In Review
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress-wrapper">
                                            <div class="progress-bar">
                                                <span style="width: 58%;"></span>
                                            </div>
                                            <span>58%</span>
                                        </div>
                                    </td>
                                    <td>A. Santiago</td>
                                </tr>
                                <tr>
                                    <td>Skyline Residences Tower B</td>
                                    <td>Vision City Homes</td>
                                    <td>
                                        <span class="status-badge success">
                                            <i class="fas fa-check"></i>
                                            On Track
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress-wrapper">
                                            <div class="progress-bar">
                                                <span style="width: 84%;"></span>
                                            </div>
                                            <span>84%</span>
                                        </div>
                                    </td>
                                    <td>M. Lozada</td>
                                </tr>
                                <tr>
                                    <td>Eastern Tech Manufacturing Plant</td>
                                    <td>ETM Group</td>
                                    <td>
                                        <span class="status-badge info">
                                            <i class="fas fa-bolt"></i>
                                            Mobilizing
                                        </span>
                                    </td>
                                    <td>
                                        <div class="progress-wrapper">
                                            <div class="progress-bar">
                                                <span style="width: 32%;"></span>
                                            </div>
                                            <span>32%</span>
                                        </div>
                                    </td>
                                    <td>J. Ramos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="dashboard-card half">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Upcoming Milestones</div>
                                <div class="dashboard-card-subtitle">Key activities scheduled over the next two weeks</div>
                            </div>
                        </div>

                        <div class="milestone-list">
                            <div class="milestone-item">
                                <div class="milestone-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="milestone-content">
                                    <div class="milestone-title">Final punch list walkthrough</div>
                                    <div class="milestone-meta">June 14 • Skyline Residences Tower B • Lead: M. Lozada</div>
                                </div>
                            </div>
                            <div class="milestone-item">
                                <div class="milestone-icon">
                                    <i class="fas fa-hard-hat"></i>
                                </div>
                                <div class="milestone-content">
                                    <div class="milestone-title">Structural steel installation mobilization</div>
                                    <div class="milestone-meta">June 18 • North Harbor Logistics Center • Lead: A. Santiago</div>
                                </div>
                            </div>
                            <div class="milestone-item">
                                <div class="milestone-icon">
                                    <i class="fas fa-water"></i>
                                </div>
                                <div class="milestone-content">
                                    <div class="milestone-title">Hydro test of fire suppression network</div>
                                    <div class="milestone-meta">June 22 • Eastern Tech Manufacturing Plant • Lead: J. Ramos</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card half">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Team Utilization</div>
                                <div class="dashboard-card-subtitle">Resource allocation across active engagements</div>
                            </div>
                        </div>

                        <div class="team-list">
                            <div class="team-member">
                                <div class="team-info">
                                    <div class="team-avatar">RS</div>
                                    <div>
                                        <div class="milestone-title">Rowena Santos</div>
                                        <div class="team-role">Project Manager • Skyline Residences</div>
                                    </div>
                                </div>
                                <div class="utilization-rate">
                                    92%
                                    <span>Critical</span>
                                </div>
                            </div>
                            <div class="team-member">
                                <div class="team-info">
                                    <div class="team-avatar">DL</div>
                                    <div>
                                        <div class="milestone-title">David Lim</div>
                                        <div class="team-role">QA/QC Supervisor • North Harbor Logistics</div>
                                    </div>
                                </div>
                                <div class="utilization-rate">
                                    76%
                                    <span>Healthy</span>
                                </div>
                            </div>
                            <div class="team-member">
                                <div class="team-info">
                                    <div class="team-avatar">KM</div>
                                    <div>
                                        <div class="milestone-title">Krista Morales</div>
                                        <div class="team-role">Procurement Lead • Eastern Tech Manufacturing</div>
                                    </div>
                                </div>
                                <div class="utilization-rate">
                                    63%
                                    <span>Available</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Recent Activity</div>
                                <div class="dashboard-card-subtitle">Latest updates across quality inspections, finance, and audit trails</div>
                            </div>
                        </div>

                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-thermometer-three-quarters"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Concrete core temperature logged at 32°C — within curing specification.</div>
                                    <div class="activity-meta">QA/QC Team • Skyline Residences Tower B • 42 minutes ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Progress billing #07 for North Harbor Logistics submitted to Finance.</div>
                                    <div class="activity-meta">Finance Division • Amount: ₱4.8M • 2 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-helmet-safety"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Safety audit checklist for precast installation approved.</div>
                                    <div class="activity-meta">Audit & Compliance • Eastern Tech Manufacturing Plant • Yesterday</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>

</html>