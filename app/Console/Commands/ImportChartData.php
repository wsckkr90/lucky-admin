<?php

namespace App\Console\Commands;

use App\Models\ChartEntry;
use App\Models\ChartWeek;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportChartData extends Command
{
    protected $signature = 'data:import-charts
                            {--game= : Import only one game legacy key}
                            {--force : Re-import and replace existing chart data}';

    protected $description =
        'Import legacy data/charts/*.json files into MySQL';

    protected string $chartsPath;

    /**
     * The legacy files use these day names.
     */
    protected array $dayOffsets = [
        'mon' => 0,
        'tue' => 1,
        'wed' => 2,
        'thu' => 3,
        'fri' => 4,
        'sat' => 5,
        'sun' => 6,
    ];

    public function handle(): int
    {
        $this->chartsPath = base_path(
            '../data/charts'
        );

        /*
        |--------------------------------------------------------------------------
        | Adjust automatically if your Laravel project has data/charts directly
        |--------------------------------------------------------------------------
        */

        if (!File::isDirectory($this->chartsPath)) {
            $fallback = base_path(
                '../data/charts'
            );

            if (File::isDirectory($fallback)) {
                $this->chartsPath = $fallback;
            }
        }

        if (!File::isDirectory($this->chartsPath)) {
            $this->error(
                "Charts directory not found: {$this->chartsPath}"
            );

            return self::FAILURE;
        }

        $files = File::glob(
            $this->chartsPath . DIRECTORY_SEPARATOR . '*.json'
        );

        if (empty($files)) {
            $this->warn(
                'No chart JSON files found.'
            );

            return self::SUCCESS;
        }

        $requestedGame = $this->option('game');

        $totalWeeks = 0;
        $totalEntries = 0;
        $totalFiles = 0;

        $this->newLine();

        foreach ($files as $filePath) {

            $legacyKey = pathinfo(
                $filePath,
                PATHINFO_FILENAME
            );

            if (
                $requestedGame &&
                $requestedGame !== $legacyKey
            ) {
                continue;
            }

            $game = Game::query()
                ->where('legacy_id', $legacyKey)
                ->first();

            if (!$game) {
                $this->warn(
                    "Skipping {$legacyKey}: no matching game found."
                );

                continue;
            }

            $this->line(
                "Processing <info>{$legacyKey}</info>..."
            );

            $json = File::get($filePath);

            try {
                $data = json_decode(
                    $json,
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );
            } catch (\Throwable $e) {
                $this->error(
                    "Invalid JSON in {$legacyKey}: {$e->getMessage()}"
                );

                continue;
            }

            if (!is_array($data)) {
                $this->warn(
                    "Skipping {$legacyKey}: expected an array."
                );

                continue;
            }

            try {

                $stats = DB::transaction(
                    fn () => $this->importGame(
                        $game,
                        $data
                    )
                );

                $totalWeeks += $stats['weeks'];
                $totalEntries += $stats['entries'];
                $totalFiles++;

                $this->info(
                    "  Weeks: {$stats['weeks']} | Entries: {$stats['entries']}"
                );

            } catch (\Throwable $e) {

                $this->error(
                    "  Failed {$legacyKey}: {$e->getMessage()}"
                );

                report($e);
            }
        }

        $this->newLine();

        $this->info(
            "Files imported: {$totalFiles}"
        );

        $this->info(
            "Chart weeks imported: {$totalWeeks}"
        );

        $this->info(
            "Chart entries imported: {$totalEntries}"
        );

        return self::SUCCESS;
    }

    /**
     * Import all weeks for one game.
     */
  protected function importGame(
    Game $game,
    array $weeks
): array {
    $weekCount = 0;
    $entryCount = 0;

    $dayOffsets = [
        'mon' => 0,
        'tue' => 1,
        'wed' => 2,
        'thu' => 3,
        'fri' => 4,
        'sat' => 5,
        'sun' => 6,
    ];

    foreach ($weeks as $weekData) {

        if (!is_array($weekData)) {
            continue;
        }

        $weekLabel = trim(
            (string) (
                $weekData['week'] ?? ''
            )
        );

        if ($weekLabel === '') {
            continue;
        }

        $range = $this->parseWeekRange(
            $weekLabel
        );

        if (!$range) {
            $this->warn(
                "Could not parse week: {$weekLabel}"
            );

            continue;
        }

        $chartWeek = ChartWeek::updateOrCreate(
            [
                'game_id' =>
                    $game->id,

                'week_start' =>
                    $range['start']->toDateString(),

                'week_end' =>
                    $range['end']->toDateString(),
            ]
        );

        $weekCount++;

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT:
        |
        | Read the actual day keys present in the JSON.
        | Do not assume that the JSON contains a particular structure beyond
        | the known mon/tue/... keys.
        |--------------------------------------------------------------------------
        */

        $days = $weekData['days'] ?? [];

        if (!is_array($days)) {
            continue;
        }

        foreach ($days as $dayName => $dayData) {

            $dayName = strtolower(
                trim((string) $dayName)
            );

            if (!array_key_exists(
                $dayName,
                $dayOffsets
            )) {
                continue;
            }

            if (!is_array($dayData)) {
                continue;
            }

            $offset =
                $dayOffsets[$dayName];

            $resultDate = $range['start']
                ->copy()
                ->addDays($offset);

            /*
            |--------------------------------------------------------------------------
            | The legacy JSON explicitly contains Sunday.
            |
            | Preserve it rather than dropping it because the textual
            | week label ends on Saturday.
            |--------------------------------------------------------------------------
            */

            $open = $this->normalizeLegacyValue(
                $dayData['open'] ?? null
            );

            $jodi = $this->normalizeLegacyValue(
                $dayData['jodi'] ?? null
            );

            $close = $this->normalizeLegacyValue(
                $dayData['close'] ?? null
            );

            /*
            |--------------------------------------------------------------------------
            | Legacy chart's primary result is Jodi.
            |--------------------------------------------------------------------------
            */

            $result = $jodi;

            /*
            |--------------------------------------------------------------------------
            | Debug-friendly logging.
            |--------------------------------------------------------------------------
            */

            $this->line(
                "    {$dayName}: {$resultDate->format('Y-m-d')} " .
                "open={$open} jodi={$jodi} close={$close}"
            );

            ChartEntry::updateOrCreate(
                [
                    'chart_week_id' =>
                        $chartWeek->id,

                    'result_date' =>
                        $resultDate->toDateString(),
                ],
                [
                    'day_of_week' =>
                        $resultDate->dayOfWeek,

                    'open_panna' =>
                        $open,

                    'jodi' =>
                        $jodi,

                    'close_panna' =>
                        $close,

                    'result' =>
                        $result,
                ]
            );

            $entryCount++;
        }
    }

    return [
        'weeks' =>
            $weekCount,

        'entries' =>
            $entryCount,
    ];
}

protected function normalizeLegacyValue(
    mixed $value
): ?string {
    if ($value === null) {
        return null;
    }

    $value = trim(
        (string) $value
    );

    if (
        $value === '' ||
        $value === '**' ||
        $value === '***' ||
        $value === '--' ||
        $value === '---'
    ) {
        return null;
    }

    return $value;
}

    /**
     * Parse the legacy week label.
     *
     * Supported examples:
     *
     * 18/05/26 to 23/05/26
     * 29/12/25 to 03/01/26
     * 15/07/2019 to 19/07/2019
     * 30/10/17to05/11/17
     */
    protected function parseWeekRange(
        string $week
    ): ?array {

        $week = trim($week);

        /*
        |--------------------------------------------------------------------------
        | Normalize spaces around "to".
        |--------------------------------------------------------------------------
        */

        $week = preg_replace(
            '/\s*to\s*/i',
            ' to ',
            $week
        );

        if (!$week) {
            return null;
        }

        $parts = explode(
            ' to ',
            $week
        );

        if (count($parts) !== 2) {
            return null;
        }

        $startString = trim($parts[0]);
        $endString = trim($parts[1]);

        $start = $this->parseLegacyDate(
            $startString
        );

        $end = $this->parseLegacyDate(
            $endString,
            $start
        );

        if (!$start || !$end) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Ensure the range isn't backwards.
        |--------------------------------------------------------------------------
        */

        if ($end->lt($start)) {
            $end->addYear();
        }

        return [
            'start' => $start,
            'end' => $end,
        ];
    }

    /**
     * Parse legacy dates.
     */
    protected function parseLegacyDate(
    string $value,
    ?Carbon $reference = null
): ?Carbon {
    $value = trim($value);

    /*
    |--------------------------------------------------------------------------
    | Explicitly parse dd/mm/yy and dd/mm/yyyy.
    |
    | Legacy data uses values such as:
    |
    | 27/07/26
    | 01/08/26
    |
    | We must convert 26 -> 2026.
    |--------------------------------------------------------------------------
    */

    if (preg_match(
        '/^(\d{1,2})\/(\d{1,2})\/(\d{2})$/',
        $value,
        $matches
    )) {

        $day = (int) $matches[1];
        $month = (int) $matches[2];
        $year = 2000 + (int) $matches[3];

        try {
            return Carbon::create(
                $year,
                $month,
                $day,
                0,
                0,
                0
            );
        } catch (\Throwable) {
            return null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Four-digit year.
    |--------------------------------------------------------------------------
    */

    if (preg_match(
        '/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/',
        $value,
        $matches
    )) {

        $day = (int) $matches[1];
        $month = (int) $matches[2];
        $year = (int) $matches[3];

        try {
            return Carbon::create(
                $year,
                $month,
                $day,
                0,
                0,
                0
            );
        } catch (\Throwable) {
            return null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Fallback.
    |--------------------------------------------------------------------------
    */

    try {
        return Carbon::parse($value)->startOfDay();
    } catch (\Throwable) {
        return null;
    }
}

    /**
     * Convert legacy placeholders into SQL NULL.
     *
     * Important:
     * We don't save "***" and "**" as real results.
     */
    protected function normalizeValue(
        mixed $value
    ): ?string {
        if ($value === null) {
            return null;
        }

        $value = trim(
            (string) $value
        );

        if (
            $value === '' ||
            $value === '***' ||
            $value === '**' ||
            $value === '-' ||
            $value === '--'
        ) {
            return null;
        }

        return $value;
    }
}
