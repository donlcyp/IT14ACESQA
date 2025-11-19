<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinanceSectionsController;
use App\Http\Controllers\TransactionController;

// Public authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected application routes
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:QA,PM,Owner')->group(function () {
        Route::get('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('project-material-management');
        Route::post('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'store'])->name('project-material-management.store');
        Route::delete('/project-material-management/{project_record}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('project-material-management.destroy');
        Route::get('/project-material-management/{project_record}', [App\Http\Controllers\QualityAssuranceController::class, 'show'])->name('project-material-management-show');
        // Materials routes within Project context
        Route::post('/project-material-management/materials', [App\Http\Controllers\QualityAssuranceController::class, 'storeMaterial'])->name('project-material-management.materials.store');
        Route::put('/project-material-management/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'updateMaterial'])->name('project-material-management.materials.update');
        Route::delete('/project-material-management/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'destroyMaterial'])->name('project-material-management.materials.destroy');
    });

    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

    Route::get('/transaction', [App\Http\Controllers\AuditController::class, 'index'])->name('transaction');
    Route::post('/transaction', [App\Http\Controllers\AuditController::class, 'store'])->name('transaction.store');

    // New Transaction System Routes (restrict to Owner for now)
    Route::middleware('role:Owner')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::get('/transactions/{projectId}/invoice/{supplier}', [TransactionController::class, 'invoice'])->name('transactions.invoice');
        Route::get('/transactions-history', [TransactionController::class, 'history'])->name('transactions.history');
    });

    // Finance (Owner only by default)
    Route::middleware('role:Owner')->group(function () {
        Route::get('/finance', [App\Http\Controllers\FinanceController::class, 'index'])->name('finance');
        Route::post('/finance', [App\Http\Controllers\FinanceController::class, 'store'])->name('finance.store');

        // Finance subsections
        Route::get('/finance/revenue', [FinanceSectionsController::class, 'revenue'])->name('finance.revenue');
        Route::get('/finance/expenses', [FinanceSectionsController::class, 'expenses'])->name('finance.expenses');
        Route::get('/finance/budget', [FinanceSectionsController::class, 'budgetIndex'])->name('finance.budget');
        Route::post('/finance/budget', [FinanceSectionsController::class, 'budgetStore'])->name('finance.budget.store');
        Route::get('/finance/purchase-orders', [FinanceSectionsController::class, 'purchaseOrdersIndex'])->name('finance.purchase-orders');
        Route::post('/finance/purchase-orders', [FinanceSectionsController::class, 'purchaseOrdersStore'])->name('finance.purchase-orders.store');
        Route::post('/finance/purchase-orders/{id}/status', [FinanceSectionsController::class, 'purchaseOrdersUpdateStatus'])->name('finance.purchase-orders.status');
    });

    Route::middleware('role:PM,Owner')->group(function () {
        Route::get('/projects', [App\Http\Controllers\ProjectsController::class, 'index'])->name('projects');
        Route::post('/projects', [App\Http\Controllers\ProjectsController::class, 'store'])->name('projects.store');
        Route::put('/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('projects.update');
        Route::post('/projects/{project}/recommend', [App\Http\Controllers\ProjectsController::class, 'recommendCompletion'])->name('projects.recommend');
        Route::post('/projects/{project}/approve', [App\Http\Controllers\ProjectsController::class, 'approve'])->name('projects.approve');
        Route::post('/projects/{project}/complete', [App\Http\Controllers\ProjectsController::class, 'complete'])->name('projects.complete');
        // Archives routes
        Route::get('/archives', [App\Http\Controllers\ProjectsController::class, 'archives'])->name('archives');
        Route::post('/projects/{project}/archive', [App\Http\Controllers\ProjectsController::class, 'archive'])->name('projects.archive');
        Route::put('/projects/{project}/unarchive', [App\Http\Controllers\ProjectsController::class, 'unarchive'])->name('projects.unarchive');
    });
    
    // Archives routes
    // Employee and attendance (Owner only by default)
    Route::middleware('role:Owner')->group(function () {
        Route::get('/employee-attendance', [App\Http\Controllers\EmployeeAttendanceController::class, 'index'])->name('employee-attendance');
        Route::post('/employee-attendance/{employee}', [App\Http\Controllers\EmployeeAttendanceController::class, 'update'])->name('employee-attendance.update');
        Route::get('/employee-attendance-history', [App\Http\Controllers\EmployeeAttendanceController::class, 'history'])->name('employee-attendance.history');
        // New Employee page route (separate from attendance)
        Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
        Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
    });
});

