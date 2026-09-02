<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\ResultService;
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
            ->with('game.city');

        /*
        |--------------------------------------------------------------------------
        | Game filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('game_id')) {
            $query->where(
                'game_id',
                $request->integer('game_id')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Exact date filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {
            $query->whereDate(
                'result_date',
                $request->input('date')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Date range
        |--------------------------------------------------------------------------
        */

        if ($request->filled('from_date')) {
            $query->whereDate(
                'result_date',
                '>=',
                $request->input('from_date')
            );
        }

        if ($request->filled('to_date')) {
            $query->whereDate(
                'result_date',
                '<=',
                $request->input('to_date')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->input('status')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Search by result
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim(
                $request->input('search')
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'result',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'jodi',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'open_panna',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'close_panna',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $results = $query
            ->orderByDesc('result_date')
            ->orderBy('game_id')
            ->paginate(30)
            ->withQueryString();

        $games = Game::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.results.index',
            compact(
                'results',
                'games'
            )
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $games = Game::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.results.create',
            compact('games')
        );
    }

    /**
     * Store a result.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'game_id' => [
            'required',
            'integer',
            'exists:games,id',
        ],

        'result_date' => [
            'required',
            'date',
        ],

        'open_panna' => [
            'nullable',
            'string',
            'max:10',
        ],

        'jodi' => [
            'nullable',
            'string',
            'max:10',
        ],

        'close_panna' => [
            'nullable',
            'string',
            'max:10',
        ],

        'result' => [
            'nullable',
            'string',
            'max:20',
        ],

        'status' => [
            'required',
            'in:pending,published,corrected,cancelled',
        ],
    ]);

    try {

        $this->resultService->create($validated);

    } catch (RuntimeException $e) {

        return back()
            ->withInput()
            ->withErrors([
                'result_date' => $e->getMessage(),
            ]);
    }

    return redirect()
        ->route('admin.results.index')
        ->with(
            'success',
            'Result created successfully.'
        );
}

    /**
     * Display result.
     */
    public function show(GameResult $result)
    {
        $result->load(
            'game.city',
            'creator',
            'updater'
        );

        return view(
            'admin.results.show',
            compact('result')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(GameResult $result)
    {
        $games = Game::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.results.edit',
            compact(
                'result',
                'games'
            )
        );
    }

    /**
     * Update a result.
     */
   public function update(
    Request $request,
    GameResult $result
) {
    $validated = $request->validate([
        'game_id' => [
            'required',
            'integer',
            'exists:games,id',
        ],

        'result_date' => [
            'required',
            'date',
        ],

        'open_panna' => [
            'nullable',
            'string',
            'max:10',
        ],

        'jodi' => [
            'nullable',
            'string',
            'max:10',
        ],

        'close_panna' => [
            'nullable',
            'string',
            'max:10',
        ],

        'result' => [
            'nullable',
            'string',
            'max:20',
        ],

        'status' => [
            'required',
            'in:pending,published,corrected,cancelled',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Prevent another game/date combination
    |--------------------------------------------------------------------------
    */

    $duplicate = GameResult::query()
        ->where('game_id', $validated['game_id'])
        ->whereDate(
            'result_date',
            $validated['result_date']
        )
        ->where(
            'id',
            '!=',
            $result->id
        )
        ->exists();

    if ($duplicate) {
        return back()
            ->withInput()
            ->withErrors([
                'result_date' =>
                    'Another result already exists for this game and date.',
            ]);
    }

    $this->resultService->update(
        $result,
        $validated
    );

    return redirect()
        ->route('admin.results.index')
        ->with(
            'success',
            'Result updated successfully.'
        );
}

    /**
     * Delete a result.
     */
    public function destroy(GameResult $result)
{
    $this->resultService->delete($result);

    return redirect()
        ->route('admin.results.index')
        ->with(
            'success',
            'Result deleted successfully.'
        );
}
}