@extends('layouts.admin')

@section('title', 'Forum')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Forum
            </h1>

            <p class="text-muted mb-0">
                Manage community forum posts.
            </p>
        </div>

        <span class="badge text-bg-dark rounded-pill">
            {{ $posts->total() }} Posts
        </span>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body border-bottom">

            <form method="GET" action="{{ route('admin.forum.index') }}">

                <div class="row g-2">

                    <div class="col-md-10">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search forum posts..."
                        >
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            Search
                        </button>
                    </div>

                </div>

            </form>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-end">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($posts as $post)

                        <tr>

                            <td>
                                #{{ $post->id }}
                            </td>

                            <td>

                                <div class="fw-semibold">
                                    {{ $post->title }}
                                </div>

                                <div class="small text-muted">
                                    {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                                </div>

                            </td>

                            <td>

                                @php
                                    $statusClass = match ($post->status) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'hidden' => 'secondary',
                                        default => 'warning',
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $statusClass }}">
                                    {{ ucfirst($post->status ?? 'pending') }}
                                </span>

                            </td>

                            <td>
                                {{ $post->created_at?->format('d M Y, h:i A') }}
                            </td>

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

                                    @can('forum.view')
                                        <a
                                            href="{{ route('admin.forum.show', $post) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            View
                                        </a>
                                    @endcan

                                    @can('forum.update')
                                        <form
                                            method="POST"
                                            action="{{ route('admin.forum.update', $post) }}"
                                        >
                                            @csrf
                                            @method('PUT')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="{{ $post->status === 'approved' ? 'hidden' : 'approved' }}"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-success"
                                            >
                                                {{ $post->status === 'approved' ? 'Hide' : 'Approve' }}
                                            </button>

                                        </form>
                                    @endcan

                                    @can('forum.delete')
                                        <form
                                            method="POST"
                                            action="{{ route('admin.forum.destroy', $post) }}"
                                            onsubmit="return confirm('Delete this forum post?');"
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
                            <td colspan="5" class="text-center py-5 text-muted">
                                No forum posts found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($posts->hasPages())

            <div class="card-footer bg-white">
                {{ $posts->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
