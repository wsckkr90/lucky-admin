<?php

namespace App\Services;

use App\Models\Game;
use App\Models\ScraperRun;
use Carbon\Carbon;

class ScraperScheduleService
{
    public function shouldRun(
        bool $force = false
    ): bool {
        if ($force) {
            return true;
        }

        $lastRun =
            ScraperRun::query()
                ->whereIn(
                    'status',
                    [
                        'success',
                        'partial',
                    ]
                )
                ->latest('completed_at')
                ->value('completed_at');

        $lastRun =
            $lastRun
                ? Carbon::parse($lastRun)
                : null;

        $now = now();

        $currentMinutes =
            ($now->hour * 60)
            + $now->minute;

        $isDeclaring = false;

        $games = Game::query()
            ->where('active', true)
            ->get([
                'open_time',
                'close_time',
            ]);

        foreach ($games as $game) {

            foreach ([
                $game->open_time,
                $game->close_time,
            ] as $time) {

                if (!$time) {
                    continue;
                }

                $minutes =
                    $this->toMinutes(
                        $time
                    );

                if ($minutes === null) {
                    continue;
                }

                if (
                    $currentMinutes >=
                        ($minutes - 2)
                    &&
                    $currentMinutes <=
                        ($minutes + 20)
                ) {
                    $isDeclaring = true;
                    break 2;
                }
            }
        }

        if (!$lastRun) {
            return true;
        }

        $secondsSince =
            $lastRun->diffInSeconds(
                $now
            );

        if ($isDeclaring) {
            return $secondsSince >= 60;
        }

        return $secondsSince >= 1800;
    }

    protected function toMinutes(
        string $time
    ): ?int {
        $time = trim($time);

        if (
            !preg_match(
                '/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i',
                $time,
                $matches
            )
        ) {
            return null;
        }

        $hour =
            (int) $matches[1];

        $minute =
            (int) $matches[2];

        $ampm =
            strtoupper($matches[3]);

        if (
            $ampm === 'PM' &&
            $hour < 12
        ) {
            $hour += 12;
        }

        if (
            $ampm === 'AM' &&
            $hour === 12
        ) {
            $hour = 0;
        }

        return (
            $hour * 60
        ) + $minute;
    }
}
