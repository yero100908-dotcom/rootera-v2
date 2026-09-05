@extends('layouts.app')
@section('content')

{{-- PORTAL MEDIA HERO SECTION (LAYOUT 60:40) --}}
<div style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); color: #fff; padding: 3.5rem 0 4rem; position: relative; overflow: hidden;">
    {{-- Background Ambient Light --}}
    <div style="position: absolute; top: -120px; left: 50%; transform: translateX(-50%); width: 900px; height: 450px; background: radial-gradient(circle, rgba(45, 212, 191, 0.18) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        
        {{-- BRANDING PORTAL HEADER --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 border-b border-slate-700/60 pb-6 mb-10">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.18); padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 700; color: #2dd4bf; text-transform: uppercase; letter-spacing: 0.06em; backdrop-filter: blur(10px);">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #2dd4bf; box-shadow: 0 0 10px #2dd4bf;" class="animate-pulse"></span>
                    Rootera News &amp; Tech Portal
                </div>
                <h1 style="font-size: clamp(1.8rem, 3.5vw, 2.75rem); font-weight: 900; line-height: 1.2; margin-top: 0.6rem; color: #ffffff;">
                    Portal Berita &amp; <span style="background: linear-gradient(90deg, #2dd4bf, #6ee7cc, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Insight Plumbing</span>
                </h1>
            </div>
            <p class="text-slate-300 text-sm max-w-md text-left md:text-right font-medium leading-relaxed">
                Pusat berita teknologi sanitasi, komparasi instalasi pipa, panduan B2B, &amp; tips edukasi rumah tangga dari ahli Rootera.
            </p>
        </div>

        {{-- HERO HEADLINE LAYOUT 60:40 --}}
        @if(isset($headline) && $headline)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            {{-- SISI KIRI (60%): HEADLINE UTAMA DOMINAN --}}
            <div class="lg:col-span-7 flex flex-col">
                <div style="background: rgba(15, 23, 42, 0.75); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 24px; overflow: hidden; backdrop-filter: blur(16px); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);" class="h-full flex flex-col group">
                    
                    {{-- 16:9 MEDIA CONTAINER --}}
                    <div class="relative bg-slate-950 aspect-[16/9] overflow-hidden">
                        <img src="{{ $headline->thumbnail_url }}" alt="{{ $headline->clean_title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" class="group-hover:scale-105">
                        
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(6,20,52,0.95) 0%, rgba(6,20,52,0.3) 50%, transparent 100%); pointer-events: none;"></div>

                        {{-- BADGES --}}
                        <div style="position: absolute; top: 1.25rem; left: 1.25rem; display: flex; gap: 0.5rem; flex-wrap: wrap; z-index: 2;">
                            <span style="background: #2563eb; color: #fff; font-size: 0.72rem; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 8px; text-transform: uppercase; letter-spacing: 0.05em; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);">
                                🔥 Headline Utama
                            </span>
                            <span style="background: rgba(0, 0, 0, 0.65); backdrop-filter: blur(6px); color: #2dd4bf; border: 1px solid rgba(45, 212, 191, 0.3); font-size: 0.72rem; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 8px;">
                                {{ $headline->category ?? 'Tips Rumah' }}
                            </span>
                        </div>

                        {{-- READ TIME & VIEWS OVERLAY --}}
                        <div style="position: absolute; bottom: 1rem; right: 1.25rem; display: flex; gap: 0.5rem; z-index: 2;">
                            <span style="background: rgba(0,0,0,0.7); backdrop-filter: blur(6px); color: #e2e8f0; font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.7rem; border-radius: 6px;">
                                ⏱️ {{ $headline->reading_time }} mnt baca
                            </span>
                            <span style="background: rgba(0,0,0,0.7); backdrop-filter: blur(6px); color: #e2e8f0; font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.7rem; border-radius: 6px;">
                                👁️ {{ $headline->views }} views
                            </span>
                        </div>

                        {{-- VIDEO PLAY OVERLAY IF APPLICABLE --}}
                        @if($headline->youtube_video_id || $headline->post_type === 'video_guide')
                        <a href="{{ route('blog.show', $headline->slug) }}" style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; z-index: 3;">
                            <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(220, 38, 38, 0.9); color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 25px rgba(220, 38, 38, 0.7); backdrop-filter: blur(4px); transition: transform 0.3s ease;" class="group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 3px;"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </a>
                        @endif
                    </div>

                    {{-- HEADLINE BODY --}}
                    <div class="p-6 lg:p-8 flex flex-col justify-between flex-grow" style="background: rgba(6, 20, 52, 0.85);">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; color: #94a3b8; font-size: 0.82rem; font-weight: 600; margin-bottom: 0.6rem;">
                                <span>📅 {{ $headline->published_at?->translatedFormat('d F Y') }}</span>
                                <span>•</span>
                                <span>✍️ {{ $headline->author ?: 'Redaksi Rootera' }}</span>
                            </div>

                            <h2 style="color: #ffffff; font-size: clamp(1.35rem, 2.2vw, 1.8rem); font-weight: 800; line-height: 1.3; margin-bottom: 0.85rem;">
                                <a href="{{ route('blog.show', $headline->slug) }}" style="color: inherit; text-decoration: none;" class="hover:text-teal-300 transition-colors">
                                    {{ $headline->clean_title }}
                                </a>
                            </h2>

                            <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                                {{ Str::limit($headline->excerpt, 170) }}
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('blog.show', $headline->slug) }}" style="background: linear-gradient(90deg, #10b981, #059669); color: #ffffff; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 12px; font-size: 0.88rem; font-weight: 800; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); transition: all 0.2s ease;" class="hover:opacity-95 hover:translate-x-1">
                                Baca Berita Utama Lengkap
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SISI KANAN (40%): 3 SIDE HEADLINES VERTIKAL --}}
            <div class="lg:col-span-5 flex flex-col space-y-4">
                
                <div class="flex items-center justify-between border-b border-slate-700/80 pb-3 mb-1">
                    <h3 class="text-sm font-extrabold tracking-wider text-teal-400 uppercase flex items-center gap-2">
                        <span>⚡</span> Highlight Berita &amp; Tren
                    </h3>
                    <span class="text-xs text-slate-400 font-bold">Top Redaksi</span>
                </div>

                @foreach($sideHeadlines as $side)
                <article class="group bg-slate-900/80 border border-slate-800 hover:border-teal-500/50 rounded-2xl p-4 transition-all duration-300 hover:bg-slate-900 flex gap-4 items-center shadow-lg">
                    
                    {{-- THUMBNAIL KECIL (16:10) --}}
                    <a href="{{ route('blog.show', $side->slug) }}" class="flex-shrink-0 w-28 sm:w-32 aspect-[16/10] bg-slate-950 rounded-xl overflow-hidden relative block">
                        <img src="{{ $side->thumbnail_url }}" alt="{{ $side->clean_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @if($side->youtube_video_id || $side->post_type === 'video_guide')
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <span class="w-7 h-7 rounded-full bg-red-600/90 text-white flex items-center justify-center text-xs">▶</span>
                        </div>
                        @endif
                    </a>

                    {{-- SIDE CONTENT --}}
                    <div class="flex-grow min-w-0">
                        <div class="flex items-center gap-2 text-[0.72rem] text-slate-400 font-bold mb-1">
                            <span class="text-teal-400 bg-teal-950/80 px-2 py-0.5 rounded border border-teal-800/40">
                                {{ $side->category ?? 'Tips Rumah' }}
                            </span>
                            <span>•</span>
                            <span>⏱️ {{ $side->reading_time }} mnt</span>
                        </div>

                        <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-teal-300 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('blog.show', $side->slug) }}">
                                {{ $side->clean_title }}
                            </a>
                        </h4>

                        <div class="text-[0.7rem] text-slate-400 mt-1.5 flex items-center gap-2">
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
</div>

