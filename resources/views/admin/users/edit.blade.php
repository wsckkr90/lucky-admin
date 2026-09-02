@extends('layouts.admin')

@section('title', 'Edit Staff User')

@section('content')

@php
    $assignedRole = $user->roles->first();
    $assignedCities = $user->cities
        ->pluck('id')
        ->toArray();
@endphp

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Edit Staff User
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.users.update',
                $user
            ) }}"
        >

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old(
                            'name',
                            $user->name
                        ) }}"
                        class="form-control"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old(
                            'email',
                            $user->email
                        ) }}"
                        class="form-control"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                    >

                    <div class="form-text">
                        Leave blank to keep the current password.
                    </div>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Role
                    </label>

                    <select
                        name="role_id"
                        class="form-select"
                        required
                    >

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                @selected(
                                    old(
                                        'role_id',
                                        $assignedRole?->id
                                    ) == $role->id
                                )
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Cities
                    </label>

                    <select
                        name="cities[]"
                        class="form-select"
                        multiple
                        size="5"
                    >

                        @foreach($cities as $city)

                            <option
                                value="{{ $city->id }}"
                                @selected(
                                    in_array(
                                        $city->id,
                                        old(
                                            'cities',
                                            $assignedCities
                                        )
                                    )
                                )
                            >
                                {{ $city->name }}
                            </option>

                        @endforeach

                    </select>

                    <div class="form-text">
                        Hold Ctrl to select multiple cities.
                    </div>

                </div>

            </div>


            <div class="form-check mt-4 mb-4">

                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    id="active"
                    class="form-check-input"
                    @checked(
                        old(
                            'active',
                            $user->active
                        )
                    )
                >

                <label
                    class="form-check-label"
                    for="active"
                >
                    Active account
                </label>

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Update User
            </button>

            <a
                href="{{ route('admin.users.index') }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection