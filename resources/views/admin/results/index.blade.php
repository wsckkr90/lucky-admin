@extends('layouts.admin')

@section('title', 'Result History')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Result History
        </h2>

        <p class="text-muted mb-0">
            Manage and review game results.
        </p>
    </div>

    <a
        href="{{ route('admin.results.create') }}"
        class="btn btn-primary"
    >
        + Add Result
    </a>

</div>


{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.results.index') }}"
        >

            <div class="row g-3">

                <div class="col-lg-3">

                    <label class="form-label">
                        Game
                    </label>

                    <select
                        name="game_id"
                        class="form-select"
                    >

                        <option value="">
                            All Games
                        </option>

                        @foreach($games as $game)

                            <option
                                value="{{ $game->id }}"
                                @selected(
                                    request('game_id') == $game->id
                                )
                            >
                                {{ $game->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-lg-2">

                    <label class="form-label">
                        Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="form-control"
                    >

                </div>


                <div class="col-lg-2">

                    <label class="form-label">
                        From
                    </label>

                    <input
                        type="date"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        class="form-control"
                    >

                </div>


                <div class="col-lg-2">

                    <label class="form-label">
                        To
                    </label>

                    <input
                        type="date"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        class="form-control"
                    >

                </div>


                <div class="col-lg-2">

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
                            value="published"
                            @selected(
                                request('status') === 'published'
                            )
                        >
                            Published
                        </option>

                        <option
                            value="pending"
                            @selected(
                                request('status') === 'pending'
                            )
                        >
                            Pending
                        </option>

                        <option
                            value="corrected"
                            @selected(
                                request('status') === 'corrected'
                            )
                        >
                            Corrected
                        </option>

                        <option
                            value="cancelled"
                            @selected(
                                request('status') === 'cancelled'
                            )
                        >
                            Cancelled
                        </option>

                    </select>

                </div>


                <div class="col-lg-1 d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-primary w-100"
                    >
                        Go
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- Results --}}
<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Date</th>

                        <th>Game</th>

                        <th>Open</th>

                        <th>Jodi</th>

                        <th>Close</th>

                        <th>Result</th>

                        <th>Source</th>

                        <th>Status</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($results as $result)

                    <tr>

                        <td>
                            {{ $results->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ $result->result_date?->format('d-m-Y') }}
                        </td>

                        <td>

                            <div class="fw-semibold">
                                {{ $result->game?->name ?? '—' }}
                            </div>

                            <small class="text-muted">
                                {{ $result->game?->city?->name ?? '' }}
                            </small>

                        </td>

                        <td>
                            {{ $result->open_panna ?? '—' }}
                        </td>

                        <td>
                            {{ $result->jodi ?? '—' }}
                        </td>

                        <td>
                            {{ $result->close_panna ?? '—' }}
                        </td>

                        <td>
                            <strong>
                                {{ $result->result ?? '—' }}
                            </strong>
                        </td>

                        <td>

                            @if($result->source === 'scraper')

                                <span class="badge bg-info text-dark">
                                    Scraper
                                </span>

                            @elseif($result->source === 'import')

                                <span class="badge bg-secondary">
                                    Import
                                </span>

                            @else

                                <span class="badge bg-primary">
                                    Manual
                                </span>

                            @endif

                        </td>

                        <td>

                            @switch($result->status)

                                @case('published')
                                    <span class="badge bg-success">
                                        Published
                                    </span>
                                    @break

                                @case('pending')
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                    @break

                                @case('corrected')
                                    <span class="badge bg-primary">
                                        Corrected
                                    </span>
                                    @break

                                @case('cancelled')
                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>
                                    @break

                            @endswitch

                        </td>

                        <td class="text-end">

                            <a
                                href="{{ route(
                                    'admin.results.show',
                                    $result
                                ) }}"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                View
                            </a>

                            <a
                                href="{{ route(
                                    'admin.results.edit',
                                    $result
                                ) }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.results.destroy',
                                    $result
                                ) }}"
                                class="d-inline"
                                onsubmit="
                                    return confirm(
                                        'Delete this result?'
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
                            colspan="10"
                            class="text-center py-5 text-muted"
                        >
                            No results found.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="mt-3">

    {{ $results->links() }}

</div>

@endsection