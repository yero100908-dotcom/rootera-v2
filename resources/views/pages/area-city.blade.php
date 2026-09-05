@extends('layouts.app')

@section('schema-markup')
<?php
$citySlug = (isset($city) && is_object($city) && isset($city->slug)) ? $city->slug : '';
$cityName = (isset($city) && is_object($city)) ? ($city->full_name ?? $city->name ?? 'Kota') : 'Kota';
$cityCanonical = url("/jasa-saluran-mampet/{$citySlug}");
$cityPhone = (isset($city) && is_object($city) && !empty($city->whatsapp_number)) ? $city->whatsapp_number : "6281385404000";
$cityProvName = (isset($city) && is_object($city) && isset($city->province) && is_object($city->province)) ? ($city->province->name ?? "Indonesia") : "Indonesia";

$cityAddress = [
  "@type" => "PostalAddress",
  "addressLocality" => (isset($city) && is_object($city)) ? ($city->district_locality ?: $city->name ?: $cityName) : $cityName,
  "addressRegion" => $cityProvName,
  "addressCountry" => "ID"
];

if (isset($city) && $city->has_physical_branch && !empty($city->street_address)) {
  $cityAddress["streetAddress"] = $city->street_address;
  if (!empty($city->postal_code)) {
    $cityAddress["postalCode"] = $city->postal_code;
  }
}

$cityBusinessSchema = [
  "@context" => "https://schema.org",
  "@type" => ["LocalBusiness", "Plumber", "HomeAndConstructionBusiness"],
  "name" => "Rootera Plumbing - " . $cityName,
  "alternateName" => ["Rootera " . $cityName, "Jasa Pipa Mampet " . $cityName],
  "description" => $seo['description'] ?? "Jasa pelancar saluran pipa mampet di {$cityName} 24 jam bergaransi resmi.",
  "@id" => $cityCanonical . "#organization",
  "url" => $cityCanonical,
  "telephone" => "+" . (isset($city) && !empty($city->branch_phone) ? $city->branch_phone : $cityPhone),
  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "image" => $seo['og_image'] ?? asset('images/JnJ.webp'),
  "priceRange" => "$$",
  "parentOrganization" => [
    "@type" => "Organization",
    "name" => "J&J GROUP",
    "url" => url('/')
  ],
  "address" => $cityAddress,
  "areaServed" => [
    "@type" => "City",
    "name" => $cityName
  ],
  "aggregateRating" => [
    "@type" => "AggregateRating",
    "ratingValue" => (string) ($city->rating_value ?? 4.9),
    "reviewCount" => (string) ($city->review_count ?? 85)
  ],
  "openingHoursSpecification" => [
    "@type" => "OpeningHoursSpecification",
    "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    "opens" => "00:00",
    "closes" => "23:59"
  ]
];

if (!empty($city->latitude) && !empty($city->longitude)) {
  $cityBusinessSchema["geo"] = [
    "@type" => "GeoCoordinates",
    "latitude" => (float) $city->latitude,
    "longitude" => (float) $city->longitude
  ];
}

