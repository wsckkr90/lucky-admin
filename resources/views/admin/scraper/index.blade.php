@extends('layouts.admin')

@section('title', 'Scraper')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-1">
            Scraper
        </h2>

        <p class="text-muted mb-0">
            Manage automated result sources.
        </p>
    </div>

    @can('scraper.create')

        <a
            href="{{ route('admin.scraper.create') }}"
            class="btn btn-primary"
        >
            + Add Source
        </a>

    @endcan

</div>


<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">
        <h5 class="mb-0">
            Sources
        </h5>
    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>
                    <th>Name</th>
                    <th>Method</th>
                    <th>URL</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>

            </thead>

            <tbody>

            @forelse($sources as $source)

                <tr>

                    <td>
                        <strong>
                            {{ $source->name }}
                        </strong>
                    </td>

                    <td>
                        {{ $source->method }}
                    </td>

                    <td>
                        <span class="text-muted">
                            {{ $source->url }}
                        </span>
                    </td>

                    <td>
                        {{ $source->priority }}
                    </td>

                    <td>

                        @if($source->active)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td class="text-end">

                        @can('scraper.run')

                            @if($source->active)

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.scraper.run',
                                        $source
                                    ) }}"
                                    class="d-inline"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-primary"
                                    >
                                        Run
                                    </button>

                                </form>

                            @endif

                        @endcan

                        @can('scraper.run')

    <form
        method="POST"
        action="{{ route(
            'admin.scraper.run',
            $source
        ) }}"
        class="d-inline"
    >
        @csrf

        <button
            type="submit"
            class="btn btn-sm btn-primary"
        >
            Live Results
        </button>

    </form>

@endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="text-center py-5 text-muted"
                    >
                        No scraper sources configured.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Recent Runs
        </h5>

    </div>

    <div class="table-responsive">

        <table class="table table-hover mb-0">

            <thead class="table-light">

                <tr>
                    <th>Started</th>
                    <th>Status</th>
                    <th>Found</th>
                    <th>Updated</th>
                    <th>Errors</th>
                    <th>Message</th>
                </tr>

            </thead>

            <tbody>

            @forelse($runs as $run)

                <tr>

                    <td>
                        {{ $run->started_at }}
                    </td>

                    <td>
                        {{ ucfirst($run->status) }}
                    </td>

                    <td>
                        {{ $run->games_found }}
                    </td>

                    <td>
                        {{ $run->games_updated }}
                    </td>

                    <td>
                        {{ $run->error_count }}
                    </td>

                    <td>
                        {{ $run->message ?? '—' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="text-center py-5 text-muted"
                    >
                        No scraper runs yet.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="mt-3">
    {{ $runs->links() }}
</div>

@endsection
