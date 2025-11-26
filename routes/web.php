<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinanceSectionsController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\TransactionController;
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
    });

    // ===== QUALITY ASSURANCE (QA): Project Material Management Only =====
    Route::middleware('role:OWNER,QA')->group(function () {
        Route::get('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('project-material-management');
        Route::post('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'store'])->name('project-material-management.store');
        Route::delete('/project-material-management/{project_record}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('project-material-management.destroy');
        Route::get('/project-material-management/{project_record}', [App\Http\Controllers\QualityAssuranceController::class, 'show'])->name('project-material-management-show');
        Route::post('/project-material-management/materials', [App\Http\Controllers\QualityAssuranceController::class, 'storeMaterial'])->name('project-material-management.materials.store');
        Route::put('/project-material-management/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'updateMaterial'])->name('project-material-management.materials.update');
        Route::delete('/project-material-management/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'destroyMaterial'])->name('project-material-management.materials.destroy');
    });

    // ===== FINANCIAL MANAGER (FM): Transactions & Finance Only =====
    Route::middleware('role:OWNER,FM')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::get('/transactions/{projectId}/invoice/{supplier}', [TransactionController::class, 'invoice'])->name('transactions.invoice');
        Route::get('/transactions-history', [TransactionController::class, 'history'])->name('transactions.history');

        Route::get('/finance', [App\Http\Controllers\FinanceController::class, 'index'])->name('finance.index');
        Route::post('/finance', [App\Http\Controllers\FinanceController::class, 'store'])->name('finance.store');
        Route::get('/finance/supplier-invoices', [FinanceController::class, 'supplierInvoices'])->name('finance.supplier-invoices');
        Route::get('/finance/payment-summary', [FinanceController::class, 'paymentSummary'])->name('finance.payment-summary');
        Route::get('/finance/revenue', [FinanceSectionsController::class, 'revenue'])->name('finance.revenue');
        Route::get('/finance/expenses', [FinanceSectionsController::class, 'expenses'])->name('finance.expenses');
        Route::get('/finance/budget', [FinanceSectionsController::class, 'budgetIndex'])->name('finance.budget');
        Route::post('/finance/budget', [FinanceSectionsController::class, 'budgetStore'])->name('finance.budget.store');
        Route::get('/finance/purchase-orders', [FinanceSectionsController::class, 'purchaseOrdersIndex'])->name('finance.purchase-orders');
        Route::post('/finance/purchase-orders', [FinanceSectionsController::class, 'purchaseOrdersStore'])->name('finance.purchase-orders.store');
        Route::post('/finance/purchase-orders/{id}/status', [FinanceSectionsController::class, 'purchaseOrdersUpdateStatus'])->name('finance.purchase-orders.status');
    });

    // Shared routes
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

    Route::get('/transaction', [App\Http\Controllers\AuditController::class, 'index'])->name('transaction');
    Route::post('/transaction', [App\Http\Controllers\AuditController::class, 'store'])->name('transaction.store');

    // API Routes for Project Employee Management (PM and OWNER only)
    Route::post('/api/projects/{project}/employees', [App\Http\Controllers\EmployeeAttendanceController::class, 'assignEmployeesToProject'])
        ->name('api.projects.employees.assign')
        ->middleware(['auth', 'verified']);

    // ===== PDF DOWNLOAD ROUTES =====
    // OWNER & FM can download financial PDFs
    Route::middleware('role:OWNER,FM')->group(function () {
        Route::get('/pdf/invoice/{invoice}', [App\Http\Controllers\PDFController::class, 'downloadInvoice'])->name('pdf.invoice.download');
        Route::get('/pdf/transaction-report', [App\Http\Controllers\PDFController::class, 'downloadTransactionReport'])->name('pdf.transaction-report.download');
        Route::get('/pdf/finance-summary', [App\Http\Controllers\PDFController::class, 'downloadFinanceSummary'])->name('pdf.finance-summary.download');
    });

    // OWNER & PM can download project reports
    Route::middleware('role:OWNER,PM')->group(function () {
        Route::get('/pdf/project/{project}', [App\Http\Controllers\PDFController::class, 'downloadProjectReport'])->name('pdf.project.download');
        Route::get('/csv/project/{project}', [App\Http\Controllers\PDFController::class, 'downloadProjectCsv'])->name('csv.project.download');
        Route::get('/pdf/attendance-report', [App\Http\Controllers\PDFController::class, 'downloadAttendanceReport'])->name('pdf.attendance-report.download');
    });
});