$cityBreadcrumbs = [
  "@context" => "https://schema.org",
  "@type" => "BreadcrumbList",
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
      "name" => $cityName,
      "item" => $cityCanonical
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($cityBusinessSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($cityBreadcrumbs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- ZONA 1: HERO SECTION (Responsive Background Banner Resmi)                 --}}
{{-- ========================================================================= --}}
<style>
.area-hero-banner-bg {
    background-image: linear-gradient(180deg, rgba(11, 25, 44, 0.88) 0%, rgba(11, 25, 44, 0.78) 100%), url("{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-mobile.webp') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
@media (min-width: 768px) {
    .area-hero-banner-bg {
        background-image: linear-gradient(180deg, rgba(11, 25, 44, 0.88) 0%, rgba(11, 25, 44, 0.78) 100%), url("{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp') }}");
    }
}
.mobile-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: #10B981 #E2E8F0;
}
.mobile-scrollbar::-webkit-scrollbar {
    height: 4px;
}
.mobile-scrollbar::-webkit-scrollbar-track {
    background: #E2E8F0;
    border-radius: 10px;
}
.mobile-scrollbar::-webkit-scrollbar-thumb {
    background: #10B981;
    border-radius: 10px;
}
</style>

<section class="area-hero-banner-bg py-6 px-4 md:py-[4.5rem] md:px-6 border-b-4 border-[#1FAF5A] relative text-white">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="max-width: 850px;">
            <div class="mb-2 md:mb-4">
                <x-breadcrumbs :items="[
                    ['name' => 'Beranda', 'url' => url('/')],
                    ['name' => 'Area Layanan', 'url' => route('area-layanan')],
                    ['name' => $cityName, 'url' => '']
                ]" />
            </div>

            <div class="inline-flex items-center gap-1.5 bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 px-3 py-1.5 md:px-4 md:py-1.5 rounded-full text-[11px] sm:text-xs md:text-[0.85rem] font-bold mb-3 md:mb-6 backdrop-blur-sm">
                <span>📍 Pusat Layanan Area {{ $city->full_name ?? $city->name ?? 'Wilayah Terkait' }}</span>
                <span>•</span>
                <span>⏱️ Response {{ $city->estimated_arrival ?? '25-40 Menit' }}</span>
            </div>

            <h1 class="text-[22px] sm:text-2xl md:text-[3.2rem] font-extrabold leading-tight md:leading-[1.2] mb-2.5 md:mb-4 text-white drop-shadow-md">
                {!! $heroHeadline ?? ("Jasa Saluran Pipa Mampet " . ($city->full_name ?? $city->name ?? 'Wilayah Terkait')) !!}
            </h1>
            <p class="text-xs sm:text-sm md:text-[1.12rem] text-slate-100/90 leading-normal md:leading-[1.6] max-w-3xl md:max-w-[800px] mb-4 md:mb-8 drop-shadow-sm">
                {!! $heroSubtitle ?? ("Solusi profesional terpercaya untuk pelancaran wastafel, floor drain kamar mandi, kloset WC, &amp; pipa industri di <strong>" . ($city->full_name ?? $city->name ?? 'Wilayah Terkait') . "</strong>. Dikerjakan tanpa bongkar lantai oleh <strong>Rootera Plumbing (J&amp;J Group)</strong> bergaransi resmi tuntas 100%.") !!}
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya butuh jasa pelancar pipa mampet di area ' . ($city->full_name ?? 'Wilayah Terkait') . '. Bisa panggil teknisi?') }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#1FAF5A] hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm md:text-[1.05rem] px-5 py-3 md:px-8 md:py-3.5 rounded-full shadow-lg transition-transform active:scale-95 text-decoration-none">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    <span>Panggil Teknisi {{ $city->name ?? 'Wilayah Terkait' }} (24 Jam)</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- ZONA 2: CORE SERVICES & PROPERTY SPECIALIZATION (Real Local Images)        --}}
{{-- ========================================================================= --}}
<?php
  $mediaService = app(\App\Services\MediaService::class);
  $propertyVisuals = $mediaService->getPropertyImages();
  $cityNameClean = $city->name ?? 'Wilayah Terkait';
  
  $coreProblemCards = [
      [
          'title' => 'Wastafel & Sink Dapur',
          'desc' => 'Pelancaran lemak beku, sisa makanan, & bau tak sedap pada sink dapur tanpa bongkar.',
          'image' => asset('assets/jenis-bangunan/wastafel-rooteraplumbing.jpg'),
          'url' => url('/layanan-pipa-mampet/wastafel-mampet/' . ($city->slug ?? 'wilayah')),
          'badge' => 'Paling Populer'
      ],
      [
          'title' => 'Kloset WC & Toilet',
          'desc' => 'Atasi kloset meluap & tersumbat tisue/benda asing dengan mesin pendorong hening.',
          'image' => asset('assets/jenis-bangunan/kloset-rootera-plumbing.jpg'),
          'url' => url('/layanan-pipa-mampet/wc-toilet-mampet/' . ($city->slug ?? 'wilayah')),
          'badge' => 'Respon Cepat'
      ],
      [
          'title' => 'Floor Drain Kamar Mandi',
          'desc' => 'Pembersihan pipa kamar mandi dari sumbatan rambut, kerak sabun, & rontokan ubin.',
          'image' => asset('assets/jenis-bangunan/floor-drain-kamarmandi-rooteraplumbing.jpg'),
          'url' => url('/layanan-pipa-mampet/kamar-mandi-mampet/' . ($city->slug ?? 'wilayah')),
          'badge' => 'Bebas Bau'
      ],
      [
          'title' => 'Talang Air & Got Utama',
          'desc' => 'Penanganan pipa saluran pembuangan luar, got mampet, & talang air hujan gedung.',
          'image' => asset('assets/jenis-bangunan/saluran-pembuangan-got-rumahan-dan-industri-rooteraplumbing.jpg'),
          'url' => url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah')),
          'badge' => 'Skala Besar'
      ]
  ];
?>
<section class="py-8 px-4 md:py-[4rem] md:px-6 bg-slate-50 border-b border-slate-200" id="layanan-utama">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Header Zona 2 -->
        <div class="text-center mb-6 md:mb-12">
            <span class="text-emerald-600 font-extrabold text-[11px] md:text-[0.85rem] uppercase tracking-wider">⚡ LAYANAN &amp; SPESIALISASI PROPERTI</span>
            <h2 class="text-[18px] sm:text-[20px] md:text-[2.3rem] font-extrabold text-slate-900 mt-1 leading-tight">Solusi Masalah Pipa &amp; Jenis Bangunan di {{ $cityNameClean }}</h2>
            <p class="text-xs md:text-[0.98rem] text-slate-500 max-w-2xl md:max-w-[760px] mx-auto mt-1 leading-relaxed md:leading-[1.6]">Pilih masalah saluran mampet Anda atau kategori properti di bawah ini untuk penanganan presisi 24 jam tanpa bongkar keramik.</p>
        </div>

        <!-- Baris 1: 4 Masalah Utama (Horizontal Snap Carousel with Peek Effect on Mobile) -->
        <div class="mb-8 md:mb-10">
            <div class="flex overflow-x-auto snap-x snap-mandatory gap-3.5 pb-3.5 mobile-scrollbar touch-pan-x md:grid md:grid-cols-2 lg:grid-cols-4 md:overflow-visible md:pb-0 md:gap-5">
                @foreach($coreProblemCards as $card)
                <a href="{{ $card['url'] }}" class="w-[82vw] min-w-[82vw] sm:min-w-[240px] snap-center shrink-0 md:w-auto md:min-w-0 bg-white rounded-2xl border border-slate-200 overflow-hidden text-decoration-none flex flex-col justify-between shadow-sm transition hover:-translate-y-1 hover:border-emerald-500 hover:shadow-lg group">
                    <div>
                        <div class="relative h-[110px] md:h-[130px] bg-slate-900 overflow-hidden flex items-center justify-center p-0.5">
                            <img src="{{ $card['image'] }}" alt="{{ $card['title'] }} {{ $cityNameClean }}" class="w-full h-full object-contain md:object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async">
                            <span class="absolute top-2 right-2 md:top-2.5 md:right-2.5 bg-slate-900/85 text-emerald-400 border border-emerald-500/40 text-[10px] md:text-[0.72rem] font-bold px-2 py-0.5 rounded-full backdrop-blur-sm">
                                {{ $card['badge'] }}
                            </span>
                        </div>
                        <div class="p-3 md:p-5">
                            <h3 class="text-sm md:text-[1.05rem] font-extrabold text-slate-900 mb-1 group-hover:text-emerald-600 transition">
                                {{ $card['title'] }}
                            </h3>
                            <p class="text-xs md:text-[0.82rem] text-slate-500 leading-snug md:leading-[1.4] margin-0 line-clamp-2 md:line-clamp-none">
                                {{ $card['desc'] }}
                            </p>
                        </div>
                    </div>
                    <div class="px-3 pb-3 md:px-5 md:pb-4 text-emerald-600 font-extrabold text-xs md:text-[0.85rem] flex items-center gap-1">
                        Solusi {{ $cityNameClean }} →
                    </div>
                </a>
                @endforeach
            </div>
            <!-- Visual Scroll Hint Indicator for Mobile -->
            <div class="flex items-center justify-center gap-1.5 mt-2 md:hidden">
                <span class="w-6 h-1 bg-emerald-500 rounded-full"></span>
                <span class="w-2 h-1 bg-slate-300 rounded-full"></span>
                <span class="w-2 h-1 bg-slate-300 rounded-full"></span>
            </div>
        </div>

        <!-- Baris 2: Sub-kategori Tipe Properti (Compact 2-Column Grid on Mobile) -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 md:p-[1.75rem] shadow-sm">
            <div class="mb-4 md:mb-6 text-center">
                <h3 class="text-sm sm:text-base md:text-[1.2rem] font-extrabold text-slate-900">🏢 Spesialisasi Tipe Properti &amp; Bangunan {{ $cityNameClean }}</h3>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 md:gap-5">
                @foreach($propertyVisuals as $pKey => $pVisual)
                <a href="{{ route('property.show', $pVisual['slug']) }}" class="bg-white rounded-xl border border-slate-200 overflow-hidden text-decoration-none flex flex-col justify-between shadow-sm transition hover:-translate-y-1 hover:border-emerald-500 hover:shadow-md group">
                    <div>
                        <div class="relative h-[95px] md:h-[130px] bg-slate-900 overflow-hidden flex items-center justify-center p-0.5">
                            <img src="{{ $pVisual['url'] }}" alt="{{ $pVisual['name'] }} di {{ $cityNameClean }}" class="w-full h-full object-contain md:object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async">
                            <span class="absolute top-1.5 right-1.5 md:top-2.5 md:right-2.5 bg-slate-900/85 text-emerald-400 border border-emerald-500/40 text-[9px] md:text-[0.7rem] font-bold px-1.5 py-0.5 rounded-full backdrop-blur-sm">
                                ⏱️ {{ $pVisual['badge'] }}
                            </span>
                            <span class="absolute bottom-1.5 left-2 text-base md:text-xl">
                                {{ $pVisual['icon'] }}
                            </span>
                        </div>
                        <div class="p-2.5 md:p-[1rem_1.25rem]">
                            <h3 class="text-xs md:text-[0.98rem] font-extrabold text-slate-900 group-hover:text-emerald-600 transition leading-snug margin-0">
                                {{ $pVisual['name'] }}
                            </h3>
                            <p class="text-[11px] md:text-[0.8rem] text-slate-500 leading-tight md:leading-[1.4] margin-0 line-clamp-2 hidden sm:block mt-1">
                                Layanan pelancaran pipa tersumbat profesional di {{ $cityNameClean }} tanpa bongkar.
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- ZONA 3: SOCIAL PROOF & ARSENAL (Peralatan + Galeri + Video)                --}}
{{-- ========================================================================= --}}
@include('components.media-documentation', [
    'projectShowcases' => $projectShowcases ?? null,
    'relatedArticles' => $relatedArticles ?? collect(),
    'locationName' => $city->full_name ?? $city->name ?? 'Wilayah Terkait',
    'locationShort' => $city->name ?? 'Wilayah Terkait'
])

