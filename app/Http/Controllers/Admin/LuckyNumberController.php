<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LuckyNumberScraperService;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class LuckyNumberController extends Controller
{
    public function __construct(
        protected SettingsService $settings,
        protected LuckyNumberScraperService $scraper
    ) {
    }

    public function index()
    {
        $autoScrapeLucky = (bool) $this->settings->get(
            'auto_scrape_lucky',
            true
        );

        $luckyAnk = (string) $this->settings->get(
            'lucky_ank',
            '( 0-2-3-4 )'
        );

        $finalAnk = (string) $this->settings->get(
            'final_ank',
            'K-0, M-8'
        );

        $targetUrl = (string) $this->settings->get(
            'scraper.target_url',
            ''
        );

        $lastRun = (string) $this->settings->get(
            'lucky_scraper.last_run',
            ''
        );

        $lastStatus = (string) $this->settings->get(
            'lucky_scraper.last_status',
            ''
        );

        $lastMessage = (string) $this->settings->get(
            'lucky_scraper.last_message',
            ''
        );

        return view(
            'admin.lucky-numbers.index',
            compact(
                'autoScrapeLucky',
                'luckyAnk',
                'finalAnk',
                'targetUrl',
                'lastRun',
                'lastStatus',
                'lastMessage'
            )
        );
    }

    public function update(
        Request $request
    ) {
        $validated = $request->validate([
            'auto_scrape_lucky' => [
                'nullable',
                'boolean',
            ],

            'lucky_ank' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'final_ank' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $this->settings->set(
            'auto_scrape_lucky',
            $request->boolean(
                'auto_scrape_lucky'
            ),
            'results',
            'boolean'
        );

        $this->settings->set(
            'lucky_ank',
            $validated['lucky_ank'] ?? '',
            'results',
            'string'
        );

        $this->settings->set(
            'final_ank',
            $validated['final_ank'] ?? '',
            'results',
            'string'
        );

        return redirect()
            ->route(
                'admin.lucky-numbers.index'
            )
            ->with(
                'success',
                'Lucky Numbers settings updated successfully.'
            );
    }

    public function scrapeNow()
    {
        $result = $this->scraper->scrape();

        if (
            ($result['skipped'] ?? false) === true
        ) {
            return redirect()
                ->route(
                    'admin.lucky-numbers.index'
                )
                ->with(
                    'error',
                    $result['message']
                );
        }

        if (!$result['success']) {
            return redirect()
                ->route(
                    'admin.lucky-numbers.index'
                )
                ->with(
                    'error',
                    $result['message']
                );
        }

        return redirect()
            ->route(
                'admin.lucky-numbers.index'
            )
            ->with(
                'success',
                'Lucky Numbers scraped successfully.'
            );
    }
}
