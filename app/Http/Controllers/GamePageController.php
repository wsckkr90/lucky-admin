<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\SeoService;

class GamePageController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {
    }

    public function show(Game $game)
    {
        $game->load([
            'city:id,name',
            'seoMeta',
            'seoContents' => function ($query) {
                $query
                    ->select(['id', 'game_id', 'title', 'content', 'sort_order'])
                    ->where('active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
            'faqs' => function ($query) {
                $query
                    ->select(['id', 'game_id', 'question', 'answer', 'sort_order'])
                    ->where('active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);

        $seo = $this->seoService->forModel(
            $game,
            [
                'title' => $game->name . ' Result, Chart & History',
                'description' => 'Check the latest ' . $game->name . ' result, historical chart and previous results.',
                'canonical' => route('game.show', $game),
                'schema_type' => 'WebPage',
            ]
        );

        return view('public.game', compact('game', 'seo'));
    }
}
