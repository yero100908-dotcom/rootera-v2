@extends('layouts.app')
@section('content')

<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden">
    {{-- Bottom Wave --}}
    <div style="position:absolute;bottom:0;left:0;width:100%;height:60px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#ffffff"></path>
        </svg>
    </div>
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
