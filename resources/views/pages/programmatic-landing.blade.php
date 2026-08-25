@extends('layouts.app')

{{-- Advanced JSON-LD Structured Data --}}
@section('schema-markup')
<?php
// 1. LocalBusiness / Plumber Schema
$localBusinessSchema = [
  "@context" => "https://schema.org",
  "@type" => ["LocalBusiness", "Plumber", "HomeAndConstructionBusiness"],
  "name" => "Rootera Plumbing - " . $category->name . " " . $locationName,
  "alternateName" => ["Rootera", "Rootera Indonesia", "J&J Group Plumbing Division"],
  "description" => $description,
  "@id" => $canonical . "#organization",
  "url" => $canonical,
  "telephone" => "+" . ($city->whatsapp_number ?: "6281385404000"),
  "logo" => asset('images/logo final.png'),
  "image" => $ogImage,
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
    "addressLocality" => $city->name,
    "addressRegion" => $city->province->name ?? "Indonesia",
    "addressCountry" => "ID"
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
    "@type" => "AdministrativeArea",
    "name" => $locationName
  ],
  "hasOfferCatalog" => [
    "@type" => "OfferCatalog",
    "name" => "Layanan " . $category->name,
    "itemListElement" => [
      [
        "@type" => "Offer",
        "itemOffered" => [
          "@type" => "Service",
          "name" => "Jasa " . $category->name . " " . $locationName,
          "description" => "Layanan mampet tanpa bongkar garansi tuntas 24 jam."
        ]
      ]
    ]
  ]
];

// 2. BreadcrumbList Schema
$breadcrumbItems = [
  [
    "@type" => "ListItem",
    "position" => 1,
    "name" => "Beranda",
    "item" => url('/')
  ],
  [
    "@type" => "ListItem",
    "position" => 2,
    "name" => "Layanan",
    "item" => route('layanan')
  ],
  [
    "@type" => "ListItem",
    "position" => 3,
    "name" => $category->name,
    "item" => route('layanan.show', $category->slug)
  ],
  [
    "@type" => "ListItem",
    "position" => 4,
    "name" => $city->name,
    "item" => url("/layanan/{$category->slug}/{$city->slug}")
  ]
];

if ($district) {
  $breadcrumbItems[] = [
    "@type" => "ListItem",
    "position" => 5,
    "name" => $district->name,
    "item" => $canonical
  ];
}

$breadcrumbSchema = [
  "@context" => "https://schema.org",
  "@type" => "BreadcrumbList",
  "itemListElement" => $breadcrumbItems
];

// 3. FAQPage Schema
$faqItems = [];

if (isset($localFaqs) && is_array($localFaqs)) {
  foreach ($localFaqs as $lfaq) {
    $faqItems[] = [
      "@type" => "Question",
      "name" => $lfaq['question'],
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => $lfaq['answer']
      ]
    ];
  }
}

foreach ($faqs as $faq) {
  $faqItems[] = [
    "@type" => "Question",
    "name" => str_replace(['[Kota]', '[Area]'], $locationShort, $faq->question),
    "acceptedAnswer" => [
      "@type" => "Answer",
      "text" => str_replace(['[Kota]', '[Area]'], $locationShort, $faq->answer)
    ]
  ];
}

$faqSchema = [
  "@context" => "https://schema.org",
  "@type" => "FAQPage",
  "mainEntity" => $faqItems
];
?>

