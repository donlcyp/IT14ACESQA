<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            font-size: 11px;
            line-height: 1.4;
        }
        .page {
            padding: 20px;
            page-break-after: always;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .company-info {
            flex: 1;
        }
        .company-logo {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .company-details {
            font-size: 10px;
            line-height: 1.6;
        }
        .project-info {
            flex: 1;
            text-align: right;
            font-size: 10px;
        }
        .project-info-row {
            margin-bottom: 3px;
        }
        .project-info-label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
        }
        h2 {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 15px 0 10px 0;
            text-decoration: underline;
        }
        .project-summary {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
            font-size: 10px;
        }
        .summary-item {
            border: 1px solid #999;
            padding: 8px;
            background-color: #f0f0f0;
        }
        .summary-label {
            font-weight: bold;
            font-size: 9px;
            color: #666;
        }
        .summary-value {
            font-weight: bold;
            font-size: 11px;
            margin-top: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th {
            background-color: #333;
            color: #fff;
            padding: 6px 4px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #000;
            font-size: 10px;
        }
        td {
            padding: 5px 4px;
            border: 1px solid #999;
            border-bottom: 1px solid #ccc;
        }
        tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .totals-row {
            background-color: #e0e0e0;
            font-weight: bold;
        }
        .section-header {
            background-color: #d0d0d0;
            font-weight: bold;
            padding: 5px 4px;
            border: 1px solid #000;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #000;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            font-size: 10px;
            text-align: center;
        }
        .footer-section {
            border-top: 1px solid #000;
            padding-top: 20px;
            margin-top: 10px;
        }
        .notes {
            margin-top: 20px;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .notes-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <div class="company-logo">AJS Aiji Crisber</div>
                <div class="company-details">
                    <strong>AJJ CRISBER ENGINEERING SERVICES</strong><br>
                    Fire Protection, Sanitary Plumbing, Plans, Design, Estimate, Supervision, Maintenance<br>
                </div>
            </div>
            <div class="project-info">
                <div class="project-info-row">
                    <span class="project-info-label">Project:</span>
                    <span>{{ $project->project_code ?? 'N/A' }}</span>
                </div>
                <div class="project-info-row">
                    <span class="project-info-label">Location:</span>
                    <span>{{ $project->location ?? 'N/A' }}</span>
                </div>
                <div class="project-info-row">
                    <span class="project-info-label">Scope:</span>
                    <span>{{ $project->industry ?? 'N/A' }}</span>
                </div>
                <div class="project-info-row">
                    <span class="project-info-label">Date:</span>
                    <span>{{ $project->created_at->format('F d, Y') ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Title -->
        <h2>{{ $project->project_name }}</h2>

        <!-- Project Summary -->
        <div class="project-summary">
            <div class="summary-item">
                <div class="summary-label">CLIENT</div>
                <div class="summary-value">{{ $project->client_first_name ?? 'N/A' }} {{ $project->client_last_name ?? 'N/A' }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">PROJECT MANAGER</div>
                <div class="summary-value">{{ $project->assignedPM?->name ?? 'Unassigned' }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">STATUS</div>
                <div class="summary-value">{{ $project->status ?? 'N/A' }}</div>
            </div>
            <div class="summary-item">
                <div class="summary-label">BUDGET</div>
                <div class="summary-value">₱{{ number_format($project->allocated_amount ?? 0, 2) }}</div>
            </div>
        </div>

        <!-- Bill of Quantity Table -->
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">ITEM NO</th>
                    <th style="width: 35%;">ITEM DESCRIPTION</th>
                    <th style="width: 8%;">QTY</th>
                    <th style="width: 8%;">UNIT</th>
                    <th style="width: 12%;">MATERIAL</th>
                    <th style="width: 12%;">LABOR</th>
                    <th style="width: 12%;">UNIT RATE</th>
                    <th style="width: 12%;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @if($project->materials && $project->materials->count() > 0)
                    @php
                        $itemNo = 1;
                        $totalQty = 0;
                        $totalMaterial = 0;
                        $totalLabor = 0;
                        $grandTotal = 0;
                    @endphp
                    @foreach($project->materials as $material)
                        @php
                            $materialCost = $material->total_cost ?? 0;
                            $laborCost = 0; // Can be calculated from your data
                            $unitRate = $material->unit_price ?? 0;
                            $itemTotal = $materialCost + $laborCost;
                            
                            $totalQty += $material->quantity_received ?? 0;
                            $totalMaterial += $materialCost;
                            $totalLabor += $laborCost;
                            $grandTotal += $itemTotal;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $itemNo }}</td>
                            <td>{{ $material->material_name ?? 'N/A' }}<br><small>{{ $material->remarks ?? '' }}</small></td>
                            <td class="text-center">{{ $material->quantity_received ?? 0 }}</td>
                            <td class="text-center">{{ $material->unit_of_measure ?? 'pcs' }}</td>
                            <td class="text-right">₱{{ number_format($materialCost, 2) }}</td>
                            <td class="text-right">₱{{ number_format($laborCost, 2) }}</td>
                            <td class="text-right">₱{{ number_format($unitRate, 2) }}</td>
                            <td class="text-right">₱{{ number_format($itemTotal, 2) }}</td>
                        </tr>
                        @php $itemNo++; @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 10px;">No materials available</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Totals Section -->
        <table style="width: 50%; margin-left: auto; margin-right: 0;">
            <tbody>
                <tr class="totals-row">
                    <td style="width: 60%;">Total Material Cost</td>
                    <td class="text-right">₱{{ number_format($totalMaterial ?? 0, 2) }}</td>
                </tr>
                <tr class="totals-row">
                    <td>Total Labor Cost</td>
                    <td class="text-right">₱{{ number_format($totalLabor ?? 0, 2) }}</td>
                </tr>
                <tr class="totals-row" style="background-color: #ffd700; font-size: 12px;">
                    <td>Grand Total</td>
                    <td class="text-right">₱{{ number_format($grandTotal ?? 0, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Notes -->
        <div class="notes">
            <div class="notes-title">Notes:</div>
            <ul style="margin-left: 20px; font-size: 9px;">
                <li>All rates are subject to change based on market conditions</li>
                <li>Delivery and installation charges may apply</li>
                <li>Payment terms: 50% upfront, 50% upon completion</li>
                <li>This BOQ is valid for 30 days from the date above</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-section">
                <strong>Prepared by:</strong><br><br><br>
                ___________________<br>
                Date: {{ now()->format('F d, Y') }}
            </div>
            <div class="footer-section">
                <strong>Checked by:</strong><br><br><br>
                ___________________<br>
                Date: _______________
            </div>
            <div class="footer-section">
                <strong>Approved by:</strong><br><br><br>
                ___________________<br>
                Date: _______________
            </div>
        </div>
    </div>
</body>
</html>
