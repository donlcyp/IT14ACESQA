@extends('layouts.attendance-validation')

@section('title', 'Approved Records - AJJ CRISBER Engineering Services')

@section('content')
<div style="padding: 20px; background: linear-gradient(135deg, #0369a1 0%, #1e40af 100%); color: white; margin-bottom: 30px; border-radius: 10px;">
    <h1 style="margin: 0 0 10px 0; font-size: 32px; font-weight: 700;">Approved Attendance Records</h1>
    <p style="margin: 0; font-size: 16px; opacity: 0.9;">All approved punch-in records</p>
</div>

<div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    @if($approvedRecords->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Employee Name</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Position</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Punch In</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Date</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Approved By</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Approved At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($approvedRecords as $record)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 15px; color: #1f2937;">{{ $record->f_name }} {{ $record->l_name }}</td>
                        <td style="padding: 15px; color: #6b7280;">{{ $record->position }}</td>
                        <td style="padding: 15px; color: #1f2937;">{{ $record->punch_in_time->format('H:i:s') }}</td>
                        <td style="padding: 15px; color: #1f2937;">{{ $record->date->format('Y-m-d') }}</td>
                        <td style="padding: 15px; color: #1f2937;">{{ $record->validator?->name ?? 'System' }}</td>
                        <td style="padding: 15px; color: #1f2937;">{{ $record->validated_at?->format('Y-m-d H:i') ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding: 20px; background: #f9fafb; border-top: 1px solid #e5e7eb;">
            {{ $approvedRecords->links() }}
        </div>
    @else
        <div style="padding: 40px; text-align: center; color: #6b7280;">
            <i class="fas fa-check-circle" style="font-size: 48px; color: #0369a1; margin-bottom: 15px; display: block;"></i>
            <h3 style="margin: 15px 0 10px 0; color: #1f2937;">No Approved Records</h3>
            <p>No attendance records have been approved yet.</p>
        </div>
    @endif
</div>

<div style="margin-top: 20px;">
    <a href="{{ route('attendance-validation.index') }}" style="display: inline-block; padding: 10px 20px; background: #3b82f6; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
        <i class="fas fa-arrow-left"></i> Back to Validations
    </a>
</div>
@endsection
