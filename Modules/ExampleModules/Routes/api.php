<?php

/**
 * Purpose: Placeholder API routes for Example Modules (optional).
 * Extends: Add versioned API endpoints here if the module needs JSON APIs.
 * Notes: Keep this empty unless the module truly needs API routes.
 */

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function (): void {
    // Example: Route::get('example-modules/ping', fn () => ['ok' => true]);
});