{{-- ========================================================================= --}}
{{-- ZONA 4: COVERAGE HUB & B2B CALLOUT (Penggabungan)                         --}}
{{-- ========================================================================= --}}
<section class="py-8 px-4 md:py-[4rem] md:px-6 bg-white border-t border-b border-slate-200" id="jangkauan-area">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div class="text-center mb-6 md:mb-10">
            <span class="text-emerald-600 font-extrabold text-[11px] md:text-[0.85rem] uppercase tracking-wider">📍 JANGKAUAN KECAMATAN &amp; LAYANAN KOMERSIAL</span>
            <h2 class="text-[18px] sm:text-[20px] md:text-[2rem] font-extrabold text-slate-900 mt-1 leading-tight">Cakupan Area Presisi di {{ $city->full_name ?? $city->name ?? 'Wilayah Terkait' }}</h2>
            <p class="text-xs md:text-[0.95rem] text-slate-500 max-w-2xl mx-auto mt-1 leading-relaxed">Armada teknisi Rootera standby di seluruh kecamatan {{ $city->name ?? 'Wilayah Terkait' }} &amp; melayani kontrak maintenance komersial B2B.</p>
        </div>

        <!-- Grid Kecamatan Kompak -->
        @if(isset($city->districts) && $city->districts->isNotEmpty())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 md:gap-[0.85rem] mb-8 md:mb-10">
            @foreach($city->districts as $district)
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah') . '/' . $district->slug) }}" class="bg-slate-50 border border-slate-200 rounded-xl py-2 px-3 md:py-[0.85rem] md:px-[1.1rem] text-decoration-none text-slate-900 font-bold text-xs md:text-[0.9rem] flex justify-between items-center transition hover:border-emerald-500 hover:bg-emerald-50/30">
                    <span class="truncate">📍 {{ $district->name }}</span>
                    <span class="text-emerald-600 font-bold ml-1 md:text-[0.85rem]">→</span>
                </a>
            @endforeach
        </div>
        @endif

        <!-- Banner / Callout Box Ringkas B2B Komersial & Area Penyangga -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-5 md:p-[2rem_2.5rem] text-white flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-6 shadow-xl">
            <div>
                <div class="inline-flex items-center gap-1.5 bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-[10px] md:text-[0.75rem] font-bold px-2.5 py-1 rounded-full uppercase mb-2">
                    🏢 Layanan Komersial &amp; B2B Maintenance
                </div>
                <h3 class="text-sm sm:text-base md:text-[1.35rem] font-extrabold text-white mb-1 leading-snug">
                    Butuh Kontrak Perawatan Pipa Berkala untuk Bisnis / Gedung di {{ $city->name }}?
                </h3>
                <p class="text-slate-300 text-xs md:text-[0.92rem] max-w-2xl leading-relaxed md:leading-[1.5] margin-0">
                    Sistem Hydro Jetting &amp; kamera endoskopi CCTV siap menangani limbah resto, ruko, hotel, &amp; pabrik di {{ $city->full_name }}.
                </p>
            </div>
            <div class="flex flex-wrap gap-2 shrink-0">
                <a href="{{ route('b2b.index') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs md:text-[0.9rem] px-4 py-2.5 md:px-6 md:py-3 rounded-full text-decoration-none inline-flex items-center gap-1 shadow-md">
                    Konsultasi B2B Komersial →
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- ZONA 5: EDUKASI RINGKAS & FAQ LOKAL (Interactive Alpine.js Accordion)    --}}
{{-- ========================================================================= --}}
<?php
  $cityFaqs = [
      [
          'question' => 'Berapa lama estimasi teknisi tiba di lokasi ' . $cityNameClean . '?',
          'answer' => 'Teknisi Rootera disiapgajikan di pos respon armada ' . $cityNameClean . ' dengan estimasi kedatangan ' . ($city->estimated_arrival ?? '25-40 Menit') . ' setelah pemesanan dikonfirmasi via WhatsApp CS 24 jam.'
      ],
      [
          'question' => 'Apakah pengerjaan benar-benar 100% tanpa bongkar ubin/keramik?',
          'answer' => 'Ya. Kami menggunakan mesin rotary spiral baja Ridgid &amp; pemotong khusus yang fleksibel mengikuti lekukan pipa (P-Trap/S-Trap), memancarkan kerak lemak &amp; sumbatan tanpa perlu membongkar lantai keramik rumah Anda.'
      ],
      [
          'question' => 'Bagaimana ketentuan garansi 30 hari Rootera?',
          'answer' => 'Setiap penanganan dilengkapi nota garansi resmi 30 hari. Jika dalam masa garansi saluran yang sama kembali mampet, teknisi kami akan meluncur ulang dan mengerjakannya 100% GRATIS tanpa biaya tambahan.'
      ],
      [
          'question' => 'Bagaimana sistem pembayaran setelah pekerjaan selesai?',
          'answer' => 'Sistem pembayaran berlaku <strong>No Flow No Pay</strong> (Hanya Bayar Jika Saluran Lancar). Pembayaran dapat dilakukan via transfer bank atau tunai setelah Anda menguji kelancaran air secara langsung.'
      ]
  ];
