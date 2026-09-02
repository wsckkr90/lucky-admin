@extends('layouts.admin')

@section('title', 'Roles')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Roles</h2>

        <p class="text-muted mb-0">
            Manage staff roles and their permissions.
        </p>
    </div>

    <a
        href="{{ route('admin.roles.create') }}"
        class="btn btn-primary"
    >
        + Add Role
    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Users</th>
                    <th>Permissions</th>
                    <th class="text-end">Actions</th>
                </tr>

            </thead>

            <tbody>

            @forelse($roles as $role)

                <tr>

                    <td>
                        {{ $roles->firstItem() + $loop->index }}
                    </td>

                    <td>

                        <strong>
                            {{ $role->name }}
                        </strong>

                        @if($role->name === 'Super Admin')

                            <span class="badge bg-danger ms-2">
                                Protected
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $role->users_count }}
                    </td>

                    <td>
                        {{ $role->permissions->count() }}
                    </td>

                    <td class="text-end">

                        <a
                            href="{{ route(
                                'admin.roles.show',
                                $role
                            ) }}"
                            class="btn btn-sm btn-outline-secondary"
                        >
                            View
                        </a>

                        <a
                            href="{{ route(
                                'admin.roles.edit',
                                $role
                            ) }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Edit
                        </a>

                        @if($role->name !== 'Super Admin')

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.roles.destroy',
                                    $role
                                ) }}"
                                class="d-inline"
                                onsubmit="
                                    return confirm(
                                        'Delete this role?'
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
                        colspan="5"
                        class="text-center py-5 text-muted"
                    >
                        No roles found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">
    {{ $roles->links() }}
</div>

@endsection