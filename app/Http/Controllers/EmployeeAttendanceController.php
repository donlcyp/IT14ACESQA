<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeAttendanceController extends Controller
{
    public function index(Request $request)
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

        $stats = [
            'total'   => Employee::count(),
            'on_site' => Employee::where('status', 'On Site')->count(),
            'on_leave'=> Employee::where('status', 'On Leave')->count(),
            'absent'  => Employee::where('status', 'Absent')->count(),
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
        $statusOptions = ['On Site', 'On Leave', 'Absent'];

        return view('employee-attendance', compact('employees', 'stats', 'filters', 'statusOptions'));
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
