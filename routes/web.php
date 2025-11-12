<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');

Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');

Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('project-material-management');

Route::post('/project-material-management', [App\Http\Controllers\QualityAssuranceController::class, 'store'])->name('project-material-management.store');

Route::delete('/project-material-management/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('project-material-management.destroy');

Route::get('/project-material-management/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'show'])->name('project-material-management-show');

// Materials routes within Project context
Route::post('/project-material-management/materials', [App\Http\Controllers\QualityAssuranceController::class, 'storeMaterial'])->name('project-material-management.materials.store');
Route::put('/project-material-management/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'updateMaterial'])->name('project-material-management.materials.update');
Route::delete('/project-material-management/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'destroyMaterial'])->name('project-material-management.materials.destroy');

Route::get('/transaction', [App\Http\Controllers\AuditController::class, 'index'])->name('transaction');

Route::get('/finance', [App\Http\Controllers\FinanceController::class, 'index'])->name('finance');

Route::get('/projects', [App\Http\Controllers\ProjectsController::class, 'index'])->name('projects');

Route::get('/employee-attendance', [App\Http\Controllers\EmployeeAttendanceController::class, 'index'])->name('employee-attendance');
