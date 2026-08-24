@extends('layouts.app')

@section('content')
{{-- HERO & FEATURED SHOWCASE SECTION --}}
<div style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); color: #fff; padding: 4.5rem 0 3.5rem; position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 2;">
        <div class="text-center" style="max-width: 780px; margin: 0 auto 3rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(45, 212, 191, 0.4); color: #2dd4bf; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                Dokumentasi Riil Tanpa Edit Rekayasa
            </div>
            <h1 style="font-size: 2.3rem; font-weight: 800; line-height: 1.25; margin-bottom: 1rem; color: #fff;">
                Galeri Pekerjaan &amp; Bukti <span style="color: #6ee7cc;">Pengerjaan Pipa Mampet</span>
            </h1>
            <p style="color: rgba(255,255,255,0.82); font-size: 1.05rem; line-height: 1.6; margin: 0;">
                Kumpulan video riil aksi teknisi, foto komparasi sebelum-sesudah (*Before &amp; After*), serta performa mesin hydro-jetting &amp; spiral rotary di lapangan.
            </p>
        </div>

        @if($featuredProject)
        {{-- FEATURED SHOWCASE CARD --}}
        <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 20px 40px rgba(0,0,0,0.3);" class="grid grid-cols-1 lg:grid-cols-12 gap-0">
            <div class="lg:col-span-7 relative bg-slate-950 flex items-center justify-center min-h-[320px]">
                @if($featuredProject->media_type === 'video' && $featuredProject->display_media)
                    <video autoplay muted loop playsinline poster="{{ $featuredProject->display_thumbnail }}" style="width: 100%; height: 100%; object-fit: cover; max-height: 420px;">
                        <source src="{{ $featuredProject->display_media }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <img src="{{ $featuredProject->display_thumbnail }}" alt="{{ $featuredProject->title }}" style="width: 100%; height: 100%; object-fit: cover; max-height: 420px;">
                @endif
                <div style="position: absolute; top: 1rem; left: 1rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
                    <span style="background: #eab308; color: #000; font-size: 0.75rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 6px; text-transform: uppercase;">⭐ Proyek Unggulan</span>
                    <span style="background: rgba(0,0,0,0.7); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 6px;">{{ $featuredProject->category_label }}</span>
                </div>
            </div>
            <div class="lg:col-span-5 p-6 lg:p-8 flex flex-col justify-between" style="background: rgba(6, 20, 52, 0.9);">
                <div>
                    @if($featuredProject->location_tag)
                    <div style="color: #6ee7cc; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; items-center; gap: 0.4rem;">
                        📍 {{ $featuredProject->location_tag }}
                    </div>
                    @endif
                    <h2 style="color: #fff; font-size: 1.5rem; font-weight: 700; line-height: 1.3; margin-bottom: 0.85rem;">
                        <a href="{{ route('galeri.show', $featuredProject->slug) }}" style="color: inherit; text-decoration: none;" class="hover:text-blue-300">
                            {{ $featuredProject->title }}
                        </a>
                    </h2>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.92rem; line-height: 1.6; margin-bottom: 1.5rem;">
                        {{ Str::limit($featuredProject->description, 180) }}
                    </p>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                    @if($featuredProject->related_service_url)
                    <a href="{{ url($featuredProject->related_service_url) }}" style="background: #10b981; color: #fff; text-decoration: none; padding: 0.65rem 1.25rem; border-radius: 10px; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.4rem;">
                        Lihat Layanan Terkait →
                    </a>
                    @endif
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya tertarik dengan pengerjaan proyek: ' . $featuredProject->title) }}" target="_blank" rel="noopener noreferrer" style="background: rgba(255,255,255,0.15); color: #fff; text-decoration: none; padding: 0.65rem 1.25rem; border-radius: 10px; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.4rem; border: 1px solid rgba(255,255,255,0.2);">
                        💬 Konsultasi Masalah Serupa
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- DYNAMIC FILTER BAR & HYBRID MEDIA GRID --}}
<section class="section" style="padding: 3.5rem 0 5rem; background: #f8fafc;">
    <div class="container">
        
        {{-- DYNAMIC FILTER PILLS --}}
        <div style="margin-bottom: 2.5rem; display: flex; justify-content: center; flex-wrap: wrap; gap: 0.5rem;" id="filter-bar">
            @php
                $currentCat = request('category', 'all');
                $currentMedia = request('media_type', 'all');
            @endphp

            <a href="{{ route('galeri') }}" class="filter-pill {{ $currentCat=='all' && $currentMedia=='all' ? 'active' : '' }}">
                ✨ Semua Dokumentasi
            </a>
            <a href="{{ route('galeri', ['category' => 'residential']) }}" class="filter-pill {{ $currentCat=='residential' ? 'active' : '' }}">
                🏠 Residensial
            </a>
            <a href="{{ route('galeri', ['category' => 'commercial_b2b']) }}" class="filter-pill {{ $currentCat=='commercial_b2b' ? 'active' : '' }}">
                🏢 Komersial &amp; B2B
            </a>
            <a href="{{ route('galeri', ['category' => 'before_after']) }}" class="filter-pill {{ $currentCat=='before_after' ? 'active' : '' }}">
                ⚖️ Before &amp; After
            </a>
            <a href="{{ route('galeri', ['category' => 'tools_equipment']) }}" class="filter-pill {{ $currentCat=='tools_equipment' ? 'active' : '' }}">
                🛠️ Alat &amp; Hydro-Jetting
            </a>
            <a href="{{ route('galeri', ['category' => 'team_action']) }}" class="filter-pill {{ $currentCat=='team_action' ? 'active' : '' }}">
                👷 Tim &amp; Lapangan
            </a>
            <a href="{{ route('galeri', ['media_type' => 'video']) }}" class="filter-pill {{ $currentMedia=='video' ? 'active' : '' }}">
                ▶️ Video Pengerjaan
            </a>
        </div>

        {{-- HYBRID MEDIA GRID CARDS --}}
        @if($galleries->isEmpty())
        <div style="text-align: center; padding: 4rem 1rem; background: #fff; border-radius: 16px; border: 1px solid #e2e8f0; max-width: 600px; margin: 0 auto;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Tidak Ada Dokumentasi Ditemukan</h3>
            <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">Coba pilih kategori filter lainnya di atas untuk mengeksplorasi galeri riil kami.</p>
            <a href="{{ route('galeri') }}" class="btn btn-primary">Lihat Semua Galeri</a>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($galleries as $item)
            <div class="gallery-card group">
                
                {{-- MEDIA THUMBNAIL CONTAINER --}}
                <div class="media-container" onclick="openMediaModal('{{ $item->media_type }}', '{{ $item->display_media }}', '{{ addslashes($item->title) }}', '{{ $item->display_before_image }}')">
                    <img src="{{ $item->display_thumbnail }}" alt="{{ $item->title }}" class="media-img" loading="lazy">
                    
                    {{-- Badges --}}
                    <div style="position: absolute; top: 0.75rem; left: 0.75rem; display: flex; gap: 0.4rem; flex-wrap: wrap; z-index: 2;">
                        <span class="badge-cat">{{ $item->category_label }}</span>
                        @if($item->media_type === 'video')
                            <span class="badge-video">▶ Video Riil</span>
                        @endif
                    </div>

                    @if($item->location_tag)
                    <div style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); color: #fff; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.6rem; border-radius: 6px; z-index: 2;">
                        📍 {{ $item->location_tag }}
                    </div>
                    @endif

                    {{-- Play Icon Overlay for Videos --}}
                    @if($item->media_type === 'video')
                    <div class="play-overlay">
                        <div class="play-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @else
                    <div class="zoom-overlay">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                    @endif
                </div>

                {{-- CARD CONTENT --}}
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="{{ route('galeri.show', $item->slug) }}">
                            {{ $item->title }}
                        </a>
                    </h3>
                    
                    @if($item->description)
                    <p class="card-desc">
                        {{ Str::limit($item->description, 110) }}
                    </p>
                    @endif

                    {{-- CONTEXTUAL SILO LINKS --}}
                    <div class="card-actions">
                        @if($item->related_service_url)
                        <a href="{{ url($item->related_service_url) }}" class="action-link-service">
                            Lihat Layanan Terkait →
                        </a>
                        @endif
                        
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi mengenai pengerjaan serupa: ' . $item->title) }}" target="_blank" rel="noopener noreferrer" class="action-link-wa">
                            💬 Konsultasi Masalah Serupa
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div style="display: flex; justify-content: center; margin-top: 2.5rem;">
            {{ $galleries->appends(request()->query())->links() }}
        </div>
        @endif

    </div>
</section>

{{-- MODAL VIEWER FOR PHOTO LIGHTBOX & HTML5 VIDEO --}}
<div id="mediaModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;" onclick="closeMediaModal(event)">
    <div style="position: relative; width: 100%; max-width: 900px; background: #0f172a; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);" onclick="event.stopPropagation()">
        
        <div style="display: flex; justify-content: space-between; items-center: center; padding: 1rem 1.5rem; background: #1e293b; border-b: 1px solid rgba(255,255,255,0.1);">
            <h4 id="modalMediaTitle" style="color: #fff; font-weight: 700; font-size: 1rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80%;"></h4>
            <button type="button" onclick="forceCloseMediaModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.75rem; cursor: pointer; line-height: 1;" class="hover:text-white">&times;</button>
        </div>

        <div id="modalMediaContainer" style="position: relative; width: 100%; min-height: 350px; max-height: 75vh; display: flex; items-center: center; justify-content: center; background: #000;">
            {{-- Injected dynamically --}}
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
.filter-pill {
    background: #ffffff;
    color: #475569;
    border: 1px solid #cbd5e1;
    padding: 0.5rem 1.1rem;
    border-radius: 9999px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
}
.filter-pill:hover {
    background: #f1f5f9;
    color: #0b2b64;
    border-color: #94a3b8;
}
.filter-pill.active {
    background: #0b2b64;
    color: #ffffff;
    border-color: #0b2b64;
    box-shadow: 0 4px 12px rgba(11, 43, 100, 0.2);
}

