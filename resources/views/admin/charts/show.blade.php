@extends('layouts.admin')

@section('title', 'Chart Entry')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            Historical Chart Entry
        </h2>

        <p class="text-muted mb-0">
            {{ $chartEntry->week?->game?->name }}
        </p>

    </div>

    <div>

        <a
            href="{{ route(
                'admin.charts.edit',
                $chartEntry
            ) }}"
            class="btn btn-primary"
        >
            Edit
        </a>

        <a
            href="{{ route(
                'admin.charts.index',
                [
                    'game_id' =>
                        $chartEntry->week?->game_id,

                    'year' =>
                        $chartEntry->result_date?->year,
                ]
            ) }}"
            class="btn btn-light"
        >
            Back
        </a>

    </div>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-4">

                <strong>
                    Game
                </strong>

                <div class="mt-1">
                    {{ $chartEntry->week?->game?->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    Date
                </strong>

                <div class="mt-1">
                    {{ $chartEntry->result_date?->format('d-m-Y') }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    Day
                </strong>

                <div class="mt-1">
                    {{ $chartEntry->result_date?->format('l') }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Open Panna
                </strong>

                <div class="mt-1">
                    {{ $chartEntry->open_panna ?? '—' }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Jodi
                </strong>

                <div class="mt-1">
                    {{ $chartEntry->jodi ?? '—' }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Close Panna
                </strong>

                <div class="mt-1">
                    {{ $chartEntry->close_panna ?? '—' }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Result
                </strong>

                <div class="mt-1 fs-5 fw-bold">
                    {{ $chartEntry->result ?? '—' }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
