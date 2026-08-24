@extends('layouts.app')
@section('content')

{{-- MODERN HERO SECTION WITH FEATURED SPOTLIGHT --}}
<div style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); color: #fff; padding: 4.5rem 0 4rem; position: relative; overflow: hidden;">
    {{-- Background Glow Effects --}}
    <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 800px; height: 400px; background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        
        {{-- HERO HEADER --}}
        <div class="text-center" style="max-width: 800px; margin: 0 auto 3.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.18); padding: 0.4rem 1.1rem; border-radius: 9999px; font-size: 0.82rem; font-weight: 700; color: #2dd4bf; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.25rem; backdrop-filter: blur(10px);">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #2dd4bf; box-shadow: 0 0 10px #2dd4bf;" class="animate-pulse"></span>
                Pusat Edukasi &amp; Solusi Plumbing
            </div>
            <h1 style="font-size: clamp(2rem, 4.5vw, 3rem); font-weight: 800; line-height: 1.2; margin-bottom: 1rem; color: #ffffff;">
                Portal Edukasi &amp; <span style="background: linear-gradient(90deg, #2dd4bf, #6ee7cc, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Knowledge Hub</span>
            </h1>
            <p style="color: rgba(255, 255, 255, 0.82); font-size: 1.1rem; line-height: 1.6; margin: 0 auto; max-width: 640px;">
                Panduan teknis visual, komparasi hydro-jetting, &amp; tips perawatan saluran air rumah tangga serta komersial dari teknisi profesional Rootera.
            </p>
        </div>

        {{-- FEATURED SPOTLIGHT GRID (HERO BAWAH) --}}
        @if(isset($featuredSpotlight) && $featuredSpotlight)
        <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 24px; overflow: hidden; backdrop-filter: blur(12px); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);" class="grid grid-cols-1 lg:grid-cols-12 gap-0 group">
            
            {{-- LEFT COLUMN: LARGE SPOTLIGHT MEDIA --}}
            <div class="lg:col-span-7 relative bg-slate-950 flex items-center justify-center min-h-[320px] lg:min-h-[400px] overflow-hidden">
                <img src="{{ $featuredSpotlight->thumbnail_url }}" alt="{{ $featuredSpotlight->clean_title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" class="group-hover:scale-105">
                
                {{-- Gradient Overlay --}}
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(6,20,52,0.9) 0%, rgba(6,20,52,0.2) 60%, transparent 100%); pointer-events: none;"></div>

                {{-- Badges --}}
                <div style="position: absolute; top: 1.25rem; left: 1.25rem; display: flex; gap: 0.5rem; flex-wrap: wrap; z-index: 2;">
                    @if($featuredSpotlight->youtube_video_id || $featuredSpotlight->post_type === 'video_guide')
                        <span style="background: #dc2626; color: #fff; font-size: 0.75rem; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 8px; text-transform: uppercase; display: flex; align-items: center; gap: 0.4rem; box-shadow: 0 0 15px rgba(220, 38, 38, 0.5);">
                            ▶ Video Panduan Utama
                        </span>
                    @else
                        <span style="background: #0d9488; color: #fff; font-size: 0.75rem; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 8px; text-transform: uppercase;">
                            📄 Artikel Unggulan
                        </span>
                    @endif
                    <span style="background: rgba(0,0,0,0.6); backdrop-filter: blur(6px); color: #fff; font-size: 0.75rem; font-weight: 600; padding: 0.35rem 0.75rem; border-radius: 8px;">
                        {{ $featuredSpotlight->category ?? 'Edukasi' }}
                    </span>
                </div>

                {{-- Center Glassmorphism Play Icon --}}
                @if($featuredSpotlight->youtube_video_id || $featuredSpotlight->post_type === 'video_guide')
                <a href="{{ route('blog.show', $featuredSpotlight->slug) }}" style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; text-decoration: none; z-index: 3;">
                    <div style="width: 68px; height: 68px; border-radius: 50%; background: rgba(220, 38, 38, 0.9); color: #ffffff; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 30px rgba(220, 38, 38, 0.7); backdrop-filter: blur(4px); transition: transform 0.3s ease;" class="group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 3px;"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </a>
                @endif
            </div>

            {{-- RIGHT COLUMN: SPOTLIGHT CONTENT --}}
            <div class="lg:col-span-5 p-6 lg:p-10 flex flex-col justify-between" style="background: rgba(6, 20, 52, 0.95);">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; color: #6ee7cc; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.75rem;">
                        <span>📅 {{ $featuredSpotlight->published_at?->translatedFormat('d F Y') }}</span>
                        <span>•</span>
                        <span>👁️ {{ $featuredSpotlight->views }} views</span>
                    </div>

                    <h2 style="color: #ffffff; font-size: clamp(1.3rem, 2.5vw, 1.75rem); font-weight: 800; line-height: 1.3; margin-bottom: 1rem;">
                        <a href="{{ route('blog.show', $featuredSpotlight->slug) }}" style="color: inherit; text-decoration: none;" class="hover:text-teal-300 transition-colors">
                            {{ $featuredSpotlight->clean_title }}
                        </a>
                    </h2>

                    <p style="color: rgba(255, 255, 255, 0.78); font-size: 0.95rem; line-height: 1.65; margin-bottom: 1.75rem;">
                        {{ Str::limit($featuredSpotlight->excerpt, 160) }}
                    </p>
                </div>

                <div>
                    <a href="{{ route('blog.show', $featuredSpotlight->slug) }}" style="background: linear-gradient(90deg, #10b981, #059669); color: #ffffff; text-decoration: none; padding: 0.8rem 1.6rem; border-radius: 12px; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); transition: all 0.2s ease;" class="hover:opacity-95 hover:translate-x-0.5">
                        {{ ($featuredSpotlight->youtube_video_id || $featuredSpotlight->post_type === 'video_guide') ? 'Tonton Video Sekarang' : 'Baca Panduan Lengkap' }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

        </div>
        @endif

    </div>
</div>

{{-- MAIN CONTENT SECTION: FILTER BAR, SEARCH, SUB-TOPICS & CARDS --}}
<section class="section" style="padding: 3.5rem 0 5rem; background: #f8fafc;">
    <div class="container">
        
        {{-- FLOATING FILTER & SEARCH BAR CONTAINER --}}
        <div style="background: #ffffff; border-radius: 20px; padding: 1.25rem 1.5rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.04); margin-bottom: 2.5rem;" class="flex flex-col md:flex-row items-center justify-between gap-4">
            
            {{-- CATEGORY TAB PILLS --}}
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; items-center: center;" id="blog-filters">
                @php 
                    $currentFilter = request('filter', 'all'); 
                    $currentSearch = request('search') ?: request('q');
                    $currentTag = request('tag');
                @endphp

                <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'all'])) }}" class="filter-pill {{ $currentFilter === 'all' && empty($currentTag) ? 'active' : '' }}">
                    ✨ Semua Content
                </a>
                <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'article'])) }}" class="filter-pill {{ $currentFilter === 'article' ? 'active' : '' }}">
                    📄 Panduan Teknis
                </a>
                <a href="{{ route('blog', array_merge(request()->except('filter', 'page'), ['filter' => 'video'])) }}" class="filter-pill {{ $currentFilter === 'video' ? 'active' : '' }}">
                    ▶️ Video YouTube
                </a>
            </div>

            {{-- LIVE SEARCH INPUT --}}
            <form method="GET" action="{{ route('blog') }}" style="position: relative; width: 100%; max-width: 320px;">
                @if(request('filter'))
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                @endif
                <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Cari panduan, watafel, kloset..." style="width: 100%; padding: 0.6rem 2.5rem 0.6rem 1rem; border-radius: 9999px; border: 1px solid #cbd5e1; font-size: 0.85rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#0b2b64'" onblur="this.style.borderColor='#cbd5e1'">
                <button type="submit" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #64748b; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </button>
            </form>

        </div>

        {{-- QUICK SUB-TOPIC TAGS --}}
        <div style="display: flex; items-center: center; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 2.5rem; font-size: 0.82rem; color: #64748b;">
            <span style="font-weight: 700; color: #0b2b64;">🔥 Sub-Topik Populer:</span>
            @foreach(['Wastafel', 'Kloset', 'Hydro-Jetting', 'Saluran Bau', 'Restoran B2B', 'Lemak Pipa'] as $subTag)
                <a href="{{ route('blog', ['tag' => strtolower($subTag)]) }}" style="background: #ffffff; border: 1px solid #e2e8f0; color: #475569; padding: 0.25rem 0.75rem; border-radius: 9999px; text-decoration: none; font-weight: 600; transition: all 0.2s;" class="hover:bg-slate-100 hover:text-blue-900 {{ strtolower($currentTag ?? '') === strtolower($subTag) ? '!bg-blue-900 !color-white !border-blue-900' : '' }}">
                    #{{ $subTag }}
                </a>
            @endforeach
            @if(!empty($currentSearch) || !empty($currentTag))
                <a href="{{ route('blog') }}" style="color: #dc2626; font-weight: 700; text-decoration: underline; margin-left: 0.5rem;">Reset Filter ×</a>
            @endif
        </div>

        {{-- POLISHED CONTENT CARDS GRID --}}
        @if($articles->isEmpty())
        <div style="text-align: center; padding: 4rem 1rem; background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; max-width: 600px; margin: 0 auto;">
            <div style="font-size: 3.5rem; margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Tidak Ada Content Ditemukan</h3>
            <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">Coba cari kata kunci lain atau pilih kategori filter di atas.</p>
            <a href="{{ route('blog') }}" class="btn btn-primary">Lihat Semua Content</a>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($articles as $article)
            <article class="content-card group" itemscope itemtype="https://schema.org/Article">
                
                {{-- 16:9 ASPECT RATIO MEDIA CONTAINER --}}
                <a href="{{ route('blog.show', $article->slug) }}" class="card-media">
                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->clean_title }}" loading="lazy" itemprop="image" class="card-img">
                    
                    {{-- OVERLAY BADGES --}}
                    <div style="position: absolute; top: 0.75rem; left: 0.75rem; display: flex; gap: 0.4rem; z-index: 2;">
                        @if($article->youtube_video_id || $article->post_type === 'video_guide')
                            <span class="badge-video">▶ Video YouTube</span>
                        @else
                            <span class="badge-article">📄 Panduan Teknis</span>
                        @endif
                    </div>

                    {{-- VIEWS BADGE (BOTTOM RIGHT) --}}
                    <div style="position: absolute; bottom: 0.75rem; right: 0.75rem; background: rgba(0,0,0,0.65); backdrop-filter: blur(6px); color: #ffffff; font-size: 0.72rem; font-weight: 600; padding: 0.2rem 0.55rem; border-radius: 6px; z-index: 2;">
                        👁️ {{ $article->views }} views
                    </div>

                    {{-- CENTER PLAY ICON OVERLAY (GLASSMORPHISM) --}}
                    @if($article->youtube_video_id || $article->post_type === 'video_guide')
                    <div class="play-overlay">
                        <div class="play-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @endif
                </a>

                {{-- CARD CONTENT BODY --}}
                <div class="card-content">
                    <div class="card-meta">
                        <time itemprop="datePublished" datetime="{{ $article->published_at?->format('Y-m-d') }}">
                            📅 {{ $article->published_at?->translatedFormat('d F Y') }}
                        </time>
                        <span>•</span>
                        <span>{{ $article->author ?: 'Tim Rootera' }}</span>
                    </div>

                    <h3 class="card-h3" itemprop="headline">
                        <a href="{{ route('blog.show', $article->slug) }}">
                            {{ $article->clean_title }}
                        </a>
                    </h3>

                    <p class="card-excerpt" itemprop="description">
                        {{ Str::limit($article->excerpt, 110) }}
                    </p>

                    {{-- FOOTER CARD ACTION LINK --}}
                    <div class="card-footer">
                        <a href="{{ route('blog.show', $article->slug) }}" class="card-cta-link">
                            <span>{{ ($article->youtube_video_id || $article->post_type === 'video_guide') ? 'Tonton Video Panduan' : 'Baca Selengkapnya' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="arrow-icon"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div style="display: flex; justify-content: center; margin-top: 3rem;">
            {{ $articles->appends(request()->query())->links() }}
        </div>
        @endif

        {{-- NEWSLETTER / KONSULTASI FLOATING BANNER (BEFORE FOOTER) --}}
        <div style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); border-radius: 24px; padding: 2.5rem 2rem; color: #ffffff; position: relative; overflow: hidden; margin-top: 5rem; box-shadow: 0 20px 40px rgba(6, 20, 52, 0.25);" class="flex flex-col lg:flex-row items-center justify-between gap-6">
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
/* Filter Pills */
.filter-pill {
    background: #ffffff;
    color: #475569;
    border: 1px solid #cbd5e1;
    padding: 0.55rem 1.25rem;
    border-radius: 9999px;
    font-size: 0.85rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
}
.filter-pill:hover {
    background: #f1f5f9;
    color: #0b2b64;
    border-color: #94a3b8;
}
.filter-pill.active {
    background: linear-gradient(135deg, #0b2b64, #0f172a);
    color: #ffffff;
    border-color: #0b2b64;
    box-shadow: 0 4px 14px rgba(11, 43, 100, 0.3);
}

/* Content Cards UI/UX Polish */
.content-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}
.content-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 35px rgba(0,0,0,0.09);
}

