@extends('layouts.admin')

@section('title', 'Edit Game')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Edit Game
        </h5>

    </div>

    <div class="card-body">

        <form
    method="POST"
    action="{{ route('admin.games.update', $game) }}"
>
    @csrf
    @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Game Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $game->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Legacy Game Key
                    </label>

                    <input
                        type="text"
                        name="legacy_id"
                        value="{{ old('legacy_id', $game->legacy_id) }}"
                        class="form-control"
                        placeholder="e.g. disawer"
                    >

                    <div class="form-text">
                        Keep this equal to the old games.json key when importing existing games.
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        City
                    </label>

                    <select
                        name="city_id"
                        class="form-select"
                    >

                        <option value="">
                            Select City
                        </option>

                        @foreach($cities as $city)

                            <option
                                 value="{{ $city->id }}"
    @selected(
        old('city_id', $game->city_id) == $city->id
    )
                            >
                                {{ $city->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Slug
                    </label>

                    <input
                        type="text"
                        name="slug"
                        value="{{ old('slug', $game->slug) }}"
                        class="form-control"
                        placeholder="Leave empty to generate"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Open Time
                    </label>

                    <input
                        type="time"
                        name="open_time"
                        value="{{ old('open_time', $game->open_time) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Close Time
                    </label>

                    <input
                        type="time"
                        name="close_time"
                        value="{{ old('close_time', $game->close_time) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Chart URL
                    </label>

                    <input
                        type="text"
                        name="chart_url"
                        value="{{ old('chart_url', $game->chart_url) }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Display Order
                    </label>

                    <input
                        type="number"
                        name="display_order"
                        value="{{ old('display_order', $game->display_order) }}"
                        min="0"
                        class="form-control"
                    >

                </div>

            </div>


            <div class="form-check mb-4">

                <input
                    type="checkbox"
                    name="active"
                    value="@checked(
    old('active', $game->active)
)"
                    class="form-check-input"
                    id="active"
                    checked
                >
<div class="mb-3">

    <label class="form-label">
        Historical Chart URL
    </label>

    <input
        type="url"
        name="chart_url"
        value="{{ old(
            'chart_url',
            $game->chart_url ?? ''
        ) }}"
        class="form-control"
        placeholder="https://example.com/game-chart"
    >

    <div class="form-text">
        URL used by the historical chart scraper.
    </div>

</div>
                <label
                    class="form-check-label"
                    for="active"
                >
                    Active
                </label>

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Game
            </button>

            <a
                href="{{ route('admin.games.index') }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection
