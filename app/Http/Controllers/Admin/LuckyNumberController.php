<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class LuckyNumberController extends Controller
{
    public function __construct(
        protected SettingsService $settingsService
    ) {
    }

    /**
     * Show Lucky Numbers configuration.
     */
    public function index()
    {
        $settings = Setting::query()
            ->whereIn('key', [
                'auto_scrape_lucky',
                'lucky_ank',
                'final_ank',
            ])
            ->get()
            ->keyBy('key');

        return view('admin.lucky-numbers.index', [
            'autoScrapeLucky' => filter_var(
                $settings->get('auto_scrape_lucky')?->value ?? false,
                FILTER_VALIDATE_BOOLEAN
            ),

            'luckyAnk' => $settings->get('lucky_ank')?->value ?? '',

            'finalAnk' => $settings->get('final_ank')?->value ?? '',
        ]);
    }

    /**
     * Update Lucky Numbers configuration.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'auto_scrape_lucky' => [
                'nullable',
                'boolean',
            ],

            'lucky_ank' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'final_ank' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $this->settingsService->set(
            'auto_scrape_lucky',
            $request->boolean('auto_scrape_lucky'),
            'boolean',
            'results'
        );

        $this->settingsService->set(
            'lucky_ank',
            $validated['lucky_ank'] ?? '',
            'string',
            'results'
        );

        $this->settingsService->set(
            'final_ank',
            $validated['final_ank'] ?? '',
            'string',
            'results'
        );

        return redirect()
            ->route('admin.lucky-numbers.index')
            ->with(
                'success',
                'Lucky Numbers settings updated successfully.'
            );
    }
}
