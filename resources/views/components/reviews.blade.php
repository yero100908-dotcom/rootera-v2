<section class="section bg-white" aria-labelledby="reviews-heading">
    <div class="container">
        <div class="bg-blue-900 text-white rounded-3xl p-6 sm:p-10 relative overflow-hidden shadow-2xl" style="background: linear-gradient(135deg, #0A2E78 0%, #051636 100%);">
            
            {{-- Grid Pattern Layer --}}
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 40px 40px;"></div>

            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                {{-- Left: Embedded Google Maps --}}
                <div class="lg:col-span-5 min-h-[320px] sm:min-h-[400px] rounded-2xl overflow-hidden shadow-lg border border-white/10">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.733575990234!2d106.86013757529841!3d-6.327597493662243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed002bb5dce5%3A0x633fc2e245a44cd6!2sRootera%20Plumbing%20-%20Jasa%20Saluran%20Pipa%20Mampet!5e0!3m2!1sen!2sid!4v1714578508492!5m2!1sen!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0; min-height: 100%; display: block;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        title="Lokasi Kantor Rootera Plumbing"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                {{-- Right: Reviews & Ratings --}}
                <div class="lg:col-span-7 flex flex-col justify-between">
                    <div>
                        <div class="mb-4">
                            <span class="inline-block bg-white/15 border border-white/30 text-white px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-wider backdrop-blur-md mb-2">
                                Review Pelanggan Google
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight" id="reviews-heading">
                                Bukti Kepuasan <span class="text-emerald-400">Ribuan Klien</span>
                            </h2>
                        </div>

                        {{-- Rating Summary Card --}}
                        <div class="bg-white text-slate-900 rounded-2xl p-5 sm:p-6 mb-6 flex items-center justify-between shadow-md max-w-md">
                            <div class="flex-1 pr-6 border-r border-slate-200">
                                @php
                                $bars = [5 => 100, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                                @endphp
                                @foreach($bars as $star => $width)
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-bold text-slate-500 w-3">{{ $star }}</span>
                                    <div class="flex-1 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-400 rounded-full" style="width: {{ $width }}%;"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <div class="text-center pl-6">
                                <div class="text-4xl font-extrabold text-slate-900 leading-none">5,0</div>
                                <div class="flex justify-center gap-0.5 my-1.5">
                                    @for($i=0; $i<5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#fbbc04" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    @endfor
                                </div>
                                <div class="text-xs text-slate-500 font-semibold">2.300+ Ulasan Google</div>
                            </div>
                        </div>

                        {{-- Review Cards Horizontal Scroll --}}
                        <div class="reviews-slider flex gap-4 overflow-x-auto pb-4 scroll-snap-x snap-mandatory">
                            @php
                            $reviews = [
                                [
                                    'name' => 'Rio Golden',
                                    'initial' => 'R',
                                    'color' => '#eab308',
                                    'time' => 'seminggu lalu',
                                    'text' => 'Ya ampun, PUAS BANGET!! Awalnya sempet was-was takut salurannya harus dibongkar dan bikin rumah berantakan. Ternyata enggak sama sekali! Teknisi kerja cepet, rapi, ramah banget...'
                                ],
                                [
                                    'name' => 'Agoy Satya',
                                    'initial' => 'A',
                                    'color' => '#3b82f6',
                                    'time' => '2 hari lalu',
                                    'text' => 'Luar biasa, mantap betul pelayanannya. Penanganan saluran pembuangan sangat profesional. Teknisi ramah, komunikatif, alat lengkap. Bersih lancar kembali!'
                                ],
                                [
                                    'name' => 'Davin Gemini',
                                    'initial' => 'D',
                                    'color' => '#10b981',
                                    'time' => '5 hari lalu',
                                    'text' => 'Teknisi ramah, bagus dan juga cekatan, wastafel saya jadi lancar deh. Makasih Rootera Plumbing!'
                                ],
                                [
                                    'name' => 'Elsa De Almeida',
                                    'initial' => 'E',
                                    'color' => '#8b5cf6',
                                    'time' => '2 jam lalu',
                                    'text' => 'Keren banget pengerjaannya sangat cepat, bersih, dan bergaransi!'
                                ]
                            ];
                            @endphp

                            @foreach($reviews as $review)
                            <div class="flex-none w-[270px] bg-white rounded-xl p-4 shadow-md text-slate-900 snap-start flex flex-col justify-between border border-slate-100">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-9 h-9 rounded-full text-white font-bold flex items-center justify-center text-sm shadow-sm" style="background-color: {{ $review['color'] }};">
                                            {{ $review['initial'] }}
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900 leading-tight">{{ $review['name'] }}</h4>
                                            <div class="flex gap-0.5 mt-0.5">
                                                @for($i=0; $i<5; $i++)
                                                <svg width="10" height="10" viewBox="0 0 24 24" fill="#fbbc04"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="w-4 h-4 ml-auto">
                                    </div>
                                    <p class="text-slate-600 text-xs leading-relaxed line-clamp-4">
                                        {{ $review['text'] }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <a href="https://maps.app.goo.gl/VGB616JEzKUmNtFd6" target="_blank" rel="noopener noreferrer" class="btn btn-primary text-sm shadow-md hover:shadow-lg">
                            <span>Lihat Semua Ulasan di Google Maps</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- JSON-LD Schema Markup for LocalBusiness / AggregateRating & Reviews --}}
@php
$schemaReviews = [];
foreach($reviews as $index => $review) {
    $schemaReviews[] = [
        "@type" => "Review",
        "author" => [
            "@type" => "Person",
            "name" => $review['name']
        ],
        "datePublished" => \Carbon\Carbon::now()->subDays(($index+1)*5)->format('Y-m-d'),
        "reviewBody" => $review['text'],
        "reviewRating" => [
            "@type" => "Rating",
            "ratingValue" => "5",
            "bestRating" => "5",
            "worstRating" => "1"
        ]
    ];
}

$reviewSchema = [
    "@context" => "https://schema.org",
    "@type" => "LocalBusiness",
    "name" => "Rootera Plumbing",
    "image" => asset('images/logo-hijau.png'),
    "@id" => url('/'),
    "url" => url('/'),
    "telephone" => "+6281385404000",
    "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => "5.0",
        "reviewCount" => "2300",
        "bestRating" => "5",
        "worstRating" => "1"
    ],
    "review" => $schemaReviews
];
@endphp
<script type="application/ld+json">
{!! json_encode($reviewSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
