<?php

namespace App\Console\Commands;

use App\Models\Khaiwal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use RuntimeException;

class ImportKhaiwals extends Command
{
    protected $signature = 'data:import-khaiwals
                            {--file= : Path to legacy khaiwals.json}
                            {--force : Overwrite existing records}';

    protected $description =
        'Import legacy khaiwals.json into MySQL';

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
                'Invalid khaiwals JSON: ' .
                $e->getMessage()
            );

            return self::FAILURE;
        }

        if (!is_array($data)) {
            $this->error(
                'khaiwals.json must contain an array.'
            );

            return self::FAILURE;
        }

        $imported = 0;
        $skipped = 0;

        foreach ($data as $index => $item) {

            if (!is_array($item)) {
                $this->warn(
                    "Skipping invalid record at index {$index}."
                );

                $skipped++;
                continue;
            }

            $legacyId = trim(
                (string) (
                    $item['id'] ?? ''
                )
            );

            $name = trim(
                (string) (
                    $item['name'] ?? ''
                )
            );

            if (
                $legacyId === '' ||
                $name === ''
            ) {
                $this->warn(
                    "Skipping incomplete record at index {$index}."
                );

                $skipped++;
                continue;
            }

            $exists = Khaiwal::query()
                ->where(
                    'legacy_id',
                    $legacyId
                )
                ->exists();

            if (
                $exists &&
                !$this->option('force')
            ) {
                $skipped++;
                continue;
            }

            Khaiwal::updateOrCreate(
                [
                    'legacy_id' =>
                        $legacyId,
                ],
                [
                    'name' =>
                        $name,

                    'top_header' =>
                        $this->nullableString(
                            $item['top_header'] ?? null
                        ),

                    'cta_text' =>
                        $this->nullableString(
                            $item['cta_text'] ?? null
                        ),

                    'whatsapp' =>
                        $this->nullableString(
                            $item['whatsapp'] ?? null
                        ),

                    'telegram' =>
                        $this->nullableString(
                            $item['telegram'] ?? null
                        ),

                    'schedule' =>
                        $this->normalizeSchedule(
                            $item['schedule'] ?? []
                        ),

                    'active' =>
                        true,

                    'display_order' =>
                        $index,
                ]
            );

            $imported++;

            $this->line(
                "Imported: {$name}"
            );
        }

        $this->newLine();

        $this->info(
            "Imported: {$imported}"
        );

        $this->info(
            "Skipped: {$skipped}"
        );

        return self::SUCCESS;
    }

    protected function resolveFile(): ?string
    {
        $option = $this->option('file');

        if ($option) {

            $path = $option;

            if (!File::exists($path)) {

                $this->error(
                    "File not found: {$path}"
                );

                return null;
            }

            return $path;
        }

        $paths = [
            base_path(
                '../data/khaiwals.json'
            ),

            base_path(
                'data/khaiwals.json'
            ),
        ];

        foreach ($paths as $path) {

            if (File::exists($path)) {
                return $path;
            }
        }

        $this->error(
            'khaiwals.json was not found.'
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

    protected function nullableString(
        mixed $value
    ): ?string {
        if ($value === null) {
            return null;
        }

        $value = trim(
            (string) $value
        );

        return $value === ''
            ? null
            : $value;
    }

    protected function normalizeSchedule(
        mixed $schedule
    ): ?array {
        if (!is_array($schedule)) {
            return null;
        }

        return array_values(
            array_filter(
                array_map(
                    function ($item) {
                        if (
                            $item === null
                        ) {
                            return null;
                        }

                        $item = trim(
                            (string) $item
                        );

                        return $item === ''
                            ? null
                            : $item;
                    },
                    $schedule
                )
            )
        );
    }
}
