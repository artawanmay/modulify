<?php

/**
 * Purpose: Render the modules dashboard with modules the user can access.
 * Extends: Adjust module filtering, ordering, or card data here.
 * Notes: Uses Module model + access {moduleKey} permissions.
 */

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModulesDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $modules = Module::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->filter(fn (Module $module) => $user && $user->can('access '.$module->key));

        return view('modules.dashboard', [
            'modules' => $modules,
        ]);
    }
}
