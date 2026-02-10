<?php

/**
 * Purpose: Guard module routes by validating module existence, active status, and access permission.
 * Extends: Add extra module-level checks (tenant, plan, etc.) here if needed.
 * Notes: Expects a moduleKey route parameter and sets activeModule on the request.
 */

namespace App\Http\Middleware;

use App\Models\Module;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureModuleAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $moduleKey = $request->route('moduleKey');

        if (! $moduleKey) {
            abort(404);
        }

        $module = Module::query()->where('key', $moduleKey)->first();

        if (! $module) {
            abort(404);
        }

        if (! $module->is_active) {
            abort(403);
        }

        $user = $request->user();

        if (! $user || ! $user->can('access '.$moduleKey)) {
            abort(403);
        }

        $request->attributes->set('activeModule', $module);

        return $next($request);
    }
}
