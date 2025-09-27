<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\QualityAssuranceController::class, 'index']);

Route::get('/quality-assurance', [App\Http\Controllers\QualityAssuranceController::class, 'index'])->name('quality-assurance');

Route::post('/quality-assurance', [App\Http\Controllers\QualityAssuranceController::class, 'store'])->name('quality-assurance.store');

Route::delete('/quality-assurance/{qa_record}', [App\Http\Controllers\QualityAssuranceController::class, 'destroy'])->name('quality-assurance.destroy');
