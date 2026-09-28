@extends('layouts.app')

@section('schema-markup')
<?php
$citySlug = (isset($city) && is_object($city) && isset($city->slug)) ? $city->slug : '';
$cityName = (isset($city) && is_object($city)) ? ($city->full_name ?? $city->name ?? 'Kota') : 'Kota';
$cityNameClean = (isset($city) && is_object($city)) ? ($city->name ?? $cityName) : $cityName;

$districtSlug = (isset($district) && is_object($district) && isset($district->slug)) ? $district->slug : '';
$districtName = (isset($district) && is_object($district)) ? ($district->name ?? 'Kecamatan') : 'Kecamatan';

$districtCanonical = url("/jasa-saluran-mampet/{$citySlug}/{$districtSlug}");
$cityPhone = (isset($city) && is_object($city) && !empty($city->whatsapp_number)) ? $city->whatsapp_number : "6281385404000";
$cityProvName = (isset($city) && is_object($city) && isset($city->province) && is_object($city->province)) ? ($city->province->name ?? "Indonesia") : "Indonesia";

$districtLat = (isset($district) && !empty($district->latitude)) ? (float)$district->latitude : ((isset($city) && !empty($city->latitude)) ? (float)$city->latitude : -6.3275975);
$districtLng = (isset($district) && !empty($district->longitude)) ? (float)$district->longitude : ((isset($city) && !empty($city->longitude)) ? (float)$city->longitude : 106.8627125);

$districtAddress = [
  "@type" => "PostalAddress",
  "streetAddress" => "Pos Hub Armada Kecamatan " . $districtName,
  "addressLocality" => $districtName . ", " . $cityNameClean,
  "addressRegion" => $cityProvName,
  "postalCode" => (isset($district) && !empty($district->postal_code)) ? $district->postal_code : ((isset($city) && !empty($city->postal_code)) ? $city->postal_code : "10000"),
  "addressCountry" => "ID"
];

$districtBusinessSchema = [
  "@type" => ["PlumbingService", "LocalBusiness", "EmergencyService"],
  "@id" => $districtCanonical . "#organization",
  "name" => "Rootera Plumbing - Jasa Saluran Pipa Mampet " . $districtName,
  "alternateName" => ["Rootera " . $districtName, "Jasa Saluran Pipa Mampet " . $districtName, "Tukang Pipa Mampet " . $districtName],
  "description" => $seo['description'] ?? "Pusat layanan pelancaran saluran pipa mampet 24 jam di Kecamatan {$districtName}, {$cityNameClean} bergaransi resmi.",
  "url" => $districtCanonical,
  "telephone" => "+" . $cityPhone,
  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "image" => $seo['og_image'] ?? asset('images/JnJ.webp'),
  "priceRange" => "$$",
  "currenciesAccepted" => "IDR",
  "paymentAccepted" => "Cash, Transfer Bank, QRIS",
  "parentOrganization" => [
    "@type" => "Organization",
    "name" => "J&J GROUP",
    "url" => url('/')
  ],
  "address" => $districtAddress,
  "areaServed" => [
    [
      "@type" => "AdministrativeArea",
      "name" => "Kecamatan " . $districtName
    ],
    [
      "@type" => "City",
      "name" => $cityNameClean
    ]
  ],
  "aggregateRating" => [
    "@type" => "AggregateRating",
    "ratingValue" => "4.9",
    "reviewCount" => "120",
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
  "geo" => [
    "@type" => "GeoCoordinates",
    "latitude" => $districtLat,
    "longitude" => $districtLng
  ],
  "hasMap" => "https://www.google.com/maps?q={$districtLat},{$districtLng}",
  "hasOfferCatalog" => [
    "@type" => "OfferCatalog",
    "name" => "Katalog Layanan Pipa Mampet Kecamatan " . $districtName,
    "itemListElement" => [
      [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa Pelancaran Pipa Mampet " . $districtName,
          "description" => "Pelancaran saluran pipa tersumbat tanpa bongkar lantai."
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
          "name" => "Jasa Wastafel & Kitchen Sink Mampet " . $districtName,
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
          "name" => "Jasa Kloset WC & Toilet Tersumbat " . $districtName,
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
          "name" => "Jasa Floor Drain & Got Pembuangan " . $districtName,
          "description" => "Pembersihan rontokan rambut, gumpalan sabun & endapan pasir."
        ]
      ],
      [
        "@type" => "Offer",
        "price" => "750000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa Inspeksi Kamera CCTV Pipa " . $districtName,
          "description" => "Pemeriksaan visual internal pipa dengan kamera endoskopi waterproof 1080p."
        ]
      ]
    ]
  ]
];

