@extends('layouts.admin')

@section('title', 'Permissions')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Permissions
        </h2>

        <p class="text-muted mb-0">
            Manage individual admin capabilities.
        </p>
    </div>

    <a
        href="{{ route('admin.permissions.create') }}"
        class="btn btn-primary"
    >
        + Add Permission
    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover mb-0">

            <thead class="table-light">

                <tr>

                    <th>#</th>
                    <th>Permission</th>
                    <th>Guard</th>
                    <th class="text-end">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($permissions as $permission)

                <tr>

                    <td>
                        {{ $permissions->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $permission->name }}
                    </td>

                    <td>
                        {{ $permission->guard_name }}
                    </td>

                    <td class="text-end">

                        <a
                            href="{{ route(
                                'admin.permissions.edit',
                                $permission
                            ) }}"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.permissions.destroy',
                                $permission
                            ) }}"
                            class="d-inline"
                            onsubmit="
                                return confirm(
                                    'Delete this permission?'
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

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="4"
                        class="text-center py-5 text-muted"
                    >
                        No permissions found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">
    {{ $permissions->links() }}
</div>

@endsection