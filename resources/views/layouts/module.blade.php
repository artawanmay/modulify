<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? ($activeModule?->name ?? 'Module') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <div class="min-h-screen lg:flex">
            <aside class="w-full bg-white lg:w-64 lg:border-r lg:border-slate-200">
                <div class="border-b border-slate-200 px-5 py-6">
                    <div class="text-xs uppercase tracking-wide text-slate-500">Module</div>
                    <div class="mt-2 text-lg font-semibold text-slate-900">
                        {{ $activeModule?->name ?? 'Module' }}
                    </div>
                </div>
                <div class="px-5 py-4">
                    <a class="inline-flex w-full items-center justify-center rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100" href="{{ route('modules.dashboard') }}">
                        Back to Modules Dashboard
                    </a>
                </div>
                <nav class="space-y-6 px-5 pb-8">
                    @forelse ($menuGroups as $group => $menus)
                        @if ($group === 'Admin' && ! $showAdminGroup)
                            @continue
                        @endif
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                {{ $group }}
                            </div>
                            <div class="mt-3 space-y-1">
                                @foreach ($menus as $menu)
                                    <a class="block rounded-md px-3 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" href="{{ route($menu->route_name) }}">
                                        {{ $menu->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-slate-500">No menus available.</div>
                    @endforelse
                </nav>
            </aside>

            <div class="flex-1">
                <header class="border-b border-slate-200 bg-white">
                    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
                        <div>
                            <div class="text-xs uppercase tracking-wide text-slate-500">Module Area</div>
                            <div class="text-lg font-semibold text-slate-900">
                                {{ $activeModule?->name ?? 'Module' }}
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-sm text-slate-600">
                            @auth
                                <span>{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="hover:text-slate-900" type="submit">Logout</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </header>

                <main class="mx-auto w-full max-w-6xl px-6 py-8">
                    @yield('content')
                </main>
            </div>
        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