<script type="application/ld+json">
{!! json_encode($localBusinessSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@push('styles')
<style>
/* Programmatic SEO Page Custom Styling */
.prog-hero {
    background: linear-gradient(135deg, #0A2E78 0%, #169F81 100%);
    color: #ffffff;
    padding: 4rem 1.5rem 5rem;
    position: relative;
    overflow: hidden;
}
.prog-hero::after {
    content: '';
    position: absolute;
    bottom: -30px;
    left: 0;
    width: 100%;
    height: 60px;
    background: #ffffff;
    transform: skewY(-1.5deg);
}
.prog-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 0.4rem 1.2rem;
    border-radius: 50px;
    font-size: 0.88rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}
.prog-title {
    font-size: clamp(2rem, 4vw, 3.25rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1.25rem;
    letter-spacing: -0.02em;
}
.prog-subtitle {
    font-size: 1.15rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 780px;
    line-height: 1.6;
    margin-bottom: 2rem;
}
.prog-breadcrumbs {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}
.prog-breadcrumbs a {
    color: #ffffff;
    text-decoration: underline;
}
.prog-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-top: 3rem;
}
.prog-feature-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.75rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid #E5E7EB;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.prog-feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(22, 159, 129, 0.12);
}
.prog-feature-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: rgba(22, 159, 129, 0.1);
    color: #169F81;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}
.spoke-section {
    background: #F9FAFB;
    padding: 4rem 1.5rem;
    border-top: 1px solid #E5E7EB;
    border-bottom: 1px solid #E5E7EB;
}
.spoke-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1.5rem;
}
.spoke-link {
    display: block;
    background: #ffffff;
    padding: 0.9rem 1.2rem;
    border-radius: 10px;
    border: 1px solid #E5E7EB;
    color: #1F2937;
    font-weight: 600;
    font-size: 0.92rem;
    transition: all 0.2s ease;
    text-align: center;
}
.spoke-link:hover {
    background: #169F81;
    color: #ffffff;
    border-color: #169F81;
    transform: translateY(-2px);
}
.faq-accordion-item {
    background: #ffffff;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    margin-bottom: 1rem;
    overflow: hidden;
}
.faq-accordion-header {
    padding: 1.25rem 1.5rem;
    font-weight: 700;
    color: #0A2E78;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.faq-accordion-body {
    padding: 0 1.5rem 1.25rem;
    color: #4B5563;
    line-height: 1.6;
}
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="prog-hero">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Breadcrumbs -->
        <nav class="prog-breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span>›</span>
            <a href="{{ route('layanan') }}">Layanan</a>
            <span>›</span>
            <a href="{{ route('layanan.show', $category->slug) }}">{{ $category->name }}</a>
            <span>›</span>
            <a href="{{ url('/layanan/' . $category->slug . '/' . $city->slug) }}">{{ $city->name }}</a>
            @if($district)
                <span>›</span>
                <span style="color: #ffffff; font-weight: 700;">{{ $district->name }}</span>
            @endif
        </nav>

        <div class="prog-badge">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
            Estimasi Tiba Teknisi: <strong>{{ $estimatedArrival }}</strong> di {{ $locationShort }}
        </div>

        <h1 class="prog-title">{!! $heroHeadline ?? "Jasa {$category->name} di {$locationName}" !!}</h1>
        <p class="prog-subtitle">
            {!! $heroSubtitle ?? "Solusi profesional terpercaya untuk masalah pipa mampet, wastafel tersumbat, kran air, dan saluran mampet di area <strong>{$locationName}</strong>. Berpengalaman, dikerjakan tanpa bongkar pipa paksa, dan bergaransi resmi tuntas 100%." !!}
        </p>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya butuh jasa ' . $category->name . ' di area ' . $locationName . '. Bisa bantu?') }}" target="_blank" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem; border-radius: 50px;">
                <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24" style="margin-right: 0.5rem;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                Panggil Teknisi Sekarang (24 Jam)
            </a>
        </div>

        {{-- Dynamic Local Context Dispatch Box --}}
        @if(isset($dispatchHub))
        <div style="margin-top: 2.5rem; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 16px; padding: 1.25rem 1.5rem; backdrop-filter: blur(10px); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; max-width: 900px;">
            <div style="display: flex; align-items: center; gap: 0.85rem; text-align: left;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.25); border: 1px solid rgba(16, 185, 129, 0.5); display: flex; align-items: center; justify-content: center; font-size: 1.35rem; color: #10B981; shrink-0;">
                    📍
                </div>
                <div>
                    <div style="font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #10B981;">Pos Hub Siaga Terdekat</div>
                    <div style="font-size: 0.95rem; font-weight: 800; color: #ffffff;">{{ $dispatchHub }}</div>
                </div>
            </div>
            @if(!empty($nearbyLandmarks))
            <div style="text-align: left; font-size: 0.82rem; color: rgba(255,255,255,0.85);">
                <span style="font-weight: 700; color: #38BDF8;">Cakupan Sekitar:</span>
                @foreach($nearbyLandmarks as $lm)
                    <span style="background: rgba(255,255,255,0.15); padding: 0.15rem 0.55rem; border-radius: 6px; margin-left: 0.2rem; display: inline-block; margin-top: 0.2rem;">{{ $lm }}</span>
                @endforeach
            </div>
            @endif
        </div>
        @endif
    </div>
</section>

<!-- Key Value Proposition Features -->
<section style="padding: 4rem 1.5rem; max-width: 1200px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <span style="color: #169F81; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.9rem;">Keunggulan Layanan Rootera</span>
        <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.5rem;">Mengapa Pilihan Utama di {{ $locationShort }}?</h2>
        @if(isset($areaTechnicalIntro))
            <p style="color: #4B5563; max-width: 800px; margin: 0.75rem auto 0; font-size: 1.05rem; line-height: 1.6;">{!! $areaTechnicalIntro !!}</p>
        @endif
    </div>

    <div class="prog-features">
        @if(isset($valueProps) && is_array($valueProps))
            @foreach($valueProps as $vp)
                <div class="prog-feature-card">
                    <div class="prog-feature-icon">{{ $vp['icon'] ?? '🛠️' }}</div>
                    <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $vp['title'] }}</h3>
                    <p style="color: #6B7280; font-size: 0.95rem; line-height: 1.5;">{{ $vp['desc'] }}</p>
                </div>
            @endforeach
        @else
            <div class="prog-feature-card">
                <div class="prog-feature-icon">🛠️</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Tanpa Bongkar Pipa</h3>
                <p style="color: #6B7280; font-size: 0.95rem; line-height: 1.5;">Menggunakan mesin rigid spiral modern yang fleksibel membersihkan kerak & lemak tanpa merusak lantai/keramik.</p>
            </div>
            <div class="prog-feature-card">
                <div class="prog-feature-icon">⚡</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Respons Cepat {{ $estimatedArrival }}</h3>
                <p style="color: #6B7280; font-size: 0.95rem; line-height: 1.5;">Teknisi stanby terdekat di wilayah {{ $locationName }} siap meluncur langsung begitu pesan diterima.</p>
            </div>
            <div class="prog-feature-card">
                <div class="prog-feature-icon">🛡️</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Garansi Pekerjaan</h3>
                <p style="color: #6B7280; font-size: 0.95rem; line-height: 1.5;">Jaminan garansi tuntas untuk memastikan masalah saluran tidak mampet kembali dalam jangka pendek.</p>
            </div>
            <div class="prog-feature-card">
                <div class="prog-feature-icon">🏷️</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Biaya Transparan</h3>
                <p style="color: #6B7280; font-size: 0.95rem; line-height: 1.5;">Harga jujur di awal tanpa biaya tersembunyi. Pembayaran dilakukan setelah pekerjaan terbukti lancar kembali.</p>
            </div>
        @endif
    </div>
</section>

<!-- B2B & Corporate Plumbing Maintenance Section (J&J Group) -->
<section style="background: linear-gradient(135deg, #060B14 0%, #0A2E78 100%); color: #ffffff; padding: 4.5rem 1.5rem;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="background: rgba(31, 175, 90, 0.2); color: #a3f0c2; border: 1px solid rgba(31, 175, 90, 0.4); padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Layanan Komersial & Industri</span>
            <h2 style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; margin-top: 0.8rem; color: #ffffff;">Layanan Plumbing B2B & Kontrak Perawatan Korporasi {{ $locationShort }}</h2>
            <p style="color: rgba(255,255,255,0.8); max-width: 780px; margin: 0.75rem auto 0; font-size: 1.05rem;">Solusi kesehatan sanitasi skala besar oleh <strong>Rootera Plumbing (Divisi Plumbing J&J Group)</strong> dengan garansi Service Level Agreement (SLA) & Faktur Pajak Resmi.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 1.75rem; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">🍽️ Restoran, Cafe & Cloud Kitchen</div>
                <p style="color: rgba(255,255,255,0.75); font-size: 0.92rem; line-height: 1.6;">Pembersihan grease trap berkala, pengikisan kerak lemak beku dapur komersial, & penanganan pipa mampet saat jam operasional padat.</p>
            </div>
            <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 1.75rem; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">🏨 Hotel, Apartemen & Kos Eksklusif</div>
                <p style="color: rgba(255,255,255,0.75); font-size: 0.92rem; line-height: 1.6;">Maintenance main vertical stack pipe, pelancaran floor drain kamar mandi per unit, & pembasmian bau tak sedap dari pembuangan.</p>
            </div>
            <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 1.75rem; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">🏢 Perkantoran, Mall & Ruko</div>
                <p style="color: rgba(255,255,255,0.75); font-size: 0.92rem; line-height: 1.6;">Jadwal pengerjaan Night Shift (Luar Jam Kerja) agar tidak mengganggu tenant & pengunjung. Dilengkapi PPN/Faktur Pajak.</p>
            </div>
            <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 1.75rem; backdrop-filter: blur(10px);">
                <div style="font-size: 2rem; margin-bottom: 0.75rem;">🏭 Pabrik, Gudang & Industri</div>
                <p style="color: rgba(255,255,255,0.75); font-size: 0.92rem; line-height: 1.6;">Hydro jetting tekanan tinggi untuk pipa limbah cair industri diameter besar & laporan visual kamera inspeksi CCTV.</p>
            </div>
        </div>

        <div style="background: rgba(31, 175, 90, 0.15); border: 1px solid rgba(31, 175, 90, 0.4); border-radius: 16px; padding: 2rem; text-align: center; max-width: 900px; margin: 0 auto;">
            <h3 style="font-size: 1.4rem; font-weight: 800; color: #a3f0c2; margin-bottom: 0.5rem;">Butuh Penawaran Resmi (SPK / Invoice B2B) untuk Perusahaan Anda?</h3>
            <p style="color: rgba(255,255,255,0.85); font-size: 0.98rem; margin-bottom: 1.5rem;">Tim Corporate Account Manager Rootera (J&J Group) siap survey lokasi dan menyusun kontrak preventive maintenance berkala.</p>
            <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera B2B Division (J&J Group), saya ingin konsultasi kontrak maintenance plumbing perusahaan di ' . $locationName) }}" target="_blank" class="btn" style="background: #1FAF5A; color: #fff; font-weight: 700; padding: 0.9rem 2rem; border-radius: 50px; text-decoration: none;">
                📞 Hubungi Tim Sales B2B J&J Group
            </a>
        </div>
    </div>
</section>

<!-- Door-to-Door Residential Service Guarantee Section -->
<section style="padding: 4.5rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; tracking-wider">Layanan Door-to-Door Perumahan</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.4rem;">Standar Pelayanan Rumah Tangga Rootera di {{ $locationShort }}</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
            <div style="border: 1px solid #E5E7EB; border-radius: 16px; padding: 1.75rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🧼</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">Bebas Bau Bau Kimia</h3>
                <p style="color: #6B7280; font-size: 0.92rem; line-height: 1.5;">Tidak menggunakan soda api beracun. Rumah Anda tetap segar dan aman untuk anak-anak & hewan peliharaan.</p>
            </div>
            <div style="border: 1px solid #E5E7EB; border-radius: 16px; padding: 1.75rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">👔</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">Teknisi Berseragam Resmi</h3>
                <p style="color: #6B7280; font-size: 0.92rem; line-height: 1.5;">Seluruh teknisi terverifikasi identitasnya, berseragam resmi Rootera / J&J Group, & menerapkan protokol kebersihan.</p>
            </div>
            <div style="border: 1px solid #E5E7EB; border-radius: 16px; padding: 1.75rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🛡️</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.5rem;">Garansi Resensial 30 Hari</h3>
                <p style="color: #6B7280; font-size: 0.92rem; line-height: 1.5;">Garansi pengerjaan ulang gratis jika saluran kembali mampet dalam masa garansi tanpa biaya tambahan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Comparison Table: Rootera (J&J Group) vs Conventional -->
