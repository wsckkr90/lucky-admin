<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    protected string $cacheKey =
        'application.settings';

    public function get(
        string $key,
        mixed $default = null
    ): mixed {
        $settings = $this->all();

        if (!array_key_exists($key, $settings)) {
            return $default;
        }

        return $settings[$key];
    }

    public function set(
        string $key,
        mixed $value,
        string $group = 'general',
        ?string $type = null
    ): Setting {
        $type ??= $this->detectType(
            $value
        );

        $storedValue = match ($type) {
            'boolean' =>
                $value ? '1' : '0',

            'integer' =>
                (string) ((int) $value),

            'json' =>
                json_encode(
                    $value,
                    JSON_UNESCAPED_UNICODE |
                    JSON_UNESCAPED_SLASHES
                ),

            default =>
                (string) $value,
        };

        $setting = Setting::updateOrCreate(
            [
                'key' => $key,
            ],
            [
                'value' =>
                    $storedValue,

                'type' =>
                    $type,

                'group' =>
                    $group,

                'autoload' =>
                    true,
            ]
        );

        Cache::forget(
            $this->cacheKey
        );

        return $setting;
    }

    public function all(): array
    {
        return Cache::remember(
            $this->cacheKey,
            now()->addHour(),
            function () {
                return Setting::query()
                    ->where('autoload', true)
                    ->get()
                    ->mapWithKeys(
                        function (Setting $setting) {
                            return [
                                $setting->key =>
                                    $setting->typed_value,
                            ];
                        }
                    )
                    ->all();
            }
        );
    }

    public function group(
        string $group
    ): array {
        return Setting::query()
            ->where('group', $group)
            ->get()
            ->mapWithKeys(
                function (Setting $setting) {
                    return [
                        $setting->key =>
                            $setting->typed_value,
                    ];
                }
            )
            ->all();
    }

    public function forgetCache(): void
    {
        Cache::forget(
            $this->cacheKey
        );
    }

    protected function detectType(
        mixed $value
    ): string {
        if (is_bool($value)) {
            return 'boolean';
        }

        if (is_int($value)) {
            return 'integer';
        }

        if (is_array($value)) {
            return 'json';
        }

        return 'string';
    }
}
