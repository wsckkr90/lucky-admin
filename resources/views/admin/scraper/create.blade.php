@extends('layouts.admin')

@section('title', 'Add Scraper Source')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Add Scraper Source
        </h5>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.scraper.store') }}"
        >

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control"
                    placeholder="Result Source"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    URL
                </label>

                <input
                    type="url"
                    name="url"
                    value="{{ old('url') }}"
                    class="form-control"
                    placeholder="https://example.com/api/results"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    HTTP Method
                </label>

                <select
                    name="method"
                    class="form-select"
                >

                    <option value="GET">
                        GET
                    </option>

                    <option value="POST">
                        POST
                    </option>

                </select>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Headers JSON
                </label>

                <textarea
                    name="headers"
                    rows="5"
                    class="form-control font-monospace"
                    placeholder='{"Accept":"application/json"}'
                >{{ old('headers') }}</textarea>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Parser Configuration JSON
                </label>

                <textarea
                    name="config"
                    rows="8"
                    class="form-control font-monospace"
                    placeholder='{"game_field":"game","result_field":"result"}'
                >{{ old('config') }}</textarea>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Priority
                </label>

                <input
                    type="number"
                    name="priority"
                    value="{{ old('priority', 0) }}"
                    min="0"
                    class="form-control"
                >

            </div>


            <div class="form-check mb-4">

                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    class="form-check-input"
                    id="active"
                    checked
                >

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
                Save Source
            </button>

            <a
                href="{{ route('admin.scraper.index') }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection
