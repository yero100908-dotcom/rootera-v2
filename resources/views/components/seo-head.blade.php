{{--
    SEO Head Component — resources/views/components/seo-head.blade.php
    ====================================================================
    Renders all critical SEO meta tags, Open Graph, Twitter Card tags,
    and injects one or more JSON-LD structured data blocks.

    Props:
        $metaTitle      (string) — Page <title> and og:title
        $metaDescription(string) — meta description and og:description
        $canonicalUrl   (string) — <link rel="canonical"> and og:url
        $schemas        (array)  — Array of pre-encoded JSON-LD strings
                                   (from SchemaGeneratorService::toJsonLd())
        $ogImage        (string, optional) — Absolute OG image URL
        $ogType         (string, optional) — og:type, default: 'website'
        $robots         (string, optional) — robots meta, default: 'index, follow'
        $keywords       (string, optional) — meta keywords (supplementary)

    Usage:
        <x-seo-head
            :meta-title="$metaTitle"
            :meta-description="$metaDescription"
            :canonical-url="$canonicalUrl"
            :schemas="$schemas"
            :og-image="$ogImage"
        />
--}}

@props([
    'metaTitle'       => config('app.name', 'Rootera Plumbing'),
    'metaDescription' => 'Layanan pelancaran pipa mampet, deteksi pipa bocor, dan inspeksi kamera CCTV 24 jam bergaransi.',
    'canonicalUrl'    => '',
    'schemas'         => [],
    'ogImage'         => '',
    'ogType'          => 'website',
    'robots'          => 'index, follow',
    'keywords'        => 'jasa saluran pipa mampet, jasa saluran mampet, rootera plumbing',
])

@php
    /* ── Sanitise title ────────────────────────────────────────────── */
    $safeTitle       = trim(strip_tags((string) $metaTitle));
    $safeDescription = trim(strip_tags((string) $metaDescription));
    $safeKeywords    = trim(strip_tags((string) $keywords));

    /* ── Canonical URL ─────────────────────────────────────────────── */
    $effectiveUrl = $canonicalUrl ?: url()->current();
    // Force HTTPS
    if (str_starts_with($effectiveUrl, 'http://')) {
        $effectiveUrl = 'https://' . substr($effectiveUrl, 7);
    }

    /* ── OG Image ──────────────────────────────────────────────────── */
    $defaultOgImage  = secure_url('images/og/rootera-default.jpg');
    $rawOgImage      = (string) $ogImage;

    if (empty($rawOgImage)) {
        $effectiveOgImage = $defaultOgImage;
    } elseif (str_starts_with($rawOgImage, 'http://')) {
        $effectiveOgImage = 'https://' . substr($rawOgImage, 7);
    } elseif (str_starts_with($rawOgImage, 'https://')) {
        $effectiveOgImage = $rawOgImage;
    } else {
        $effectiveOgImage = secure_url(ltrim($rawOgImage, '/'));
    }

    /* ── OG Image MIME type ────────────────────────────────────────── */
    $imgExt       = strtolower(pathinfo(parse_url($effectiveOgImage, PHP_URL_PATH), PATHINFO_EXTENSION));
    $ogImageMime  = match($imgExt) {
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'webp' => 'image/webp',
        default => 'image/jpeg',
    };
@endphp

{{-- ════════════════════════════════════════════════════════════════════
     TITLE & BASIC META
     ════════════════════════════════════════════════════════════════════ --}}
<title>{{ $safeTitle }}</title>
<meta name="description" content="{{ $safeDescription }}">

@if($safeKeywords)
    <meta name="keywords" content="{{ $safeKeywords }}">
@endif

<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $effectiveUrl }}">

{{-- ════════════════════════════════════════════════════════════════════
     OPEN GRAPH (Facebook / WhatsApp / LinkedIn)
     ════════════════════════════════════════════════════════════════════ --}}
<meta property="og:type"              content="{{ $ogType }}">
<meta property="og:url"               content="{{ $effectiveUrl }}">
<meta property="og:title"             content="{{ $safeTitle }}">
<meta property="og:description"       content="{{ $safeDescription }}">
<meta property="og:image"             content="{{ $effectiveOgImage }}">
<meta property="og:image:secure_url"  content="{{ $effectiveOgImage }}">
<meta property="og:image:type"        content="{{ $ogImageMime }}">
<meta property="og:image:width"       content="1200">
<meta property="og:image:height"      content="630">
<meta property="og:site_name"         content="Rootera Plumbing">
<meta property="og:locale"            content="id_ID">

{{-- ════════════════════════════════════════════════════════════════════
     TWITTER CARD
     ════════════════════════════════════════════════════════════════════ --}}
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:site"        content="@RooteraPlumbing">
<meta name="twitter:url"         content="{{ $effectiveUrl }}">
<meta name="twitter:title"       content="{{ $safeTitle }}">
<meta name="twitter:description" content="{{ $safeDescription }}">
<meta name="twitter:image"       content="{{ $effectiveOgImage }}">

{{-- ════════════════════════════════════════════════════════════════════
     JSON-LD STRUCTURED DATA INJECTION
     Safely renders each pre-encoded schema string passed via $schemas.
     Uses {!! !!} — the strings are already sanitised by json_encode()
     with JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE.
     ════════════════════════════════════════════════════════════════════ --}}
@if(!empty($schemas))
    @foreach($schemas as $schemaJson)
        @if(!empty($schemaJson))
            <script type="application/ld+json">
            {!! $schemaJson !!}
            </script>
        @endif
    @endforeach
@endif
