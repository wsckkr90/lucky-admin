<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Services\ResultService;
use Illuminate\Http\Request;

class TodayResultController extends Controller
{
    public function __construct(
        protected ResultService $resultService
    ) {}

    public function index()
    {
        $date = today();

        $games = Game::query()
            ->with([
                'city',
                'results' => function ($query) use ($date) {
                    $query->whereDate(
                        'result_date',
                        $date
                    );
                },
            ])
            ->where('active', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.results.today',
            compact(
                'games',
                'date'
            )
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'game_id' => [
                'required',
                'integer',
                'exists:games,id',
            ],

            'open_panna' => [
                'nullable',
                'string',
                'max:10',
            ],

            'jodi' => [
                'nullable',
                'string',
                'max:10',
            ],

            'close_panna' => [
                'nullable',
                'string',
                'max:10',
            ],

            'result' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status' => [
                'required',
                'in:pending,published,corrected,cancelled',
            ],
        ]);

        $this->resultService->upsertToday(
            $validated['game_id'],
            [
                'open_panna' =>
                    $validated['open_panna'] ?? null,

                'jodi' =>
                    $validated['jodi'] ?? null,

                'close_panna' =>
                    $validated['close_panna'] ?? null,

                'result' =>
                    $validated['result'] ?? null,

                'status' =>
                    $validated['status'],

                'source' =>
                    'manual',
            ]
        );

        return redirect()
            ->route('admin.results.today')
            ->with(
                'success',
                'Today\'s result updated successfully.'
            );
    }
}