@extends('layouts.admin')

@section('title', 'SEO Content - ' . $game->name)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            SEO Content
        </h2>

        <div class="text-muted">
            {{ $game->name }}
        </div>

    </div>

    <div>

        <a
            href="{{ route('admin.seo.index') }}"
            class="btn btn-outline-secondary"
        >
            ← Back to SEO
        </a>

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger">

        <strong>
            Please fix the following:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- ========================================================= --}}
{{-- SEO CONTENT --}}
{{-- ========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5 class="mb-0">
                    Page Content
                </h5>

                <small class="text-muted">
                    Manage SEO-friendly content blocks.
                </small>

            </div>

        </div>

    </div>


    <div class="card-body">

        @forelse($game->seoContents as $content)

            <div class="border rounded p-3 mb-3">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div>

                        <h6 class="mb-1">
                            {{ $content->title ?: 'Untitled Content' }}
                        </h6>

                        <span class="badge
                            {{ $content->active
                                ? 'bg-success'
                                : 'bg-secondary' }}"
                        >
                            {{ $content->active
                                ? 'Active'
                                : 'Inactive' }}
                        </span>

                    </div>


                    <div class="d-flex gap-2">

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.seo.content.toggle',
                                $content
                            ) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                Toggle
                            </button>

                        </form>


                        <form
                            method="POST"
                            action="{{ route(
                                'admin.seo.content.destroy',
                                $content
                            ) }}"
                            onsubmit="return confirm(
                                'Delete this SEO content block?'
                            );"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-danger"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route(
                        'admin.seo.content.update',
                        $content
                    ) }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="row g-3">

                        <div class="col-md-8">

                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ $content->title }}"
                                class="form-control"
                                maxlength="255"
                            >

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ $content->sort_order }}"
                                min="0"
                                class="form-control"
                            >

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Content
                            </label>

                            <textarea
                                name="content"
                                rows="8"
                                class="form-control"
                                required
                            >{{ $content->content }}</textarea>

                        </div>


                        <div class="col-12">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    name="active"
                                    value="1"
                                    class="form-check-input"
                                    id="seo-content-active-{{ $content->id }}"
                                    @checked($content->active)
                                >

                                <label
                                    class="form-check-label"
                                    for="seo-content-active-{{ $content->id }}"
                                >
                                    Active
                                </label>

                            </div>

                        </div>


                        <div class="col-12">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Update Content
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        @empty

            <div class="text-center text-muted py-4">

                No SEO content blocks yet.

            </div>

        @endforelse

    </div>

</div>


