@extends('layouts.module')

@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-app">Projects</h1>
            <p class="mt-2 text-sm text-muted">Manage your project list.</p>
        </div>
        <a class="glass-btn glass-btn-primary" href="{{ route('pm.projects.create') }}">
            Create Project
        </a>
    </div>

    <div class="glass-card mt-6 text-center text-muted">
        No projects yet. Use the create button to add your first project.
    </div>
@endsection
