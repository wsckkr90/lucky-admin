@extends('layouts.admin')

@section('title', 'Create Blog')

@section('content')
<div class="admin-form-page space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-1 text-xs font-extrabold uppercase tracking-[0.12em] text-slate-400">Content / कंटेंट</div>
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Create Blog</h1>
            <p class="mt-1 max-w-2xl text-sm text-slate-500">Publish a polished article with a cover image, author and clear publishing controls.</p>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary inline-flex items-center justify-center gap-2 px-4">
            <span aria-hidden="true">←</span> Back to Blogs
        </a>
    </div>

    @if($errors->any())
        <div class="admin-alert admin-alert-danger" role="alert">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1fr)_380px]">
            <section class="admin-card overflow-hidden">
                <div class="border-b border-slate-100 px-5 py-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600" aria-hidden="true">✎</span>
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">Blog content</h2>
                            <p class="text-xs text-slate-500">Write the article readers will see on your public site.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 p-5 sm:p-6">
                    <div>
                        <label class="form-label" for="title">Title <span class="text-red-500">*</span></label>
                        <input id="title" type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. Today’s latest market update" required>
                        @error('title')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between gap-3">
                            <label class="form-label" for="slug">Slug</label>
                            <span class="text-[11px] font-semibold text-slate-400">Auto-generated when empty</span>
                        </div>
                        <input id="slug" type="text" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" placeholder="today-latest-market-update">
                        @error('slug')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="excerpt">Excerpt</label>
                        <textarea id="excerpt" name="excerpt" rows="4" class="form-control @error('excerpt') is-invalid @enderror" placeholder="Add a concise summary for cards, previews and SEO snippets.">{{ old('excerpt') }}</textarea>
                        <p class="form-text mt-1">Keep this short and useful. Around 1–3 sentences works well.</p>
                        @error('excerpt')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3">
                            <label class="form-label mb-0" for="content">Content <span class="text-red-500">*</span></label>
                            <span class="text-[11px] font-semibold text-slate-400">Long-form article body</span>
                        </div>
                        <textarea id="content" name="content" rows="22" class="form-control min-h-[420px] font-mono text-[13px] @error('content') is-invalid @enderror" placeholder="Write your article content here..." required>{{ old('content') }}</textarea>
                        <p class="form-text mt-1">HTML is accepted when your public renderer supports it.</p>
                        @error('content')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                    </div>
                </div>
            </section>

            <aside class="space-y-6 xl:sticky xl:top-24 xl:self-start">
                <section class="admin-card overflow-hidden">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h2 class="text-base font-extrabold text-slate-900">Publishing</h2>
                        <p class="mt-1 text-xs text-slate-500">Control visibility and timing.</p>
                    </div>
                    <div class="space-y-5 p-5">
                        <div>
                            <label class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                                <option value="published" @selected(old('status') === 'published')>Published</option>
                            </select>
                            @error('status')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label" for="published_at">Published at</label>
                            <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="form-control @error('published_at') is-invalid @enderror">
                            @error('published_at')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-3">
                            <input type="checkbox" name="featured" value="1" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" @checked(old('featured'))>
                            <span>
                                <span class="block text-sm font-bold text-slate-800">Featured blog</span>
                                <span class="block text-xs text-slate-500">Highlight this post in featured content.</span>
                            </span>
                        </label>
                    </div>
                </section>

                <section class="admin-card overflow-hidden">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h2 class="text-base font-extrabold text-slate-900">Author</h2>
                        <p class="mt-1 text-xs text-slate-500">Choose who owns this post.</p>
                    </div>
                    <div class="p-5">
                        <label class="form-label" for="author_id">Author</label>
                        <select id="author_id" name="author_id" class="form-select @error('author_id') is-invalid @enderror">
                            <option value="">Current logged-in user</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" @selected((string) old('author_id') === (string) $author->id)>{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                    </div>
                </section>

                <section class="admin-card overflow-hidden">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h2 class="text-base font-extrabold text-slate-900">Cover image</h2>
                        <p class="mt-1 text-xs text-slate-500">Upload an optimized image for the blog card and detail page.</p>
                    </div>
                    <div class="space-y-4 p-5">
                        <div>
                            <label class="form-label" for="cover_text">Cover text</label>
                            <input id="cover_text" type="text" name="cover_text" value="{{ old('cover_text') }}" class="form-control @error('cover_text') is-invalid @enderror" placeholder="Optional cover heading">
                            @error('cover_text')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label" for="cover_image">Image</label>
                            <div class="blog-cover-upload relative">
                                <input id="cover_image" name="cover_image" type="file" accept="image/jpeg,image/png,image/webp" class="sr-only @error('cover_image') is-invalid @enderror">
                                <label for="cover_image" class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 px-5 py-8 text-center transition hover:border-blue-400 hover:bg-blue-50/40">
                                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white text-xl shadow-sm ring-1 ring-slate-200" aria-hidden="true">↥</span>
                                    <span class="mt-3 text-sm font-extrabold text-slate-800">Choose cover image</span>
                                    <span class="mt-1 text-xs text-slate-500">JPG, PNG or WebP · max 4 MB</span>
                                    <span id="cover-file-name" class="mt-3 hidden max-w-full truncate rounded-full bg-blue-100 px-3 py-1 text-[11px] font-bold text-blue-700"></span>
                                </label>
                                <div id="cover-preview" class="mt-3 hidden overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                                    <img src="" alt="Cover preview" class="aspect-[16/9] w-full object-cover">
                                </div>
                            </div>
                            @error('cover_image')<div class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </section>

                <section class="admin-card p-5">
                    <button type="submit" class="btn btn-primary w-full justify-center px-5 py-3">Create Blog</button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary mt-2 inline-flex w-full items-center justify-center px-5 py-3">Cancel</a>
                </section>
            </aside>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('cover_image');
    const preview = document.getElementById('cover-preview');
    const image = preview?.querySelector('img');
    const fileName = document.getElementById('cover-file-name');

    input?.addEventListener('change', () => {
        const file = input.files?.[0];
        if (!file) return;
        if (!file.type.startsWith('image/')) return;

        if (fileName) {
            fileName.textContent = file.name;
            fileName.classList.remove('hidden');
        }

        if (preview && image) {
            image.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        }
    });
});
</script>
@endpush
