@extends('layouts.app')

{{-- ========================================================================= --}}
{{-- STRUCTURED DATA (JSON-LD) SCHEMA.ORG FOR PERSON / LEADERSHIP PROFILE       --}}
{{-- ========================================================================= --}}
@section('schema-markup')
<?php
$personSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "Person",
      "@id" => url('/tentang-kami/tim/' . $member['slug']) . "#person",
      "name" => $member['name'],
      "jobTitle" => $member['role'],
      "image" => $member['image'],
      "description" => $member['bio'] ?? ($member['name'] . ' - ' . $member['role'] . ' di Rootera Plumbing.'),
      "worksFor" => [
        "@type" => "Organization",
        "name" => "Rootera Plumbing",
        "url" => url('/')
      ],
      "knowsAbout" => $member['knows_about'] ?? [
        "Diagnostic Plumbing Systems",
        "High-Pressure Hydro-Jetting",
        "CCTV Pipeline Inspection",
        "Grease Trap Engineering",
        "Sanitary Risk Assessment"
      ],
      "hasCredential" => $member['certification'] ?? "Sertifikasi K3 & Technical Hydro-Jetting Specialist",
      "sameAs" => [
        "https://www.instagram.com/Rootera_plumbing?igsh=c2NkbXA1b3h6MTVy",
        "https://www.facebook.com/Rootera.id"
      ]
    ],
    [
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
        ],
        [
          "@type" => "ListItem",
          "position" => 3,
          "name" => "Tim",
          "item" => url('/tentang-kami#expert-team')
        ],
        [
          "@type" => "ListItem",
          "position" => 4,
          "name" => $member['name'],
          "item" => url('/tentang-kami/tim/' . $member['slug'])
        ]
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. HERO SPLIT SCREEN SECTION                                               --}}
{{-- ========================================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#0B1E36] via-[#0D2A4A] to-[#061324] pt-24 pb-16 md:pt-32 md:pb-24 text-white">
    {{-- Dynamic Ambient Glow Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[400px] bg-emerald-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-[450px] h-[450px] bg-cyan-500/10 blur-[100px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-slate-300 mb-8 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('tentang-kami') }}#expert-team" class="hover:text-emerald-400 transition-colors">Tim</a>
            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-emerald-400 font-semibold">{{ $member['name'] }}</span>
        </nav>

        {{-- Main Profile Grid (Split Screen Layout) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            {{-- Left Column: Portrait Card & Direct Action --}}
            <div class="lg:col-span-5 flex flex-col items-center lg:items-start">
                <div class="relative w-full max-w-md rounded-3xl overflow-hidden border-2 border-emerald-500/40 bg-[#0B2545]/90 shadow-[0_0_40px_rgba(16,185,129,0.2)] group backdrop-blur-md">
                    <div class="aspect-[4/5] overflow-hidden relative bg-[#07172B]">
                        <img src="{{ $member['image'] }}" 
                             alt="{{ $member['alt'] ?? ($member['name'] . ' - ' . $member['role']) }}" 
                             loading="eager" 
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6 bg-[#091C33] border-t border-slate-700/60">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                {{ $member['badge'] ?? 'FOUNDER & EXECUTIVE LEADER' }}
                            </span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">
                            {{ $member['name'] }}
                        </h1>
                        <p class="text-emerald-400 font-semibold text-sm mt-1">
                            {{ $member['role'] }}
                        </p>
                    </div>
                </div>

                {{-- Certification & License Card --}}
                <div class="mt-6 w-full max-w-md bg-[#0E2847]/80 border border-slate-700/70 rounded-2xl p-5 shadow-lg backdrop-blur-md">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xl shrink-0 border border-emerald-500/30">
                            🛡️
                        </div>
                        <div>
                            <h4 class="text-xs uppercase tracking-wider font-extrabold text-slate-400">Lisensi &amp; Sertifikasi Teruji</h4>
                            <p class="text-xs sm:text-sm font-semibold text-slate-200 mt-1 leading-snug">
                                {{ $member['certification'] ?? 'Sertifikasi K3 & Technical Hydro-Jetting Specialist' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Direct CTA Button --}}
                <div class="mt-6 w-full max-w-md">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rafael Abimanyu & Tim Rootera Plumbing, saya ingin konsultasi penanganan masalah saluran khusus.') }}" 
                       target="_blank" rel="noopener" 
                       class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-600/30 flex items-center justify-center gap-3 transition-all text-sm sm:text-base">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.756zm6.205-4.437l.383.227c1.47.872 3.17 1.332 4.908 1.334 5.143 0 9.333-4.189 9.336-9.333.001-2.493-.968-4.838-2.731-6.601-1.763-1.763-4.108-2.733-6.602-2.734-5.142 0-9.332 4.189-9.334 9.333-.001 1.831.535 3.613 1.55 5.166l.25.38-1.026 3.748 3.842-1.007z"/></svg>
                        <span>Konsultasi Penanganan Masalah Khusus</span>
                    </a>
                </div>
            </div>

            {{-- Right Column: Header Info, Quote & Metrik Pills --}}
            <div class="lg:col-span-7 flex flex-col justify-start">
                
                {{-- Experience Capsule --}}
                <div class="mb-4">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        ⚡ {{ $member['experience'] ?? '3+ Tahun Mengakar di Lapangan & Rekayasa Sanitasi Modern' }}
                    </span>
                </div>

                {{-- Leader Title --}}
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                    Mengawal Integritas &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Presisi Sanitasi Indonesia</span>
                </h2>

                {{-- Quote Block --}}
                <div class="bg-gradient-to-r from-emerald-950/70 to-[#0B2545] border-l-4 border-emerald-400 rounded-r-2xl p-6 mb-8 shadow-md">
                    <span class="text-emerald-400 text-4xl font-serif leading-none block mb-1">“</span>
                    <p class="text-slate-200 text-base sm:text-lg italic font-medium leading-relaxed">
                        {{ $member['quote'] ?? 'Bagi kami, pipa bukan sekadar saluran air di balik dinding, melainkan urat nadi kenyamanan sebuah hunian. Masalah saluran yang tuntas tanpa merusak adalah bentuk penghormatan tertinggi kami terhadap properti Anda.' }}
                    </p>
                    <div class="mt-4 text-xs font-extrabold text-emerald-400 uppercase tracking-wider">
                        &mdash; {{ $member['name'] }}, {{ $member['role'] }}
                    </div>
                </div>

                {{-- Metrics Summary Grid (3 Metrik Utama) --}}
                <div class="grid grid-cols-3 gap-3 sm:gap-4 mb-8">
                    <div class="bg-[#081B33] border border-slate-700/80 p-3.5 sm:p-5 rounded-2xl text-center">
                        <div class="text-xl sm:text-3xl font-extrabold text-emerald-400 font-['Plus_Jakarta_Sans',sans-serif]">3+ Tahun</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-300 mt-1">Pengalaman Lapangan</div>
                    </div>
                    <div class="bg-[#081B33] border border-slate-700/80 p-3.5 sm:p-5 rounded-2xl text-center">
                        <div class="text-xl sm:text-3xl font-extrabold text-cyan-400 font-['Plus_Jakarta_Sans',sans-serif]">1.000+</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-300 mt-1">Kasus Ekstrem Selesai</div>
                    </div>
                    <div class="bg-[#081B33] border border-slate-700/80 p-3.5 sm:p-5 rounded-2xl text-center">
                        <div class="text-xl sm:text-3xl font-extrabold text-amber-400 font-['Plus_Jakarta_Sans',sans-serif]">100%</div>
                        <div class="text-[11px] sm:text-xs font-semibold text-slate-300 mt-1">Standar Mutu Rootera</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2. BIOGRAFI: NARRATIVE "MENGAKAR DARI BAWAH" (THE JOURNEY & PHILOSOPHY)    --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-white text-slate-900" aria-labelledby="bio-narrative-heading">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 uppercase tracking-wider mb-3">
                Rekam Jejak &amp; Filosofi Perjalanan
            </span>
            <h2 id="bio-narrative-heading" class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Kisah &amp; Perjalanan Sang Pendiri: <span class="text-emerald-600">Mengakar dari Bawah</span>
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Bagaimana pengalaman riil di meja customer service dan memegang mesin spiral di lapangan melahirkan standar baru Rootera Plumbing.
            </p>
        </div>

        {{-- Narrative Blocks --}}
        <div class="space-y-10 text-slate-700 text-base sm:text-lg leading-relaxed">
            
            {{-- Part 1 --}}
            <div class="bg-slate-50 border border-slate-200/80 rounded-3xl p-6 sm:p-10 shadow-sm relative overflow-hidden">
                <div class="w-2 h-full bg-emerald-600 absolute top-0 left-0"></div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">1</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        {{ $member['bio_part1_title'] ?? 'Dari Meja Kantor hingga Kotoran Saluran (The Dual Perspective)' }}
                    </h3>
                </div>
                <div class="prose prose-slate max-w-none text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                    @if(!empty($member['bio_part1']))
                        @foreach(explode("\n\n", $member['bio_part1']) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    @else
                        <p>
                            Keunggulan terbesar Rafael Abimanyu bukan diraih dari teori di balik meja kantor, melainkan karena ia mengawali langkahnya langsung dari akar rumput. Dimulai sebagai staf kantor dan admin customer service, ia mendengar langsung kepanikan, rasa frustrasi, dan keluhan masyarakat yang kerap kecewa akibat praktek oknum tukang abal-abal maupun harga yang tidak transparan.
                        </p>
                        <p>
                            Tidak berhenti di balik meja admin, Rafael memilih terjun langsung ke lapangan sebagai teknisi. Ia memegang sendiri kabel mesin spiral Ridgid, mencium bau sengatan saluran tersumbat, membersihkan kerak lemak membatu di grease trap restoran komersial, hingga memecahkan kebuntuan pipa gedung bertingkat yang paling rumit.
                        </p>
                    @endif
                </div>
            </div>

            {{-- Part 2 --}}
            <div class="bg-slate-50 border border-slate-200/80 rounded-3xl p-6 sm:p-10 shadow-sm relative overflow-hidden">
                <div class="w-2 h-full bg-teal-600 absolute top-0 left-0"></div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 rounded-xl bg-teal-600 text-white flex items-center justify-center font-bold text-sm">2</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        {{ $member['bio_part2_title'] ?? 'Titik Balik Lahirnya Rootera Plumbing' }}
                    </h3>
                </div>
                <div class="prose prose-slate max-w-none text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                    @if(!empty($member['bio_part2']))
                        @foreach(explode("\n\n", $member['bio_part2']) as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    @else
                        <p>
                            Dari pengalaman dwifungsi (kantor &amp; lapangan) tersebut, Rafael melihat celah mendasar dalam industri sanitasi Indonesia: Masyarakat tidak kekurangan tukang, tetapi kekurangan penyedia jasa yang jujur, menguasai sains drainase modern, dan benar-benar menghargai struktur properti pelanggan.
                        </p>
                        <p>
                            Dari kesadaran itulah lahir Rootera Plumbing—sebuah brand yang dirancang bukan hanya sebagai pembersih kotoran pipa, melainkan pelindung kenyamanan dan kesehatan sanitasi bangunan modern yang bekerja dengan integritas mutlak, teknologi tanpa bongkar, serta standardisasi layanan korporat.
                        </p>
                    @endif
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 3. VISI & MISI PRIBADI SANG PEMIMPIN                                       --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-[#07172B] text-white relative" aria-labelledby="personal-vm-heading">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 uppercase tracking-wider mb-3">
                Leadership Commitment
            </span>
            <h2 id="personal-vm-heading" class="text-2xl sm:text-4xl font-extrabold text-white leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Visi &amp; Misi Pribadi <span class="text-emerald-400">Sang Pemimpin</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
            
            {{-- Visi Pribadi Card --}}
            <div class="md:col-span-5 bg-[#0D2440] border-2 border-emerald-500/40 rounded-3xl p-6 sm:p-8 flex flex-col justify-between shadow-[0_0_30px_rgba(16,185,129,0.15)]">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl font-bold mb-4 border border-emerald-500/30">
                        🎯
                    </div>
                    <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-400 block mb-2">Visi Pribadi Leadership</span>
                    <h3 class="text-xl font-bold text-white font-['Plus_Jakarta_Sans',sans-serif] mb-3">Transformasi Profesi Sanitasi</h3>
                    <blockquote class="text-slate-200 text-sm sm:text-base italic leading-relaxed bg-[#061730] p-4 rounded-2xl border-l-4 border-emerald-400">
                        “{{ $member['personal_vision'] ?? 'Membawa peradaban baru pada profesi teknisi drainase di Indonesia—dari yang sebelumnya dianggap sekadar pekerjaan kasar menjadi profesi engineering sanitasi yang presisi, dihormati, dan dipercaya sepenuhnya oleh setiap keluarga dan pemilik bisnis.' }}”
                    </blockquote>
                </div>
            </div>

            {{-- Misi Pribadi Card List --}}
            <div class="md:col-span-7 bg-[#0E2847] border border-slate-700/80 rounded-3xl p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500/20 text-blue-400 flex items-center justify-center text-2xl font-bold border border-blue-500/30">
                            🚩
                        </div>
                        <div>
                            <span class="text-xs font-extrabold uppercase tracking-wider text-blue-400">Komitmen Operasional</span>
                            <h3 class="text-xl font-bold text-white font-['Plus_Jakarta_Sans',sans-serif]">Misi Pribadi Rafael Abimanyu</h3>
                        </div>
                    </div>

                    <ul class="space-y-4">
                        @if(!empty($member['personal_mission']))
                            @foreach($member['personal_mission'] as $idx => $misiItem)
                            <li class="flex items-start gap-3 bg-[#08182B] p-4 rounded-2xl border border-slate-800">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">{{ $idx + 1 }}</span>
                                <span class="text-xs sm:text-sm text-slate-200 leading-relaxed">{{ $misiItem }}</span>
                            </li>
                            @endforeach
                        @else
                            <li class="flex items-start gap-3 bg-[#08182B] p-4 rounded-2xl border border-slate-800">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">1</span>
                                <span class="text-xs sm:text-sm text-slate-200 leading-relaxed">Terus mengawal SOP kerja setiap armada teknisi agar tidak ada kompromi pada kualitas dan keramahan.</span>
                            </li>
                            <li class="flex items-start gap-3 bg-[#08182B] p-4 rounded-2xl border border-slate-800">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</span>
                                <span class="text-xs sm:text-sm text-slate-200 leading-relaxed">Mengembangkan teknologi pelancaran saluran tanpa bongkar ke seluruh penjuru Nusantara.</span>
                            </li>
                            <li class="flex items-start gap-3 bg-[#08182B] p-4 rounded-2xl border border-slate-800">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">3</span>
                                <span class="text-xs sm:text-sm text-slate-200 leading-relaxed">Membina teknisi-teknisi muda lokal agar memiliki keahlian teknis tinggi, sertifikasi keselamatan kerja, dan integritas moral yang kuat.</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 4. EXPERTISE BADGES & EDUCATIONAL ARTICLES RELATION                       --}}
{{-- ========================================================================= --}}
<section class="py-16 md:py-24 bg-white text-slate-900 border-t border-slate-200" aria-labelledby="expertise-heading">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Expertise Badges --}}
        <div class="mb-14 text-center max-w-4xl mx-auto">
            <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-wider block mb-2">Technical Competency</span>
            <h2 id="expertise-heading" class="text-xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mb-6">
                Keahlian Khusus &amp; Spesialisasi Teknis
            </h2>

            <div class="flex flex-wrap justify-center gap-3">
                @php
                    $expertiseList = $member['expertise_badges'] ?? [
                        'Diagnostic Plumbing Systems',
                        'High-Pressure Hydro-Jetting',
                        'CCTV Pipeline Inspection',
                        'Grease Trap Engineering',
                        'Sanitary Risk Assessment'
                    ];
                @endphp
                @foreach($expertiseList as $exp)
                <span class="px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-bold bg-slate-900 text-emerald-400 border border-slate-800 flex items-center gap-2 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $exp }}
                </span>
                @endforeach
            </div>
        </div>

        {{-- Educational Articles --}}
        @if(isset($relatedArticles) && count($relatedArticles) > 0)
        <div>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Authoritativeness &amp; Edukasi</span>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        Artikel Edukasi Solusi Pipa Terkait
                    </h3>
                </div>
                <a href="{{ route('blog') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                    <span>Lihat Semua Artikel</span> &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $art)
                <a href="{{ route('blog.show', $art->slug) }}" class="group bg-slate-50 rounded-2xl overflow-hidden border border-slate-200/80 hover:border-emerald-500 transition-all duration-300 hover:-translate-y-1 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="aspect-video overflow-hidden bg-slate-200">
                            <img src="{{ $art->thumbnail_url }}" alt="{{ $art->clean_title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-5">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-emerald-600 transition-colors line-clamp-2 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                                {{ $art->clean_title }}
                            </h4>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                {{ $art->excerpt }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 pb-5 text-[11px] font-bold text-emerald-600 flex items-center gap-1">
                        <span>Baca Wawasan Lengkap</span> &rarr;
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Back to Team Link --}}
        <div class="mt-12 text-center pt-8 border-t border-slate-200">
            <a href="{{ route('tentang-kami') }}#expert-team" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-800 transition-colors bg-emerald-50 px-5 py-3 rounded-xl border border-emerald-200">
                &larr; <span>Kembali ke Halaman Utama Tentang Kami &amp; Struktur Tim</span>
            </a>
        </div>

    </div>
</section>

@endsection
