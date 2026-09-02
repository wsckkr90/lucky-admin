@php
    $seo = $seo ?? [];
@endphp

<title>{{ $seo['title'] ?? config('app.name') }}</title>

@if(!empty($seo['description']))
    <meta
        name="description"
        content="{{ $seo['description'] }}"
    >
@endif

@if(!empty($seo['canonical']))
    <link
        rel="canonical"
        href="{{ $seo['canonical'] }}"
    >
@endif

@if(!empty($seo['robots']))
    <meta
        name="robots"
        content="{{ $seo['robots'] }}"
    >
@endif


{{-- Open Graph --}}

<meta
    property="og:type"
    content="{{ $ogType ?? 'website' }}"
>

<meta
    property="og:title"
    content="{{ $seo['og_title'] ?? $seo['title'] ?? config('app.name') }}"
>

@if(!empty($seo['og_description']))
    <meta
        property="og:description"
        content="{{ $seo['og_description'] }}"
    >
@endif

<meta
    property="og:url"
    content="{{ $seo['canonical'] ?? url()->current() }}"
>

@if(!empty($seo['og_image']))
    <meta
        property="og:image"
        content="{{ $seo['og_image'] }}"
    >
@endif


{{-- Twitter / X --}}

<meta
    name="twitter:card"
    content="summary_large_image"
>

<meta
    name="twitter:title"
    content="{{ $seo['twitter_title'] ?? $seo['title'] ?? config('app.name') }}"
>

@if(!empty($seo['twitter_description']))
    <meta
        name="twitter:description"
        content="{{ $seo['twitter_description'] }}"
    >
@endif

@if(!empty($seo['twitter_image']))
    <meta
        name="twitter:image"
        content="{{ $seo['twitter_image'] }}"
    >
@endif


{{-- Structured Data --}}

@if(!empty($seo['schema_json']))
    <script type="application/ld+json">
{!! json_encode(
    $seo['schema_json'],
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE |
    JSON_PRETTY_PRINT
) !!}
    </script>
@elseif(!empty($seo['schema_type']))
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => $seo['schema_type'],
    'name' => $seo['title'] ?? config('app.name'),
    'url' => $seo['canonical'] ?? url()->current(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endif