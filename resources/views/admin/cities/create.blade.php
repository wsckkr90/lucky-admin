@extends('layouts.admin')

@section('title', 'Create City')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">
        <h5 class="mb-0">Create City</h5>
    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.cities.store') }}"
        >

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    City Name
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

            <div class="mb-3">

                <label class="form-label">
                    Slug
                </label>

                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug') }}"
                    class="form-control @error('slug') is-invalid @enderror"
                    placeholder="Leave empty to generate automatically"
                >

                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="form-check mb-4">

                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    class="form-check-input"
                    id="active"
                    checked
                >

                <label
                    class="form-check-label"
                    for="active"
                >
                    Active
                </label>

            </div>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save City
                </button>

                <a
                    href="{{ route('admin.cities.index') }}"
                    class="btn btn-light"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection