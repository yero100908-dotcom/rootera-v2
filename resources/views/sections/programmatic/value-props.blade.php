{{-- Standar Garansi & Keunggulan Layanan Rootera --}}

<section class="bg-slate-100/90 py-12 sm:py-16 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-50 text-[#169F81] font-bold text-xs uppercase tracking-widest mb-2.5 border border-emerald-200 shadow-xs">
                🛡️ STANDAR LAYANAN ROOTERA
            </span>
            <h2 class="text-xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Mengapa Pilihan Utama di {{ $locationShort }}?
            </h2>
            @if(isset($areaTechnicalIntro))
                <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed max-w-3xl mx-auto text-center">{!! $areaTechnicalIntro !!}</p>
            @endif
        </div>

        {{-- 4 Core Pillars Grid (2x2 on Mobile, 4-col on Desktop) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-5 md:gap-6">

            {{-- ── Card 1: 100% Non-Bongkar Keramik ───────────────────── --}}
            <div class="bg-white p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-[#169F81]/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-teal-50 text-[#169F81] border border-teal-200/60 flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-[#169F81] group-hover:text-white transition-all duration-300 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-xs sm:text-base mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        100% Non-Bongkar Keramik
                    </h3>
                    <p class="text-[11px] sm:text-xs text-slate-500 md:text-slate-600 leading-relaxed">
                        Penanganan mekanis kabel spiral fleksibel menembus belokan pipa P-Trap tanpa membongkar lantai ubin atau merusak dinding.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#169F81] shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-[#169F81] uppercase tracking-wider">Tanpa Merusak Ubin</span>
                </div>
            </div>

            {{-- ── Card 2: Garansi Tuntas 30 Hari ────────────────────── --}}
            <div class="bg-white p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-[#0A2E78]/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-blue-50 text-[#0A2E78] border border-blue-200/60 flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-[#0A2E78] group-hover:text-white transition-all duration-300 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-xs sm:text-base mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        Garansi Tuntas 30 Hari
                    </h3>
                    <p class="text-[11px] sm:text-xs text-slate-500 md:text-slate-600 leading-relaxed">
                        Perhitungan jaminan 30 hari kalender. Jika mampet ulang pada titik sama, teknisi datang perbaiki gratis tanpa biaya tambahan.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#0A2E78] shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-[#0A2E78] uppercase tracking-wider">Garansi Resmi 30 Hari</span>
                </div>
            </div>

            {{-- ── Card 3: Respon Cepat 20–35 Menit ──────────────────── --}}
            <div class="bg-white p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-amber-400/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200/60 flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-xs sm:text-base mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        Respon Cepat 20–35 Menit
                    </h3>
                    <p class="text-[11px] sm:text-xs text-slate-500 md:text-slate-600 leading-relaxed">
                        Armada posko siaga terdekat di wilayah {{ $locationShort }} bergerak cepat untuk penanganan darurat 24 jam nonstop.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-amber-500 shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-amber-600 uppercase tracking-wider">Armada Siaga 24 Jam</span>
                </div>
            </div>

            {{-- ── Card 4: 0% Kimia (Bebas Soda Api) ─────────────────── --}}
            <div class="bg-white p-4 sm:p-5 md:p-6 rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-emerald-400/50 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200/60 flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-xs">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-none stroke-current stroke-2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.4 19 2c1 2 2 4.1 2 7 0 4.4-3.6 8-8 8-1.2 0-2.3-.3-3.3-.9L11 20z"></path>
                            <path d="M12 10a6 6 0 0 0-4 5"></path>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-xs sm:text-base mb-1.5 font-['Plus_Jakarta_Sans',sans-serif] leading-snug">
                        0% Kimia (Bebas Soda Api)
                    </h3>
                    <p class="text-[11px] sm:text-xs text-slate-500 md:text-slate-600 leading-relaxed">
                        Metode mekanis ramah lingkungan. Tanpa bahan kimia korosif yang merusak sambungan pipa PVC atau mencemari air tanah.
                    </p>
                </div>
                <div class="mt-3 sm:mt-4 pt-2.5 sm:pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-emerald-500 shrink-0"></span>
                    <span class="text-[10px] sm:text-xs font-bold text-emerald-600 uppercase tracking-wider">100% Aman Untuk Pipa</span>
                </div>
            </div>

        </div>

    </div>
</section>

