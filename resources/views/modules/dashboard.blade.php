@extends('layouts.modules')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-app">Modules Dashboard</h1>
        <p class="mt-2 text-sm text-muted">Choose a module you have access to.</p>
    </div>

    @if ($modules->isEmpty())
        <div class="glass-card text-center text-muted">
            No modules available for your account.
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($modules as $module)
                <a class="glass-card glass-card-hover group" href="{{ url('/m/'.$module->key) }}">
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold text-app">{{ $module->name }}</div>
                        <div class="glass-badge uppercase">
                            {{ $module->key }}
                        </div>
                    </div>
                    @if ($module->description)
                        <p class="mt-3 text-sm text-muted">{{ $module->description }}</p>
                    @else
                        <p class="mt-3 text-sm text-muted">Open module</p>
                    @endif
                    <div class="mt-5 text-sm font-medium text-app">
                        Enter module →
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection
