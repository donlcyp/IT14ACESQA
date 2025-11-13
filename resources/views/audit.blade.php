<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Transaction</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap"
        rel="stylesheet">
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
            --red-600: var(--accent);
            --green-600: #059669;

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
            font-family: var(--text-md-normal-font-family);
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
            opacity: 0.9;
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
            font-family: var(--text-md-normal-font-family);
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

            .audit-table thead th,
            .audit-table tbody td {
                padding: 8px 12px;
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
        .modal-close:hover { background: #f0f0f0; }
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
        .btn-cancel:hover { background: #f9f9f9; }
        .btn-add { background: #0066cc; color: white; border: none; }
        .btn-add:hover { background: #0055aa; }
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

                <!-- Transaction Header -->
                <div class="audit-header">
                    <h1 class="audit-title">Transaction</h1>
                    <div class="audit-actions">
                        <button class="audit-button primary" id="openAddInvoice">
                            <i class="fas fa-plus"></i>
                            Add Invoice
                        </button>
                        <button class="audit-button secondary">
                            <i class="fas fa-file-image"></i>
                            Image Reports
                        </button>
                        <button class="audit-options">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>

                <!-- Transaction Cards -->
                <div class="audit-cards">
                    <!-- Approved Invoice Card -->
                    <div class="audit-card">
                        <div class="audit-card-header">
                            <h2 class="audit-card-title">Approved Invoice</h2>
                            <button class="audit-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="audit-table approved">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Purchase Order ID</th>
                                    <th>Total Amount (P)</th>
                                    <th>Status</th>
                                    <th>Invoice Date</th>
                                    <th>Verification Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($approvedInvoices as $invoice)
                                    @php
                                        $statusClass = match ($invoice->payment_status) {
                                            'paid' => 'paid',
                                            'partial' => 'partial',
                                            default => 'unpaid',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->purchase_order_number ?? '—' }}</td>
                                        <td>₱{{ number_format($invoice->total_amount, 2) }}</td>
                                        <td><span class="status-badge {{ $statusClass }}">{{ ucfirst($invoice->payment_status) }}</span></td>
                                        <td>{{ optional($invoice->invoice_date)->format('Y-m-d') ?? '—' }}</td>
                                        <td>{{ optional($invoice->verification_date)->format('Y-m-d') ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center; padding:20px; color:#6b7280;">No approved invoices yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pending Approvals Card -->
                    <div class="audit-card">
                        <div class="audit-card-header">
                            <h2 class="audit-card-title">Pending Approvals</h2>
                            <button class="audit-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="audit-table pending">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Purchase Order ID</th>
                                    <th>Total Amount (P)</th>
                                    <th>Status</th>
                                    <th>Invoice Date</th>
                                    <th>Date of Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingInvoices as $invoice)
                                    @php
                                        $statusClass = match ($invoice->payment_status) {
                                            'paid' => 'paid',
                                            'partial' => 'partial',
                                            default => 'unpaid',
                                        };
                                    @endphp
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->purchase_order_number ?? '—' }}</td>
                                        <td>₱{{ number_format($invoice->total_amount, 2) }}</td>
                                        <td><span class="status-badge {{ $statusClass }}">{{ ucfirst($invoice->payment_status) }}</span></td>
                                        <td>{{ optional($invoice->invoice_date)->format('Y-m-d') ?? '—' }}</td>
                                        <td>{{ optional($invoice->payment_date)->format('Y-m-d') ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center; padding:20px; color:#6b7280;">No pending invoices right now.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Audit Logs Card -->
                    <div class="audit-card">
                        <div class="audit-card-header">
                            <h2 class="audit-card-title">Transaction Logs</h2>
                            <button class="audit-expand">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </button>
                        </div>
                        <table class="audit-table logs">
                            <thead>
                                <tr>
                                    <th>Log ID</th>
                                    <th>Action</th>
                                    <th>User</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoiceLogs as $log)
                                    @php
                                        $timestamp = optional($log->created_at)
                                            ? $log->created_at
                                                ->timezone(config('app.timezone'))
                                                ->format('g:i A T, M d, Y')
                                            : '—';
                                    @endphp
                                    <tr>
                                        <td>LOG{{ str_pad((string) $log->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>Created Invoice {{ $log->invoice_number }}</td>
                                        <td>{{ optional($log->creator)->name ?? 'System' }}</td>
                                        <td>{{ $timestamp }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align:center; padding:20px; color:#6b7280;">No transaction logs available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @include('partials.sidebar-js')
    
    <!-- Add Invoice Modal -->
    <div class="modal-overlay" id="addInvoiceModal" aria-hidden="true">
      <div class="modal-content" role="dialog" aria-modal="true">
        <form id="invoiceForm" action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="modal-close" id="invoiceCloseBtn" aria-label="Close">&times;</div>
            <h2 class="modal-title">
              <svg viewBox="0 0 24 24"><path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/></svg>
              Add Invoice
            </h2>
            <div class="form-group">
              <div class="checkbox-group">
                <label class="checkbox-item">
                  <input type="radio" name="approval_status" value="approved" {{ old('approval_status', 'pending') === 'approved' ? 'checked' : '' }} />
                  <span>Approved</span>
                </label>
                <label class="checkbox-item">
                  <input type="radio" name="approval_status" value="pending" {{ old('approval_status', 'pending') === 'pending' ? 'checked' : '' }} />
                  <span>Pending</span>
                </label>
              </div>
              @error('approval_status')
                  <p class="form-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="invoiceNo">Invoice No.</label>
              <input type="text" id="invoiceNo" name="invoice_number" class="form-input" value="{{ old('invoice_number') }}" required />
              @error('invoice_number')
                  <p class="form-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="purchaseOrder">Purchase Order ID</label>
              <input type="text" id="purchaseOrder" name="purchase_order_number" class="form-input" value="{{ old('purchase_order_number') }}" />
              @error('purchase_order_number')
                  <p class="form-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="totalAmount">Total Amount</label>
              <input type="number" id="totalAmount" name="total_amount" class="form-input" placeholder="₱ -" value="{{ old('total_amount') }}" min="0" step="0.01" required />
              @error('total_amount')
                  <p class="form-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="status">Payment Status</label>
              <select id="status" name="payment_status" class="form-select" required>
                <option value="" disabled {{ old('payment_status') ? '' : 'selected' }}>Select status</option>
                <option value="paid" {{ old('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ old('payment_status', 'unpaid') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="partial" {{ old('payment_status') === 'partial' ? 'selected' : '' }}>Partially Paid</option>
              </select>
              @error('payment_status')
                  <p class="form-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="date-row">
              <div class="form-group">
                <label class="form-label" for="invoiceDate">Invoice Date</label>
                <div class="input-wrapper">
                  <input type="date" id="invoiceDate" name="invoice_date" class="form-input" value="{{ old('invoice_date') }}" />
                  <svg class="calendar-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                  </svg>
                </div>
                @error('invoice_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group">
                <label class="form-label" for="verificationDate">Verification Date</label>
                <div class="input-wrapper">
                  <input type="date" id="verificationDate" name="verification_date" class="form-input" value="{{ old('verification_date') }}" />
                  <svg class="calendar-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                  </svg>
                </div>
                @error('verification_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label class="form-label" for="paymentDate">Payment Date</label>
              <div class="input-wrapper">
                <input type="date" id="paymentDate" name="payment_date" class="form-input" value="{{ old('payment_date') }}" />
                <svg class="calendar-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                </svg>
              </div>
              @error('payment_date')
                  <p class="form-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="button-group">
              <button class="btn btn-cancel" id="invoiceCancelBtn" type="button">Cancel</button>
              <button class="btn btn-add" type="submit">Add</button>
            </div>
        </form>
      </div>
    </div>

    <script>
      (function(){
        const openBtn = document.getElementById('openAddInvoice');
        const modal = document.getElementById('addInvoiceModal');
        const closeBtn = document.getElementById('invoiceCloseBtn');
        const cancelBtn = document.getElementById('invoiceCancelBtn');
        const invoiceForm = document.getElementById('invoiceForm');

        function openModal(shouldReset = true){
          if (!modal) return;
          modal.classList.add('active');
          modal.setAttribute('aria-hidden','false');

          if (invoiceForm) {
            if (shouldReset) {
              invoiceForm.reset();
            }

            const defaultApproval = invoiceForm.querySelector('input[name="approval_status"][value="pending"]');
            if (shouldReset && defaultApproval && !Array.from(invoiceForm.querySelectorAll('input[name="approval_status"]')).some(radio => radio.checked)) {
              defaultApproval.checked = true;
            }

            const firstFocusable = invoiceForm.querySelector('input, select, textarea');
            if (firstFocusable) {
              firstFocusable.focus();
            }
          }
        }

        function closeModal(){
          if (!modal) return;
          modal.classList.remove('active');
          modal.setAttribute('aria-hidden','true');
          if (invoiceForm) {
            invoiceForm.reset();
          }
        }

        if (openBtn) {
          openBtn.addEventListener('click', () => openModal(true));
        }
        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        if (modal) {
          modal.addEventListener('click', function(e){ if(e.target === modal){ closeModal(); } });
        }
        document.addEventListener('keydown', function(e){ if(e.key === 'Escape'){ closeModal(); } });

        const shouldOpenInvoiceModal = {{ $errors->any() ? 'true' : 'false' }};
        if (shouldOpenInvoiceModal) {
          openModal(false);
        }
      })();
    </script>
</body>

</html>