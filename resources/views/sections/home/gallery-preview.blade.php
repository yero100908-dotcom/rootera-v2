<section id="galeri-kerja-nyata" class="w-full relative py-20 overflow-hidden style="background: #f8fafc;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- HEADER --}}
        <div class="text-center mb-16">
            <span style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; font-size: 0.8rem; font-weight: 800; padding: 0.35rem 1rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 1rem;">
                📹 BUKTI DOKUMENTASI &amp; VIDEO PENGERJAAN
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0b2b64] tracking-tight leading-tight">
                Galeri Hasil <span style="background: linear-gradient(90deg, #0b2b64, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Kerja Nyata Kami</span>
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto">
                Bukti otentik video aksi teknisi di lapangan, komparasi *Before/After*, &amp; performa hydro-jetting tanpa rekayasa.
            </p>
        </div>

        {{-- HYBRID CARDS GRID --}}
        @if(isset($hybridGalleries) && $hybridGalleries->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($hybridGalleries as $item)
            <div style="background: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03); transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column;" class="hover:-translate-y-2 hover:shadow-xl group">
                
                {{-- MEDIA THUMBNAIL CONTAINER --}}
                <div style="position: relative; width: 100%; aspect-ratio: 16/9; background: #0f172a; overflow: hidden;" onclick="openHomeMediaModal('{{ $item->media_type }}', '{{ $item->display_media }}', '{{ addslashes($item->title) }}')">
                    <img src="{{ $item->display_thumbnail }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy">
                    
                    {{-- Badges --}}
                    <div style="position: absolute; top: 0.75rem; left: 0.75rem; display: flex; gap: 0.4rem; z-index: 2;">
                        <span style="background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(4px); color: #ffffff; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 6px; text-transform: uppercase;">
                            {{ $item->category_label }}
                        </span>
                        @if($item->media_type === 'video')
                        <span style="background: #dc2626; color: #ffffff; font-size: 0.7rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 6px;">
                            ▶ Video Riil
                        </span>
                        @endif
                    </div>

                    @if($item->location_tag)
                    <div style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); color: #ffffff; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.6rem; border-radius: 6px; z-index: 2;">
                        📍 {{ $item->location_tag }}
                    </div>
                    @endif

                    @if($item->media_type === 'video')
                    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; items-center: center; justify-content: center; z-index: 2; transition: opacity 0.3s ease;">
                        <div style="width: 52px; height: 52px; border-radius: 50%; background: #dc2626; color: #ffffff; display: flex; items-center: center; justify-content: center; box-shadow: 0 0 20px rgba(220,38,38,0.6);" class="group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- CONTENT --}}
                <div style="padding: 1.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="font-size: 1.05rem; font-weight: 800; line-height: 1.35; margin-bottom: 0.5rem;">
                        <a href="{{ route('galeri.show', $item->slug) }}" style="color: #0f172a; text-decoration: none;" class="hover:text-emerald-600">
                            {{ $item->title }}
                        </a>
                    </h3>
                    
                    @if($item->description)
                    <p style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.25rem;">
                        {{ Str::limit($item->description, 100) }}
                    </p>
                    @endif

                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; items-center: center;">
                        <a href="{{ route('galeri.show', $item->slug) }}" style="color: #0b2b64; font-size: 0.82rem; font-weight: 800; text-decoration: none;">
                            Lihat Detail Proyek →
                        </a>
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya tertarik dengan pengerjaan proyek: ' . $item->title) }}" target="_blank" rel="noopener noreferrer" style="color: #10b981; font-size: 0.82rem; font-weight: 800; text-decoration: none;">
                            💬 Konsultasi
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('galeri') }}" style="background: linear-gradient(90deg, #0b2b64, #059669); color: #ffffff; text-decoration: none; padding: 0.95rem 2rem; border-radius: 12px; font-weight: 800; font-size: 0.95rem; display: inline-flex; items-center: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(11,43,100,0.25);" class="hover:scale-105 transition-all">
                Lihat Seluruh Galeri &amp; Dokumentasi Video (100% Real) →
            </a>
        </div>

    </div>
</section>

{{-- MODAL MEDIA PLAYER --}}
<div id="homeMediaModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;" onclick="closeHomeMediaModal(event)">
    <div style="position: relative; width: 100%; max-width: 900px; background: #0f172a; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);" onclick="event.stopPropagation()">
        <div style="display: flex; justify-content: space-between; items-center: center; padding: 1rem 1.5rem; background: #1e293b;">
            <h4 id="homeModalTitle" style="color: #fff; font-weight: 700; font-size: 1rem; margin: 0;"></h4>
            <button type="button" onclick="forceCloseHomeMediaModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.75rem; cursor: pointer;">&times;</button>
        </div>
        <div id="homeModalContainer" style="width: 100%; min-height: 350px; background: #000; display: flex; items-center: center; justify-content: center;"></div>
    </div>
</div>

<script>
function openHomeMediaModal(type, url, title) {
    const modal = document.getElementById('homeMediaModal');
    const container = document.getElementById('homeModalContainer');
    const titleEl = document.getElementById('homeModalTitle');
    titleEl.textContent = title;
    container.innerHTML = '';

    if (type === 'video') {
        container.innerHTML = `<video controls autoplay style="width:100%; max-height:70vh; object-fit:contain;"><source src="${url}" type="video/mp4">Browser tidak mendukung pemutaran video.</video>`;
    } else {
        container.innerHTML = `<img src="${url}" style="width:100%; max-height:70vh; object-fit:contain;">`;
    }
    modal.style.display = 'flex';
}

function closeHomeMediaModal(e) {
    if (e.target.id === 'homeMediaModal') forceCloseHomeMediaModal();
}
function forceCloseHomeMediaModal() {
    document.getElementById('homeModalContainer').innerHTML = '';
    document.getElementById('homeMediaModal').style.display = 'none';
}
</script>
