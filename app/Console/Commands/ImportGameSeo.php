<?php

namespace App\Console\Commands;

use App\Models\Game;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportGameSeo extends Command
{
    protected $signature = 'data:import-game-seo
                            {--file= : Path to game_seo.json}
                            {--force : Overwrite existing SEO records}';

    protected $description =
        'Import legacy game_seo.json into seo_meta';

    public function handle(): int
    {
        $path = $this->resolveFile();

        if (!$path) {
            return self::FAILURE;
        }

        try {
            $data = json_decode(
                File::get($path),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\Throwable $e) {

            $this->error(
                'Invalid game_seo.json: ' .
                $e->getMessage()
            );

            return self::FAILURE;
        }

        if (!is_array($data)) {

            $this->error(
                'game_seo.json must contain an object.'
            );

            return self::FAILURE;
        }

        $imported = 0;
        $skipped = 0;
        $notFound = 0;

        foreach ($data as $gameKey => $seoData) {

            if (!is_array($seoData)) {

                $this->warn(
                    "Invalid SEO data for {$gameKey}."
                );

                $skipped++;
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Find matching game.
            |--------------------------------------------------------------------------
            */

            $game = $this->findGame(
                $gameKey
            );

            if (!$game) {

                $this->warn(
                    "Game not found: {$gameKey}"
                );

                $notFound++;
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Existing SEO check.
            |--------------------------------------------------------------------------
            */

            $existing =
                $game->seoMeta()->exists();

            if (
                $existing &&
                !$this->option('force')
            ) {

                $this->warn(
                    "SEO already exists: {$game->name}"
                );

                $skipped++;
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Normalize schema JSON.
            |--------------------------------------------------------------------------
            */

            $schemaJson =
                $this->normalizeSchemaJson(
                    $seoData['schema_json']
                    ?? null
                );

            /*
            |--------------------------------------------------------------------------
            | Save through polymorphic relationship.
            |--------------------------------------------------------------------------
            |
            | This is the important fix.
            |
            | Laravel automatically writes:
            |
            | seoable_type = App\Models\Game
            | seoable_id   = $game->id
            |--------------------------------------------------------------------------
            */

            $game->seoMeta()->updateOrCreate(
                [],
                [
                    'meta_title' =>
                        $seoData['meta_title']
                        ?? $seoData['title']
                        ?? null,

                    'meta_description' =>
                        $seoData['meta_description']
                        ?? $seoData['description']
                        ?? null,

                    'focus_keyword' =>
                        $seoData['focus_keyword']
                        ?? null,

                    'secondary_keywords' =>
                        $seoData['secondary_keywords']
                        ?? null,

                    'canonical_url' =>
                        $seoData['canonical_url']
                        ?? null,

                    'robots' =>
                        $seoData['robots']
                        ?? 'index,follow',

                    'og_title' =>
                        $seoData['og_title']
                        ?? null,

                    'og_description' =>
                        $seoData['og_description']
                        ?? null,

                    'og_image' =>
                        $seoData['og_image']
                        ?? null,

                    'twitter_title' =>
                        $seoData['twitter_title']
                        ?? null,

                    'twitter_description' =>
                        $seoData['twitter_description']
                        ?? null,

                    'twitter_image' =>
                        $seoData['twitter_image']
                        ?? null,

                    'schema_type' =>
                        $seoData['schema_type']
                        ?? 'WebPage',

                    'schema_json' =>
                        $schemaJson,
                ]
            );

            $imported++;

            $this->line(
                "Imported SEO: {$game->name}"
            );
        }

        $this->newLine();

        $this->info(
            "Imported: {$imported}"
        );

        $this->info(
            "Skipped: {$skipped}"
        );

        $this->info(
            "Games not found: {$notFound}"
        );

        return self::SUCCESS;
    }

    /**
     * Find game using several safe identifiers.
     */
    protected function findGame(
        string $gameKey
    ): ?Game {
        $gameKey = trim(
            strtolower($gameKey)
        );

        /*
        |--------------------------------------------------------------------------
        | Exact legacy_id.
        |--------------------------------------------------------------------------
        */

        $game = Game::query()
            ->where(
                'legacy_id',
                $gameKey
            )
            ->first();

        if ($game) {
            return $game;
        }

        /*
        |--------------------------------------------------------------------------
        | Exact slug.
        |--------------------------------------------------------------------------
        */

        $game = Game::query()
            ->where(
                'slug',
                $gameKey
            )
            ->first();

        if ($game) {
            return $game;
        }

        /*
        |--------------------------------------------------------------------------
        | Generate a normalized slug.
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug(
            $gameKey
        );

        $game = Game::query()
            ->where(
                'slug',
                $slug
            )
            ->orWhere(
                'legacy_id',
                $slug
            )
            ->first();

        if ($game) {
            return $game;
        }

        /*
        |--------------------------------------------------------------------------
        | Known legacy naming aliases.
        |--------------------------------------------------------------------------
        |
        | Keep this limited to confirmed legacy differences.
        |--------------------------------------------------------------------------
        */

        $aliases = [
            'disawer' => [
                'disawar',
                'disawer',
            ],
        ];

        foreach (
            $aliases[$gameKey] ?? []
            as $alias
        ) {

            $game = Game::query()
                ->where(
                    'legacy_id',
                    $alias
                )
                ->orWhere(
                    'slug',
                    $alias
                )
                ->first();

            if ($game) {
                return $game;
            }
        }

        return null;
    }

    /**
     * Normalize schema JSON.
     */
    protected function normalizeSchemaJson(
        mixed $value
    ): ?array {
        if ($value === null) {
            return null;
        }

        if (is_array($value)) {
            return $value;
        }

        if (!is_string($value)) {
            return null;
        }

        $value = trim($value);

        if ($value === '') {
            return null;
        }

        try {

            $decoded = json_decode(
                $value,
                true,
                512,
                JSON_THROW_ON_ERROR
            );

            return is_array($decoded)
                ? $decoded
                : null;

        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Resolve legacy file.
     */
    protected function resolveFile(): ?string
    {
        $custom = $this->option('file');

        if ($custom) {

            if (!File::exists($custom)) {

                $this->error(
                    "File not found: {$custom}"
                );

                return null;
            }

            return $custom;
        }

        $paths = [
            base_path(
                '../data/game_seo.json'
            ),

            base_path(
                'data/game_seo.json'
            ),
        ];

        foreach ($paths as $path) {

            if (File::exists($path)) {
                return $path;
            }
        }

        $this->error(
            'game_seo.json was not found.'
        );

        return null;
    }
}
