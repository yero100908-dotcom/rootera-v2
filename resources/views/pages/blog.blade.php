@extends('layouts.app')

@section('schema-markup')
<?php
$itemListElements = [];
if (isset($articles) && $articles->count() > 0) {
    foreach ($articles as $index => $art) {
        $itemListElements[] = [
            "@type" => "ListItem",
            "position" => $index + 1,
            "url" => route('blog.show', $art->slug),
            "name" => $art->clean_title,
            "item" => [
                "@type" => "BlogPosting",
                "headline" => $art->clean_title,
                "description" => Str::limit($art->excerpt ?? '', 150),
                "url" => route('blog.show', $art->slug),
                "datePublished" => $art->published_at?->toIso8601String() ?: now()->toIso8601String(),
                "image" => [$art->thumbnail_url],
                "author" => [
                    "@type" => "Organization",
                    "name" => "Rootera Plumbing",
                    "url" => url('/')
                ]
            ]
        ];
    }
}

$blogSchema = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => ["CollectionPage", "Blog"],
            "@id" => ($seo['canonical'] ?? url()->current()) . "#blog",
            "url" => $seo['canonical'] ?? url()->current(),
            "name" => $seo['title'] ?? "Portal Berita & Panduan Plumbing Indonesia | Rootera Plumbing",
            "description" => $seo['description'] ?? "Portal berita plumbing modern, artikel teknis sanitasi rumah & komersial B2B, komparasi material, serta video tutorial dari teknisi profesional Rootera.",
            "publisher" => [
                "@type" => "Organization",
                "name" => "Rootera Plumbing",
                "url" => url('/'),
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
                ]
            ],
            "mainEntity" => [
                "@type" => "ItemList",
                "numberOfItems" => count($itemListElements),
                "itemListElement" => $itemListElements
            ]
        ],
        [
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
                    "name" => "Rootera News & Tech",
                    "item" => route('blog')
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($blogSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- PORTAL MEDIA HERO SECTION (ASYMMETRIC BENTO GRID MAGAZINE LAYOUT) --}}
<section class="relative bg-gradient-to-br from-[#071930] via-[#0B2545] to-[#0D3B66] text-white pt-12 pb-14 md:pt-16 md:pb-20 overflow-hidden">
    {{-- Background Ambient Light Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-emerald-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[350px] bg-cyan-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- BRANDING PORTAL HEADER --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b border-white/10 pb-6 mb-8 md:mb-10">
            <div>
                <div class="inline-flex items-center gap-2 bg-emerald-500/15 border border-emerald-500/30 px-3.5 py-1 rounded-full text-xs font-extrabold text-emerald-400 uppercase tracking-widest shadow-md mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Sanitation &amp; Plumbing Journal</span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black tracking-tight text-white leading-tight">
                    Jurnal Teknik Sanitasi &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Investigasi Saluran Pipa</span>
                </h1>
            </div>
            <p class="text-slate-300 text-xs sm:text-sm max-w-md text-left md:text-right leading-relaxed font-medium">
                Wawasan investigasi lapangan, regulasi limbah komersial B2B, dan panduan pencegahan kerusakan struktural instalasi perpipaan dari teknisi profesional Rootera.
            </p>
        </div>

        {{-- ASYMMETRIC BENTO GRID HERO LAYOUT (8 COLS : 4 COLS) --}}
        @if(isset($headline) && $headline)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
            
            {{-- SISI KIRI (8 COLS / ~67%): BENTO HEADLINE UTAMA (MAGAZINE HERO) --}}
            <div class="lg:col-span-8 flex flex-col">
                <div class="bg-gradient-to-b from-white/[0.08] to-white/[0.03] border border-white/15 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl flex flex-col justify-between group h-full relative transition-all duration-300 hover:border-emerald-400/40">
                    
                    {{-- IMMERSIVE MEDIA CONTAINER --}}
                    <div class="relative bg-slate-950 aspect-[16/10] sm:aspect-[16/9] overflow-hidden cursor-pointer">
                        <a href="{{ route('blog.show', $headline->slug) }}" class="block w-full h-full">
                            <img src="{{ $headline->thumbnail_url }}" alt="{{ $headline->thumbnail_alt ?: $headline->clean_title }}" loading="eager" fetchpriority="high" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </a>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#061434] via-[#061434]/40 to-transparent pointer-events-none"></div>

                        {{-- FLOATING BADGES --}}
                        <div class="absolute top-4 left-4 flex gap-2 flex-wrap z-10">
                            <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-slate-950 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-lg flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-slate-950 animate-pulse"></span>
                                <span>Headline Utama</span>
                            </span>
                            <span class="bg-slate-950/80 backdrop-blur-md text-teal-300 border border-teal-500/30 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $headline->category ?? 'Tips Rumah' }}
                            </span>
                        </div>

                        {{-- READ TIME & VIEWS OVERLAY --}}
                        <div class="absolute bottom-4 right-4 flex gap-2 z-10 text-xs font-bold">
                            <span class="bg-slate-950/80 backdrop-blur-md text-slate-200 px-3 py-1 rounded-full border border-white/10">
                                ⏱️ {{ $headline->reading_time }} mnt
                            </span>
                            <span class="bg-slate-950/80 backdrop-blur-md text-emerald-300 px-3 py-1 rounded-full border border-white/10">
                                👁️ {{ $headline->views }} views
                            </span>
                        </div>

                        {{-- VIDEO PLAY BUTTON OVERLAY IF APPLICABLE --}}
                        @if($headline->youtube_video_id || $headline->post_type === 'video_guide')
                        <a href="{{ route('blog.show', $headline->slug) }}" class="absolute inset-0 flex items-center justify-center z-20">
                            <div class="w-16 h-16 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-2xl shadow-red-600/50 backdrop-blur-xs group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 ml-1 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </a>
                        @endif
                    </div>

                    {{-- HEADLINE BODY --}}
                    <div class="p-6 sm:p-8 flex flex-col justify-between flex-grow bg-[#061434]/80">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-300 font-semibold mb-3">
                                <span>📅 {{ $headline->published_at?->translatedFormat('d F Y') }}</span>
                                <span class="text-slate-500">•</span>
                                <span class="text-emerald-400 font-bold">✍️ {{ $headline->author ?: 'Redaksi Rootera' }}</span>
                            </div>

                            <h2 class="text-xl sm:text-2xl lg:text-3xl font-black text-white leading-snug sm:leading-tight mb-4 group-hover:text-emerald-300 transition-colors">
                                <a href="{{ route('blog.show', $headline->slug) }}" class="text-decoration-none text-white group-hover:text-emerald-300 transition-colors">
                                    {{ $headline->clean_title }}
                                </a>
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6 line-clamp-3">
                                {{ Str::limit($headline->excerpt, 180) }}
                            </p>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-white/10">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#070F1E] border border-emerald-400/30 flex items-center justify-center text-sm shadow-xs">
                                    👨‍🔧
                                </div>
                                <span class="text-xs font-bold text-slate-300">Tim Riset Sanitasi Rootera</span>
                            </div>
                            <a href="{{ route('blog.show', $headline->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs sm:text-sm font-extrabold rounded-xl shadow-lg shadow-emerald-950/40 transition-all group-hover:translate-x-1 text-decoration-none">
                                <span>Baca Artikel Utama</span>
                                <svg class="w-4 h-4 fill-none stroke-current shrink-0" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SISI KANAN (4 COLS / ~33%): BENTO SIDE HEADLINES BERTUMPUK VERTIKAL --}}
            <div class="lg:col-span-4 flex flex-col gap-4">
                
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <h3 class="text-xs sm:text-sm font-black tracking-wider text-emerald-400 uppercase flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span>Highlight Redaksi</span>
                    </h3>
                    <span class="text-[11px] text-slate-400 font-bold">Trending Pilihan</span>
                </div>

                @foreach($sideHeadlines->take(2) as $side)
                <article class="group flex-1 bg-white/[0.06] hover:bg-white/[0.12] border border-white/10 hover:border-emerald-400/40 rounded-3xl p-4 sm:p-5 transition-all duration-300 backdrop-blur-xl shadow-xl flex flex-col justify-between">
                    <div>
                        {{-- THUMBNAIL 16:9 DENGAN SUDUT LEMBUT --}}
                        <a href="{{ route('blog.show', $side->slug) }}" class="w-full aspect-[16/9] bg-slate-950 rounded-2xl overflow-hidden relative block mb-3.5">
                            <img src="{{ $side->thumbnail_url }}" alt="{{ $side->thumbnail_alt ?: $side->clean_title }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            
                            {{-- BADGE OVERLAY --}}
                            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
                                <span class="text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-950/90 text-emerald-300 border border-emerald-500/40">
                                    {{ $side->category ?? 'Tips Rumah' }}
                                </span>
                            </div>

                            <div class="absolute bottom-2.5 right-2.5 text-[10px] font-bold bg-black/80 text-white px-2 py-0.5 rounded-md">
                                ⏱️ {{ $side->reading_time }} mnt
                            </div>

                            @if($side->youtube_video_id || $side->post_type === 'video_guide')
                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                <span class="w-8 h-8 rounded-full bg-red-600/90 text-white flex items-center justify-center text-xs shadow-md">▶</span>
                            </div>
                            @endif
                        </a>

                        {{-- SIDE TITLE & META --}}
                        <div class="flex items-center gap-2 text-[10px] sm:text-[11px] text-slate-300 font-semibold mb-1.5">
                            <span>📅 {{ $side->published_at?->translatedFormat('d M Y') }}</span>
                            <span>•</span>
                            <span>👁️ {{ $side->views }}</span>
                        </div>

                        <h4 class="text-sm font-bold text-white group-hover:text-emerald-300 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('blog.show', $side->slug) }}" class="text-decoration-none text-white group-hover:text-emerald-300">
                                {{ $side->clean_title }}
                            </a>
                        </h4>
                    </div>

                    <div class="pt-3 mt-2 border-t border-white/5 flex items-center justify-between text-xs">
                        <span class="text-slate-400 text-[11px]">✍️ {{ $side->author ?: 'Tim Rootera' }}</span>
                        <a href="{{ route('blog.show', $side->slug) }}" class="text-emerald-400 font-bold group-hover:translate-x-1 transition-transform flex items-center gap-1 text-decoration-none text-[11px]">
                            <span>Baca</span>
                            <span>→</span>
                        </a>
                    </div>
                </article>
                @endforeach

            </div>

        </div>
        @endif

    </div>
