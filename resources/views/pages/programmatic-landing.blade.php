@extends('layouts.app')

{{-- Advanced JSON-LD Structured Data --}}
@section('schema-markup')
<?php
// Dynamic Multi-Branch Schema Logic
if (isset($city) && $city->has_physical_branch && !empty($city->street_address)) {
    // 1. Schema LocalBusiness / Plumber untuk Cabang Fisik Riil (cth: Semarang, Tegal, Surabaya, Bandar Lampung, Jakarta Timur)
    $serviceSchema = [
        "@context" => "https://schema.org",
        "@type" => ["Plumber", "LocalBusiness"],
        "@id" => $canonical . "#localbusiness",
        "name" => "Rootera Plumbing Cabang " . $city->name,
        "alternateName" => ["Rootera " . $city->name, "Jasa Saluran Pipa Mampet " . $city->name],
        "url" => $canonical,
        "telephone" => "+" . ltrim($city->branch_phone ?: ($city->whatsapp_number ?: "6281385404000"), "+"),
        "priceRange" => "Rp 150.000 - Rp 1.500.000",
        "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        "image" => $ogImage,
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => $city->street_address,
            "addressLocality" => $city->district_locality ?: $city->name,
            "addressRegion" => $city->province->name ?? "Indonesia",
            "postalCode" => $city->postal_code ?: "13770",
            "addressCountry" => "ID"
        ],
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => (float) ($city->latitude ?: -6.3275975),
            "longitude" => (float) ($city->longitude ?: 106.8627125)
        ],
        "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => (string) ($city->rating_value ?: 4.9),
            "reviewCount" => (string) ($city->review_count ?: 85),
            "bestRating" => "5",
            "worstRating" => "1"
        ],
        "areaServed" => array_values(array_unique(array_merge([$locationName], isset($siblingDistricts) ? $siblingDistricts->pluck('name')->toArray() : [])))
    ];
} else {
    // 2. Schema Service (Service Area Business - SAB untuk area tanpa cabang fisik riil)
    $serviceSchema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "@id" => $canonical . "#service",
        "name" => "Jasa " . $category->name . " " . $locationName,
        "serviceType" => "Plumbing & Drain Cleaning Service",
        "description" => $description,
        "url" => $canonical,
        "provider" => [
            "@type" => "Organization",
            "name" => "Rootera Plumbing Indonesia",
            "url" => url('/'),
            "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            "telephone" => "+" . ltrim(($city->whatsapp_number ?? "6281385404000"), "+")
        ],
        "areaServed" => [
            "@type" => "AdministrativeArea",
            "name" => $locationName
        ],
        "hasOfferCatalog" => [
            "@type" => "OfferCatalog",
            "name" => "Layanan " . $category->name . " " . $locationName,
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
}

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
    "name" => "Jasa Saluran Mampet " . $city->name,
    "item" => url("/jasa-saluran-mampet/{$city->slug}")
  ]
];

if ($district) {
  $breadcrumbItems[] = [
    "@type" => "ListItem",
    "position" => 3,
    "name" => "Layanan " . $category->name . " " . $district->name,
    "item" => $canonical
  ];
} else {
  $breadcrumbItems[] = [
    "@type" => "ListItem",
    "position" => 3,
    "name" => "Layanan " . $category->name . " " . $city->name,
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
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
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

{{-- 1. Hero: Headline, Live Badge, CTAs, Pos Hub --}}
@include('sections.programmatic.hero')

{{-- 2. Estimasi Tarif: 4 pricing cards --}}
@include('sections.programmatic.pricing-estimator')

{{-- 3. Cakupan Area Mikro / Kelurahan Mesh --}}
@include('sections.programmatic.local-coverage')

{{-- 4. Standar Garansi & Keunggulan Layanan --}}
@include('sections.programmatic.value-props')

{{-- 5. Bukti Pengerjaan: Media Showcase --}}
@include('sections.programmatic.media-showcase')

{{-- 6. Tabel Komparasi Rootera vs Konvensional --}}
@include('sections.programmatic.comparison-table')

{{-- 7. B2B Commercial & Industrial Banner --}}
@include('sections.programmatic.b2b-corporate')

{{-- 8. FAQ Akordion (5 pertanyaan kurasi) --}}
@include('sections.programmatic.faq-accordion')

{{-- 9. Smart Interlinking + Tag Cloud --}}
@include('sections.programmatic.interlinking')

{{-- 10. Emergency CTA Banner --}}
@include('sections.programmatic.emergency-cta')

@endsection
