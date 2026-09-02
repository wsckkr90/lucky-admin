@extends('layouts.admin')

@section('title', 'Cities')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Cities</h2>
        <p class="text-muted mb-0">
            Manage your game cities and markets.
        </p>
    </div>

    <a
        href="{{ route('admin.cities.create') }}"
        class="btn btn-primary"
    >
        + Add City
    </a>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0">

                <thead class="table-light">

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Games</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($cities as $city)

                    <tr>

                        <td>
                            {{ $city->id }}
                        </td>

                        <td>
                            <strong>
                                {{ $city->name }}
                            </strong>
                        </td>

                        <td>
                            {{ $city->slug }}
                        </td>

                        <td>
                            {{ $city->games_count }}
                        </td>

                        <td>

                            @if($city->active)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td class="text-end">

                            <a
                                href="{{ route(
                                    'admin.cities.edit',
                                    $city
                                ) }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.cities.destroy',
                                    $city
                                ) }}"
                                class="d-inline"
                                onsubmit="
                                    return confirm(
                                        'Delete this city?'
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
                            colspan="6"
                            class="text-center py-5 text-muted"
                        >
                            No cities found.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="mt-3">
    {{ $cities->links() }}
</div>

@endsection