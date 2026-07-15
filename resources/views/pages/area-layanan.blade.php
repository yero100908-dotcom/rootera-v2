@extends('layouts.app')
@section('content')

<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden">
    {{-- Bottom Wave --}}
    <div style="position:absolute;bottom:0;left:0;width:100%;height:60px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#ffffff"></path>
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
                        <h3 itemprop="name" style="margin-bottom:.1rem;font-size:1.1rem">{{ $area->name }}</h3>
                        @if($area->province)
                        <span style="font-size:.82rem;color:#9ca3af">{{ $area->province }}</span>
                        @endif
                    </div>
                </div>
                @if($area->description)
                <p itemprop="description">{{ $area->description }}</p>
                @endif
                <a href="https://wa.me/6281385404000?text=Halo%20ROOTERA%2C%20saya%20di%20area%20{{ urlencode($area->name) }}%20butuh%20layanan%20pipa%20mampet." class="btn btn-primary" style="margin-top:1rem;font-size:.88rem" target="_blank" rel="noopener">
                    Pesan di {{ $area->name }}
                </a>
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
        <div style="border-radius:20px;overflow:hidden;box-shadow:0 8px 32px rgba(10,46,120,.12);height:400px">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.66025265827!2d106.68987808984375!3d-6.229728899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1720000000000"
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
    </div>
</section>

@include('sections.home.cta-banner')
@endsection
