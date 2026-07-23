@extends('layouts.app')
@section('title', 'Galeri & Portofolio')
@section('meta_description', 'Lihat galeri dan portofolio pengerjaan saluran mampet, instalasi pipa, dan sanitasi dari tim profesional ROOTERA.')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    .gallery-filter-btn {
        padding: 0.6rem 1.25rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid transparent;
        cursor: pointer;
    }
    .gallery-filter-btn:hover {
        background: #e2e8f0;
        color: #334155;
    }
    .gallery-filter-btn.active {
        background: #169F81; /* ROOTERA Accent */
        color: white;
        box-shadow: 0 4px 6px -1px rgba(22, 159, 129, 0.2);
    }
    .gallery-card {
        display: block;
        border-radius: 1rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        position: relative;
    }
    .gallery-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        transform: translateY(-4px);
    }
    .gallery-card-img-wrapper {
        position: relative;
        width: 100%;
        padding-top: 75%; /* 4:3 Aspect Ratio */
        overflow: hidden;
    }
    .gallery-card-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-card:hover .gallery-card-img {
        transform: scale(1.08);
    }
    .gallery-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 10;
        pointer-events: none;
    }
    .gallery-card-body {
        padding: 1.25rem;
    }
    .gallery-card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.35rem;
    }
    .gallery-card-desc {
        font-size: 0.875rem;
        color: #64748b;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    /* Hidden items during filtering */
    .gallery-item.hidden {
        display: none;
    }
</style>
@endpush

@section('content')
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden">
    {{-- Bottom Wave --}}
    <div style="position:absolute;bottom:0;left:0;width:100%;height:100px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.15"></path>
            <path d="M0,80 C360,10 720,110 1080,30 C1260,20 1360,70 1440,80 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.25"></path>
            <path d="M0,50 C240,90 480,20 840,90 C1100,130 1280,50 1440,70 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.40"></path>
            <path d="M0,90 C360,130 720,40 1080,110 C1260,130 1360,100 1440,90 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>

    <div class="container text-center" style="position:relative;z-index:2">
        <h1 style="color:#fff;margin-bottom:.75rem">Galeri & <span style="color:#6ee7cc">Portofolio</span></h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:600px;margin:0 auto">Lihat langsung hasil pekerjaan profesional tim ROOTERA di lapangan. Dari instalasi pipa hingga penanganan saluran mampet berat.</p>
    </div>
</div>

<section class="section" style="padding: 4rem 0 6rem; background: #fafafa;">
    <div class="container">
        
        @if($photos->isEmpty())
            <div class="text-center" style="padding:4rem 0;color:#6b7280">
                <div style="font-size:3rem;margin-bottom:1rem">📸</div>
                <p>Belum ada foto galeri yang dipublikasikan.</p>
            </div>
        @else
            
            {{-- Filter Tabs --}}
            @if(count($categories) > 0)
            <div class="flex flex-wrap justify-center gap-3 mb-10" id="gallery-filters">
                <button class="gallery-filter-btn active" data-filter="all">Semua Foto</button>
                @foreach($categories as $cat)
                    <button class="gallery-filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
                @endforeach
            </div>
            @endif

            {{-- Gallery Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="gallery-grid">
                @foreach($photos as $photo)
                <div class="gallery-item" data-category="{{ $photo->category ? Str::slug($photo->category) : 'uncategorized' }}">
                    <a href="{{ $photo->image_url }}" class="gallery-card glightbox" data-gallery="portfolio" data-title="{{ $photo->title }}" data-description="{{ $photo->description }}">
                        <div class="gallery-card-img-wrapper">
                            @if($photo->category)
                                <span class="gallery-badge">{{ $photo->category }}</span>
                            @endif
                            <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" class="gallery-card-img" loading="lazy">
                        </div>
                        <div class="gallery-card-body">
                            <h3 class="gallery-card-title">{{ $photo->title }}</h3>
                            @if($photo->description)
                                <p class="gallery-card-desc">{{ Str::limit($photo->description, 70) }}</p>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize GLightbox
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        zoomable: true,
        descPosition: 'bottom'
    });

    // Filtering Logic
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
                    } else {
                        if(item.getAttribute('data-category') === filterValue) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    }
                });
                
                // Reload GLightbox so only visible items are navigable
                lightbox.reload();
            });
        });
    }
});
</script>
@endpush
