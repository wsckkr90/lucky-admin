<?php

namespace App\Http\Controllers;

use App\Models\ChartEntry;
use App\Models\ChartWeek;
use App\Models\Game;
use App\Models\GameResult;
use App\Services\SeoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChartController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {
    }

    public function index(
        Request $request,
        ?string $game = null,
        ?int $year = null,
        ?int $month = null
    ) {
        $requestedMonth = $month;
        if ($requestedMonth === null && $request->filled('month')) {
            $requestedMonth = (int) $request->query('month');
        }

        if ($requestedMonth !== null && ($requestedMonth < 1 || $requestedMonth > 12)) {
            abort(404);
        }

        $gameKey = $game;
        if (($gameKey === null || $gameKey === '') && $request->filled('game')) {
            $gameKey = $request->query('game');
        }

        $gameKey = preg_replace('/[^a-z0-9-]/', '', strtolower(trim((string) $gameKey)));

        if ($gameKey === '') {
            return $this->yearlyIndex();
        }

        $gameModel = Game::query()
            ->where(function ($query) use ($gameKey) {
                $query->where('legacy_id', $gameKey)->orWhere('slug', $gameKey);
            })
            ->where('active', true)
            ->with([
                'city:id,name',
                'seoMeta',
                'seoContents' => fn ($query) => $query->where('active', true)->orderBy('sort_order')->orderBy('id'),
                'faqs' => fn ($query) => $query->where('active', true)->orderBy('sort_order')->orderBy('id'),
            ])
            ->first();

        if (!$gameModel) {
            abort(404);
        }

        $currentYear = now()->year;
        $availableYears = $this->availableYearsForGame($gameModel->id, $currentYear);

        $requestedYear = $year;
        if ($requestedYear === null && $request->filled('year')) {
            $requestedYear = (int) $request->query('year');
        }

        if ($requestedYear === null) {
            $requestedYear = $currentYear;
        }

        $selectedYear = in_array($requestedYear, $availableYears, true)
            ? $requestedYear
            : $currentYear;

        // Use sargable date ranges so MySQL/MariaDB can use date indexes.
        $rangeStart = $requestedMonth !== null
            ? Carbon::create($selectedYear, $requestedMonth, 1)->startOfDay()
            : Carbon::create($selectedYear, 1, 1)->startOfDay();

        $rangeEnd = $requestedMonth !== null
            ? Carbon::create($selectedYear, $requestedMonth, 1)->endOfMonth()->endOfDay()
            : Carbon::create($selectedYear, 12, 31)->endOfDay();

        $chartEntries = ChartEntry::query()
            ->select('chart_entries.*')
            ->join('chart_weeks', 'chart_weeks.id', '=', 'chart_entries.chart_week_id')
            ->where('chart_weeks.game_id', $gameModel->id)
            ->whereBetween('chart_entries.result_date', [$rangeStart->toDateString(), $rangeEnd->toDateString()])
            ->orderBy('chart_entries.result_date')
            ->get()
            ->keyBy(fn ($entry) => $entry->result_date->format('Y-m-d'));

        // Live results stay uncached so a newly published result appears immediately.
        $liveResults = GameResult::query()
            ->where('game_id', $gameModel->id)
            ->whereBetween('result_date', [$rangeStart->toDateString(), $rangeEnd->toDateString()])
            ->orderBy('result_date')
            ->get()
            ->keyBy(fn ($result) => $result->result_date->format('Y-m-d'));

        $chartUrl = route('chart.game', [
            'game' => $gameModel->legacy_id ?: $gameModel->slug,
            'year' => $selectedYear,
        ]);

        if ($requestedMonth !== null) {
            $chartUrl = route('chart.month', [
                'game' => $gameModel->legacy_id ?: $gameModel->slug,
                'year' => $selectedYear,
                'month' => $requestedMonth,
            ]);
        }

        $seo = $this->seoService->forModel($gameModel, [
            'title' => $gameModel->name . ' Result & Chart ' . $selectedYear,
            'description' => 'View ' . $gameModel->name . ' result and historical chart for ' . $selectedYear . '.',
            'canonical' => $chartUrl,
            'schema_type' => 'WebPage',
        ]);

        return view('public.chart', [
            'game' => $gameModel,
            'chartEntries' => $chartEntries,
            'liveResults' => $liveResults,
            'results' => $liveResults,
            'availableYears' => $availableYears,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $requestedMonth,
            'currentYear' => $currentYear,
            'currentMonth' => now()->month,
            'currentDay' => now()->day,
            'months' => $this->months(),
            'seo' => $seo,
        ]);
    }

    protected function yearlyIndex()
    {
        $games = Game::query()
            ->select(['id', 'city_id', 'name', 'slug', 'legacy_id', 'display_order', 'active'])
            ->with('city:id,name')
            ->where('active', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        // Year lists change rarely compared with live result rows, so keep only
        // this small metadata cache for a few minutes.
        $availableYears = Cache::remember('public:chart:available-years', now()->addMinutes(5), function () {
            $years = ChartWeek::query()
                ->selectRaw('YEAR(week_start) AS year')
                ->distinct()
                ->pluck('year')
                ->map(fn ($year) => (int) $year)
                ->filter(fn ($year) => $year > 0)
                ->toArray();

            $years = array_merge($years, GameResult::query()
                ->selectRaw('YEAR(result_date) AS year')
                ->distinct()
                ->pluck('year')
                ->map(fn ($year) => (int) $year)
                ->filter(fn ($year) => $year > 0)
                ->toArray());

            $years[] = now()->year;
            $years = array_values(array_unique($years));
            rsort($years);

            return $years;
        });

        $seo = [
            'title' => 'Satta Chart - Yearly Historical Results',
            'description' => 'Browse yearly satta charts and historical results for all available games.',
            'focus_keyword' => 'satta chart',
            'secondary_keywords' => 'satta result chart, historical satta chart',
            'canonical' => route('chart'),
            'robots' => 'index,follow',
            'og_title' => 'Satta Chart - Yearly Historical Results',
            'og_description' => 'Browse yearly satta charts and historical results for all available games.',
            'og_image' => null,
            'twitter_title' => 'Satta Chart - Yearly Historical Results',
            'twitter_description' => 'Browse yearly satta charts and historical results for all available games.',
            'twitter_image' => null,
            'schema_type' => 'WebPage',
            'schema_json' => null,
        ];

        return view('public.chart-index', compact('games', 'availableYears', 'seo'));
    }

    protected function availableYearsForGame(int $gameId, int $currentYear): array
    {
        return Cache::remember("public:chart:years:{$gameId}", now()->addMinutes(5), function () use ($gameId, $currentYear) {
            $chartYears = ChartWeek::query()
                ->where('game_id', $gameId)
                ->selectRaw('YEAR(week_start) AS year')
                ->distinct()
                ->pluck('year')
                ->map(fn ($year) => (int) $year)
                ->filter(fn ($year) => $year > 0)
                ->toArray();

            $resultYears = GameResult::query()
                ->where('game_id', $gameId)
                ->selectRaw('YEAR(result_date) AS year')
                ->distinct()
                ->pluck('year')
                ->map(fn ($year) => (int) $year)
                ->filter(fn ($year) => $year > 0)
                ->toArray();

            $years = array_values(array_unique(array_merge($chartYears, $resultYears, [$currentYear])));
            rsort($years);

            return $years;
        });
    }

    protected function months(): array
    {
        return [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];
    }
}