.gallery-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}
.gallery-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}

.media-container {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #0f172a;
    overflow: hidden;
    cursor: pointer;
}
.media-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.gallery-card:hover .media-img {
    transform: scale(1.05);
}

.badge-cat {
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(4px);
    color: #ffffff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}
.badge-video {
    background: #dc2626;
    color: #ffffff;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
}

.play-overlay, .zoom-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.85;
    transition: opacity 0.3s ease, background 0.3s ease;
}
.gallery-card:hover .play-overlay, .gallery-card:hover .zoom-overlay {
    opacity: 1;
    background: rgba(0, 0, 0, 0.15);
}
.play-btn {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: #dc2626;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 20px rgba(220, 38, 38, 0.6);
    transition: transform 0.2s ease;
}
.gallery-card:hover .play-btn {
    transform: scale(1.1);
}
.zoom-overlay svg {
    color: #ffffff;
    opacity: 0.8;
}

.card-body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.card-title {
    font-size: 1.05rem;
    font-weight: 700;
    line-height: 1.35;
    margin-bottom: 0.5rem;
}
.card-title a {
    color: #0f172a;
    text-decoration: none;
    transition: color 0.2s ease;
}
.card-title a:hover {
    color: #1d4ed8;
}
.card-desc {
    color: #64748b;
    font-size: 0.85rem;
    line-height: 1.5;
    margin-bottom: 1.25rem;
}

.card-actions {
    margin-top: auto;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    padding-top: 0.85rem;
    border-top: 1px solid #f1f5f9;
}
.action-link-service {
    color: #10b981;
    font-size: 0.8rem;
    font-weight: 700;
    text-decoration: none;
    transition: color 0.2s ease;
}
.action-link-service:hover {
    color: #047857;
    text-decoration: underline;
}
.action-link-wa {
    color: #2563eb;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.2s ease;
}
.action-link-wa:hover {
    color: #1d4ed8;
    text-decoration: underline;
}
</style>
@endpush

@push('scripts')
<script>
function openMediaModal(type, url, title, beforeUrl) {
    const modal = document.getElementById('mediaModal');
    const container = document.getElementById('modalMediaContainer');
    const titleEl = document.getElementById('modalMediaTitle');
    
    titleEl.textContent = title;
    container.innerHTML = '';

    if (type === 'video') {
        container.innerHTML = `
            <video controls autoplay style="width:100%; max-height:70vh; object-fit:contain;">
                <source src="${url}" type="video/mp4">
                Browser Anda tidak mendukung pemutaran video.
            </video>
        `;
    } else if (beforeUrl && beforeUrl !== 'null' && beforeUrl !== '') {
        container.innerHTML = `
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; padding:1rem; width:100%;">
                <div style="text-align:center;">
                    <span style="background:#dc2626; color:#fff; font-size:0.75rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:4px; margin-bottom:0.5rem; display:inline-block;">SEBELUM (BEFORE)</span>
                    <img src="${beforeUrl}" style="width:100%; height:320px; object-fit:cover; border-radius:8px;">
                </div>
                <div style="text-align:center;">
                    <span style="background:#10b981; color:#fff; font-size:0.75rem; font-weight:700; padding:0.2rem 0.6rem; border-radius:4px; margin-bottom:0.5rem; display:inline-block;">SESUDAH (AFTER)</span>
                    <img src="${url}" style="width:100%; height:320px; object-fit:cover; border-radius:8px;">
                </div>
            </div>
        `;
    } else {
        container.innerHTML = `
            <img src="${url}" style="width:100%; max-height:70vh; object-fit:contain;">
        `;
    }

    modal.style.display = 'flex';
}

function closeMediaModal(e) {
    if (e.target.id === 'mediaModal') {
        forceCloseMediaModal();
    }
}

function forceCloseMediaModal() {
    const modal = document.getElementById('mediaModal');
    const container = document.getElementById('modalMediaContainer');
    container.innerHTML = '';
    modal.style.display = 'none';
}
</script>
@endpush
