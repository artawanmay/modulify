@extends('layouts.module')

@section('content')
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-semibold text-app">Project Management</h1>
            <p class="mt-2 text-sm text-muted">Welcome to the Project Management module dashboard.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <a class="glass-card glass-card-hover p-4" href="{{ route('pm.projects.index') }}">
                <div class="text-sm font-semibold text-app">Projects</div>
                <div class="mt-2 text-xs text-muted">View project list</div>
            </a>
            <a class="glass-card glass-card-hover p-4" href="{{ route('pm.settings') }}">
                <div class="text-sm font-semibold text-app">Settings</div>
                <div class="mt-2 text-xs text-muted">Manage module settings</div>
            </a>
        </div>
    </div>
@endsection
