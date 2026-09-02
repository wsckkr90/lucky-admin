<?php

namespace App\Console\Commands;

use App\Models\ScraperSource;
use App\Services\ScraperScheduleService;
use App\Services\ScraperService;
use Illuminate\Console\Command;

class RunScraper extends Command
{
    protected $signature = 'scraper:run
                            {--source= : Source ID}
                            {--all : Run all active sources}
                            {--force : Ignore declaration timing}';

    protected $description =
        'Run the configured result scraper';

    public function handle(
        ScraperService $scraperService,
        ScraperScheduleService $schedule
    ): int {
        if (
            !$schedule->shouldRun(
                $this->option('force')
            )
        ) {
            $this->info(
                'Scrape skipped: outside declaration window or recently executed.'
            );

            return self::SUCCESS;
        }

        $query = ScraperSource::query()
            ->where('active', true)
            ->orderBy('priority');

        if ($this->option('source')) {

            $query->where(
                'id',
                $this->option('source')
            );

        } elseif (!$this->option('all')) {

            $query->limit(1);
        }

        $sources = $query->get();

        if ($sources->isEmpty()) {

            $this->warn(
                'No active scraper source found.'
            );

            return self::SUCCESS;
        }

        foreach ($sources as $source) {

            $this->info(
                "Scraping {$source->name}"
            );

            $run =
                $scraperService->run(
                    $source
                );

            $this->line(
                "Status: {$run->status}"
            );

            $this->line(
                $run->message ?? ''
            );
        }

        return self::SUCCESS;
    }
}
