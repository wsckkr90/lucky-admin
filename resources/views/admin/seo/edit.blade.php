@extends('layouts.admin')

@section('title', 'SEO Settings')

@section('content')

@php
    $metaTitle = old('meta_title', $seo->meta_title ?? '');
    $metaDescription = old('meta_description', $seo->meta_description ?? '');
    $focusKeyword = old('focus_keyword', $seo->focus_keyword ?? '');
    $secondaryKeywords = old('secondary_keywords', $seo->secondary_keywords ?? '');
    $canonicalUrl = old('canonical_url', $seo->canonical_url ?? '');
    $robots = old('robots', $seo->robots ?? 'index,follow');

    $ogTitle = old('og_title', $seo->og_title ?? '');
    $ogDescription = old('og_description', $seo->og_description ?? '');
    $ogImage = old('og_image', $seo->og_image ?? '');

    $twitterTitle = old('twitter_title', $seo->twitter_title ?? '');
    $twitterDescription = old('twitter_description', $seo->twitter_description ?? '');
    $twitterImage = old('twitter_image', $seo->twitter_image ?? '');

    $schemaType = old('schema_type', $seo->schema_type ?? 'WebPage');

    $schemaValue = old('schema_json', $seo->schema_json ?? '');

    if (is_array($schemaValue)) {
        $schemaValue = json_encode(
            $schemaValue,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE
        );
    }
