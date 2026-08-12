<section class="section" aria-labelledby="reviews-heading" style="padding: 5rem 0;">
    <div class="container">
        
        <!-- Blue Container with Grid -->
        <div style="background-color: #0A2E78; border-radius: 20px; padding: 2.5rem; position: relative; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(10,46,120,0.3);">
            
            <!-- Grid Background Pattern -->
            <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none;"></div>

            <div style="position: relative; z-index: 10;">
                <div class="reviews-grid" style="display: flex; gap: 2.5rem; align-items: stretch; flex-wrap: wrap;">
                    
                    <!-- Left: Google Maps Iframe -->
                    <div class="map-container" style="flex: 1 1 400px; min-height: 450px; background: #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.733575990234!2d106.86013757529841!3d-6.327597493662243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed002bb5dce5%3A0x633fc2e245a44cd6!2sRootera%20Plumbing%20-%20Jasa%20Saluran%20Pipa%20Mampet!5e0!3m2!1sen!2sid!4v1714578508492!5m2!1sen!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0; min-height: 100%; display: block;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <!-- Right: Content & Reviews -->
                    <div class="reviews-content" style="flex: 1 1 500px; display: flex; flex-direction: column;">
                        
                        <!-- Badges and Title -->
                        <div style="text-align: left; margin-bottom: 1.5rem;">
                            <span style="display: inline-block; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: #ffffff; padding: 0.5rem 1.25rem; border-radius: 50px; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.05em; backdrop-filter: blur(4px); margin-bottom: 1rem;">
                                Tentang Kami Dari Customers
                            </span>
                            <h2 style="font-size: clamp(1.75rem, 3vw, 2.25rem); font-weight: 800; color: #ffffff; line-height: 1.2; margin: 0;">
                                Galeri Hasil <span style="color: #4ade80;">Kerja Nyata Kami!</span>
                            </h2>
                        </div>

                        <!-- Rating Summary Box -->
                        <div style="background: #ffffff; border-radius: 16px; padding: 1.5rem 2rem; display: flex; align-items: center; justify-content: space-between; max-width: 450px; margin-bottom: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                            <!-- Distribution Bars -->
                            <div style="flex: 1; margin-right: 2rem;">
                                @php
                                $bars = [
                                    5 => 100,
                                    4 => 0,
                                    3 => 0,
                                    2 => 0,
                                    1 => 0
                                ];
                                @endphp
                                @foreach($bars as $star => $width)
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                    <span style="font-size: 0.8rem; color: #64748b; min-width: 8px;">{{ $star }}</span>
                                    <div style="flex: 1; height: 6px; background: #f1f5f9; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #fbbc04; border-radius: 3px; width: {{ $width }}%;"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <!-- Rating Numbers -->
                            <div style="text-align: center;">
                                <div style="font-size: 3rem; font-weight: 800; color: #0f172a; line-height: 1;">5,0</div>
                                <div style="display: flex; justify-content: center; gap: 2px; margin: 4px 0;">
                                    @for($i=0; $i<5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#fbbc04" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    @endfor
                                </div>
                                <div style="font-size: 0.75rem; color: #64748b;">14 ulasan</div>
                            </div>
                        </div>

                        <!-- Ulasan Customers Badge -->
                        <div style="margin-bottom: 1rem;">
                            <span style="display: inline-block; background: linear-gradient(180deg, #60a5fa, #3b82f6); color: #ffffff; padding: 0.5rem 1.5rem; border-radius: 50px; font-weight: 800; font-size: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1), inset 0 2px 4px rgba(255,255,255,0.4); text-shadow: 0 1px 2px rgba(0,0,0,0.2);">
                                UlasanCustomers
                            </span>
                        </div>

                        <!-- Horizontal Scrollable Review Cards -->
                        <div class="reviews-slider" style="display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 1rem; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; margin-right: -2.5rem; padding-right: 2.5rem;">
                            <style>
                                .reviews-slider::-webkit-scrollbar {
                                    height: 8px;
                                }
                                .reviews-slider::-webkit-scrollbar-track {
                                    background: rgba(255,255,255,0.1);
                                    border-radius: 4px;
                                }
                                .reviews-slider::-webkit-scrollbar-thumb {
                                    background: rgba(255,255,255,0.3);
                                    border-radius: 4px;
                                }
                            </style>

                            @php
                            $reviews = [
                                [
                                    'name' => 'Rio Golden',
                                    'initial' => 'R',
                                    'color' => '#eab308',
                                    'time' => 'seminggu lalu',
                                    'text' => 'Ya ampun, PUAS BANGET!! 🤩❤️ Awalnya sempet was-was takut salurannya harus dibongkar dan bikin rumah berantakan. Ternyata enggak sama sekali! 😍 Teknisi kerja cepet, rapi, ramah banget...'
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
                                    'text' => 'teknisi ramah, bagus dan juga cekatan, wastafel saya jadi lancar deh. makasih rootera plumbing'
                                ],
                                [
                                    'name' => 'Elsa De Almeida',
                                    'initial' => 'E',
                                    'color' => '#8b5cf6',
                                    'time' => '2 jam lalu',
                                    'text' => 'kerenn perkerjaannya cepat'
                                ]
                            ];
                            @endphp

                            @foreach($reviews as $review)
                            <div style="flex: 0 0 280px; background: #ffffff; border-radius: 12px; padding: 1.25rem; scroll-snap-align: start; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; flex-direction: column;">
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 0.75rem;">
                                    <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $review['color'] }}; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">
                                        {{ $review['initial'] }}
                                    </div>
                                    <div>
                                        <h3 style="margin: 0; font-size: 0.9rem; font-weight: 700; color: #1e293b;">{{ $review['name'] }}</h3>
                                        <div style="display: flex; gap: 2px; margin-top: 2px;">
                                            @for($i=0; $i<5; $i++)
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="#fbbc04" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="width:16px; height:16px; margin-left:auto;">
                                </div>
                                <p style="color: #475569; font-size: 0.85rem; line-height: 1.5; margin: 0; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $review['text'] }}
                                </p>
                            </div>
                            @endforeach
                        </div>

                        <!-- Action Button -->
                        <div style="text-align: right; margin-top: 1rem;">
                            <a href="https://maps.app.goo.gl/VGB616JEzKUmNtFd6" target="_blank" rel="noopener noreferrer" style="display: inline-block; background-color: #4ade80; color: #ffffff; padding: 0.75rem 2rem; border-radius: 50px; font-weight: 800; font-size: 0.9rem; text-decoration: none; transition: transform 0.2s ease, background-color 0.2s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                Lihat Lebih Banyak!
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JSON-LD Schema Markup for LocalBusiness / AggregateRating & Reviews -->
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
    "name" => "Rootera",
    "image" => asset('images/logo final.png'),
    "@id" => url('/'),
    "url" => url('/'),
    "telephone" => "+6281385404000",
    "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => "5.0",
        "reviewCount" => "14",
        "bestRating" => "5",
        "worstRating" => "1"
    ],
    "review" => $schemaReviews
];
@endphp
<script type="application/ld+json">
{!! json_encode($reviewSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
