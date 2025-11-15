<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AttendanceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();

        // Save yesterday's attendance to history before resetting
        $employeesWithAttendance = Employee::whereNotNull('attendance_date')
            ->whereDate('attendance_date', '<>', $today->toDateString())
            ->get();

        foreach ($employeesWithAttendance as $employee) {
            AttendanceHistory::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'attendance_date' => $employee->attendance_date,
                ],
                [
                    'employee_code' => $employee->employee_code,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'position' => $employee->position,
                    'status' => $employee->status,
                    'time_in' => $employee->time_in,
                    'time_out' => $employee->time_out,
                ]
            );
        }

        // Reset employees for today - default to Idle (no status yet)
        Employee::where(function ($query) use ($today) {
            $query->whereNull('attendance_date')
                ->orWhereDate('attendance_date', '<>', $today->toDateString());
        })->update([
            'status' => 'Idle',
            'attendance_date' => null,
            'time_in' => null,
            'time_out' => null,
        ]);

        $stats = [
            'total'   => Employee::count(),
            'on_site' => Employee::where('status', 'On Site')->count(),
            'on_leave'=> Employee::where('status', 'On Leave')->count(),
            'absent'  => Employee::where('status', 'Absent')->count(),
            'idle'    => Employee::where('status', 'Idle')->count(),
        ];

        $query = Employee::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('employee_code', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $employees = $query
            ->orderBy('employee_code')
            ->paginate(10)
            ->withQueryString();

        $filters = $request->only(['search', 'status']);
        $statusOptions = ['Idle', 'On Site', 'On Leave', 'Absent'];

        return view('employee-attendance', compact('employees', 'stats', 'filters', 'statusOptions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Idle,On Site,On Leave,Absent'],
            'attendance_date' => ['nullable', 'date'],
            'time_in' => ['nullable', 'date_format:H:i'],
            'time_out' => ['nullable', 'date_format:H:i'],
        ]);

        // Auto-update status based on conditions:
        // - Idle: No status set yet (default)
        // - If time_in is provided and status is not "On Leave", set to "On Site"
        // - If no time_in and status is not "On Leave", keep as "Idle" or "Absent"
        // - "On Leave" must be explicitly selected
        if (!empty($data['time_in'])) {
            // If they clocked in, they're On Site (unless manually set to On Leave)
            if ($data['status'] !== 'On Leave') {
                $data['status'] = 'On Site';
            }
        } else {
            // No clock in time
            if ($data['status'] === 'On Site') {
                // Can't be On Site without clocking in
                $data['status'] = 'Idle';
            }
        }

        $employee->update($data);

        return redirect()->route('employee-attendance')->with('success', 'Attendance updated successfully.');
    }

    public function history(Request $request)
    {
        $query = AttendanceHistory::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('employee_code', 'like', '%' . $search . '%');
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('attendance_date', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('attendance_date', '<=', $request->input('date_to'));
        }

        $records = $query
            ->orderBy('attendance_date', 'desc')
            ->orderBy('employee_code')
            ->paginate(15)
            ->withQueryString();

        $filters = $request->only(['search', 'status', 'date_from', 'date_to']);
        $statusOptions = ['Idle', 'On Site', 'On Leave', 'Absent'];

        // Calculate stats for filtered results
        $statsQuery = AttendanceHistory::query();
        if ($request->filled('date_from')) {
            $statsQuery->whereDate('attendance_date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $statsQuery->whereDate('attendance_date', '<=', $request->input('date_to'));
        }

        $stats = [
            'total' => $statsQuery->distinct('employee_id')->count('employee_id'),
            'on_site' => $statsQuery->where('status', 'On Site')->count(),
            'on_leave' => $statsQuery->where('status', 'On Leave')->count(),
            'absent' => $statsQuery->where('status', 'Absent')->count(),
        ];

        return view('attendance-history', compact('records', 'stats', 'filters', 'statusOptions'));
    }
}
