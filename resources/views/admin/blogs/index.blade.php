@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h4 class="mb-1 fw-bold">Blogs</h4>
            <p class="text-muted mb-0">
                Manage blog posts, publishing and featured content.
            </p>
        </div>

        @can('blogs.create')
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                <span class="me-1">+</span>
                Create Blog
            </a>
        @endcan
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.blogs.index') }}"
            >
                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-lg-5 col-md-6">
                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by title or slug..."
                            value="{{ request('search') }}"
                        >
                    </div>

                    {{-- Status --}}
                    <div class="col-lg-2 col-md-3">
                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status" class="form-select">
                            <option value="">All Status</option>

                            <option
                                value="published"
                                @selected(request('status') === 'published')
                            >
                                Published
                            </option>

                            <option
                                value="draft"
                                @selected(request('status') === 'draft')
                            >
                                Draft
                            </option>
                        </select>
                    </div>

                    {{-- Featured --}}
                    <div class="col-lg-2 col-md-3">
                        <label class="form-label fw-semibold">
                            Featured
                        </label>

                        <select name="featured" class="form-select">
                            <option value="">All</option>

                            <option
                                value="1"
                                @selected(request('featured') === '1')
                            >
                                Featured
                            </option>

                            <option
                                value="0"
                                @selected(request('featured') === '0')
                            >
                                Not Featured
                            </option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="col-lg-3 col-md-12">
                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Search
                            </button>

                            <a
                                href="{{ route('admin.blogs.index') }}"
                                class="btn btn-outline-secondary"
                            >
                                Reset
                            </a>

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    {{-- Blog Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">
                    All Blogs
                </h5>

                <span class="badge bg-light text-dark">
                    {{ $blogs->total() }} Total
                </span>

            </div>
        </div>

        <div class="card-body p-0">

            @if($blogs->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="px-3">Blog</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Published</th>
                                <th class="text-end px-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($blogs as $blog)

                            <tr>

                                {{-- Blog --}}
                                <td class="px-3">
                                    <div class="fw-semibold">
                                        {{ $blog->title }}
                                    </div>

                                    <div class="small text-muted">
                                        /{{ $blog->slug }}
                                    </div>

                                    @if($blog->excerpt)
                                        <div class="small text-muted mt-1">
                                            {{ \Illuminate\Support\Str::limit($blog->excerpt, 80) }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Author --}}
                                <td>
                                    {{ $blog->author?->name ?? 'Unknown' }}
                                </td>

                                {{-- Status --}}
                                <td>

                                    @if($blog->status === 'published')

                                        <span class="badge bg-success">
                                            Published
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Draft
                                        </span>

                                    @endif

                                </td>

                                {{-- Featured --}}
                                <td>

                                    @if($blog->featured)

                                        <span class="badge bg-warning text-dark">
                                            Featured
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            No
                                        </span>

                                    @endif

                                </td>

                                {{-- Published --}}
                                <td>

                                    @if($blog->published_at)

                                        <div>
                                            {{ $blog->published_at->format('d M Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $blog->published_at->format('h:i A') }}
                                        </small>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>

                                {{-- Actions --}}
                                <td class="text-end px-3">

                                    <div class="d-flex justify-content-end gap-1 flex-wrap">

                                        {{-- Edit --}}
                                        @can('blogs.update')
                                            <a
                                                href="{{ route('admin.blogs.edit', $blog) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Edit"
                                            >
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Publish / Unpublish --}}
                                        @can('blogs.publish')

                                            @if($blog->status === 'published')

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.blogs.unpublish', $blog) }}"
                                                    class="d-inline"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-warning"
                                                        onclick="return confirm('Move this blog back to draft?')"
                                                    >
                                                        Unpublish
                                                    </button>
                                                </form>

                                            @else

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.blogs.publish', $blog) }}"
                                                    class="d-inline"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-success"
                                                    >
                                                        Publish
                                                    </button>
                                                </form>

                                            @endif

                                        @endcan

                                        {{-- Featured --}}
                                        @can('blogs.update')

                                            <form
                                                method="POST"
                                                action="{{ route('admin.blogs.toggle-featured', $blog) }}"
                                                class="d-inline"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-dark"
                                                >
                                                    {{ $blog->featured ? 'Unfeature' : 'Feature' }}
                                                </button>
                                            </form>

                                        @endcan

                                        {{-- Delete --}}
                                        @can('blogs.delete')

                                            <form
                                                method="POST"
                                                action="{{ route('admin.blogs.destroy', $blog) }}"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this blog?')"
                                                >
                                                    Delete
                                                </button>
                                            </form>

                                        @endcan

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>
                </div>

            @else

                <div class="text-center py-5">

                    <div class="fs-1 text-muted mb-3">
                        📝
                    </div>

                    <h5 class="fw-bold">
                        No blogs found
                    </h5>

                    <p class="text-muted mb-3">
                        Create your first blog post to get started.
                    </p>

                    @can('blogs.create')
                        <a
                            href="{{ route('admin.blogs.create') }}"
                            class="btn btn-primary"
                        >
                            Create Blog
                        </a>
                    @endcan

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if($blogs->hasPages())
            <div class="card-footer bg-white border-0">
                {{ $blogs->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
