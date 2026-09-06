@extends('layouts.app')
@section('content')

{{-- PORTAL MEDIA HERO SECTION (DARK GLASSMORPHISM 60:40) --}}
<section class="relative bg-gradient-to-br from-[#071930] via-[#0B2545] to-[#0D3B66] text-white pt-12 pb-14 md:pt-16 md:pb-20 overflow-hidden">
    {{-- Background Ambient Light Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-emerald-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[350px] bg-cyan-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- BRANDING PORTAL HEADER --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 border-b border-white/10 pb-6 mb-8 md:mb-10">
            <div>
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/15 px-3.5 py-1 rounded-full text-xs font-bold text-teal-400 uppercase tracking-wider backdrop-blur-md shadow-xs mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-sm animate-pulse"></span>
                    <span>Rootera News &amp; Tech Portal</span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Portal Berita &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Insight Plumbing</span>
                </h1>
            </div>
            <p class="text-slate-300 text-xs sm:text-sm max-w-md text-left md:text-right leading-relaxed font-medium">
                Pusat edukasi teknologi sanitasi, komparasi instalasi pipa, panduan B2B, &amp; tips perawatan rumah dari teknisi ahli Rootera.
            </p>
        </div>

        {{-- HERO HEADLINE LAYOUT 60:40 --}}
        @if(isset($headline) && $headline)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
            
            {{-- SISI KIRI (60%): FEATURED POST UTAMA (DARK GLASSMORPHISM) --}}
            <div class="lg:col-span-7 flex flex-col">
                <div class="bg-white/[0.07] border border-white/15 backdrop-blur-md rounded-3xl overflow-hidden shadow-2xl flex flex-col group h-full">
                    
                    {{-- 16:9 MEDIA CONTAINER --}}
                    <div class="relative bg-slate-950 aspect-[16/9] overflow-hidden cursor-pointer">
                        <a href="{{ route('blog.show', $headline->slug) }}" class="block w-full h-full">
                            <img src="{{ $headline->thumbnail_url }}" alt="{{ $headline->clean_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </a>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#071930] via-black/30 to-transparent pointer-events-none"></div>

                        {{-- BADGES TOP --}}
                        <div class="absolute top-3.5 left-3.5 flex gap-2 flex-wrap z-10">
                            <span class="bg-emerald-500 text-slate-950 text-[10px] sm:text-xs font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider shadow-md">
                                🔥 Headline Utama
                            </span>
                            <span class="bg-slate-950/80 backdrop-blur-sm text-teal-300 border border-teal-500/30 text-[10px] sm:text-xs font-bold px-2.5 py-0.5 rounded-md">
                                {{ $headline->category ?? 'Tips Rumah' }}
                            </span>
                        </div>

                        {{-- READ TIME & VIEWS OVERLAY --}}
                        <div class="absolute bottom-3 right-3 flex gap-2 z-10 text-[10px] sm:text-xs">
                            <span class="bg-slate-950/80 backdrop-blur-sm text-slate-200 font-semibold px-2.5 py-0.5 rounded-md">
                                ⏱️ {{ $headline->reading_time }} mnt
                            </span>
                            <span class="bg-slate-950/80 backdrop-blur-sm text-slate-200 font-semibold px-2.5 py-0.5 rounded-md">
                                👁️ {{ $headline->views }}
                            </span>
                        </div>

                        {{-- VIDEO PLAY BUTTON OVERLAY IF APPLICABLE --}}
                        @if($headline->youtube_video_id || $headline->post_type === 'video_guide')
                        <a href="{{ route('blog.show', $headline->slug) }}" class="absolute inset-0 flex items-center justify-center z-20">
                            <div class="w-14 h-14 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-lg shadow-red-600/50 backdrop-blur-xs group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </a>
                        @endif
                    </div>

                    {{-- HEADLINE BODY --}}
                    <div class="p-5 sm:p-7 flex flex-col justify-between flex-grow bg-[#061434]/60">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-300 font-medium mb-2">
                                <span>📅 {{ $headline->published_at?->translatedFormat('d F Y') }}</span>
                                <span>•</span>
                                <span>✍️ {{ $headline->author ?: 'Redaksi Rootera' }}</span>
                            </div>

                            <h2 class="text-lg sm:text-xl md:text-2xl font-extrabold text-white leading-snug mb-3 group-hover:text-emerald-300 transition-colors">
                                <a href="{{ route('blog.show', $headline->slug) }}" class="text-decoration-none text-white">
                                    {{ $headline->clean_title }}
                                </a>
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-5 line-clamp-3">
                                {{ Str::limit($headline->excerpt, 150) }}
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('blog.show', $headline->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs sm:text-sm font-extrabold rounded-xl shadow-lg shadow-emerald-950/40 transition-all group-hover:translate-x-0.5 text-decoration-none">
                                <span>Baca Artikel Utama</span>
                                <svg class="w-4 h-4 fill-none stroke-current shrink-0" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SISI KANAN (40%): HIGHLIGHT BERITA VERTIKAL (DESKTOP) & RECENT LIST --}}
            <div class="lg:col-span-5 flex flex-col gap-3.5">
                
                <div class="flex items-center justify-between border-b border-white/10 pb-2.5 mb-1">
                    <h3 class="text-xs sm:text-sm font-extrabold tracking-wider text-emerald-400 uppercase flex items-center gap-2">
                        <span>⚡</span> HIGHLIGHT BERITA &amp; TREN
                    </h3>
                    <span class="text-[11px] text-slate-400 font-semibold">Pilihan Redaksi</span>
                </div>

                @foreach($sideHeadlines as $side)
                <article class="group bg-white/[0.05] border border-white/10 hover:border-emerald-400/40 hover:bg-white/[0.10] backdrop-blur-md rounded-2xl p-3 sm:p-3.5 transition-all duration-300 flex gap-3.5 items-center shadow-lg">
                    
                    {{-- THUMBNAIL KECIL (16:9 / 4:3) --}}
                    <a href="{{ route('blog.show', $side->slug) }}" class="shrink-0 w-24 sm:w-28 aspect-[16/10] bg-slate-950 rounded-xl overflow-hidden relative block">
                        <img src="{{ $side->thumbnail_url }}" alt="{{ $side->clean_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @if($side->youtube_video_id || $side->post_type === 'video_guide')
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <span class="w-6 h-6 rounded-full bg-red-600/90 text-white flex items-center justify-center text-[10px] shadow-xs">▶</span>
                        </div>
                        @endif
                    </a>

                    {{-- SIDE CONTENT --}}
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2 text-[10px] sm:text-[11px] text-slate-300 font-bold mb-1">
                            <span class="text-emerald-400 bg-emerald-950/80 px-2 py-0.5 rounded border border-emerald-800/40">
                                {{ $side->category ?? 'Tips Rumah' }}
                            </span>
                            <span>•</span>
                            <span>⏱️ {{ $side->reading_time }} mnt</span>
                        </div>

                        <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-emerald-300 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('blog.show', $side->slug) }}" class="text-decoration-none text-white">
                                {{ $side->clean_title }}
                            </a>
                        </h4>

                        <div class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-2 font-medium">
                            <span>📅 {{ $side->published_at?->translatedFormat('d M Y') }}</span>
                            <span>•</span>
                            <span>👁️ {{ $side->views }}</span>
                        </div>
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

            {{-- ROW 2: TIPE KONTEN & SUB-TAGS --}}
            <div class="flex flex-wrap items-center justify-between gap-3 text-xs">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-extrabold text-slate-700 shrink-0">Filter Tipe:</span>
                    <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'all'])) }}" 
                       class="px-3 py-1 rounded-full font-bold text-decoration-none {{ ($filterType ?? 'all') === 'all' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Semua
                    </a>
                    <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'article'])) }}" 
                       class="px-3 py-1 rounded-full font-bold text-decoration-none {{ ($filterType ?? '') === 'article' ? 'bg-teal-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        📄 Artikel Teks
                    </a>
                    <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'video'])) }}" 
                       class="px-3 py-1 rounded-full font-bold text-decoration-none {{ ($filterType ?? '') === 'video' ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        ▶️ Video Panduan
                    </a>
                </div>

                @if(!empty($search) || !empty($tag) || ($filterCategory ?? 'all') !== 'all' || ($filterType ?? 'all') !== 'all')
                <div>
                    <a href="{{ route('blog') }}" class="text-rose-600 font-extrabold hover:underline flex items-center gap-1 text-decoration-none">
                        <span>× Reset Semua Filter</span>
                    </a>
                </div>
                @endif
            </div>

        </div>

        {{-- MAIN NEWS GRID --}}
        @if($articles->isEmpty())
        <div class="text-center py-12 px-4 bg-white rounded-3xl border border-slate-200 max-w-md mx-auto shadow-sm">
            <div class="text-4xl mb-3">🔍</div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-1">Tidak Ada Artikel Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-500 mb-4">Coba gunakan kata kunci lain atau pilih pilar kategori industri lainnya.</p>
            <a href="{{ route('blog') }}" class="inline-flex px-5 py-2.5 bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-md text-decoration-none">Lihat Semua Berita</a>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-12">
            @foreach($articles as $article)
            <article class="group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between" itemscope itemtype="https://schema.org/Article">
                
                <div>
                    {{-- 16:9 ASPECT RATIO MEDIA CONTAINER --}}
                    <a href="{{ route('blog.show', $article->slug) }}" class="relative aspect-[16/9] bg-slate-950 overflow-hidden block">
                        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->clean_title }}" loading="lazy" itemprop="image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        {{-- CATEGORY BADGE --}}
                        <div class="absolute top-3 left-3 flex gap-2 z-10">
                            <span class="bg-[#0B2545]/90 backdrop-blur-xs text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-md uppercase tracking-wider">
                                {{ $article->category ?? 'Tips Rumah' }}
                            </span>
                        </div>

                        {{-- READ TIME BADGE --}}
                        <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded z-10 flex items-center gap-1">
                            <span>⏱️ {{ $article->reading_time }} mnt</span>
                        </div>

                        {{-- PLAY OVERLAY IF VIDEO --}}
                        @if($article->youtube_video_id || $article->post_type === 'video_guide')
                        <div class="absolute inset-0 bg-black/25 flex items-center justify-center group-hover:bg-black/10 transition-colors">
                            <div class="w-11 h-11 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        @endif
                    </a>

                    {{-- CARD CONTENT BODY --}}
                    <div class="p-4 sm:p-5">
                        <div class="flex items-center gap-2 text-[11px] text-slate-500 font-medium mb-2">
                            <time itemprop="datePublished" datetime="{{ $article->published_at?->format('Y-m-d') }}">
                                📅 {{ $article->published_at?->translatedFormat('d F Y') }}
                            </time>
                            <span>•</span>
                            <span>👁️ {{ $article->views }} views</span>
                        </div>

                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-snug mb-2" itemprop="headline">
                            <a href="{{ route('blog.show', $article->slug) }}" class="text-decoration-none text-slate-900 group-hover:text-emerald-600">
                                {{ $article->clean_title }}
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-3" itemprop="description">
                            {{ Str::limit($article->excerpt, 115) }}
                        </p>
                    </div>
                </div>

                {{-- FOOTER CARD ACTION LINK --}}
                <div class="px-4 sm:px-5 pb-4 pt-3 border-t border-slate-100 flex items-center justify-between w-full">
                    <span class="text-[11px] font-bold text-slate-500 truncate max-w-[130px]">
                        ✍️ {{ $article->author ?: 'Tim Rootera' }}
                    </span>
                    <a href="{{ route('blog.show', $article->slug) }}" class="text-xs font-extrabold text-[#0B2545] hover:text-emerald-600 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform text-decoration-none shrink-0">
                        <span>Baca Selengkapnya</span>
                        <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>

            </article>
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
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->clean_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
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
