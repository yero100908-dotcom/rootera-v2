<!DOCTYPE html>
<html lang="id" class="w-full h-full overflow-x-hidden">
<head>
    <!-- Google tag (gtag.js) - User Interaction Delay for Performance -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      (function() {
        var gaId = '{{ config('services.ga4_id', env('GA4_TRACKING_ID', 'G-DGGQRFGDFL')) }}';
        var loaded = false;
        function loadGA() {
          if (loaded) return;
          loaded = true;
          gtag('config', gaId);
          var s = document.createElement('script');
          s.async = true;
          s.src = 'https://www.googletagmanager.com/gtag/js?id=' + gaId;
          document.head.appendChild(s);
        }
        var events = ['scroll', 'pointerdown', 'touchstart', 'mousemove', 'keydown'];
        events.forEach(function(e) {
          window.addEventListener(e, loadGA, { once: true, passive: true });
        });
        setTimeout(loadGA, 4000);
      })();
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Mobile Web App & Theme Color Standards --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#0B2545">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#071930">
    <meta name="msapplication-navbutton-color" content="#0B2545">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="S0NcIdbOStrvK_9vfK7mA4CnO2IhMDg3kp4_QLZHYRQ" />

    {{-- Dynamic GEO Meta Tags (Target City / District OR Headquarters: Cijantung, Jakarta Timur) --}}
    <?php
        $geoLat = -6.3275278;
        $geoLng = 106.8627778;
        $geoPlaceName = "Jakarta Timur";
        $geoRegion = "ID-JK";

        if (isset($district) && !empty($district->latitude) && !empty($district->longitude)) {
            $geoLat = (float) $district->latitude;
            $geoLng = (float) $district->longitude;
            $geoPlaceName = $district->name . ", " . ($city->name ?? 'Jabodetabek');
        } elseif (isset($city) && !empty($city->latitude) && !empty($city->longitude)) {
            $geoLat = (float) $city->latitude;
            $geoLng = (float) $city->longitude;
            $geoPlaceName = $city->full_name ?? $city->name;
            if (isset($city->province)) {
                $provName = strtolower($city->province->name ?? '');
                if (str_contains($provName, 'jawa barat')) {
                    $geoRegion = "ID-JB";
                } elseif (str_contains($provName, 'banten')) {
                    $geoRegion = "ID-BT";
                } elseif (str_contains($provName, 'jawa tengah')) {
                    $geoRegion = "ID-JT";
                } elseif (str_contains($provName, 'lampung')) {
                    $geoRegion = "ID-LA";
                }
            }
        }
    ?>
    <meta name="geo.region" content="{{ $geoRegion }}" />
    <meta name="geo.placename" content="{{ $geoPlaceName }}" />
    <meta name="geo.position" content="{{ $geoLat }};{{ $geoLng }}" />
    <meta name="ICBM" content="{{ $geoLat }}, {{ $geoLng }}" />
    <meta name="author" content="Rootera Plumbing (J&J Group)" />

    {{-- LCP Image Preload for Homepage (Responsive Mobile & Desktop) --}}
    @if(request()->routeIs('home') || request()->path() === '/')
        <link rel="preload" as="image" href="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-mobile.webp') }}" media="(max-width: 767px)" type="image/webp" fetchpriority="high">
        <link rel="preload" as="image" href="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp') }}" media="(min-width: 768px)" type="image/webp" fetchpriority="high">
    @endif
    @stack('preloads')

    {{-- Dynamic SEO Meta Tags & Open Graph Configuration --}}
    @php
        $defaultOgImage = secure_url('images/og/rootera-default.jpg');

        // Resolve title
        if (View::hasSection('meta_title')) {
            $effectiveTitle = trim(View::getSection('meta_title'));
        } elseif (!empty($seo['title'])) {
            $effectiveTitle = $seo['title'];
        } elseif (request()->routeIs('home') || request()->path() === '/') {
            $effectiveTitle = 'Rootera Plumbing — Jasa Saluran Pipa Mampet No. 1 & Tanpa Bongkar';
        } else {
            $effectiveTitle = $title ?? 'Rootera Plumbing - Jasa Saluran Pipa Mampet & Deteksi CCTV 24 Jam';
        }

        // Resolve description
        if (View::hasSection('meta_description')) {
            $effectiveDescription = trim(View::getSection('meta_description'));
        } elseif (!empty($seo['description'])) {
            $effectiveDescription = $seo['description'];
        } else {
            $effectiveDescription = 'Layanan pelancaran pipa mampet, deteksi pipa bocor, dan inspeksi kamera CCTV 24 jam bergaransi.';
        }

        // Resolve OG Image
        if (View::hasSection('og_image')) {
            $rawOgImage = trim(View::getSection('og_image'));
        } elseif (!empty($seo['og_image'])) {
            $rawOgImage = $seo['og_image'];
        } else {
            $rawOgImage = $ogImage ?? '';
        }

        if (empty($rawOgImage)) {
            $effectiveOgImage = $defaultOgImage;
        } elseif (\Illuminate\Support\Str::startsWith($rawOgImage, ['http://', 'https://'])) {
            $effectiveOgImage = \Illuminate\Support\Str::startsWith($rawOgImage, 'http://')
                ? 'https://' . substr($rawOgImage, 7)
                : $rawOgImage;
        } else {
            $effectiveOgImage = secure_url(ltrim($rawOgImage, '/'));
        }

        // Detect mime type for og:image:type
        $imgExt = strtolower(pathinfo(parse_url($effectiveOgImage, PHP_URL_PATH), PATHINFO_EXTENSION));
        $ogImageType = match($imgExt) {
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            default => 'image/jpeg',
        };

        // Resolve URL
        if (View::hasSection('canonical')) {
            $effectiveUrl = trim(View::getSection('canonical'));
        } elseif (!empty($seo['canonical'])) {
            $effectiveUrl = $seo['canonical'];
        } else {
            $effectiveUrl = url()->current();
        }
    @endphp

    <title>{{ $effectiveTitle }}</title>
    <meta name="description" content="{{ $effectiveDescription }}">

    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @else
        <meta name="keywords" content="{{ $seo['keywords'] ?? 'jasa saluran pipa mampet, jasa saluran mampet, jasa pipa mampet, jasa sedot wc, jasa perbaikan pipa saluran air, saluran mampet jabodetabek, rootera plumbing, rootera' }}">
    @endif

    <link rel="canonical" href="{{ $effectiveUrl }}">
    
    @if(isset($seo['is_indexable']) && !$seo['is_indexable'])
        <meta name="robots" content="noindex, follow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    <!-- Open Graph / WhatsApp / Facebook -->
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $effectiveUrl }}">
    <meta property="og:title" content="{{ $effectiveTitle }}">
    <meta property="og:description" content="{{ $effectiveDescription }}">
    <meta property="og:image" content="{{ $effectiveOgImage }}">
    <meta property="og:image:secure_url" content="{{ $effectiveOgImage }}">
    <meta property="og:image:type" content="{{ $ogImageType }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Rootera Plumbing">
    <meta property="og:see_also" content="https://www.youtube.com/@RooteraPlumbing">
    <meta property="og:see_also" content="https://www.instagram.com/rootera_plumbing/">
    <meta property="og:see_also" content="https://www.tiktok.com/@rooteraplumbing.id">
    <meta property="og:see_also" content="https://x.com/RooteraPlumbing">
    <meta property="og:see_also" content="https://www.linkedin.com/in/rooteraplumbing/">
    <meta property="og:see_also" content="https://id.pinterest.com/rooteraplumbing/">
    <meta property="og:see_also" content="https://www.facebook.com/people/Jasa-Saluran-Pipa-Mampet/61591857691922/">
    <meta property="og:see_also" content="https://maps.google.com/?cid=16012437648585635749">
    <meta property="og:locale" content="id_ID">

    @if(isset($seo['og_type']) && $seo['og_type'] === 'article')
        @if(!empty($seo['published_time']))
            <meta property="article:published_time" content="{{ $seo['published_time'] }}">
        @endif
        @if(!empty($seo['modified_time']))
            <meta property="article:modified_time" content="{{ $seo['modified_time'] }}">
        @endif
        @if(!empty($seo['section']))
            <meta property="article:section" content="{{ $seo['section'] }}">
        @endif
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $effectiveUrl }}">
    <meta name="twitter:title" content="{{ $effectiveTitle }}">
    <meta name="twitter:description" content="{{ $effectiveDescription }}">
    <meta name="twitter:image" content="{{ $effectiveOgImage }}">

    {{-- Schema Markup: Dynamic structured data --}}
    @hasSection('structured_data')
        @yield('structured_data')
    @else
        @hasSection('schema-markup')
            @yield('schema-markup')
        @else
            <?php
            $fallbackSchema = [
              "@context" => "https://schema.org",
              "@graph" => [
                [
                  "@type" => ["LocalBusiness", "Plumber", "HomeAndConstructionBusiness"],
                  "name" => "Rootera Plumbing",
                  "alternateName" => ["Rootera", "Rootera Indonesia", "J&J Group Plumbing Division"],
                  "description" => "Layanan profesional jasa saluran pipa mampet, wastafel tersumbat, kran air, dan plumbing service B2C & B2B oleh Rootera Plumbing (J&J Group).",
                  "@id" => url('/') . "#organization",
                  "url" => url('/'),
                  "telephone" => "+6281385404000",
                  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
                  "image" => asset('images/JnJ.webp'),
                  "priceRange" => "$$",
                  "parentOrganization" => [
                    "@type" => "Organization",
                    "name" => "J&J GROUP",
                    "url" => url('/')
                  ],
                  "knowsAbout" => [
                    "Pelancaran Pipa Mampet Tanpa Bongkar",
                    "B2B Preventive Plumbing Maintenance",
                    "Hydro Jetting Industrial System",
                    "CCTV Pipe Inspection",
                    "Residential Door-to-Door Plumbing Service"
                  ],
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
                    "latitude" => -6.3275278,
                    "longitude" => 106.8627778
                  ],
                  "openingHoursSpecification" => [
                    "@type" => "OpeningHoursSpecification",
                    "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                    "opens" => "00:00",
                    "closes" => "23:59"
                  ],
                  "areaServed" => [
                    "Jabodetabek",
                    "Semarang",
                    "Bandar Lampung"
                  ],
                  "sameAs" => [
                    "https://www.youtube.com/@RooteraPlumbing",
                    "https://www.instagram.com/rootera_plumbing/",
                    "https://www.tiktok.com/@rooteraplumbing.id",
                    "https://x.com/RooteraPlumbing",
                    "https://www.linkedin.com/in/rooteraplumbing/",
                    "https://id.pinterest.com/rooteraplumbing/",
                    "https://www.facebook.com/people/Jasa-Saluran-Pipa-Mampet/61591857691922/",
                    "https://maps.google.com/?cid=16012437648585635749"
                  ]
                ],
                [
                  "@type" => "Service",
                  "serviceType" => "Jasa Saluran Pipa Mampet",
                  "provider" => [
                    "@id" => url('/') . "#organization"
                  ],
                  "areaServed" => [
                    "@type" => "State",
                    "name" => "Jabodetabek"
                  ]
                ]
              ]
            ];
            ?>
            <script type="application/ld+json">
            {!! json_encode($fallbackSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
            </script>
        @endif
    @endif

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/brand/favicon-rooteraplumbing-jasa-saluran-pipa-mampet.png') }}">

    <style>[x-cloak] { display: none !important; }</style>

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen w-full max-w-full bg-white text-slate-800 antialiased overflow-x-hidden relative m-0 p-0">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main id="main-content" class="w-full max-w-full overflow-hidden min-h-screen pb-20 md:pb-0">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Floating WhatsApp Button (Desktop) & Sticky Mobile CTA Bar --}}
    @include('components.whatsapp-float')
    @include('components.mobile-sticky-cta')

    @stack('scripts')
</body>
</html>
