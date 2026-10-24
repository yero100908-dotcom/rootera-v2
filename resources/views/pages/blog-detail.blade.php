@extends('layouts.app')

@section('schema-markup')
<?php
$wordCount = str_word_count(strip_tags($article->content));
$articleUrl = url('/blog/' . $article->slug);
$articleImgRaw = $article->thumbnail_url ?: asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp');
$articleImg = \Illuminate\Support\Str::startsWith($articleImgRaw, 'http://')
    ? 'https://' . substr($articleImgRaw, 7)
    : (\Illuminate\Support\Str::startsWith($articleImgRaw, 'https://') ? $articleImgRaw : secure_url(ltrim($articleImgRaw, '/')));

$publisherSchema = [
    "@type" => "Organization",
    "name" => "Rootera Plumbing",
    "url" => url('/'),
    "logo" => [
        "@type" => "ImageObject",
        "url" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
    ]
];

$authorPerson = [
    "@type" => "Person",
    "name" => $article->author ?: "Tim Teknis Rootera Plumbing",
    "jobTitle" => "Master Plumbing Specialist & Sanitary Engineer",
    "worksFor" => [
        "@type" => "Organization",
        "name" => "Rootera Plumbing",
        "url" => url('/')
    ]
];

$reviewerPerson = [
    "@type" => "Person",
    "name" => "Ir. Hendra Saputra, ST",
    "jobTitle" => "Lead Technical Sanitary Auditor & Senior Plumber",
    "alumniOf" => "Ikatan Ahli Perpipaan & Sanitasi Indonesia"
];

$providerSchema = [
    "@type" => "PlumbingService",
    "name" => "Rootera Plumbing",
    "url" => url('/'),
    "telephone" => "+6281385404000",
    "priceRange" => "$$",
    "areaServed" => ["Jakarta", "Bogor", "Depok", "Tangerang", "Bekasi", "Semarang", "Bandar Lampung"]
];

$schemas = [];

// Base schema attributes
$baseArticle = [
    "@context" => "https://schema.org",
    "@id" => $articleUrl . "#article",
    "headline" => $article->clean_title,
    "description" => $article->meta_description ?? $article->excerpt,
    "image" => [$articleImg],
    "wordCount" => $wordCount,
    "inLanguage" => "id-ID",
    "author" => $authorPerson,
    "reviewedBy" => $reviewerPerson,
    "publisher" => $publisherSchema,
    "provider" => $providerSchema,
    "datePublished" => $article->published_at?->toIso8601String() ?: now()->toIso8601String(),
    "dateModified" => $article->updated_at->toIso8601String(),
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => $articleUrl
    ]
];

// Context-Aware Schema by post_type
if ($article->isPromo()) {
    // 1. Promo: Article + SaleEvent / Offer
    $baseArticle["@type"] = ["Article", "SaleEvent"];
    $baseArticle["startDate"] = $article->published_at?->toIso8601String() ?: now()->toIso8601String();
    if ($article->promo_end_date) {
        $baseArticle["endDate"] = $article->promo_end_date->toIso8601String();
        $baseArticle["validThrough"] = $article->promo_end_date->toIso8601String();
    }
    $baseArticle["eventStatus"] = "https://schema.org/EventScheduled";
    $baseArticle["offers"] = [
        "@type" => "Offer",
        "name" => $article->clean_title,
        "priceCurrency" => "IDR",
        "availability" => "https://schema.org/InStock",
        "validThrough" => $article->promo_end_date?->toIso8601String() ?? now()->addMonth()->toIso8601String(),
        "seller" => $publisherSchema,
        "url" => $articleUrl
    ];
    $schemas[] = $baseArticle;
} elseif ($article->isCaseStudy()) {
    // 2. Case Study: TechArticle + LocalBusiness project
    $baseArticle["@type"] = ["TechArticle", "Report"];
    if ($article->client_name) {
        $baseArticle["customer"] = [
            "@type" => "Organization",
            "name" => $article->client_name
        ];
    }
    if ($article->location_geo) {
        $baseArticle["contentLocation"] = [
            "@type" => "Place",
            "name" => $article->location_geo,
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => $article->location_geo,
                "addressCountry" => "ID"
            ]
        ];
    }
    $schemas[] = $baseArticle;

    // Tambahan LocalBusiness context
    $schemas[] = [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "@id" => $articleUrl . "#business-case",
        "name" => "Rootera Plumbing - " . ($article->location_geo ?: 'Layanan Proyek B2B'),
        "image" => $articleImg,
        "telephone" => "+6281385404000",
        "url" => url('/'),
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => $article->location_geo ?: "Jabodetabek",
            "addressCountry" => "ID"
        ],
        "department" => [
            "@type" => "PlumbingService",
            "name" => "Divisi Proyek Industri & B2B Rootera"
        ]
    ];
} elseif ($article->post_type === 'news' || $article->post_type === 'press_release') {
    // 3. News / Press Release: NewsArticle
    $baseArticle["@type"] = "NewsArticle";
    $baseArticle["dateline"] = $article->location_geo ?? "Jakarta, Indonesia";
    $baseArticle["printEdition"] = $article->post_type === 'press_release' ? 'Press Release Resmi' : 'Kabar Perusahaan';
    $schemas[] = $baseArticle;
} else {
    // 4. TechArticle / Standard Article
    $baseArticle["@type"] = ["BlogPosting", "TechArticle"];
    $baseArticle["proficiencyLevel"] = "Expert";
    $schemas[] = $baseArticle;
}

// 5. VideoObject Schema jika artikel memiliki safe_youtube_id
if ($article->safe_youtube_id) {
    $schemas[] = [
        "@context" => "https://schema.org",
        "@type" => "VideoObject",
        "@id" => $articleUrl . "#video",
        "name" => $article->clean_title,
        "description" => $article->meta_description ?? $article->excerpt ?? "Video panduan teknis plumbing oleh Rootera.",
        "thumbnailUrl" => [
            "https://i.ytimg.com/vi/{$article->safe_youtube_id}/hqdefault.jpg",
            "https://i.ytimg.com/vi/{$article->safe_youtube_id}/maxresdefault.jpg"
        ],
        "uploadDate" => $article->published_at?->toIso8601String() ?: now()->toIso8601String(),
        "embedUrl" => "https://www.youtube.com/embed/{$article->safe_youtube_id}",
        "contentUrl" => "https://www.youtube.com/watch?v={$article->safe_youtube_id}",
        "publisher" => $publisherSchema
    ];
}

