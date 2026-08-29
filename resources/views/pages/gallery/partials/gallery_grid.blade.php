@if($galleries->isEmpty())
<div class="col-span-full text-center py-12 px-4 bg-white rounded-2xl border border-slate-200 shadow-sm max-w-md mx-auto my-6">
    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🔍</div>
    <h3 class="text-lg font-bold text-slate-800 mb-1">Tidak Ada Dokumentasi Ditemukan</h3>
    <p class="text-xs sm:text-sm text-slate-500 mb-5">Coba pilih kategori filter lainnya di atas untuk mengeksplorasi galeri riil kami.</p>
    <button type="button" onclick="resetGalleryFilter()" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-xl transition-all shadow-md shadow-blue-500/20">
        ✨ Lihat Semua Galeri
    </button>
</div>
@else
@foreach($galleries as $item)
<div class="gallery-card group bg-white rounded-xl sm:rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
    
    {{-- MEDIA THUMBNAIL CONTAINER --}}
    <div class="media-container relative aspect-[4/3] bg-slate-950 overflow-hidden cursor-pointer group" onclick="openMediaModal('{{ $item->media_type }}', '{{ $item->display_media }}', '{{ addslashes($item->title) }}', '{{ $item->display_before_image }}', '{{ urlencode($item->title) }}')">
        <img src="{{ $item->display_thumbnail }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        
        {{-- Badges Top Left --}}
        <div class="absolute top-2 left-2 flex flex-wrap gap-1 z-10 pointer-events-none">
            <span class="bg-slate-900/85 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-md shadow-sm">
                {{ $item->category_label }}
            </span>
            @if($item->media_type === 'video')
                <span class="bg-red-600/90 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-md shadow-sm flex items-center gap-1">
                    ▶ Video
                </span>
            @elseif($item->display_before_image)
                <span class="bg-emerald-600/90 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-md shadow-sm">
                    ⚖️ B&A
                </span>
            @endif
        </div>

        {{-- Location Tag Bottom Left --}}
        @if($item->location_tag)
        <div class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-sm text-slate-100 text-[10px] sm:text-xs font-medium px-2 py-0.5 rounded-md z-10 flex items-center gap-1 pointer-events-none">
            <span>📍</span> {{ $item->location_tag }}
        </div>
        @endif

        {{-- Play Icon Overlay for Videos / Zoom Overlay for Images --}}
        @if($item->media_type === 'video')
        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/15 transition-all flex items-center justify-center z-10">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg shadow-red-600/40 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
        </div>
        @else
        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-10">
            <div class="w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm text-slate-800 flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            </div>
        </div>
        @endif
    </div>

    {{-- CARD CONTENT --}}
    <div class="p-3 sm:p-4 flex flex-col flex-grow justify-between bg-white">
        <div>
            <h3 class="text-xs sm:text-sm font-bold text-slate-900 line-clamp-2 leading-snug hover:text-blue-600 transition-colors mb-1.5">
                <a href="{{ route('galeri.show', $item->slug) }}">
                    {{ $item->title }}
                </a>
            </h3>
            
            @if($item->description)
            <p class="text-[11px] sm:text-xs text-slate-500 line-clamp-2 leading-relaxed mb-3 hidden sm:block">
                {{ $item->description }}
            </p>
            @endif
        </div>

        {{-- CARD ACTIONS --}}
        <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between gap-1 text-[11px] font-semibold mt-auto">
            <a href="{{ route('galeri.show', $item->slug) }}" class="text-blue-600 hover:text-blue-800 font-bold truncate transition-colors flex items-center gap-0.5">
                <span>Studi Kasus</span> →
            </a>
            
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi mengenai pengerjaan serupa: ' . $item->title) }}" target="_blank" rel="noopener noreferrer" class="text-emerald-600 hover:text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-2 py-1 rounded-lg transition-colors flex items-center gap-1 font-bold shrink-0">
                <span>💬</span> <span class="hidden sm:inline">Konsultasi</span><span class="sm:hidden">WA</span>
            </a>
        </div>
    </div>

</div>
@endforeach
@endif
