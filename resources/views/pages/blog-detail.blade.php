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
/* Editorial E-E-A-T Header */
.article-header { padding: 3rem 0 2rem; }
.category-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
    border: 1px solid rgba(37, 99, 235, 0.25);
    font-weight: 800;
    font-size: 0.78rem;
    padding: 0.35rem 1rem;
    border-radius: 9999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 1.25rem;
}

.article-main-title {
    color: #0f172a;
    font-size: clamp(1.75rem, 4vw, 2.75rem);
    font-weight: 900;
    line-height: 1.25;
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
}

/* E-E-A-T Author Box */
.eeat-author-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 0.85rem 1.25rem;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    font-size: 0.82rem;
    color: #475569;
}

/* 16:9 Hero Media Container */
.article-hero-wrapper {
    margin-bottom: 3rem;
}
.article-hero-media {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #0f172a;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}
.article-hero-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Layout 70:30 */
.article-grid-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 3rem;
}
@media (min-width: 1024px) {
    .article-grid-layout {
        grid-template-columns: 1fr 340px;
    }
}

/* Prose Typography Styling */
.article-prose {
    font-size: 1.05rem;
    line-height: 1.85;
    color: #334155;
}
.article-prose p {
    margin-bottom: 1.6rem;
}
.article-prose h2 {
    color: #0f172a;
    font-size: clamp(1.35rem, 2.5vw, 1.75rem);
    margin: 2.75rem 0 1.1rem;
    font-weight: 800;
    line-height: 1.35;
    scroll-margin-top: 100px;
    border-left: 4px solid #2563eb;
    padding-left: 0.85rem;
}
.article-prose h3 {
    color: #0f172a;
    font-size: clamp(1.15rem, 2vw, 1.35rem);
    margin: 2rem 0 0.9rem;
    font-weight: 800;
    line-height: 1.4;
    scroll-margin-top: 100px;
}
.article-prose ul, .article-prose ol {
    padding-left: 1.6rem;
    margin-bottom: 1.6rem;
}
.article-prose li {
    margin-bottom: 0.6rem;
}
.article-prose blockquote {
    margin: 2.25rem 0;
    padding: 1.25rem 1.75rem;
    background: #f0fdf4;
    border-left: 5px solid #10b981;
    border-radius: 0 16px 16px 0;
    font-size: 1.08rem;
    font-style: italic;
    color: #064e3b;
    line-height: 1.65;
    font-weight: 600;
}
.article-prose img {
    border-radius: 18px;
    margin: 2rem 0;
    width: 100%;
    height: auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

/* Table of Contents */
.toc-box {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 1.5rem;
    margin-bottom: 2.5rem;
}

/* In-Article Conversion Callout Box */
.conversion-callout-card {
    background: linear-gradient(135deg, #061434 0%, #0b2b64 100%);
    border-radius: 24px;
    padding: 2.5rem 2rem;
    color: #ffffff;
    text-align: center;
    margin: 3.5rem 0;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 45px rgba(6, 20, 52, 0.3);
}

/* Sidebar Sticky */
.sidebar-sticky-box {
    position: sticky;
    top: 100px;
}

/* Next / Prev Navigation Cards */
.nav-article-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 1.25rem;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-decoration: none;
}
.nav-article-card:hover {
    border-color: #2563eb;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
    transform: translateY(-3px);
}
</style>
@endpush

@section('content')

<div class="bg-slate-50/60 pb-20">
    <div class="container">
        
        {{-- BREADCRUMBS & EDITORIAL HEADER --}}
        <header class="article-header max-w-4xl mx-auto text-center">
            
            <nav class="flex flex-wrap items-center justify-center gap-2 text-xs font-semibold text-slate-500 mb-4" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-blue-900 transition">Beranda</a>
                <span>›</span>
                <a href="{{ route('blog') }}" class="hover:text-blue-900 transition">Rootera News &amp; Tech</a>
                <span>›</span>
                <a href="{{ route('blog', ['category' => $article->category]) }}" class="hover:text-blue-900 transition">{{ $article->category ?? 'Berita' }}</a>
                <span>›</span>
                <span class="text-slate-900 font-bold max-w-[200px] sm:max-w-[300px] truncate">{{ $article->clean_title }}</span>
            </nav>

            <span class="category-badge-pill">
                📌 {{ $article->category ?? 'Tips Rumah' }}
            </span>

            <h1 class="article-main-title">
                {{ $article->title }}
            </h1>

            {{-- E-E-A-T EDITORIAL BOX --}}
            <div class="eeat-author-card max-w-3xl mx-auto">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-900 text-teal-300 font-black flex items-center justify-center text-sm border-2 border-teal-400/50 shadow-sm">
                        👨‍🔧
                    </div>
                    <div class="text-left">
                        <div class="font-extrabold text-slate-900 text-xs sm:text-sm flex items-center gap-1.5">
                            <span>Ditinjau oleh Tim Ahli Rootera</span>
                            <span class="bg-emerald-100 text-emerald-800 text-[10px] px-2 py-0.5 rounded-full font-black">Verified E-E-A-T</span>
                        </div>
                        <div class="text-[0.75rem] text-slate-500 font-medium">
                            Penulis: <span class="font-bold text-slate-700">{{ $article->author ?: 'Redaksi Rootera' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3 text-slate-600 text-xs font-bold">
                    <span>📅 {{ $article->published_at?->translatedFormat('d F Y') ?: now()->translatedFormat('d F Y') }}</span>
                    <span>•</span>
                    <span>⏱️ {{ $article->reading_time }} mnt baca</span>
                    <span>•</span>
                    <span>👁️ {{ $article->views }} views</span>
                </div>
            </div>

        </header>

        {{-- 16:9 HERO MEDIA CONTAINER --}}
        <div class="article-hero-wrapper max-w-5xl mx-auto">
            @if($article->youtube_video_id)
            <div class="article-hero-media">
                <iframe style="width:100%; height:100%; border:0;" src="https://www.youtube-nocookie.com/embed/{{ $article->youtube_video_id }}" title="{{ $article->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            @elseif($article->thumbnail_url)
            <div class="article-hero-media">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->clean_title }}" loading="eager" decoding="async">
            </div>
            @endif
        </div>

        {{-- MAIN ARTICLE CONTENT & SIDEBAR (LAYOUT 70:30) --}}
        <div class="article-grid-layout max-w-6xl mx-auto">
            
            {{-- MAIN ARTICLE COLUMN (70%) --}}
            <main>
                <article class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm">
                    
                    {{-- TABLE OF CONTENTS (TOC) --}}
                    <div id="tableOfContents" class="toc-box hidden">
                        <div class="flex items-center justify-between font-extrabold text-slate-900 text-sm mb-3 pb-2 border-b border-slate-200">
                            <span class="flex items-center gap-2">
                                📑 Daftar Isi Artikel &amp; Panduan
                            </span>
                            <span class="text-xs text-blue-900 font-bold">Rootera Tech</span>
                        </div>
                        <ol id="tocList" class="space-y-2 text-xs sm:text-sm font-semibold text-slate-700 list-decimal pl-5"></ol>
                    </div>

                    {{-- ARTICLE HTML CONTENT --}}
                    <div id="articleBody" class="article-prose">
                        {!! $article->content !!}
                    </div>

                    {{-- IN-ARTICLE CONVERSION BRIDGE --}}
                    <div class="conversion-callout-card">
                        <div style="position: absolute; right: -50px; bottom: -50px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, transparent 70%); pointer-events: none;"></div>
                        
                        <span style="background: rgba(45, 212, 191, 0.2); border: 1px solid rgba(45, 212, 191, 0.4); color: #2dd4bf; font-size: 0.75rem; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 0.85rem;">
                            ⚡ Layanan Pipa Mampet Tanpa Bongkar 24 Jam
                        </span>

                        <h3 style="color: #ffffff; font-size: clamp(1.3rem, 2.2vw, 1.65rem); font-weight: 900; line-height: 1.3; margin-bottom: 0.75rem;">
                            Masalah Saluran Air Anda Masih Belum Tuntas?
                        </h3>
                        
                        <p style="color: rgba(255, 255, 255, 0.82); font-size: 0.92rem; margin: 0 auto 1.75rem; max-width: 540px; line-height: 1.6;">
                            Jangan biarkan luapan air kotor merusak rumah atau properti usaha Anda. Panggil armada teknisi profesional Rootera Plumbing sekarang — Pengerjaan cepat tanpa bongkar &amp; garansi 30 hari!
                        </p>

                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca artikel "' . $article->title . '" dan ingin berkonsultasi mengenai pelancaran pipa tersumbat.') }}" target="_blank" rel="noopener noreferrer" style="background: #25D366; color: #ffffff; text-decoration: none; padding: 0.85rem 1.85rem; border-radius: 14px; font-weight: 800; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.6rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4); transition: transform 0.2s;" class="hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                            Panggil Teknisi WA 24 Jam (Garansi 30 Hari)
                        </a>
                    </div>

                    {{-- B2B CORPORATE RETAINER CALLOUT --}}
                    <div class="bg-slate-900 rounded-3xl p-6 sm:p-8 text-white my-8 shadow-lg border border-slate-800">
                        <span class="inline-block bg-teal-500/20 text-teal-300 border border-teal-500/40 text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                            🏢 Layanan B2B &amp; Industri (J&amp;J Group)
                        </span>
                        <h4 class="text-lg font-extrabold text-white mb-2">Butuh Kontrak Maintenance Pipa Tempat Usaha?</h4>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-4">
                            Rootera Plumbing (J&amp;J Group) melayani kontrak perawatan berkala untuk Restoran, Hotel, Apartemen, Mall, &amp; Pabrik dengan SLA Response Cepat &amp; Faktur Pajak PPN Resmi.
                        </p>
                        <a href="{{ route('b2b.contract', 'restoran-cafe') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-3 px-5 rounded-xl transition text-decoration-none">
                            <span>📄 Pengajuan Kontrak Maintenance B2B &rarr;</span>
                        </a>
                    </div>

                    {{-- DYNAMIC CITY HUB SPOKE LINKS --}}
                    @if(isset($cities) && $cities->isNotEmpty())
                    <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 my-8">
                        <h4 class="text-sm font-extrabold text-slate-900 mb-1">📍 Navigator Layanan Pipa Mampet Terdekat</h4>
                        <p class="text-xs text-slate-500 mb-4">Pilih kota operasional terdekat untuk reservasi armada teknisi Rootera:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($cities as $c)
                                <a href="{{ url('/jasa-saluran-mampet/' . $c->slug) }}" class="bg-white border border-slate-300 text-slate-700 hover:border-blue-900 hover:text-blue-900 px-3 py-1.5 rounded-full text-xs font-bold transition text-decoration-none shadow-2xs">
                                    📍 Jasa Pipa {{ $c->name }}
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
                            <h5 class="text-xs font-bold text-slate-900 group-hover:text-blue-900 transition line-clamp-2 leading-snug">
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
                            <h5 class="text-xs font-bold text-slate-900 group-hover:text-blue-900 transition line-clamp-2 leading-snug">
                                {{ $nextArticle->clean_title }}
                            </h5>
                            <img src="{{ $nextArticle->thumbnail_url }}" alt="{{ $nextArticle->clean_title }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 bg-slate-900">
                        </div>
                    </a>
                    @endif
                </div>

            </main>

            {{-- SIDEBAR COLUMN (30%) --}}
            <aside class="space-y-6">
                <div class="sidebar-sticky-box space-y-6">
                    
                    {{-- EMERGENCY WA CALLOUT CARD --}}
                    <div class="bg-gradient-to-br from-slate-950 to-blue-950 border border-slate-800 rounded-3xl p-6 text-white text-center shadow-xl relative overflow-hidden">
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/20 text-teal-300 flex items-center justify-center text-2xl mx-auto mb-3 border border-teal-500/30">
                            ⚡
                        </div>
                        <h3 class="text-base font-extrabold text-white mb-2">Butuh Bantuan Teknisi Darurat?</h3>
                        <p class="text-xs text-slate-300 mb-4 leading-relaxed">
                            Teknisi Rootera standby 24 jam dengan estimasi tiba 30-45 menit. Pengerjaan 100% tanpa bongkar pipa &amp; garansi 30 hari!
                        </p>
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya mau panggil teknisi pipa mampet sekarang.') }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#1eb956] text-white text-xs font-extrabold py-3.5 px-4 rounded-xl transition text-decoration-none shadow-lg">
                            <span>📱 Panggil Teknisi WA (24 Jam)</span>
                        </a>
                    </div>

                    {{-- TRENDING ARTICLES WIDGET --}}
                    @if(isset($trendingArticles) && $trendingArticles->isNotEmpty())
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
                        <h3 class="text-sm font-extrabold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center justify-between">
                            <span>⚡ Berita &amp; Tren Terpopuler</span>
                            <span class="text-[10px] text-teal-600 bg-teal-50 px-2 py-0.5 rounded font-black">POPULER</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach($trendingArticles as $trend)
                            <a href="{{ route('blog.show', $trend->slug) }}" class="flex items-center gap-3 group text-decoration-none">
                                <img src="{{ $trend->thumbnail_url }}" alt="{{ $trend->clean_title }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 border border-slate-100 bg-slate-900">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900 group-hover:text-blue-900 transition leading-snug line-clamp-2">{{ $trend->clean_title }}</h4>
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
                    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
                        <h3 class="text-sm font-extrabold text-slate-900 mb-3 pb-2 border-b border-slate-100">
                            📌 Pilar Kategori Industri
                        </h3>
                        <div class="space-y-2">
                            @foreach(\App\Models\Article::CATEGORIES as $catKey => $catLabel)
                            <a href="{{ route('blog', ['category' => $catKey]) }}" class="flex items-center justify-between text-xs font-bold text-slate-700 hover:text-blue-900 bg-slate-50 hover:bg-slate-100 p-2.5 rounded-xl transition text-decoration-none">
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

{{-- FLOATING WHATSAPP BUTTON (MOBILE ONLY) --}}
<div class="fixed bottom-5 right-5 z-50 md:hidden">
    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca artikel "' . $article->title . '" dan mau pesan jasa pelancaran pipa.') }}" 
       target="_blank" rel="noopener noreferrer" 
       class="bg-[#25D366] text-white p-3.5 rounded-full shadow-2xl flex items-center gap-2 text-xs font-extrabold transition hover:scale-105 active:scale-95 animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        <span>Konsultasi WA</span>
    </a>
</div>

@push('scripts')
<script>
// Dynamic Table of Contents Generator
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
        link.className = 'hover:text-blue-900 transition text-decoration-none';

        li.appendChild(link);
        tocList.appendChild(li);
    });

    tocContainer.classList.remove('hidden');
});
</script>
@endpush
@endsection
