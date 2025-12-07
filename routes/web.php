<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

// Public authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public support routes
Route::get('/forgot-password', [\App\Http\Controllers\SupportController::class, 'showForgotPassword'])->name('support.forgot-password');
Route::post('/forgot-password', [\App\Http\Controllers\SupportController::class, 'submitForgotPassword'])->name('support.forgot-password');
Route::get('/support', [\App\Http\Controllers\SupportController::class, 'showSupportForm'])->name('support.form');
Route::post('/support', [\App\Http\Controllers\SupportController::class, 'submitSupportTicket'])->name('support.submit-ticket');

// Protected application routes
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/finance-graphs', [App\Http\Controllers\DashboardController::class, 'financeGraphs'])->name('finance-graphs');

    // ===== SHARED ROUTES: OWNER & PROJECT MANAGER =====
    Route::middleware('role:OWNER,PM')->group(function () {
        // Projects
        Route::get('/projects', [App\Http\Controllers\ProjectsController::class, 'index'])->name('projects');
        Route::get('/api/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'getProject'])->name('api.projects.get');
        Route::match(['get', 'post'], '/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'show'])->name('projects.show');
        Route::post('/projects', [App\Http\Controllers\ProjectsController::class, 'store'])->name('projects.store');
        Route::put('/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('projects.update');
        Route::post('/projects/{project}/recommend', [App\Http\Controllers\ProjectsController::class, 'recommendCompletion'])->name('projects.recommend');
        Route::post('/projects/{project}/approve', [App\Http\Controllers\ProjectsController::class, 'approve'])->name('projects.approve');
        Route::post('/projects/{project}/complete', [App\Http\Controllers\ProjectsController::class, 'complete'])->name('projects.complete');

        // Project Material Management
        Route::get('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('project-material-management');

        // Transactions (Material Returns)
        Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{id}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');

        // Project Documents
        Route::post('/projects/{project}/documents', [App\Http\Controllers\ProjectsController::class, 'storeDocument'])->name('projects.documents.store');
        Route::delete('/projects/{project}/documents/{document}', [App\Http\Controllers\ProjectsController::class, 'deleteDocument'])->name('projects.documents.delete');

        // Project Updates
        Route::post('/projects/{project}/updates', [App\Http\Controllers\ProjectsController::class, 'storeUpdate'])->name('projects.updates.store');
        Route::get('/projects/{project}/tasks', [App\Http\Controllers\ProjectsController::class, 'getTasksByMaterial'])->name('projects.tasks.get');

        // Project Materials
        Route::get('/projects/{project}/materials/{material}', [App\Http\Controllers\ProjectsController::class, 'getMaterial'])->name('projects.materials.get');
        Route::post('/projects/{project}/materials', [App\Http\Controllers\ProjectsController::class, 'storeMaterial'])->name('projects.materials.store');
        Route::put('/projects/{project}/materials/{material}', [App\Http\Controllers\ProjectsController::class, 'updateMaterial'])->name('projects.materials.update');
        Route::delete('/projects/{project}/materials/{material}', [App\Http\Controllers\ProjectsController::class, 'deleteMaterial'])->name('projects.materials.delete');

        // Project Employees
        Route::post('/projects/{project}/employees', [App\Http\Controllers\ProjectsController::class, 'assignEmployee'])->name('projects.employees.assign');
        Route::delete('/projects/{project}/employees/{employee}', [App\Http\Controllers\ProjectsController::class, 'removeEmployee'])->name('projects.employees.remove');

        // Archives
        Route::get('/archives', [App\Http\Controllers\ProjectsController::class, 'archives'])->name('archives');
        Route::post('/projects/{project}/archive', [App\Http\Controllers\ProjectsController::class, 'archive'])->name('projects.archive');
        Route::put('/projects/{project}/unarchive', [App\Http\Controllers\ProjectsController::class, 'unarchive'])->name('projects.unarchive');

        // Employee & Attendance (OWNER & PM only)
        Route::get('/employee-attendance', [App\Http\Controllers\EmployeeAttendanceController::class, 'index'])->name('employee-attendance');
        Route::post('/employee-attendance/{employee}', [App\Http\Controllers\EmployeeAttendanceController::class, 'storeAttendance'])->name('employee-attendance.store');
        Route::get('/employee-attendance-history', [App\Http\Controllers\EmployeeAttendanceController::class, 'history'])->name('employee-attendance.history');
    });

    // ===== OWNER ONLY: Additional exclusive access =====
    Route::middleware('role:OWNER')->group(function () {
        // Employee Management
        Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
        Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');

        // Admin User Management
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('/', [UserManagementController::class, 'index'])->name('index');
                Route::get('/create', [UserManagementController::class, 'create'])->name('create');
                Route::post('/', [UserManagementController::class, 'store'])->name('store');
            });

            // Support Management
            Route::prefix('support')->name('support.')->group(function () {
                // Password Reset Requests
                Route::get('/password-resets', [\App\Http\Controllers\AdminSupportController::class, 'passwordResets'])->name('password-resets');
                Route::get('/password-resets/{id}', [\App\Http\Controllers\AdminSupportController::class, 'showPasswordReset'])->name('password-reset.show');
                Route::post('/password-resets/{id}/resolve', [\App\Http\Controllers\AdminSupportController::class, 'resolvePasswordReset'])->name('password-reset.resolve');
                Route::post('/password-resets/{id}/reject', [\App\Http\Controllers\AdminSupportController::class, 'rejectPasswordReset'])->name('password-reset.reject');

                // Support Tickets
                Route::get('/tickets', [\App\Http\Controllers\AdminSupportController::class, 'supportTickets'])->name('tickets');
                Route::get('/tickets/{id}', [\App\Http\Controllers\AdminSupportController::class, 'showSupportTicket'])->name('ticket.show');
                Route::post('/tickets/{id}/respond', [\App\Http\Controllers\AdminSupportController::class, 'respondToTicket'])->name('ticket.respond');
            });
        });

        // Activity Logs
        Route::prefix('logs')->name('logs.')->group(function () {
            Route::get('/', [App\Http\Controllers\LogController::class, 'index'])->name('index');
            Route::get('/filter', [App\Http\Controllers\LogController::class, 'filterByUser'])->name('filter');
            Route::get('/export', [App\Http\Controllers\LogController::class, 'export'])->name('export');
        });

        // Activity Log Routes
        Route::get('/activity-log', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-log.index');
        Route::get('/activity-log/{log}', [App\Http\Controllers\ActivityLogController::class, 'show'])->name('activity-log.show');
    });

    // ===== EMPLOYEE ONLY: Attendance and Punch In/Out =====
    Route::middleware('auth')->group(function () {
        // These routes allow any authenticated user with an employee profile to punch in/out
        Route::get('/my-attendance', [App\Http\Controllers\EmployeeAttendanceController::class, 'index'])->name('my-attendance');
        Route::post('/punch-in', [App\Http\Controllers\EmployeeAttendanceController::class, 'punchInEmployee'])->name('punch.in.employee');
        Route::post('/punch-out', [App\Http\Controllers\EmployeeAttendanceController::class, 'punchOutEmployee'])->name('punch.out.employee');
        Route::get('/punch-status', [App\Http\Controllers\EmployeeAttendanceController::class, 'getPunchStatusEmployee'])->name('punch.status.employee');
    });

    // API Routes for Project Employee Management (PM and OWNER only)
    Route::post('/api/projects/{project}/employees', [App\Http\Controllers\EmployeeAttendanceController::class, 'assignEmployeesToProject'])
        ->name('api.projects.employees.assign')
        ->middleware(['auth', 'verified']);

    // OWNER & PM can download project reports
    Route::middleware('role:OWNER,PM')->group(function () {
        Route::get('/pdf/project/{project}', [App\Http\Controllers\PDFController::class, 'downloadProjectReport'])->name('pdf.project.download');
        Route::get('/csv/project/{project}', [App\Http\Controllers\PDFController::class, 'downloadProjectCsv'])->name('csv.project.download');
        Route::get('/pdf/boq/{project}', [App\Http\Controllers\PDFController::class, 'downloadBOQ'])->name('pdf.boq.download');
        Route::get('/pdf/attendance-report', [App\Http\Controllers\PDFController::class, 'downloadAttendanceReport'])->name('pdf.attendance-report.download');
    });

    // ===== HR/TIMEKEEPER ONLY: Attendance Validation =====
    Route::middleware('role:HR')->group(function () {
        Route::prefix('attendance-validation')->name('attendance-validation.')->group(function () {
            // Dashboard and main views
            Route::get('/', [App\Http\Controllers\AttendanceValidationController::class, 'index'])->name('index');
            Route::get('/dashboard', [App\Http\Controllers\AttendanceValidationController::class, 'dashboard'])->name('dashboard');
            Route::get('/approved', [App\Http\Controllers\AttendanceValidationController::class, 'approved'])->name('approved');
            Route::get('/rejected', [App\Http\Controllers\AttendanceValidationController::class, 'rejected'])->name('rejected');
            Route::get('/filter', [App\Http\Controllers\AttendanceValidationController::class, 'filter'])->name('filter');

            // Single validation review and actions
            Route::get('/{attendance}', [App\Http\Controllers\AttendanceValidationController::class, 'show'])->name('show');
            Route::post('/{attendance}/approve', [App\Http\Controllers\AttendanceValidationController::class, 'approve'])->name('approve');
            Route::post('/{attendance}/reject', [App\Http\Controllers\AttendanceValidationController::class, 'reject'])->name('reject');

            // Employee history
            Route::get('/employee/{employee}/history', [App\Http\Controllers\AttendanceValidationController::class, 'employeeHistory'])->name('employee.history');
        });
    });
});

