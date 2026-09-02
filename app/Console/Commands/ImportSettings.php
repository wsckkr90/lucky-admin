<?php

namespace App\Console\Commands;

use App\Services\SettingsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use RuntimeException;

class ImportSettings extends Command
{
    protected $signature = 'data:import-settings
                            {--file= : Path to legacy settings.json}
                            {--force : Overwrite existing settings}';

    protected $description =
        'Import legacy settings.json into MySQL';

    public function handle(
        SettingsService $settings
    ): int {
        $path = $this->option('file');

        if (!$path) {
            $path = base_path(
                '../data/settings.json'
            );

            if (!File::exists($path)) {
                $path = base_path(
                    'data/settings.json'
                );
            }
        }

        if (!File::exists($path)) {
            $this->error(
                "Settings file not found: {$path}"
            );

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
                'Invalid settings JSON: ' .
                $e->getMessage()
            );

            return self::FAILURE;
        }

        if (!is_array($data)) {
            throw new RuntimeException(
                'Expected settings.json to contain an object.'
            );
        }

        $mapping = $this->mapping();

        $imported = 0;
        $skipped = 0;

        foreach ($data as $legacyKey => $value) {

            $config =
                $mapping[$legacyKey]
                ?? [
                    'key' =>
                        'legacy.' .
                        $legacyKey,

                    'group' =>
                        'legacy',

                    'type' =>
                        'string',
                ];

            $existing = \App\Models\Setting::query()
                ->where(
                    'key',
                    $config['key']
                )
                ->exists();

            if (
                $existing &&
                !$this->option('force')
            ) {
                $skipped++;
                continue;
            }

            $settings->set(
                $config['key'],
                $value,
                $config['group'],
                $config['type']
            );

            $imported++;

            $this->line(
                "Imported: {$legacyKey} → {$config['key']}"
            );
        }

        $settings->forgetCache();

        $this->newLine();

        $this->info(
            "Imported: {$imported}"
        );

        $this->info(
            "Skipped: {$skipped}"
        );

        return self::SUCCESS;
    }

    protected function mapping(): array
    {
        return [
            /*
            |--------------------------------------------------------------------------
            | Scraper
            |--------------------------------------------------------------------------
            */

            'scraping_mode' => [
                'key' =>
                    'scraper.mode',

                'group' =>
                    'scraper',

                'type' =>
                    'string',
            ],

            'target_url' => [
                'key' =>
                    'scraper.target_url',

                'group' =>
                    'scraper',

                'type' =>
                    'string',
            ],

            'last_run' => [
                'key' =>
                    'scraper.last_run',

                'group' =>
                    'scraper',

                'type' =>
                    'string',
            ],

            'cron_token' => [
                'key' =>
                    'scraper.cron_token',

                'group' =>
                    'scraper',

                'type' =>
                    'string',
            ],

            'auto_scrape_lucky' => [
                'key' =>
                    'scraper.auto_scrape_lucky',

                'group' =>
                    'scraper',

                'type' =>
                    'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | Admin
            |--------------------------------------------------------------------------
            */

            
            /*
            |--------------------------------------------------------------------------
            | Results
            |--------------------------------------------------------------------------
            */

            'lucky_ank' => [
                'key' =>
                    'results.lucky_ank',

                'group' =>
                    'results',

                'type' =>
                    'string',
            ],

            'final_ank' => [
                'key' =>
                    'results.final_ank',

                'group' =>
                    'results',

                'type' =>
                    'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Social
            |--------------------------------------------------------------------------
            */

            'whatsapp_number' => [
                'key' =>
                    'social.whatsapp_number',

                'group' =>
                    'social',

                'type' =>
                    'string',
            ],

            'telegram_url' => [
                'key' =>
                    'social.telegram_url',

                'group' =>
                    'social',

                'type' =>
                    'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Arun Bhai
            |--------------------------------------------------------------------------
            */

            'arun_title' => [
                'key' =>
                    'arun.title',

                'group' =>
                    'arun',

                'type' =>
                    'string',
            ],

            'arun_whatsapp' => [
                'key' =>
                    'arun.whatsapp',

                'group' =>
                    'arun',

                'type' =>
                    'string',
            ],

            'arun_telegram' => [
                'key' =>
                    'arun.telegram',

                'group' =>
                    'arun',

                'type' =>
                    'string',
            ],

            'arun_note' => [
                'key' =>
                    'arun.note',

                'group' =>
                    'arun',

                'type' =>
                    'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Callout 1
            |--------------------------------------------------------------------------
            */

            'callout1_header' => [
                'key' =>
                    'callout.1.header',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            'callout1_text' => [
                'key' =>
                    'callout.1.text',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            'callout1_name' => [
                'key' =>
                    'callout.1.name',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            'callout1_whatsapp' => [
                'key' =>
                    'callout.1.whatsapp',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Callout 2
            |--------------------------------------------------------------------------
            */

            'callout2_text' => [
                'key' =>
                    'callout.2.text',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            'callout2_name' => [
                'key' =>
                    'callout.2.name',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            'callout2_subtext' => [
                'key' =>
                    'callout.2.subtext',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],

            'callout2_telegram' => [
                'key' =>
                    'callout.2.telegram',

                'group' =>
                    'callouts',

                'type' =>
                    'string',
            ],
        ];
    }
}
