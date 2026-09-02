@extends('layouts.admin')

@section('title', 'Edit Chart Entry')

@section('content')

<div class="mb-4">

    <h2 class="mb-1">
        Edit Historical Chart
    </h2>

    <p class="text-muted mb-0">

        {{ $chartEntry->week?->game?->name }}

        —

        {{ $chartEntry->result_date?->format('d-m-Y') }}

    </p>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.charts.update',
                $chartEntry
            ) }}"
        >

            @csrf
            @method('PUT')


            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Open Panna
                    </label>

                    <input
                        type="text"
                        name="open_panna"
                        value="{{ old(
                            'open_panna',
                            $chartEntry->open_panna
                        ) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Jodi
                    </label>

                    <input
                        type="text"
                        name="jodi"
                        value="{{ old(
                            'jodi',
                            $chartEntry->jodi
                        ) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Close Panna
                    </label>

                    <input
                        type="text"
                        name="close_panna"
                        value="{{ old(
                            'close_panna',
                            $chartEntry->close_panna
                        ) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Result
                    </label>

                    <input
                        type="text"
                        name="result"
                        value="{{ old(
                            'result',
                            $chartEntry->result
                        ) }}"
                        class="form-control"
                    >

                </div>

            </div>


            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Chart
                </button>

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
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
