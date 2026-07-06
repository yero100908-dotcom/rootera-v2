@extends('layouts.app')
@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 4rem;position:relative;overflow:hidden">
    <div class="container text-center" style="position:relative;z-index:1">
        <h1 style="color:#fff;margin-bottom:.75rem">Tentang <span style="color:#6ee7cc">ROOTERA</span></h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:550px;margin:0 auto">Tim profesional yang berdedikasi untuk memberikan solusi pipa terbaik bagi rumah dan bisnis Anda.</p>
    </div>
</div>

{{-- Profil --}}
<section class="section" aria-labelledby="about-profile">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center">
            <div>
                <span class="badge badge-green" style="margin-bottom:1rem">Profil Perusahaan</span>
                <h2 id="about-profile" class="section-title" style="text-align:left;margin-bottom:1rem">
                    Solusi Pipa <span>Profesional</span> Indonesia
                </h2>
                <p style="color:#4b5563;margin-bottom:1rem;line-height:1.8">ROOTERA adalah perusahaan jasa cleaning service pipa dan sanitasi terpercaya yang telah melayani ribuan pelanggan di seluruh Indonesia. Kami hadir dengan misi memberikan solusi cepat, aman, dan terjangkau untuk setiap masalah saluran dan pipa Anda.</p>
                <p style="color:#4b5563;margin-bottom:2rem;line-height:1.8">Dengan teknologi non-destruktif terkini dan tim teknisi bersertifikat, ROOTERA memastikan setiap pekerjaan diselesaikan dengan standar kualitas tertinggi — tanpa perlu membongkar dinding atau struktur bangunan.</p>
                <div style="display:flex;flex-direction:column;gap:1rem">
                    <div style="background:#f0faf8;border-left:4px solid #169F81;padding:1rem 1.25rem;border-radius:0 8px 8px 0">
                        <strong style="color:#0A2E78;display:block;margin-bottom:.25rem">🎯 Visi</strong>
                        <span style="font-size:.92rem;color:#4b5563">Menjadi perusahaan jasa pipa terdepan dan terpercaya di Indonesia dengan layanan berkualitas internasional.</span>
                    </div>
                    <div style="background:#eff6ff;border-left:4px solid #1E73D8;padding:1rem 1.25rem;border-radius:0 8px 8px 0">
                        <strong style="color:#0A2E78;display:block;margin-bottom:.25rem">🚀 Misi</strong>
                        <span style="font-size:.92rem;color:#4b5563">Memberikan layanan saluran mampet yang cepat, aman, dan bergaransi menggunakan teknologi modern dan tim profesional bersertifikat.</span>
                    </div>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
                @php
                $stats2 = [
                    ['num'=>'2300+','label'=>'Proyek Selesai','color'=>'#0A2E78'],
                    ['num'=>'6','label'=>'Kota Jangkauan','color'=>'#169F81'],
                    ['num'=>'100%','label'=>'Bergaransi','color'=>'#1E73D8'],
                    ['num'=>'24/7','label'=>'Siap Melayani','color'=>'#0A2E78'],
                ];
                @endphp
                @foreach($stats2 as $s)
                <div style="background:#f9fafb;border-radius:16px;padding:1.75rem;text-align:center;border:1px solid #e5e7eb">
                    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:2rem;font-weight:800;color:{{ $s['color'] }};margin-bottom:.25rem">{{ $s['num'] }}</div>
                    <div style="font-size:.85rem;color:#6b7280;font-weight:500">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Keunggulan --}}
<section class="section bg-offwhite" aria-labelledby="advantages-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-blue">Keunggulan Tim</span>
            <h2 class="section-title" id="advantages-heading" style="margin-top:.75rem">Mengapa Percayakan <span>pada Kami</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem">
            @foreach($advantages as $i => $adv)
            @php
                $advIcons = [
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                ];
            @endphp
            <div class="advantage-card fade-in" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="advantage-icon">{!! $advIcons[$i % 3] !!}</div>
                <h3>{{ $adv['title'] }}</h3>
                <p>{{ $adv['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Wilayah Pelayanan --}}
<section class="section" aria-labelledby="zones-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-green">Wilayah Pelayanan</span>
            <h2 class="section-title" id="zones-heading" style="margin-top:.75rem">Kami Melayani <span>Berbagai</span> Lokasi</h2>
            <p class="section-sub">Dari hunian pribadi hingga area industri — tim ROOTERA siap hadir di mana Anda membutuhkan.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.25rem">
            @php
            $zoneIcons = [
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><line x1="9" y1="22" x2="9" y2="12"/><line x1="15" y1="22" x2="15" y2="12"/><line x1="9" y1="12" x2="15" y2="12"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
            ];
            @endphp
            @foreach($teamZones as $i => $zone)
            <div class="zone-card fade-in" style="animation-delay:{{ $i * 0.08 }}s">
                <div class="zone-icon">{!! $zoneIcons[$i % 6] !!}</div>
                <h3>{{ $zone['name'] }}</h3>
                <p>{{ $zone['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
@verbatim
@media(max-width:768px){
    .about-profile-grid{grid-template-columns:1fr!important}
    .zones-grid{grid-template-columns:1fr 1fr!important}
}
@endverbatim
</style>
@endpush

@include('sections.home.cta-banner')
@endsection
