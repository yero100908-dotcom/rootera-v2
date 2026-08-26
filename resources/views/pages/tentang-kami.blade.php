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
          "hasCredential" => $member['badge'] ?? "Teknisi Bersertifikat"
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
  "image" => asset('images/JnJ.webp'),
  "telephone" => "+6281385404000",
  "priceRange" => "$$",
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
  ]
];

if (!empty($employeeSchema)) {
    $organizationSchema['employee'] = $employeeSchema;
}

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
    $organizationSchema
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($aboutPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. HERO SECTION & VALUE PROPOSITION (WITH FLOATING STATS RIBBON)          --}}
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
        <path d="M-150,30 C250,170 550,-100 900,120 C1100,220 1300,80 1500,170" fill="none" stroke="url(#about-hero-wave)" stroke-width="1.5" stroke-dasharray="6,6"></path>
    </svg>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Home</a>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-emerald-400 font-semibold">Tentang Kami</span>
        </nav>

        {{-- Glowing Capsule Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-emerald-400/30 px-4 py-1.5 rounded-full text-xs sm:text-sm font-bold text-emerald-400 uppercase tracking-wider mb-6 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_10px_#10B981]"></span>
            Pionir Plumbing &amp; Drainase Modern Tanpa Bongkar
        </div>

        {{-- Main Headline --}}
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-4xl mx-auto tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
            Mendefinisikan Ulang Solusi Sanitasi &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Plumbing Modern</span> di Indonesia.
        </h1>

        {{-- Sub-headline --}}
        <p class="text-slate-200 text-sm sm:text-base md:text-lg max-w-3xl mx-auto leading-relaxed mb-8">
            Rootera berkomitmen menghadirkan layanan pembersihan drainase &amp; perbaikan pipa tanpa bongkar menggunakan teknologi <strong>Hydro-Jetting bertekanan tinggi</strong>, <strong>kamera CCTV inspeksi presisi</strong>, dan standar higienitas tertinggi yang aman bagi struktur properti Anda.
        </p>
    </div>

    {{-- Bottom Wave Divider --}}
    <div class="absolute bottom-0 left-0 w-full h-[60px] md:h-[90px] pointer-events-none z-10">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="w-full h-full block">
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.15"></path>
            <path d="M0,90 C360,130 720,40 1080,110 C1260,130 1360,100 1440,90 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>
</section>

{{-- Floating Key Metrics Ribbon --}}
<div class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 md:-mt-20 mb-12">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
        <div class="flex flex-col items-center justify-center p-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-[#0B2545] font-['Plus_Jakarta_Sans',sans-serif] mb-1">2.300+</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-500">Masalah Pipa Terselesaikan</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-4 md:pt-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-[#10B981] font-['Plus_Jakarta_Sans',sans-serif] mb-1">6+ Tahun</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-500">Pengalaman Terpercaya</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-4 md:pt-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-[#1E73D8] font-['Plus_Jakarta_Sans',sans-serif] mb-1">100%</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-500">Bergaransi &amp; Tanpa Bongkar</div>
        </div>
        <div class="flex flex-col items-center justify-center p-2 pt-4 md:pt-2">
            <div class="text-3xl sm:text-4xl font-extrabold text-[#0B2545] font-['Plus_Jakarta_Sans',sans-serif] mb-1">24/7</div>
            <div class="text-xs sm:text-sm font-semibold text-slate-500">Respons Cepat Darurat</div>
        </div>
    </div>
</div>

{{-- ========================================================================= --}}
{{-- 2. OUR STORY & BRAND PURPOSE (KENAPA ROOTERA LAHIR?)                      --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-white" aria-labelledby="story-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- Left Column: Image Showcase & Badges --}}
            <div class="lg:col-span-6 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-50 group">
                    <img src="{{ asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp') }}" 
                         alt="Armada dan Teknisi Rootera Plumbing Penanganan Pipa Mampet Tanpa Bongkar" 
                         loading="lazy" 
                         decoding="async" 
                         width="600" 
                         height="480" 
                         class="w-full h-[400px] sm:h-[480px] object-cover transform transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B2545]/90 via-[#0B2545]/20 to-transparent"></div>
                    
                    {{-- Floating Glassmorphism Badge --}}
                    <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-4 sm:p-5 rounded-2xl border border-white/40 shadow-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xl shrink-0">
                                🛠️
                            </div>
                            <div>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900">Peralatan Modern &amp; APD Higienis</h4>
                                <p class="text-xs text-slate-600">Hydro-Jetting, Spiral Cable Machine &amp; Kamera CCTV Inspeksi</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Corner Floating Badge --}}
                <div class="absolute -top-4 -right-4 sm:-top-6 sm:-right-6 bg-[#0B2545] text-white p-4 rounded-2xl shadow-xl border border-white/20 hidden sm:block">
                    <div class="text-center font-bold text-xs uppercase tracking-wider text-emerald-400">Metode Unggulan</div>
                    <div class="text-base font-extrabold text-white">100% Non-Destructive</div>
                </div>
            </div>

            {{-- Right Column: Storytelling & Purpose --}}
            <div class="lg:col-span-6 flex flex-col justify-center">
                <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-[#00A86B] uppercase tracking-wider w-fit mb-4">Cerita &amp; Tujuan Kami</span>
                <h2 id="story-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                    Berangkat dari Keresahan Metode Plumbing Lama yang <span class="text-red-600 underline decoration-red-200">Merusak Properti</span>
                </h2>
                
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-4">
                    Di Indonesia, masalah pipa mampet sering kali diselesaikan dengan cara konvensional yang destruktif—membongkar lantai keramik, merusak dinding, atau menggali taman. Proses ini tidak hanya memakan waktu dan biaya pemulihan yang mahal, tetapi juga menyisakan kotoran, bau tidak sedap, serta mengganggu estetika bangunan Anda.
                </p>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-6">
                    <strong>Rootera Plumbing</strong> lahir sebagai evolusi layanan sanitasi profesional modern. Kami menggabungkan peralatan teknologi tinggi dengan teknisi terlatih untuk melancarkan saluran mampet dalam hitungan jam tanpa merusak struktur bangunan satu milimeter pun.
                </p>

                {{-- Heritage Block: J&J Group --}}
                <div class="bg-gradient-to-r from-slate-50 to-blue-50/50 border-l-4 border-[#0B2545] rounded-2xl p-5 mb-8 shadow-sm">
                    <div class="flex items-center gap-2 font-bold text-slate-900 text-sm sm:text-base mb-2">
                        <span class="text-emerald-600">🛡️</span> Bagian dari J&J Group: Warisan Pengalaman Lebih dari Satu Dekade
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Rootera berdiri kokoh di atas fondasi <strong>J&J Group (Jawa &amp; Jaya Rooter)</strong>—pionir layanan drainase nasional dengan rekam jejak lebih dari 10 tahun dalam menangani berbagai kasus pipa tersumbat di sektor rumah tangga hingga jaringan komersial dan korporat di Indonesia.
                    </p>
                </div>

                {{-- Vision & Mission Iconic Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50/60 border border-emerald-200/60 rounded-2xl p-4 transition-all hover:shadow-md">
                        <div class="flex items-center gap-2 font-bold text-[#0B2545] text-sm mb-1">
                            <span>🎯</span> Visi Perusahaan
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Menjadi penyedia layanan pipa &amp; drainase modern nomor 1 di Indonesia yang dikenal atas presisi teknologi, kecepatan respons, dan standar higienis internasional.
                        </p>
                    </div>
                    <div class="bg-blue-50/60 border border-blue-200/60 rounded-2xl p-4 transition-all hover:shadow-md">
                        <div class="flex items-center gap-2 font-bold text-[#0B2545] text-sm mb-1">
                            <span>🚀</span> Misi Utama
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Memberikan kepastian solusi pipa lancar tanpa bongkar, transparansi harga 100%, serta perlindungan garansi resmi demi kenyamanan setiap pelanggan.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 3. CORE VALUES & PRINSIP KERJA KAMI (4 PILAR ROOTERA)                    --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-[#0B2545] text-white relative overflow-hidden" aria-labelledby="values-heading">
    {{-- Ambient Lighting --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-white/10 text-emerald-400 uppercase tracking-wider mb-3 border border-white/15">Prinsip Kerja Rootera</span>
            <h2 id="values-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                4 Pilar Utama Layanan <span class="text-emerald-400">High-Trust</span> Kami
            </h2>
            <p class="text-slate-300 text-sm sm:text-base mt-3">
                Setiap pekerjaan dipandu oleh komitmen keamanan properti, higienitas, dan transparansi mutlak.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($advantages as $i => $adv)
            <div class="bg-white/5 border border-white/10 hover:border-emerald-400/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1.5 hover:bg-white/10 hover:shadow-xl group flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl font-bold mb-4 group-hover:scale-110 transition-transform">
                        @if($i == 0) 🛡️ @elseif($i == 1) ✨ @elseif($i == 2) 💎 @else 🍃 @endif
                    </div>
                    <span class="inline-block text-[10px] uppercase font-bold tracking-wider px-2.5 py-0.5 rounded bg-emerald-400/20 text-emerald-300 mb-2">
                        {{ $adv['badge'] ?? 'Pilar Utama' }}
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
{{-- 4. MEET THE TEAM & LEADERSHIP (MODERN STATE PLACEHOLDER BANNER)           --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-[#F8FAFC]" aria-labelledby="team-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($teamMembers) && count($teamMembers) > 0)
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
                <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-[#00A86B] uppercase tracking-wider mb-3">Tim Inti &amp; Manajemen</span>
                <h2 id="team-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                    Tim Profesional di Balik <span class="text-[#10B981]">Keunggulan Rootera</span>
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    Didorong oleh kepemimpinan berpengalaman, teknisi bersertifikasi master, dan manajemen armada respons cepat 24 jam.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                @foreach($teamMembers as $index => $member)
                @php
                    $isOwner = ($index == 0);
                @endphp
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border {{ $isOwner ? 'border-amber-300 ring-2 ring-amber-400/30' : 'border-slate-200/80' }} group flex flex-col justify-between">
                    <div>
                        <div class="relative w-full aspect-[3/4] overflow-hidden bg-slate-900">
                            <img src="{{ $member['image_url'] ?? asset('images/JnJ.jpeg') }}" 
                                 alt="{{ $member['name'] ?? 'Teknisi Rootera' }}" 
                                 loading="lazy" 
                                 decoding="async" 
                                 width="400" 
                                 height="533" 
                                 class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0B2545] via-[#0B2545]/20 to-transparent opacity-90"></div>
                            
                            <div class="absolute top-3 left-3">
                                <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider text-white {{ $isOwner ? 'bg-amber-500 shadow-md' : 'bg-emerald-600/90 backdrop-blur-md' }}">
                                    {{ $member['badge'] ?? 'Tim Rootera' }}
                                </span>
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <div class="text-xs font-semibold text-emerald-400 mb-0.5">{{ $member['experience'] ?? 'Pengalaman Teruji' }}</div>
                                <h3 class="text-lg sm:text-xl font-bold font-['Plus_Jakarta_Sans',sans-serif] leading-snug">{{ $member['name'] }}</h3>
                                <p class="text-xs text-slate-200 font-medium">{{ $member['role'] }}</p>
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="mb-3">
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Spesialisasi Utama:</span>
                                <span class="text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-lg inline-block">
                                    {{ $member['specialization'] ?? 'Spesialis Pipa' }}
                                </span>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic bg-slate-50 p-3 rounded-xl border border-slate-100">
                                "{{ $member['quote'] ?? $member['description'] ?? '' }}"
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5 pt-0">
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin berkonsultasi mengenai perbaikan saluran dengan tim Rootera') }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="w-full py-2.5 px-4 bg-slate-100 hover:bg-[#0B2545] hover:text-white text-slate-700 font-bold text-xs rounded-xl flex items-center justify-center gap-2 transition-colors text-decoration-none">
                            <span>Konsultasi via Tim WA</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Modern Team Placeholder / Status Notice Banner --}}
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#061730] text-white rounded-3xl p-8 sm:p-12 shadow-2xl relative overflow-hidden border border-emerald-500/30 text-center">
                    {{-- Ambient Glow Orbs --}}
                    <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 blur-3xl pointer-events-none rounded-full"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-500/10 blur-3xl pointer-events-none rounded-full"></div>

                    <div class="relative z-10">
                        {{-- Icon / Illustrated Safety Tech Badge --}}
                        <div class="w-20 h-20 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-4xl mb-6 mx-auto border border-emerald-400/30 shadow-[0_0_25px_rgba(16,185,129,0.25)]">
                            🛡️
                        </div>

                        {{-- Notice Badge --}}
                        <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/40 px-4 py-1.5 rounded-full text-xs font-bold text-emerald-400 uppercase tracking-wider mb-6">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_8px_#10B981]"></span>
                            Profil Tim Sedang Diperbarui
                        </div>

                        {{-- Headline --}}
                        <h2 id="team-heading" class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                            Didukung Puluhan Teknisi Bersertifikasi &amp;<br>
                            <span class="text-emerald-400">Tim Manajemen Berdedikasi</span>
                        </h2>

                        {{-- Sub-description --}}
                        <p class="text-slate-200 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8">
                            Kami sedang melakukan pembaruan katalog profil dan dokumentasi portofolio resmi seluruh jajaran teknisi spesialis, manajemen operasional, hingga dispatch 24 jam kami. Seluruh armada dan teknisi berlisensi Rootera tetap beroperasi penuh melayani kebutuhan Anda setiap hari.
                        </p>

                        {{-- Quick Action CTA --}}
                        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin terhubung dengan tim dispatch operasional.') }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="w-full sm:w-auto bg-[#10B981] hover:bg-emerald-600 text-white font-extrabold text-sm sm:text-base py-3.5 px-8 rounded-2xl inline-flex items-center justify-center gap-2 shadow-[0_10px_25px_rgba(16,185,129,0.35)] hover:scale-105 active:scale-95 transition-all text-decoration-none min-h-[48px]">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                                <span>Hubungi Tim Dispatch Kami (WA 24 Jam)</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 5. WORK IN ACTION (GALERI DOKUMENTASI & VIDEO RIIL - REAL PROOF)          --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-white border-t border-slate-100" aria-labelledby="gallery-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-[#0B2545] uppercase tracking-wider mb-3">Bukti Pengerjaan Riil</span>
            <h2 id="gallery-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Galeri Dokumentasi &amp; <span class="text-[#10B981]">Video Lapangan</span>
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3">
                Bukti nyata penanganan saluran mampet tanpa bongkar di stasiun, mall, industri, dan perumahan warga.
            </p>
        </div>

        {{-- Filter Category Tabs --}}
        <div class="flex justify-center gap-2 mb-10 flex-wrap">
            <button onclick="filterGallery('all')" id="gtab-all" class="gallery-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-[#0B2545] text-white shadow-md">
                Semua Dokumentasi
            </button>
            <button onclick="filterGallery('Hydro Jetting')" id="gtab-hydro" class="gallery-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">
                Hydro Jetting
            </button>
            <button onclick="filterGallery('CCTV Pipe Scan')" id="gtab-cctv" class="gallery-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">
                Inspeksi CCTV
            </button>
            <button onclick="filterGallery('Spiral Rigging')" id="gtab-spiral" class="gallery-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">
                Spiral Rigging
            </button>
            <button onclick="filterGallery('Commercial Grease Trap')" id="gtab-grease" class="gallery-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">
                Grease Trap B2B
            </button>
        </div>

        {{-- Gallery Grid Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($documentationGallery as $item)
            @php
                $catSlug = str_replace(' ', '_', $item['category']);
            @endphp
            <div class="gallery-item gcat-{{ $catSlug }} bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all group">
                
                @if(!empty($item['is_before_after']) && !empty($item['before_image']) && !empty($item['after_image']))
                    {{-- Before / After Comparison Display --}}
                    <div class="relative h-56 grid grid-cols-2 overflow-hidden">
                        <div class="relative h-full">
                            <img src="{{ $item['before_image'] }}" alt="Kondisi Sebelum Pembersihan" loading="lazy" decoding="async" width="300" height="224" class="w-full h-full object-cover">
                            <span class="absolute top-2 left-2 bg-red-600 text-white font-bold text-[10px] px-2 py-0.5 rounded shadow">SEBELUM</span>
                        </div>
                        <div class="relative h-full">
                            <img src="{{ $item['after_image'] }}" alt="{{ $item['alt_seo_text'] }}" loading="lazy" decoding="async" width="300" height="224" class="w-full h-full object-cover">
                            <span class="absolute top-2 right-2 bg-emerald-600 text-white font-bold text-[10px] px-2 py-0.5 rounded shadow">SESUDAH</span>
                        </div>
                    </div>
                @else
                    {{-- Standard Single Photo / Video Preview --}}
                    <div class="relative h-56 overflow-hidden bg-slate-900">
                        <img src="{{ $item['image_url'] }}" 
                             alt="{{ $item['alt_seo_text'] }}" 
                             loading="lazy" 
                             decoding="async" 
                             width="600" 
                             height="400" 
                             class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0B2545]/80 via-transparent to-transparent opacity-80"></div>
                        
                        {{-- Video Play Badge if Video exists --}}
                        @if(!empty($item['video_url']))
                            <button onclick="openVideoModal('{{ $item['video_url'] }}', '{{ addslashes($item['title']) }}')" 
                                    class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/40 transition-colors">
                                <div class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform animate-pulse">
                                    <svg class="w-6 h-6 fill-current ml-1" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </button>
                        @endif

                        <div class="absolute top-3 left-3 bg-[#0B2545]/90 text-emerald-400 text-[11px] font-bold px-2.5 py-0.5 rounded backdrop-blur-md">
                            {{ $item['category'] }}
                        </div>
                    </div>
                @endif

                <div class="p-5">
                    <span class="text-[11px] font-semibold text-slate-400 block mb-1">📍 {{ $item['location_tag'] }}</span>
                    <h3 class="text-base font-bold text-slate-900 mb-2 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">{{ $item['title'] }}</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $item['alt_seo_text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- Video Modal Popup --}}
<div id="videoModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-slate-900 rounded-2xl overflow-hidden w-full max-w-3xl border border-slate-700 shadow-2xl relative">
        <div class="p-4 bg-slate-800 flex justify-between items-center text-white border-b border-slate-700">
            <h4 id="videoModalTitle" class="font-bold text-sm sm:text-base">Video Dokumentasi Rootera</h4>
            <button onclick="closeVideoModal()" class="text-slate-400 hover:text-white font-bold text-xl px-2">&times;</button>
        </div>
        <div class="p-2 aspect-video bg-black flex items-center justify-center">
            <video id="videoModalPlayer" controls class="w-full h-full rounded-lg" srcset="">
                <source id="videoModalSource" src="" type="video/mp4">
                Browser Anda tidak mendukung pemutar video.
            </video>
        </div>
    </div>
</div>

{{-- ========================================================================= --}}
{{-- 6. STANDAR SOP & PERALATAN CANGGIH                                       --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-[#F8FAFC]" aria-labelledby="tech-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-[#0B2545] uppercase tracking-wider mb-3">Teknologi &amp; Standar Kerja</span>
            <h2 id="tech-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Peralatan Canggih &amp; <span class="text-[#10B981]">SOP Pengerjaan Presisi</span>
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3">
                Kami menginvestasikan teknologi mutakhir agar perbaikan pipa dilakukan dengan cepat, aman, dan tanpa bongkar.
            </p>
        </div>

        {{-- Technologies Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            @foreach($technologies as $tech)
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all group">
                <div class="relative h-48 overflow-hidden bg-slate-900">
                    <img src="{{ $tech['image'] }}" 
                         alt="{{ $tech['name'] }} spesifikasi {{ $tech['specs'] }} Rootera Plumbing" 
                         loading="lazy" 
                         decoding="async" 
                         width="400" 
                         height="250" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90">
                    <div class="absolute top-3 right-3 bg-[#0B2545]/90 text-emerald-400 backdrop-blur-md px-2.5 py-1 rounded-md text-[11px] font-bold border border-white/10">
                        {{ $tech['specs'] }}
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-base font-bold text-slate-900 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">{{ $tech['name'] }}</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ $tech['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Interactive SOP 5-Step Flow Stepper --}}
        <div class="bg-gradient-to-br from-[#0B2545] to-[#134074] rounded-3xl p-6 sm:p-10 text-white shadow-xl relative overflow-hidden">
            <div class="text-center max-w-2xl mx-auto mb-8">
                <h3 class="text-xl sm:text-2xl font-bold font-['Plus_Jakarta_Sans',sans-serif] text-white">Prosedur Kerja Standar 5 Langkah</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">Metode sistematis Rootera untuk hasil tuntas dan bergaransi resmi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 relative z-10">
                @foreach($sopSteps as $sop)
                <div class="bg-white/10 border border-white/15 rounded-2xl p-4 text-center hover:bg-white/20 transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-full bg-emerald-500 text-white font-extrabold text-sm flex items-center justify-center mx-auto mb-3 shadow-md">
                            {{ $sop['step'] }}
                        </div>
                        <h4 class="text-sm font-bold text-white mb-1.5 font-['Plus_Jakarta_Sans',sans-serif]">{{ $sop['title'] }}</h4>
                        <p class="text-xs text-slate-300 leading-relaxed">{{ $sop['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 7. SEKTOR YANG KAMI LAYANI (INTERACTIVE SECTOR FILTER)                    --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-white" aria-labelledby="sectors-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-[#00A86B] uppercase tracking-wider mb-3">Wilayah &amp; Kategori Layanan</span>
            <h2 id="sectors-heading" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Sektor yang Kami Layani dengan <span class="text-[#10B981]">Standar Tinggi</span>
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3">
                Dari hunian pribadi hingga area komersial &amp; industri berstandar ketat.
            </p>
        </div>

        {{-- Interactive Filter Tabs --}}
        <div class="flex justify-center gap-2 mb-8 flex-wrap">
            <button onclick="filterSectors('all')" id="tab-all" class="sector-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-[#0B2545] text-white shadow-md">
                Semua Sektor
            </button>
            <button onclick="filterSectors('residential')" id="tab-residential" class="sector-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">
                Residensial &amp; Kost
            </button>
            <button onclick="filterSectors('commercial')" id="tab-commercial" class="sector-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200">
                Komersial &amp; Industri
            </button>
        </div>

        {{-- Sector Grid Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @forelse($sectors as $i => $sector)
            @php
                $secName = is_array($sector) ? $sector['sector_name'] : $sector->sector_name;
                $secSlug = is_array($sector) ? $sector['slug'] : $sector->slug;
                $secIcon = is_array($sector) ? ($sector['icon'] ?? '🏢') : ($sector->icon ?? '🏢');
                $secBadge = is_array($sector) ? ($sector['badge'] ?? 'Komersial & B2B') : 'Komersial & B2B';
                $secDesc = is_array($sector) ? ($sector['short_description'] ?? '') : ($sector->short_description ?? $sector->description ?? '');
                $categoryType = ($i == 0 || $i == 2) ? 'residential' : 'commercial';
            @endphp
            <a href="{{ route('b2b.sector', $secSlug) }}" class="sector-card-item sector-cat-{{ $categoryType }} group relative bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 hover:border-emerald-400 text-decoration-none flex flex-col justify-between overflow-hidden">
                {{-- Top Ambient Hover Glow --}}
                <div class="absolute -top-12 -right-12 w-28 h-28 bg-emerald-500/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

                <div>
                    {{-- Top Header Row --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 group-hover:bg-emerald-500 text-[#0B2545] group-hover:text-white flex items-center justify-center text-2xl transition-all duration-300 shadow-sm">
                            {{ $secIcon }}
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-200/70 px-2.5 py-1 rounded-full shadow-xs">
                            {{ $secBadge }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-[#0B2545] mb-2 font-['Plus_Jakarta_Sans',sans-serif] leading-snug transition-colors">
                        {{ $secName }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-xs text-slate-600 leading-relaxed mb-6 line-clamp-3">
                        {{ $secDesc }}
                    </p>
                </div>

                {{-- Interactive CTA Link at Bottom --}}
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-600 group-hover:text-emerald-500">
                    <span>Eksplor Solusi &rarr;</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-8 text-slate-500">
                Data sektor layanan belum tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 8. CALL TO ACTION (CTA) KONVERSI TINGGI                                   --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-20 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#051428] text-white relative overflow-hidden">
    {{-- Glow Accents --}}
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/20 blur-3xl pointer-events-none rounded-full"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-cyan-500/20 blur-3xl pointer-events-none rounded-full"></div>

    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/40 px-3.5 py-1 rounded-full text-xs font-bold text-emerald-400 uppercase tracking-wider mb-6">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Respons Darurat 24 Jam
        </span>

        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
            Pipa Air Mampet &amp; Meluap Hari Ini?<br>
            <span class="text-emerald-400">Jangan Tunggu Kerusakan Lebih Parah!</span>
        </h2>

        <p class="text-slate-200 text-sm sm:text-base md:text-lg max-w-2xl mx-auto leading-relaxed mb-8">
            Tim Teknisi Rootera siap datang ke lokasi Anda dalam <strong>30–60 menit</strong>. Pengerjaan cepat tanpa bongkar keramik dan bergaransi 100% tuntas!
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 max-w-xl mx-auto">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin panggil teknisi untuk perbaikan saluran mampet.') }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="w-full sm:w-auto bg-[#10B981] hover:bg-emerald-600 text-white font-extrabold text-sm sm:text-base py-4 px-8 rounded-2xl flex items-center justify-center gap-3 shadow-[0_10px_30px_rgba(16,185,129,0.4)] hover:scale-105 active:scale-95 transition-all text-decoration-none min-h-[52px]">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                <span>Panggil Teknisi via WhatsApp 24 Jam</span>
            </a>

            <a href="tel:+6281385404000" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold text-sm sm:text-base py-4 px-6 rounded-2xl flex items-center justify-center gap-2 border border-white/20 backdrop-blur-md transition-all text-decoration-none min-h-[52px]">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                <span>Konsultasi Gratis</span>
            </a>
        </div>
    </div>
</section>

{{-- Sector & Gallery Tab Scripts & Video Modal Handler --}}
@push('scripts')
<script>
function filterSectors(type) {
    const cards = document.querySelectorAll('.sector-card-item');
    const buttons = document.querySelectorAll('.sector-tab-btn');

    buttons.forEach(btn => {
        btn.classList.remove('bg-[#0B2545]', 'text-white');
        btn.classList.add('bg-white', 'text-slate-700');
    });

    const activeBtn = document.getElementById('tab-' + type);
    if(activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-slate-700');
        activeBtn.classList.add('bg-[#0B2545]', 'text-white');
    }

    cards.forEach(card => {
        if(type === 'all') {
            card.style.display = 'block';
        } else if(card.classList.contains('sector-cat-' + type)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterGallery(category) {
    const items = document.querySelectorAll('.gallery-item');
    const buttons = document.querySelectorAll('.gallery-tab-btn');

    buttons.forEach(btn => {
        btn.classList.remove('bg-[#0B2545]', 'text-white');
        btn.classList.add('bg-[#ffffff]', 'text-slate-700');
    });

    const catSlug = category.replace(/\s+/g, '_');
    const activeBtn = document.querySelector('[onclick="filterGallery(\'' + category + '\')"]');
    if(activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-slate-700');
        activeBtn.classList.add('bg-[#0B2545]', 'text-white');
    }

    items.forEach(item => {
        if(category === 'all') {
            item.style.display = 'block';
        } else if(item.classList.contains('gcat-' + catSlug)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function openVideoModal(url, title) {
    const modal = document.getElementById('videoModal');
    const player = document.getElementById('videoModalPlayer');
    const source = document.getElementById('videoModalSource');
    const titleEl = document.getElementById('videoModalTitle');

    if(modal && player && source) {
        source.src = url;
        player.load();
        if(titleEl) titleEl.innerText = title || 'Video Dokumentasi Rootera';
        modal.classList.remove('hidden');
        player.play().catch(e => console.log('Autoplay prevented:', e));
    }
}

function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const player = document.getElementById('videoModalPlayer');
    if(modal && player) {
        player.pause();
        modal.classList.add('hidden');
    }
}
</script>
@endpush

@endsection
