@props([
    'locationName' => 'Wilayah Terkait',
    'whatsappNumber' => '6281385404000'
])

<section class="py-16 sm:py-24 bg-white border-b border-slate-200/80" id="sektor-properti">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-3">
                🏢 SPESIALISASI LINTAS SEKTOR
            </span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Solusi Saluran Pipa Tersumbat untuk Berbagai Properti di {{ $locationName }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                Penanganan mekanis modern tanpa bongkar untuk hunian residensial, area kuliner, hingga fasilitas komersial skala besar.
            </p>
        </div>

        {{-- Grid 6 Sektor Bangunan (Prioritas Residensial First) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Sektor 1: Hunian Rumah Tinggal (Primary Highlight Badge) --}}
            <div class="bg-gradient-to-br from-emerald-50/80 via-white to-emerald-50/30 rounded-3xl p-6 border-2 border-[#169F81] shadow-xl relative flex flex-col justify-between group hover:shadow-2xl transition-all scale-[1.02]">
                <div class="absolute -top-3.5 left-6 bg-[#169F81] text-white text-[10px] font-bold px-3.5 py-1 rounded-full uppercase tracking-wider shadow-md">
                    ⭐ Paling Banyak Ditangani
                </div>
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-[#169F81] flex items-center justify-center text-2xl font-bold mb-4">🏠</div>
                    <h3 class="font-extrabold text-slate-900 text-xl mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Hunian Rumah Tinggal</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penanganan wastafel cuci piring, kloset toilet, dan floor drain kamar mandi tanpa bongkar keramik hunian pribadi Anda.
                    </p>
                    <ul class="mt-4 space-y-1.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Wastafel dapur, WC &amp; Floor drain</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Bebas kimia korosif soda api</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Garansi tuntas 30 hari resmi</li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo Rootera, saya butuh penanganan pipa mampet untuk Rumah Tinggal di ' . $locationName) }}"
                   target="_blank" rel="noopener"
                   class="mt-6 w-full py-3.5 bg-[#169F81] hover:bg-emerald-600 text-white font-bold text-xs rounded-xl text-center shadow-md transition-colors flex items-center justify-center gap-1.5 text-decoration-none">
                    <span>Konsultasi Sektor Ini</span> <span>→</span>
                </a>
            </div>

            {{-- Sektor 2: Restoran, Cafe & F&B --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl font-bold mb-4">🍽️</div>
                    <h3 class="font-extrabold text-slate-900 text-xl mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Restoran, Cafe &amp; F&amp;B</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penanganan lemak beku grease trap dan pembuangan cuci alat dapur agar operasional resto tidak terhenti saat jam sibuk.
                    </p>
                    <ul class="mt-4 space-y-1.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Hydro Jetting pengikis lemak 300 Bar</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Pengerjaan Shift Malam tanpa bau</li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo Rootera, saya butuh penanganan pipa mampet untuk Restoran/F&B di ' . $locationName) }}"
                   target="_blank" rel="noopener"
                   class="mt-6 w-full py-3.5 bg-slate-900 hover:bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md transition-colors flex items-center justify-center gap-1.5 text-decoration-none">
                    <span>Konsultasi Sektor Ini</span> <span>→</span>
                </a>
            </div>

            {{-- Sektor 3: Apartemen & Kondominium --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-bold mb-4">🏢</div>
                    <h3 class="font-extrabold text-slate-900 text-xl mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Apartemen &amp; Kondominium</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Pembersihan pipa shaft vertikal dan drainase unit hunian bertingkat tanpa risiko kebocoran ke unit di bawahnya.
                    </p>
                    <ul class="mt-4 space-y-1.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Kabel spiral fleksibel Ridgid USA</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Metode tanpa bising &amp; tanpa getar</li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo Rootera, saya butuh penanganan pipa mampet untuk Unit Apartemen di ' . $locationName) }}"
                   target="_blank" rel="noopener"
                   class="mt-6 w-full py-3.5 bg-slate-900 hover:bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md transition-colors flex items-center justify-center gap-1.5 text-decoration-none">
                    <span>Konsultasi Sektor Ini</span> <span>→</span>
                </a>
            </div>

            {{-- Sektor 4: Ruko Bisnis & Rukan --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-2xl font-bold mb-4">🏪</div>
                    <h3 class="font-extrabold text-slate-900 text-xl mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Ruko Bisnis &amp; Rukan</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penanganan pipa talang hujan, jalur got tertutup, dan instalasi toilet komersial area tempat usaha &amp; kantor ruko.
                    </p>
                    <ul class="mt-4 space-y-1.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Pelancaran bak kontrol &amp; talang</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Respon siaga teknisi terdekat</li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo Rootera, saya butuh penanganan pipa mampet Ruko/Rukan di ' . $locationName) }}"
                   target="_blank" rel="noopener"
                   class="mt-6 w-full py-3.5 bg-slate-900 hover:bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md transition-colors flex items-center justify-center gap-1.5 text-decoration-none">
                    <span>Konsultasi Sektor Ini</span> <span>→</span>
                </a>
            </div>

            {{-- Sektor 5: Gedung Perkantoran --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-[#0A2E78]/10 text-[#0A2E78] flex items-center justify-center text-2xl font-bold mb-4">🏛️</div>
                    <h3 class="font-extrabold text-slate-900 text-xl mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Gedung Perkantoran</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Layanan terjadwal untuk jaringan pipa gedung bertingkat dengan kelengkapan SOP K3 resmi &amp; seragam terverifikasi.
                    </p>
                    <ul class="mt-4 space-y-1.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Kepatuhan K3 &amp; APD Lengkap</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Kontrak Maintenance Berkala</li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo Rootera, saya butuh penanganan pipa mampet Gedung Perkantoran di ' . $locationName) }}"
                   target="_blank" rel="noopener"
                   class="mt-6 w-full py-3.5 bg-slate-900 hover:bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md transition-colors flex items-center justify-center gap-1.5 text-decoration-none">
                    <span>Konsultasi Sektor Ini</span> <span>→</span>
                </a>
            </div>

            {{-- Sektor 6: Area Pabrik & Industri --}}
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-md flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl transition-all group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-800 flex items-center justify-center text-2xl font-bold mb-4">🏭</div>
                    <h3 class="font-extrabold text-slate-900 text-xl mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Area Pabrik &amp; Industri</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Pembersihan pipa limbah berdiameter besar menggunakan Hydro-Jetting 300 Bar dengan fasilitas Faktur Pajak PPN 11%.
                    </p>
                    <ul class="mt-4 space-y-1.5 text-xs text-slate-600 font-medium">
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Hydro-Jetting 300 Bar industri</li>
                        <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> Faktur Pajak PPN 11% e-Faktur</li>
                    </ul>
                </div>
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Halo Rootera, saya butuh penanganan pipa limbah Pabrik/Industri di ' . $locationName) }}"
                   target="_blank" rel="noopener"
                   class="mt-6 w-full py-3.5 bg-slate-900 hover:bg-[#169F81] text-white font-bold text-xs rounded-xl text-center shadow-md transition-colors flex items-center justify-center gap-1.5 text-decoration-none">
                    <span>Konsultasi Sektor Ini</span> <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>
