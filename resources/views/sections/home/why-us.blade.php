<section id="keunggulan" aria-labelledby="why-heading" class="relative overflow-hidden bg-gradient-to-br from-[#0b132b] via-[#0f172a] to-[#061434] py-8 sm:py-10 md:py-16 lg:py-20 text-white">
    
    {{-- Ambient Light Orb --}}
    <div class="absolute -top-24 -right-24 w-[400px] h-[400px] md:w-[600px] md:h-[600px] bg-[radial-gradient(circle,_rgba(16,185,129,0.14)_0%,_transparent_70%)] pointer-events-none z-0" aria-hidden="true"></div>

    <div class="container relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- SECTION HEADER --}}
        <div class="text-center max-w-3xl mx-auto mb-6 md:mb-14">
            <span class="inline-block bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[10px] sm:text-xs font-extrabold uppercase tracking-wider py-1 px-3 sm:px-3.5 rounded-full mb-2 md:mb-3 backdrop-blur-md whitespace-nowrap shadow-2xs">
                🏆 KEUNGGULAN TEKNOLOGI &amp; PROTOKOL KERJA
            </span>
            <h2 id="why-heading" class="text-xl sm:text-2xl md:text-[clamp(1.8rem,3.5vw,2.5rem)] font-extrabold text-white leading-snug md:leading-tight mb-2.5 md:mb-3">
                Keunggulan Jasa Saluran Pipa Mampet <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Rootera Plumbing</span>
            </h2>
            <p class="text-xs sm:text-sm md:text-[1.05rem] text-slate-300 md:text-slate-200/85 leading-relaxed max-w-2xl mx-auto mb-0">
                Kami menerapkan standar kerja kelas profesional menggunakan peralatan canggih tanpa membongkar keramik lantai atau merusak struktur bangunan Anda.
            </p>
        </div>

        {{-- 4 PILLARS GRID / MOBILE CAROUSEL PEEK SLIDER --}}
        <div id="whyus-slider-container"
             class="flex overflow-x-auto snap-x snap-mandatory gap-3 sm:gap-6 pb-3 mobile-scrollbar touch-pan-x touch-pan-y sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:overflow-visible sm:pb-0 sm:gap-6"
             style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @php
            $reasons = [
                [
                    'number' => '01',
                    'icon'   => '🌀',
                    'title'  => 'Tanpa Bongkar Keramik',
                    'desc'   => 'Mesin Drain Cleaner Spiral Baja Ridgid mengikis lemak beku & pembuangan tanpa merusak lantai atau keramik porcelain.',
                ],
                [
                    'number' => '02',
                    'icon'   => '📹',
                    'title'  => 'Inspeksi Kamera CCTV 30M',
                    'desc'   => 'Deteksi presisi lokasi retakan & sumbatan pipa secara visual melalui monitor HD sebelum & sesudah pengerjaan.',
                ],
                [
                    'number' => '03',
                    'icon'   => '🛡️',
                    'title'  => 'Garansi Resmi 30 Hari',
                    'desc'   => 'Jaminan garansi penuh tanpa syarat rumit. Jika pipa tersumbat kembali dalam masa garansi, teknisi datang gratis.',
                ],
                [
                    'number' => '04',
                    'icon'   => '✨',
                    'title'  => 'Teknisi APD Steril K3',
                    'desc'   => 'Teknisi bekerja higienis menggunakan cover sepatu, sarung tangan steril, & memastikan lokasi kerja selalu bersih.',
                ],
            ];
            @endphp

            @foreach($reasons as $r)
            <div class="w-[80vw] min-w-[80vw] sm:min-w-0 snap-center shrink-0 sm:w-auto bg-white/[0.04] border border-white/[0.12] backdrop-blur-md rounded-2xl p-4 sm:p-6 shadow-xl hover:-translate-y-1 md:hover:-translate-y-2 hover:border-emerald-400/50 transition-all duration-300 group flex flex-col justify-between h-full">
                <div>
                    <div class="flex justify-between items-center mb-3 md:mb-5">
                        <div class="text-xl sm:text-2xl md:text-3xl shrink-0 group-hover:scale-110 transition-transform">
                            {{ $r['icon'] }}
                        </div>
                        <span class="text-base md:text-2xl font-extrabold text-slate-500/80 md:text-slate-400/40 font-mono">
                            {{ $r['number'] }}
                        </span>
                    </div>
                    <h3 class="text-sm sm:text-base md:text-[1.15rem] font-extrabold text-white mb-1.5 md:mb-2 group-hover:text-emerald-300 transition-colors">
                        {{ $r['title'] }}
                    </h3>
                    <p class="text-xs md:text-[0.88rem] text-slate-300 md:text-slate-200/75 leading-relaxed line-clamp-3 md:line-clamp-none">
                        {{ $r['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Mobile Dynamic Interactive Carousel Dots --}}
        <div id="whyus-dots-container" class="sm:hidden flex items-center justify-center gap-1.5 mt-3">
            @foreach($reasons as $index => $r)
                <button type="button" 
                        onclick="scrollToSliderItem('whyus-slider-container', {{ $index }})" 
                        aria-label="Geser ke slide {{ $index + 1 }}" 
                        class="transition-all duration-300 rounded-full h-1.5 {{ $index === 0 ? 'w-6 bg-emerald-500' : 'w-1.5 bg-slate-700' }}">
                </button>
            @endforeach
        </div>

    </div>
</section>
