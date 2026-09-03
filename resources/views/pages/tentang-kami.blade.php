@extends('layouts.app')

{{-- ========================================================================= --}}
{{-- STRUCTURED DATA (JSON-LD) SCHEMA.ORG FOR ABOUT US & LOCALBUSINESS E-E-A-T  --}}
{{-- ========================================================================= --}}
@section('schema-markup')
<?php
$employeeSchema = [];
if (isset($teamMembers) && is_array($teamMembers)) {
    $employeeSchema = array_map(function($member) {
        $data = [
            "@type" => "Person",
            "name" => $member['name'],
            "jobTitle" => $member['role'],
            "image" => $member['image']
        ];
        if (!empty($member['slug'])) {
            $data['url'] = url('/tentang-kami/tim/' . $member['slug']);
        }
        if (!empty($member['bio'])) {
            $data['description'] = $member['bio'];
        }
        return $data;
    }, $teamMembers);
}

$organizationSchema = [
  "@type" => ["Plumber", "LocalBusiness", "Organization"],
  "@id" => url('/') . "#organization",
  "name" => "Rootera Plumbing - Jasa Saluran Pipa Mampet",
  "alternateName" => ["Rootera", "Rootera Indonesia", "J&J Group Plumbing Division"],
  "url" => url('/'),
  "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "image" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
  "telephone" => "+6281385404000",
  "priceRange" => "$$",
  "foundingDate" => "2026-07-01",
  "founder" => [
    "@type" => "Person",
    "name" => "Rafael Abimanyu",
    "jobTitle" => "Founder & Lead Director"
  ],
  "parentOrganization" => [
    "@type" => "Organization",
    "name" => "J&J Group",
    "url" => url('/'),
    "description" => "Holding grup manajemen rantai pasok dan layanan teknis terintegrasi dengan pengalaman lebih dari 10 tahun di Indonesia."
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
    "streetAddress" => "Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung",
    "addressLocality" => "Kec. Ps. Rebo, Kota Jakarta Timur",
    "addressRegion" => "Daerah Khusus Ibukota Jakarta",
    "postalCode" => "13770",
    "addressCountry" => "ID"
  ],
  "geo" => [
    "@type" => "GeoCoordinates",
    "latitude" => -6.327526,
    "longitude" => 106.862779
  ],
  "hasMap" => "https://maps.google.com/?cid=16012437648585635749",
  "openingHours" => "Mo-Su 00:00-23:59",
  "contactPoint" => [
    "@type" => "ContactPoint",
    "telephone" => "+6281385404000",
    "contactType" => "customer service",
    "availableLanguage" => ["Indonesian", "English"],
    "hoursAvailable" => "Mo-Su 00:00-24:00"
  ],
  "sameAs" => [
    "https://rooteraplumbing.id",
    "https://instagram.com/rootera.plumbing",
    "https://tiktok.com/@rootera_plumbing",
    "https://facebook.com/rooteraplumbing",
    "https://youtube.com/@rooteraplumbing"
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
      "name" => $seo['title'] ?? "Tentang Kami — Profil Perusahaan, Workshop Resmi & Tim Ahli Rootera Plumbing",
      "description" => $seo['description'] ?? "Mengenal profil Rootera Plumbing, spesialis saluran pipa mampet tanpa bongkar yang dipimpin oleh Rafael Abimanyu. Kantor pusat & workshop resmi di Cijantung, Jakarta Timur.",
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

{{-- Master Wrapper to prevent horizontal overflow --}}
<div class="overflow-x-hidden w-full bg-[#07172B]">

{{-- ========================================================================= --}}
{{-- 1. HERO SECTION & VALUE PROPOSITION                                       --}}
{{-- ========================================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#061730] pt-20 pb-24 md:pt-28 md:pb-36 text-center text-white" aria-label="Hero Tentang Kami">
    {{-- Dynamic Ambient Glow Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] md:w-[800px] h-[350px] md:h-[450px] bg-emerald-500/15 blur-[100px] md:blur-[120px] pointer-events-none rounded-full" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-[300px] md:w-[450px] h-[300px] md:h-[450px] bg-cyan-500/10 blur-[80px] md:blur-[100px] pointer-events-none rounded-full" aria-hidden="true"></div>

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
        <nav class="flex justify-center items-center gap-1.5 sm:gap-2 text-xs sm:text-sm text-slate-300 mb-4 sm:mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-emerald-400 font-semibold">Tentang Kami</span>
        </nav>

        {{-- Glowing Capsule Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-emerald-400/30 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-extrabold text-emerald-400 uppercase tracking-wider mb-4 sm:mb-6 backdrop-blur-md max-w-full truncate">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_10px_#10B981] shrink-0"></span>
            <span class="truncate">Pionir Solusi Pipa &amp; Sanitasi Modern Tanpa Bongkar</span>
        </div>

        {{-- Main Headline (Mobile-First Responsive Typography) --}}
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4 sm:mb-6 max-w-5xl mx-auto tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
            Solusi Pipa Mampet &amp; Drainase <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Profesional, Cepat &amp; Bergaransi</span>
        </h1>

        {{-- Sub-headline --}}
        <p class="text-slate-200 text-xs sm:text-sm md:text-base max-w-3xl mx-auto leading-relaxed mb-6 sm:mb-8">
            Rootera Plumbing (bagian dari J&amp;J Group) menggabungkan teknologi <strong>Spiral Ridgid</strong>, <strong>Kamera CCTV Inspeksi 1080p</strong>, dan <strong>Hydro Jetting 300 Bar</strong> untuk melancarkan saluran tanpa membongkar keramik atau dinding bangunan Anda.
        </p>

        {{-- Quick CTA Header Buttons (44px Minimum Touch Target) --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 max-w-md mx-auto">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin panggil teknisi untuk perbaikan saluran mampet.') }}" 
               target="_blank" rel="noopener" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold py-3.5 px-6 rounded-xl shadow-lg shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all text-xs sm:text-sm min-h-[44px]">
                <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                <span>Konsultasi Gratis via WhatsApp</span>
            </a>
            <a href="#expert-team" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold py-3.5 px-6 rounded-xl border border-white/20 transition-all flex items-center justify-center gap-2 text-xs sm:text-sm min-h-[44px]">
                <span>Lihat Tim Rootera</span> &darr;
            </a>
        </div>
    </div>

    {{-- Bottom Wave Divider --}}
    <div class="absolute bottom-0 left-0 w-full h-[40px] sm:h-[60px] md:h-[90px] pointer-events-none z-10">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="w-full h-full block">
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.15"></path>
            <path d="M0,90 C360,130 720,40 1080,110 C1260,130 1360,100 1440,90 L1440,120 L0,120 Z" fill="#07172B"></path>
        </svg>
    </div>
</section>

{{-- Floating Key Value Metrics Counter Ribbon (Grid 2 Kolom Mobile) --}}
<div class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 sm:-mt-16 md:-mt-20 mb-10 sm:mb-14 md:mb-16">
    <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-2xl border border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
        <div class="flex flex-col items-center justify-center p-2">
            <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-[#0B2545] font-['Plus_Jakarta_Sans',sans-serif] mb-0.5 sm:mb-1">15.000+</div>
            <div class="text-[11px] sm:text-xs font-bold text-slate-700">Proyek Pipa Selesai</div>
            <div class="text-[10px] sm:text-[11px] text-slate-400 mt-0.5">Rumah, Resto &amp; Industri</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-3 md:pt-2">
            <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-emerald-600 font-['Plus_Jakarta_Sans',sans-serif] mb-0.5 sm:mb-1">4.9 / 5.0</div>
            <div class="text-[11px] sm:text-xs font-bold text-slate-700">Rating Kepuasan</div>
            <div class="text-[10px] sm:text-[11px] text-slate-400 mt-0.5">1.200+ Ulasan Pelanggan</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-3 md:pt-2">
            <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-blue-600 font-['Plus_Jakarta_Sans',sans-serif] mb-0.5 sm:mb-1">50+</div>
            <div class="text-[11px] sm:text-xs font-bold text-slate-700">Teknisi Certified K3</div>
            <div class="text-[10px] sm:text-[11px] text-slate-400 mt-0.5">Sertifikasi &amp; SOP Steril</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-3 md:pt-2">
            <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-amber-600 font-['Plus_Jakarta_Sans',sans-serif] mb-0.5 sm:mb-1">50+ Kota</div>
            <div class="text-[11px] sm:text-xs font-bold text-slate-700">Cakupan Operasional</div>
            <div class="text-[10px] sm:text-[11px] text-slate-400 mt-0.5">Jabodetabek, Jawa &amp; Sumatra</div>
        </div>
    </div>
</div>

{{-- ========================================================================= --}}
{{-- 1.5. 🏛️ SEJARAH PENDIRIAN & NAUNGAN HOLDING J&J GROUP                    --}}
{{-- ========================================================================= --}}
<section class="py-10 md:py-16 bg-[#07172B] text-white relative" aria-labelledby="history-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="bg-[#0B223D]/75 border border-slate-700/60 rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-10 shadow-2xl relative overflow-hidden">
            {{-- Background Accent Glow --}}
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                {{-- Section Badge & Header --}}
                <div class="mb-6 sm:mb-8 text-center md:text-left">
                    <span class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-400/30 uppercase tracking-wider mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        SEJARAH &amp; ENTITAS KORPORASI
                    </span>
                    <h2 id="history-heading" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-white leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                        Lahir dari Komitmen Integritas di Bawah Payung <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">J&amp;J Group</span>
                    </h2>
                </div>

                {{-- Corporate History Copywriting Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-stretch mb-8 sm:mb-10 text-slate-300 text-xs sm:text-sm md:text-base leading-relaxed">
                    
                    {{-- Left Column: Titik Mula Dedikasi --}}
                    <div class="bg-[#07172B]/80 border border-slate-700/70 p-5 sm:p-6 rounded-2xl space-y-3 relative h-full flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 font-bold text-emerald-400 text-sm sm:text-base mb-3">
                                <span class="text-xl">📅</span>
                                <span>Titik Mula Dedikasi &amp; Visi Pendiri</span>
                            </div>
                            <p class="text-slate-200 leading-relaxed mb-3">
                                Didirikan secara resmi pada <strong>Rabu, 1 Juli 2026</strong>, Rootera Plumbing hadir bukan sekadar sebagai penyedia jasa perbaikan teknis, melainkan sebagai <strong>pencetus standar baru (pioneer of dignity)</strong> dalam industri sanitasi dan pemipaan modern di Indonesia.
                            </p>
                            <p class="text-slate-300 leading-relaxed">
                                Diprakarsai langsung oleh <strong>Rafael Abimanyu</strong>—seorang praktisi yang tumbuh dari dinamika meja administrasi kantor hingga kotornya medan saluran pipa lapangan—Rootera lahir dari sebuah refleksi mendalam: <em class="text-emerald-300">“bahwa kenyamanan dan kebersihan sebuah hunian berhak dirawat dengan sains yang presisi, kejujuran harga, dan teknologi tanpa bongkar yang menghargai struktur properti.”</em>
                            </p>
                        </div>
                    </div>

                    {{-- Right Column: Kekuatan J&J Group --}}
                    <div class="bg-[#07172B]/80 border border-slate-700/70 p-5 sm:p-6 rounded-2xl space-y-3 relative h-full flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 font-bold text-blue-400 text-sm sm:text-base mb-3">
                                <span class="text-xl">🏛️</span>
                                <span>Kekuatan di Bawah Naungan J&amp;J Group</span>
                            </div>
                            <p class="text-slate-200 leading-relaxed mb-3">
                                Berdiri kokoh dengan rekam jejak lebih dari <strong>satu dekade (10+ tahun)</strong> dalam manajemen rantai pasok dan layanan teknis terintegrasi di Indonesia, <strong>J&amp;J Group</strong> hadir sebagai fondasi utama di balik lahirnya Rootera Plumbing.
                            </p>
                            <p class="text-slate-300 leading-relaxed mb-3">
                                Sebagai pilar bisnis strategis, Rootera mengemban mandat keunggulan operasional, tata kelola manajemen akuntabel, dan standardisasi armada berskala nasional. Pengalaman panjang J&amp;J Group memastikan setiap prosedur didukung sistem logistik mesin mutakhir yang kuat, kepatuhan keselamatan kerja (K3) ketat, serta kapasitas ekspansi lintas wilayah yang terukur.
                            </p>
                            <blockquote class="text-slate-200 text-xs sm:text-sm italic font-medium leading-relaxed bg-[#061730]/70 p-3.5 rounded-xl border-l-4 border-blue-400">
                                “Dukungan penuh dari kematangan ekosistem J&amp;J Group memberi kepastian bahwa garansi purna-jual 30 hari, transparansi tanpa biaya tersembunyi, dan kehormatan terhadap properti pelanggan bukan sekadar janji promosi, melainkan komitmen institusi yang terbukti konsisten selama lebih dari 10 tahun.”
                            </blockquote>
                        </div>
                    </div>

                </div>

                {{-- Komponen Saluran Komunikasi & Media Sosial Resmi (Grid 6 Cards) --}}
                <div class="pt-6 border-t border-slate-700/80">
                    <div class="mb-4 text-center md:text-left">
                        <span class="text-[11px] sm:text-xs font-bold text-emerald-400 uppercase tracking-wider block">Verifikasi Digital &amp; Akses Resmi</span>
                        <h3 class="text-base sm:text-lg font-bold text-white font-['Plus_Jakarta_Sans',sans-serif] mt-0.5">
                            Saluran Komunikasi &amp; Media Sosial Resmi
                        </h3>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                        {{-- 1. Website Resmi --}}
                        <a href="https://rooteraplumbing.id" 
                           target="_blank" rel="noopener noreferrer" 
                           class="group bg-[#07172B] hover:bg-emerald-950/60 border border-slate-700/80 hover:border-emerald-400/60 p-3 sm:p-3.5 rounded-xl transition-all duration-300 text-center flex flex-col items-center justify-center">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-base mb-1.5 group-hover:scale-110 transition-transform">
                                🌐
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Website</span>
                            <span class="text-xs font-bold text-slate-200 group-hover:text-emerald-300 truncate w-full mt-0.5">rooteraplumbing.id</span>
                        </a>

                        {{-- 2. WhatsApp --}}
                        <a href="https://wa.me/6281385404000" 
                           target="_blank" rel="noopener noreferrer" 
                           class="group bg-[#07172B] hover:bg-emerald-950/60 border border-slate-700/80 hover:border-emerald-400/60 p-3 sm:p-3.5 rounded-xl transition-all duration-300 text-center flex flex-col items-center justify-center">
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-base mb-1.5 group-hover:scale-110 transition-transform">
                                💬
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">WhatsApp 24h</span>
                            <span class="text-xs font-bold text-slate-200 group-hover:text-emerald-300 truncate w-full mt-0.5">0813-8540-4000</span>
                        </a>

                        {{-- 3. Instagram --}}
                        <a href="https://instagram.com/rootera.plumbing" 
                           target="_blank" rel="noopener noreferrer" 
                           class="group bg-[#07172B] hover:bg-rose-950/60 border border-slate-700/80 hover:border-rose-400/60 p-3 sm:p-3.5 rounded-xl transition-all duration-300 text-center flex flex-col items-center justify-center">
                            <div class="w-8 h-8 rounded-lg bg-rose-500/20 text-rose-400 flex items-center justify-center text-base mb-1.5 group-hover:scale-110 transition-transform">
                                📸
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Instagram</span>
                            <span class="text-xs font-bold text-slate-200 group-hover:text-rose-300 truncate w-full mt-0.5">@rootera.plumbing</span>
                        </a>

                        {{-- 4. TikTok --}}
                        <a href="https://tiktok.com/@rootera_plumbing" 
                           target="_blank" rel="noopener noreferrer" 
                           class="group bg-[#07172B] hover:bg-cyan-950/60 border border-slate-700/80 hover:border-cyan-400/60 p-3 sm:p-3.5 rounded-xl transition-all duration-300 text-center flex flex-col items-center justify-center">
                            <div class="w-8 h-8 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-base mb-1.5 group-hover:scale-110 transition-transform">
                                🎵
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">TikTok</span>
                            <span class="text-xs font-bold text-slate-200 group-hover:text-cyan-300 truncate w-full mt-0.5">@rootera_plumbing</span>
                        </a>

                        {{-- 5. Facebook --}}
                        <a href="https://facebook.com/rooteraplumbing" 
                           target="_blank" rel="noopener noreferrer" 
                           class="group bg-[#07172B] hover:bg-blue-950/60 border border-slate-700/80 hover:border-blue-400/60 p-3 sm:p-3.5 rounded-xl transition-all duration-300 text-center flex flex-col items-center justify-center">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center text-base mb-1.5 group-hover:scale-110 transition-transform">
                                📘
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Facebook</span>
                            <span class="text-xs font-bold text-slate-200 group-hover:text-blue-300 truncate w-full mt-0.5">Rootera Plumbing</span>
                        </a>

                        {{-- 6. YouTube --}}
                        <a href="https://youtube.com/@rooteraplumbing" 
                           target="_blank" rel="noopener noreferrer" 
                           class="group bg-[#07172B] hover:bg-red-950/60 border border-slate-700/80 hover:border-red-400/60 p-3 sm:p-3.5 rounded-xl transition-all duration-300 text-center flex flex-col items-center justify-center">
                            <div class="w-8 h-8 rounded-lg bg-red-500/20 text-red-400 flex items-center justify-center text-base mb-1.5 group-hover:scale-110 transition-transform">
                                ▶️
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">YouTube</span>
                            <span class="text-xs font-bold text-slate-200 group-hover:text-red-300 truncate w-full mt-0.5">Rootera Plumbing</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2. VISI & MISI KORPORAT BRAND ROOTERA PLUMBING                             --}}
{{-- ========================================================================= --}}
<section class="py-10 md:py-16 lg:py-20 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#061730] text-white relative overflow-hidden" aria-labelledby="brand-vision-heading">
    <div class="absolute top-0 right-0 w-80 md:w-96 h-80 md:h-96 bg-emerald-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 md:w-96 h-80 md:h-96 bg-cyan-500/10 blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-8 md:mb-12">
            <span class="inline-flex items-center gap-2 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-400/30 uppercase tracking-wider mb-3 sm:mb-4 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Filosofi &amp; Landasan Layanan Rootera
            </span>
            <h2 id="brand-vision-heading" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-white leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                Visi &amp; Misi Korporat <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Rootera Plumbing</span>
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm md:text-base mt-2 sm:mt-3 max-w-2xl mx-auto leading-relaxed">
                Komitmen tertinggi kami untuk menetapkan tolok ukur baru dalam industri sanitasi dan pelancaran drainase bergaransi di Indonesia.
            </p>
        </div>

        {{-- 2 Pillar Grid: Visi & Misi --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-6 md:gap-8 items-stretch">
            
            {{-- Pillar 1: Visi Utama Rootera --}}
            <div class="md:col-span-5 bg-[#0D2A4A]/80 border-2 border-emerald-500/40 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 backdrop-blur-md shadow-[0_0_30px_rgba(16,185,129,0.15)] flex flex-col justify-between relative group hover:border-emerald-400 transition-all duration-300">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl sm:text-2xl font-bold mb-4 sm:mb-6 border border-emerald-500/30 group-hover:scale-110 transition-transform">
                        🏆
                    </div>
                    <span class="px-2.5 py-1 rounded-md text-[10px] sm:text-xs font-semibold uppercase tracking-wider bg-emerald-400/20 text-emerald-300 border border-emerald-400/30 mb-2 sm:mb-3 inline-block">
                        Visi Utama Brand
                    </span>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-white mb-3 sm:mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                        The Gold Standard Sanitation Service
                    </h3>
                    <blockquote class="text-xs sm:text-sm md:text-base text-slate-200 italic font-medium leading-relaxed bg-[#061730]/60 p-3.5 sm:p-5 rounded-xl sm:rounded-2xl border-l-4 border-emerald-400">
                        “Menjadi tolok ukur (gold standard) layanan sanitasi dan drainase modern di Indonesia yang mengedepankan etika kerja transparan, teknologi mutakhir ramah struktur bangunan, serta kepastian tuntas bergaransi nyata.”
                    </blockquote>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-700/60 flex items-center gap-2 text-[11px] sm:text-xs font-bold text-emerald-400">
                    <span>🏛️ Standar Mutu Berkelanjutan J&amp;J Group</span>
                </div>
            </div>

            {{-- Pillar 2: Misi Utama 4 Pilar Inti --}}
            <div class="md:col-span-7 bg-[#0E2847]/70 border border-slate-700/80 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 backdrop-blur-md flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl sm:text-2xl font-bold border border-blue-500/30 shrink-0">
                            🚀
                        </div>
                        <div>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase tracking-wider text-blue-400 block">4 Pilar Operational Excellence</span>
                            <h3 class="text-base sm:text-lg md:text-xl font-bold text-white font-['Plus_Jakarta_Sans',sans-serif]">Misi Korporat Rootera</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        {{-- Misi 1 --}}
                        <div class="bg-[#081B33]/80 border border-slate-700/70 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl hover:border-emerald-500/50 transition-colors">
                            <div class="flex items-center gap-2 font-bold text-emerald-400 text-xs sm:text-sm mb-1">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0">1</span>
                                <span>Preservasi Bangunan</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                <strong>Zero-Destructive Method:</strong> Mengutamakan solusi mekanis fleksibel dan inspeksi visual CCTV 1080p tanpa membongkar keramik, semen, atau merusak estetika properti.
                            </p>
                        </div>

                        {{-- Misi 2 --}}
                        <div class="bg-[#081B33]/80 border border-slate-700/70 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl hover:border-emerald-500/50 transition-colors">
                            <div class="flex items-center gap-2 font-bold text-emerald-400 text-xs sm:text-sm mb-1">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0">2</span>
                                <span>Transparansi Mutlak</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Menghapus stigma "tukang tembak harga" melalui tarif jelas di awal, diagnosa faktual, serta kepastian garansi 30 hari tanpa perdebatan.
                            </p>
                        </div>

                        {{-- Misi 3 --}}
                        <div class="bg-[#081B33]/80 border border-slate-700/70 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl hover:border-emerald-500/50 transition-colors">
                            <div class="flex items-center gap-2 font-bold text-emerald-400 text-xs sm:text-sm mb-1">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0">3</span>
                                <span>Tanggap Darurat Presisi</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Mengintegrasikan sistem dispatch digital agar armada teknisi tersertifikasi K3 menjangkau lokasi masalah dalam waktu <strong>30–60 menit</strong>.
                            </p>
                        </div>

                        {{-- Misi 4 --}}
                        <div class="bg-[#081B33]/80 border border-slate-700/70 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl hover:border-emerald-500/50 transition-colors">
                            <div class="flex items-center gap-2 font-bold text-emerald-400 text-xs sm:text-sm mb-1">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0">4</span>
                                <span>Edukasi Sanitasi</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Memberikan wawasan pencegahan jangka panjang kepada pemilik rumah dan bisnis agar jaringan drainase tetap sehat &amp; bebas bau.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 3. 👥 TIM & HIERARKI KARYAWAN ROOTERA (3-TIER STRUCTURE SHOWCASE)         --}}
{{-- ========================================================================= --}}
<section id="expert-team" class="py-10 md:py-16 lg:py-20 bg-[#07172B] text-white relative border-t border-slate-800" aria-labelledby="team-heading">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-emerald-500/5 blur-[120px] pointer-events-none rounded-full" aria-hidden="true"></div>
    
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-8 md:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 uppercase tracking-wider mb-3 sm:mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                👥 Tim &amp; Hierarki Karyawan Rootera
            </span>
            <h2 id="team-heading" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-white leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                Struktur Tim Ahli &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Armada Lapangan</span>
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm md:text-base mt-2 sm:mt-3 max-w-2xl mx-auto leading-relaxed">
                Sosok profesional di balik presisi penanganan, keselamatan K3, dan respon darurat 24 jam pelancaran pipa mampet di seluruh wilayah operasional.
            </p>
        </div>

        {{-- Tab Filter Pill Navigation --}}
        <div class="flex flex-wrap justify-center items-center gap-1.5 sm:gap-3 mb-8 md:mb-12">
            <button type="button" 
                    onclick="filterTeam('all')" 
                    id="tab-all" 
                    class="team-tab-btn px-3 py-1.5 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 border border-emerald-500">
                Semua Tim
            </button>
            <button type="button" 
                    onclick="filterTeam('pimpinan')" 
                    id="tab-pimpinan" 
                    class="team-tab-btn px-3 py-1.5 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-[#0E2847] text-slate-300 hover:text-white border border-slate-700/80 hover:border-emerald-500/50">
                Pimpinan &amp; Manajemen
            </button>
            <button type="button" 
                    onclick="filterTeam('staf-cs')" 
                    id="tab-staf-cs" 
                    class="team-tab-btn px-3 py-1.5 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-[#0E2847] text-slate-300 hover:text-white border border-slate-700/80 hover:border-emerald-500/50">
                Staf &amp; CS WhatsApp
            </button>
            <button type="button" 
                    onclick="filterTeam('teknisi')" 
                    id="tab-teknisi" 
                    class="team-tab-btn px-3 py-1.5 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-[#0E2847] text-slate-300 hover:text-white border border-slate-700/80 hover:border-emerald-500/50">
                Teknisi Lapangan
            </button>
        </div>

        {{-- 3-TIER TEAM SHOWCASE CONTAINER --}}
        <div id="team-showcase-container" class="space-y-10 sm:space-y-12">
            
            {{-- TIER 1: THE FOUNDER & LEADER (Solo Showcase — Kartu Tunggal Heroik) --}}
            <div id="tier-pimpinan-wrapper" class="team-tier-block transition-all duration-300">
                <div class="flex items-center gap-3 mb-4 sm:mb-6 pb-2 border-b border-slate-800">
                    <span class="px-2.5 py-0.5 rounded-md text-[10px] sm:text-xs font-semibold uppercase tracking-wider bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Tier 1</span>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-white font-['Plus_Jakarta_Sans',sans-serif]">The Founder &amp; Executive Leader</h3>
                </div>

                {{-- Solo Showcase Heroic Card --}}
                @foreach($teamMembers as $member)
                    @if(($member['tier'] ?? 0) === 1)
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-[#0B223D]/90 border-2 border-emerald-500/40 hover:border-emerald-400 rounded-2xl sm:rounded-3xl overflow-hidden shadow-[0_0_50px_rgba(16,185,129,0.2)] transition-all duration-500 flex flex-col md:flex-row group">
                            {{-- Photo Frame (Centered & Compact in Mobile) --}}
                            <div class="w-full md:w-72 lg:w-80 aspect-[3/4] sm:aspect-[4/5] overflow-hidden relative bg-[#07172B] shrink-0 max-w-[220px] sm:max-w-[260px] md:max-w-none mx-auto md:mx-0 my-4 md:my-0 rounded-2xl md:rounded-none">
                                <img src="{{ $member['image'] }}" 
                                     alt="{{ $member['alt'] ?? $member['name'] }}" 
                                     loading="eager" 
                                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[10px] sm:text-xs font-semibold uppercase tracking-wider bg-slate-950/90 text-emerald-400 backdrop-blur-md border border-emerald-500/40 shadow-lg">
                                    {{ $member['badge'] ?? 'FOUNDER & EXECUTIVE LEADER' }}
                                </span>
                            </div>

                            {{-- Content --}}
                            <div class="p-4 sm:p-6 md:p-8 flex-1 flex flex-col justify-between bg-gradient-to-br from-[#0D2644] to-[#07192E]">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[10px] sm:text-xs font-semibold text-emerald-400 uppercase tracking-wider">Rootera Plumbing Leadership</span>
                                    </div>
                                    <h4 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif] group-hover:text-emerald-300 transition-colors">
                                        {{ $member['name'] }}
                                    </h4>
                                    <p class="text-xs sm:text-sm font-bold text-emerald-400 mt-0.5">
                                        {{ $member['role'] }}
                                    </p>
                                    
                                    @if(!empty($member['experience']))
                                    <div class="mt-2.5">
                                        <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                            ⚡ {{ $member['experience'] }}
                                        </span>
                                    </div>
                                    @endif

                                    @if(!empty($member['quote']))
                                    <blockquote class="text-xs sm:text-sm text-slate-200 leading-relaxed italic border-l-2 border-emerald-500 pl-3 my-3 bg-[#061730] p-3.5 rounded-xl shadow-inner">
                                        “{{ $member['quote'] }}”
                                    </blockquote>
                                    @endif
                                </div>

                                <div class="mt-4 pt-3.5 border-t border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                                    <span class="text-xs text-slate-400 font-medium flex items-center gap-1.5">
                                        🛡️ <span>{{ $member['certification'] ?? 'Sertifikasi K3 & Technical Specialist' }}</span>
                                    </span>
                                    @if(!empty($member['slug']))
                                    <a href="{{ route('tentang-kami.team-member', $member['slug']) }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 text-xs sm:text-sm font-extrabold py-3 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white shadow-lg shadow-emerald-600/30 transition-all min-h-[44px]">
                                        <span>Pelajari Profil &amp; Perjalanan Lengkap</span> &rarr;
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            {{-- TIER 2: STAFF KANTOR & CUSTOMER SERVICE --}}
            <div id="tier-staf-cs-wrapper" class="team-tier-block transition-all duration-300">
                <div class="flex items-center gap-3 mb-4 sm:mb-6 pb-2 border-b border-slate-800">
                    <span class="px-2.5 py-0.5 rounded-md text-[10px] sm:text-xs font-semibold uppercase tracking-wider bg-blue-500/20 text-blue-400 border border-blue-500/30">Tier 2</span>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-white font-['Plus_Jakarta_Sans',sans-serif]">Staf Kantor &amp; Customer Service</h3>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 md:gap-4 lg:gap-6">
                    @foreach($teamMembers as $member)
                        @if(($member['tier'] ?? 0) === 2)
                        <div class="team-card team-card-staf-cs bg-[#0B223D]/80 border border-slate-700/60 hover:border-emerald-400/50 rounded-2xl p-3 sm:p-4 text-center hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                            <div>
                                {{-- Portrait Photo Frame (aspect-[4/5] object-cover object-top) --}}
                                <div class="aspect-[4/5] overflow-hidden rounded-xl bg-[#07172B] relative shadow-md border border-slate-700/60">
                                    <img src="{{ $member['image'] }}" 
                                         alt="{{ $member['alt'] ?? $member['name'] }}" 
                                         loading="lazy" 
                                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider bg-slate-900/90 text-emerald-400 backdrop-blur-xs border border-emerald-500/30">
                                        {{ $member['badge'] ?? 'Staff Support' }}
                                    </span>
                                </div>

                                {{-- Details Below Photo --}}
                                <div class="mt-2.5">
                                    <h4 class="text-xs sm:text-sm md:text-base font-bold text-white font-['Plus_Jakarta_Sans',sans-serif] group-hover:text-emerald-400 transition-colors truncate">
                                        {{ $member['name'] }}
                                    </h4>
                                    <p class="text-[11px] sm:text-xs text-emerald-400 font-medium truncate mt-0.5">
                                        {{ $member['role'] }}
                                    </p>
                                    @if(!empty($member['experience']))
                                    <div class="mt-1.5">
                                        <span class="text-[10px] bg-slate-800/80 border border-slate-700 px-2 py-0.5 rounded-full text-slate-300 inline-block text-center truncate max-w-full">
                                            ⚡ {{ $member['experience'] }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- TIER 3: TEKNISI ARMADA LAPANGAN --}}
            <div id="tier-teknisi-wrapper" class="team-tier-block transition-all duration-300">
                <div class="flex items-center gap-3 mb-4 sm:mb-6 pb-2 border-b border-slate-800">
                    <span class="px-2.5 py-0.5 rounded-md text-[10px] sm:text-xs font-semibold uppercase tracking-wider bg-amber-500/20 text-amber-400 border border-amber-500/30">Tier 3</span>
                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-white font-['Plus_Jakarta_Sans',sans-serif]">Teknisi Armada Lapangan (24 Jam)</h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-4">
                    @foreach($teamMembers as $member)
                        @if(($member['tier'] ?? 0) === 3)
                        <div class="team-card team-card-teknisi bg-[#0D2440] border border-slate-700/60 hover:border-emerald-400 rounded-xl sm:rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col justify-between group p-2 sm:p-3">
                            <div>
                                {{-- Aspect Ratio Photo Frame --}}
                                <div class="aspect-[4/5] overflow-hidden relative bg-[#07172B] rounded-lg sm:rounded-xl">
                                    <img src="{{ $member['image'] }}" 
                                         alt="{{ $member['alt'] ?? $member['name'] }}" 
                                         loading="lazy" 
                                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-1.5 left-1.5 px-1.5 py-0.5 rounded text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider bg-slate-900/90 text-emerald-400 backdrop-blur-xs border border-emerald-500/30">
                                        {{ $member['badge'] ?? 'Teknisi' }}
                                    </span>
                                </div>

                                {{-- Details --}}
                                <div class="p-2 sm:p-3 pt-2">
                                    <h4 class="text-xs sm:text-sm font-bold text-white font-['Plus_Jakarta_Sans',sans-serif] leading-tight group-hover:text-emerald-400 transition-colors">
                                        {{ $member['name'] }}
                                    </h4>
                                    <p class="text-[11px] sm:text-xs text-slate-300 font-medium leading-snug mt-0.5 truncate">
                                        {{ $member['role'] }}
                                    </p>
                                    <div class="mt-1 text-[10px] sm:text-[11px] text-emerald-400 font-medium flex items-center gap-1">
                                        <span>📍</span> <span class="truncate">{{ $member['area'] ?? 'Area Metro' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Micro-interaction Trigger Button --}}
                            <div class="p-1 sm:p-2 pt-0">
                                <button type="button" 
                                        onclick="openTechnicianModal({{ json_encode($member) }})"
                                        class="w-full py-1.5 px-2 bg-emerald-500/15 hover:bg-emerald-600 text-emerald-300 hover:text-white font-bold text-[11px] sm:text-xs rounded-lg border border-emerald-500/30 transition-all flex items-center justify-center gap-1">
                                    <span>🔍 Lihat Keahlian</span>
                                </button>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</section>

{{-- Technician Quick Detail Modal --}}
<div id="tech-modal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm hidden flex items-center justify-center p-4 transition-opacity duration-300" onclick="closeTechnicianModal(event)">
    <div class="bg-[#0B223D] border border-emerald-500/40 rounded-2xl sm:rounded-3xl max-w-md w-full overflow-hidden shadow-2xl relative text-white animate-in fade-in zoom-in-95 duration-200" onclick="event.stopPropagation()">
        {{-- Close Button --}}
        <button type="button" onclick="closeTechnicianModal()" class="absolute top-4 right-4 text-slate-400 hover:text-white w-8 h-8 bg-slate-800/80 rounded-full flex items-center justify-center font-bold">
            &times;
        </button>

        <div class="p-4 sm:p-6">
            <div class="flex items-center gap-3.5 mb-4">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl sm:rounded-2xl overflow-hidden bg-slate-900 border border-slate-700 shrink-0">
                    <img id="modal-img" src="" alt="" class="w-full h-full object-cover object-top">
                </div>
                <div class="min-w-0">
                    <span id="modal-badge" class="px-2 py-0.5 rounded text-[9px] sm:text-[10px] font-semibold uppercase tracking-wider bg-emerald-500/20 text-emerald-400 border border-emerald-500/30"></span>
                    <h3 id="modal-name" class="text-base sm:text-lg font-bold text-white font-['Plus_Jakarta_Sans',sans-serif] mt-1 truncate"></h3>
                    <p id="modal-role" class="text-xs text-slate-300 font-medium truncate"></p>
                    <p id="modal-area" class="text-xs text-emerald-400 font-semibold mt-0.5 flex items-center gap-1 truncate"></p>
                </div>
            </div>

            <div class="space-y-3 bg-[#07172B] p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-800 text-xs sm:text-sm">
                <div>
                    <span class="text-slate-400 uppercase tracking-wider text-[9px] sm:text-[10px] font-bold block">Keahlian &amp; Spesialisasi</span>
                    <p id="modal-spec" class="text-slate-200 font-medium mt-0.5"></p>
                </div>
                <div>
                    <span class="text-slate-400 uppercase tracking-wider text-[9px] sm:text-[10px] font-bold block">Alat &amp; Sertifikasi K3</span>
                    <p id="modal-cert" class="text-emerald-400 font-semibold mt-0.5"></p>
                </div>
            </div>

            <div class="mt-5 flex items-center gap-2.5">
                <a id="modal-wa-btn" href="#" target="_blank" rel="noopener" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold py-3 px-4 rounded-xl text-center text-xs sm:text-sm shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center gap-2 min-h-[44px]">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                    <span>Panggil Teknisi Ini via WA</span>
                </a>
                <button type="button" onclick="closeTechnicianModal()" class="py-3 px-4 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold rounded-xl text-xs min-h-[44px]">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function filterTeam(category) {
    document.querySelectorAll('.team-tab-btn').forEach(btn => {
        btn.classList.remove('bg-emerald-600', 'text-white', 'shadow-lg', 'shadow-emerald-600/30', 'border-emerald-500');
        btn.classList.add('bg-[#0E2847]', 'text-slate-300', 'border-slate-700/80');
    });

    const activeBtn = document.getElementById('tab-' + category);
    if (activeBtn) {
        activeBtn.classList.remove('bg-[#0E2847]', 'text-slate-300', 'border-slate-700/80');
        activeBtn.classList.add('bg-emerald-600', 'text-white', 'shadow-lg', 'shadow-emerald-600/30', 'border-emerald-500');
    }

    const tierPimpinan = document.getElementById('tier-pimpinan-wrapper');
    const tierStaf = document.getElementById('tier-staf-cs-wrapper');
    const tierTeknisi = document.getElementById('tier-teknisi-wrapper');

    if (category === 'all') {
        tierPimpinan.style.display = 'block';
        tierStaf.style.display = 'block';
        tierTeknisi.style.display = 'block';
    } else if (category === 'pimpinan') {
        tierPimpinan.style.display = 'block';
        tierStaf.style.display = 'none';
        tierTeknisi.style.display = 'none';
    } else if (category === 'staf-cs') {
        tierPimpinan.style.display = 'none';
        tierStaf.style.display = 'block';
        tierTeknisi.style.display = 'none';
    } else if (category === 'teknisi') {
        tierPimpinan.style.display = 'none';
        tierStaf.style.display = 'none';
        tierTeknisi.style.display = 'block';
    }
}

function openTechnicianModal(member) {
    document.getElementById('modal-img').src = member.image;
    document.getElementById('modal-name').innerText = member.name;
    document.getElementById('modal-role').innerText = member.role;
    document.getElementById('modal-badge').innerText = member.badge || 'Teknisi Certified';
    document.getElementById('modal-area').innerText = '📍 ' + (member.area || 'Area Metro');
    document.getElementById('modal-spec').innerText = member.specialization || 'Pelancaran Saluran Air Mampet';
    document.getElementById('modal-cert').innerText = member.certification || 'Sertifikasi K3 Plumbing';
    
    const waText = encodeURIComponent('Halo Rootera, saya ingin panggil teknisi ' + member.name + ' (' + member.role + ') untuk lokasi saya.');
    document.getElementById('modal-wa-btn').href = 'https://wa.me/6281385404000?text=' + waText;
    
    const modal = document.getElementById('tech-modal');
    modal.classList.remove('hidden');
}

function closeTechnicianModal() {
    const modal = document.getElementById('tech-modal');
    modal.classList.add('hidden');
}
</script>

{{-- ========================================================================= --}}
{{-- 4. CORE VALUES (4 PILAR UNGGULAN ROOTERA)                                 --}}
{{-- ========================================================================= --}}
<section class="py-10 md:py-16 lg:py-20 bg-[#0B2545] text-white relative overflow-hidden" aria-labelledby="values-heading">
    <div class="absolute top-0 right-0 w-80 md:w-96 h-80 md:h-96 bg-emerald-500/10 blur-3xl pointer-events-none"></div>
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-8 md:mb-12">
            <span class="inline-block px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold bg-white/10 text-emerald-400 uppercase tracking-wider mb-2.5 border border-white/15">Why Choose Us</span>
            <h2 id="values-heading" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-white leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                4 Pilar Utama Keunggulan <span class="text-emerald-400">Rootera Plumbing</span>
            </h2>
            <p class="text-slate-300 text-xs sm:text-sm md:text-base mt-2">
                Jaminan pengerjaan bermutu tinggi dengan pendekatan ilmiah &amp; teknologi tanpa bongkar.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($advantages as $adv)
            <div class="bg-white/5 border border-white/10 hover:border-emerald-400/50 rounded-2xl p-4 sm:p-6 transition-all duration-300 hover:-translate-y-1.5 hover:bg-white/10 hover:shadow-xl group flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl sm:text-2xl font-bold mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        {{ $adv['icon'] }}
                    </div>
                    <span class="inline-block text-[10px] uppercase font-semibold tracking-wider px-2.5 py-0.5 rounded bg-emerald-400/20 text-emerald-300 mb-2">
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
<section class="py-10 md:py-16 lg:py-20 bg-white" aria-labelledby="subpages-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-8 md:mb-12">
            <span class="inline-block px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold bg-emerald-100 text-emerald-700 uppercase tracking-wider mb-2.5">Sub-Halaman Informasi</span>
            <h2 id="subpages-heading" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                Pelajari Kredibilitas &amp; <span class="text-emerald-600">Standar Layanan Kami</span>
            </h2>
            <p class="text-slate-600 text-xs sm:text-sm md:text-base mt-2">
                Temukan informasi mendalam tentang legalitas K3, teknologi mesin, portofolio proyek B2B, garansi, dan FAQ.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            {{-- Card 1: Profil & K3 --}}
            <a href="{{ route('tentang-kami.profil') }}" class="group bg-slate-50 hover:bg-emerald-50/60 border border-slate-200/80 hover:border-emerald-400 p-4 sm:p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl sm:text-2xl mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        🏢
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-emerald-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Profil Perusahaan &amp; Standar K3
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3 sm:mb-4">
                        Legalitas usaha resmi, SOP sterilisasi alat, protokol APD teknisi, serta filosofi layanan Rootera.
                    </p>
                </div>
                <div class="text-xs font-bold text-emerald-600 group-hover:text-emerald-700 flex items-center gap-1">
                    <span>Baca Profil Selengkapnya</span> &rarr;
                </div>
            </a>

            {{-- Card 2: Peralatan & Teknologi --}}
            <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="group bg-slate-50 hover:bg-blue-50/60 border border-slate-200/80 hover:border-blue-400 p-4 sm:p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl sm:text-2xl mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        ⚙️
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-blue-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Peralatan &amp; Teknologi Modern
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3 sm:mb-4">
                        Spesifikasi Mesin Ridgid Amerika, Mikro Kamera CCTV Flex 1080p, &amp; Hydro Jetting 300 Bar.
                    </p>
                </div>
                <div class="text-xs font-bold text-blue-600 group-hover:text-blue-700 flex items-center gap-1">
                    <span>Lihat Spesifikasi Mesin</span> &rarr;
                </div>
            </a>

            {{-- Card 3: Portofolio B2B --}}
            <a href="{{ route('tentang-kami.portofolio-klien') }}" class="group bg-slate-50 hover:bg-purple-50/60 border border-slate-200/80 hover:border-purple-400 p-4 sm:p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl sm:text-2xl mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        📁
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-purple-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Klien &amp; Portofolio B2B
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3 sm:mb-4">
                        Rekam jejak pengerjaan di restoran, mall, hotel, gedung kantor, hingga kawasan industri BUMN.
                    </p>
                </div>
                <div class="text-xs font-bold text-purple-600 group-hover:text-purple-700 flex items-center gap-1">
                    <span>Lihat Portofolio B2B</span> &rarr;
                </div>
            </a>

            {{-- Card 4: Garansi Layanan --}}
            <a href="{{ route('tentang-kami.garansi-layanan') }}" class="group bg-slate-50 hover:bg-amber-50/60 border border-slate-200/80 hover:border-amber-400 p-4 sm:p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl sm:text-2xl mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        🛡️
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-amber-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Garansi Pengerjaan 30 Hari
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3 sm:mb-4">
                        Penjelasan transparan SOP klaim garansi 30 hari, syarat &amp; ketentuan, dan prinsip "Tuntas Baru Bayar".
                    </p>
                </div>
                <div class="text-xs font-bold text-amber-600 group-hover:text-amber-700 flex items-center gap-1">
                    <span>Kebijakan Garansi</span> &rarr;
                </div>
            </a>

            {{-- Card 5: FAQ & Pusat Bantuan --}}
            <a href="{{ route('faq.index') }}" class="group bg-slate-50 hover:bg-rose-50/60 border border-slate-200/80 hover:border-rose-400 p-4 sm:p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-md flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center text-xl sm:text-2xl mb-3 sm:mb-4 group-hover:scale-110 transition-transform">
                        ❓
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-rose-700 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        FAQ / Pusat Bantuan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3 sm:mb-4">
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
{{-- 5.5. 📍 KANTOR PUSAT & WORKSHOP OPERASIONAL (EMBED GOOGLE MAPS E-E-A-T)    --}}
{{-- ========================================================================= --}}
<section class="py-10 md:py-16 lg:py-20 bg-[#07172B] text-white relative border-t border-slate-800" aria-labelledby="workshop-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="bg-[#0B223D]/80 border border-slate-700/50 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 lg:p-10 backdrop-blur-md shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 lg:gap-10 items-center">
                
                {{-- Sisi Kiri / Info Kontak & Legalitas (lg:col-span-5) --}}
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div>
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] sm:text-xs font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-400/30 uppercase tracking-wider mb-3 sm:mb-4">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            PUSAT LOGISTIK &amp; KANTOR PUSAT
                        </span>
                        
                        <h2 id="workshop-heading" class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white leading-snug font-['Plus_Jakarta_Sans',sans-serif] mb-3 sm:mb-4">
                            Kunjungi Workshop &amp; <span class="text-emerald-400">Hub Operasional Resmi Kami</span>
                        </h2>
                        
                        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-4 sm:mb-5">
                            Pusat komando logistik armada teknisi, pemeliharaan mesin spiral fleksibel, inventaris hydro-jetting, dan penjaminan mutu garansi Rootera Plumbing.
                        </p>

                        {{-- Keywords On-Page Subtitle Pills --}}
                        <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-4 sm:mb-6">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] sm:text-[11px] font-semibold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                                🏛️ Profil Perusahaan &amp; Legalitas Operasional
                            </span>
                            <span class="px-2.5 py-1 rounded-lg text-[10px] sm:text-[11px] font-semibold bg-blue-500/15 text-blue-300 border border-blue-500/30">
                                🏬 Workshop &amp; Pusat Logistik Armada Jakarta Timur
                            </span>
                            <span class="px-2.5 py-1 rounded-lg text-[10px] sm:text-[11px] font-semibold bg-teal-500/15 text-teal-300 border border-teal-500/30">
                                🛡️ Spesialis Pipa Mampet Tanpa Bongkar Bergaransi
                            </span>
                        </div>

                        {{-- Card Detail Alamat & Operasional --}}
                        <div class="space-y-3 sm:space-y-4 mb-5 sm:mb-6">
                            {{-- Card 1: Detail Alamat --}}
                            <div class="bg-[#07172B] border border-slate-700/80 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl flex items-start gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-lg sm:text-xl shrink-0 border border-emerald-500/30">
                                    📍
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-[10px] sm:text-[11px] uppercase tracking-wider font-extrabold text-emerald-400">Alamat Lengkap:</h4>
                                    <p class="text-xs sm:text-sm font-semibold text-white mt-0.5">Rootera Plumbing - Jasa Saluran Pipa Mampet</p>
                                    <p class="text-xs text-slate-300 mt-0.5 leading-snug">
                                        Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13770
                                    </p>
                                </div>
                            </div>

                            {{-- Card 2: Jam Operasional & Layanan --}}
                            <div class="bg-[#07172B] border border-slate-700/80 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl flex items-start gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold text-lg sm:text-xl shrink-0 border border-blue-500/30">
                                    ⏰
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-[10px] sm:text-[11px] uppercase tracking-wider font-extrabold text-blue-400">Jam Operasional &amp; Jangkauan:</h4>
                                    <p class="text-xs sm:text-sm font-semibold text-white mt-0.5">Operasional 24 Jam Nonstop (Senin – Minggu)</p>
                                    <p class="text-xs text-slate-300 mt-0.5 leading-snug">
                                        Melayani Jabodetabek, Lampung, dan kota ekspansi lainnya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CTA Button (44px Minimum Touch Target) --}}
                    <div>
                        <a href="https://maps.google.com/?cid=16012437648585635749" 
                           target="_blank" rel="noopener noreferrer" 
                           class="inline-flex items-center justify-center gap-2 w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs sm:text-sm py-3.5 px-6 rounded-xl shadow-lg shadow-emerald-600/30 transition-all border border-emerald-500 min-h-[44px]">
                            <span>Buka Petunjuk Arah di Google Maps ↗</span>
                        </a>
                    </div>
                </div>

                {{-- Sisi Kanan / Embed Google Maps Interaktif (lg:col-span-7) --}}
                <div class="lg:col-span-7">
                    <div class="relative w-full h-[260px] sm:h-[320px] md:h-[400px] rounded-xl sm:rounded-2xl overflow-hidden border border-slate-700/60 shadow-xl bg-[#07172B]">
                        <iframe 
                          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15862.051339859769!2d106.862779!3d-6.327526000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed006e00b8b5%3A0xde36fb02cfc2b7a5!2sRootera%20Plumbing%20-%20Jasa%20Saluran%20Pipa%20Mampet!5e0!3m2!1sid!2sid!4v1788370210222!5m2!1sid!2sid" 
                          class="w-full h-full border-0" 
                          allowfullscreen="" 
                          loading="lazy" 
                          referrerpolicy="strict-origin-when-cross-origin">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 6. CTA KONVERSI & FLOATING MOBILE BAR                                    --}}
{{-- ========================================================================= --}}
<section class="py-10 md:py-16 lg:py-20 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#051428] text-white relative overflow-hidden mb-12 lg:mb-0">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/40 px-3.5 py-1 rounded-full text-xs font-bold text-emerald-400 uppercase tracking-wider mb-4 sm:mb-6">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Respons Darurat 24 Jam
        </span>

        <h2 class="text-xl sm:text-3xl md:text-4xl font-extrabold text-white leading-tight mb-3 sm:mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
            Butuh Bantuan Saluran Air Mampet Hari Ini?<br>
            <span class="text-emerald-400">Tim Teknisi Siaga Tiba 30-60 Menit</span>
        </h2>

        <p class="text-slate-200 text-xs sm:text-sm md:text-base max-w-2xl mx-auto leading-relaxed mb-6 sm:mb-8">
            Konsultasikan kendala pipa rumah, ruko, restoran, atau pabrik Anda secara gratis. Bebas biaya pengerjaan jika saluran tidak lancar!
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 max-w-xl mx-auto">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya mau panggil teknisi pipa mampet.') }}" 
               target="_blank" rel="noopener" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs sm:text-sm md:text-base py-3.5 sm:py-4 px-6 sm:px-8 rounded-xl sm:rounded-2xl flex items-center justify-center gap-3 shadow-lg shadow-emerald-600/40 transition-all min-h-[44px]">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                <span>Panggil Teknisi via WhatsApp (24 Jam)</span>
            </a>
        </div>
    </div>
</section>

{{-- Floating Sticky Mobile CTA Bar --}}
<div class="fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/80 p-2.5 sm:p-3 lg:hidden shadow-2xl flex items-center gap-2">
    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya mau panggil teknisi pelancar pipa.') }}" 
       target="_blank" rel="noopener" 
       class="flex-1 py-3 px-3 sm:px-4 bg-emerald-600 active:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm rounded-xl flex items-center justify-center gap-2 shadow-md min-h-[44px]">
        <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
        <span>Konsultasi &amp; Panggil Teknisi</span>
    </a>
    <a href="tel:+6281385404000" class="py-3 px-3 sm:px-3.5 bg-slate-900 text-white rounded-xl font-bold text-xs flex items-center justify-center min-h-[44px]">
        <span>📞 Telepon</span>
    </a>
</div>

</div> {{-- End Master Wrapper --}}

@endsection
