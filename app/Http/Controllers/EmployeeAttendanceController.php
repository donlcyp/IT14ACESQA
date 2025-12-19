<?php

namespace App\Http\Controllers;

use App\Models\EmployeeList;
use App\Models\EmployeeAttendance;
use App\Models\AttendanceValidation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $isEmployee = $user && EmployeeList::where('user_id', $user->id)->exists();

        if ($isEmployee) {
            // EMPLOYEE VIEW - Show only their own attendance
            $currentEmployee = EmployeeList::where('user_id', $user->id)->firstOrFail();
            
            // Get their assigned project
            $assignedProject = $currentEmployee->projects()->first();
            
            // Get today's attendance
            $today = Carbon::today();
            $todayAttendance = EmployeeAttendance::where('employee_id', $currentEmployee->id)
                ->where('date', $today)
                ->first();
            
            // Get recent attendance records
            $recentRecords = EmployeeAttendance::where('employee_id', $currentEmployee->id)
                ->orderBy('date', 'desc')
                ->take(10)
                ->get();

            // Statistics for this employee
            $stats = [
                'total_days' => EmployeeAttendance::where('employee_id', $currentEmployee->id)->count(),
                'on_site' => EmployeeAttendance::where('employee_id', $currentEmployee->id)
                    ->where('attendance_status', 'On Site')->count(),
                'on_leave' => EmployeeAttendance::where('employee_id', $currentEmployee->id)
                    ->where('attendance_status', 'On Leave')->count(),
                'absent' => EmployeeAttendance::where('employee_id', $currentEmployee->id)
                    ->where('attendance_status', 'Absent')->count(),
                'late_count' => EmployeeAttendance::where('employee_id', $currentEmployee->id)
                    ->where('is_late', true)->count(),
            ];

            return view('employee-my-attendance', compact(
                'currentEmployee',
                'assignedProject',
                'todayAttendance',
                'recentRecords',
                'stats'
            ));
        } else {
            // OWNER/PM VIEW - Show all projects and employees
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
            $allEmployees = EmployeeList::all()->map(function ($employee) {
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
            });
            
            // Build project-employees mapping
            $projectEmployees = [];
            foreach ($projects as $project) {
                $projectEmployees[$project->id] = $project->employees->pluck('id')->toArray();
            }

            // Statistics for dashboard
            $today = Carbon::today();
            $todayRecords = EmployeeAttendance::whereDate('date', $today->toDateString())->get();
            
            $stats = [
                'total'   => EmployeeList::count(),
                'on_site' => $todayRecords->where('attendance_status', 'On Site')->count(),
                'on_leave'=> $todayRecords->where('attendance_status', 'On Leave')->count(),
                'absent'  => $todayRecords->where('attendance_status', 'Absent')->count(),
                'idle'    => $todayRecords->where('attendance_status', 'Idle')->count(),
            ];

            $query = EmployeeList::query();

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
                'statusOptions',
                'isEmployee'
            ));
        }
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
            $assignedToOtherProjects = EmployeeList::whereHas('projects', function ($query) use ($employeeIds, $project) {
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
                $employee = EmployeeList::find($employeeId);
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

            $employee = EmployeeList::findOrFail($employeeId);
            
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

    /**
     * Punch In - Record employee arrival time (For OWNER/PM manually recording)
     */
    public function punchIn(Request $request, $employeeId)
    {
        try {
            // Only OWNER and PM can use this endpoint
            $user = auth()->user();
            if (!$user || !in_array($user->role, ['OWNER', 'PM'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $employee = EmployeeList::findOrFail($employeeId);
            $today = now()->toDateString();
            
            // Get or create today's attendance record
            $attendance = EmployeeAttendance::firstOrCreate(
                [
                    'employee_id' => $employeeId,
                    'date' => $today,
                ],
                [
                    'f_name' => $employee->f_name,
                    'l_name' => $employee->l_name,
                    'position' => $employee->position,
                    'attendance_status' => 'On Site',
                ]
            );

            // Check if already punched in
            if ($attendance->punch_in_time !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Already punched in at ' . $attendance->punch_in_time->format('H:i:s')
                ], 422);
            }

            // Get project start time (default 8:00 AM, grace period 15 minutes)
            $scheduledStartTime = now()->setHour(8)->setMinute(0)->setSecond(0);
            $graceMinutes = 15;
            $gracePeriodEnd = $scheduledStartTime->copy()->addMinutes($graceMinutes);
            
            $punchTime = now();
            $isLate = false;
            $lateMinutes = 0;
            $gracePeriodApplied = false;

            // Calculate if late
            if ($punchTime->isAfter($scheduledStartTime)) {
                $lateMinutes = $punchTime->diffInMinutes($scheduledStartTime);
                
                // Check if within grace period
                if ($punchTime->isBefore($gracePeriodEnd)) {
                    $isLate = false;
                    $gracePeriodApplied = true;
                } else {
                    $isLate = true;
                }
            }

            // Update attendance record
            $attendance->update([
                'punch_in_time' => $punchTime,
                'is_late' => $isLate,
                'late_minutes' => $lateMinutes,
                'grace_period_applied' => $gracePeriodApplied,
                'attendance_status' => 'On Site',
            ]);

            $message = 'Punched in at ' . $punchTime->format('H:i:s');
            if ($isLate) {
                $message .= " - LATE by $lateMinutes minutes";
            } elseif ($gracePeriodApplied) {
                $message .= " (Within grace period - " . $lateMinutes . " min late)";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'punch_status' => $attendance->getPunchStatus(),
                'is_late' => $isLate,
                'late_minutes' => $lateMinutes,
                'punch_in_time' => $punchTime->format('H:i:s'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error during punch in: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Punch Out - Record employee departure time (For OWNER/PM manually recording)
     */
    public function punchOut(Request $request, $employeeId)
    {
        try {
            // Only OWNER and PM can use this endpoint
            $user = auth()->user();
            if (!$user || !in_array($user->role, ['OWNER', 'PM'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $employee = EmployeeList::findOrFail($employeeId);
            $today = now()->toDateString();
            
            // Get today's attendance record
            $attendance = EmployeeAttendance::where('employee_id', $employeeId)
                ->where('date', $today)
                ->firstOrFail();

            // Check if not punched in
            if ($attendance->punch_in_time === null && $attendance->time_in === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please punch in first'
                ], 422);
            }

            // Check if already punched out
            if ($attendance->punch_out_time !== null || $attendance->time_out !== null) {
                $outTime = $attendance->punch_out_time ?? $attendance->time_out;
                return response()->json([
                    'success' => false,
                    'message' => 'Already punched out at ' . $outTime->format('H:i:s')
                ], 422);
            }

            $punchOutTime = now();
            $punchInTime = $attendance->punch_in_time ?? $attendance->time_in;
            $hoursWorked = $punchInTime ? $punchOutTime->diffInMinutes($punchInTime) / 60 : 0;

            $attendance->update([
                'time_out' => $punchOutTime,
                'punch_out_time' => $punchOutTime,
                'attendance_status' => 'Present', // Mark as officially present after punch out
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Punched out at ' . $punchOutTime->format('H:i:s'),
                'punch_status' => $attendance->getPunchStatus(),
                'hours_worked' => round($hoursWorked, 2),
                'punch_out_time' => $punchOutTime->format('H:i:s'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error during punch out: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Punch In - Employee self-punch in
     */
    public function punchInEmployee(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Get the employee profile for this user
            $employee = EmployeeList::where('user_id', $user->id)->first();
            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'No employee profile found for this user'
                ], 404);
            }
            
            $today = now()->toDateString();
            
            // Get or create today's attendance record
            $attendance = EmployeeAttendance::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'date' => $today,
                ],
                [
                    'f_name' => $employee->f_name,
                    'l_name' => $employee->l_name,
                    'position' => $employee->position,
                    'attendance_status' => 'On Site',
                ]
            );

            // Check if already punched in
            if ($attendance->punch_in_time !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Already punched in at ' . $attendance->punch_in_time->format('H:i:s')
                ], 422);
            }

            // Get project start time (default 8:00 AM, grace period 15 minutes)
            $scheduledStartTime = now()->setHour(8)->setMinute(0)->setSecond(0);
            $graceMinutes = 15;
            $gracePeriodEnd = $scheduledStartTime->copy()->addMinutes($graceMinutes);
            
            $punchTime = now();
            $isLate = false;
            $lateMinutes = 0;
            $gracePeriodApplied = false;

            // Calculate if late
            if ($punchTime->isAfter($scheduledStartTime)) {
                $lateMinutes = $punchTime->diffInMinutes($scheduledStartTime);
                
                // Check if within grace period
                if ($punchTime->isBefore($gracePeriodEnd)) {
                    $isLate = false;
                    $gracePeriodApplied = true;
                } else {
                    $isLate = true;
                }
            }

            // Update attendance record
            $attendance->update([
                'time_in' => $punchTime,
                'punch_in_time' => $punchTime,
                'is_late' => $isLate,
                'late_minutes' => $lateMinutes,
                'grace_period_applied' => $gracePeriodApplied,
                'attendance_status' => 'On Site',
                'validation_status' => 'pending', // Set to pending for HR/Timekeeper validation
            ]);

            // Create validation request for HR/Timekeeper
            AttendanceValidation::create([
                'attendance_id' => $attendance->id,
                'employee_id' => $employee->id,
                'validation_status' => 'pending',
            ]);

            $message = 'Punched in at ' . $punchTime->format('H:i:s') . ' - Pending HR Review';
            if ($isLate) {
                $message .= " - LATE by $lateMinutes minutes";
            } elseif ($gracePeriodApplied) {
                $message .= " (Within grace period - " . $lateMinutes . " min late)";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'punch_status' => $attendance->getPunchStatus(),
                'is_late' => $isLate,
                'late_minutes' => $lateMinutes,
                'punch_in_time' => $punchTime->format('H:i:s'),
                'validation_status' => 'pending',
                'validation_message' => 'Your punch-in is waiting for HR/Timekeeper approval',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error punching in: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Punch Out - Employee self-punch out
     */
    public function punchOutEmployee(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Get the employee profile for this user
            $employee = EmployeeList::where('user_id', $user->id)->first();
            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'No employee profile found for this user'
                ], 404);
            }
            
            $today = now()->toDateString();
            
            // Get today's attendance record
            $attendance = EmployeeAttendance::where('employee_id', $employee->id)
                ->where('date', $today)
                ->first();

            if (!$attendance) {
                return response()->json([
                    'success' => false,
                    'message' => 'No attendance record found for today'
                ], 404);
            }

            // Check if not punched in
            if ($attendance->punch_in_time === null && $attendance->time_in === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please punch in first'
                ], 422);
            }

            // Check if already punched out
            if ($attendance->punch_out_time !== null || $attendance->time_out !== null) {
                $outTime = $attendance->punch_out_time ?? $attendance->time_out;
                return response()->json([
                    'success' => false,
                    'message' => 'Already punched out at ' . $outTime->format('H:i:s')
                ], 422);
            }

            $punchOutTime = now();
            $punchInTime = $attendance->punch_in_time ?? $attendance->time_in;
            $hoursWorked = $punchInTime ? $punchOutTime->diffInMinutes($punchInTime) / 60 : 0;

            $attendance->update([
                'time_out' => $punchOutTime,
                'punch_out_time' => $punchOutTime,
                'attendance_status' => 'Present', // Mark as officially present after punch out
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Punched out at ' . $punchOutTime->format('H:i:s'),
                'punch_status' => $attendance->getPunchStatus(),
                'hours_worked' => round($hoursWorked, 2),
                'punch_out_time' => $punchOutTime->format('H:i:s'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error punching out: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get current punch status for employee
     */
    public function getPunchStatusEmployee(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Get the employee profile for this user
            $employee = EmployeeList::where('user_id', $user->id)->first();
            
            if (!$employee) {
                return response()->json([
                    'punch_status' => 'Not Punched',
                    'punch_in_time' => null,
                    'punch_out_time' => null,
                    'is_late' => false,
                    'late_minutes' => 0,
                    'hours_worked' => null,
                ]);
            }

            $today = now()->toDateString();
            
            $attendance = EmployeeAttendance::where('employee_id', $employee->id)
                ->where('date', $today)
                ->first();

            if (!$attendance) {
                return response()->json([
                    'punch_status' => 'Not Punched',
                    'punch_in_time' => null,
                    'punch_out_time' => null,
                    'is_late' => false,
                    'late_minutes' => 0,
                    'hours_worked' => null,
                ]);
            }

            return response()->json([
                'punch_status' => $attendance->getPunchStatus(),
                'punched_in' => ($attendance->punch_in_time || $attendance->time_in) ? true : false,
                'punched_out' => ($attendance->punch_out_time || $attendance->time_out) ? true : false,
                'time_in' => $attendance->punch_in_time ? $attendance->punch_in_time->format('H:i:s') : ($attendance->time_in ? \Carbon\Carbon::parse($attendance->time_in)->format('H:i:s') : null),
                'time_out' => $attendance->punch_out_time ? $attendance->punch_out_time->format('H:i:s') : ($attendance->time_out ? \Carbon\Carbon::parse($attendance->time_out)->format('H:i:s') : null),
                'punch_in_time' => $attendance->punch_in_time ? $attendance->punch_in_time->format('H:i:s') : ($attendance->time_in ? \Carbon\Carbon::parse($attendance->time_in)->format('H:i:s') : null),
                'punch_out_time' => $attendance->punch_out_time ? $attendance->punch_out_time->format('H:i:s') : ($attendance->time_out ? \Carbon\Carbon::parse($attendance->time_out)->format('H:i:s') : null),
                'is_late' => $attendance->is_late,
                'late_minutes' => $attendance->late_minutes,
                'grace_period_applied' => $attendance->grace_period_applied,
                'hours_worked' => $attendance->getHoursWorked(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting punch status: ' . $e->getMessage()
            ], 403);
        }
    }

    /**
     * Get current punch status (For OWNER/PM viewing employee status)
     */
    public function getPunchStatus($employeeId)
    {
        try {
            // Only OWNER and PM can use this endpoint
            $user = auth()->user();
            if (!$user || !in_array($user->role, ['OWNER', 'PM'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $employee = EmployeeList::findOrFail($employeeId);
            $today = now()->toDateString();
            
            $attendance = EmployeeAttendance::where('employee_id', $employeeId)
                ->where('date', $today)
                ->first();

            if (!$attendance) {
                return response()->json([
                    'punch_status' => 'Not Punched',
                    'punch_in_time' => null,
                    'punch_out_time' => null,
                    'is_late' => false,
                    'late_minutes' => 0,
                    'hours_worked' => null,
                ]);
            }

            return response()->json([
                'punch_status' => $attendance->getPunchStatus(),
                'punch_in_time' => $attendance->punch_in_time ? $attendance->punch_in_time->format('H:i:s') : null,
                'punch_out_time' => $attendance->punch_out_time ? $attendance->punch_out_time->format('H:i:s') : null,
                'is_late' => $attendance->is_late,
                'late_minutes' => $attendance->late_minutes,
                'grace_period_applied' => $attendance->grace_period_applied,
                'hours_worked' => $attendance->getHoursWorked(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting punch status: ' . $e->getMessage()
            ], 500);
        }
    }
}
