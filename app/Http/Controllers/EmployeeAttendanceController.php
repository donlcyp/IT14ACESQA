<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeAttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        Employee::where(function ($query) use ($today) {
            $query->whereNull('attendance_date')
                ->orWhereDate('attendance_date', '<>', $today->toDateString());
        })->update([
            'status' => 'On Site',
            'attendance_date' => null,
            'time_in' => null,
            'time_out' => null,
        ]);

        $employees = Employee::orderBy('employee_code')->get();

        $stats = [
            'total'   => $employees->count(),
            'on_site' => $employees->where('status', 'On Site')->count(),
            'on_leave'=> $employees->where('status', 'On Leave')->count(),
            'absent'  => $employees->where('status', 'Absent')->count(),
        ];

        return view('employee-attendance', compact('employees', 'stats'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'status' => ['required', 'in:On Site,On Leave,Absent'],
            'attendance_date' => ['nullable', 'date'],
            'time_in' => ['nullable', 'date_format:H:i'],
            'time_out' => ['nullable', 'date_format:H:i'],
        ]);

        $employee->update($data);

        return redirect()->route('employee-attendance')->with('success', 'Attendance updated successfully.');
    }
}
