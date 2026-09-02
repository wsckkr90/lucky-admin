@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')

<div class="mb-4">
    <h2 class="mb-1">Edit FAQ</h2>
    <p class="text-muted mb-0">
        Update the selected FAQ.
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <form
            method="POST"
            action="{{ route('admin.faqs.update', $faq) }}"
        >

            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-4">

                    <label class="form-label">
                        Scope
                    </label>

                    <select
                        name="scope"
                        id="scope"
                        class="form-select"
                        onchange="toggleGameField()"
                        required
                    >

                        <option
                            value="global"
                            @selected($faq->scope === 'global')
                        >
                            Global
                        </option>

                        <option
                            value="game"
                            @selected($faq->scope === 'game')
                        >
                            Game
                        </option>

                    </select>

                </div>

                <div
                    class="col-md-8"
                    id="gameField"
                >

                    <label class="form-label">
                        Game
                    </label>

                    <select
                        name="game_id"
                        class="form-select"
                    >

                        <option value="">
                            Select Game
                        </option>

                        @foreach($games as $game)

                            <option
                                value="{{ $game->id }}"
                                @selected($faq->game_id == $game->id)
                            >
                                {{ $game->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-12">

                    <label class="form-label">
                        Question
                    </label>

                    <input
                        type="text"
                        name="question"
                        value="{{ old('question', $faq->question) }}"
                        class="form-control"
                        required
                    >

                </div>

                <div class="col-12">

                    <label class="form-label">
                        Answer
                    </label>

                    <textarea
                        name="answer"
                        class="form-control"
                        rows="8"
                        required
                    >{{ old('answer', $faq->answer) }}</textarea>

                </div>

                <div class="col-md-4">

                    <label class="form-label">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $faq->sort_order) }}"
                        class="form-control"
                        min="0"
                    >

                </div>

                <div class="col-md-4">

                    <label class="form-label d-block">
                        Status
                    </label>

                    <div class="form-check form-switch">

                        <input
                            type="hidden"
                            name="active"
                            value="0"
                        >

                        <input
                            type="checkbox"
                            name="active"
                            value="1"
                            class="form-check-input"
                            @checked($faq->active)
                        >

                        <label class="form-check-label">
                            Active
                        </label>

                    </div>

                </div>

            </div>

            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update FAQ
                </button>

                <a
                    href="{{ route('admin.faqs.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

<script>
function toggleGameField() {

    const scope = document.getElementById('scope');
    const gameField = document.getElementById('gameField');

    if (scope.value === 'game') {
        gameField.style.display = 'block';
    } else {
        gameField.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    toggleGameField();
});
</script>

@endsection
