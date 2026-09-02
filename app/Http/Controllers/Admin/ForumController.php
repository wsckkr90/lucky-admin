<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumPost::query();

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $posts = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.forum.index', compact('posts'));
    }

    public function show(ForumPost $forumPost)
    {
        return view('admin.forum.show', [
            'post' => $forumPost,
        ]);
    }

    public function update(Request $request, ForumPost $forumPost)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                'in:pending,approved,rejected,hidden',
            ],
        ]);

        $forumPost->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.forum.index')
            ->with('success', 'Forum post status updated successfully.');
    }

    public function destroy(ForumPost $forumPost)
    {
        $forumPost->delete();

        return redirect()
            ->route('admin.forum.index')
            ->with('success', 'Forum post deleted successfully.');
    }
}
