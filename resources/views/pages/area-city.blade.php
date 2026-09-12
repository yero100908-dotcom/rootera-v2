@extends('layouts.app')

@section('structured_data')
<?php
$citySlug = (isset($city) && is_object($city) && isset($city->slug)) ? $city->slug : '';
$cityName = (isset($city) && is_object($city)) ? ($city->full_name ?? $city->name ?? 'Kota') : 'Kota';
$cityNameClean = (isset($city) && is_object($city)) ? ($city->name ?? $cityName) : $cityName;
$cityCanonical = url("/jasa-saluran-mampet/{$citySlug}");
$cityPhone = (isset($city) && is_object($city) && !empty($city->whatsapp_number)) ? $city->whatsapp_number : "6281385404000";
$cityProvName = (isset($city) && is_object($city) && isset($city->province) && is_object($city->province)) ? ($city->province->name ?? "Indonesia") : "Indonesia";

$isLampungArea = ($citySlug === 'bandar-lampung' || (isset($city->province) && str_contains(strtolower($city->province->slug ?? ''), 'lampung')));
$isSemarangArea = ($citySlug === 'semarang' || (isset($city->province) && str_contains(strtolower($city->province->slug ?? ''), 'jawa-tengah')));

if ($isLampungArea) {
    $fallbackStreet = "Jl. Danau Towuti No. 9";
    $fallbackLocality = "Kedaton, Surabaya, Kota Bandar Lampung";
    $fallbackPostal = "35148";
    $fallbackLat = -5.388639;
    $fallbackLng = 105.265417;
} elseif ($isSemarangArea) {
    $fallbackStreet = "Jl. Simpang Lima No. 1";
    $fallbackLocality = "Semarang Tengah, Kota Semarang";
    $fallbackPostal = "50134";
    $fallbackLat = -6.9902958;
    $fallbackLng = 110.4227318;
} else {
    // Default Jabodetabek / HQ
    $fallbackStreet = "Jl. Gongseng Raya No. 9";
    $fallbackLocality = "Cijantung, Pasar Rebo, Kota Jakarta Timur";
    $fallbackPostal = "13770";
    $fallbackLat = -6.3275975;
    $fallbackLng = 106.8627125;
}

$cityAddress = [
  "@type" => "PostalAddress",
  "streetAddress" => (isset($city) && !empty($city->street_address)) ? $city->street_address : $fallbackStreet,
  "addressLocality" => (isset($city) && !empty($city->district_locality)) ? $city->district_locality : $fallbackLocality,
  "addressRegion" => $cityProvName,
  "postalCode" => (isset($city) && !empty($city->postal_code)) ? $city->postal_code : $fallbackPostal,
  "addressCountry" => "ID"
];

$areaServedList = [
  [
    "@type" => "City",
    "name" => $cityNameClean
  ]
];
if (isset($city) && is_object($city) && isset($city->districts) && count($city->districts) > 0) {
  foreach ($city->districts as $dst) {
    $areaServedList[] = [
      "@type" => "AdministrativeArea",
      "name" => $dst->name
    ];
  }
}

$cityBusinessSchema = [
  "@type" => ["PlumbingService", "LocalBusiness", "EmergencyService"],
  "@id" => $cityCanonical . "#organization",
  "name" => "Rootera Plumbing " . $cityNameClean,
  "alternateName" => ["Rootera " . $cityNameClean, "Jasa Saluran Pipa Mampet " . $cityNameClean, "Tukang Pipa Mampet " . $cityNameClean],
  "description" => $seo['description'] ?? "Pusat layanan pelancaran saluran pipa mampet 24 jam di {$cityNameClean} bergaransi resmi.",
  "url" => $cityCanonical,
  "telephone" => "+" . (isset($city) && !empty($city->branch_phone) ? $city->branch_phone : $cityPhone),
  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "image" => $seo['og_image'] ?? asset('images/JnJ.webp'),
  "priceRange" => "Rp 400.000 - Rp 1.500.000",
  "parentOrganization" => [
    "@type" => "Organization",
    "name" => "J&J GROUP",
    "url" => url('/')
  ],
  "address" => $cityAddress,
  "areaServed" => $areaServedList,
  "aggregateRating" => [
    "@type" => "AggregateRating",
    "ratingValue" => (string) ($city->rating_value ?? 4.9),
    "reviewCount" => (string) ($city->review_count ?? 85),
    "bestRating" => "5",
    "worstRating" => "1"
  ],
  "openingHoursSpecification" => [
    [
      "@type" => "OpeningHoursSpecification",
      "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
      "opens" => "00:00",
      "closes" => "23:59"
    ]
  ],
  "hasOfferCatalog" => [
    "@type" => "OfferCatalog",
    "name" => "Katalog Layanan Pipa Mampet " . $cityNameClean,
    "itemListElement" => [
      [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa Wastafel & Kitchen Sink Mampet " . $cityNameClean,
          "description" => "Pelancaran kerak lemak jenuh dapur tanpa membongkar meja keramik."
        ]
      ],
      [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa Kloset WC & Toilet Tersumbat " . $cityNameClean,
          "description" => "Penanganan WC meluap tersumbat tanpa sedot tinja."
        ]
      ],
      [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa Floor Drain Kamar Mandi " . $cityNameClean,
          "description" => "Pembersihan rontokan rambut, gumpalan sabun & endapan pasir ubin."
        ]
      ],
      [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa Pelancaran Pipa Utama, Got & Talang Air " . $cityNameClean,
          "description" => "Pembersihan pipa pembuangan utama, saluran got luar, serta talang air atap tanpa bongkar saluran."
        ]
      ]
    ]
  ]
];