<section style="background: #F9FAFB; padding: 4.5rem 1.5rem; border-top: 1px solid #E5E7EB; border-bottom: 1px solid #E5E7EB;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Komparasi Layanan</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.4rem;">Mengapa Memilih Rootera Plumbing (J&J Group)?</h2>
        </div>

        <div style="overflow-x: auto; background: #ffffff; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.92rem;">
                <thead>
                    <tr style="background: #0A2E78; color: #ffffff;">
                        <th style="padding: 1.2rem; font-weight: 700;">Parameter</th>
                        <th style="padding: 1.2rem; font-weight: 700; background: #169F81;">Rootera Plumbing (J&J Group)</th>
                        <th style="padding: 1.2rem; font-weight: 700; background: #374151;">Tukang Konvensional / Soda Api</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <td style="padding: 1rem 1.2rem; font-weight: 600; color: #1F2937;">Metode Pengerjaan</td>
                        <td style="padding: 1rem 1.2rem; font-weight: 700; color: #169F81; background: rgba(22,159,129,0.05);">Mesin Rooter Spiral Flexible (Tanpa Bongkar)</td>
                        <td style="padding: 1rem 1.2rem; color: #6B7280;">Bongkar Keramik Ubin / Siram Soda Api Hot</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <td style="padding: 1rem 1.2rem; font-weight: 600; color: #1F2937;">Risiko Kerusakan Pipa</td>
                        <td style="padding: 1rem 1.2rem; font-weight: 700; color: #169F81; background: rgba(22,159,129,0.05);">0% (Pipa Aman Terjaga)</td>
                        <td style="padding: 1rem 1.2rem; color: #DC2626;">Tinggi (Pipa Melengkung & Sambungan Lem Meleleh)</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <td style="padding: 1rem 1.2rem; font-weight: 600; color: #1F2937;">Efektivitas Kerak Lemak</td>
                        <td style="padding: 1rem 1.2rem; font-weight: 700; color: #169F81; background: rgba(22,159,129,0.05);">Hancur 100% Bergaransi</td>
                        <td style="padding: 1rem 1.2rem; color: #6B7280;">Sementara & Cepat Mampet Kembali</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <td style="padding: 1rem 1.2rem; font-weight: 600; color: #1F2937;">Waktu Penanganan</td>
                        <td style="padding: 1rem 1.2rem; font-weight: 700; color: #169F81; background: rgba(22,159,129,0.05);">30 - 60 Menit Tuntas</td>
                        <td style="padding: 1rem 1.2rem; color: #6B7280;">1 - 3 Hari (Mengganggu Aktivitas)</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #F3F4F6;">
                        <td style="padding: 1rem 1.2rem; font-weight: 600; color: #1F2937;">Garansi Pekerjaan</td>
                        <td style="padding: 1rem 1.2rem; font-weight: 700; color: #169F81; background: rgba(22,159,129,0.05);">Garansi Resmi 30 Hari & SLA B2B</td>
                        <td style="padding: 1rem 1.2rem; color: #DC2626;">Tanpa Garansi Resmi</td>
                    </tr>
                    <tr>
                        <td style="padding: 1rem 1.2rem; font-weight: 600; color: #1F2937;">Legalitas & Faktur Pajak B2B</td>
                        <td style="padding: 1rem 1.2rem; font-weight: 700; color: #169F81; background: rgba(22,159,129,0.05);">Resmi PT/CV (J&J Group) + Faktur Pajak</td>
                        <td style="padding: 1rem 1.2rem; color: #6B7280;">Perorangan / Tanpa Legalitas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Portfolio Project Showcase (Social Proof & Image SEO) -->
@if(isset($projectShowcases) && $projectShowcases->isNotEmpty())
<section style="background: #F3F4F6; padding: 4rem 1.5rem; border-top: 1px solid #E5E7EB;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Dokumentasi Pengerjaan Nyata</span>
            <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">Portofolio Proyek Rootera di {{ $locationShort }}</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach($projectShowcases as $proj)
            <div style="background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #E5E7EB; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
                <div style="position: relative; height: 200px; background: #0A2E78; overflow: hidden;">
                    <img src="{{ $proj->after_image_url }}" alt="{{ $proj->image_alt }}" style="width: 100%; height: 100%; object-fit: cover;">
                    <span style="position: absolute; top: 12px; right: 12px; background: #169F81; color: #fff; font-size: 0.75rem; font-weight: 700; padding: 0.3rem 0.8rem; border-radius: 50px; text-transform: uppercase;">
                        {{ $proj->client_type }}
                    </span>
                </div>
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.1rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem; line-height: 1.4;">{{ $proj->title }}</h3>
                    <p style="font-size: 0.88rem; color: #6B7280; line-height: 1.5; margin-bottom: 1rem;">{{ $proj->description }}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #F3F4F6; padding-top: 0.75rem; font-size: 0.82rem; color: #9CA3AF;">
                        <span>⏱️ Durasi: {{ $proj->completion_time }}</span>
                        <span style="color: #169F81; font-weight: 600;">✓ Selesai Bergaransi</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Spoke Internal Linking Section 1: Districts in the same City -->
@if($siblingDistricts->isNotEmpty())
<section class="spoke-section">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="color: #0A2E78; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">Jangkauan Kecamatan Jasa {{ $category->name }} di {{ $city->name }}</h3>
        <p style="color: #6B7280; font-size: 0.95rem;">Teknisi kami siap melayani seluruh kelurahan dan kecamatan di {{ $city->name }}:</p>

        <div class="spoke-grid">
            @foreach($siblingDistricts as $sibDistrict)
                <a href="{{ url('/layanan-pipa-mampet/' . $category->slug . '/' . $city->slug . '/' . $sibDistrict->slug) }}" class="spoke-link">
                    📍 {{ $category->name }} {{ $sibDistrict->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Spoke Internal Linking Section 2: Other Services in the same Location -->
<section style="padding: 4rem 1.5rem; max-width: 1200px; margin: 0 auto;">
    <h3 style="color: #0A2E78; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">Layanan Plumbing Lainnya di {{ $locationShort }}</h3>
    <p style="color: #6B7280; font-size: 0.95rem; margin-bottom: 1.5rem;">Solusi lengkap sanitasi dan perbaikan saluran air dari Rootera:</p>

    <div class="spoke-grid">
        @foreach($allCategories as $otherCategory)
            <a href="{{ url('/layanan-pipa-mampet/' . $otherCategory->slug . '/' . $city->slug . ($district ? '/' . $district->slug : '')) }}" class="spoke-link">
                🔧 {{ $otherCategory->name }} {{ $locationShort }}
            </a>
        @endforeach
    </div>
</section>

<!-- Hub Kawasan Jabodetabek Terpopuler -->
<section style="background: #ffffff; padding: 4rem 1.5rem; border-top: 1px solid #E5E7EB;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="color: #0A2E78; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">🔥 Hotspot Kawasan Jabodetabek &amp; Banten Terpopuler</h3>
        <p style="color: #6B7280; font-size: 0.95rem; margin-bottom: 1.5rem;">Pintasan ke pusat pemukiman residensial &amp; kawasan bisnis utama:</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 0.85rem;">
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/jakarta-utara/pantai-indah-kapuk-pik') }}" class="spoke-link">📍 PIK Pantai Indah Kapuk</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/jakarta-utara/kelapa-gading') }}" class="spoke-link">📍 Kelapa Gading Jakarta</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/tangerang-selatan/bintaro-jaya') }}" class="spoke-link">📍 Bintaro Jaya Tangsel</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/tangerang-selatan/bsd-city') }}" class="spoke-link">📍 BSD City Serpong</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/kabupaten-bogor/sentul-city') }}" class="spoke-link">📍 Sentul City Bogor</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/bekasi/grand-galaxy-city') }}" class="spoke-link">📍 Grand Galaxy Bekasi</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/depok/margonda') }}" class="spoke-link">📍 Margonda Depok</a>
            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/kabupaten-bekasi/cikarang-selatan-kawasan-mm2100-jababeka') }}" class="spoke-link">📍 Cikarang Industri</a>
        </div>
    </div>
