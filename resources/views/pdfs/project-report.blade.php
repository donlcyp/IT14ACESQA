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
            margin: 15px 0;
            page-break-inside: avoid;
        }
        .image-wrapper {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 15px;
        }
        .image-content {
            max-height: 300px;
            overflow: hidden;
            background-color: #f9fafb;
        }
        .image-content img {
            width: 100%;
            height: auto;
        }
        .image-info {
            padding: 10px 12px;
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
    <div class="section-title">Documentation Images</div>
    <div class="image-container">
        @foreach($project->documents as $doc)
        <div class="image-wrapper">
            <div class="image-content">
                <img src="{{ storage_path('app/public/' . $doc->file_path) }}" alt="{{ $doc->title }}">
            </div>
            <div class="image-info">
                <div class="image-title">{{ $doc->title }}</div>
                <div class="image-meta">
                    Uploaded: {{ $doc->created_at->format('M d, Y H:i') }} | By: {{ $doc->uploader?->name ?? 'Unknown' }} | Size: {{ number_format($doc->file_size / 1024, 2) }} KB
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($project->updates && $project->updates->count() > 0)
    <div class="section-title">Project Updates</div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Updated By</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->updates as $update)
            <tr>
                <td style="font-weight: bold;">{{ $update->title }}</td>
                <td>{{ Str::limit($update->description, 100) }}</td>
                <td>
                    <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;
                        @if($update->status === 'Completed') background-color: #dcfce7; color: #166534;
                        @elseif($update->status === 'In Progress') background-color: #bfdbfe; color: #1e40af;
                        @elseif($update->status === 'On Hold') background-color: #fef3c7; color: #92400e;
                        @elseif($update->status === 'Cancelled') background-color: #fee2e2; color: #991b1b;
                        @else background-color: #f3f4f6; color: #1f2937;
                        @endif
                    ">
                        {{ $update->status }}
                    </span>
                </td>
                <td>{{ $update->updatedBy?->name ?? 'Unknown' }}</td>
                <td>{{ $update->created_at->format('M d, Y H:i') }}</td>
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
