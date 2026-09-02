@extends('layouts.admin')

@section('title', 'Edit Result')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Edit Result
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.results.update',
                $result
            ) }}"
        >

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Game
                    </label>

                    <select
                        name="game_id"
                        class="form-select"
                        required
                    >

                        @foreach($games as $game)

                            <option
                                value="{{ $game->id }}"
                                @selected(
                                    old(
                                        'game_id',
                                        $result->game_id
                                    ) == $game->id
                                )
                            >
                                {{ $game->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Result Date
                    </label>

                    <input
                        type="date"
                        name="result_date"
                        value="{{ old(
                            'result_date',
                            $result->result_date?->format('Y-m-d')
                        ) }}"
                        class="form-control"
                        required
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Open Panna
                    </label>

                    <input
                        type="text"
                        name="open_panna"
                        value="{{ old(
                            'open_panna',
                            $result->open_panna
                        ) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Jodi
                    </label>

                    <input
                        type="text"
                        name="jodi"
                        value="{{ old(
                            'jodi',
                            $result->jodi
                        ) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Close Panna
                    </label>

                    <input
                        type="text"
                        name="close_panna"
                        value="{{ old(
                            'close_panna',
                            $result->close_panna
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
                            $result->result
                        ) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
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
                                        $result->status
                                    ) === $status
                                )
                            >
                                {{ ucfirst($status) }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Result
                </button>

                <a
                    href="{{ route('admin.results.index') }}"
                    class="btn btn-light"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection