@extends('layouts.admin')

@section('title', 'Lucky Numbers')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Lucky Numbers
            </h1>

            <p class="text-muted mb-0">
                Manage and automatically scrape today's Lucky Ank and Final Ank.
            </p>
        </div>

        <div>
            @if($autoScrapeLucky)
                <span class="badge rounded-pill text-bg-success">
                    ● Auto Scrape Enabled
                </span>
            @else
                <span class="badge rounded-pill text-bg-secondary">
                    ● Auto Scrape Disabled
                </span>
            @endif
        </div>

    </div>


    {{-- Status --}}
    @if($lastStatus)

        <div class="alert
            {{ $lastStatus === 'success'
                ? 'alert-success'
                : 'alert-danger' }}
            border-0 shadow-sm"
        >

            <div class="fw-semibold mb-1">
                Last Scraper Status:
                {{ ucfirst($lastStatus) }}
            </div>

            @if($lastRun)
                <div class="small mb-1">
                    Last Run:
                    {{ $lastRun }}
                </div>
            @endif

            @if($lastMessage)
                <div class="small">
                    {{ $lastMessage }}
                </div>
            @endif

        </div>

    @endif


    {{-- Configuration --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-bottom py-3">

            <h5 class="mb-1 fw-bold">
                🍀 Lucky Numbers Configuration
            </h5>

            <small class="text-muted">
                Configure automatic scraping and manual fallback values.
            </small>

        </div>


        <div class="card-body p-4">

            <form
                method="POST"
                action="{{ route('admin.lucky-numbers.update') }}"
            >

                @csrf
                @method('PUT')


                {{-- Auto Scrape --}}
                <div class="border rounded-3 p-3 mb-4">

                    <div class="form-check form-switch">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="auto_scrape_lucky"
                            name="auto_scrape_lucky"
                            value="1"
                            {{ $autoScrapeLucky ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label fw-semibold"
                            for="auto_scrape_lucky"
                        >
                            Auto-Scrape Lucky Numbers
                        </label>

                    </div>

                    <div class="small text-muted mt-2">
                        When enabled, the scheduled scraper automatically
                        fetches Lucky Ank and Final Ank from the configured
                        target website.
                    </div>

                </div>


                {{-- Target --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Scraper Target
                    </label>

                    <div class="form-control bg-light text-muted">
                        {{ $targetUrl ?: 'No scraper target configured' }}
                    </div>

                    <div class="form-text">
                        This uses the existing
                        <code>scraper.target_url</code>
                        setting.
                    </div>

                </div>


                {{-- Lucky Ank --}}
                <div class="mb-4">

                    <label
                        for="lucky_ank"
                        class="form-label fw-semibold"
                    >
                        Lucky Ank
                    </label>

                    <input
                        type="text"
                        class="form-control @error('lucky_ank') is-invalid @enderror"
                        id="lucky_ank"
                        name="lucky_ank"
                        value="{{ old('lucky_ank', $luckyAnk) }}"
                        maxlength="1000"
                        placeholder="e.g. ( 0-2-3-4 )"
                    >

                    @error('lucky_ank')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Final Ank --}}
                <div class="mb-4">

                    <label
                        for="final_ank"
                        class="form-label fw-semibold"
                    >
                        Final Ank
                    </label>

                    <input
                        type="text"
                        class="form-control @error('final_ank') is-invalid @enderror"
                        id="final_ank"
                        name="final_ank"
                        value="{{ old('final_ank', $finalAnk) }}"
                        maxlength="1000"
                        placeholder="e.g. K-0, M-8"
                    >

                    @error('final_ank')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="d-flex justify-content-end">

                    @can('lucky-numbers.update')

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Save Changes
                        </button>

                    @endcan

                </div>

            </form>

        </div>

    </div>


    {{-- Manual Scrape --}}
    @can('lucky-numbers.update')

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            🔄 Scrape Now
                        </h5>

                        <p class="text-muted mb-0">
                            Immediately fetch the latest Lucky Ank and Final Ank.
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('admin.lucky-numbers.scrape') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-primary"
                            {{ !$autoScrapeLucky ? 'disabled' : '' }}
                        >
                            Run Scraper
                        </button>

                    </form>

                </div>

            </div>

        </div>

    @endcan

</div>

@endsection
