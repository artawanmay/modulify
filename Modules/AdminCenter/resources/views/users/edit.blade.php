@extends('layouts.module')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-app">Edit User</h1>
            <p class="mt-2 text-sm text-muted">Update user profile and roles.</p>
        </div>

        <form class="glass-card space-y-6" method="POST" action="{{ route('ac.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-app">Name</label>
                <input class="glass-input mt-2" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-app">Email</label>
                <input class="glass-input mt-2" name="email" type="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-app">Password (optional)</label>
                <input class="glass-input mt-2" name="password" type="password">
                @error('password') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            @can('assignments.manage')
                <div>
                    <label class="block text-sm font-medium text-app">Roles</label>
                    <div class="mt-3 grid gap-2 sm:grid-cols-2">
                        @foreach ($roles as $role)
                            <label class="flex items-center gap-2 text-sm text-app">
                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $role->id }}"
                                    class="rounded border-white/20 bg-transparent text-emerald-300 focus:ring-0"
                                    @if (in_array($role->name, $user->roles->pluck('name')->all(), true)) checked @endif
                                >
                                {{ $role->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('roles.*') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
                </div>
            @endcan

            <div class="flex items-center gap-3">
                <button class="glass-btn glass-btn-primary" type="submit">
                    Update
                </button>
                <a class="glass-btn glass-btn-ghost" href="{{ route('ac.users.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
