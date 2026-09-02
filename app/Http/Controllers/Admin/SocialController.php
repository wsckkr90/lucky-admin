<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $settings = Setting::query()
            ->where('group', 'social')
            ->orderBy('key')
            ->get();

        return view(
            'admin.social.index',
            compact('settings')
        );
    }

    public function update(
        Request $request,
        SettingsService $settingsService
    ) {
        $validated = $request->validate([
            'telegram_url' => ['nullable', 'url', 'max:500'],
            'whatsapp_url' => ['nullable', 'url', 'max:500'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'instagram_url' => ['nullable', 'url', 'max:500'],
            'facebook_url' => ['nullable', 'url', 'max:500'],
            'twitter_url' => ['nullable', 'url', 'max:500'],
        ]);

        $keys = [
            'telegram_url',
            'whatsapp_url',
            'youtube_url',
            'instagram_url',
            'facebook_url',
            'twitter_url',
        ];

        foreach ($keys as $key) {
            $fullKey = 'social.' . $key;

            $setting = Setting::query()
                ->where('key', $fullKey)
                ->first();

            if (!$setting) {
                continue;
            }

            $settingsService->set(
                $setting->key,
                $validated[$key] ?? '',
                $setting->group,
                $setting->type
            );
        }

        return back()->with(
            'success',
            'Social channels updated successfully.'
        );
    }
}
