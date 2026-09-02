@extends('layouts.admin')

@section('title', 'Lucky Numbers')

@section('content')

<div class="container-fluid px-0">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Lucky Numbers
            </h1>

            <p class="text-muted mb-0">
                Manage Lucky Ank, Final Ank and automatic scraping settings.
            </p>
        </div>

        <div>
            <span class="badge rounded-pill
                {{ $autoScrapeLucky ? 'text-bg-success' : 'text-bg-secondary' }}">
                <span class="me-1">●</span>
                Auto Scrape {{ $autoScrapeLucky ? 'Enabled' : 'Disabled' }}
            </span>
        </div>

    </div>


    {{-- Main Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex align-items-center gap-2">
                <div
                    class="rounded-circle d-flex align-items-center justify-content-center bg-light"
                    style="width:42px;height:42px;"
                >
                    <span style="font-size:20px;">🍀</span>
                </div>

                <div>
                    <h5 class="mb-0 fw-bold">
                        Lucky Numbers Configuration
                    </h5>

                    <small class="text-muted">
                        Configure values used by the Lucky Numbers system.
                    </small>
                </div>
            </div>
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
                        When enabled, the scraper can automatically update
                        Lucky Ank and Final Ank values from the configured
                        target source.
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

                    <textarea
                        class="form-control @error('lucky_ank') is-invalid @enderror"
                        id="lucky_ank"
                        name="lucky_ank"
                        rows="4"
                        maxlength="1000"
                        placeholder="Example: 0-2-3-4"
                    >{{ old('lucky_ank', $luckyAnk) }}</textarea>

                    <div class="form-text">
                        Enter the Lucky Ank values exactly in the format
                        required by your frontend/scraper.
                    </div>

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

                    <textarea
                        class="form-control @error('final_ank') is-invalid @enderror"
                        id="final_ank"
                        name="final_ank"
                        rows="4"
                        maxlength="1000"
                        placeholder="Example: K-0, M-8"
                    >{{ old('final_ank', $finalAnk) }}</textarea>

                    <div class="form-text">
                        Enter the Final Ank / market codes used by the
                        existing Lucky Numbers system.
                    </div>

                    @error('final_ank')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Current Values Preview --}}
                <div class="bg-light rounded-3 p-3 mb-4">

                    <h6 class="fw-bold mb-3">
                        Current Configuration
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="bg-white border rounded-3 p-3 h-100">

                                <div class="small text-muted mb-1">
                                    Lucky Ank
                                </div>

                                <div class="fw-semibold text-break">
                                    {{ $luckyAnk !== '' ? $luckyAnk : 'Not configured' }}
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="bg-white border rounded-3 p-3 h-100">

                                <div class="small text-muted mb-1">
                                    Final Ank
                                </div>

                                <div class="fw-semibold text-break">
                                    {{ $finalAnk !== '' ? $finalAnk : 'Not configured' }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="d-flex flex-wrap justify-content-end gap-2">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="btn btn-light border"
                    >
                        Cancel
                    </a>

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

</div>

@endsection
