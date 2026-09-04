<?php

namespace App\Console\Commands;

use App\Services\LuckyNumberScraperService;
use Illuminate\Console\Command;

class ScrapeLuckyNumbersCommand extends Command
{
    protected $signature = 'lucky-numbers:scrape';

    protected $description =
        'Scrape Lucky Ank and Final Ank from the configured target site';

    public function handle(
        LuckyNumberScraperService $scraper
    ): int {
        $this->info(
            'Starting Lucky Numbers scraper...'
        );

        $result = $scraper->scrape();

        if ($result['skipped'] ?? false) {
            $this->warn(
                $result['message']
            );

            return self::SUCCESS;
        }

        if (!$result['success']) {
            $this->error(
                $result['message']
            );

            return self::FAILURE;
        }

        $this->info(
            'Lucky Ank: ' .
            $result['lucky_ank']
        );

        $this->info(
            'Final Ank: ' .
            $result['final_ank']
        );

        $this->info(
            $result['message']
        );

        return self::SUCCESS;
    }
}
