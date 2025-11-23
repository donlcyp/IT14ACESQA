<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AttendanceHistory;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Get all projects with their employees
        $projects = Project::with('employees')->orderBy('project_name')->get();
        
        // Get all employees with their current project assignments
        $allEmployees = Employee::all()->map(function ($employee) {
            $assignedProject = $employee->projects()->first();
            $employee->assigned_to_other_project = $assignedProject && $assignedProject->status !== 'Completed';
            
            // Get attendance records - both current and historical
            $attendanceRecords = [];
            
            // Add current attendance if it exists
            if ($employee->status) {
                $attendanceRecords[] = [
                    'employee_id' => $employee->id,
                    'employee_code' => $employee->employee_code,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'position' => $employee->position,
                    'status' => $employee->status,
                    'attendance_date' => $employee->attendance_date ? $employee->attendance_date->format('Y-m-d') : now()->format('Y-m-d'),
                    'time_in' => $employee->time_in ? $employee->time_in->format('H:i') : null,
                    'time_out' => $employee->time_out ? $employee->time_out->format('H:i') : null,
                ];
            }
            
            // Add historical attendance records
            $historicalRecords = AttendanceHistory::where('employee_id', $employee->id)
                ->orderBy('attendance_date', 'desc')
                ->limit(10)
                ->get()
                ->map(function ($record) {
                    return [
                        'employee_id' => $record->employee_id,
                        'employee_code' => $record->employee_code,
                        'first_name' => $record->first_name,
                        'last_name' => $record->last_name,
                        'position' => $record->position,
                        'status' => $record->status,
                        'attendance_date' => $record->attendance_date ? $record->attendance_date->format('Y-m-d') : null,
                        'time_in' => $record->time_in ? (is_string($record->time_in) ? $record->time_in : $record->time_in->format('H:i')) : null,
                        'time_out' => $record->time_out ? (is_string($record->time_out) ? $record->time_out : $record->time_out->format('H:i')) : null,
                    ];
                })
                ->toArray();
            
            $employee->attendance_records = array_merge($attendanceRecords, $historicalRecords);
            
            return $employee;
        })->toArray();
        
        // Build project-employees mapping
        $projectEmployees = [];
        foreach ($projects as $project) {
            $projectEmployees[$project->id] = $project->employees->pluck('id')->toArray();
        }

        // For daily attendance tracking
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

        // Ensure Idle employees assigned to any active (non-completed) project get a current attendance_date (today)
        $activeAssignedIds = Employee::whereHas('projects', function ($q) {
                $q->where('status', '!=', 'Completed');
            })
            ->pluck('id');
        if ($activeAssignedIds->isNotEmpty()) {
            Employee::whereIn('id', $activeAssignedIds)->where('status', 'Idle')->update([
                'attendance_date' => $today->toDateString(),
            ]);
        }

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

        return view('employee-attendance', compact(
            'employees',
            'projects',
            'allEmployees',
            'projectEmployees',
            'stats',
            'filters',
            'statusOptions'
        ));
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

        // Return JSON response
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Attendance updated successfully.']);
        }

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

    /**
     * Assign employees to a project
     */
    public function assignEmployeesToProject(Request $request, Project $project)
    {
        try {
            // Validate that user has permission (PM or OWNER)
            $user = auth()->guard('web')->user();
            if (!$user || !$user->canManageProjectEmployees()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            $validated = $request->validate([
                'employee_ids' => ['required', 'array', 'min:1'],
                'employee_ids.*' => ['integer', 'exists:employees,id']
            ]);

            $employeeIds = $validated['employee_ids'];

            // Check if employees are already assigned to other active projects
            $assignedToOtherProjects = Employee::whereHas('projects', function ($query) use ($employeeIds, $project) {
                $query->where('status', '!=', 'Completed')
                      ->where('project_id', '!=', $project->id);
            })
            ->whereIn('id', $employeeIds)
            ->pluck('id')
            ->toArray();

            if (!empty($assignedToOtherProjects)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Some employees are already assigned to other active projects and cannot be reassigned until those projects are completed.'
                ], 422);
            }

            // Sync employees (this will add new ones and remove old ones)
            $project->employees()->sync($employeeIds);

            // Ensure assigned employees default to Idle status on assignment
            Employee::whereIn('id', $employeeIds)->update([
                'status' => 'Idle',
                'attendance_date' => null,
                'time_in' => null,
                'time_out' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Employees assigned successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
}
