@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('content')

<div class="mb-4">

    <h2 class="mb-1">
        Activity Logs
    </h2>

    <p class="text-muted mb-0">
        Track changes made inside the administration panel.
    </p>

</div>


<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form
            method="GET"
            action="{{ route('admin.activity-logs.index') }}"
        >

            <div class="row g-3">

                <div class="col-md-4">

                    <label class="form-label">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Action or IP address"
                    >

                </div>

                <div class="col-md-3">

                    <label class="form-label">
                        Module
                    </label>

                    <select
                        name="module"
                        class="form-select"
                    >

                        <option value="">
                            All Modules
                        </option>

                        <option
                            value="results"
                            @selected(
                                request('module') === 'results'
                            )
                        >
                            Results
                        </option>

                        <option
                            value="games"
                            @selected(
                                request('module') === 'games'
                            )
                        >
                            Games
                        </option>

                        <option
                            value="users"
                            @selected(
                                request('module') === 'users'
                            )
                        >
                            Users
                        </option>

                        <option
                            value="seo"
                            @selected(
                                request('module') === 'seo'
                            )
                        >
                            SEO
                        </option>

                    </select>

                </div>

                <div class="col-md-3">

                    <label class="form-label">
                        Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="form-control"
                    >

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button
                        class="btn btn-primary w-100"
                        type="submit"
                    >
                        Filter
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<div class="card border-0 shadow-sm">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th>Date</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>IP</th>
                    <th></th>

                </tr>

            </thead>

            <tbody>

            @forelse($logs as $log)

                <tr>

                    <td>
                        {{ $log->created_at?->format(
                            'd-m-Y H:i:s'
                        ) }}
                    </td>

                    <td>
                        {{ $log->user?->name ?? 'System' }}
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            {{ $log->action }}
                        </span>
                    </td>

                    <td>
                        {{ $log->module ?? '—' }}
                    </td>

                    <td>
                        {{ $log->ip_address ?? '—' }}
                    </td>

                    <td class="text-end">

                        <a
                            href="{{ route(
                                'admin.activity-logs.show',
                                $log
                            ) }}"
                            class="btn btn-sm btn-outline-secondary"
                        >
                            Details
                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="text-center py-5 text-muted"
                    >
                        No activity found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">
    {{ $logs->links() }}
</div>

@endsection