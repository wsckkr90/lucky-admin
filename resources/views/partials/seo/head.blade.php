@php
    $seo = $seo ?? app(\App\Services\SeoService::class)->forCurrentPage();
    $pageSchema = $seo['schema_json'] ?? null;
    if (is_string($pageSchema) && $pageSchema !== '') {
        $pageSchema = json_decode($pageSchema, true);
    }
    $organizationSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => rtrim($seo['canonical'] ?? url('/'), '/') . '/#organization',
        'name' => $seo['organization_name'] ?? $seo['site_name'] ?? config('app.name'),
        'url' => $seo['canonical'] ?? url('/'),
    ];
    if (!empty($seo['logo'])) {
        $organizationSchema['logo'] = [
            '@type' => 'ImageObject',
            'url' => $seo['logo'],
        ];
    }
    if (!empty($seo['same_as'])) {
        $organizationSchema['sameAs'] = array_values(array_filter($seo['same_as']));
    }
@endphp

<title>{{ $seo['title'] ?? config('app.name') }}</title>

@if(!empty($seo['description']))<meta name="description" content="{{ $seo['description'] }}">@endif
@if(!empty($seo['keywords']))<meta name="keywords" content="{{ $seo['keywords'] }}">@endif
@if(!empty($seo['author']))<meta name="author" content="{{ $seo['author'] }}">@endif
@if(!empty($seo['canonical']))<link rel="canonical" href="{{ $seo['canonical'] }}">@endif
@if(!empty($seo['robots']))<meta name="robots" content="{{ $seo['robots'] }}">@endif
@if(!empty($seo['published_at']))<meta property="article:published_time" content="{{ \Illuminate\Support\Carbon::parse($seo['published_at'])->toIso8601String() }}">@endif

<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:site_name" content="{{ $seo['site_name'] ?? config('app.name') }}">
<meta property="og:title" content="{{ $seo['og_title'] ?? $seo['title'] ?? config('app.name') }}">
@if(!empty($seo['og_description']))<meta property="og:description" content="{{ $seo['og_description'] }}">@endif
<meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}">
@if(!empty($seo['og_image']))<meta property="og:image" content="{{ $seo['og_image'] }}">@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo['twitter_title'] ?? $seo['title'] ?? config('app.name') }}">
@if(!empty($seo['twitter_description']))<meta name="twitter:description" content="{{ $seo['twitter_description'] }}">@endif
@if(!empty($seo['twitter_image']))<meta name="twitter:image" content="{{ $seo['twitter_image'] }}">@endif

@if(is_array($pageSchema) && !empty($pageSchema))
<script type="application/ld+json">{!! json_encode($pageSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}</script>
@else
<script type="application/ld+json">{!! json_encode(array_filter([
    '@context' => 'https://schema.org',
    '@type' => $seo['schema_type'] ?? 'WebPage',
    'name' => $seo['title'] ?? config('app.name'),
    'description' => $seo['description'] ?? null,
    'url' => $seo['canonical'] ?? url()->current(),
]), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endif

<script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}</script>

@if(!empty($seo['extra_head']))
{!! $seo['extra_head'] !!}
@endif
