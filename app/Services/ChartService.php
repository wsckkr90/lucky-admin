<?php

namespace App\Services;

use App\Models\ChartEntry;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ChartService
{
    public function getYear(
        Game $game,
        int $year
    ): Collection {
        return ChartEntry::query()
            ->whereHas('week', function ($query) use ($game) {
                $query->where(
                    'game_id',
                    $game->id
                );
            })
            ->whereYear(
                'result_date',
                $year
            )
            ->orderBy('result_date')
            ->get();
    }

    public function getMonth(
        Game $game,
        int $year,
        int $month
    ): Collection {
        return ChartEntry::query()
            ->whereHas('week', function ($query) use ($game) {
                $query->where(
                    'game_id',
                    $game->id
                );
            })
            ->whereYear(
                'result_date',
                $year
            )
            ->whereMonth(
                'result_date',
                $month
            )
            ->orderBy('result_date')
            ->get();
    }

    public function getWeek(
        Game $game,
        Carbon $date
    ): Collection {
        $start = $date->copy()->startOfWeek();
        $end = $date->copy()->endOfWeek();

        return ChartEntry::query()
            ->whereHas('week', function ($query) use ($game) {
                $query->where(
                    'game_id',
                    $game->id
                );
            })
            ->whereBetween(
                'result_date',
                [
                    $start->toDateString(),
                    $end->toDateString(),
                ]
            )
            ->orderBy('result_date')
            ->get();
    }

    public function getHistoricalYear(
    Game $game,
    int $year
) {
    return ChartEntry::query()
        ->with('week')
        ->whereHas('week', function ($query) use ($game) {
            $query->where(
                'game_id',
                $game->id
            );
        })
        ->whereYear(
            'result_date',
            $year
        )
        ->orderBy('result_date')
        ->get();
}

public function getHistoricalMonth(
    Game $game,
    int $year,
    int $month
) {
    return ChartEntry::query()
        ->with('week')
        ->whereHas('week', function ($query) use ($game) {
            $query->where(
                'game_id',
                $game->id
            );
        })
        ->whereYear(
            'result_date',
            $year
        )
        ->whereMonth(
            'result_date',
            $month
        )
        ->orderBy('result_date')
        ->get();
}
}