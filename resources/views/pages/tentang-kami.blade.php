@extends('layouts.app')

{{-- ========================================================================= --}}
{{-- STRUCTURED DATA (JSON-LD) SCHEMA.ORG FOR TECHNICAL LOCAL SEO              --}}
{{-- ========================================================================= --}}
@section('schema-markup')
<?php
$employeeSchema = [];
if (!empty($teamMembers) && count($teamMembers) > 0) {
    $employeeSchema = array_map(function($member) {
        return [
          "@type" => "Person",
          "name" => $member['name'],
          "jobTitle" => $member['role'] ?? "Teknisi Plumbing",
          "hasCredential" => $member['badge'] ?? "Teknisi Bersertifikat K3"
        ];
    }, $teamMembers);
}

$organizationSchema = [
  "@type" => ["Plumber", "LocalBusiness", "Organization"],
  "@id" => url('/') . "#organization",
  "name" => "Rootera Plumbing",
  "alternateName" => ["Rootera", "Rootera Indonesia", "J&J Group Plumbing Division"],
  "url" => url('/'),
  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "image" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "telephone" => "+6281385404000",
  "priceRange" => "$$",
  "foundingDate" => "2018-05-15",
  "parentOrganization" => [
    "@type" => "Organization",
    "name" => "J&J GROUP",
    "url" => url('/')
  ],
  "knowsAbout" => [
    "Hydro Jetting",
    "Non-Destructive Plumbing",
    "CCTV Pipe Inspection",
    "Drain Cleaning",
    "Spiral Cable Rigging",
    "Commercial Grease Trap Maintenance"
  ],
  "areaServed" => [
    "Jabodetabek", "Jakarta", "Bogor", "Depok", "Tangerang", "Bekasi", 
    "Semarang", "Surabaya", "Bandung", "Yogyakarta", "Lampung", "Cirebon", "Solo"
  ],
  "address" => [
    "@type" => "PostalAddress",
    "streetAddress" => "Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo",
    "addressLocality" => "Jakarta Timur",
    "addressRegion" => "DKI Jakarta",
    "postalCode" => "13770",
    "addressCountry" => "ID"
  ],
  "contactPoint" => [
    "@type" => "ContactPoint",
    "telephone" => "+6281385404000",
    "contactType" => "customer service",
    "availableLanguage" => ["Indonesian", "English"],
    "hoursAvailable" => "Mo-Su 00:00-24:00"
  ]
];

if (!empty($employeeSchema)) {
    $organizationSchema['employee'] = $employeeSchema;
}

$breadcrumbSchema = [
  "@type" => "BreadcrumbList",
  "itemListElement" => [
    [
      "@type" => "ListItem",
      "position" => 1,
      "name" => "Beranda",
      "item" => url('/')
    ],
    [
      "@type" => "ListItem",
      "position" => 2,
      "name" => "Tentang Kami",
      "item" => url('/tentang-kami')
    ]
  ]
];

$aboutPageSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "AboutPage",
      "@id" => url('/tentang-kami') . "#webpage",
      "url" => url('/tentang-kami'),
      "name" => $seo['title'] ?? "Tentang Kami - Rootera Plumbing",
      "description" => $seo['description'] ?? "Profil lengkap Rootera Plumbing, pionir jasa pelancar saluran pipa mampet tanpa bongkar di Indonesia.",
      "inLanguage" => "id-ID",
      "isPartOf" => [
        "@type" => "WebSite",
        "@id" => url('/') . "#website",
        "url" => url('/'),
        "name" => "Rootera Plumbing"
      ],
      "mainEntity" => [
        "@id" => url('/') . "#organization"
      ]
    ],
    $organizationSchema,
    $breadcrumbSchema
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($aboutPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. HERO SECTION & VALUE PROPOSITION                                       --}}
{{-- ========================================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#061730] pt-24 pb-32 md:pt-32 md:pb-40 text-center text-white" aria-label="Hero Tentang Kami">
    {{-- Dynamic Ambient Glow Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-[450px] bg-emerald-500/15 blur-[120px] pointer-events-none rounded-full" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-[450px] h-[450px] bg-cyan-500/10 blur-[100px] pointer-events-none rounded-full" aria-hidden="true"></div>

    {{-- Tech Wave Background Overlay --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" class="absolute inset-0 w-full h-full pointer-events-none z-0 opacity-10" aria-hidden="true">
        <defs>
            <linearGradient id="about-hero-wave" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#10B981" />
                <stop offset="100%" stop-color="#38BDF8" />
            </linearGradient>
        </defs>
        <path d="M-100,80 C300,260 600,-40 1000,180 C1200,290 1400,120 1600,220" fill="none" stroke="url(#about-hero-wave)" stroke-width="3"></path>
        <path d="M-50,140 C350,300 650,40 950,220 C1150,320 1350,160 1550,260" fill="none" stroke="url(#about-hero-wave)" stroke-width="2"></path>
    </svg>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-emerald-400 font-semibold">Tentang Kami</span>
        </nav>

        {{-- Glowing Capsule Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-emerald-400/30 px-4 py-1.5 rounded-full text-xs sm:text-sm font-bold text-emerald-400 uppercase tracking-wider mb-6 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_10px_#10B981]"></span>
            Pionir Solusi Pipa &amp; Sanitasi Modern Tanpa Bongkar di Indonesia
        </div>

        {{-- Main Headline --}}
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-5xl mx-auto tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
            Solusi Pipa Mampet &amp; Drainase <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Profesional, Cepat &amp; Bergaransi</span>
        </h1>

        {{-- Sub-headline --}}
        <p class="text-slate-200 text-sm sm:text-base md:text-lg max-w-3xl mx-auto leading-relaxed mb-8">
            Rootera Plumbing (bagian dari J&amp;J Group) menggabungkan teknologi <strong>Spiral Ridgid</strong>, <strong>Kamera CCTV Inspeksi 1080p</strong>, dan <strong>Hydro Jetting 300 Bar</strong> untuk melancarkan saluran tanpa membongkar keramik atau dinding bangunan Anda.
        </p>

        {{-- Quick CTA Header Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 max-w-md mx-auto">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin panggil teknisi untuk perbaikan saluran mampet.') }}" 
               target="_blank" rel="noopener" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold py-3.5 px-6 rounded-xl shadow-lg shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                <span>Konsultasi Gratis via WhatsApp</span>
            </a>
            <a href="#expert-team" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold py-3.5 px-6 rounded-xl border border-white/20 transition-all flex items-center justify-center gap-2">
                <span>Lihat Tim Rootera</span> &darr;
            </a>
        </div>
    </div>

    {{-- Bottom Divider --}}
    <div class="absolute bottom-0 left-0 w-full h-[60px] md:h-[90px] pointer-events-none z-10">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="w-full h-full block">
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.15"></path>
            <path d="M0,90 C360,130 720,40 1080,110 C1260,130 1360,100 1440,90 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>
</section>

{{-- Floating Key Value Metrics Counter Ribbon --}}
<div class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 md:-mt-20 mb-16">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
        <div class="flex flex-col items-center justify-center p-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-[#0B2545] font-['Plus_Jakarta_Sans',sans-serif] mb-1">15.000+</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-600">Proyek Pipa Selesai</div>
            <div class="text-[11px] text-slate-400 mt-0.5">Rumah, Resto &amp; Industri</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-4 md:pt-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-emerald-600 font-['Plus_Jakarta_Sans',sans-serif] mb-1">4.9 / 5.0</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-600">Rating Kepuasan</div>
            <div class="text-[11px] text-slate-400 mt-0.5">Berdasarkan 1.200+ Review</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-4 md:pt-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-blue-600 font-['Plus_Jakarta_Sans',sans-serif] mb-1">50+</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-600">Teknisi Certified K3</div>
            <div class="text-[11px] text-slate-400 mt-0.5">Sertifikasi &amp; SOP Steril</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-4 md:pt-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-amber-600 font-['Plus_Jakarta_Sans',sans-serif] mb-1">50+ Kota</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-600">Cakupan Operasional</div>
            <div class="text-[11px] text-slate-400 mt-0.5">Jabodetabek, Jawa &amp; Sumatra</div>
        </div>
    </div>
</div>

{{-- ========================================================================= --}}
{{-- 2. VISI, MISI & KOMITMEN K3                                                --}}
{{-- ========================================================================= --}}
<section class="py-12 md:py-20 bg-white" aria-labelledby="story-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- Left Showcase --}}
            <div class="lg:col-span-6 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-50 group">
                    <img src="{{ asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp') }}" 
                         alt="Teknisi Rootera Plumbing dengan standar keselamatan kerja K3" 
                         loading="lazy" decoding="async" width="600" height="480" 
                         class="w-full h-[380px] sm:h-[460px] object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B2545]/90 via-[#0B2545]/20 to-transparent"></div>
                    
                    <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-4 sm:p-5 rounded-2xl border border-white/40 shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-xl shrink-0">
                                🦺
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900">Komitmen K3 &amp; APD Lengkap</h4>
                                <p class="text-xs text-slate-600">Teknisi dibekali helm K3, sarung tangan heavy-duty, &amp; SOP disinfeksi steril</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Description --}}
            <div class="lg:col-span-6 flex flex-col justify-center">
                <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider w-fit mb-3">Visi, Misi &amp; Komitmen K3</span>
                <h2 id="story-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight mb-5 font-['Plus_Jakarta_Sans',sans-serif]">
                    Standar Baru Layanan Sanitasi: <span class="text-emerald-600">Higienis, Aman &amp; Tanpa Merusak</span>
                </h2>
                
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-4">
                    Di Rootera Plumbing, kami menyadari bahwa perbaikan pipa bukan sekadar melancarkan air, tetapi juga menjaga estetika, kebersihan, dan keselamatan properti Anda.
                </p>
                
                {{-- Heritage Block: J&J Group --}}
                <div class="bg-slate-50 border-l-4 border-emerald-600 rounded-2xl p-4 mb-6 shadow-xs">
                    <div class="flex items-center gap-2 font-bold text-slate-900 text-sm mb-1">
                        <span>🏛️</span> Bagian dari J&amp;J Group (Pengalaman 10+ Tahun)
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Didukung oleh infrastruktur manajemen J&amp;J Group yang mengelola ribuan kasus pipa mampet residensial, restoran, mall, hingga kawasan pabrik di seluruh Indonesia.
                    </p>
                </div>

                {{-- Visi Misi Cards Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50/70 border border-emerald-200/70 rounded-2xl p-4">
                        <div class="flex items-center gap-2 font-bold text-slate-900 text-sm mb-1">
                            <span>🎯</span> Visi Utama
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Menjadi penyedia jasa plumbing modern nomor 1 di Indonesia dengan mengutamakan presisi teknologi dan kepuasan pelanggan 100%.
                        </p>
                    </div>
                    <div class="bg-blue-50/70 border border-blue-200/70 rounded-2xl p-4">
                        <div class="flex items-center gap-2 font-bold text-slate-900 text-sm mb-1">
                            <span>🚀</span> Misi Operasional
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Menyajikan kepastian garansi tertulis 30 hari, transparansi harga di awal, dan penanganan tanpa bongkar keramik.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 3. 👥 TIM & KARYAWAN PROFESIONAL ROOTERA (MINIMALIST & CLEAN CONCEPT)      --}}
{{-- ========================================================================= --}}
<section id="expert-team" class="py-16 md:py-24 bg-slate-50/80 border-t border-slate-200/70" aria-labelledby="team-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-10 md:mb-14">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider mb-3">
                👥 Tim &amp; Karyawan Profesional
            </span>
            <h2 id="team-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Tim Profesional <span class="text-emerald-600">Rootera Plumbing</span>
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Sosok di balik ketepatan penanganan dan respon cepat 24 jam layanan kami.
            </p>
        </div>

        {{-- Minimalist & Modern Staff Grid (2 cols mobile, 3 cols tablet, 4 cols desktop) --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-6">
            @foreach($teamMembers as $member)
            <div class="group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col">
                {{-- Aspect Frame with Face Focus (object-top) --}}
                <div class="aspect-square sm:aspect-[4/5] overflow-hidden relative bg-slate-100">
                    <img src="{{ $member['image'] }}" 
                         alt="{{ $member['alt'] ?? ($member['name'] . ' - ' . $member['role']) }}" 
                         loading="lazy" 
                         decoding="async" 
                         width="400" 
                         height="400" 
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                    
                    {{-- Minimalist Badge Overlay --}}
                    @if(!empty($member['badge']))
                    <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-slate-900/80 text-emerald-400 backdrop-blur-xs">
                        {{ $member['badge'] }}
                    </span>
                    @endif
                </div>

                {{-- Clean Text Content --}}
                <div class="p-3.5 sm:p-4 text-center flex-1 flex flex-col justify-center bg-white">
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] leading-tight mb-1 group-hover:text-emerald-600 transition-colors">
                        {{ $member['name'] }}
                    </h3>
                    <p class="text-xs text-slate-500 font-medium leading-snug">
                        {{ $member['role'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 4. CORE VALUES (4 PILAR UNGGULAN ROOTERA)                                 --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-[#0B2545] text-white relative overflow-hidden" aria-labelledby="values-heading">
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/10 blur-3xl pointer-events-none"></div>
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-white/10 text-emerald-400 uppercase tracking-wider mb-3 border border-white/15">Why Choose Us</span>
            <h2 id="values-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                4 Pilar Utama Keunggulan <span class="text-emerald-400">Rootera Plumbing</span>
            </h2>
            <p class="text-slate-300 text-sm sm:text-base mt-3">
                Jaminan pengerjaan bermutu tinggi dengan pendekatan ilmiah &amp; teknologi tanpa bongkar.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($advantages as $adv)
            <div class="bg-white/5 border border-white/10 hover:border-emerald-400/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1.5 hover:bg-white/10 hover:shadow-xl group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl font-bold mb-4 group-hover:scale-110 transition-transform">
                        {{ $adv['icon'] }}
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-wider px-2.5 py-0.5 rounded bg-emerald-400/20 text-emerald-300 mb-2">
                        {{ $adv['badge'] }}
                    </span>
                    <h3 class="text-base sm:text-lg font-bold text-white mb-2 font-['Plus_Jakarta_Sans',sans-serif]">{{ $adv['title'] }}</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">{{ $adv['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 5. QUICK NAVIGATION KE SUB-HALAMAN KREDIBILITAS                           --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-white" aria-labelledby="subpages-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider mb-3">Sub-Halaman Informasi</span>
            <h2 id="subpages-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Pelajari Kredibilitas &amp; <span class="text-emerald-600">Standar Layanan Kami</span>
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3">
                Temukan informasi mendalam tentang legalitas K3, teknologi mesin, portofolio proyek B2B, garansi, dan FAQ.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Card 1: Profil & K3 --}}
            <a href="{{ route('tentang-kami.profil') }}" class="group bg-slate-50 hover:bg-emerald-50/60 border border-slate-200/80 hover:border-emerald-400 p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        🏢
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Profil Perusahaan &amp; Standar K3
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        Legalitas usaha resmi, SOP sterilisasi alat, protokol APD teknisi, serta filosofi layanan Rootera.
                    </p>
                </div>
                <div class="text-xs font-bold text-emerald-600 group-hover:text-emerald-700 flex items-center gap-1">
                    <span>Baca Profil Selengkapnya</span> &rarr;
                </div>
            </a>

            {{-- Card 2: Peralatan & Teknologi --}}
            <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="group bg-slate-50 hover:bg-blue-50/60 border border-slate-200/80 hover:border-blue-400 p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        ⚙️
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Peralatan &amp; Teknologi Modern
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        Spesifikasi Mesin Ridgid Amerika, Mikro Kamera CCTV Flex 1080p, &amp; Hydro Jetting 300 Bar.
                    </p>
                </div>
                <div class="text-xs font-bold text-blue-600 group-hover:text-blue-700 flex items-center gap-1">
                    <span>Lihat Spesifikasi Mesin</span> &rarr;
                </div>
            </a>

            {{-- Card 3: Portofolio B2B --}}
            <a href="{{ route('tentang-kami.portofolio-klien') }}" class="group bg-slate-50 hover:bg-purple-50/60 border border-slate-200/80 hover:border-purple-400 p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        📁
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-purple-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Klien &amp; Portofolio B2B
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        Rekam jejak pengerjaan di restoran, mall, hotel, gedung kantor, hingga kawasan industri BUMN.
                    </p>
                </div>
                <div class="text-xs font-bold text-purple-600 group-hover:text-purple-700 flex items-center gap-1">
                    <span>Lihat Portofolio B2B</span> &rarr;
                </div>
            </a>

            {{-- Card 4: Garansi Layanan --}}
            <a href="{{ route('tentang-kami.garansi-layanan') }}" class="group bg-slate-50 hover:bg-amber-50/60 border border-slate-200/80 hover:border-amber-400 p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        🛡️
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Garansi Pengerjaan 30 Hari
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        Penjelasan transparan SOP klaim garansi 30 hari, syarat &amp; ketentuan, dan prinsip "Tuntas Baru Bayar".
                    </p>
                </div>
                <div class="text-xs font-bold text-amber-600 group-hover:text-amber-700 flex items-center gap-1">
                    <span>Kebijakan Garansi</span> &rarr;
                </div>
            </a>

            {{-- Card 5: FAQ & Pusat Bantuan --}}
            <a href="{{ route('faq.index') }}" class="group bg-slate-50 hover:bg-rose-50/60 border border-slate-200/80 hover:border-rose-400 p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">
                        ❓
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-rose-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        FAQ / Pusat Bantuan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        Pertanyaan umum mengenai estimasi biaya, jangkauan area, waktu tiba teknisi, &amp; pembayaran.
                    </p>
                </div>
                <div class="text-xs font-bold text-rose-600 group-hover:text-rose-700 flex items-center gap-1">
                    <span>Buka Pusat Bantuan</span> &rarr;
                </div>
            </a>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 6. CTA KONVERSI & FLOATING MOBILE BAR                                    --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-20 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#051428] text-white relative overflow-hidden mb-12 lg:mb-0">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/40 px-3.5 py-1 rounded-full text-xs font-bold text-emerald-400 uppercase tracking-wider mb-6">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Respons Darurat 24 Jam
        </span>

        <h2 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
            Butuh Bantuan Saluran Air Mampet Hari Ini?<br>
            <span class="text-emerald-400">Tim Teknisi Siaga Tiba 30-60 Menit</span>
        </h2>

        <p class="text-slate-200 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8">
            Konsultasikan kendala pipa rumah, ruko, restoran, atau pabrik Anda secara gratis. Bebas biaya pengerjaan jika saluran tidak lancar!
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 max-w-xl mx-auto">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya mau panggil teknisi pipa mampet.') }}" 
               target="_blank" rel="noopener" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-sm sm:text-base py-4 px-8 rounded-2xl flex items-center justify-center gap-3 shadow-lg shadow-emerald-600/40 transition-all">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                <span>Panggil Teknisi via WhatsApp (24 Jam)</span>
            </a>
        </div>
    </div>
</section>

{{-- Floating Sticky Mobile CTA Bar --}}
<div class="fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/80 p-3 lg:hidden shadow-2xl flex items-center gap-2.5">
    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya mau panggil teknisi pelancar pipa.') }}" 
       target="_blank" rel="noopener" 
       class="flex-1 py-3 px-4 bg-emerald-600 active:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm rounded-xl flex items-center justify-center gap-2 shadow-md">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
        <span>Konsultasi &amp; Panggil Teknisi</span>
    </a>
    <a href="tel:+6281385404000" class="py-3 px-3.5 bg-slate-900 text-white rounded-xl font-bold text-xs flex items-center justify-center">
        <span>📞 Telepon</span>
    </a>
</div>

@endsection
