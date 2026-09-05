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
</style>

<section class="area-hero-banner-bg" style="color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #1FAF5A; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="max-width: 850px;">
            <x-breadcrumbs :items="[
                ['name' => 'Beranda', 'url' => url('/')],
                ['name' => 'Area Layanan', 'url' => route('area-layanan')],
                ['name' => $cityName, 'url' => '']
            ]" />

            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(31, 175, 90, 0.25); border: 1px solid rgba(31, 175, 90, 0.45); color: #a3f0c2; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; margin-bottom: 1.5rem; backdrop-filter: blur(4px);">
                <span>📍 Pusat Layanan Area {{ $city->full_name ?? $city->name ?? 'Wilayah Terkait' }}</span>
                <span>•</span>
                <span>⏱️ Response {{ $city->estimated_arrival ?? '25-40 Menit' }}</span>
            </div>

            <h1 style="font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 800; line-height: 1.2; margin-bottom: 1rem; color: #ffffff; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">
                {!! $heroHeadline ?? ("Jasa Saluran Pipa Mampet " . ($city->full_name ?? $city->name ?? 'Wilayah Terkait')) !!}
            </h1>
            <p style="font-size: 1.12rem; color: rgba(255,255,255,0.92); max-width: 800px; margin-bottom: 2rem; line-height: 1.6; text-shadow: 0 1px 5px rgba(0,0,0,0.5);">
                {!! $heroSubtitle ?? ("Solusi profesional terpercaya untuk pelancaran wastafel, floor drain kamar mandi, kloset WC, &amp; pipa industri di <strong>" . ($city->full_name ?? $city->name ?? 'Wilayah Terkait') . "</strong>. Dikerjakan tanpa bongkar lantai oleh <strong>Rootera Plumbing (J&amp;J Group)</strong> bergaransi resmi tuntas 100%.") !!}
            </p>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya butuh jasa pelancar pipa mampet di area ' . ($city->full_name ?? 'Wilayah Terkait') . '. Bisa panggil teknisi?') }}" target="_blank" class="btn" style="background: #1FAF5A; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(31, 175, 90, 0.4);">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    Panggil Teknisi {{ $city->name ?? 'Wilayah Terkait' }} (24 Jam)
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
<section style="background: #F8FAFC; padding: 4rem 1.5rem; border-bottom: 1px solid #E2E8F0;" id="layanan-utama">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Header Zona 2 -->
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #10B981; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">⚡ LAYANAN &amp; SPESIALISASI PROPERTI</span>
            <h2 style="color: #0B192C; font-size: clamp(1.8rem, 3.5vw, 2.3rem); font-weight: 800; margin-top: 0.4rem;">Solusi Masalah Pipa &amp; Jenis Bangunan di {{ $cityNameClean }}</h2>
            <p style="color: #64748B; font-size: 0.98rem; max-width: 760px; margin: 0.4rem auto 0; line-height: 1.6;">Pilih masalah saluran mampet Anda atau kategori properti di bawah ini untuk penanganan presisi 24 jam tanpa bongkar keramik.</p>
        </div>

        <!-- Baris 1: 4 Masalah Utama (Gambar Asli Compact Card Design) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
            @foreach($coreProblemCards as $card)
            <a href="{{ $card['url'] }}" style="background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; overflow: hidden; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.25s ease, border-color 0.25s ease;" class="hover:-translate-y-1 hover:border-emerald-500 hover:shadow-lg group">
                <div>
                    <div style="position: relative; height: 130px; background: #0B192C; overflow: hidden;">
                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }} {{ $cityNameClean }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy" decoding="async">
                        <span style="position: absolute; top: 10px; right: 10px; background: rgba(11, 25, 44, 0.85); color: #34D399; border: 1px solid rgba(52, 211, 153, 0.4); font-size: 0.72rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 50px; backdrop-filter: blur(4px);">
                            {{ $card['badge'] }}
                        </span>
                    </div>
                    <div style="padding: 1rem 1.25rem;">
                        <h3 style="color: #0B192C; font-size: 1.05rem; font-weight: 800; margin: 0 0 0.3rem;" class="group-hover:text-emerald-600 transition">
                            {{ $card['title'] }}
                        </h3>
                        <p style="color: #64748B; font-size: 0.82rem; line-height: 1.4; margin: 0;">
                            {{ $card['desc'] }}
                        </p>
                    </div>
                </div>
                <div style="padding: 0 1.25rem 1rem; color: #10B981; font-weight: 800; font-size: 0.85rem; display: flex; align-items: center; gap: 0.25rem;">
                    Solusi {{ $cityNameClean }} →
                </div>
            </a>
            @endforeach
        </div>

        <!-- Baris 2: Sub-kategori Tipe Properti (Compact Card Design dengan Gambar Asli WebP) -->
        <div style="background: #ffffff; border-radius: 20px; border: 1px solid #E2E8F0; padding: 1.75rem; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="margin-bottom: 1.5rem; text-align: center;">
                <h3 style="color: #0B192C; font-size: 1.2rem; font-weight: 800; margin: 0;">🏢 Spesialisasi Tipe Properti &amp; Bangunan {{ $cityNameClean }}</h3>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                @foreach($propertyVisuals as $pKey => $pVisual)
                <a href="{{ route('property.show', $pVisual['slug']) }}" style="background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; overflow: hidden; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.25s ease;" class="hover:-translate-y-1 hover:border-emerald-500 hover:shadow-lg group">
                    <div>
                        <div style="position: relative; height: 130px; background: #0B192C; overflow: hidden;">
                            <img src="{{ $pVisual['url'] }}" alt="{{ $pVisual['name'] }} di {{ $cityNameClean }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy" decoding="async">
                            <span style="position: absolute; top: 10px; right: 10px; background: rgba(11, 25, 44, 0.85); color: #34D399; border: 1px solid rgba(52, 211, 153, 0.4); font-size: 0.7rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 50px; backdrop-filter: blur(4px);">
                                ⏱️ {{ $pVisual['badge'] }}
                            </span>
                            <span style="position: absolute; bottom: 8px; left: 10px; font-size: 1.3rem;">
                                {{ $pVisual['icon'] }}
                            </span>
                        </div>
                        <div style="padding: 1rem 1.25rem;">
                            <h3 style="color: #0B192C; font-size: 0.98rem; font-weight: 800; margin: 0 0 0.25rem;" class="group-hover:text-emerald-600 transition">
                                {{ $pVisual['name'] }}
                            </h3>
                            <p style="color: #64748B; font-size: 0.8rem; line-height: 1.4; margin: 0;">
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
<section style="background: #ffffff; padding: 4rem 1.5rem; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;" id="jangkauan-area">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: #10B981; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">📍 JANGKAUAN KECAMATAN &amp; LAYANAN KOMERSIAL</span>
            <h2 style="color: #0B192C; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">Cakupan Area Presisi di {{ $city->full_name ?? $city->name ?? 'Wilayah Terkait' }}</h2>
            <p style="color: #64748B; font-size: 0.95rem; max-width: 720px; margin: 0.4rem auto 0;">Armada teknisi Rootera standby di seluruh kecamatan {{ $city->name ?? 'Wilayah Terkait' }} &amp; melayani kontrak maintenance komersial B2B.</p>
        </div>

        <!-- Grid Kecamatan Kompak -->
        @if(isset($city->districts) && $city->districts->isNotEmpty())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 0.85rem; margin-bottom: 2.5rem;">
            @foreach($city->districts as $district)
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah') . '/' . $district->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 0.85rem 1.1rem; text-decoration: none; color: #0B192C; font-weight: 700; font-size: 0.9rem; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s;" class="hover:border-emerald-500 hover:bg-emerald-50/30">
                    <span>📍 {{ $district->name }}</span>
                    <span style="color: #10B981; font-size: 0.85rem;">→</span>
                </a>
            @endforeach
        </div>
        @endif

        <!-- Banner / Callout Box Ringkas B2B Komersial & Area Penyangga -->
        <div style="background: linear-gradient(135deg, #0B192C 0%, #1E293B 100%); border-radius: 20px; padding: 2rem 2.5rem; color: #ffffff; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.5rem; box-shadow: 0 10px 30px rgba(11, 25, 44, 0.12);">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(52, 211, 153, 0.15); color: #34D399; border: 1px solid rgba(52, 211, 153, 0.3); font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 50px; text-transform: uppercase; margin-bottom: 0.6rem;">
                    🏢 Layanan Komersial &amp; B2B Maintenance
                </div>
                <h3 style="font-size: 1.35rem; font-weight: 800; margin: 0 0 0.35rem; color: #ffffff;">
                    Butuh Kontrak Perawatan Pipa Berkala untuk Bisnis / Gedung di {{ $city->name }}?
                </h3>
                <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.92rem; margin: 0; max-width: 680px; line-height: 1.5;">
                    Sistem Hydro Jetting &amp; kamera endoskopi CCTV siap menangani limbah resto, ruko, hotel, &amp; pabrik di {{ $city->full_name }}.
                </p>
            </div>
            <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
                <a href="{{ route('b2b.index') }}" style="background: #10B981; color: #ffffff; font-weight: 800; padding: 0.8rem 1.6rem; border-radius: 50px; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.4rem;" class="hover:bg-emerald-600">
                    Konsultasi B2B Komersial →
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- ZONA 5: EDUKASI RINGKAS & FAQ LOKAL (Mobile Horizontal Carousel)          --}}
{{-- ========================================================================= --}}
<section style="background: #F8FAFC; padding: 4rem 1.5rem; border-bottom: 1px solid #E2E8F0;" id="faq-edukasi">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #10B981; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">❓ PERTANYAAN UMUM &amp; EDUKASI</span>
            <h2 style="color: #0B192C; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">Pertanyaan Sering Diajukan di {{ $cityNameClean }}</h2>
            <p style="color: #64748B; font-size: 0.95rem; max-width: 700px; margin: 0.4rem auto 0;">Informasi esensial garansi, waktu respon teknisi, dan metode kerja tanpa pembongkaran lantai.</p>
        </div>

        <!-- Section 4: 4 Essential FAQ Cards Mobile Carousel / Desktop Grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 no-scrollbar touch-pan-x md:grid md:grid-cols-2 md:overflow-visible md:pb-0 md:gap-4 max-w-[1000px] mx-auto">
            <div class="min-w-[82vw] sm:min-w-[320px] snap-center shrink-0 md:min-w-0" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.35rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                <h3 style="color: #0B192C; font-size: 1.05rem; font-weight: 800; margin: 0 0 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>⏱️ Berapa lama estimasi teknisi tiba di lokasi {{ $cityNameClean }}?</span>
                </h3>
                <p style="color: #64748B; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    Teknisi Rootera disiapgajikan di pos respon armada {{ $cityNameClean }} dengan estimasi kedatangan {{ $city->estimated_arrival ?? '25-40 Menit' }} setelah pemesanan dikonfirmasi via WhatsApp CS 24 jam.
                </p>
            </div>

            <div class="min-w-[82vw] sm:min-w-[320px] snap-center shrink-0 md:min-w-0" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.35rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                <h3 style="color: #0B192C; font-size: 1.05rem; font-weight: 800; margin: 0 0 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>🛡️ Apakah pengerjaan benar-benar 100% tanpa bongkar ubin/keramik?</span>
                </h3>
                <p style="color: #64748B; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    Ya. Kami menggunakan mesin rotary spiral baja Ridgid &amp; pemotong khusus yang fleksibel mengikuti lekukan pipa (P-Trap/S-Trap), memancarkan kerak lemak &amp; sumbatan tanpa perlu membongkar lantai keramik rumah Anda.
                </p>
            </div>

            <div class="min-w-[82vw] sm:min-w-[320px] snap-center shrink-0 md:min-w-0" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.35rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                <h3 style="color: #0B192C; font-size: 1.05rem; font-weight: 800; margin: 0 0 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>📜 Bagaimana ketentuan garansi 30 hari Rootera?</span>
                </h3>
                <p style="color: #64748B; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    Setiap penanganan dilengkapi nota garansi resmi 30 hari. Jika dalam masa garansi saluran yang sama kembali mampet, teknisi kami akan meluncur ulang dan mengerjakannya 100% GRATIS tanpa biaya tambahan.
                </p>
            </div>

            <div class="min-w-[82vw] sm:min-w-[320px] snap-center shrink-0 md:min-w-0" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.35rem 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                <h3 style="color: #0B192C; font-size: 1.05rem; font-weight: 800; margin: 0 0 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>💳 Bagaimana sistem pembayaran setelah pekerjaan selesai?</span>
                </h3>
                <p style="color: #64748B; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                    Sistem pembayaran berlaku <strong>No Flow No Pay</strong> (Hanya Bayar Jika Saluran Lancar). Pembayaran dapat dilakukan via transfer bank atau tunai setelah Anda menguji kelancaran air secara langsung.
                </p>
            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- ZONA 6: SEO SILO & REGIONAL INTERLINKING                                  --}}
{{-- ========================================================================= --}}
@if(isset($siblingCities) && $siblingCities->isNotEmpty())
<section style="padding: 3.5rem 1.5rem; max-width: 1200px; margin: 0 auto;" id="area-sekitar">
    <div style="border-top: 1px solid #E2E8F0; padding-top: 2.5rem;">
        <h3 style="color: #0B192C; font-size: 1.25rem; font-weight: 800; margin-bottom: 0.4rem;">📍 Layanan Pipa Mampet di Kota Sekitar {{ $city->name ?? 'Wilayah Terkait' }}</h3>
        <p style="color: #64748B; font-size: 0.88rem; margin-bottom: 1.25rem;">Teknisi Rootera juga melayani wilayah tetangga di provinsi {{ $city->province->name ?? 'Jabodetabek & Java' }}:</p>

        <div style="display: flex; flex-wrap: wrap; gap: 0.65rem;">
            @foreach($siblingCities as $sib)
                <a href="{{ url('/jasa-saluran-mampet/' . $sib->slug) }}" style="background: #F8FAFC; border: 1px solid #CBD5E1; padding: 0.45rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: #0B192C; text-decoration: none;" class="hover:border-emerald-500 hover:bg-emerald-50/50">
                    📍 Jasa Pipa {{ $sib->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
