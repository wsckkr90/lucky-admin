<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Services\ChartScraperService;
use Illuminate\Console\Command;

class RunChartScraper extends Command
{
    protected $signature = 'scraper:charts
                            {--game= : Game ID}
                            {--all : Run all configured games}';

    protected $description =
        'Scrape historical chart data';

    public function handle(
        ChartScraperService $service
    ): int {
        $query = Game::query()
            ->where('active', true)
            ->whereNotNull('chart_url')
            ->where('chart_url', '!=', '');

        if ($this->option('game')) {
            $query->where(
                'id',
                $this->option('game')
            );
        } elseif (!$this->option('all')) {
            $query->limit(1);
        }

        $games = $query
            ->orderBy('display_order')
            ->get();

        if ($games->isEmpty()) {
            $this->warn(
                'No games with chart URLs configured.'
            );

            return self::SUCCESS;
        }

        foreach ($games as $game) {

            $this->info(
                "Scraping chart: {$game->name}"
            );

            try {

                $stats =
                    $service->scrape($game);

                $this->line(
                    "Weeks: {$stats['weeks']}"
                );

                $this->line(
                    "Entries: {$stats['entries']}"
                );

            } catch (\Throwable $e) {

                $this->error(
                    $e->getMessage()
                );

                report($e);
            }
        }

        return self::SUCCESS;
    }
}
