<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\EmployeeList;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;

class RequirePunchIn
{
    /**
     * Roles that require punch-in before accessing pages
     */
    protected $restrictedRoles = ['PM', 'FM', 'HR', 'QA', 'SS', 'CW'];

    /**
     * Routes that are exempt from punch-in requirement (allow access for punching in)
     */
    protected $exemptRoutes = [
        'punch.in',
        'punch.out',
        'punch.in.employee',
        'punch.out.employee',
        'punch.status.employee',
        'logout',
        'login',
        'my-attendance',
        'attendance.history',
        'cw.attendance',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Skip if not authenticated
        if (!$user) {
            return $next($request);
        }

        // Skip if user role is not in restricted roles
        if (!in_array($user->role, $this->restrictedRoles)) {
            return $next($request);
        }

        // Skip exempt routes
        $currentRoute = $request->route()->getName();
        if (in_array($currentRoute, $this->exemptRoutes)) {
            return $next($request);
        }

        // Check if user has punched in today
        $employeeRecord = EmployeeList::where('user_id', $user->id)->first();

        if (!$employeeRecord) {
            // No employee record, allow access (might be admin setup)
            return $next($request);
        }

        $todayAttendance = EmployeeAttendance::where('employee_id', $employeeRecord->id)
            ->whereDate('date', Carbon::today())
            ->first();

        // Check if punched in (has time_in or punch_in_time)
        $hasPunchedIn = $todayAttendance && 
            ($todayAttendance->time_in || $todayAttendance->punch_in_time);

        if (!$hasPunchedIn) {
            // Redirect to attendance page so they can punch in first
            $redirectRoute = $this->getAttendanceRoute($user->role);
            
            return redirect()->route($redirectRoute)
                ->with('error', 'Please punch in first before accessing other pages.');
        }

        return $next($request);
    }

    /**
     * Get the attendance route based on user role
     */
    protected function getAttendanceRoute(string $role): string
    {
        return match($role) {
            'CW' => 'cw.attendance',
            default => 'my-attendance',
        };
    }
}
