@extends('layouts.app')
@section('content')

<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden">
    {{-- Bottom Wave --}}
    <div style="position:absolute;bottom:0;left:0;width:100%;height:100px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <!-- Layer 4 (Backmost - 15% Opacity) -->
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.15"></path>
            <!-- Layer 3 (Behind Middle - 25% Opacity) -->
            <path d="M0,80 C360,10 720,110 1080,30 C1260,20 1360,70 1440,80 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.25"></path>
            <!-- Layer 2 (Middle - 40% Opacity) -->
            <path d="M0,50 C240,90 480,20 840,90 C1100,130 1280,50 1440,70 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.40"></path>
            <!-- Layer 1 (Front - Full Opacity) -->
            <path d="M0,90 C360,130 720,40 1080,110 C1260,130 1360,100 1440,90 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>

    {{-- Fluid Smooth Wavy Lines (Rich Pattern) --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:1;opacity:0.1" aria-hidden="true">
        <defs>
            <linearGradient id="hero-fluid-wave-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#20b2aa" />
                <stop offset="100%" stop-color="#6495ed" />
            </linearGradient>
        </defs>
        <!-- Line 1: Thick continuous path -->
        <path d="M-100,80 C300,260 600,-40 1000,180 C1200,290 1400,120 1600,220" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="3"></path>
        <!-- Line 2: Medium continuous path -->
        <path d="M-50,140 C350,300 650,40 950,220 C1150,320 1350,160 1550,260" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="2"></path>
        <!-- Line 3: Thin continuous path -->
        <path d="M-120,200 C200,80 500,280 800,100 C1100,20 1300,240 1600,120" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="1"></path>
        <!-- Line 4: Dash pattern 1 -->
        <path d="M-150,30 C250,170 550,-100 900,120 C1100,220 1300,80 1500,170" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="1.5" stroke-dasharray="5,5"></path>
        <!-- Line 5: Dash pattern 2 -->
        <path d="M-80,240 C280,360 620,120 920,280 C1220,400 1380,180 1580,290" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="2" stroke-dasharray="8,4"></path>
        <!-- Line 6: Diagonal intersecting sweep -->
        <path d="M-200,280 C100,80 400,20 800,180 C1100,300 1300,120 1650,50" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="1.5"></path>
    </svg>

    <div class="container text-center" style="position:relative;z-index:2">
        <h1 style="color:#fff;margin-bottom:.75rem">Area <span style="color:#6ee7cc">Layanan</span></h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:550px;margin:0 auto">Tim ROOTERA telah menjangkau berbagai kota besar di Indonesia untuk melayani kebutuhan pipa dan sanitasi Anda.</p>
    </div>
</div>

<section class="section" aria-labelledby="areas-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-green">Wilayah Kami</span>
            <h2 class="section-title" id="areas-heading" style="margin-top:.75rem">Kota yang <span>Kami Layani</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem">
            @php $areaColors=['#0A2E78','#169F81','#1E73D8','#0d3a94','#1dbf9e','#1a6fcc']; @endphp
            @foreach($areas as $i => $area)
            <article class="service-card fade-in" style="animation-delay:{{ $i * 0.08 }}s" itemscope itemtype="https://schema.org/Place">
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
                    @if($area->image)
                        <img src="{{ Storage::url($area->image) }}" alt="{{ $area->name }}" style="width:56px;height:56px;border-radius:12px;object-fit:cover" loading="lazy">
                    @else
                        <div style="width:56px;height:56px;border-radius:12px;background:{{ $areaColors[$i % 6] }};display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff;flex-shrink:0">
                            📍
                        </div>
                    @endif
                    <div>
                        <h3 itemprop="name" style="margin-bottom:.1rem;font-size:1.1rem">
                            <a href="{{ route('area-layanan.show', $area->slug) }}" style="color:inherit;text-decoration:none;" class="hover:underline">{{ $area->name }}</a>
                        </h3>
                        @if($area->province)
                        <span style="font-size:.82rem;color:#9ca3af">{{ $area->province }}</span>
                        @endif
                    </div>
                </div>
                @if($area->description)
                <p itemprop="description">{{ $area->description }}</p>
                @endif
                <div style="display:flex;gap:0.75rem;margin-top:1rem">
                    <a href="https://wa.me/6281385404000?text=Halo%20ROOTERA%2C%20saya%20di%20area%20{{ urlencode($area->name) }}%20butuh%20layanan%20pipa%20mampet." class="btn btn-primary" style="font-size:.85rem;flex:1;padding:.6rem 1rem;justify-content:center" target="_blank" rel="noopener">
                        Pesan WA
                    </a>
                    <a href="{{ route('area-layanan.show', $area->slug) }}" class="btn btn-secondary" style="font-size:.85rem;flex:1;padding:.6rem 1rem;border:2px solid var(--blue);color:var(--blue);background:transparent;justify-content:center">
                        Info Detail
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- Maps Section --}}
<section class="section bg-offwhite" aria-labelledby="map-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:2.5rem">
            <span class="badge badge-blue">Lokasi Kami</span>
            <h2 class="section-title" id="map-heading" style="margin-top:.75rem">Temukan <span>Kami di Peta</span></h2>
        </div>
        <div style="border-radius:20px;overflow:hidden;box-shadow:0 8px 32px rgba(10,46,120,.12);height:400px;margin-bottom:2rem">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.4124978809493!2d106.8627125!3d-6.3275975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTknMzkuMyJTIDEwNsKwNTEnNDU4Ijg3RSI!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                width="100%"
                height="400"
                style="border:0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi layanan ROOTERA"
                aria-label="Peta area layanan ROOTERA"
            ></iframe>
        </div>
        
        {{-- Official Business Address Card --}}
        <a href="https://www.google.com/maps/dir/?api=1&destination=-6.3275975,106.8627125" target="_blank" rel="noopener noreferrer" style="text-decoration:none;display:block;max-width:700px;margin:0 auto;">
            <div style="text-align:center;font-family:'Plus Jakarta Sans',sans-serif;background:#fff;padding:1.5rem 2rem;border-radius:16px;box-shadow:0 4px 20px rgba(10,46,120,.05);border:1px solid #edf2f7;transition:transform 0.2s,box-shadow 0.2s;cursor:pointer" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 30px rgba(10,46,120,.1)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(10,46,120,.05)';">
                <div style="display:flex;align-items:center;justify-content:center;gap:0.5rem;margin-bottom:0.5rem">
                    <span style="font-size:1.25rem">📍</span>
                    <strong style="font-size:1.1rem;color:#0A2E78">Rootera Plumbing - Jasa Saluran Pipa Mampet</strong>
                </div>
                <p style="font-size:0.95rem;line-height:1.6;color:#4b5563;margin:0 0 1rem 0">
                    Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13770
                </p>
                <div style="display:inline-flex;align-items:center;gap:0.5rem;background:#169F81;color:#fff;padding:0.6rem 1.25rem;border-radius:30px;font-size:0.875rem;font-weight:700;transition:background 0.2s" onmouseover="event.stopPropagation();this.style.background='#117c64'" onmouseout="event.stopPropagation();this.style.background='#169F81'">
                    <span>🚗 Petunjuk Arah (Maps)</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </div>
            </div>
        </a>
    </div>
</section>

@include('sections.home.cta-banner')
@endsection