{{-- ========================================================= --}}
{{-- ADD SEO CONTENT --}}
{{-- ========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Add Content Block
        </h5>

    </div>


    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.seo.content.store',
                $game
            ) }}"
        >

            @csrf


            <div class="row g-3">

                <div class="col-md-8">

                    <label class="form-label">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        class="form-control"
                        maxlength="255"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old(
                            'sort_order',
                            0
                        ) }}"
                        min="0"
                        class="form-control"
                    >

                </div>


                <div class="col-12">

                    <label class="form-label">
                        Content
                    </label>

                    <textarea
                        name="content"
                        rows="8"
                        class="form-control"
                        placeholder="Enter SEO content..."
                        required
                    >{{ old('content') }}</textarea>

                </div>


                <div class="col-12">

                    <div class="form-check">

                        <input
                            type="checkbox"
                            name="active"
                            value="1"
                            class="form-check-input"
                            id="new-content-active"
                            checked
                        >

                        <label
                            class="form-check-label"
                            for="new-content-active"
                        >
                            Active
                        </label>

                    </div>

                </div>


                <div class="col-12">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add Content
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- ========================================================= --}}
{{-- FAQS --}}
{{-- ========================================================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            FAQs
        </h5>

    </div>


    <div class="card-body">

        @forelse($game->faqs as $faq)

            <div class="border rounded p-3 mb-3">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div>

                        <div class="mb-1">

                            <span class="badge bg-info">
                                {{ $faq->scope }}
                            </span>

                            <span class="badge
                                {{ $faq->active
                                    ? 'bg-success'
                                    : 'bg-secondary' }}"
                            >
                                {{ $faq->active
                                    ? 'Active'
                                    : 'Inactive' }}
                            </span>

                        </div>

                        <h6 class="mb-0">
                            {{ $faq->question }}
                        </h6>

                    </div>


                    <div class="d-flex gap-2">

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.seo.faq.toggle',
                                $faq
                            ) }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                Toggle
                            </button>

                        </form>


                        <form
                            method="POST"
                            action="{{ route(
                                'admin.seo.faq.destroy',
                                $faq
                            ) }}"
                            onsubmit="return confirm(
                                'Delete this FAQ?'
                            );"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-danger"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route(
                        'admin.seo.faq.update',
                        $faq
                    ) }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="row g-3">

                        <div class="col-md-3">

                            <label class="form-label">
                                Scope
                            </label>

                            <input
                                type="text"
                                name="scope"
                                value="{{ $faq->scope }}"
                                class="form-control"
                                maxlength="100"
                                required
                            >

                        </div>


                        <div class="col-md-7">

                            <label class="form-label">
                                Question
                            </label>

                            <input
                                type="text"
                                name="question"
                                value="{{ $faq->question }}"
                                class="form-control"
                                maxlength="1000"
                                required
                            >

                        </div>


                        <div class="col-md-2">

                            <label class="form-label">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ $faq->sort_order }}"
                                min="0"
                                class="form-control"
                            >

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Answer
                            </label>

                            <textarea
                                name="answer"
                                rows="6"
                                class="form-control"
                                required
                            >{{ $faq->answer }}</textarea>

                        </div>


                        <div class="col-12">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    name="active"
                                    value="1"
                                    class="form-check-input"
                                    id="faq-active-{{ $faq->id }}"
                                    @checked($faq->active)
                                >

                                <label
                                    class="form-check-label"
                                    for="faq-active-{{ $faq->id }}"
                                >
                                    Active
                                </label>

                            </div>

                        </div>


                        <div class="col-12">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Update FAQ
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        @empty

            <div class="text-center text-muted py-4">

                No FAQs added yet.

            </div>

        @endforelse

    </div>

</div>


{{-- ========================================================= --}}
{{-- ADD FAQ --}}
{{-- ========================================================= --}}

<div class="card border-0 shadow-sm mb-5">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Add FAQ
        </h5>

    </div>


    <div class="card-body">

        <form
            method="POST"
            action="{{ route(
                'admin.seo.faq.store',
                $game
            ) }}"
        >

            @csrf


            <div class="row g-3">

                <div class="col-md-3">

                    <label class="form-label">
                        Scope
                    </label>

                    <select
                        name="scope"
                        class="form-select"
                        required
                    >

                        <option
                            value="game"
                            @selected(
                                old(
                                    'scope',
                                    'game'
                                ) === 'game'
                            )
                        >
                            Game
                        </option>

                        <option
                            value="global"
                            @selected(
                                old('scope') === 'global'
                            )
                        >
                            Global
                        </option>

                    </select>

                </div>


                <div class="col-md-7">

                    <label class="form-label">
                        Question
                    </label>

                    <input
                        type="text"
                        name="question"
                        value="{{ old('question') }}"
                        class="form-control"
                        maxlength="1000"
                        required
                    >

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old(
                            'sort_order',
                            0
                        ) }}"
                        min="0"
                        class="form-control"
                    >

                </div>


                <div class="col-12">

                    <label class="form-label">
                        Answer
                    </label>

                    <textarea
                        name="answer"
                        rows="6"
                        class="form-control"
                        required
                    >{{ old('answer') }}</textarea>

                </div>


                <div class="col-12">

                    <div class="form-check">

                        <input
                            type="checkbox"
                            name="active"
                            value="1"
                            class="form-check-input"
                            id="new-faq-active"
                            checked
                        >

                        <label
                            class="form-check-label"
                            for="new-faq-active"
                        >
                            Active
                        </label>

                    </div>

                </div>


                <div class="col-12">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Add FAQ
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection
