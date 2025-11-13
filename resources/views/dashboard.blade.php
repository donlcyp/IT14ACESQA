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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }
        
        /* When sidebar is hidden on desktop */
        .main-content.sidebar-closed { 
            margin-left: 0; 
        }
        
        /* Desktop: Reserve space for sidebar */
        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }
        
        /* Mobile: Sidebar overlays, no margin */
        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0 !important; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0 !important; 
            }
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
            background-color: transparent;
            color: #047857;
        }

        .status-badge.warning {
            background-color: transparent;
            color: #a16207;
        }

        .status-badge.info {
            background-color: transparent;
            color: #1d4ed8;
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
                                <div class="dashboard-card-subtitle">Projects currently in execution with status</div>
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
                                    <td>J. Ramos</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="dashboard-card half">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Project Material Management</div>
                                <div class="dashboard-card-subtitle">Recent project materials and inspections</div>
                            </div>
                            <a class="view-link" href="{{ route('project-material-management') }}">
                                View all
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Client</th>
                                    <th>Inspector</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>North Harbor Logistics Center</td>
                                    <td>TransPhil Industries</td>
                                    <td>D. Lim</td>
                                    <td>2 hours ago</td>
                                </tr>
                                <tr>
                                    <td>Skyline Residences Tower B</td>
                                    <td>Vision City Homes</td>
                                    <td>R. Santos</td>
                                    <td>5 hours ago</td>
                                </tr>
                                <tr>
                                    <td>Eastern Tech Manufacturing Plant</td>
                                    <td>ETM Group</td>
                                    <td>J. Ramos</td>
                                    <td>1 day ago</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="dashboard-card half">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Transaction Reminders</div>
                                <div class="dashboard-card-subtitle">Pending approvals and unpaid invoices</div>
                            </div>
                            <a class="view-link" href="{{ route('transaction') }}">
                                View all
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>PO ID</th>
                                    <th>Amount (₱)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV003</td>
                                    <td>P0003</td>
                                    <td>₱7,000</td>
                                    <td>
                                        <span class="status-badge warning">Unpaid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>INV002</td>
                                    <td>P0002</td>
                                    <td>₱3,200</td>
                                    <td>
                                        <span class="status-badge warning">Unpaid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>INV004</td>
                                    <td>P0004</td>
                                    <td>₱12,500</td>
                                    <td>
                                        <span class="status-badge info">Pending Approval</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="dashboard-card full">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-title">Finance Summary</div>
                                <div class="dashboard-card-subtitle">Financial overview and key metrics</div>
                            </div>
                            <a class="view-link" href="{{ route('finance') }}">
                                View all
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <table class="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Metric</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Revenue</td>
                                    <td>₱5,718,923</td>
                                    <td>
                                        <span class="status-badge success">On Track</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Total Expenses</td>
                                    <td>₱2,309,895</td>
                                    <td>
                                        <span class="status-badge info">Within Budget</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Net Profit</td>
                                    <td>₱3,409,028</td>
                                    <td>
                                        <span class="status-badge success">Positive</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Total Transactions</td>
                                    <td>23</td>
                                    <td>
                                        <span class="status-badge info">Active</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Average Profit Margin</td>
                                    <td>15%</td>
                                    <td>
                                        <span class="status-badge success">Healthy</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Monthly Revenue</td>
                                    <td>₱476,577</td>
                                    <td>
                                        <span class="status-badge success">On Target</span>
                                    </td>
                                    <td>This Month</td>
                                </tr>
                                <tr>
                                    <td>Monthly Expenses</td>
                                    <td>₱192,491</td>
                                    <td>
                                        <span class="status-badge info">Controlled</span>
                                    </td>
                                    <td>This Month</td>
                                </tr>
                                <tr>
                                    <td>Outstanding Invoices</td>
                                    <td>₱22,700</td>
                                    <td>
                                        <span class="status-badge warning">Pending</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Pending Payments</td>
                                    <td>₱15,200</td>
                                    <td>
                                        <span class="status-badge warning">Awaiting</span>
                                    </td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>Budget Utilization</td>
                                    <td>68%</td>
                                    <td>
                                        <span class="status-badge success">Optimal</span>
                                    </td>
                                    <td>This Month</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
</body>

</html>