</section>

{{-- MAIN NEWS SECTION --}}
<section class="py-10 sm:py-14 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- FLOATING FILTER BAR & PILAR CATEGORIES (MOBILE FRIENDLY HORIZONTAL SCROLL) --}}
        <div class="bg-white rounded-3xl p-4 sm:p-6 border border-slate-200/90 shadow-md mb-8 sm:mb-10 space-y-4">
            
            {{-- ROW 1: PILAR KATEGORI INDUSTRI --}}
            <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                
                {{-- MOBILE SCROLLABLE CATEGORY TABS --}}
                <div class="flex overflow-x-auto no-scrollbar gap-2 py-1 px-0.5 snap-x items-center" id="category-pills">
                    <a href="{{ route('blog', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" 
                       class="category-pill snap-start shrink-0 inline-flex items-center gap-1 px-3.5 py-2 rounded-full text-xs font-bold transition-all text-decoration-none {{ ($filterCategory ?? 'all') === 'all' ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-950/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        <span>🌐 Semua ({{ array_sum($categoryCounts ?? []) }})</span>
                    </a>

                    @foreach($categories as $catKey => $catLabel)
                        <a href="{{ route('blog', array_merge(request()->except('category', 'page'), ['category' => $catKey])) }}" 
                           class="category-pill snap-start shrink-0 inline-flex items-center gap-1 px-3.5 py-2 rounded-full text-xs font-bold transition-all text-decoration-none {{ ($filterCategory ?? '') === $catKey ? 'bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-950/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            <span>{{ $catLabel }} ({{ $categoryCounts[$catKey] ?? 0 }})</span>
                        </a>
                    @endforeach
                </div>

                {{-- SEARCH FORM --}}
                <form method="GET" action="{{ route('blog') }}" class="relative w-full lg:w-72 shrink-0">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('filter'))
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    @endif
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari artikel, pipa, wastafel..." 
                           class="w-full pl-4 pr-10 py-2.5 rounded-full border border-slate-300 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all bg-slate-50">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-transparent border-none text-slate-500 hover:text-emerald-600 cursor-pointer p-1">
                        <svg class="w-4 h-4 fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </form>
            </div>

            {{-- ROW 2: SEGMENTED CONTROL CONTENT HUB TABS --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs pt-1 border-t border-slate-100">
                <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar py-1 snap-x">
                    @php
                        $activeType = $filterPostType ?? request('type') ?? request('filter', 'all');
                        $hubTabs = [
                            'all'           => ['label' => 'Semua', 'icon' => '🌐'],
                            'article'       => ['label' => 'Edukasi Teknis', 'icon' => '📄'],
                            'promo'         => ['label' => 'Promo Khusus', 'icon' => '🏷️'],
                            'news'          => ['label' => 'Kabar Perusahaan', 'icon' => '📰'],
                            'case_study'    => ['label' => 'Studi Kasus B2B', 'icon' => '💼'],
                            'press_release' => ['label' => 'Press Release', 'icon' => '📢'],
                            'video_guide'   => ['label' => 'Video Panduan', 'icon' => '🎥'],
                        ];
                    @endphp

                    @foreach($hubTabs as $tabKey => $tab)
                        @php
                            $isTabActive = ($activeType === $tabKey) || ($tabKey === 'video_guide' && $activeType === 'video');
                            $tabUrl = route('blog', array_merge(request()->except('type', 'filter', 'page'), ['type' => $tabKey]));
                            $count = $postTypeCounts[$tabKey] ?? null;
                        @endphp
                        <a href="{{ $tabUrl }}" 
                           class="snap-start shrink-0 inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-bold transition-all text-decoration-none {{ $isTabActive ? 'bg-[#070F1E] text-white shadow-sm ring-1 ring-white/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}">
                            <span>{{ $tab['icon'] }}</span>
                            <span>{{ $tab['label'] }}</span>
                            @if(isset($count))
                                <span class="text-[10px] px-1.5 py-0.2 rounded-full font-extrabold {{ $isTabActive ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-600' }}">
                                    {{ $count }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>

                @if(!empty($search) || !empty($tag) || ($filterCategory ?? 'all') !== 'all' || ($activeType ?? 'all') !== 'all')
                <div class="shrink-0 self-end sm:self-auto">
                    <a href="{{ route('blog') }}" class="text-rose-600 font-extrabold hover:underline flex items-center gap-1 text-decoration-none text-xs">
                        <span>× Reset Semua Filter</span>
                    </a>
                </div>
                @endif
            </div>

        </div>

        {{-- MAIN NEWS GRID WITH SCROLL REVEAL INTERACTION --}}
        @if($articles->isEmpty())
        <div class="text-center py-12 px-4 bg-white rounded-3xl border border-slate-200 max-w-md mx-auto shadow-sm">
            <div class="text-4xl mb-3">🔍</div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-1">Tidak Ada Konten Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-500 mb-4">Coba ubah filter tipe postingan, kata kunci pencarian, atau pilih kategori lainnya.</p>
            <a href="{{ route('blog') }}" class="inline-flex px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl shadow-md text-decoration-none transition-all">Lihat Semua Konten</a>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-12">
            @foreach($articles as $article)
            
            {{-- 1. KARTU PROMO KHUSUS (BENTO PROMO ARCHETYPE) --}}
            @if($article->isPromo())
            <article class="opacity-0 translate-y-8 transition-all duration-700 ease-out scroll-reveal group bg-gradient-to-b from-amber-50/40 via-white to-rose-50/20 border-2 border-amber-300 ring-2 ring-amber-400/20 shadow-md hover:shadow-2xl hover:border-amber-400 hover:-translate-y-1.5 rounded-3xl overflow-hidden flex flex-col justify-between relative">
                <div>
                    {{-- 16:9 MEDIA CONTAINER --}}
                    <a href="{{ route('blog.show', $article->slug) }}" class="relative aspect-[16/9] bg-slate-950 overflow-hidden block">
                        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->thumbnail_alt ?: $article->clean_title }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        {{-- PROMO BADGES & COUNTDOWN --}}
                        <div class="absolute top-3 left-3 flex gap-1.5 z-10 flex-wrap">
                            <span class="bg-gradient-to-r from-red-600 to-amber-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider shadow-sm flex items-center gap-1">
                                <span>🏷️</span> PROMO KHUSUS
                            </span>
                            @if($article->promo_end_date)
                                @if($article->promo_end_date->isPast())
                                    <span class="bg-red-800 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-xs">
                                        🔴 Berakhir
                                    </span>
                                @elseif($article->promo_end_date->diffInHours(now()) <= 72)
                                    <span class="bg-amber-400 text-slate-950 text-[10px] font-extrabold px-2 py-0.5 rounded-md shadow-xs animate-pulse flex items-center gap-1">
                                        🔥 Segera Berakhir
                                    </span>
                                @else
                                    <span class="bg-slate-950/80 backdrop-blur-xs text-amber-300 text-[10px] font-bold px-2 py-0.5 rounded-md shadow-xs">
                                        ⏰ s/d {{ $article->promo_end_date->translatedFormat('d M') }}
                                    </span>
                                @endif
                            @endif
                        </div>

                        {{-- DEADLINE STRIP OVERLAY --}}
                        @if($article->promo_end_date && !$article->promo_end_date->isPast())
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-2.5 flex items-center justify-between text-white text-[10px] font-bold">
                            <span class="flex items-center gap-1 text-amber-300">
                                <span>⏳</span> Masa Berlaku Promo
                            </span>
                            <span class="font-mono text-white/90">
                                {{ $article->promo_end_date->translatedFormat('d F Y, H:i') }} WIB
                            </span>
                        </div>
                        @endif
                    </a>

                    {{-- PROMO CARD BODY --}}
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-[11px] text-amber-800 font-semibold mb-2">
                            <span>🏷️ Penawaran Spesial</span>
                            <span>•</span>
                            <span>👁️ {{ $article->views }} peminat</span>
                        </div>

                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-amber-700 transition-colors line-clamp-2 leading-snug mb-2">
                            <a href="{{ route('blog.show', $article->slug) }}" class="text-decoration-none text-slate-900 group-hover:text-amber-700">
                                {{ $article->clean_title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-3">
                            {{ Str::limit($article->excerpt, 115) }}
                        </p>
                    </div>
                </div>

                {{-- PROMO FOOTER WITH HIGH-CONVERTING CTA --}}
                <div class="px-5 pb-4 pt-3 border-t border-amber-100 flex items-center justify-between w-full bg-amber-50/50">
                    <span class="text-[11px] font-extrabold text-amber-800 truncate max-w-[130px] flex items-center gap-1">
                        <span>⚡ Promo Diskon</span>
                    </span>
                    <a href="{{ route('blog.show', $article->slug) }}" class="px-3.5 py-2 bg-gradient-to-r from-red-600 to-amber-600 hover:from-red-700 hover:to-amber-700 text-white text-xs font-extrabold rounded-xl shadow-sm flex items-center gap-1.5 group-hover:scale-105 transition-all text-decoration-none">
                        <span>Lihat Promo</span>
                        <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>

            {{-- 2. KARTU STUDI KASUS & PORTOFOLIO B2B (BENTO CASE STUDY ARCHETYPE) --}}
            @elseif($article->isCaseStudy())
            <article class="opacity-0 translate-y-8 transition-all duration-700 ease-out scroll-reveal group bg-white rounded-3xl overflow-hidden border border-indigo-200/90 shadow-sm hover:shadow-xl hover:border-indigo-500 hover:-translate-y-1.5 flex flex-col justify-between">
                <div>
                    {{-- 16:9 MEDIA CONTAINER --}}
                    <a href="{{ route('blog.show', $article->slug) }}" class="relative aspect-[16/9] bg-slate-950 overflow-hidden block">
                        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->thumbnail_alt ?: $article->clean_title }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        {{-- B2B CASE STUDY BADGE --}}
                        <div class="absolute top-3 left-3 flex gap-2 z-10">
                            <span class="bg-[#0B2545]/95 backdrop-blur-xs text-indigo-200 text-[10px] font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider flex items-center gap-1">
                                <span>💼</span> STUDI KASUS B2B
                            </span>
                        </div>

                        {{-- READ TIME --}}
                        <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded z-10 flex items-center gap-1">
                            <span>⏱️ {{ $article->reading_time }} mnt</span>
                        </div>
                    </a>

                    {{-- CASE STUDY BODY --}}
                    <div class="p-5">
                        {{-- PROMINENT CLIENT & GEO ROW --}}
                        @if($article->client_name || $article->location_geo)
                        <div class="flex items-center gap-2 text-[11px] font-bold text-indigo-950 bg-indigo-50/80 px-3 py-1.5 rounded-xl mb-2.5 border border-indigo-100/90 flex-wrap">
                            @if($article->client_name)
                                <span class="flex items-center gap-1 truncate font-extrabold text-indigo-900">
                                    🏢 {{ $article->client_name }}
                                </span>
                            @endif
                            @if($article->client_name && $article->location_geo)
                                <span class="text-indigo-300">•</span>
                            @endif
                            @if($article->location_geo)
                                <span class="flex items-center gap-1 text-slate-600 font-medium truncate">
                                    📍 {{ $article->location_geo }}
                                </span>
                            @endif
                        </div>
                        @endif

                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug mb-2">
                            <a href="{{ route('blog.show', $article->slug) }}" class="text-decoration-none text-slate-900 group-hover:text-indigo-600">
                                {{ $article->clean_title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-3">
                            {{ Str::limit($article->excerpt, 120) }}
                        </p>
                    </div>
                </div>

                {{-- CASE STUDY FOOTER --}}
                <div class="px-5 pb-4 pt-3 border-t border-slate-100 flex items-center justify-between w-full bg-slate-50/40">
                    <span class="text-[11px] font-bold text-indigo-900">
                        🛡️ Proyek Terverifikasi
                    </span>
                    <a href="{{ route('blog.show', $article->slug) }}" class="text-xs font-extrabold text-indigo-700 hover:text-indigo-900 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform text-decoration-none">
                        <span>Baca Studi Kasus</span>
                        <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>

            {{-- 3. KARTU STANDAR EDUKASI / NEWS / PRESS RELEASE (BENTO STANDARD ARCHETYPE) --}}
            @else
            <article class="opacity-0 translate-y-8 transition-all duration-700 ease-out scroll-reveal group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-emerald-500 hover:-translate-y-1.5 flex flex-col justify-between">
                <div>
                    {{-- 16:9 MEDIA CONTAINER --}}
                    <a href="{{ route('blog.show', $article->slug) }}" class="relative aspect-[16/9] bg-slate-950 overflow-hidden block">
                        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->thumbnail_alt ?: $article->clean_title }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        {{-- CATEGORY / POST TYPE BADGE --}}
                        <div class="absolute top-3 left-3 flex gap-2 z-10 flex-wrap">
                            @if($article->post_type === 'news')
                                <span class="bg-blue-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider shadow-sm flex items-center gap-1">
                                    <span>📰</span> KABAR
                                </span>
                            @elseif($article->post_type === 'press_release')
                                <span class="bg-purple-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider shadow-sm flex items-center gap-1">
                                    <span>📢</span> PRESS RELEASE
                                </span>
                            @else
                                <span class="bg-emerald-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider shadow-sm">
                                    {{ $article->category ?? 'Tips Rumah' }}
                                </span>
                            @endif
                        </div>

                        {{-- READ TIME --}}
                        <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded z-10 flex items-center gap-1">
                            <span>⏱️ {{ $article->reading_time }} mnt</span>
                        </div>

                        {{-- PLAY BUTTON OVERLAY FOR VIDEO --}}
                        @if($article->youtube_video_id || $article->post_type === 'video_guide')
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center text-sm shadow-md">▶</span>
                        </div>
                        @endif
                    </a>

                    {{-- CARD BODY --}}
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-[11px] text-slate-500 font-medium mb-2">
                            <span>📅 {{ $article->published_at?->translatedFormat('d M Y') }}</span>
                            <span>•</span>
                            <span>👁️ {{ $article->views }} views</span>
                        </div>

                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug mb-2">
                            <a href="{{ route('blog.show', $article->slug) }}" class="text-decoration-none text-slate-900 group-hover:text-emerald-600">
                                {{ $article->clean_title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-3">
                            {{ Str::limit($article->excerpt, 120) }}
                        </p>
                    </div>
                </div>

                {{-- CARD FOOTER --}}
                <div class="px-5 pb-4 pt-3 border-t border-slate-100 flex items-center justify-between w-full">
                    <span class="text-[11px] font-bold text-slate-500 truncate max-w-[130px]">
                        ✍️ {{ $article->author ?: 'Tim Rootera' }}
                    </span>
                    <a href="{{ route('blog.show', $article->slug) }}" class="text-xs font-extrabold text-[#0B2545] hover:text-emerald-600 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform text-decoration-none shrink-0">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>
            @endif

            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-center mt-8">
            {{ $articles->appends(request()->query())->links() }}
        </div>
        @endif

        {{-- DEDICATED VIDEO SECTION (ROOTERA TV / PANDUAN VISUAL - SWIPEABLE ON MOBILE) --}}
        @if(isset($videoArticles) && $videoArticles->isNotEmpty())
        <div class="my-12 sm:my-16 bg-slate-900/95 border border-white/10 rounded-3xl p-5 sm:p-8 md:p-10 text-white shadow-2xl relative overflow-hidden backdrop-blur-md">
            <div class="absolute -right-20 -bottom-20 w-72 h-72 bg-red-600/15 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-3 mb-6 sm:mb-8 border-b border-white/10 pb-4">
                <div>
                    <div class="inline-flex items-center gap-2 bg-red-600/20 border border-red-500/40 px-3 py-1 rounded-full text-[11px] sm:text-xs font-extrabold text-red-400 uppercase tracking-wider mb-1.5">
                        <span>📺 Rootera TV</span> • Video Tutorial Direct
                    </div>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-white">Panduan Visual &amp; Demo Lapangan</h3>
                </div>
                <a href="{{ route('blog', ['filter' => 'video']) }}" class="text-xs font-extrabold text-red-400 hover:text-red-300 flex items-center gap-1 text-decoration-none">
                    <span>Lihat Semua Video Tutorial</span>
                    <span>→</span>
                </a>
            </div>

            {{-- MOBILE HORIZONTAL SWIPEABLE VIDEO CAROUSEL --}}
            <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 no-scrollbar md:grid md:grid-cols-3 pb-2 md:pb-0">
                @foreach($videoArticles as $video)
                <div class="w-[260px] sm:w-[320px] md:w-auto shrink-0 snap-start bg-slate-950/80 border border-white/10 hover:border-red-500/50 rounded-2xl overflow-hidden transition-all duration-300 group">
                    <a href="{{ route('blog.show', $video->slug) }}" class="relative aspect-[16/9] block overflow-hidden bg-black">
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->thumbnail_alt ?: $video->clean_title }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <div class="w-11 h-11 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-lg shadow-red-600/50 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <span class="absolute bottom-2 right-2 bg-black/80 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded">
                            👁️ {{ $video->views }} views
                        </span>
                    </a>
                    <div class="p-3.5">
                        <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-red-400 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('blog.show', $video->slug) }}" class="text-decoration-none text-white group-hover:text-red-400">
                                {{ $video->clean_title }}
                            </a>
                        </h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- BANNER KONSULTASI WHATSAPP --}}
        <div class="bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#071930] rounded-3xl p-6 sm:p-10 text-white relative overflow-hidden shadow-2xl border border-white/10 flex flex-col lg:flex-row items-center justify-between gap-6 mt-12 mb-12 sm:mb-8">
            <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
            
            <div class="max-w-2xl z-10 text-center lg:text-left">
                <span class="bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-[11px] sm:text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider inline-block mb-3">
                    Bantuan Layanan Darurat 24 Jam
                </span>
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-white leading-tight mb-2">
                    Punya Masalah Saluran Air yang Membutuhkan Solusi Cepat?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                    Konsultasikan langsung kendala pipa tersumbat rumah atau bisnis Anda bersama tim ahli Rootera 24 jam nonstop. Gratis estimasi biaya &amp; garansi 30 hari!
                </p>
            </div>

            <div class="z-10 shrink-0 w-full lg:w-auto">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca portal blog & pengetahuan dan membutuhkan bantuan pelancaran pipa.') }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="w-full lg:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-lg shadow-emerald-950/40 transition-all hover:scale-105 text-decoration-none">
                    <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    <span>Konsultasi Gratis via WhatsApp</span>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection

@push('styles')
<style>
/* Custom scrollbar utility for mobile pills */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endpush

@push('scripts')
<script>
// Interaction: Smooth Scroll Reveal for Articles Feed Grid
document.addEventListener('DOMContentLoaded', function() {
    const revealElements = document.querySelectorAll('.scroll-reveal');
    if (!revealElements.length) return;

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => observer.observe(el));
    } else {
        // Fallback for older browsers
        revealElements.forEach(el => el.classList.remove('opacity-0', 'translate-y-8'));
    }
});
</script>
@endpush
