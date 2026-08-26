@extends('layouts.app')
@section('title', 'Galeri & Dokumentasi')
@section('meta_description', 'Lihat galeri dan dokumentasi pengerjaan saluran mampet, instalasi pipa, dan sanitasi dari tim profesional Rootera.')

@push('styles')
<style>
    .gallery-filter-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 0.5rem;
        font-size: 0.8rem;
        font-weight: 700;
        transition: all 0.3s ease;
        background: transparent;
        color: #64748b; /* slate-500 */
        border: 1px solid #e2e8f0;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .gallery-filter-btn:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .gallery-filter-btn.active {
        background: #169F81;
        color: white;
        border-color: #169F81;
        box-shadow: 0 4px 6px -1px rgba(22, 159, 129, 0.3);
    }
    .gallery-item.hidden {
        display: none;
    }
</style>
@endpush

@section('content')

@php
    $featuredVideo = $photos->whereNotNull('youtube_id')->first();
    if (!$featuredVideo) {
        $featuredVideo = $photos->first();
    }
@endphp

<section class="relative pb-16 bg-white overflow-hidden" style="padding-top: 80px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-12 items-center">
            <!-- Left Side: Text Content -->
            <div class="pr-0 lg:pr-10">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded bg-teal-50 text-teal-600 font-extrabold text-[10px] tracking-widest uppercase mb-6">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    VISUAL ARCHIVES
                </div>
                <h1 class="font-['Plus_Jakarta_Sans'] text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.1] mb-6 tracking-tight text-[#0A111E]">
                    Dokumentasi<br>
                    <span style="color: #169F81;">Rootera</span>
                </h1>
                <p class="text-lg leading-relaxed text-slate-500 max-w-lg">
                    Menangkap setiap detail pengerjaan profesional kami, dari instalasi pipa hingga penanganan saluran mampet. Bukti nyata komitmen kami memberikan solusi tuntas dan berkualitas.
                </p>
            </div>

            <!-- Right Side: Featured Item -->
            @if($featuredVideo)
            <div class="relative w-full mt-10 lg:mt-0">
                <!-- Integrated Single Card -->
                <div class="relative overflow-hidden rounded-2xl bg-slate-900 border border-slate-700/50 shadow-2xl group w-full aspect-video">
                    <button type="button" class="video-modal-trigger block relative w-full h-full cursor-pointer text-left" data-youtube-id="{{ $featuredVideo->youtube_id }}">
                        
                        <!-- Thumbnail Image -->
                        <img src="{{ $featuredVideo->image_url }}" alt="{{ $featuredVideo->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105 z-0">
                        
                        <!-- Bottom Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent pointer-events-none z-10"></div>
                        
                        @if($featuredVideo->youtube_id)
                        <!-- Center Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                            <div class="w-16 h-16 rounded-full bg-teal-500/90 text-white flex items-center justify-center shadow-lg shadow-teal-500/30 backdrop-blur-md group-hover:scale-110 group-hover:bg-teal-400 transition-all duration-300 ring-4 ring-white/20">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 ml-1"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        @endif

                        <!-- Information Overlay (Bottom Left) -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-8 z-30 pointer-events-none">
                            <div class="flex items-center flex-wrap mb-2">
                                <span class="bg-teal-500/20 text-teal-300 border border-teal-500/30 text-[10px] px-2.5 py-1 rounded-md font-bold tracking-wider uppercase inline-block">{{ $featuredVideo->category ?? 'Sorotan Utama' }}</span>
                                <span class="text-slate-300 text-xs inline-block ml-3 font-medium">{{ $featuredVideo->created_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-white font-['Plus_Jakarta_Sans'] font-bold text-base md:text-lg lg:text-xl leading-snug line-clamp-2 drop-shadow-sm group-hover:text-teal-300 transition-colors">{{ $featuredVideo->title }}</h3>
                        </div>

                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<section id="explore" class="py-16 bg-white mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-16">
        
        @if($photos->isEmpty())
            <div class="text-center py-20 text-slate-500">
                <div class="text-5xl mb-4">📸</div>
                <p class="font-medium text-lg">Belum ada dokumentasi yang dipublikasikan.</p>
            </div>
        @else
            
            <!-- Filter Section -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8 border-b border-slate-100 mt-16 mb-8 pb-6">
                <!-- Title -->
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-[#169F81]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl lg:text-2xl text-[#0A111E] uppercase tracking-wide">
                        EXPLORE <span style="color: #169F81;">CATEGORIES</span>
                    </h2>
                </div>
                
                {{-- Filter Tabs --}}
                @if(count($categories) > 0)
                <div class="flex flex-wrap gap-2.5" id="gallery-filters">
                    <button class="gallery-filter-btn active" data-filter="all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Semua
                    </button>
                    @foreach($categories as $cat)
                        <button class="gallery-filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Gallery Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 mt-12 mb-24" id="gallery-grid">
                @foreach($photos as $photo)
                @if($featuredVideo && $photo->id === $featuredVideo->id) @continue @endif
                
                <div class="gallery-item" data-category="{{ $photo->category ? Str::slug($photo->category) : 'uncategorized' }}">
                    <button type="button" class="video-modal-trigger w-full text-left bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group hover:-translate-y-1" data-youtube-id="{{ $photo->youtube_id }}">
                        
                        <!-- Media Thumbnail -->
                        <div class="relative aspect-video w-full overflow-hidden bg-slate-900">
                            <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                            
                            @if($photo->youtube_id)
                            <!-- Play Button Overlay -->
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center pointer-events-none">
                                <div class="w-12 h-12 rounded-full bg-white/90 text-teal-600 flex items-center justify-center shadow-md backdrop-blur group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 ml-1"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Card Content -->
                        <div class="p-5 flex flex-col flex-grow justify-between gap-3 w-full">
                            <div class="flex items-center justify-between text-xs text-slate-500 w-full">
                                <span class="px-2.5 py-1 rounded-full font-semibold uppercase text-[11px] bg-teal-50 text-teal-700 tracking-wide">{{ $photo->category ?? 'Dokumentasi' }}</span>
                                <span class="flex items-center gap-1 text-slate-400 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $photo->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-slate-800 text-base leading-snug group-hover:text-[#169F81] transition-colors line-clamp-2">{{ $photo->title }}</h3>
                        </div>
                        
                    </button>
                </div>
                @endforeach
            </div>
            
            <!-- Load More -->
            <div class="mt-20 mb-28 text-center">
                <button class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-teal-600 text-teal-600 font-medium hover:bg-teal-600 hover:text-white transition-all shadow-sm hover:shadow-md">
                    Eksplorasi Lebih Banyak
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </div>
        @endif
    </div>
</section>

<section>
    <!-- Custom Video Modal -->
    <div id="nativeVideoModal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <!-- Close Button -->
        <button id="closeVideoModalBtn" class="absolute top-6 right-6 lg:top-8 lg:right-8 text-white/70 hover:text-white transition-colors p-2 rounded-full bg-white/10 hover:bg-white/20">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        
        <div class="w-full max-w-5xl px-4 lg:px-8">
            <!-- Container Modal Responsive 16:9 -->
            <div class="relative w-full aspect-video rounded-xl overflow-hidden bg-black shadow-2xl ring-1 ring-white/10">
                <iframe 
                    id="youtubePlayerIframe"
                    class="w-full h-full absolute inset-0"
                    src="" 
                    title="YouTube video player" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- NATIVE VIDEO MODAL LOGIC ---
    const modal = document.getElementById('nativeVideoModal');
    const iframe = document.getElementById('youtubePlayerIframe');
    const closeBtn = document.getElementById('closeVideoModalBtn');
    const triggers = document.querySelectorAll('.video-modal-trigger');
    
    function openModal(youtubeId) {
        if(!youtubeId) return;
        // Gunakan parameter embed resmi untuk mencegah error "unavailable"
        iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0&modestbranding=1`;
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal.classList.remove('opacity-100', 'pointer-events-auto');
        modal.classList.add('opacity-0', 'pointer-events-none');
        iframe.src = ''; // Hentikan video saat modal ditutup
        document.body.style.overflow = '';
    }
    
    triggers.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const yId = this.getAttribute('data-youtube-id');
            openModal(yId);
        });
    });
    
    closeBtn.addEventListener('click', closeModal);
    
    // Tutup jika background gelap diklik
    modal.addEventListener('click', function(e) {
        if(e.target === modal) {
            closeModal();
        }
    });
    
    // Tutup dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if(e.key === 'Escape' && modal.classList.contains('opacity-100')) {
            closeModal();
        }
    });

    // --- FILTERING LOGIC ---
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    if(filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                galleryItems.forEach(item => {
                    if(filterValue === 'all') {
                        item.classList.remove('hidden');
                        item.style.animation = 'fadeIn 0.5s ease forwards';
                    } else {
                        if(item.getAttribute('data-category') === filterValue) {
                            item.classList.remove('hidden');
                            item.style.animation = 'fadeIn 0.5s ease forwards';
                        } else {
                            item.classList.add('hidden');
                        }
                    }
                });
            });
        });
    }
});

// Add keyframes for filtering animation dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>
@endpush
