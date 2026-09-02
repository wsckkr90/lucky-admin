<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChartEntry;
use App\Models\ChartWeek;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController2 extends Controller
{
    /**
     * Display historical charts.
     */
    public function index(Request $request)
    {
        $games = Game::query()
            ->where('active', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        $game = null;
        $years = collect();
        $months = collect();
        $weeks = collect();

        /*
        |--------------------------------------------------------------------------
        | Game selection
        |--------------------------------------------------------------------------
        */

        if ($request->filled('game_id')) {

            $game = Game::query()
                ->findOrFail(
                    $request->integer('game_id')
                );

            /*
            |--------------------------------------------------------------------------
            | Available years
            |--------------------------------------------------------------------------
            */

            $years = ChartWeek::query()
                ->where(
                    'game_id',
                    $game->id
                )
                ->selectRaw(
                    'YEAR(week_start) as year'
                )
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year')
                ->map(
                    fn ($year) => (int) $year
                );

            /*
            |--------------------------------------------------------------------------
            | Year selected
            |--------------------------------------------------------------------------
            */

            if ($request->filled('year')) {

                $year = $request->integer(
                    'year'
                );

                /*
                |--------------------------------------------------------------------------
                | Available months
                |--------------------------------------------------------------------------
                */

                $months = ChartWeek::query()
                    ->where(
                        'game_id',
                        $game->id
                    )
                    ->where(function ($query) use ($year) {
                        $query
                            ->whereYear(
                                'week_start',
                                $year
                            )
                            ->orWhereYear(
                                'week_end',
                                $year
                            );
                    })
                    ->selectRaw(
                        'MONTH(week_start) as month'
                    )
                    ->distinct()
                    ->orderBy('month')
                    ->pluck('month')
                    ->map(
                        fn ($month) => (int) $month
                    );

                /*
                |--------------------------------------------------------------------------
                | Month selected
                |--------------------------------------------------------------------------
                */

                if ($request->filled('month')) {

                    $month = $request->integer(
                        'month'
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Validate month.
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $month < 1 ||
                        $month > 12
                    ) {
                        abort(404);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Get weeks touching selected month.
                    |--------------------------------------------------------------------------
                    |
                    | This correctly includes a week that starts in the
                    | previous month but ends in the selected month.
                    |--------------------------------------------------------------------------
                    */

                    $weeks = ChartWeek::query()
                        ->with([
                            'entries' => function ($query) {
                                $query
                                    ->orderBy('result_date');
                            },
                        ])
                        ->where(
                            'game_id',
                            $game->id
                        )
                        ->where(function ($query) use (
                            $year,
                            $month
                        ) {
                            $query
                                ->where(function ($query) use (
                                    $year,
                                    $month
                                ) {
                                    $query
                                        ->whereYear(
                                            'week_start',
                                            $year
                                        )
                                        ->whereMonth(
                                            'week_start',
                                            $month
                                        );
                                })
                                ->orWhere(function ($query) use (
                                    $year,
                                    $month
                                ) {
                                    $query
                                        ->whereYear(
                                            'week_end',
                                            $year
                                        )
                                        ->whereMonth(
                                            'week_end',
                                            $month
                                        );
                                })
                                ->orWhere(function ($query) use (
                                    $year,
                                    $month
                                ) {
                                    $monthStart = now()
                                        ->setYear($year)
                                        ->setMonth($month)
                                        ->startOfMonth()
                                        ->toDateString();

                                    $monthEnd = now()
                                        ->setYear($year)
                                        ->setMonth($month)
                                        ->endOfMonth()
                                        ->toDateString();

                                    $query
                                        ->where(
                                            'week_start',
                                            '<=',
                                            $monthEnd
                                        )
                                        ->where(
                                            'week_end',
                                            '>=',
                                            $monthStart
                                        );
                                });
                        })
                        ->orderBy('week_start')
                        ->get();

                    /*
                    |--------------------------------------------------------------------------
                    | Keep only entries belonging to selected month.
                    |--------------------------------------------------------------------------
                    |
                    | The week can cross a month boundary.
                    | We still load the whole week, but filter the displayed
                    | entries to the requested month.
                    |--------------------------------------------------------------------------
                    */

                    $weeks->each(
                        function ($week) use (
                            $year,
                            $month
                        ) {
                            $week->setRelation(
                                'entries',
                                $week->entries->filter(
                                    function ($entry) use (
                                        $year,
                                        $month
                                    ) {
                                        return
                                            (int) $entry
                                                ->result_date
                                                ->year ===
                                                $year
                                            &&
                                            (int) $entry
                                                ->result_date
                                                ->month ===
                                                $month;
                                    }
                                )->values()
                            );
                        }
                    );

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | No month selected:
                    | load all weeks for selected year.
                    |--------------------------------------------------------------------------
                    */

                    $weeks = ChartWeek::query()
                        ->with([
                            'entries' => function ($query) {
                                $query
                                    ->orderBy('result_date');
                            },
                        ])
                        ->where(
                            'game_id',
                            $game->id
                        )
                        ->where(function ($query) use ($year) {
                            $query
                                ->whereYear(
                                    'week_start',
                                    $year
                                )
                                ->orWhereYear(
                                    'week_end',
                                    $year
                                );
                        })
                        ->orderBy('week_start')
                        ->get();
                }
            }
        }

        return view(
            'admin.charts.index',
            [
                'games' =>
                    $games,

                'game' =>
                    $game,

                'years' =>
                    $years,

                'months' =>
                    $months,

                'weeks' =>
                    $weeks,
            ]
        );
    }

    /**
     * Display a single chart entry.
     */
    public function show(
        ChartEntry $chartEntry
    ) {
        $chartEntry->load(
            'week.game'
        );

        return view(
            'admin.charts.show',
            [
                'chartEntry' =>
                    $chartEntry,
            ]
        );
    }

    /**
     * Edit a single chart entry.
     */
    public function edit(
        ChartEntry $chartEntry
    ) {
        $chartEntry->load(
            'week.game'
        );

        return view(
            'admin.charts.edit',
            [
                'chartEntry' =>
                    $chartEntry,
            ]
        );
    }

    /**
     * Update a single chart entry.
     */
    public function update(
        Request $request,
        ChartEntry $chartEntry
    ) {
        $validated = $request->validate([
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
        ]);

        DB::transaction(
            function () use (
                $validated,
                $chartEntry
            ) {
                $chartEntry->update([
                    'open_panna' =>
                        $validated[
                            'open_panna'
                        ] ?? null,

                    'jodi' =>
                        $validated[
                            'jodi'
                        ] ?? null,

                    'close_panna' =>
                        $validated[
                            'close_panna'
                        ] ?? null,

                    'result' =>
                        $validated[
                            'result'
                        ] ?? null,
                ]);
            }
        );

        return redirect()
            ->route(
                'admin.charts.index',
                [
                    'game_id' =>
                        $chartEntry
                            ->week
                            ->game_id,

                    'year' =>
                        $chartEntry
                            ->result_date
                            ->year,

                    'month' =>
                        $chartEntry
                            ->result_date
                            ->month,
                ]
            )
            ->with(
                'success',
                'Historical chart entry updated successfully.'
            );
    }

    /**
     * Update all entries in one week.
     */
    public function updateWeek(
        Request $request
    ) {
        $validated = $request->validate([
            'week_id' => [
                'required',
                'integer',
                'exists:chart_weeks,id',
            ],

            'entries' => [
                'required',
                'array',
            ],

            'entries.*.id' => [
                'required',
                'integer',
                'exists:chart_entries,id',
            ],

            'entries.*.open_panna' => [
                'nullable',
                'string',
                'max:10',
            ],

            'entries.*.jodi' => [
                'nullable',
                'string',
                'max:10',
            ],

            'entries.*.close_panna' => [
                'nullable',
                'string',
                'max:10',
            ],

            'entries.*.result' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        $week = ChartWeek::query()
            ->with('entries')
            ->findOrFail(
                $validated['week_id']
            );

        /*
        |--------------------------------------------------------------------------
        | Security:
        | only update entries belonging to this week.
        |--------------------------------------------------------------------------
        */

        $entryIds = $week->entries
            ->pluck('id')
            ->map(
                fn ($id) => (int) $id
            )
            ->all();

        DB::transaction(
            function () use (
                $validated,
                $entryIds
            ) {
                foreach (
                    $validated['entries']
                    as $entryData
                ) {

                    $entryId =
                        (int) $entryData['id'];

                    /*
                    |--------------------------------------------------------------------------
                    | Prevent modifying an entry from another week.
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !in_array(
                            $entryId,
                            $entryIds,
                            true
                        )
                    ) {
                        continue;
                    }

                    ChartEntry::query()
                        ->whereKey(
                            $entryId
                        )
                        ->update([
                            'open_panna' =>
                                $entryData[
                                    'open_panna'
                                ] ?? null,

                            'jodi' =>
                                $entryData[
                                    'jodi'
                                ] ?? null,

                            'close_panna' =>
                                $entryData[
                                    'close_panna'
                                ] ?? null,

                            'result' =>
                                $entryData[
                                    'result'
                                ] ?? null,
                        ]);
                }
            }
        );

        return back()
            ->with(
                'success',
                'Weekly chart updated successfully.'
            );
    }
}