@endphp

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                SEO Settings
            </h2>

            <p class="text-muted mb-0">
                {{ $game->name }}
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.seo.index') }}"
                class="btn btn-outline-secondary"
            >
                Back
            </a>

            <a
                href="{{ route('admin.seo.content.index', $game) }}"
                class="btn btn-outline-primary"
            >
                Content & FAQs
            </a>

        </div>

    </div>


    <form
        method="POST"
        action="{{ route(
            'admin.seo.update',
            [
                'type' => 'game',
                'id' => $game->id
            ]
        ) }}"
    >

        @csrf
        @method('PUT')


        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Basic SEO
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-4">

                    <label
                        for="meta_title"
                        class="form-label fw-semibold"
                    >
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        id="meta_title"
                        class="form-control"
                        maxlength="255"
                        value="{{ $metaTitle }}"
                    >

                </div>


                <div class="mb-4">

                    <label
                        for="meta_description"
                        class="form-label fw-semibold"
                    >
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        id="meta_description"
                        class="form-control"
                        rows="5"
                        maxlength="1000"
                    >{{ $metaDescription }}</textarea>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label
                            for="focus_keyword"
                            class="form-label fw-semibold"
                        >
                            Focus Keyword
                        </label>

                        <input
                            type="text"
                            name="focus_keyword"
                            id="focus_keyword"
                            class="form-control"
                            maxlength="255"
                            value="{{ $focusKeyword }}"
                        >

                    </div>


                    <div class="col-md-6 mb-4">

                        <label
                            for="secondary_keywords"
                            class="form-label fw-semibold"
                        >
                            Secondary Keywords
                        </label>

                        <input
                            type="text"
                            name="secondary_keywords"
                            id="secondary_keywords"
                            class="form-control"
                            maxlength="2000"
                            value="{{ $secondaryKeywords }}"
                        >

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-8 mb-3">

                        <label
                            for="canonical_url"
                            class="form-label fw-semibold"
                        >
                            Canonical URL
                        </label>

                        <input
                            type="url"
                            name="canonical_url"
                            id="canonical_url"
                            class="form-control"
                            maxlength="2048"
                            value="{{ $canonicalUrl }}"
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label
                            for="robots"
                            class="form-label fw-semibold"
                        >
                            Robots
                        </label>

                        <select
                            name="robots"
                            id="robots"
                            class="form-select"
                        >

                            <option
                                value="index,follow"
                                {{ $robots === 'index,follow' ? 'selected' : '' }}
                            >
                                index,follow
                            </option>

                            <option
                                value="index,nofollow"
                                {{ $robots === 'index,nofollow' ? 'selected' : '' }}
                            >
                                index,nofollow
                            </option>

                            <option
                                value="noindex,follow"
                                {{ $robots === 'noindex,follow' ? 'selected' : '' }}
                            >
                                noindex,follow
                            </option>

                            <option
                                value="noindex,nofollow"
                                {{ $robots === 'noindex,nofollow' ? 'selected' : '' }}
                            >
                                noindex,nofollow
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>


        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Open Graph
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label
                        for="og_title"
                        class="form-label fw-semibold"
                    >
                        OG Title
                    </label>

                    <input
                        type="text"
                        name="og_title"
                        id="og_title"
                        class="form-control"
                        maxlength="255"
                        value="{{ $ogTitle }}"
                    >

                </div>


                <div class="mb-3">

                    <label
                        for="og_description"
                        class="form-label fw-semibold"
                    >
                        OG Description
                    </label>

                    <textarea
                        name="og_description"
                        id="og_description"
                        class="form-control"
                        rows="5"
                        maxlength="1000"
                    >{{ $ogDescription }}</textarea>

                </div>


                <div>

                    <label
                        for="og_image"
                        class="form-label fw-semibold"
                    >
                        OG Image URL
                    </label>

                    <input
                        type="url"
                        name="og_image"
                        id="og_image"
                        class="form-control"
                        maxlength="2048"
                        value="{{ $ogImage }}"
                    >

                </div>

            </div>

        </div>


        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Twitter Card
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label
                        for="twitter_title"
                        class="form-label fw-semibold"
                    >
                        Twitter Title
                    </label>

                    <input
                        type="text"
                        name="twitter_title"
                        id="twitter_title"
                        class="form-control"
                        maxlength="255"
                        value="{{ $twitterTitle }}"
                    >

                </div>


                <div class="mb-3">

                    <label
                        for="twitter_description"
                        class="form-label fw-semibold"
                    >
                        Twitter Description
                    </label>

                    <textarea
                        name="twitter_description"
                        id="twitter_description"
                        class="form-control"
                        rows="5"
                        maxlength="1000"
                    >{{ $twitterDescription }}</textarea>

                </div>


                <div>

                    <label
                        for="twitter_image"
                        class="form-label fw-semibold"
                    >
                        Twitter Image URL
                    </label>

                    <input
                        type="url"
                        name="twitter_image"
                        id="twitter_image"
                        class="form-control"
                        maxlength="2048"
                        value="{{ $twitterImage }}"
                    >

                </div>

            </div>

        </div>


        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">
                    Structured Data
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label
                        for="schema_type"
                        class="form-label fw-semibold"
                    >
                        Schema Type
                    </label>

                    <select
                        name="schema_type"
                        id="schema_type"
                        class="form-select"
                    >

                        <option
                            value="WebPage"
                            {{ $schemaType === 'WebPage' ? 'selected' : '' }}
                        >
                            WebPage
                        </option>

                        <option
                            value="Article"
                            {{ $schemaType === 'Article' ? 'selected' : '' }}
                        >
                            Article
                        </option>

                        <option
                            value="FAQPage"
                            {{ $schemaType === 'FAQPage' ? 'selected' : '' }}
                        >
                            FAQPage
                        </option>

                        <option
                            value="CollectionPage"
                            {{ $schemaType === 'CollectionPage' ? 'selected' : '' }}
                        >
                            CollectionPage
                        </option>

                        <option
                            value="ItemList"
                            {{ $schemaType === 'ItemList' ? 'selected' : '' }}
                        >
                            ItemList
                        </option>

                    </select>

                </div>


                <div>

                    <label
                        for="schema_json"
                        class="form-label fw-semibold"
                    >
                        Schema JSON
                    </label>

                    <textarea
                        name="schema_json"
                        id="schema_json"
                        class="form-control font-monospace"
                        rows="16"
                        spellcheck="false"
                    >{{ $schemaValue }}</textarea>

                </div>

            </div>

        </div>


        <div class="text-end mb-5">

            <button
                type="submit"
                class="btn btn-primary px-4"
            >
                Save SEO Settings
            </button>

        </div>

    </form>

</div>

@endsection
