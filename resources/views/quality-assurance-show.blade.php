<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Project Material Management</title>
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
        }

        .header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent); }
        .header-menu { background: none; border: none; color: white; font-size: 24px; cursor: pointer; padding: 8px; border-radius: 4px; transition: background-color 0.2s ease; }
        .header-menu:hover { background-color: rgba(255, 255, 255, 0.1); }
        .header-title { color: white; font-family: "Zen Dots", sans-serif; font-size: 24px; font-weight: 400; flex: 1; }
        .back-btn { color: white; text-decoration: none; margin-right: 15px; padding: 8px 12px; border-radius: 4px; transition: background-color 0.2s ease; display: inline-flex; align-items: center; gap: 8px; }
        .back-btn:hover { background-color: rgba(255, 255, 255, 0.1); color: white; text-decoration: none; }
            .header { 
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

            .back-btn { 
                color: white; 
                text-decoration: none; 
                margin-right: 15px; 
                padding: 8px 12px; 
                border-radius: 4px; 
                transition: background-color 0.2s ease; 
                display: inline-flex; 
                align-items: center; 
                gap: 8px; 
            }

            .back-btn:hover { 
                background-color: rgba(255, 255, 255, 0.1); 
                color: white; 
                text-decoration: none; 
            }
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
    .qa-button-base.primary { background:var(--accent); color:#fff; border-color:var(--accent); }
        .qa-button-base.success { background:#22c55e; color:#fff; border-color:#22c55e; }
        .qa-button-base.danger { background:#ef4444; color:#fff; border-color:#ef4444; }

        .status-tabs-container { margin-bottom: 20px; }
        .status-tabs { display: flex; border-bottom: 3px solid #e5e7eb; background: white; border-radius: 15px 15px 0 0; overflow: hidden; }
        .tab-btn { flex: 1; padding: 16px 24px; background: white; border: none; border-bottom: 3px solid transparent; font-family: 'Inter', sans-serif; font-size: 14px; color: #4b5563; cursor: pointer; transition: all 0.3s; position: relative; }
        .tab-btn:first-child { border-radius: 15px 0 0 0; }
        .tab-btn:last-child { border-radius: 0 15px 0 0; }
    .tab-btn.active { border-bottom-color: var(--accent); color: #000; font-weight: 600; background: #f9fafb; }
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
    .qa-input:focus, .qa-select:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.12); }
        .qa-actions-row { display:flex; justify-content:flex-end; gap:8px; margin-top:16px; }
        .btn-sm { display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; cursor:pointer; font-size: 14px; font-weight: 500; transition: all 0.2s; }
        .btn-sm:hover { opacity: 0.9; }
    .btn-sm.primary { background:var(--accent); color:#fff; border-color:var(--accent); }
        .btn-sm.ghost { background:#fff; color:#111827; }
        .modal-close { position:absolute; top:10px; right:10px; background:#fff; border:1px solid #e5e7eb; border-radius:6px; padding:6px; cursor:pointer; transition: background 0.2s; }
        .modal-close:hover { background: #f3f4f6; }

        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* New Material Modal Styles - Clean Design */
        .modal-add, .modal-add * { box-sizing: border-box; }
        .modal-add { 
            background: #ffffff; 
            border-radius: 16px; 
            position: relative; 
            width: 520px; 
            max-width: 90vw; 
            max-height: 90vh; 
            overflow: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 24px 0 24px;
            margin-bottom: 24px;
        }
        
        .modal-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .modal-icon { 
            width: 40px; 
            height: 40px; 
            border-radius: 8px; 
            background: #1f2937; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .modal-icon i { color: #ffffff; font-size: 16px; }
        
        .modal-title-text { 
            color: #111827; 
            font-family: "Inter", sans-serif; 
            font-size: 20px; 
            font-weight: 600; 
            margin: 0;
        }
        
        .modal-close {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px; 
            padding: 8px;
            cursor: pointer;
            display: flex; 
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .modal-close:hover {
            background: #f3f4f6; 
        }
        .modal-close i {
            font-size: 14px;
            color: #6b7280;
        }
        
        .modal-body {
            padding: 0 24px 24px 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            color: #374151;
            font-family: "Inter", sans-serif; 
            font-size: 14px; 
            font-weight: 500;
            margin-bottom: 6px;
        }
        
        .form-input {
            width: 100%; 
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            color: #111827;
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.12);
        }

        .form-input:disabled {
            background-color: #f3f4f6;
            color: #6b7280;
            cursor: not-allowed;
        }
        
        .form-input::placeholder {
            color: #9ca3af; 
        }
        
        .form-input[readonly] {
            background: #f9fafb;
            color: #6b7280;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        
        .modal-footer {
            padding: 20px 24px 24px 24px;
            display: flex; 
            justify-content: flex-end; 
            gap: 12px;
            border-top: 1px solid #f3f4f6;
            margin-top: 24px;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 8px; 
            font-size: 14px;
            font-weight: 500;
            cursor: pointer; 
            transition: all 0.2s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            gap: 8px;
        }
        
        .btn-secondary {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        .btn-secondary:hover {
            background: #f9fafb;
        }
        
        .btn-primary {
            background: var(--accent);
            color: #ffffff;
        }
        .btn-primary:hover {
            background: var(--accent);
        }

        /* Modal Step 2 Styles - Clean Table Design */
        .modal-add-2, .modal-add-2 * { box-sizing: border-box; }
        .modal-add-2 { 
            background: #ffffff; 
            border-radius: 16px; 
            position: relative; 
            width: 1000px; 
            max-width: 95vw; 
            max-height: 90vh; 
            overflow: auto; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .add-item-btn { 
            background: var(--accent); 
            color: #ffffff; 
            border-radius: 8px; 
            padding: 10px 16px; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            cursor: pointer; 
            border: none; 
            font-size: 14px; 
            font-weight: 500; 
            transition: all 0.2s ease; 
        }
        .add-item-btn:hover { background: var(--accent); }
        .add-item-btn i { font-size: 12px; }
        
        .materials-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        
        .materials-table thead {
            background: #f9fafb;
        }
        
        .materials-table th {
            padding: 16px 12px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .materials-table td {
            padding: 12px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        
        .materials-table tbody tr:hover {
            background: #f9fafb;
        }
        
        .materials-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .table-input {
            width: 100%;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            color: #111827;
            transition: all 0.2s ease;
        }
        
        .table-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.12);
        }
        
        .table-input::placeholder {
            color: #9ca3af;
        }
        
        .table-input[readonly] {
            background: #f9fafb;
            color: #6b7280;
        }
        
        .table-select {
            width: 100%;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            color: #111827;
            cursor: pointer;
        }
        
        .table-select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.12);
        }
        
        .delete-btn {
            background: transparent;
            border: none;
            color: #ef4444;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .delete-btn:hover {
            background: #fef2f2;
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
                width: 95vw !important;
            }
            
            .modal-header {
                padding: 20px 20px 0 20px;
                margin-bottom: 20px;
            }
            
            .modal-body {
                padding: 0 20px 20px 20px;
            }
            
            .modal-footer {
                padding: 16px 20px 20px 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            /* Table responsive */
            .materials-table {
                font-size: 12px;
            }
            
            .materials-table th,
            .materials-table td {
                padding: 8px 6px;
            }
            
            .table-input,
            .table-select {
                font-size: 12px;
                padding: 6px 8px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <a href="{{ route('quality-assurance') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Project Materials
                </a>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
                <div style="margin-left: auto;">
                </div>
            </header>

            <section class="content-area">
                <!-- Breadcrumb -->
                <nav style="margin-bottom: 20px; font-size: 14px; color: #6b7280;">
                    <a href="{{ route('dashboard') }}" style="color: var(--accent); text-decoration: none;">Dashboard</a>
                    <span style="margin: 0 8px;">></span>
                    <a href="{{ route('quality-assurance') }}" style="color: var(--accent); text-decoration: none;">Project Material Management</a>
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
                                    <span class="project-badge" style="width: 20px; height: 20px; border-radius: 50%;" data-color="{{ $record->color ?? '#2563eb' }}"></span>
                                    <input class="project-title-input" value="{{ $record->title ?? '' }}" readonly />
                                </div>
                                <div class="project-subrow">
                                    <span>{{ $record->client ?? '' }}</span>
                                    <span>•</span>
                                    <span>Inspected by:</span>
                                    <span class="inspector-chip">{{ $record->inspector ?? '' }}</span>
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
                        <button class="tab-btn" data-status="Fail">Fail</button>
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
                        <tbody id="materialsTableBody"></tbody>
                    </table>
                </div>

                <!-- New/Edit Material Modal - Step 1 -->
                <div class="qa-modal" id="materialModal" aria-hidden="true">
                    <div class="modal-add" role="dialog" aria-modal="true">
                        <div class="modal-header">
                            <div class="modal-title">
                                <div class="modal-icon"><i class="fas fa-bolt"></i></div>
                                <div class="modal-title-text">Add Material</div>
                            </div>
                        <button class="modal-close" onclick="closeMaterialModal()">
                            <i class="fas fa-times"></i>
                        </button>
                                </div>
                                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Inspector Name</label>
                                <input type="text" class="form-input" value="{{ $record->inspector }}" readonly />
                                </div>
                                        
                            <div class="form-group">
                                <label class="form-label">Supplier</label>
                                <input type="text" class="form-input" placeholder="Enter supplier name" id="mat_supplier" name="supplier" />
                                </div>
                                        
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Date Received</label>
                                    <input type="date" class="form-input" id="mat_received" name="date_received" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-input" id="mat_status" name="status">
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Fail">Fail</option>
                                    </select>
                                </div>
                                </div>
                                        
                            <div class="form-group">
                                <label class="form-label">Storage Location</label>
                                <input type="text" class="form-input" placeholder="Enter storage location" id="mat_location" name="location" />
                                </div>
                                </div>
                                        
                        <div class="modal-footer">
                            <button class="btn btn-secondary" onclick="closeMaterialModal()">Cancel</button>
                            <button class="btn btn-primary" onclick="showMaterialStep2()">Next</button>
                        </div>
                    </div>
                </div>

                <!-- New/Edit Material Modal - Step 2 -->
                <div class="qa-modal" id="materialModalStep2" aria-hidden="true">
                    <div class="modal-add-2" role="dialog" aria-modal="true">
                        <div class="modal-header">
                            <div class="modal-title">
                                <div class="modal-icon"><i class="fas fa-bolt"></i></div>
                                <div class="modal-title-text">Add Material Items</div>
                            </div>
                            <button class="modal-close" onclick="closeMaterialModal()">
                            <i class="fas fa-times"></i>
                        </button>
                                    </div>
                                    
                        <div class="modal-body">
                            <table class="materials-table">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;">Product Name</th>
                                        <th style="width: 18%;">Batch/Serial No.</th>
                                        <th style="width: 12%;">Quantity</th>
                                        <th style="width: 15%;">Unit of Measure</th>
                                        <th style="width: 15%;">Unit Price (₱)</th>
                                        <th style="width: 15%;">Total (₱)</th>
                                        <th style="width: 5%;"></th>
                                    </tr>
                                </thead>
                                <tbody id="materialRowsContainer">
                                                <!-- Material rows will be added here dynamically -->
                                </tbody>
                            </table>
                                    </div>
                                    
                        <div class="modal-footer">
                            <button class="btn btn-secondary" onclick="showMaterialStep1()">Back</button>
                            <button class="btn btn-primary" id="addItemBtn" onclick="addMaterialRow()">
                                <i class="fas fa-plus"></i>
                                <span>Add Item</span>
                            </button>
                            <button class="btn btn-primary" onclick="saveMaterial()" style="background: #059669;">
                                <i class="fas fa-save"></i>
                                <span>Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
    // Set background color for project badge
    const projectBadge = document.querySelector('.project-badge');
    if (projectBadge) {
        const color = projectBadge.getAttribute('data-color');
        if (color) {
            projectBadge.style.backgroundColor = color;
        }
    }
    
    // Materials data from database (processed by Blade on server)
    const materialsData = '{{ json_encode($materials ?? []) }}';
    let materials = JSON.parse(materialsData.replace(/&quot;/g, '"'));
    
    // Current record id for scoping API requests
    const currentRecordId = parseInt('{{ isset($record) && $record->id ? $record->id : 0 }}') || null;
        
        // CSRF token for AJAX requests
        const csrfToken = '{{ csrf_token() }}';
        console.log('CSRF Token:', csrfToken);

        let currentFilter = 'Pending';
        let selectedRowIndex = -1;
        let editMode = false;

        // Sidebar functionality (guarded for pages that may not include all elements)
        const headerMenu = document.getElementById('headerMenu');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        function updateMainContentMargin(isOpen) {
            if (mainContent) mainContent.style.marginLeft = isOpen ? '280px' : '0';
        }

        function closeSidebar() {
            if (sidebar) sidebar.classList.remove('open');
            updateMainContentMargin(false);
        }

        function toggleSidebar() {
            if (!sidebar) return;
            const willBeOpen = !sidebar.classList.contains('open');
            sidebar.classList.toggle('open');
            updateMainContentMargin(willBeOpen);
        }

        if (headerMenu) headerMenu.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking outside (guard headerMenu presence)
        document.addEventListener('click', function (e) {
            const clickedInsideSidebar = sidebar && sidebar.contains(e.target);
            const clickedHeaderMenu = headerMenu && headerMenu.contains(e.target);
            if (!clickedInsideSidebar && !clickedHeaderMenu) {
                closeSidebar();
            }
        });

        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeSidebar();
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
                'Fail': 'background: #f8d7da; color: #721c24;', // treat Fail same as Rejected
                'In Use': 'background: #cfe2ff; color: #084298;',
                'Depleted': 'background: #e2e3e5; color: #383d41;'
            };
            return styles[status] || 'background: #e2e3e5; color: #383d41;';
        }

        // Row selection
        const materialsTableBodyEl = document.getElementById('materialsTableBody');
        if (materialsTableBodyEl) {
            materialsTableBodyEl.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                if (!row || row.querySelector('td[colspan]')) return;
                
                document.querySelectorAll('#materialsTableBody tr').forEach(r => r.classList.remove('selected'));
                row.classList.add('selected');
                selectedRowIndex = parseInt(row.dataset.index);
            });
        }

        // Delete functionality (guard presence of delete button)
        const deleteBtn = document.getElementById('deleteBtn');
        if (deleteBtn) {
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
        }

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
                document.getElementById('mat_status').value = material.status || 'Pending';
                
                // Enable status editing for edit mode
                const statusField = document.getElementById('mat_status');
                if (statusField) {
                    statusField.disabled = false;
                    console.log('Status field enabled for edit mode');
                }
                
                // Hide Add Item button in edit mode
                const addItemBtn = document.getElementById('addItemBtn');
                if (addItemBtn) {
                    addItemBtn.style.display = 'none';
                }
                
                // Clear existing rows and add the material being edited
                const container = document.getElementById('materialRowsContainer');
                container.innerHTML = '';
                
                const editRow = document.createElement('tr');
                editRow.innerHTML = `
                    <td>
                        <input type="text" class="table-input material-name" placeholder="Product name" value="${material.name}" />
                    </td>
                    <td>
                        <input type="text" class="table-input material-batch" placeholder="Batch/Serial" value="${material.batch || ''}" />
                    </td>
                    <td>
                        <input type="number" class="table-input material-quantity" value="${material.quantity}" />
                    </td>
                    <td>
                        <select class="table-select material-unit">
                                <option value="">Select</option>
                                <option value="Meter" ${material.unit === 'Meter' ? 'selected' : ''}>Meter</option>
                                <option value="Feet" ${material.unit === 'Feet' ? 'selected' : ''}>Feet</option>
                                <option value="Kilogram" ${material.unit === 'Kilogram' ? 'selected' : ''}>Kilogram</option>
                                <option value="Pound" ${material.unit === 'Pound' ? 'selected' : ''}>Pound</option>
                                <option value="Ton" ${material.unit === 'Ton' ? 'selected' : ''}>Ton</option>
                                <option value="Piece" ${material.unit === 'Piece' ? 'selected' : ''}>Piece</option>
                                <option value="Liter" ${material.unit === 'Liter' ? 'selected' : ''}>Liter</option>
                                <option value="Gallon" ${material.unit === 'Gallon' ? 'selected' : ''}>Gallon</option>
                                <option value="Box" ${material.unit === 'Box' ? 'selected' : ''}>Box</option>
                                <option value="Bag" ${material.unit === 'Bag' ? 'selected' : ''}>Bag</option>
                            </select>
                    </td>
                    <td>
                        <input type="number" class="table-input material-price" placeholder="0.00" step="0.01" value="${material.price}" />
                    </td>
                    <td>
                        <input type="number" class="table-input material-total" placeholder="0.00" readonly value="${material.total}" />
                    </td>
                    <td>
                        <button class="delete-btn" onclick="removeMaterialRow(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>`;
                container.appendChild(editRow);
            } else {
                // Reset form for new material
                document.getElementById('mat_supplier').value = '';
                document.getElementById('mat_location').value = '';
                document.getElementById('mat_received').value = '';
                document.getElementById('mat_status').value = 'Pending';
                
                // Disable status editing for new materials (only edit can change status)
                document.getElementById('mat_status').disabled = true;
                
                // Show Add Item button for new materials
                const addItemBtn = document.getElementById('addItemBtn');
                if (addItemBtn) {
                    addItemBtn.style.display = 'inline-flex';
                }
                
                // Clear existing rows and add one empty row
                const container = document.getElementById('materialRowsContainer');
                container.innerHTML = '';
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
            // Debug: Check if Step 1 fields are populated
            const supplier = document.getElementById('mat_supplier').value;
            const location = document.getElementById('mat_location').value;
            const dateReceived = document.getElementById('mat_received').value;
            const status = document.getElementById('mat_status').value;
            
            console.log('Step 1 values before Step 2:', { supplier, location, dateReceived, status });
            
            materialModal.classList.remove('active');
            materialModalStep2.classList.add('active');
            materialModal.setAttribute('aria-hidden', 'true');
            materialModalStep2.setAttribute('aria-hidden', 'false');
            
            // Ensure at least one row exists
            const container = document.getElementById('materialRowsContainer');
            if (container.children.length === 0) {
                addMaterialRow();
            }
            
            // Focus on the first input field and trigger calculations
            setTimeout(() => {
                const firstInput = container.querySelector('.material-name');
                if (firstInput) {
                    firstInput.focus();
                }
                
                // Trigger calculation for existing rows
                const quantityInputs = container.querySelectorAll('.material-quantity');
                const priceInputs = container.querySelectorAll('.material-price');
                
                console.log('Found quantity inputs:', quantityInputs.length);
                console.log('Found price inputs:', priceInputs.length);
                
                // Calculate for all rows that have values
                quantityInputs.forEach(input => {
                    console.log('Triggering calculation for quantity input:', input.value);
                    calculateRowTotal(input);
                });
                
                priceInputs.forEach(input => {
                    console.log('Triggering calculation for price input:', input.value);
                    calculateRowTotal(input);
                });
            }, 100);
        }

        function showMaterialStep1() {
            materialModalStep2.classList.remove('active');
            materialModal.classList.add('active');
            materialModal.setAttribute('aria-hidden', 'false');
            materialModalStep2.setAttribute('aria-hidden', 'true');
        }

        function addMaterialRow() {
            const container = document.getElementById('materialRowsContainer');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <input type="text" class="table-input material-name" placeholder="Product name" />
                </td>
                <td>
                    <input type="text" class="table-input material-batch" placeholder="Batch/Serial" />
                </td>
                <td>
                    <input type="number" class="table-input material-quantity" value="0" />
                </td>
                <td>
                    <select class="table-select material-unit">
                            <option value="">Select</option>
                            <option value="Meter">Meter</option>
                            <option value="Feet">Feet</option>
                            <option value="Kilogram">Kilogram</option>
                            <option value="Pound">Pound</option>
                            <option value="Ton">Ton</option>
                            <option value="Piece">Piece</option>
                            <option value="Liter">Liter</option>
                            <option value="Gallon">Gallon</option>
                            <option value="Box">Box</option>
                            <option value="Bag">Bag</option>
                        </select>
                </td>
                <td>
                    <input type="number" class="table-input material-price" placeholder="0.00" step="0.01" />
                </td>
                <td>
                    <input type="number" class="table-input material-total" placeholder="0.00" readonly />
                </td>
                <td>
                    <button class="delete-btn" onclick="removeMaterialRow(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>`;
            container.appendChild(newRow);
            
            // Add direct event listeners to the new row
            const quantityInput = newRow.querySelector('.material-quantity');
            const priceInput = newRow.querySelector('.material-price');
            
            if (quantityInput) {
                quantityInput.addEventListener('input', () => calculateRowTotal(quantityInput));
                quantityInput.addEventListener('change', () => calculateRowTotal(quantityInput));
            }
            
            if (priceInput) {
                priceInput.addEventListener('input', () => calculateRowTotal(priceInput));
                priceInput.addEventListener('change', () => calculateRowTotal(priceInput));
            }
        }

        function removeMaterialRow(btn) {
            const row = btn.closest('tr');
            if (row) row.remove();
        }

        function recalculateAll() {
            console.log('Manual recalculation triggered');
            const container = document.getElementById('materialRowsContainer');
            const rows = container.querySelectorAll('tr');
            
            console.log('Found rows to recalculate:', rows.length);
            
            rows.forEach((row, index) => {
                console.log(`Recalculating row ${index + 1}`);
                const quantityInput = row.querySelector('.material-quantity');
                const priceInput = row.querySelector('.material-price');
                
                if (quantityInput && priceInput) {
                    console.log(`Row ${index + 1} - Quantity: ${quantityInput.value}, Price: ${priceInput.value}`);
                    calculateRowTotal(quantityInput);
                }
            });
        }

        function calculateRowTotal(inputElement) {
            console.log('calculateRowTotal called with:', inputElement);
            const row = inputElement.closest('tr');
            if (!row) {
                console.log('No row found for element:', inputElement);
                return;
            }
            
            const quantityInput = row.querySelector('.material-quantity');
            const priceInput = row.querySelector('.material-price');
            const totalInput = row.querySelector('.material-total');
            
            console.log('Found inputs:', { quantityInput, priceInput, totalInput });
            
            if (quantityInput && priceInput && totalInput) {
                const quantity = parseFloat(quantityInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
            const total = quantity * price;
                
                console.log('Calculation:', quantity, 'x', price, '=', total);
                
                totalInput.value = total.toFixed(2);
                console.log('Total set to:', totalInput.value);
            } else {
                console.error('Missing inputs for calculation:', { quantityInput, priceInput, totalInput });
            }
        }


        async function saveMaterial() {
            const container = document.getElementById('materialRowsContainer');
            const rows = container ? container.querySelectorAll('tr') : [];

            // Locate save button early so we can restore state on errors
            const saveBtn = document.querySelector('button[onclick="saveMaterial()"]');
            const originalText = saveBtn ? saveBtn.innerHTML : null;

            console.log('Found rows:', rows.length);
            console.log('Container:', container);

            if (!rows || rows.length === 0) {
                alert('Please add at least one material item.');
                return;
            }

            const supplierInput = document.getElementById('mat_supplier');
            const locationInput = document.getElementById('mat_location');
            const dateReceivedInput = document.getElementById('mat_received');
            const statusInput = document.getElementById('mat_status');

            console.log('Step 1 inputs:', { supplierInput, locationInput, dateReceivedInput, statusInput });
            console.log('Status input value:', statusInput ? statusInput.value : 'undefined');
            console.log('Status input disabled:', statusInput ? statusInput.disabled : 'undefined');

            // Check each field individually
            console.log('Field values:', {
                supplier: supplierInput ? supplierInput.value : 'MISSING',
                location: locationInput ? locationInput.value : 'MISSING', 
                dateReceived: dateReceivedInput ? dateReceivedInput.value : 'MISSING',
                status: statusInput ? statusInput.value : 'MISSING'
            });

            // If status field is disabled, enable it temporarily for saving
            if (statusInput && statusInput.disabled) {
                console.log('Status field is disabled, enabling temporarily for save');
                statusInput.disabled = false;
            }

            if (!supplierInput || !locationInput || !dateReceivedInput || !statusInput) {
                console.error('Missing form fields:', {
                    supplierInput: !!supplierInput,
                    locationInput: !!locationInput,
                    dateReceivedInput: !!dateReceivedInput,
                    statusInput: !!statusInput
                });
                alert('Error: Some form fields are missing. Please refresh the page and try again.');
                if (saveBtn && originalText !== null) { saveBtn.innerHTML = originalText; saveBtn.disabled = false; }
                return;
            }

            const supplier = supplierInput.value;
            const location = locationInput.value;
            const dateReceived = dateReceivedInput.value;
            const status = statusInput.value;

            console.log('Form values:', { supplier, location, dateReceived, status });

            if (!supplier || !location || !dateReceived) {
                alert('Please fill in all required fields in Step 1.');
                if (saveBtn && originalText !== null) { saveBtn.innerHTML = originalText; saveBtn.disabled = false; }
                return;
            }

            // Show loading state
            if (saveBtn) {
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Saving...</span>';
                saveBtn.disabled = true;
            }

            try {
                for (const row of rows) {
                    const nameInput = row.querySelector('.material-name');
                    const batchInput = row.querySelector('.material-batch');
                    const quantityInput = row.querySelector('.material-quantity');
                    const unitInput = row.querySelector('.material-unit');
                    const priceInput = row.querySelector('.material-price');
                    const totalInput = row.querySelector('.material-total');

                    // Check if all required inputs exist
                    if (!nameInput || !quantityInput || !priceInput || !totalInput) {
                        console.error('Missing required inputs in row:', row);
                        alert('Error: Some form fields are missing. Please refresh the page and try again.');
                        if (saveBtn) { saveBtn.innerHTML = originalText; saveBtn.disabled = false; }
                        return;
                    }

                    const name = nameInput.value;
                    const batch = batchInput ? batchInput.value : '';
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const unit = unitInput ? unitInput.value : '';
                    const price = parseFloat(priceInput.value) || 0;
                    const total = parseFloat(totalInput.value) || 0;

                    console.log('Row data:', { name, batch, quantity, unit, price, total });

                    if (!name || quantity <= 0 || price <= 0) {
                        alert('Please fill in all required fields for each material item.');
                        if (saveBtn) { saveBtn.innerHTML = originalText; saveBtn.disabled = false; }
                        return;
                    }

                    const formData = {
                        name: name,
                        batch: batch,
                        supplier: supplier,
                        quantity: quantity,
                        unit: unit,
                        price: price,
                        total: total,
                        date_received: dateReceived,
                        date_inspected: dateReceived,
                        status: status,
                        location: location,
                        _token: csrfToken
                    };

                    console.log('Sending form data:', formData);

                    // Use FormData instead of JSON to avoid CSRF issues
                    const formDataObj = new FormData();
                    Object.keys(formData).forEach(key => {
                        formDataObj.append(key, formData[key]);
                    });

                    // Determine the URL and method based on edit mode
                    let url, method;
                    if (editMode) {
                        // For edit mode, we need to get the material ID
                        const filtered = materials.filter(m => m.status === currentFilter);
                        const material = filtered[selectedRowIndex];
                        url = `/quality-assurance/materials/${material.id}`;
                        // Use POST with _method override so Laravel parses form-data properly
                        method = 'POST';
                        formDataObj.append('_method', 'PUT');
                        formDataObj.append('qa_record_id', currentRecordId);
                        console.log('Edit mode: updating material ID:', material.id);
                    } else {
                        // For new mode, create a new material
                        url = '/quality-assurance/materials';
                        method = 'POST';
                        formDataObj.append('qa_record_id', currentRecordId);
                        console.log('New mode: creating new material');
                    }

                    console.log('Making fetch request to:', url);
                    console.log('Method:', method);
                    console.log('Form data:', formData);

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formDataObj
                    });

                    console.log('Response received:', response);
                    console.log('Response status:', response.status);
                    console.log('Response ok:', response.ok);

                    if (!response.ok) {
                        let errorMessage = 'An error occurred while saving the material';
                        try {
                        const errorData = await response.json();
                            errorMessage = errorData.message || errorMessage;
                            if (errorData.errors) {
                                const errorList = Object.values(errorData.errors).flat().join(', ');
                                errorMessage = `Validation errors: ${errorList}`;
                            }
                        } catch (e) {
                            errorMessage = `HTTP ${response.status}: ${response.statusText}`;
                        }
                        showError(errorMessage);
                        if (saveBtn) { saveBtn.innerHTML = originalText; saveBtn.disabled = false; }
                        return;
                    }
                }

                if (editMode) {
                    showSuccess('Material updated successfully!');
                } else {
                    showSuccess('Materials added successfully!');
                }
                closeMaterialModal();
                
                // Update the materials array with the new data
                // For now, reload the page to get fresh data from server
                window.location.reload();
            } catch (error) {
                console.error('Error details:', error);
                console.error('Error message:', error.message);
                console.error('Error stack:', error.stack);
                
                let errorMessage = 'Network error occurred. Please check your connection and try again.';
                if (error.message.includes('Failed to fetch')) {
                    errorMessage = 'Cannot connect to server. Please make sure the Laravel server is running (php artisan serve).';
                } else if (error.message.includes('CORS')) {
                    errorMessage = 'CORS error. Please check server configuration.';
                }
                
                showError(errorMessage);
                if (saveBtn) { saveBtn.innerHTML = originalText; saveBtn.disabled = false; }
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
        if (materialModal) {
            materialModal.addEventListener('click', (e) => {
                if (e.target === materialModal) {
                    closeMaterialModal();
                }
            });
        }

        if (materialModalStep2) {
            materialModalStep2.addEventListener('click', (e) => {
                if (e.target === materialModalStep2) {
                    closeMaterialModal();
                }
            });
        }

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

        // Add event delegation for calculation
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('material-quantity') || e.target.classList.contains('material-price')) {
                console.log('Input event triggered for:', e.target);
                calculateRowTotal(e.target);
            }
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('material-quantity') || e.target.classList.contains('material-price')) {
                console.log('Change event triggered for:', e.target);
                calculateRowTotal(e.target);
            }
        });

        // Also add keyup event for better responsiveness
        document.addEventListener('keyup', function(e) {
            if (e.target.classList.contains('material-quantity') || e.target.classList.contains('material-price')) {
                console.log('Keyup event triggered for:', e.target);
                calculateRowTotal(e.target);
            }
        });
    </script>
</body>

</html>