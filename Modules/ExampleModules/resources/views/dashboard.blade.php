{{-- 
/**
 * Purpose: Example module dashboard with quick onboarding steps and structure overview.
 * Extends: Add more learning sections or links for developers here.
 * Notes: Uses glass UI classes from the main app theme.
 */
--}}
@extends('layouts.module')

@section('content')
    <div class="space-y-6">
        <div class="space-y-2">
            <h1 class="text-2xl font-semibold text-app">Example Modules</h1>
            <p class="text-sm text-muted">
                This module is a living guide for how Modulify modules are structured, wired, and displayed.
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a class="glass-btn glass-btn-ghost" href="{{ route('ex.files') }}">Files &amp; Folders</a>
            <a class="glass-btn glass-btn-ghost" href="{{ route('ex.sidebar') }}">Sidebar &amp; Menus</a>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="glass-card p-5">
                <h2 class="text-base font-semibold text-app">Module folder tree</h2>
                <p class="mt-2 text-sm text-muted">Everything for a module stays inside its own folder.</p>
                <pre class="mt-4 overflow-x-auto rounded-xl border border-white/10 bg-white/5 p-4 text-xs text-muted">
Modules/
  ExampleModules/
    app/Http/Controllers/
    Routes/web.php
    resources/views/
    database/
    module.json
                </pre>
                <p class="mt-3 text-sm text-muted">
                    Keep module routes, controllers, and views contained so each module can evolve independently.
                </p>
            </div>

            <div class="glass-card p-5">
                <h2 class="text-base font-semibold text-app">Create a module in 7 steps</h2>
                <ol class="mt-3 list-decimal space-y-2 pl-5 text-sm text-muted">
                    <li>Run <span class="text-app">php artisan module:make YourModule</span>.</li>
                    <li>Create module routes in <span class="text-app">Modules/YourModule/Routes/web.php</span>.</li>
                    <li>Build controllers under <span class="text-app">Modules/YourModule/app/Http/Controllers</span>.</li>
                    <li>Add views in <span class="text-app">Modules/YourModule/resources/views</span>.</li>
                    <li>Seed <span class="text-app">modules</span> table with key, name, entry_route.</li>
                    <li>Seed <span class="text-app">module_menus</span> for sidebar items + permissions.</li>
                    <li>Assign permissions to roles (Spatie) and test access.</li>
                </ol>
            </div>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-base font-semibold text-app">Common mistakes</h2>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-muted">
                <li>Forgetting <span class="text-app">access {moduleKey}</span> permission.</li>
                <li>Missing <span class="text-app">entry_route</span> in the modules table.</li>
                <li>Using route names that do not match the module prefix.</li>
                <li>Mixing mobile drawer logic with desktop collapse in the sidebar.</li>
                <li>Using global <span class="text-app">group-hover</span> that reveals all labels at once.</li>
            </ul>
        </div>
    </div>
@endsection
