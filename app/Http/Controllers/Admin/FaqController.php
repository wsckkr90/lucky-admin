<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query()
            ->with('game')
            ->orderBy('sort_order')
            ->orderBy('id');

        // Filter by scope
        if ($request->filled('scope')) {
            $query->where('scope', $request->scope);
        }

        // Filter by game
        if ($request->filled('game_id')) {
            $query->where('game_id', $request->game_id);
        }

        // Filter by status
        if ($request->filled('active')) {
            $query->where(
                'active',
                $request->boolean('active')
            );
        }

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', '%' . $search . '%')
                    ->orWhere('answer', 'like', '%' . $search . '%');
            });
        }

        $faqs = $query->paginate(20)->withQueryString();

        $games = Game::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.faqs.index',
            compact('faqs', 'games')
        );
    }

    public function create()
    {
        $games = Game::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.faqs.create',
            compact('games')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'scope' => [
                'required',
                Rule::in(['global', 'game']),
            ],

            'game_id' => [
                'nullable',
                'integer',
                'exists:games,id',
            ],

            'question' => [
                'required',
                'string',
                'max:1000',
            ],

            'answer' => [
                'required',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        if ($validated['scope'] === 'global') {
            $validated['game_id'] = null;
        }

        Faq::create([
            'scope' => $validated['scope'],
            'game_id' => $validated['game_id'] ?? null,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => $request->boolean('active'),
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        $games = Game::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.faqs.edit',
            compact('faq', 'games')
        );
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'scope' => [
                'required',
                Rule::in(['global', 'game']),
            ],

            'game_id' => [
                'nullable',
                'integer',
                'exists:games,id',
            ],

            'question' => [
                'required',
                'string',
                'max:1000',
            ],

            'answer' => [
                'required',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        if ($validated['scope'] === 'global') {
            $validated['game_id'] = null;
        }

        $faq->update([
            'scope' => $validated['scope'],
            'game_id' => $validated['game_id'] ?? null,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => $request->boolean('active'),
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    public function toggle(Faq $faq)
    {
        $faq->update([
            'active' => ! $faq->active,
        ]);

        return back()->with(
            'success',
            'FAQ status updated successfully.'
        );
    }
}
