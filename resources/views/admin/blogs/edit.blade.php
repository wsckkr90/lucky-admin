@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">

        <div>
            <h4 class="mb-1 fw-bold">
                Edit Blog
            </h4>

            <p class="text-muted mb-0">
                Update blog content and publishing settings.
            </p>
        </div>

        <a
            href="{{ route('admin.blogs.index') }}"
            class="btn btn-outline-secondary"
        >
            ← Back to Blogs
        </a>

    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form
        method="POST"
        action="{{ route('admin.blogs.update', $blog) }}"
    >
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Main --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            Blog Content
                        </h5>
                    </div>

                    <div class="card-body">

                        {{-- Title --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Title <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $blog->title) }}"
                                placeholder="Enter blog title"
                                required
                            >

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Slug
                            </label>

                            <input
                                type="text"
                                name="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $blog->slug) }}"
                                placeholder="blog-post-url"
                            >

                            @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Excerpt --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Excerpt
                            </label>

                            <textarea
                                name="excerpt"
                                rows="4"
                                class="form-control @error('excerpt') is-invalid @enderror"
                                placeholder="Short description..."
                            >{{ old('excerpt', $blog->excerpt) }}</textarea>

                            @error('excerpt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Content --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Content <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="content"
                                rows="18"
                                class="form-control @error('content') is-invalid @enderror"
                                placeholder="Write your blog content..."
                                required
                            >{{ old('content', $blog->content) }}</textarea>

                            @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">

                {{-- Publishing --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            Publishing
                        </h5>
                    </div>

                    <div class="card-body">

                        {{-- Status --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select @error('status') is-invalid @enderror"
                            >

                                <option
                                    value="draft"
                                    @selected(old('status', $blog->status) === 'draft')
                                >
                                    Draft
                                </option>

                                <option
                                    value="published"
                                    @selected(old('status', $blog->status) === 'published')
                                >
                                    Published
                                </option>

                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Published --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Published At
                            </label>

                            <input
                                type="datetime-local"
                                name="published_at"
                                class="form-control @error('published_at') is-invalid @enderror"
                                value="{{ old(
                                    'published_at',
                                    $blog->published_at
                                        ? $blog->published_at->format('Y-m-d\TH:i')
                                        : ''
                                ) }}"
                            >

                            @error('published_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Featured --}}
                        <div class="form-check mb-3">

                            <input
                                type="checkbox"
                                name="featured"
                                value="1"
                                class="form-check-input"
                                id="featured"
                                @checked(old('featured', $blog->featured))
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="featured"
                            >
                                Featured Blog
                            </label>

                        </div>

                    </div>

                </div>

                {{-- Author --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            Author
                        </h5>
                    </div>

                    <div class="card-body">

                        <label class="form-label fw-semibold">
                            Author
                        </label>

                        <select
                            name="author_id"
                            class="form-select @error('author_id') is-invalid @enderror"
                        >

                            <option value="">
                                Current logged-in user
                            </option>

                            @foreach($authors as $author)

                                <option
                                    value="{{ $author->id }}"
                                    @selected(
                                        (string) old('author_id', $blog->author_id)
                                        ===
                                        (string) $author->id
                                    )
                                >
                                    {{ $author->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('author_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- Cover --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            Cover
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Cover Text
                            </label>

                            <input
                                type="text"
                                name="cover_text"
                                class="form-control @error('cover_text') is-invalid @enderror"
                                value="{{ old('cover_text', $blog->cover_text) }}"
                                placeholder="Cover title or text"
                            >

                            @error('cover_text')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div>

                            <label class="form-label fw-semibold">
                                Cover Image
                            </label>

                            <input
                                type="text"
                                name="cover_image"
                                class="form-control @error('cover_image') is-invalid @enderror"
                                value="{{ old('cover_image', $blog->cover_image) }}"
                                placeholder="Image URL or path"
                            >

                            @error('cover_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- Save --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Update Blog
                        </button>

                        <a
                            href="{{ route('admin.blogs.index') }}"
                            class="btn btn-outline-secondary w-100 mt-2"
                        >
                            Cancel
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>
@endsection
