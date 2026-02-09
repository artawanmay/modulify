@extends('layouts.module')

@section('content')
    <div class="max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-app">Create Role</h1>
            <p class="mt-2 text-sm text-muted">Add a new role for access control.</p>
        </div>

        <form class="glass-card space-y-6" method="POST" action="{{ route('ac.roles.store') }}">
            @csrf

            <div>
                <label class="block text-sm font-medium text-app">Role Name</label>
                <input class="glass-input mt-2" name="name" type="text" value="{{ old('name') }}" required>
                @error('name') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3">
                <button class="glass-btn glass-btn-primary" type="submit">
                    Save
                </button>
                <a class="glass-btn glass-btn-ghost" href="{{ route('ac.roles.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
