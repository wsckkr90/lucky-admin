<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Game;
use App\Models\GameResult;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember(
            'admin:dashboard:stats',
            now()->addSeconds(30),
            fn () => [
                'users' => User::count(),
                'cities' => City::query()->where('active', true)->count(),
                'games' => Game::query()->where('active', true)->count(),
                'today_results' => GameResult::query()->where('result_date', today())->count(),
            ]
        );

        return view('admin.dashboard.index', compact('stats'));
    }
}
