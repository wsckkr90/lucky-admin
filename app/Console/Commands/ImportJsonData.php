<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Game;
use App\Models\GameResult;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\GameSeoContent;
use App\Models\SeoBlock;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportJsonData extends Command
{
    protected $signature = 'data:import-json
                            {--only= : Import only a specific dataset}
                            {--fresh : Update existing records from JSON}';

    protected $description =
        'Import existing JSON backend data into MySQL';

    protected string $dataPath;

    public function handle(): int
    {
        $this->dataPath = base_path('../data');

        if (!File::isDirectory($this->dataPath)) {
            $this->error(
                "JSON data directory not found: {$this->dataPath}"
            );

            return self::FAILURE;
        }

        $only = $this->option('only');

        $this->info(
            'Starting JSON → MySQL migration...'
        );

        try {
            DB::transaction(function () use ($only) {

                /*
                |--------------------------------------------------------------------------
                | Order matters
                |--------------------------------------------------------------------------
                */

                if (!$only || $only === 'cities') {
                    $this->importCities();
                }

                if (!$only || $only === 'games') {
                    $this->importGames();
                }

                if (!$only || $only === 'results') {
                    $this->importResults();
                }

                if (!$only || $only === 'blogs') {
                    $this->importBlogs();
                }

                if (!$only || $only === 'faqs') {
                    $this->importFaqs();
                }

                if (!$only || $only === 'game-seo') {
                    $this->importGameSeo();
                }

                if (!$only || $only === 'seo-blocks') {
                    $this->importSeoBlocks();
                }

                if (!$only || $only === 'settings') {
                    $this->importSettings();
                }
            });

        } catch (\Throwable $e) {

            $this->error(
                'Import failed: ' . $e->getMessage()
            );

            report($e);

            return self::FAILURE;
        }

        $this->newLine();

        $this->info(
            'JSON import completed successfully.'
        );

        return self::SUCCESS;
    }


    /*
    |--------------------------------------------------------------------------
    | JSON Helper
    |--------------------------------------------------------------------------
    */

    protected function readJson(string $filename): array
    {
        $path = $this->dataPath . DIRECTORY_SEPARATOR . $filename;

        if (!File::exists($path)) {
            $this->warn(
                "Skipping missing file: {$filename}"
            );

            return [];
        }

        $contents = File::get($path);

        $data = json_decode(
            $contents,
            true
        );

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(
                "Invalid JSON: {$filename} - " .
                json_last_error_msg()
            );
        }

        return is_array($data)
            ? $data
            : [];
    }


    /*
    |--------------------------------------------------------------------------
    | Cities
    |--------------------------------------------------------------------------
    */

    protected function importCities(): void
    {
        $this->info('Importing cities...');

        $cities = $this->readJson('cities.json');

        $count = 0;

        foreach ($cities as $key => $cityData) {

            if (is_string($cityData)) {

                $name = $cityData;

                $legacyId = (string) $key;

                $active = true;

            } else {

                $name =
                    $cityData['name']
                    ?? $cityData['title']
                    ?? (is_string($key) ? $key : 'Unnamed City');

                $legacyId =
                    $cityData['id']
                    ?? $cityData['key']
                    ?? (is_string($key) ? $key : null);

                $active =
                    array_key_exists(
                        'active',
                        $cityData
                    )
                        ? (bool) $cityData['active']
                        : true;
            }

            $legacyId = $legacyId !== null
                ? (string) $legacyId
                : null;

            $slug = Str::slug($name);

            City::updateOrCreate(
                ['legacy_id' => $legacyId],
                [
                    'name' => $name,
                    'slug' => $slug,
                    'active' => $active,
                ]
            );

            $count++;
        }

        $this->info(
            "Cities imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Games
    |--------------------------------------------------------------------------
    */

    protected function importGames(): void
    {
        $this->info('Importing games...');

        $games = $this->readJson('games.json');

        $count = 0;

        foreach ($games as $key => $gameData) {

            if (!is_array($gameData)) {
                continue;
            }

            $legacyId =
                $gameData['id']
                ?? $gameData['key']
                ?? (is_string($key) ? $key : null);

            if (!$legacyId) {
                $this->warn(
                    'Skipping game without legacy ID.'
                );

                continue;
            }

            $name =
                $gameData['name']
                ?? $gameData['title']
                ?? $legacyId;

            $cityId =
                $gameData['city_id']
                ?? $gameData['city']
                ?? null;

            $city = null;

            if ($cityId !== null) {
                $city = City::where(
                    'legacy_id',
                    (string) $cityId
                )->first();
            }

            /*
            | Some old data may use city name/key instead.
            */

            if (!$city && is_string($cityId)) {
                $city = City::where(
                    'slug',
                    Str::slug($cityId)
                )->first();
            }

            $game = Game::updateOrCreate(
                [
                    'legacy_id' => (string) $legacyId,
                ],
                [
                    'city_id' =>
                        $city?->id,

                    'name' =>
                        $name,

                    'slug' =>
                        Str::slug($name),

                    'open_time' =>
                        $this->normalizeTime(
                            $gameData['open_time']
                            ?? $gameData['open']
                            ?? null
                        ),

                    'close_time' =>
                        $this->normalizeTime(
                            $gameData['close_time']
                            ?? $gameData['close']
                            ?? null
                        ),

                    'chart_url' =>
                        $gameData['chart_url']
                        ?? $gameData['chart']
                        ?? null,

                    'active' =>
                        array_key_exists(
                            'active',
                            $gameData
                        )
                            ? (bool) $gameData['active']
                            : true,

                    'display_order' =>
                        (int) (
                            $gameData['display_order']
                            ?? $gameData['order']
                            ?? $count
                        ),
                ]
            );

            $count++;
        }

        $this->info(
            "Games imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Daily Results
    |--------------------------------------------------------------------------
    */

    protected function importResults(): void
    {
        $this->info(
            'Importing daily results...'
        );

        $results = $this->readJson(
            'daily_results.json'
        );

        $count = 0;

        foreach ($results as $date => $dayResults) {

            if (!is_array($dayResults)) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Existing structure:
            |
            | "2026-08-29": {
            |     "disawer": "31",
            |     "noida": "42"
            | }
            |--------------------------------------------------------------------------
            */

            foreach ($dayResults as $gameKey => $value) {

                $game = Game::where(
                    'legacy_id',
                    (string) $gameKey
                )->first();

                if (!$game) {
                    $this->warn(
                        "Game not found for result: {$gameKey}"
                    );

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Support both simple string results and
                | structured result objects.
                |--------------------------------------------------------------------------
                */

                $openPanna = null;
                $jodi = null;
                $closePanna = null;
                $result = null;

                if (is_array($value)) {

                    $openPanna =
                        $value['open_panna']
                        ?? $value['open']
                        ?? null;

                    $jodi =
                        $value['jodi']
                        ?? $value['result']
                        ?? null;

                    $closePanna =
                        $value['close_panna']
                        ?? $value['close']
                        ?? null;

                    $result =
                        $value['result']
                        ?? $jodi;

                } else {

                    $result = (string) $value;
                }

                GameResult::updateOrCreate(
                    [
                        'game_id' =>
                            $game->id,

                        'result_date' =>
                            $date,
                    ],
                    [
                        'open_panna' =>
                            $openPanna,

                        'jodi' =>
                            $jodi,

                        'close_panna' =>
                            $closePanna,

                        'result' =>
                            $result,

                        'source' =>
                            'import',

                        'status' =>
                            'published',
                    ]
                );

                $count++;
            }
        }

        $this->info(
            "Results imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Blogs
    |--------------------------------------------------------------------------
    */

    protected function importBlogs(): void
    {
        $this->info('Importing blogs...');

        $blogs = $this->readJson('blogs.json');

        $count = 0;

        foreach ($blogs as $blog) {

            if (!is_array($blog)) {
                continue;
            }

            $title =
                $blog['title']
                ?? 'Untitled';

            $slug =
                $blog['slug']
                ?? Str::slug($title);

            Blog::updateOrCreate(
                [
                    'slug' => $slug,
                ],
                [
                    'title' =>
                        $title,

                    'excerpt' =>
                        $blog['excerpt']
                        ?? $blog['description']
                        ?? null,

                    'content' =>
                        $blog['content']
                        ?? $blog['body']
                        ?? '',

                    'cover_text' =>
                        $blog['cover_text']
                        ?? null,

                    'cover_image' =>
                        $blog['cover_image']
                        ?? $blog['image']
                        ?? null,

                    'status' =>
                        !empty($blog['published'])
                            ? 'published'
                            : (
                                $blog['status']
                                ?? 'draft'
                            ),

                    'featured' =>
                        (bool) (
                            $blog['featured']
                            ?? false
                        ),

                    'published_at' =>
                        $blog['published_at']
                        ?? null,
                ]
            );

            $count++;
        }

        $this->info(
            "Blogs imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FAQs
    |--------------------------------------------------------------------------
    */

    protected function importFaqs(): void
    {
        $this->info('Importing FAQs...');

        $files = [
            [
                'file' => 'faqs.json',
                'scope' => 'global',
            ],
            [
                'file' => 'game_faqs.json',
                'scope' => 'game',
            ],
            [
                'file' => 'chart_faqs.json',
                'scope' => 'chart',
            ],
        ];

        $count = 0;

        foreach ($files as $source) {

            $faqs = $this->readJson(
                $source['file']
            );

            foreach ($faqs as $key => $faq) {

                if (!is_array($faq)) {
                    continue;
                }

                $gameId = null;

                if (!empty($faq['game_id'])) {
                    $gameId = Game::where(
                        'legacy_id',
                        (string) $faq['game_id']
                    )->value('id');
                }

                Faq::updateOrCreate(
                    [
                        'scope' =>
                            $source['scope'],

                        'question' =>
                            $faq['question']
                            ?? "FAQ {$key}",

                        'game_id' =>
                            $gameId,
                    ],
                    [
                        'answer' =>
                            $faq['answer']
                            ?? $faq['content']
                            ?? '',

                        'sort_order' =>
                            (int) (
                                $faq['sort_order']
                                ?? $faq['order']
                                ?? 0
                            ),

                        'active' =>
                            $faq['active']
                            ?? true,
                    ]
                );

                $count++;
            }
        }

        $this->info(
            "FAQs imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Game SEO
    |--------------------------------------------------------------------------
    */

    protected function importGameSeo(): void
    {
        $this->info(
            'Importing game SEO content...'
        );

        $seo = $this->readJson(
            'game_seo.json'
        );

        $count = 0;

        foreach ($seo as $gameKey => $blocks) {

            $game = Game::where(
                'legacy_id',
                (string) $gameKey
            )->first();

            if (!$game) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | A game may contain either an object or an array of blocks.
            |--------------------------------------------------------------------------
            */

            if (isset($blocks['content'])) {
                $blocks = [$blocks];
            }

            if (!is_array($blocks)) {
                continue;
            }

            foreach ($blocks as $index => $block) {

                if (!is_array($block)) {
                    continue;
                }

                GameSeoContent::updateOrCreate(
                    [
                        'game_id' =>
                            $game->id,

                        'sort_order' =>
                            (int) (
                                $block['sort_order']
                                ?? $index
                            ),
                    ],
                    [
                        'title' =>
                            $block['title']
                            ?? null,

                        'content' =>
                            $block['content']
                            ?? '',
                        
                        'active' =>
                            $block['active']
                            ?? true,
                    ]
                );

                $count++;
            }
        }

        $this->info(
            "Game SEO blocks imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Generic SEO Blocks
    |--------------------------------------------------------------------------
    */

    protected function importSeoBlocks(): void
    {
        $this->info(
            'Importing SEO blocks...'
        );

        $blocks = $this->readJson(
            'seo_blocks.json'
        );

        $count = 0;

        foreach ($blocks as $pageType => $items) {

            if (isset($items['content'])) {
                $items = [$items];
            }

            if (!is_array($items)) {
                continue;
            }

            foreach ($items as $index => $block) {

                if (!is_array($block)) {
                    continue;
                }

                SeoBlock::updateOrCreate(
                    [
                        'page_type' =>
                            is_string($pageType)
                                ? $pageType
                                : 'global',

                        'sort_order' =>
                            (int) (
                                $block['sort_order']
                                ?? $index
                            ),
                    ],
                    [
                        'title' =>
                            $block['title']
                            ?? null,

                        'content' =>
                            $block['content']
                            ?? '',

                        'active' =>
                            $block['active']
                            ?? true,
                    ]
                );

                $count++;
            }
        }

        $this->info(
            "SEO blocks imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    protected function importSettings(): void
    {
        $this->info(
            'Importing settings...'
        );

        $settings = $this->readJson(
            'settings.json'
        );

        $count = 0;

        foreach ($settings as $key => $value) {

            if (is_array($value)) {
                $encodedValue = json_encode(
                    $value,
                    JSON_UNESCAPED_UNICODE
                );

                $type = 'json';

            } elseif (is_bool($value)) {

                $encodedValue =
                    $value ? '1' : '0';

                $type = 'boolean';

            } else {

                $encodedValue =
                    (string) $value;

                $type = 'string';
            }

            Setting::updateOrCreate(
                [
                    'key' => $key,
                ],
                [
                    'value' => $encodedValue,
                    'type' => $type,
                    'group' => 'general',
                ]
            );

            $count++;
        }

        $this->info(
            "Settings imported: {$count}"
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Time Normalizer
    |--------------------------------------------------------------------------
    */

    protected function normalizeTime(
        mixed $value
    ): ?string {
        if (
            $value === null ||
            $value === ''
        ) {
            return null;
        }

        $value = trim((string) $value);

        /*
        | Already HH:MM
        */

        if (
            preg_match(
                '/^\d{2}:\d{2}$/',
                $value
            )
        ) {
            return $value;
        }

        /*
        | HH:MM:SS
        */

        if (
            preg_match(
                '/^\d{2}:\d{2}:\d{2}$/',
                $value
            )
        ) {
            return substr($value, 0, 5);
        }

        /*
        | Try strtotime for values such as:
        | 5:00 AM
        */

        $timestamp = strtotime($value);

        if ($timestamp !== false) {
            return date(
                'H:i',
                $timestamp
            );
        }

        return null;
    }
}