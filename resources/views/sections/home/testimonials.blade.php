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
        animation: marquee-scroll-left 45s linear infinite;
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
                ⭐ ULASAN REAL CUSTOMERS GOOGLE MAPS
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                Apa Kata Pelanggan Asli Kami?
            </h2>
            <p class="mt-3 text-slate-400 text-sm sm:text-base max-w-2xl mx-auto">
                Testimoni riil pelanggan Rootera Plumbing yang terverifikasi langsung dari lokasi Google Maps.
            </p>
        </div>

        <!-- Map & Rating Container -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16 max-w-7xl mx-auto">
            
            <!-- Left: Google Maps Interactive Embed -->
            <div class="bg-slate-900 rounded-3xl overflow-hidden shadow-xl shadow-emerald-900/20 border border-slate-700/50 min-h-[320px] lg:min-h-[100%] h-full relative">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5128341974773!2d106.8627791!3d-6.3275261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed006e00b8b5%3A0xde36fb02cfc2b7a5!2sRootera%20Plumbing%20-%20Jasa%20Saluran%20Pipa%20Mampet!5e0!3m2!1sid!2sid!4v1787587462755!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height: 320px; display: block;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="strict-origin-when-cross-origin"
                    class="w-full h-full rounded-3xl">
                </iframe>
                <div class="absolute bottom-3 left-3 z-10">
                    <a href="https://maps.app.goo.gl/gDmjvDa9RYJ66MvR8" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900/90 backdrop-blur-md text-white text-xs font-bold shadow-lg hover:bg-emerald-600 transition-colors">
                        📍 Buka Peta Google Maps →
                    </a>
                </div>
            </div>

            <!-- Right: Rating Overview Card (Light Theme) -->
            <div class="bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-xl shadow-emerald-900/20 flex flex-col justify-center h-full">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 w-full h-full">
                    <!-- Left: score summary -->
                    <div class="w-full md:w-1/2 text-center md:text-left flex flex-col items-center md:items-start justify-center gap-2">
                        <div class="flex items-center gap-2 justify-center md:justify-start">
                            <span class="text-5xl font-black text-slate-900">5.0</span>
                            <span class="text-lg font-bold text-slate-400">/ 5.0</span>
                        </div>
                        <div class="flex gap-1 text-amber-400 text-2xl font-bold my-1">
                            ★ ★ ★ ★ ★
                        </div>
                        <p class="text-base font-semibold text-slate-600">Ulasan Asli Google Maps Terverifikasi</p>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#10b981]/10 text-[#10b981] text-xs font-bold mt-2">
                            <svg class="w-4.5 h-4.5 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            Rootera Plumbing Google Business
                        </span>
                    </div>

                    <!-- Right: rating progress breakdown -->
                    <div class="w-full md:w-1/2 flex flex-col justify-center gap-3">
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
        </div>

        <!-- Marquee Carousel Section -->
        <div class="relative w-full overflow-hidden mb-12">
            <!-- Fade Gradient Masks -->
            <div class="pointer-events-none absolute inset-y-0 left-0 w-16 sm:w-32 bg-gradient-to-r from-[#0d1b2a] to-transparent z-10" aria-hidden="true"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 w-16 sm:w-32 bg-gradient-to-l from-[#0d1b2a] to-transparent z-10" aria-hidden="true"></div>

            @php
            $realReviews = [
                [
                    'name' => 'Nawri Ibrahim Argiffari',
                    'initial' => 'N',
                    'avatarInitial' => 'N',
                    'rating' => 5,
                    'timeAgo' => '2 hari lalu',
                    'date' => '2 hari lalu',
                    'isNew' => true,
                    'badge' => 'BARU',
                    'bg' => 'bg-[#00796B]',
                    'text' => 'Mantap bener pelayanan dari Rootera Plumbing. Wastafel dapur gw semalem mampet total, pagi dihubungi siang lgsg dateng. Gak pake ribet bongkar-bongkar, taunya lgsg plong lagi. Istri di rumah seneng gak ngomel mulu hahaha. Recommended lah pokoknya!',
                    'review' => 'Mantap bener pelayanan dari Rootera Plumbing. Wastafel dapur gw semalem mampet total, pagi dihubungi siang lgsg dateng. Gak pake ribet bongkar-bongkar, taunya lgsg plong lagi. Istri di rumah seneng gak ngomel mulu hahaha. Recommended lah pokoknya!',
                    'priceRating' => 'Harga bagus (Rp 200–400 rb)',
                    'service' => 'Pelancaran Saluran Wastafel Dapur',
                    'tags' => [
                        'Harga bagus (Rp 200–400 rb)',
                        'Pelancaran Saluran Wastafel Dapur'
                    ]
                ],
                [
                    'name' => 'Mina lope',
                    'initial' => 'M',
                    'avatarInitial' => 'M',
                    'rating' => 5,
                    'timeAgo' => '2 hari lalu',
                    'date' => '2 hari lalu',
                    'isNew' => true,
                    'badge' => 'BARU',
                    'bg' => 'bg-[#D81B60]',
                    'text' => 'Sangat membantu di saat darurat. Saluran air mampet langsung beres hari itu juga. Hasil kerja mantap dan bergaransi.',
                    'review' => 'Sangat membantu di saat darurat. Saluran air mampet langsung beres hari itu juga. Hasil kerja mantap dan bergaransi.',
                    'priceRating' => null,
                    'service' => 'Pelancaran Saluran Air',
                    'tags' => [
                        'Pelancaran Saluran Air'
                    ]
                ],
                [
                    'name' => 'marlia kelana',
                    'initial' => 'M',
                    'avatarInitial' => 'M',
                    'rating' => 5,
                    'timeAgo' => '2 hari lalu',
                    'date' => '2 hari lalu',
                    'isNew' => true,
                    'badge' => 'BARU',
                    'bg' => 'bg-[#558B2F]',
                    'text' => 'Saluran wastafel resto mampet dan air mulai menggenang. Saya coba hubungi Rootera, responsnya cukup cepat. Teknisi datang bawa peralatan dan langsung dikerjakan. Tidak perlu bongkar besar-besaran, setelah selesai salurannya sudah normal lagi.',
                    'review' => 'Saluran wastafel resto mampet dan air mulai menggenang. Saya coba hubungi Rootera, responsnya cukup cepat. Teknisi datang bawa peralatan dan langsung dikerjakan. Tidak perlu bongkar besar-besaran, setelah selesai salurannya sudah normal lagi.',
                    'priceRating' => null,
                    'service' => 'Pelancaran Saluran Wastafel Resto',
                    'tags' => [
                        'Pelancaran Saluran Wastafel Resto'
                    ]
                ],
                [
                    'name' => 'RAZQHA FAHZRY',
                    'initial' => 'R',
                    'avatarInitial' => 'R',
                    'rating' => 5,
                    'timeAgo' => '3 hari lalu',
                    'date' => '3 hari lalu',
                    'isNew' => true,
                    'badge' => 'BARU',
                    'bg' => 'bg-[#C0392B]',
                    'text' => 'rootera plumbing membuat saluran di resto kembali lancar, pengerjaan cepat dan rapih . teknisi ramah atas nama mas abi dan mas galih',
                    'review' => 'rootera plumbing membuat saluran di resto kembali lancar, pengerjaan cepat dan rapih . teknisi ramah atas nama mas abi dan mas galih',
                    'priceRating' => 'Harga: Rp 800 rb – Rp 1 jt',
                    'service' => 'Pelancaran Saluran Air Resto',
                    'tags' => [
                        'Harga: Rp 800 rb – Rp 1 jt',
                        'Pelancaran Saluran Air Resto'
                    ]
                ],
                [
                    'name' => 'Yero Virdhan Akifan',
                    'initial' => 'Y',
                    'avatarInitial' => 'Y',
                    'rating' => 5,
                    'timeAgo' => '1 bulan lalu',
                    'date' => '1 bulan lalu',
                    'isNew' => false,
                    'badge' => null,
                    'bg' => 'bg-[#4267B2]',
                    'text' => 'Sempat panik! Saluran dapur restoran kami mampet parah🤯. Mulai dari sink cuci piring, gutter, sampai saluran utama bikin air meluap dan dapur hampir banjir, apalagi pas restoran lagi ramai. 😵💦 Untung tim Rootera Plumbing💙💚 gercep datang dan langsung menangani masalahnya. Setelah dibersihkan, saluran kembali lancar dan operasional dapur normal lagi. 🙌 Secara keseluruhan puas dengan pelayanannya. Terima kasih Rootera Plumbing, sukses selalu! 👍👍',
                    'review' => 'Sempat panik! Saluran dapur restoran kami mampet parah🤯. Mulai dari sink cuci piring, gutter, sampai saluran utama bikin air meluap dan dapur hampir banjir, apalagi pas restoran lagi ramai. 😵💦 Untung tim Rootera Plumbing💙💚 gercep datang dan langsung menangani masalahnya. Setelah dibersihkan, saluran kembali lancar dan operasional dapur normal lagi. 🙌 Secara keseluruhan puas dengan pelayanannya. Terima kasih Rootera Plumbing, sukses selalu! 👍👍',
                    'priceRating' => null,
                    'service' => 'Pelancaran Saluran Dapur Restoran (Sink & Gutter)',
                    'tags' => [
                        'Pelancaran Saluran Dapur Restoran (Sink & Gutter)'
                    ]
                ],
                [
                    'name' => 'Agoy Satya',
                    'initial' => 'A',
                    'avatarInitial' => 'A',
                    'rating' => 5,
                    'timeAgo' => '2 minggu lalu',
                    'date' => '2 minggu lalu',
                    'isNew' => false,
                    'badge' => null,
                    'bg' => 'bg-[#5c3826]',
                    'text' => 'Luar biasa, mantap betul pelayanannya. Penanganan saluran pembuangan dan talang di Haka Dimsum Blok M sangat profesional. Mas-mas teknisinya ramah, komunikatif, dan alat yang dipakai lengkap banget. Dapur dan area sekitar langsung bersih lancar kembali. Terima kasih banyak, sukses terus buat usahanya! 👍🏼',
                    'review' => 'Luar biasa, mantap betul pelayanannya. Penanganan saluran pembuangan dan talang di Haka Dimsum Blok M sangat profesional. Mas-mas teknisinya ramah, komunikatif, dan alat yang dipakai lengkap banget. Dapur dan area sekitar langsung bersih lancar kembali. Terima kasih banyak, sukses terus buat usahanya! 👍🏼',
                    'priceRating' => 'Harga terjangkau',
                    'service' => 'Pelancaran Saluran Pembuangan & Talang',
                    'tags' => [
                        'Harga terjangkau',
                        'Pelancaran Saluran Pembuangan & Talang'
                    ]
                ]
            ];
            // Repeated arrays to construct smooth continuous loop
            $doubleReviews = array_merge($realReviews, $realReviews, $realReviews);
            @endphp

            <!-- Marquee Track -->
            <div class="marquee-track gap-6 py-4">
                @foreach($doubleReviews as $review)
                <div class="w-[320px] sm:w-[380px] shrink-0 bg-white rounded-2xl p-6 sm:p-7 shadow-md border border-slate-200/80 flex flex-col justify-between transition-all duration-300 hover:shadow-xl hover:border-[#10b981]/40 hover:-translate-y-1 h-auto min-h-[290px]">
                    <div>
                        <!-- Card Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-11 h-11 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm {{ $review['bg'] }}">
                                    {{ $review['initial'] }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-slate-900 text-base tracking-wide">{{ $review['name'] }}</h4>
                                        @if(!empty($review['isNew']) || !empty($review['badge']))
                                        <span class="bg-red-500 text-white text-[0.65rem] font-extrabold px-1.5 py-0.5 rounded uppercase">
                                            {{ $review['badge'] ?? 'BARU' }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-1.5 text-amber-400 text-sm mt-0.5">
                                        ★ ★ ★ ★ ★
                                        <span class="text-xs text-slate-400 font-normal ml-1">• {{ $review['timeAgo'] ?? $review['date'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Google Icon (Aligned Top Right) -->
                            <div class="text-slate-400 flex-shrink-0">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.24 10.285V13.4h6.887C18.2 15.614 15.645 18 12.24 18c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.7 0 3.25.61 4.47 1.625l2.427-2.427C17.43 1.705 15.02 1 12.24 1 6.58 1 2 5.58 2 11.24s4.58 10.24 10.24 10.24c5.9 0 9.81-4.14 9.81-10 0-.67-.06-1.32-.18-1.9H12.24z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Review Text -->
                        <p class="text-slate-700 text-sm leading-relaxed mb-4 font-medium">
                            "{{ $review['review'] ?? $review['text'] }}"
                        </p>
                    </div>

                    <!-- Footer Tags (Service & Price Details) -->
                    @if(!empty($review['tags']))
                    <div class="pt-3 border-t border-slate-100 mt-auto flex flex-wrap gap-1.5">
                        @foreach($review['tags'] as $tag)
                        @if(str_contains(strtolower($tag), 'harga'))
                        <span class="bg-emerald-50 text-emerald-700 text-[0.72rem] font-bold px-2.5 py-1 rounded-md border border-emerald-200/60">
                            🏷️ {{ $tag }}
                        </span>
                        @else
                        <span class="bg-blue-50 text-blue-700 text-[0.72rem] font-bold px-2.5 py-1 rounded-md border border-blue-200/60">
                            🔧 {{ $tag }}
                        </span>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Lihat Lebih Banyak (CTA) -->
        <div class="text-center mt-4">
            <a href="https://maps.app.goo.gl/gDmjvDa9RYJ66MvR8" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-7 py-3.5 bg-[#10b981] hover:bg-emerald-600 text-white font-bold rounded-full transition-all duration-300 shadow-lg shadow-emerald-500/20 transform hover:-translate-y-0.5 cursor-pointer text-sm sm:text-base">
                <span>Lihat Lebih Banyak di Google Maps</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </div>
</section>
