@extends('layouts.module')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-app">Roles</h1>
            <p class="mt-2 text-sm text-muted">Manage role definitions.</p>
        </div>
        @can('roles.create')
            <a class="glass-btn glass-btn-primary" href="{{ route('ac.roles.create') }}">
                Create Role
            </a>
        @endcan
    </div>

    @if (session('status'))
        <div class="mt-4 glass-surface px-4 py-3 text-sm text-app">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-4 glass-surface px-4 py-3 text-sm text-rose-300">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mt-6 glass-table">
        <table class="min-w-full text-sm">
            <thead class="text-left text-xs font-semibold uppercase tracking-wide text-muted">
                <tr>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Users</th>
                    <th class="px-4 py-3">Permissions</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse ($roles as $role)
                    <tr>
                        <td class="px-4 py-3">{{ $role->name }}</td>
                        <td class="px-4 py-3">{{ $role->users_count }}</td>
                        <td class="px-4 py-3">{{ $role->permissions_count }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                @can('roles.edit')
                                    <a class="glass-btn glass-btn-ghost text-xs" href="{{ route('ac.roles.edit', $role) }}">
                                        Edit
                                    </a>
                                @endcan
                                @can('roles.delete')
                                    <form method="POST" action="{{ route('ac.roles.destroy', $role) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="glass-btn glass-btn-danger text-xs" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-muted">No roles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
