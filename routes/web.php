<?php

use App\Http\Controllers\MonitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MonitorController::class, 'index'])->name('dashboard');
Route::post('/monitors', [MonitorController::class, 'store'])->name('monitors.store');