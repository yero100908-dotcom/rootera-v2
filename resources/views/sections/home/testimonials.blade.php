<style>
    @keyframes marquee-scroll-left {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    .marquee-track {
        display: flex;
        width: max-content;
        animation: marquee-scroll-left 40s linear infinite;
        will-change: transform;
    }
    .marquee-track:hover {
        animation-play-state: paused;
    }
</style>

<section id="ulasan-pelanggan" class="w-full relative py-16 sm:py-24 overflow-hidden scroll-margin-top-[100px]" style="background-color: #0d1b2a; background-image: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.06) 0%, transparent 40%), radial-gradient(circle at 90% 80%, rgba(10, 46, 120, 0.2) 0%, transparent 50%), linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px); background-size: 100% 100%, 100% 100%, 24px 24px, 24px 24px;">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-500/10 text-[#10b981] border border-emerald-500/20 text-xs font-semibold uppercase tracking-wider mb-4">
                ⭐ ULASAN CUSTOMERS
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                Apa Kata Pelanggan Kami?
            </h2>
        </div>

        <!-- Rating Overview Card (Light Theme) -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 max-w-4xl mx-auto mb-16 shadow-xl shadow-slate-200/50">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-8">
                <!-- Left: score summary -->
                <div class="text-center sm:text-left flex flex-col items-center sm:items-start gap-2">
                    <div class="flex items-center gap-2 justify-center sm:justify-start">
                        <span class="text-5xl font-black text-slate-900">5.0</span>
                        <span class="text-lg font-bold text-slate-400">/ 5.0</span>
                    </div>
                    <div class="flex gap-0.5 text-amber-400 text-xl font-bold my-0.5">
                        ★ ★ ★ ★ ★
                    </div>
                    <p class="text-sm font-semibold text-slate-600">Berdasarkan 120+ Ulasan Google Maps</p>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#10b981]/10 text-[#10b981] text-xs font-bold mt-1">
                        <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        Ulasan Terverifikasi Google
                    </span>
                </div>

                <!-- Right: rating progress breakdown -->
                <div class="w-full sm:max-w-md flex flex-col gap-2">
                    @php
                    $ratingBreakdown = [
                        5 => 120,
                        4 => 0,
                        3 => 0,
                        2 => 0,
                        1 => 0,
                    ];
                    @endphp
                    @foreach($ratingBreakdown as $star => $count)
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-3 text-slate-700 font-bold">{{ $star }}</span>
                        <span class="text-amber-400">★</span>
                        <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-400 rounded-full transition-all duration-500" style="width: {{ $star === 5 ? 100 : 0 }}%"></div>
                        </div>
                        <span class="w-8 text-right text-slate-500 font-medium">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Marquee Carousel Section -->
        <div class="relative w-full overflow-hidden mb-12">
            <!-- Fade Gradient Masks -->
            <div class="pointer-events-none absolute inset-y-0 left-0 w-16 sm:w-32 bg-gradient-to-r from-[#0d1b2a] to-transparent z-10" aria-hidden="true"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-16 sm:w-32 bg-gradient-to-l from-[#0d1b2a] to-transparent z-10" aria-hidden="true"></div>

            @php
            $reviews = [
                [
                    'name' => 'Budi Santoso',
                    'initial' => 'B',
                    'bg' => 'bg-gradient-to-br from-blue-500 to-indigo-600',
                    'text' => 'Sangat puas dengan layanan Rootera! Pipa wastafel mampet bertahun-tahun langsung lancar dalam 30 menit. Teknisi ramah, profesional, dan peralatan sangat canggih tanpa membongkar keramik lantai sama sekali. Harga sangat transparan dan bergaransi.',
                    'date' => '2 hari yang lalu'
                ],
                [
                    'name' => 'Siti Aminah',
                    'initial' => 'S',
                    'bg' => 'bg-gradient-to-br from-emerald-500 to-teal-600',
                    'text' => 'Pekerjaannya rapi dan bersih. Pipa air kotor mampet di rumah bisa diatasi dengan hydro jetting modern. Air mengalir lancar kembali. Terima kasih banyak tim Rootera atas pelayanannya yang super cepat dan responsif!',
                    'date' => '1 minggu yang lalu'
                ],
                [
                    'name' => 'Rian Hidayat',
                    'initial' => 'R',
                    'bg' => 'bg-gradient-to-br from-amber-500 to-orange-600',
                    'text' => 'Toren air saya kotor sekali dan kran mampet tersumbat lumut. Panggil teknisi Rootera datang tepat waktu, toren langsung cling dibersihkan luar dalam dan kran lancar jaya lagi. Garansinya beneran bisa diklaim.',
                    'date' => '3 minggu yang lalu'
                ],
                [
                    'name' => 'Dewi Lestari',
                    'initial' => 'D',
                    'bg' => 'bg-gradient-to-br from-purple-500 to-pink-600',
                    'text' => 'Response time luar biasa cepat. Hubungi pagi, siang teknisi sudah datang dengan alat spiral elektrik modern. Saluran kamar mandi yang mampet selesai kurang dari 1 jam. Bersih, tertib, dan harga sangat terjangkau.',
                    'date' => '1 bulan yang lalu'
                ]
            ];
            // Repeated arrays to construct smooth loop
            $doubleReviews = array_merge($reviews, $reviews, $reviews, $reviews);
            @endphp

            <!-- Marquee Track -->
            <div class="marquee-track gap-6 py-4">
                @foreach($doubleReviews as $review)
                <div class="w-[310px] sm:w-[350px] shrink-0 bg-white rounded-2xl p-6 shadow-md border border-slate-200/80 flex flex-col justify-between transition-all duration-300 hover:shadow-xl hover:border-[#10b981]/30 hover:-translate-y-1 h-full min-h-[230px]">
                    <div>
                        <!-- Card Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-base shadow-sm {{ $review['bg'] }}">
                                    {{ $review['initial'] }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-slate-900 text-sm tracking-wide">{{ $review['name'] }}</h4>
                                    <div class="flex text-amber-400 text-xs">
                                        ★ ★ ★ ★ ★
                                    </div>
                                </div>
                            </div>
                            <!-- Google Icon (Aligned Top Right) -->
                            <div class="text-slate-300 flex-shrink-0">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.24 10.285V13.4h6.887C18.2 15.614 15.645 18 12.24 18c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.7 0 3.25.61 4.47 1.625l2.427-2.427C17.43 1.705 15.02 1 12.24 1 6.58 1 2 5.58 2 11.24s4.58 10.24 10.24 10.24c5.9 0 9.81-4.14 9.81-10 0-.67-.06-1.32-.18-1.9H12.24z"/>
                                </svg>
                            </div>
                        </div>
                        <!-- Review Text -->
                        <p class="text-slate-600 text-sm leading-relaxed mb-4 line-clamp-5">
                            "{{ $review['text'] }}"
                        </p>
                    </div>
                    <!-- Card Footer -->
                    <div class="text-xs text-slate-400 font-medium mt-auto">
                        {{ $review['date'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Lihat Lebih Banyak (CTA) -->
        <div class="text-center mt-4">
            <a href="https://www.google.com/maps/place/Rootera+Plumbing+-+Jasa+Saluran+Pipa+Mampet/@-6.3275975,106.8627125,17z/data=!4m8!3m7!1s0x0:0x0!8m2!3d-6.3275975!4d106.8627125!9m1!1b1" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 bg-[#10b981] hover:bg-emerald-600 text-white font-semibold rounded-full transition-all duration-300 shadow-lg shadow-emerald-500/15 transform hover:-translate-y-0.5 cursor-pointer">
                <span>Lihat Lebih Banyak di Google</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </div>
</section>
