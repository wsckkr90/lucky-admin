@extends('layouts.admin')

@section('title', 'Create Permission')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Create Permission
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.permissions.store') }}"
        >

            @csrf

            <div class="mb-4">

                <label class="form-label">
                    Permission Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control"
                    placeholder="example: results.update"
                    required
                >

                <div class="form-text">
                    Recommended format:
                    module.action
                </div>

                @error('name')

                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Create Permission
            </button>

            <a
                href="{{ route('admin.permissions.index') }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection