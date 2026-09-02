<?php

namespace App\Services;

use App\Models\ChartEntry;
use App\Models\ChartWeek;
use App\Models\Game;
use Carbon\Carbon;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ChartScraperService
{
    /**
     * Weekday offsets from Monday.
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

    /**
     * Scrape and store historical chart data.
     */
    public function scrape(Game $game): array
    {
        $targetUrl = config(
            'services.scraper.target_url'
        );

        if (!$targetUrl) {
            throw new RuntimeException(
                'Scraper target URL is not configured.'
            );
        }

        $targetUrl = trim($targetUrl);

        if (!filter_var(
            $targetUrl,
            FILTER_VALIDATE_URL
        )) {
            throw new RuntimeException(
                "Invalid scraper target URL: {$targetUrl}"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Game chart path
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | chart.php?game=alwar-bazar
        |
        |--------------------------------------------------------------------------
        */

        $chartPath = trim(
            (string) $game->chart_url
        );

        if ($chartPath === '') {
            throw new RuntimeException(
                "No historical chart URL configured for {$game->name}."
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Special legacy Dpboss source.
        |--------------------------------------------------------------------------
        */

        if (str_contains(
            strtolower($targetUrl),
            'dpbossss.boston'
        )) {
            $gameKey =
                $game->legacy_id
                ?: $game->slug;

            $url =
                rtrim($targetUrl, '/')
                . '/panel-chart-record/'
                . $gameKey
                . '.php';
        } else {
            $url =
                rtrim($targetUrl, '/')
                . '/'
                . ltrim($chartPath, '/');
        }

        if (!filter_var(
            $url,
            FILTER_VALIDATE_URL
        )) {
            throw new RuntimeException(
                "Invalid chart URL generated for {$game->name}: {$url}"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Request the external chart page.
        |--------------------------------------------------------------------------
        */

        $response = Http::timeout(30)
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
                    rtrim($targetUrl, '/'),
            ])
            ->get($url);

        if (!$response->successful()) {
            throw new RuntimeException(
                "Chart source returned HTTP {$response->status()} for {$url}"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Keep a debug copy while the source parser is being verified.
        |--------------------------------------------------------------------------
        */

        file_put_contents(
            storage_path('app/chart-debug.html'),
            $response->body()
        );

        /*
        |--------------------------------------------------------------------------
        | Parse and save.
        |--------------------------------------------------------------------------
        */

        return $this->parseAndStore(
            $game,
            $response->body()
        );
    }

    /**
     * Parse normalized weekly data and save to MySQL.
     */
    protected function parseAndStore(
        Game $game,
        string $html
    ): array {
        $weeks = $this->parseHtml($html);

        $weekCount = 0;
        $entryCount = 0;

        foreach ($weeks as $weekData) {

            if (!is_array($weekData)) {
                continue;
            }

            $range = $this->parseWeekRange(
                $weekData['week'] ?? ''
            );

            if (!$range) {
                continue;
            }

            $week = ChartWeek::updateOrCreate(
                [
                    'game_id' =>
                        $game->id,

                    'week_start' =>
                        $range['start']
                            ->toDateString(),

                    'week_end' =>
                        $range['end']
                            ->toDateString(),
                ]
            );

            $weekCount++;

            $days = $weekData['days'] ?? [];

            if (!is_array($days)) {
                continue;
            }

            foreach (
                $days as $dayName => $values
            ) {

                $dayName = strtolower(
                    trim((string) $dayName)
                );

                if (!array_key_exists(
                    $dayName,
                    $this->dayOffsets
                )) {
                    continue;
                }

                if (!is_array($values)) {
                    continue;
                }

                $date = $range['start']
                    ->copy()
                    ->addDays(
                        $this->dayOffsets[$dayName]
                    );

                /*
                |--------------------------------------------------------------------------
                | Open
                |--------------------------------------------------------------------------
                */

                $open = $this->normalize(
                    $values['open'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | Jodi
                |--------------------------------------------------------------------------
                */

                $jodi = $this->normalize(
                    $values['jodi'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | Close
                |--------------------------------------------------------------------------
                */

                $close = $this->normalize(
                    $values['close'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | Legacy chart result = Jodi.
                |--------------------------------------------------------------------------
                */

                $result = $jodi;

                ChartEntry::updateOrCreate(
                    [
                        'chart_week_id' =>
                            $week->id,

                        'result_date' =>
                            $date->toDateString(),
                    ],
                    [
                        'day_of_week' =>
                            $date->dayOfWeek,

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

        if (
            $weekCount === 0 &&
            $entryCount === 0
        ) {
            throw new RuntimeException(
                "No historical weekly chart data could be parsed for {$game->name}."
            );
        }

        return [
            'weeks' =>
                $weekCount,

            'entries' =>
                $entryCount,
        ];
    }

    /**
     * Parse the external chart HTML.
     *
     * IMPORTANT:
     * We specifically require a weekly date range such as:
     *
     * 27/07/26 to 01/08/26
     *
     * We do not treat the current monthly public chart as a historical
     * weekly source.
     */
    protected function parseHtml(
        string $html
    ): array {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();

        $loaded = $dom->loadHTML(
            '<?xml encoding="UTF-8">' . $html
        );

        libxml_clear_errors();

        if (!$loaded) {
            throw new RuntimeException(
                'Unable to parse chart HTML.'
            );
        }

        $xpath = new DOMXPath($dom);

        /*
        |--------------------------------------------------------------------------
        | First look for known legacy weekly chart tables.
        |--------------------------------------------------------------------------
        */

        $candidateTables = $xpath->query(
            '//table'
        );

        if (
            !$candidateTables ||
            $candidateTables->length === 0
        ) {
            throw new RuntimeException(
                'No table elements were found in the chart response.'
            );
        }

        $bestTable = null;
        $bestScore = 0;

        foreach ($candidateTables as $table) {

            if (!$table instanceof DOMElement) {
                continue;
            }

            $score = 0;

            /*
            |--------------------------------------------------------------------------
            | Table class scoring.
            |--------------------------------------------------------------------------
            */

            $class =
                strtolower(
                    trim(
                        $table->getAttribute(
                            'class'
                        )
                    )
                );

            if (str_contains(
                $class,
                'pchart'
            )) {
                $score += 20;
            }

            if (str_contains(
                $class,
                'panel-chart'
            )) {
                $score += 20;
            }

            if (str_contains(
                $class,
                'chart-table'
            )) {
                $score += 20;
            }

            /*
            |--------------------------------------------------------------------------
            | Inspect table rows for weekly date ranges.
            |--------------------------------------------------------------------------
            */

            $rows =
                $table->getElementsByTagName(
                    'tr'
                );

            foreach ($rows as $row) {

                $text = $this->cleanText(
                    $row->textContent
                );

                if ($this->looksLikeWeekRange(
                    $text
                )) {
                    $score += 50;
                }

                $cellCount =
                    $this->directCellCount(
                        $row
                    );

                if ($cellCount >= 10) {
                    $score += 5;
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestTable = $table;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | No weekly chart found.
        |--------------------------------------------------------------------------
        */

        if (
            !$bestTable ||
            $bestScore < 50
        ) {
            throw new RuntimeException(
                'The configured chart URL does not contain a supported weekly historical chart. ' .
                'The returned page appears to be a public/monthly chart or a different layout.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Parse weekly rows.
        |--------------------------------------------------------------------------
        */

        $rows =
            $bestTable->getElementsByTagName(
                'tr'
            );

        $chartData = [];

        foreach ($rows as $row) {

            if (!$row instanceof DOMElement) {
                continue;
            }

            $cells =
                $this->directCells(
                    $row
                );

            if (count($cells) < 4) {
                continue;
            }

            $dateRange =
                $this->cleanText(
                    $cells[0]->textContent
                );

            if (!$this->looksLikeWeekRange(
                $dateRange
            )) {
                continue;
            }

            $days = [
                'mon',
                'tue',
                'wed',
                'thu',
                'fri',
                'sat',
                'sun',
            ];

            $dayData = [];

            $cellIndex = 1;

            foreach ($days as $day) {

                $open = null;
                $jodi = null;
                $close = null;

                if (
                    isset($cells[$cellIndex])
                    &&
                    isset($cells[$cellIndex + 1])
                    &&
                    isset($cells[$cellIndex + 2])
                ) {
                    $open =
                        $this->cleanChartCell(
                            $cells[$cellIndex]
                                ->textContent
                        );

                    $jodi =
                        $this->cleanChartCell(
                            $cells[$cellIndex + 1]
                                ->textContent
                        );

                    $close =
                        $this->cleanChartCell(
                            $cells[$cellIndex + 2]
                                ->textContent
                        );

                    $cellIndex += 3;
                }

                $dayData[$day] = [
                    'open' =>
                        $open,

                    'jodi' =>
                        $jodi,

                    'close' =>
                        $close,
                ];
            }

            $chartData[] = [
                'week' =>
                    $dateRange,

                'days' =>
                    $dayData,
            ];
        }

        if (empty($chartData)) {
            throw new RuntimeException(
                'A historical chart table was found, but no weekly rows could be parsed.'
            );
        }

        return $chartData;
    }

    /**
     * Determine whether text contains a legacy week range.
     */
    protected function looksLikeWeekRange(
        string $text
    ): bool {
        return preg_match(
            '/\d{1,2}\s*\/\s*\d{1,2}\s*\/\s*\d{2,4}\s*to\s*\d{1,2}\s*\/\s*\d{1,2}\s*\/\s*\d{2,4}/i',
            $text
        ) === 1;
    }

    /**
     * Get direct TD/TH children.
     */
    protected function directCells(
        DOMElement $row
    ): array {
        $cells = [];

        foreach ($row->childNodes as $child) {

            if (
                !$child instanceof DOMElement
            ) {
                continue;
            }

            $tag =
                strtolower(
                    $child->tagName
                );

            if (
                $tag === 'td' ||
                $tag === 'th'
            ) {
                $cells[] = $child;
            }
        }

        return $cells;
    }

    /**
     * Count direct TD/TH children.
     */
    protected function directCellCount(
        DOMElement $row
    ): int {
        return count(
            $this->directCells($row)
        );
    }

    /**
     * Clean normal HTML text.
     */
    protected function cleanText(
        string $value
    ): string {
        $value = html_entity_decode(
            $value,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $value = str_replace(
            "\xc2\xa0",
            ' ',
            $value
        );

        return trim(
            preg_replace(
                '/\s+/',
                ' ',
                $value
            ) ?? ''
        );
    }

    /**
     * Clean individual chart cells.
     */
    protected function cleanChartCell(
        string $value
    ): ?string {
        $value = html_entity_decode(
            $value,
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $value = str_replace(
            [
                "\r",
                "\n",
                "\t",
                "\xc2\xa0",
            ],
            '',
            $value
        );

        $value = trim($value);

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
     * Parse legacy week range.
     *
     * Examples:
     *
     * 27/07/26 to 01/08/26
     * 29/12/25 to 03/01/26
     * 01/01/2026 to 03/01/2026
     */
    protected function parseWeekRange(
        string $value
    ): ?array {
        $value = trim($value);

        $value = preg_replace(
            '/\s*to\s*/i',
            ' to ',
            $value
        ) ?? '';

        if (
            !preg_match(
                '/^(.+?)\s+to\s+(.+)$/i',
                $value,
                $matches
            )
        ) {
            return null;
        }

        $start = $this->parseDate(
            trim($matches[1])
        );

        $end = $this->parseDate(
            trim($matches[2])
        );

        if (!$start || !$end) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Cross-year range.
        |--------------------------------------------------------------------------
        */

        if ($end->lt($start)) {
            $end->addYear();
        }

        return [
            'start' =>
                $start,

            'end' =>
                $end,
        ];
    }

    /**
     * Parse legacy date safely.
     *
     * Carbon can interpret "26" as year 0026 depending on how it is called,
     * so two-digit years are converted explicitly to 20xx.
     */
    protected function parseDate(
        string $value
    ): ?Carbon {
        $value = trim($value);

        /*
        |--------------------------------------------------------------------------
        | dd/mm/yy
        |--------------------------------------------------------------------------
        */

        if (preg_match(
            '/^(\d{1,2})\/(\d{1,2})\/(\d{2})$/',
            $value,
            $matches
        )) {
            $day =
                (int) $matches[1];

            $month =
                (int) $matches[2];

            $year =
                2000 + (int) $matches[3];

            try {
                return Carbon::create(
                    $year,
                    $month,
                    $day,
                    0,
                    0,
                    0
                )->startOfDay();
            } catch (\Throwable) {
                return null;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | dd/mm/yyyy
        |--------------------------------------------------------------------------
        */

        if (preg_match(
            '/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/',
            $value,
            $matches
        )) {
            $day =
                (int) $matches[1];

            $month =
                (int) $matches[2];

            $year =
                (int) $matches[3];

            try {
                return Carbon::create(
                    $year,
                    $month,
                    $day,
                    0,
                    0,
                    0
                )->startOfDay();
            } catch (\Throwable) {
                return null;
            }
        }

        return null;
    }

    /**
     * Normalize values before MySQL storage.
     */
    protected function normalize(
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
}
