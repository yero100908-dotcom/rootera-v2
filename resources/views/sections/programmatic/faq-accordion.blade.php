<!-- FAQ Accordion Section -->
<section class="bg-white py-14 sm:py-16 px-4 sm:px-6 lg:px-8 border-b border-slate-200/80" id="faq-section" itemscope itemtype="https://schema.org/FAQPage">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center max-w-2xl mx-auto mb-10 md:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-2">
                ❓ Pertanyaan Populer
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                FAQ Jasa {{ $category->name }} di {{ $district->name ?? $locationShort }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-2">
                Jawaban langsung untuk pertanyaan paling sering ditanyakan seputar pengerjaan, estimasi waktu, & garansi di area {{ $district->name ?? $locationShort }}.
            </p>
        </div>

        @php
            $essentialFaqs = [
                [
                    'q' => "Berapa lama waktu kedatangan teknisi Rootera ke lokasi saya di " . ($district->name ?? $locationShort) . "?",
                    'a' => "Setelah pesanan dikonfirmasi via WhatsApp, teknisi terdekat dari " . ($dispatchHub ?? 'Pos Siaga') . " langsung dijadwalkan meluncur ke lokasi Anda sesuai antrean darurat hari itu juga. Kami memprioritaskan kasus saluran mampet aktif agar Anda tidak menunggu lama."
                ],
                [
                    'q' => "Apakah pengerjaan pelancaran pipa memerlukan pembongkaran lantai atau keramik?",
                    'a' => "100% Tanpa Bongkar. Kami menggunakan mesin Spiral Rotary Cable Ridgid fleksibel standar industri yang membersihkan pipa hingga puluhan meter tanpa merusak ubin atau keramik rumah Anda."
                ],
                [
                    'q' => "Berapa estimasi biaya jasa saluran mampet di area " . ($district->name ?? $locationShort) . "?",
                    'a' => "Tarif transparan mulai dari Rp 400.000 untuk wastafel/bak cuci piring. Biaya final diinfokan di awal setelah inspeksi tanpa biaya tersembunyi."
                ],
                [
                    'q' => "Apa yang dimaksud dengan sistem garansi \"No Fix, No Fee\"?",
                    'a' => "Jika saluran yang tersumbat tidak berhasil kami lancarkan hingga air mengalir normal kembali, Anda tidak dikenakan biaya jasa pengerjaan (bebas biaya)."
                ],
                [
                    'q' => "Apakah ada jaminan garansi resmi setelah saluran lancar?",
                    'a' => "Ya, seluruh pekerjaan disertai Garansi Resmi hingga 30 Hari. Jika saluran kembali mampet dalam masa garansi, teknisi kami kerjakan ulang gratis tanpa biaya tambahan."
                ]
            ];
        @endphp

        <!-- 5 Curated Native Details/Summary Accordion Cards -->
        <div class="space-y-3.5">
            @foreach($essentialFaqs as $fIndex => $faqItem)
            <details class="group bg-white border border-slate-200 rounded-2xl transition-all duration-200 overflow-hidden shadow-sm hover:border-emerald-500/60" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question" {{ $fIndex === 0 ? 'open' : '' }}>
                <summary class="flex items-center justify-between p-4 sm:p-5 font-bold text-slate-900 text-sm sm:text-base cursor-pointer list-none select-none group-open:text-emerald-700 group-open:bg-slate-50/80 transition-colors">
                    <span itemprop="name" class="pr-3 leading-snug">{{ $faqItem['q'] }}</span>
                    <span class="w-8 h-8 rounded-full bg-slate-100 group-open:bg-emerald-100 group-open:text-emerald-700 text-slate-500 flex items-center justify-center shrink-0 transition-transform duration-200 group-open:rotate-180 text-xs sm:text-sm">
                        ▼
                    </span>
                </summary>
                <div class="p-4 sm:p-5 pt-0 sm:pt-0 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-transparent group-open:border-slate-100 group-open:bg-slate-50/40" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
                    <p itemprop="text" class="m-0 pt-2">
                        {!! $faqItem['a'] !!}
                    </p>
                </div>
            </details>
            @endforeach
        </div>

        <!-- Help Callout Box -->
        <div class="mt-8 md:mt-10 bg-slate-900 text-white rounded-2xl p-5 sm:p-6 shadow-md flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
            <div>
                <div class="font-extrabold text-sm sm:text-base text-white">Masih punya pertanyaan seputar saluran pipa Anda?</div>
                <div class="text-xs text-slate-300 mt-0.5">Tim Customer Service &amp; Teknisi kami siap menjawab 24 Jam nonstop.</div>
            </div>
            <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya ada pertanyaan seputar jasa ' . $category->name . ' di area ' . ($district->name ?? $locationShort)) }}" 
               target="_blank" 
               class="bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs sm:text-sm px-5 py-3 rounded-full shadow-md shadow-emerald-500/20 whitespace-nowrap transition-transform active:scale-95 shrink-0 flex items-center gap-2">
                <span>Konsultasi Gratis via WA →</span>
            </a>
        </div>

    </div>
</section>