?>
<section class="py-8 px-4 md:py-[4rem] md:px-6 bg-slate-50 border-b border-slate-200" id="faq-edukasi">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div class="text-center mb-6 md:mb-10">
            <span class="text-emerald-600 font-extrabold text-[11px] md:text-[0.85rem] uppercase tracking-wider">❓ PERTANYAAN UMUM &amp; EDUKASI</span>
            <h2 class="text-[18px] sm:text-[20px] md:text-[2rem] font-extrabold text-slate-900 mt-1 leading-tight">Pertanyaan Sering Diajukan di {{ $cityNameClean }}</h2>
            <p class="text-xs md:text-[0.95rem] text-slate-500 max-w-2xl mx-auto mt-1 leading-relaxed">Informasi esensial garansi, waktu respon teknisi, dan metode kerja tanpa pembongkaran lantai.</p>
        </div>

        <!-- Section 4: Interactive Accordion (Vertical Stack 1 Column) -->
        <div x-data="{ activeFaq: 0 }" class="max-w-[1000px] mx-auto flex flex-col gap-3">
            @foreach($cityFaqs as $index => $faq)
            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm transition-all">
                <button 
                    @click="activeFaq = (activeFaq === {{ $index }} ? null : {{ $index }})" 
                    class="w-full text-left p-4 md:p-[1.25rem_1.5rem] flex items-center justify-between gap-3 bg-white hover:bg-slate-50 transition-colors focus:outline-none cursor-pointer"
                    :aria-expanded="activeFaq === {{ $index }} ? 'true' : 'false'">
                    <h3 class="text-xs sm:text-sm md:text-[1.05rem] font-extrabold text-slate-900 flex items-center gap-2 margin-0 leading-snug">
                        <span>⏱️ {{ $faq['question'] }}</span>
                    </h3>
                    <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 transition-transform duration-200" :class="activeFaq === {{ $index }} ? 'rotate-180 bg-emerald-100 text-emerald-700' : ''">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </span>
                </button>
                <div x-show="activeFaq === {{ $index }}" x-collapse x-cloak class="px-4 pb-4 md:px-[1.5rem] md:pb-[1.25rem] text-xs md:text-[0.9rem] text-slate-600 leading-relaxed md:leading-[1.6] border-t border-slate-100 pt-3">
                    <p class="margin-0">{!! $faq['answer'] !!}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- ZONA 6: SEO SILO & REGIONAL INTERLINKING                                  --}}
{{-- ========================================================================= --}}
@php
    $uniqueSiblingCities = isset($siblingCities) ? $siblingCities->unique('slug') : collect();
