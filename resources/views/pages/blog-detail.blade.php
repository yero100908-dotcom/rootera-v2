@extends('layouts.app')

@section('schema-markup')
<?php
$wordCount = str_word_count(strip_tags($article->content));
$articleSchema = [
  "@context" => "https://schema.org",
  "@type" => "TechArticle",
  "headline" => $article->clean_title,
  "description" => $article->meta_description ?? $article->excerpt,
  "image" => [$article->thumbnail_url ?: asset('images/JnJ.jpeg')],
  "wordCount" => $wordCount,
  "inLanguage" => "id-ID",
  "author" => [
    "@type" => "Person",
    "name" => $article->author ?: "Tim Ahli Rootera Plumbing",
    "jobTitle" => "Master Plumbing Specialist",
    "worksFor" => [
      "@type" => "Organization",
      "name" => "Rootera Plumbing Indonesia"
    ]
  ],
  "publisher" => [
    "@type" => "Organization",
    "name" => "Rootera Plumbing",
    "url" => url('/'),
    "logo" => [
      "@type" => "ImageObject",
      "url" => asset('images/JnJ.jpeg')
    ]
  ],
  "datePublished" => $article->published_at?->toIso8601String() ?: now()->toIso8601String(),
  "dateModified" => $article->updated_at->toIso8601String(),
  "mainEntityOfPage" => [
    "@type" => "WebPage",
    "@id" => url()->current()
  ]
];

// Extract FAQ items dynamically from article content for FAQPage JSON-LD schema
$faqSchema = null;
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
        $faqSchema = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $faqEntities
        ];
    }
}
?>
<script type="application/ld+json">
{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@if($faqSchema)
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endsection

@push('styles')
<style>
/* Editorial Article Typography & Layout */
.article-header { padding: 2rem 0 1.25rem; }

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
    margin-bottom: 0.85rem;
}

.article-main-title {
    color: #0f172a;
    font-weight: 900;
    line-height: 1.28;
    letter-spacing: -0.02em;
}

