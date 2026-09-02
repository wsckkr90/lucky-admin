@extends('layouts.admin')

@section('title', 'Edit City')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">
        <h5 class="mb-0">
            Edit City
        </h5>
    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.cities.update', $city) }}"
        >

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    City Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old(
                        'name',
                        $city->name
                    ) }}"
                    class="form-control"
                    required
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Slug
                </label>

                <input
                    type="text"
                    name="slug"
                    value="{{ old(
                        'slug',
                        $city->slug
                    ) }}"
                    class="form-control"
                    required
                >

            </div>

            <div class="form-check mb-4">

                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    class="form-check-input"
                    id="active"
                    @checked(
                        old('active', $city->active)
                    )
                >

                <label
                    class="form-check-label"
                    for="active"
                >
                    Active
                </label>

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update City
            </button>

            <a
                href="{{ route('admin.cities.index') }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection