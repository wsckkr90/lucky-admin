<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {
    }

    /**
     * SEO dashboard.
     */
    public function index()
    {
        $games = Game::query()
            ->with('seoMeta')
            ->where('active', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(20);

        return view(
            'admin.seo.index',
            [
                'games' => $games,
            ]
        );
    }

    /**
     * Edit SEO.
     *
     * URL:
     * /admin/seo/game/3/edit
     */
    public function edit(
        string $type,
        int $id
    ) {
        /*
        |--------------------------------------------------------------------------
        | Only game SEO is supported by this page.
        |--------------------------------------------------------------------------
        */

        if ($type !== 'game') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Find game explicitly.
        |--------------------------------------------------------------------------
        */

        $game = Game::query()
            ->with([
                'seoMeta',
            ])
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Existing SEO record.
        |--------------------------------------------------------------------------
        */

        $seo = $game->seoMeta;

        /*
        |--------------------------------------------------------------------------
        | Create in-memory defaults when no SEO row exists.
        |--------------------------------------------------------------------------
        */

        if (!$seo) {
            $seo = new \App\Models\SeoMeta([
                'meta_title' =>
                    $game->name .
                    ' Result & Chart',

                'meta_description' =>
                    'Check ' .
                    $game->name .
                    ' results, chart and historical results.',

                'focus_keyword' =>
                    strtolower(
                        $game->name
                    ) . ' result',

                'secondary_keywords' =>
                    strtolower(
                        $game->name
                    ) . ' chart, satta chart',

                'canonical_url' =>
                    url(
                        '/chart/' .
                        $game->slug
                    ),

                'robots' =>
                    'index,follow',

                'og_title' =>
                    $game->name .
                    ' Result & Chart',

                'og_description' =>
                    'Check ' .
                    $game->name .
                    ' results and historical chart.',

                'twitter_title' =>
                    $game->name .
                    ' Result & Chart',

                'twitter_description' =>
                    'Check ' .
                    $game->name .
                    ' results and historical chart.',

                'schema_type' =>
                    'WebPage',

                'schema_json' =>
                    null,
            ]);
        }

        return view(
            'admin.seo.edit',
            [
                'game' => $game,
                'seo' => $seo,
            ]
        );
    }

    /**
     * Update game SEO.
     *
     * URL:
     * PUT /admin/seo/game/3
     */
    public function update(
        Request $request,
        string $type,
        int $id
    ) {
        if ($type !== 'game') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Explicitly load the game.
        |--------------------------------------------------------------------------
        */

        $game = Game::query()
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Validate.
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'focus_keyword' => [
                'nullable',
                'string',
                'max:255',
            ],

            'secondary_keywords' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'canonical_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'robots' => [
                'required',
                'string',
                'max:100',
            ],

            'og_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'og_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'og_image' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'twitter_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'twitter_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'twitter_image' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'schema_type' => [
                'required',
                'string',
                'max:100',
            ],

            'schema_json' => [
                'nullable',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate schema JSON.
        |--------------------------------------------------------------------------
        */

        $schemaJson = null;

        if (
            isset($validated['schema_json']) &&
            trim(
                $validated['schema_json']
            ) !== ''
        ) {
            try {

                $schemaJson = json_decode(
                    $validated['schema_json'],
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );

            } catch (\Throwable) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'schema_json' =>
                            'Schema JSON is invalid.',
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Save through polymorphic relationship.
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $game,
                $validated,
                $schemaJson
            ) {

                $game->seoMeta()
                    ->updateOrCreate(
                        [],
                        [
                            'meta_title' =>
                                $validated[
                                    'meta_title'
                                ] ?? null,

                            'meta_description' =>
                                $validated[
                                    'meta_description'
                                ] ?? null,

                            'focus_keyword' =>
                                $validated[
                                    'focus_keyword'
                                ] ?? null,

                            'secondary_keywords' =>
                                $validated[
                                    'secondary_keywords'
                                ] ?? null,

                            'canonical_url' =>
                                $validated[
                                    'canonical_url'
                                ] ?? null,

                            'robots' =>
                                $validated[
                                    'robots'
                                ],

                            'og_title' =>
                                $validated[
                                    'og_title'
                                ] ?? null,

                            'og_description' =>
                                $validated[
                                    'og_description'
                                ] ?? null,

                            'og_image' =>
                                $validated[
                                    'og_image'
                                ] ?? null,

                            'twitter_title' =>
                                $validated[
                                    'twitter_title'
                                ] ?? null,

                            'twitter_description' =>
                                $validated[
                                    'twitter_description'
                                ] ?? null,

                            'twitter_image' =>
                                $validated[
                                    'twitter_image'
                                ] ?? null,

                            'schema_type' =>
                                $validated[
                                    'schema_type'
                                ],

                            'schema_json' =>
                                $schemaJson,
                        ]
                    );
            }
        );

        return redirect()
            ->route(
                'admin.seo.edit',
                [
                    'type' => 'game',
                    'id' => $game->id,
                ]
            )
            ->with(
                'success',
                'SEO settings updated successfully.'
            );
    }
}
