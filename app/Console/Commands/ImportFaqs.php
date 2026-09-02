<?php

namespace App\Console\Commands;

use App\Models\Faq;
use App\Models\Game;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportFaqs extends Command
{
    protected $signature = 'data:import-faqs
                            {--file= : Path to legacy FAQ JSON}
                            {--force : Update existing FAQ records}';

    protected $description =
        'Import legacy FAQ data into the existing faqs table';

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
                'Invalid FAQ JSON: ' . $e->getMessage()
            );

            return self::FAILURE;
        }

        if (!is_array($data)) {
            $this->error(
                'FAQ JSON must contain an array or object.'
            );

            return self::FAILURE;
        }

        $records = $this->normalizeRecords($data);

        if (empty($records)) {
            $this->warn(
                'No FAQ records were found in the source file.'
            );

            return self::SUCCESS;
        }

        $imported = 0;
        $skipped = 0;
        $notFound = 0;

        foreach ($records as $index => $record) {

            if (!is_array($record)) {
                $skipped++;
                continue;
            }

            $gameKey = trim(
                (string) (
                    $record['game']
                    ?? $record['game_id']
                    ?? $record['game_key']
                    ?? $record['slug']
                    ?? ''
                )
            );

            $question = trim(
                strip_tags(
                    (string) (
                        $record['question']
                        ?? ''
                    )
                )
            );

            $answer = trim(
                (string) (
                    $record['answer']
                    ?? ''
                )
            );

            if (
                $gameKey === '' ||
                $question === '' ||
                $answer === ''
            ) {
                $skipped++;
                continue;
            }

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

            $scope = trim(
                (string) (
                    $record['scope']
                    ?? 'game'
                )
            );

            if ($scope === '') {
                $scope = 'game';
            }

            $sortOrder = (int) (
                $record['sort_order']
                ?? $record['order']
                ?? $index
            );

            $active = $this->normalizeBoolean(
                $record['active'] ?? true
            );

            /*
            |--------------------------------------------------------------------------
            | Find existing FAQ.
            |--------------------------------------------------------------------------
            |
            | We use game + scope + question as the natural legacy identity.
            |--------------------------------------------------------------------------
            */

            $existing = Faq::query()
                ->where(
                    'game_id',
                    $game->id
                )
                ->where(
                    'scope',
                    $scope
                )
                ->where(
                    'question',
                    $question
                )
                ->first();

            if (
                $existing &&
                !$this->option('force')
            ) {
                $skipped++;
                continue;
            }

            if ($existing) {

                $existing->update([
                    'answer' =>
                        $answer,

                    'sort_order' =>
                        $sortOrder,

                    'active' =>
                        $active,
                ]);

            } else {

                Faq::create([
                    'scope' =>
                        $scope,

                    'game_id' =>
                        $game->id,

                    'question' =>
                        $question,

                    'answer' =>
                        $answer,

                    'sort_order' =>
                        $sortOrder,

                    'active' =>
                        $active,
                ]);
            }

            $imported++;

            $this->line(
                "Imported FAQ: {$game->name} → {$question}"
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
     * Convert different possible legacy JSON layouts
     * into one normalized FAQ record list.
     */
    protected function normalizeRecords(
        array $data
    ): array {
        $records = [];

        /*
        |--------------------------------------------------------------------------
        | Format:
        |
        | [
        |   {
        |      game: "...",
        |      question: "...",
        |      answer: "..."
        |   }
        | ]
        |--------------------------------------------------------------------------
        */

        if (
            array_is_list($data)
        ) {
            return $data;
        }

        /*
        |--------------------------------------------------------------------------
        | Format:
        |
        | {
        |   "game-key": [
        |      {
        |         "question": "...",
        |         "answer": "..."
        |      }
        |   ]
        | }
        |--------------------------------------------------------------------------
        */

        foreach ($data as $gameKey => $items) {

            if (!is_array($items)) {
                continue;
            }

            /*
            | Single FAQ object.
            */

            if (
                isset($items['question']) ||
                isset($items['answer'])
            ) {
                $items = [$items];
            }

            foreach ($items as $item) {

                if (!is_array($item)) {
                    continue;
                }

                $item['game'] =
                    $item['game']
                    ?? $gameKey;

                $records[] = $item;
            }
        }

        return $records;
    }

    /**
     * Find the Laravel Game.
     */
    protected function findGame(
        string $gameKey
    ): ?Game {
        $key = strtolower(
            trim($gameKey)
        );

        $game = Game::query()
            ->where(
                'legacy_id',
                $key
            )
            ->orWhere(
                'slug',
                $key
            )
            ->first();

        if ($game) {
            return $game;
        }

        $slug = Str::slug(
            $key
        );

        $game = Game::query()
            ->where(
                'legacy_id',
                $slug
            )
            ->orWhere(
                'slug',
                $slug
            )
            ->first();

        return $game;
    }

    /**
     * Normalize boolean values from JSON.
     */
    protected function normalizeBoolean(
        mixed $value
    ): bool {
        if (is_bool($value)) {
            return $value;
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

        return !in_array(
            strtolower(
                trim(
                    (string) $value
                )
            ),
            [
                '',
                '0',
                'false',
                'no',
                'off',
                'inactive',
            ],
            true
        );
    }

    /**
     * Resolve legacy FAQ file.
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
                '../data/chart_faqs.json'
            ),

            base_path(
                'data/chart_faqs.json'
            ),

            base_path(
                '../data/faqs.json'
            ),

            base_path(
                'data/faqs.json'
            ),
        ];

        foreach ($paths as $path) {

            if (File::exists($path)) {
                return $path;
            }
        }

        $this->error(
            'FAQ JSON file was not found.'
        );

        $this->line(
            'Checked:'
        );

        foreach ($paths as $path) {
            $this->line(
                " - {$path}"
            );
        }

        return null;
    }
}
