<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Dynamic SEO Meta Tags --}}
    <title>{{ $seo['title'] ?? 'Rootera – Jasa Pipa & Saluran Mampet Profesional' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Rootera solusi terpercaya pipa dan wastafel mampet. Profesional, cepat, bergaransi.' }}">
    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">
    
    @if(isset($seo['is_indexable']) && !$seo['is_indexable'])
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ $seo['canonical'] ?? url()->current() }}">
    <meta property="og:title"       content="{{ $seo['title'] ?? 'Rootera' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
    <meta property="og:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}">
    <meta property="og:site_name"   content="Rootera">
    <meta property="og:locale"      content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $seo['title'] ?? 'Rootera' }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
    <meta name="twitter:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}">

    {{-- Schema Markup: Dynamic structured data --}}
    @if (View::hasSection('schema-markup'))
        @yield('schema-markup')
    @else
        <?php
        $fallbackSchema = [
          "@context" => "https://schema.org",
          "@type" => ["Plumber", "LocalBusiness"],
          "name" => "Rootera Plumbing - Jasa Saluran Pipa Mampet",
          "description" => "Jasa cleaning service pipa, wastafel mampet, cuci toren, dan instalasi pipa baru profesional tanpa bongkar.",
          "@id" => url('/') . "#organization",
          "url" => url('/'),
          "telephone" => "+6281385404000",
          "logo" => asset('images/logo-hijau.png'),
          "image" => asset('images/JnJ.jpeg'),
          "priceRange" => "Rp",
          "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo",
            "addressLocality" => "Jakarta Timur",
            "addressRegion" => "DKI Jakarta",
            "postalCode" => "13770",
            "addressCountry" => "ID"
          ],
          "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => -6.3275975,
            "longitude" => 106.8627125
          ],
          "openingHoursSpecification" => [
            "@type" => "OpeningHoursSpecification",
            "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens" => "00:00",
            "closes" => "23:59"
          ],
          "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => "4.9",
            "reviewCount" => "2300"
          ],
          "areaServed" => [
            "Jabodetabek",
            "Lampung",
            "Bandung",
            "Yogyakarta",
            "Semarang",
            "Cirebon",
            "Solo"
          ],
          "sameAs" => [
            "https://www.instagram.com/Rootera_plumbing?igsh=c2NkbXA1b3h6MTVy",
            "https://www.facebook.com/Rootera.id",
            "https://www.tiktok.com/@Rootera_plumbing?_r=1&_t=ZS-97nM89aiu5h"
          ]
        ];
        ?>
        <script type="application/ld+json">
        {!! json_encode($fallbackSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-cropped.png') }}">

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
