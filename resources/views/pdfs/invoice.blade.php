<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #16a34a;
            padding-bottom: 15px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #16a34a;
        }
        .invoice-title {
            font-size: 20px;
            margin: 20px 0;
            color: #374151;
        }
        .details-section {
            margin: 20px 0;
        }
        .details-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }
        .detail-label {
            font-weight: bold;
            color: #6b7280;
            width: 40%;
        }
        .detail-value {
            width: 60%;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background-color: #f3f4f6;
            border-bottom: 2px solid #d1d5db;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            color: #1f2937;
        }
        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        .total-section {
            text-align: right;
            margin: 20px 0;
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 8px;
        }
        .total-row {
            font-size: 14px;
            margin: 8px 0;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #16a34a;
            margin-top: 10px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">AJJ CRISBER Engineering Services</div>
        <div class="invoice-title">Invoice</div>
    </div>

    <div class="details-section">
        <div class="details-row">
            <div class="detail-label">Invoice Number:</div>
            <div class="detail-value">{{ $invoice->invoice_number }}</div>
        </div>
        <div class="details-row">
            <div class="detail-label">Invoice Date:</div>
            <div class="detail-value">{{ optional($invoice->invoice_date)->format('M d, Y') ?? 'N/A' }}</div>
        </div>
        <div class="details-row">
            <div class="detail-label">PO Number:</div>
            <div class="detail-value">{{ $invoice->purchase_order_number }}</div>
        </div>
        <div class="details-row">
            <div class="detail-label">Approval Status:</div>
            <div class="detail-value">{{ ucfirst($invoice->approval_status) }}</div>
        </div>
        <div class="details-row">
            <div class="detail-label">Payment Status:</div>
            <div class="detail-value">{{ ucfirst($invoice->payment_status) }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Invoice Amount</td>
                <td>₱{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">Subtotal: ₱{{ number_format($invoice->total_amount, 2) }}</div>
        <div class="total-amount">Total: ₱{{ number_format($invoice->total_amount, 2) }}</div>
    </div>

    <div class="footer">
        <p>This is an automatically generated invoice. Generated on {{ now()->format('M d, Y H:i') }}</p>
        <p>&copy; 2025 AJJ CRISBER Engineering Services. All rights reserved.</p>
    </div>
</body>
</html>
