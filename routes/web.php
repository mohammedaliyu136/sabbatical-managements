<?php

use App\Http\Controllers\Settings;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SabbaticalController;
use App\Http\Controllers\ProgressReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Redirect old leave route to new system
    Route::get('leave', function() {
        return redirect()->route('leaves.index');
    })->name('settings.profile.leave');

    // Leave Management Routes (Legacy)
    Route::resource('leaves', LeaveController::class);
    Route::patch('leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');

    // Sabbatical Management Routes
    Route::resource('sabbaticals', SabbaticalController::class);
    Route::get('sabbaticals/status/active', [SabbaticalController::class, 'active'])->name('sabbaticals.active');
    Route::get('sabbaticals/status/upcoming', [SabbaticalController::class, 'upcoming'])->name('sabbaticals.upcoming');
    Route::get('sabbaticals/status/completed', [SabbaticalController::class, 'completed'])->name('sabbaticals.completed');
    Route::patch('sabbaticals/{sabbatical}/approve', [SabbaticalController::class, 'approve'])->name('sabbaticals.approve');
    Route::patch('sabbaticals/{sabbatical}/reject', [SabbaticalController::class, 'reject'])->name('sabbaticals.reject');
    Route::post('sabbaticals/{sabbatical}/reports', [ProgressReportController::class, 'store'])->name('progress-reports.store');
    Route::delete('sabbaticals/{sabbatical}/reports/{report}', [ProgressReportController::class, 'destroy'])->name('progress-reports.destroy');

    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
});

require __DIR__.'/auth.php';
