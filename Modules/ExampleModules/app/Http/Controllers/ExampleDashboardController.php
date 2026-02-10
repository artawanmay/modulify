<?php

/**
 * Purpose: Serve the Example Modules dashboard learning page.
 * Extends: Add module-level stats or links to additional pages here.
 * Notes: View lives in Modules/ExampleModules/resources/views/dashboard.blade.php.
 */

namespace Modules\ExampleModules\Http\Controllers;

use Illuminate\Contracts\View\View;

class ExampleDashboardController
{
    public function index(): View
    {
        return view('examplemodules::dashboard');
    }
}