// Breadcrumb Schema
$breadcrumbSchema = [
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
            "name" => "Content Hub",
            "item" => route('blog')
        ],
        [
            "@type" => "ListItem",
            "position" => 3,
            "name" => $article->category ?? 'Panduan',
            "item" => route('blog', ['category' => $article->category ?? 'all'])
        ],
        [
            "@type" => "ListItem",
            "position" => 4,
            "name" => $article->clean_title,
            "item" => $articleUrl
        ]
    ]
];
$schemas[] = $breadcrumbSchema;

// FAQ Schema extraction
preg_match_all('/<h4[^>]*>Q:\s*(.*?)<\/h4>\s*<p[^>]*>A:\s*(.*?)<\/p>/is', $article->content, $faqMatches, PREG_SET_ORDER);
if (!empty($faqMatches)) {
    $faqEntities = [];
    foreach ($faqMatches as $match) {
        $faqEntities[] = [
            "@type" => "Question",
            "name" => trim(strip_tags($match[1])),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => trim(strip_tags($match[2]))
            ]
        ];
    }
    if (!empty($faqEntities)) {
        $schemas[] = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $faqEntities
        ];
    }
}
?>
@foreach($schemas as $s)
<script type="application/ld+json">
{!! json_encode($s, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endforeach
@endsection

@push('styles')
{{-- Editorial Google Font for Classic Serif Drop Cap & Pull-Quotes --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;0,900;1,400;1,700&display=swap" rel="stylesheet">

<style>
/* Editorial Typography Flourishes: Classic Serif Drop Cap for First Paragraph */
.article-prose > p:first-of-type::first-letter {
    font-size: 3.85rem;
    font-weight: 900;
    float: left;
    line-height: 0.82;
    margin-right: 0.95rem;
    margin-top: 0.15rem;
    padding: 0.35rem 0.75rem;
    color: #047857;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.12), rgba(6, 78, 59, 0.04));
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 12px;
    font-family: 'Playfair Display', Georgia, Cambria, "Times New Roman", Times, serif;
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.08);
}

.category-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
    border: 1px solid rgba(16, 185, 129, 0.25);
    font-weight: 800;
    font-size: 0.75rem;
    padding: 0.35rem 0.9rem;
    border-radius: 9999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Editorial Prose Typography Styling (Generous Line Height & Editorial Feel) */
.article-prose {
    font-size: 1.075rem;
    line-height: 1.95;
    color: #334155;
}
.article-prose p {
    margin-bottom: 1.65rem;
}
.article-prose h2 {
    color: #0f172a;
    font-size: clamp(1.35rem, 2.4vw, 1.75rem);
    margin: 2.75rem 0 1.15rem;
    font-weight: 800;
    line-height: 1.35;
    scroll-margin-top: 100px;
    border-left: 4px solid #10b981;
    padding-left: 0.85rem;
}
.article-prose h3 {
    color: #0f172a;
    font-size: clamp(1.15rem, 1.9vw, 1.4rem);
    margin: 2.25rem 0 0.95rem;
    font-weight: 800;
    line-height: 1.4;
    scroll-margin-top: 100px;
    border-left: 3px solid #3b82f6;
    padding-left: 0.75rem;
}
.article-prose ul {
    padding-left: 1.4rem;
    margin-bottom: 1.65rem;
    list-style-type: none;
}
.article-prose ul li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.75rem;
}
.article-prose ul li::before {
    content: "✓";
    position: absolute;
    left: 0;
    top: 0;
    color: #10b981;
    font-weight: 900;
    font-size: 0.9rem;
}
.article-prose ol {
    padding-left: 1.5rem;
    margin-bottom: 1.65rem;
}
.article-prose ol li {
    margin-bottom: 0.75rem;
}

/* Sticky Desktop Table of Contents Styles (Deconstructed & Invisible) */
.toc-nav-item {
    display: block;
    padding: 0.45rem 0.65rem;
    border-radius: 10px;
    color: #475569;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.2s ease;
    text-decoration: none;
    line-height: 1.45;
    border-left: 3px solid transparent;
}
.toc-nav-item:hover {
    color: #059669;
    background: rgba(16, 185, 129, 0.08);
}
.toc-nav-item.active {
    color: #047857;
    background: rgba(236, 253, 245, 0.9);
    font-weight: 800;
    border-left-color: #10b981;
}
.toc-nav-item.is-h3 {
    padding-left: 1.35rem;
    font-size: 0.75rem;
    opacity: 0.9;
}

/* Interactive FAQ Accordion Styles */
.faq-accordion-item {
    margin-top: 0.65rem;
    margin-bottom: 0.65rem;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(167, 243, 208, 0.7);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    transition: all 0.2s ease;
}
@media (min-width: 640px) {
    .faq-accordion-item {
        margin-top: 1.25rem;
        margin-bottom: 1.25rem;
        border-radius: 16px;
    }
}
.faq-accordion-header {
    background: rgba(236, 253, 245, 0.85);
    color: #0f172a;
    font-size: 0.875rem;
    font-weight: 800;
    padding: 0.85rem 1rem;
    cursor: pointer;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 0.65rem;
    user-select: none;
    border-left: 4px solid #10b981;
    transition: background 0.2s ease;
}
@media (min-width: 640px) {
    .faq-accordion-header {
        font-size: 0.975rem;
        padding: 1rem 1.25rem;
        gap: 0.75rem;
        align-items: center;
    }
}
.faq-accordion-header:hover {
    background: #dcfce7;
}
.faq-accordion-body {
    background: #f0fdf4;
    padding: 0.85rem 1rem 1rem;
    color: #334155;
    font-size: 0.8125rem;
    line-height: 1.65;
    border-top: 1px solid rgba(167, 243, 208, 0.5);
    display: none;
    transition: all 0.3s ease;
}
@media (min-width: 640px) {
    .faq-accordion-body {
        padding: 1rem 1.25rem 1.25rem;
        font-size: 0.95rem;
        line-height: 1.75;
    }
}
.faq-accordion-item.active .faq-accordion-body {
    display: block;
}
.faq-icon-chevron {
    width: 16px;
    height: 16px;
    transition: transform 0.2s ease;
    flex-shrink: 0;
    color: #059669;
    margin-top: 2px;
}
@media (min-width: 640px) {
    .faq-icon-chevron {
        width: 18px;
        height: 18px;
        margin-top: 0;
    }
}
.faq-accordion-item.active .faq-icon-chevron {
    transform: rotate(180deg);
}

.article-prose blockquote {
    margin: 2.25rem 0;
    padding: 1.35rem 1.75rem;
    background: rgba(240, 253, 244, 0.6);
    border-left: 4px solid #10b981;
    border-radius: 0 16px 16px 0;
    font-size: 1.1rem;
    font-style: italic;
    color: #064e3b;
    line-height: 1.75;
    font-weight: 600;
}

/* Navigation Article Cards */
.nav-article-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 1.25rem;
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-decoration: none;
}
.nav-article-card:hover {
    border-color: #10b981;
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.1);
    transform: translateY(-2px);
}
</style>
@endpush

