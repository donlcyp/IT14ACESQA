<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Material Receipts - Site Supervisor</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #1e40af;
            --accent-dark: #1e3a8a;
            --accent-light: #3b82f6;
            --white: #ffffff;
            --sidebar-bg: #f8fafc;
            --header-bg: #1e40af;
            --main-bg: #f8fafc;

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
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            color: var(--gray-700);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { margin-left: 280px; }
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0 !important; }
        }

        .header {
            background: var(--header-bg);
            padding: 20px 30px;
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

        .header-title {
            color: white;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            flex: 1;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            margin-bottom: 12px;
        }

        .page-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: var(--accent);
        }

        .page-header p {
            color: var(--gray-600);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 16px 20px;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-icon.pending { background: #fef3c7; color: #92400e; }
        .stat-icon.received { background: #d1fae5; color: #065f46; }
        .stat-icon.damaged { background: #fee2e2; color: #991b1b; }

        .stat-info h4 {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        .stat-info p {
            font-size: 12px;
            color: var(--gray-600);
        }

        /* Filter Row */
        .filter-row {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            min-width: 180px;
        }

        /* Section Card */
        .section-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .section-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
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
            color: var(--accent);
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 14px 16px;
            font-size: 13px;
            color: var(--gray-700);
            border-bottom: 1px solid #f3f4f6;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: #f9fafb;
        }

        .material-name {
            font-weight: 500;
            color: var(--black-1);
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-pending { background: none; color: #92400e; }
        .badge-received { background: none; color: #065f46; }
        .badge-damaged { background: none; color: #991b1b; }

        /* Action Button */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-confirm {
            background: var(--accent);
            color: white;
        }
        .btn-confirm:hover {
            filter: brightness(0.9);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--black-1);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: var(--gray-500);
            cursor: pointer;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
        }

        .radio-group {
            display: flex;
            gap: 16px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-item input {
            width: 16px;
            height: 16px;
        }

        .modal-footer {
            padding: 16px 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid #e5e7eb;
        }
        .btn-secondary:hover {
            filter: brightness(0.95);
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <div class="page-header">
                    <a href="{{ route('ss.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <h2>
                        <i class="fas fa-truck"></i>
                        Material Receipts
                    </h2>
                    <p>Confirm material deliveries and report any issues with received items</p>
                </div>

                <!-- Stats Row -->
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h4>{{ $stats['pending'] ?? 0 }}</h4>
                            <p>Pending Receipt</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon received">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h4>{{ $stats['received'] ?? 0 }}</h4>
                            <p>Received</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon damaged">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h4>{{ $stats['damaged'] ?? 0 }}</h4>
                            <p>Damaged/Issues</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-row">
                    <select class="filter-select" onchange="filterMaterials()">
                        <option value="">All Projects</option>
                        @foreach($projects ?? [] as $project)
                            <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                                {{ $project->project_name ?? $project->project_code }}
                            </option>
                        @endforeach
                    </select>
                    <select class="filter-select" onchange="filterStatus(this.value)">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="received">Received</option>
                        <option value="damaged">Damaged</option>
                    </select>
                </div>

                <!-- Materials Table -->
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-title">
                            <i class="fas fa-boxes"></i> Material Deliveries
                        </span>
                    </div>
                    <div class="table-container">
                        @if(isset($materials) && $materials->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Project</th>
                                        <th>Quantity</th>
                                        <th>Expected Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materials as $material)
                                        <tr>
                                            <td>
                                                <div class="material-name">{{ Str::limit($material->item_description ?? $material->material_name ?? 'Material', 40) }}</div>
                                            </td>
                                            <td>{{ $material->project->project_name ?? 'N/A' }}</td>
                                            <td>{{ $material->quantity ?? 0 }} {{ $material->unit ?? 'pcs' }}</td>
                                            <td>
                                                {{ $material->delivery_date ? \Carbon\Carbon::parse($material->delivery_date)->format('M d, Y') : 'TBD' }}
                                            </td>
                                            <td>
                                                @if($material->received_by_ss)
                                                    @if($material->receipt_condition === 'damaged')
                                                        <span class="status-badge badge-damaged">Damaged</span>
                                                    @else
                                                        <span class="status-badge badge-received">Received</span>
                                                    @endif
                                                @else
                                                    <span class="status-badge badge-pending">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$material->received_by_ss)
                                                    <button class="btn btn-confirm btn-sm" onclick="openConfirmModal({{ $material->id }}, '{{ addslashes($material->item_description ?? $material->material_name ?? 'Material') }}')">
                                                        <i class="fas fa-check"></i> Confirm
                                                    </button>
                                                @else
                                                    <span style="font-size: 12px; color: var(--gray-500);">
                                                        Confirmed {{ $material->received_date ? \Carbon\Carbon::parse($material->received_date)->format('M d') : '' }}
                                                    </span>
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
                                <p>No materials are listed for your assigned projects.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Confirm Receipt Modal -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Confirm Material Receipt</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <form id="confirmForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p style="margin-bottom: 16px; color: var(--gray-600);">
                        Confirming receipt for: <strong id="materialName"></strong>
                    </p>

                    <div class="form-group">
                        <label>Condition <span style="color: #dc2626;">*</span></label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="condition" value="good" checked>
                                <span>Good Condition</span>
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="condition" value="damaged">
                                <span>Damaged/Defective</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Quantity Received</label>
                        <input type="number" name="quantity_received" class="form-control" placeholder="Enter quantity received">
                    </div>

                    <div class="form-group">
                        <label>Notes/Remarks</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Any observations about the delivery..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-confirm">
                        <i class="fas fa-check"></i> Confirm Receipt
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('partials.sidebar-js')

    <script>
        function openConfirmModal(materialId, materialName) {
            document.getElementById('materialName').textContent = materialName;
            document.getElementById('confirmForm').action = '{{ url("ss-material-receipts") }}/' + materialId + '/confirm';
            document.getElementById('confirmModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.remove('active');
        }

        // Close modal on overlay click
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        function filterMaterials() {
            // Filter implementation
        }

        function filterStatus(status) {
            // Filter implementation
        }
    </script>
</body>
</html>
