@extends('layouts.admin')

@section('title', 'Historical Charts')

@section('content')

<div class="mb-4">

    <h2 class="mb-1">
        Historical Charts
    </h2>

    <p class="text-muted mb-0">
        Browse and manage historical weekly chart data.
    </p>

</div>


<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.charts.index') }}"
        >

            <div class="row g-3">

                {{-- Game --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Game
                    </label>

                    <select
                        name="game_id"
                        class="form-select"
                        onchange="this.form.submit()"
                    >

                        <option value="">
                            Select Game
                        </option>

                        @foreach($games as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected(
                                    $game?->id == $item->id
                                )
                            >
                                {{ $item->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Year --}}
                <div class="col-md-3">

                    <label class="form-label">
                        Year
                    </label>

                    <select
                        name="year"
                        class="form-select"
                        @disabled(!$game)
                        onchange="this.form.submit()"
                    >

                        <option value="">
                            Select Year
                        </option>

                        @foreach($years as $year)

                            <option
                                value="{{ $year }}"
                                @selected(
                                    request('year') == $year
                                )
                            >
                                {{ $year }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Month --}}
                <div class="col-md-3">

                    <label class="form-label">
                        Month
                    </label>

                    <select
                        name="month"
                        class="form-select"
                        @disabled($years->isEmpty())
                        onchange="this.form.submit()"
                    >

                        <option value="">
                            All Months
                        </option>

                        @foreach($months as $month)

                            <option
                                value="{{ $month }}"
                                @selected(
                                    request('month') == $month
                                )
                            >
                                {{ \Carbon\Carbon::create(
                                    null,
                                    $month,
                                    1
                                )->format('F') }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <a
                        href="{{ route(
                            'admin.charts.index'
                        ) }}"
                        class="btn btn-light w-100"
                    >
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>


@if($game && $weeks->isNotEmpty())

    <div class="mb-4">

        <h4>
            {{ $game->name }}
        </h4>

        <p class="text-muted">
            @if(request('year'))
                {{ request('year') }}
            @endif

            @if(request('month'))
                —
                {{ \Carbon\Carbon::create(
                    null,
                    request('month'),
                    1
                )->format('F') }}
            @endif
        </p>

    </div>


    @foreach($weeks as $week)

        @php

            $entriesByDate = $week->entries
                ->keyBy(function ($entry) {
                    return $entry->result_date
                        ->format('Y-m-d');
                });

        @endphp


        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="mb-1">
                            Week:
                            {{ $week->week_start?->format('d/m/Y') }}
                            →
                            {{ $week->week_end?->format('d/m/Y') }}
                        </h5>

                        <small class="text-muted">
                            {{ $week->entries->count() }}
                            day entries
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route(
                        'admin.charts.week.update'
                    ) }}"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="week_id"
                        value="{{ $week->id }}"
                    >


                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead class="table-light">

                                <tr>

                                    <th>
                                        Day
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                    <th>
                                        Open
                                    </th>

                                    <th>
                                        Jodi
                                    </th>

                                    <th>
                                        Close
                                    </th>

                                    <th>
                                        Result
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                            @foreach($week->entries as $entry)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $entry->result_date->format('D') }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $entry->result_date->format('d-m-Y') }}
                                    </td>


                                    <td>

                                        <input
                                            type="hidden"
                                            name="entries[{{ $loop->index }}][id]"
                                            value="{{ $entry->id }}"
                                        >

                                        <input
                                            type="text"
                                            name="entries[{{ $loop->index }}][open_panna]"
                                            value="{{ old(
                                                "entries.{$loop->index}.open_panna",
                                                $entry->open_panna
                                            ) }}"
                                            class="form-control form-control-sm"
                                        >

                                    </td>


                                    <td>

                                        <input
                                            type="text"
                                            name="entries[{{ $loop->index }}][jodi]"
                                            value="{{ old(
                                                "entries.{$loop->index}.jodi",
                                                $entry->jodi
                                            ) }}"
                                            class="form-control form-control-sm"
                                        >

                                    </td>


                                    <td>

                                        <input
                                            type="text"
                                            name="entries[{{ $loop->index }}][close_panna]"
                                            value="{{ old(
                                                "entries.{$loop->index }.close_panna",
                                                $entry->close_panna
                                            ) }}"
                                            class="form-control form-control-sm"
                                        >

                                    </td>


                                    <td>

                                        <input
                                            type="text"
                                            name="entries[{{ $loop->index }}][result]"
                                            value="{{ old(
                                                "entries.{$loop->index}.result",
                                                $entry->result
                                            ) }}"
                                            class="form-control form-control-sm"
                                        >

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>


                    <div class="mt-3">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Save Week
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endforeach

@elseif($game && request('year'))

    <div class="card border-0 shadow-sm">

        <div class="card-body text-center py-5">

            <h5>
                No historical chart data found.
            </h5>

            <p class="text-muted mb-0">
                There are no imported chart weeks for this selection.
            </p>

        </div>

    </div>

@else

    <div class="card border-0 shadow-sm">

        <div class="card-body text-center py-5">

            <h5>
                Select a game and year
            </h5>

            <p class="text-muted mb-0">
                Choose a game and year to browse historical charts.
            </p>

        </div>

    </div>

@endif

@endsection