@endphp

@if($uniqueSiblingCities->isNotEmpty())
<section class="py-6 px-4 md:py-[3.5rem] md:px-6 max-w-6xl mx-auto mb-4" id="area-sekitar">
    <div class="border-t border-slate-200 pt-6">
        <h3 class="text-sm sm:text-base md:text-[1.25rem] font-extrabold text-slate-900 mb-1">📍 Layanan Pipa Mampet di Kota Sekitar {{ $city->name ?? 'Wilayah Terkait' }}</h3>
        <p class="text-xs md:text-[0.88rem] text-slate-500 mb-3 md:mb-5">Teknisi Rootera juga melayani wilayah tetangga di provinsi {{ $city->province->name ?? 'Jabodetabek & Java' }}:</p>

        <div class="flex flex-wrap gap-1.5 md:gap-2.5">
            @foreach($uniqueSiblingCities as $sib)
                <a href="{{ url('/jasa-saluran-mampet/' . $sib->slug) }}" class="bg-slate-50 border border-slate-300 hover:border-emerald-500 hover:bg-emerald-50/50 py-1.5 px-3 md:py-[0.45rem] md:px-[1rem] rounded-full text-xs md:text-[0.85rem] font-semibold md:font-bold text-slate-800 text-decoration-none transition inline-flex items-center gap-1">
                    <span>📍 Jasa Pipa {{ $sib->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

