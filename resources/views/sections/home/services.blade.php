<section id="layanan" aria-labelledby="layanan-heading" class="relative overflow-hidden bg-gradient-to-b from-slate-50 via-white to-slate-50 text-slate-900 py-8 sm:py-12 md:py-16 border-t border-slate-200/60">
    
    {{-- Subtle Ambient Water Glow & Pattern --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[350px] bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-sky-100/50 via-emerald-50/20 to-transparent pointer-events-none z-0" aria-hidden="true"></div>
    <div class="absolute top-20 right-0 w-[400px] h-[300px] bg-cyan-400/5 blur-[90px] rounded-full pointer-events-none z-0" aria-hidden="true"></div>
    <div class="absolute bottom-10 left-0 w-[400px] h-[300px] bg-emerald-400/5 blur-[90px] rounded-full pointer-events-none z-0" aria-hidden="true"></div>

    <div class="container relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- SECTION HEADER --}}
        <div class="text-center max-w-3xl mx-auto mb-6 md:mb-12">
            <span class="inline-block bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] sm:text-xs font-extrabold uppercase tracking-wider py-1 px-3.5 rounded-full mb-2 md:mb-3 shadow-2xs">
                🛠️ SOLUSI SPESIALIS PIPA TANPA BONGKAR
            </span>
            <h2 class="section-title text-xl sm:text-2xl md:text-[clamp(1.8rem,3.5vw,2.5rem)] font-extrabold text-slate-900 leading-tight mb-2 md:mb-3" id="layanan-heading">
                Layanan Jasa Saluran Pipa Mampet <span class="text-emerald-600">Tanpa Bongkar</span>
            </h2>
            <p class="text-xs sm:text-sm md:text-[1.02rem] text-slate-600 leading-relaxed max-w-2xl mx-auto mb-0">
                Penanganan cepat pipa tersumbat menggunakan <strong>Mesin Spiral Drain Cleaner Modern</strong> &amp; <strong>Kamera CCTV Inspeksi Digital</strong> untuk rumah tangga, restoran, kantor, dan fasilitas publik.
            </p>
        </div>

        {{-- INTERACTIVE CARDS GRID / MOBILE HORIZONTAL SCROLL CAROUSEL --}}
        <div id="services-slider-container" 
             class="flex overflow-x-auto snap-x snap-mandatory gap-3 sm:gap-6 pb-3 mobile-scrollbar touch-pan-x touch-pan-y md:grid md:grid-cols-2 lg:grid-cols-3 md:overflow-visible md:pb-0 md:gap-6"
             style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @php
                $serviceItems = [
                    [
                        'icon' => '🚰',
                        'title' => 'Wastafel & Kitchen Sink',
                        'badge' => '⚡ Paling Sering Tersumbat',
                        'desc' => 'Pembersihan endapan lemak padat, sisa minyak makanan, & saringan berkerak pada bak cuci piring dapur.',
                        'tags' => ['Mesin Drain Cleaner', 'Spiral Rotary K-50', 'Bebas Bau'],
                        'url' => '/layanan/wastafel-mampet',
                    ],
                    [
                        'icon' => '🚽',
                        'title' => 'Kloset & Toilet Meluap',
                        'badge' => '🛡️ Garansi 30 Hari',
                        'desc' => 'Pelancaran WC tersumbat benda asing, tisu padat, atau leher angsa mampet tanpa membongkar porselen.',
                        'tags' => ['Spiral Steel Auger', 'Higienis K3', 'Tanpa Bongkar'],
                        'url' => '/layanan/wc-toilet-mampet',
                    ],
                    [
                        'icon' => '🚿',
                        'title' => 'Floor Drain Kamar Mandi',
                        'badge' => '💧 Bebas Genangan',
                        'desc' => 'Pembersihan tumpukan rontokan rambut, sisa sabun membeku, & pasir yang membuat air kamar mandi meluap.',
                        'tags' => ['Mesin Ridgid Rotary', 'Pipa PVC Safe', 'Lancar Total'],
                        'url' => '/layanan/kamar-mandi-mampet',
                    ],
                    [
                        'icon' => '🚰',
                        'title' => 'Cuci Toren & Kuras Tandon Air',
                        'badge' => '✨ Perawatan Higienis',
                        'desc' => 'Pembersihan kerak lumut membandel, endapan lumpur, dan sterilisasi tangki air bersih rumah tangga & komersial tanpa bahan kimia berbahaya.',
                        'tags' => ['High-Pressure Jet Cleaner', '100% Bebas Kimia Korosif', 'Air Higienis'],
                        'url' => route('services.cuci-toren'),
                        'direct_link' => true,
                    ],
                    [
                        'icon' => '🌊',
                        'title' => 'Hydro-Jetting Pelengkap B2B',
                        'badge' => '🔥 Kerak Lemak Ekstrem',
                        'desc' => 'Metode pelengkap semprotan air bertekanan 300 Bar untuk pembilas jaringan pipa restoran & pabrik skala besar.',
                        'tags' => ['Tekanan 300 Bar', 'Pipa Resto & Pabrik', 'Pembersih Kerak'],
                        'url' => '/layanan-b2b-komersial',
                    ],
                    [
                        'icon' => '🏬',
                        'title' => 'Got Utama & Bak Kontrol',
                        'badge' => '🧱 Pengurasan Sedimen',
                        'desc' => 'Pembersihan got luar, bak penampungan, & pipa pembuangan utama perumahan agar air lancar saat hujan deras.',
                        'tags' => ['Ridgid Heavy Duty', 'Got Perumahan', 'Bebas Banjir'],
                        'url' => '/layanan/got-saluran-pembuangan',
                    ],
                    [
                        'icon' => '🎥',
                        'title' => 'Inspeksi Kamera CCTV Pipa',
                        'badge' => '🔍 Deteksi Presisi HD',
                        'desc' => 'Audit jaringan pipa vertikal/horisontal menggunakan kamera crawler 30M untuk melacak lokasi retakan & sumbatan.',
                        'tags' => ['CCTV 30M HD', 'Laporan Digital', 'Deteksi Presisi'],
                        'url' => '/tentang-kami',
                    ],
                ];
            @endphp

            @foreach($serviceItems as $item)
            <div class="w-[82vw] min-w-[82vw] sm:min-w-[340px] snap-center shrink-0 md:w-auto md:min-w-0 bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-lg hover:border-emerald-400/60 transition-all duration-300 group flex flex-col justify-between h-full">
                
                <div class="flex flex-col flex-grow justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-3 md:mb-4">
                            <div class="w-10 h-10 md:w-13 md:h-13 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-lg md:text-2xl group-hover:scale-110 transition-transform shrink-0">
                                {{ $item['icon'] }}
                            </div>
                            <span class="bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-[10px] md:text-[0.72rem] font-bold px-2 py-0.5 md:px-3 md:py-1 rounded-full h-fit">
                                {{ $item['badge'] }}
                            </span>
                        </div>

                        <h3 class="text-base md:text-[1.2rem] font-extrabold text-slate-900 mb-1 md:mb-2 group-hover:text-emerald-600 transition-colors">
                            {{ $item['title'] }}
                        </h3>

                        <p class="text-xs md:text-[0.88rem] text-slate-600 leading-normal md:leading-relaxed mb-3 md:mb-5 line-clamp-3">
                            {{ $item['desc'] }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-1 md:gap-1.5 mb-3 md:mb-6 mt-auto">
                        @foreach($item['tags'] as $tag)
                            <span class="bg-slate-100 border border-slate-200/70 text-slate-700 text-[10px] md:text-[0.72rem] font-semibold py-0.5 px-2 md:py-1 md:px-2.5 rounded-md">
                                ✓ {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="pt-2.5 md:pt-4 border-t border-slate-100 mt-auto">
                    @if(isset($item['direct_link']) && $item['direct_link'])
                        <a href="{{ $item['url'] }}" class="text-sky-600 font-bold text-xs md:text-sm inline-flex items-center gap-1 hover:text-sky-700 min-h-[40px] md:min-h-[44px] text-decoration-none">
                            <span>Lihat Layanan Cuci Toren →</span>
                        </a>
                    @else
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh jasa pelancaran: ' . $item['title']) }}" target="_blank" rel="noopener noreferrer" class="text-emerald-600 font-bold text-xs md:text-sm inline-flex items-center gap-1 hover:text-emerald-700 min-h-[40px] md:min-h-[44px] text-decoration-none">
                            <span>Panggil Teknisi untuk Masalah Ini →</span>
                        </a>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
        <!-- Mobile Dynamic Interactive Carousel Dots -->
        <div id="services-dots-container" class="md:hidden flex items-center justify-center gap-1.5 mt-3">
            @foreach($serviceItems as $index => $item)
                <button type="button" 
                        onclick="scrollToSliderItem('services-slider-container', {{ $index }})" 
                        aria-label="Geser ke slide {{ $index + 1 }}" 
                        class="transition-all duration-300 rounded-full h-1.5 {{ $index === 0 ? 'w-6 bg-emerald-500' : 'w-1.5 bg-slate-300' }}">
                </button>
            @endforeach
        </div>

        {{-- CROSS-SELLING MINI HIGHLIGHT BANNER --}}
        <div class="mt-6 md:mt-10 bg-slate-900 text-white rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md max-w-4xl mx-auto">
            <div class="flex items-center gap-3 text-left">
                <span class="text-xl sm:text-2xl shrink-0">💡</span>
                <p class="text-xs sm:text-sm text-slate-300">
                    <strong class="text-white">Sekalian Perawatan Toren Air?</strong> Kami sediakan layanan kuras &amp; sterilisasi toren bertekanan tinggi saat teknisi standby di lokasi Anda.
                </p>
            </div>
            <a href="{{ route('services.cuci-toren') }}" class="shrink-0 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs px-4 py-2.5 sm:px-5 sm:py-2.5 rounded-full transition-all hover:scale-105 min-h-[40px] md:min-h-[44px] flex items-center justify-center text-decoration-none">
                Pelajari Jasa Cuci Toren →
            </a>
        </div>

        <div class="text-center mt-8 md:mt-12">
            <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white font-extrabold text-xs md:text-sm px-6 py-3 md:px-9 md:py-3.5 rounded-full text-decoration-none shadow-md transition-all">
                <span>Lihat Katalog Lengkap &amp; Estimasi Harga →</span>
            </a>
        </div>

    </div>
</section>
