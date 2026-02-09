@extends('layouts.module')

@section('content')
    <div class="space-y-4">
        <div>
            <h1 class="text-2xl font-semibold text-app">Create Project</h1>
            <p class="mt-2 text-sm text-muted">Fill the dynamic form based on schema configuration.</p>
        </div>

        @if ($moduleForm)
            <livewire:module-form-renderer :module-form="$moduleForm" />
        @else
            <div class="glass-card text-sm text-muted">
                Module form configuration is missing. Please seed module forms first.
            </div>
        @endif
    </div>
@endsection