/* Featured Media Container */
.article-hero-media {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #0f172a;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(226, 232, 240, 0.8);
}
.article-hero-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Editorial Prose Typography Styling */
.article-prose {
    font-size: 1.025rem;
    line-height: 1.85;
    color: #334155;
}
.article-prose p {
    margin-bottom: 1.5rem;
}
.article-prose h2 {
    color: #0f172a;
    font-size: clamp(1.3rem, 2.3vw, 1.7rem);
    margin: 2.5rem 0 1rem;
    font-weight: 800;
    line-height: 1.35;
    scroll-margin-top: 100px;
    border-left: 4px solid #10b981;
    padding-left: 0.85rem;
}
.article-prose h3 {
    color: #0f172a;
    font-size: clamp(1.1rem, 1.8vw, 1.35rem);
    margin: 2rem 0 0.85rem;
    font-weight: 800;
    line-height: 1.4;
    scroll-margin-top: 100px;
    border-left: 3px solid #3b82f6;
    padding-left: 0.75rem;
}
.article-prose ul {
    padding-left: 1.4rem;
    margin-bottom: 1.5rem;
    list-style-type: none;
}
.article-prose ul li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.65rem;
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
    margin-bottom: 1.5rem;
}
.article-prose ol li {
    margin-bottom: 0.65rem;
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
    background: rgba(209, 250, 229, 0.95);
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
    margin: 2rem 0;
    padding: 1.25rem 1.5rem;
    background: #f0fdf4;
    border-left: 4px solid #10b981;
    border-radius: 0 16px 16px 0;
    font-size: 1.05rem;
    font-style: italic;
    color: #064e3b;
    line-height: 1.7;
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



<div class="bg-slate-50/60 pb-12 sm:pb-16">
    
    {{-- POLISHED HEADER WITH AMBIENT BACKGROUND GRADIENT & GLOW --}}
    <div class="relative bg-gradient-to-b from-slate-100/70 via-slate-50/40 to-slate-50/10 pt-4 pb-6 border-b border-slate-200/60 overflow-hidden">
        {{-- Ambient Glow Orbs --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-10 top-10 w-64 h-64 bg-cyan-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <header class="article-header max-w-4xl mx-auto text-center">
                
                {{-- BREADCRUMBS --}}
                <nav class="flex flex-wrap items-center justify-center gap-1.5 text-xs text-slate-500 mb-3 sm:mb-4" aria-label="Breadcrumb">
                    <a href="{{ url('/') }}" class="hover:text-emerald-600 transition">Beranda</a>
                    <span>›</span>
                    <a href="{{ route('blog') }}" class="hover:text-emerald-600 transition">Rootera News</a>
                    <span>›</span>
                    <a href="{{ route('blog', ['category' => $article->category]) }}" class="hover:text-emerald-600 transition">{{ $article->category ?? 'Berita' }}</a>
                    <span>›</span>
                    <span class="text-slate-900 font-bold max-w-[180px] sm:max-w-[280px] truncate">{{ $article->clean_title }}</span>
                </nav>

                {{-- CATEGORY BADGE --}}
                <div class="mb-3">
                    <span class="category-badge-pill">
                        📌 {{ $article->category ?? 'Tips Rumah' }}
                    </span>
                </div>

                {{-- ARTICLE TITLE --}}
                <h1 class="article-main-title text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight sm:leading-snug mb-6">
                    {{ $article->title }}
                </h1>

                {{-- E-E-A-T EDITORIAL AUTHOR & META CARD --}}
                <div class="bg-white/90 border border-slate-200/80 rounded-2xl p-4 sm:p-5 shadow-xs max-w-4xl mx-auto text-left transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
                        
                        {{-- Author Profile (Left) --}}
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-950 text-emerald-300 font-black flex items-center justify-center text-sm border border-emerald-400/40 shadow-2xs flex-shrink-0">
                                👨‍🔧
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-extrabold text-slate-900 leading-tight">
                                        {{ $article->author ?: 'Tim Ahli Rootera' }}
                                    </span>
                                    <span class="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full border border-emerald-200/60 inline-flex items-center gap-1">
                                        <span>✓</span> Verified E-E-A-T
                                    </span>
                                </div>
                                <span class="text-xs text-slate-500 font-medium block mt-0.5">
                                    Spesialis Plumbing &amp; Sanitasi
                                </span>
                            </div>
                        </div>

                        {{-- Mobile Divider --}}
                        <div class="border-t border-slate-100 my-1 sm:hidden"></div>

                        {{-- Meta Details & Share Buttons (Right) --}}
                        <div class="flex items-center justify-between sm:justify-end gap-3 text-xs text-slate-500 font-semibold">
                            
                            {{-- Meta Info --}}
                            <div class="flex items-center gap-2.5 sm:gap-3 text-[11px] sm:text-xs">
                                <span>📅 {{ $article->published_at?->translatedFormat('d M Y') ?: now()->translatedFormat('d M Y') }}</span>
                                <span class="text-slate-300">•</span>
                                <span>⏱️ {{ $article->reading_time }} mnt</span>
                                <span class="text-slate-300">•</span>
                                <span>👁️ {{ $article->views }}</span>
                            </div>

                            {{-- Vertical Divider (Desktop) --}}
                            <div class="h-4 w-px bg-slate-200 hidden sm:block"></div>

                            {{-- Share Buttons --}}
                            <div class="flex items-center gap-1.5 flex-shrink-0">
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                                   target="_blank" rel="noopener noreferrer" title="Bagikan ke WhatsApp"
                                   class="w-7 h-7 rounded-full bg-emerald-100 hover:bg-emerald-200 text-emerald-700 flex items-center justify-center transition shadow-2xs">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                                </a>
                                <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');" 
                                        title="Salin Link" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition text-[11px] font-bold border border-slate-200/60 shadow-2xs">
                                    🔗
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </header>

            {{-- 16:9 FEATURED MEDIA CONTAINER WITH SOFT SHADOW --}}
            <div class="article-hero-wrapper max-w-4xl mx-auto my-6 sm:my-8 relative z-10">
                @if($article->youtube_video_id)
                <div class="article-hero-media shadow-xl rounded-3xl border border-slate-200/80 overflow-hidden">
                    <iframe style="width:100%; height:100%; border:0;" src="https://www.youtube-nocookie.com/embed/{{ $article->youtube_video_id }}" title="{{ $article->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                @elseif($article->thumbnail_url)
                <div class="article-hero-media shadow-xl rounded-3xl border border-slate-200/80 overflow-hidden">
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->clean_title }}" loading="eager" decoding="async">
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 pt-6">
        {{-- MAIN ARTICLE CONTENT & SIDEBAR GRID LAYOUT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 max-w-6xl mx-auto">
            
            {{-- MAIN ARTICLE COLUMN (8 COLS) --}}
            <main class="lg:col-span-8">
                <article class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-xs">
                    
                    {{-- MODERN COLLAPSIBLE TABLE OF CONTENTS (TOC) --}}
                    <div id="tableOfContents" class="toc-box hidden bg-slate-50/90 border border-slate-200/90 rounded-2xl p-4 sm:p-5 mb-8 transition-all">
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

                    {{-- ARTICLE HTML CONTENT --}}
                    <div id="articleBody" class="article-prose">
                        {!! $article->content !!}
                    </div>

                    {{-- UNIFIED DARK GLASSMORPHISM SOLUTION CTA CARD --}}
                    <div class="my-10 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#071930] rounded-3xl p-5 sm:p-8 border border-white/15 shadow-2xl text-white relative overflow-hidden">
                        <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="relative z-10">
                            <div class="flex flex-wrap items-center gap-1.5 mb-3">
                                <span class="inline-flex items-center gap-1 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[10px] sm:text-xs font-extrabold py-1 px-2.5 rounded-full uppercase tracking-wider">
                                    ⚡ Respon Cepat 24/7
                                </span>
                                <span class="inline-flex items-center gap-1 bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 text-[10px] sm:text-xs font-extrabold py-1 px-2.5 rounded-full uppercase tracking-wider">
                                    🛡️ Garansi 30 Hari
                                </span>
                                <span class="inline-flex items-center gap-1 bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[10px] sm:text-xs font-extrabold py-1 px-2.5 rounded-full uppercase tracking-wider">
                                    🏢 Residensi &amp; B2B
                                </span>
                            </div>

                            <h3 class="text-xl sm:text-2xl font-extrabold text-white mb-3 leading-snug">
                                Butuh Solusi Pipa Mampet atau Maintenance Berkala?
                            </h3>
                            
                            <p class="text-xs sm:text-sm text-slate-300 mb-6 max-w-2xl leading-relaxed">
                                Tim teknisi master Rootera Plumbing (holding J&amp;J Group) siap membantu penanganan darurat rumah tangga 24 jam serta kontrak perawatan rutin tempat usaha (Restoran, Mall, Hotel, Pabrik) dengan Faktur Pajak PPN Resmi.
                            </p>

                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca artikel "' . $article->title . '" dan mau panggil teknisi pipa mampet.') }}" 
                                   target="_blank" rel="noopener noreferrer" 
                                   class="bg-[#25D366] hover:bg-[#1eb956] text-white font-extrabold text-xs sm:text-sm py-3.5 px-5 rounded-xl shadow-lg hover:shadow-emerald-900/40 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2 text-decoration-none">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                                    <span>📱 Panggil Teknisi WA (24 Jam)</span>
                                </a>
                                
                                <a href="{{ route('b2b.contract', 'restoran-cafe') }}" 
                                   class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs sm:text-sm py-3.5 px-5 rounded-xl transition flex items-center justify-center gap-2 text-decoration-none">
                                    <span>🏢 Maintenance B2B &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- DYNAMIC CITY HUB SPOKE LINKS (COMPACT MOBILE GRID) --}}
                    @if(isset($cities) && $cities->isNotEmpty())
                    <div class="bg-slate-50 border border-slate-200 rounded-3xl p-5 sm:p-6 my-8">
                        <h4 class="text-sm font-extrabold text-slate-900 mb-1">📍 Navigator Layanan Pipa Mampet Terdekat</h4>
                        <p class="text-xs text-slate-500 mb-4">Pilih kota operasional terdekat untuk reservasi armada teknisi Rootera:</p>
                        <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2 max-h-64 sm:max-h-none overflow-y-auto pr-1">
                            @foreach($cities as $c)
                                <a href="{{ url('/jasa-saluran-mampet/' . $c->slug) }}" class="bg-white border border-slate-300 text-slate-700 hover:border-emerald-600 hover:text-emerald-700 py-2 px-2.5 rounded-xl text-xs font-bold transition text-decoration-none shadow-2xs text-center truncate flex items-center justify-center gap-1">
                                    <span>📍</span>
                                    <span class="truncate">Jasa Pipa {{ $c->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </article>

                {{-- NEXT / PREVIOUS ARTICLE NAVIGATION CARDS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8">
                    @if(isset($previousArticle) && $previousArticle)
                    <a href="{{ route('blog.show', $previousArticle->slug) }}" class="nav-article-card group">
                        <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-2 block">
                            ← Artikel Sebelumnya
                        </span>
                        <div class="flex items-center gap-3">
                            <img src="{{ $previousArticle->thumbnail_url }}" alt="{{ $previousArticle->clean_title }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 bg-slate-900">
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
                            <img src="{{ $nextArticle->thumbnail_url }}" alt="{{ $nextArticle->clean_title }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 bg-slate-900">
                        </div>
                    </a>
                    @endif
                </div>

                {{-- MOBILE ONLY: RELATED ARTICLES GRID --}}
                @if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
                <div class="lg:hidden my-8">
                    <h3 class="text-base font-extrabold text-slate-900 mb-4 flex items-center justify-between">
                        <span>📚 Artikel Terkait Lainnya</span>
                        <a href="{{ route('blog') }}" class="text-xs font-bold text-emerald-600">Lihat Semua &rarr;</a>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($relatedArticles as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-2xs hover:border-emerald-500 transition flex items-center gap-3">
                            <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->clean_title }}" class="w-16 h-16 rounded-xl object-cover bg-slate-900 flex-shrink-0">
                            <div>
                                <span class="text-[10px] font-bold text-emerald-600 uppercase block mb-1">{{ $rel->category ?? 'Tips' }}</span>
                                <h4 class="text-xs font-bold text-slate-900 line-clamp-2 leading-snug">{{ $rel->clean_title }}</h4>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </main>

            {{-- DESKTOP SIDEBAR COLUMN (4 COLS) --}}
            <aside class="lg:col-span-4 space-y-6">
                <div class="sticky top-24 space-y-6">
                    
                    {{-- EMERGENCY WA CALLOUT CARD --}}
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

                    {{-- TRENDING ARTICLES WIDGET --}}
                    @if(isset($trendingArticles) && $trendingArticles->isNotEmpty())
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                        <h3 class="text-sm font-extrabold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center justify-between">
                            <span>⚡ Berita &amp; Tren Terpopuler</span>
                            <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded font-black">POPULER</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach($trendingArticles as $trend)
                            <a href="{{ route('blog.show', $trend->slug) }}" class="flex items-center gap-3 group text-decoration-none">
                                <img src="{{ $trend->thumbnail_url }}" alt="{{ $trend->clean_title }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 border border-slate-100 bg-slate-900">
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

                    {{-- INDUSTRY CATEGORIES LIST --}}
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                        <h3 class="text-sm font-extrabold text-slate-900 mb-3 pb-2 border-b border-slate-100">
                            📌 Pilar Kategori Industri
                        </h3>
                        <div class="space-y-2">
                            @foreach(\App\Models\Article::CATEGORIES as $catKey => $catLabel)
                            <a href="{{ route('blog', ['category' => $catKey]) }}" class="flex items-center justify-between text-xs font-bold text-slate-700 hover:text-emerald-700 bg-slate-50 hover:bg-slate-100 p-2.5 rounded-xl transition text-decoration-none">
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



@push('scripts')
<script>
// Dynamic Reading Progress Bar Calculation
window.addEventListener('scroll', function() {
    const article = document.getElementById('articleBody');
    const progressBar = document.getElementById('readingProgressBar');
    if (!article || !progressBar) return;

    const articleHeight = article.offsetHeight;
    const windowHeight = window.innerHeight;
    
    // Calculate scroll offset over article content
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

// Dynamic Table of Contents Generator with Toggle Accordion
document.addEventListener("DOMContentLoaded", function() {
    const articleBody = document.getElementById('articleBody');
    const tocContainer = document.getElementById('tableOfContents');
    const tocList = document.getElementById('tocList');
    
    if (!articleBody || !tocList) return;

    const headings = articleBody.querySelectorAll('h2, h3');
    if (headings.length < 2) return;

    headings.forEach((heading, index) => {
        const id = 'heading-' + index;
        heading.setAttribute('id', id);

        const li = document.createElement('li');
        li.className = heading.tagName.toLowerCase() === 'h3' ? 'ml-4 list-disc text-slate-600' : 'font-bold text-slate-900';

        const link = document.createElement('a');
        link.setAttribute('href', '#' + id);
        link.textContent = heading.textContent;
        link.className = 'hover:text-emerald-600 transition text-decoration-none';

        li.appendChild(link);
        tocList.appendChild(li);
    });

    tocContainer.classList.remove('hidden');
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
    const articleBody = document.getElementById('articleBody');
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
@endsection
