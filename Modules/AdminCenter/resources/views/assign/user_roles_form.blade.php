@extends('layouts.module')

@section('content')
    <div class="max-w-4xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-app">Assign Roles to User</h1>
            <p class="mt-2 text-sm text-muted">Select a user and manage their roles.</p>
        </div>

        @if (session('status'))
            <div class="glass-surface px-4 py-3 text-sm text-app">
                {{ session('status') }}
            </div>
        @endif

        <form method="GET" action="{{ route('ac.assign.user-roles') }}" class="glass-card">
            <label class="block text-sm font-medium text-app">Select User</label>
            <select name="user_id" class="glass-input mt-2" onchange="this.form.submit()">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if ($selectedUser && $selectedUser->id === $user->id) selected @endif>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </form>

        @if ($selectedUser)
            <form class="glass-card space-y-4" method="POST" action="{{ route('ac.assign.user-roles.save') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $selectedUser->id }}">

                <div class="grid gap-2 sm:grid-cols-2">
                    @foreach ($roles as $role)
                        <label class="flex items-center gap-2 text-sm text-app">
                            <input
                                type="checkbox"
                                name="roles[]"
                                value="{{ $role->id }}"
                                class="rounded border-white/20 bg-transparent text-emerald-300 focus:ring-0"
                                @if ($selectedUser->roles->pluck('id')->contains($role->id)) checked @endif
                            >
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>

                <div>
                    <button class="glass-btn glass-btn-primary" type="submit">
                        Save Roles
                    </button>
                </div>
            </form>
        @else
            <div class="glass-card text-sm text-muted">
                No users available.
            </div>
        @endif
    </div>
@endsection
