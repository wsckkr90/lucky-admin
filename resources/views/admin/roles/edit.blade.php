@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Edit Role
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.roles.update',
                $role
            ) }}"
        >

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="form-label">
                    Role Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old(
                        'name',
                        $role->name
                    ) }}"
                    class="form-control"
                    required
                >

            </div>


            <h5 class="mb-3">
                Permissions
            </h5>


            @php
                $assignedPermissions =
                    $role->permissions
                        ->pluck('id')
                        ->toArray();
            @endphp


            @foreach($permissions as $group => $groupPermissions)

                <div class="border rounded p-3 mb-3">

                    <h6 class="text-capitalize mb-3">
                        {{ $group }}
                    </h6>

                    <div class="row">

                        @foreach($groupPermissions as $permission)

                            <div class="col-md-4 mb-2">

                                <div class="form-check">

                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->id }}"
                                        class="form-check-input"
                                        id="permission_{{ $permission->id }}"
                                        @checked(
                                            in_array(
                                                $permission->id,
                                                old(
                                                    'permissions',
                                                    $assignedPermissions
                                                )
                                            )
                                        )
                                    >

                                    <label
                                        class="form-check-label"
                                        for="permission_{{ $permission->id }}"
                                    >
                                        {{ $permission->name }}
                                    </label>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach


            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Role
            </button>

            <a
                href="{{ route('admin.roles.index') }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection