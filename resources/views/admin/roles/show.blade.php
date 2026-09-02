@extends('layouts.admin')

@section('title', 'Role Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            {{ $role->name }}
        </h2>

        <p class="text-muted mb-0">
            Role permissions
        </p>

    </div>

    <a
        href="{{ route('admin.roles.index') }}"
        class="btn btn-light"
    >
        Back
    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <h5 class="mb-3">
            Assigned Permissions
        </h5>

        @forelse($role->permissions as $permission)

            <span class="badge bg-primary me-1 mb-2">
                {{ $permission->name }}
            </span>

        @empty

            <p class="text-muted mb-0">
                No permissions assigned.
            </p>

        @endforelse

    </div>

</div>

@endsection