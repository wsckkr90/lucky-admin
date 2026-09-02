<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScraperRun;
use App\Models\ScraperSource;
use App\Services\ScraperService;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function index()
    {
        $sources = ScraperSource::query()
            ->withCount([
                'runs'
            ])
            ->orderBy('priority')
            ->get();

        $runs = ScraperRun::query()
            ->latest('started_at')
            ->paginate(20);

        return view(
            'admin.scraper.index',
            compact(
                'sources',
                'runs'
            )
        );
    }

    public function create()
    {
        return view(
            'admin.scraper.create'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'url' => [
                'required',
                'url',
                'max:2048',
            ],

            'method' => [
                'required',
                'in:GET,POST',
            ],

            'headers' => [
                'nullable',
                'json',
            ],

            'config' => [
                'nullable',
                'json',
            ],

            'priority' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ]);

        ScraperSource::create([
            'name' =>
                $validated['name'],

            'url' =>
                $validated['url'],

            'method' =>
                strtoupper(
                    $validated['method']
                ),

            'headers' =>
                !empty($validated['headers'])
                    ? json_decode(
                        $validated['headers'],
                        true
                    )
                    : null,

            'config' =>
                !empty($validated['config'])
                    ? json_decode(
                        $validated['config'],
                        true
                    )
                    : null,

            'priority' =>
                (int) (
                    $validated['priority']
                    ?? 0
                ),

            'active' =>
                $request->boolean('active'),
        ]);

        return redirect()
            ->route('admin.scraper.index')
            ->with(
                'success',
                'Scraper source created successfully.'
            );
    }

    public function run(
        ScraperSource $source,
        ScraperService $scraperService
    ) {
        if (!$source->active) {
            return back()
                ->with(
                    'error',
                    'This scraper source is inactive.'
                );
        }

        $run = $scraperService->run(
            $source
        );

        return back()
            ->with(
                'success',
                "Scraper finished with status: {$run->status}"
            );
    }
}
