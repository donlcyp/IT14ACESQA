<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/quality-assurance', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('quality-assurance');

Route::post('/quality-assurance', [App\Http\Controllers\QualityAssuranceController::class, 'store'])->name('quality-assurance.store');

Route::delete('/quality-assurance/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('quality-assurance.destroy');

Route::get('/quality-assurance/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'show'])->name('quality-assurance.show');

Route::get('/audit', [App\Http\Controllers\AuditController::class, 'index'])->name('audit');

Route::get('/finance', [App\Http\Controllers\FinanceController::class, 'index'])->name('finance');

Route::get('/projects', [App\Http\Controllers\ProjectsController::class, 'index'])->name('projects');

Route::get('/employee-attendance', [App\Http\Controllers\EmployeeAttendanceController::class, 'index'])->name('employee-attendance');