$districtBreadcrumbs = [
  "@type" => "BreadcrumbList",
  "@id" => $districtCanonical . "#breadcrumb",
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
      "item" => url("/jasa-saluran-mampet/{$citySlug}")
    ],
    [
      "@type" => "ListItem",
      "position" => 4,
      "name" => "Kecamatan " . $districtName,
      "item" => $districtCanonical
    ]
  ]
];

// Structured FAQ Data for Rich Results Schema
$districtFaqs = [
    [
        'question' => 'Berapa lama estimasi teknisi tiba di area Kecamatan ' . $districtName . '?',
        'answer' => 'Teknisi Rootera disiagakan di posko armada ' . $districtName . ' dengan estimasi kedatangan ' . ($district->estimated_arrival ?? '20-35 Menit') . ' setelah pemesanan dikonfirmasi via WhatsApp CS 24 jam.'
    ],
    [
        'question' => 'Apakah pengerjaan di Kecamatan ' . $districtName . ' membutuhkan pembongkaran lantai?',
        'answer' => '100% Tanpa Bongkar. Kami menggunakan mesin rotary kabel spiral baja fleksibel buatan USA yang menembus lekukan pipa (P-Trap/S-Trap) tanpa merusak keramik atau ubin rumah Anda.'
    ],
    [
        'question' => 'Bagaimana garansi layanan untuk wilayah ' . $districtName . '?',
        'answer' => 'Seluruh pengerjaan di ' . $districtName . ' dilengkapi Garansi Resmi 30 Hari pasca pengerjaan (Tuntas Baru Bayar / No Result No Pay).'
    ]
];

$faqSchemaEntities = [];
foreach ($districtFaqs as $fItem) {
    $faqSchemaEntities[] = [
        "@type" => "Question",
        "name" => strip_tags($fItem['question']),
        "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => strip_tags($fItem['answer'])
        ]
    ];
}

$districtFaqSchema = [
    "@type" => "FAQPage",
    "@id" => $districtCanonical . "#faq",
    "mainEntity" => $faqSchemaEntities
];

$graphSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    $districtBusinessSchema,
    $districtBreadcrumbs,
    $districtFaqSchema
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($graphSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. HERO SECTION (SPLIT MODERN & DISTRICT BADGES)                          --}}
{{-- ========================================================================= --}}
<section class="relative bg-gradient-to-b from-[#0A2E78] via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden border-b-4 border-[#169F81]">
    {{-- Radial glow effect --}}
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[400px] bg-[#169F81]/20 blur-[130px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-4">
            <x-breadcrumbs :items="[
                ['name' => 'Beranda', 'url' => url('/')],
                ['name' => 'Area Layanan', 'url' => route('area-layanan')],
                ['name' => $cityNameClean, 'url' => url('/jasa-saluran-mampet/' . $citySlug)],
                ['name' => $districtName, 'url' => '']
            ]" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            {{-- Left Column: Copywriting & CTA --}}
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 bg-[#169F81]/20 border border-[#169F81]/40 text-emerald-300 px-4 py-1.5 rounded-full text-xs font-bold mb-5 backdrop-blur-md shadow-lg shadow-emerald-950/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>📍 Pos Hub Siaga Kecamatan {{ $districtName }}, {{ $cityNameClean }}</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight mb-4 text-white font-['Plus_Jakarta_Sans',sans-serif]">
                    {!! $heroHeadline ?? ("Spesialis Jasa Saluran Pipa Mampet <span class='text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-200'>" . $districtName . "</span> 24 Jam") !!}
                </h1>

                <p class="text-slate-200 text-sm sm:text-base lg:text-lg leading-relaxed mb-6 max-w-2xl">
                    {!! $heroSubtitle ?? ("Layanan pelancaran wastafel, kloset WC, floor drain kamar mandi &amp; got tersumbat di area <strong>Kecamatan " . $districtName . ", " . $cityNameClean . "</strong>. Dikerjakan tanpa bongkar lantai oleh <strong>Rootera Plumbing</strong> bergaransi tuntas 30 hari.") !!}
                </p>

                {{-- Quick Metrics Bar --}}
                <div class="grid grid-cols-3 gap-3 mb-8 max-w-xl">
                    <div class="bg-white/10 border border-white/15 rounded-2xl p-3 backdrop-blur-md text-center">
                        <div class="text-base sm:text-xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">{{ $district->estimated_arrival ?? '20-35 Mnt' }}</div>
                        <div class="text-[10px] sm:text-xs text-slate-300">Respon Tiba</div>
                    </div>
                    <div class="bg-white/10 border border-white/15 rounded-2xl p-3 backdrop-blur-md text-center">
                        <div class="text-base sm:text-xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">100% Safe</div>
                        <div class="text-[10px] sm:text-xs text-slate-300">Tanpa Bongkar Ubin</div>
                    </div>
                    <div class="bg-white/10 border border-white/15 rounded-2xl p-3 backdrop-blur-md text-center">
                        <div class="text-base sm:text-xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">30 Hari</div>
                        <div class="text-[10px] sm:text-xs text-slate-300">Garansi Resmi</div>
                    </div>
                </div>

                {{-- CTA Group --}}
                <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 sm:gap-4">
                    <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera Plumbing, saya butuh jasa pelancaran saluran pipa mampet di area Kecamatan ' . $districtName . ', ' . $cityNameClean . '. Bisa panggil teknisi sekarang?') }}" 
                       target="_blank" rel="noopener" 
                       class="inline-flex items-center justify-center gap-2.5 bg-[#169F81] hover:bg-emerald-600 text-white font-bold text-sm sm:text-base px-6 py-3.5 sm:py-4 rounded-2xl shadow-xl shadow-emerald-900/40 transition-all hover:scale-[1.02] active:scale-95 text-decoration-none">
                        <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        <span>Panggil Teknisi {{ $districtName }} (24 Jam)</span>
                    </a>

                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $city->branch_phone ?? ($city->whatsapp_number ?? '081385404000')) }}" 
                       class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm sm:text-base px-6 py-3.5 sm:py-4 rounded-2xl shadow-lg shadow-blue-900/30 transition-all hover:scale-[1.02] active:scale-95 text-decoration-none">
                        <svg class="w-5 h-5 fill-none stroke-current stroke-2 shrink-0" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span>Telepon CS</span>
                    </a>

                    <a href="#layanan-terpadu" 
                       class="inline-flex items-center justify-center gap-1.5 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm px-5 py-3.5 sm:py-4 rounded-2xl border border-white/20 backdrop-blur-md transition-all text-decoration-none">
                        <span>Pilihan Layanan ↓</span>
                    </a>
                </div>
            </div>

            {{-- Right Column: Visual Showcase & Badges --}}
            <div class="lg:col-span-5 relative mt-6 lg:mt-0">
                <div class="relative rounded-3xl overflow-hidden border-4 border-white/10 shadow-2xl shadow-slate-950/50 group">
                    <img src="{{ $heroImage ?? asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp') }}" 
                         alt="Teknisi Rootera Plumbing Kecamatan {{ $districtName }}" 
                         width="600"
                         height="440"
                         loading="lazy"
                         decoding="async"
                         class="w-full h-[380px] sm:h-[440px] object-cover group-hover:scale-105 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>

                    {{-- Floating Badge 1 --}}
                    <div class="absolute top-5 left-5 bg-slate-900/80 backdrop-blur-md border border-white/20 px-4 py-2.5 rounded-2xl text-xs font-semibold text-white shadow-xl flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>⚡ Posko Siaga {{ $districtName }}: {{ $estimatedArrival }} Tiba</span>
                    </div>

                    {{-- Floating Badge 2 --}}
                    <div class="absolute bottom-5 right-5 bg-slate-900/85 backdrop-blur-md border border-white/20 p-4 rounded-2xl text-white shadow-2xl">
                        <div class="flex items-center gap-2">
                            <span class="text-amber-400 text-sm">⭐⭐⭐⭐⭐</span>
                            <span class="font-bold text-xs">4.9 / 5.0</span>
                        </div>
                        <div class="text-[11px] text-slate-300 font-medium mt-0.5">Penanganan Profesional {{ $districtName }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(($city && $city->slug === 'bandar-lampung') || (isset($city->province) && $city->province->slug === 'lampung') || ($district && $district->slug === 'kedaton'))
    <x-workshop-posko-bandar-lampung :city="$city" :district="$district" />
@endif

{{-- ========================================================================= --}}
{{-- 2. KATALOG ALL-IN-ONE LAYANAN TERPADU KECAMATAN                           --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-white border-b border-slate-200" id="layanan-terpadu">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">LAYANAN ALL-IN-ONE TERPADU</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Solusi Sanitasi &amp; Pipa Mampet di {{ $districtName }}
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Seluruh masalah saluran air hunian, ruko, restoran, &amp; gedung di {{ $districtName }} ditangani tuntas tanpa bongkar lantai.
            </p>
        </div>

        {{-- Grid Kartu Layanan Terpadu --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Kartu 1: Wastafel & Kitchen Sink --}}
            <div class="bg-emerald-50/40 rounded-3xl p-6 border-2 border-[#169F81] shadow-xl relative flex flex-col justify-between group hover:shadow-2xl transition-all">
                <div class="absolute -top-3.5 left-6 bg-[#169F81] text-white text-[11px] font-bold px-3 py-0.5 rounded-full uppercase tracking-wider">
                    🔥 Sering Dipesan
                </div>
                <div>
                    <div class="text-3xl mb-3">🍽️</div>
                    <h3 class="font-extrabold text-slate-900 text-xl font-['Plus_Jakarta_Sans',sans-serif]">Wastafel &amp; Kitchen Sink</h3>
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                        Pelancaran bekuan lemak jenuh dapur, sisa makanan, dan kerak minyak di leher angsa P-trap tanpa bongkar meja keramik di area {{ $districtName }}.
                    </p>
                    <div class="mt-4 pt-4 border-t border-emerald-200">
                        <div class="text-xs text-slate-500 font-medium">Estimasi Biaya</div>
                        <div class="text-2xl font-extrabold text-[#169F81]">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau pesan pelancaran Wastafel Cuci Piring mampet di Kecamatan ' . $districtName . ', ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-emerald-600 transition-colors">
                    Pesan Wastafel {{ $districtName }}
                </a>
            </div>

            {{-- Kartu 2: Kloset WC & Toilet --}}
            <div class="bg-emerald-50/40 rounded-3xl p-6 border-2 border-[#169F81] shadow-xl relative flex flex-col justify-between group hover:shadow-2xl transition-all">
                <div class="absolute -top-3.5 left-6 bg-blue-600 text-white text-[11px] font-bold px-3 py-0.5 rounded-full uppercase tracking-wider">
                    ⚡ Respon Cepat
                </div>
                <div>
                    <div class="text-3xl mb-3">WC</div>
                    <h3 class="font-extrabold text-slate-900 text-xl font-['Plus_Jakarta_Sans',sans-serif]">Kloset WC &amp; Toilet</h3>
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                        Penanganan WC tersumbat tisu, pembalut, atau benda asing meluap tanpa perlu sedot tinja. Pembersihan leher angsa 100% aman untuk keramik.
                    </p>
                    <div class="mt-4 pt-4 border-t border-emerald-200">
                        <div class="text-xs text-slate-500 font-medium">Estimasi Biaya</div>
                        <div class="text-2xl font-extrabold text-[#169F81]">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau pesan pelancaran Kloset WC mampet di Kecamatan ' . $districtName . ', ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-emerald-600 transition-colors">
                    Pesan WC {{ $districtName }}
                </a>
            </div>

            {{-- Kartu 3: Floor Drain Kamar Mandi --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md relative flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all">
                <div>
                    <div class="text-3xl mb-3">🚿</div>
                    <h3 class="font-extrabold text-slate-900 text-xl font-['Plus_Jakarta_Sans',sans-serif]">Floor Drain Kamar Mandi</h3>
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                        Evakuasi gumpalan rambut tersangkut, kerak sabun membeku, dan pasir kapur di perangkap bau (odor trap) floor drain kamar mandi.
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="text-xs text-slate-500 font-medium">Estimasi Biaya</div>
                        <div class="text-2xl font-extrabold text-slate-900">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau pesan pelancaran Floor Drain kamar mandi di Kecamatan ' . $districtName . ', ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-slate-900 text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-[#169F81] transition-colors">
                    Pesan Kamar Mandi
                </a>
            </div>

            {{-- Kartu 4: Pipa Utama, Got & Talang --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md relative flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all">
                <div>
                    <div class="text-3xl mb-3">🌊</div>
                    <h3 class="font-extrabold text-slate-900 text-xl font-['Plus_Jakarta_Sans',sans-serif]">Pipa Utama, Got &amp; Talang</h3>
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                        Pembersihan pipa drainase utama, saluran got luar, dan talang atap dari endapan tanah, pasir, daun gugur, dan sampah plastik.
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="text-xs text-slate-500 font-medium">Estimasi Biaya</div>
                        <div class="text-2xl font-extrabold text-slate-900">Rp 400.000-an</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya mau pesan pelancaran Pipa Utama / Got / Talang mampet di Kecamatan ' . $districtName . ', ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-slate-900 text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-[#169F81] transition-colors">
                    Pesan Pipa Utama &amp; Got
                </a>
            </div>

            {{-- Kartu 5: Inspeksi Kamera CCTV Pipa --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md relative flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all">
                <div>
                    <div class="text-3xl mb-3">📷</div>
                    <h3 class="font-extrabold text-slate-900 text-xl font-['Plus_Jakarta_Sans',sans-serif]">Inspeksi Kamera CCTV Pipa</h3>
                    <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                        Pemeriksaan visual internal pipa menggunakan kamera endoskopi waterproof 1080p untuk melacak titik pecah, kemiringan pipa, dan sumbatan tersembunyi.
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="text-xs text-slate-500 font-medium">Layanan Spesialis</div>
                        <div class="text-2xl font-extrabold text-slate-900">Deteksi 1080p</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya ingin pesan layanan Inspeksi CCTV Pipa di Kecamatan ' . $districtName . ', ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-slate-900 text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-[#169F81] transition-colors">
                    Pesan CCTV Pipa
                </a>
            </div>

            {{-- Kartu 6: B2B Komersial & Hydro-Jetting --}}
            <div class="bg-slate-900 text-white rounded-3xl p-6 border border-slate-800 shadow-xl relative flex flex-col justify-between hover:border-emerald-400 transition-all">
                <div>
                    <div class="text-3xl mb-3">🏭</div>
                    <h3 class="font-extrabold text-white text-xl font-['Plus_Jakarta_Sans',sans-serif]">Hydro-Jetting B2B Industri</h3>
                    <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                        Penyemprotan jet air 300 Bar untuk resto, ruko, hotel, &amp; pabrik di {{ $districtName }}. Dilengkapi fasilitas Faktur Pajak PPN 11%.
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-800">
                        <div class="text-xs text-slate-400 font-medium">Komersial &amp; Pabrik</div>
                        <div class="text-2xl font-extrabold text-emerald-400">Hydro-Jetting 300 Bar</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera B2B, saya ingin konsultasi Hydro-Jetting untuk lokasi usaha di Kecamatan ' . $districtName . ', ' . $cityNameClean) }}" 
                   target="_blank" rel="noopener" 
                   class="mt-6 w-full py-3 bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md hover:bg-emerald-600 transition-colors">
                    Konsultasi B2B / Resto
                </a>
            </div>
        </div>

        {{-- Jaminan Teks Mikro --}}
        <div class="mt-10 text-center text-xs sm:text-sm text-slate-600 font-medium bg-slate-50 p-4 rounded-2xl border border-slate-200/80 max-w-2xl mx-auto flex items-center justify-center gap-2 flex-wrap">
            <span>✓ Pengerjaan Tanpa Bongkar Keramik</span>
            <span>•</span>
            <span>Tuntas Baru Bayar (No Result No Pay)</span>
            <span>•</span>
            <span>Garansi Resmi 30 Hari</span>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2.5. CAKUPAN LINGKUNGAN & PERUMAHAN LOKAL KECAMATAN                       --}}
{{-- ========================================================================= --}}
<section class="py-12 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-md">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-10 h-10 rounded-2xl bg-emerald-100 text-[#169F81] font-bold flex items-center justify-center text-lg">🏡</span>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg sm:text-xl font-['Plus_Jakarta_Sans',sans-serif]">
                        Cakupan Lingkungan, Kelurahan &amp; Perumahan di {{ $districtName }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600">
                        Armada teknisi siaga melayani area rumah tinggal, ruko, apartemen, &amp; kawasan usaha di seluruh Kecamatan {{ $districtName }}, {{ $cityNameClean }}.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-4 border-t border-slate-100 text-xs text-slate-700 font-medium">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">✓ Area Pemukiman Warga</div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">✓ Kompleks Perumahan</div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">✓ Kawasan Ruko &amp; Kuliner</div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/60">✓ Gedung &amp; Perkantoran</div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2.8. DOKUMENTASI PROYEK & ARTIKEL LOKAL KECAMATAN                         --}}
{{-- ========================================================================= --}}
<div class="bg-slate-100 py-16 border-b border-slate-200">
    <x-media-documentation :articles="$relatedArticles ?? collect()" :projectShowcases="$projectShowcases ?? collect()" :locationName="$districtName" />
</div>

{{-- ========================================================================= --}}
{{-- 3. SEKSI MULTI-SEKTOR PROPERTI                                         --}}
{{-- ========================================================================= --}}
<x-multi-sector-grid :locationName="$districtName" :whatsappNumber="$city->whatsapp_number ?? '6281385404000'" />

{{-- ========================================================================= --}}
{{-- 4. KEUNGGULAN UTAMA                                                       --}}
{{-- ========================================================================= --}}
<section class="py-12 sm:py-20 bg-[#F8FAFC] border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-50 text-[#169F81] font-bold text-xs tracking-widest uppercase border border-emerald-200 mb-2.5 shadow-xs">
                ✨ STANDAR KERJA PROFESIONAL
            </span>
            <h2 class="text-xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Mengapa Warga Kecamatan {{ $districtName }} Memilih Rootera?
            </h2>
        </div>

        <div class="grid grid-cols-2 gap-3 sm:gap-4 md:grid-cols-4 md:gap-6">
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="bg-teal-50 text-[#169F81] rounded-2xl w-11 h-11 flex items-center justify-center mb-3">🌀</div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1">100% Non-Bongkar</h3>
                    <p class="text-xs text-slate-600">Kabel spiral Ridgid fleksibel menembus belokan pipa tanpa merusak ubin.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="bg-blue-50 text-blue-700 rounded-2xl w-11 h-11 flex items-center justify-center mb-3">🛡️</div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1">Garansi 30 Hari</h3>
                    <p class="text-xs text-slate-600">Jaminan tuntas. Jika mampet berulang pada titik sama, teknisi servis gratis.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="bg-amber-50 text-amber-600 rounded-2xl w-11 h-11 flex items-center justify-center mb-3">⚡</div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1">Respon Cepat {{ $districtName }}</h3>
                    <p class="text-xs text-slate-600">Posko siaga terdekat siap meluncur 24 jam nonstop ke lokasi Anda.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 sm:p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="bg-emerald-50 text-emerald-600 rounded-2xl w-11 h-11 flex items-center justify-center mb-3">🌱</div>
                    <h3 class="font-bold text-sm sm:text-base text-slate-900 mb-1">0% Kimia Korosif</h3>
                    <p class="text-xs text-slate-600">Tanpa soda api keras yang dapat melunakkan dan merusak sambungan pipa PVC.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 5. BENTO GRID PERALATAN INDUSTRIAL                                        --}}
{{-- ========================================================================= --}}
<section class="py-16 sm:py-24 bg-[#071C4D] text-white relative overflow-hidden border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-emerald-400 font-bold text-xs tracking-widest uppercase bg-white/10 px-3.5 py-1.5 rounded-full border border-white/20 backdrop-blur-md">TEKNOLOGI MODERN</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-white mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Mesin Spesialis Pelancar Pipa di {{ $districtName }}
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-slate-900/90 border border-slate-800 p-8 rounded-3xl flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold bg-[#169F81] text-white px-3 py-1 rounded-full uppercase">Hydro-Jetting 300 Bar</span>
                    <h3 class="text-2xl font-extrabold text-white mt-4 mb-2">Penyemprotan Air Bertekanan Ultra-Tinggi</h3>
                    <p class="text-slate-300 text-xs sm:text-sm">Rontokkan kerak lemak membatu, endapan semen, dan lumpur pekat tanpa merusak dinding pipa PVC.</p>
                </div>
            </div>
            <div class="bg-slate-900/90 border border-slate-800 p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <div class="text-2xl mb-2">🌀</div>
                    <h3 class="font-extrabold text-white text-lg mb-1">Mesin Cable Ridgid USA</h3>
                    <p class="text-xs text-slate-300">Kabel spiral baja berputar cepat menghancurkan gumpalan rambut &amp; kain tersumbat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 6. CAKUPAN KECAMATAN SEKITAR (INTERLINKING SPOKE MESH)                     --}}
{{-- ========================================================================= --}}
@if(isset($siblingDistricts) && count($siblingDistricts) > 0)
<section class="py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">JARINGAN POSKO TERDEKAT</span>
            <h2 class="text-xl sm:text-3xl font-extrabold text-slate-900 mt-2 font-['Plus_Jakarta_Sans',sans-serif]">
                Area Kecamatan Tetangga di {{ $cityNameClean }}
            </h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($siblingDistricts as $sDist)
            <a href="{{ url('/jasa-saluran-mampet/' . $citySlug . '/' . $sDist->slug) }}" 
               class="bg-white hover:bg-[#169F81] hover:text-white text-slate-800 font-semibold text-xs p-3 rounded-xl border border-slate-200 text-center transition-all shadow-xs hover:shadow-md truncate">
                📍 {{ $sDist->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========================================================================= --}}
{{-- 7. FAQ ACCORDION & EMERGENCY CTA                                          --}}
{{-- ========================================================================= --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">FAQ KECAMATAN {{ strtoupper($districtName) }}</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Pertanyaan Sering Diajukan</h2>
        </div>

        <div class="space-y-4">
            @foreach($districtFaqs as $dfaq)
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                <h3 class="font-bold text-slate-900 text-base mb-2">❓ {{ $dfaq['question'] }}</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">💡 {{ $dfaq['answer'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
