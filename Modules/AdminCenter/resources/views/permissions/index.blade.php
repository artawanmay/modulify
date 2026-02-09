@extends('layouts.module')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-app">Permissions</h1>
            <p class="mt-2 text-sm text-muted">Manage permission catalog.</p>
        </div>
        @can('permissions.create')
            <a class="glass-btn glass-btn-primary" href="{{ route('ac.permissions.create') }}">
                Create Permission
            </a>
        @endcan
    </div>

    @if (session('status'))
        <div class="mt-4 glass-surface px-4 py-3 text-sm text-app">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 glass-table">
        <table class="min-w-full text-sm">
            <thead class="text-left text-xs font-semibold uppercase tracking-wide text-muted">
                <tr>
                    <th class="px-4 py-3">Permission</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse ($permissions as $permission)
                    <tr>
                        <td class="px-4 py-3">{{ $permission->name }}</td>
                        <td class="px-4 py-3 text-right">
                            @can('permissions.delete')
                                <form class="inline" method="POST" action="{{ route('ac.permissions.destroy', $permission) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="glass-btn glass-btn-danger text-xs" type="submit">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-muted">No permissions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
