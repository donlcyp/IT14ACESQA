<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Quality Assurance</title>
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

        * { box-sizing: border-box; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }

        body { font-family: var(--text-md-normal-font-family); background-color: var(--main-bg); overflow-x: hidden; }

        .dashboard-container { display: flex; min-height: 100vh; }

        .sidebar { width: 280px; background-color: var(--sidebar-bg); padding: 20px; display: flex; flex-direction: column; gap: 30px; position: fixed; height: 100vh; left: 0; top: 0; z-index: 1000; transition: transform 0.3s ease; transform: translateX(-100%); }
        .sidebar.open { transform: translateX(0); }
        .sidebar-header { display: flex; align-items: center; gap: 15px; margin-bottom: 10px; }
        .logo { width: 50px; height: 50px; border-radius: 50%; background-color: white; border: 2px solid #9ca3af; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .logo-img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; display:block; }
        .logo-fallback { width:100%; height:100%; border-radius:50%; display:none; align-items:center; justify-content:center; background:#e5e7eb; color:#111827; font-weight:700; font-family: "Inter", sans-serif; }
        .sidebar-title { font-family: var(--text-headline-small-bold-font-family); font-size: var(--text-headline-small-bold-font-size); font-weight: var(--text-headline-small-bold-font-weight); color: black; }
        .nav-toggle { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .hamburger-menu { background: none; border: none; font-size: 18px; color: var(--gray-700); cursor: pointer; }
        .chevron { font-size: 14px; color: var(--gray-700); }
        .nav-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .nav-item { display: flex; align-items: center; gap: 15px; padding: 12px 16px; border-radius: 8px; text-decoration: none; color: var(--gray-700); font-family: var(--text-md-normal-font-family); font-size: var(--text-md-normal-font-size); transition: all 0.2s ease; position: relative; }
        .nav-item:hover { background-color: rgba(255, 255, 255, 0.3); }
        .nav-item.active { background-color: white; color: black; font-weight: 600; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
        .nav-icon { font-size: 18px; width: 20px; text-align: center; }
        .logout-section { margin-top: auto; padding-top: 20px; }
        .logout-item { display: flex; align-items: center; gap: 15px; padding: 12px 16px; border-radius: 8px; text-decoration: none; color: var(--gray-700); font-family: var(--text-md-normal-font-family); font-size: var(--text-md-normal-font-size); transition: all 0.2s ease; }
        .logout-item:hover { background-color: rgba(255, 255, 255, 0.3); }

        .main-content { flex: 1; margin-left: 0; display: flex; flex-direction: column; min-height: 100vh; width: 100%; }

        .header { background: linear-gradient(135deg, var(--header-bg), #2d3748); padding: 20px 30px; display: flex; align-items: center; gap: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden; }
        .header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent); }
        .header-menu { background: none; border: none; color: white; font-size: 24px; cursor: pointer; padding: 8px; border-radius: 4px; transition: background-color 0.2s ease; }
        .header-menu:hover { background-color: rgba(255, 255, 255, 0.1); }
        .header-title { color: white; font-family: "Zen Dots", sans-serif; font-size: 24px; font-weight: 400; flex: 1; }
        .back-btn { color: white; text-decoration: none; margin-right: 15px; padding: 8px 12px; border-radius: 4px; transition: background-color 0.2s ease; display: inline-flex; align-items: center; gap: 8px; }
        .back-btn:hover { background-color: rgba(255, 255, 255, 0.1); color: white; text-decoration: none; }

        .content-area { flex: 1; padding: 30px; background: linear-gradient(135deg, #f7fafc, #edf2f7); border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }

        .qa-header { background: #f5f5f5; border-radius: 10px; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25); margin-bottom: 30px; padding: 20px; }
        .qa-content { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
        .qa-title-section { flex: 1; display: flex; flex-direction: column; gap: 12px; }
        .project-card { background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; padding:14px; box-shadow: var(--shadow-xs); }
        .project-line-1 { display:flex; align-items:center; gap:8px; }
        .project-title-input { flex:1; background:#f7f7f7; border:1px solid #e5e7eb; border-radius:6px; padding:8px 12px; color:#111827; font-weight:600; }
        .project-subrow { margin-top:8px; display:flex; align-items:center; gap:10px; color:#6b7280; font-size:12px; }
        .inspector-chip { background:#e5e7eb; border-radius:6px; padding:4px 8px; color:#111827; font-size:12px; }
        .qa-title { color: #101828; font-family: var(--text-lg-medium-font-family); font-size: var(--text-lg-medium-font-size); font-weight: var(--text-lg-medium-font-weight); line-height: var(--text-lg-medium-line-height); }
        .qa-actions { display: flex; align-items: center; gap: 16px; }
        .qa-button { background: none; border: none; cursor: pointer; }
        .qa-button-base { display: inline-flex; align-items: center; gap:6px; padding: 8px 12px; border-radius: 8px; background: #fff; box-shadow: var(--shadow-xs); border:1px solid #e5e7eb; font-size: 12px; }
        .qa-button-base.primary { background:#3b82f6; color:#fff; border-color:#3b82f6; }
        .qa-button-base.success { background:#22c55e; color:#fff; border-color:#22c55e; }
        .qa-button-base.danger { background:#ef4444; color:#fff; border-color:#ef4444; }

        .status-tabs-container { margin-bottom: 20px; }
        .status-tabs { display: flex; border-bottom: 3px solid #e5e7eb; background: white; border-radius: 15px 15px 0 0; overflow: hidden; }
        .tab-btn { flex: 1; padding: 16px 24px; background: white; border: none; border-bottom: 3px solid transparent; font-family: 'Inter', sans-serif; font-size: 14px; color: #4b5563; cursor: pointer; transition: all 0.3s; position: relative; }
        .tab-btn:first-child { border-radius: 15px 0 0 0; }
        .tab-btn:last-child { border-radius: 0 15px 0 0; }
        .tab-btn.active { border-bottom-color: #3b82f6; color: #000; font-weight: 600; background: #f9fafb; }
        .tab-btn:hover:not(.active) { background: #f9fafb; }

        .table-card { background:#ffffff; border-radius: 0 0 12px 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow:hidden; border:1px solid #e2e8f0; border-top: none; }
        table { width: 100%; border-collapse: collapse; }
        thead th { background:#f8fafc; color:#111827; font-weight:600; padding:12px; border-bottom:1px solid #e5e7eb; font-size:12px; text-align: left; }
        tbody td { padding:12px; border-bottom:1px solid #e5e7eb; font-size:12px; color:#111827; }
        tbody tr:hover { background:#f9fafb; }
        tbody tr.selected { background:#eef2ff; }
        tbody tr.delete-hover { background:#fee2e2; }

        /* Modal Styles */
        .qa-modal { display:none; position:fixed; inset:0; background: rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index: 2000; opacity:0; transition: opacity .2s ease; }
        .qa-modal.active { display:flex; opacity:1; }
        .qa-modal[aria-hidden="false"] { display:flex; opacity:1; }
        .qa-modal-content { background:#ffffff; border:1px solid #e5e7eb; border-radius:10px; width:100%; max-width:720px; padding:20px; position:relative; box-shadow: var(--shadow-md); max-height: 90vh; overflow-y: auto; }
        .qa-modal-title { font-weight:700; margin-bottom:12px; color:#111827; }
        .qa-form-grid { display:grid; grid-template-columns: 1fr 1fr; gap:12px; }
        .qa-form-field { display:flex; flex-direction:column; gap:6px; }
        .qa-label { font-size:12px; color:#374151; font-weight: 500; }
        .qa-input, .qa-select { border:1px solid #e5e7eb; border-radius:6px; padding:8px 10px; font-size:14px; }
        .qa-input:focus, .qa-select:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .qa-actions-row { display:flex; justify-content:flex-end; gap:8px; margin-top:16px; }
        .btn-sm { display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; cursor:pointer; font-size: 14px; font-weight: 500; transition: all 0.2s; }
        .btn-sm:hover { opacity: 0.9; }
        .btn-sm.primary { background:#3b82f6; color:#fff; border-color:#3b82f6; }
        .btn-sm.ghost { background:#fff; color:#111827; }
        .modal-close { position:absolute; top:10px; right:10px; background:#fff; border:1px solid #e5e7eb; border-radius:6px; padding:6px; cursor:pointer; transition: background 0.2s; }
        .modal-close:hover { background: #f3f4f6; }

        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* New Material Modal Styles */
        .modal-add, .modal-add * { box-sizing: border-box; }
        .modal-add { background: #ffffff; border-radius: 8px; height: 616px; position: relative; width: 1100px; max-width: 95vw; max-height: 90vh; overflow: auto; }
        .container { padding: 32px; width: 100%; height: 616px; position: relative; }
        .container2 { width: 100%; height: 569px; position: relative; }
        .container3 { background: #ffffff; border-radius: 8px; border-style: solid; border-color: #e5e7eb; border-width: 1px; padding: 24px; width: 100%; height: 546px; position: relative; }
        .container4 { width: 100%; height: auto; position: relative; margin-bottom: 16px; }
        .heading { width: 100%; min-height: 28px; position: relative; display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 12px; }
        .modal-head { display: flex; align-items: center; gap: 12px; }
        .modal-icon { width: 36px; height: 36px; border-radius: 10px; background: #eef2ff; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb; }
        .modal-icon i { color: #1f2937; }
        .add-material { color: #111827; text-align: left; font-family: "Inter-Bold", sans-serif; font-size: 18px; line-height: 28px; font-weight: 700; }
        .icon { display: none; }
        .paragraph { display: none; } /* Hide paragraph for now */
        .container5 { width: 100%; display: flex; flex-direction: column; gap: 16px; }
        .container6, .container7, .container8, .container9, .container10 { width: 100%; display: flex; flex-direction: column; gap: 8px; margin: 0; }
        .label { width: 100%; margin: 0; }
        .supplier, .status, .storage-location, .inspector-name, .date-received { color: #374151; font-family: "Inter-Regular", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .input, .input2, .input3 { background: #ffffff; border-radius: 8px; border: 1px solid #d1d5db; padding: 10px 12px; width: 100%; display: flex; align-items: center; }
        .input2 { background: rgba(75, 75, 75, 0.1); }
        .enter-supplier-name, .enter-storage-location, .mm-dd-yyyy { color: #000; font-family: "Inter-Regular", sans-serif; font-size: 16px; line-height: 24px; font-weight: 400; border: none; background: transparent; width: 100%; outline: none; }
        .enter-supplier-name::placeholder, .enter-storage-location::placeholder, .mm-dd-yyyy::placeholder { color: #cccccc; }
        .pending { color: #000000; font-family: "Inter-Regular", sans-serif; font-size: 16px; line-height: 24px; font-weight: 400; }
        .container9 { width: 100%; margin-bottom: 20px; }
        .engr-jeric-santos { color: #000000; font-family: "Inter-Regular", sans-serif; font-size: 14px; line-height: 20px; font-weight: 400; }
        .btns { display: flex; flex-direction: row; gap: 12px; align-items: center; justify-content: flex-end; margin-top: 20px; width: 100%; }
        .button { background: #ffffff; border-radius: 4px; border: 1px solid #e9e9e9; padding: 8px 12px; display: flex; align-items: center; justify-content: center; height: 36px; cursor: pointer; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1); }
        .button2 { color: #313131; font-family: "Inter-Regular", sans-serif; font-size: 14px; line-height: 20px; font-weight: 400; }
        .button3 { background: #1c57b6; border-radius: 4px; padding: 8px 12px; display: flex; align-items: center; justify-content: center; height: 36px; cursor: pointer; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1); }
        .button4 { color: #ffffff; font-family: "Inter-Bold", sans-serif; font-size: 14px; line-height: 20px; font-weight: 700; }
        .container10 { width: 100%; margin-bottom: 20px; }
        .container11 { width: 100%; position: relative; }
        /* prevent right-edge overflow */
        .modal-add .container3, .modal-add-2 .container3 { box-sizing: border-box; overflow: hidden; }
        .modal-add .container3 > *:not(.btns), .modal-add-2 .container3 > *:not(.btns) { max-width: 100%; }
        .button5 { display: none; } /* Hide button5 for now */
        .frame { display: none; } /* Hide frame for now */

        /* Header right action (Step 2) */
        .add-item-btn { background: #9333ea; color: #ffffff; border-radius: 8px; padding: 8px 14px; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; border: none; box-shadow: var(--shadow-xs); }
        .add-item-btn i { font-size: 12px; }

        /* Modal Step 2 Styles */
        .modal-add-2, .modal-add-2 * { box-sizing: border-box; }
        .modal-add-2 { background: #ffffff; border-radius: 8px; height: 616px; position: relative; width: 1100px; max-width: 95vw; max-height: 90vh; overflow: auto; }
        .add-item { color: #ffffff; text-align: center; font-family: "Inter-Regular", sans-serif; font-size: 14px; line-height: 20px; font-weight: 400; }
        .span { display: none; } /* Hide span for now */
        .button { background: #9333ea; border-radius: 8px; padding: 8px 16px; width: 100px; height: 33px; cursor: pointer; margin-bottom: 20px; }
        .container5 { border-radius: 8px; border: 1px solid #e5e7eb; width: 100%; height: 362px; overflow: hidden; margin-bottom: 20px; }
        .container6 { width: 100%; height: 198px; position: relative; }
        .container7 { width: 100%; height: 48.5px; position: relative; }
        .container8 { background: #f9fafb; width: 100%; height: 48.5px; position: relative; display: flex; box-sizing: border-box; padding-right: 8px; }
        .container9 { padding: 12px 24px; width: 240px; height: 49px; position: relative; display: flex; align-items: center; }
        .product { color: #4b5563; font-family: "Inter-Medium", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .container10 { padding: 12px 24px; width: 114px; height: 49px; position: relative; display: flex; align-items: center; justify-content: center; }
        .quantity { color: #4b5563; font-family: "Inter-Medium", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .container11 { padding: 12px 24px; width: 118px; height: 49px; position: relative; display: flex; align-items: center; justify-content: center; }
        .unit-of-measure { color: #4b5563; font-family: "Inter-Medium", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .container12 { padding: 12px 24px; width: 119px; height: 49px; position: relative; display: flex; align-items: center; justify-content: flex-end; }
        .total { color: #4b5563; font-family: "Inter-Medium", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .container13 { padding: 12px 24px; width: 155px; height: 49px; position: relative; display: flex; align-items: center; justify-content: center; }
        .batch-serial-no { color: #4b5563; font-family: "Inter-Medium", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .container14 { padding: 12px 24px; width: 106px; height: 49px; position: relative; display: flex; align-items: center; justify-content: center; }
        .unit-price { color: #4b5563; font-family: "Inter-Medium", sans-serif; font-size: 14px; line-height: 20px; font-weight: 500; }
        .container15 { width: 100%; height: 84px; position: relative; }
        .container16 { border-top: 1px solid #e5e7eb; width: 100%; height: 84px; position: relative; display: flex; align-items: center; box-sizing: border-box; padding-right: 8px; }
        ._0 { color: #000000; font-family: "Inter-Regular", sans-serif; font-size: 16px; line-height: 24px; font-weight: 400; }
        .input2 { background: #ffffff; border-radius: 4px; border: 1px solid #d1d5db; padding: 9px; width: 135px; height: 42px; margin: 0 5px; }
        .input4 { background: #ffffff; border-radius: 4px; border: 1px solid #d1d5db; padding: 9px; width: 218px; height: 42px; margin: 0 5px; }
        .input5 { border-radius: 4px; width: 96px; height: 42px; margin: 0 5px; }
        .input6 { background: #ffffff; border-radius: 4px; border: 1px solid #d1d5db; padding: 9px; width: 177px; height: 42px; margin: 0 5px; }
        .container17 { padding: 16px 8px; width: 40px; height: 75px; position: relative; display: flex; align-items: center; justify-content: center; }
        .button6 { background: transparent; width: 18px; height: 18px; cursor: pointer; }

        /* Additional styles for better input appearance */
        .input input, .input2 input, .input3 input, .input4 input, .input5 select, .input6 input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            font-size: 16px;
            color: #000;
            padding: 0;
        }
        
        .input input::placeholder, .input2 input::placeholder, .input3 input::placeholder, .input4 input::placeholder, .input6 input::placeholder {
            color: #cccccc;
        }
        
        .input5 select {
            color: #000;
            cursor: pointer;
            border: 1px solid #d1d5db;
            background: #ffffff;
            border-radius: 4px;
            padding: 8px;
        }
        
        .input5 select option {
            color: #000;
        }

        /* Fix for date input */
        .input3 input[type="date"] {
            color: #000;
        }

        .input3 input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar { width: 100%; }
            .content-area { padding: 20px; }
            .qa-form-grid { grid-template-columns: 1fr; }
            .qa-actions { flex-wrap: wrap; }
            .status-tabs { flex-direction: column; }
            
            /* Modal responsive styles */
            .modal-add, .modal-add-2 { 
                max-width: 95vw; 
                max-height: 95vh; 
                margin: 20px;
            }
            .container { padding: 20px; }
            .container3 { padding: 15px; }
            .container8 { flex-direction: column; height: auto; }
            .container9, .container10, .container11, .container12, .container13, .container14 { 
                width: 100%; 
                padding: 8px 12px; 
                height: auto; 
            }
            .container16 { flex-direction: column; height: auto; padding: 10px; }
            .input2, .input4, .input5, .input6 { 
                width: 100%; 
                margin: 5px 0; 
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="images/aces-logo.png" alt="ACES logo" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="logo-fallback">ACES</div>
                </div>
                <div class="sidebar-title">ACES</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item"><i class="nav-icon fas fa-smile"></i><span>Dashboard</span></a>
                <a href="{{ route('quality-assurance') }}" class="nav-item active"><i class="nav-icon fas fa-bolt"></i><span>Project Material Management</span></a>
                <a href="{{ route('audit') }}" class="nav-item"><i class="nav-icon fas fa-gavel"></i><span>Audit</span></a>
                <a href="{{ route('finance') }}" class="nav-item"><i class="nav-icon fas fa-chart-bar"></i><span>Finance</span></a>
                <a href="{{ route('projects') }}" class="nav-item"><i class="nav-icon fas fa-tasks"></i><span>Projects</span></a>
                <a href="{{ route('employee-attendance') }}" class="nav-item"><i class="nav-icon fas fa-hard-hat"></i><span>Employee Attendance</span></a>
            </nav>
            <div class="logout-section">
                <a href="#" class="logout-item" onclick="logout()"><i class="nav-icon fas fa-sign-out-alt"></i><span>Log Out</span></a>
            </div>
        </aside>

        <main class="main-content" id="mainContent">
            <header class="header">
                <a href="{{ route('quality-assurance') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to QA Records
                </a>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
                <button class="header-menu" id="headerMenu"><i class="fas fa-bars"></i></button>
            </header>

            <section class="content-area">
                <!-- Breadcrumb -->
                <nav style="margin-bottom: 20px; font-size: 14px; color: #6b7280;">
                    <a href="{{ route('dashboard') }}" style="color: #3b82f6; text-decoration: none;">Dashboard</a>
                    <span style="margin: 0 8px;">></span>
                    <a href="{{ route('quality-assurance') }}" style="color: #3b82f6; text-decoration: none;">Quality Assurance</a>
                    <span style="margin: 0 8px;">></span>
                    <span style="color: #374151;">Material Management</span>
                </nav>

                <!-- Success Message -->
                <div class="alert alert-success" id="successAlert" style="display: none;">
                    Material saved successfully!
                </div>

                <div class="qa-header">
                    <div class="qa-content">
                        <div class="qa-title-section">
                            <div class="project-card">
                                <div class="project-line-1">
                                    <span class="project-badge" style="width: 20px; height: 20px; border-radius: 50%; background: #3b82f6;"></span>
                                    <input class="project-title-input" value="Matina IT Park Office" readonly />
                                </div>
                                <div class="project-subrow">
                                    <span>Mr. Carlos Reyes</span>
                                    <span>•</span>
                                    <span>Inspected by:</span>
                                    <span class="inspector-chip">Engr. Jeric Santos</span>
                                </div>
                            </div>
                        </div>
                        <div class="qa-actions">
                            <button class="qa-button" aria-label="New">
                                <div class="qa-button-base primary" onclick="openMaterialModal('new')"><i class="fas fa-plus"></i><span>New</span></div>
                            </button>
                            <button class="qa-button" aria-label="Edit">
                                <div class="qa-button-base success" onclick="openMaterialModal('edit')"><i class="fas fa-pen"></i><span>Edit</span></div>
                            </button>
                            <button class="qa-button" aria-label="Delete">
                                <div class="qa-button-base danger" id="deleteBtn"><i class="fas fa-trash"></i><span>Delete</span></div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Status Tabs -->
                <div class="status-tabs-container">
                    <div class="status-tabs">
                        <button class="tab-btn active" data-status="Pending">Pending</button>
                        <button class="tab-btn" data-status="Approved">Approved</button>
                        <button class="tab-btn" data-status="Rejected">Fail</button>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>Material Name</th>
                                <th>Batch/Serial No.</th>
                                <th>Supplier</th>
                                <th>Quantity Received</th>
                                <th>Unit of Measure</th>
                                <th>Unit Price (₱)</th>
                                <th>Total Cost (₱)</th>
                                <th>Date Received</th>
                                <th>Date Inspected</th>
                                <th>Status</th>
                                <th>Storage Location</th>
                            </tr>
                        </thead>
                        <tbody id="materialsTableBody">
                            <tr>
                                <td>PVC Pipe 4"</td>
                                <td>PVC-2025-045</td>
                                <td>Solid Steel Philippines</td>
                                <td>15</td>
                                <td>Meter</td>
                                <td>₱252.00</td>
                                <td>₱3,780.00</td>
                                <td>Jul 19, 2025</td>
                                <td>Jul 19, 2025</td>
                                <td><span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500; background: #fff3cd; color: #856404;">Pending</span></td>
                                <td>Site A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- New/Edit Material Modal - Step 1 -->
                <div class="qa-modal" id="materialModal" aria-hidden="true">
                    <div class="modal-add" role="dialog" aria-modal="true">
                        <button class="modal-close" onclick="closeMaterialModal()" style="position: absolute; top: 15px; right: 15px; background: #fff; border: 1px solid #e5e7eb; border-radius: 6px; padding: 6px; cursor: pointer; z-index: 10;">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="container">
                            <div class="container2">
                                <div class="container3">
                                    <div class="container4">
                                        <div class="heading">
                                            <div class="modal-head">
                                                <div class="modal-icon"><i class="fas fa-bolt"></i></div>
                                                <div class="add-material">Add Material</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paragraph"></div>
                                    <!-- Inspector Name -->
                                    <div class="container9">
                                        <div class="label"><div class="inspector-name">Inspector Name</div></div>
                                        <div class="input"><div class="engr-jeric-santos">Engr. Jeric Santos</div></div>
                                    </div>
                                    <!-- Supplier -->
                                    <div class="container5">
                                        <div class="container6">
                                            <div class="label"><div class="supplier">Supplier</div></div>
                                            <div class="input">
                                                <input type="text" class="enter-supplier-name" placeholder="Enter supplier name" id="mat_supplier" name="supplier" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Date Received -->
                                    <div class="container10">
                                        <div class="label"><div class="date-received">Date Received</div></div>
                                        <div class="container11">
                                            <div class="input3">
                                                <input type="date" class="mm-dd-yyyy" id="mat_received" name="date_received" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Storage Location -->
                                    <div class="container8">
                                        <div class="label"><div class="storage-location">Storage Location</div></div>
                                        <div class="input">
                                            <input type="text" class="enter-storage-location" placeholder="Enter storage location" id="mat_location" name="location" />
                                        </div>
                                    </div>
                                    <!-- Status (read-only) -->
                                    <div class="container7">
                                        <div class="label"><div class="status">Status</div></div>
                                        <div class="input2"><div class="pending">Pending</div></div>
                                    </div>
                                    <div class="btns">
                                        <div class="button">
                                            <div class="button2" onclick="closeMaterialModal()">Cancel</div>
                                        </div>
                                        <div class="button3">
                                            <div class="button4" onclick="showMaterialStep2()">Next</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New/Edit Material Modal - Step 2 -->
                <div class="qa-modal" id="materialModalStep2" aria-hidden="true">
                    <div class="modal-add-2" role="dialog" aria-modal="true">
                        <button class="modal-close" onclick="closeMaterialModal()" style="position: absolute; top: 15px; right: 15px; background: #fff; border: 1px solid #e5e7eb; border-radius: 6px; padding: 6px; cursor: pointer; z-index: 10;">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="container">
                            <div class="container2">
                                <div class="container3">
                                    <div class="container4">
                                        <div class="heading">
                                            <div class="modal-head">
                                                <div class="modal-icon"><i class="fas fa-bolt"></i></div>
                                                <div class="add-material">Add Material</div>
                                            </div>
                                            <button class="add-item-btn" onclick="addMaterialRow()"><i class="fas fa-plus"></i><span>Add Item</span></button>
                                        </div>
                                    </div>
                                    <div class="btns">
                                        <div class="button2">
                                            <div class="button3" onclick="showMaterialStep1()">Back</div>
                                        </div>
                                        <div class="button4">
                                            <div class="button5" onclick="saveMaterial()">Save</div>
                                        </div>
                                    </div>
                                    <div class="container5">
                                        <div class="container6">
                                            <div class="container7">
                                                <div class="container8">
                                                    <div class="container9">
                                                        <div class="product">Product</div>
                                                    </div>
                                                    <div class="container10">
                                                        <div class="quantity">Quantity</div>
                                                    </div>
                                                    <div class="container11">
                                                        <div class="unit-of-measure">Unit of Measure</div>
                                                    </div>
                                                    <div class="container12">
                                                        <div class="total">Total (₱)</div>
                                </div>
                                                    <div class="container13">
                                                        <div class="batch-serial-no">Batch/Serial No.</div>
                                </div>
                                                    <div class="container14">
                                                        <div class="unit-price">Unit Price (₱)</div>
                                </div>
                                </div>
                                </div>
                                            <div class="container15">
                                                <div class="container16" id="materialRows">
                                                    <!-- Material rows will be added here dynamically -->
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Materials data from database
        let materials = @json($materials);
        
        // CSRF token for AJAX requests
        const csrfToken = '{{ csrf_token() }}';

        let currentFilter = 'Pending';
        let selectedRowIndex = -1;
        let editMode = false;

        // Sidebar toggle
        const headerMenu = document.getElementById('headerMenu');
        const sidebar = document.getElementById('sidebar');
        
        function toggleSidebar() { 
            sidebar.classList.toggle('open'); 
        }
        
        headerMenu.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking outside
        document.addEventListener('click', function (e) {
            if (!sidebar.contains(e.target) && !headerMenu.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });

        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                sidebar.classList.remove('open');
            }
        });

        // Tab filtering
        const tabBtns = document.querySelectorAll('.tab-btn');
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentFilter = btn.dataset.status;
                renderTable();
            });
        });

        // Render table
        function renderTable() {
            const tbody = document.getElementById('materialsTableBody');
            const filtered = materials.filter(m => m.status === currentFilter);
            
            if (filtered.length === 0) {
                tbody.innerHTML = '<tr><td colspan="11" style="text-align: center; color: #6b7280;">No materials found for this status.</td></tr>';
                return;
            }

            tbody.innerHTML = filtered.map((m, idx) => `
                <tr data-index="${idx}">
                    <td>${m.name}</td>
                    <td>${m.batch || 'N/A'}</td>
                    <td>${m.supplier || 'N/A'}</td>
                    <td>${m.quantity}</td>
                    <td>${m.unit || 'N/A'}</td>
                    <td>₱${parseFloat(m.price).toFixed(2)}</td>
                    <td>₱${parseFloat(m.total).toFixed(2)}</td>
                    <td>${formatDate(m.date_received)}</td>
                    <td>${formatDate(m.date_inspected)}</td>
                    <td><span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500; ${getStatusStyle(m.status)}">${m.status}</span></td>
                    <td>${m.location || 'N/A'}</td>
                </tr>
            `).join('');
        }

        function formatDate(dateStr) {
            if (!dateStr) return 'N/A';
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        }

        function getStatusStyle(status) {
            const styles = {
                'Pending': 'background: #fff3cd; color: #856404;',
                'Approved': 'background: #d4edda; color: #155724;',
                'Rejected': 'background: #f8d7da; color: #721c24;',
                'In Use': 'background: #cfe2ff; color: #084298;',
                'Depleted': 'background: #e2e3e5; color: #383d41;'
            };
            return styles[status] || 'background: #e2e3e5; color: #383d41;';
        }

        // Row selection
        document.getElementById('materialsTableBody').addEventListener('click', (e) => {
            const row = e.target.closest('tr');
            if (!row || row.querySelector('td[colspan]')) return;
            
            document.querySelectorAll('#materialsTableBody tr').forEach(r => r.classList.remove('selected'));
            row.classList.add('selected');
            selectedRowIndex = parseInt(row.dataset.index);
        });

        // Delete functionality
        const deleteBtn = document.getElementById('deleteBtn');
        
        deleteBtn.addEventListener('mouseenter', () => {
            if (selectedRowIndex >= 0) {
                const rows = document.querySelectorAll('#materialsTableBody tr');
                rows[selectedRowIndex]?.classList.add('delete-hover');
            }
        });

        deleteBtn.addEventListener('mouseleave', () => {
            document.querySelectorAll('#materialsTableBody tr').forEach(r => r.classList.remove('delete-hover'));
        });

        deleteBtn.addEventListener('click', async () => {
            if (selectedRowIndex < 0) {
                alert('Please select a material row first by clicking on it.');
                return;
            }

            const filtered = materials.filter(m => m.status === currentFilter);
            const material = filtered[selectedRowIndex];
            
            if (confirm(`Are you sure you want to delete ${material.name}?`)) {
                try {
                    const response = await fetch(`/quality-assurance/materials/${material.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        const result = await response.json();
                        if (result.success) {
                            // Reload the page to get updated data from database
                            window.location.reload();
                        } else {
                            showError(result.message || 'An error occurred');
                        }
                    } else {
                        const errorData = await response.json();
                        showError(errorData.message || 'An error occurred');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showError('Network error occurred');
                }
            }
        });

        // Modal functions
        const materialModal = document.getElementById('materialModal');
        const materialModalStep2 = document.getElementById('materialModalStep2');
        let materialRows = [];

        function openMaterialModal(mode) {
            editMode = mode === 'edit';

            if (editMode) {
                if (selectedRowIndex < 0) {
                    alert('Please select a material row first by clicking on it.');
                    return;
                }
                // For edit mode, we'll populate the form with existing data
                const filtered = materials.filter(m => m.status === currentFilter);
                const material = filtered[selectedRowIndex];
                
                document.getElementById('mat_supplier').value = material.supplier || '';
                document.getElementById('mat_location').value = material.location || '';
                document.getElementById('mat_received').value = material.date_received || '';
                
                // Add existing material as a row in step 2
                materialRows = [{
                    name: material.name,
                    batch: material.batch || '',
                    quantity: material.quantity,
                    unit: material.unit || '',
                    price: material.price,
                    total: material.total
                }];
            } else {
                // Reset form for new material
                document.getElementById('mat_supplier').value = '';
                document.getElementById('mat_location').value = '';
                document.getElementById('mat_received').value = '';
                materialRows = [];
                // Initialize with one empty row
                addMaterialRow();
            }

            materialModal.classList.add('active');
            materialModal.setAttribute('aria-hidden', 'false');
            materialModalStep2.setAttribute('aria-hidden', 'true');
        }

        function closeMaterialModal() {
            materialModal.classList.remove('active');
            materialModalStep2.classList.remove('active');
            materialModal.setAttribute('aria-hidden', 'true');
            materialModalStep2.setAttribute('aria-hidden', 'true');
            materialRows = [];
            editMode = false;
        }

        function showMaterialStep2() {
            materialModal.classList.remove('active');
            materialModalStep2.classList.add('active');
            materialModal.setAttribute('aria-hidden', 'true');
            materialModalStep2.setAttribute('aria-hidden', 'false');
            // If using dynamic rows container, ensure at least one row
            const simpleContainer = document.getElementById('materialRowsContainer');
            if (simpleContainer) {
                if (simpleContainer.children.length === 0) {
                    addMaterialRow();
                }
            } else {
                renderMaterialRows();
            }
        }

        function showMaterialStep1() {
            materialModalStep2.classList.remove('active');
            materialModal.classList.add('active');
            materialModal.setAttribute('aria-hidden', 'false');
            materialModalStep2.setAttribute('aria-hidden', 'true');
        }

        function addMaterialRow() {
            const simpleContainer = document.getElementById('materialRowsContainer');
            if (simpleContainer) {
                const newRow = document.createElement('div');
                newRow.className = 'container16';
                newRow.innerHTML = `
                    <div style="padding: 12px 24px; width: 240px;">
                        <div class="input4">
                            <input type="text" placeholder="Product name" />
                        </div>
                    </div>
                    <div style="padding: 12px 24px; width: 155px;">
                        <div class="input5">
                            <input type="text" placeholder="Batch/Serial" />
                        </div>
                    </div>
                    <div style="padding: 12px 24px; width: 114px;">
                        <div class="input6">
                            <input type="number" value="0" />
                        </div>
                    </div>
                    <div style="padding: 12px 24px; width: 118px;">
                        <div class="input7">
                            <select>
                                <option value="">Select</option>
                                <option value="pcs">Pcs</option>
                                <option value="kg">Kg</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                            </select>
                        </div>
                    </div>
                    <div style="padding: 12px 24px; width: 106px;">
                        <div class="input8">
                            <input type="number" placeholder="0.00" />
                        </div>
                    </div>
                    <div style="padding: 12px 24px; width: 119px;">
                        <div class="input9">
                            <input type="number" placeholder="0.00" readonly />
                        </div>
                    </div>
                    <div class="container17">
                        <button class="button6" onclick="removeMaterialRow(this)">
                            <i class="fas fa-trash" style="color: #ef4444;"></i>
                        </button>
                    </div>`;
                simpleContainer.appendChild(newRow);
                return;
            }
            // fallback to array-driven rows
            materialRows.push({ name: '', batch: '', quantity: 0, unit: '', price: 0, total: 0 });
            renderMaterialRows();
        }

        function removeMaterialRow(btn) {
            const row = btn.closest('.container16');
            if (row) row.remove();
        }

        function removeMaterialRow(index) {
            materialRows.splice(index, 1);
            renderMaterialRows();
        }

        function renderMaterialRows() {
            const container = document.getElementById('materialRows');
            container.innerHTML = '';
            
            materialRows.forEach((row, index) => {
                const rowElement = document.createElement('div');
                rowElement.className = 'container16';
                rowElement.innerHTML = `
                    <div class="input4">
                        <input type="text" placeholder="Product name" value="${row.name}" onchange="updateMaterialRow(${index}, 'name', this.value)" />
                    </div>
                    <div class="input2">
                        <input type="text" placeholder="Batch/Serial" value="${row.batch}" onchange="updateMaterialRow(${index}, 'batch', this.value)" />
                    </div>
                    <div class="input">
                        <input type="number" placeholder="0" value="${row.quantity}" onchange="updateMaterialRow(${index}, 'quantity', this.value); calculateRowTotal(${index})" />
                    </div>
                    <div class="input5">
                        <select onchange="updateMaterialRow(${index}, 'unit', this.value)">
                            <option value="">Select Unit</option>
                            <option value="Meter" ${row.unit === 'Meter' ? 'selected' : ''}>Meters</option>
                            <option value="Feet" ${row.unit === 'Feet' ? 'selected' : ''}>Feet</option>
                            <option value="Kilogram" ${row.unit === 'Kilogram' ? 'selected' : ''}>Kilograms</option>
                            <option value="Pound" ${row.unit === 'Pound' ? 'selected' : ''}>Pounds</option>
                            <option value="Ton" ${row.unit === 'Ton' ? 'selected' : ''}>Tons</option>
                            <option value="Piece" ${row.unit === 'Piece' ? 'selected' : ''}>Pieces</option>
                            <option value="Liter" ${row.unit === 'Liter' ? 'selected' : ''}>Liters</option>
                            <option value="Gallon" ${row.unit === 'Gallon' ? 'selected' : ''}>Gallons</option>
                            <option value="Box" ${row.unit === 'Box' ? 'selected' : ''}>Boxes</option>
                            <option value="Bag" ${row.unit === 'Bag' ? 'selected' : ''}>Bags</option>
                        </select>
                    </div>
                    <div class="input6">
                        <input type="number" step="0.01" placeholder="0.00" value="${row.price}" onchange="updateMaterialRow(${index}, 'price', this.value); calculateRowTotal(${index})" />
                    </div>
                    <div class="input3">
                        <input type="number" step="0.01" placeholder="0.00" value="${row.total}" readonly />
                    </div>
                    <div class="container17">
                        <div class="button6" onclick="removeMaterialRow(${index})">
                            <i class="fas fa-trash" style="color: #dc3545; cursor: pointer;"></i>
                        </div>
                    </div>
                `;
                container.appendChild(rowElement);
            });
        }

        function updateMaterialRow(index, field, value) {
            materialRows[index][field] = value;
        }

        function calculateRowTotal(index) {
            const row = materialRows[index];
            row.total = parseFloat(row.quantity || 0) * parseFloat(row.price || 0);
            renderMaterialRows();
        }

        async function saveMaterial() {
            if (materialRows.length === 0) {
                alert('Please add at least one material item.');
                return;
            }

            const supplier = document.getElementById('mat_supplier').value;
            const location = document.getElementById('mat_location').value;
            const dateReceived = document.getElementById('mat_received').value;

            try {
                for (const row of materialRows) {
                    const formData = {
                        name: row.name,
                        batch: row.batch,
                        supplier: supplier,
                        quantity: parseFloat(row.quantity),
                        unit: row.unit,
                        price: parseFloat(row.price),
                        total: parseFloat(row.total),
                        date_received: dateReceived,
                        date_inspected: dateReceived,
                        status: 'Pending',
                        location: location,
                        _token: csrfToken
                    };

                    const response = await fetch('/quality-assurance/materials', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(formData)
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        showError(errorData.message || 'An error occurred');
                        return;
                    }
                }

                showSuccess('Materials added successfully!');
                closeMaterialModal();
                window.location.reload();
            } catch (error) {
                console.error('Error:', error);
                showError('Network error occurred');
            }
        }

        // Initialize with one empty row for new materials
        function initializeNewMaterial() {
            if (!editMode) {
                addMaterialRow();
            }
        }

        // Success message
        function showSuccess(message) {
            const alert = document.getElementById('successAlert');
            alert.textContent = message;
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        }

        // Error message
        function showError(message) {
            const alert = document.getElementById('successAlert');
            alert.textContent = message;
            alert.className = 'alert alert-danger';
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
                alert.className = 'alert alert-success';
            }, 5000);
        }

        // Close modal on outside click
        materialModal.addEventListener('click', (e) => {
            if (e.target === materialModal) {
                closeMaterialModal();
            }
        });

        materialModalStep2.addEventListener('click', (e) => {
            if (e.target === materialModalStep2) {
                closeMaterialModal();
            }
        });

        // Logout function
        function logout() {
            if (confirm('Are you sure you want to log out?')) {
                // For now, redirect to dashboard. In a real app, you'd have a logout route
                window.location.href = '{{ route("dashboard") }}';
            }
        }

        // Set active navigation item
        function setActiveNavItem() {
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                item.classList.remove('active');
                const href = item.getAttribute('href');
                if (href && currentPath.includes(href.replace('{{ url("") }}', ''))) {
                    item.classList.add('active');
                }
            });
        }

        // Initialize table and navigation
        renderTable();
        setActiveNavItem();
    </script>
</body>

</html>