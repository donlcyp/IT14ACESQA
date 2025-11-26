<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Payment Summary - AJJ CRISBER Engineering Services</title>
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

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-unpaid {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-500);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-item {
            background: white;
            border-left: 4px solid var(--accent);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .summary-label {
            font-size: 12px;
            color: var(--gray-600);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--black-1);
        }

        .summary-change {
            font-size: 12px;
            color: var(--gray-500);
            margin-top: 4px;
        }

        .summary-change.positive {
            color: #16a34a;
        }

        .summary-change.negative {
            color: #dc2626;
        }

        .payment-breakdown {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .breakdown-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--black-1);
        }

        .breakdown-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-300);
        }

        .breakdown-item:last-child {
            border-bottom: none;
        }

        .breakdown-label {
            color: var(--gray-700);
            font-weight: 600;
        }

        .breakdown-value {
            color: var(--black-1);
            font-weight: 700;
        }

        .breakdown-item.total {
            border-top: 2px solid var(--accent);
            margin-top: 10px;
            padding-top: 15px;
            font-size: 16px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 8px;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent);
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
                <i class="fas fa-receipt"></i> Payment Summary
            </div>

            <!-- Key Metrics -->
            <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-label">Total Amount Due</div>
                <div class="summary-value">₱{{ number_format($totalAmount, 2) }}</div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 100%"></div>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Paid Invoices</div>
                <div class="summary-value">₱{{ number_format($paidAmount, 2) }}</div>
                <div class="summary-change positive" id="paid-percentage">
                    {{ number_format(($totalAmount > 0 ? ($paidAmount / $totalAmount) * 100 : 0), 1) }}% Complete
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $totalAmount > 0 ? ($paidAmount / $totalAmount) * 100 : 0 }}%"></div>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Outstanding Balance</div>
                <div class="summary-value">₱{{ number_format($unpaidAmount, 2) }}</div>
                <div class="summary-change negative">
                    {{ number_format(($totalAmount > 0 ? ($unpaidAmount / $totalAmount) * 100 : 0), 1) }}% Pending
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $totalAmount > 0 ? ($unpaidAmount / $totalAmount) * 100 : 0 }}%; background: #dc2626;"></div>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-label">Payment Ratio</div>
                <div class="summary-value">{{ $totalAmount > 0 ? number_format(($paidAmount / $totalAmount) * 100, 1) : 0 }}%</div>
                <div class="summary-change">
                    {{ $materials->where('status', 'approved')->count() }} of {{ $materials->count() }} items paid
                </div>
            </div>
        </div>

        <!-- Payment Status Summary -->
        <div class="payment-breakdown">
            <div class="breakdown-title">
                <i class="fas fa-chart-bar"></i> Payment Status Summary
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Total Materials/Invoices</span>
                <span class="breakdown-value">{{ $materials->count() }} items</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Paid/Approved</span>
                <span class="breakdown-value">{{ $materials->where('status', 'approved')->count() }} items (₱{{ number_format($paidAmount, 2) }})</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Pending/Unpaid</span>
                <span class="breakdown-value">{{ $materials->where('status', 'pending')->count() }} items (₱{{ number_format($materials->where('status', 'pending')->sum('total_cost'), 2) }})</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Failed/Returns</span>
                <span class="breakdown-value">{{ $materials->where('status', 'failed')->count() }} items (₱{{ number_format($materials->where('status', 'failed')->sum('total_cost'), 2) }})</span>
            </div>
            <div class="breakdown-item total">
                <span class="breakdown-label">Grand Total</span>
                <span class="breakdown-value">₱{{ number_format($totalAmount, 2) }}</span>
            </div>
        </div>

        <!-- Unpaid Invoices Table -->
        <div class="card">
            <div class="card-title">Outstanding Payments</div>

            @if($unpaidMaterials->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Date Received</th>
                            <th>Days Pending</th>
                            <th>Project</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unpaidMaterials->sortBy('date_received') as $material)
                            <tr>
                                <td><strong>{{ $material->supplier ?? 'Unknown' }}</strong></td>
                                <td>{{ $material->material_name ?? 'N/A' }}</td>
                                <td>{{ $material->quantity_received ?? 0 }} {{ $material->unit_of_measure ?? '' }}</td>
                                <td><strong>₱{{ number_format($material->total_cost ?? 0, 2) }}</strong></td>
                                <td>{{ $material->date_received?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $daysPending = $material->date_received ? now()->diffInDays($material->date_received) : 0;
                                    @endphp
                                    {{ $daysPending }} days
                                </td>
                                <td>{{ $material->project?->project_name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ strtolower($material->status ?? 'unpaid') }}">
                                        {{ $material->status ?? 'Unpaid' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>All invoices are paid! Great work.</p>
                </div>
            @endif
        </div>

        <!-- All Payments History -->
        <div class="card">
            <div class="card-title">All Payment Records</div>

            @if($materials->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Material</th>
                            <th>Amount</th>
                            <th>Date Received</th>
                            <th>Project</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materials->sortByDesc('date_received') as $material)
                            <tr>
                                <td><strong>{{ $material->supplier ?? 'Unknown' }}</strong></td>
                                <td>{{ $material->material_name ?? 'N/A' }}</td>
                                <td>₱{{ number_format($material->total_cost ?? 0, 2) }}</td>
                                <td>{{ $material->date_received?->format('M d, Y') ?? 'N/A' }}</td>
                                <td>{{ $material->project?->project_name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-{{ $material->status === 'approved' ? 'paid' : ($material->status === 'pending' ? 'pending' : 'unpaid') }}">
                                        {{ $material->status === 'approved' ? 'Paid' : ucfirst($material->status ?? 'Unpaid') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-data">
                    <p>No payment records found</p>
                </div>
            @endif
        </div>
        </main>
    </div>

    <script>
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
</body>
</html>
