{{-- Transparansi Tarif & Estimasi Biaya Darurat Section --}}

<section class="bg-slate-50 border-b border-slate-200/80 py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center max-w-3xl mx-auto mb-8 md:mb-10">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-3">
                🏷️ Transparansi Biaya Rootera
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Estimasi Biaya Jasa Saluran Pipa Mampet di {{ $district->name ?? $locationShort }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                Biaya transparan di awal tanpa biaya tersembunyi. Bayar hanya jika pekerjaan tuntas 100% (<strong class="text-slate-900 font-bold">No Fix, No Fee</strong>).
            </p>
        </div>

        {{-- ── CARD CONTAINER: snap-scroll on mobile, 4-col grid on desktop ── --}}
        <div class="flex lg:grid lg:grid-cols-4 overflow-x-auto lg:overflow-visible snap-x snap-mandatory gap-4 pb-4 lg:pb-0 no-scrollbar -mx-4 px-4 sm:-mx-6 sm:px-6 lg:mx-0 lg:px-0">

            {{-- Card 1: Wastafel / Bak Cuci Piring --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-2xl border border-slate-200 p-5 shadow-sm
                        hover:shadow-md hover:border-emerald-500 transition-all duration-200
                        flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-3 right-3 bg-amber-100 text-amber-800 text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider">
                    Paling Populer
                </div>
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">🥣</div>
                    <h3 class="text-base font-bold text-slate-900 mb-1">Wastafel & Cuci Piring</h3>
                    <p class="text-xs text-slate-500 mb-3">Pelancaran bak cuci berlemak beku</p>
                    <div class="mb-4 pb-4 border-b border-slate-100">
                        <span class="text-xs text-slate-400 font-medium block">Estimasi Tarif:</span>
                        <span class="text-xl font-extrabold text-emerald-600">Mulai Rp 400rb</span>
                    </div>
                    <ul class="space-y-2 text-xs text-slate-600 mb-5">
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Mesin Rotary Spiral Flexible</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Pengikisan Lemak & Sisa Sabun</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Garansi Pengerjaan 30 Hari</span></li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya ingin pesan penanganan Wastafel / Bak Cuci Piring di area ' . ($district->name ?? $locationShort) . '. Berapa estimasi totalnya?') }}"
                   target="_blank"
                   class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs py-3 px-4 rounded-xl text-center transition-colors duration-200 flex items-center justify-center gap-2">
                    <span>Pesan Jasa Ini</span><span class="text-emerald-400 group-hover:text-white">→</span>
                </a>
            </div>

            {{-- Card 2: Floor Drain Kamar Mandi --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-2xl border border-slate-200 p-5 shadow-sm
                        hover:shadow-md hover:border-emerald-500 transition-all duration-200
                        flex flex-col justify-between relative overflow-hidden group">
                <div class="absolute top-3 right-3 bg-emerald-100 text-emerald-800 text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider">
                    Rekomendasi
                </div>
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">🚿</div>
                    <h3 class="text-base font-bold text-slate-900 mb-1">Floor Drain Kamar Mandi</h3>
                    <p class="text-xs text-slate-500 mb-3">Pembersihan rontokan rambut & sabun</p>
                    <div class="mb-4 pb-4 border-b border-slate-100">
                        <span class="text-xs text-slate-400 font-medium block">Estimasi Tarif:</span>
                        <span class="text-xl font-extrabold text-emerald-600">Mulai Rp 400rb</span>
                    </div>
                    <ul class="space-y-2 text-xs text-slate-600 mb-5">
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Mesin Rotary Spiral Flexible</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Pembersihan Rambut & Kerak Sabun</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Garansi Pengerjaan 30 Hari</span></li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya ingin pesan penanganan Floor Drain Kamar Mandi di area ' . ($district->name ?? $locationShort) . '. Berapa estimasi totalnya?') }}"
                   target="_blank"
                   class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs py-3 px-4 rounded-xl text-center transition-colors duration-200 flex items-center justify-center gap-2">
                    <span>Pesan Jasa Ini</span><span class="text-emerald-400 group-hover:text-white">→</span>
                </a>
            </div>

            {{-- Card 3: Kloset Duduk / Jongkok --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-2xl border border-slate-200 p-5 shadow-sm
                        hover:shadow-md hover:border-emerald-500 transition-all duration-200
                        flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">🚽</div>
                    <h3 class="text-base font-bold text-slate-900 mb-1">Kloset Duduk / Jongkok</h3>
                    <p class="text-xs text-slate-500 mb-3">Pelancaran WC meluap & tersumbat</p>
                    <div class="mb-4 pb-4 border-b border-slate-100">
                        <span class="text-xs text-slate-400 font-medium block">Estimasi Tarif:</span>
                        <span class="text-xl font-extrabold text-emerald-600">Mulai Rp 400rb</span>
                    </div>
                    <ul class="space-y-2 text-xs text-slate-600 mb-5">
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Penanganan WC Meluap 24 Jam</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Tanpa Pembongkaran Kloset</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Garansi Pengerjaan 30 Hari</span></li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya ingin pesan penanganan Kloset / WC Tersumbat di area ' . ($district->name ?? $locationShort) . '. Berapa estimasi totalnya?') }}"
                   target="_blank"
                   class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs py-3 px-4 rounded-xl text-center transition-colors duration-200 flex items-center justify-center gap-2">
                    <span>Pesan Jasa Ini</span><span class="text-emerald-400 group-hover:text-white">→</span>
                </a>
            </div>

            {{-- Card 4: Pipa Utama / Got / Talang --}}
            <div class="w-[82vw] sm:w-[55vw] lg:w-auto shrink-0 lg:shrink snap-center
                        bg-white rounded-2xl border border-slate-200 p-5 shadow-sm
                        hover:shadow-md hover:border-emerald-500 transition-all duration-200
                        flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition-transform">🌧️</div>
                    <h3 class="text-base font-bold text-slate-900 mb-1">Pipa Utama / Got / Talang</h3>
                    <p class="text-xs text-slate-500 mb-3">Pelancaran pipa pembuangan utama</p>
                    <div class="mb-4 pb-4 border-b border-slate-100">
                        <span class="text-xs text-slate-400 font-medium block">Estimasi Tarif:</span>
                        <span class="text-xl font-extrabold text-emerald-600">Mulai Rp 400rb</span>
                    </div>
                    <ul class="space-y-2 text-xs text-slate-600 mb-5">
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Mesin Rigid Spiral Jangkauan Panjang</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Pembersihan Endapan Pasir & Lumpur</span></li>
                        <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">✓</span><span>Garansi Pengerjaan 30 Hari</span></li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya ingin pesan penanganan Pipa Utama / Got / Talang di area ' . ($district->name ?? $locationShort) . '. Berapa estimasi totalnya?') }}"
                   target="_blank"
                   class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs py-3 px-4 rounded-xl text-center transition-colors duration-200 flex items-center justify-center gap-2">
                    <span>Pesan Jasa Ini</span><span class="text-emerald-400 group-hover:text-white">→</span>
                </a>
            </div>

        </div>{{-- end snap container --}}

        {{-- Mobile swipe hint --}}
        <div class="lg:hidden flex items-center justify-center gap-1.5 text-slate-400 text-xs mt-3 select-none">
            <span>←</span><span>Geser untuk melihat semua paket harga</span><span>→</span>
        </div>

        {{-- Bottom Callout --}}
        <div class="mt-7 md:mt-9 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="space-y-1.5 text-xs md:text-sm text-slate-600">
                <div class="flex items-start gap-2 font-medium text-slate-800">
                    <span class="text-amber-500 shrink-0">💡</span>
                    <span>Biaya akhir disesuaikan tingkat kesulitan sumbatan di lapangan setelah cek awal teknisi.</span>
                </div>
                <div class="flex items-start gap-2 font-medium text-slate-800">
                    <span class="text-emerald-500 shrink-0">🛡️</span>
                    <span>Garansi 100% pengerjaan ulang gratis jika saluran kembali mampet dalam masa garansi.</span>
                </div>
            </div>
            <a href="{{ route('diagnostic.index') }}"
               class="inline-flex items-center gap-1.5 text-xs md:text-sm font-bold text-emerald-600 hover:text-emerald-700 hover:underline shrink-0">
                <span>Simulasi Diagnostik Interaktif →</span>
            </a>
        </div>

    </div>
</section>
