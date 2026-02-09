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
            sidebarState: 'expanded',
            mobileOpen: false,
            isDesktop: window.innerWidth >= 1024,
            get isCollapsed() { return this.sidebarState === 'collapsed'; },
            init() {
                const stored = localStorage.getItem('modulify.sidebar');
                if (stored === 'collapsed' || stored === 'expanded') {
                    this.sidebarState = stored;
                }
                this.isDesktop = window.innerWidth >= 1024;
                window.addEventListener('resize', () => {
                    this.isDesktop = window.innerWidth >= 1024;
                    if (this.isDesktop) {
                        this.mobileOpen = false;
                    }
                });
            },
            setSidebarState(state) {
                this.sidebarState = state;
                localStorage.setItem('modulify.sidebar', state);
            },
            toggleSidebar() {
                if (this.isDesktop) {
                    this.setSidebarState(this.isCollapsed ? 'expanded' : 'collapsed');
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
            class="min-h-screen lg:grid"
            :class="isCollapsed ? 'lg:grid-cols-[4.5rem_1fr]' : 'lg:grid-cols-[18rem_1fr]'"
        >
            <div
                class="fixed inset-0 z-30 bg-slate-900/40 lg:hidden"
                x-show="mobileOpen"
                x-transition.opacity
                @click="closeMobile"
                aria-hidden="true"
            ></div>

            <aside
                id="app-sidebar"
                class="glass-sidebar group fixed inset-y-0 left-0 z-40 w-72 overflow-y-auto overflow-x-hidden transition-[transform,width] duration-300 lg:static lg:z-20 lg:translate-x-0 lg:overflow-visible"
                :class="[mobileOpen ? 'translate-x-0' : '-translate-x-full', isCollapsed ? 'lg:w-[4.5rem] lg:hover:w-72' : 'lg:w-72']"
                @keydown.escape.window="closeMobile"
            >
                <div
                    class="flex items-center justify-between border-b glass-divider px-4 py-4"
                    :class="isCollapsed ? 'lg:px-3' : 'lg:px-5'"
                >
                    <div class="flex items-center gap-3">
                        <button
                            class="inline-flex items-center justify-center rounded-md border border-white/10 p-2 text-muted hover:text-app lg:hidden"
                            type="button"
                            @click="closeMobile"
                            aria-label="Close sidebar"
                        >
                            <x-heroicon-o-x-mark class="h-5 w-5" />
                        </button>
                        <a
                            class="inline-flex items-center gap-3"
                            :class="isCollapsed ? 'lg:gap-0' : ''"
                            href="{{ route('modules.dashboard') }}"
                        >
                            <x-application-logo class="block h-8 w-auto fill-current text-app" />
                            <span
                                class="inline-flex items-center text-base font-semibold text-app transition-[opacity,max-width] duration-200 lg:whitespace-nowrap"
                                :class="isCollapsed ? 'lg:opacity-0 lg:max-w-0 lg:overflow-hidden lg:group-hover:opacity-100 lg:group-hover:max-w-[20rem]' : 'lg:opacity-100 lg:max-w-none'"
                            >
                                Modulify
                            </span>
                        </a>
                    </div>
                </div>
                <div class="px-4 py-3" :class="isCollapsed ? 'lg:px-2' : 'lg:px-5'">
                    <a
                        class="glass-navitem glass-btn-ghost"
                        :class="isCollapsed ? 'lg:justify-center lg:gap-0' : 'lg:justify-start'"
                        href="{{ route('modules.dashboard') }}"
                    >
                        <x-heroicon-o-arrow-left class="h-5 w-5" />
                        <span
                            class="inline-flex items-center text-sm font-medium transition-[opacity,max-width] duration-200 lg:whitespace-nowrap"
                            :class="isCollapsed ? 'lg:opacity-0 lg:max-w-0 lg:overflow-hidden lg:group-hover:opacity-100 lg:group-hover:max-w-[20rem]' : 'lg:opacity-100 lg:max-w-none'"
                        >
                            Back to Modules Dashboard
                        </span>
                    </a>
                </div>
                <nav class="space-y-6 px-4 pb-8" :class="isCollapsed ? 'lg:px-2' : 'lg:px-5'" aria-label="Module navigation">
                    @forelse ($menuGroups as $group => $menus)
                        @if ($group === 'Admin' && ! $showAdminGroup)
                            @continue
                        @endif
                        <div>
                            <div
                                class="text-xs font-semibold uppercase tracking-wide text-muted transition-[opacity,max-width] duration-200 lg:whitespace-nowrap"
                                :class="isCollapsed ? 'lg:opacity-0 lg:max-w-0 lg:overflow-hidden lg:group-hover:opacity-100 lg:group-hover:max-w-[20rem]' : 'lg:opacity-100 lg:max-w-none'"
                            >
                                {{ $group }}
                            </div>
                            <div class="mt-3 space-y-1">
                                @foreach ($menus as $menu)
                                    @php $isActive = request()->routeIs($menu->route_name); @endphp
                                    <a
                                        class="glass-navitem glass-btn-ghost"
                                        :class="isCollapsed ? 'lg:justify-center lg:gap-0' : 'lg:justify-start'"
                                        href="{{ route($menu->route_name) }}"
                                        @if ($isActive) aria-current="page" @endif
                                    >
                                        <x-dynamic-component
                                            :component="$menu->icon ?: 'heroicon-o-rectangle-stack'"
                                            class="h-5 w-5"
                                        />
                                        <span
                                            class="inline-flex items-center text-sm font-medium transition-[opacity,max-width] duration-200 lg:whitespace-nowrap"
                                            :class="isCollapsed ? 'lg:opacity-0 lg:max-w-0 lg:overflow-hidden lg:group-hover:opacity-100 lg:group-hover:max-w-[20rem]' : 'lg:opacity-100 lg:max-w-none'"
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
                    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-6">
                        <div class="flex items-center gap-3">
                            <button
                                class="inline-flex items-center justify-center rounded-md border border-white/10 p-2.5 text-muted hover:text-app"
                                type="button"
                                @click="toggleSidebar"
                                aria-label="Toggle sidebar"
                                aria-controls="app-sidebar"
                                :aria-expanded="isDesktop ? (!isCollapsed).toString() : (mobileOpen ? 'true' : 'false')"
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

                <main class="mx-auto w-full max-w-6xl px-6 py-8">
                    @yield('content')
                </main>
            </div>
        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
