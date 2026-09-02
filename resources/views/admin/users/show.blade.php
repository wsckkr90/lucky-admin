@extends('layouts.admin')

@section('title', 'User Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            {{ $user->name }}
        </h2>

        <p class="text-muted mb-0">
            {{ $user->email }}
        </p>

    </div>

    <div>

        <a
            href="{{ route(
                'admin.users.edit',
                $user
            ) }}"
            class="btn btn-primary"
        >
            Edit
        </a>

        <a
            href="{{ route(
                'admin.users.index'
            ) }}"
            class="btn btn-light"
        >
            Back
        </a>

    </div>

</div>


<div class="row g-4">

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Account
                </h5>
            </div>

            <div class="card-body">

                <p>
                    <strong>Name:</strong>
                    {{ $user->name }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $user->email }}
                </p>

                <p>
                    <strong>Status:</strong>

                    @if($user->active)

                        <span class="badge bg-success">
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Inactive
                        </span>

                    @endif

                </p>

                <p class="mb-0">
                    <strong>Created:</strong>
                    {{ $user->created_at }}
                </p>

            </div>

        </div>

    </div>


    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Roles
                </h5>
            </div>

            <div class="card-body">

                @forelse($user->roles as $role)

                    <span class="badge bg-primary me-1">
                        {{ $role->name }}
                    </span>

                @empty

                    <span class="text-muted">
                        No role assigned.
                    </span>

                @endforelse

            </div>

        </div>

    </div>


    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Assigned Cities
                </h5>
            </div>

            <div class="card-body">

                @forelse($user->cities as $city)

                    <span class="badge bg-light text-dark border me-1">
                        {{ $city->name }}
                    </span>

                @empty

                    <span class="text-muted">
                        No cities assigned.
                    </span>

                @endforelse

            </div>

        </div>

    </div>


    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Effective Permissions
                </h5>
            </div>

            <div class="card-body">

                @php
                    $permissions = $user
                        ->getAllPermissions();
                @endphp

                @forelse($permissions as $permission)

                    <span class="badge bg-secondary me-1 mb-1">
                        {{ $permission->name }}
                    </span>

                @empty

                    <span class="text-muted">
                        No permissions.
                    </span>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection