@extends('layouts.app')

@section('schema-markup')
<?php
$citySlug = (isset($city) && is_object($city) && isset($city->slug)) ? $city->slug : '';
$cityName = (isset($city) && is_object($city)) ? ($city->full_name ?? $city->name ?? 'Kota') : 'Kota';
$cityCanonical = url("/jasa-saluran-mampet/{$citySlug}");
$cityPhone = (isset($city) && is_object($city) && !empty($city->whatsapp_number)) ? $city->whatsapp_number : "6281385404000";
$cityProvName = (isset($city) && is_object($city) && isset($city->province) && is_object($city->province)) ? ($city->province->name ?? "Indonesia") : "Indonesia";

$cityBusinessSchema = [
  "@context" => "https://schema.org",
  "@type" => ["LocalBusiness", "Plumber", "HomeAndConstructionBusiness"],
  "name" => "Rootera Plumbing - " . $cityName,
  "alternateName" => ["Rootera " . $cityName, "Jasa Pipa Mampet " . $cityName],
  "description" => $seo['description'] ?? "Jasa pelancar saluran pipa mampet di {$cityName} 24 jam bergaransi resmi.",
  "@id" => $cityCanonical . "#organization",
  "url" => $cityCanonical,
  "telephone" => "+" . $cityPhone,
  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "image" => $seo['og_image'] ?? asset('images/JnJ.webp'),
  "priceRange" => "$$",
  "parentOrganization" => [
    "@type" => "Organization",
    "name" => "J&J GROUP",
    "url" => url('/')
  ],
  "address" => [
    "@type" => "PostalAddress",
    "addressLocality" => (isset($city) && is_object($city)) ? ($city->name ?? $cityName) : $cityName,
    "addressRegion" => $cityProvName,
    "addressCountry" => "ID"
  ],
  "areaServed" => [
    "@type" => "City",
    "name" => $cityName
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
<!-- Hero Section with Regional Media Service WebP Integration -->
<?php
  $mediaService = app(\App\Services\MediaService::class);
  $provinceSlug = $city->province->slug ?? 'dki-jakarta';
  $regionalHeroImg = $mediaService->getRegionalImage($provinceSlug, $city->slug, 0);
?>
<section style="background: linear-gradient(135deg, #0A2E78 0%, #060B14 100%); color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #1FAF5A;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2.5rem;">
        
        <div style="flex: 1 1 550px;">
            <x-breadcrumbs :items="[
                ['name' => 'Beranda', 'url' => url('/')],
                ['name' => 'Area Layanan', 'url' => route('area-layanan')],
                ['name' => $cityName, 'url' => '']
            ]" />

            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(31, 175, 90, 0.2); border: 1px solid rgba(31, 175, 90, 0.4); color: #a3f0c2; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; margin-bottom: 1.5rem;">
                <span>📍 Pusat Layanan Area {{ $city->full_name ?? $city->name ?? 'Wilayah Terkait' }}</span>
                <span>•</span>
                <span>⏱️ Response {{ $city->estimated_arrival ?? '25-40 Menit' }}</span>
            </div>

            <h1 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; line-height: 1.2; margin-bottom: 1rem; color: #ffffff;">
                {!! $heroHeadline ?? ("Jasa Saluran Pipa Mampet " . ($city->full_name ?? $city->name ?? 'Wilayah Terkait')) !!}
            </h1>
            <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); max-width: 800px; margin-bottom: 2rem; line-height: 1.6;">
                {!! $heroSubtitle ?? ("Solusi profesional terpercaya untuk pelancaran wastafel, floor drain kamar mandi, kloset WC, &amp; pipa industri di <strong>" . ($city->full_name ?? $city->name ?? 'Wilayah Terkait') . "</strong>. Dikerjakan tanpa bongkar lantai oleh <strong>Rootera Plumbing (J&amp;J Group)</strong> bergaransi resmi tuntas 100%.") !!}
            </p>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya butuh jasa pelancar pipa mampet di area ' . ($city->full_name ?? 'Wilayah Terkait') . '. Bisa panggil teknisi?') }}" target="_blank" class="btn" style="background: #1FAF5A; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    Panggil Teknisi {{ $city->name ?? 'Wilayah Terkait' }} (24 Jam)
                </a>
            </div>
        </div>

        <div style="flex: 1 1 350px; max-width: 450px;">
            <div style="position: relative; border-radius: 24px; overflow: hidden; border: 2px solid rgba(255,255,255,0.15); box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
                <img src="{{ $regionalHeroImg }}" alt="Pos Respon Armada Jasa Pipa Mampet Rootera di {{ $city->full_name ?? 'Kota Terkait' }}" style="width: 100%; height: 280px; object-fit: cover;" loading="lazy" decoding="async">
                <div style="position: absolute; bottom: 0; inset-x: 0; background: linear-gradient(to top, rgba(6,11,20,0.9) 0%, transparent 100%); padding: 1.25rem; font-size: 0.85rem; font-weight: 700; color: #ffffff;">
                    📍 Pos Respon Armada {{ $city->full_name ?? $city->name }}
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Sub-District Grid Section -->
@if(isset($city->districts) && $city->districts->isNotEmpty())
<section style="padding: 4rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Cakupan Area Presisi</span>
            <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">Jangkauan Kecamatan di {{ $city->full_name ?? $city->name ?? 'Wilayah Terkait' }}</h2>
            <p style="color: #6B7280; font-size: 0.95rem; max-width: 700px; margin: 0.5rem auto 0;">Teknisi Rootera stanby di seluruh kecamatan {{ $city->name ?? 'Wilayah Terkait' }} untuk respon penanganan darurat cepat:</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
            @forelse($city->districts as $district)
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah') . '/' . $district->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1rem 1.25rem; text-decoration: none; color: #0A2E78; font-weight: 700; font-size: 0.95rem; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s;">
                    <span>📍 {{ $district->name }}</span>
                    <span style="color: #169F81; font-size: 0.85rem;">→</span>
                </a>
            @empty
                <p style="color: #6B7280;">Daftar kecamatan belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
@endif

<!-- Property Client Categories Showcase Grid (MediaService WebP Integration) -->
<?php
  $propertyVisuals = $mediaService->getPropertyImages();
  $cityNameClean = $city->name ?? 'Wilayah Terkait';
?>
<section style="background: #F9FAFB; padding: 4.5rem 1.5rem; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">🏢 Spesialisasi Tipe Properti</span>
            <h2 style="color: #0A2E78; font-size: clamp(1.8rem, 3.5vw, 2.2rem); font-weight: 800; margin-top: 0.4rem;">Solusi Jenis Bangunan &amp; Properti di {{ $cityNameClean }}</h2>
            <p style="color: #64748B; font-size: 0.95rem; max-width: 720px; margin: 0.4rem auto 0;">Armada teknisi Rootera siap meluncur dengan peralatan khusus disesuaikan dengan jenis properti tempat usaha &amp; hunian Anda.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            @foreach($propertyVisuals as $pKey => $pVisual)
            <a href="{{ route('property.show', $pVisual['slug']) }}" style="background: #ffffff; border-radius: 20px; border: 1px solid #E5E7EB; overflow: hidden; text-decoration: none; display: block; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.25s ease;" class="hover:-translate-y-1.5 hover:border-emerald-500 hover:shadow-xl group">
                <div style="position: relative; height: 170px; background: #0B192C; overflow: hidden;">
                    <img src="{{ $pVisual['url'] }}" alt="Jasa Saluran Pipa Mampet {{ $pVisual['name'] }} di {{ $cityNameClean }} - Rootera Plumbing" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy" decoding="async">
                    <span style="position: absolute; top: 10px; right: 10px; background: rgba(11, 25, 44, 0.85); color: #34D399; border: 1px solid rgba(52, 211, 153, 0.4); font-size: 0.72rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 50px; backdrop-filter: blur(4px);">
                        ⏱️ {{ $pVisual['badge'] }}
                    </span>
                    <span style="position: absolute; bottom: 10px; left: 12px; font-size: 1.5rem;">
                        {{ $pVisual['icon'] }}
                    </span>
                </div>
                <div style="padding: 1.25rem;">
                    <h3 style="color: #0A2E78; font-size: 1.1rem; font-weight: 800; margin: 0 0 0.4rem; line-height: 1.3;" class="group-hover:text-emerald-600 transition">
                        {{ $pVisual['name'] }}
                    </h3>
                    <p style="color: #64748B; font-size: 0.84rem; line-height: 1.5; margin: 0;">
                        Layanan pelancaran pipa tersumbat profesional di {{ $cityNameClean }} tanpa bongkar keramik.
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Multi-Service Categories Navigation Grid -->
@if(isset($allCategories) && $allCategories->isNotEmpty())
<section style="padding: 4rem 1.5rem; max-width: 1200px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Pilihan Layanan Terkait</span>
        <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">Layanan Plumbing Utama di {{ $city->name ?? 'Wilayah Terkait' }}</h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.25rem;">
        @foreach($allCategories as $cat)
            <a href="{{ url('/layanan-pipa-mampet/' . $cat->slug . '/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.25rem; text-decoration: none; color: #0A2E78; font-weight: 700; display: block; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                <div style="color: #169F81; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.3rem;">Rootera {{ $city->name ?? 'Wilayah Terkait' }}</div>
                <div style="font-size: 1.1rem; color: #0A2E78;">🔧 {{ $cat->name }}</div>
            </a>
        @endforeach
    </div>
</section>
@endif

<!-- Tag Wilayah & Pintasan Populer (Pill Badge Grid) -->
<section style="background: #F1F5F9; padding: 4rem 1.5rem; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #0A2E78; font-size: 1.4rem; font-weight: 800; margin-bottom: 0.4rem;">🏷️ Tag Wilayah &amp; Kata Kunci Pencarian Populer {{ $city->name ?? 'Wilayah Terkait' }}</h3>
            <p style="color: #64748B; font-size: 0.9rem;">Pintasan cepat kata kunci solusi pipa mampet di area {{ $city->name ?? 'Wilayah Terkait' }}:</p>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #334155; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Jasa Pipa Mampet {{ $city->name ?? 'Wilayah' }}</a>
            <a href="{{ url('/layanan-pipa-mampet/wastafel-mampet/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #334155; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Jasa Wastafel Mampet {{ $city->name ?? 'Wilayah' }}</a>
            <a href="{{ url('/layanan-pipa-mampet/kamar-mandi-mampet/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #334155; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Solusi Kamar Mandi Mampet {{ $city->name ?? 'Wilayah' }}</a>
            <a href="{{ url('/layanan-pipa-mampet/wc-toilet-mampet/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #334155; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Pelancar WC Mampet {{ $city->name ?? 'Wilayah' }}</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-industri-pabrik/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #334155; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Pipa Limbah Pabrik {{ $city->name ?? 'Wilayah' }}</a>
            <a href="{{ url('/layanan-pipa-mampet/inspeksi-pipa-kamera/' . ($city->slug ?? 'wilayah')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #334155; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Inspeksi CCTV Pipa {{ $city->name ?? 'Wilayah' }}</a>

            @if(isset($city->districts))
                @foreach($city->districts as $d)
                    <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . ($city->slug ?? 'wilayah') . '/' . $d->slug) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #0A2E78; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Pelancar Pipa {{ $d->name }}</a>
                    <a href="{{ url('/layanan-pipa-mampet/wastafel-mampet/' . ($city->slug ?? 'wilayah') . '/' . $d->slug) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #0A2E78; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Wastafel Mampet {{ $d->name }}</a>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Equipment & Technology Showcase Section (Dynamic DB Data) -->
<div style="max-width: 1200px; margin: 3rem auto; padding: 0 1.5rem;">
    <x-equipment-showcase title="🛠️ Peralatan Modern Teknisi Rootera di {{ $cityNameClean }}" subtitle="Unit mekanis &amp; kamera digital berstandar internasional yang disiapkan untuk area {{ $cityNameClean }} 100% tanpa bongkar." />
</div>

<!-- Interactive Media Documentation Showcase (Before-After Photos & Video Reels) -->
@include('components.media-documentation', [
    'projectShowcases' => $projectShowcases ?? null,
    'relatedArticles' => $relatedArticles ?? collect(),
    'locationName' => $city->full_name ?? $city->name ?? 'Wilayah Terkait',
    'locationShort' => $city->name ?? 'Wilayah Terkait'
])

<!-- Smart Interlinking Hub (Service Matrix, District Mesh with ETA, & B2B Cross-Link) -->
@include('components.smart-interlinking', [
    'category' => null,
    'city' => $city,
    'district' => null,
    'siblingDistricts' => $city->districts ?? collect(),
    'allCategories' => $allCategories ?? collect(),
    'locationShort' => $city->name ?? 'Wilayah Terkait'
])

<!-- Related Knowledge Hub Articles -->
@if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
<section style="background: #F8FAFC; padding: 4.5rem 1.5rem; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Pusat Edukasi</span>
            <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">Panduan Perawatan Pipa &amp; Tips Solusi Mampet</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach($relatedArticles as $art)
            <div style="background: #ffffff; border-radius: 16px; padding: 1.5rem; border: 1px solid #E2E8F0; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
                <span style="color: #169F81; font-size: 0.8rem; font-weight: 700; text-transform: uppercase;">Artikel Edukasi</span>
                <h3 style="font-size: 1.15rem; font-weight: 700; color: #0A2E78; margin: 0.5rem 0 0.75rem; line-height: 1.4;">
                    <a href="{{ route('blog.show', $art->slug) }}" style="color: inherit; text-decoration: none;">{{ $art->title }}</a>
                </h3>
                <p style="font-size: 0.9rem; color: #64748B; line-height: 1.5; margin-bottom: 1.25rem;">{{ Str::limit($art->excerpt, 110) }}</p>
                <a href="{{ route('blog.show', $art->slug) }}" style="color: #169F81; font-weight: 700; font-size: 0.88rem; text-decoration: none;">Baca Selengkapnya →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Neighboring Cities Section -->
@if(isset($siblingCities) && $siblingCities->isNotEmpty())
<section style="padding: 4rem 1.5rem; max-width: 1200px; margin: 0 auto;">
    <h3 style="color: #0A2E78; font-size: 1.4rem; font-weight: 800; margin-bottom: 0.5rem;">Layanan Pipa Mampet di Kota Sekitar {{ $city->name ?? 'Wilayah Terkait' }}</h3>
    <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 1.5rem;">Teknisi Rootera juga melayani wilayah tetangga di provinsi {{ $city->province->name ?? 'Jabodetabek & Java' }}:</p>

    <div style="display: flex; flex-wrap: wrap; gap: 0.8rem;">
        @foreach($siblingCities as $sib)
            <a href="{{ url('/jasa-saluran-mampet/' . $sib->slug) }}" style="background: #ffffff; border: 1px solid #CBD5E1; padding: 0.5rem 1.1rem; border-radius: 50px; font-size: 0.9rem; font-weight: 700; color: #0A2E78; text-decoration: none;">
                📍 Jasa Pipa {{ $sib->name }}
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
