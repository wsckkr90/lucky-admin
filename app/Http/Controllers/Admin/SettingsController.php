<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::query()
            ->orderBy('group')
            ->orderBy('key')
            ->get()
            ->groupBy('group');

        return view(
            'admin.settings.index',
            compact('settings')
        );
    }

    public function update(
        Request $request,
        SettingsService $settingsService
    ) {
        $groups = [
            'general',
            'scraper',
            'admin',
            'results',
            'social',
            'arun',
            'callouts',
        ];

        foreach ($groups as $group) {

            if (!$request->has($group)) {
                continue;
            }

            $values =
                $request->input(
                    $group,
                    []
                );

            if (!is_array($values)) {
                continue;
            }

            foreach ($values as $key => $value) {

                /*
                |--------------------------------------------------------------------------
                | Setting keys arrive after the final dot.
                |--------------------------------------------------------------------------
                */

                $fullKey =
                    str_replace(
                        '__',
                        '.',
                        $key
                    );

                $setting =
                    Setting::query()
                        ->where(
                            'key',
                            $fullKey
                        )
                        ->first();

                if (!$setting) {
                    continue;
                }

                $settingsService->set(
                    $setting->key,
                    $value,
                    $setting->group,
                    $setting->type
                );
            }
        }

        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }
}