.card-media {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #0f172a;
    overflow: hidden;
    display: block;
}
.card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.content-card:hover .card-img {
    transform: scale(1.06);
}

/* Badges */
.badge-video {
    background: #dc2626;
    color: #ffffff;
    font-size: 0.7rem;
    font-weight: 800;
    padding: 0.25rem 0.65rem;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(220, 38, 38, 0.4);
}
.badge-article {
    background: #0d9488;
    color: #ffffff;
    font-size: 0.7rem;
    font-weight: 800;
    padding: 0.25rem 0.65rem;
    border-radius: 6px;
}

/* Play Icon Glassmorphism */
.play-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}
.content-card:hover .play-overlay {
    background: rgba(0, 0, 0, 0.1);
}
.play-icon-box {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(220, 38, 38, 0.9);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
    backdrop-filter: blur(4px);
    transition: transform 0.3s ease;
}
.content-card:hover .play-icon-box {
    transform: scale(1.12);
}

/* Card Body */
.card-content {
    padding: 1.35rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.card-meta {
    font-size: 0.78rem;
    color: #64748b;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.6rem;
}
.card-h3 {
    font-size: 1.08rem;
    font-weight: 800;
    line-height: 1.38;
    margin-bottom: 0.6rem;
}
.card-h3 a {
    color: #0f172a;
    text-decoration: none;
    transition: color 0.2s ease;
}
.card-h3 a:hover {
    color: #2563eb;
}
.card-excerpt {
    color: #64748b;
    font-size: 0.88rem;
    line-height: 1.55;
    margin-bottom: 1.25rem;
}

/* Card Footer CTA */
.card-footer {
    margin-top: auto;
    padding-top: 0.85rem;
    border-top: 1px solid #f1f5f9;
}
.card-cta-link {
    color: #0b2b64;
    font-size: 0.85rem;
    font-weight: 800;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}
.card-cta-link .arrow-icon {
    transition: transform 0.2s ease;
}
.content-card:hover .card-cta-link .arrow-icon {
    transform: translateX(4px);
}
</style>
@endpush
