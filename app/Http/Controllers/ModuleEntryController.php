<?php

/**
 * Purpose: Redirect /m/{moduleKey} to the module's configured entry route.
 * Extends: Add tracking or onboarding redirects per module here.
 * Notes: Relies on EnsureModuleAccess to validate access.
 */

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ModuleEntryController extends Controller
{
    public function enter(Request $request, string $moduleKey): RedirectResponse
    {
        $module = $request->attributes->get('activeModule');

        if (! $module instanceof Module) {
            $module = Module::query()->where('key', $moduleKey)->firstOrFail();
        }

        return redirect()->route($module->entry_route);
    }
}
