@extends('layouts.admin')

@section('title', 'Scheduler')

@section('content')

<div class="container-fluid px-0">

    <div class="mb-4">

        <h1 class="h3 fw-bold mb-1">
            Scheduler
        </h1>

        <p class="text-muted mb-0">
            Monitor and manually trigger Laravel scheduled tasks.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="small text-muted mb-1">
                        Application Timezone
                    </div>

                    <div class="h5 fw-bold">
                        {{ $timezone }}
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <h5 class="fw-bold">
                        Scheduler
                    </h5>

                    <p class="text-muted">
                        Run the scheduler once manually. This executes
                        tasks that are due at the current time.
                    </p>

                    @can('scheduler.run')

                        <form
                            method="POST"
                            action="{{ route('admin.scheduler.run') }}"
                            onsubmit="return confirm('Run the scheduler now?');"
                        >

                            @csrf

                            <button class="btn btn-primary">
                                Run Scheduler
                            </button>

                        </form>

                    @endcan

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
