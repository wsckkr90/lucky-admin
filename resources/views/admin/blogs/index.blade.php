@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <div class="mb-1 text-xs font-extrabold uppercase tracking-[0.12em] text-slate-400">Content / कंटेंट</div>
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Blogs</h1>
            <p class="mt-1 text-sm text-slate-500">Manage articles, cover images, publishing state and featured content from one place.</p>
        </div>

        @can('blogs.create')
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary inline-flex items-center justify-center gap-2 px-5 py-2.5">
                <span aria-hidden="true">＋</span> Create Blog
            </a>
        @endcan
    </div>

    @if($errors->any())
        <div class="admin-alert admin-alert-danger" role="alert">
            <strong>Please fix the following:</strong>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="admin-card p-4 sm:p-5">
        <form method="GET" action="{{ route('admin.blogs.index') }}" class="grid grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1fr)_180px_180px_auto] lg:items-end">
            <div>
                <label class="form-label" for="search">Search</label>
                <div class="relative">
                    <input id="search" type="search" name="search" value="{{ request('search') }}" class="form-control pr-10" placeholder="Search title or slug...">
                    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-sm text-slate-400" aria-hidden="true">⌕</span>
                </div>
            </div>

            <div>
                <label class="form-label" for="status">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">All status</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                </select>
            </div>

            <div>
                <label class="form-label" for="featured">Featured</label>
                <select id="featured" name="featured" class="form-select">
                    <option value="">All</option>
                    <option value="1" @selected(request('featured') === '1')>Featured</option>
                    <option value="0" @selected(request('featured') === '0')>Not featured</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary flex-1 px-4">Filter</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary px-4">Reset</a>
            </div>
        </form>
    </section>

    <section class="admin-card overflow-hidden">
        <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">All blogs</h2>
                <p class="mt-1 text-xs text-slate-500">{{ $blogs->total() }} total posts</p>
            </div>
            <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-extrabold text-slate-600">Page {{ $blogs->currentPage() }}</span>
        </div>

        @if($blogs->count())
            <div class="table-responsive border-0 rounded-none">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Blog</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Published</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                        @php
                            $imageUrl = null;
                            if ($blog->cover_image) {
                                $imageUrl = filter_var($blog->cover_image, FILTER_VALIDATE_URL)
                                    ? $blog->cover_image
                                    : \Illuminate\Support\Facades\Storage::disk('public')->url($blog->cover_image);
                            }
                        @endphp
                        <tr>
                            <td class="min-w-[320px]">
                                <div class="flex items-center gap-3">
                                    <div class="h-14 w-20 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-100">
                                        @if($imageUrl)
                                            <img src="{{ $imageUrl }}" alt="" loading="lazy" decoding="async" class="h-full w-full object-cover">
                                        @else
                                            <div class="grid h-full place-items-center text-xs font-bold text-slate-400">No image</div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="truncate font-bold text-slate-800">{{ $blog->title }}</div>
                                        <div class="truncate text-xs text-slate-400">/{{ $blog->slug }}</div>
                                        @if($blog->excerpt)
                                            <div class="mt-1 max-w-[430px] truncate text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($blog->excerpt, 90) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">{{ $blog->author?->name ?? 'Unknown' }}</td>
                            <td>
                                @if($blog->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if($blog->featured)
                                    <span class="badge bg-warning text-dark">Featured</span>
                                @else
                                    <span class="text-xs font-semibold text-slate-400">No</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap">
                                @if($blog->published_at)
                                    <div class="font-semibold text-slate-700">{{ $blog->published_at->format('d M Y') }}</div>
                                    <small class="text-slate-400">{{ $blog->published_at->format('h:i A') }}</small>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-wrap justify-end gap-1.5">
                                    @can('blogs.update')
                                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary px-3" title="Edit blog">Edit</a>
                                    @endcan

                                    @can('blogs.publish')
                                        @if($blog->status === 'published')
                                            <form method="POST" action="{{ route('admin.blogs.unpublish', $blog) }}" class="inline-flex">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-warning px-3">Unpublish</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.blogs.publish', $blog) }}" class="inline-flex">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success px-3">Publish</button>
                                            </form>
                                        @endif
                                    @endcan

                                    @can('blogs.update')
                                        <form method="POST" action="{{ route('admin.blogs.toggle-featured', $blog) }}" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-dark px-3">{{ $blog->featured ? 'Unfeature' : 'Feature' }}</button>
                                        </form>
                                    @endcan

                                    @can('blogs.delete')
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" class="inline-flex" onsubmit="return confirm('Delete this blog? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3">Delete</button>
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
            <div class="empty-state">
                <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-slate-100 text-2xl" aria-hidden="true">✎</div>
                <strong class="mt-4">No blogs found</strong>
                <p>Create your first blog post or adjust the filters.</p>
                @can('blogs.create')
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mt-4 inline-flex px-4">Create Blog</a>
                @endcan
            </div>
        @endif

        @if($blogs->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $blogs->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
