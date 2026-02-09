@extends('layouts.module')

@section('content')
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-semibold text-app">Admin Center</h1>
            <p class="mt-2 text-sm text-muted">Manage users, roles, permissions, and module access.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <a class="glass-card glass-card-hover p-4" href="{{ route('ac.users.index') }}">
                <div class="text-sm font-semibold text-app">Users</div>
                <div class="mt-2 text-xs text-muted">Manage application users</div>
            </a>
            <a class="glass-card glass-card-hover p-4" href="{{ route('ac.roles.index') }}">
                <div class="text-sm font-semibold text-app">Roles</div>
                <div class="mt-2 text-xs text-muted">Manage role definitions</div>
            </a>
            <a class="glass-card glass-card-hover p-4" href="{{ route('ac.permissions.index') }}">
                <div class="text-sm font-semibold text-app">Permissions</div>
                <div class="mt-2 text-xs text-muted">Manage permissions catalog</div>
            </a>
            <a class="glass-card glass-card-hover p-4" href="{{ route('ac.assign.module-access') }}">
                <div class="text-sm font-semibold text-app">Module Access Matrix</div>
                <div class="mt-2 text-xs text-muted">Assign module permissions per role</div>
            </a>
        </div>
    </div>
@endsection