@section('content')

{{-- DYNAMIC READING PROGRESS BAR --}}
<div class="fixed top-0 left-0 right-0 z-50 h-1 bg-slate-200/40 pointer-events-none">
    <div id="readingProgressBar" class="h-full w-0 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 transition-all duration-150 ease-out"></div>
</div>

{{-- STICKY VERTICAL FLOATING SHARE BAR (DESKTOP XL) --}}
<div class="fixed left-4 lg:left-6 top-1/3 flex-col gap-3 hidden xl:flex z-50 p-2.5 bg-white/90 backdrop-blur-md border border-slate-200/80 rounded-2xl shadow-xl transition-all duration-300 hover:shadow-2xl">
    <span class="text-[9px] font-black uppercase text-slate-400 text-center tracking-wider px-1">Share</span>
    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
       target="_blank" rel="noopener noreferrer" title="Bagikan ke WhatsApp"
       class="w-10 h-10 rounded-xl bg-[#25D366] hover:bg-[#1eb956] text-white flex items-center justify-center transition-transform hover:scale-110 shadow-md shadow-emerald-500/20 text-decoration-none">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
    </a>
    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');" 
            title="Salin Link Artikel" 
            class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-transform hover:scale-110 shadow-xs border border-slate-200/70 text-sm font-bold cursor-pointer">
        🔗
    </button>
</div>

{{-- 1. BORDERLESS CINEMATIC IMMERSIVE HERO (TEXT DIRECTLY ON HERO, NO OVERLAPPING BOX) --}}
<section class="relative w-full min-h-[550px] md:min-h-[620px] lg:min-h-[680px] bg-slate-950 flex flex-col justify-end overflow-hidden pt-28 pb-12 sm:pb-16 md:pb-20">
    
    {{-- Background Media Layer --}}
    @if($article->safe_youtube_id)
    <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
        <iframe class="w-full h-full object-cover scale-105 pointer-events-auto" 
                src="https://www.youtube-nocookie.com/embed/{{ $article->safe_youtube_id }}?autoplay=0&rel=0&modestbranding=1" 
                title="{{ e($article->clean_title) }}" 
                loading="lazy" 
                referrerpolicy="strict-origin-when-cross-origin" 
                sandbox="allow-scripts allow-same-origin allow-presentation" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>
    </div>
    @elseif($article->thumbnail_url)
    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->thumbnail_alt ?: $article->clean_title }}" loading="eager" fetchpriority="high" decoding="async" class="w-full h-full object-cover absolute inset-0 z-0 scale-105 transition-transform duration-1000 opacity-90">
    @else
    <div class="w-full h-full bg-gradient-to-br from-[#071930] via-[#0B2545] to-[#0D3B66] absolute inset-0 z-0"></div>
    @endif

    {{-- Ultra Deep Cinematic Vignette & Gradient Overlays for Maximum Text Contrast --}}
    <div class="absolute inset-0 bg-gradient-to-t from-[#071930] via-[#071930]/80 to-black/60 z-10 pointer-events-none"></div>
    <div class="absolute top-0 inset-x-0 h-44 bg-gradient-to-b from-black/85 via-black/40 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute bottom-1/4 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-emerald-500/15 rounded-full blur-[140px] z-10 pointer-events-none"></div>

    {{-- Hero Text Elements (DIRECTLY on Hero, Pure White, drop-shadow-md) --}}
    <div class="container mx-auto px-4 sm:px-6 relative z-20 max-w-5xl">
        
        {{-- BREADCRUMBS --}}
        <nav class="flex flex-wrap items-center gap-1.5 text-xs text-slate-300 mb-3 sm:mb-4 drop-shadow-md font-medium" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-emerald-400 transition text-slate-300">Beranda</a>
            <span class="text-slate-400">›</span>
            <a href="{{ route('blog') }}" class="hover:text-emerald-400 transition text-slate-300">Content Hub</a>
            <span class="text-slate-400">›</span>
            <a href="{{ route('blog', ['category' => $article->category]) }}" class="hover:text-emerald-400 transition text-slate-300">{{ $article->category ?? 'Panduan' }}</a>
            <span class="text-slate-400">›</span>
            <span class="text-white font-bold max-w-[200px] sm:max-w-[340px] truncate">{{ $article->clean_title }}</span>
        </nav>

        {{-- CATEGORY & POST TYPE BADGES --}}
        <div class="mb-4 flex items-center gap-2 flex-wrap">
            @if($article->isPromo())
                <span class="inline-flex items-center gap-1.5 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider bg-rose-500/25 text-rose-300 border border-rose-400/40 backdrop-blur-md drop-shadow-md">
                    🏷️ Promo Khusus
                </span>
                @if($article->promo_end_date)
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-3 py-1 rounded-full bg-amber-500/25 text-amber-300 border border-amber-400/40 backdrop-blur-md drop-shadow-md">
                        ⏰ Berlaku s/d {{ $article->promo_end_date->translatedFormat('d F Y') }}
                    </span>
                @endif
            @elseif($article->isCaseStudy())
                <span class="inline-flex items-center gap-1.5 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider bg-indigo-500/25 text-indigo-300 border border-indigo-400/40 backdrop-blur-md drop-shadow-md">
                    💼 Studi Kasus B2B
                </span>
                @if($article->client_name)
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold px-3 py-1 rounded-full bg-indigo-900/70 text-indigo-200 border border-indigo-400/30 backdrop-blur-md drop-shadow-md">
                        🏢 Klien: {{ $article->client_name }}
                    </span>
                @endif
                @if($article->location_geo)
                    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-3 py-1 rounded-full bg-white/10 text-slate-200 border border-white/20 backdrop-blur-md drop-shadow-md">
                        📍 {{ $article->location_geo }}
                    </span>
                @endif
            @elseif($article->post_type === 'news')
                <span class="inline-flex items-center gap-1.5 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider bg-blue-500/25 text-blue-300 border border-blue-400/40 backdrop-blur-md drop-shadow-md">
                    📰 Kabar Perusahaan
                </span>
            @elseif($article->post_type === 'press_release')
                <span class="inline-flex items-center gap-1.5 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider bg-purple-500/25 text-purple-300 border border-purple-400/40 backdrop-blur-md drop-shadow-md">
                    📢 Press Release
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 text-xs font-black px-3.5 py-1 rounded-full uppercase tracking-wider bg-emerald-500/25 text-emerald-300 border border-emerald-400/40 backdrop-blur-md drop-shadow-md">
                    📌 {{ $article->category ?? 'Tips Sanitasi' }}
                </span>
            @endif
        </div>

        {{-- ARTICLE TITLE (WHITE, DRAMATIC EDITORIAL, DROP SHADOW) --}}
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight sm:leading-snug mb-6 tracking-tight drop-shadow-md">
            {{ $article->title }}
        </h1>

        {{-- E-E-A-T EDITORIAL AUTHOR & METADATA ROW --}}
        <div class="pt-5 border-t border-white/15 flex flex-col md:flex-row md:items-center justify-between gap-4 drop-shadow-md">
            
            {{-- Author Profile (Left) --}}
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md text-emerald-300 font-black flex items-center justify-center text-xl border border-white/20 shadow-md shrink-0">
                    👨‍🔧
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm sm:text-base font-extrabold text-white leading-tight">
                            {{ $article->author ?: 'Tim Teknis Rootera Plumbing' }}
                        </span>
                        <span class="bg-emerald-500/25 text-emerald-300 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full border border-emerald-400/30 inline-flex items-center gap-1 backdrop-blur-md">
                            <span>✓</span> Verified E-E-A-T
                        </span>
                    </div>
                    <span class="text-xs text-slate-300 font-medium block mt-0.5">
                        Master Plumbing Specialist &amp; Praktisi Sanitasi Lapangan
                    </span>
                </div>
            </div>

            {{-- Meta Info (Right) --}}
            <div class="flex items-center gap-2.5 text-xs text-slate-300 font-semibold flex-wrap">
                <span class="bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/15 text-white">📅 {{ $article->published_at?->translatedFormat('d M Y') ?: now()->translatedFormat('d M Y') }}</span>
                <span class="bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/15 text-white">⏱️ {{ $article->reading_time }} mnt</span>
                <span class="bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/15 text-emerald-300">👁️ {{ $article->views }} views</span>
            </div>

        </div>

        {{-- BADGE PENINJAU AHLI (EXPERT REVIEWER BANNER) --}}
        <div class="mt-4 pt-3.5 border-t border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs drop-shadow-md">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-slate-200 border border-white/15 px-3.5 py-1.5 rounded-xl font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                <span>🔬 Ditulis oleh <strong class="text-white">{{ $article->author ?: 'Tim Rootera' }}</strong> • Ditinjau secara teknis oleh <strong class="text-emerald-300">Ahli Sanitasi &amp; K3 Perpipaan Senior</strong></span>
            </div>
            <div class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-slate-300 pl-1 sm:pl-0">
                <span>🛡️ Standar SNI 03-6481-2000</span>
                <span class="text-slate-500">•</span>
                <span>Kepatuhan K3 &amp; AMDAL</span>
            </div>
        </div>

    </div>
