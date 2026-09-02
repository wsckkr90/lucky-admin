<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMXPath;
use RuntimeException;

class ScraperParserService
{
    public function __construct(
        protected LegacyGameKeyService $gameKeys
    ) {
    }

    /**
     * Parse legacy homepage HTML.
     */
    public function parseLiveHtml(
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
                'Unable to parse source HTML.'
            );
        }

        $xpath = new DOMXPath($dom);

        /*
        |--------------------------------------------------------------------------
        | Legacy scraper first checks tables.
        |--------------------------------------------------------------------------
        */

        $tables = $xpath->query(
            "//table[contains(@class, 'table-hover') or contains(@class, 'table-bordered')]"
        );

        if ($tables && $tables->length > 0) {
            return $this->parseTableLayout(
                $tables
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DPBoss-style layout.
        |--------------------------------------------------------------------------
        */

        $elements = $xpath->query(
            "//div[contains(@class, 'tkt-val')]/div"
        );

        $layout = 'dpboss';

        if (!$elements || $elements->length === 0) {

            $elements = $xpath->query(
                "//div[contains(@class, 'tkt-val')]//div[h4 and span]"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Sitarabazar-style layout.
        |--------------------------------------------------------------------------
        */

        if (!$elements || $elements->length === 0) {

            $elements = $xpath->query(
                "//div[contains(@class, 'fix')]"
            );

            $layout = 'sitarabazar';
        }

        if (!$elements || $elements->length === 0) {
            throw new RuntimeException(
                'No supported result layout was found.'
            );
        }

        return $this->parseCardLayout(
            $elements,
            $layout
        );
    }

    protected function parseTableLayout(
        $tables
    ): array {
        $records = [];

        foreach ($tables as $table) {

            /** @var DOMElement $table */

            $rows = $table->getElementsByTagName('tr');

            foreach ($rows as $row) {

                $tds = $row->getElementsByTagName('td');

                if ($tds->length < 2) {
                    continue;
                }

                $rawNameTime = $this->cleanText(
                    $tds->item(0)->textContent
                );

                if (
                    str_contains(
                        $rawNameTime,
                        'सट्टा का नाम'
                    )
                    ||
                    strcasecmp(
                        $rawNameTime,
                        'Date'
                    ) === 0
                    ||
                    preg_match(
                        '/^\d{2}-\d{2}$/',
                        $rawNameTime
                    )
                ) {
                    continue;
                }

                $yesterday =
                    $this->cleanText(
                        $tds->item(1)->textContent
                    );

                $today =
                    $tds->length >= 3
                        ? $this->cleanText(
                            $tds->item(2)->textContent
                        )
                        : '';

                $result =
                    $today !== ''
                        ? $today
                        : $yesterday;

                if ($result === '') {
                    continue;
                }

                $gameName = $rawNameTime;

                $openTime = null;

                if (
                    preg_match(
                        '/^(.*?)\s+(\d{1,2}:\d{2}\s*(?:AM|PM))$/i',
                        $rawNameTime,
                        $matches
                    )
                ) {
                    $gameName =
                        trim($matches[1]);

                    $openTime =
                        trim($matches[2]);
                }

                $legacyKey =
                    $this->gameKeys->fromName(
                        $gameName
                    );

                $records[] = [
                    'game' => $legacyKey,
                    'game_name' => $gameName,
                    'result' => $result,
                    'open_time' => $openTime,
                    'close_time' => null,
                ];
            }
        }

        return $records;
    }

    protected function parseCardLayout(
        $elements,
        string $layout
    ): array {
        $records = [];

        foreach ($elements as $element) {

            /** @var DOMElement $element */

            $gameName = '';
            $result = '';
            $timing = '';

            if ($layout === 'dpboss') {

                $h4s =
                    $element->getElementsByTagName('h4');

                $spans =
                    $element->getElementsByTagName('span');

                $ps =
                    $element->getElementsByTagName('p');

                if (
                    $h4s->length > 0 &&
                    $spans->length > 0
                ) {
                    $gameName =
                        $this->cleanText(
                            $h4s->item(0)->textContent
                        );

                    $result =
                        $this->cleanText(
                            $spans->item(0)->textContent
                        );

                    $timing =
                        $ps->length > 0
                            ? $this->cleanText(
                                $ps->item(0)->textContent
                            )
                            : '';
                }

            } else {

                $spans =
                    $element->getElementsByTagName('span');

                if ($spans->length >= 2) {

                    $gameName =
                        $this->cleanText(
                            $spans->item(0)->textContent
                        );

                    $result =
                        $this->cleanText(
                            $spans->item(1)->textContent
                        );

                    $timing =
                        $spans->length >= 3
                            ? $this->cleanText(
                                $spans->item(2)->textContent
                            )
                            : '';
                }
            }

            if (
                $gameName === '' ||
                $result === ''
            ) {
                continue;
            }

            $legacyKey =
                $this->gameKeys->fromName(
                    $gameName
                );

            [
                $openTime,
                $closeTime
            ] = $this->parseTiming(
                $timing
            );

            $records[] = [
                'game' => $legacyKey,
                'game_name' => $gameName,
                'result' => $result,
                'open_time' => $openTime,
                'close_time' => $closeTime,
            ];
        }

        return $records;
    }

    protected function parseTiming(
        string $timing
    ): array {
        if ($timing === '') {
            return [null, null];
        }

        $clean = str_replace(
            ['(', ')'],
            '',
            $timing
        );

        $clean = html_entity_decode(
            $clean,
            ENT_QUOTES,
            'UTF-8'
        );

        $clean = preg_replace(
            '/\s+/',
            ' ',
            $clean
        );

        $clean = trim($clean);

        if (
            preg_match_all(
                '/\d{1,2}:\d{2}\s*(?:AM|PM)/i',
                $clean,
                $matches
            )
        ) {
            return [
                $matches[0][0] ?? null,
                $matches[0][1] ?? null,
            ];
        }

        return [null, null];
    }

    protected function cleanText(
        string $value
    ): string {
        $value = html_entity_decode(
            $value,
            ENT_QUOTES,
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
            )
        );
    }
}
