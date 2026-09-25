@extends('layouts.app')

@section('meta_title', $title ?? ($seo['title'] ?? ''))
@section('meta_description', $description ?? ($seo['description'] ?? ''))
@section('og_image', !empty($ogImage) ? (str_starts_with($ogImage, 'http') ? $ogImage : secure_url(ltrim($ogImage, '/'))) : secure_url('images/og/rootera-default.jpg'))
@section('canonical', $canonical ?? ($seo['canonical'] ?? ''))

@push('preloads')
@if(!empty($ogImage))
    <link rel="preload" as="image" href="{{ $ogImage }}" fetchpriority="high">
@endif
@endpush

{{-- Advanced JSON-LD Structured Data --}}
{{-- Advanced Enterprise Nested JSON-LD Structured Data (@graph) --}}
@section('schema-markup')
<?php
$activeCategoryName = $category->name ?? "Saluran Pipa Mampet";

$serviceOffers = [
    [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Jasa " . $activeCategoryName . " " . $locationShort,
            "serviceType" => $activeCategoryName,
            "description" => "Pelancaran saluran " . strtolower($activeCategoryName) . " tersumbat di area " . $locationShort . " tanpa bongkar pipa."
        ]
    ]
];

// Area Served Mesh (District + Kelurahan Mesh)
$areaServedList = [
    [
        "@type" => "AdministrativeArea",
        "name" => $locationName
    ]
];

if (!empty($nearbyLandmarks) && is_array($nearbyLandmarks)) {
    foreach ($nearbyLandmarks as $landmark) {
        $areaServedList[] = [
            "@type" => "AdministrativeArea",
            "name" => "Kelurahan " . $landmark . ", " . $locationShort
        ];
    }
}

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

$serviceTypes = (!empty($city->street_address) && $city->has_physical_branch)
    ? ["PlumbingService", "LocalBusiness", "EmergencyService"]
    : ["PlumbingService", "EmergencyService"];

$mainEntity = [
    "@type" => $serviceTypes,
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
    "areaServed" => $areaServedList,
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Katalog Layanan Pelancaran " . $activeCategoryName . " " . $locationShort,
        "itemListElement" => $serviceOffers
    ]
];

$geoLat = !empty($district->latitude) ? (float) $district->latitude : (!empty($city->latitude) ? (float) $city->latitude : null);
$geoLng = !empty($district->longitude) ? (float) $district->longitude : (!empty($city->longitude) ? (float) $city->longitude : null);

if ($geoLat && $geoLng) {
    $mainEntity["geo"] = [
        "@type" => "GeoCoordinates",
        "latitude" => $geoLat,
        "longitude" => $geoLng
    ];
    $mainEntity["hasMap"] = "https://www.google.com/maps?q={$geoLat},{$geoLng}";
}

// Breadcrumbs (4-Level Silo Hierarchy)
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
        "name" => "Layanan " . $category->name . " " . $city->name,
        "item" => url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}")
    ];
    $breadcrumbItems[] = [
        "@type" => "ListItem",
        "position" => 4,
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
if (!empty($localFaqs) && (is_array($localFaqs) || is_object($localFaqs))) {
    foreach ($localFaqs as $lfaq) {
        $qText = is_array($lfaq) ? ($lfaq['question'] ?? '') : ($lfaq->question ?? '');
        $aText = is_array($lfaq) ? ($lfaq['answer'] ?? '') : ($lfaq->answer ?? '');
        if (!empty($qText)) {
            $faqItems[] = [
                "@type" => "Question",
                "name" => $qText,
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $aText
                ]
            ];
        }
    }
}

