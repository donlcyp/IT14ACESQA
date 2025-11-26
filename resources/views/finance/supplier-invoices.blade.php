<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Supplier Invoices - AJJ CRISBER Engineering Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
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
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: #f7fafc;
            color: var(--gray-700);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open {
            margin-left: 280px;
        }

        .main-wrapper {
            display: flex;
            flex: 1;
        }

        .header {
            background: linear-gradient(135deg, var(--header-bg), #15803d);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: white;
            transition: margin-left 0.3s ease;
        }

        body.sidebar-open .header {
            margin-left: 0;
        }

        .header-title {
            color: white;
            font-size: 24px;
            font-weight: 700;
            flex: 1;
        }

        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px 12px;
            margin-right: 15px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-toggle-btn:hover {
            transform: scale(1.1);
            opacity: 0.9;
        }

        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--gray-300);
            padding: 20px 0;
            overflow-y: auto;
            max-height: calc(100vh - 80px);
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            padding: 0 20px;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            font-size: 13px;
            font-weight: 500;
        }

        .sidebar-link:hover {
            background: rgba(22, 163, 74, 0.1);
            color: var(--accent);
        }

        .sidebar-link.active {
            background: rgba(22, 163, 74, 0.15);
            color: var(--accent);
            border-left-color: var(--accent);
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--black-1);
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--sidebar-bg);
            border-bottom: 2px solid var(--accent);
        }

        th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--gray-700);
        }

        td {
            padding: 12px;
            border-bottom: 1px solid var(--gray-300);
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-approved {
            background: #dcfce7;
            color: #166534;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-unpaid {
            background: #fee2e2;
            color: #991b1b;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-500);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-item {
            background: #f9fafb;
            border-left: 4px solid var(--accent);
            padding: 15px;
            border-radius: 6px;
        }

        .summary-label {
            font-size: 12px;
            color: var(--gray-600);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--black-1);
        }

        .filters {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .filter-group label {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 13px;
        }

        .filter-group input,
        .filter-group select {
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 13px;
            background: white;
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
            }

    </style>
</head>
<body>
    @include('partials.sidebar')

    <header class="header">
        <button id="sidebar-toggle" class="sidebar-toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
    </header>

    <div class="main-wrapper">
        <main class="content-area">
            <div class="page-title">
                <i class="fas fa-file-invoice"></i> Supplier Invoices
            </div>

            <!-- Summary Statistics -->
            <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-label">Total Suppliers</div>
                <div class="summary-value">{{ $suppliers->count() }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Total Invoice Amount</div>
                <div class="summary-value">₱{{ number_format($totalInvoiceAmount, 2) }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Paid</div>
                <div class="summary-value">₱{{ number_format($paidAmount, 2) }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Outstanding</div>
                <div class="summary-value">₱{{ number_format($unpaidAmount, 2) }}</div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filters">
            <div class="filter-group">
                <label for="supplier-filter">Supplier:</label>
                <select id="supplier-filter" onchange="filterTable()">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier }}">{{ $supplier->supplier }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label for="status-filter">Status:</label>
                <select id="status-filter" onchange="filterTable()">
                    <option value="">All Statuses</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
        </div>

        <!-- Supplier Invoices Table -->
        <div class="card">
            <div class="card-title">All Supplier Invoices</div>

            @if($materials->count() > 0)
                <table id="invoices-table">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Payment Status</th>
                            <th>Project</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials->sortByDesc('date_received') as $material)
                            <tr data-supplier="{{ $material->supplier ?? 'Unknown' }}" data-status="{{ strtolower($material->status ?? 'unpaid') }}">
                                <td><strong>{{ $material->supplier ?? 'Unknown' }}</strong></td>
                                <td>{{ $material->material_name ?? 'N/A' }}</td>
                                <td>{{ $material->quantity_received ?? 0 }} {{ $material->unit_of_measure ?? '' }}</td>
                                <td>₱{{ number_format($material->unit_price ?? 0, 2) }}</td>
                                <td><strong>₱{{ number_format($material->total_cost ?? 0, 2) }}</strong></td>
                                <td>{{ $material->date_received?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ $material->status === 'approved' ? 'paid' : 'unpaid' }}">
                                        {{ $material->status === 'approved' ? 'Paid' : 'Unpaid' }}
                                    </span>
                                </td>
                                <td>{{ $material->project?->project_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>No invoice data available</p>
                </div>
            @endif
        </div>
    </main>

    <script>
        function filterTable() {
            const supplierFilter = document.getElementById('supplier-filter').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value.toLowerCase();
            const table = document.getElementById('invoices-table');
            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const supplier = row.getAttribute('data-supplier').toLowerCase();
                const status = row.getAttribute('data-status').toLowerCase();

                const supplierMatch = !supplierFilter || supplier.includes(supplierFilter);
                const statusMatch = !statusFilter || status.includes(statusFilter);

                row.style.display = supplierMatch && statusMatch ? '' : 'none';
            });
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const body = document.body;
            sidebar.classList.toggle('open');
            body.classList.toggle('sidebar-open');
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('open');
                document.body.classList.remove('sidebar-open');
            }
        });
    </script>
        </main>
    </div>
</body>
</html>
