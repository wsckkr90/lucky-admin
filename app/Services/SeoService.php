<?php

namespace App\Services;

use App\Models\SeoPage;
use App\Models\SeoSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class SeoService
{
    public function forModel(object $model, array $defaults = []): array
    {
        return $this->normalize($model->seoMeta, $defaults);
    }

    public function forCurrentPage(?string $pageKey = null): array
    {
        $site = $this->resolveSite();
        $key = $pageKey ?: $this->pageKeyFromRequest();
        $host = strtolower((string) request()->getHost());
        $cacheKey = 'seo:page:' . sha1($host . '|' . $site?->id . '|' . $key);

        return Cache::remember($cacheKey, now()->addMinutes(2), function () use ($site, $key) {
            $page = $site?->pages()
                ->where('page_key', $key)
                ->first();

            if (!$page) {
                return $this->normalize(null, [
                    'title' => Config::get('app.name', 'Website'),
                    'description' => 'Latest updates, results and information.',
                    'canonical' => url()->current(),
                    'schema_type' => $key === 'home' ? 'WebSite' : 'WebPage',
                ] + ($site ? [
                    'site_name' => $site->name,
                    'logo' => $site->logo_url,
                    'same_as' => $site->same_as ?? [],
                    'organization_name' => $site->organization_name,
                ] : []));
            }

            return $this->normalize($page, [
                'title' => $site?->name ?: Config::get('app.name', 'Website'),
                'canonical' => $this->absolutePageUrl($site, $page),
                'schema_type' => $key === 'home' ? 'WebSite' : 'WebPage',
                'site_name' => $site?->name,
                'logo' => $site?->logo_url,
                'same_as' => $site?->same_as ?? [],
                'organization_name' => $site?->organization_name,
            ]);
        });
    }

    public function normalize($seo, array $defaults = []): array
    {
        $siteName = $defaults['site_name'] ?? Config::get('app.name', 'Website');
        $title = $seo?->meta_title ?: ($defaults['title'] ?? $siteName);
        $description = $seo?->meta_description ?: ($defaults['description'] ?? '');
        $canonical = $seo?->canonical_url ?: ($defaults['canonical'] ?? url()->current());

        return [
            'title' => $title,
            'description' => $description,
            'focus_keyword' => $seo?->focus_keyword ?: null,
            'secondary_keywords' => $seo?->secondary_keywords ?: null,
            'keywords' => collect([$seo?->focus_keyword, $seo?->secondary_keywords])->filter()->implode(', '),
            'canonical' => $canonical,
            'robots' => $seo?->robots ?: 'index,follow',
            'author' => $seo?->author ?: null,
            'published_at' => $seo?->published_at,
            'og_title' => $seo?->og_title ?: $title,
            'og_description' => $seo?->og_description ?: $description,
            'og_image' => $seo?->og_image ?: ($defaults['image'] ?? null),
            'twitter_title' => $seo?->twitter_title ?: $title,
            'twitter_description' => $seo?->twitter_description ?: $description,
            'twitter_image' => $seo?->twitter_image ?: ($seo?->og_image ?: ($defaults['image'] ?? null)),
            'schema_type' => $seo?->schema_type ?: ($defaults['schema_type'] ?? 'WebPage'),
            'schema_json' => $seo?->schema_json ?: null,
            'extra_head' => $seo?->extra_head ?: null,
            'site_name' => $siteName,
            'logo' => $defaults['logo'] ?? null,
            'same_as' => $defaults['same_as'] ?? [],
            'organization_name' => $defaults['organization_name'] ?? $siteName,
        ];
    }

    protected function resolveSite(): ?SeoSite
    {
        $host = strtolower((string) request()->getHost());
        $host = preg_replace('/^www\./', '', $host);
        $cacheKey = 'seo:site:' . sha1($host);

        return Cache::remember($cacheKey, now()->addMinutes(2), function () use ($host) {
            return SeoSite::query()
                ->where('active', true)
                ->where('domain', $host)
                ->first()
                ?: SeoSite::query()
                    ->where('active', true)
                    ->orderBy('id')
                    ->first();
        });
    }

    protected function pageKeyFromRequest(): string
    {
        $route = request()->route()?->getName();
        return match (true) {
            Str::startsWith((string) $route, 'chart.') => 'chart',
            $route === 'game.show' => 'game',
            Str::contains((string) request()->path(), 'blog-detail') => 'blog-detail',
            Str::contains((string) request()->path(), 'blog') => 'blog-list',
            Str::contains((string) request()->path(), 'privacy') => 'privacy-policy',
            Str::contains((string) request()->path(), 'terms') => 'terms',
            Str::contains((string) request()->path(), 'disclaimer') => 'disclaimer',
            Str::contains((string) request()->path(), 'contact') => 'contact',
            default => 'home',
        };
    }

    protected function absolutePageUrl(?SeoSite $site, SeoPage $page): string
    {
        if (filter_var($page->canonical_url, FILTER_VALIDATE_URL)) {
            return $page->canonical_url;
        }

        $scheme = $site?->scheme ?: request()->getScheme();
        $domain = $site?->domain ?: request()->getHost();
        $path = '/' . ltrim($page->path ?: '/', '/');
        return rtrim($scheme . '://' . $domain, '/') . ($path === '/' ? '/' : $path);
    }
}
