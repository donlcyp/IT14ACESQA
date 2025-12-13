<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AJJ CRISBER Engineering Services - Employees</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
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
            --green-600: #1e40af;

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
            background: linear-gradient(135deg, var(--header-bg), #1e40af);
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
        .btn-blue:hover  { background: #1e3a8a; }
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

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }
        .page-title {
            font-family: var(--text-headline-small-bold-font-family);
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        /* Tab Navigation */
        .tab-btn {
            display: none;
        }

        /* Projects Table */
        .projects-table {
            width: 100%;
            border-collapse: collapse;
        }
        .projects-table thead {
            background: var(--accent);
            color: #ffffff;
        }
        .projects-table thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
        }
        .projects-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--black-1);
            font-size: 14px;
        }
        .projects-table tbody tr:last-child td {
            border-bottom: none;
        }
        .projects-table tbody tr:hover {
            background: #f9fafb;
        }

        /* Project Status Badge */
        .project-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .project-status.ongoing {
            background: #dbeafe;
            color: #1e40af;
        }
        .project-status.completed {
            background: #dcfce7;
            color: #166534;
        }

        /* Employees Badge */
        .employees-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 28px;
            height: 28px;
            background: var(--accent);
            color: #ffffff;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 600;
        }

        /* Action Buttons */
        .project-actions {
            display: flex;
            gap: 8px;
        }
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #ffffff;
            color: #374151;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            background: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
        }
        .action-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
        }
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }
        #editAttendanceModal.active {
            z-index: 3000;
        }
        #allProjectsAttendanceModal.active {
            z-index: 2500;
        }
        .modal-content {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: inherit;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--black-1);
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-close:hover {
            color: #111827;
        }

        /* Employee List in Modal */
        .employee-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 20px 0;
            max-height: 400px;
            overflow-y: auto;
        }
        .employee-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
            transition: all 0.2s ease;
        }
        .employee-item:hover {
            background: #f3f4f6;
        }
        .employee-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--accent);
        }
        .employee-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .employee-name {
            font-weight: 500;
            color: #111827;
        }
        .employee-code {
            font-size: 12px;
            color: #6b7280;
        }
        .employee-position {
            font-size: 12px;
            color: #6b7280;
        }

        .page-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-box {
            position: relative;
            width: 280px;
            max-width: 40vw;
        }
        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: var(--shadow-xs);
            outline: none;
        }
        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 14px;
        }
        .filter-select {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            background: #ffffff;
            font-size: 14px;
            min-width: 160px;
            box-shadow: var(--shadow-xs);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .filter-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }

        /* Stat Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            border-radius: 14px;
            padding: 22px;
            box-shadow: var(--shadow-md);
        }
        .stat-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #ffffff;
        }
        .stat-text p {
            margin: 0;
            color: var(--gray-600);
            font-size: 14px;
        }
        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--black-1);
        }
        .stat-total .stat-icon { background: #3b82f6; }
        .stat-idle .stat-icon { background: #9ca3af; }
        .stat-onsite .stat-icon { background: #16a34a; }
        .stat-absent .stat-icon { background: #ef4444; }
        .stat-leave .stat-icon { background: #f97316; }

        /* Actions */
        .actions-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            background: #ffffff;
            color: #111827;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
            font-weight: 500;
        }
        .btn:hover { filter: brightness(0.97); }
        .btn-outline {
            border: 1px solid #d1d5db;
            background: #ffffff;
        }
        .btn-green {
            background: var(--accent);
            color: #ffffff;
        }
        .btn-green:hover { filter: brightness(0.93); }
        .btn-red {
            background: #dc2626;
            color: #ffffff;
        }

        /* Table */
        .table-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }
        .attendance-table thead {
            background: var(--accent);
            color: #ffffff;
        }
        .attendance-table thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
        }
        .attendance-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--black-1);
            font-size: 14px;
        }
        .attendance-table tbody tr:last-child td {
            border-bottom: none;
        }
        .attendance-input {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 10px;
            background: #ffffff;
            font-size: 14px;
        }
        .attendance-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .attendance-actions .btn-save {
            background: var(--accent);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 13px;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
        }
        .attendance-actions .btn-save:hover {
            filter: brightness(0.93);
        }

        /* Badge Styles - Enhanced with backgrounds */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            gap: 6px;
        }
        .status-idle {
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #d1d5db;
        }
        .status-on-site {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }
        .status-on-leave {
            background: #fed7aa;
            color: #92400e;
            border: 1px solid #fdba74;
        }
        .status-absent {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        /* Info Banner */
        .info-banner {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 1px solid #93c5fd;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
        .info-banner-icon {
            color: #2563eb;
            font-size: 20px;
            margin-top: 2px;
        }
        .info-banner-content h4 {
            color: #1e40af;
            font-size: 14px;
            font-weight: 600;
            margin: 0 0 6px 0;
        }
        .info-banner-content p {
            color: #1e40af;
            font-size: 13px;
            margin: 0;
            line-height: 1.6;
        }
        .info-banner-content ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
            color: #1e40af;
            font-size: 13px;
        }
        .info-banner-content ul li {
            margin: 4px 0;
        }
        .status-legend {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Modern Pagination Styles */
        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 20px 0;
            user-select: none;
        }
        .pagination-info {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
        }
        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        .page-btn:hover:not(.disabled):not(.active):not(.ellipsis) {
            background: #f3f4f6;
            color: #111827;
        }
        .page-btn:active:not(.disabled):not(.ellipsis) {
            transform: scale(0.95);
        }
        .page-btn.active {
            background: var(--accent);
            color: #ffffff;
            font-weight: 600;
        }
        .page-btn.disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
        .page-btn.arrow {
            font-size: 20px;
            font-weight: 400;
        }
        .page-btn.ellipsis {
            cursor: default;
            pointer-events: none;
        }
        .page-btn.ellipsis:hover {
            background: transparent;
        }

        /* Quick Punch Employee Cards */
        .quick-punch-section {
            background: white;
            padding: 24px;
            border-radius: 10px;
            border: 1px solid var(--gray-300);
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .quick-punch-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .quick-punch-title h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-900);
        }
        .quick-punch-title p {
            margin: 4px 0 0;
            color: var(--gray-600);
            font-size: 14px;
        }
        .quick-punch-clock {
            text-align: right;
        }
        .quick-punch-clock .time {
            font-size: 28px;
            font-weight: 700;
            color: #16a34a;
        }
        .quick-punch-clock .date {
            font-size: 12px;
            color: var(--gray-600);
        }
        .quick-punch-filters {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }
        .quick-punch-search {
            position: relative;
            flex: 1;
            min-width: 200px;
            max-width: 300px;
        }
        .quick-punch-search input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .quick-punch-search input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.12);
        }
        .quick-punch-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 14px;
        }
        .role-filter-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .role-filter-btn {
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #ffffff;
            color: #374151;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .role-filter-btn:hover {
            background: #f9fafb;
        }
        .role-filter-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #ffffff;
        }
        .employee-punch-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
            max-height: 500px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .employee-punch-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            transition: all 0.2s ease;
        }
        .employee-punch-card:hover {
            background: #f3f4f6;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .employee-punch-card.punched-in {
            border-left: 4px solid #16a34a;
        }
        .employee-punch-card.punched-out {
            border-left: 4px solid #6b7280;
            opacity: 0.7;
        }
        .employee-punch-card.not-punched {
            border-left: 4px solid #3b82f6;
        }
        .punch-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .punch-card-info h4 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: #111827;
        }
        .punch-card-info .role {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }
        .punch-card-status {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }
        .punch-card-status.status-in {
            background: #dcfce7;
            color: #166534;
        }
        .punch-card-status.status-out {
            background: #f3f4f6;
            color: #6b7280;
        }
        .punch-card-status.status-not {
            background: #dbeafe;
            color: #1e40af;
        }
        .punch-card-status.status-late {
            background: #fef3c7;
            color: #92400e;
        }
        .punch-card-times {
            display: flex;
            gap: 16px;
            margin-bottom: 12px;
            font-size: 12px;
        }
        .punch-card-times .time-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .punch-card-times .time-label {
            color: #9ca3af;
            font-weight: 500;
        }
        .punch-card-times .time-value {
            color: #111827;
            font-weight: 600;
        }
        .punch-card-actions {
            display: flex;
            gap: 8px;
        }
        .punch-card-btn {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .punch-card-btn.btn-in {
            background: #16a34a;
            color: white;
        }
        .punch-card-btn.btn-in:hover:not(:disabled) {
            background: #15803d;
        }
        .punch-card-btn.btn-out {
            background: #dc2626;
            color: white;
        }
        .punch-card-btn.btn-out:hover:not(:disabled) {
            background: #b91c1c;
        }
        .punch-card-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .no-employees-found {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }
        .no-employees-found i {
            font-size: 48px;
            margin-bottom: 12px;
            color: #d1d5db;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .page-controls {
                width: 100%;
                justify-content: space-between;
            }
            .search-box { width: 100%; }
            .actions-row {
                flex-wrap: wrap;
            }
            .attendance-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .quick-punch-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .quick-punch-clock {
                text-align: left;
            }
            .quick-punch-search {
                max-width: 100%;
            }
            .employee-punch-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 640px) {
            .page-btn {
                min-width: 32px;
                height: 32px;
                font-size: 13px;
            }
            .page-btn.arrow {
                font-size: 18px;
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
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Page Title -->
                <div class="page-header" style="margin-bottom: 24px;">
                    @if ($isEmployee ?? false)
                        <h1 class="page-title">My Attendance</h1>
                    @else
                        <h1 class="page-title">Project Employee Assignments</h1>
                    @endif
                </div>

                @if ($isEmployee ?? false)
                    <!-- EMPLOYEE VIEW -->
                    
                    <!-- Employee Info Card -->
                    <div style="background: white; padding: 24px; border-radius: 10px; border: 1px solid var(--gray-300); margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                            <div>
                                <h2 style="margin: 0; font-size: 20px; font-weight: 700; color: var(--gray-900);">{{ $currentEmployee->f_name }} {{ $currentEmployee->l_name }}</h2>
                                <p style="margin: 4px 0 0; color: var(--gray-600); font-size: 14px;">Position: <strong>{{ $currentEmployee->position }}</strong></p>
                                @if ($assignedProject)
                                    <p style="margin: 4px 0 0; color: var(--gray-600); font-size: 14px;">Project: <strong>{{ $assignedProject->project_name }}</strong></p>
                                @endif
                            </div>
                            <div style="text-align: right;">
                                <div style="font-size: 28px; font-weight: 700; color: #16a34a;" id="clockTime">--:--:--</div>
                                <div style="font-size: 12px; color: var(--gray-600);" id="clockDate">Today</div>
                            </div>
                        </div>

                        <!-- Punch In/Out Buttons for Employee -->
                        <div style="display: flex; gap: 10px;">
                            <button id="punchInBtn" class="btn" style="flex: 1; background: #16a34a; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s;" onclick="performEmployeePunchIn()">
                                <i class="fas fa-arrow-right"></i> PUNCH IN
                            </button>
                            <button id="punchOutBtn" class="btn" style="flex: 1; background: #dc2626; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s;" onclick="performEmployeePunchOut()">
                                <i class="fas fa-arrow-left"></i> PUNCH OUT
                            </button>
                        </div>

                        <!-- Punch Status Display -->
                        <div style="margin-top: 20px; padding: 15px; background: #f9fafb; border-radius: 6px; border-left: 4px solid #3b82f6;">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                                <div>
                                    <div style="font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Status</div>
                                    <div style="font-size: 16px; font-weight: 700; color: #3b82f6;" id="punchStatus">Not Punched</div>
                                </div>
                                <div>
                                    <div style="font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Punch In Time</div>
                                    <div style="font-size: 16px; font-weight: 700; color: var(--gray-900);" id="punchInDisplay">—</div>
                                </div>
                                <div>
                                    <div style="font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Punch Out Time</div>
                                    <div style="font-size: 16px; font-weight: 700; color: var(--gray-900);" id="punchOutDisplay">—</div>
                                </div>
                                <div>
                                    <div style="font-size: 12px; color: var(--gray-600); font-weight: 600; margin-bottom: 4px;">Late Status</div>
                                    <div style="font-size: 16px; font-weight: 700; color: #dc2626;" id="lateStatus">On Time</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Statistics -->
                    <div class="stats-grid">
                        <div class="stat-card stat-total">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-calendar"></i></div>
                                <div class="stat-text">
                                    <p>Total Days</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['total_days'] }}</span>
                        </div>
                        <div class="stat-card stat-onsite">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-check"></i></div>
                                <div class="stat-text">
                                    <p>On Site</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['on_site'] }}</span>
                        </div>
                        <div class="stat-card stat-absent">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-user-times"></i></div>
                                <div class="stat-text">
                                    <p>Absent</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['absent'] }}</span>
                        </div>
                        <div class="stat-card stat-leave">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                                <div class="stat-text">
                                    <p>On Leave</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['on_leave'] }}</span>
                        </div>
                        <div class="stat-card stat-absent">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <div class="stat-text">
                                    <p>Late Arrivals</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['late_count'] }}</span>
                        </div>
                    </div>

                    <!-- Recent Attendance Records -->
                    <div class="table-card">
                        <div style="padding: 20px; border-bottom: 1px solid var(--gray-300);">
                            <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: var(--gray-900);">Recent Attendance</h3>
                        </div>
                        <table class="projects-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Late</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentRecords as $record)
                                    <tr>
                                        <td>{{ $record->date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="project-status {{ strtolower(str_replace(' ', '-', $record->attendance_status)) }}">
                                                {{ $record->attendance_status }}
                                            </span>
                                        </td>
                                        <td>{{ $record->punch_in_time ? $record->punch_in_time->format('H:i:s') : '—' }}</td>
                                        <td>{{ $record->punch_out_time ? $record->punch_out_time->format('H:i:s') : '—' }}</td>
                                        <td>
                                            @if ($record->is_late)
                                                <span style="color: #dc2626; font-weight: 600;">Yes ({{ $record->late_minutes }} min)</span>
                                            @else
                                                <span style="color: #16a34a; font-weight: 600;">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 20px; color: var(--gray-600);">No attendance records yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                @else
                    <!-- ADMIN/PM VIEW -->
                    
                    <!-- Punch In/Out Section -->
                    <!-- Quick Punch In/Out Section with Employee Cards -->
                    <div class="quick-punch-section">
                        <div class="quick-punch-header">
                            <div class="quick-punch-title">
                                <h2><i class="fas fa-clock" style="margin-right: 8px; color: var(--accent);"></i>Quick Punch In/Out</h2>
                                <p>Click on an employee to record their attendance instantly</p>
                            </div>
                            <div class="quick-punch-clock">
                                <div class="time" id="clockTime">--:--:--</div>
                                <div class="date" id="clockDate">Today</div>
                            </div>
                        </div>

                        <!-- Search and Filter -->
                        <div class="quick-punch-filters">
                            <div class="quick-punch-search">
                                <i class="fas fa-search"></i>
                                <input type="text" id="employeeSearchInput" placeholder="Search employee name..." autocomplete="off">
                            </div>
                            <div class="role-filter-tabs">
                                <button class="role-filter-btn active" data-role="all">All</button>
                                @php
                                    $roles = $allEmployees->pluck('position')->unique()->filter()->values();
                                @endphp
                                @foreach($roles as $role)
                                    <button class="role-filter-btn" data-role="{{ $role }}">{{ $role }}</button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Employee Cards Grid -->
                        <div class="employee-punch-grid" id="employeePunchGrid">
                            @foreach($allEmployees as $emp)
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $todayAttendance = \App\Models\EmployeeAttendance::where('employee_id', $emp->id)
                                        ->whereDate('date', $today)
                                        ->first();
                                    $isPunchedIn = $todayAttendance && $todayAttendance->punch_in_time && !$todayAttendance->punch_out_time;
                                    $isPunchedOut = $todayAttendance && $todayAttendance->punch_out_time;
                                    $isLate = $todayAttendance && $todayAttendance->is_late;
                                    $cardClass = $isPunchedOut ? 'punched-out' : ($isPunchedIn ? 'punched-in' : 'not-punched');
                                    $statusClass = $isPunchedOut ? 'status-out' : ($isPunchedIn ? ($isLate ? 'status-late' : 'status-in') : 'status-not');
                                    $statusText = $isPunchedOut ? 'Punched Out' : ($isPunchedIn ? ($isLate ? 'Late' : 'On Site') : 'Not Punched');
                                @endphp
                                <div class="employee-punch-card {{ $cardClass }}" 
                                     data-employee-id="{{ $emp->id }}" 
                                     data-employee-name="{{ strtolower($emp->f_name . ' ' . $emp->l_name) }}"
                                     data-employee-role="{{ $emp->position }}">
                                    <div class="punch-card-header">
                                        <div class="punch-card-info">
                                            <h4>{{ $emp->f_name }} {{ $emp->l_name }}</h4>
                                            <div class="role">{{ $emp->position }}</div>
                                        </div>
                                        <span class="punch-card-status {{ $statusClass }}" id="status-{{ $emp->id }}">
                                            @if($isPunchedIn && !$isPunchedOut)
                                                <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            @endif
                                            {{ $statusText }}
                                        </span>
                                    </div>
                                    <div class="punch-card-times">
                                        <div class="time-item">
                                            <span class="time-label">In</span>
                                            <span class="time-value" id="in-time-{{ $emp->id }}">
                                                {{ $todayAttendance && $todayAttendance->punch_in_time ? $todayAttendance->punch_in_time->format('h:i A') : '—' }}
                                            </span>
                                        </div>
                                        <div class="time-item">
                                            <span class="time-label">Out</span>
                                            <span class="time-value" id="out-time-{{ $emp->id }}">
                                                {{ $todayAttendance && $todayAttendance->punch_out_time ? $todayAttendance->punch_out_time->format('h:i A') : '—' }}
                                            </span>
                                        </div>
                                        @if($todayAttendance && $todayAttendance->is_late)
                                            <div class="time-item">
                                                <span class="time-label">Late</span>
                                                <span class="time-value" style="color: #dc2626;">{{ $todayAttendance->late_minutes }} min</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="punch-card-actions">
                                        <button class="punch-card-btn btn-in" 
                                                onclick="cardPunchIn({{ $emp->id }})" 
                                                id="btn-in-{{ $emp->id }}"
                                                {{ $isPunchedIn || $isPunchedOut ? 'disabled' : '' }}>
                                            <i class="fas fa-arrow-right"></i> Punch In
                                        </button>
                                        <button class="punch-card-btn btn-out" 
                                                onclick="cardPunchOut({{ $emp->id }})" 
                                                id="btn-out-{{ $emp->id }}"
                                                {{ !$isPunchedIn || $isPunchedOut ? 'disabled' : '' }}>
                                            <i class="fas fa-arrow-left"></i> Punch Out
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="no-employees-found" id="noEmployeesFound" style="display: none;">
                                <i class="fas fa-search"></i>
                                <p>No employees found matching your search</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden select for backward compatibility -->
                    <select id="punchEmployee" style="display: none;">
                        <option value="">-- Choose Employee --</option>
                        @foreach ($allEmployees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->f_name }} {{ $emp->l_name }} ({{ $emp->position }})</option>
                        @endforeach
                    </select>
                    <div id="punchStatus" style="display: none;">Not Punched</div>
                    <div id="punchInDisplay" style="display: none;">—</div>
                    <div id="punchOutDisplay" style="display: none;">—</div>
                    <div id="lateStatus" style="display: none;">On Time</div>
                    <button id="punchInBtn" style="display: none;"></button>
                    <button id="punchOutBtn" style="display: none;"></button>

                    <!-- Projects Tab -->

                    @if(auth()->check() && auth()->user()->role === 'OWNER')
                    <div class="stats-grid">
                        <div class="stat-card stat-total">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-users"></i></div>
                                <div class="stat-text">
                                    <p>Total Employees</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['total'] }}</span>
                        </div>
                        <div class="stat-card stat-idle">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                                <div class="stat-text">
                                    <p>Idle (No Status)</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['idle'] }}</span>
                        </div>
                        <div class="stat-card stat-onsite">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-check"></i></div>
                                <div class="stat-text">
                                    <p>On Site</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['on_site'] }}</span>
                        </div>
                        <div class="stat-card stat-absent">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-user-times"></i></div>
                                <div class="stat-text">
                                    <p>Absent</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['absent'] }}</span>
                        </div>
                        <div class="stat-card stat-leave">
                            <div class="stat-left">
                                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                                <div class="stat-text">
                                    <p>On Leave</p>
                                </div>
                            </div>
                            <span class="stat-value">{{ $stats['on_leave'] }}</span>
                        </div>
                    </div>
                    @endif
                @endif
                
                @if(auth()->check() && auth()->user()->role === 'OWNER')
                <div class="table-card">
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Client</th>
                                <th>Project Lead</th>
                                <th>Status</th>
                                <th>Employees Assigned</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                                <tr>
                                    <td><strong>{{ $project->project_name }}</strong></td>
                                    <td>{{ $project->client_full_name }}</td>
                                    <td>{{ $project->lead_full_name }}</td>
                                    <td>
                                        <span class="project-status {{ strtolower($project->status) }}">
                                            {{ $project->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="employees-badge">{{ $project->employees->count() }}</span>
                                    </td>
                                    <td>
                                        <div class="project-actions">
                                            <button class="action-btn" onclick="viewProjectEmployees({{ $project->id }})">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding: 24px; color: #6b7280;">
                                        No projects available. Create a project from the Projects page to get started.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
                </div>

            </section>
        </main>
    </div>

    <!-- Edit Attendance Modal -->
    <div id="editAttendanceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Attendance - <span id="editEmployeeName"></span></h2>
                <button class="modal-close" onclick="closeEditAttendanceModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="field" style="margin-bottom: 16px;">
                <label>Status</label>
                <select id="editStatus" style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; width: 100%; height: 40px;">
                    <option value="Idle">Idle</option>
                    <option value="On Site">On Site</option>
                    <option value="On Leave">On Leave</option>
                    <option value="Absent">Absent</option>
                </select>
            </div>

            <div class="field" style="margin-bottom: 16px;">
                <label>Time In</label>
                <input type="time" id="editTimeIn" style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; width: 100%; height: 40px;" placeholder="">
            </div>

            <div class="field" style="margin-bottom: 16px;">
                <label>Time Out</label>
                <input type="time" id="editTimeOut" style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; width: 100%; height: 40px;" placeholder="">
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button class="btn btn-outline" onclick="closeEditAttendanceModal()">Cancel</button>
                <button class="btn btn-green" onclick="saveAttendanceEdit()">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>

    <!-- View Employees Modal -->
    <div id="viewEmployeesModal" class="modal">
        <div class="modal-content" style="max-width: 1000px; max-height: 80vh; overflow-y: auto;">
            <div class="modal-header">
                <h2 class="modal-title">Project Employees - <span id="viewModalProjectName"></span></h2>
                <button class="modal-close" onclick="closeViewModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Tab Navigation -->
            <div style="display: flex; gap: 8px; margin-bottom: 20px; border-bottom: 1px solid #e5e7eb;">
                <button onclick="switchViewTab('assigned')" id="tab-assigned" style="padding: 10px 16px; border: none; background: none; cursor: pointer; font-weight: 500; color: var(--accent); border-bottom: 3px solid var(--accent); transition: all 0.2s;">
                    <i class="fas fa-users"></i> Assigned Employees
                </button>
                <button onclick="switchViewTab('attendance')" id="tab-attendance" style="padding: 10px 16px; border: none; background: none; cursor: pointer; font-weight: 500; color: #6b7280; border-bottom: 3px solid transparent; transition: all 0.2s;">
                    <i class="fas fa-calendar-check"></i> Daily Attendance
                </button>
            </div>

            <!-- Assigned Employees Tab -->
            <div id="assigned-content" style="display: block;">
                <div id="employeesView" style="display: flex; flex-direction: column; gap: 8px;">
                    <!-- Populated by JavaScript -->
                </div>
            </div>

            <!-- Daily Attendance Tab -->
            <div id="attendance-content" style="display: none; overflow-x: auto;">
                <table class="attendance-table" style="min-width: 100%;">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th style="min-width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceTableBody">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button class="btn btn-outline" onclick="closeViewModal()">Close</button>
                <button class="btn btn-primary" onclick="viewAllProjectsAttendance()">
                    <i class="fas fa-history"></i> View All
                </button>
            </div>
        </div>
    </div>

    <!-- View All Projects Attendance Modal -->
    <div id="allProjectsAttendanceModal" class="modal">
        <div class="modal-content" style="max-width: 1000px; max-height: 85vh; overflow-y: auto;">
            <div class="modal-header">
                <h2 class="modal-title">All Projects - Daily Attendance History</h2>
                <button class="modal-close" onclick="closeAllProjectsAttendanceModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Date Filter -->
            <div style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; align-items: center;">
                <label style="font-weight: 500; color: #111827;">Filter by Date:</label>
                <input type="date" id="attendanceDateFilter" style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; height: 40px;">
                <button class="action-btn" onclick="clearDateFilter()" style="background: #f3f4f6; color: #374151;">
                    <i class="fas fa-times"></i> Clear
                </button>
            </div>

            <!-- Status Filter -->
            <div style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;">
                <button class="action-btn" onclick="filterAttendanceStatus('All')" id="filter-All" style="background: var(--accent); color: #fff; border-color: var(--accent);">
                    <i class="fas fa-list"></i> All
                </button>
                <button class="action-btn" onclick="filterAttendanceStatus('On Site')" id="filter-On Site">
                    <i class="fas fa-check"></i> On Site
                </button>
                <button class="action-btn" onclick="filterAttendanceStatus('On Leave')" id="filter-On Leave">
                    <i class="fas fa-clock"></i> On Leave
                </button>
                <button class="action-btn" onclick="filterAttendanceStatus('Absent')" id="filter-Absent">
                    <i class="fas fa-user-times"></i> Absent
                </button>
                <button class="action-btn" onclick="filterAttendanceStatus('Idle')" id="filter-Idle">
                    <i class="fas fa-hourglass-half"></i> Idle
                </button>
            </div>

            <!-- Attendance Table -->
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                    </tr>
                </thead>
                <tbody id="allAttendanceTableBody">
                    <!-- Populated by JavaScript -->
                </tbody>
            </table>

            <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button class="btn btn-outline" onclick="closeAllProjectsAttendanceModal()">Close</button>
            </div>
        </div>
    </div>

    @include('partials.sidebar-js')

    <script>
        let currentProjectId = null;
        let currentProjectStatus = null;
        let allEmployees = {!! json_encode($allEmployees ?? []) !!};
        let projectEmployees = {!! json_encode($projectEmployees ?? []) !!};
        let projectNames = {!! json_encode(($projects ?? collect())->pluck('project_name','id')) !!};
        let canManage = {{ auth()->user()->canManageProjectEmployees() ? 'true' : 'false' }};

        function openEmployeeModal(projectId, projectName, projectStatus) {
            if (!canManage) {
                alert('You do not have permission to manage project employees.');
                return;
            }

            currentProjectId = projectId;
            currentProjectStatus = projectStatus;
            document.getElementById('modalProjectName').textContent = projectName;

            // Show warning if project is completed
            if (projectStatus.toLowerCase() === 'completed') {
                document.getElementById('modalWarning').style.display = 'flex';
            } else {
                document.getElementById('modalWarning').style.display = 'none';
            }

            // Load and display employees
            loadEmployeesForModal(projectId);
            document.getElementById('employeeModal').classList.add('active');
        }

        function closeEmployeeModal() {
            document.getElementById('employeeModal').classList.remove('active');
            currentProjectId = null;
        }

        function loadEmployeesForModal(projectId) {
            const employeeList = document.getElementById('employeeList');
            const assignedEmployeeIds = projectEmployees[projectId] || [];

            employeeList.innerHTML = '';

            allEmployees.forEach(employee => {
                const isAssigned = assignedEmployeeIds.includes(employee.id);
                const isAssignedToOtherProject = employee.assigned_to_other_project && !isAssigned;

                const employeeItem = document.createElement('div');
                employeeItem.className = 'employee-item';
                employeeItem.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 12px; flex: 1;">
                        <input 
                            type="checkbox" 
                            value="${employee.id}"
                            ${isAssigned ? 'checked' : ''}
                            ${isAssignedToOtherProject ? 'disabled' : ''}
                            class="employee-checkbox"
                        >
                        <div class="employee-info">
                            <div class="employee-name">${employee.f_name} ${employee.l_name}</div>
                            <div class="employee-code">EMP${String(employee.id).padStart(3, '0')}</div>
                            <div class="employee-position">${employee.position || 'No Position'}</div>
                            ${isAssignedToOtherProject ? '<div style="color: #dc2626; font-size: 11px; font-weight: 600;">Assigned to other active project</div>' : ''}
                        </div>
                    </div>
                `;
                employeeList.appendChild(employeeItem);
            });
        }

        function saveEmployeeAssignments() {
            const checkboxes = document.querySelectorAll('.employee-checkbox:not(:disabled)');
            const selectedEmployeeIds = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => parseInt(cb.value));

            if (selectedEmployeeIds.length === 0) {
                alert('Please select at least one employee to assign.');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            if (!csrfToken) {
                alert('CSRF token not found. Please refresh the page and try again.');
                console.error('CSRF token missing');
                return;
            }

            console.log('Sending request to:', `/api/projects/${currentProjectId}/employees`);
            console.log('Employee IDs:', selectedEmployeeIds);
            console.log('CSRF Token:', csrfToken);

            fetch(`/api/projects/${currentProjectId}/employees`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    employee_ids: selectedEmployeeIds
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                // Check if response is actually JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        console.error('Non-JSON response received:', text);
                        throw new Error('Server returned non-JSON response. Status: ' + response.status);
                    });
                }
                
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || `HTTP error! status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    alert('Employees assigned successfully!');
                    closeEmployeeModal();
                    location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Failed to assign employees'));
                }
            })
            .catch(error => {
                console.error('Full error:', error);
                alert('An error occurred: ' + error.message);
            });
        }

        function viewProjectEmployees(projectId) {
            const assignedEmployeeIds = projectEmployees[projectId] || [];
            const projectName = event.target.closest('tr').querySelector('td strong').textContent;
            
            document.getElementById('viewModalProjectName').textContent = projectName;

            // Load assigned employees
            const employeesView = document.getElementById('employeesView');
            employeesView.innerHTML = '';

            if (assignedEmployeeIds.length === 0) {
                employeesView.innerHTML = '<p style="color: #6b7280; text-align: center;">No employees assigned to this project.</p>';
            } else {
                assignedEmployeeIds.forEach(employeeId => {
                    const employee = allEmployees.find(e => e.id === employeeId);
                    if (employee) {
                        const employeeView = document.createElement('div');
                        employeeView.style.cssText = 'padding: 12px; background: #f9fafb; border-radius: 8px; border-left: 3px solid var(--accent);';
                        employeeView.innerHTML = `
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div>
                                    <div style="font-weight: 500; color: #111827;">${employee.f_name} ${employee.l_name}</div>
                                    <div style="font-size: 13px; color: #6b7280;">EMP${String(employee.id).padStart(3, '0')} • ${employee.position || 'No Position'}</div>
                                </div>
                            </div>
                        `;
                        employeesView.appendChild(employeeView);
                    }
                });
            }

            // Load attendance for assigned employees
            loadAttendanceForEmployees(assignedEmployeeIds);

            // Reset tab to assigned employees
            switchViewTab('assigned');

            document.getElementById('viewEmployeesModal').classList.add('active');
        }

        function switchViewTab(tabName) {
            // Hide all tabs
            document.getElementById('assigned-content').style.display = tabName === 'assigned' ? 'block' : 'none';
            document.getElementById('attendance-content').style.display = tabName === 'attendance' ? 'block' : 'none';

            // Update tab buttons
            const assignedBtn = document.getElementById('tab-assigned');
            const attendanceBtn = document.getElementById('tab-attendance');

            if (tabName === 'assigned') {
                assignedBtn.style.cssText = 'padding: 10px 16px; border: none; background: none; cursor: pointer; font-weight: 500; color: var(--accent); border-bottom: 3px solid var(--accent); transition: all 0.2s;';
                attendanceBtn.style.cssText = 'padding: 10px 16px; border: none; background: none; cursor: pointer; font-weight: 500; color: #6b7280; border-bottom: 3px solid transparent; transition: all 0.2s;';
            } else {
                assignedBtn.style.cssText = 'padding: 10px 16px; border: none; background: none; cursor: pointer; font-weight: 500; color: #6b7280; border-bottom: 3px solid transparent; transition: all 0.2s;';
                attendanceBtn.style.cssText = 'padding: 10px 16px; border: none; background: none; cursor: pointer; font-weight: 500; color: var(--accent); border-bottom: 3px solid var(--accent); transition: all 0.2s;';
            }
        }

        function loadAttendanceForEmployees(employeeIds) {
            const tableBody = document.getElementById('attendanceTableBody');
            tableBody.innerHTML = '';

            if (employeeIds.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 24px; color: #6b7280;">No employees assigned to view attendance.</td></tr>';
                return;
            }

            let hasRecords = false;
            const attendanceRows = [];

            // Collect all attendance records for assigned employees
            employeeIds.forEach(employeeId => {
                const employee = allEmployees.find(e => e.id === employeeId);
                
                if (employee) {
                    console.log(`Employee: ${employee.f_name} ${employee.l_name}`, employee.attendance_records);
                    
                    if (employee.attendance_records && employee.attendance_records.length > 0) {
                        employee.attendance_records.forEach(record => {
                            hasRecords = true;
                            const statusClass = getStatusClass(record.status);
                            
                            attendanceRows.push({
                                employeeId: record.employee_id,
                                name: `${record.first_name} ${record.last_name}`,
                                status: record.status,
                                statusClass: statusClass,
                                date: record.attendance_date || '—',
                                timeIn: record.time_in || '—',
                                timeOut: record.time_out || '—'
                            });
                        });
                    }
                }
            });

            // Sort by date (newest first)
            attendanceRows.sort((a, b) => {
                if (a.date === '—' || b.date === '—') return 0;
                return new Date(b.date) - new Date(a.date);
            });

            // Render rows
            attendanceRows.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.name}</td>
                    <td><span class="status-badge ${row.statusClass}">${row.status}</span></td>
                    <td>${row.date}</td>
                    <td>${row.timeIn}</td>
                    <td>${row.timeOut}</td>
                    <td>
                        <button class="action-btn" onclick="openEditAttendanceModal(${row.employeeId}, '${row.name}', '${row.status}', '${row.timeIn}', '${row.timeOut}')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </td>
                `;
                tableBody.appendChild(tr);
            });

            if (!hasRecords) {
                console.warn('No attendance records found for employees:', employeeIds);
                tableBody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 24px; color: #6b7280;">No attendance records for assigned employees.</td></tr>';
            }
        }

        function getStatusClass(status) {
            switch(status) {
                case 'Idle': return 'status-idle';
                case 'On Site': return 'status-on-site';
                case 'On Leave': return 'status-on-leave';
                case 'Absent': return 'status-absent';
                default: return 'status-idle';
            }
        }

        function formatDate(dateString) {
            if (!dateString) return null;
            try {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
            } catch (e) {
                return dateString;
            }
        }

        // Edit Attendance Functions
        let currentEditEmployeeId = null;

        function openEditAttendanceModal(employeeId, employeeName, status, timeIn, timeOut) {
            currentEditEmployeeId = employeeId;
            document.getElementById('editEmployeeName').textContent = employeeName;
            document.getElementById('editStatus').value = 'Idle'; // Always default to Idle
            document.getElementById('editTimeIn').value = ''; // Keep empty
            document.getElementById('editTimeOut').value = ''; // Keep empty
            
            document.getElementById('editAttendanceModal').classList.add('active');
        }

        function closeEditAttendanceModal() {
            document.getElementById('editAttendanceModal').classList.remove('active');
            currentEditEmployeeId = null;
        }

        function saveAttendanceEdit() {
            const status = document.getElementById('editStatus').value;
            const timeIn = document.getElementById('editTimeIn').value;
            const timeOut = document.getElementById('editTimeOut').value;

            if (!currentEditEmployeeId) {
                alert('Error: Employee ID not found');
                return;
            }

            // Send update to server
            fetch(`/employee-attendance/${currentEditEmployeeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: status,
                    time_in: timeIn || null,
                    time_out: timeOut || null,
                    attendance_date: new Date().toISOString().split('T')[0]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message) {
                    alert('Attendance updated successfully!');
                    closeEditAttendanceModal();
                    location.reload();
                } else {
                    alert('Error updating attendance');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating attendance');
            });
        }

        function closeViewModal() {
            document.getElementById('viewEmployeesModal').classList.remove('active');
        }

        // View All Projects Attendance
        let currentAttendanceFilter = 'All';
        let currentDateFilter = '';

        function viewAllProjectsAttendance() {
            currentAttendanceFilter = 'All';
            currentDateFilter = '';
            document.getElementById('attendanceDateFilter').value = '';
            loadAllProjectsAttendance();
            document.getElementById('allProjectsAttendanceModal').classList.add('active');
        }

        function closeAllProjectsAttendanceModal() {
            document.getElementById('allProjectsAttendanceModal').classList.remove('active');
        }

        function loadAllProjectsAttendance() {
            const tableBody = document.getElementById('allAttendanceTableBody');
            tableBody.innerHTML = '';

            const rows = [];

            // Collect attendance from all projects
            Object.keys(projectEmployees).forEach(projectId => {
                const employeeIds = projectEmployees[projectId] || [];
                
                employeeIds.forEach(employeeId => {
                    const employee = allEmployees.find(e => e.id === employeeId);
                    
                    if (employee && employee.attendance_records && employee.attendance_records.length > 0) {
                        employee.attendance_records.forEach(record => {
                            const projectName = projectNames[String(projectId)] || projectNames[Number(projectId)] || `Project ${projectId}`;
                            
                            rows.push({
                                projectName: projectName,
                                employeeName: `${record.f_name} ${record.l_name}`,
                                status: record.status,
                                statusClass: getStatusClass(record.status),
                                date: record.attendance_date || '—',
                                timeIn: record.time_in || '—',
                                timeOut: record.time_out || '—'
                            });
                        });
                    }
                });
            });

            // Apply status filter
            let filtered = currentAttendanceFilter === 'All' 
                ? rows 
                : rows.filter(row => row.status === currentAttendanceFilter);

            // Apply date filter
            if (currentDateFilter) {
                filtered = filtered.filter(row => row.date === currentDateFilter);
            }

            if (filtered.length === 0) {
                const filterText = currentDateFilter ? ` on ${currentDateFilter}` : '';
                tableBody.innerHTML = `<tr><td colspan="6" style="text-align: center; padding: 24px; color: #6b7280;">No ${currentAttendanceFilter} records found${filterText}.</td></tr>`;
                return;
            }

            filtered.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.projectName}</td>
                    <td>${row.employeeName}</td>
                    <td><span class="status-badge ${row.statusClass}">${row.status}</span></td>
                    <td>${row.date}</td>
                    <td>${row.timeIn}</td>
                    <td>${row.timeOut}</td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function filterAttendanceStatus(status) {
            currentAttendanceFilter = status;
            
            // Update active button
            document.querySelectorAll('#allProjectsAttendanceModal .action-btn').forEach(btn => {
                btn.style.background = '';
                btn.style.color = '';
                btn.style.borderColor = '';
            });
            document.getElementById(`filter-${status}`).style.background = 'var(--accent)';
            document.getElementById(`filter-${status}`).style.color = '#fff';
            document.getElementById(`filter-${status}`).style.borderColor = 'var(--accent)';
            
            loadAllProjectsAttendance();
        }

        // Date filter event listener
        document.addEventListener('DOMContentLoaded', function() {
            const dateFilter = document.getElementById('attendanceDateFilter');
            if (dateFilter) {
                dateFilter.addEventListener('change', function(e) {
                    currentDateFilter = e.target.value;
                    loadAllProjectsAttendance();
                });
            }
        });

        function clearDateFilter() {
            currentDateFilter = '';
            document.getElementById('attendanceDateFilter').value = '';
            loadAllProjectsAttendance();
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('employeeModal');
            const viewModal = document.getElementById('viewEmployeesModal');
            const editModal = document.getElementById('editAttendanceModal');
            const allProjectsModal = document.getElementById('allProjectsAttendanceModal');
            
            if (event.target === modal) {
                closeEmployeeModal();
            }
            if (event.target === viewModal) {
                closeViewModal();
            }
            if (event.target === editModal) {
                closeEditAttendanceModal();
            }
            if (event.target === allProjectsModal) {
                closeAllProjectsAttendanceModal();
            }
        });

        // ===== PUNCH CLOCK FUNCTIONALITY =====
        
        // Update clock display every second
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', { hour12: false });
            const dateStr = now.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
            
            document.getElementById('clockTime').textContent = timeStr;
            document.getElementById('clockDate').textContent = dateStr;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Load employee punch status if this is an employee view
        const isEmployee = {!! json_encode($isEmployee ?? false) !!};
        if (isEmployee) {
            loadEmployeePunchStatus();
        }

        // Load punch status when employee is selected
        document.getElementById('punchEmployee').addEventListener('change', function() {
            const employeeId = this.value;
            if (employeeId) {
                loadPunchStatus(employeeId);
            } else {
                resetPunchDisplay();
            }
        });

        function resetPunchDisplay() {
            document.getElementById('punchStatus').textContent = 'Not Punched';
            document.getElementById('punchInDisplay').textContent = '—';
            document.getElementById('punchOutDisplay').textContent = '—';
            document.getElementById('lateStatus').textContent = 'On Time';
            document.getElementById('punchInBtn').disabled = false;
            document.getElementById('punchOutBtn').disabled = true;
        }

        function loadPunchStatus(employeeId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-status/${employeeId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load punch status');
                }
                return response.json();
            })
            .then(data => {
                updatePunchDisplay(data);
            })
            .catch(error => {
                console.error('Error loading punch status:', error);
                resetPunchDisplay();
            });
        }

        function updatePunchDisplay(data) {
            const punchStatus = document.getElementById('punchStatus');
            const punchInDisplay = document.getElementById('punchInDisplay');
            const punchOutDisplay = document.getElementById('punchOutDisplay');
            const lateStatus = document.getElementById('lateStatus');
            const punchInBtn = document.getElementById('punchInBtn');
            const punchOutBtn = document.getElementById('punchOutBtn');

            // Update punch in display
            if (data.punch_in_time) {
                const punchInTime = new Date(data.punch_in_time);
                punchInDisplay.textContent = punchInTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
                punchInBtn.disabled = true;
                punchInBtn.style.opacity = '0.5';
                punchOutBtn.disabled = false;
                punchOutBtn.style.opacity = '1';
            } else {
                punchInDisplay.textContent = '—';
                punchInBtn.disabled = false;
                punchInBtn.style.opacity = '1';
                punchOutBtn.disabled = true;
                punchOutBtn.style.opacity = '0.5';
            }

            // Update punch out display
            if (data.punch_out_time) {
                const punchOutTime = new Date(data.punch_out_time);
                punchOutDisplay.textContent = punchOutTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
                punchOutBtn.disabled = true;
                punchOutBtn.style.opacity = '0.5';
            } else {
                punchOutDisplay.textContent = '—';
            }

            // Update status
            if (data.punch_in_time && data.punch_out_time) {
                punchStatus.textContent = 'Punched Out';
                punchStatus.style.color = '#6b7280';
            } else if (data.punch_in_time) {
                punchStatus.textContent = 'Punched In';
                punchStatus.style.color = '#16a34a';
            } else {
                punchStatus.textContent = 'Not Punched';
                punchStatus.style.color = '#3b82f6';
            }

            // Update late status
            if (data.is_late) {
                lateStatus.textContent = `⚠️ LATE - ${data.late_minutes} min`;
                lateStatus.style.color = '#dc2626';
            } else if (data.punch_in_time) {
                lateStatus.textContent = '✓ On Time';
                lateStatus.style.color = '#16a34a';
            } else {
                lateStatus.textContent = 'On Time';
                lateStatus.style.color = '#6b7280';
            }
        }

        // ===== EMPLOYEE PUNCH IN/OUT FUNCTIONS =====
        
        function performEmployeePunchIn() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-in`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch in');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('✓ Punch In Successful!', data.message, 'success');
                    loadEmployeePunchStatus();
                    
                    // If late, show extra notification
                    if (data.is_late) {
                        setTimeout(() => {
                            showNotification('⚠️ Late Notice', `You are ${data.late_minutes} minutes late`, 'warning');
                        }, 500);
                    }
                } else {
                    showNotification('Error', data.message || 'Failed to punch in', 'error');
                }
            })
            .catch(error => {
                console.error('Punch in error:', error);
                showNotification('Error', error.message || 'An error occurred while punching in', 'error');
            });
        }

        function performEmployeePunchOut() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-out`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch out');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('✓ Punch Out Successful!', `Hours worked: ${data.hours_worked.toFixed(2)} hrs`, 'success');
                    loadEmployeePunchStatus();
                } else {
                    showNotification('Error', data.message || 'Failed to punch out', 'error');
                }
            })
            .catch(error => {
                console.error('Punch out error:', error);
                showNotification('Error', error.message || 'An error occurred while punching out', 'error');
            });
        }

        function loadEmployeePunchStatus() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-status`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to load punch status');
                }
                return response.json();
            })
            .then(data => {
                updatePunchDisplay(data);
            })
            .catch(error => {
                console.error('Error loading punch status:', error);
            });
        }

        function performPunchIn() {
            const employeeId = document.getElementById('punchEmployee').value;
            
            if (!employeeId) {
                alert('Please select an employee first');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-in/${employeeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch in');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('✓ Punch In Successful!', data.message, 'success');
                    loadPunchStatus(employeeId);
                    
                    // If late, show extra notification
                    if (data.is_late) {
                        setTimeout(() => {
                            showNotification('⚠️ Late Notice', `You are ${data.late_minutes} minutes late`, 'warning');
                        }, 500);
                    }
                } else {
                    showNotification('Error', data.message || 'Failed to punch in', 'error');
                }
            })
            .catch(error => {
                console.error('Punch in error:', error);
                showNotification('Error', error.message || 'An error occurred while punching in', 'error');
            });
        }

        function performPunchOut() {
            const employeeId = document.getElementById('punchEmployee').value;
            
            if (!employeeId) {
                alert('Please select an employee first');
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            fetch(`/punch-out/${employeeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch out');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('✓ Punch Out Successful!', `Hours worked: ${data.hours_worked.toFixed(2)} hrs`, 'success');
                    loadPunchStatus(employeeId);
                } else {
                    showNotification('Error', data.message || 'Failed to punch out', 'error');
                }
            })
            .catch(error => {
                console.error('Punch out error:', error);
                showNotification('Error', error.message || 'An error occurred while punching out', 'error');
            });
        }

        function showNotification(title, message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? '#dcfce7' : type === 'error' ? '#fee2e2' : type === 'warning' ? '#fef3c7' : '#dbeafe';
            const borderColor = type === 'success' ? '#16a34a' : type === 'error' ? '#dc2626' : type === 'warning' ? '#f59e0b' : '#3b82f6';
            const textColor = type === 'success' ? '#166534' : type === 'error' ? '#7f1d1d' : type === 'warning' ? '#92400e' : '#1e40af';

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${bgColor};
                border-left: 4px solid ${borderColor};
                padding: 16px;
                border-radius: 8px;
                color: ${textColor};
                font-weight: 600;
                z-index: 9999;
                min-width: 300px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            `;

            notification.innerHTML = `
                <div style="font-size: 14px; font-weight: 700;">${title}</div>
                <div style="font-size: 13px; font-weight: 400; margin-top: 4px;">${message}</div>
            `;

            document.body.appendChild(notification);

            // Remove after 4 seconds
            setTimeout(() => {
                notification.style.transition = 'opacity 0.3s ease-out';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // ===== EMPLOYEE CARDS PUNCH FUNCTIONALITY =====
        
        // Search and filter functionality
        const searchInput = document.getElementById('employeeSearchInput');
        const roleFilterBtns = document.querySelectorAll('.role-filter-btn');
        const employeeCards = document.querySelectorAll('.employee-punch-card');
        const noEmployeesFound = document.getElementById('noEmployeesFound');
        
        let currentSearchTerm = '';
        let currentRoleFilter = 'all';

        // Search input handler
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                currentSearchTerm = e.target.value.toLowerCase().trim();
                filterEmployeeCards();
            });
        }

        // Role filter button handlers
        roleFilterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                roleFilterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentRoleFilter = this.dataset.role;
                filterEmployeeCards();
            });
        });

        function filterEmployeeCards() {
            let visibleCount = 0;
            
            employeeCards.forEach(card => {
                const name = card.dataset.employeeName || '';
                const role = card.dataset.employeeRole || '';
                
                const matchesSearch = currentSearchTerm === '' || name.includes(currentSearchTerm);
                const matchesRole = currentRoleFilter === 'all' || role === currentRoleFilter;
                
                if (matchesSearch && matchesRole) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (noEmployeesFound) {
                noEmployeesFound.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Card-based Punch In function
        function cardPunchIn(employeeId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const card = document.querySelector(`.employee-punch-card[data-employee-id="${employeeId}"]`);
            const btnIn = document.getElementById(`btn-in-${employeeId}`);
            const btnOut = document.getElementById(`btn-out-${employeeId}`);
            
            // Disable button while processing
            if (btnIn) btnIn.disabled = true;
            
            fetch(`/punch-in/${employeeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch in');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update card UI
                    updateCardAfterPunchIn(employeeId, data);
                    showNotification('✓ Punch In Successful!', data.message, 'success');
                    
                    // If late, show extra notification
                    if (data.is_late) {
                        setTimeout(() => {
                            showNotification('⚠️ Late Notice', `Employee is ${data.late_minutes} minutes late`, 'warning');
                        }, 500);
                    }
                } else {
                    if (btnIn) btnIn.disabled = false;
                    showNotification('Error', data.message || 'Failed to punch in', 'error');
                }
            })
            .catch(error => {
                console.error('Punch in error:', error);
                if (btnIn) btnIn.disabled = false;
                showNotification('Error', error.message || 'An error occurred while punching in', 'error');
            });
        }

        // Card-based Punch Out function
        function cardPunchOut(employeeId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const btnOut = document.getElementById(`btn-out-${employeeId}`);
            
            // Disable button while processing
            if (btnOut) btnOut.disabled = true;
            
            fetch(`/punch-out/${employeeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to punch out');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update card UI
                    updateCardAfterPunchOut(employeeId, data);
                    showNotification('✓ Punch Out Successful!', `Hours worked: ${data.hours_worked.toFixed(2)} hrs`, 'success');
                } else {
                    if (btnOut) btnOut.disabled = false;
                    showNotification('Error', data.message || 'Failed to punch out', 'error');
                }
            })
            .catch(error => {
                console.error('Punch out error:', error);
                if (btnOut) btnOut.disabled = false;
                showNotification('Error', error.message || 'An error occurred while punching out', 'error');
            });
        }

        function updateCardAfterPunchIn(employeeId, data) {
            const card = document.querySelector(`.employee-punch-card[data-employee-id="${employeeId}"]`);
            const status = document.getElementById(`status-${employeeId}`);
            const inTime = document.getElementById(`in-time-${employeeId}`);
            const btnIn = document.getElementById(`btn-in-${employeeId}`);
            const btnOut = document.getElementById(`btn-out-${employeeId}`);
            
            if (card) {
                card.classList.remove('not-punched', 'punched-out');
                card.classList.add('punched-in');
            }
            
            if (status) {
                status.className = 'punch-card-status ' + (data.is_late ? 'status-late' : 'status-in');
                status.innerHTML = (data.is_late ? '' : '<i class="fas fa-circle" style="font-size: 6px;"></i> ') + (data.is_late ? 'Late' : 'On Site');
            }
            
            if (inTime && data.punch_in_time) {
                const time = new Date(data.punch_in_time);
                inTime.textContent = time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            }
            
            if (btnIn) btnIn.disabled = true;
            if (btnOut) btnOut.disabled = false;
        }

        function updateCardAfterPunchOut(employeeId, data) {
            const card = document.querySelector(`.employee-punch-card[data-employee-id="${employeeId}"]`);
            const status = document.getElementById(`status-${employeeId}`);
            const outTime = document.getElementById(`out-time-${employeeId}`);
            const btnIn = document.getElementById(`btn-in-${employeeId}`);
            const btnOut = document.getElementById(`btn-out-${employeeId}`);
            
            if (card) {
                card.classList.remove('punched-in', 'not-punched');
                card.classList.add('punched-out');
            }
            
            if (status) {
                status.className = 'punch-card-status status-out';
                status.innerHTML = 'Punched Out';
            }
            
            if (outTime && data.punch_out_time) {
                const time = new Date(data.punch_out_time);
                outTime.textContent = time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            }
            
            if (btnIn) btnIn.disabled = true;
            if (btnOut) btnOut.disabled = true;
        }
    </script>