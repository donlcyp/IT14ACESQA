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
        .summary-cards {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            gap: 20px;
            flex-wrap: wrap;
        }
        .summary-card {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            background-color: #f9fafb;
            border-left: 4px solid #16a34a;
            border-radius: 4px;
        }
        .card-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .card-value {
            font-size: 24px;
            font-weight: bold;
            color: #16a34a;
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
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin: 30px 0 15px 0;
            border-bottom: 2px solid #16a34a;
            padding-bottom: 8px;
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
        <div class="report-title">Finance Summary</div>
    </div>

    <div class="summary-cards">
        <div class="summary-card">
            <div class="card-label">Total Revenue</div>
            <div class="card-value">₱0.00</div>
        </div>
        <div class="summary-card">
            <div class="card-label">Total Expenses</div>
            <div class="card-value">₱0.00</div>
        </div>
        <div class="summary-card">
            <div class="card-label">Net Income</div>
            <div class="card-value">₱0.00</div>
        </div>
    </div>

    <div class="section-title">Invoice Summary</div>
    <table>
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Approval Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" style="text-align: center; color: #9ca3af; padding: 20px;">
                    Financial data will be populated from database queries
                </td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">Budget Status</div>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Budgeted</th>
                <th>Spent</th>
                <th>Remaining</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" style="text-align: center; color: #9ca3af; padding: 20px;">
                    Budget data will be populated from database queries
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
