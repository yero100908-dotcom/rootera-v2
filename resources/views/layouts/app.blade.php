<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Dynamic SEO Meta Tags --}}
    <title>{{ $seo['title'] ?? 'ROOTERA – Jasa Pipa & Saluran Mampet Profesional' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'ROOTERA solusi terpercaya pipa dan wastafel mampet. Profesional, cepat, bergaransi.' }}">
    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">
    
    @if(isset($seo['is_indexable']) && !$seo['is_indexable'])
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ $seo['canonical'] ?? url()->current() }}">
    <meta property="og:title"       content="{{ $seo['title'] ?? 'ROOTERA' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
    <meta property="og:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}">
    <meta property="og:site_name"   content="ROOTERA">
    <meta property="og:locale"      content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $seo['title'] ?? 'ROOTERA' }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
    <meta name="twitter:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}">

    {{-- Schema Markup: Local Business --}}
    <script type="application/ld+json">
    @verbatim
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "ROOTERA",
      "description": "Jasa cleaning service pipa dan wastafel mampet profesional",
      "telephone": "+6281385404000",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Jakarta",
        "addressRegion": "DKI Jakarta",
        "addressCountry": "ID"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-6.2088",
        "longitude": "106.8456"
      },
      "openingHours": "Mo-Su 00:00-23:59",
      "priceRange": "Rp",
      "sameAs": [
        "https://www.instagram.com/rootera_plumbing?igsh=c2NkbXA1b3h6MTVy",
        "https://www.facebook.com/rootera.id",
        "https://www.tiktok.com/@rootera_plumbing?_r=1&_t=ZS-97nM89aiu5h"
      ]
    }
    @endverbatim
    </script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Floating WhatsApp Button --}}
    @include('components.whatsapp-float')

    @stack('scripts')
</body>
</html>
