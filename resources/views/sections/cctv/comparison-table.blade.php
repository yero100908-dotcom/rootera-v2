{{-- SECTION: TABEL KOMPARASI METODE BONGKAR ACAK VS ROOTERA CCTV INSPECTION --}}
<div class="my-8 max-w-full overflow-hidden" x-data="{ tab: 'rootera' }">
    <div class="text-center max-w-2xl mx-auto mb-6">
        <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Smart Choice</span>
        <h3 class="text-xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1 tracking-tight">
            Mengapa Memilih Diagnostik CCTV Dibanding Bongkar Acak?
        </h3>
        <p class="text-xs sm:text-sm text-slate-600 mt-1">
            Bandingkan risiko &amp; biaya antara metode tebak-tebakan tradisional dengan teknologi pemindaian visual presisi Rootera:
        </p>
    </div>

    {{-- Mobile Segmented Control Tab Navigation (Screen < 768px) --}}
    <div class="md:hidden flex bg-slate-100 p-1.5 rounded-2xl mb-4 border border-slate-200">
        <button type="button" @click="tab = 'rootera'" :class="tab === 'rootera' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-700 hover:text-slate-900'" class="flex-1 py-2.5 px-3 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-1.5">
            <span>⚡ Rootera CCTV</span>
        </button>
        <button type="button" @click="tab = 'traditional'" :class="tab === 'traditional' ? 'bg-rose-600 text-white shadow-md' : 'text-slate-700 hover:text-slate-900'" class="flex-1 py-2.5 px-3 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-1.5">
            <span>❌ Bongkar Acak</span>
        </button>
    </div>

    {{-- Mobile Tab Content Cards --}}
    <div class="md:hidden">
        {{-- Card Rootera CCTV Inspection --}}
        <div x-show="tab === 'rootera'" x-transition class="bg-emerald-50/90 border-2 border-emerald-500 rounded-2xl p-5 shadow-lg space-y-3">
            <div class="flex items-center justify-between pb-3 border-b border-emerald-200">
                <span class="text-sm font-extrabold text-emerald-950 flex items-center gap-1.5">
                    ⚡ Rootera CCTV Inspection
                </span>
                <span class="text-[10px] font-bold bg-emerald-200 text-emerald-900 px-2.5 py-0.5 rounded-full">Solusi Rekomendasi</span>
            </div>
            
            <div class="space-y-2.5 text-xs text-slate-800">
                <div class="p-2.5 rounded-xl bg-white border border-emerald-200/80 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Akurasi Titik Lokasi</span>
                    <strong class="text-emerald-700 text-sm block">Presisi 98% (Lensa HD + Sonde 512Hz)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-emerald-200/80 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Dampak Pada Ubin/Keramik</span>
                    <strong class="text-emerald-700 text-sm block">100% Utuh (Zero Pembongkaran Acak)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-emerald-200/80 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Biaya Restorasi Bangunan</span>
                    <strong class="text-emerald-700 text-sm block">Hemat Rp 0 (Tanpa Pekerjaan Sipil)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-emerald-200/80 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Bukti Transparansi</span>
                    <strong class="text-emerald-700 text-sm block">100% Transparan (File Video HD MP4)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-emerald-200/80 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Estimasi Waktu</span>
                    <strong class="text-emerald-700 text-sm block">Singkat (Selesai dalam 1 Jam)</strong>
                </div>
            </div>
        </div>

        {{-- Card Traditional Random Destruction --}}
        <div x-show="tab === 'traditional'" x-transition class="bg-rose-50/90 border-2 border-rose-300 rounded-2xl p-5 shadow-sm space-y-3">
            <div class="flex items-center justify-between pb-3 border-b border-rose-200">
                <span class="text-sm font-bold text-rose-950 flex items-center gap-1.5">
                    ❌ Pembongkaran Acak (Tradisional)
                </span>
                <span class="text-[10px] font-bold bg-rose-200 text-rose-800 px-2.5 py-0.5 rounded-full">Resiko Tinggi</span>
            </div>

            <div class="space-y-2.5 text-xs text-slate-800">
                <div class="p-2.5 rounded-xl bg-white border border-rose-200 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Akurasi Titik Lokasi</span>
                    <strong class="text-rose-700 text-sm block">Rendah (Mengandalkan tebakan acak)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-rose-200 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Dampak Pada Ubin/Keramik</span>
                    <strong class="text-rose-700 text-sm block">Berantakan (Membobol ubin acak)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-rose-200 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Biaya Restorasi Bangunan</span>
                    <strong class="text-rose-700 text-sm block">Mahal (Biaya ubin baru + tukang)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-rose-200 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Bukti Transparansi</span>
                    <strong class="text-rose-700 text-sm block">Tanpa Bukti (Hanya klaim lisan)</strong>
                </div>

                <div class="p-2.5 rounded-xl bg-white border border-rose-200 shadow-2xs">
                    <span class="text-slate-500 block text-[10px] font-bold uppercase mb-0.5">Estimasi Waktu</span>
                    <strong class="text-rose-700 text-sm block">Lama (Bisa berhari-hari bongkar)</strong>
                </div>
            </div>
        </div>
    </div>

    {{-- Desktop Table View (Screen >= 768px) --}}
    <div class="hidden md:block overflow-hidden border border-slate-200/90 rounded-3xl shadow-xs bg-white">
        <table class="w-full text-left text-xs sm:text-sm border-collapse">
            <thead>
                <tr class="bg-slate-900 text-white">
                    <th class="py-4 px-6 font-extrabold w-1/4">Parameter Diagnostik</th>
                    <th class="py-4 px-6 font-extrabold w-3/8 bg-rose-950/80 text-rose-300 border-l border-slate-800">
                        ❌ Metode Pembongkaran Acak (Tradisional)
                    </th>
                    <th class="py-4 px-6 font-extrabold w-3/8 bg-emerald-950/80 text-emerald-300 border-l border-slate-800">
                        ⚡ Metode Rootera CCTV Inspection
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <tr>
                    <td class="py-4 px-6 font-bold text-slate-900">Akurasi Penentuan Titik</td>
                    <td class="py-4 px-6 text-slate-600 bg-rose-50/30 border-l border-slate-100">
                        Rendah (Hanya mengandalkan perkiraan &amp; tebakan teknisi)
                    </td>
                    <td class="py-4 px-6 font-bold text-emerald-700 bg-emerald-50/40 border-l border-slate-100">
                        Presisi Tinggi (Visual HD 1080p + Sinyal 512Hz Sonde Locator)
                    </td>
                </tr>
                <tr class="bg-slate-50/50">
                    <td class="py-4 px-6 font-bold text-slate-900">Dampak Pada Keramik &amp; Lantai</td>
                    <td class="py-4 px-6 text-slate-600 bg-rose-50/50 border-l border-slate-100">
                        Rusak &amp; Berantakan (Membobol ubin di beberapa titik acak)
                    </td>
                    <td class="py-4 px-6 font-bold text-emerald-700 bg-emerald-50/60 border-l border-slate-100">
                        100% Utuh (Tanpa merusak keramik/semen cor sama sekali)
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-6 font-bold text-slate-900">Biaya Restorasi Bangunan</td>
                    <td class="py-4 px-6 text-rose-600 font-semibold bg-rose-50/30 border-l border-slate-100">
                        Tinggi (Biaya tukang, beli ubin baru, semen, &amp; cat ulang)
                    </td>
                    <td class="py-4 px-6 font-bold text-emerald-700 bg-emerald-50/40 border-l border-slate-100">
                        Rp 0 (Hemat jutaan rupiah karena tidak ada pengerjaan sipil)
                    </td>
                </tr>
                <tr class="bg-slate-50/50">
                    <td class="py-4 px-6 font-bold text-slate-900">Bukti Transparansi Problem</td>
                    <td class="py-4 px-6 text-slate-600 bg-rose-50/50 border-l border-slate-100">
                        Tidak Ada (Hanya klaim lisan dari tukang)
                    </td>
                    <td class="py-4 px-6 font-bold text-emerald-700 bg-emerald-50/60 border-l border-slate-100">
                        Transparan 100% (File Rekaman Video HD MP4 &amp; Live Monitor)
                    </td>
                </tr>
                <tr>
                    <td class="py-4 px-6 font-bold text-slate-900">Waktu Pengerjaan</td>
                    <td class="py-4 px-6 text-slate-600 bg-rose-50/30 border-l border-slate-100">
                        Lama (Bisa memakan waktu berhari-hari karena bongkar pasang)
                    </td>
                    <td class="py-4 px-6 font-bold text-emerald-700 bg-emerald-50/40 border-l border-slate-100">
                        Singkat &amp; Cepat (Proses inspeksi selesai dalam 1 jam)
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
