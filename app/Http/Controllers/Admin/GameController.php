<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::query()
            ->with('city');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('legacy_id', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | City Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('city_id')) {
            $query->where(
                'city_id',
                $request->input('city_id')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where(
                'active',
                $request->input('status') === 'active'
            );
        }

        $games = $query
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $cities = City::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.games.index',
            compact(
                'games',
                'cities'
            )
        );
    }

    public function create()
    {
        $cities = City::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.games.create',
            compact('cities')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'legacy_id' => [
                'nullable',
                'string',
                'max:255',
                'unique:games,legacy_id',
            ],

            'city_id' => [
                'nullable',
                'integer',
                'exists:cities,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:games,slug',
            ],

            'open_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'close_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'chart_url' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['slug'] =
            $validated['slug']
            ?? Str::slug($validated['name']);

        $validated['active'] =
            $request->boolean('active');

        $validated['display_order'] =
            (int) ($validated['display_order'] ?? 0);

        Game::create($validated);

        return redirect()
            ->route('admin.games.index')
            ->with(
                'success',
                'Game created successfully.'
            );
    }

    public function show(Game $game)
    {
        $game->load('city');

        return view(
            'admin.games.show',
            compact('game')
        );
    }

    public function edit(Game $game)
    {
        $cities = City::query()
            ->orderBy('name')
            ->get();

        return view(
            'admin.games.edit',
            compact(
                'game',
                'cities'
            )
        );
    }

    public function update(
        Request $request,
        Game $game
    ) {
        $validated = $request->validate([
            'legacy_id' => [
                'nullable',
                'string',
                'max:255',
                'unique:games,legacy_id,' . $game->id,
            ],

            'city_id' => [
                'nullable',
                'integer',
                'exists:cities,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:games,slug,' . $game->id,
            ],

            'open_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'close_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'chart_url' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['active'] =
            $request->boolean('active');

        $validated['display_order'] =
            (int) ($validated['display_order'] ?? 0);

        $game->update($validated);

        return redirect()
            ->route('admin.games.index')
            ->with(
                'success',
                'Game updated successfully.'
            );
    }

    public function destroy(Game $game)
    {
        /*
        |--------------------------------------------------------------------------
        | Protect games that already have results
        |--------------------------------------------------------------------------
        */

        if ($game->results()->exists()) {
            return redirect()
                ->route('admin.games.index')
                ->with(
                    'error',
                    'This game cannot be deleted because results already exist. Deactivate it instead.'
                );
        }

        $game->delete();

        return redirect()
            ->route('admin.games.index')
            ->with(
                'success',
                'Game deleted successfully.'
            );
    }
}
