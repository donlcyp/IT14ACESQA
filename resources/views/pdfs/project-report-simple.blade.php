<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Report - {{ $project->project_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            color: #1f2937;
            line-height: 1.6;
        }
        
        .header {
            background-color: #1e40af;
            color: white;
            padding: 30px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .section-title {
            background-color: #f3f4f6;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            border-left: 4px solid #1e40af;
            margin-bottom: 15px;
        }
        
        .content {
            padding: 0 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        th, td {
            border: 1px solid #d1d5db;
            padding: 12px;
            text-align: left;
        }
        
        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #374151;
        }
        
        .info-value {
            flex: 1;
            color: #6b7280;
        }
        
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .stat-item {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #d1d5db;
            font-size: 12px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $project->project_name }}</h1>
        <p>Project Report</p>
        <p style="font-size: 12px; margin-top: 10px;">Generated on {{ now()->format('M d, Y H:i:s') }}</p>
    </div>

    <!-- Project Summary -->
    <div class="section">
        <div class="section-title">Project Summary</div>
        <div class="content">
            @php
                $effectiveUsedAmount = $project->getEffectiveUsedAmount();
                $budgetUtilized = $project->allocated_amount > 0 ? round(($effectiveUsedAmount / $project->allocated_amount) * 100, 2) : 0;
            @endphp
            <div class="stat-grid">
                <div class="stat-item">
                    <div class="stat-value">{{ $project->employees->count() }}</div>
                    <div class="stat-label">Assigned Employees</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">₱{{ number_format($effectiveUsedAmount, 2) }}</div>
                    <div class="stat-label">Amount Used</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $budgetUtilized }}%</div>
                    <div class="stat-label">Budget Utilized</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Details -->
    <div class="section">
        <div class="section-title">Project Details</div>
        <div class="content">
            <div class="info-row">
                <span class="info-label">Project Name:</span>
                <span class="info-value">{{ $project->project_name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Description:</span>
                <span class="info-value">{{ $project->description ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Location:</span>
                <span class="info-value">{{ $project->location ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Industry:</span>
                <span class="info-value">{{ $project->industry ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value">{{ $project->status ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Client:</span>
                <span class="info-value">{{ $project->client?->company_name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Project Manager:</span>
                <span class="info-value">{{ $project->assignedPM?->name ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Allocated Budget:</span>
                <span class="info-value">₱{{ number_format($project->allocated_amount ?? 0, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Project Timeline -->
    <div class="section">
        <div class="section-title">Project Timeline</div>
        <div class="content">
            <div class="info-row">
                <span class="info-label">Start Date:</span>
                <span class="info-value">{{ $project->date_started?->format('M d, Y') ?? 'Not set' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">End Date:</span>
                <span class="info-value">{{ $project->date_ended?->format('M d, Y') ?? 'Not set' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Target Timeline:</span>
                <span class="info-value">{{ $project->target_timeline?->format('M d, Y') ?? 'Not set' }}</span>
            </div>
        </div>
    </div>

    <!-- Assigned Employees -->
    @if($project->employees && $project->employees->count() > 0)
    <div class="section">
        <div class="section-title">Assigned Employees ({{ $project->employees->count() }})</div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Position</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->employees as $employee)
                    <tr>
                        <td>{{ $employee->f_name }} {{ $employee->l_name ?? '' }}</td>
                        <td>{{ $employee->position ?? 'N/A' }}</td>
                        <td>{{ $employee->user?->role ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Project Updates -->
    @if($project->updates && $project->updates->count() > 0)
    <div class="section">
        <div class="section-title">Project Updates</div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->updates as $update)
                    <tr>
                        <td>{{ $update->title }}</td>
                        <td>{{ substr($update->description ?? '', 0, 100) }}...</td>
                        <td>{{ $update->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Documentation Files -->
    @if($project->documents && $project->documents->count() > 0)
    <div class="section">
        <div class="section-title">Documentation & Attachments</div>
        <div class="content">
            @foreach($project->documents as $doc)
                @php
                    $isImage = in_array(strtolower(pathinfo($doc->file_name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    $fileExt = strtoupper(pathinfo($doc->file_name, PATHINFO_EXTENSION));
                @endphp
                <div style="margin-bottom: 30px; padding: 15px; border: 1px solid #e5e7eb; border-radius: 8px; page-break-inside: avoid;">
                    <div style="margin-bottom: 10px;">
                        <strong style="font-size: 16px; color: #1e40af;">{{ $doc->title }}</strong>
                        <p style="font-size: 12px; color: #6b7280; margin-top: 5px;">
                            Type: {{ $fileExt }} | Size: {{ number_format($doc->file_size / 1024, 2) }} KB | Uploaded: {{ $doc->created_at->format('M d, Y H:i') }} by {{ $doc->uploader?->name ?? 'Unknown' }}
                        </p>
                    </div>
                    
                    @if($isImage)
                        <!-- Display Image -->
                        <div style="text-align: center; margin-top: 15px;">
                            <img src="{{ storage_path('app/public/' . $doc->file_path) }}" 
                                 alt="{{ $doc->title }}" 
                                 style="max-width: 100%; height: auto; border-radius: 4px; max-height: 500px;">
                        </div>
                    @else
                        <!-- Document Info for non-image files -->
                        <div style="background: #f9fafb; padding: 12px; border-radius: 4px; margin-top: 10px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @if(str_contains($doc->mime_type, 'pdf'))
                                    <span style="font-size: 32px; color: #dc2626;">📄</span>
                                    <div>
                                        <strong>PDF Document</strong>
                                        <p style="font-size: 12px; color: #6b7280; margin: 3px 0;">
                                            This is a PDF file. Open the attached file to view its contents.
                                        </p>
                                    </div>
                                @elseif(str_contains($doc->mime_type, 'word') || str_contains($doc->file_name, 'docx') || str_contains($doc->file_name, 'doc'))
                                    <span style="font-size: 32px; color: #2563eb;">📝</span>
                                    <div>
                                        <strong>Word Document</strong>
                                        <p style="font-size: 12px; color: #6b7280; margin: 3px 0;">
                                            This is a Word document. Open the attached file to view its contents.
                                        </p>
                                    </div>
                                @elseif(str_contains($doc->mime_type, 'excel') || str_contains($doc->mime_type, 'spreadsheet') || str_contains($doc->file_name, 'xlsx') || str_contains($doc->file_name, 'xls'))
                                    <span style="font-size: 32px; color: #1e40af;">📊</span>
                                    <div>
                                        <strong>Excel Spreadsheet</strong>
                                        <p style="font-size: 12px; color: #6b7280; margin: 3px 0;">
                                            This is an Excel spreadsheet. Open the attached file to view its data.
                                        </p>
                                    </div>
                                @elseif(str_contains($doc->mime_type, 'zip') || str_contains($doc->file_name, 'zip'))
                                    <span style="font-size: 32px; color: #9333ea;">📦</span>
                                    <div>
                                        <strong>Compressed Archive</strong>
                                        <p style="font-size: 12px; color: #6b7280; margin: 3px 0;">
                                            This is a ZIP archive file. Open the attached file to access its contents.
                                        </p>
                                    </div>
                                @else
                                    <span style="font-size: 32px; color: #6b7280;">📎</span>
                                    <div>
                                        <strong>Attached File</strong>
                                        <p style="font-size: 12px; color: #6b7280; margin: 3px 0;">
                                            Open the attached file to view its contents.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="footer">
        <p>This is an auto-generated report from the Project Management System</p>
    </div>
</body>
</html>
