@extends('layouts.module')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-app">Users</h1>
            <p class="mt-2 text-sm text-muted">Manage user accounts and roles.</p>
        </div>
        @can('users.create')
            <a class="glass-btn glass-btn-primary" href="{{ route('ac.users.create') }}">
                Create User
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
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Roles</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                @forelse ($user->roles as $role)
                                    <span class="glass-badge">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-muted">No roles</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                @can('users.edit')
                                    <a class="glass-btn glass-btn-ghost text-xs" href="{{ route('ac.users.edit', $user) }}">
                                        Edit
                                    </a>
                                @endcan
                                @can('users.delete')
                                    <form method="POST" action="{{ route('ac.users.destroy', $user) }}">
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
                        <td colspan="4" class="px-4 py-8 text-center text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
