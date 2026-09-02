@extends('layouts.admin')

@section('title', 'Activity Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            Activity Details
        </h2>

        <p class="text-muted mb-0">
            {{ $activityLog->action }}
        </p>

    </div>

    <a
        href="{{ route('admin.activity-logs.index') }}"
        class="btn btn-light"
    >
        Back
    </a>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-4">

                <strong>User</strong>

                <div class="mt-1">
                    {{ $activityLog->user?->name ?? 'System' }}
                </div>

            </div>

            <div class="col-md-4">

                <strong>Action</strong>

                <div class="mt-1">
                    {{ $activityLog->action }}
                </div>

            </div>

            <div class="col-md-4">

                <strong>Module</strong>

                <div class="mt-1">
                    {{ $activityLog->module ?? '—' }}
                </div>

            </div>

            <div class="col-md-4">

                <strong>IP Address</strong>

                <div class="mt-1">
                    {{ $activityLog->ip_address ?? '—' }}
                </div>

            </div>

            <div class="col-md-4">

                <strong>Date</strong>

                <div class="mt-1">
                    {{ $activityLog->created_at }}
                </div>

            </div>

            <div class="col-md-4">

                <strong>Record ID</strong>

                <div class="mt-1">
                    {{ $activityLog->record_id ?? '—' }}
                </div>

            </div>

        </div>


        <hr class="my-4">


        <div class="row g-4">

            <div class="col-md-6">

                <h5>
                    Previous Values
                </h5>

                <pre class="bg-light rounded p-3">{{ json_encode(
    $activityLog->old_values,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
) }}</pre>

            </div>


            <div class="col-md-6">

                <h5>
                    New Values
                </h5>

                <pre class="bg-light rounded p-3">{{ json_encode(
    $activityLog->new_values,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
) }}</pre>

            </div>

        </div>

    </div>

</div>

@endsection