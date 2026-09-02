@extends('layouts.admin')

@section('title', 'Cache')

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">

        <h1 class="h3 fw-bold mb-1">
            Cache
        </h1>

        <p class="text-muted mb-0">
            Manage application cache.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="border rounded-3 p-4 h-100">

                        <div class="small text-muted mb-1">
                            Cache Driver
                        </div>

                        <div class="h5 fw-bold mb-0">
                            {{ $driver }}
                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="border rounded-3 p-4 h-100">

                        <div class="small text-muted mb-2">
                            Cache Management
                        </div>

                        <p class="text-muted small">
                            Clear the application's cached values.
                            This does not delete database records.
                        </p>

                        @can('cache.clear')

                            <form
                                method="POST"
                                action="{{ route('admin.cache.clear') }}"
                                onsubmit="return confirm('Clear application cache?');"
                            >

                                @csrf

                                <button class="btn btn-danger">
                                    Clear Cache
                                </button>

                            </form>

                        @endcan

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
