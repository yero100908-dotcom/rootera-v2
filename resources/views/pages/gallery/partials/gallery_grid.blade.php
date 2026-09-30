@if($galleries->isEmpty())
<div class="col-span-full text-center py-16 px-6 bg-slate-900/50 rounded-3xl border border-slate-800 shadow-xl max-w-lg mx-auto my-8">
    <div class="w-16 h-16 bg-slate-800 text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl shadow-inner border border-slate-700">
        🔬
    </div>
    <h3 class="text-xl font-extrabold text-white mb-2">Tidak Ada Dokumentasi Ditemukan</h3>
    <p class="text-xs sm:text-sm text-slate-400 mb-6 leading-relaxed">
        Belum ada laporan studi kasus untuk kategori ini. Silakan pilih kategori filter lain di atas untuk melihat dokumentasi pengerjaan riil.
    </p>
    <button type="button" onclick="resetGalleryFilter()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs sm:text-sm font-extrabold rounded-xl transition-all shadow-lg shadow-emerald-500/20 active:scale-95">
        ✨ Tampilkan Semua Studi Kasus
    </button>
</div>
@else
@foreach($galleries as $item)
<?php
    $realLocation = !empty($item->location_tag) ? $item->location_tag : (!empty($item->related_area_name) ? $item->related_area_name : 'Jabodetabek');
    $displayThumb = $item->display_thumbnail;
?>
<div class="gallery-card group bg-white rounded-2xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col h-full">
    
    {{-- MEDIA THUMBNAIL CONTAINER --}}
    <div class="media-container relative aspect-[16/10] bg-slate-950 border-b border-slate-100 overflow-hidden cursor-pointer group" 
         onclick="openMediaModal('{{ $item->media_type }}', '{{ $item->display_media }}', '{{ addslashes($item->title) }}', '{{ $item->display_before_image }}', '{{ urlencode($item->title) }}')">
        
        <img src="{{ $displayThumb }}" 
             alt="Dokumentasi Pekerjaan - {{ $item->title }}" 
             title="{{ $item->title }} - Rootera Plumbing" 
             class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105" 
             loading="lazy" 
             decoding="async"
             onerror="this.onerror=null;this.src='{{ asset('images/JnJ.jpeg') }}';">
        
        {{-- BADGES TOP LEFT --}}
        <div class="absolute top-2.5 left-2.5 flex flex-wrap gap-1.5 z-10 pointer-events-none">
            <span class="bg-slate-950/90 backdrop-blur-md text-emerald-400 border border-emerald-500/30 text-[10px] font-extrabold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-md">
                🏷️ {{ $item->category_label }}
            </span>
            @if($item->media_type === 'video')
                <span class="bg-rose-600/90 backdrop-blur-md text-white text-[10px] font-black px-2.5 py-1 rounded-md shadow-md flex items-center gap-1">
                    ▶ Video Reel
                </span>
            @elseif($item->display_before_image)
                <span class="bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-black px-2.5 py-1 rounded-md shadow-md">
                    ⚖️ Before-After
                </span>
            @endif
        </div>

        {{-- LOCATION TAG TOP RIGHT --}}
        <div class="absolute top-2.5 right-2.5 bg-emerald-600/90 backdrop-blur-md text-white text-[10px] font-extrabold px-2.5 py-1 rounded-md z-10 flex items-center gap-1 shadow-md pointer-events-none">
            📍 {{ $realLocation }}
        </div>

        {{-- HOVER OVERLAY & INTERACTION ICON --}}
        @if($item->media_type === 'video')
        <div class="absolute inset-0 bg-slate-950/40 group-hover:bg-slate-950/20 transition-all flex items-center justify-center z-10">
            <div class="w-11 h-11 rounded-full bg-rose-600 text-white flex items-center justify-center shadow-xl shadow-rose-600/40 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
        </div>
        @else
        <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
            <span class="bg-emerald-500 hover:bg-emerald-400 text-white text-xs font-black px-3.5 py-1.5 rounded-full shadow-lg flex items-center gap-1.5 transform group-hover:scale-105 transition-transform">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                <span>Pratinjau Foto</span>
            </span>
        </div>
        @endif
    </div>

    {{-- CARD BODY CONTENT --}}
    <div class="p-4 flex flex-col flex-grow justify-between bg-white">
        <div>
            <h3 class="text-sm font-bold text-slate-900 leading-snug group-hover:text-emerald-600 transition-colors mb-2 line-clamp-2">
                <a href="{{ route('galeri.show', $item->slug) }}" class="text-inherit no-underline">
                    {{ $item->title }}
                </a>
            </h3>
            
            @if($item->description)
            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-3">
                {{ $item->description }}
            </p>
            @endif

            {{-- TECHNICAL PARAMETER BADGES GRID --}}
            <div class="flex flex-wrap gap-1.5 mb-3">
                @if($item->tool_used)
                    <span class="bg-blue-50 text-blue-700 border border-blue-200/80 text-[10px] font-bold px-2 py-0.5 rounded-md flex items-center gap-1" title="Peralatan Utama">
                        🛠️ <span class="truncate max-w-[110px]">{{ $item->tool_used }}</span>
                    </span>
                @endif
                @if($item->pipe_specs)
                    <span class="bg-slate-100 text-slate-700 border border-slate-200 text-[10px] font-semibold px-2 py-0.5 rounded-md flex items-center gap-1" title="Dimensi Pipa">
                        📏 {{ $item->pipe_specs }} @if($item->pipe_length)({{ $item->pipe_length }})@endif
                    </span>
                @endif
                @if($item->completion_time)
                    <span class="bg-purple-50 text-purple-700 border border-purple-200/80 text-[10px] font-semibold px-2 py-0.5 rounded-md flex items-center gap-1" title="Durasi Pengerjaan">
                        ⏱️ {{ $item->completion_time }}
                    </span>
                @endif
                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/80 text-[10px] font-extrabold px-2 py-0.5 rounded-md flex items-center gap-1">
                    🛡️ Garansi {{ $item->warranty_days ?? 30 }} Hari
                </span>
            </div>

            @if($item->technical_diagnosis)
                <div class="text-[11px] text-slate-600 bg-amber-50/80 border border-amber-200/70 p-2 rounded-xl mb-3 line-clamp-2 leading-relaxed">
                    <span class="font-extrabold text-amber-900">🔬 Diagnosa CCTV:</span> {{ $item->technical_diagnosis }}
                </div>
            @endif
        </div>

        {{-- CARD FOOTER ACTIONS --}}
        <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 text-xs font-bold mt-auto">
            <a href="{{ route('galeri.show', $item->slug) }}" class="text-slate-700 hover:text-emerald-600 transition-colors flex items-center gap-1 no-underline">
                <span>Laporan Teknis</span>
                <span>→</span>
            </a>
            
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya membaca laporan studi kasus [' . $item->title . ']. Saya memiliki kendala pipa serupa dan ingin konsultasi/panggil teknisi.') }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="bg-emerald-100 hover:bg-emerald-500 text-emerald-800 hover:text-white px-3 py-1 rounded-full transition-all duration-200 no-underline shrink-0 flex items-center gap-1 shadow-xs">
                <span>💬 Konsultasi</span>
            </a>
        </div>
    </div>

</div>
@endforeach
@endif
