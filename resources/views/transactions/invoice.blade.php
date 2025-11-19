<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --accent: #16a34a;
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
            --green-600: #059669;
            --black-1: #111827;
            --sidebar-bg: #f8fafc;
            --header-bg: var(--accent);
            --main-bg: #ffffff;
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
            font-family: "Inter", sans-serif;
            background-color: var(--main-bg);
            overflow-x: hidden;
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
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 769px) {
            .main-content { 
                margin-left: 280px; 
            }
            .main-content.sidebar-closed { 
                margin-left: 0; 
            }
        }

        @media (max-width: 768px) {
            .main-content { 
                margin-left: 0 !important; 
            }
        }

        .header {
            background: linear-gradient(135deg, var(--header-bg), #16a34a);
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
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .content-area {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f7fafc, #edf2f7);
            border-left: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .invoice-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .invoice-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 24px;
            border-bottom: 2px solid #e5e7eb;
        }

        .company-info h1 {
            font-size: 24px;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 4px;
        }

        .company-info p {
            color: var(--gray-600);
            font-size: 14px;
            margin: 2px 0;
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-meta h2 {
            font-size: 32px;
            color: var(--black-1);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .invoice-meta p {
            color: var(--gray-600);
            font-size: 14px;
            margin: 4px 0;
        }

        .invoice-parties {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .party-info h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--gray-500);
            font-weight: 600;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .party-details {
            background: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .party-details p {
            color: var(--black-1);
            font-size: 14px;
            margin: 4px 0;
        }

        .party-details p:first-child {
            font-weight: 600;
            font-size: 16px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
        }

        .invoice-table thead {
            background: #f9fafb;
        }

        .invoice-table thead th {
            padding: 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            border-bottom: 2px solid #e5e7eb;
        }

        .invoice-table thead th:last-child {
            text-align: right;
        }

        .invoice-table tbody td {
            padding: 16px 12px;
            font-size: 14px;
            color: var(--black-1);
            border-bottom: 1px solid #f3f4f6;
        }

        .invoice-table tbody td:last-child {
            text-align: right;
            font-weight: 500;
        }

        .invoice-totals {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .totals-box {
            width: 350px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            font-size: 14px;
        }

        .total-row.subtotal {
            color: var(--gray-700);
            border-bottom: 1px solid #e5e7eb;
        }

        .total-row.tax {
            color: var(--gray-700);
            border-bottom: 1px solid #e5e7eb;
        }

        .total-row.final {
            font-size: 18px;
            font-weight: 700;
            color: var(--black-1);
            padding-top: 16px;
            border-top: 2px solid var(--accent);
        }

        .total-row .label {
            font-weight: 500;
        }

        .total-row .amount {
            font-weight: 600;
        }

        .invoice-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .action-btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s ease;
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        .action-btn.secondary {
            background: #f3f4f6;
            color: var(--gray-700);
        }

        .action-btn.primary {
            background: var(--accent);
            color: white;
        }

        @media print {
            .invoice-actions {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 20px;
            }

            .invoice-card {
                padding: 24px;
            }

            .invoice-header {
                flex-direction: column;
                gap: 24px;
            }

            .invoice-meta {
                text-align: left;
            }

            .invoice-parties {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .totals-box {
                width: 100%;
            }

            .invoice-actions {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }

        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 20px 0;
        }

        .pagination-info {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
        }

        .pagination-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            height: 36px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .page-btn:hover {
            background-color: rgba(22, 163, 74, 0.1);
        }

        .page-btn.active {
            background: #16a34a;
            color: white;
            font-weight: 600;
        }

        .page-btn.arrow {
            font-size: 20px;
            color: #374151;
        }

        .page-btn.arrow.disabled {
            opacity: 0.5;
            color: #9ca3af;
            cursor: not-allowed;
            pointer-events: none;
        }

        .page-btn.ellipsis {
            padding: 0;
            width: auto;
            height: auto;
            line-height: 1;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content" id="mainContent">
            <header class="header">
                <a href="{{ route('transactions.show', $project->id) }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button class="header-menu" id="headerMenu">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="header-title">AJJ CRISBER Engineering Services</h1>
            </header>

            <section class="content-area">
                <div class="invoice-container">
                    <div class="invoice-card">
                        <!-- Invoice Header -->
                        <div class="invoice-header">
                            <div class="company-info">
                                <h1>AJJ CRISBER Engineering Services</h1>
                                <p>Engineering & Construction Services</p>
                                <p>Philippines</p>
                            </div>
                            <div class="invoice-meta">
                                <h2>INVOICE</h2>
                                <p><strong>Invoice #:</strong> INV-{{ str_pad($project->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p><strong>Date:</strong> {{ date('F d, Y') }}</p>
                                <p><strong>Project:</strong> {{ $project->title }}</p>
                            </div>
                        </div>

                        <!-- Invoice Parties -->
                        <div class="invoice-parties">
                            <div class="party-info">
                                <h3>Bill To</h3>
                                <div class="party-details">
                                    <p>{{ $project->client }}</p>
                                    <p>Project: {{ $project->title }}</p>
                                </div>
                            </div>
                            <div class="party-info">
                                <h3>Supplier</h3>
                                <div class="party-details">
                                    <p>{{ $supplier }}</p>
                                    <p>Supplier Information</p>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Items Table -->
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th>Item Description</th>
                                    <th>Batch/Serial</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $material)
                                    <tr>
                                        <td>{{ $material->name }}</td>
                                        <td>{{ $material->batch ?? 'N/A' }}</td>
                                        <td>{{ $material->quantity }} {{ $material->unit }}</td>
                                        <td>₱{{ number_format($material->price, 2) }}</td>
                                        <td>₱{{ number_format($material->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Invoice Totals -->
                        <div class="invoice-totals">
                            <div class="totals-box">
                                <div class="total-row subtotal">
                                    <span class="label">Subtotal:</span>
                                    <span class="amount">₱{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="total-row tax">
                                    <span class="label">Tax (12%):</span>
                                    <span class="amount">₱{{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="total-row final">
                                    <span class="label">Total:</span>
                                    <span class="amount">₱{{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Actions -->
                        <div class="invoice-actions">
                            <button class="action-btn secondary" onclick="window.print()">
                                <i class="fas fa-print"></i>
                                Print Invoice
                            </button>
                            <button class="action-btn primary" onclick="downloadInvoice()">
                                <i class="fas fa-download"></i>
                                Download PDF
                            </button>
                        </div>
                    </div>

                    @if(isset($failedMaterials) && $failedMaterials->count() > 0)
                        <div class="invoice-card" style="margin-top: 24px;">
                            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px; color: var(--black-1);">
                                <i class="fas fa-undo" style="color: var(--red-600); margin-right: 8px;"></i>
                                Return Invoice - Failed Items
                            </h3>
                            <p style="font-size: 13px; color: var(--gray-600); margin-bottom: 16px;">
                                These materials are marked as <strong>Fail</strong> and are <strong>not included</strong> in the main invoice. Use this section to record the reason for returning each item.
                            </p>

                            <table class="invoice-table">
                                <thead>
                                    <tr>
                                        <th>Item Description</th>
                                        <th>Batch/Serial</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Reason for Returning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($failedMaterials as $failed)
                                        <tr>
                                            <td>{{ $failed->name }}</td>
                                            <td>{{ $failed->batch ?? 'N/A' }}</td>
                                            <td>{{ $failed->quantity }} {{ $failed->unit }}</td>
                                            <td>₱{{ number_format($failed->total, 2) }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('transactions.return-reason.update', $failed->id) }}" style="display: flex; flex-direction: column; gap: 8px;">
                                                    @csrf
                                                    @method('PUT')
                                                    <textarea name="remarks" rows="2" style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #e5e7eb; font-size: 13px; resize: vertical;" placeholder="Enter reason for returning this item">{{ old('remarks', $failed->remarks) }}</textarea>
                                                    <button type="submit" class="action-btn primary" style="padding: 6px 12px; font-size: 12px; align-self: flex-start;">
                                                        <i class="fas fa-save"></i>
                                                        Save Reason
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="invoice-totals">
                                <div class="totals-box">
                                    <div class="total-row subtotal">
                                        <span class="label">Total Failed Items Value:</span>
                                        <span class="amount">₱{{ number_format($failedSubtotal, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Purchase History for this supplier -->
                    @if($purchaseHistory->count() > 0)
                        <div class="invoice-card" style="margin-top: 24px;">
                            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 20px; color: var(--black-1);">
                                <i class="fas fa-history" style="color: var(--accent); margin-right: 8px;"></i>
                                Purchase History - {{ $supplier }}
                            </h3>
                            <table class="invoice-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchaseHistory as $item)
                                        <tr>
                                            <td>{{ $item->date_received ? date('M d, Y', strtotime($item->date_received)) : 'N/A' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>₱{{ number_format($item->price, 2) }}</td>
                                            <td>
                                                <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; 
                                                    @if($item->status == 'Approved') background: #d1fae5; color: #065f46;
                                                    @elseif($item->status == 'Fail') background: #fee2e2; color: #991b1b;
                                                    @else background: #fef3c7; color: #92400e; @endif">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td>₱{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($purchaseHistory instanceof \Illuminate\Pagination\LengthAwarePaginator && $purchaseHistory->hasPages())
                                @php
                                    $currentPage = $purchaseHistory->currentPage();
                                    $lastPage = $purchaseHistory->lastPage();
                                    $pageNumbers = [];
                                    if ($lastPage <= 7) {
                                        for ($i = 1; $i <= $lastPage; $i++) {
                                            $pageNumbers[] = $i;
                                        }
                                    } else {
                                        $pageNumbers[] = 1;
                                        if ($currentPage > 3) {
                                            $pageNumbers[] = '...';
                                        }
                                        $start = max(2, $currentPage - 1);
                                        $end = min($lastPage - 1, $currentPage + 1);
                                        for ($i = $start; $i <= $end; $i++) {
                                            $pageNumbers[] = $i;
                                        }
                                        if ($currentPage < $lastPage - 2) {
                                            $pageNumbers[] = '...';
                                        }
                                        $pageNumbers[] = $lastPage;
                                    }
                                @endphp
                                <div class="pagination-container" style="display: flex; flex-direction: column; align-items: center; gap: 16px; padding: 20px 0;">
                                    <div class="pagination-info" style="color: #6b7280; font-size: 14px; text-align: center;">
                                        Showing {{ $purchaseHistory->firstItem() }} to {{ $purchaseHistory->lastItem() }} of {{ $purchaseHistory->total() }} purchase history records
                                    </div>
                                    <div class="pagination-controls" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                        @if ($purchaseHistory->onFirstPage())
                                            <span class="page-btn disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 14px;">‹</span>
                                        @else
                                            <a class="page-btn" href="{{ $purchaseHistory->previousPageUrl() }}" rel="prev" style="color: #374151; text-decoration: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: white; font-size: 14px; transition: all 0.2s ease;">‹</a>
                                        @endif
                                        <div class="pagination-nav" style="display: flex; align-items: center; gap: 4px;">
                                            @foreach ($pageNumbers as $page)
                                                @if ($page === '...')
                                                    <span class="page-btn ellipsis" style="color: #9ca3af; padding: 8px 4px; font-size: 14px;">…</span>
                                                @elseif ($page == $currentPage)
                                                    <span class="page-btn active" style="background: #16a34a; color: white; font-weight: 600; border-radius: 6px; padding: 8px 12px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; border: 1px solid #16a34a;">{{ $page }}</span>
                                                @else
                                                    <a class="page-btn" href="{{ $purchaseHistory->url($page) }}" style="color: #374151; text-decoration: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: white; font-size: 14px; min-width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s ease;">{{ $page }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                        @if ($purchaseHistory->hasMorePages())
                                            <a class="page-btn" href="{{ $purchaseHistory->nextPageUrl() }}" rel="next" style="color: #374151; text-decoration: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: white; font-size: 14px; transition: all 0.2s ease;">›</a>
                                        @else
                                            <span class="page-btn disabled" style="opacity: 0.5; color: #9ca3af; cursor: not-allowed; pointer-events: none; padding: 8px 12px; border-radius: 6px; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 14px;">›</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')

    <script>
        function downloadInvoice() {
            alert('PDF download functionality would be implemented here using a library like DomPDF or similar.');
        }
    </script>
</body>
</html>
