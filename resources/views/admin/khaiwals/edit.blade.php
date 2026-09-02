@extends('layouts.admin')

@section('title', 'Edit Khaiwal')

@section('content')

<div class="mb-4">

    <h2>
        Edit Khaiwal
    </h2>

    <p class="text-muted">
        {{ $khaiwal->name }}
    </p>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.khaiwals.update',
                $khaiwal
            ) }}"
        >

            @csrf
            @method('PUT')


            <div class="mb-3">

                <label class="form-label">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old(
                        'name',
                        $khaiwal->name
                    ) }}"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Legacy ID
                </label>

                <input
                    type="text"
                    name="legacy_id"
                    value="{{ old(
                        'legacy_id',
                        $khaiwal->legacy_id
                    ) }}"
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
                    value="{{ old(
                        'top_header',
                        $khaiwal->top_header
                    ) }}"
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
                >{{ old(
                    'cta_text',
                    $khaiwal->cta_text
                ) }}</textarea>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ old(
                            'whatsapp',
                            $khaiwal->whatsapp
                        ) }}"
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
                        value="{{ old(
                            'telegram',
                            $khaiwal->telegram
                        ) }}"
                        class="form-control"
                    >

                </div>

            </div>


            <div class="mb-4">

                <label class="form-label">
                    Schedule
                </label>


                @php
                    $schedule =
                        old(
                            'schedule',
                            $khaiwal->schedule ?? []
                        );

                    if (!is_array($schedule)) {
                        $schedule = [];
                    }

                    if (empty($schedule)) {
                        $schedule = [''];
                    }
                @endphp


                <div id="schedule-container">

                    @foreach(
                        $schedule as $index => $item
                    )

                        <div
                            class="input-group mb-2 schedule-row"
                        >

                            <input
                                type="text"
                                name="schedule[]"
                                value="{{ $item }}"
                                class="form-control"
                                placeholder="Schedule item"
                            >

                            <button
                                type="button"
                                class="btn btn-outline-danger"
                                onclick="removeScheduleRow(this)"
                            >
                                Remove
                            </button>

                        </div>

                    @endforeach

                </div>


                <button
                    type="button"
                    class="btn btn-sm btn-outline-primary"
                    onclick="addScheduleRow()"
                >
                    + Add Schedule
                </button>

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
                            $khaiwal->display_order
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
                            @checked(
                                old(
                                    'active',
                                    $khaiwal->active
                                )
                            )
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
                Update Khaiwal
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


<script>

function addScheduleRow() {

    const container =
        document.getElementById(
            'schedule-container'
        );

    const row =
        document.createElement('div');

    row.className =
        'input-group mb-2 schedule-row';

    row.innerHTML = `
        <input
            type="text"
            name="schedule[]"
            class="form-control"
            placeholder="Schedule item"
        >

        <button
            type="button"
            class="btn btn-outline-danger"
            onclick="removeScheduleRow(this)"
        >
            Remove
        </button>
    `;

    container.appendChild(row);
}

function removeScheduleRow(button) {

    const rows =
        document.querySelectorAll(
            '.schedule-row'
        );

    if (rows.length <= 1) {
        return;
    }

    button
        .closest('.schedule-row')
        .remove();
}

</script>

@endsection
