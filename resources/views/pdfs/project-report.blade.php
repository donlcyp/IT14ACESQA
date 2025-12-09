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
        .project-details {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 8px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
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
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        .update-table td {
            vertical-align: top;
            font-size: 11px;
        }
        .update-title-cell {
            font-weight: bold;
            width: 12%;
            color: #1f2937;
        }
        .update-description-cell {
            width: 35%;
            line-height: 1.5;
            color: #374151;
        }
        .update-status-cell {
            width: 12%;
        }
        .update-by-cell {
            width: 15%;
        }
        .update-date-cell {
            width: 12%;
            white-space: nowrap;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
            margin: 20px 0 10px 0;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }
        .image-container {
            margin: 0;
        }
        .image-wrapper {
            page-break-after: always;
            page-break-inside: avoid;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .image-content {
            background-color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            margin-bottom: 15px;
        }
        .image-content img {
            width: 100%;
            height: auto;
            max-width: 100%;
            object-fit: contain;
        }
        .image-info {
            padding: 12px;
            background-color: #f3f4f6;
            border-top: 1px solid #d1d5db;
            font-size: 12px;
        }
        .image-title {
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .image-meta {
            color: #6b7280;
            font-size: 11px;
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
        <div class="report-title">Project Report</div>
    </div>

    <div class="project-details">
        <div class="detail-row">
            <div class="detail-label">Project Name:</div>
            <div class="detail-value">{{ $project->project_name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Client:</div>
            <div class="detail-value">{{ $project->client_name ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Lead Engineer:</div>
            <div class="detail-value">{{ $project->lead ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Status:</div>
            <div class="detail-value">{{ $project->status }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Created:</div>
            <div class="detail-value">{{ optional($project->created_at)->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="section-title">Assigned Employees</div>
    <table>
        <thead>
            <tr>
                <th>Employee Code</th>
                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($project->employees as $employee)
            <tr>
                <td>{{ 'EMP' . str_pad($employee->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $employee->f_name }} {{ $employee->l_name }}</td>
                <td>{{ $employee->position ?? 'N/A' }}</td>
                <td>{{ $employee->user->role ?? 'Idle' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #9ca3af;">No employees assigned</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($project->documents && $project->documents->count() > 0)
    <div class="image-container">
        @foreach($project->documents as $doc)
            @php
                $isImage = in_array(strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
            @endphp
            @if($isImage)
            <div class="image-wrapper">
                <div style="margin-bottom: 15px;">
                    <div style="font-size: 18px; font-weight: bold; color: #1f2937; margin-bottom: 10px;">{{ $doc->title }}</div>
                    <div style="color: #6b7280; font-size: 12px; margin-bottom: 10px;">
                        Uploaded: {{ $doc->created_at->format('M d, Y H:i') }} | By: {{ $doc->uploader?->name ?? 'Unknown' }} | Size: {{ number_format($doc->file_size / 1024, 2) }} KB
                    </div>
                </div>
                <div class="image-content">
                    <img src="{{ storage_path('app/public/' . $doc->file_path) }}" alt="{{ $doc->title }}">
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif

    @if($project->updates && $project->updates->count() > 0)
    <div class="section-title">Project Updates</div>
    <table class="update-table">
        <thead>
            <tr>
                <th class="update-title-cell">Title</th>
                <th class="update-description-cell">Description</th>
                <th class="update-status-cell">Status</th>
                <th class="update-by-cell">Updated By</th>
                <th class="update-date-cell">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->updates as $update)
            <tr>
                <td class="update-title-cell">{{ $update->title }}</td>
                <td class="update-description-cell" style="white-space: pre-wrap;">{{ $update->description }}</td>
                <td class="update-status-cell">
                    <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; display: inline-block;
                        @if($update->status === 'Completed') background-color: #dcfce7; color: #166534;
                        @else background-color: #bfdbfe; color: #1e40af;
                        @endif
                    ">
                        {{ $update->status === 'Completed' ? 'Complete' : 'Ongoing' }}
                    </span>
                </td>
                <td class="update-by-cell">{{ $update->updatedBy?->name ?? 'Unknown' }}</td>
                <td class="update-date-cell">{{ $update->created_at->format('M d, Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="footer">
        <p>This is an automatically generated report. Generated on {{ now()->format('M d, Y H:i') }}</p>
        <p>&copy; 2025 AJJ CRISBER Engineering Services. All rights reserved.</p>
    </div>
</body>
</html>
