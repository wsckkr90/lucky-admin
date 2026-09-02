@extends('layouts.admin')

@section('title', 'Add Result')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Add Manual Result
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.results.store') }}"
        >

            @csrf

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Game
                    </label>

                    <select
                        name="game_id"
                        class="form-select @error('game_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Select Game
                        </option>

                        @foreach($games as $game)

                            <option
                                value="{{ $game->id }}"
                                @selected(
                                    old('game_id') == $game->id
                                )
                            >
                                {{ $game->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('game_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

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
                            now()->format('Y-m-d')
                        ) }}"
                        class="form-control @error('result_date') is-invalid @enderror"
                        required
                    >

                    @error('result_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Open Panna
                    </label>

                    <input
                        type="text"
                        name="open_panna"
                        value="{{ old('open_panna') }}"
                        class="form-control"
                        placeholder="123"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Jodi
                    </label>

                    <input
                        type="text"
                        name="jodi"
                        value="{{ old('jodi') }}"
                        class="form-control"
                        placeholder="45"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Close Panna
                    </label>

                    <input
                        type="text"
                        name="close_panna"
                        value="{{ old('close_panna') }}"
                        class="form-control"
                        placeholder="678"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Result
                    </label>

                    <input
                        type="text"
                        name="result"
                        value="{{ old('result') }}"
                        class="form-control"
                        placeholder="45"
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

                        <option
                            value="published"
                            @selected(
                                old('status') === 'published'
                            )
                        >
                            Published
                        </option>

                        <option
                            value="pending"
                            @selected(
                                old('status') === 'pending'
                            )
                        >
                            Pending
                        </option>

                        <option
                            value="corrected"
                            @selected(
                                old('status') === 'corrected'
                            )
                        >
                            Corrected
                        </option>

                        <option
                            value="cancelled"
                            @selected(
                                old('status') === 'cancelled'
                            )
                        >
                            Cancelled
                        </option>

                    </select>

                </div>

            </div>


            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save Result
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