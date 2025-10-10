<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');

Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');

Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/quality-assurance', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('quality-assurance');

Route::post('/quality-assurance', [App\Http\Controllers\QualityAssuranceController::class, 'store'])->name('quality-assurance.store');

Route::delete('/quality-assurance/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('quality-assurance.destroy');

Route::get('/quality-assurance/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'show'])->name('quality-assurance.show');

// Materials routes within Quality Assurance context
Route::post('/quality-assurance/materials', [App\Http\Controllers\QualityAssuranceController::class, 'storeMaterial'])->name('quality-assurance.materials.store');
Route::put('/quality-assurance/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'updateMaterial'])->name('quality-assurance.materials.update');
Route::delete('/quality-assurance/materials/{id}', [App\Http\Controllers\QualityAssuranceController::class, 'destroyMaterial'])->name('quality-assurance.materials.destroy');

Route::get('/audit', [App\Http\Controllers\AuditController::class, 'index'])->name('audit');

Route::get('/finance', [App\Http\Controllers\FinanceController::class, 'index'])->name('finance');

Route::get('/projects', [App\Http\Controllers\ProjectsController::class, 'index'])->name('projects');

Route::get('/employee-attendance', [App\Http\Controllers\EmployeeAttendanceController::class, 'index'])->name('employee-attendance');
