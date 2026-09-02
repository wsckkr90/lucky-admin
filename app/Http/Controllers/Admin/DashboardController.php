<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Game;
use App\Models\GameResult;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),

            'cities' => City::where('active', true)->count(),

            'games' => Game::where('active', true)->count(),

            'today_results' => GameResult::whereDate(
                'result_date',
                today()
            )->count(),
        ];

        return view(
            'admin.dashboard.index',
            compact('stats')
        );
    }
}