<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjectionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes untuk objections
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('objections/filter', [ObjectionController::class, 'filter'])->name('objections.filter');
    Route::resource('objections', ObjectionController::class);
    Route::patch('objections/{objection}/update-status', [ObjectionController::class, 'updateStatus'])->name('objections.update-status');
});

require __DIR__.'/auth.php';
