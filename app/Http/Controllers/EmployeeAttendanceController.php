<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Get all projects with their employees, client, and PM
        $projects = Project::with(['employees', 'client', 'assignedPM'])
            ->orderBy('project_code')
            ->get()
            ->map(function ($project) {
                // Add convenience attributes for the view
                $project->client_full_name = $project->client?->company_name ?? 'N/A';
                $project->lead_full_name = $project->assignedPM?->name ?? 'N/A';
                return $project;
            });
        
        // Get all employees with their current project assignments and recent attendance
        $allEmployees = Employee::all()->map(function ($employee) {
            $assignedProject = $employee->projects()->first();
            $employee->assigned_to_other_project = $assignedProject && $assignedProject->status !== 'Completed';
            
            // Get recent attendance records from EmployeeAttendance table
            $attendanceRecords = EmployeeAttendance::where('employee_id', $employee->id)
                ->orderBy('date', 'desc')
                ->limit(10)
                ->get()
                ->map(function ($record) {
                    return [
                        'employee_id' => $record->employee_id,
                        'f_name' => $record->f_name,
                        'l_name' => $record->l_name,
                        'position' => $record->position,
                        'status' => $record->attendance_status,
                        'date' => $record->date->format('Y-m-d'),
                        'time_in' => $record->time_in ? (is_string($record->time_in) ? $record->time_in : $record->time_in->format('H:i')) : null,
                        'time_out' => $record->time_out ? (is_string($record->time_out) ? $record->time_out : $record->time_out->format('H:i')) : null,
                    ];
                })
                ->toArray();
            
            $employee->attendance_records = $attendanceRecords;
            return $employee;
        })->toArray();
        
        // Build project-employees mapping
        $projectEmployees = [];
        foreach ($projects as $project) {
            $projectEmployees[$project->id] = $project->employees->pluck('id')->toArray();
        }

        // Statistics for dashboard
        $today = Carbon::today();
        $todayRecords = EmployeeAttendance::whereDate('date', $today->toDateString())->get();
        
        $stats = [
            'total'   => Employee::count(),
            'on_site' => $todayRecords->where('attendance_status', 'On Site')->count(),
            'on_leave'=> $todayRecords->where('attendance_status', 'On Leave')->count(),
            'absent'  => $todayRecords->where('attendance_status', 'Absent')->count(),
            'idle'    => $todayRecords->where('attendance_status', 'Idle')->count(),
        ];

        $query = Employee::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('f_name', 'like', '%' . $search . '%')
                    ->orWhere('l_name', 'like', '%' . $search . '%');
            });
        }

        $employees = $query
            ->orderBy('f_name')
            ->orderBy('l_name')
            ->paginate(10)
            ->withQueryString();

        $filters = $request->only(['search']);
        $statusOptions = ['Idle', 'On Site', 'On Leave', 'Absent'];

        return view('employee-attendance', compact(
            'projects',
            'employees',
            'allEmployees',
            'projectEmployees',
            'stats',
            'filters',
            'statusOptions'
        ));
    }

    public function update(Request $request, EmployeeAttendance $attendance)
    {
        $data = $request->validate([
            'attendance_status' => ['required', 'in:Idle,On Site,On Leave,Absent'],
            'time_in' => ['nullable', 'date_format:H:i'],
            'time_out' => ['nullable', 'date_format:H:i'],
        ]);

        // Auto-update status based on conditions:
        // - If time_in is provided and status is not "On Leave", set to "On Site"
        // - If no time_in and status is not "On Leave", keep as "Idle" or "Absent"
        // - "On Leave" must be explicitly selected
        if (!empty($data['time_in'])) {
            if ($data['attendance_status'] !== 'On Leave') {
                $data['attendance_status'] = 'On Site';
            }
        } else {
            if ($data['attendance_status'] === 'On Site') {
                $data['attendance_status'] = 'Idle';
            }
        }

        $attendance->update($data);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Attendance updated successfully.']);
        }

        return redirect()->route('employee-attendance')->with('success', 'Attendance updated successfully.');
    }

    public function history(Request $request)
    {
        $query = EmployeeAttendance::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('f_name', 'like', '%' . $search . '%')
                    ->orWhere('l_name', 'like', '%' . $search . '%');
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('attendance_status', $request->input('status'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->input('date_to'));
        }

        $records = $query
            ->orderBy('date', 'desc')
            ->orderBy('f_name')
            ->orderBy('l_name')
            ->paginate(15)
            ->withQueryString();

        $filters = $request->only(['search', 'status', 'date_from', 'date_to']);
        $statusOptions = ['Idle', 'On Site', 'On Leave', 'Absent'];

        // Calculate stats for filtered results
        $statsQuery = EmployeeAttendance::query();
        if ($request->filled('date_from')) {
            $statsQuery->whereDate('date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $statsQuery->whereDate('date', '<=', $request->input('date_to'));
        }

        $stats = [
            'total' => $statsQuery->distinct('employee_id')->count('employee_id'),
            'on_site' => $statsQuery->where('attendance_status', 'On Site')->count(),
            'on_leave' => $statsQuery->where('attendance_status', 'On Leave')->count(),
            'absent' => $statsQuery->where('attendance_status', 'Absent')->count(),
        ];

        return view('attendance-history', compact('records', 'stats', 'filters', 'statusOptions'));
    }

    /**
     * Assign employees to a project
     */
    public function assignEmployeesToProject(Request $request, Project $project)
    {
        try {
            // Validate that user has permission
            $user = auth()->guard('web')->user();
            if (!$user || !$user->canManageProjectEmployees()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            $validated = $request->validate([
                'employee_ids' => ['required', 'array', 'min:1'],
                'employee_ids.*' => ['integer', 'exists:employee_list,id']
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

            // Create attendance records for assigned employees if they don't exist for today
            $today = Carbon::today();
            foreach ($employeeIds as $employeeId) {
                $employee = Employee::find($employeeId);
                if ($employee) {
                    EmployeeAttendance::firstOrCreate(
                        [
                            'employee_id' => $employeeId,
                            'date' => $today,
                        ],
                        [
                            'f_name' => $employee->f_name,
                            'l_name' => $employee->l_name,
                            'position' => $employee->position,
                            'attendance_status' => 'Idle',
                        ]
                    );
                }
            }

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

    /**
     * Store or update attendance from modal
     */
    public function storeAttendance(Request $request, $employeeId)
    {
        try {
            $validated = $request->validate([
                'status' => ['required', 'in:Idle,On Site,On Leave,Absent'],
                'time_in' => ['nullable', 'date_format:H:i'],
                'time_out' => ['nullable', 'date_format:H:i'],
                'attendance_date' => ['required', 'date_format:Y-m-d'],
            ]);

            $employee = Employee::findOrFail($employeeId);
            
            $status = $validated['status'];
            
            // Auto-update status based on time_in
            if (!empty($validated['time_in'])) {
                if ($status !== 'On Leave') {
                    $status = 'On Site';
                }
            } else {
                if ($status === 'On Site') {
                    $status = 'Idle';
                }
            }

            // Find or create attendance record
            $attendance = EmployeeAttendance::firstOrCreate(
                [
                    'employee_id' => $employeeId,
                    'date' => $validated['attendance_date'],
                ],
                [
                    'f_name' => $employee->f_name,
                    'l_name' => $employee->l_name,
                    'position' => $employee->position,
                    'attendance_status' => $status,
                    'time_in' => $validated['time_in'],
                    'time_out' => $validated['time_out'],
                ]
            );

            // Update if already exists
            if ($attendance->wasRecentlyCreated === false) {
                $attendance->update([
                    'attendance_status' => $status,
                    'time_in' => $validated['time_in'],
                    'time_out' => $validated['time_out'],
                ]);
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Attendance updated successfully'
                ]);
            }

            return redirect()->back()->with('success', 'Attendance updated successfully');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server error: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Error updating attendance: ' . $e->getMessage());
        }
    }
}
