@props([
    'beforeImage' => null,
    'afterImage' => null,
    'title' => 'Komparasi Sebelum & Sesudah Pengerjaan',
    'aspectRatio' => 'aspect-[16/10]',
    'class' => '',
])

@php
    $before = $beforeImage ?: asset('images/JnJ.jpeg');
    $after = $afterImage ?: asset('images/ridgid.jpeg');
@endphp

<div x-data="{ 
        sliderPosition: 50, 
        isDragging: false,
        updatePosition(e) {
            if (!$refs.container) return;
            const rect = $refs.container.getBoundingClientRect();
            let clientX = e.clientX;
            if (e.touches && e.touches[0]) {
                clientX = e.touches[0].clientX;
            }
            if (clientX === undefined) return;
            let x = clientX - rect.left;
            if (x < 0) x = 0;
            if (x > rect.width) x = rect.width;
            this.sliderPosition = Math.max(0, Math.min(100, (x / rect.width) * 100));
        }
    }" 
    x-ref="container"
    @mousedown="isDragging = true; updatePosition($event)"
    @mouseup="isDragging = false"
    @mouseleave="isDragging = false"
    @mousemove="if (isDragging) updatePosition($event)"
    @touchstart="isDragging = true; updatePosition($event)"
    @touchend="isDragging = false"
    @touchmove="if (isDragging) updatePosition($event)"
    class="relative w-full {{ $aspectRatio }} overflow-hidden rounded-2xl sm:rounded-3xl border border-slate-800 bg-slate-950 select-none cursor-ew-resize shadow-2xl group {{ $class }}">
    
    {{-- AFTER IMAGE (Background Layer - 100% Width) --}}
    <img src="{{ $after }}" 
         alt="Hasil Sesudah Pengerjaan - {{ $title }}" 
         title="Hasil Sesudah Pengerjaan - {{ $title }}" 
         class="absolute inset-0 w-full h-full object-cover pointer-events-none" 
         onerror="this.onerror=null;this.src='{{ asset('images/ridgid.jpeg') }}';">
    
    {{-- AFTER BADGE --}}
    <span class="absolute top-3 right-3 z-10 bg-emerald-600/90 text-white border border-emerald-400/30 text-[10px] sm:text-xs font-black px-2.5 py-1 rounded-md uppercase tracking-wider backdrop-blur-md shadow-lg pointer-events-none">
        ✓ SESUDAH (100% LANCAR)
    </span>

    {{-- BEFORE IMAGE (Clipped Foreground Layer) --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none" 
         :style="'width: ' + sliderPosition + '%'">
        <img src="{{ $before }}" 
             alt="Kondisi Sebelum Pengerjaan - {{ $title }}" 
             title="Kondisi Sebelum Pengerjaan - {{ $title }}" 
             class="absolute top-0 left-0 w-full h-full object-cover max-w-none" 
             :style="'width: ' + ($refs.container ? $refs.container.offsetWidth + 'px' : '100%')"
             onerror="this.onerror=null;this.src='{{ asset('images/JnJ.jpeg') }}';">
        
        {{-- BEFORE BADGE --}}
        <span class="absolute top-3 left-3 z-10 bg-rose-600/90 text-white border border-rose-400/30 text-[10px] sm:text-xs font-black px-2.5 py-1 rounded-md uppercase tracking-wider backdrop-blur-md shadow-lg pointer-events-none">
            ⚠️ SEBELUM (MAMPET)
        </span>
    </div>

    {{-- SLIDER CONTROL LINE & HANDLE --}}
    <div class="absolute top-0 bottom-0 w-1 bg-white shadow-[0_0_12px_rgba(255,255,255,0.8)] z-20 pointer-events-none transition-transform duration-75"
         :style="'left: ' + sliderPosition + '%'">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-900 border-2 border-white text-white flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform">
            <svg class="w-5 h-5 text-emerald-400 fill-current" viewBox="0 0 24 24">
                <path d="M8.5 16.5L4 12l4.5-4.5v9zm7 0v-9l4.5 4.5-4.5 4.5z"/>
            </svg>
        </div>
    </div>

    {{-- HELPER TOUCH INSTRUCTION OVERLAY --}}
    <div x-show="sliderPosition === 50" 
         x-transition:leave="transition opacity duration-300 pointer-events-none" 
         class="absolute bottom-3 left-1/2 -translate-x-1/2 bg-slate-900/80 backdrop-blur-md border border-white/20 text-slate-200 text-[10px] sm:text-xs font-semibold px-3 py-1 rounded-full pointer-events-none shadow-md">
        👈 Geser Tuas untuk Komparasi 👉
    </div>
</div>
