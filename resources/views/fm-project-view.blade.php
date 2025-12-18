<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $project->project_name ?? 'Project' }} - Finance View - AJJ CRISBER</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        .page-subtitle {
            font-size: 14px;
            color: var(--gray-500);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .page-subtitle span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
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

        /* Financial Summary Cards */
        .finance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .finance-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .finance-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .finance-card.budget::before { background: #10b981; }
        .finance-card.spent::before { background: #3b82f6; }
        .finance-card.material::before { background: #8b5cf6; }
        .finance-card.labor::before { background: #f59e0b; }
        .finance-card.remaining::before { background: #ef4444; }

        .finance-label {
            font-size: 14px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .finance-value {
            font-size: 22px;
            font-weight: 700;
            color: var(--black-1);
        }

        .finance-subtext {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 4px;
        }

        /* Section Cards */
        .section-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .section-header {
            padding: 16px 20px;
            background: var(--gray-100);
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #059669;
        }

        .section-body {
            padding: 20px;
        }

        /* Charts Grid */
        .charts-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 900px) {
            .charts-row {
                grid-template-columns: 1fr;
            }
        }

        .chart-container {
            position: relative;
            height: 250px;
        }

        /* Utilization Bar */
        .utilization-section {
            margin-bottom: 20px;
        }

        .utilization-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .utilization-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
        }

        .utilization-percentage {
            font-size: 18px;
            font-weight: 700;
        }

        .utilization-bar {
            width: 100%;
            height: 12px;
            background: var(--gray-200);
            border-radius: 6px;
            overflow: hidden;
        }

        .utilization-fill {
            height: 100%;
            border-radius: 6px;
            transition: width 0.5s ease;
        }

        .utilization-fill.good { background: linear-gradient(90deg, #10b981, #34d399); }
        .utilization-fill.warning { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .utilization-fill.danger { background: linear-gradient(90deg, #ef4444, #f87171); }

        /* Materials Table */
        .materials-table {
            width: 100%;
            border-collapse: collapse;
        }

        .materials-table th {
            background: var(--gray-100);
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .materials-table td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--gray-200);
            vertical-align: middle;
        }

        .materials-table tr:hover {
            background: #fafafa;
        }

        .material-name {
            font-weight: 600;
            color: var(--black-1);
        }

        .material-category {
            font-size: 12px;
            color: var(--gray-500);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 15px;
            font-weight: 600;
        }

        .status-badge.pending { color: #92400e; }
        .status-badge.passed { color: #166534; }
        .status-badge.failed { color: #991b1b; }
        .status-badge.recheck { color: #3730a3; }

        /* Replacement Requests */
        .replacement-item {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .replacement-item.approved {
            background: #f0fdf4;
            border-color: #86efac;
        }

        .replacement-item.pending {
            background: #fffbeb;
            border-color: #fde68a;
        }

        .replacement-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .replacement-material {
            font-weight: 600;
            color: var(--black-1);
        }

        .replacement-info {
            font-size: 13px;
            color: var(--gray-600);
            margin-top: 4px;
        }

        .replacement-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-approve {
            background: #10b981;
            color: white;
        }
        .btn-approve:hover {
            filter: brightness(0.9);
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }
        .btn-reject:hover {
            filter: brightness(0.9);
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .info-item {
            padding: 14px;
            background: var(--gray-100);
            border-radius: 8px;
        }

        .info-label {
            font-size: 14px;
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-400);
            margin-bottom: 12px;
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
        }

        .btn-secondary {
            background: var(--gray-300);
            color: var(--gray-700);
        }
        .btn-secondary:hover {
            filter: brightness(0.95);
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
        }

        .toast.success { background: #10b981; }
        .toast.error { background: #ef4444; }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content sidebar-closed" id="mainContent">
            <header class="header">
                <button class="header-menu" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="page-title">{{ $project->project_name ?? $project->project_code }}</h2>
                        <div class="page-subtitle">
                            <span><i class="fas fa-building"></i> {{ $project->client->client_name ?? 'No Client' }}</span>
                            <span><i class="fas fa-map-marker-alt"></i> {{ $project->location ?? 'No Location' }}</span>
                            <span><i class="fas fa-calendar"></i> {{ $project->date_started ? \Carbon\Carbon::parse($project->date_started)->format('M d, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('fm.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>

                <!-- Financial Summary -->
                <div class="finance-grid">
                    <div class="finance-card budget">
                        <div class="finance-label">Total Budget</div>
                        <div class="finance-value">₱{{ number_format($financials['budget'], 2) }}</div>
                        <div class="finance-subtext">Allocated Amount</div>
                    </div>
                    <div class="finance-card spent">
                        <div class="finance-label">Total Spent</div>
                        <div class="finance-value">₱{{ number_format($financials['total_spent'], 2) }}</div>
                        <div class="finance-subtext">{{ $financials['utilization'] }}% utilized</div>
                    </div>
                    <div class="finance-card material">
                        <div class="finance-label">Material Cost</div>
                        <div class="finance-value">₱{{ number_format($financials['material_cost'], 2) }}</div>
                        <div class="finance-subtext">Raw materials & supplies</div>
                    </div>
                    <div class="finance-card labor">
                        <div class="finance-label">Labor Cost</div>
                        <div class="finance-value">₱{{ number_format($financials['labor_cost'], 2) }}</div>
                        <div class="finance-subtext">Installation & work</div>
                    </div>
                    <div class="finance-card remaining">
                        <div class="finance-label">Remaining</div>
                        <div class="finance-value" style="color: {{ $financials['remaining'] < 0 ? '#ef4444' : '#10b981' }};">
                            ₱{{ number_format($financials['remaining'], 2) }}
                        </div>
                        <div class="finance-subtext">{{ $financials['remaining'] < 0 ? 'Over budget!' : 'Available' }}</div>
                    </div>
                </div>

                <!-- Budget Utilization -->
                <div class="section-card">
                    <div class="section-body">
                        <div class="utilization-section">
                            <div class="utilization-header">
                                <span class="utilization-label">Budget Utilization</span>
                                <span class="utilization-percentage" style="color: {{ $financials['utilization'] > 90 ? '#ef4444' : ($financials['utilization'] > 70 ? '#f59e0b' : '#10b981') }};">
                                    {{ $financials['utilization'] }}%
                                </span>
                            </div>
                            <div class="utilization-bar">
                                @php
                                    $barClass = $financials['utilization'] > 90 ? 'danger' : ($financials['utilization'] > 70 ? 'warning' : 'good');
                                @endphp
                                <div class="utilization-fill {{ $barClass }}" style="width: {{ min($financials['utilization'], 100) }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="charts-row">
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title"><i class="fas fa-chart-pie"></i> Cost Distribution</h3>
                        </div>
                        <div class="section-body">
                            <div class="chart-container">
                                <canvas id="costChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title"><i class="fas fa-clipboard-check"></i> Material QA Status</h3>
                        </div>
                        <div class="section-body">
                            <div class="chart-container">
                                <canvas id="qaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Replacement Requests Section -->
                @if($replacementRequests->count() > 0)
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-exchange-alt"></i> Replacement Requests</h3>
                    </div>
                    <div class="section-body">
                        @foreach($replacementRequests as $request)
                        @php
                            $statusClass = $request->replacement_status === 'approved' ? 'approved' : ($request->replacement_status === 'rejected' ? '' : 'pending');
                        @endphp
                        <div class="replacement-item {{ $statusClass }}">
                            <div class="replacement-header">
                                <div>
                                    <div class="replacement-material">{{ $request->item_description ?? $request->material_name ?? 'Material' }}</div>
                                    <div class="replacement-info">
                                        {{ $request->quantity }} {{ $request->unit }} • 
                                        Cost: ₱{{ number_format((($request->material_cost ?? 0) + ($request->labor_cost ?? 0)) * ($request->quantity ?? 0), 2) }}
                                    </div>
                                    @if($request->replacement_reason)
                                    <div class="replacement-info" style="margin-top: 8px;">
                                        <strong>Reason:</strong> {{ $request->replacement_reason }}
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    @if($request->replacement_status === 'pending')
                                    <div class="replacement-actions">
                                        <button class="btn btn-reject" onclick="openActionModal({{ $request->id }}, '{{ addslashes($request->item_description ?? 'Material') }}', 'reject')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                        <button class="btn btn-approve" onclick="openActionModal({{ $request->id }}, '{{ addslashes($request->item_description ?? 'Material') }}', 'approve')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </div>
                                    @else
                                    <span class="status-badge {{ $request->replacement_status === 'approved' ? 'passed' : 'failed' }}">
                                        <i class="fas fa-{{ $request->replacement_status === 'approved' ? 'check-circle' : 'times-circle' }}"></i>
                                        {{ ucfirst($request->replacement_status) }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Materials List -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-boxes"></i> Project Materials ({{ $project->materials->count() }})</h3>
                    </div>
                    <div class="section-body" style="padding: 0;">
                        @if($project->materials->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="materials-table">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Material Cost</th>
                                        <th>Labor Cost</th>
                                        <th>Total</th>
                                        <th>QA Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->materials as $material)
                                    @php
                                        $mCost = ($material->material_cost ?? 0) * ($material->quantity ?? 0);
                                        $lCost = ($material->labor_cost ?? 0) * ($material->quantity ?? 0);
                                        $total = $mCost + $lCost;
                                        $qaStatus = $material->qa_status ?? 'pending';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="material-name">{{ $material->item_description ?? 'Unnamed' }}</div>
                                            <div class="material-category">Item #{{ $material->item_no ?? 'N/A' }}</div>
                                        </td>
                                        <td>{{ $material->category ?? '—' }}</td>
                                        <td>{{ $material->quantity ?? 0 }} {{ $material->unit ?? '' }}</td>
                                        <td>₱{{ number_format($mCost, 2) }}</td>
                                        <td>₱{{ number_format($lCost, 2) }}</td>
                                        <td style="font-weight: 600;">₱{{ number_format($total, 2) }}</td>
                                        <td>
                                            <span class="status-badge {{ $qaStatus === 'passed' ? 'passed' : ($qaStatus === 'failed' ? 'failed' : ($qaStatus === 'requires_recheck' ? 'recheck' : 'pending')) }}">
                                                {{ ucfirst(str_replace('_', ' ', $qaStatus)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h4>No Materials</h4>
                            <p>No materials have been added to this project yet.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Project Info -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="section-title"><i class="fas fa-info-circle"></i> Project Information</h3>
                    </div>
                    <div class="section-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Project Manager</div>
                                <div class="info-value">{{ $project->assignedPM->name ?? 'Not Assigned' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Status</div>
                                <div class="info-value">{{ $project->status ?? 'Unknown' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Start Date</div>
                                <div class="info-value">{{ $project->date_started ? \Carbon\Carbon::parse($project->date_started)->format('M d, Y') : 'Not Set' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">End Date</div>
                                <div class="info-value">{{ $project->date_ended ? \Carbon\Carbon::parse($project->date_ended)->format('M d, Y') : 'Not Set' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Materials</div>
                                <div class="info-value">{{ $materialStats['total'] }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">QA Passed</div>
                                <div class="info-value" style="color: #10b981;">{{ $materialStats['passed'] }} materials</div>
                            </div>
                        </div>
                    </div>
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
                    </div>

                    <input type="hidden" id="actionMaterialId" value="">
                    <input type="hidden" id="actionType" value="">

                    <div class="form-group">
                        <label class="form-label" id="notesLabel">Notes</label>
                        <textarea id="actionNotes" class="form-textarea" rows="3" placeholder="Add notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
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
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            if (sidebar) {
                sidebar.classList.toggle('open');
                mainContent?.classList.toggle('sidebar-closed');
            }
        }

        // Charts
        const financials = @json($financials);
        const materialStats = @json($materialStats);

        // Cost Distribution Chart
        const costCtx = document.getElementById('costChart').getContext('2d');
        new Chart(costCtx, {
            type: 'doughnut',
            data: {
                labels: ['Material Cost', 'Labor Cost', 'Remaining'],
                datasets: [{
                    data: [financials.material_cost, financials.labor_cost, Math.max(0, financials.remaining)],
                    backgroundColor: ['#3b82f6', '#f59e0b', '#e5e7eb'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ₱' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // QA Status Chart
        const qaCtx = document.getElementById('qaChart').getContext('2d');
        new Chart(qaCtx, {
            type: 'doughnut',
            data: {
                labels: ['Passed', 'Failed', 'Pending', 'Recheck'],
                datasets: [{
                    data: [materialStats.passed, materialStats.failed, materialStats.pending, materialStats.recheck],
                    backgroundColor: ['#10b981', '#ef4444', '#f59e0b', '#8b5cf6'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Modal Functions
        function openActionModal(materialId, materialName, action) {
            document.getElementById('actionMaterialId').value = materialId;
            document.getElementById('actionType').value = action;
            document.getElementById('modalMaterialName').textContent = materialName;
            document.getElementById('actionNotes').value = '';

            const header = document.getElementById('modalHeader');
            const title = document.getElementById('modalTitle');
            const submitBtn = document.getElementById('submitBtn');

            if (action === 'approve') {
                header.className = 'modal-header approve';
                title.innerHTML = '<i class="fas fa-check-circle"></i> Approve Replacement';
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Approve';
                submitBtn.className = 'btn btn-approve';
            } else {
                header.className = 'modal-header reject';
                title.innerHTML = '<i class="fas fa-times-circle"></i> Reject Replacement';
                submitBtn.innerHTML = '<i class="fas fa-times"></i> Reject';
                submitBtn.className = 'btn btn-reject';
            }

            document.getElementById('actionModal').style.display = 'flex';
        }

        function closeActionModal() {
            document.getElementById('actionModal').style.display = 'none';
        }

        function submitAction(event) {
            event.preventDefault();

            const materialId = document.getElementById('actionMaterialId').value;
            const action = document.getElementById('actionType').value;
            const notes = document.getElementById('actionNotes').value;

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            fetch(`/materials/${materialId}/replacement/process`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ action: action, replacement_notes: notes })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    closeActionModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast(data.message || 'Failed', 'error');
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                showToast('An error occurred', 'error');
                submitBtn.disabled = false;
            });

            return false;
        }

        function showToast(message, type) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.className = 'toast ' + type;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 4000);
        }

        document.getElementById('actionModal').addEventListener('click', function(e) {
            if (e.target === this) closeActionModal();
        });
    </script>
</body>
</html>
