c<!-- FAQ Accordion Section -->
<section class="bg-white py-14 sm:py-16 px-4 sm:px-6 lg:px-8 border-b border-slate-200/80" id="faq-section" itemscope itemtype="https://schema.org/FAQPage">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center max-w-2xl mx-auto mb-10 md:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-emerald-50 text-[#169F81] font-bold text-xs uppercase tracking-widest border border-emerald-200 mb-3 shadow-xs">
                💡 BANTUAN &amp; JAWABAN CEPAT
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                FAQ Jasa {{ $category->name }} di {{ $district->name ?? $locationShort }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                Pertanyaan yang paling sering diajukan pelanggan sebelum memesan teknisi di <strong>{{ $district->name ?? $locationShort }}</strong>.
            </p>
        </div>

        @php
            $essentialFaqs = [
                [
                    'q' => "Berapa lama waktu kedatangan teknisi Rootera ke lokasi saya di " . ($district->name ?? $locationShort) . "?",
                    'a' => "Setelah pesanan dikonfirmasi via WhatsApp, teknisi terdekat dari <strong>" . ($dispatchHub ?? 'Pos Siaga') . "</strong> langsung meluncur ke lokasi Anda dengan estimasi <strong>15–30 Menit</strong>."
                ],
                [
                    'q' => "Apakah pengerjaan pelancaran pipa memerlukan pembongkaran lantai atau keramik?",
                    'a' => "<strong>100% Tanpa Bongkar</strong>. Kami menggunakan mesin Spiral Rotary Cable Ridgid fleksibel standar industri USA yang membersihkan pipa hingga puluhan meter tanpa merusak ubin atau keramik rumah Anda."
                ],
                [
                    'q' => "Berapa estimasi biaya jasa saluran mampet di area " . ($district->name ?? $locationShort) . "?",
                    'a' => "Tarif transparan <strong>mulai dari Rp 400.000-an</strong> untuk wastafel/bak cuci piring. Biaya final diinfokan di awal setelah inspeksi tanpa biaya tersembunyi."
                ],
                [
                    'q' => "Apa yang dimaksud dengan sistem garansi \"No Result No Pay\"?",
                    'a' => "Jika saluran yang tersumbat tidak berhasil kami lancarkan hingga air mengalir normal kembali, Anda tidak dikenakan biaya jasa pengerjaan <strong>(Tuntas Baru Bayar / No Result No Pay)</strong>."
                ],
                [
                    'q' => "Apakah ada jaminan garansi resmi setelah saluran lancar?",
                    'a' => "Ya, seluruh pekerjaan disertai <strong>Garansi Resmi 30 Hari</strong>. Jika saluran kembali mampet dalam masa garansi, teknisi kami kerjakan ulang <strong>100% GRATIS</strong>."
                ]
            ];
        @endphp

        <!-- 5 Curated Accordion Cards -->
        <div class="space-y-3.5">
            @foreach($essentialFaqs as $fIndex => $faqItem)
            <details class="group bg-white border border-slate-200/80 rounded-2xl transition-all duration-200 overflow-hidden shadow-xs hover:shadow-md group-open:border-l-4 group-open:border-l-[#169F81] group-open:border-emerald-500/80 group-open:bg-emerald-50/20 group-open:shadow-md" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question" {{ $fIndex === 0 ? 'open' : '' }}>
                <summary class="flex items-center justify-between px-4 py-4 sm:px-6 sm:py-5 min-h-[52px] font-bold text-slate-900 text-sm sm:text-base cursor-pointer list-none select-none group-open:bg-slate-50/70 transition-colors">
                    <div class="flex items-center gap-3 sm:gap-4 pr-2">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-full shrink-0 flex items-center justify-center font-extrabold text-xs transition-all shadow-xs group-open:bg-[#169F81] group-open:text-white group-open:ring-2 group-open:ring-emerald-200 bg-teal-50 text-[#169F81] border border-teal-200/60">
                            0{{ $fIndex + 1 }}
                        </span>
                        <span itemprop="name" class="leading-snug font-['Plus_Jakarta_Sans',sans-serif]">{{ $faqItem['q'] }}</span>
                    </div>
                    <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-100 group-open:bg-emerald-100 group-open:text-emerald-700 text-slate-500 flex items-center justify-center shrink-0 transition-transform duration-300 group-open:rotate-180 border border-slate-200/80 text-xs sm:text-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </span>
                </summary>
                <div class="px-4 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3.5 bg-white/70" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
                    <p itemprop="text" class="m-0">
                        {!! $faqItem['a'] !!}
                    </p>
                </div>
            </details>
            @endforeach
        </div>

        <!-- Micro-CTA Help Box -->
        <div class="mt-10 sm:mt-12 bg-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 border border-slate-800">
            <div class="text-center md:text-left">
                <span class="inline-block text-xs font-bold text-emerald-400 uppercase tracking-wider bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20 mb-2">💬 KONSULTASI GRATIS 24 JAM</span>
                <h3 class="text-base sm:text-xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">
                    Masih punya pertanyaan lain seputar kondisi pipa Anda di {{ $district->name ?? $locationShort }}?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">
                    Tim teknisi &amp; CS kami siap memberikan analisis &amp; estimasi biaya gratis secara langsung via WhatsApp.
                </p>
            </div>
            <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya ada pertanyaan seputar kondisi pipa mampet di area ' . ($district->name ?? $locationShort)) }}" 
               target="_blank" rel="noopener" 
               class="shrink-0 inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs sm:text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-emerald-900/30 transition-all hover:scale-105 active:scale-95 text-decoration-none min-h-[44px]">
                <span>Tanya Teknisi Langsung via WhatsApp →</span>
            </a>
        </div>

    </div>
</section>

