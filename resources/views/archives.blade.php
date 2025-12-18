<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Archives</title>
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
            --red-600: var(--accent);
            --green-600: #1e40af;

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
            font-family: 'Inter', sans-serif;
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

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            box-shadow: var(--shadow-xs);
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
            filter: brightness(0.9);
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

        /* Report details */
        .report-details {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 12px;
        }
        .report-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .report-section-title { font-weight: 600; margin-bottom: 8px; color: #111827; }
        .muted { color: #6b7280; font-size: 14px; }
        .report-table { width: 100%; border-collapse: collapse; }
        .report-table th, .report-table td { padding: 8px 10px; border-bottom: 1px solid #e5e7eb; text-align: left; font-size: 14px; }
        .toggle-btn { 
            background: white; 
            border: 1px solid #e5e7eb; 
            color: #111827; 
            padding: 6px 12px; 
            border-radius: 6px; 
            cursor: pointer; 
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            transition: all 0.2s ease;
        }
        .toggle-btn:hover {
            filter: brightness(0.95);
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
            font-family: 'Inter', sans-serif;
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
            background: transparent;
            color: #065f46;
        }

        .status-badge.unpaid {
            background: transparent;
            color: #991b1b;
        }

        .status-badge.partial {
            background: transparent;
            color: #92400e;
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

            .audit-table thead {
                display: none;
            }

            .audit-table tbody {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .audit-table tbody tr {
                display: flex;
                flex-direction: column;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 12px;
                gap: 8px;
            }

            .audit-table tbody tr:last-child {
                border-bottom: 1px solid #e5e7eb;
            }

            .audit-table tbody td {
                padding: 8px 0;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .audit-table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6b7280;
                min-width: 100px;
                display: block;
            }

            .audit-table tbody td strong {
                font-weight: 700;
                color: #111827;
            }

            .audit-table tbody div {
                flex-direction: column !important;
                gap: 8px !important;
                width: 100%;
            }

            .audit-table tbody .status-badge {
                display: inline-block;
                width: fit-content;
            }
        }

        @media (max-width: 480px) {
            .audit-table tbody td::before {
                min-width: 80px;
                font-size: 12px;
            }

            .audit-table tbody td {
                font-size: 13px;
            }

            .audit-button {
                padding: 5px 10px !important;
                font-size: 11px !important;
            }

            .toggle-btn {
                padding: 5px 10px !important;
                font-size: 11px !important;
            }
        }

        /* Invoice Modal Styles */
        .modal-overlay {
          position: fixed;
          top: 0; left: 0;
          width: 100%; height: 100%;
          background: rgba(0, 0, 0, 0.5);
          display: none; /* hidden by default */
          justify-content: center;
          align-items: center;
          z-index: 1000;
          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .modal-overlay.active { display: flex; }
        .modal-content {
          background: white;
          border-radius: 12px;
          width: 90%;
          max-width: 480px;
          padding: 24px;
          box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
          position: relative;
        }
        .modal-close {
          position: absolute;
          top: 16px; right: 16px;
          font-size: 20px;
          color: #999;
          cursor: pointer;
          width: 32px;
          height: 32px;
          display: flex;
          align-items: center;
          justify-content: center;
          border-radius: 50%;
          transition: background 0.2s;
        }
        .modal-title {
          font-size: 20px;
          font-weight: 600;
          margin: 0 0 20px;
          color: #1a1a1a;
          display: flex;
          align-items: center;
          gap: 8px;
        }
        .modal-title svg { width: 20px; height: 20px; fill: #666; }
        .checkbox-group { display: flex; gap: 24px; margin-bottom: 20px; font-size: 14px; }
        .checkbox-item { display: flex; align-items: center; gap: 6px; cursor: pointer; }
        .checkbox-item input[type="checkbox"] { width: 16px; height: 16px; accent-color: #0066cc; }
        .form-label { display: block; font-size: 14px; font-weight: 500; color: #333; margin-bottom: 6px; }
        .form-input, .form-select { width: 100%; padding: 10px 12px; font-size: 14px; border: 1px solid #d0d0d0; border-radius: 6px; transition: border 0.2s; }
        .form-input:focus, .form-select:focus { outline: none; border-color: #0066cc; box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1); }
        .form-group { margin-bottom: 16px; }
        .date-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .button-group { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; }
        .btn { padding: 10px 16px; font-size: 14px; font-weight: 500; border-radius: 6px; cursor: pointer; transition: all 0.2s; }
        .btn-cancel { background: white; color: #666; border: 1px solid #d0d0d0; }
        .btn-cancel:hover { filter: brightness(0.95); }
        .btn-add { background: #0066cc; color: white; border: none; }
        .btn-add:hover { filter: brightness(0.9); }
        .input-wrapper { position: relative; }
        .calendar-icon { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none; color: #999; }
        .input-wrapper input { padding-right: 36px; }
        .form-error { color: #b91c1c; font-size: 12px; margin-top: 6px; }
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
                @if (session('transaction_success'))
                    <div class="alert alert-success">
                        {{ session('transaction_success') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>There were some issues with your submission:</strong>
                        <ul style="margin-top: 10px; padding-left: 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Archives Header -->
                <div class="audit-header">
                    <h1 class="audit-title">Archived Projects</h1>
                    <div class="audit-actions">
                        <a href="{{ route('projects') }}" class="audit-button secondary">
                            <i class="fas fa-arrow-left"></i>
                            Back to Projects
                        </a>
                    </div>
                </div>

                <!-- Archived Projects Table -->
                <div class="audit-card">
                    <div class="audit-card-header">
                        <h2 class="audit-card-title">Archived Projects</h2>
                    </div>
                    <table class="audit-table logs">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Client</th>
                                <th>Lead</th>
                                <th>Status</th>
                                <th>Archive Reason</th>
                                <th>Archived Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                                <tr>
                                    <td data-label="Project Name"><strong>{{ $project->project_name }}</strong></td>
                                    <td data-label="Client">{{ $project->client?->company_name ?? trim($project->client_first_name . ' ' . $project->client_last_name) }}</td>
                                    <td data-label="Lead">{{ $project->lead }}</td>
                                    <td data-label="Status">
                                        @php
                                            $archiveDisplayStatus = $project->status === 'On Track' ? 'Ongoing' : $project->status;
                                        @endphp
                                        <span class="status-badge" style="
                                            @if($archiveDisplayStatus === 'Ongoing') background: #d1fae5; color: #065f46;
                                            @elseif($archiveDisplayStatus === 'At Risk') background: #fef3c7; color: #92400e;
                                            @elseif($archiveDisplayStatus === 'Off Track') background: #fee2e2; color: #991b1b;
                                            @else background: #dbeafe; color: #1e40af; @endif
                                        ">{{ $archiveDisplayStatus }}</span>
                                    </td>
                                    <td data-label="Archive Reason">
                                        <span class="status-badge" style="
                                            @if($project->archive_reason === 'Finished') background: #d1fae5; color: #065f46;
                                            @else background: #fee2e2; color: #991b1b; @endif
                                        ">{{ $project->archive_reason }}</span>
                                    </td>
                                    <td data-label="Archived Date">{{ $project->archived_at ? \Carbon\Carbon::parse($project->archived_at)->format('M d, Y') : '—' }}</td>
                                    <td data-label="Action">
                                        <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                            <form action="{{ route('projects.unarchive', $project) }}" method="POST" style="display:inline; margin:0;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="audit-button primary" style="padding: 6px 12px; font-size: 12px; margin:0;">
                                                    <i class="fas fa-undo"></i>
                                                    Restore
                                                </button>
                                            </form>
                                            <button class="toggle-btn" onclick="toggleReport('report-{{ $project->id }}')" style="margin:0;">
                                                <i class="fas fa-file-alt"></i> Report
                                            </button>
                                            <a href="{{ route('pdf.project.download', $project->id) }}" class="toggle-btn" style="text-decoration:none; display:inline-flex; align-items:center; margin:0;">
                                                <i class="fas fa-file-pdf"></i> PDF
                                            </a>
                                            <a href="{{ route('csv.project.download', $project->id) }}" class="toggle-btn" style="text-decoration:none; display:inline-flex; align-items:center; margin:0;">
                                                <i class="fas fa-file-csv"></i> CSV
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="report-{{ $project->id }}" style="display:none;">
                                    <td colspan="7">
                                        <div class="report-details">
                                            <div class="report-grid">
                                                <div>
                                                    <div class="report-section-title">Project Details</div>
                                                    <div class="muted">Client</div>
                                                    <div>{{ $project->client?->company_name ?? trim($project->client_first_name . ' ' . $project->client_last_name) }}</div>
                                                    <div class="muted" style="margin-top:8px;">Lead</div>
                                                    <div>{{ $project->lead }}</div>
                                                    <div class="muted" style="margin-top:8px;">Inspector</div>
                                                    <div>{{ $project->lead ?? 'N/A' }}</div>
                                                </div>
                                                <div>
                                                    @php
                                                        $materials = $project->materials;
                                                        $materialsTotal = $materials->sum(function($m) {
                                                            // Try multiple cost field combinations
                                                            if ($m->total_cost !== null && $m->total_cost > 0) {
                                                                return $m->total_cost;
                                                            }
                                                            $boqCost = (($m->material_cost ?? 0) + ($m->labor_cost ?? 0)) * ($m->quantity ?? 0);
                                                            if ($boqCost > 0) {
                                                                return $boqCost;
                                                            }
                                                            // Fallback to unit_price * quantity_received for seeded data
                                                            return ($m->unit_price ?? 0) * ($m->quantity_received ?? 0);
                                                        });
                                                    @endphp
                                                    <div class="report-section-title">Materials Used</div>
                                                    <table class="report-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Qty</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($materials as $m)
                                                                @php
                                                                    $itemName = $m->item_description ?? $m->material_name ?? 'N/A';
                                                                    $itemQty = $m->quantity ?? $m->quantity_received ?? 0;
                                                                    $itemUnit = $m->unit ?? $m->unit_of_measure ?? '';
                                                                    
                                                                    // Calculate total with multiple fallback options
                                                                    if ($m->total_cost !== null && $m->total_cost > 0) {
                                                                        $itemTotal = $m->total_cost;
                                                                    } else {
                                                                        $boqCost = (($m->material_cost ?? 0) + ($m->labor_cost ?? 0)) * $itemQty;
                                                                        if ($boqCost > 0) {
                                                                            $itemTotal = $boqCost;
                                                                        } else {
                                                                            $itemTotal = ($m->unit_price ?? 0) * ($m->quantity_received ?? $itemQty);
                                                                        }
                                                                    }
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $itemName }}</td>
                                                                    <td>{{ $itemQty }} {{ $itemUnit }}</td>
                                                                    <td>₱{{ number_format($itemTotal, 2) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr><td colspan="3" class="muted">No materials recorded.</td></tr>
                                                            @endforelse
                                                            <tr>
                                                                <td colspan="2" style="text-align:right; font-weight:600;">Total Cost</td>
                                                                <td style="font-weight:700;">₱{{ number_format($materialsTotal, 2) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div style="margin-top:16px;">
                                                <div class="report-section-title">Employees Involved</div>
                                                <table class="report-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Position</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($project->employees as $emp)
                                                            <tr>
                                                                <td>{{ $emp->full_name }}</td>
                                                                <td>{{ $emp->position }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr><td colspan="2" class="muted">No employees assigned.</td></tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:20px; color:#6b7280;">No archived projects yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    @if($projects->hasPages())
                        <div style="margin-top: 20px; display: flex; justify-content: center;">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
    <script>
        function toggleReport(id){
            const row = document.getElementById(id);
            if(!row) return;
            
            const isVisible = row.style.display === 'none';
            row.style.display = isVisible ? '' : 'none';
            
            // Find the button that triggered this
            const button = event.target.closest('.toggle-btn');
            if (button) {
                // Add visual feedback
                if (isVisible) {
                    button.style.background = '#3b82f6';
                    button.style.borderColor = '#3b82f6';
                    button.style.color = 'white';
                } else {
                    button.style.background = 'white';
                    button.style.borderColor = '#e5e7eb';
                    button.style.color = '#111827';
                }
            }
        }
    </script>
</body>

</html>