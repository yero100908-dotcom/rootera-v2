@extends('layouts.app')
@section('content')

{{-- Page Header --}}
<div class="relative overflow-hidden bg-gradient-to-br from-[#0A2E78] to-[#0d3a94] pt-16 pb-24 md:pt-24 md:pb-32 text-center">
    {{-- Bottom Wave --}}
    <div class="absolute bottom-0 left-0 w-full h-[60px] pointer-events-none z-10" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" class="w-full h-full block">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#ffffff"></path>
        </svg>
    </div>

    {{-- Fluid Smooth Wavy Lines --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:1;opacity:0.08" aria-hidden="true">
        <defs>
            <linearGradient id="fluid-wave-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#20b2aa" />
                <stop offset="100%" stop-color="#6495ed" />
            </linearGradient>
        </defs>
        <path d="M-100,80 C300,260 600,-40 1000,180 C1200,290 1400,120 1600,220" fill="none" stroke="url(#fluid-wave-grad)" stroke-width="4"></path>
        <path d="M-50,140 C350,300 650,40 950,220 C1150,320 1350,160 1550,260" fill="none" stroke="url(#fluid-wave-grad)" stroke-width="3"></path>
        <path d="M-150,30 C250,170 550,-100 900,120 C1100,220 1300,80 1500,170" fill="none" stroke="url(#fluid-wave-grad)" stroke-width="2" stroke-dasharray="12,6"></path>
    </svg>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-4">Tentang <span class="text-[#6ee7cc]">ROOTERA</span></h1>
        <p class="text-white/80 text-sm sm:text-base md:text-lg max-w-2xl mx-auto leading-relaxed">Tim profesional yang berdedikasi untuk memberikan solusi pipa terbaik bagi rumah dan bisnis Anda.</p>
    </div>
</div>

{{-- Profil --}}
<section class="py-12 md:py-20 bg-white" aria-labelledby="about-profile">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl mx-auto text-center flex flex-col items-center justify-center px-4 py-8">
            <span class="badge badge-green mb-4 inline-block">Profil Perusahaan</span>
            <h2 id="about-profile" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 leading-tight mb-4 text-center">
                Solusi Pipa <span class="text-[#169F81]">Profesional</span> Indonesia
            </h2>
            <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-4 text-center max-w-3xl">ROOTERA adalah perusahaan jasa cleaning service pipa dan sanitasi terpercaya yang telah melayani ribuan pelanggan di seluruh Indonesia. Kami hadir dengan misi memberikan solusi cepat, aman, dan terjangkau untuk setiap masalah saluran dan pipa Anda.</p>
            <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-6 text-center max-w-3xl">Dengan teknologi non-destruktif terkini dan tim teknisi bersertifikat, ROOTERA memastikan setiap pekerjaan diselesaikan dengan standar kualitas tertinggi — tanpa perlu membongkar dinding atau struktur bangunan.</p>
            
            <div class="flex flex-col sm:flex-row gap-4 w-full max-w-3xl mx-auto mt-2 mb-6 text-left justify-center">
                <div class="bg-[#f0faf8] border-l-4 border-[#169F81] p-4 rounded-r-lg shadow-sm flex-1">
                    <strong class="text-[#0A2E78] block mb-1">🎯 Visi</strong>
                    <span class="text-xs sm:text-sm text-slate-600 leading-relaxed">Menjadi perusahaan jasa pipa terdepan dan terpercaya di Indonesia dengan layanan berkualitas internasional.</span>
                </div>
                <div class="bg-[#eff6ff] border-l-4 border-[#1E73D8] p-4 rounded-r-lg shadow-sm flex-1">
                    <strong class="text-[#0A2E78] block mb-1">🚀 Misi</strong>
                    <span class="text-xs sm:text-sm text-slate-600 leading-relaxed">Memberikan layanan saluran mampet yang cepat, aman, dan bergaransi menggunakan teknologi modern dan tim profesional bersertifikat.</span>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full max-w-3xl mx-auto mt-8 justify-center items-center">
                @php
                $stats2 = [
                    ['num'=>'2300+','label'=>'Proyek Selesai','color'=>'#0A2E78'],
                    ['num'=>'6','label'=>'Kota Jangkauan','color'=>'#169F81'],
                    ['num'=>'100%','label'=>'Bergaransi','color'=>'#1E73D8'],
                    ['num'=>'24/7','label'=>'Siap Melayani','color'=>'#0A2E78'],
                ];
                @endphp
                @foreach($stats2 as $s)
                <div class="bg-slate-50 rounded-2xl p-5 sm:p-6 text-center border border-slate-100 shadow-sm transition-all duration-300 hover:shadow-md hover:scale-[1.02]">
                    <div class="font-['Plus_Jakarta_Sans',sans-serif] text-2xl sm:text-3xl font-extrabold mb-1" style="color:{{ $s['color'] }}">{{ $s['num'] }}</div>
                    <div class="text-xs sm:text-sm text-slate-500 font-semibold leading-tight">{{ $s['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Keunggulan --}}
<section class="py-12 md:py-20 bg-slate-50" aria-labelledby="advantages-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mx-auto flex flex-col items-center mb-10 md:mb-14">
            <span class="badge badge-blue mb-3 inline-block">Keunggulan Tim</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 leading-tight text-center" id="advantages-heading">Mengapa Percayakan <span class="text-[#169F81]">pada Kami</span></h2>
        </div>
        <div class="flex flex-wrap justify-center gap-6 mt-8 w-full max-w-5xl mx-auto">
            @foreach($advantages as $i => $adv)
            @php
                $advIcons = [
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
                ];
            @endphp
            <div class="advantage-card fade-in w-full sm:w-[calc(50%_-_12px)] lg:w-[calc(33.33%_-_16px)]" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="advantage-icon">{!! $advIcons[$i % 3] !!}</div>
                <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-2 mt-4">{{ $adv['title'] }}</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ $adv['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Wilayah Pelayanan --}}
<section class="py-12 md:py-20 bg-white" aria-labelledby="zones-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mx-auto flex flex-col items-center mb-10 md:mb-14">
            <span class="badge badge-green mb-3 inline-block">Wilayah Pelayanan</span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 leading-tight text-center" id="zones-heading">Kami Melayani <span class="text-[#169F81]">Berbagai</span> Lokasi</h2>
            <p class="text-sm sm:text-base text-slate-600 leading-relaxed mt-3 max-w-2xl mx-auto text-center">Dari hunian pribadi hingga area industri — tim ROOTERA siap hadir di mana Anda membutuhkan.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-6 mt-8 w-full max-w-6xl mx-auto">
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
            <div class="zone-card fade-in w-full sm:w-[calc(50%_-_12px)] lg:w-[calc(33.33%_-_16px)]" style="animation-delay:{{ $i * 0.08 }}s">
                <div class="zone-icon">{!! $zoneIcons[$i % 6] !!}</div>
                <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-2 mt-4">{{ $zone['name'] }}</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ $zone['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('sections.home.cta-banner')
@endsection