</section>

<!-- FAQ Accordion Section -->
<section style="background: #ffffff; padding: 4rem 1.5rem; border-top: 1px solid #E5E7EB;">
    <div style="max-width: 900px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Pertanyaan Populer</span>
            <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.4rem;">FAQ Jasa {{ $category->name }} {{ $locationShort }}</h2>
        </div>

        <div>
            @if(isset($localFaqs) && is_array($localFaqs))
                @foreach($localFaqs as $lfaq)
                    <div class="faq-accordion-item" style="border-left: 4px solid #169F81;">
                        <div class="faq-accordion-header" style="color: #169F81;">
                            <span>{{ $lfaq['question'] }}</span>
                            <span style="color: #169F81; font-size: 1.2rem;">+</span>
                        </div>
                        <div class="faq-accordion-body">
                            {{ $lfaq['answer'] }}
                        </div>
                    </div>
                @endforeach
            @endif

            @foreach($faqs as $faq)
                <div class="faq-accordion-item">
                    <div class="faq-accordion-header">
                        <span>{{ str_replace(['[Kota]', '[Area]'], $locationShort, $faq->question) }}</span>
                        <span style="color: #169F81; font-size: 1.2rem;">+</span>
                    </div>
                    <div class="faq-accordion-body">
                        {{ str_replace(['[Kota]', '[Area]'], $locationShort, $faq->answer) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Clickable Local Tag Cloud Grid -->
<section style="background: #F8FAFC; padding: 3.5rem 1.5rem; border-top: 1px solid #E5E7EB;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="color: #0A2E78; font-size: 1.35rem; font-weight: 800; margin-bottom: 0.5rem;">🏷️ Pintasan Kata Kunci Pencarian Lokal di {{ $locationShort }}</h3>
        <p style="color: #6B7280; font-size: 0.92rem; margin-bottom: 1.25rem;">Kata kunci pencarian populer solusi pipa air &amp; saluran tersumbat:</p>

        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
            @php
                $localTags = [
                    "Jasa Pipa Mampet {$locationShort}",
                    "Tukang Saluran Mampet {$locationShort}",
                    "Pelancar Wastafel Berlemak {$locationShort}",
                    "Ahli Floor Drain Kamar Mandi {$locationShort}",
                    "Kloset WC Meluap 24 Jam {$locationShort}",
                    "Service Got & Talang Hujan {$locationShort}",
                    "Emergency Plumber {$locationShort}",
                    "Inspeksi Pipa Kamera CCTV {$locationShort}",
                    "Hydro Jetting Industri {$locationShort}",
                    "Sedot Pipa Tersumbat Tanpa Bongkar {$locationShort}"
                ];
            @endphp
            @foreach($localTags as $tag)
                <a href="{{ url('/solusi/' . \Illuminate\Support\Str::slug($tag) . ($city ? '/' . $city->slug : '')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #0A2E78; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;" class="hover:border-[#169F81] hover:text-[#169F81]">
                    #{{ $tag }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Emergency CTA Banner -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4rem 1.5rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem;">Saluran Air di {{ $locationShort }} Mampet Hari Ini?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2rem;">Jangan biarkan air meluap dan merusak ruangan Anda. Tim spesialis Rootera siap meluncur cepat {{ $estimatedArrival }} dengan garansi tuntas.</p>
        
        <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saluran saya mampet di ' . $locationName . '. Tolong bantu kirim teknisi sekarang.') }}" target="_blank" class="btn btn-primary" style="font-size: 1.15rem; padding: 1.1rem 2.5rem; border-radius: 50px;">
            Hubungi Customer Service WhatsApp (24 Jam)
        </a>
    </div>
</section>

@endsection
