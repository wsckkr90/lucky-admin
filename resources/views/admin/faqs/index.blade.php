@extends('layouts.admin')

@section('title', 'FAQs')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">FAQs</h2>
        <p class="text-muted mb-0">
            Manage global and game-specific frequently asked questions.
        </p>
    </div>

    @can('faqs.create')
        <a
            href="{{ route('admin.faqs.create') }}"
            class="btn btn-primary"
        >
            + Add FAQ
        </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <form method="GET" action="{{ route('admin.faqs.index') }}">

            <div class="row g-3">

                <div class="col-md-3">
                    <label class="form-label">Search</label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search question..."
                    >
                </div>

                <div class="col-md-2">
                    <label class="form-label">Scope</label>

                    <select name="scope" class="form-select">
                        <option value="">All</option>

                        <option
                            value="global"
                            @selected(request('scope') === 'global')
                        >
                            Global
                        </option>

                        <option
                            value="game"
                            @selected(request('scope') === 'game')
                        >
                            Game
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Game</label>

                    <select name="game_id" class="form-select">

                        <option value="">All Games</option>

                        @foreach($games as $game)

                            <option
                                value="{{ $game->id }}"
                                @selected(
                                    (string) request('game_id') ===
                                    (string) $game->id
                                )
                            >
                                {{ $game->name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Status</label>

                    <select name="active" class="form-select">

                        <option value="">All</option>

                        <option
                            value="1"
                            @selected(request('active') === '1')
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            @selected(request('active') === '0')
                        >
                            Inactive
                        </option>

                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-dark w-100">
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
                    <th width="70">ID</th>
                    <th>Question</th>
                    <th>Scope</th>
                    <th>Game</th>
                    <th width="90">Order</th>
                    <th width="110">Status</th>
                    <th width="210">Actions</th>
                </tr>

            </thead>

            <tbody>

                @forelse($faqs as $faq)

                    <tr>

                        <td>
                            {{ $faq->id }}
                        </td>

                        <td>
                            <div class="fw-semibold">
                                {{ $faq->question }}
                            </div>

                            <div class="text-muted small">
                                {{ \Illuminate\Support\Str::limit(strip_tags($faq->answer), 100) }}
                            </div>
                        </td>

                        <td>
                            @if($faq->scope === 'game')
                                <span class="badge bg-info">
                                    Game
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Global
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $faq->game?->name ?? '—' }}
                        </td>

                        <td>
                            {{ $faq->sort_order }}
                        </td>

                        <td>

                            @if($faq->active)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                @can('faqs.update')

                                    <a
                                        href="{{ route('admin.faqs.edit', $faq) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.faqs.toggle', $faq) }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-warning"
                                        >
                                            {{ $faq->active ? 'Disable' : 'Enable' }}
                                        </button>

                                    </form>

                                @endcan

                                @can('faqs.delete')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.faqs.destroy', $faq) }}"
                                        onsubmit="return confirm('Delete this FAQ?');"
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

                                @endcan

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="7"
                            class="text-center py-5 text-muted"
                        >
                            No FAQs found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($faqs->hasPages())

        <div class="card-body border-top">
            {{ $faqs->links() }}
        </div>

    @endif

</div>

@endsection
