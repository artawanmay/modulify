@extends('layouts.module')

@section('content')
    <div class="max-w-4xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-app">Assign Permissions to Role</h1>
            <p class="mt-2 text-sm text-muted">Select a role and manage its permissions.</p>
        </div>

        @if (session('status'))
            <div class="glass-surface px-4 py-3 text-sm text-app">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" action="{{ route('ac.assign.role-permissions') }}" class="glass-card">
            <label class="block text-sm font-medium text-app">Select Role</label>
            <select name="role_id" class="glass-input mt-2" onchange="this.form.submit()">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if ($selectedRole && $selectedRole->id === $role->id) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </form>

        @if ($selectedRole)
            <form class="glass-card space-y-4" method="POST" action="{{ route('ac.assign.role-permissions.save') }}">
                @csrf
                <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">

                <div class="grid gap-2 sm:grid-cols-2">
                    @foreach ($permissions as $permission)
                        <label class="flex items-center gap-2 text-sm text-app">
                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->name }}"
                                class="rounded border-white/20 bg-transparent text-emerald-300 focus:ring-0"
                                @if ($selectedRole->permissions->pluck('name')->contains($permission->name)) checked @endif
                            >
                            {{ $permission->name }}
                        </label>
                    @endforeach
                </div>

                <div>
                    <button class="glass-btn glass-btn-primary" type="submit">
                        Save Permissions
                    </button>
                </div>
            </form>
        @else
            <div class="glass-card text-sm text-muted">
                No roles available.
            </div>
        @endif
    </div>
@endsection
