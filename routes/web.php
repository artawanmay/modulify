<?php

use App\Http\Controllers\ModuleEntryController;
use App\Http\Controllers\ModulesDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureModuleAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('modules.dashboard');
    }

    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('modules.dashboard');
})->name('dashboard');

Route::get('/dashboard-modules', [ModulesDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('modules.dashboard');

Route::get('/m/{moduleKey}', [ModuleEntryController::class, 'enter'])
    ->middleware(['auth', EnsureModuleAccess::class]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
