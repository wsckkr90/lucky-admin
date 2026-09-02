@extends('layouts.admin')

@section('title', "Today's Results")

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            Today's Results
        </h2>

        <p class="text-muted mb-0">
            {{ $date->format('l, d F Y') }}
        </p>

    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('admin.results.index') }}"
            class="btn btn-outline-secondary"
        >
            Result History
        </a>

        <a
            href="{{ route('admin.results.create') }}"
            class="btn btn-primary"
        >
            Full Result Entry
        </a>

    </div>

</div>


@if($errors->any())

    <div class="alert alert-danger">

        <strong>
            Please fix the following:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th style="min-width: 180px;">
                            Game
                        </th>

                        <th>
                            Open
                        </th>

                        <th>
                            Close
                        </th>

                        <th style="min-width: 130px;">
                            Open Panna
                        </th>

                        <th style="min-width: 100px;">
                            Jodi
                        </th>

                        <th style="min-width: 130px;">
                            Close Panna
                        </th>

                        <th style="min-width: 110px;">
                            Result
                        </th>

                        <th style="min-width: 130px;">
                            Status
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($games as $game)

                    @php
                        $result = $game->results->first();
                    @endphp

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>

                            <div class="fw-semibold">
                                {{ $game->name }}
                            </div>

                            <small class="text-muted">
                                {{ $game->city?->name ?? '—' }}
                            </small>

                        </td>


                        <td>
                            {{ $game->open_time ?? '—' }}
                        </td>


                        <td>
                            {{ $game->close_time ?? '—' }}
                        </td>


                        <td colspan="6">

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.results.today.update'
                                ) }}"
                                class="row g-2 align-items-center"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="game_id"
                                    value="{{ $game->id }}"
                                >


                                <div class="col">

                                    <input
                                        type="text"
                                        name="open_panna"
                                        value="{{ old(
                                            'open_panna',
                                            $result?->open_panna
                                        ) }}"
                                        class="form-control form-control-sm"
                                        placeholder="Open"
                                    >

                                </div>


                                <div class="col">

                                    <input
                                        type="text"
                                        name="jodi"
                                        value="{{ old(
                                            'jodi',
                                            $result?->jodi
                                        ) }}"
                                        class="form-control form-control-sm"
                                        placeholder="Jodi"
                                    >

                                </div>


                                <div class="col">

                                    <input
                                        type="text"
                                        name="close_panna"
                                        value="{{ old(
                                            'close_panna',
                                            $result?->close_panna
                                        ) }}"
                                        class="form-control form-control-sm"
                                        placeholder="Close"
                                    >

                                </div>


                                <div class="col">

                                    <input
                                        type="text"
                                        name="result"
                                        value="{{ old(
                                            'result',
                                            $result?->result
                                        ) }}"
                                        class="form-control form-control-sm"
                                        placeholder="Result"
                                    >

                                </div>


                                <div class="col">

                                    <select
                                        name="status"
                                        class="form-select form-select-sm"
                                    >

                                        @foreach([
                                            'published',
                                            'pending',
                                            'corrected',
                                            'cancelled'
                                        ] as $status)

                                            <option
                                                value="{{ $status }}"
                                                @selected(
                                                    old(
                                                        'status',
                                                        $result?->status
                                                        ?? 'pending'
                                                    ) === $status
                                                )
                                            >
                                                {{ ucfirst($status) }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-auto">

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-primary"
                                    >
                                        {{ $result ? 'Update' : 'Save' }}
                                    </button>

                                </div>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="text-center py-5 text-muted"
                        >
                            No active games found.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection