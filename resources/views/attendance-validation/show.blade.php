@extends('layouts.attendance-validation')

@section('title', 'Attendance Review - AJJ CRISBER Engineering Services')

@section('content')
<div style="padding: 20px; background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; margin-bottom: 30px; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="margin: 0 0 5px 0; font-size: 28px; font-weight: 700;">Attendance Review</h1>
        <p style="margin: 0; font-size: 14px; opacity: 0.9;">{{ $attendance->f_name }} {{ $attendance->l_name }} - {{ $attendance->date->format('F d, Y') }}</p>
    </div>
    <a href="{{ route('attendance-validation.index') }}" style="background: rgba(255,255,255,0.2); color: white; padding: 10px 15px; border-radius: 6px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <!-- Main Review Section -->
    <div>
        <!-- Attendance Details Card -->
        <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #1f2937; font-size: 18px;">Attendance Details</h2>
            
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                <div>
                    <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 5px;">EMPLOYEE NAME</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1f2937;">{{ $attendance->f_name }} {{ $attendance->l_name }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 5px;">POSITION</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1f2937;">{{ $attendance->position }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 5px;">PUNCH IN TIME</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1f2937;">
                        {{ $attendance->punch_in_time ? $attendance->punch_in_time->format('H:i:s') : 'N/A' }}
                    </div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #6b7280; font-weight: 600; margin-bottom: 5px;">ATTENDANCE DATE</div>
                    <div style="font-size: 16px; font-weight: 700; color: #1f2937;">{{ $attendance->date->format('Y-m-d') }}</div>
                </div>
            </div>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                    <div style="background: #f0f9ff; padding: 12px; border-radius: 6px; border-left: 3px solid #0ea5e9;">
                        <div style="font-size: 11px; color: #0369a1; font-weight: 600;">LATE STATUS</div>
                        @if($attendance->is_late)
                            <div style="font-size: 18px; font-weight: 700; color: #991b1b;">LATE</div>
                            <div style="font-size: 12px; color: #7f1d1d; margin-top: 5px;">{{ $attendance->late_minutes }} minutes</div>
                        @else
                            <div style="font-size: 18px; font-weight: 700; color: #166534;">ON TIME</div>
                            @if($attendance->grace_period_applied)
                                <div style="font-size: 12px; color: #145a3c; margin-top: 5px;">Grace period applied</div>
                            @endif
                        @endif
                    </div>

                    <div style="background: #f0fdf4; padding: 12px; border-radius: 6px; border-left: 3px solid #0369a1;">
                        <div style="font-size: 11px; color: #065f46; font-weight: 600;">PUNCH OUT</div>
                        @if($attendance->punch_out_time)
                            <div style="font-size: 18px; font-weight: 700; color: #065f46;">{{ $attendance->punch_out_time->format('H:i:s') }}</div>
                            <div style="font-size: 12px; color: #047857; margin-top: 5px;">{{ $attendance->getHoursWorked() }} hrs worked</div>
                        @else
                            <div style="font-size: 18px; font-weight: 700; color: #6b7280;">—</div>
                            <div style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Not yet punched out</div>
                        @endif
                    </div>

                    <div style="background: #fdf2f8; padding: 12px; border-radius: 6px; border-left: 3px solid #ec4899;">
                        <div style="font-size: 11px; color: #831843; font-weight: 600;">VALIDATION STATUS</div>
                        <div style="font-size: 18px; font-weight: 700; color: #be123c;">{{ $attendance->getValidationStatusLabel() }}</div>
                        <div style="font-size: 12px; color: #be185d; margin-top: 5px;">Pending your decision</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee History Card -->
        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #1f2937; font-size: 18px;">Recent Attendance History</h2>
            
            @if($recentRecords->count() > 0)
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f3f4f6;">
                        <tr>
                            <th style="padding: 10px; text-align: left; font-weight: 600; font-size: 12px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Date</th>
                            <th style="padding: 10px; text-align: left; font-weight: 600; font-size: 12px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Punch In</th>
                            <th style="padding: 10px; text-align: left; font-weight: 600; font-size: 12px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Punch Out</th>
                            <th style="padding: 10px; text-align: center; font-weight: 600; font-size: 12px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentRecords as $record)
                            <tr style="border-bottom: 1px solid #e5e7eb; {{ $record->id == $attendance->id ? 'background: #fef3c7;' : '' }}">
                                <td style="padding: 10px; color: #1f2937; font-size: 14px;">{{ $record->date->format('Y-m-d') }}</td>
                                <td style="padding: 10px; color: #1f2937; font-size: 14px;">{{ $record->punch_in_time ? $record->punch_in_time->format('H:i') : '—' }}</td>
                                <td style="padding: 10px; color: #1f2937; font-size: 14px;">{{ $record->punch_out_time ? $record->punch_out_time->format('H:i') : '—' }}</td>
                                <td style="padding: 10px; text-align: center; font-size: 12px;">
                                    @if($record->validation_status === 'pending')
                                        <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-weight: 600;">Pending</span>
                                    @elseif($record->validation_status === 'approved')
                                        <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-weight: 600;">Approved</span>
                                    @else
                                        <span style="display: inline-block; background: #fcd34d; color: #92400e; padding: 4px 8px; border-radius: 4px; font-weight: 600;">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #6b7280; text-align: center; padding: 20px;">No recent records found</p>
            @endif
        </div>
    </div>

    <!-- Action Panel -->
    <div>
        <!-- Approval Form -->
        <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #0369a1;">
            <h3 style="margin-top: 0; color: #1f2937;">Approve Attendance</h3>
            <form method="POST" action="{{ route('attendance-validation.approve', $attendance->id) }}">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 8px;">Validation Notes (Optional)</label>
                    <textarea name="validation_notes" style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 14px; font-family: Arial, sans-serif; resize: vertical; min-height: 80px;" placeholder="Add any notes about this approval..."></textarea>
                </div>
                <button type="submit" style="width: 100%; padding: 12px; background: #0369a1; color: white; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; transition: all 0.3s; font-size: 14px;">
                    <i class="fas fa-check-circle"></i> Approve This Punch-In
                </button>
            </form>
        </div>

        <!-- Rejection Form -->
        <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #ef4444;">
            <h3 style="margin-top: 0; color: #1f2937;">Reject Attendance</h3>
            <form method="POST" action="{{ route('attendance-validation.reject', $attendance->id) }}">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 8px;">Rejection Reason *</label>
                    <select name="rejection_reason" required style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 14px;">
                        <option value="">Select a reason...</option>
                        <option value="Not on site">Not on site</option>
                        <option value="Suspicious activity">Suspicious activity</option>
                        <option value="Duplicate punch-in">Duplicate punch-in</option>
                        <option value="System error">System error</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 8px;">Additional Notes</label>
                    <textarea name="validation_notes" style="width: 100%; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 14px; font-family: Arial, sans-serif; resize: vertical; min-height: 80px;" placeholder="Explain why this punch-in is being rejected..."></textarea>
                </div>

                <button type="submit" onclick="return confirm('Are you sure you want to reject this punch-in? This will mark the employee as absent.');" style="width: 100%; padding: 12px; background: #ef4444; color: white; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; transition: all 0.3s; font-size: 14px;">
                    <i class="fas fa-times-circle"></i> Reject This Punch-In
                </button>
            </form>
        </div>

        <!-- Info Card -->
        <div style="background: #eff6ff; padding: 15px; border-radius: 10px; border-left: 4px solid #0284c7;">
            <div style="font-size: 12px; color: #0369a1; font-weight: 700; margin-bottom: 8px;">
                <i class="fas fa-info-circle"></i> VERIFICATION TIPS
            </div>
            <ul style="margin: 0; padding-left: 20px; font-size: 12px; color: #0369a1; line-height: 1.6;">
                <li>Check if employee was actually on site at punch-in time</li>
                <li>Review employee's location/GPS data if available</li>
                <li>Consider any suspicious patterns or anomalies</li>
                <li>Verify against project schedules and assignments</li>
                <li>Check for duplicate punch-in attempts</li>
            </ul>
        </div>
    </div>
</div>

<style>
    textarea:focus, input:focus, select:focus {
        outline: none;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
@endsection
