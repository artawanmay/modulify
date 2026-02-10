{{-- 
/**
 * Purpose: Explain how the module sidebar pulls menus and enforces permissions.
 * Extends: Add more menu examples or admin workflows here.
 * Notes: Uses data injected into layouts.module by AppServiceProvider.
 */
--}}
@extends('layouts.module')

@section('content')
    <div class="space-y-6">
        <div class="space-y-2">
            <h1 class="text-2xl font-semibold text-app">Sidebar &amp; Menus</h1>
            <p class="text-sm text-muted">
                Sidebar items are dynamic. They come from <span class="text-app">module_menus</span> and are filtered by permissions.
            </p>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-base font-semibold text-app">How the sidebar loads menus</h2>
            <p class="mt-2 text-sm text-muted">
                The view composer in <span class="text-app">AppServiceProvider</span> loads menus for the active moduleKey.
            </p>
            <pre class="mt-4 overflow-x-auto rounded-xl border border-white/10 bg-white/5 p-4 text-xs text-muted">
$module = Module::where('key', $moduleKey)->first();
$menus = $module->menus()
    ->where('is_active', true)
    ->orderBy('sort')
    ->get()
    ->filter(fn ($menu) => !$menu->permission_name
        || auth()->user()->can($menu->permission_name));

$menuGroups = $menus->groupBy(fn ($menu) => $menu->group ?: 'Main');
            </pre>
            <p class="mt-3 text-sm text-muted">
                The layout file <span class="text-app">resources/views/layouts/module.blade.php</span> renders these groups.
            </p>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-base font-semibold text-app">Permission visibility</h2>
            <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-muted">
                <li>If <span class="text-app">permission_name</span> is null, the menu always shows.</li>
                <li>If set, the user must have that permission to see the menu item.</li>
                <li>Group <span class="text-app">Admin</span> only appears if create/edit/delete permissions exist.</li>
            </ul>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-base font-semibold text-app">Where to add menu items</h2>
            <ol class="mt-3 list-decimal space-y-2 pl-5 text-sm text-muted">
                <li>
                    <span class="text-app">Seeder (recommended)</span>:
                    define new rows in <span class="text-app">database/seeders/DatabaseSeeder.php</span>.
                </li>
                <li>
                    <span class="text-app">Admin Center UI</span>:
                    manage menu records at runtime for quick tweaks.
                </li>
            </ol>
        </div>
    </div>
@endsection
