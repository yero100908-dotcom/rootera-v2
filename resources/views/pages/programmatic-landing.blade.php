@extends('layouts.app')

{{-- Advanced JSON-LD Structured Data --}}
{{-- Advanced Enterprise Nested JSON-LD Structured Data (@graph) --}}
@section('schema-markup')
<?php
$serviceOffers = [
    [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Jasa Wastafel & Cuci Piring Mampet " . $locationShort,
            "description" => "Pelancaran saluran cuci piring tersumbat lemak & sisa makanan tanpa bongkar pipa."
        ]
    ],
    [
        "@type" => "Offer",
        "price" => "450000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Jasa WC & Kloset Tersumbat " . $locationShort,
            "description" => "Pelancaran kloset duduk/jongkok mampet 24 jam dengan Ridgid Cable Machine tanpa perusak ubin."
        ]
    ],
    [
        "@type" => "Offer",
        "price" => "500000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Jasa Floor Drain & Got Mampet " . $locationShort,
            "description" => "Pembersihan pipa pembuangan kamar mandi & got mampet teknologi Hydro Jetting."
        ]
    ]
];

$addressSchema = [
    "@type" => "PostalAddress",
    "addressLocality" => $city->district_locality ?: ($district ? "{$district->name}, {$city->name}" : $city->name),
    "addressRegion" => $city->province->name ?? "Indonesia",
    "addressCountry" => "ID"
];
if (!empty($city->street_address)) {
    $addressSchema["streetAddress"] = $city->street_address;
}
if (!empty($city->postal_code)) {
    $addressSchema["postalCode"] = $city->postal_code;
}

$mainEntity = [
    "@type" => ["PlumbingService", "LocalBusiness", "EmergencyService"],
    "@id" => $canonical . "#organization",
    "name" => "Rootera Plumbing " . $locationShort,
    "alternateName" => ["Rootera " . $locationShort, "Jasa Saluran Pipa Mampet " . $locationShort],
    "url" => $canonical,
    "telephone" => "+" . ltrim(($city->branch_phone ?: ($city->whatsapp_number ?: "6281385404000")), "+"),
    "priceRange" => "Rp 400.000 - Rp 1.500.000",
    "image" => $ogImage,
    "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
    "description" => $description,
    "address" => $addressSchema,
    "openingHoursSpecification" => [
        [
            "@type" => "OpeningHoursSpecification",
            "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens" => "00:00",
            "closes" => "23:59"
        ]
    ],
    "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => (string) ($city->rating_value ?: 4.9),
        "reviewCount" => (string) ($city->review_count ?: 120),
        "bestRating" => "5",
        "worstRating" => "1"
    ],
    "areaServed" => [
        "@type" => "AdministrativeArea",
        "name" => $locationName
    ],
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Katalog Layanan Pelancaran Saluran Mampet " . $locationShort,
        "itemListElement" => $serviceOffers
    ]
];

if (!empty($city->latitude) && !empty($city->longitude)) {
    $mainEntity["geo"] = [
        "@type" => "GeoCoordinates",
        "latitude" => (float) $city->latitude,
        "longitude" => (float) $city->longitude
    ];
    $mainEntity["hasMap"] = "https://www.google.com/maps?q={$city->latitude},{$city->longitude}";
}

// Breadcrumbs
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

// FAQs
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

if (isset($faqs)) {
    foreach ($faqs->take(5) as $faq) {
        $faqItems[] = [
            "@type" => "Question",
            "name" => str_replace(['[Kota]', '[Area]'], $locationShort, $faq->question),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => str_replace(['[Kota]', '[Area]'], $locationShort, $faq->answer)
            ]
        ];
    }
}

$graphSchema = [
    "@context" => "https://schema.org",
    "@graph" => [
        $mainEntity,
        [
            "@type" => "BreadcrumbList",
            "@id" => $canonical . "#breadcrumb",
            "itemListElement" => $breadcrumbItems
        ],
        [
            "@type" => "FAQPage",
            "@id" => $canonical . "#faq",
            "mainEntity" => $faqItems
        ]
    ]
];
?>

<script type="application/ld+json">
{!! json_encode($graphSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
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

@if(($city && $city->slug === 'bandar-lampung') || (isset($city->province) && $city->province->slug === 'lampung') || ($district && $district->slug === 'kedaton'))
    <x-workshop-posko-bandar-lampung :city="$city" :district="$district" />
@endif

{{-- 2. Estimasi Tarif: 4 pricing cards --}}
@include('sections.programmatic.pricing-estimator')

{{-- 2.5. Multi-Sektor Properti --}}
<x-multi-sector-grid :locationName="$district->name ?? $locationShort" :whatsappNumber="$city->whatsapp_number ?? '6281385404000'" />

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
