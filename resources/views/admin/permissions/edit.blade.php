@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Edit Permission
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.permissions.update',
                $permission
            ) }}"
        >

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="form-label">
                    Permission Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old(
                        'name',
                        $permission->name
                    ) }}"
                    class="form-control"
                    required
                >

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Permission
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