{{-- MAIN NEWS SECTION --}}
<section class="section" style="padding: 3.5rem 0 5rem; background: #f8fafc;">
    <div class="container">
        
        {{-- FLOATING FILTER BAR & PILAR CATEGORIES --}}
        <div style="background: #ffffff; border-radius: 24px; padding: 1.5rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.04); margin-bottom: 2.5rem;" class="space-y-4">
            
            {{-- ROW 1: PILAR KATEGORI INDUSTRI --}}
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-4">
                <div class="flex flex-wrap items-center gap-2" id="category-pills">
                    <a href="{{ route('blog', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" 
                       class="category-pill {{ ($filterCategory ?? 'all') === 'all' ? 'active' : '' }}">
                        🌐 Semua Pilar ({{ array_sum($categoryCounts ?? []) }})
                    </a>

                    @foreach($categories as $catKey => $catLabel)
                        <a href="{{ route('blog', array_merge(request()->except('category', 'page'), ['category' => $catKey])) }}" 
                           class="category-pill {{ ($filterCategory ?? '') === $catKey ? 'active' : '' }}">
                            {{ $catLabel }} ({{ $categoryCounts[$catKey] ?? 0 }})
                        </a>
                    @endforeach
                </div>

                {{-- SEARCH FORM --}}
                <form method="GET" action="{{ route('blog') }}" class="relative w-full md:w-72">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('filter'))
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    @endif
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari artikel, pipa, watafel..." 
                           style="width: 100%; padding: 0.55rem 2.5rem 0.55rem 1rem; border-radius: 9999px; border: 1px solid #cbd5e1; font-size: 0.85rem; outline: none;" 
                           class="focus:border-blue-900 transition-all">
                    <button type="submit" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </form>
            </div>

            {{-- ROW 2: TIPE KONTEN & SUB-TAGS --}}
            <div class="flex flex-wrap items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="font-extrabold text-slate-700">Filter Tipe:</span>
                    <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'all'])) }}" 
                       class="px-3 py-1 rounded-full font-bold {{ ($filterType ?? 'all') === 'all' ? 'bg-slate-800 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Semua
                    </a>
                    <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'article'])) }}" 
                       class="px-3 py-1 rounded-full font-bold {{ ($filterType ?? '') === 'article' ? 'bg-teal-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        📄 Artikel Teks
                    </a>
                    <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'video'])) }}" 
                       class="px-3 py-1 rounded-full font-bold {{ ($filterType ?? '') === 'video' ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        ▶️ Video Panduan
                    </a>
                </div>

                @if(!empty($search) || !empty($tag) || ($filterCategory ?? 'all') !== 'all' || ($filterType ?? 'all') !== 'all')
                <div>
                    <a href="{{ route('blog') }}" class="text-rose-600 font-extrabold hover:underline flex items-center gap-1">
                        <span>× Reset Semua Filter</span>
                    </a>
                </div>
                @endif
            </div>

        </div>

        {{-- MAIN NEWS GRID --}}
        @if($articles->isEmpty())
        <div style="text-align: center; padding: 4rem 1rem; background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; max-width: 600px; margin: 0 auto;">
            <div style="font-size: 3.5rem; margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Tidak Ada Artikel Ditemukan</h3>
            <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">Coba gunakan kata kunci lain atau pilih pilar kategori industri lainnya.</p>
            <a href="{{ route('blog') }}" class="btn btn-primary">Lihat Semua Berita</a>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($articles as $article)
            <article class="content-card group bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col" itemscope itemtype="https://schema.org/Article">
                
                {{-- 16:9 ASPECT RATIO MEDIA CONTAINER --}}
                <a href="{{ route('blog.show', $article->slug) }}" class="card-media relative aspect-[16/9] bg-slate-900 overflow-hidden block">
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->clean_title }}" loading="lazy" itemprop="image" class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500">
                    
                    {{-- CATEGORY BADGE --}}
                    <div class="absolute top-3 left-3 flex gap-2 z-10">
                        <span class="bg-blue-900/90 backdrop-blur-md text-white text-[0.7rem] font-extrabold px-2.5 py-1 rounded-md tracking-wider uppercase">
                            {{ $article->category ?? 'Tips Rumah' }}
                        </span>
                    </div>

                    {{-- READ TIME BADGE --}}
                    <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-md text-white text-[0.7rem] font-bold px-2 py-0.5 rounded z-10 flex items-center gap-1">
                        <span>⏱️ {{ $article->reading_time }} mnt</span>
                    </div>

                    {{-- PLAY OVERLAY IF VIDEO --}}
                    @if($article->youtube_video_id || $article->post_type === 'video_guide')
                    <div class="absolute inset-0 bg-black/25 flex items-center justify-center group-hover:bg-black/10 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @endif
                </a>

                {{-- CARD CONTENT BODY --}}
                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold mb-2">
                        <time itemprop="datePublished" datetime="{{ $article->published_at?->format('Y-m-d') }}">
                            📅 {{ $article->published_at?->translatedFormat('d F Y') }}
                        </time>
                        <span>•</span>
                        <span>👁️ {{ $article->views }} views</span>
                    </div>

                    <h3 class="text-base font-extrabold text-slate-900 group-hover:text-blue-700 transition-colors line-clamp-2 leading-snug mb-2" itemprop="headline">
                        <a href="{{ route('blog.show', $article->slug) }}">
                            {{ $article->clean_title }}
                        </a>
                    </h3>

                    <p class="text-xs sm:text-sm text-slate-600 line-clamp-3 leading-relaxed mb-4" itemprop="description">
                        {{ Str::limit($article->excerpt, 115) }}
                    </p>

                    {{-- FOOTER CARD ACTION LINK --}}
                    <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">
                            ✍️ {{ $article->author ?: 'Tim Rootera' }}
                        </span>
                        <a href="{{ route('blog.show', $article->slug) }}" class="text-xs font-extrabold text-blue-900 hover:text-blue-700 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <span>Baca Selengkapnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-center mt-10">
            {{ $articles->appends(request()->query())->links() }}
        </div>
        @endif

        {{-- DEDICATED VIDEO SECTION (ROOTERA TV / PANDUAN VISUAL) --}}
        @if(isset($videoArticles) && $videoArticles->isNotEmpty())
        <div class="my-16 bg-slate-950 rounded-3xl p-6 sm:p-10 border border-slate-800 text-white shadow-2xl relative overflow-hidden">
            <div style="position: absolute; right: -80px; bottom: -80px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(220, 38, 38, 0.15) 0%, transparent 70%); pointer-events: none;"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8 border-b border-slate-800 pb-5">
                <div>
                    <div class="inline-flex items-center gap-2 bg-red-600/20 border border-red-500/40 px-3 py-1 rounded-full text-xs font-extrabold text-red-400 uppercase tracking-wider mb-2">
                        <span>📺 Rootera TV</span> • Video Tutorial Direct
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black text-white">Panduan Visual &amp; Demo Lapangan</h3>
                </div>
                <a href="{{ route('blog', ['filter' => 'video']) }}" class="text-xs font-extrabold text-red-400 hover:text-red-300 flex items-center gap-1">
                    Lihat Semua Video Tutorial →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($videoArticles as $video)
                <div class="group bg-slate-900 border border-slate-800 hover:border-red-500/50 rounded-2xl overflow-hidden transition-all duration-300">
                    <a href="{{ route('blog.show', $video->slug) }}" class="relative aspect-[16/9] block overflow-hidden bg-black">
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->clean_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                            <div class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-115 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <span class="absolute bottom-2 right-2 bg-black/80 text-white text-[0.7rem] font-bold px-2 py-0.5 rounded">
                            👁️ {{ $video->views }} views
                        </span>
                    </a>
                    <div class="p-4">
                        <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-red-400 transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('blog.show', $video->slug) }}">
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
        <div style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); border-radius: 24px; padding: 2.5rem 2rem; color: #ffffff; position: relative; overflow: hidden; margin-top: 4rem; box-shadow: 0 20px 40px rgba(6, 20, 52, 0.25);" class="flex flex-col lg:flex-row items-center justify-between gap-6">
            <div style="position: absolute; right: -50px; bottom: -50px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, transparent 70%); pointer-events: none;"></div>
            
            <div style="max-width: 650px; z-index: 2;">
                <span style="background: rgba(45, 212, 191, 0.2); border: 1px solid rgba(45, 212, 191, 0.4); color: #2dd4bf; font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.8rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 0.75rem;">
                    Bantuan Layanan Darurat 24 Jam
                </span>
                <h3 style="color: #ffffff; font-size: clamp(1.25rem, 2.5vw, 1.65rem); font-weight: 800; line-height: 1.3; margin-bottom: 0.5rem;">
                    Punya Masalah Saluran Air yang Membutuhkan Solusi Cepat?
                </h3>
                <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.95rem; margin: 0; line-height: 1.6;">
                    Konsultasikan langsung kendala pipa tersumbat rumah atau bisnis Anda bersama tim ahli Rootera 24 jam nonstop. Gratis estimasi biaya &amp; garansi 30 hari!
                </p>
            </div>

            <div style="z-index: 2; flex-shrink: 0;">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera CS, saya membaca portal blog & pengetahuan dan membutuhkan bantuan pelancaran pipa.') }}" target="_blank" rel="noopener noreferrer" style="background: #25D366; color: #ffffff; text-decoration: none; padding: 0.85rem 1.75rem; border-radius: 14px; font-weight: 800; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35); transition: transform 0.2s;" class="hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    Konsultasi Gratis via WhatsApp
                </a>
            </div>
        </div>

    </div>
</section>
@endsection

@push('styles')
<style>
/* Category Pills */
.category-pill {
    background: #ffffff;
    color: #475569;
    border: 1px solid #cbd5e1;
    padding: 0.45rem 1rem;
    border-radius: 9999px;
    font-size: 0.8rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
}
.category-pill:hover {
    background: #f1f5f9;
    color: #0b2b64;
    border-color: #94a3b8;
}
.category-pill.active {
    background: linear-gradient(135deg, #0b2b64, #0f172a);
    color: #ffffff;
    border-color: #0b2b64;
    box-shadow: 0 4px 14px rgba(11, 43, 100, 0.3);
}
</style>
@endpush
