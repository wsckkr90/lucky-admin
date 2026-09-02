@extends('layouts.admin')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following:</strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('title', 'Create Staff User')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Create Staff User
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.users.store') }}"
        >

            @csrf

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Role
                    </label>

                    <select
                        name="role_id"
                        class="form-select @error('role_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Select Role
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                @selected(
                                    old('role_id') == $role->id
                                )
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('role_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

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
                                        old('cities', [])
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
                    checked
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
                Create User
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