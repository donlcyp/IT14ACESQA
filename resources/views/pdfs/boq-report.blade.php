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
            padding: 15px 20px;
            page-break-after: always;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }
        .company-info {
            flex: 1;
        }
        .company-logo {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
            color: #c41e3a;
        }
        .company-details {
            font-size: 10px;
            line-height: 1.5;
            font-weight: bold;
        }
        .company-tagline {
            font-size: 8px;
            color: #666;
            margin-top: 3px;
        }
        .project-info {
            flex: 1;
            text-align: right;
            font-size: 10px;
        }
        .project-info-row {
            margin-bottom: 4px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .project-info-label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
            text-align: right;
        }
        .project-info-value {
            text-align: left;
        }
        .section-header {
            background-color: #d4393d;
            color: white;
            padding: 6px 8px;
            font-weight: bold;
            font-size: 11px;
            margin-top: 8px;
            margin-bottom: 0;
        }
        .section-header-text {
            background-color: #f0f0f0;
            padding: 4px 8px;
            font-size: 10px;
            border-bottom: 1px solid #ccc;
        }
        h2 {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0 5px 0;
        }
        .project-summary {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 9px;
        }
        .summary-item {
            border-left: 3px solid #c41e3a;
            padding: 6px 8px;
            background-color: #fff;
        }
        .summary-label {
            font-weight: bold;
            font-size: 8px;
            color: #666;
            text-transform: uppercase;
        }
        .summary-value {
            font-weight: bold;
            font-size: 10px;
            margin-top: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }
        th {
            background-color: #333;
            color: #fff;
            padding: 6px 4px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #000;
            font-size: 9px;
        }
        td {
            padding: 4px 4px;
            border: 1px solid #ccc;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
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
            border: 1px solid #000;
        }
        .grand-total-row {
            background-color: #d4d4d4;
            font-weight: bold;
            border: 1px solid #000;
            font-size: 11px;
        }
        .category-total-row {
            background-color: #f0f0f0;
            font-weight: bold;
            border: 1px solid #999;
        }
        .vat-row {
            background-color: #f0f0f0;
            font-weight: bold;
            border: 1px solid #999;
            font-size: 10px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            font-size: 9px;
        }
        .footer-section {
            border-top: 1px solid #000;
            padding-top: 15px;
            text-align: center;
        }
        .footer-section strong {
            display: block;
            margin-bottom: 40px;
        }
        .page-info {
            text-align: right;
            font-size: 9px;
            margin-top: 20px;
        }
        .item-description {
            font-size: 10px;
        }
        .item-notes {
            font-size: 8px;
            color: #666;
            font-style: italic;
        }
        .category-section {
            page-break-inside: avoid;
            margin-bottom: 8px;
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
                    AJJ CRISBER ENGINEERING SERVICES
                </div>
                <div class="company-tagline">
                    Fire Protection, Sanitary Plumbing, Fire Alarm<br>
                    Design & Build, Design Estimate, Supervision, Maintenance
                </div>
            </div>
            <div class="project-info">
                <div class="project-info-row">
                    <span class="project-info-label">Project:</span>
                    <span class="project-info-value">{{ $project->project_name ?? $project->project_code ?? 'N/A' }}</span>
                </div>
                <div class="project-info-row">
                    <span class="project-info-label">Location:</span>
                    <span class="project-info-value">{{ $project->location ?? 'N/A' }}</span>
                </div>
                <div class="project-info-row">
                    <span class="project-info-label">Scope:</span>
                    <span class="project-info-value">{{ $project->project_type ?? $project->industry ?? 'N/A' }}</span>
                </div>
                <div class="project-info-row">
                    <span class="project-info-label">Date:</span>
                    <span class="project-info-value">{{ $project->created_at->format('F d, Y') ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Project Summary -->
        <div class="project-summary">
            <div class="summary-item">
                <div class="summary-label">CLIENT</div>
                <div class="summary-value">{{ $project->client?->company_name ?? trim($project->client_first_name . ' ' . $project->client_last_name) }}</div>
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
        @php
            $materials = $project->materials ?? collect();
            $groupedByCategory = $materials->groupBy('category');
            $overallTotal = 0;
            $overallMaterial = 0;
            $overallLabor = 0;
        @endphp

        @if($materials->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 4%;">ITEM NO</th>
                        <th style="width: 30%;">ITEM DESCRIPTION</th>
                        <th style="width: 6%;">QTY</th>
                        <th style="width: 8%;">UNIT</th>
                        <th style="width: 13%;">MATERIAL</th>
                        <th style="width: 13%;">LABOR</th>
                        <th style="width: 13%;">UNIT RATE</th>
                        <th style="width: 13%;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @php $itemNo = 1; @endphp
                    
                    @forelse($groupedByCategory as $category => $categoryItems)
                        <!-- Category Header -->
                        @if($category)
                            <tr class="section-header">
                                <td colspan="8" class="section-header" style="border: none; background-color: #d4393d; color: white;">
                                    {{ strtoupper($category) }}
                                </td>
                            </tr>
                        @endif

                        @php
                            $categoryMaterial = 0;
                            $categoryLabor = 0;
                            $categoryTotal = 0;
                        @endphp

                        @foreach($categoryItems as $material)
                            @php
                                $materialCost = $material->material_cost ?? 0;
                                $laborCost = $material->labor_cost ?? 0;
                                $unitRate = $materialCost + $laborCost;
                                $quantity = $material->quantity ?? 0;
                                $itemTotal = $unitRate * $quantity;
                                
                                $categoryMaterial += $materialCost * $quantity;
                                $categoryLabor += $laborCost * $quantity;
                                $categoryTotal += $itemTotal;
                                $overallTotal += $itemTotal;
                                $overallMaterial += $materialCost * $quantity;
                                $overallLabor += $laborCost * $quantity;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $itemNo }}</td>
                                <td>
                                    <div class="item-description"><strong>{{ $material->item_description ?? 'N/A' }}</strong></div>
                                    @if($material->notes)
                                        <div class="item-notes">{{ $material->notes }}</div>
                                    @endif
                                </td>
                                <td class="text-center">{{ $quantity }}</td>
                                <td class="text-center">{{ $material->unit ?? 'pcs' }}</td>
                                <td class="text-right">₱{{ number_format($materialCost, 2) }}</td>
                                <td class="text-right">₱{{ number_format($laborCost, 2) }}</td>
                                <td class="text-right">₱{{ number_format($unitRate, 2) }}</td>
                                <td class="text-right">₱{{ number_format($itemTotal, 2) }}</td>
                            </tr>
                            @php $itemNo++; @endphp
                        @endforeach

                        <!-- Category Subtotal -->
                        <tr class="category-total-row">
                            <td colspan="4" class="text-right"><strong>Subtotal for {{ $category ?? 'Uncategorized' }}</strong></td>
                            <td class="text-right">₱{{ number_format($categoryMaterial, 2) }}</td>
                            <td class="text-right">₱{{ number_format($categoryLabor, 2) }}</td>
                            <td class="text-right"></td>
                            <td class="text-right">₱{{ number_format($categoryTotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center" style="padding: 20px;">No materials available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Grand Totals Section -->
            <table style="width: 60%; margin-left: auto;">
                <tbody>
                    <tr class="totals-row">
                        <td style="width: 60%;">Sub Total Material</td>
                        <td class="text-right">₱{{ number_format($overallMaterial, 2) }}</td>
                    </tr>
                    <tr class="totals-row">
                        <td>Sub Total Labor</td>
                        <td class="text-right">₱{{ number_format($overallLabor, 2) }}</td>
                    </tr>
                    <tr class="vat-row">
                        <td><strong>VAT 12%</strong></td>
                        <td class="text-right"><strong>₱{{ number_format(($overallMaterial + $overallLabor) * 0.12, 2) }}</strong></td>
                    </tr>
                    <tr class="grand-total-row">
                        <td><strong>Grand Total w/ VAT</strong></td>
                        <td class="text-right"><strong>₱{{ number_format(($overallMaterial + $overallLabor) * 1.12, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 40px; color: #999;">
                No Bill of Quantity items available
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div class="footer-section">
                <strong>Submitted by:</strong>
                <br><br><br>
                ___________________<br>
                <strong>CRISBEN B. BERSONG</strong><br>
                General Manager
            </div>
            <div class="footer-section">
                <strong>Approved by:</strong>
                <br><br><br>
                ___________________<br>
                Date: _______________
            </div>
        </div>

        <div class="page-info">
            Generated: {{ now()->format('F d, Y H:i') }}
        </div>
    </div>
</body>
</html>
