<?php

/**
 * Purpose: Register web routes for the Example Modules learning area.
 * Extends: Add new module pages here with auth + EnsureModuleAccess middleware.
 * Notes: Keep route names prefixed with ex.* and set moduleKey defaults.
 */

use App\Http\Middleware\EnsureModuleAccess;
use Illuminate\Support\Facades\Route;
use Modules\ExampleModules\Http\Controllers\ExampleDashboardController;
use Modules\ExampleModules\Http\Controllers\ExampleFilesController;
use Modules\ExampleModules\Http\Controllers\ExampleSidebarController;

Route::prefix('m/example-modules')
    ->middleware(['auth', EnsureModuleAccess::class])
    ->name('ex.')
    ->group(function (): void {
        Route::get('/dashboard', [ExampleDashboardController::class, 'index'])
            ->name('dashboard')
            ->middleware('can:example-modules.view')
            ->defaults('moduleKey', 'example-modules');

        Route::get('/files', [ExampleFilesController::class, 'index'])
            ->name('files')
            ->middleware('can:example-modules.view')
            ->defaults('moduleKey', 'example-modules');

        Route::get('/sidebar', [ExampleSidebarController::class, 'index'])
            ->name('sidebar')
            ->middleware('can:example-modules.view')
            ->defaults('moduleKey', 'example-modules');
    });