$latVal = (isset($city) && !empty($city->latitude)) ? (float)$city->latitude : $fallbackLat;
$lngVal = (isset($city) && !empty($city->longitude)) ? (float)$city->longitude : $fallbackLng;

$cityBusinessSchema["geo"] = [
  "@type" => "GeoCoordinates",
  "latitude" => $latVal,
  "longitude" => $lngVal
];
$cityBusinessSchema["hasMap"] = "https://www.google.com/maps?q={$latVal},{$lngVal}";

$cityBreadcrumbs = [
  "@type" => "BreadcrumbList",
  "@id" => $cityCanonical . "#breadcrumb",
  "itemListElement" => [
    [
      "@type" => "ListItem",
      "position" => 1,
      "name" => "Beranda",
      "item" => url('/')
    ],
    [
      "@type" => "ListItem",
      "position" => 2,
      "name" => "Area Layanan",
      "item" => route('area-layanan')
    ],
    [
      "@type" => "ListItem",
      "position" => 3,
      "name" => $cityNameClean,
      "item" => $cityCanonical
    ]
  ]
];

$graphSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    $cityBusinessSchema,
    $cityBreadcrumbs
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($graphSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. HERO SECTION (SPLIT MODERN & FLOATING TRUST BADGES)                     --}}
{{-- ========================================================================= --}}
<section class="relative bg-gradient-to-b from-[#0A2E78] via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden border-b-4 border-[#169F81]">
    {{-- Radial glow effect --}}
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[400px] bg-[#169F81]/20 blur-[130px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-4">
            <x-breadcrumbs :items="[
                ['name' => 'Beranda', 'url' => url('/')],
                ['name' => 'Area Layanan', 'url' => route('area-layanan')],
                ['name' => $cityName, 'url' => '']
            ]" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            {{-- Left Column: Copywriting & CTA --}}
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 bg-[#169F81]/20 border border-[#169F81]/40 text-emerald-300 px-4 py-1.5 rounded-full text-xs font-bold mb-5 backdrop-blur-md shadow-lg shadow-emerald-950/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>📍 Pusat Layanan &amp; Komando Armada Kota {{ $cityNameClean }}</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight mb-4 text-white font-['Plus_Jakarta_Sans',sans-serif]">
                    {!! $heroHeadline ?? ("Jasa Saluran Pipa Mampet <span class='text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-200'>" . $cityName . "</span> 24 Jam") !!}
                </h1>

                <p class="text-slate-200 text-sm sm:text-base lg:text-lg leading-relaxed mb-6 max-w-2xl">
                    {!! $heroSubtitle ?? ("Solusi profesional terpercaya untuk pelancaran wastafel, floor drain kamar mandi, kloset WC, &amp; pipa industri di <strong>" . $cityName . "</strong>. Dikerjakan tanpa bongkar lantai oleh <strong>Rootera Plumbing (J&amp;J Group)</strong> bergaransi resmi tuntas 100%.") !!}
                </p>

                {{-- Quick Metrics Bar --}}
                <div class="grid grid-cols-3 gap-3 mb-8 max-w-xl">
                    <div class="bg-white/10 border border-white/15 rounded-2xl p-3 backdrop-blur-md text-center">
                        <div class="text-base sm:text-xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">10+ Posko</div>
                        <div class="text-[10px] sm:text-xs text-slate-300">Siaga Se-{{ $cityNameClean }}</div>
                    </div>
                    <div class="bg-white/10 border border-white/15 rounded-2xl p-3 backdrop-blur-md text-center">
                        <div class="text-base sm:text-xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">30-45 Mnt</div>
                        <div class="text-[10px] sm:text-xs text-slate-300">Respon Kecamatan</div>
                    </div>
                    <div class="bg-white/10 border border-white/15 rounded-2xl p-3 backdrop-blur-md text-center">
                        <div class="text-base sm:text-xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">30 Hari</div>
                        <div class="text-[10px] sm:text-xs text-slate-300">Garansi Resmi</div>
                    </div>
                </div>

                {{-- CTA Group --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya butuh jasa pelancar pipa mampet di area ' . $cityName . '. Bisa panggil teknisi?') }}" 
                       target="_blank" rel="noopener" 
                       class="inline-flex items-center justify-center gap-3 bg-[#169F81] hover:bg-emerald-600 text-white font-bold text-sm sm:text-base px-8 py-4 rounded-2xl shadow-xl shadow-emerald-900/40 transition-all hover:scale-[1.02] active:scale-95 text-decoration-none">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        <span>Panggil Teknisi {{ $cityNameClean }} (24 Jam)</span>
                    </a>

                    <a href="#estimasi-biaya" 
                       class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold text-sm sm:text-base px-6 py-4 rounded-2xl border border-white/20 backdrop-blur-md transition-all text-decoration-none">
                        <span>Jelajahi Estimasi &amp; Posko Armada ↓</span>
                    </a>
                </div>
            </div>

            {{-- Right Column: Visual Showcase & Floating Glassmorphism Badges --}}
            <div class="lg:col-span-5 relative mt-6 lg:mt-0">
                <div class="relative rounded-3xl overflow-hidden border-4 border-white/10 shadow-2xl shadow-slate-950/50 group">
                    <img src="{{ asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp') }}" 
                         alt="Teknisi Rootera Plumbing {{ $cityName }}" 
                         class="w-full h-[380px] sm:h-[440px] object-cover group-hover:scale-105 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>

                    {{-- Floating Glassmorphism Badge 1 (Kiri Atas) --}}
                    <div class="absolute top-5 left-5 bg-slate-900/80 backdrop-blur-md border border-white/20 px-4 py-2.5 rounded-2xl text-xs font-semibold text-white shadow-xl flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>⚡ Respon Cepat {{ $cityNameClean }}: {{ $city->estimated_arrival ?? '15–30 Menit Tiba' }}</span>
                    </div>

                    {{-- Floating Glassmorphism Badge 2 (Kanan Bawah) --}}
                    <div class="absolute bottom-5 right-5 bg-slate-900/85 backdrop-blur-md border border-white/20 p-4 rounded-2xl text-white shadow-2xl">
                        <div class="flex items-center gap-2">
                            <span class="text-amber-400 text-sm">⭐⭐⭐⭐⭐</span>
                            <span class="font-bold text-xs">4.9 / 5.0</span>
                        </div>
                        <div class="text-[11px] text-slate-300 font-medium mt-0.5">500+ Proyek {{ $cityNameClean }} Bergaransi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if((isset($city) && $city->slug === 'bandar-lampung') || (isset($city->province) && $city->province->slug === 'lampung'))
    <x-workshop-posko-bandar-lampung :city="$city" />
@endif

{{-- ========================================================================= --}}
{{-- 2. ESTIMASI BIAYA & POPULAR HIGHLIGHT (PURE WHITE #FFFFFF)                --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-white border-b border-slate-200" id="estimasi-biaya">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">ESTIMASI BIAYA TRANSPARAN</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Daftar Biaya &amp; Estimasi Layanan {{ $cityNameClean }}
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Estimasi biaya pelancaran pipa tersumbat di {{ $cityNameClean }}. Tanpa biaya tersembunyi, sistem No Result No Pay (Tuntas Baru Bayar).
            </p>
        </div>

        {{-- 4 Pricing Cards with Popular Highlight --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card 1: Wastafel / Kitchen Sink (POPULAR HIGHLIGHT) --}}
            <div class="bg-emerald-50/40 rounded-3xl p-6 border-2 border-[#169F81] shadow-xl relative flex flex-col justify-between scale-[1.02] group hover:shadow-2xl transition-all">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-[#169F81] text-white text-[11px] font-bold px-3.5 py-1 rounded-full uppercase tracking-wider shadow-md">
                    🔥 Paling Sering Dipesan
                </div>
                <div>
                    <div class="text-2xl mb-2">🍽️</div>
                    <h3 class="font-extrabold text-slate-900 text-lg font-['Plus_Jakarta_Sans',sans-serif]">Wastafel &amp; Kitchen Sink</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Pelancaran kerak lemak jenuh dapur tanpa membongkar meja keramik.</p>
                    <div class="mt-4 pt-4 border-t border-emerald-200">
                        <div class="text-xs text-slate-500 font-medium">Mulai dari</div>
                        <div class="text-2xl font-extrabold text-[#169F81]">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau tanya estimasi biaya pelancaran Wastafel mampet di ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-emerald-600 transition-colors">
                    Order Wastafel {{ $cityNameClean }}
                </a>
            </div>

            {{-- Card 2: Kloset WC & Toilet (POPULAR HIGHLIGHT) --}}
            <div class="bg-emerald-50/40 rounded-3xl p-6 border-2 border-[#169F81] shadow-xl relative flex flex-col justify-between group hover:shadow-2xl transition-all">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[11px] font-bold px-3.5 py-1 rounded-full uppercase tracking-wider shadow-md">
                    ⚡ Respon Cepat 24 Jam
                </div>
                <div>
                    <div class="text-2xl mb-2">🚽</div>
                    <h3 class="font-extrabold text-slate-900 text-lg font-['Plus_Jakarta_Sans',sans-serif]">Kloset WC &amp; Toilet</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Penanganan WC meluap / tersumbat pembalut &amp; tisu tanpa sedot tinja.</p>
                    <div class="mt-4 pt-4 border-t border-emerald-200">
                        <div class="text-xs text-slate-500 font-medium">Mulai dari</div>
                        <div class="text-2xl font-extrabold text-[#169F81]">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau tanya estimasi biaya pelancaran Kloset WC mampet di ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-emerald-600 transition-colors">
                    Order WC {{ $cityNameClean }}
                </a>
            </div>

            {{-- Card 3: Floor Drain Kamar Mandi --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md relative flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all">
                <div>
                    <div class="text-2xl mb-2">🚿</div>
                    <h3 class="font-extrabold text-slate-900 text-lg font-['Plus_Jakarta_Sans',sans-serif]">Floor Drain Kamar Mandi</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Pembersihan rontokan rambut, gumpalan sabun, &amp; endapan pasir ubin.</p>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="text-xs text-slate-500 font-medium">Mulai dari</div>
                        <div class="text-2xl font-extrabold text-slate-900">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau tanya estimasi biaya Floor Drain kamar mandi mampet di ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-slate-900 text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-[#169F81] transition-colors">
                    Order Kamar Mandi
                </a>
            </div>

            {{-- Card 4: Pipa Utama, Got & Talang --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md relative flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all">
                <div>
                    <div class="w-11 h-11 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-[#169F81] flex items-center justify-center mb-3 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16M4 5v4a2 2 0 002 2h12a2 2 0 002-2V5M9 11v8a2 2 0 002 2h2a2 2 0 002-2v-8"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-lg font-['Plus_Jakarta_Sans',sans-serif]">Pipa Utama, Got &amp; Talang</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">Pembersihan pipa pembuangan utama, saluran got luar, serta talang air atap dari endapan lumpur, pasir, sampah, dan daun kering tanpa bongkar saluran.</p>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="text-xs text-slate-500 font-medium">Mulai dari</div>
                        <div class="text-2xl font-extrabold text-slate-900">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera Plumbing, saya ingin konsultasi dan pesan layanan pelancaran Pipa Utama / Got / Talang air mampet di ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-slate-900 text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-[#169F81] transition-colors">
                    Order Pipa Utama &amp; Talang
                </a>
            </div>
        </div>

        {{-- Jaminan Teks Mikro --}}
        <div class="mt-10 text-center text-xs sm:text-sm text-slate-600 font-medium bg-slate-50 p-4 rounded-2xl border border-slate-200/80 max-w-2xl mx-auto flex items-center justify-center gap-2 flex-wrap">
            <span>✓ Biaya transparan di awal</span>
            <span>•</span>
            <span>Tuntas baru bayar (No Result No Pay)</span>
            <span>•</span>
            <span>Garansi resmi 30 hari</span>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2.5. SEKSI MULTI-SEKTOR PROPERTI                                         --}}
{{-- ========================================================================= --}}
<x-multi-sector-grid :locationName="$cityNameClean" :whatsappNumber="$city->whatsapp_number ?? '6281385404000'" />

{{-- ========================================================================= --}}
{{-- 3. MENGAPA PILIH ROOTERA (COMPACT 2x2 MOBILE GRID & DUAL-TONE SVG)       --}}
{{-- ========================================================================= --}}
<section class="py-12 sm:py-20 bg-[#F8FAFC] border-b border-slate-200" id="keunggulan-utama">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-50 text-[#169F81] font-bold text-xs tracking-widest uppercase border border-emerald-200 mb-2.5 shadow-xs">
                ✨ KEUNGGULAN UTAMA
            </span>
            <h2 class="text-xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Mengapa Warga {{ $cityNameClean }} Memilih Rootera Plumbing?
            </h2>
            <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2 leading-relaxed max-w-2xl mx-auto">
                Standar kerja profesional bergaransi resmi dengan jaminan keamanan struktur bangunan tanpa membongkar lantai keramik.
            </p>
        </div>

        {{-- 4 Core Pillars Grid (2x2 on Mobile, 4-col on Desktop) --}}
        <div class="grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4 md:gap-6">
            {{-- Card 1: 100% Non-Bongkar --}}
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="bg-teal-50 text-[#169F81] rounded-2xl w-11 h-11 flex items-center justify-center flex-shrink-0 mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-[#169F81] group-hover:text-white transition-all duration-300 border border-teal-200/60 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        100% Non-Bongkar
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-snug">
                        Metode kabel spiral fleksibel meluncur ikuti belokan pipa tanpa merusak ubin keramik.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#169F81] shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-[#169F81] uppercase tracking-wider">Tanpa Merusak Ubin</span>
                </div>
            </div>

            {{-- Card 2: Garansi Resmi 30 Hari --}}
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="bg-blue-50 text-[#0A2E78] rounded-2xl w-11 h-11 flex items-center justify-center flex-shrink-0 mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-[#0A2E78] group-hover:text-white transition-all duration-300 border border-blue-200/60 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        Garansi 30 Hari
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-snug">
                        Jaminan tuntas 30 hari kalender. Jika mampet berulang pada titik sama, teknisi servis gratis.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#0A2E78] shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-[#0A2E78] uppercase tracking-wider">Garansi Resmi 30 Hari</span>
                </div>
            </div>

            {{-- Card 3: Respon 20–35 Menit --}}
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="bg-amber-50 text-amber-600 rounded-2xl w-11 h-11 flex items-center justify-center flex-shrink-0 mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 border border-amber-200/60 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        Respon Cepat
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-snug">
                        Armada posko siaga terdekat di wilayah {{ $cityNameClean }} siap meluncur 24 jam nonstop.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-amber-500 shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-amber-600 uppercase tracking-wider">Armada Siaga 24 Jam</span>
                </div>
            </div>

            {{-- Card 4: Bebas Soda Api --}}
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="bg-emerald-50 text-emerald-600 rounded-2xl w-11 h-11 flex items-center justify-center flex-shrink-0 mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 border border-emerald-200/60 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.4 19 2c1 2 2 4.1 2 7 0 4.4-3.6 8-8 8-1.2 0-2.3-.3-3.3-.9L11 20z"></path>
                            <path d="M12 10a6 6 0 0 0-4 5"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        0% Kimia Korosif
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-snug">
                        Tanpa soda api atau zat kimia berbahaya yang melunakkan dan merusak sambungan pipa PVC.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-emerald-500 shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-emerald-600 uppercase tracking-wider">100% Aman Untuk Pipa</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 4. KATALOG MESIN BENTO GRID (DARK INDUSTRIAL THEME #071C4D)               --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-[#071C4D] text-white relative overflow-hidden border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-emerald-400 font-bold text-xs tracking-widest uppercase bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20 backdrop-blur-md">ALAT &amp; TEKNOLOGI MODERN</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Armada &amp; Mesin Spesialis Plumbing di {{ $cityNameClean }}
            </h2>
            <p class="text-slate-300 text-sm sm:text-base mt-2">
                Peralatan standar industri Amerika dan Eropa yang menjamin kekuatan pelancaran tanpa pembongkaran pipa.
            </p>
        </div>

        {{-- Bento Grid Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Bento 1: Kartu Besar / Hero Equipment (Span 2 Kolom) --}}
            <div class="lg:col-span-2 bg-slate-900/90 border border-slate-800 p-8 rounded-3xl relative overflow-hidden group hover:border-[#169F81]/50 transition-all flex flex-col justify-between">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <span class="text-xs font-bold bg-[#169F81] text-white px-3 py-1 rounded-full uppercase tracking-wider">⚡ Sorotan Tekanan Tinggi</span>
                    <span class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/30">Tanpa Bongkar Keramik</span>
                </div>
                <div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Mesin Hydro-Jetting High-Pressure (300 Bar)</h3>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed max-w-xl mb-6">
                        Penyemprotan jet air bertekanan ultra-tinggi hingga 300 Bar yang mampu mengikis kerak lemak jenuh membatu, endapan sedimen semen, dan lumpur pekat di pipa drainase restoran &amp; pabrik {{ $cityNameClean }}.
                    </p>
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t border-slate-800 text-center">
                        <div class="p-3 bg-slate-800/60 rounded-2xl">
                            <div class="text-lg font-bold text-emerald-400">300 Bar</div>
                            <div class="text-[10px] text-slate-400">Tekanan Air</div>
                        </div>
                        <div class="p-3 bg-slate-800/60 rounded-2xl">
                            <div class="text-lg font-bold text-emerald-400">50 Meter</div>
                            <div class="text-[10px] text-slate-400">Jangkauan Selang</div>
                        </div>
                        <div class="p-3 bg-slate-800/60 rounded-2xl">
                            <div class="text-lg font-bold text-emerald-400">100% Clean</div>
                            <div class="text-[10px] text-slate-400">Pengikis Lemak</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bento 2: Mesin Ridgid --}}
            <div class="bg-slate-900/90 border border-slate-800 p-6 rounded-3xl flex flex-col justify-between hover:border-[#169F81]/50 transition-all">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl">🌀</span>
                        <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/30">Tanpa Bongkar</span>
                    </div>
                    <h3 class="font-extrabold text-white text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Mesin Cable Spiral Ridgid USA</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Kabel baja fleksibel Ridgid K-50/K-60 yang berotasi kecepatan tinggi menembus lekukan pipa P-Trap &amp; menghancurkan sumbatan rambut/kain.
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-800 text-[11px] text-emerald-400 font-semibold">
                    ✓ Rotasi Presisi Anti-Pecah Pipa
                </div>
            </div>

            {{-- Bento 3: Kamera CCTV Endoskopi --}}
            <div class="bg-slate-900/90 border border-slate-800 p-6 rounded-3xl flex flex-col justify-between hover:border-[#169F81]/50 transition-all">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl">📷</span>
                        <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/30">Tanpa Bongkar</span>
                    </div>
                    <h3 class="font-extrabold text-white text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Kamera CCTV Pipeline 1080p</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Endoskopi mikro waterproof berlampu LED melacak lokasi pasti titik sumbatan &amp; keretakan pipa secara real-time di layar monitor.
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-800 text-[11px] text-emerald-400 font-semibold">
                    ✓ Visual Deteksi Presisi 99.9%
                </div>
            </div>

            {{-- Bento 4: Floor Protection Kit (Span 2 Kolom) --}}
            <div class="lg:col-span-2 bg-slate-900/90 border border-slate-800 p-6 rounded-3xl flex flex-col justify-between hover:border-[#169F81]/50 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">🛡️</span>
                        <h3 class="font-extrabold text-white text-lg font-['Plus_Jakarta_Sans',sans-serif]">Floor Protection &amp; Anti-Spill Kit</h3>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/30">Garansi Kebersihan</span>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed mb-4">
                    Setiap teknisi dilengkapi pelindung alas sepatu (footwear covers), terpal penahan cipratan air limbah, serta cairan karbol antiseptik agar area kerja kembali bersih &amp; harum pasca-kerja.
                </p>
                <div class="text-[11px] text-slate-400 flex items-center gap-3 border-t border-slate-800 pt-3">
                    <span>• Footwear Boots Protect</span>
                    <span>• Terpal Splash Shield</span>
                    <span>• Karbol Sanitasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 5. INTERACTIVE BEFORE / AFTER SHOWCASE                                    --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">BUKTI PENGERJAAN NYATA</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Hasil Pengerjaan Sebelum vs Sesudah Hydro-Jetting
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Visual komparasi nyata pipa tersumbat kerak lemak jenuh yang kembali bersih lancar 100%.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            {{-- BEFORE Card --}}
            <div class="bg-rose-50/50 p-6 rounded-3xl border-2 border-rose-200 relative group overflow-hidden">
                <div class="inline-flex items-center gap-2 bg-rose-600 text-white text-xs font-bold px-3 py-1 rounded-full mb-4 shadow-md">
                    <span>⚠️ Kondisi Awal (Mampet Total)</span>
                </div>
                <div class="rounded-2xl overflow-hidden mb-4 border border-rose-200">
                    <img src="{{ asset('images/dokumentasi/sebelum-pipa-mampet-lemak.webp') }}" 
                         alt="Sebelum Hydro Jetting Rootera Plumbing" 
                         class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-1">Pipa Jenuh Kerak Lemak &amp; Endapan</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Air buangan meluap ke lantai wastafel &amp; timbul aroma menyengat akibat tumpukan minyak membatu.</p>
            </div>

            {{-- AFTER Card --}}
            <div class="bg-emerald-50/50 p-6 rounded-3xl border-2 border-[#169F81] relative group overflow-hidden shadow-xl">
                <div class="inline-flex items-center gap-2 bg-[#169F81] text-white text-xs font-bold px-3 py-1 rounded-full mb-4 shadow-md">
                    <span>✨ Hasil Akhir (Lancar 100%)</span>
                </div>
                <div class="rounded-2xl overflow-hidden mb-4 border border-emerald-200">
                    <img src="{{ asset('images/dokumentasi/after-gutter-resto-bersih-rootera.webp') }}" 
                         alt="Sesudah Hydro Jetting Rootera Plumbing" 
                         class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="font-bold text-slate-900 text-base mb-1">Pipa Plong &amp; Dinding Pipa Clean</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Kerak lemak terkikis habis oleh semprotan Hydro-jetting 300 Bar. Air mengalir deras tanpa hambatan.</p>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 5.2. KOMPARASI VISUAL (ROOTERA VS TUKANG PIPA TRADISIONAL)                --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-slate-900 text-white relative overflow-hidden border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-emerald-400 font-bold text-xs tracking-widest uppercase bg-emerald-500/10 px-3.5 py-1.5 rounded-full border border-emerald-500/20">KOMPARASI KUALITAS</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Rootera Plumbing vs Tukang Saluran Tradisional
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm mt-2">
                Mengapa ratusan pemilik rumah, resto, &amp; gedung di {{ $cityNameClean }} memilih standar profesional Rootera.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
            {{-- Rootera Column --}}
            <div class="bg-slate-800/90 border-2 border-[#169F81] rounded-3xl p-6 sm:p-8 shadow-2xl relative">
                <div class="inline-flex items-center gap-2 bg-[#169F81] text-white text-xs font-bold px-3 py-1 rounded-full mb-6 uppercase tracking-wider">
                    ✨ STANDAR ROOTERA PLUMBING
                </div>
                <ul class="space-y-4 text-xs sm:text-sm">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shrink-0">✓</span>
                        <div>
                            <strong class="text-white">100% Tanpa Bongkar Keramik:</strong>
                            <span class="text-slate-300 block">Kabel spiral Ridgid USA meluncur ikuti P-Trap tanpa merusak ubin.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shrink-0">✓</span>
                        <div>
                            <strong class="text-white">Garansi Resmi 30 Hari:</strong>
                            <span class="text-slate-300 block">Gratis perbaikan ulang jika mampet kembali dalam masa garansi.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shrink-0">✓</span>
                        <div>
                            <strong class="text-white">Alat Heavy-Duty Hydro Jetting:</strong>
                            <span class="text-slate-300 block">Tekanan 300 Bar merontokkan kerak lemak jenuh hingga bersih 100%.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shrink-0">✓</span>
                        <div>
                            <strong class="text-white">0% Soda Api (Pipa PVC Safe):</strong>
                            <span class="text-slate-300 block">Tanpa bahan kimia korosif yang melunakkan &amp; memecahkan pipa.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shrink-0">✓</span>
                        <div>
                            <strong class="text-white">Transparan &amp; Faktur PPN 11%:</strong>
                            <span class="text-slate-300 block">Sistem No Result No Pay &amp; kuitansi resmi untuk perumahan maupun B2B.</span>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Traditional Column --}}
            <div class="bg-slate-900/60 border border-slate-800 rounded-3xl p-6 sm:p-8">
                <div class="inline-flex items-center gap-2 bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-bold px-3 py-1 rounded-full mb-6 uppercase tracking-wider">
                    ⚠️ TUKANG KONVENSIONAL
                </div>
                <ul class="space-y-4 text-xs sm:text-sm text-slate-400">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold shrink-0">✕</span>
                        <div>
                            <strong class="text-slate-300">Sering Membongkar Keramik:</strong>
                            <span class="block">Biaya perbaikan keramik mahal &amp; merusak estetika kamar mandi.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold shrink-0">✕</span>
                        <div>
                            <strong class="text-slate-300">Tanpa Garansi Tertulis:</strong>
                            <span class="block">Mampet ulang beberapa hari kemudian dikenakan biaya full dari awal.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold shrink-0">✕</span>
                        <div>
                            <strong class="text-slate-300">Alat Manual Seadanya:</strong>
                            <span class="block">Kawat biasa / bambu tidak mampu mengikis lemak jenuh membatu.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold shrink-0">✕</span>
                        <div>
                            <strong class="text-slate-300">Sering Memakai Soda Api:</strong>
                            <span class="block">Risiko pipa PVC melengkung, bocor ke plafon, atau tersumbat parah.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold shrink-0">✕</span>
                        <div>
                            <strong class="text-slate-300">Tarif Berubah di Lapangan:</strong>
                            <span class="block">Harga awal murah namun membengkak tanpa nota resmi PT.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 5.5. DOKUMENTASI PROYEK & BLOG EDUKASI LOKAL                              --}}
{{-- ========================================================================= --}}
<div class="bg-slate-100 py-16 border-b border-slate-200">
    <x-media-documentation :articles="$articles ?? collect()" :projectShowcases="$projectShowcases ?? collect()" :locationName="$cityNameClean" />
</div>

{{-- ========================================================================= --}}
{{-- 6. PENATAAN CAKUPAN AREA (INTERACTIVE CHIPS & PULSING DOT)                --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-[#F8FAFC] border-b border-slate-200" id="jangkauan-area">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-800 px-3.5 py-1 rounded-full text-xs font-bold mb-3 border border-emerald-300">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                <span>Teknisi Siaga Hari Ini di {{ $cityNameClean }}</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                Cakupan Area &amp; Kecamatan di {{ $cityNameClean }}
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Pilih kelurahan/kecamatan terdekat Anda untuk pemanggilan armada teknisi siaga 24 jam:
            </p>
        </div>

        {{-- Interactive Chips --}}
        @if(isset($city->districts) && $city->districts->isNotEmpty())
        <div class="flex flex-wrap justify-center gap-2.5 max-w-5xl mx-auto mb-12">
            @foreach($city->districts as $district)
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah') . '/' . $district->slug) }}" 
                   class="bg-white border border-slate-200 hover:border-[#169F81] hover:bg-emerald-50/50 text-slate-800 hover:text-emerald-700 text-xs sm:text-sm font-bold px-4 py-2.5 rounded-2xl transition-all shadow-sm flex items-center gap-1.5 text-decoration-none hover:scale-105">
                    <span>📍 {{ $district->name }}</span>
                    <span class="text-emerald-600">→</span>
                </a>
            @endforeach
        </div>
        @endif

        {{-- B2B Callout Box --}}
        <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-3xl p-8 text-white flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 shadow-2xl border border-slate-700">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full border border-emerald-500/30">🏢 Corporate &amp; B2B Contract</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-white mt-2 mb-1 font-['Plus_Jakarta_Sans',sans-serif]">
                    Butuh Kontrak Maintenance Pipa Restoran / Gedung di {{ $cityNameClean }}?
                </h3>
                <p class="text-slate-300 text-xs sm:text-sm max-w-2xl leading-relaxed">
                    Sistem Hydro Jetting &amp; e-Faktur Pajak PPN 11% resmi untuk kebutuhan perawatan saluran rutin restoran, mall, hotel, &amp; pabrik.
                </p>
            </div>
            <a href="{{ route('b2b.index') }}" 
               class="shrink-0 px-6 py-3.5 bg-[#169F81] hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm rounded-xl transition-all text-decoration-none shadow-lg">
                Konsultasi B2B {{ $cityNameClean }} →
            </a>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 7. FAQ & EDUKASI LOKAL (MODERN & MOBILE-FIRST ACCORDION)                  --}}
{{-- ========================================================================= --}}
<?php
  $cityFaqs = [
      [
          'question' => 'Berapa lama estimasi teknisi tiba di lokasi ' . $cityNameClean . '?',
          'answer' => 'Teknisi Rootera disiapgajikan di pos respon armada <strong>' . $cityNameClean . '</strong> dengan estimasi kedatangan <strong>' . ($city->estimated_arrival ?? '15-30 Menit') . '</strong> setelah pemesanan dikonfirmasi via WhatsApp CS 24 jam.'
      ],
      [
          'question' => 'Apakah pengerjaan benar-benar 100% tanpa bongkar ubin/keramik?',
          'answer' => 'Ya, <strong>100% tanpa bongkar keramik</strong>. Kami menggunakan mesin rotary spiral baja Ridgid fleksibel buatan USA &amp; pemotong khusus yang mampu menembus lekukan pipa (P-Trap/S-Trap), mengikis kerak lemak jenuh tanpa merusak ubin lantai rumah Anda.'
      ],
      [
          'question' => 'Bagaimana ketentuan Garansi Resmi 30 Hari Rootera?',
          'answer' => 'Setiap pengerjaan dilengkapi nota garansi resmi. Jika dalam kurun waktu <strong>30 Hari Garansi</strong> saluran pada titik yang sama kembali tersumbat, teknisi kami meluncur ulang dan memperbaikinya <strong>100% GRATIS</strong>.'
      ],
      [
          'question' => 'Bagaimana sistem pembayaran setelah pengerjaan selesai?',
          'answer' => 'Sistem pembayaran menerapkan <strong>No Result No Pay (Tuntas Baru Bayar)</strong>. Anda hanya membayar jika air saluran sudah mengalir lancar kembali secara teruji. Pembayaran dapat dilakukan via Cash atau Transfer Bank.'
      ],
      [
          'question' => 'Apakah Rootera melayani komersial, restoran, & pabrik di ' . $cityNameClean . '?',
          'answer' => 'Tentu saja. Kami melayani perumahan residensial, resto/cafe (pembersihan <i>grease trap</i> &amp; lemak jenuh), apartemen, gedung perkantoran, hingga pabrik industri menggunakan teknologi <strong>Hydro-Jetting 300 Bar</strong> dengan fasilitas <strong>Faktur Pajak PPN 11%</strong>.'
      ]
  ];
?>
<section class="py-16 sm:py-24 bg-white border-b border-slate-200" id="faq-edukasi">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header FAQ --}}
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-50 text-[#169F81] font-bold text-xs tracking-widest uppercase border border-emerald-200 mb-3 shadow-xs">
                💡 BANTUAN &amp; JAWABAN CEPAT
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
                FAQ Pelancaran Pipa Mampet {{ $cityNameClean }}
            </h2>
            <p class="text-slate-600 text-xs sm:text-sm mt-2.5 leading-relaxed">
                Pertanyaan yang paling sering diajukan pelanggan sebelum memesan teknisi di <strong>{{ $cityNameClean }}</strong>.
            </p>
        </div>

        {{-- Accordion Container --}}
        <div x-data="{ activeFaq: 0 }" class="space-y-3.5">
            @foreach($cityFaqs as $index => $faq)
            <div 
                class="bg-white border transition-all duration-200 rounded-2xl overflow-hidden shadow-xs hover:shadow-md"
                :class="activeFaq === {{ $index }} ? 'border-l-4 border-l-[#169F81] border-emerald-500/80 bg-emerald-50/20 shadow-md' : 'border-slate-200/80 hover:border-slate-300'"
            >
                <button 
                    @click="activeFaq = (activeFaq === {{ $index }} ? null : {{ $index }})" 
                    class="w-full text-left px-4 py-4 sm:px-6 sm:py-5 min-h-[52px] flex items-center justify-between gap-4 transition-colors focus:outline-none cursor-pointer select-none"
                    :class="activeFaq === {{ $index }} ? 'bg-slate-50/70' : 'hover:bg-slate-50/50'"
                    :aria-expanded="activeFaq === {{ $index }} ? 'true' : 'false'">
                    
                    <div class="flex items-center gap-3 sm:gap-4 pr-2">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-full shrink-0 flex items-center justify-center font-extrabold text-xs transition-all shadow-xs"
                              :class="activeFaq === {{ $index }} ? 'bg-[#169F81] text-white ring-2 ring-emerald-200' : 'bg-teal-50 text-[#169F81] border border-teal-200/60'">
                            0{{ $index + 1 }}
                        </span>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                            {{ $faq['question'] }}
                        </h3>
                    </div>
                    
                    <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 transition-transform duration-300 border border-slate-200/80" 
                          :class="activeFaq === {{ $index }} ? 'rotate-180 bg-emerald-100 text-emerald-700 border-emerald-300' : ''">
                        <svg class="w-4 h-4 fill-current transition-transform" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </span>
                </button>
                
                <div x-show="activeFaq === {{ $index }}" x-collapse x-cloak class="px-4 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3.5 bg-white/70">
                    <p>{!! $faq['answer'] !!}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Micro-CTA Box di Bawah FAQ --}}
        <div class="mt-10 sm:mt-12 bg-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-slate-800">
            <div class="text-center md:text-left">
                <span class="inline-block text-xs font-bold text-emerald-400 uppercase tracking-wider bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20 mb-2">💬 KONSULTASI GRATIS 24 JAM</span>
                <h3 class="text-base sm:text-xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">
                    Masih punya pertanyaan lain seputar kondisi pipa Anda di {{ $cityNameClean }}?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">
                    Tim teknisi &amp; CS kami siap memberikan analisis &amp; estimasi biaya gratis secara langsung via WhatsApp.
                </p>
            </div>
            <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya ada pertanyaan seputar kondisi pipa mampet di area ' . $cityNameClean) }}" 
               target="_blank" rel="noopener" 
               class="shrink-0 inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs sm:text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-emerald-900/30 transition-all hover:scale-105 active:scale-95 text-decoration-none min-h-[44px]">
                <span>Tanya Teknisi Langsung via WhatsApp →</span>
            </a>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 8. SEO SILO & REGIONAL INTERLINKING                                       --}}
{{-- ========================================================================= --}}
@php
    $uniqueSiblingCities = isset($siblingCities) ? $siblingCities->unique('slug') : collect();
@endphp

@if($uniqueSiblingCities->isNotEmpty())
<section class="py-12 bg-slate-50 border-b border-slate-200" id="area-sekitar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-base font-extrabold text-slate-900 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">📍 Layanan Pipa Mampet di Kota Sekitar {{ $cityNameClean }}</h3>
        <p class="text-xs text-slate-500 mb-4">Teknisi Rootera juga melayani wilayah tetangga di provinsi {{ $city->province->name ?? 'Jabodetabek & Java' }}:</p>

        <div class="flex flex-wrap gap-2">
            @foreach($uniqueSiblingCities as $sib)
                <a href="{{ url('/jasa-saluran-mampet/' . $sib->slug) }}" 
                   class="bg-white border border-slate-200 hover:border-[#169F81] hover:bg-emerald-50/50 py-2 px-3.5 rounded-full text-xs font-semibold text-slate-800 text-decoration-none transition inline-flex items-center gap-1 shadow-sm">
                    <span>📍 Jasa Pipa {{ $sib->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========================================================================= --}}
{{-- 9. FLOATING MOBILE CTA BAR (SMARTPHONE PERFECTION)                       --}}
{{-- ========================================================================= --}}
<div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-slate-900/95 backdrop-blur-md p-3 border-t border-slate-800 flex items-center justify-between gap-3 shadow-2xl">
    <div class="flex items-center gap-2 pl-2">
        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
        <div class="text-[11px] font-bold text-white leading-tight">
            <div>Siaga {{ $cityNameClean }}</div>
            <div class="text-[10px] text-emerald-400 font-normal">Garansi 30 Hari</div>
        </div>
    </div>
    <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya butuh jasa pelancar pipa mampet di area ' . $cityNameClean) }}" 
       target="_blank" rel="noopener" 
       class="px-5 py-2.5 bg-[#169F81] text-white text-xs font-bold rounded-xl shadow-lg flex items-center gap-2 text-decoration-none min-h-[44px]">
        <span>💬 WA CS 24 Jam</span>
    </a>
</div>

@endsection
