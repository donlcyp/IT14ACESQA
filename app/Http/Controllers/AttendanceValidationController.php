<?php

namespace App\Http\Controllers;

use App\Models\AttendanceValidation;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceValidationController extends Controller
{
    /**
     * Display pending attendance validations for HR/Timekeeper
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can access this page
        if (!$user || $user->role !== 'HR') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        // Get pending validations (only with punch_in_time)
        $pendingValidations = EmployeeAttendance::where('validation_status', 'pending')
            ->whereNotNull('punch_in_time')
            ->with(['employee', 'validator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Get statistics
        $stats = [
            'pending' => EmployeeAttendance::where('validation_status', 'pending')
                ->whereNotNull('punch_in_time')
                ->count(),
            'approved' => EmployeeAttendance::where('validation_status', 'approved')->count(),
            'rejected' => EmployeeAttendance::where('validation_status', 'rejected')->count(),
            'total' => EmployeeAttendance::count(),
        ];

        return view('attendance-validation.index', compact('pendingValidations', 'stats'));
    }

    /**
     * Show single pending validation detail
     */
    public function show(EmployeeAttendance $attendance)
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can view
        if (!$user || $user->role !== 'HR') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        // Get employee details
        $employee = $attendance->employee;
        $recentRecords = EmployeeAttendance::where('employee_id', $attendance->employee_id)
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        return view('attendance-validation.show', compact('attendance', 'employee', 'recentRecords'));
    }

    /**
     * Approve attendance punch-in
     */
    public function approve(Request $request, EmployeeAttendance $attendance)
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can approve
        if (!$user || $user->role !== 'HR') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // Validate input
        try {
            $validated = $request->validate([
                // Add your validation rules here, e.g.:
                'validation_notes' => 'nullable|string|max:500',
            ]);

            // ...existing approval logic...

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Attendance approved successfully',
                    'validation_status' => 'approved',
                ]);
            }

            return redirect()->back()->with('success', 'Attendance approved successfully');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error approving attendance: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error approving attendance: ' . $e->getMessage());
        }
    }

    /**
     * Reject attendance punch-in
     */
    public function reject(Request $request, EmployeeAttendance $attendance)
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can reject
        if (!$user || $user->role !== 'HR') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // Validate input
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:255',
            'validation_notes' => 'nullable|string|max:500',
        ]);

        try {
            // Reject the attendance
            $attendance->reject(
                $user,
                $validated['rejection_reason'],
                $validated['validation_notes'] ?? null
            );

            // Log the action
            \App\Models\Log::create([
                'user_id' => $user->id,
                'action' => 'Rejected attendance punch-in',
                'description' => 'Rejected punch-in for ' . $attendance->employee->f_name . ' ' . $attendance->employee->l_name . ' on ' . $attendance->date->format('Y-m-d') . ' - Reason: ' . $validated['rejection_reason'],
                'ip_address' => $request->ip(),
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Attendance rejected successfully',
                    'validation_status' => 'rejected',
                ]);
            }

            return redirect()->back()->with('success', 'Attendance rejected successfully');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error rejecting attendance: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error rejecting attendance: ' . $e->getMessage());
        }
    }

    /**
     * Filter pending validations
     */
    public function filter(Request $request)
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can filter
        if (!$user || $user->role !== 'HR') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        try {
            $query = EmployeeAttendance::where('validation_status', 'pending')
                ->whereNotNull('punch_in_time');

            // Filter by employee name
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('f_name', 'like', '%' . $search . '%')
                        ->orWhere('l_name', 'like', '%' . $search . '%');
                });
            }

            // Filter by date
            if ($request->has('date') && $request->date) {
                $query->where('date', $request->date);
            }

            // Filter by is_late status
            if ($request->has('is_late') && $request->is_late !== null) {
                $query->where('is_late', $request->is_late);
            }

            $pendingValidations = $query
                ->with(['employee', 'validator'])
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString();

            // Get statistics
            $stats = [
                'pending' => EmployeeAttendance::where('validation_status', 'pending')
                    ->whereNotNull('punch_in_time')
                    ->count(),
                'approved' => EmployeeAttendance::where('validation_status', 'approved')->count(),
                'rejected' => EmployeeAttendance::where('validation_status', 'rejected')->count(),
                'total' => EmployeeAttendance::count(),
            ];

            return view('attendance-validation.index', compact('pendingValidations', 'stats'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error filtering validations: ' . $e->getMessage());
        }
    }

    /**
     * Get all approved validations
     */
    public function approved()
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can access
        if (!$user || $user->role !== 'HR') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $approvedRecords = EmployeeAttendance::where('validation_status', 'approved')
            ->with(['employee', 'validator'])
            ->orderBy('validated_at', 'desc')
            ->paginate(15);

        return view('attendance-validation.approved', compact('approvedRecords'));
    }

    /**
     * Get all rejected validations
     */
    public function rejected()
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can access
        if (!$user || $user->role !== 'HR') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $rejectedRecords = EmployeeAttendance::where('validation_status', 'rejected')
            ->with(['employee', 'validator'])
            ->orderBy('validated_at', 'desc')
            ->paginate(15);

        return view('attendance-validation.rejected', compact('rejectedRecords'));
    }

    /**
     * Get validation history for an employee
     */
    public function employeeHistory(EmployeeList $employee)
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can access
        if (!$user || $user->role !== 'HR') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $validationHistory = EmployeeAttendance::where('employee_id', $employee->id)
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('attendance-validation.employee-history', compact('employee', 'validationHistory'));
    }

    /**
     * Get validation statistics/dashboard
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Only HR/Timekeeper can access
        if (!$user || $user->role !== 'HR') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        $stats = [
            'pending_today' => EmployeeAttendance::where('validation_status', 'pending')
                ->where('date', $today)
                ->whereNotNull('punch_in_time')
                ->count(),
            'pending_total' => EmployeeAttendance::where('validation_status', 'pending')
                ->whereNotNull('punch_in_time')
                ->count(),
            'approved_today' => EmployeeAttendance::where('validation_status', 'approved')
                ->where('date', $today)
                ->count(),
            'approved_month' => EmployeeAttendance::where('validation_status', 'approved')
                ->where('date', '>=', $thisMonth)
                ->count(),
            'rejected_month' => EmployeeAttendance::where('validation_status', 'rejected')
                ->where('date', '>=', $thisMonth)
                ->count(),
            'total_validated' => EmployeeAttendance::whereIn('validation_status', ['approved', 'rejected'])
                ->count(),
        ];

        // Get pending validations for today
        $pendingToday = EmployeeAttendance::where('validation_status', 'pending')
            ->where('date', $today)
            ->whereNotNull('punch_in_time')
            ->with(['employee'])
            ->orderBy('punch_in_time', 'desc')
            ->take(10)
            ->get();

        // Get late punch-ins pending approval
        $latePendingApproval = EmployeeAttendance::where('validation_status', 'pending')
            ->where('is_late', true)
            ->with(['employee'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('attendance-validation.dashboard', compact('stats', 'pendingToday', 'latePendingApproval'));
    }
}
