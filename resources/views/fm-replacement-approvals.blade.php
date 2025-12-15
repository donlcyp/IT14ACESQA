<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Replacement Approvals - Finance Manager - AJJ CRISBER</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
            --accent-light: #3b82f6;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: #059669;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d0d5dd;
            --gray-400: #9ca3af;
            --gray-500: #667085;
            --gray-600: #6b7280;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --black-1: #111827;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: var(--gray-700);
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.sidebar-closed {
            margin-left: 0;
        }

        @media (min-width: 769px) {
            .main-content {
                margin-left: 280px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        .header {
            background: #1e40af;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-menu {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
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

        @media (max-width: 768px) {
            .header-title {
                font-size: 18px;
            }
        }

        .content-area {
            padding: 20px;
            flex: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: #059669;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: var(--gray-100);
            border-color: #059669;
            color: #059669;
        }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.pending {
            background: #fef3c7;
            color: #f59e0b;
        }

        .stat-icon.approved {
            background: #dcfce7;
            color: #10b981;
        }

        .stat-icon.rejected {
            background: #fee2e2;
            color: #ef4444;
        }

        .stat-icon.cost {
            background: #dbeafe;
            color: #3b82f6;
        }

        .stat-info {
            flex: 1;
        }

        .stat-label {
            font-size: 13px;
            color: var(--gray-500);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            background: white;
            padding: 8px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            flex-wrap: wrap;
        }

        .tab {
            padding: 10px 20px;
            border: 2px solid var(--gray-300);
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-600);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab:hover {
            border-color: #059669;
            color: #059669;
        }

        .tab.active {
            background: #059669;
            border-color: #059669;
            color: white;
        }

        .tab .count {
            background: rgba(0, 0, 0, 0.1);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .tab.active .count {
            background: rgba(255, 255, 255, 0.2);
        }

        .tab.pending { border-color: #f59e0b; }
        .tab.pending.active { background: #f59e0b; border-color: #f59e0b; }
        .tab.approved { border-color: #10b981; }
        .tab.approved.active { background: #10b981; border-color: #10b981; }
        .tab.rejected { border-color: #ef4444; }
        .tab.rejected.active { background: #ef4444; border-color: #ef4444; }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Replacement Cards */
        .replacements-grid {
            display: grid;
            gap: 16px;
        }

        .replacement-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .replacement-card.pending {
            border-left: 4px solid #f59e0b;
        }

        .replacement-card.approved {
            border-left: 4px solid #10b981;
        }

        .replacement-card.rejected {
            border-left: 4px solid #ef4444;
        }

        .card-header {
            padding: 16px 20px;
            background: var(--gray-100);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
        }

        .card-subtitle {
            font-size: 13px;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .card-body {
            padding: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }

        .info-item {
            padding: 12px;
            background: var(--gray-100);
            border-radius: 8px;
        }

        .info-label {
            font-size: 11px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--black-1);
        }

        .reason-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 16px;
        }

        .reason-box.failure {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .reason-box.approval {
            background: #f0fdf4;
            border-color: #86efac;
        }

        .reason-box.rejection {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .reason-label {
            font-size: 11px;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .reason-box.failure .reason-label { color: #991b1b; }
        .reason-box.approval .reason-label { color: #166534; }
        .reason-box.rejection .reason-label { color: #991b1b; }

        .reason-text {
            font-size: 14px;
            color: var(--gray-700);
            line-height: 1.5;
        }

        .card-footer {
            padding: 16px 20px;
            background: var(--gray-100);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-approve {
            background: #10b981;
            color: white;
        }

        .btn-approve:hover {
            background: #059669;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn-reject:hover {
            background: #dc2626;
        }

        .btn-view {
            background: #e0e7ff;
            color: var(--accent);
        }

        .btn-view:hover {
            background: #c7d2fe;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .empty-state i {
            font-size: 64px;
            color: var(--gray-400);
            margin-bottom: 16px;
        }

        .empty-state h3 {
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--gray-500);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header.approve {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .modal-header.reject {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: white;
            cursor: pointer;
            padding: 4px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background: var(--gray-100);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        .material-info-box {
            background: var(--gray-100);
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .material-info-title {
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 4px;
        }

        .material-info-subtitle {
            font-size: 13px;
            color: var(--gray-600);
        }

        .warning-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 16px;
        }

        .warning-box i {
            color: #f59e0b;
            margin-top: 2px;
        }

        .warning-box p {
            font-size: 12px;
            color: #92400e;
            line-height: 1.5;
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 2000;
            display: none;
            animation: slideIn 0.3s ease;
        }

        .toast.success { background: #10b981; }
        .toast.error { background: #ef4444; }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content sidebar-closed" id="mainContent">
            <header class="header">
                <button class="header-menu" id="headerMenu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <h2 class="page-title">
                        <i class="fas fa-exchange-alt"></i>
                        Material Replacement Approvals
                    </h2>
                    <a href="{{ route('fm.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>

                <!-- Stats Row -->
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Pending Approval</div>
                            <div class="stat-value">{{ $pendingReplacements->count() }}</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon cost">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Pending Cost Impact</div>
                            <div class="stat-value">₱{{ number_format($pendingReplacementCost, 2) }}</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon approved">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Approved</div>
                            <div class="stat-value">{{ $approvedReplacements->count() }}</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon rejected">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Rejected</div>
                            <div class="stat-value">{{ $rejectedReplacements->count() }}</div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                    <button class="tab pending active" onclick="switchTab('pending')">
                        <i class="fas fa-clock"></i>
                        Pending
                        <span class="count">{{ $pendingReplacements->count() }}</span>
                    </button>
                    <button class="tab approved" onclick="switchTab('approved')">
                        <i class="fas fa-check-circle"></i>
                        Approved
                        <span class="count">{{ $approvedReplacements->count() }}</span>
                    </button>
                    <button class="tab rejected" onclick="switchTab('rejected')">
                        <i class="fas fa-times-circle"></i>
                        Rejected
                        <span class="count">{{ $rejectedReplacements->count() }}</span>
                    </button>
                </div>

                <!-- Pending Tab Content -->
                <div id="tab-pending" class="tab-content active">
                    @if($pendingReplacements->count() > 0)
                    <div class="replacements-grid">
                        @foreach($pendingReplacements as $material)
                        <div class="replacement-card pending" id="card-{{ $material->id }}">
                            <div class="card-header">
                                <div>
                                    <div class="card-title">{{ $material->item_description ?? $material->material_name ?? 'Unnamed Material' }}</div>
                                    <div class="card-subtitle">
                                        <i class="fas fa-folder"></i> {{ $material->project->project_name ?? 'Unknown Project' }}
                                        • Item #{{ $material->item_no ?? 'N/A' }}
                                    </div>
                                </div>
                                <span class="status-badge pending">
                                    <i class="fas fa-clock"></i> Pending Approval
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Category</div>
                                        <div class="info-value">{{ $material->category ?? 'N/A' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Quantity</div>
                                        <div class="info-value">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Unit Cost</div>
                                        <div class="info-value">₱{{ number_format(($material->material_cost ?? 0) + ($material->labor_cost ?? 0), 2) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Total Cost Impact</div>
                                        <div class="info-value" style="color: #ef4444;">
                                            ₱{{ number_format((($material->material_cost ?? 0) + ($material->labor_cost ?? 0)) * ($material->quantity ?? 0), 2) }}
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Requested By</div>
                                        <div class="info-value">{{ $material->replacementRequester->name ?? 'Unknown' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Request Date</div>
                                        <div class="info-value">{{ $material->replacement_requested_at ? $material->replacement_requested_at->format('M d, Y') : 'N/A' }}</div>
                                    </div>
                                </div>

                                @if($material->failure_reason)
                                <div class="reason-box failure">
                                    <div class="reason-label"><i class="fas fa-exclamation-triangle"></i> QA Failure Reason</div>
                                    <div class="reason-text">{{ $material->failure_reason }}</div>
                                </div>
                                @endif

                                @if($material->replacement_reason)
                                <div class="reason-box">
                                    <div class="reason-label"><i class="fas fa-comment-alt"></i> Replacement Request Reason</div>
                                    <div class="reason-text">{{ $material->replacement_reason }}</div>
                                </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('fm.project.view', $material->project_id) }}" class="btn btn-view">
                                    <i class="fas fa-eye"></i> View Project
                                </a>
                                <button type="button" class="btn btn-reject" onclick="openActionModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Material') }}', 'reject')">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                                <button type="button" class="btn btn-approve" onclick="openActionModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Material') }}', 'approve')">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-check-circle"></i>
                        <h3>No Pending Requests</h3>
                        <p>All replacement requests have been processed. Great job!</p>
                    </div>
                    @endif
                </div>

                <!-- Approved Tab Content -->
                <div id="tab-approved" class="tab-content">
                    @if($approvedReplacements->count() > 0)
                    <div class="replacements-grid">
                        @foreach($approvedReplacements as $material)
                        <div class="replacement-card approved">
                            <div class="card-header">
                                <div>
                                    <div class="card-title">{{ $material->item_description ?? $material->material_name ?? 'Unnamed Material' }}</div>
                                    <div class="card-subtitle">
                                        <i class="fas fa-folder"></i> {{ $material->project->project_name ?? 'Unknown Project' }}
                                    </div>
                                </div>
                                <span class="status-badge approved">
                                    <i class="fas fa-check-circle"></i> Approved
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Quantity</div>
                                        <div class="info-value">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Total Cost</div>
                                        <div class="info-value">₱{{ number_format((($material->material_cost ?? 0) + ($material->labor_cost ?? 0)) * ($material->quantity ?? 0), 2) }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Approved By</div>
                                        <div class="info-value">{{ $material->replacementApprover->name ?? 'Unknown' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Approval Date</div>
                                        <div class="info-value">{{ $material->replacement_approved_at ? $material->replacement_approved_at->format('M d, Y h:i A') : 'N/A' }}</div>
                                    </div>
                                </div>

                                @if($material->replacement_notes)
                                <div class="reason-box approval">
                                    <div class="reason-label"><i class="fas fa-check"></i> Approval Notes</div>
                                    <div class="reason-text">{{ $material->replacement_notes }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Approved Requests</h3>
                        <p>No replacement requests have been approved yet.</p>
                    </div>
                    @endif
                </div>

                <!-- Rejected Tab Content -->
                <div id="tab-rejected" class="tab-content">
                    @if($rejectedReplacements->count() > 0)
                    <div class="replacements-grid">
                        @foreach($rejectedReplacements as $material)
                        <div class="replacement-card rejected">
                            <div class="card-header">
                                <div>
                                    <div class="card-title">{{ $material->item_description ?? $material->material_name ?? 'Unnamed Material' }}</div>
                                    <div class="card-subtitle">
                                        <i class="fas fa-folder"></i> {{ $material->project->project_name ?? 'Unknown Project' }}
                                    </div>
                                </div>
                                <span class="status-badge rejected">
                                    <i class="fas fa-times-circle"></i> Rejected
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Quantity</div>
                                        <div class="info-value">{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Rejected By</div>
                                        <div class="info-value">{{ $material->replacementApprover->name ?? 'Unknown' }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Rejection Date</div>
                                        <div class="info-value">{{ $material->replacement_approved_at ? $material->replacement_approved_at->format('M d, Y h:i A') : 'N/A' }}</div>
                                    </div>
                                </div>

                                @if($material->replacement_notes)
                                <div class="reason-box rejection">
                                    <div class="reason-label"><i class="fas fa-times"></i> Rejection Reason</div>
                                    <div class="reason-text">{{ $material->replacement_notes }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Rejected Requests</h3>
                        <p>No replacement requests have been rejected.</p>
                    </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <!-- Action Modal -->
    <div id="actionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">
                <h3 class="modal-title" id="modalTitle">
                    <i class="fas fa-check-circle"></i> Approve Replacement
                </h3>
                <button class="modal-close" onclick="closeActionModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="actionForm" onsubmit="return submitAction(event)">
                <div class="modal-body">
                    <div class="material-info-box">
                        <div class="material-info-title" id="modalMaterialName"></div>
                        <div class="material-info-subtitle" id="modalMaterialInfo"></div>
                    </div>

                    <input type="hidden" id="actionMaterialId" value="">
                    <input type="hidden" id="actionType" value="">

                    <div class="form-group">
                        <label class="form-label" id="notesLabel">Notes (Optional)</label>
                        <textarea id="actionNotes" class="form-textarea" rows="3" placeholder="Add any notes regarding this decision..."></textarea>
                    </div>

                    <div class="warning-box" id="rejectWarning" style="display: none;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>Rejecting this request will notify the QA officer who submitted it. Please provide a clear reason for the rejection.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-view" onclick="closeActionModal()">Cancel</button>
                    <button type="submit" class="btn" id="submitBtn">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="toast"></div>

    <script>
        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar) {
                sidebar.classList.toggle('open');
                mainContent?.classList.toggle('sidebar-closed');
            }
        }

        // Tab switching
        function switchTab(tabName) {
            // Update tab buttons
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelector(`.tab.${tabName}`).classList.add('active');

            // Update tab content
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById('tab-' + tabName).classList.add('active');
        }

        // Modal functions
        let currentMaterialId = null;
        let currentAction = null;

        function openActionModal(materialId, materialName, action) {
            currentMaterialId = materialId;
            currentAction = action;

            document.getElementById('actionMaterialId').value = materialId;
            document.getElementById('actionType').value = action;
            document.getElementById('modalMaterialName').textContent = materialName;
            document.getElementById('actionNotes').value = '';

            const header = document.getElementById('modalHeader');
            const title = document.getElementById('modalTitle');
            const submitBtn = document.getElementById('submitBtn');
            const notesLabel = document.getElementById('notesLabel');
            const rejectWarning = document.getElementById('rejectWarning');

            if (action === 'approve') {
                header.className = 'modal-header approve';
                title.innerHTML = '<i class="fas fa-check-circle"></i> Approve Replacement';
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Approve';
                submitBtn.className = 'btn btn-approve';
                notesLabel.textContent = 'Approval Notes (Optional)';
                rejectWarning.style.display = 'none';
            } else {
                header.className = 'modal-header reject';
                title.innerHTML = '<i class="fas fa-times-circle"></i> Reject Replacement';
                submitBtn.innerHTML = '<i class="fas fa-times"></i> Reject';
                submitBtn.className = 'btn btn-reject';
                notesLabel.textContent = 'Rejection Reason';
                rejectWarning.style.display = 'flex';
            }

            document.getElementById('actionModal').style.display = 'flex';
        }

        function closeActionModal() {
            document.getElementById('actionModal').style.display = 'none';
            currentMaterialId = null;
            currentAction = null;
        }

        function submitAction(event) {
            event.preventDefault();

            const materialId = document.getElementById('actionMaterialId').value;
            const action = document.getElementById('actionType').value;
            const notes = document.getElementById('actionNotes').value;

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            submitBtn.disabled = true;

            fetch(`/materials/${materialId}/replacement/process`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: action,
                    replacement_notes: notes
                })
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                if (data.success) {
                    showToast(data.message, 'success');
                    closeActionModal();
                    // Reload after short delay to update the list
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast(data.message || 'Failed to process request', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showToast('An error occurred while processing the request', 'error');
            });

            return false;
        }

        function showToast(message, type) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.className = 'toast ' + type;
            toast.style.display = 'block';
            setTimeout(() => {
                toast.style.display = 'none';
            }, 4000);
        }

        // Close modal on outside click
        document.getElementById('actionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeActionModal();
            }
        });
    </script>
</body>
</html>
