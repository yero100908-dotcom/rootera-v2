@extends('layouts.app')

@section('meta_title', 'Pusat Bantuan & FAQ Saluran Mampet Tanpa Bongkar | Rootera Plumbing')
@section('meta_description', 'Tanya jawab komprehensif seputar solusi pipa mampet, estimasi biaya, keamanan pipa PVC, metode spiral & hydro jetting, serta garansi 30 hari.')
@section('meta_keywords', 'faq pipa mampet, solusi saluran mampet, biaya pelancaran pipa, alat hydro jetting aman, pipa kitchen sink mampet')
@section('canonical', route('faq.index'))

@section('schema-markup')
<?php
$faqSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
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
          "name" => "Pusat Bantuan & FAQ",
          "item" => route('faq.index')
        ]
      ]
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => $allFaqs->map(function($item) {
          return [
            "@type" => "Question",
            "name" => strip_tags($item->question),
            "acceptedAnswer" => [
              "@type" => "Answer",
              "text" => strip_tags($item->answer)
            ]
          ];
      })->toArray()
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div x-data="{ 
    activeCategory: 'all', 
    searchQuery: '{{ $searchQuery }}',
    openFaq: null,
    setSearch(keyword) {
        this.searchQuery = keyword;
    },
    resetFilters() {
        this.activeCategory = 'all';
        this.searchQuery = '';
    },
    faqMatches(question, answer, catSlug) {
        const q = this.searchQuery.toLowerCase().trim();
        const catMatch = (this.activeCategory === 'all' || this.activeCategory === catSlug);
        if (!catMatch) return false;
        if (!q) return true;
        return question.toLowerCase().includes(q) || answer.toLowerCase().includes(q);
    }
}">

    {{-- 1. HERO SECTION & LIVE SEARCH --}}
    <section class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 overflow-hidden border-b border-slate-800/80">
        {{-- Background Ambient Radial Glow & Grid Pattern --}}
        <div class="absolute inset-0 bg-[radial-gradient(#169F81_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 via-teal-400 to-blue-500"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            {{-- Breadcrumbs --}}
            <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
                <span class="text-slate-500">/</span>
                <span class="text-emerald-400 font-semibold">Pusat Bantuan &amp; FAQ</span>
            </nav>

            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4 backdrop-blur-md">
                📖 KNOWLEDGE BASE &amp; PUSAT BANTUAN 24/7
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-4 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Pusat Bantuan &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Tanya Jawab Saluran</span>
            </h1>

            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto mb-8">
                Temukan jawaban lengkap seputar estimasi biaya, teknologi spiral vs jetting, garansi 30 hari, keamanan pipa PVC, dan layanan B2B.
            </p>

            {{-- Floating Live Search Card --}}
            <div class="max-w-2xl mx-auto relative mb-6">
                <div class="relative flex items-center bg-white/95 backdrop-blur-xl p-2 rounded-full shadow-2xl border border-white/20">
                    <span class="pl-4 text-slate-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" 
                           x-model="searchQuery" 
                           placeholder="Cari pertanyaan... (contoh: biaya, garansi, pvc, soda api, faktur pajak)" 
                           class="w-full px-3 py-3 text-slate-900 text-xs sm:text-sm font-medium bg-transparent border-none outline-none focus:ring-0 placeholder:text-slate-400">
                    
                    {{-- Clear Button if active --}}
                    <button type="button" 
                            x-show="searchQuery.length > 0" 
                            @click="searchQuery = ''" 
                            class="p-2 text-slate-400 hover:text-slate-600 text-xs font-bold mr-1 shrink-0" 
                            title="Hapus Pencarian">
                        ✕
                    </button>

                    <button type="button" 
                            @click="$dispatch('focus-faq-list')" 
                            class="px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs sm:text-sm rounded-full transition-colors shrink-0 flex items-center gap-1.5 shadow-md min-h-[44px]">
                        <span>Cari</span>
                    </button>
                </div>
            </div>

            {{-- Quick Keyword Chips --}}
            <div class="flex flex-wrap items-center justify-center gap-2 text-xs">
                <span class="text-slate-400 font-semibold text-[11px] uppercase tracking-wider">Populer:</span>
                <button type="button" @click="setSearch('biaya')" class="px-3 py-1.5 rounded-full bg-slate-800/80 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-slate-700 hover:border-emerald-500/40 transition-all font-medium">
                    💰 Berapa Biaya?
                </button>
                <button type="button" @click="setSearch('garansi')" class="px-3 py-1.5 rounded-full bg-slate-800/80 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-slate-700 hover:border-emerald-500/40 transition-all font-medium">
                    🛡️ Garansi 30 Hari
                </button>
                <button type="button" @click="setSearch('pvc')" class="px-3 py-1.5 rounded-full bg-slate-800/80 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-slate-700 hover:border-emerald-500/40 transition-all font-medium">
                    🧪 Aman untuk Pipa PVC?
                </button>
                <button type="button" @click="setSearch('hydro jetting')" class="px-3 py-1.5 rounded-full bg-slate-800/80 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-slate-700 hover:border-emerald-500/40 transition-all font-medium">
                    ⚙️ Metode Spiral vs Jetting
                </button>
                <button type="button" @click="setSearch('soda api')" class="px-3 py-1.5 rounded-full bg-slate-800/80 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-slate-700 hover:border-emerald-500/40 transition-all font-medium">
                    ⚠️ Bahaya Soda Api
                </button>
                <button type="button" @click="setSearch('faktur pajak')" class="px-3 py-1.5 rounded-full bg-slate-800/80 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-slate-700 hover:border-emerald-500/40 transition-all font-medium">
                    📊 Faktur Pajak B2B
                </button>
            </div>
        </div>
    </section>

    {{-- 2. TAXONOMY KATEGORI TOPIK (INTERACTIVE FILTER TABS) --}}
    <section class="py-10 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-6">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Topik Informasi</span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-0.5">Filter Kategori FAQ</h2>
            </div>

            {{-- Horizontal Scrollable Chips on Mobile / Grid on Desktop --}}
            <div class="flex xl:grid xl:grid-cols-5 gap-3 overflow-x-auto pb-3 xl:pb-0 scrollbar-none snap-x snap-mandatory">
                
                {{-- All Categories Tab --}}
                <button type="button" 
                        @click="activeCategory = 'all'" 
                        :class="activeCategory === 'all' ? 'bg-slate-900 text-white border-slate-900 shadow-md ring-2 ring-emerald-500/50' : 'bg-white text-slate-700 border-slate-200 hover:border-emerald-500/50 hover:bg-slate-50'"
                        class="px-4 py-3 rounded-2xl border transition-all text-left flex items-center justify-between gap-3 shrink-0 snap-start min-w-[170px] xl:min-w-0 cursor-pointer">
                    <div class="flex items-center gap-2.5">
                        <span class="text-xl">📂</span>
                        <div>
                            <div class="font-bold text-xs sm:text-sm">Semua Topik</div>
                            <div class="text-[11px] opacity-75 font-medium">{{ $allFaqs->count() }} Pertanyaan</div>
                        </div>
                    </div>
                </button>

                @foreach($categories as $cat)
                    <button type="button" 
                            @click="activeCategory = '{{ $cat->slug }}'" 
                            :class="activeCategory === '{{ $cat->slug }}' ? 'bg-emerald-600 text-white border-emerald-600 shadow-md ring-2 ring-emerald-500/50' : 'bg-white text-slate-700 border-slate-200 hover:border-emerald-500/50 hover:bg-slate-50'"
                            class="px-4 py-3 rounded-2xl border transition-all text-left flex items-center justify-between gap-3 shrink-0 snap-start min-w-[190px] xl:min-w-0 cursor-pointer">
                        <div class="flex items-center gap-2.5">
                            <span class="text-xl">{{ $cat->icon }}</span>
                            <div>
                                <div class="font-bold text-xs sm:text-sm line-clamp-1">{{ $cat->name }}</div>
                                <div class="text-[11px] opacity-75 font-medium">{{ $cat->faqs_count }} Pertanyaan</div>
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. SMART ACCORDION FAQ LIST --}}
    <section class="py-12 sm:py-16 bg-white min-h-[500px]" id="faq-list-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Active Filter Bar Notification --}}
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100 text-xs sm:text-sm">
                <div class="text-slate-600 font-medium">
                    Menampilkan pertanyaan 
                    <span x-show="activeCategory !== 'all'" class="font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        Kategori: <span x-text="activeCategory"></span>
                    </span>
                    <span x-show="searchQuery.length > 0" class="font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-200 ml-1">
                        Kata Kunci: "<span x-text="searchQuery"></span>"
                    </span>
                </div>

                <button type="button" 
                        x-show="activeCategory !== 'all' || searchQuery.length > 0" 
                        @click="resetFilters()" 
                        class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline flex items-center gap-1">
                    Reset Filter ↺
                </button>
            </div>

            {{-- Accordion Container --}}
            <div class="space-y-3.5">
                <?php $faqIndexCounter = 0; ?>
                @foreach($allFaqs as $faq)
                    <?php 
                        $faqIndexCounter++; 
                        $catSlug = $faq->category->slug ?? 'umum';
                        $catName = $faq->category->name ?? 'Umum';
                        $catIcon = $faq->category->icon ?? '❓';
                        $qEscaped = addslashes($faq->question);
                        $aEscaped = addslashes(strip_tags($faq->answer));
                    ?>

                    <div x-show="faqMatches('{{ $qEscaped }}', '{{ $aEscaped }}', '{{ $catSlug }}')" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-98"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         :class="openFaq === {{ $faq->id }} ? 'border-l-4 border-emerald-500 bg-emerald-50/40 shadow-md border-emerald-200' : 'bg-white border-slate-200/90 hover:border-slate-300 hover:shadow-xs'"
                         class="rounded-2xl border transition-all overflow-hidden">
                        
                        {{-- Accordion Toggle Header --}}
                        <button type="button" 
                                @click="openFaq = (openFaq === {{ $faq->id }} ? null : {{ $faq->id }})" 
                                class="w-full p-4 sm:p-5 text-left flex items-start justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base focus:outline-none min-h-[48px] cursor-pointer select-none">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-1 border border-slate-200">
                                        <span>{{ $catIcon }}</span> <span>{{ $catName }}</span>
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-900 text-sm sm:text-base leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                                    {{ $faq->question }}
                                </h3>
                            </div>

                            <span :class="openFaq === {{ $faq->id }} ? 'rotate-180 text-emerald-600 bg-emerald-100' : 'text-slate-400 bg-slate-100'" 
                                  class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-transform duration-300 font-bold text-sm">
                                ▾
                            </span>
                        </button>

                        {{-- Accordion Body --}}
                        <div x-show="openFaq === {{ $faq->id }}" 
                             x-collapse 
                             class="px-4 pb-4 sm:px-5 sm:pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100/80 pt-3">
                            <div class="prose prose-slate prose-sm max-w-none text-slate-600 leading-relaxed">
                                {!! $faq->answer !!}
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                                <a href="{{ route('faq.show', $faq->slug) }}" class="text-emerald-600 font-bold hover:underline flex items-center gap-1">
                                    Halaman Detail FAQ &rarr;
                                </a>
                                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin menanyakan lebih lanjut mengenai: ' . $faq->question) }}" target="_blank" rel="noopener" class="text-slate-500 hover:text-emerald-600 flex items-center gap-1">
                                    💬 Tanya CS via WA
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty State (If search or category yields no results) --}}
            <div x-show="!$el.parentNode.querySelector('.rounded-2xl:not([style*=\'display: none\'])')" class="text-center py-16 px-4 bg-slate-50 rounded-3xl border border-slate-200 mt-6">
                <div class="w-16 h-16 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold text-2xl mx-auto mb-4">🔍</div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Pertanyaan Tidak Ditemukan</h3>
                <p class="text-xs sm:text-sm text-slate-600 max-w-md mx-auto mb-6">
                    Maaf, tidak ada jawaban yang cocok dengan kata kunci atau kategori yang Anda pilih.
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <button type="button" @click="resetFilters()" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition-colors">
                        Reset Filter &amp; Tampilkan Semua
                    </button>
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya tidak menemukan jawaban di FAQ untuk kendala pipa saya.') }}" target="_blank" rel="noopener" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                        💬 Tanya Langsung ke Konsultan WA
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- 4. B2B & EMERGENCY CALL-OUT BANNER (HYBRID CONVERSION) --}}
    <section class="py-12 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Emergency Card 24H --}}
                <div class="p-6 sm:p-8 bg-gradient-to-br from-slate-900 to-slate-950 text-white rounded-3xl border border-slate-800 shadow-xl flex flex-col justify-between">
                    <div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-rose-500/20 text-rose-400 border border-rose-500/30">
                            🚨 Emergency Unit 24 Jam
                        </span>
                        <h3 class="font-extrabold text-xl text-white mt-3 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                            Butuh Layanan Darurat 24 Jam Hunian?
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6">
                            Saluran meluap di malam hari? Armada teknisi siaga Rootera meluncur cepat ke lokasi rumah/ruko Anda dengan peralatan lengkap.
                        </p>
                    </div>
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh penanganan darurat pipa mampet sekarang!') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 py-3.5 px-6 bg-[#25D366] hover:bg-[#1EBE5A] text-white font-extrabold text-xs sm:text-sm rounded-xl transition-all shadow-md">
                        <span>💬 WhatsApp Hotline CS 24 Jam</span>
                    </a>
                </div>

                {{-- B2B & Corporate Card --}}
                <div class="p-6 sm:p-8 bg-gradient-to-br from-slate-900 via-[#0B2545] to-slate-900 text-white rounded-3xl border border-slate-800 shadow-xl flex flex-col justify-between">
                    <div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                            🏢 Sektor B2B &amp; Restoran
                        </span>
                        <h3 class="font-extrabold text-xl text-white mt-3 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                            Kebutuhan Korporat &amp; Faktur Pajak?
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6">
                            Pengajuan e-Faktur PPN 11%, kontrak *preventive maintenance* restoran/gedung, dan pengadaan B2B bergaransi resmi J&amp;J Group.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('b2b.faktur-pajak') }}" class="w-full sm:w-1/2 inline-flex items-center justify-center gap-1.5 py-3 px-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl transition-all text-center">
                            📊 Faktur Pajak PPN
                        </a>
                        <a href="{{ route('b2b.licensing') }}" class="w-full sm:w-1/2 inline-flex items-center justify-center gap-1.5 py-3 px-4 bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs rounded-xl border border-slate-700 transition-all text-center">
                            📜 Kontrak Licensing
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 5. BOTTOM DIRECT CONSULTATION CTA --}}
    <section class="bg-gradient-to-r from-slate-900 via-slate-950 to-slate-900 text-white py-14 px-4 text-center border-t border-slate-800">
        <div class="max-w-3xl mx-auto space-y-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">
                Masih Memiliki Pertanyaan Seputar Pipa Mampet?
            </h2>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-xl mx-auto">
                Tim konsultan teknis Rootera Plumbing siap mendiagnosa dan memberikan estimasi biaya transparan secara gratis via WhatsApp.
            </p>
            <div class="pt-2">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi gratis seputar pipa mampet') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-8 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold text-xs sm:text-sm rounded-full shadow-xl transition-all hover:-translate-y-0.5 min-h-[44px]">
                    <span>💬 Konsultasi Gratis Sekarang (WA 24 Jam)</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
