<?php

/**
 * Purpose: Explain module file/folder layout to developers.
 * Extends: Add richer documentation or links as the module evolves.
 * Notes: View lives in Modules/ExampleModules/resources/views/files.blade.php.
 */

namespace Modules\ExampleModules\Http\Controllers;

use Illuminate\Contracts\View\View;

class ExampleFilesController
{
    public function index(): View
    {
        return view('examplemodules::files');
    }
}
