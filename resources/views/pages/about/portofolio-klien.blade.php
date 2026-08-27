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

@section('content')
{{-- HERO SECTION --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    {{-- Decorative Ambient Glow --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-emerald-500/15 blur-[120px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Portofolio &amp; Klien B2B</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 mb-4 shadow-sm">
                💼 Kepercayaan Klien Komersial &amp; B2B
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Kemitraan &amp; Portofolio <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Klien Komersial Rootera</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Dipercaya oleh ratusan brand F&amp;B nasional, supermarket, pengelola gedung, stasiun BUMN, hingga industri dalam menjaga kelancaran sistem drainase tanpa membongkar properti.
            </p>
        </div>
    </div>
</div>

{{-- MAIN PORTFOLIO & MITRA SECTION --}}
<section class="py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Category Filter Tabs --}}
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-12" id="mitra-filter-tabs">
            <button data-filter="all" 
                    class="filter-btn active px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-emerald-600 text-white shadow-md shadow-emerald-600/30">
                Semua Klien ({{ count($partnerPortfolio ?? []) }})
            </button>
            <button data-filter="restoran-fnb" 
                    class="filter-btn px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 shadow-xs">
                🍽️ Restoran &amp; F&amp;B
            </button>
            <button data-filter="mall-supermarket" 
                    class="filter-btn px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 shadow-xs">
                🏬 Mall &amp; Supermarket
            </button>
            <button data-filter="transportasi-bumn" 
                    class="filter-btn px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 shadow-xs">
                🏛️ Transportasi &amp; BUMN
            </button>
            <button data-filter="otomotif-industri" 
                    class="filter-btn px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 shadow-xs">
                🏭 Otomotif &amp; Industri
            </button>
        </div>

        {{-- Partner Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" id="mitra-cards-grid">
            @foreach($partnerPortfolio as $item)
            <div class="mitra-card group bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between" 
                 data-category="{{ $item['category_slug'] }}">
                
                <div>
                    {{-- Logo & Category Badge Header --}}
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div class="w-28 h-16 bg-slate-50 border border-slate-100 rounded-2xl p-2.5 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ $item['logo'] }}" alt="{{ $item['alt'] }}" loading="lazy" decoding="async" class="max-h-full max-w-full object-contain">
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200/80 shrink-0">
                            {{ $item['category_label'] }}
                        </span>
                    </div>

                    {{-- Partner Name --}}
                    <h3 class="text-xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mb-2 group-hover:text-emerald-600 transition-colors">
                        {{ $item['name'] }}
                    </h3>

                    {{-- Property Type & Service Info --}}
                    <div class="space-y-2 mb-4">
                        <div class="flex items-start gap-2 text-xs text-slate-600">
                            <span class="font-semibold text-slate-400 shrink-0">🏢 Properti:</span>
                            <span class="font-medium text-slate-800">{{ $item['property_type'] }}</span>
                        </div>
                        <div class="flex items-start gap-2 text-xs text-slate-600">
                            <span class="font-semibold text-slate-400 shrink-0">🛠️ Layanan:</span>
                            <span class="font-bold text-emerald-700">{{ $item['service_type'] }}</span>
                        </div>
                    </div>

                    {{-- Brief Description --}}
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                        {{ $item['description'] }}
                    </p>
                </div>

                {{-- Card Action CTA Button --}}
                <div class="pt-4 border-t border-slate-100">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin konsultasi layanan B2B / kontrak perawatan pipa untuk ' . $item['name']) }}" 
                       target="_blank" rel="noopener" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-xs transition-all group/btn">
                        <span>Konsultasi Layanan B2B / Kontrak Perawatan</span>
                        <svg class="w-3.5 h-3.5 text-emerald-400 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
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
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
            Siap Menjadi Mitra Maintenance Pipa Properti Bisnis Anda
        </h2>
        <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8 max-w-3xl mx-auto">
            Rootera Plumbing melayani penerbitan Surat Penawaran Harga (SPK), Faktur Pajak PPN resmi, pengerjaan shift malam (night-shift maintenance), dan jaminan SLA tanggap darurat 24 jam.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera B2B Care, saya berminat mengajukan penawaran kontrak maintenance berkala untuk perusahaan kami.') }}" 
               target="_blank" rel="noopener" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-sm py-4 px-8 rounded-2xl shadow-lg shadow-emerald-600/30 flex items-center justify-center gap-2 transition-all">
                <span>💬 Ajukan Kontrak Perawatan B2B via WhatsApp</span>
            </a>
            <a href="{{ route('tentang-kami.profil') }}" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 text-white font-bold text-sm py-4 px-8 rounded-2xl border border-white/20 transition-all flex items-center justify-center gap-2">
                <span>Pelajari Profil &amp; Legalitas K3</span> &rarr;
            </a>
        </div>
    </div>
</section>

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
                t.className = 'filter-btn px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 shadow-xs';
            });
            this.className = 'filter-btn active px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all bg-emerald-600 text-white shadow-md shadow-emerald-600/30';

            // Filter Cards
            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'flex';
                    card.classList.add('animate-fadeIn');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
