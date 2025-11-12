<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Audit</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #dc2626;
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

            --purple-600: #7c3aed;
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
            background: linear-gradient(135deg, var(--header-bg), #dc2626);
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

        /* Audit Specific Styles */
        .audit-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .audit-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .audit-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .audit-button {
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

        .audit-button:hover {
            opacity: 0.9;
        }

        .audit-button.primary {
            background: var(--blue-600);
            color: white;
        }

        .audit-button.secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .audit-options {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 18px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .audit-options:hover {
            background-color: var(--gray-100);
        }

        /* Audit Cards */
        .audit-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .audit-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        .audit-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .audit-card-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .audit-expand {
            background: none;
            border: none;
            color: var(--gray-600);
            font-size: 16px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }

        .audit-expand:hover {
            background-color: var(--gray-100);
        }

        /* Tables */
        .audit-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .audit-table thead {
            color: white;
        }

        .audit-table thead th {
            padding: 12px 16px;
            text-align: left;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
        }

        .audit-table tbody tr {
            border-bottom: 1px solid var(--gray-200);
        }

        .audit-table tbody tr:last-child {
            border-bottom: none;
        }

        .audit-table tbody td {
            padding: 12px 16px;
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
        }

        .audit-table.approved thead {
            background: var(--blue-600);
        }

        .audit-table.pending thead {
            background: #8b0000;
        }

        .audit-table.logs thead {
            background: var(--green-600);
        }

        /* Status badges */
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.paid {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.unpaid {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Responsive Design */
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

            .audit-actions {
                flex-direction: column;
                gap: 8px;
            }

            .audit-table {
                font-size: 14px;
            }

            .audit-table thead th,
            .audit-table tbody td {
                padding: 8px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
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
                <!-- Audit Header -->
                <div class="audit-header">
                    <h1 class="audit-title">Audit</h1>
                    <div class="audit-actions">
                        <button class="audit-button primary">
                            <i class="fas fa-plus"></i>
                            Add Invoice
                        </button>
                        <button class="audit-button secondary">
                            <i class="fas fa-file-image"></i>
                            Image Reports
                        </button>
                        <button class="audit-options">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <!-- Audit Cards -->
                <div class="audit-cards">
                    <!-- Approved Invoice Card -->
                    <div class="audit-card">
                        <div class="audit-card-header">
                            <h2 class="audit-card-title">Approved Invoice</h2>
                            <button class="audit-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="audit-table approved">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Purchase Order ID</th>
                                    <th>Total Amount (P)</th>
                                    <th>Status</th>
                                    <th>Invoice Date</th>
                                    <th>Verification Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV001</td>
                                    <td>P0001</td>
                                    <td>5000</td>
                                    <td><span class="status-badge paid">Paid</span></td>
                                    <td>2025-01-16</td>
                                    <td>2025-01-16</td>
                                </tr>
                                <tr>
                                    <td>INV002</td>
                                    <td>P0002</td>
                                    <td>3200</td>
                                    <td><span class="status-badge unpaid">Unpaid</span></td>
                                    <td>Vendor Y</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pending Approvals Card -->
                    <div class="audit-card">
                        <div class="audit-card-header">
                            <h2 class="audit-card-title">Pending Approvals</h2>
                            <button class="audit-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="audit-table pending">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Purchase Order ID</th>
                                    <th>Total Amount (P)</th>
                                    <th>Status</th>
                                    <th>Invoice Date</th>
                                    <th>Date of Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV003</td>
                                    <td>P0003</td>
                                    <td>7000</td>
                                    <td><span class="status-badge unpaid">Unpaid</span></td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Audit Logs Card -->
                    <div class="audit-card">
                        <div class="audit-card-header">
                            <h2 class="audit-card-title">Audit Logs</h2>
                            <button class="audit-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="audit-table logs">
                            <thead>
                                <tr>
                                    <th>Log ID</th>
                                    <th>Action</th>
                                    <th>User</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>LOG003</td>
                                    <td>Added Invoice</td>
                                    <td>John Doe</td>
                                    <td>07:00 AM PST, Sep 15, 2025</td>
                                </tr>
                                <tr>
                                    <td>LOG002</td>
                                    <td>Updated Record</td>
                                    <td>Jane Smith</td>
                                    <td>06:45 AM PST, Sep 11, 2025</td>
                                </tr>
                                <tr>
                                    <td>LOG001</td>
                                    <td>Added Invoice</td>
                                    <td>John Doe</td>
                                    <td>12:00 PM PST, Aug 28, 2025</td>
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