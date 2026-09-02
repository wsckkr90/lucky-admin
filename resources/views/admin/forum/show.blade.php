@extends('layouts.admin')

@section('title', 'Forum Post')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Forum Post
            </h1>

            <p class="text-muted mb-0">
                Review forum post details.
            </p>
        </div>

        <a
            href="{{ route('admin.forum.index') }}"
            class="btn btn-light border"
        >
            ← Back
        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">
                {{ $post->title }}
            </h4>

            <div class="d-flex gap-2 mb-4">

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

                <span class="text-muted">
                    {{ $post->created_at?->format('d M Y, h:i A') }}
                </span>

            </div>


            <div class="border rounded-3 p-4 bg-light">
                {!! nl2br(e($post->content)) !!}
            </div>


            @can('forum.update')

                <form
                    method="POST"
                    action="{{ route('admin.forum.update', $post) }}"
                    class="mt-4"
                >

                    @csrf
                    @method('PUT')

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select mb-3"
                    >

                        @foreach([
                            'pending',
                            'approved',
                            'rejected',
                            'hidden'
                        ] as $status)

                            <option
                                value="{{ $status }}"
                                @selected($post->status === $status)
                            >
                                {{ ucfirst($status) }}
                            </option>

                        @endforeach

                    </select>

                    <button class="btn btn-primary">
                        Update Status
                    </button>

                </form>

            @endcan

        </div>

    </div>

</div>

@endsection
