<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class SeoService
{
    public function forModel(
        object $model,
        array $defaults = []
    ): array {
        $seo = $model->seoMeta;

        return $this->normalize(
            $seo,
            $defaults
        );
    }

    public function normalize(
        $seo,
        array $defaults = []
    ): array {
        $siteName = Config::get(
            'app.name',
            'Website'
        );

        $title = $seo?->meta_title
            ?: ($defaults['title'] ?? $siteName);

        $description = $seo?->meta_description
            ?: ($defaults['description'] ?? '');

        $canonical = $seo?->canonical_url
            ?: ($defaults['canonical'] ?? url()->current());

        return [
            'title' => $title,

            'description' => $description,

            'focus_keyword' =>
                $seo?->focus_keyword
                ?: null,

            'secondary_keywords' =>
                $seo?->secondary_keywords
                ?: null,

            'canonical' => $canonical,

            'robots' =>
                $seo?->robots
                ?: 'index,follow',

            'og_title' =>
                $seo?->og_title
                ?: $title,

            'og_description' =>
                $seo?->og_description
                ?: $description,

            'og_image' =>
                $seo?->og_image
                ?: ($defaults['image'] ?? null),

            'twitter_title' =>
                $seo?->twitter_title
                ?: $title,

            'twitter_description' =>
                $seo?->twitter_description
                ?: $description,

            'twitter_image' =>
                $seo?->twitter_image
                ?: (
                    $seo?->og_image
                    ?: ($defaults['image'] ?? null)
                ),

            'schema_type' =>
                $seo?->schema_type
                ?: ($defaults['schema_type'] ?? 'WebPage'),

            'schema_json' =>
                $seo?->schema_json
                ?: null,
        ];
    }
}
