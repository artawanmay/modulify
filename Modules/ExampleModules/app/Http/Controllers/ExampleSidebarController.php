<?php

/**
 * Purpose: Explain how sidebar menus are defined and rendered.
 * Extends: Add usage examples for menus, groups, and permissions here.
 * Notes: View lives in Modules/ExampleModules/resources/views/sidebar.blade.php.
 */

namespace Modules\ExampleModules\Http\Controllers;

use Illuminate\Contracts\View\View;

class ExampleSidebarController
{
    public function index(): View
    {
        return view('examplemodules::sidebar');
    }
}
