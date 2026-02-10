{{-- 
/**
 * Purpose: Explain the module file/folder layout and key system files.
 * Extends: Add deeper links or module-specific conventions here.
 * Notes: Keep paths in sync with actual repository structure.
 */
--}}
@extends('layouts.module')

@section('content')
    <div class="space-y-6">
        <div class="space-y-2">
            <h1 class="text-2xl font-semibold text-app">Files &amp; Folders</h1>
            <p class="text-sm text-muted">
                Use this page as a reference for where each module file belongs and what it controls.
            </p>
        </div>

        <div class="grid gap-4 lg:grid-cols-2">
            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Module routes</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">Modules/&lt;ModuleName&gt;/Routes/web.php</pre>
                <p class="mt-2 text-sm text-muted">Define /m/&lt;moduleKey&gt; routes, names, middleware, and defaults.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Controllers</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">Modules/&lt;ModuleName&gt;/app/Http/Controllers</pre>
                <p class="mt-2 text-sm text-muted">Keep controllers per feature or per page.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Views</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">Modules/&lt;ModuleName&gt;/resources/views</pre>
                <p class="mt-2 text-sm text-muted">Blade views for module pages. Use <span class="text-app">layouts.module</span>.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Module database</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">Modules/&lt;ModuleName&gt;/database</pre>
                <p class="mt-2 text-sm text-muted">Optional migrations/seeders specific to the module.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Access middleware</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">app/Http/Middleware/EnsureModuleAccess.php</pre>
                <p class="mt-2 text-sm text-muted">Guards module access using moduleKey + access permission.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Module layout</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">resources/views/layouts/module.blade.php</pre>
                <p class="mt-2 text-sm text-muted">Sidebar + topbar shell for every module page.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Seeders</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">database/seeders/DatabaseSeeder.php</pre>
                <p class="mt-2 text-sm text-muted">Register modules, menus, and permissions for new modules.</p>
            </div>

            <div class="glass-card p-4">
                <h2 class="text-sm font-semibold text-app">Database tables</h2>
                <pre class="mt-3 rounded-xl border border-white/10 bg-white/5 p-3 text-xs text-muted">modules
module_menus</pre>
                <p class="mt-2 text-sm text-muted">
                    <span class="text-app">modules</span> powers the dashboard. <span class="text-app">module_menus</span> powers sidebar items.
                </p>
            </div>
        </div>
    </div>
@endsection
