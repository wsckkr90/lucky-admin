@extends('layouts.admin')

@section('title', $game->name)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            {{ $game->name }}
        </h2>

        <p class="text-muted mb-0">
            Game details
        </p>
    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('admin.games.edit', $game) }}"
            class="btn btn-primary"
        >
            Edit Game
        </a>

        <a
            href="{{ route('admin.games.index') }}"
            class="btn btn-light"
        >
            Back
        </a>

    </div>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">

                <strong>Name</strong>

                <div class="mt-1">
                    {{ $game->name }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>Legacy Key</strong>

                <div class="mt-1">
                    {{ $game->legacy_id ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>City</strong>

                <div class="mt-1">
                    {{ $game->city?->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>Slug</strong>

                <div class="mt-1">
                    {{ $game->slug }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>Open Time</strong>

                <div class="mt-1">
                    {{ $game->open_time ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>Close Time</strong>

                <div class="mt-1">
                    {{ $game->close_time ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <strong>Chart URL</strong>

                <div class="mt-1">

                    @if($game->chart_url)

                        {{ $game->chart_url }}

                    @else

                        —

                    @endif

                </div>

            </div>


            <div class="col-md-6">

                <strong>Status</strong>

                <div class="mt-1">

                    @if($game->active)

                        <span class="badge bg-success">
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Inactive
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection