<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Game;
use App\Models\SeoContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoContentController extends Controller
{
    /**
     * SEO content + FAQ manager for one game.
     */
    public function index(Game $game)
    {
        $game->load([
            'seoMeta',
            'seoContents' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
            'faqs' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);

        return view(
            'admin.seo.content',
            compact('game')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEO CONTENT
    |--------------------------------------------------------------------------
    */

    /**
     * Store SEO content block.
     */
    public function storeContent(
        Request $request,
        Game $game
    ) {
        $validated = $request->validate([
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        SeoContent::create([
            'game_id' =>
                $game->id,

            'title' =>
                $validated['title'] ?? null,

            'content' =>
                $validated['content'],

            'active' =>
                $request->boolean('active'),

            'sort_order' =>
                (int) (
                    $validated['sort_order']
                    ?? 0
                ),
        ]);

        return back()->with(
            'success',
            'SEO content added successfully.'
        );
    }

    /**
     * Update SEO content block.
     */
    public function updateContent(
        Request $request,
        SeoContent $seoContent
    ) {
        $validated = $request->validate([
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'content' => [
                'required',
                'string',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $seoContent->update([
            'title' =>
                $validated['title'] ?? null,

            'content' =>
                $validated['content'],

            'active' =>
                $request->boolean('active'),

            'sort_order' =>
                (int) (
                    $validated['sort_order']
                    ?? 0
                ),
        ]);

        return back()->with(
            'success',
            'SEO content updated successfully.'
        );
    }

    /**
     * Delete SEO content.
     */
    public function destroyContent(
        SeoContent $seoContent
    ) {
        $seoContent->delete();

        return back()->with(
            'success',
            'SEO content deleted successfully.'
        );
    }

    /**
     * Toggle SEO content.
     */
    public function toggleContent(
        SeoContent $seoContent
    ) {
        $seoContent->update([
            'active' =>
                !$seoContent->active,
        ]);

        return back()->with(
            'success',
            $seoContent->active
                ? 'SEO content activated.'
                : 'SEO content deactivated.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FAQ
    |--------------------------------------------------------------------------
    */

    /**
     * Store FAQ for a game.
     */
    public function storeFaq(
        Request $request,
        Game $game
    ) {
        $validated = $request->validate([
            'scope' => [
                'required',
                'string',
                'max:100',
            ],

            'question' => [
                'required',
                'string',
                'max:1000',
            ],

            'answer' => [
                'required',
                'string',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        Faq::create([
            'scope' =>
                $validated['scope'],

            'game_id' =>
                $game->id,

            'question' =>
                $validated['question'],

            'answer' =>
                $validated['answer'],

            'active' =>
                $request->boolean('active'),

            'sort_order' =>
                (int) (
                    $validated['sort_order']
                    ?? 0
                ),
        ]);

        return back()->with(
            'success',
            'FAQ added successfully.'
        );
    }

    /**
     * Update FAQ.
     */
    public function updateFaq(
        Request $request,
        Faq $faq
    ) {
        $validated = $request->validate([
            'scope' => [
                'required',
                'string',
                'max:100',
            ],

            'question' => [
                'required',
                'string',
                'max:1000',
            ],

            'answer' => [
                'required',
                'string',
            ],

            'active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $faq->update([
            'scope' =>
                $validated['scope'],

            'question' =>
                $validated['question'],

            'answer' =>
                $validated['answer'],

            'active' =>
                $request->boolean('active'),

            'sort_order' =>
                (int) (
                    $validated['sort_order']
                    ?? 0
                ),
        ]);

        return back()->with(
            'success',
            'FAQ updated successfully.'
        );
    }

    /**
     * Delete FAQ.
     */
    public function destroyFaq(
        Faq $faq
    ) {
        $faq->delete();

        return back()->with(
            'success',
            'FAQ deleted successfully.'
        );
    }

    /**
     * Toggle FAQ status.
     */
    public function toggleFaq(
        Faq $faq
    ) {
        $faq->update([
            'active' =>
                !$faq->active,
        ]);

        return back()->with(
            'success',
            $faq->active
                ? 'FAQ activated.'
                : 'FAQ deactivated.'
        );
    }
}
