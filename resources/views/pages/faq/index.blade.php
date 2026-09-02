@extends('layouts.app')

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
<div id="faq-root" class="bg-slate-50 min-h-screen text-slate-800 font-['Inter',sans-serif]">
    
    {{-- 1. HERO SECTION & SMART SEARCH --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#0B192C] via-[#0A2540] to-[#0d3a94] text-white pt-10 pb-16 md:pt-16 md:pb-24 border-b border-cyan-500/20">
        {{-- Background Glow & Grid Accents --}}
        <div class="absolute inset-0 pointer-events-none opacity-20 bg-[radial-gradient(#00D2FF_1px,transparent_1px)] [background-size:24px_24px]"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#00D2FF]/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#00F5D4]/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container mx-auto px-4 relative z-10 text-center max-w-4xl">
            
            {{-- Glowing Pulse Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-cyan-300 text-xs sm:text-sm font-semibold tracking-wide mb-6 shadow-lg shadow-cyan-950/40 animate-pulse">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                <span>⚡ Pusat Bantuan Cepat &amp; Solusi Pipa 24 Jam</span>
            </div>

            {{-- Main Headline --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] tracking-tight leading-tight text-white mb-4">
                Pusat Bantuan &amp; Tanya Jawab <br class="hidden sm:inline" />
                <span class="bg-gradient-to-r from-[#00D2FF] via-[#00F5D4] to-emerald-400 bg-clip-text text-transparent">Rootera Plumbing</span>
            </h1>

            {{-- Subtitle --}}
            <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-2xl mx-auto mb-8 font-normal leading-relaxed">
                Temukan jawaban cepat seputar estimasi biaya, teknologi tanpa bongkar, hingga jaminan garansi 30 hari resmi.
            </p>

            {{-- Smart Search Bar (Client-Side Instant Filter) --}}
            <div class="max-w-2xl mx-auto relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-[#00D2FF] to-[#00F5D4] rounded-full blur opacity-40 group-hover:opacity-75 transition duration-300"></div>
                
                <div class="relative flex items-center bg-white rounded-full shadow-2xl p-1.5 sm:p-2 border border-slate-100">
                    <span class="pl-4 pr-2 text-slate-400">
                        <svg class="w-6 h-6 text-[#0A2540]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    
                    <input type="text" id="faq-search-input" value="{{ $searchQuery }}" 
                           placeholder="Cari pertanyaan... (contoh: biaya, garansi, soda api, hydro jetting)" 
                           class="w-full bg-transparent border-none py-3 px-2 text-slate-800 text-sm sm:text-base font-medium placeholder-slate-400 focus:outline-none focus:ring-0"
                           aria-label="Cari FAQ" />
                    
                    {{-- Clear Search Button --}}
                    <button type="button" id="faq-search-clear" class="hidden p-2 text-slate-400 hover:text-slate-600 transition-colors mr-1" aria-label="Bersihkan pencarian">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <button type="button" id="faq-search-submit" class="shrink-0 bg-gradient-to-r from-[#0A2540] to-[#0d3a94] hover:from-[#10b981] hover:to-[#059669] text-white font-bold px-5 sm:px-7 py-3 rounded-full text-xs sm:text-sm transition-all duration-300 shadow-md">
                        Cari
                    </button>
                </div>
            </div>

            {{-- Quick Trending Chips (Horizontal Scroll on Mobile) --}}
            <div class="mt-6 flex items-center justify-center gap-2 overflow-x-auto no-scrollbar py-2 px-1 text-xs sm:text-sm">
                <span class="text-slate-400 font-medium shrink-0 mr-1">Tren Pencarian:</span>
                <button type="button" onclick="setFaqSearch('Estimasi Biaya')" class="trending-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-cyan-500/20 border border-white/15 text-slate-200 hover:text-cyan-300 font-medium transition-all cursor-pointer">
                    💰 Estimasi Biaya
                </button>
                <button type="button" onclick="setFaqSearch('Garansi')" class="trending-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-cyan-500/20 border border-white/15 text-slate-200 hover:text-cyan-300 font-medium transition-all cursor-pointer">
                    🛡️ Klaim Garansi
                </button>
                <button type="button" onclick="setFaqSearch('Tanpa Bongkar')" class="trending-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-cyan-500/20 border border-white/15 text-slate-200 hover:text-cyan-300 font-medium transition-all cursor-pointer">
                    🚫 Tanpa Bongkar?
                </button>
                <button type="button" onclick="setFaqSearch('Soda Api')" class="trending-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-cyan-500/20 border border-white/15 text-slate-200 hover:text-cyan-300 font-medium transition-all cursor-pointer">
                    🧪 Soda Api
                </button>
                <button type="button" onclick="setFaqSearch('Waktu')" class="trending-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-cyan-500/20 border border-white/15 text-slate-200 hover:text-cyan-300 font-medium transition-all cursor-pointer">
                    ⏱️ Waktu Pengerjaan
                </button>
                <button type="button" onclick="setFaqSearch('B2B')" class="trending-chip shrink-0 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-cyan-500/20 border border-white/15 text-slate-200 hover:text-cyan-300 font-medium transition-all cursor-pointer">
                    🏢 Klien Resto/B2B
                </button>
            </div>
        </div>
    </section>

    {{-- 2. STICKY CATEGORY TAB BAR --}}
    <div class="sticky top-[75px] z-30 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm py-3 transition-all">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar snap-x snap-mandatory py-1" id="category-tabs">
                
                {{-- All Categories Tab --}}
                <button type="button" data-category="all" onclick="selectFaqCategory('all')"
                        class="faq-tab-btn snap-start shrink-0 px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 flex items-center gap-1.5 bg-gradient-to-r from-[#0A2540] to-[#00D2FF] text-white shadow-md">
                    <span>📌 Semua Pertanyaan</span>
                    <span class="bg-white/20 text-white text-[10px] px-2 py-0.5 rounded-full" id="count-all">{{ $allFaqs->count() }}</span>
                </button>

                @foreach($categories as $cat)
                    <button type="button" data-category="{{ $cat->slug }}" onclick="selectFaqCategory('{{ $cat->slug }}')"
                            class="faq-tab-btn snap-start shrink-0 px-4 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 border border-slate-200">
                        <span>{{ $cat->icon }} {{ $cat->name }}</span>
                        <span class="bg-slate-200 text-slate-600 text-[10px] px-2 py-0.5 rounded-full">{{ $cat->faqs_count }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- MAIN CONTAINER --}}
    <main class="container mx-auto px-4 py-8 max-w-5xl">
        
        {{-- Controls Bar (Expand / Collapse All + Counter) --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                <h2 class="text-sm sm:text-base font-bold text-slate-900" id="faq-section-heading">
                    Menampilkan <span id="visible-faq-count" class="text-emerald-600 font-extrabold">{{ $allFaqs->count() }}</span> Pertanyaan
                </h2>
            </div>
            
            <div class="flex items-center gap-2 text-xs sm:text-sm">
                <button type="button" onclick="toggleAllAccordion(true)" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    Buka Semua
                </button>
                <button type="button" onclick="toggleAllAccordion(false)" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    Tutup Semua
                </button>
            </div>
        </div>

        {{-- 3. INTERACTIVE FAQ ACCORDION LIST --}}
        <div class="space-y-4" id="faq-accordion-list">
            @foreach($allFaqs as $index => $faq)
                <div class="faq-card-item bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
                     data-category="{{ $faq->category->slug ?? 'umum' }}"
                     data-question="{{ strtolower($faq->question) }}"
                     data-answer="{{ strtolower(strip_tags($faq->answer)) }}">
                    
                    {{-- Question Header Toggle Button --}}
                    <button type="button" 
                            class="faq-header-btn w-full p-4 sm:p-5 text-left flex items-start sm:items-center justify-between gap-4 cursor-pointer focus:outline-none focus:ring-2 focus:ring-cyan-500/40 rounded-2xl transition-colors hover:bg-slate-50/80"
                            aria-expanded="false"
                            aria-controls="faq-body-{{ $faq->id }}"
                            id="faq-btn-{{ $faq->id }}"
                            onclick="toggleSingleAccordion(this)">
                        
                        <div class="flex items-start sm:items-center gap-3 pr-2">
                            <span class="text-xl shrink-0 mt-0.5 sm:mt-0 p-2 rounded-xl bg-slate-100 text-slate-700">
                                {{ $faq->category->icon ?? '❓' }}
                            </span>
                            <div>
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-cyan-50 text-cyan-700 border border-cyan-200/60 text-[11px] font-bold mb-1">
                                    {{ $faq->category->name ?? 'Informasi Layanan' }}
                                </div>
                                <h3 class="faq-question-text text-base sm:text-lg font-bold text-slate-900 leading-snug">
                                    {{ $faq->question }}
                                </h3>
                            </div>
                        </div>

                        {{-- Indicator Chevron --}}
                        <div class="faq-chevron-icon shrink-0 w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 transition-transform duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </button>

                    {{-- Content Body --}}
                    <div id="faq-body-{{ $faq->id }}" 
                         role="region" 
                         aria-labelledby="faq-btn-{{ $faq->id }}"
                         class="faq-content-wrapper hidden border-t border-slate-100 bg-slate-50/50 px-4 sm:px-6 py-5">
                        
                        {{-- Mini Technical Badge --}}
                        <div class="flex items-center gap-2 mb-3 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-3 py-1.5 w-fit">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Tips &amp; Solusi Teknisi Rootera</span>
                        </div>

                        {{-- Answer HTML Text --}}
                        <div class="faq-answer-text text-sm sm:text-base text-slate-700 leading-relaxed space-y-2">
                            {!! $faq->answer !!}
                        </div>

                        {{-- Interactive Footer: Feedback & Direct WA CTA --}}
                        <div class="mt-5 pt-4 border-t border-slate-200/70 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs sm:text-sm">
                            
                            {{-- Helpfulness Feedback --}}
                            <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-lg border border-slate-200" id="feedback-box-{{ $faq->id }}">
                                <span class="text-slate-500 font-medium">Apakah jawaban ini membantu?</span>
                                <button type="button" onclick="sendFaqFeedback({{ $faq->id }}, 'yes')" class="hover:bg-emerald-50 text-slate-700 hover:text-emerald-600 px-2 py-1 rounded font-bold transition-colors">
                                    👍 Ya
                                </button>
                                <span class="text-slate-300">|</span>
                                <button type="button" onclick="sendFaqFeedback({{ $faq->id }}, 'no')" class="hover:bg-rose-50 text-slate-700 hover:text-rose-600 px-2 py-1 rounded font-bold transition-colors">
                                    👎 Belum
                                </button>
                            </div>

                            {{-- Inline WA CTA --}}
                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya membaca FAQ tentang "' . $faq->question . '" dan ingin berkonsultasi mengenai masalah saluran saya.') }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs sm:text-sm transition-all shadow-sm">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 2c-5.514 0-9.996 4.477-9.996 9.989 0 1.76.459 3.473 1.332 4.982l-1.367 4.992 5.127-1.34c1.458.797 3.107 1.217 4.898 1.217 5.514 0 9.997-4.477 9.997-9.989 0-5.514-4.483-9.991-9.991-9.991zm5.952 14.182c-.252.709-1.464 1.353-2.02 1.417-.502.057-1.157.085-3.329-.814-2.776-1.15-4.568-3.978-4.707-4.163-.138-.184-1.127-1.503-1.127-2.863 0-1.36.711-2.03.963-2.308.252-.278.553-.347.738-.347.185 0 .37.003.528.01.171.008.4.004.577.433.185.449.63 1.54.685 1.653.055.113.093.245.018.393-.075.148-.113.241-.225.371-.113.13-.237.29-.338.391-.113.113-.231.236-.1.461.131.225.582.96 1.252 1.557.86.767 1.585 1.004 1.81 1.117.225.113.357.094.489-.056.132-.15.568-.663.72-892.152-.228.303-.189.504-.113.225.075 1.503.731 1.765.862.262.131.436.197.498.303.063.107.063.619-.189 1.328z"/></svg>
                                <span>Tanya CS via WA</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- No Search Results Fallback State --}}
        <div id="faq-empty-state" class="hidden bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 text-center my-6">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                🔎
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Pertanyaan Tidak Ditemukan</h3>
            <p class="text-slate-600 max-w-md mx-auto mb-6 text-sm sm:text-base">
                Maaf, tidak ada FAQ yang sesuai dengan pencarian Anda. Tim CS teknis kami siap memberikan penjelasan lengkap secara langsung.
            </p>
            <button type="button" onclick="resetFaqFilters()" class="px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm rounded-full transition-all">
                Reset Filter Pencarian
            </button>
        </div>

        {{-- 4. INTERACTIVE VALUE ADD-ON: DIAGNOSIS MASALAH KILAT --}}
        <section class="mt-14 mb-10 bg-gradient-to-br from-slate-900 via-[#0A2540] to-slate-900 rounded-3xl p-6 sm:p-8 md:p-10 text-white shadow-xl border border-cyan-500/30 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-400/30 text-xs font-bold uppercase tracking-wider mb-3">
                    <span>⚡ Tool Interaktif</span>
                </div>
                
                <h3 class="text-2xl sm:text-3xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] mb-2">
                    Diagnosis Masalah Pipa Kilat
                </h3>
                <p class="text-slate-300 text-sm sm:text-base mb-6">
                    Saluran Anda mampet di titik mana? Klik lokasi di bawah untuk melihat perkiraan penyebab &amp; estimasi waktu penanganan.
                </p>

                {{-- Interactive Selector Buttons --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3 mb-6" id="diag-buttons">
                    <button type="button" onclick="selectDiagnosis('wastafel')" data-diag="wastafel"
                            class="diag-btn p-3 sm:p-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 text-center transition-all cursor-pointer group active-diag shadow-sm">
                        <span class="text-2xl sm:text-3xl block mb-1.5 group-hover:scale-110 transition-transform">🍳</span>
                        <span class="text-xs sm:text-sm font-bold block">Wastafel Dapur</span>
                    </button>
                    
                    <button type="button" onclick="selectDiagnosis('kamarmandi')" data-diag="kamarmandi"
                            class="diag-btn p-3 sm:p-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 text-center transition-all cursor-pointer group">
                        <span class="text-2xl sm:text-3xl block mb-1.5 group-hover:scale-110 transition-transform">🚿</span>
                        <span class="text-xs sm:text-sm font-bold block">Floor Drain / KM</span>
                    </button>

                    <button type="button" onclick="selectDiagnosis('kloset')" data-diag="kloset"
                            class="diag-btn p-3 sm:p-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 text-center transition-all cursor-pointer group">
                        <span class="text-2xl sm:text-3xl block mb-1.5 group-hover:scale-110 transition-transform">🚽</span>
                        <span class="text-xs sm:text-sm font-bold block">Kloset / WC</span>
                    </button>

                    <button type="button" onclick="selectDiagnosis('talang')" data-diag="talang"
                            class="diag-btn p-3 sm:p-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/15 text-center transition-all cursor-pointer group">
                        <span class="text-2xl sm:text-3xl block mb-1.5 group-hover:scale-110 transition-transform">🌧️</span>
                        <span class="text-xs sm:text-sm font-bold block">Talang Air &amp; Got</span>
                    </button>
                </div>

                {{-- Diagnosis Result Card Display --}}
                <div id="diag-result-card" class="bg-white/10 backdrop-blur-md rounded-2xl p-5 sm:p-6 text-left border border-white/20 shadow-inner">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-white/10 pb-4 mb-4">
                        <div>
                            <span class="text-xs text-cyan-300 font-bold uppercase tracking-wider block">Hasil Diagnosa Pipa:</span>
                            <h4 class="text-lg sm:text-xl font-bold text-white" id="diag-title">Wastafel Dapur Tersumbat Lemak</h4>
                        </div>
                        <div class="shrink-0 bg-emerald-500/20 text-emerald-300 border border-emerald-400/40 text-xs px-3 py-1.5 rounded-full font-bold">
                            ⏱️ Estimasi Kerja: <span id="diag-time">15 - 30 Menit</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm mb-5">
                        <div class="bg-black/20 p-3.5 rounded-xl border border-white/10">
                            <span class="text-slate-400 font-semibold block mb-1">🔍 Estimasi Penyebab Utama:</span>
                            <p class="text-slate-200 leading-snug" id="diag-cause">Penumpukan minyak goreng, sisa lemak makanan membeku, dan sisa bahan sabun di pipa P-trap.</p>
                        </div>
                        <div class="bg-black/20 p-3.5 rounded-xl border border-white/10">
                            <span class="text-slate-400 font-semibold block mb-1">🛠️ Rekomendasi Peralatan Rootera:</span>
                            <p class="text-slate-200 leading-snug" id="diag-tool">Mesin Drain Cleaner Rotary Spiral Cable flexibel (Tanpa Bongkar Keramik).</p>
                        </div>
                    </div>

                    <div class="text-center sm:text-right">
                        <a id="diag-wa-link" href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh teknisi untuk penanganan Wastafel Dapur tersumbat lemak.') }}"
                           target="_blank" rel="noopener noreferrer"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold text-sm rounded-xl shadow-lg transition-all">
                            <span>Panggil Teknisi Wastafel Sekarang →</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- 5. CONVERSION CTA BANNER SECTION --}}
        <section class="my-10 bg-gradient-to-r from-[#0A2540] via-[#0d3a94] to-[#00D2FF] rounded-3xl p-8 sm:p-12 text-white text-center relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] opacity-10 [background-size:16px_16px]"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="bg-white/20 text-white border border-white/30 text-xs font-bold px-4 py-1.5 rounded-full inline-block mb-4">
                    💬 Layanan Respon Cepat 24 Jam
                </span>
                
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] mb-3 leading-tight">
                    Masih Punya Pertanyaan atau Saluran Mampet Parah?
                </h2>
                
                <p class="text-slate-200 text-sm sm:text-base mb-8 leading-relaxed">
                    Tim teknisi bersertifikat Rootera siap merespons pemanggilan Anda dalam 5 menit. Konsultasi &amp; Estimasi Biaya Gratis!
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin konsultasi gratis dan memesan teknisi pipa mampet.') }}" 
                       target="_blank" rel="noopener noreferrer"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-[#25D366] hover:bg-[#1ebe59] text-white font-extrabold text-sm sm:text-base rounded-full shadow-lg transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 2c-5.514 0-9.996 4.477-9.996 9.989 0 1.76.459 3.473 1.332 4.982l-1.367 4.992 5.127-1.34c1.458.797 3.107 1.217 4.898 1.217 5.514 0 9.997-4.477 9.997-9.989 0-5.514-4.483-9.991-9.991-9.991zm5.952 14.182c-.252.709-1.464 1.353-2.02 1.417-.502.057-1.157.085-3.329-.814-2.776-1.15-4.568-3.978-4.707-4.163-.138-.184-1.127-1.503-1.127-2.863 0-1.36.711-2.03.963-2.308.252-.278.553-.347.738-.347.185 0 .37.003.528.01.171.008.4.004.577.433.185.449.63 1.54.685 1.653.055.113.093.245.018.393-.075.148-.113.241-.225.371-.113.13-.237.29-.338.391-.113.113-.231.236-.1.461.131.225.582.96 1.252 1.557.86.767 1.585 1.004 1.81 1.117.225.113.357.094.489-.056.132-.15.568-.663.72-892.152-.228.303-.189.504-.113.225.075 1.503.731 1.765.862.262.131.436.197.498.303.063.107.063.619-.189 1.328z"/></svg>
                        <span>WhatsApp Direct Chat</span>
                    </a>

                    <a href="tel:081385404000" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white border border-white/30 font-bold text-sm sm:text-base rounded-full transition-all">
                        <svg class="w-5 h-5 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1.001 1.001 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>Hotline 0813-8540-4000</span>
                    </a>
                </div>
            </div>
        </section>

    </main>
</div>

{{-- Dynamic Toast Notification Container --}}
<div id="faq-toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900 text-white text-xs sm:text-sm font-semibold px-5 py-3 rounded-full shadow-2xl border border-slate-700 opacity-0 pointer-events-none transition-all duration-300 flex items-center gap-2">
    <span class="text-emerald-400">✓</span>
    <span id="faq-toast-msg">Terima kasih atas masukan Anda!</span>
</div>

@push('scripts')
<script>
    // State Variables
    let currentCategory = 'all';
    let currentSearchTerm = "{{ strtolower($searchQuery) }}";

    const diagnosisData = {
        wastafel: {
            title: "Wastafel Dapur Tersumbat Lemak & Sisa Makanan",
            cause: "Akumulasi minyak goreng, sisa lemak masakan membeku di leher angsa P-Trap dan dinding pipa.",
            tool: "Mesin Drain Cleaner Rotary Spiral Cable fleksibel (Pembersihan Lemak Tanpa Bongkar).",
            time: "15 - 30 Menit",
            waMsg: "Halo Rootera, saya butuh penanganan teknisi untuk Wastafel Dapur mampet tersumbat lemak."
        },
        kamarmandi: {
            title: "Floor Drain Kamar Mandi Tersumbat Hair & Soap Scum",
            cause: "Penumpukan rontokan rambut, gumpalan endapan sabun mandi, dan serat benang pakaian.",
            tool: "Kabel Spiral Flex Rotary Rooter 5/8 inch pendorong pembersih kerak pipa.",
            time: "20 - 45 Menit",
            waMsg: "Halo Rootera, saya butuh teknisi untuk melancarkan saluran Kamar Mandi / Floor Drain yang meluap."
        },
        kloset: {
            title: "Kloset / WC Tersumbat Benda Asing / Septic Tank Full",
            cause: "Sumbatan tisu basah, pembalut, benda jatuh, atau pipa hawa/volume septic tank penuh.",
            tool: "Peralatan Auger Kloset Pendorong tekanan tinggi (Tanpa lepas mangkuk WC).",
            time: "25 - 45 Menit",
            waMsg: "Halo Rootera, saya bermaksud memesan teknisi untuk masalah Kloset / WC mampet meluap."
        },
        talang: {
            title: "Talang Air & Got Tersumbat Daun / Pasir Hujan",
            cause: "Penumpukan daun kering, sedimen pasir, dan lumpur pekat di sudut pipa talang roof drain.",
            tool: "Mesin Hydro-Jetting air bertekanan tinggi 150-200 Bar / Cable Rooter.",
            time: "30 - 60 Menit",
            waMsg: "Halo Rootera, saya butuh bantuan teknisi untuk penanganan saluran Talang Air / Got meluap saat hujan."
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('faq-search-input');
        const searchClear = document.getElementById('faq-search-clear');
        const searchSubmit = document.getElementById('faq-search-submit');

        if (searchInput) {
            // Live instant search
            searchInput.addEventListener('input', (e) => {
                currentSearchTerm = e.target.value.toLowerCase().trim();
                if (searchClear) {
                    searchClear.classList.toggle('hidden', currentSearchTerm.length === 0);
                }
                filterFaqs();
            });

            if (searchInput.value.trim() !== '') {
                if (searchClear) searchClear.classList.remove('hidden');
                filterFaqs();
            }
        }

        if (searchClear) {
            searchClear.addEventListener('click', () => {
                searchInput.value = '';
                currentSearchTerm = '';
                searchClear.classList.add('hidden');
                filterFaqs();
            });
        }

        if (searchSubmit) {
            searchSubmit.addEventListener('click', () => {
                filterFaqs();
            });
        }
    });

    // Category Selection Tab Logic
    function selectFaqCategory(catSlug) {
        currentCategory = catSlug;
        
        // Update Active Tab Styling
        document.querySelectorAll('.faq-tab-btn').forEach(btn => {
            const isTarget = btn.getAttribute('data-category') === catSlug;
            if (isTarget) {
                btn.className = "faq-tab-btn snap-start shrink-0 px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 flex items-center gap-1.5 bg-gradient-to-r from-[#0A2540] to-[#00D2FF] text-white shadow-md";
            } else {
                btn.className = "faq-tab-btn snap-start shrink-0 px-4 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all duration-300 flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 border border-slate-200";
            }
        });

        filterFaqs();
    }

    // Filter FAQs Function
    function filterFaqs() {
        const cards = document.querySelectorAll('.faq-card-item');
        let visibleCount = 0;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            const questionText = card.getAttribute('data-question');
            const answerText = card.getAttribute('data-answer');

            const matchesCat = (currentCategory === 'all' || cardCat === currentCategory);
            const matchesSearch = (currentSearchTerm === '' || 
                                   questionText.includes(currentSearchTerm) || 
                                   answerText.includes(currentSearchTerm));

            if (matchesCat && matchesSearch) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Update counter & empty state visibility
        const counterEl = document.getElementById('visible-faq-count');
        if (counterEl) counterEl.textContent = visibleCount;

        const emptyState = document.getElementById('faq-empty-state');
        const accordionList = document.getElementById('faq-accordion-list');
        
        if (emptyState && accordionList) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                accordionList.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                accordionList.classList.remove('hidden');
            }
        }
    }

    function setFaqSearch(term) {
        const searchInput = document.getElementById('faq-search-input');
        const searchClear = document.getElementById('faq-search-clear');
        if (searchInput) {
            searchInput.value = term;
            currentSearchTerm = term.toLowerCase().trim();
            if (searchClear) searchClear.classList.remove('hidden');
            filterFaqs();
            
            // Scroll smoothly to search area
            window.scrollTo({ top: 120, behavior: 'smooth' });
        }
    }

    function resetFaqFilters() {
        const searchInput = document.getElementById('faq-search-input');
        const searchClear = document.getElementById('faq-search-clear');
        if (searchInput) searchInput.value = '';
        if (searchClear) searchClear.classList.add('hidden');
        currentSearchTerm = '';
        selectFaqCategory('all');
    }

    // Single Accordion Toggle
    function toggleSingleAccordion(btn) {
        const isExpanded = btn.getAttribute('aria-expanded') === 'true';
        const bodyId = btn.getAttribute('aria-controls');
        const bodyEl = document.getElementById(bodyId);
        const chevron = btn.querySelector('.faq-chevron-icon');

        if (isExpanded) {
            btn.setAttribute('aria-expanded', 'false');
            if (bodyEl) bodyEl.classList.add('hidden');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        } else {
            btn.setAttribute('aria-expanded', 'true');
            if (bodyEl) bodyEl.classList.remove('hidden');
            if (chevron) chevron.style.transform = 'rotate(180deg)';
        }
    }

    // Expand All / Collapse All Toggle
    function toggleAllAccordion(open) {
        const cards = document.querySelectorAll('.faq-card-item:not(.hidden)');
        cards.forEach(card => {
            const btn = card.querySelector('.faq-header-btn');
            const bodyId = btn.getAttribute('aria-controls');
            const bodyEl = document.getElementById(bodyId);
            const chevron = btn.querySelector('.faq-chevron-icon');

            if (open) {
                btn.setAttribute('aria-expanded', 'true');
                if (bodyEl) bodyEl.classList.remove('hidden');
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            } else {
                btn.setAttribute('aria-expanded', 'false');
                if (bodyEl) bodyEl.classList.add('hidden');
                if (chevron) chevron.style.transform = 'rotate(0deg)';
            }
        });
    }

    // Interactive Helpfulness Feedback
    function sendFaqFeedback(faqId, val) {
        const box = document.getElementById(`feedback-box-${faqId}`);
        if (box) {
            box.innerHTML = `<span class="text-emerald-600 font-bold">✓ Terima kasih atas respon Anda!</span>`;
        }
        showToast(val === 'yes' ? 'Senang bisa membantu Anda!' : 'Masukan Anda sangat berarti bagi kami.');
    }

    function showToast(msg) {
        const toast = document.getElementById('faq-toast');
        const toastMsg = document.getElementById('faq-toast-msg');
        if (toast && toastMsg) {
            toastMsg.textContent = msg;
            toast.classList.remove('opacity-0', 'pointer-events-none');
            toast.classList.add('opacity-100');
            setTimeout(() => {
                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0', 'pointer-events-none');
            }, 3000);
        }
    }

    // Diagnosis Widget Interactive Selector
    function selectDiagnosis(key) {
        const item = diagnosisData[key];
        if (!item) return;

        // Active State Buttons
        document.querySelectorAll('.diag-btn').forEach(btn => {
            if (btn.getAttribute('data-diag') === key) {
                btn.classList.add('bg-cyan-500/30', 'border-cyan-400', 'ring-2', 'ring-cyan-400/50');
                btn.classList.remove('bg-white/10');
            } else {
                btn.classList.remove('bg-cyan-500/30', 'border-cyan-400', 'ring-2', 'ring-cyan-400/50');
                btn.classList.add('bg-white/10');
            }
        });

        // Update Card Data
        const titleEl = document.getElementById('diag-title');
        const timeEl  = document.getElementById('diag-time');
        const causeEl = document.getElementById('diag-cause');
        const toolEl  = document.getElementById('diag-tool');
        const waLink  = document.getElementById('diag-wa-link');

        if (titleEl) titleEl.textContent = item.title;
        if (timeEl)  timeEl.textContent  = item.time;
        if (causeEl) causeEl.textContent = item.cause;
        if (toolEl)  toolEl.textContent  = item.tool;
        if (waLink) {
            waLink.href = `https://wa.me/6281385404000?text=${encodeURIComponent(item.waMsg)}`;
            waLink.querySelector('span').textContent = `Panggil Teknisi ${item.title.split(' ')[0]} Sekarang →`;
        }
    }
</script>
@endpush
@endsection