if (!empty($faqs) && (is_object($faqs) || is_array($faqs))) {
    try {
        $faqList = (is_object($faqs) && method_exists($faqs, 'take'))
            ? $faqs->take(5)
            : (is_array($faqs) ? array_slice($faqs, 0, 5) : []);

        foreach ($faqList as $faq) {
            $qName = is_object($faq) ? ($faq->question ?? '') : ($faq['question'] ?? '');
            $aText = is_object($faq) ? ($faq->answer ?? '') : ($faq['answer'] ?? '');
            if (!empty($qName)) {
                $faqItems[] = [
                    "@type" => "Question",
                    "name" => str_replace(['[Kota]', '[Area]'], $locationShort, $qName),
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => str_replace(['[Kota]', '[Area]'], $locationShort, $aText)
                    ]
                ];
            }
        }
    } catch (\Throwable $e) {
        // Safe fallback exception handling
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

@php
$orderList = $sectionOrder ?? [
    'hero',
    'technical-context',
    'pricing-estimator',
    'multi-sector',
    'local-coverage',
    'value-props',
    'media-showcase',
    'comparison-table',
    'b2b-corporate',
    'faq-accordion',
    'interlinking',
    'emergency-cta'
];
@endphp

@foreach($orderList as $sectionKey)
    @switch($sectionKey)
        @case('hero')
            {{-- 1. Hero: Headline, Live Badge, CTAs, Pos Hub --}}
            @include('sections.programmatic.hero')

            @if(($city && $city->slug === 'bandar-lampung') || (isset($city->province) && $city->province->slug === 'lampung') || ($district && $district->slug === 'kedaton'))
                <x-workshop-posko-bandar-lampung :city="$city" :district="$district" />
            @endif
            @break

        @case('technical-context')
            {{-- 1.5. Analisis Teknis & Solusi Spesifik Kategori --}}
            @include('sections.programmatic.technical-context')

            @if(isset($category) && (str_contains(strtolower($category->slug ?? ''), 'cctv') || str_contains(strtolower($category->slug ?? ''), 'inspeksi') || str_contains(strtolower($category->slug ?? ''), 'deteksi')))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @include('sections.cctv.use-cases')
                    @include('sections.cctv.tech-specs-deliverables')
                </div>
            @endif
            @break

        @case('pricing-estimator')
            {{-- 2. Estimasi Tarif: 4 pricing cards --}}
            @include('sections.programmatic.pricing-estimator')
            @break

        @case('multi-sector')
            {{-- 2.5. Multi-Sektor Properti --}}
            <x-multi-sector-grid :locationName="$district->name ?? $locationShort" :whatsappNumber="$city->whatsapp_number ?? '6281385404000'" />
            @break

        @case('local-coverage')
            {{-- 3. Cakupan Area Mikro / Kelurahan Mesh --}}
            @include('sections.programmatic.local-coverage')
            @break

        @case('value-props')
            {{-- 4. Standar Garansi & Keunggulan Layanan --}}
            @include('sections.programmatic.value-props')
            @break

        @case('media-showcase')
            {{-- 5. Bukti Pengerjaan: Media Showcase --}}
            @include('sections.programmatic.media-showcase')

            {{-- 5.5. Ulasan Asli Google Maps (Elfsight Live Widget) --}}
            <section class="bg-slate-50 py-12 border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-8">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 text-amber-800 font-bold text-xs uppercase tracking-wider mb-2">
                            ⭐ Ulasan Asli Google Maps
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Ulasan &amp; Rating Pelanggan Rootera Plumbing di {{ $locationShort }}
                        </h2>
                    </div>
                    <!-- Elfsight Google Reviews -->
                    <script src="https://elfsightcdn.com/platform.js" async></script>
                    <div class="elfsight-app-d736a051-79f5-4dc0-847d-0633b20dc8f5" data-elfsight-app-lazy></div>
                </div>
            </section>
            @break

        @case('comparison-table')
            {{-- 6. Tabel Komparasi Rootera vs Konvensional --}}
            @include('sections.programmatic.comparison-table')
            @break

        @case('b2b-corporate')
            {{-- 7. B2B Commercial & Industrial Banner --}}
            @include('sections.programmatic.b2b-corporate')
            @break

        @case('faq-accordion')
            {{-- 8. FAQ Akordion (5 pertanyaan kurasi) --}}
            @include('sections.programmatic.faq-accordion')
            @break

        @case('interlinking')
            {{-- 9. Smart Interlinking + Tag Cloud --}}
            @include('sections.programmatic.interlinking')
            @break

        @case('emergency-cta')
            {{-- 10. Emergency CTA Banner --}}
            @include('sections.programmatic.emergency-cta')
            @break
    @endswitch
@endforeach

@endsection
