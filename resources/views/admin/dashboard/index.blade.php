@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Overview of your website administration.
        </p>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-6 col-xl-3">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="text-muted mb-2">
                    Staff Users
                </div>

                <div class="fs-2 fw-bold">
                    {{ $stats['users'] }}
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="text-muted mb-2">
                    Active Cities
                </div>

                <div class="fs-2 fw-bold">
                    {{ $stats['cities'] }}
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="text-muted mb-2">
                    Active Games
                </div>

                <div class="fs-2 fw-bold">
                    {{ $stats['games'] }}
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card stat-card h-100">

            <div class="card-body">

                <div class="text-muted mb-2">
                    Today's Results
                </div>

                <div class="fs-2 fw-bold">
                    {{ $stats['today_results'] }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection