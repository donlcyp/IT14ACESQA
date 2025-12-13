@extends('layouts.app')

@section('content')
<div style="padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; margin-bottom: 30px; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="margin: 0 0 5px 0; font-size: 28px; font-weight: 700;">{{ $employee->f_name }} {{ $employee->l_name }}</h1>
        <p style="margin: 0; font-size: 14px; opacity: 0.9;">Position: {{ $employee->position ?? 'N/A' }} - Validation History</p>
    </div>
    <a href="{{ route('attendance-validation.index') }}" style="background: rgba(255,255,255,0.2); color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<!-- Statistics for this employee -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    @php
        $stats = [
            'total' => $validationHistory->total(),
            'approved' => $validationHistory->total() > 0 ? $validationHistory->where('validation_status', 'approved')->count() : 0,
            'rejected' => $validationHistory->total() > 0 ? $validationHistory->where('validation_status', 'rejected')->count() : 0,
            'pending' => $validationHistory->total() > 0 ? $validationHistory->where('validation_status', 'pending')->count() : 0,
        ];
    @endphp

    <div style="background: white; padding: 20px; border-radius: 10px; border-left: 4px solid #3b82f6; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 8px;">TOTAL RECORDS</div>
        <div style="font-size: 32px; font-weight: 700; color: #3b82f6;">{{ $validationHistory->total() }}</div>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; border-left: 4px solid #0369a1; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 8px;">APPROVED</div>
        <div style="font-size: 32px; font-weight: 700; color: #0369a1;">
            @if($validationHistory->total() > 0)
                {{ $validationHistory->where('validation_status', 'approved')->count() }}
            @else
                0
            @endif
        </div>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; border-left: 4px solid #f59e0b; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 8px;">REJECTED</div>
        <div style="font-size: 32px; font-weight: 700; color: #f59e0b;">
            @if($validationHistory->total() > 0)
                {{ $validationHistory->where('validation_status', 'rejected')->count() }}
            @else
                0
            @endif
        </div>
    </div>

    <div style="background: white; padding: 20px; border-radius: 10px; border-left: 4px solid #ef4444; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 8px;">PENDING</div>
        <div style="font-size: 32px; font-weight: 700; color: #ef4444;">
            @if($validationHistory->total() > 0)
                {{ $validationHistory->where('validation_status', 'pending')->count() }}
            @else
                0
            @endif
        </div>
    </div>
</div>

<!-- Validation History Table -->
<div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    @if($validationHistory->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f3f4f6; border-bottom: 2px solid #e5e7eb;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Date</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Punch In Time</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Late Status</th>
                    <th style="padding: 15px; text-align: center; font-weight: 600; color: #374151; font-size: 14px;">Validation Status</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #374151; font-size: 14px;">Decision Details</th>
                    <th style="padding: 15px; text-align: center; font-weight: 600; color: #374151; font-size: 14px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($validationHistory as $record)
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 15px; color: #1f2937; font-weight: 600;">{{ $record->date->format('Y-m-d') }}</td>
                        <td style="padding: 15px; color: #1f2937;">
                            {{ $record->punch_in_time ? $record->punch_in_time->format('H:i:s') : '—' }}
                        </td>
                        <td style="padding: 15px; color: #1f2937;">
                            @if($record->is_late)
                                <span style="display: inline-block; background: #fecaca; color: #991b1b; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    LATE ({{ $record->late_minutes }}min)
                                </span>
                            @else
                                <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    ON TIME
                                </span>
                            @endif
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            @if($record->validation_status === 'pending')
                                <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-hourglass-half"></i> Pending
                                </span>
                            @elseif($record->validation_status === 'approved')
                                <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-check-circle"></i> Approved
                                </span>
                            @else
                                <span style="display: inline-block; background: #fcd34d; color: #92400e; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-times-circle"></i> Rejected
                                </span>
                            @endif
                        </td>
                        <td style="padding: 15px; color: #6b7280; font-size: 12px;">
                            @if($record->validation_status === 'pending')
                                <span style="color: #9ca3af;">Awaiting decision</span>
                            @else
                                <div>
                                    @if($record->validator)
                                        <strong>By:</strong> {{ $record->validator->name }}<br>
                                    @endif
                                    @if($record->validated_at)
                                        <strong>At:</strong> {{ $record->validated_at->format('Y-m-d H:i') }}<br>
                                    @endif
                                    @if($record->validation_status === 'rejected' && $record->rejection_reason)
                                        <strong>Reason:</strong> {{ $record->rejection_reason }}
                                    @endif
                                    @if($record->validation_notes)
                                        <div style="margin-top: 5px; padding-top: 5px; border-top: 1px solid #e5e7eb;">
                                            <strong>Notes:</strong> {{ Str::limit($record->validation_notes, 50) }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            @if($record->validation_status === 'pending')
                                <a href="{{ route('attendance-validation.show', $record->id) }}" style="display: inline-block; padding: 6px 12px; background: #ef4444; color: white; text-decoration: none; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="fas fa-eye"></i> Review
                                </a>
                            @else
                                <span style="font-size: 12px; color: #9ca3af;">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding: 20px; background: #f9fafb; border-top: 1px solid #e5e7eb;">
            {{ $validationHistory->links() }}
        </div>
    @else
        <div style="padding: 40px; text-align: center; color: #6b7280;">
            <i class="fas fa-inbox" style="font-size: 48px; color: #9ca3af; margin-bottom: 15px; display: block;"></i>
            <h3 style="margin: 15px 0 10px 0; color: #1f2937;">No Records Found</h3>
            <p>No attendance records found for this employee.</p>
        </div>
    @endif
</div>
@endsection
