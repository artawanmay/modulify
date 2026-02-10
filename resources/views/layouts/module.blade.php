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
    <body
        class="font-sans antialiased app-bg"
        x-data="{
            desktopCollapsed: false,
            mobileOpen: false,
            isDesktop: window.matchMedia('(min-width: 768px)').matches,
            get sidebarWidth() { return this.desktopCollapsed ? '4.5rem' : '18rem'; },
            get showLabels() { return !this.desktopCollapsed || !this.isDesktop; },
            get showTooltip() { return this.desktopCollapsed && this.isDesktop; },
            init() {
                const stored = localStorage.getItem('modulify.sidebar');
                if (stored === 'collapsed' || stored === 'expanded') {
                    this.desktopCollapsed = stored === 'collapsed';
                }
                const media = window.matchMedia('(min-width: 768px)');
                this.isDesktop = media.matches;
                media.addEventListener('change', (event) => {
                    this.isDesktop = event.matches;
                    if (this.isDesktop) {
                        this.mobileOpen = false;
                    }
                });
            },
            setDesktopCollapsed(collapsed) {
                this.desktopCollapsed = collapsed;
                localStorage.setItem('modulify.sidebar', collapsed ? 'collapsed' : 'expanded');
            },
            toggleSidebar() {
                if (this.isDesktop) {
                    this.setDesktopCollapsed(!this.desktopCollapsed);
                    return;
                }
                this.mobileOpen = !this.mobileOpen;
            },
            closeMobile() {
                this.mobileOpen = false;
            }
        }"
    >
        <div
            class="min-h-screen sidebar-grid"
            :style="{ '--sidebar-width': sidebarWidth }"
        >
            <div
                class="fixed inset-0 z-30 bg-slate-900/40 md:hidden"
                x-show="mobileOpen"
                x-transition.opacity
                @click="closeMobile"
                aria-hidden="true"
            ></div>

            <aside
                id="app-sidebar"
                class="glass-sidebar sidebar-shell fixed inset-y-0 left-0 z-40 overflow-y-auto overflow-x-hidden transition-transform duration-300 md:static md:z-20 md:translate-x-0 md:overflow-visible"
                :class="[isDesktop ? '' : (mobileOpen ? 'translate-x-0' : '-translate-x-full')]"
                @keydown.escape.window="closeMobile"
            >
                <div
                    class="flex items-center justify-between border-b glass-divider px-4 py-4"
                    :class="desktopCollapsed ? 'md:px-3' : 'md:px-5'"
                >
                    <div class="flex items-center gap-3">
                        <button
                            class="inline-flex items-center justify-center rounded-md border border-white/10 p-2 text-muted hover:text-app md:hidden"
                            type="button"
                            @click="closeMobile"
                            aria-label="Close sidebar"
                        >
                            <x-heroicon-o-x-mark class="h-5 w-5" />
                        </button>
                        <a
                            class="inline-flex items-center gap-3"
                            :class="desktopCollapsed && isDesktop ? 'md:gap-0' : ''"
                            href="{{ route('modules.dashboard') }}"
                            aria-label="Modulify"
                        >
                            <x-application-logo class="block h-8 w-auto fill-current text-app" />
                            <span
                                class="inline-flex items-center text-base font-semibold text-app md:whitespace-nowrap"
                                x-show="showLabels"
                                x-cloak
                            >
                                Modulify
                            </span>
                        </a>
                    </div>
                </div>
                <div class="px-4 py-3" :class="desktopCollapsed ? 'md:px-2' : 'md:px-5'">
                    <a
                        class="relative flex items-center justify-center rounded-xl px-3 py-2 glass-navitem glass-btn-ghost group md:justify-start"
                        :class="desktopCollapsed ? 'w-12 mx-auto md:justify-center' : 'w-full'"
                        href="{{ route('modules.dashboard') }}"
                        aria-label="Back to Modules Dashboard"
                    >
                        <span class="w-8 text-center">
                            <x-heroicon-o-arrow-left class="h-5 w-5" />
                        </span>
                        <span class="ml-2 text-sm font-medium md:whitespace-nowrap" x-show="showLabels" x-cloak>
                            Back to Modules Dashboard
                        </span>
                        <span
                            class="glass-tooltip pointer-events-none absolute left-full top-1/2 z-50 ml-3 -translate-y-1/2 whitespace-nowrap hidden md:group-hover:block md:group-focus-within:block"
                            x-show="showTooltip"
                            x-cloak
                        >
                            Back to Modules Dashboard
                        </span>
                    </a>
                </div>
                <nav class="space-y-6 px-4 pb-8" :class="desktopCollapsed ? 'md:px-2' : 'md:px-5'" aria-label="Module navigation">
                    @forelse ($menuGroups as $group => $menus)
                        @if ($group === 'Admin' && ! $showAdminGroup)
                            @continue
                        @endif
                        <div>
                            <div
                                class="text-xs font-semibold uppercase tracking-wide text-muted md:whitespace-nowrap"
                                x-show="showLabels"
                                x-cloak
                            >
                                {{ $group }}
                            </div>
                            <div class="mt-3 space-y-1">
                                @foreach ($menus as $menu)
                                    @php $isActive = request()->routeIs($menu->route_name); @endphp
                                    <a
                                        class="relative flex items-center justify-center rounded-xl px-3 py-2 glass-navitem glass-btn-ghost group md:justify-start"
                                        :class="desktopCollapsed ? 'w-12 mx-auto md:justify-center' : 'w-full'"
                                        href="{{ route($menu->route_name) }}"
                                        aria-label="{{ $menu->label }}"
                                        @if ($isActive) aria-current="page" @endif
                                    >
                                        <span class="w-8 text-center">
                                            <x-dynamic-component
                                                :component="$menu->icon ?: 'heroicon-o-rectangle-stack'"
                                                class="h-5 w-5"
                                            />
                                        </span>
                                        <span class="ml-2 text-sm font-medium md:whitespace-nowrap" x-show="showLabels" x-cloak>
                                            {{ $menu->label }}
                                        </span>
                                        <span
                                            class="glass-tooltip pointer-events-none absolute left-full top-1/2 z-50 ml-3 -translate-y-1/2 whitespace-nowrap hidden md:group-hover:block md:group-focus-within:block"
                                            x-show="showTooltip"
                                            x-cloak
                                        >
                                            {{ $menu->label }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-muted">No menus available.</div>
                    @endforelse
                </nav>
            </aside>

            <div class="min-w-0">
                <header class="glass-topbar sticky top-0 z-20">
                    <div class="flex h-16 w-full items-center gap-2 pl-2 pr-6">
                        <div class="flex items-center gap-2">
                            <button
                                class="glass-btn glass-btn-ghost p-2"
                                type="button"
                                @click="toggleSidebar"
                                aria-label="Toggle sidebar"
                                aria-controls="app-sidebar"
                                :aria-expanded="isDesktop ? (!desktopCollapsed).toString() : (mobileOpen ? 'true' : 'false')"
                                title="Toggle sidebar"
                            >
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>

                        <div class="flex-1"></div>

                        <div class="flex items-center gap-2">
                            <button
                                class="glass-btn glass-btn-ghost p-2"
                                type="button"
                                data-theme-toggle
                                title="Toggle theme"
                                aria-label="Toggle theme"
                            >
                                <svg class="h-5 w-5 theme-icon-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-11.314 1.414 1.414m11.314 11.314-1.414-1.414" />
                                </svg>
                                <svg class="h-5 w-5 theme-icon-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                                </svg>
                            </button>

                            @auth
                                <div x-data="{ open: false }" class="relative">
                                    <button
                                        class="glass-btn glass-btn-ghost flex items-center gap-2 px-2"
                                        type="button"
                                        @click="open = !open"
                                        :aria-expanded="open.toString()"
                                        aria-haspopup="true"
                                    >
                                        <span class="hidden sm:inline text-sm font-semibold text-app">{{ auth()->user()->name }}</span>
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-xs font-semibold text-app">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </span>
                                        <svg class="h-4 w-4 text-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                                        </svg>
                                    </button>
                                    <div
                                        x-show="open"
                                        x-transition
                                        x-cloak
                                        @click.away="open = false"
                                        @keydown.escape.window="open = false"
                                        class="absolute right-0 mt-2 w-48 glass-surface rounded-xl p-2 z-50"
                                    >
                                        <a class="glass-dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="glass-dropdown-item w-full text-left" type="submit">Logout</button>
                                        </form>
                                    </div>
                                </div>
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
