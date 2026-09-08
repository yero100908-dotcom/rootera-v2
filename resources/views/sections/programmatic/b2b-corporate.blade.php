<!-- B2B & Commercial Services Compact Strip Banner -->
<section class="py-10 px-4 sm:px-6 lg:px-8 bg-white border-b border-slate-200/80">
    <div class="bg-slate-900 text-white rounded-3xl mx-auto max-w-7xl p-6 sm:p-8 shadow-xl border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">

        <!-- Left: Icon + Text -->
        <div class="flex items-center gap-4 text-white">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-2xl shrink-0">🏢</div>
            <div>
                <div class="text-xs font-bold uppercase tracking-widest text-emerald-400 mb-1">Layanan Komersial & Industri</div>
                <p class="text-sm text-slate-200 font-medium leading-snug">
                    Melayani <strong class="text-white">Residensial & Fasilitas Bisnis</strong> (Restoran, Ruko, Kantor, Hotel, dan Pabrik).
                    <span class="text-slate-400 block sm:inline mt-0.5 sm:mt-0">Tersedia SPK resmi &amp; Invoice perusahaan (J&amp;J Group).</span>
                </p>
            </div>
        </div>

        <!-- Right: CTA Button -->
        <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera B2B, saya ingin konsultasi layanan plumbing komersial di ' . $locationName) }}"
           target="_blank"
           class="shrink-0 inline-flex items-center gap-2 px-6 py-3 rounded-full bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs sm:text-sm shadow-lg shadow-emerald-500/25 transition-all duration-200 whitespace-nowrap">
            📞 Konsultasi B2B
        </a>

    </div>
</section>
