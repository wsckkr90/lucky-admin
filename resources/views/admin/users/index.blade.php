@extends('layouts.admin')

@section('title', 'Staff Users')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Staff Users
        </h2>

        <p class="text-muted mb-0">
            Manage staff accounts, roles and city access.
        </p>
    </div>

    <a
        href="{{ route('admin.users.create') }}"
        class="btn btn-primary"
    >
        + Add User
    </a>

</div>


<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.users.index') }}"
        >

            <div class="row g-3">

                <div class="col-md-5">

                    <label class="form-label">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Name or email"
                    >

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        Role
                    </label>

                    <select
                        name="role"
                        class="form-select"
                    >

                        <option value="">
                            All Roles
                        </option>

                        @foreach($roles as $role)

                            <option
                                value="{{ $role->id }}"
                                @selected(
                                    request('role') == $role->id
                                )
                            >
                                {{ $role->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="">
                            All
                        </option>

                        <option
                            value="active"
                            @selected(
                                request('status') === 'active'
                            )
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected(
                                request('status') === 'inactive'
                            )
                        >
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                    >
                        Filter
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<div class="card border-0 shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th>#</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Cities</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-end">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($users as $user)

                <tr>

                    <td>
                        {{ $users->firstItem() + $loop->index }}
                    </td>

                    <td>

                        <div class="fw-semibold">
                            {{ $user->name }}
                        </div>

                        <small class="text-muted">
                            {{ $user->email }}
                        </small>

                    </td>


                    <td>

                        @forelse($user->roles as $role)

                            <span class="badge bg-primary">
                                {{ $role->name }}
                            </span>

                        @empty

                            <span class="text-muted">
                                No role
                            </span>

                        @endforelse

                    </td>


                    <td>

                        @forelse($user->cities as $city)

                            <span class="badge bg-light text-dark border">
                                {{ $city->name }}
                            </span>

                        @empty

                            <span class="text-muted">
                                All / None
                            </span>

                        @endforelse

                    </td>


                    <td>

                        @if($user->active)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @endif

                    </td>


                    <td>
                        {{ $user->created_at?->format('d-m-Y') }}
                    </td>


                    <td class="text-end">

                        <a
                            href="{{ route(
                                'admin.users.show',
                                $user
                            ) }}"
                            class="btn btn-sm btn-outline-secondary"
                        >
                            View
                        </a>

                        <a
                            href="{{ route(
                                'admin.users.edit',
                                $user
                            ) }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Edit
                        </a>

                        @if($user->id !== auth()->id())

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.users.destroy',
                                    $user
                                ) }}"
                                class="d-inline"
                                onsubmit="
                                    return confirm(
                                        'Delete this user?'
                                    );
                                "
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                >
                                    Delete
                                </button>

                            </form>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        class="text-center py-5 text-muted"
                    >
                        No staff users found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">
    {{ $users->links() }}
</div>

@endsection