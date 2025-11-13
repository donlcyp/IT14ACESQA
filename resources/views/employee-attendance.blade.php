<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Employees</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
            --white: #ffffff;

            --gray-500: #667085;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;

            --blue-1: var(--accent);
            --blue-600: var(--accent);
            --red-600: #dc2626;
            --green-600: #059669;

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
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Employees Toolbar */
        .employee-header {
            background: white;
            border-radius: 12px;
            padding: 16px 16px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .employee-title {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 20px;
            font-weight: var(--text-headline-small-bold-font-weight);
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }
        .att-toolbar {
            background: white;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 14px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: space-between;
        }
        .att-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .chip-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #fff;
            box-shadow: var(--shadow-xs);
            color: #111827;
        }
        .att-title { font-weight: 600; color: #111827; }
        .action-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }
        .btn-blue  { background: var(--accent); border-color: var(--accent); color:#fff; }
        .btn-green { background: var(--accent); border-color: var(--accent); color:#fff; }
        .btn-red   { background: var(--accent); border-color: var(--accent); color:#fff; }
        .btn-blue:hover  { background: #15803d; }
        .btn-green:hover { background: #15803d; }
        .btn-red:hover   { background: #15803d; }
        .search-box {
            position: relative;
            width: 320px;
            max-width: 40vw;
        }
        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 36px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            outline: none;
            background-color: #fff;
        }
        .search-box .fa-search {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 14px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #111827;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
        }
        .btn:hover { background: #f9fafb; }
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .btn-primary:hover { background: #15803d; }

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

        /* Form Layout */
        .form-wrapper {
            display: none;
            flex-direction: column;
            gap: 20px;
        }
        .form-header {
            background: white;
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .back-btn {
            background: none;
            border: none;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            color: #111827;
        }
        .section-card {
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
        }
        .section-title {
            color: #111827;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .section-note {
            color: #ef4444;
            font-size: 12px;
            margin-bottom: 12px;
        }
        .grid {
            display: grid;
            gap: 12px;
        }
        .grid.cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        .grid.cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .field label {
            font-size: 13px;
            color: #374151;
        }
        .field input, .field select {
            height: 36px;
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #ffffff;
            outline: none;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-success { background: var(--accent); border-color: var(--accent); color: #fff; }
        .btn-success:hover { filter: brightness(0.95); }

        @media (max-width: 1024px) {
            .grid.cols-5, .grid.cols-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
        .employee-table.employees thead th:first-child { border-top-left-radius: 8px; }
        .employee-table.employees thead th:last-child { border-top-right-radius: 8px; }
        .actions {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--gray-700);
        }
        .actions i { cursor: pointer; }

        .employee-table.attendance thead {
            background: var(--red-600);
        }
        .employee-table.attendance thead th:first-child { border-top-left-radius: 8px; }
        .employee-table.attendance thead th:last-child { border-top-right-radius: 8px; }

        /* Status badges */
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-badge.on-leave {
            background: transparent;
            color: #92400e;
        }

        .status-badge.on-site {
            background: transparent;
            color: #065f46;
        }

        .status-badge.absent {
            background: transparent;
            color: #ef4444;
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
                <div class="employee-header">
                    <h1 class="employee-title">Employee Attendance</h1>
                    <div class="toolbar">
                        <button class="btn" title="Options"><i class="fas fa-ellipsis-v"></i></button>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search" />
                        </div>
                        <button class="btn" title="Filters"><i class="fas fa-filter"></i> Filters</button>
                    </div>
                </div>

                <div class="action-row">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> New</button>
                    <button class="btn btn-primary"><i class="fas fa-pen"></i> Update</button>
                    <button class="btn btn-primary"><i class="fas fa-trash"></i> Delete</button>
                </div>

                <div class="employee-card">
                    <table class="employee-table employees">
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
                                <td>EMP003</td>
                                <td>John</td>
                                <td>Doe</td>
                                <td>Project Manager</td>
                                <td><span class="status-badge on-leave">On Leave</span></td>
                                <td>2025-09-26</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>EMP002</td>
                                <td>Mari</td>
                                <td>Lou</td>
                                <td>Construction Worker</td>
                                <td><span class="status-badge on-site">On Site</span></td>
                                <td>2025-09-26</td>
                                <td>7:26 AM PST</td>
                                <td>10:30 PM PST</td>
                            </tr>
                            <tr>
                                <td>EMP001</td>
                                <td>Paul</td>
                                <td>Tan</td>
                                <td>Quality Inspector</td>
                                <td><span class="status-badge absent">Absent</span></td>
                                <td>2025-09-26</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </section>
            </main>
        </div>

        @include('partials.sidebar-js')
    </body>

    </html>