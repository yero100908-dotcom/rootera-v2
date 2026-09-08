{{-- Comparison Section: Rootera vs Metode Konvensional --}}
<section class="bg-white py-14 md:py-20 px-4 sm:px-6 lg:px-8 border-b border-slate-200">
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-10 md:mb-14">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-slate-900 text-emerald-400 font-bold text-xs uppercase tracking-widest mb-4">
                ⚖️ Komparasi Solusi
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Mengapa Memilih Rootera Dibanding Metode Tradisional?
            </h2>
            <p class="text-sm sm:text-base text-slate-500 mt-3 leading-relaxed">
                Bandingkan perbedaan pengerjaan modern tanpa bongkar kami dengan metode konvensional atau penggunaan bahan kimia berisiko.
            </p>
        </div>

        {{-- 2-Column Comparison Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6 items-stretch">

            {{-- === CARD LEFT: Rootera (Winner) === --}}
            <div class="relative flex flex-col rounded-3xl border-2 border-emerald-500 bg-white shadow-xl shadow-emerald-500/10 overflow-hidden">

                {{-- Card Header --}}
                <div class="bg-emerald-500 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="inline-block bg-white/20 text-white text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-full mb-2">
                                ✦ Standar Modern & Bergaransi
                            </span>
                            <h3 class="text-lg sm:text-xl font-extrabold text-white leading-tight">
                                Rootera Plumbing
                            </h3>
                            <p class="text-emerald-100 text-xs font-medium mt-0.5">Divisi Plumbing J&J Group</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center text-2xl shrink-0">
                            🏆
                        </div>
                    </div>
                </div>

                {{-- Parameters --}}
                <div class="flex-1 px-6 py-5 space-y-4">
                    @php
                        $rootera = [
                            ['label' => 'Metode Pengerjaan',     'value' => 'Mesin Rooter Spiral Flexible (100% Tanpa Bongkar Lantai)'],
                            ['label' => 'Keamanan Pipa',         'value' => '0% Risiko Kerusakan (Pipa PVC & sambungan lem aman terjaga)'],
                            ['label' => 'Efektivitas Kerak Lemak','value' => 'Hancur bersih 100% hingga dinding pipa, bukan sekadar dilubangi'],
                            ['label' => 'Waktu Penanganan',      'value' => '30 hingga 60 Menit tuntas, aktivitas tidak terganggu'],
                            ['label' => 'Garansi Pekerjaan',     'value' => 'Garansi Resmi 30 Hari. Pengerjaan ulang gratis jika mampet lagi'],
                            ['label' => 'Legalitas & Faktur',    'value' => 'Resmi PT/CV (J&J Group) + Invoice & Faktur Pajak tersedia'],
                        ];
                    @endphp

                    @foreach($rootera as $row)
                    <div class="flex items-start gap-3">
                        <span class="mt-0.5 w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-extrabold shrink-0">✓</span>
                        <div>
                            <div class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 mb-0.5">{{ $row['label'] }}</div>
                            <div class="text-sm font-semibold text-slate-800 leading-snug">{{ $row['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Bottom Rating --}}
                <div class="px-6 pb-6">
                    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-4 py-3 flex items-center justify-between">
                        <span class="text-xs font-bold text-emerald-800">⭐ 4.9/5 · 2.300+ Pelanggan Puas</span>
                        <span class="text-xs text-emerald-600 font-semibold">Buka 24 Jam</span>
                    </div>
                </div>
            </div>

            {{-- === CARD RIGHT: Konvensional (Warning) === --}}
            <div class="relative flex flex-col rounded-3xl border-2 border-slate-200 bg-slate-50 overflow-hidden">

                {{-- Card Header --}}
                <div class="bg-slate-700 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="inline-block bg-white/10 text-slate-300 text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-full mb-2">
                                ⚠ Berisiko & Tidak Terjamin
                            </span>
                            <h3 class="text-lg sm:text-xl font-extrabold text-white leading-tight">
                                Tukang Konvensional
                            </h3>
                            <p class="text-slate-400 text-xs font-medium mt-0.5">Soda Api / Bongkar Keramik</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl shrink-0">
                            🔧
                        </div>
                    </div>
                </div>

                {{-- Parameters --}}
                <div class="flex-1 px-6 py-5 space-y-4">
                    @php
                        $konvensional = [
                            ['label' => 'Metode Pengerjaan',     'value' => 'Bongkar ubin/keramik lantai atau tuang soda api panas beracun'],
                            ['label' => 'Keamanan Pipa',         'value' => 'Risiko tinggi. Pipa PVC melengkung & sambungan lem meleleh'],
                            ['label' => 'Efektivitas Kerak Lemak','value' => 'Hanya melubangi sumbatan sesaat. Cepat mampet kembali dalam hitungan minggu'],
                            ['label' => 'Waktu Penanganan',      'value' => '1 hingga 3 hari pengerjaan yang merepotkan & mengotori rumah'],
                            ['label' => 'Garansi Pekerjaan',     'value' => 'Tanpa garansi resmi. Risiko mampet lagi ditanggung sendiri'],
                            ['label' => 'Legalitas & Faktur',    'value' => 'Perorangan / tanpa legalitas formal, tidak ada invoice resmi'],
                        ];
                    @endphp

                    @foreach($konvensional as $row)
                    <div class="flex items-start gap-3">
                        <span class="mt-0.5 w-5 h-5 rounded-full bg-red-100 text-red-500 flex items-center justify-center text-xs font-extrabold shrink-0">✕</span>
                        <div>
                            <div class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-0.5">{{ $row['label'] }}</div>
                            <div class="text-sm font-semibold text-slate-500 leading-snug">{{ $row['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Bottom Warning --}}
                <div class="px-6 pb-6">
                    <div class="bg-red-50 border border-red-200 rounded-2xl px-4 py-3 flex items-center gap-2">
                        <span class="text-red-500 text-sm shrink-0">⚠️</span>
                        <span class="text-xs font-semibold text-red-700">Potensi biaya renovasi keramik Rp 500rb hingga Rp 3jt+</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Micro CTA Conclusion --}}
        <div class="mt-8 md:mt-10 bg-slate-900 rounded-3xl px-6 sm:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-5 text-center sm:text-left">
            <div>
                <p class="text-white font-bold text-base sm:text-lg leading-snug">
                    Hindari biaya renovasi keramik ratusan ribu rupiah.
                </p>
                <p class="text-slate-400 text-sm mt-1">
                    Pilih penanganan modern tanpa bongkar hari ini, bergaransi resmi 30 hari.
                </p>
            </div>
            <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya ingin jasa pelancaran pipa mampet tanpa bongkar di ' . $locationName . '. Berapa estimasi biayanya?') }}"
               target="_blank"
               class="shrink-0 inline-flex items-center gap-2 px-6 py-3.5 rounded-full bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-sm shadow-lg shadow-emerald-500/30 hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">
                <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                Pilih Metode Modern →
            </a>
        </div>

    </div>
</section>
