{{-- Standar Garansi & Keunggulan Layanan Rootera --}}

{{-- Inline CSS for scrollbar hiding (no Tailwind plugin required) --}}
<style>
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
.no-scrollbar::-webkit-scrollbar { display: none; }
</style>

<section class="bg-white py-14 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-8 md:mb-10">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-blue-50 text-blue-700 font-bold text-xs uppercase tracking-widest mb-3">
                🛡️ Standar Layanan Rootera
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Mengapa Pilihan Utama di {{ $locationShort }}?
            </h2>
            @if(isset($areaTechnicalIntro))
                <p class="text-sm sm:text-base text-slate-500 mt-3 leading-relaxed max-w-xl mx-auto">{!! $areaTechnicalIntro !!}</p>
            @endif
        </div>

        {{-- ─── CARD CONTAINER ───────────────────────────────────────────
             Mobile  : horizontal flex snap-scroll carousel (no wrap)
             Desktop : 4-column grid
        ──────────────────────────────────────────────────────────────── --}}
        <div class="flex lg:grid lg:grid-cols-4 overflow-x-auto lg:overflow-visible snap-x snap-mandatory gap-4 pb-4 lg:pb-0 no-scrollbar -mx-4 px-4 sm:-mx-6 sm:px-6 lg:mx-0 lg:px-0">

            {{-- ── Card 1: Tanpa Bongkar Lantai ──────────────────────── --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6
                        shadow-sm hover:shadow-xl hover:border-emerald-500/50 hover:-translate-y-1
                        transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-xl mb-4">
                        🛠️
                    </div>
                    <h3 class="text-slate-900 font-extrabold text-base mb-1.5">
                        100% Tanpa Bongkar Lantai
                    </h3>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Mesin Flexible Rotary Spiral Ridgid membersihkan pipa hingga puluhan meter tanpa merusak ubin, keramik, atau struktur lantai rumah Anda.
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Teknologi Mesin Modern</span>
                </div>
            </div>

            {{-- ── Card 2: Garansi Resmi 30 Hari ─────────────────────── --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6
                        shadow-sm hover:shadow-xl hover:border-blue-400/50 hover:-translate-y-1
                        transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center text-xl mb-4">
                        🛡️
                    </div>
                    <h3 class="text-slate-900 font-extrabold text-base mb-1.5">
                        Garansi Resmi 30 Hari
                    </h3>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Jaminan pengerjaan ulang gratis jika saluran kembali mampet dalam masa garansi resmi, tanpa syarat dan tanpa biaya tambahan apapun.
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500 shrink-0"></span>
                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Jaminan Tertulis Resmi</span>
                </div>
            </div>

            {{-- ── Card 3: Tanpa Bahan Kimia Berbahaya ────────────────── --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6
                        shadow-sm hover:shadow-xl hover:border-amber-400/50 hover:-translate-y-1
                        transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-xl mb-4">
                        🧼
                    </div>
                    <h3 class="text-slate-900 font-extrabold text-base mb-1.5">
                        Tanpa Bahan Kimia Berbahaya
                    </h3>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Tidak menggunakan soda api korosif. Lingkungan rumah tetap segar, aman untuk anak-anak, lansia, dan hewan peliharaan setelah pengerjaan.
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0"></span>
                    <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Ramah Penghuni Rumah</span>
                </div>
            </div>

            {{-- ── Card 4: Biaya Transparan ───────────────────────────── --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-3xl border border-slate-200/90 p-5 sm:p-6
                        shadow-sm hover:shadow-xl hover:border-purple-400/50 hover:-translate-y-1
                        transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center text-xl mb-4">
                        🏷️
                    </div>
                    <h3 class="text-slate-900 font-extrabold text-base mb-1.5">
                        Biaya Transparan, Tanpa Tersembunyi
                    </h3>
                    <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                        Estimasi biaya diinfokan jelas sebelum pengerjaan. Bayar hanya setelah pekerjaan terbukti tuntas. Berlaku sistem <strong class="text-slate-700">No Fix, No Fee</strong>.
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-purple-500 shrink-0"></span>
                    <span class="text-xs font-bold text-purple-600 uppercase tracking-wider">Harga Jujur & Terbuka</span>
                </div>
            </div>

        </div>{{-- end card container --}}

        {{-- Mobile swipe hint (hidden on desktop) --}}
        <div class="lg:hidden flex items-center justify-center gap-1.5 text-slate-400 text-xs mt-3 select-none">
            <span>←</span>
            <span>Geser untuk melihat semua standar garansi</span>
            <span>→</span>
        </div>

    </div>
</section>
