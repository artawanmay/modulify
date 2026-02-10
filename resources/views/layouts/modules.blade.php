{{--
/**
 * Purpose: Layout for the Modules Dashboard (/dashboard-modules).
 * Extends: Adjust the topbar or container for the modules landing page here.
 * Notes: Cards are rendered by ModulesDashboardController.
 */
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Modules Dashboard' }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus+jakarta+sans:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased app-bg">
        <div class="min-h-screen">
            <header class="glass-topbar sticky top-0 z-20">
                <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
                    <div class="flex items-center gap-3">
                        <a class="flex items-center" href="{{ route('modules.dashboard') }}">
                            <x-application-logo class="block h-8 w-auto fill-current text-app" />
                        </a>
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
                            <a class="glass-btn glass-btn-ghost" href="{{ route('profile.edit') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="glass-btn glass-btn-ghost" type="submit">Logout</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-6 py-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>
