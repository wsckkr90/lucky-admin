<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->select([
                'id',
                'title',
                'slug',
                'excerpt',
                'author_id',
                'cover_image',
                'status',
                'featured',
                'published_at',
                'created_at',
            ])
            ->with('author:id,name')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->input('search'));

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when(
                $request->filled('status'),
                fn ($q) => $q->where('status', $request->input('status'))
            )
            ->when(
                $request->filled('featured'),
                fn ($q) => $q->where('featured', $request->boolean('featured'))
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $authors = User::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.blogs.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateBlog($request);

        $validated['slug'] = $this->uniqueSlug(
            $validated['slug'] ?? $validated['title']
        );

        $validated['author_id'] = $validated['author_id'] ?? auth()->id();
        $validated['featured'] = $request->boolean('featured');
        $validated['cover_image'] = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('blog-covers', 'public')
            : null;

        if ($validated['status'] === 'published') {
            $validated['published_at'] =
                $validated['published_at'] ?? now();
        } else {
            $validated['published_at'] = null;
        }

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $authors = User::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.blogs.edit', compact('blog', 'authors'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $this->validateBlog($request);

        $validated['slug'] = $this->uniqueSlug(
            $validated['slug'] ?? $validated['title'],
            $blog->id
        );

        $validated['featured'] = $request->boolean('featured');

        if ($request->boolean('remove_cover_image') && $blog->cover_image) {
            $this->deleteCoverImage($blog->cover_image);
            $validated['cover_image'] = null;
        } elseif ($request->hasFile('cover_image')) {
            $this->deleteCoverImage($blog->cover_image);
            $validated['cover_image'] = $request->file('cover_image')
                ->store('blog-covers', 'public');
        } else {
            unset($validated['cover_image']);
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] =
                $validated['published_at']
                ?? $blog->published_at
                ?? now();
        } else {
            $validated['published_at'] = null;
        }

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->deleteCoverImage($blog->cover_image);
        $blog->delete();

        return back()->with(
            'success',
            'Blog deleted successfully.'
        );
    }

    public function publish(Blog $blog)
    {
        $blog->update([
            'status' => 'published',
            'published_at' => $blog->published_at ?? now(),
        ]);

        return back()->with(
            'success',
            'Blog published successfully.'
        );
    }

    public function unpublish(Blog $blog)
    {
        $blog->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return back()->with(
            'success',
            'Blog moved to draft.'
        );
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update([
            'featured' => !$blog->featured,
        ]);

        return back()->with(
            'success',
            $blog->featured
                ? 'Blog marked as featured.'
                : 'Blog removed from featured.'
        );
    }

    private function validateBlog(Request $request): array
    {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'excerpt' => [
                'nullable',
                'string',
            ],

            'content' => [
                'required',
                'string',
            ],

            'author_id' => [
                'nullable',
                'exists:users,id',
            ],

            'cover_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:4096',
            ],

            'remove_cover_image' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'required',
                'in:draft,published',
            ],

            'featured' => [
                'nullable',
                'boolean',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);
    }

    private function deleteCoverImage(?string $path): void
    {
        if (!$path || filter_var($path, FILTER_VALIDATE_URL)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function uniqueSlug(
        string $value,
        ?int $ignoreId = null
    ): string {
        $base = Str::slug($value) ?: 'blog';
        $slug = $base;
        $counter = 2;

        while (
            Blog::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
