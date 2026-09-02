<?php

namespace App\Http\Controllers;

use App\Models\ChartEntry;
use App\Models\ChartWeek;
use App\Models\Game;
use App\Models\GameResult;
use App\Services\SeoService;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Public chart controller.
     *
     * Supported URLs:
     *
     * /chart
     * /chart/disawer
     * /chart/disawer/2026
     * /chart/disawer/2026/8
     *
     * Legacy:
     *
     * /chart.php
     * /chart.php?game=disawer
     * /chart.php?game=disawer&year=2026
     */
    public function __construct(
        protected SeoService $seoService
    ) {
    }

    /**
     * Main chart page.
     */
    public function index(
        Request $request,
        ?string $game = null,
        ?int $year = null,
        ?int $month = null
    ) {
        /*
        |--------------------------------------------------------------------------
        | Resolve month
        |--------------------------------------------------------------------------
        */

        $requestedMonth = $month;

        if ($requestedMonth === null && $request->filled('month')) {
            $requestedMonth = (int) $request->query('month');
        }

        if (
            $requestedMonth !== null &&
            (
                $requestedMonth < 1 ||
                $requestedMonth > 12
            )
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Resolve game
        |--------------------------------------------------------------------------
        |
        | Path parameter has priority over query parameter.
        |--------------------------------------------------------------------------
        */

        $gameKey = $game;

        if (
            ($gameKey === null || $gameKey === '') &&
            $request->filled('game')
        ) {
            $gameKey = $request->query('game');
        }

        $gameKey = strtolower(
            trim((string) $gameKey)
        );

        /*
        |--------------------------------------------------------------------------
        | Keep only safe slug characters.
        |--------------------------------------------------------------------------
        */

        $gameKey = preg_replace(
            '/[^a-z0-9-]/',
            '',
            $gameKey
        );

        /*
        |--------------------------------------------------------------------------
        | /chart
        |--------------------------------------------------------------------------
        |
        | No game means yearly chart index.
        |--------------------------------------------------------------------------
        */

        if ($gameKey === '') {
            return $this->yearlyIndex();
        }

        /*
        |--------------------------------------------------------------------------
        | Find game
        |--------------------------------------------------------------------------
        */

        $gameModel = Game::query()
            ->where(function ($query) use ($gameKey) {
                $query
                    ->where(
                        'legacy_id',
                        $gameKey
                    )
                    ->orWhere(
                        'slug',
                        $gameKey
                    );
            })
            ->where(
                'active',
                true
            )
            ->with([
                'city',
                'seoMeta',
                'seoContents',
                'faqs',
            ])
            ->first();

        if (!$gameModel) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Current year
        |--------------------------------------------------------------------------
        */

        $currentYear = now()->year;

        /*
        |--------------------------------------------------------------------------
        | Available years
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | Historical chart years should come from chart_weeks,
        | while current/live result years can come from game_results.
        |
        | We merge both sources so the chart index remains complete.
        |--------------------------------------------------------------------------
        */

        $chartYears = ChartWeek::query()
            ->where(
                'game_id',
                $gameModel->id
            )
            ->selectRaw(
                'YEAR(week_start) AS year'
            )
            ->distinct()
            ->pluck('year')
            ->map(
                fn ($value) => (int) $value
            )
            ->filter(
                fn ($value) => $value > 0
            )
            ->toArray();

        $resultYears = GameResult::query()
            ->where(
                'game_id',
                $gameModel->id
            )
            ->selectRaw(
                'YEAR(result_date) AS year'
            )
            ->distinct()
            ->pluck('year')
            ->map(
                fn ($value) => (int) $value
            )
            ->filter(
                fn ($value) => $value > 0
            )
            ->toArray();

        $availableYears = array_values(
            array_unique(
                array_merge(
                    $chartYears,
                    $resultYears,
                    [$currentYear]
                )
            )
        );

        rsort($availableYears);

        /*
        |--------------------------------------------------------------------------
        | Resolve selected year
        |--------------------------------------------------------------------------
        */

        $requestedYear = $year;

        if (
            $requestedYear === null &&
            $request->filled('year')
        ) {
            $requestedYear = (int) $request->query('year');
        }

        if ($requestedYear === null) {
            $requestedYear = $currentYear;
        }

        /*
        |--------------------------------------------------------------------------
        | Invalid year falls back to current year.
        |--------------------------------------------------------------------------
        */

        if (
            !in_array(
                $requestedYear,
                $availableYears,
                true
            )
        ) {
            $selectedYear = $currentYear;
        } else {
            $selectedYear = $requestedYear;
        }

        /*
        |--------------------------------------------------------------------------
        | Historical chart entries
        |--------------------------------------------------------------------------
        |
        | This is the important migration:
        |
        | OLD:
        | daily_results.json
        |
        | NEW:
        | chart_entries
        |
        |--------------------------------------------------------------------------
        */

        $chartEntriesQuery = ChartEntry::query()
            ->whereHas(
                'week',
                function ($query) use ($gameModel) {
                    $query->where(
                        'game_id',
                        $gameModel->id
                    );
                }
            )
            ->whereYear(
                'result_date',
                $selectedYear
            )
            ->orderBy(
                'result_date'
            );

        /*
        |--------------------------------------------------------------------------
        | Optional month filter
        |--------------------------------------------------------------------------
        */

        if ($requestedMonth !== null) {
            $chartEntriesQuery->whereMonth(
                'result_date',
                $requestedMonth
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Key by date for O(1) Blade lookup.
        |--------------------------------------------------------------------------
        */

        $chartEntries = $chartEntriesQuery
            ->get()
            ->keyBy(function ($entry) {
                return $entry->result_date
                    ->format('Y-m-d');
            });

        /*
        |--------------------------------------------------------------------------
        | Current/live results
        |--------------------------------------------------------------------------
        |
        | Keep game_results available separately.
        | This is useful for today's/current result data.
        |--------------------------------------------------------------------------
        */

        $liveResultsQuery = GameResult::query()
            ->where(
                'game_id',
                $gameModel->id
            )
            ->whereYear(
                'result_date',
                $selectedYear
            )
            ->orderBy(
                'result_date'
            );

        if ($requestedMonth !== null) {
            $liveResultsQuery->whereMonth(
                'result_date',
                $requestedMonth
            );
        }

        $liveResults = $liveResultsQuery
            ->get()
            ->keyBy(function ($result) {
                return $result->result_date
                    ->format('Y-m-d');
            });

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        |
        | Explicit admin SEO always wins.
        | Otherwise SeoService generates sensible defaults.
        |--------------------------------------------------------------------------
        */

        $chartUrl = route(
            'chart.game',
            [
                'game' =>
                    $gameModel->legacy_id
                    ?: $gameModel->slug,

                'year' =>
                    $selectedYear,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Month-specific canonical
        |--------------------------------------------------------------------------
        */

        if ($requestedMonth !== null) {
            $chartUrl = route(
                'chart.month',
                [
                    'game' =>
                        $gameModel->legacy_id
                        ?: $gameModel->slug,

                    'year' =>
                        $selectedYear,

                    'month' =>
                        $requestedMonth,
                ]
            );
        }

        $seo = $this->seoService->forModel(
            $gameModel,
            [
                'title' =>
                    $gameModel->name .
                    ' Result & Chart ' .
                    $selectedYear,

                'description' =>
                    'View ' .
                    $gameModel->name .
                    ' result and historical chart for ' .
                    $selectedYear .
                    '.',

                'canonical' =>
                    $chartUrl,

                'schema_type' =>
                    'WebPage',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Render
        |--------------------------------------------------------------------------
        */

        return view(
            'public.chart',
            [
                'game' =>
                    $gameModel,

                /*
                |--------------------------------------------------------------------------
                | Historical chart records
                |--------------------------------------------------------------------------
                */

                'chartEntries' =>
                    $chartEntries,

                /*
                |--------------------------------------------------------------------------
                | Live/current result records
                |--------------------------------------------------------------------------
                */

                'liveResults' =>
                    $liveResults,

                /*
                |--------------------------------------------------------------------------
                | Backward-compatible variable.
                |
                | Remove later after chart.blade.php is fully migrated.
                |--------------------------------------------------------------------------
                */

                'results' =>
                    $liveResults,

                'availableYears' =>
                    $availableYears,

                'selectedYear' =>
                    $selectedYear,

                'selectedMonth' =>
                    $requestedMonth,

                'currentYear' =>
                    $currentYear,

                'currentMonth' =>
                    now()->month,

                'currentDay' =>
                    now()->day,

                'months' =>
                    $this->months(),

                'seo' =>
                    $seo,
            ]
        );
    }

    /**
     * Yearly chart index.
     */
    protected function yearlyIndex()
    {
        $games = Game::query()
            ->with('city')
            ->where(
                'active',
                true
            )
            ->orderBy(
                'display_order'
            )
            ->orderBy(
                'name'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Historical years
        |--------------------------------------------------------------------------
        */

        $chartYears = ChartWeek::query()
            ->selectRaw(
                'YEAR(week_start) AS year'
            )
            ->distinct()
            ->pluck('year')
            ->map(
                fn ($year) => (int) $year
            )
            ->filter(
                fn ($year) => $year > 0
            )
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Live result years
        |--------------------------------------------------------------------------
        */

        $resultYears = GameResult::query()
            ->selectRaw(
                'YEAR(result_date) AS year'
            )
            ->distinct()
            ->pluck('year')
            ->map(
                fn ($year) => (int) $year
            )
            ->filter(
                fn ($year) => $year > 0
            )
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Merge + current year.
        |--------------------------------------------------------------------------
        */

        $availableYears = array_values(
            array_unique(
                array_merge(
                    $chartYears,
                    $resultYears,
                    [
                        now()->year,
                    ]
                )
            )
        );

        rsort($availableYears);

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        $seo = [
            'title' =>
                'Satta Chart - Yearly Historical Results',

            'description' =>
                'Browse yearly satta charts and historical results for all available games.',

            'focus_keyword' =>
                'satta chart',

            'secondary_keywords' =>
                'satta result chart, historical satta chart',

            'canonical' =>
                route('chart'),

            'robots' =>
                'index,follow',

            'og_title' =>
                'Satta Chart - Yearly Historical Results',

            'og_description' =>
                'Browse yearly satta charts and historical results for all available games.',

            'og_image' =>
                null,

            'twitter_title' =>
                'Satta Chart - Yearly Historical Results',

            'twitter_description' =>
                'Browse yearly satta charts and historical results for all available games.',

            'twitter_image' =>
                null,

            'schema_type' =>
                'WebPage',

            'schema_json' =>
                null,
        ];

        return view(
            'public.chart-index',
            [
                'games' =>
                    $games,

                'availableYears' =>
                    $availableYears,

                'seo' =>
                    $seo,
            ]
        );
    }

    /**
     * Month names.
     */
    protected function months(): array
    {
        return [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
    }
}
