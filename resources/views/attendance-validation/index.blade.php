@extends('layouts.attendance-validation')

@section('title', 'Attendance Validation - AJJ CRISBER Engineering Services')

@section('content')
<div style="padding: 12px 16px; background: #1e40af; color: white; margin-bottom: 16px; border-radius: 8px;">
    <h1 style="margin: 0 0 4px 0; font-size: 20px; font-weight: 700;">Attendance Validation</h1>
    <p style="margin: 0; font-size: 13px; opacity: 0.9;">Approve or reject employee punch-in records</p>
</div>

<!-- Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; margin-bottom: 16px;">
    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #ef4444; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">PENDING</div>
        <div style="font-size: 24px; font-weight: 700; color: #ef4444;">{{ $stats['pending'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">Waiting for approval</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #0369a1; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">APPROVED</div>
        <div style="font-size: 24px; font-weight: 700; color: #0369a1;">{{ $stats['approved'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">Records approved</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #f59e0b; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">REJECTED</div>
        <div style="font-size: 24px; font-weight: 700; color: #f59e0b;">{{ $stats['rejected'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">Records rejected</div>
    </div>

    <div style="background: white; padding: 12px; border-radius: 8px; border-left: 3px solid #3b82f6; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 6px;">TOTAL</div>
        <div style="font-size: 24px; font-weight: 700; color: #3b82f6;">{{ $stats['total'] }}</div>
        <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">Total records</div>
    </div>
</div>

<!-- Filter Section -->
<div style="background: white; padding: 12px 16px; border-radius: 8px; margin-bottom: 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
    <h3 style="margin-top: 0; margin-bottom: 12px; color: #1f2937; font-size: 13px;">Filter Pending Validations</h3>
    <form action="{{ route('attendance-validation.filter') }}" method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 10px; align-items: flex-end;">
        <div>
            <label style="display: block; font-size: 10px; font-weight: 600; color: #6b7280; margin-bottom: 4px;">Search by Name</label>
            <input type="text" name="search" placeholder="First or Last Name" value="{{ request('search') }}" style="width: 100%; padding: 6px 8px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 12px;">
        </div>
        <div>
            <label style="display: block; font-size: 10px; font-weight: 600; color: #6b7280; margin-bottom: 4px;">Date</label>
            <input type="date" name="date" value="{{ request('date') }}" style="width: 100%; padding: 6px 8px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 12px;">
        </div>
        <div>
            <label style="display: block; font-size: 10px; font-weight: 600; color: #6b7280; margin-bottom: 4px;">Late Status</label>
            <select name="is_late" style="width: 100%; padding: 6px 8px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 12px;">
                <option value="">All</option>
                <option value="1" {{ request('is_late') == '1' ? 'selected' : '' }}>Late</option>
                <option value="0" {{ request('is_late') == '0' ? 'selected' : '' }}>On Time</option>
            </select>
        </div>
        <button type="submit" style="background: #3b82f6; color: white; padding: 6px 12px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-size: 12px;">
            <i class="fas fa-filter"></i> Filter
        </button>
    </form>
</div>

<!-- Pending Validations Table -->
<div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,0.08);">
    @if($pendingValidations->count() > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #f3f4f6; border-bottom: 1px solid #e5e7eb;">
                <tr>
                    <th style="padding: 10px 12px; text-align: left; font-weight: 600; color: #374151; font-size: 12px;">Employee Name</th>
                    <th style="padding: 10px 12px; text-align: left; font-weight: 600; color: #374151; font-size: 12px;">Position</th>
                    <th style="padding: 10px 12px; text-align: left; font-weight: 600; color: #374151; font-size: 12px;">Punch In Time</th>
                    <th style="padding: 10px 12px; text-align: left; font-weight: 600; color: #374151; font-size: 12px;">Date</th>
                    <th style="padding: 10px 12px; text-align: center; font-weight: 600; color: #374151; font-size: 12px;">Status</th>
                    <th style="padding: 10px 12px; text-align: center; font-weight: 600; color: #374151; font-size: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingValidations as $record)
                    <tr style="border-bottom: 1px solid #e5e7eb; transition: background-color 0.2s;">
                        <td style="padding: 10px 12px; color: #1f2937; font-size: 12px;">
                            <strong>{{ $record->f_name }} {{ $record->l_name }}</strong>
                        </td>
                        <td style="padding: 10px 12px; color: #6b7280; font-size: 12px;">{{ $record->position }}</td>
                        <td style="padding: 10px 12px; color: #1f2937; font-size: 12px;">
                            {{ $record->punch_in_time ? $record->punch_in_time->format('H:i:s') : 'N/A' }}
                        </td>
                        <td style="padding: 10px 12px; color: #1f2937; font-size: 12px;">
                            {{ $record->date->format('Y-m-d') }}
                        </td>
                        <td style="padding: 10px 12px; text-align: center;">
                            @if($record->is_late)
                                <span style="display: inline-block; color: #991b1b; font-size: 11px; font-weight: 600;">
                                    LATE ({{ $record->late_minutes }}min)
                                </span>
                            @else
                                <span style="display: inline-block; color: #166534; font-size: 11px; font-weight: 600;">
                                    ON TIME
                                </span>
                            @endif
                        </td>
                        <td style="padding: 10px 12px; text-align: center;">
                            <a href="{{ route('attendance-validation.show', $record->id) }}" style="display: inline-block; padding: 4px 8px; background: #3b82f6; color: white; text-decoration: none; border-radius: 4px; font-size: 11px; font-weight: 600; transition: background 0.3s;">
                                <i class="fas fa-eye"></i> Review
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div style="padding: 12px 16px; background: #f9fafb; border-top: 1px solid #e5e7eb; font-size: 12px;">
            {{ $pendingValidations->links() }}
        </div>
    @else
        <div style="padding: 24px; text-align: center; color: #6b7280;">
            <i class="fas fa-check-circle" style="font-size: 32px; color: #0369a1; margin-bottom: 10px; display: block;"></i>
            <h3 style="margin: 8px 0 6px 0; color: #1f2937; font-size: 14px;">All Clear!</h3>
            <p style="font-size: 12px; margin: 0;">No pending validations. All attendance records have been reviewed.</p>
        </div>
    @endif
</div>

<!-- Quick Stats Links -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 10px; margin-top: 12px;">
    <a href="{{ route('attendance-validation.approved') }}" style="background: white; padding: 10px 12px; border-radius: 8px; text-decoration: none; border-left: 3px solid #0369a1; box-shadow: 0 1px 2px rgba(0,0,0,0.08); transition: all 0.3s;">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 4px;">View Approved Records</div>
        <div style="font-size: 16px; font-weight: 700; color: #0369a1;">{{ $stats['approved'] }} Records</div>
        <div style="font-size: 10px; color: #9ca3af; margin-top: 4px;">See all approved punch-ins</div>
    </a>

    <a href="{{ route('attendance-validation.rejected') }}" style="background: white; padding: 10px 12px; border-radius: 8px; text-decoration: none; border-left: 3px solid #f59e0b; box-shadow: 0 1px 2px rgba(0,0,0,0.08); transition: all 0.3s;">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 4px;">View Rejected Records</div>
        <div style="font-size: 16px; font-weight: 700; color: #f59e0b;">{{ $stats['rejected'] }} Records</div>
        <div style="font-size: 10px; color: #9ca3af; margin-top: 4px;">See all rejected punch-ins</div>
    </a>

    <a href="{{ route('attendance-validation.dashboard') }}" style="background: white; padding: 10px 12px; border-radius: 8px; text-decoration: none; border-left: 3px solid #1e40af; box-shadow: 0 1px 2px rgba(0,0,0,0.08); transition: all 0.3s;">
        <div style="font-size: 10px; color: #6b7280; font-weight: 600; margin-bottom: 4px;">View Dashboard</div>
        <div style="font-size: 16px; font-weight: 700; color: #1e40af;">Validation Stats</div>
        <div style="font-size: 10px; color: #9ca3af; margin-top: 4px;">See full validation dashboard</div>
    </a>
</div>
@endsection
