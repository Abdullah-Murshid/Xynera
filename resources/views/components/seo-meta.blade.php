@php
    // ── Resolve values with fallback chain: DB → defaults → app config ──
    $siteName    = config('app.name', 'Xynera');
    $siteUrl     = config('app.url', url('/'));

    // Title: DB record → passed default → site name
    $pageTitle       = $seo?->title       ?? $defaults['title']       ?? $siteName;
    $fullTitle       = $siteName . ' — ' . $pageTitle;

    // Description: DB record → passed default → empty
    $metaDescription = $seo?->meta_description ?? $defaults['description'] ?? '';

    // Keywords — optional, low modern SEO value but still used
    $keywords        = $seo?->keywords ?? '';

    // Canonical URL: strip query string so category filter pages point cleanly to main route
    $rawUrl          = $seo?->canonical_url ?? $defaults['url'] ?? request()->url();
    $canonicalUrl    = strtok($rawUrl, '?');

    // OG fields
    $ogTitle         = $fullTitle;
    $ogDescription   = $seo?->og_description ?? $metaDescription;
    $ogImage         = $seo?->og_image_url   ?? $defaults['og_image'] ?? asset('assets/images/og-image.jpg');
    $ogUrl           = $canonicalUrl;
    $ogType          = $defaults['og_type'] ?? 'website';

    // Twitter Card
    $twitterCard     = $seo?->twitter_card ?? 'summary_large_image';
@endphp

{{-- ── Core Meta Tags ───────────────────────────────────────── --}}
<title>{{ $fullTitle }}</title>

@if($metaDescription)
<meta name="description" content="{{ $metaDescription }}">
@endif

@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif

{{-- Canonical prevents duplicate content penalties --}}
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- ── Open Graph Tags (Facebook, LinkedIn, WhatsApp) ─────────── --}}
<meta property="og:type"        content="{{ $ogType }}">
<meta property="og:site_name"   content="{{ $siteName }}">
<meta property="og:title"       content="{{ $ogTitle }}">
<meta property="og:url"         content="{{ $ogUrl }}">

@if($ogDescription)
<meta property="og:description" content="{{ $ogDescription }}">
@endif

@if($ogImage)
<meta property="og:image"       content="{{ $ogImage }}">
<meta property="og:image:alt"   content="{{ $pageTitle }}">
@endif

{{-- ── Twitter Card Tags ─────────────────────────────────────── --}}
<meta name="twitter:card"        content="{{ $twitterCard }}">
<meta name="twitter:title"       content="{{ $ogTitle }}">

@if($ogDescription)
<meta name="twitter:description" content="{{ $ogDescription }}">
@endif

@if($ogImage)
<meta name="twitter:image"       content="{{ $ogImage }}">
@endif
