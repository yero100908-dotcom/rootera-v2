@extends('layouts.app')

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $seo['title'] ?? 'Kemitraan & Portofolio Klien Komersial - Rootera Plumbing',
    'description' => $seo['description'] ?? '',
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Portofolio Klien', 'item' => url('/tentang-kami/portofolio-klien')]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@push('styles')
<style>
/* Infinite Marquee Slider Animations */
@keyframes marquee {
    0% { transform: translateX(0%); }
    100% { transform: translateX(-50%); }
}

@keyframes marquee-reverse {
    0% { transform: translateX(-50%); }
    100% { transform: translateX(0%); }
}

.animate-marquee {
    display: flex;
    width: max-content;
    animation: marquee 35s linear infinite;
}

.animate-marquee-reverse {
    display: flex;
    width: max-content;
    animation: marquee-reverse 35s linear infinite;
}

.marquee-container:hover .animate-marquee,
.marquee-container:hover .animate-marquee-reverse {
    animation-play-state: paused;
}

/* Custom Scrollbar for Horizontal Pill Navigation */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endpush

@section('content')
<div class="overflow-x-hidden">
    {{-- HERO SECTION WITH AMBIENT LIGHTING & METRIC COUNTERS --}}
    <div class="relative bg-gradient-to-b from-slate-950 via-[#071739] to-slate-950 text-white pt-20 sm:pt-24 pb-16 sm:pb-20 overflow-hidden">
        {{-- Ambient Decorative Glow Orbs --}}
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-emerald-500/15 blur-[140px] pointer-events-none rounded-full" aria-hidden="true"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 bg-teal-500/10 blur-[120px] pointer-events-none rounded-full" aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Breadcrumb --}}
            <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
                <span class="text-slate-500">/</span>
                <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
                <span class="text-slate-500">/</span>
                <span class="text-emerald-400 font-semibold">Kemitraan &amp; Portofolio B2B</span>
            </nav>

            {{-- Hero Headline --}}
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 mb-4 shadow-sm backdrop-blur-md">
                    💼 Kepercayaan Klien Komersial &amp; B2B
                </span>
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-4 sm:mb-6 leading-tight">
                    Kemitraan &amp; Portofolio <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Klien Komersial Rootera</span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-lg leading-relaxed">
                    Dipercaya oleh puluhan brand F&amp;B nasional, supermarket, pengelola gedung, stasiun BUMN, hingga kawasan industri dalam menjaga kelancaran drainase 100% tanpa membongkar struktur bangunan.
                </p>
            </div>

            {{-- Enterprise Stats Metrics Grid --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 max-w-5xl mx-auto">
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 sm:p-5 rounded-2xl text-center hover:border-emerald-400/50 transition-all duration-300">
                    <div class="text-2xl sm:text-4xl font-extrabold text-emerald-400 mb-1">15+</div>
                    <div class="text-xs sm:text-sm text-slate-200 font-bold">Brand Nasional &amp; B2B</div>
                    <div class="text-[11px] text-slate-400 mt-0.5">F&amp;B, Ritel, BUMN &amp; Industri</div>
                </div>

                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 sm:p-5 rounded-2xl text-center hover:border-emerald-400/50 transition-all duration-300">
                    <div class="text-2xl sm:text-4xl font-extrabold text-teal-300 mb-1">100%</div>
                    <div class="text-xs sm:text-sm text-slate-200 font-bold">Metode Non-Bongkar</div>
                    <div class="text-[11px] text-slate-400 mt-0.5">Aman Keramik &amp; Semen</div>
                </div>

                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 sm:p-5 rounded-2xl text-center hover:border-emerald-400/50 transition-all duration-300">
                    <div class="text-2xl sm:text-4xl font-extrabold text-cyan-300 mb-1">30 Hari</div>
                    <div class="text-xs sm:text-sm text-slate-200 font-bold">Garansi Layanan Resmi</div>
                    <div class="text-[11px] text-slate-400 mt-0.5">Jaminan Bebas Mampet Ulang</div>
                </div>

                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 sm:p-5 rounded-2xl text-center hover:border-emerald-400/50 transition-all duration-300">
                    <div class="text-2xl sm:text-4xl font-extrabold text-emerald-400 mb-1">24/7 SLA</div>
                    <div class="text-xs sm:text-sm text-slate-200 font-bold">Respons Shift Malam</div>
                    <div class="text-[11px] text-slate-400 mt-0.5">Penanganan Non-Stop</div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN PORTFOLIO & MITRA CARDS SECTION --}}
    <section class="py-12 sm:py-16 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Subhead --}}
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
                <span class="text-emerald-600 font-extrabold uppercase text-xs tracking-wider">📸 Dokumentasi Pengerjaan Nyata</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">Studi Kasus &amp; Portofolio Proyek Klien</h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-2">Pilih kategori industri untuk melihat aksi teknisi di lokasi mitra komersial kami.</p>
            </div>

            {{-- Mobile-First Ergonomic Horizontal Scrollable Category Filter Tabs --}}
            <div class="relative mb-10 max-w-full">
                <div class="flex items-center gap-2 sm:gap-3 overflow-x-auto no-scrollbar scroll-smooth whitespace-nowrap py-2 px-1 justify-start sm:justify-center max-w-full" id="mitra-filter-tabs">
                    <button data-filter="all" 
                            class="filter-btn active shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-emerald-600 text-white shadow-md shadow-emerald-600/30">
                        Semua Klien ({{ count($partnerPortfolio ?? []) }})
                    </button>
                    <button data-filter="restoran-fnb" 
                            class="filter-btn shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200/90 shadow-xs">
                        🍽️ Restoran &amp; F&amp;B
                    </button>
                    <button data-filter="mall-supermarket" 
                            class="filter-btn shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200/90 shadow-xs">
                        🏬 Mall &amp; Supermarket
                    </button>
                    <button data-filter="transportasi-bumn" 
                            class="filter-btn shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200/90 shadow-xs">
                        🏛️ Transportasi &amp; BUMN
                    </button>
                    <button data-filter="otomotif-industri" 
                            class="filter-btn shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200/90 shadow-xs">
                        🏭 Otomotif &amp; Industri
                    </button>
                </div>
            </div>

            {{-- Enterprise Partner Portfolio Cards Grid (Mobile: 1col, Tablet: 2col, Desktop: 3col) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" id="mitra-cards-grid">
                @foreach($partnerPortfolio as $item)
                <div class="mitra-card group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-2xl hover:border-emerald-400/80 transition-all duration-500 flex flex-col justify-between hover:-translate-y-1.5" 
                     data-category="{{ $item['category_slug'] }}">
                    
                    <div>
                        {{-- Top Documentation Photo Showcase (Portrait Aspect Ratio aspect-[4/5] with Smooth Zoom) --}}
                        <div class="relative aspect-[4/5] sm:aspect-[4/5] overflow-hidden bg-slate-950">
                            <img src="{{ $item['photo'] ?? asset('images/JnJ.webp') }}" 
                                 alt="Dokumentasi Pengerjaan Pelancaran Pipa {{ $item['name'] }} - Rootera Plumbing" 
                                 loading="lazy" 
                                 decoding="async" 
                                 width="600" 
                                 height="750" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            
                            {{-- Dark Gradient Mask for Badge & Title Visibility --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent pointer-events-none"></div>

                            {{-- Floating Status Badge Top Left --}}
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-slate-950/85 backdrop-blur-md text-teal-300 text-[11px] font-bold px-3 py-1 rounded-full border border-teal-500/30 flex items-center gap-1 shadow-md">
                                    {{ $item['badge'] ?? '⚡ Shift Malam 24 Jam' }}
                                </span>
                            </div>

                            {{-- Category Badge Top Right --}}
                            <div class="absolute top-3 right-3 z-10">
                                <span class="bg-emerald-500/90 text-white text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-md backdrop-blur-sm">
                                    {{ $item['category_label'] }}
                                </span>
                            </div>

                            {{-- Client Name Overlay on Photo Bottom --}}
                            <div class="absolute bottom-4 left-4 right-4 z-10">
                                <span class="text-xs font-semibold text-slate-300 block mb-0.5">Mitra Kepercayaan</span>
                                <h3 class="text-xl font-extrabold text-white leading-tight drop-shadow-md">
                                    {{ $item['name'] }}
                                </h3>
                            </div>
                        </div>

                        {{-- Body Info & Description Section --}}
                        <div class="p-5 sm:p-6">
                            {{-- Logo Box & Property Info Split --}}
                            <div class="flex items-center gap-4 mb-4 pb-4 border-b border-slate-100">
                                {{-- Logo Box (Grayscale to Color Hover Effect) --}}
                                <div class="w-24 h-14 bg-slate-50 border border-slate-200/80 rounded-xl p-2 flex items-center justify-center shrink-0 group-hover:border-emerald-300 transition-colors">
                                    <img src="{{ $item['logo'] }}" 
                                         alt="{{ $item['alt'] }}" 
                                         loading="lazy" 
                                         decoding="async" 
                                         class="max-h-full max-w-full object-contain filter grayscale contrast-125 opacity-75 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300">
                                </div>
                                
                                {{-- Key Metadata --}}
                                <div class="space-y-1">
                                    <div class="text-xs text-slate-500 font-medium truncate max-w-[170px]">
                                        🏢 <span class="text-slate-800 font-bold">{{ $item['property_type'] }}</span>
                                    </div>
                                    <div class="text-xs text-emerald-700 font-extrabold leading-snug line-clamp-1">
                                        🛠️ {{ $item['service_type'] }}
                                    </div>
                                </div>
                            </div>

                            {{-- Symmetrical Line-Clamped Description --}}
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3 min-h-[54px]">
                                {{ $item['description'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Action CTA Button (Thumb-Zone Friendly Min Height 48px) --}}
                    <div class="px-5 sm:px-6 pb-6 pt-1">
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin konsultasi layanan B2B / kontrak perawatan pipa untuk ' . $item['name']) }}" 
                           target="_blank" 
                           rel="noopener" 
                           class="min-h-[48px] w-full inline-flex items-center justify-center gap-2 py-3 px-4 bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md transition-all group-hover:shadow-emerald-500/20 active:scale-98">
                            <span>Konsultasi Layanan B2B / Kontrak Perawatan</span>
                            <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- INFINITE LOGO MARQUEE SLIDER SECTION --}}
    <section class="py-16 bg-slate-900 text-white overflow-hidden relative border-t border-slate-800 marquee-container group">
        {{-- Left & Right Gradient Mask for Smooth Fade Out --}}
        <div class="absolute left-0 top-0 bottom-0 w-20 sm:w-36 bg-gradient-to-r from-slate-900 to-transparent z-10 pointer-events-none" aria-hidden="true"></div>
        <div class="absolute right-0 top-0 bottom-0 w-20 sm:w-36 bg-gradient-to-l from-slate-900 to-transparent z-10 pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-10 relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 mb-3">
                🤝 Ekosistem Kemitraan Nasional
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                Dipercaya oleh Puluhan Brand &amp; Pengelola Properti Nasional
            </h2>
            <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
                Mitra resmi penanganan drainase &amp; pipa mampet untuk skala restoran, ritel, stasiun publik BUMN, hingga kawasan industri.
            </p>
        </div>

        {{-- Infinite Marquee Row 1 (Left to Right) --}}
        <div class="flex overflow-hidden mb-6 py-2">
            <div class="animate-marquee gap-4 sm:gap-6 px-3">
                @foreach(array_merge($partnerPortfolio, $partnerPortfolio) as $m)
                <div class="shrink-0 w-44 sm:w-52 h-20 bg-slate-800/80 border border-slate-700/80 rounded-2xl p-4 flex items-center justify-center hover:border-emerald-400/60 hover:bg-slate-800 transition-all duration-300 group/logo">
                    <img src="{{ $m['logo'] }}" 
                         alt="{{ $m['alt'] }}" 
                         loading="lazy" 
                         decoding="async" 
                         class="max-h-full max-w-full object-contain filter grayscale contrast-125 opacity-70 group-hover/logo:grayscale-0 group-hover/logo:opacity-100 transition-all duration-300">
                </div>
                @endforeach
            </div>
        </div>

        {{-- Infinite Marquee Row 2 (Right to Left Reverse) --}}
        <div class="flex overflow-hidden py-2">
            <div class="animate-marquee-reverse gap-4 sm:gap-6 px-3">
                @foreach(array_merge(array_reverse($partnerPortfolio), array_reverse($partnerPortfolio)) as $m)
                <div class="shrink-0 w-44 sm:w-52 h-20 bg-slate-800/80 border border-slate-700/80 rounded-2xl p-4 flex items-center justify-center hover:border-emerald-400/60 hover:bg-slate-800 transition-all duration-300 group/logo">
                    <img src="{{ $m['logo'] }}" 
                         alt="{{ $m['alt'] }}" 
                         loading="lazy" 
                         decoding="async" 
                         class="max-h-full max-w-full object-contain filter grayscale contrast-125 opacity-70 group-hover/logo:grayscale-0 group-hover/logo:opacity-100 transition-all duration-300">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- B2B SERVICE OFFERING & CONTRACT BANNER --}}
    <section class="py-16 bg-gradient-to-br from-[#0B2545] via-[#0D3B66] to-[#071930] text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 px-3.5 py-1 rounded-full text-xs font-bold text-emerald-400 uppercase tracking-wider mb-4">
                📄 Layanan Pengadaan B2B &amp; SPK Resmi
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white mb-4">
                Siap Menjadi Mitra Maintenance Pipa Properti Bisnis Anda
            </h2>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8 max-w-3xl mx-auto">
                Rootera Plumbing melayani penerbitan Surat Penawaran Harga (SPK), Faktur Pajak PPN resmi, pengerjaan shift malam (night-shift maintenance), dan jaminan SLA tanggap darurat 24 jam.
            </p>

            {{-- Key B2B Features Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10 text-left">
                <div class="bg-white/5 border border-white/10 p-4 rounded-xl">
                    <div class="text-emerald-400 font-bold text-sm mb-1">📄 SPK &amp; Contract</div>
                    <div class="text-slate-300 text-xs leading-snug">Perjanjian Kerja Resmi B2B berkala</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-4 rounded-xl">
                    <div class="text-teal-300 font-bold text-sm mb-1">📑 Faktur PPN</div>
                    <div class="text-slate-300 text-xs leading-snug">Kelengkapan perpajakan resmi perusahaan</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-4 rounded-xl">
                    <div class="text-cyan-300 font-bold text-sm mb-1">🌙 Shift Malam</div>
                    <div class="text-slate-300 text-xs leading-snug">Pengerjaan di luar jam operasional toko</div>
                </div>
                <div class="bg-white/5 border border-white/10 p-4 rounded-xl">
                    <div class="text-emerald-400 font-bold text-sm mb-1">⚡ 24/7 Dispatch</div>
                    <div class="text-slate-300 text-xs leading-snug">Respon darurat cepat untuk pipa meluap</div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera B2B Care, saya berminat mengajukan penawaran kontrak maintenance berkala untuk perusahaan kami.') }}" 
                   target="_blank" rel="noopener" 
                   class="min-h-[48px] w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-sm py-4 px-8 rounded-2xl shadow-lg shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                    <span>💬 Ajukan Kontrak Perawatan B2B via WhatsApp</span>
                </a>
                <a href="{{ route('tentang-kami.profil') }}" class="min-h-[48px] w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold text-sm py-4 px-8 rounded-2xl border border-white/20 transition-all flex items-center justify-center gap-2">
                    <span>Pelajari Profil &amp; Legalitas K3</span> &rarr;
                </a>
            </div>
        </div>
    </section>
</div>

{{-- CATEGORY FILTERING SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#mitra-filter-tabs .filter-btn');
    const cards = document.querySelectorAll('#mitra-cards-grid .mitra-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');

            // Update Tab Active Style
            tabs.forEach(t => {
                t.className = 'filter-btn shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200/90 shadow-xs';
            });
            this.className = 'filter-btn active shrink-0 px-4 sm:px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-emerald-600 text-white shadow-md shadow-emerald-600/30';

            // Filter Cards
            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
