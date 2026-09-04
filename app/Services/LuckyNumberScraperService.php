<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class LuckyNumberScraperService
{
    public function __construct(
        protected SettingsService $settings
    ) {
    }

    /**
     * Scrape Lucky Ank and Final Ank from the configured target website.
     */
    public function scrape(): array
    {
        $startedAt = now();

        try {
            /*
            |--------------------------------------------------------------------------
            | Auto scrape check
            |--------------------------------------------------------------------------
            */

            $enabled = $this->settings->get(
                'auto_scrape_lucky',
                true
            );

            if (!$enabled) {
                return [
                    'success' => false,
                    'skipped' => true,
                    'lucky_ank' => null,
                    'final_ank' => null,
                    'message' => 'Lucky Numbers auto-scrape is disabled.',
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | Target URL
            |--------------------------------------------------------------------------
            */

            $targetUrl = trim(
                (string) $this->settings->get(
                    'scraper.target_url',
                    ''
                )
            );

            if (
                $targetUrl === '' ||
                !filter_var(
                    $targetUrl,
                    FILTER_VALIDATE_URL
                )
            ) {
                throw new RuntimeException(
                    'Invalid scraper target URL.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Fetch page
            |--------------------------------------------------------------------------
            */

            $response = Http::timeout(20)
                ->connectTimeout(10)
                ->retry(2, 500)
                ->withOptions([
                    'allow_redirects' => true,
                    'verify' => false,
                ])
                ->withHeaders([
                    'Accept' =>
                        'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',

                    'Accept-Language' =>
                        'en-US,en;q=0.9',

                    'Cache-Control' =>
                        'no-cache',

                    'Pragma' =>
                        'no-cache',

                    'User-Agent' =>
                        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0.0.0 Safari/537.36',

                    'Referer' =>
                        $targetUrl,
                ])
                ->get($targetUrl);

            if (!$response->successful()) {
                throw new RuntimeException(
                    "HTTP {$response->status()} returned from {$targetUrl}"
                );
            }

            $html = $response->body();

            if (trim($html) === '') {
                throw new RuntimeException(
                    'Target website returned an empty response.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Parse HTML
            |--------------------------------------------------------------------------
            */

            [$luckyAnk, $finalAnk] = $this->parseLuckyNumbers(
                $html
            );

            /*
            |--------------------------------------------------------------------------
            | Save values
            |--------------------------------------------------------------------------
            */

            $this->settings->set(
                'lucky_ank',
                $luckyAnk,
                'results',
                'string'
            );

            $this->settings->set(
                'final_ank',
                $finalAnk,
                'results',
                'string'
            );

            /*
            |--------------------------------------------------------------------------
            | Save scraper status
            |--------------------------------------------------------------------------
            */

            $message =
                'Lucky Numbers scraped successfully.';

            $this->settings->set(
                'lucky_scraper.last_run',
                now()->toDateTimeString(),
                'results',
                'string'
            );

            $this->settings->set(
                'lucky_scraper.last_status',
                'success',
                'results',
                'string'
            );

            $this->settings->set(
                'lucky_scraper.last_message',
                $message,
                'results',
                'string'
            );

            Log::info(
                'Lucky Numbers scraper completed',
                [
                    'target_url' => $targetUrl,
                    'lucky_ank' => $luckyAnk,
                    'final_ank' => $finalAnk,
                    'started_at' => $startedAt->toDateTimeString(),
                    'completed_at' => now()->toDateTimeString(),
                ]
            );

            return [
                'success' => true,
                'skipped' => false,
                'lucky_ank' => $luckyAnk,
                'final_ank' => $finalAnk,
                'message' => $message,
            ];

        } catch (\Throwable $e) {

            $message =
                'Lucky Numbers scrape failed: ' .
                $e->getMessage();

            $this->settings->set(
                'lucky_scraper.last_run',
                now()->toDateTimeString(),
                'results',
                'string'
            );

            $this->settings->set(
                'lucky_scraper.last_status',
                'failed',
                'results',
                'string'
            );

            $this->settings->set(
                'lucky_scraper.last_message',
                $message,
                'results',
                'string'
            );

            Log::error(
                'Lucky Numbers scraper failed',
                [
                    'error' => $e->getMessage(),
                    'target_url' =>
                        $this->settings->get(
                            'scraper.target_url'
                        ),
                ]
            );

            return [
                'success' => false,
                'skipped' => false,
                'lucky_ank' => null,
                'final_ank' => null,
                'message' => $message,
            ];
        }
    }

    /**
     * Parse Lucky Ank and Final Ank from legacy .menu3 markup.
     *
     * Legacy scraper:
     * .menu3
     *   td[0]
     *   td[1]
     *   td[2] = Lucky Ank
     *   td[3] = Final Ank
     */
    protected function parseLuckyNumbers(
        string $html
    ): array {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();

        if (
            !$dom->loadHTML(
                '<?xml encoding="UTF-8">' . $html
            )
        ) {
            throw new RuntimeException(
                'Unable to parse target HTML.'
            );
        }

        $xpath = new \DOMXPath($dom);

        $menu3List = $xpath->query(
            "//div[contains(concat(' ', normalize-space(@class), ' '), ' menu3 ')]"
        );

        if (!$menu3List || $menu3List->length === 0) {
            throw new RuntimeException(
                'Lucky Numbers container (.menu3) was not found.'
            );
        }

        $menu3 = $menu3List->item(0);

        $tds = $menu3->getElementsByTagName('td');

        if ($tds->length < 4) {
            throw new RuntimeException(
                'Lucky Numbers table does not contain the required values.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Exact legacy mapping
        |--------------------------------------------------------------------------
        |
        | td[2] => Lucky Ank
        | td[3] => Final Ank
        |
        */

        $luckyAnk = $this->cleanValue(
            $tds->item(2)->textContent
        );

        $finalAnk = $this->cleanValue(
            $tds->item(3)->textContent
        );

        if ($luckyAnk === '') {
            throw new RuntimeException(
                'Lucky Ank value was empty.'
            );
        }

        if ($finalAnk === '') {
            throw new RuntimeException(
                'Final Ank value was empty.'
            );
        }

        return [
            $luckyAnk,
            $finalAnk,
        ];
    }

    /**
     * Normalize scraped text.
     */
    protected function cleanValue(
        ?string $value
    ): string {
        $value = html_entity_decode(
            (string) $value,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $value = preg_replace(
            '/\s+/u',
            ' ',
            $value
        );

        return trim($value);
    }
}
