@extends('layouts.admin')

@section('title', 'Games')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">Games</h2>

        <p class="text-muted mb-0">
            Manage games, cities, timings and chart configuration.
        </p>
    </div>

    <a
        href="{{ route('admin.games.create') }}"
        class="btn btn-primary"
    >
        + Add Game
    </a>

</div>


{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.games.index') }}"
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
                        placeholder="Game name, legacy key or slug"
                    >

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        City
                    </label>

                    <select
                        name="city_id"
                        class="form-select"
                    >

                        <option value="">
                            All Cities
                        </option>

                        @foreach($cities as $city)

                            <option
                                value="{{ $city->id }}"
                                @selected(
                                    request('city_id') == $city->id
                                )
                            >
                                {{ $city->name }}
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


{{-- Games table --}}
<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover mb-0 align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Game</th>

                        <th>City</th>

                        <th>Open</th>

                        <th>Close</th>

                        <th>Status</th>

                        <th>Order</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($games as $game)

                    <tr>

                        <td>
                            {{ $games->firstItem() + $loop->index }}
                        </td>

                        <td>

                            <div class="fw-semibold">
                                {{ $game->name }}
                            </div>

                            @if($game->legacy_id)

                                <div class="small text-muted">
                                    {{ $game->legacy_id }}
                                </div>

                            @endif

                        </td>

                        <td>
                            {{ $game->city?->name ?? '—' }}
                        </td>

                        <td>
                            {{ $game->open_time ?? '—' }}
                        </td>

                        <td>
                            {{ $game->close_time ?? '—' }}
                        </td>

                        <td>

                            @if($game->active)

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
                            {{ $game->display_order }}
                        </td>

                        <td class="text-end">

                            <a
                                href="{{ route(
                                    'admin.games.show',
                                    $game
                                ) }}"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                View
                            </a>

                            <a
                                href="{{ route(
                                    'admin.games.edit',
                                    $game
                                ) }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.games.destroy',
                                    $game
                                ) }}"
                                class="d-inline"
                                onsubmit="
                                    return confirm(
                                        'Delete this game?'
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
                            colspan="8"
                            class="text-center py-5 text-muted"
                        >
                            No games found.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="mt-3">
    {{ $games->links() }}
</div>

@endsection