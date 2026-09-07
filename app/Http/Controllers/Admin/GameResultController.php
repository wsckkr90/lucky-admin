<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;
use App\Services\ResultService;
use Illuminate\Http\Request;
use RuntimeException;

class GameResultController extends Controller
{
    public function __construct(
        protected ResultService $resultService
    ) {}

    /**
     * Display result history.
     */
    public function index(Request $request)
    {
        $query = GameResult::query()
            ->select([
                'id',
                'game_id',
                'result_date',
                'open_panna',
                'jodi',
                'close_panna',
                'result',
                'status',
                'created_by',
                'updated_by',
            ])
            ->with([
                'game:id,city_id,name,slug',
                'game.city:id,name',
            ]);

        if ($request->filled('game_id')) {
            $query->where('game_id', $request->integer('game_id'));
        }

        if ($request->filled('date')) {
            $query->where('result_date', $request->input('date'));
        }

        if ($request->filled('from_date')) {
            $query->where('result_date', '>=', $request->input('from_date'));
        }

        if ($request->filled('to_date')) {
            $query->where('result_date', '<=', $request->input('to_date'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('result', 'like', "%{$search}%")
                    ->orWhere('jodi', 'like', "%{$search}%")
                    ->orWhere('open_panna', 'like', "%{$search}%")
                    ->orWhere('close_panna', 'like', "%{$search}%");
            });
        }

        $results = $query
            ->orderByDesc('result_date')
            ->orderBy('game_id')
            ->paginate(30)
            ->withQueryString();

        $games = Game::query()
            ->select(['id', 'name'])
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view('admin.results.index', compact('results', 'games'));
    }

    public function create()
    {
        $games = Game::query()
            ->select(['id', 'name'])
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view('admin.results.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => ['required', 'integer', 'exists:games,id'],
            'result_date' => ['required', 'date'],
            'open_panna' => ['nullable', 'string', 'max:10'],
            'jodi' => ['nullable', 'string', 'max:10'],
            'close_panna' => ['nullable', 'string', 'max:10'],
            'result' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:pending,published,corrected,cancelled'],
        ]);

        try {
            $this->resultService->create($validated);
        } catch (RuntimeException $e) {
            return back()->withInput()->withErrors(['result_date' => $e->getMessage()]);
        }

        return redirect()->route('admin.results.index')->with('success', 'Result created successfully.');
    }

    public function show(GameResult $result)
    {
        $result->load([
            'game:id,city_id,name,slug',
            'game.city:id,name',
            'creator:id,name',
            'updater:id,name',
        ]);

        return view('admin.results.show', compact('result'));
    }

    public function edit(GameResult $result)
    {
        $games = Game::query()
            ->select(['id', 'name'])
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view('admin.results.edit', compact('result', 'games'));
    }

    public function update(Request $request, GameResult $result)
    {
        $validated = $request->validate([
            'game_id' => ['required', 'integer', 'exists:games,id'],
            'result_date' => ['required', 'date'],
            'open_panna' => ['nullable', 'string', 'max:10'],
            'jodi' => ['nullable', 'string', 'max:10'],
            'close_panna' => ['nullable', 'string', 'max:10'],
            'result' => ['nullable', 'string', 'max:20'],
            'status' => ['required', 'in:pending,published,corrected,cancelled'],
        ]);

        $duplicate = GameResult::query()
            ->where('game_id', $validated['game_id'])
            ->where('result_date', $validated['result_date'])
            ->where('id', '!=', $result->id)
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->withErrors(['result_date' => 'Another result already exists for this game and date.']);
        }

        $this->resultService->update($result, $validated);

        return redirect()->route('admin.results.index')->with('success', 'Result updated successfully.');
    }

    public function destroy(GameResult $result)
    {
        $this->resultService->delete($result);

        return redirect()->route('admin.results.index')->with('success', 'Result deleted successfully.');
    }
}
