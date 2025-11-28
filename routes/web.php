<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;

// Public authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected application routes
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

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

        // Project Documents
        Route::post('/projects/{project}/documents', [App\Http\Controllers\ProjectsController::class, 'storeDocument'])->name('projects.documents.store');
        Route::delete('/projects/{project}/documents/{document}', [App\Http\Controllers\ProjectsController::class, 'deleteDocument'])->name('projects.documents.delete');

        // Project Updates
        Route::post('/projects/{project}/updates', [App\Http\Controllers\ProjectsController::class, 'storeUpdate'])->name('projects.updates.store');

        // Archives
        Route::get('/archives', [App\Http\Controllers\ProjectsController::class, 'archives'])->name('archives');
        Route::post('/projects/{project}/archive', [App\Http\Controllers\ProjectsController::class, 'archive'])->name('projects.archive');
        Route::put('/projects/{project}/unarchive', [App\Http\Controllers\ProjectsController::class, 'unarchive'])->name('projects.unarchive');

        // Employee & Attendance
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

    // API Routes for Project Employee Management (PM and OWNER only)
    Route::post('/api/projects/{project}/employees', [App\Http\Controllers\EmployeeAttendanceController::class, 'assignEmployeesToProject'])
        ->name('api.projects.employees.assign')
        ->middleware(['auth', 'verified']);

    // OWNER & PM can download project reports
    Route::middleware('role:OWNER,PM')->group(function () {
        Route::get('/pdf/project/{project}', [App\Http\Controllers\PDFController::class, 'downloadProjectReport'])->name('pdf.project.download');
        Route::get('/csv/project/{project}', [App\Http\Controllers\PDFController::class, 'downloadProjectCsv'])->name('csv.project.download');
        Route::get('/pdf/attendance-report', [App\Http\Controllers\PDFController::class, 'downloadAttendanceReport'])->name('pdf.attendance-report.download');
    });
});

