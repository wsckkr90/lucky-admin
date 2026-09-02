@extends('layouts.admin')

@section('title', 'Result Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Result Details
        </h2>

        <p class="text-muted mb-0">
            {{ $result->game?->name }}
        </p>
    </div>

    <div>

        <a
            href="{{ route(
                'admin.results.edit',
                $result
            ) }}"
            class="btn btn-primary"
        >
            Edit
        </a>

        <a
            href="{{ route('admin.results.index') }}"
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
                    {{ $result->game?->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    City
                </strong>

                <div class="mt-1">
                    {{ $result->game?->city?->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    Date
                </strong>

                <div class="mt-1">
                    {{ $result->result_date?->format('d-m-Y') }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Open Panna
                </strong>

                <div class="mt-1">
                    {{ $result->open_panna ?? '—' }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Jodi
                </strong>

                <div class="mt-1">
                    {{ $result->jodi ?? '—' }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Close Panna
                </strong>

                <div class="mt-1">
                    {{ $result->close_panna ?? '—' }}
                </div>

            </div>


            <div class="col-md-3">

                <strong>
                    Result
                </strong>

                <div class="mt-1 fs-5 fw-bold">
                    {{ $result->result ?? '—' }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    Source
                </strong>

                <div class="mt-1">
                    {{ ucfirst($result->source) }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    Status
                </strong>

                <div class="mt-1">
                    {{ ucfirst($result->status) }}
                </div>

            </div>


            <div class="col-md-4">

                <strong>
                    Updated By
                </strong>

                <div class="mt-1">
                    {{ $result->updater?->name ?? 'System' }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection