<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QA Materials Inspection - AJJ CRISBER Engineering Services</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
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
            flex: 1;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
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

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--header-bg), #1e40af);
            padding: 16px 20px;
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

        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
                gap: 16px;
            }
            
            .header-menu {
                display: block;
            }
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
            padding: 16px;
            flex: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: var(--accent);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: white;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.2s;
        }

        /* Status Tabs */
        .status-tabs {
            display: flex;
            gap: 6px;
            margin-bottom: 16px;
            flex-wrap: wrap;
            background: white;
            padding: 8px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .status-tab {
            padding: 8px 16px;
            border: 2px solid var(--gray-300);
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .status-tab.active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        .status-tab .count {
            background: rgba(0,0,0,0.1);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
        }

        .status-tab.active .count {
            background: rgba(255,255,255,0.2);
        }

        .status-tab.pending { border-color: #f59e0b; }
        .status-tab.pending.active { background: #f59e0b; border-color: #f59e0b; }
        .status-tab.approved { border-color: #10b981; }
        .status-tab.approved.active { background: #10b981; border-color: #10b981; }
        .status-tab.failed { border-color: #ef4444; }
        .status-tab.failed.active { background: #ef4444; border-color: #ef4444; }
        .status-tab.recheck { border-color: #6366f1; }
        .status-tab.recheck.active { background: #6366f1; border-color: #6366f1; }
        .status-tab.replacement { border-color: #dc2626; }
        .status-tab.replacement.active { background: #dc2626; border-color: #dc2626; }

        /* Materials Table */
        .materials-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .materials-table {
            width: 100%;
            border-collapse: collapse;
        }

        .materials-table th {
            background: var(--sidebar-bg);
            padding: 10px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--gray-300);
        }

        .materials-table td {
            padding: 12px;
            border-bottom: 1px solid var(--gray-300);
            vertical-align: middle;
        }

        .materials-table tr:hover {
            background: #fafafa;
        }

        .materials-table tr:last-child td {
            border-bottom: none;
        }

        .material-name {
            font-weight: 600;
            color: var(--black-1);
            margin-bottom: 2px;
            font-size: 14px;
        }

        .material-details {
            font-size: 12px;
            color: var(--gray-600);
        }

        .project-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            color: var(--accent);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-badge.pending {
            color: #93a116ff;
        }

        .status-badge.approved {
            color: #065f46;
        }

        .status-badge.failed {
            color: #991b1b;
        }

        .status-badge.recheck {
            color: #3730a3;
        }

        .action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .action-btn.inspect {
            background: var(--accent);
            color: white;
        }
        .action-btn.inspect:hover {
            filter: brightness(0.9);
        }

        .action-btn.view {
            background: #e0e7ff;
            color: var(--accent);
        }
        .action-btn.view:hover {
            filter: brightness(0.95);
        }

        .failure-reason {
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: #991b1b;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-600);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-400);
            margin-bottom: 16px;
        }

        .empty-state h3 {
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        /* Modal Styles */
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
            border-bottom: 1px solid var(--gray-300);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--gray-500);
            cursor: pointer;
            padding: 4px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--gray-300);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background: var(--sidebar-bg);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--gray-700);
        }

        .form-select, .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .decision-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        .decision-btn {
            padding: 16px;
            border: 2px solid var(--gray-300);
            border-radius: 10px;
            background: white;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
        }

        .decision-btn.selected.approve {
            border-color: #10b981;
            background: #d1fae5;
        }

        .decision-btn.selected.reject {
            border-color: #ef4444;
            background: #fee2e2;
        }

        .decision-btn i {
            font-size: 28px;
            margin-bottom: 8px;
            display: block;
        }

        .decision-btn.approve i {
            color: #10b981;
        }

        .decision-btn.reject i {
            color: #ef4444;
        }

        .decision-btn span {
            font-weight: 600;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary {
            background: var(--gray-300);
            color: var(--gray-700);
        }
        .btn-secondary:hover {
            filter: brightness(0.95);
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }
        .btn-primary:hover {
            filter: brightness(0.9);
        }

        .material-info-box {
            background: var(--sidebar-bg);
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
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

        #failureReasonGroup {
            display: none;
        }

        /* Toast Notification */
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

        .toast.success {
            background: #10b981;
        }

        .toast.error {
            background: #ef4444;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
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
            <div class="page-header">
                <h2 class="page-title">
                    <i class="fas fa-clipboard-check"></i>
                    Materials Quality Assurance
                </h2>
                <a href="{{ route('dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
            </div>

            <!-- Status Tabs -->
            <div class="status-tabs">
                <a href="{{ route('qa.materials') }}?status=all" class="status-tab {{ $statusFilter === 'all' ? 'active' : '' }}">
                    <i class="fas fa-th-list"></i>
                    All Materials
                    <span class="count">{{ $counts['all'] }}</span>
                </a>
                <a href="{{ route('qa.materials') }}?status=pending" class="status-tab pending {{ $statusFilter === 'pending' ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>
                    Pending
                    <span class="count">{{ $counts['pending'] }}</span>
                </a>
                <a href="{{ route('qa.materials') }}?status=approved" class="status-tab approved {{ $statusFilter === 'approved' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i>
                    Approved
                    <span class="count">{{ $counts['approved'] }}</span>
                </a>
                <a href="{{ route('qa.materials') }}?status=failed" class="status-tab failed {{ $statusFilter === 'failed' ? 'active' : '' }}">
                    <i class="fas fa-times-circle"></i>
                    Failed
                    <span class="count">{{ $counts['failed'] }}</span>
                </a>
                <a href="{{ route('qa.materials') }}?status=recheck" class="status-tab recheck {{ $statusFilter === 'recheck' ? 'active' : '' }}">
                    <i class="fas fa-redo"></i>
                    Recheck
                    <span class="count">{{ $counts['recheck'] }}</span>
                </a>
                <a href="{{ route('qa.materials') }}?status=replacement" class="status-tab replacement {{ $statusFilter === 'replacement' ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i>
                    Needs Replacement
                    <span class="count">{{ $counts['replacement'] }}</span>
                </a>
            </div>

            <!-- Materials Table -->
            <div class="materials-card">
                @if($materials->count() > 0)
                <table class="materials-table">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Project</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Inspector</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials as $material)
                        <tr>
                            <td>
                                <div class="material-name">{{ $material->item_description ?? $material->material_name ?? 'Unnamed Item' }}</div>
                                <div class="material-details">
                                    @if($material->category)
                                        <span>{{ $material->category }}</span> •
                                    @endif
                                    Item #{{ $material->item_no ?? 'N/A' }}
                                </div>
                                @if($material->failure_reason)
                                <div class="failure-reason">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $material->failure_reason }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <span class="project-badge">
                                    <i class="fas fa-folder"></i>
                                    {{ $material->project->project_name ?? $material->project->project_code ?? 'Unknown' }}
                                </span>
                            </td>
                            <td>
                                <strong style="font-size: 14px;">{{ $material->quantity ?? 0 }}</strong> <span style="font-size: 15px;">{{ $material->unit ?? 'pcs' }}</span>   
                            </td>
                            <td>
                                @php
                                    $qaStatus = $material->qa_status ?? 'pending';
                                @endphp
                                <span class="status-badge {{ $qaStatus === 'passed' ? 'approved' : ($qaStatus === 'failed' ? 'failed' : ($qaStatus === 'requires_recheck' ? 'recheck' : 'pending')) }}">
                                    @if($qaStatus === 'passed')
                                        <i class="fas fa-check-circle"></i> Passed
                                    @elseif($qaStatus === 'failed')
                                        <i class="fas fa-times-circle"></i> Failed
                                    @elseif($qaStatus === 'requires_recheck')
                                        <i class="fas fa-redo"></i> Recheck
                                    @else
                                        <i class="fas fa-clock"></i> Pending
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if($material->qaInspector)
                                    <div style="font-size: 14px;">{{ $material->qaInspector->name }}</div>
                                    <div style="font-size: 13px; color: var(--gray-500);">{{ $material->qa_inspected_at ? $material->qa_inspected_at->format('M d, Y') : '' }}</div>
                                @else
                                    <span style="color: var(--gray-500); font-size: 14px;">Not inspected</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if(!$material->qa_status || $material->qa_status === 'pending' || $material->qa_status === 'requires_recheck')
                                <button type="button" class="action-btn inspect" onclick="openInspectModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Item') }}', '{{ $material->project->project_name ?? '' }}')">
                                    <i class="fas fa-clipboard-check"></i> Inspect
                                </button>
                                @elseif($material->needs_replacement && !$material->replacement_requested)
                                <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                    <button type="button" class="action-btn view" onclick="openViewDetailsModal({{ $material->id }})">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button type="button" class="action-btn" style="background: #dc2626; color: white;" onclick="openRequestReplacementModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Item') }}')">
                                        <i class="fas fa-exchange-alt"></i> Request
                                    </button>
                                </div>
                                @elseif($material->replacement_requested)
                                <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                    <button type="button" class="action-btn view" onclick="openViewDetailsModal({{ $material->id }})">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 600; color: {{ $material->replacement_status === 'approved' ? '#065f46' : ($material->replacement_status === 'rejected' ? '#991b1b' : '#93a116ff') }};">
                                        <i class="fas {{ $material->replacement_status === 'approved' ? 'fa-check' : ($material->replacement_status === 'rejected' ? 'fa-times' : 'fa-hourglass-half') }}"></i>
                                        {{ ucfirst($material->replacement_status ?? 'Pending') }}
                                    </span>
                                </div>
                                @else
                                <button type="button" class="action-btn view" onclick="openViewDetailsModal({{ $material->id }})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>No Materials Found</h3>
                    <p>There are no materials matching this filter in your assigned projects.</p>
                </div>
                @endif
            </div>
        </section>
    </div>

    <!-- QA Decision Modal -->
    <div id="inspectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-clipboard-check" style="color: var(--accent);"></i>
                    QA Inspection Decision
                </h3>
                <button class="modal-close" onclick="closeInspectModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="inspectForm" onsubmit="return submitDecision(event)">
                <input type="hidden" id="materialId" name="material_id" value="">
                
                <div class="modal-body">
                    <div class="material-info-box">
                        <div class="material-info-title" id="modalMaterialName"></div>
                        <div class="material-info-subtitle" id="modalProjectName"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Decision <span style="color: #ef4444;">*</span></label>
                        <div class="decision-buttons">
                            <button type="button" class="decision-btn approve" onclick="selectDecision('approved')">
                                <i class="fas fa-check-circle"></i>
                                <span>Approve</span>
                            </button>
                            <button type="button" class="decision-btn reject" onclick="selectDecision('failed')">
                                <i class="fas fa-times-circle"></i>
                                <span>Fail / Reject</span>
                            </button>
                        </div>
                        <input type="hidden" id="decisionValue" name="decision" value="">
                    </div>

                    <div class="form-group" id="failureReasonGroup">
                        <label class="form-label">Failure Reason <span style="color: #ef4444;">*</span></label>
                        <select id="failureReason" name="failure_reason" class="form-select">
                            <option value="">-- Select Reason --</option>
                            @foreach($failureReasons as $reason)
                            <option value="{{ $reason }}">{{ $reason }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Remarks (Optional)</label>
                        <textarea id="remarks" name="remarks" class="form-textarea" rows="3" placeholder="Add any additional notes or observations..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Submit Decision
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="viewDetailsModal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--accent), #1e3a8a);">
                <h3 class="modal-title" style="color: white;">
                    <i class="fas fa-info-circle"></i>
                    Material Details
                </h3>
                <button class="modal-close" onclick="closeViewDetailsModal()" style="color: white;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="viewDetailsContent" style="padding: 20px;">
                <div style="text-align: center; padding: 40px; color: var(--gray-500);">
                    <i class="fas fa-spinner fa-spin" style="font-size: 32px;"></i>
                    <p style="margin-top: 12px;">Loading details...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Replacement Modal -->
    <div id="requestReplacementModal" class="modal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header" style="background: #1e40af;">
                <h3 class="modal-title" style="color: white;">
                    <i class="fas fa-exchange-alt"></i>
                    Request Replacement
                </h3>
                <button class="modal-close" onclick="closeRequestReplacementModal()" style="color: white;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="requestReplacementForm" onsubmit="return submitReplacementRequest(event)">
                <div style="padding: 20px;">
                    <div style="background: #dbeafe; border: 1px solid #93c5fd; border-radius: 8px; padding: 12px; margin-bottom: 16px;">
                        <div style="font-size: 11px; color: #1e40af; text-transform: uppercase; margin-bottom: 4px;">Requesting Replacement For</div>
                        <div id="replacementMaterialName" style="font-weight: 600; color: #1e3a8a; font-size: 14px;"></div>
                    </div>

                    <input type="hidden" id="replacementMaterialId" value="">

                    <div class="form-group">
                        <label class="form-label">Replacement Reason <span style="color: #ef4444;">*</span></label>
                        <textarea id="replacementReason" name="replacement_reason" class="form-textarea" rows="4" placeholder="Explain why this material needs replacement and any additional details for the project manager..." required></textarea>
                    </div>

                    <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px; margin-top: 12px;">
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-info-circle" style="color: #f59e0b; margin-top: 2px;"></i>
                            <div style="font-size: 12px; color: #92400e; line-height: 1.5;">
                                This request will be sent to the Project Manager, Finance Manager, and Owner for approval. You will be notified once the replacement is approved.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn" style="background: #1e40af; color: white;">
                        <i class="fas fa-paper-plane"></i> Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>

    <script>
        let currentMaterialId = null;
        let currentDecision = null;

        function openInspectModal(materialId, materialName, projectName) {
            currentMaterialId = materialId;
            document.getElementById('materialId').value = materialId;
            document.getElementById('modalMaterialName').textContent = materialName;
            document.getElementById('modalProjectName').textContent = projectName ? 'Project: ' + projectName : '';
            
            // Reset form
            currentDecision = null;
            document.getElementById('decisionValue').value = '';
            document.getElementById('failureReason').value = '';
            document.getElementById('remarks').value = '';
            document.getElementById('failureReasonGroup').style.display = 'none';
            
            document.querySelectorAll('.decision-btn').forEach(btn => btn.classList.remove('selected'));
            
            document.getElementById('inspectModal').style.display = 'flex';
        }

        function closeInspectModal() {
            document.getElementById('inspectModal').style.display = 'none';
            currentMaterialId = null;
            currentDecision = null;
        }

        function selectDecision(decision) {
            currentDecision = decision;
            document.getElementById('decisionValue').value = decision;
            
            // Update button styles
            document.querySelectorAll('.decision-btn').forEach(btn => btn.classList.remove('selected'));
            
            if (decision === 'approved') {
                document.querySelector('.decision-btn.approve').classList.add('selected');
                document.getElementById('failureReasonGroup').style.display = 'none';
                document.getElementById('failureReason').value = '';
            } else {
                document.querySelector('.decision-btn.reject').classList.add('selected');
                document.getElementById('failureReasonGroup').style.display = 'block';
            }
        }

        function submitDecision(event) {
            event.preventDefault();
            
            if (!currentDecision) {
                showToast('Please select a decision (Approve or Fail)', 'error');
                return false;
            }
            
            if (currentDecision === 'failed' && !document.getElementById('failureReason').value) {
                showToast('Please select a failure reason', 'error');
                return false;
            }
            
            const formData = {
                decision: currentDecision,
                failure_reason: document.getElementById('failureReason').value,
                remarks: document.getElementById('remarks').value
            };
            
            fetch(`/qa-materials/${currentMaterialId}/decision`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    closeInspectModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast(data.message || 'Failed to submit decision', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while submitting', 'error');
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

        // View Details Modal Functions
        function openViewDetailsModal(materialId) {
            document.getElementById('viewDetailsModal').style.display = 'flex';
            document.getElementById('viewDetailsContent').innerHTML = `
                <div style="text-align: center; padding: 40px; color: var(--gray-500);">
                    <i class="fas fa-spinner fa-spin" style="font-size: 32px;"></i>
                    <p style="margin-top: 12px;">Loading details...</p>
                </div>
            `;

            fetch(`/qa-materials/${materialId}/details`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const material = data.material;
                    let statusBadge = '';
                    let statusColor = '#6b7280';
                    
                    if (material.qa_status === 'passed') {
                        statusBadge = '<span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;"><i class="fas fa-check-circle"></i> Passed</span>';
                    } else if (material.qa_status === 'failed') {
                        statusBadge = '<span style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;"><i class="fas fa-times-circle"></i> Failed</span>';
                    } else if (material.qa_status === 'requires_recheck') {
                        statusBadge = '<span style="background: #fef3c7; color: #92400e; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;"><i class="fas fa-redo"></i> Requires Recheck</span>';
                    } else {
                        statusBadge = '<span style="background: #e5e7eb; color: #374151; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;"><i class="fas fa-clock"></i> Pending</span>';
                    }

                    let replacementSection = '';
                    if (material.needs_replacement) {
                        let replacementStatus = '';
                        if (material.replacement_requested) {
                            if (material.replacement_status === 'approved') {
                                replacementStatus = `
                                    <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 8px; padding: 12px; margin-top: 12px;">
                                        <div style="font-weight: 600; color: #166534; margin-bottom: 4px;">
                                            <i class="fas fa-check-circle"></i> Replacement Approved
                                        </div>
                                        <div style="font-size: 12px; color: #15803d;">
                                            Approved on: ${material.replacement_approved_at ? new Date(material.replacement_approved_at).toLocaleDateString() : 'N/A'}
                                            ${material.replacement_notes ? '<br>Notes: ' + material.replacement_notes : ''}
                                        </div>
                                    </div>`;
                            } else if (material.replacement_status === 'rejected') {
                                replacementStatus = `
                                    <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 8px; padding: 12px; margin-top: 12px;">
                                        <div style="font-weight: 600; color: #991b1b; margin-bottom: 4px;">
                                            <i class="fas fa-times-circle"></i> Replacement Rejected
                                        </div>
                                        <div style="font-size: 12px; color: #b91c1c;">
                                            ${material.replacement_notes ? 'Reason: ' + material.replacement_notes : 'No reason provided'}
                                        </div>
                                    </div>`;
                            } else {
                                replacementStatus = `
                                    <div style="background: #fef3c7; border: 1px solid #fde68a; border-radius: 8px; padding: 12px; margin-top: 12px;">
                                        <div style="font-weight: 600; color: #92400e; margin-bottom: 4px;">
                                            <i class="fas fa-clock"></i> Replacement Request Pending
                                        </div>
                                        <div style="font-size: 12px; color: #b45309;">
                                            Requested on: ${material.replacement_requested_at ? new Date(material.replacement_requested_at).toLocaleDateString() : 'N/A'}
                                            <br>Reason: ${material.replacement_reason || 'N/A'}
                                        </div>
                                    </div>`;
                            }
                        } else {
                            replacementStatus = `
                                <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 12px; margin-top: 12px;">
                                    <div style="font-weight: 600; color: #991b1b; margin-bottom: 4px;">
                                        <i class="fas fa-exclamation-triangle"></i> Replacement Needed
                                    </div>
                                    <div style="font-size: 12px; color: #b91c1c;">
                                        This material has been marked for replacement. Please submit a replacement request.
                                    </div>
                                </div>`;
                        }
                        replacementSection = replacementStatus;
                    }

                    document.getElementById('viewDetailsContent').innerHTML = `
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            <!-- Header Info -->
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; margin-bottom: 4px;">Material</div>
                                    <div style="font-weight: 600; color: #1f2937; font-size: 16px;">${material.item_description || 'N/A'}</div>
                                </div>
                                ${statusBadge}
                            </div>

                            <!-- Project Info -->
                            <div style="background: #f3f4f6; border-radius: 8px; padding: 12px;">
                                <div style="font-size: 11px; color: #6b7280; text-transform: uppercase; margin-bottom: 8px;">Project Information</div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 13px;">
                                    <div><span style="color: #6b7280;">Project:</span> <strong>${material.project?.project_name || 'N/A'}</strong></div>
                                    <div><span style="color: #6b7280;">Location:</span> ${material.project?.location || 'N/A'}</div>
                                </div>
                            </div>

                            <!-- Material Details -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                <div style="background: #f9fafb; border-radius: 8px; padding: 12px;">
                                    <div style="font-size: 11px; color: #6b7280; margin-bottom: 4px;">Unit</div>
                                    <div style="font-weight: 500;">${material.unit || 'N/A'}</div>
                                </div>
                                <div style="background: #f9fafb; border-radius: 8px; padding: 12px;">
                                    <div style="font-size: 11px; color: #6b7280; margin-bottom: 4px;">Quantity</div>
                                    <div style="font-weight: 500;">${material.quantity || '0'}</div>
                                </div>
                                <div style="background: #f9fafb; border-radius: 8px; padding: 12px;">
                                    <div style="font-size: 11px; color: #6b7280; margin-bottom: 4px;">Unit Cost</div>
                                    <div style="font-weight: 500;">₱${parseFloat(material.unit_cost || 0).toLocaleString('en-PH', {minimumFractionDigits: 2})}</div>
                                </div>
                                <div style="background: #f9fafb; border-radius: 8px; padding: 12px;">
                                    <div style="font-size: 11px; color: #6b7280; margin-bottom: 4px;">Total Amount</div>
                                    <div style="font-weight: 500;">₱${parseFloat(material.amount || 0).toLocaleString('en-PH', {minimumFractionDigits: 2})}</div>
                                </div>
                            </div>

                            <!-- QA Inspection Info -->
                            ${material.qa_inspected_at ? `
                                <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 12px;">
                                    <div style="font-size: 11px; color: #1e40af; text-transform: uppercase; margin-bottom: 8px;">QA Inspection Details</div>
                                    <div style="display: grid; gap: 6px; font-size: 13px;">
                                        <div><span style="color: #3b82f6;">Inspected By:</span> <strong>${material.qa_inspector?.name || 'N/A'}</strong></div>
                                        <div><span style="color: #3b82f6;">Inspected On:</span> ${new Date(material.qa_inspected_at).toLocaleString()}</div>
                                        ${material.failure_reason ? `<div><span style="color: #3b82f6;">Failure Reason:</span> ${material.failure_reason}</div>` : ''}
                                        ${material.qa_remarks ? `<div><span style="color: #3b82f6;">Remarks:</span> ${material.qa_remarks}</div>` : ''}
                                    </div>
                                </div>
                            ` : ''}

                            ${replacementSection}
                        </div>
                    `;
                } else {
                    document.getElementById('viewDetailsContent').innerHTML = `
                        <div style="text-align: center; padding: 40px; color: #ef4444;">
                            <i class="fas fa-exclamation-circle" style="font-size: 32px;"></i>
                            <p style="margin-top: 12px;">Failed to load material details</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('viewDetailsContent').innerHTML = `
                    <div style="text-align: center; padding: 40px; color: #ef4444;">
                        <i class="fas fa-exclamation-circle" style="font-size: 32px;"></i>
                        <p style="margin-top: 12px;">An error occurred while loading details</p>
                    </div>
                `;
            });
        }

        function closeViewDetailsModal() {
            document.getElementById('viewDetailsModal').style.display = 'none';
        }

        // Request Replacement Modal Functions
        function openRequestReplacementModal(materialId, materialName) {
            document.getElementById('replacementMaterialId').value = materialId;
            document.getElementById('replacementMaterialName').textContent = materialName;
            document.getElementById('replacementReason').value = '';
            document.getElementById('requestReplacementModal').style.display = 'flex';
        }

        function closeRequestReplacementModal() {
            document.getElementById('requestReplacementModal').style.display = 'none';
        }

        function submitReplacementRequest(event) {
            event.preventDefault();
            
            const materialId = document.getElementById('replacementMaterialId').value;
            const reason = document.getElementById('replacementReason').value;
            
            if (!reason.trim()) {
                showToast('Please provide a reason for the replacement request', 'error');
                return false;
            }

            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;

            fetch(`/qa-materials/${materialId}/request-replacement`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ replacement_reason: reason })
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                if (data.success) {
                    showToast(data.message, 'success');
                    closeRequestReplacementModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast(data.message || 'Failed to submit replacement request', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showToast('An error occurred while submitting the request', 'error');
            });
            
            return false;
        }

        // Close modal when clicking outside
        document.getElementById('inspectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeInspectModal();
            }
        });

        document.getElementById('viewDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeViewDetailsModal();
            }
        });

        document.getElementById('requestReplacementModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRequestReplacementModal();
            }
        });

        // Sidebar toggle function
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar) {
                sidebar.classList.toggle('open');
                mainContent?.classList.toggle('sidebar-closed');
            }
        }
    </script>
        </main>
    </div>
</body>
</html>