</section>

{{-- MAIN CONTENT & SIDEBAR WRAPPER --}}
<div class="bg-slate-50/70 pt-10 sm:pt-14 pb-24 xl:pb-16">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 max-w-6xl mx-auto">
            
            {{-- MAIN ARTICLE COLUMN (8 COLS) --}}
            <main class="lg:col-span-8">
                <article class="bg-white rounded-3xl p-6 sm:p-10 md:p-12 border border-slate-200/80 shadow-xs">
                    
                    {{-- 3. EDITORIAL PULL-QUOTE MEWAH (REPLACES BOX ALERT) --}}
                    @if($article->excerpt)
                    <div class="relative my-6 sm:my-8 py-5 px-6 sm:px-8 border-l-4 border-emerald-500 overflow-hidden bg-transparent">
                        {{-- Large Faded Quote Icon Watermark --}}
                        <svg class="absolute -top-3 -left-1 w-20 h-20 text-emerald-500/10 pointer-events-none -z-0 fill-current select-none" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <div class="relative z-10">
                            <span class="block text-[11px] font-black text-emerald-700 uppercase tracking-widest mb-2">
                                💡 Ringkasan Panduan &amp; Fact Sheet
                            </span>
                            <p class="text-lg sm:text-xl font-serif italic text-slate-800 leading-relaxed m-0 font-medium">
                                "{{ $article->excerpt }}"
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- MOBILE COLLAPSIBLE TABLE OF CONTENTS (TOC) --}}
                    <div id="tableOfContents" class="toc-box hidden lg:hidden bg-slate-50/90 border border-slate-200/90 rounded-2xl p-4 sm:p-5 mb-8 transition-all">
                        <div class="flex items-center justify-between font-extrabold text-slate-900 text-sm pb-2.5 border-b border-slate-200/80">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span>📑 Daftar Isi Artikel &amp; Panduan</span>
                            </div>
                            <button id="tocToggleBtn" onclick="toggleToc()" class="text-xs font-bold text-slate-600 hover:text-slate-900 bg-white px-2.5 py-1 rounded-lg border border-slate-200 shadow-2xs flex items-center gap-1 transition">
                                <span id="tocToggleText">Sembunyikan</span>
                                <svg id="tocToggleIcon" class="w-3.5 h-3.5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>
                        <div id="tocContent" class="mt-3 overflow-hidden transition-all duration-300">
                            <ol id="tocList" class="space-y-2 text-xs sm:text-sm font-semibold text-slate-700 list-decimal pl-5"></ol>
                        </div>
                    </div>

                    {{-- ARTICLE HTML CONTENT CONTAINER (WITH CLASSIC SERIF DROP CAP & PROSE) --}}
                    <div id="article-content" class="article-prose">
                        {!! $article->content !!}
                    </div>

                    {{-- TOPIC & SEO TAGS PILLS --}}
                    @if(!empty($article->tags))
                    @php
                        $articleTags = array_filter(array_map('trim', explode(',', $article->tags)));
                    @endphp
                    @if(count($articleTags) > 0)
                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-2">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-wider mr-1">🏷️ Topik Terkait:</span>
                        @foreach($articleTags as $tag)
                            <a href="{{ route('blog', ['q' => $tag]) }}" class="inline-flex items-center bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 text-[11px] px-3 py-1 rounded-xl font-bold transition-all text-decoration-none border border-slate-200/60 shadow-2xs hover:border-emerald-300">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                    @endif
                    @endif

                    {{-- <!-- PREMIUM AUTHOR & EXPERT PROFILE BOX (E-E-A-T) --> --}}
                    <div class="py-8 my-10 border-y border-slate-200/60 bg-transparent flex flex-col sm:flex-row items-start sm:items-center gap-6">
                        {{-- Avatar Profile with Glowing Effect & Verified Badge --}}
                        <div class="relative shrink-0 group/avatar">
                            <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-teal-400 rounded-3xl blur-md opacity-40 group-hover/avatar:opacity-75 transition duration-500"></div>
                            <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-[#070F1E] text-white flex items-center justify-center text-3xl font-black border border-emerald-400/40 shadow-xl shadow-emerald-500/10">
                                👨‍🔧
                            </div>
                            <span class="absolute -bottom-1 -right-1 bg-emerald-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-white shadow-xs font-bold z-10" title="Teknisi Terverifikasi">
                                ✓
                            </span>
                        </div>

                        {{-- Bio & Credibility --}}
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <div>
                                    <h4 class="text-base font-extrabold text-slate-900 m-0 leading-tight">
                                        {{ $article->author ?: 'Ir. Hendra Saputra, ST & Tim Master Plumber' }}
                                    </h4>
                                    <p class="text-xs font-bold text-emerald-700 m-0 mt-0.5">
                                        Spesialis Diagnosa Pipa &amp; Hydro-Jetting Bersertifikat (12+ Tahun Pengalaman)
                                    </p>
                                </div>
                                <span class="inline-flex items-center gap-1 text-[11px] font-extrabold bg-emerald-100/90 text-emerald-800 px-2.5 py-1 rounded-full border border-emerald-200">
                                    🛡️ Verified Expert
                                </span>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed m-0 font-medium">
                                Berpengalaman lebih dari 12 tahun dalam investigasi kamera CCTV pipa pembuangan, flushing bertekanan tinggi (Hydro-Jetting), dan rancang bangun sistem grease trap komersial &amp; residensial sesuai standar SNI 03-6481-2000 dan regulasi lingkungan AMDAL.
                                @if($article->location_geo)
                                    Termasuk penanganan prioritas untuk area layanan khusus di <strong>{{ $article->location_geo }}</strong> dan sekitarnya.
                                @endif
                            </p>

                            {{-- Typography Data Row --}}
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between sm:justify-start gap-4 sm:gap-8 divide-x divide-slate-200">
                                <div class="flex flex-col">
                                    <span class="text-base sm:text-lg font-black text-slate-900 leading-tight">15.000+</span>
                                    <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Titik Tertangani</span>
                                </div>
                                <div class="pl-4 sm:pl-8 flex flex-col">
                                    <span class="text-base sm:text-lg font-black text-emerald-600 leading-tight">95%</span>
                                    <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Sukses Tanpa Bongkar</span>
                                </div>
                                <div class="pl-4 sm:pl-8 flex flex-col">
                                    <span class="text-base sm:text-lg font-black text-slate-900 leading-tight">24/7</span>
                                    <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Standby Darurat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <!-- CINEMATIC DARK CTA BOX --> --}}
                    <div class="my-10 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#071930] rounded-3xl p-6 sm:p-10 border border-white/20 shadow-2xl text-white relative overflow-hidden">
                        {{-- Ambient Light Orbs --}}
                        <div class="absolute -right-10 -bottom-10 w-96 h-96 bg-emerald-500/20 rounded-full blur-[100px] pointer-events-none" aria-hidden="true"></div>
                        <div class="absolute -left-10 -top-10 w-80 h-80 bg-cyan-500/10 rounded-full blur-[90px] pointer-events-none" aria-hidden="true"></div>

                        <div class="relative z-10">
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="inline-flex items-center gap-1.5 bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-[10px] sm:text-xs font-black py-1 px-3 rounded-full uppercase tracking-wider backdrop-blur-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>⚡ Respon Cepat 24/7</span>
                                </span>
                                <span class="inline-flex items-center gap-1 bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 text-[10px] sm:text-xs font-black py-1 px-3 rounded-full uppercase tracking-wider backdrop-blur-md">
                                    🛡️ Garansi 30 Hari
                                </span>
                                <span class="inline-flex items-center gap-1 bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[10px] sm:text-xs font-black py-1 px-3 rounded-full uppercase tracking-wider backdrop-blur-md">
                                    🏢 Residensi &amp; B2B
                                </span>
                            </div>

                            <h3 class="text-2xl sm:text-3xl font-black text-white mb-3.5 leading-tight tracking-tight">
                                Mengalami Masalah Pipa Serupa di Rumah atau Kantor Anda?
                            </h3>
                            
                            <p class="text-xs sm:text-sm text-slate-300 mb-8 max-w-2xl leading-relaxed font-medium">
                                Tim teknisi master Rootera Plumbing (holding J&amp;J Group) siap membantu penanganan darurat rumah tangga 24 jam serta kontrak perawatan rutin tempat usaha (Restoran, Mall, Hotel, Pabrik) dengan Garansi 30 Hari &amp; Tanpa Bongkar.
                            </p>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca artikel "' . $article->title . '" dan mau panggil teknisi pipa mampet.') }}" 
                                   target="_blank" rel="noopener noreferrer" 
                                   class="bg-[#25D366] hover:bg-[#1eb956] text-white font-black text-xs sm:text-sm py-4 px-6 rounded-2xl shadow-xl shadow-emerald-950/40 hover:-translate-y-1 transition-all flex items-center justify-center gap-2 text-decoration-none">
                                    <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                                    <span class="whitespace-nowrap">📱 Panggil Teknisi WA (24 Jam)</span>
                                </a>
                                
                                <a href="{{ route('b2b.contract', 'restoran-cafe') }}" 
                                   class="bg-white/10 hover:bg-white/20 border border-white/25 backdrop-blur-md text-white font-bold text-xs sm:text-sm py-4 px-6 rounded-2xl hover:-translate-y-1 transition-all flex items-center justify-center gap-2 text-decoration-none shadow-md">
                                    <span class="whitespace-nowrap">🏢 Maintenance B2B &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- 4. REDESAIN EKSTREM: AREA JANGKAUAN & LAYANAN POPULER (BORDERLESS CONTAINER & ELEGANT PILLS) --}}
                    <div class="my-10 pt-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 border-b border-slate-200/80 pb-3">
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-900 m-0">📍 Area Jangkauan Service &amp; Pipa Mampet Terdekat</h4>
                                <p class="text-xs text-slate-500 m-0 mt-0.5">Reservasi armada teknisi profesional Rootera di kota operasional Anda:</p>
                            </div>
                            <a href="{{ route('area-layanan') }}" class="text-xs font-extrabold text-emerald-600 hover:text-emerald-700 text-decoration-none shrink-0">
                                Lihat Semua Kota &rarr;
                            </a>
                        </div>
                        @if(isset($cities) && count($cities) > 0)
                        <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2 max-h-64 sm:max-h-none overflow-y-auto pr-1 mb-5">
                            @foreach($cities as $c)
                                <a href="{{ url('/jasa-saluran-mampet/' . $c->slug) }}" class="bg-white border border-slate-200/80 text-slate-600 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-md transition-all rounded-xl py-2 px-3 text-xs font-bold text-decoration-none text-center truncate flex items-center justify-center gap-1.5 shadow-2xs">
                                    <span>📍</span>
                                    <span class="truncate">Jasa Pipa {{ $c->name }}</span>
                                </a>
                            @endforeach
                        </div>
                        @endif

                        {{-- CONTEXTUAL INTERNAL SERVICE PAGE LINKS --}}
                        <div class="pt-3 border-t border-slate-200/80 flex flex-wrap items-center gap-2 text-xs">
                            <span class="font-black text-slate-700 text-xs">Layanan Populer:</span>
                            <a href="{{ route('area-layanan') }}" class="bg-white border border-slate-200/80 text-slate-600 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-md transition-all rounded-xl px-3 py-1.5 font-bold text-decoration-none shadow-2xs">
                                🔧 Jasa Pipa Mampet
                            </a>
                            <a href="{{ route('services.cuci-toren') }}" class="bg-white border border-slate-200/80 text-slate-600 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-md transition-all rounded-xl px-3 py-1.5 font-bold text-decoration-none shadow-2xs">
                                🚰 Jasa Cuci Toren Air
                            </a>
                            <a href="{{ route('b2b.index') }}" class="bg-white border border-slate-200/80 text-slate-600 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-md transition-all rounded-xl px-3 py-1.5 font-bold text-decoration-none shadow-2xs">
                                🏢 Layanan B2B Komersial
                            </a>
                            <a href="{{ route('diagnostic.index') }}" class="bg-white border border-slate-200/80 text-slate-600 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-md transition-all rounded-xl px-3 py-1.5 font-bold text-decoration-none shadow-2xs">
                                🔍 Cek Kondisi Pipa (Diagnostik)
                            </a>
                        </div>
                    </div>

                </article>

                {{-- NEXT / PREVIOUS ARTICLE NAVIGATION CARDS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
                    @if(isset($previousArticle) && $previousArticle)
                    <a href="{{ route('blog.show', $previousArticle->slug) }}" class="nav-article-card group">
                        <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-2 block">
                            ← Artikel Sebelumnya
                        </span>
                        <div class="flex items-center gap-3">
                            <img src="{{ $previousArticle->thumbnail_url }}" alt="{{ $previousArticle->thumbnail_alt ?: $previousArticle->clean_title }}" loading="lazy" decoding="async" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 bg-slate-900">
                            <h5 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
                                {{ $previousArticle->clean_title }}
                            </h5>
                        </div>
                    </a>
                    @else
                    <div></div>
                    @endif

                    @if(isset($nextArticle) && $nextArticle)
                    <a href="{{ route('blog.show', $nextArticle->slug) }}" class="nav-article-card group text-right">
                        <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-2 block">
                            Artikel Selanjutnya →
                        </span>
                        <div class="flex items-center justify-end gap-3 text-right">
                            <h5 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
                                {{ $nextArticle->clean_title }}
                            </h5>
                            <img src="{{ $nextArticle->thumbnail_url }}" alt="{{ $nextArticle->thumbnail_alt ?: $nextArticle->clean_title }}" loading="lazy" decoding="async" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 bg-slate-900">
                        </div>
                    </a>
                    @endif
                </div>

                {{-- MOBILE ONLY: RELATED ARTICLES GRID --}}
                @if(isset($relatedArticles) && count($relatedArticles) > 0)
                <div class="lg:hidden my-8">
                    <h3 class="text-sm font-extrabold text-slate-900 mb-4 pb-2 border-b border-slate-200">
                        📚 Panduan Terkait Lainnya
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach($relatedArticles as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="bg-white rounded-2xl p-3 border border-slate-200/80 shadow-2xs hover:border-emerald-500 transition text-decoration-none">
                            <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->thumbnail_alt ?: $rel->clean_title }}" loading="lazy" decoding="async" class="w-full aspect-video object-cover rounded-xl mb-2 bg-slate-900">
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-2 leading-tight">{{ $rel->clean_title }}</h5>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </main>

            {{-- 2. DECONSTRUCTED INVISIBLE SIDEBAR COLUMN (4 COLS) --}}
            <aside class="lg:col-span-4 space-y-6">
                <div class="sticky top-24 space-y-6">
                    
                    {{-- STICKY TABLE OF CONTENTS (INVISIBLE / TRANSPARENT BLENDED) --}}
                    <div id="desktopStickyToc" class="hidden lg:block py-2 transition-all">
                        <div class="flex items-center justify-between font-black text-slate-900 text-xs tracking-wider uppercase pb-3 mb-3 border-b border-slate-200/80">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>📑 Daftar Isi Artikel</span>
                            </div>
                            <span class="text-[10px] font-extrabold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">
                                Navigasi Cepat
                            </span>
                        </div>
                        <nav id="desktopTocList" class="max-h-[50vh] overflow-y-auto pr-1 space-y-1 text-xs">
                            {{-- Diisi secara dinamis oleh JavaScript --}}
                        </nav>
                    </div>

                    {{-- EMERGENCY WA CALLOUT CARD (STANDOUT PROMINENT EXCEPTION) --}}
                    <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 border border-slate-800 rounded-3xl p-6 text-white text-center shadow-xl relative overflow-hidden">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center text-2xl mx-auto mb-3 border border-emerald-500/30">
                            ⚡
                        </div>
                        <h3 class="text-base font-extrabold text-white mb-2">Butuh Bantuan Teknisi Darurat?</h3>
                        <p class="text-xs text-slate-300 mb-5 leading-relaxed">
                            Teknisi Rootera standby 24 jam dengan estimasi tiba 30-45 menit. Pengerjaan 100% tanpa bongkar pipa &amp; garansi 30 hari!
                        </p>
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya mau panggil teknisi pipa mampet sekarang.') }}" 
                           target="_blank" rel="noopener noreferrer" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#1eb956] text-white text-xs font-extrabold py-3.5 px-4 rounded-xl transition text-decoration-none shadow-lg hover:shadow-emerald-900/40">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                            <span>📱 Panggil Teknisi WA (24 Jam)</span>
                        </a>
                    </div>

                    {{-- TRENDING ARTICLES (INVISIBLE / TRANSPARENT BLENDED) --}}
                    @if(isset($trendingArticles) && count($trendingArticles) > 0)
                    <div class="py-2">
                        <div class="flex items-center justify-between font-black text-slate-900 text-xs tracking-wider uppercase mb-4 pb-2 border-b border-slate-200/80">
                            <span class="flex items-center gap-1.5">
                                <span>⚡</span>
                                <span>Berita &amp; Tren Terpopuler</span>
                            </span>
                            <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-black">POPULER</span>
                        </div>
                        <div class="space-y-4">
                            @foreach($trendingArticles as $trend)
                            <a href="{{ route('blog.show', $trend->slug) }}" class="flex items-center gap-3 group text-decoration-none py-1">
                                <img src="{{ $trend->thumbnail_url }}" alt="{{ $trend->thumbnail_alt ?: $trend->clean_title }}" loading="lazy" decoding="async" class="w-14 h-14 rounded-2xl object-cover flex-shrink-0 border border-slate-200 bg-slate-900 shadow-2xs group-hover:scale-105 transition-transform">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">{{ $trend->clean_title }}</h4>
                                    <div class="text-[10px] text-slate-400 mt-1 flex items-center gap-2 font-medium">
                                        <span>⏱️ {{ $trend->reading_time }} mnt</span>
                                        <span>•</span>
                                        <span>👁️ {{ $trend->views }}</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- INDUSTRY CATEGORIES LIST (INVISIBLE / TRANSPARENT BLENDED) --}}
                    <div class="py-2">
                        <div class="font-black text-slate-900 text-xs tracking-wider uppercase mb-3 pb-2 border-b border-slate-200/80 flex items-center gap-2">
                            <span>📌</span>
                            <span>Pilar Kategori Industri</span>
                        </div>
                        <div class="space-y-1.5">
                            @foreach(\App\Models\Article::CATEGORIES as $catKey => $catLabel)
                            <a href="{{ route('blog', ['category' => $catKey]) }}" class="flex items-center justify-between text-xs font-semibold text-slate-700 hover:text-emerald-700 hover:bg-slate-200/70 p-2.5 rounded-xl transition text-decoration-none">
                                <span>{{ $catKey }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">&rarr;</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </aside>

        </div>
    </div>
</div>

{{-- 4. MOBILE STICKY BOTTOM ACTION BAR (BLOCK XL:HIDDEN) --}}
<div class="block xl:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur-xl border-t border-slate-200/90 shadow-[0_-10px_25px_rgba(0,0,0,0.08)] px-4 py-2.5">
    <div class="max-w-md mx-auto flex items-center justify-between gap-2.5">
        {{-- Reading time pill --}}
        <div class="flex items-center gap-1.5 text-xs font-bold text-slate-600 bg-slate-100/90 px-3 py-2 rounded-xl shrink-0 border border-slate-200/60">
            <span>⏱️</span>
            <span>{{ $article->reading_time }} mnt</span>
        </div>

        <div class="flex items-center gap-2 flex-1 justify-end">
            {{-- Copy Link Button --}}
            <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');" 
                    title="Salin Link Artikel" 
                    class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 active:scale-95 text-slate-700 flex items-center gap-1 text-xs font-bold transition border border-slate-200 shadow-2xs cursor-pointer">
                <span>🔗</span>
                <span class="hidden sm:inline">Salin</span>
            </button>

            {{-- Share WA Button --}}
            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
               target="_blank" rel="noopener noreferrer" 
               class="px-3.5 py-2 rounded-xl bg-[#25D366] hover:bg-[#1eb956] active:scale-95 text-white flex items-center gap-1.5 text-xs font-extrabold shadow-sm transition text-decoration-none">
                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                <span>Share WA</span>
            </a>

            {{-- Panggil Teknisi WA --}}
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca artikel "' . $article->title . '" dan mau panggil teknisi pipa mampet.') }}" 
               target="_blank" rel="noopener noreferrer" 
               class="px-3.5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 active:scale-95 text-white flex items-center gap-1.5 text-xs font-black shadow-md transition text-decoration-none">
                <span>⚡ Panggil CS</span>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Dynamic Reading Progress Bar Calculation
window.addEventListener('scroll', function() {
    const article = document.getElementById('article-content') || document.getElementById('articleBody');
    const progressBar = document.getElementById('readingProgressBar');
    if (!article || !progressBar) return;

    const articleHeight = article.offsetHeight;
    const windowHeight = window.innerHeight;
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const articleTop = article.offsetTop;
    
    if (scrollTop < articleTop - 200) {
        progressBar.style.width = '0%';
        return;
    }

    const totalScrollable = articleHeight - windowHeight + 300;
    const scrolled = scrollTop - (articleTop - 150);
    const progress = Math.min(100, Math.max(0, (scrolled / Math.max(1, totalScrollable)) * 100));

    progressBar.style.width = progress + '%';
});

// Dynamic Table of Contents (TOC) with Smooth Scroll & Scroll-Spy
document.addEventListener("DOMContentLoaded", function() {
    const articleContent = document.getElementById('article-content') || document.getElementById('articleBody');
    const mobileTocBox = document.getElementById('tableOfContents');
    const mobileTocList = document.getElementById('tocList');
    const desktopTocBox = document.getElementById('desktopStickyToc');
    const desktopTocList = document.getElementById('desktopTocList');

    if (!articleContent) return;

    const headings = articleContent.querySelectorAll('h2, h3');
    if (headings.length < 2) {
        if (mobileTocBox) mobileTocBox.classList.add('hidden');
        if (desktopTocBox) desktopTocBox.classList.add('hidden');
        return;
    }

    const tocLinks = [];

    headings.forEach((heading, index) => {
        let id = heading.getAttribute('id');
        if (!id) {
            id = 'heading-section-' + index;
            heading.setAttribute('id', id);
        }

        const isH3 = heading.tagName.toLowerCase() === 'h3';
        const text = heading.textContent.trim();

        // 1. Mobile TOC list item
        if (mobileTocList) {
            const li = document.createElement('li');
            li.className = isH3 ? 'ml-4 list-disc text-slate-600' : 'font-bold text-slate-900';
            const a = document.createElement('a');
            a.setAttribute('href', '#' + id);
            a.textContent = text;
            a.className = 'hover:text-emerald-600 transition text-decoration-none';
            a.addEventListener('click', function(e) {
                e.preventDefault();
                scrollToHeading(id);
            });
            li.appendChild(a);
            mobileTocList.appendChild(li);
        }

        // 2. Desktop Sticky TOC item
        if (desktopTocList) {
            const aDesk = document.createElement('a');
            aDesk.setAttribute('href', '#' + id);
            aDesk.className = 'toc-nav-item' + (isH3 ? ' is-h3' : '');
            aDesk.textContent = (isH3 ? '↳ ' : '• ') + text;
            aDesk.addEventListener('click', function(e) {
                e.preventDefault();
                scrollToHeading(id);
            });
            desktopTocList.appendChild(aDesk);
            tocLinks.push({ id: id, element: aDesk, heading: heading });
        }
    });

    if (mobileTocBox) mobileTocBox.classList.remove('hidden');
    if (desktopTocBox) desktopTocBox.classList.remove('hidden');

    function scrollToHeading(id) {
        const target = document.getElementById(id);
        if (target) {
            const offset = 95;
            const bodyRect = document.body.getBoundingClientRect().top;
            const elementRect = target.getBoundingClientRect().top;
            const elementPosition = elementRect - bodyRect;
            const offsetPosition = elementPosition - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }

    // Scroll-Spy: Active TOC Heading Highlighting
    window.addEventListener('scroll', function() {
        if (!tocLinks.length) return;
        const scrollPosition = (window.scrollY || document.documentElement.scrollTop) + 120;

        let activeId = null;
        for (let i = 0; i < tocLinks.length; i++) {
            const heading = tocLinks[i].heading;
            if (heading.offsetTop <= scrollPosition) {
                activeId = tocLinks[i].id;
            } else {
                break;
            }
        }

        tocLinks.forEach(item => {
            if (item.id === activeId) {
                item.element.classList.add('active');
            } else {
                item.element.classList.remove('active');
            }
        });
    });
});

function toggleToc() {
    const tocContent = document.getElementById('tocContent');
    const toggleText = document.getElementById('tocToggleText');
    const toggleIcon = document.getElementById('tocToggleIcon');
    if (tocContent.classList.contains('hidden')) {
        tocContent.classList.remove('hidden');
        toggleText.textContent = 'Sembunyikan';
        toggleIcon.classList.remove('rotate-180');
    } else {
        tocContent.classList.add('hidden');
        toggleText.textContent = 'Tampilkan';
        toggleIcon.classList.add('rotate-180');
    }
}

// Interactive FAQ Accordion Builder (Responsive Mobile Optimization)
document.addEventListener("DOMContentLoaded", function() {
    const articleBody = document.getElementById('article-content') || document.getElementById('articleBody');
    if (!articleBody) return;

    const h4s = Array.from(articleBody.querySelectorAll('h4'));
    h4s.forEach((h4, idx) => {
        if (!h4.textContent.includes('Q:')) return;

        const nextP = h4.nextElementSibling;
        if (!nextP || nextP.tagName.toLowerCase() !== 'p') return;

        // Clean raw question and answer strings
        const rawQuestion = h4.innerHTML.replace(/^Q:\s*/i, '').trim();
        const rawAnswer = nextP.innerHTML.replace(/^A:\s*/i, '').trim();

        // Create container for Accordion
        const wrapper = document.createElement('div');
        wrapper.className = 'faq-accordion-item' + (idx === 0 ? ' active' : '');

        // Header element
        const header = document.createElement('div');
        header.className = 'faq-accordion-header';
        
        header.innerHTML = `
            <div class="flex items-start gap-2 flex-1 text-left">
                <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-emerald-600 text-white font-extrabold text-[10px] shrink-0 mt-0.5 sm:hidden">Q</span>
                <span class="hidden sm:inline-flex items-center gap-1 font-black text-emerald-700 text-xs shrink-0">❓ Q:</span>
                <span class="text-xs sm:text-sm font-bold text-slate-900 leading-snug sm:leading-relaxed text-left flex-1">${rawQuestion}</span>
            </div>
            <span class="shrink-0">
                <svg class="faq-icon-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        `;

        // Body element
        const body = document.createElement('div');
        body.className = 'faq-accordion-body';
        body.innerHTML = `
            <div class="flex items-start gap-2">
                <span class="inline-flex items-center justify-center w-5 h-5 rounded bg-emerald-700 text-white font-extrabold text-[10px] shrink-0 mt-0.5 sm:hidden">A</span>
                <span class="hidden sm:inline-flex items-center gap-1 font-black text-emerald-800 text-xs shrink-0">💡 A:</span>
                <div class="flex-1 text-xs sm:text-sm text-slate-700 leading-relaxed">${rawAnswer}</div>
            </div>
        `;

        wrapper.appendChild(header);
        wrapper.appendChild(body);

        // Toggle Click Listener
        header.addEventListener('click', function() {
            wrapper.classList.toggle('active');
        });

        // Insert wrapper before h4 and remove original elements
        h4.parentNode.insertBefore(wrapper, h4);
        h4.remove();
        nextP.remove();
    });
});
</script>
@endpush
