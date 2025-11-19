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
        .report-title {
            font-size: 20px;
            margin: 20px 0;
            color: #374151;
        }
        .filter-info {
            font-size: 12px;
            color: #6b7280;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 11px;
        }
        table thead {
            background-color: #f3f4f6;
            border-bottom: 2px solid #d1d5db;
        }
        table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            color: #1f2937;
        }
        table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        .status-unpaid {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status-partial {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">AJJ CRISBER Engineering Services</div>
        <div class="report-title">Transaction Report</div>
    </div>

    <div class="filter-info">
        @if($filters['date_from'] || $filters['date_to'])
            <strong>Period:</strong> 
            {{ $filters['date_from'] ?? 'N/A' }} to {{ $filters['date_to'] ?? 'N/A' }}
        @endif
        @if($filters['status'])
            | <strong>Status:</strong> {{ ucfirst($filters['status']) }}
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>PO #</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Approval Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6" style="text-align: center; color: #9ca3af; padding: 20px;">
                    Transaction data will be populated from database queries
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>This is an automatically generated report. Generated on {{ now()->format('M d, Y H:i') }}</p>
        <p>&copy; 2025 AJJ CRISBER Engineering Services. All rights reserved.</p>
    </div>
</body>
</html>
