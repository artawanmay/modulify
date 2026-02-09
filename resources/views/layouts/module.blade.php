<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? ($activeModule?->name ?? 'Module') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus+jakarta+sans:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased app-bg" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">
        <div class="min-h-screen lg:flex">
            <div
                class="fixed inset-0 z-20 bg-slate-900/40 lg:hidden"
                x-show="sidebarOpen"
                x-transition.opacity
                @click="sidebarOpen = false"
            ></div>

            <aside
                class="glass-sidebar fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto overflow-x-hidden transition-[transform,width,opacity] duration-300 lg:static"
                :class="sidebarOpen ? 'translate-x-0 lg:w-64 lg:translate-x-0 lg:opacity-100' : '-translate-x-full lg:w-0 lg:-translate-x-full lg:opacity-0 lg:pointer-events-none'"
            >
                <div class="flex items-center justify-between border-b glass-divider px-5 py-5">
                    <div class="flex items-center gap-3">
                        <button
                            class="inline-flex items-center justify-center rounded-md border border-white/10 p-2 text-muted hover:text-app"
                            type="button"
                            @click="sidebarOpen = ! sidebarOpen"
                            aria-label="Toggle sidebar"
                            :aria-expanded="sidebarOpen ? 'true' : 'false'"
                        >
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <a class="inline-flex items-center gap-3" href="{{ route('modules.dashboard') }}">
                            <x-application-logo class="block h-8 w-auto fill-current text-app" />
                            <span class="text-base font-semibold text-app">Modulify</span>
                        </a>
                    </div>
                </div>
                <div class="px-5 py-4">
                    <a class="glass-btn w-full" href="{{ route('modules.dashboard') }}">
                        Back to Modules Dashboard
                    </a>
                </div>
                <nav class="space-y-6 px-5 pb-8">
                    @forelse ($menuGroups as $group => $menus)
                        @if ($group === 'Admin' && ! $showAdminGroup)
                            @continue
                        @endif
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wide text-muted">
                                {{ $group }}
                            </div>
                            <div class="mt-3 space-y-1">
                                @foreach ($menus as $menu)
                                    <a class="glass-btn glass-btn-ghost w-full justify-start px-3 py-2 text-sm" href="{{ route($menu->route_name) }}">
                                        {{ $menu->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-muted">No menus available.</div>
                    @endforelse
                </nav>
            </aside>

            <div class="flex-1">
                <header class="glass-topbar sticky top-0 z-20">
                    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button
                                class="inline-flex items-center justify-center rounded-md border border-white/10 p-2.5 text-muted hover:text-app"
                                type="button"
                                @click="sidebarOpen = ! sidebarOpen"
                                aria-label="Toggle sidebar"
                                :aria-expanded="sidebarOpen ? 'true' : 'false'"
                            >
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <button class="glass-btn glass-btn-ghost" type="button" data-theme-toggle>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-11.314 1.414 1.414m11.314 11.314-1.414-1.414" />
                                </svg>
                                <span data-theme-label>Dark</span>
                            </button>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-muted">
                            @auth
                                <span class="text-app">{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="glass-btn glass-btn-ghost" type="submit">Logout</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </header>

                <main class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                    @yield('content')
                </main>
            </div>
        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
