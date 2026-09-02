@extends('layouts.admin')

@section('title', 'Add Khaiwal')

@section('content')

<div class="mb-4">

    <h2>
        Add Khaiwal
    </h2>

    <p class="text-muted">
        Create a new khaiwal configuration.
    </p>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.khaiwals.store') }}"
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
                    required
                >

                @error('name')
                    <div class="text-danger small">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Legacy ID
                </label>

                <input
                    type="text"
                    name="legacy_id"
                    value="{{ old('legacy_id') }}"
                    class="form-control"
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Top Header
                </label>

                <input
                    type="text"
                    name="top_header"
                    value="{{ old('top_header') }}"
                    class="form-control"
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    CTA Text
                </label>

                <textarea
                    name="cta_text"
                    class="form-control"
                    rows="3"
                >{{ old('cta_text') }}</textarea>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ old('whatsapp') }}"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Telegram
                    </label>

                    <input
                        type="url"
                        name="telegram"
                        value="{{ old('telegram') }}"
                        class="form-control"
                    >

                </div>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Schedule
                </label>

                <textarea
                    name="schedule[]"
                    class="form-control"
                    rows="6"
                    placeholder="Enter one schedule item per line"
                >{{ old(
                    'schedule.0'
                ) }}</textarea>

                <div class="form-text">
                    You can add schedule items after creation.
                </div>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Display Order
                    </label>

                    <input
                        type="number"
                        name="display_order"
                        value="{{ old(
                            'display_order',
                            0
                        ) }}"
                        min="0"
                        class="form-control"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label d-block">
                        Status
                    </label>

                    <div class="form-check">

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

                </div>

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Khaiwal
            </button>

            <a
                href="{{ route(
                    'admin.khaiwals.index'
                ) }}"
                class="btn btn-light"
            >
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection
