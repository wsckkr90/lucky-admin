<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SocialSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'social.telegram_url',
                'value' => '',
                'type' => 'string',
                'group' => 'social',
                'autoload' => true,
            ],
            [
                'key' => 'social.whatsapp_url',
                'value' => '',
                'type' => 'string',
                'group' => 'social',
                'autoload' => true,
            ],
            [
                'key' => 'social.youtube_url',
                'value' => '',
                'type' => 'string',
                'group' => 'social',
                'autoload' => true,
            ],
            [
                'key' => 'social.instagram_url',
                'value' => '',
                'type' => 'string',
                'group' => 'social',
                'autoload' => true,
            ],
            [
                'key' => 'social.facebook_url',
                'value' => '',
                'type' => 'string',
                'group' => 'social',
                'autoload' => true,
            ],
            [
                'key' => 'social.twitter_url',
                'value' => '',
                'type' => 'string',
                'group' => 'social',
                'autoload' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
