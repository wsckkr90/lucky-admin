<?php

namespace App\Services;

use App\Models\Game;
use App\Models\GameResult;
use App\Models\ScraperRun;
use App\Models\ScraperSource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ScraperService
{
    public function __construct(
        protected ResultService $resultService,
        protected ScraperParserService $parser,
        protected SettingsService $settings
    ) {
    }

    /**
     * Run one configured live-result scraper source.
     */
    public function run(
        ScraperSource $source
    ): ScraperRun {
        $run = ScraperRun::create([
            'scraper_source_id' => $source->id,
            'started_at' => now(),
            'status' => 'running',

            'records_found' => 0,
            'records_accepted' => 0,
            'records_rejected' => 0,
            'records_changed' => 0,

            'error_count' => 0,
        ]);

        try {

            /*
            |--------------------------------------------------------------------------
            | Global scraper target comes from MySQL settings.
            |--------------------------------------------------------------------------
            */

            $targetUrl = $this->settings->get(
                'scraper.target_url'
            );

            /*
            |--------------------------------------------------------------------------
            | Fall back to the source URL if no global target exists.
            |--------------------------------------------------------------------------
            */

            if (!$targetUrl) {
                $targetUrl = $source->url;
            }

            $targetUrl = trim(
                (string) $targetUrl
            );

            if (
                $targetUrl === '' ||
                !filter_var(
                    $targetUrl,
                    FILTER_VALIDATE_URL
                )
            ) {
                throw new RuntimeException(
                    "Invalid scraper target URL: {$targetUrl}"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Source URL can optionally override the global target.
            |--------------------------------------------------------------------------
            |
            | If scraper source is an absolute URL, use it directly.
            | Otherwise treat it as a path under target_url.
            |--------------------------------------------------------------------------
            */

            $url = $this->buildSourceUrl(
                $targetUrl,
                $source->url
            );

            /*
            |--------------------------------------------------------------------------
            | Request headers.
            |--------------------------------------------------------------------------
            */

            $headers = [
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
            ];

            /*
            |--------------------------------------------------------------------------
            | Merge custom headers from scraper_sources.
            |--------------------------------------------------------------------------
            */

            if (
                is_array($source->headers)
            ) {
                $headers = array_merge(
                    $headers,
                    $source->headers
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Make request.
            |--------------------------------------------------------------------------
            */

            $http = Http::timeout(20)
                ->connectTimeout(10)
                ->retry(2, 500)
                ->withOptions([
                    'allow_redirects' => true,

                    /*
                    | Some older local/hosted source sites have certificate
                    | configuration problems. This can be enabled/disabled
                    | later in production depending on the source.
                    */
                    'verify' => false,
                ])
                ->withHeaders($headers);

            $method = strtoupper(
                $source->method ?: 'GET'
            );

            if ($method === 'POST') {

                $payload = [];

                if (
                    is_array($source->config) &&
                    isset(
                        $source->config['post_data']
                    ) &&
                    is_array(
                        $source->config['post_data']
                    )
                ) {
                    $payload =
                        $source->config['post_data'];
                }

                $response = $http->post(
                    $url,
                    $payload
                );

            } else {

                $response = $http->get(
                    $url
                );
            }

            /*
            |--------------------------------------------------------------------------
            | HTTP validation.
            |--------------------------------------------------------------------------
            */

            if (!$response->successful()) {
                throw new RuntimeException(
                    "HTTP {$response->status()} returned from {$url}"
                );
            }

            $body = $response->body();

            if (
                trim($body) === ''
            ) {
                throw new RuntimeException(
                    'Scraper source returned an empty response.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Parse the live HTML.
            |--------------------------------------------------------------------------
            */

            $records =
                $this->parser->parseLiveHtml(
                    $body
                );

            if (!is_array($records)) {
                throw new RuntimeException(
                    'Scraper parser did not return an array.'
                );
            }

            $found = count(
                $records
            );

            $accepted = 0;
            $rejected = 0;
            $changed = 0;

            /*
            |--------------------------------------------------------------------------
            | Process every parsed game.
            |--------------------------------------------------------------------------
            */

            foreach ($records as $record) {

                if (!is_array($record)) {
                    $rejected++;
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Required game key.
                |--------------------------------------------------------------------------
                */

                $gameKey = trim(
                    (string) (
                        $record['game']
                        ?? ''
                    )
                );

                /*
                |--------------------------------------------------------------------------
                | Required result.
                |--------------------------------------------------------------------------
                */

                $result = trim(
                    (string) (
                        $record['result']
                        ?? ''
                    )
                );

                if (
                    $gameKey === '' ||
                    $result === ''
                ) {
                    $rejected++;
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Find matching Laravel game.
                |--------------------------------------------------------------------------
                */

                $game = Game::query()
                    ->where(
                        'legacy_id',
                        $gameKey
                    )
                    ->orWhere(
                        'slug',
                        $gameKey
                    )
                    ->first();

                if (!$game) {
                    $rejected++;

                    Log::warning(
                        'Scraper game not found',
                        [
                            'source_id' =>
                                $source->id,

                            'game_key' =>
                                $gameKey,

                            'result' =>
                                $result,
                        ]
                    );

                    continue;
                }

                try {

                    DB::transaction(
                        function () use (
                            $game,
                            $record,
                            $result,
                            &$changed
                        ) {
                            /*
                            |--------------------------------------------------------------------------
                            | Update game timing when source provides it.
                            |--------------------------------------------------------------------------
                            */

                            $this->updateGameTiming(
                                $game,
                                $record
                            );

                            /*
                            |--------------------------------------------------------------------------
                            | Find today's existing result.
                            |--------------------------------------------------------------------------
                            */

                            $existing =
                                GameResult::query()
                                    ->where(
                                        'game_id',
                                        $game->id
                                    )
                                    ->whereDate(
                                        'result_date',
                                        today()
                                    )
                                    ->first();

                            $oldResult =
                                $existing?->result;

                            /*
                            |--------------------------------------------------------------------------
                            | Send result through ResultService.
                            |--------------------------------------------------------------------------
                            |
                            | This is the single application entry point for
                            | writing live results.
                            |--------------------------------------------------------------------------
                            */

                            $this->resultService->upsertToday(
                                $game->id,
                                [
                                    'result' =>
                                        $result,

                                    /*
                                    | The legacy live source exposes the
                                    | displayed result as the primary value.
                                    |
                                    | Only use separate Jodi if the parser
                                    | explicitly gives us one.
                                    */
                                    'jodi' =>
                                        $record['jodi']
                                        ?? $result,

                                    'open_panna' =>
                                        $record['open_panna']
                                        ?? null,

                                    'close_panna' =>
                                        $record['close_panna']
                                        ?? null,

                                    'source' =>
                                        'scraper',

                                    'status' =>
                                        'published',
                                ]
                            );

                            /*
                            |--------------------------------------------------------------------------
                            | Check whether the stored result actually changed.
                            |--------------------------------------------------------------------------
                            */

                            $updated =
                                GameResult::query()
                                    ->where(
                                        'game_id',
                                        $game->id
                                    )
                                    ->whereDate(
                                        'result_date',
                                        today()
                                    )
                                    ->first();

                            if (
                                $oldResult !==
                                $updated?->result
                            ) {
                                $changed++;
                            }
                        }
                    );

                    $accepted++;

                } catch (\Throwable $e) {

                    $rejected++;

                    Log::warning(
                        'Scraper result rejected',
                        [
                            'source_id' =>
                                $source->id,

                            'game_id' =>
                                $game->id,

                            'game_key' =>
                                $gameKey,

                            'result' =>
                                $result,

                            'error' =>
                                $e->getMessage(),
                        ]
                    );
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Determine final run status.
            |--------------------------------------------------------------------------
            */

            $status = 'success';

            if (
                $rejected > 0 &&
                $accepted > 0
            ) {
                $status = 'partial';

            } elseif (
                $rejected > 0 &&
                $accepted === 0
            ) {
                $status = 'failed';
            }

            /*
            |--------------------------------------------------------------------------
            | Save run statistics.
            |--------------------------------------------------------------------------
            */

            $run->update([
                'completed_at' =>
                    now(),

                'status' =>
                    $status,

                'records_found' =>
                    $found,

                'records_accepted' =>
                    $accepted,

                'records_rejected' =>
                    $rejected,

                'records_changed' =>
                    $changed,

                'error_count' =>
                    $rejected,

                'message' =>
                    "Found {$found}, accepted {$accepted}, rejected {$rejected}, changed {$changed}.",
            ]);

            /*
            |--------------------------------------------------------------------------
            | Store scraper last-run timestamp in MySQL settings.
            |--------------------------------------------------------------------------
            */

            $this->settings->set(
                'scraper.last_run',
                now()->toDateTimeString(),
                'scraper',
                'string'
            );

        } catch (\Throwable $e) {

            Log::error(
                'Legacy scraper failed',
                [
                    'source_id' =>
                        $source->id,

                    'source_name' =>
                        $source->name,

                    'error' =>
                        $e->getMessage(),
                ]
            );

            $run->update([
                'completed_at' =>
                    now(),

                'status' =>
                    'failed',

                'error_count' =>
                    1,

                'response_error' =>
                    $e->getMessage(),

                'message' =>
                    $e->getMessage(),
            ]);
        }

        return $run->fresh();
    }

    /**
     * Build the actual request URL.
     */
    protected function buildSourceUrl(
        string $targetUrl,
        string $sourceUrl
    ): string {
        $sourceUrl = trim(
            $sourceUrl
        );

        /*
        |--------------------------------------------------------------------------
        | Absolute source URL.
        |--------------------------------------------------------------------------
        */

        if (
            filter_var(
                $sourceUrl,
                FILTER_VALIDATE_URL
            )
        ) {
            return $sourceUrl;
        }

        /*
        |--------------------------------------------------------------------------
        | Relative source path.
        |--------------------------------------------------------------------------
        */

        if ($sourceUrl === '') {
            return $targetUrl;
        }

        return rtrim(
            $targetUrl,
            '/'
        ) . '/' . ltrim(
            $sourceUrl,
            '/'
        );
    }

    /**
     * Update game's opening/closing times when available.
     */
    protected function updateGameTiming(
        Game $game,
        array $record
    ): void {
        $updates = [];

        if (
            !empty($record['open_time'])
        ) {
            $openTime =
                trim(
                    (string)
                    $record['open_time']
                );

            if (
                $game->open_time !==
                $openTime
            ) {
                $updates['open_time'] =
                    $openTime;
            }
        }

        if (
            !empty($record['close_time'])
        ) {
            $closeTime =
                trim(
                    (string)
                    $record['close_time']
                );

            if (
                $game->close_time !==
                $closeTime
            ) {
                $updates['close_time'] =
                    $closeTime;
            }
        }

        if (!empty($updates)) {
            $game->update(
                $updates
            );
        }
    }
}
