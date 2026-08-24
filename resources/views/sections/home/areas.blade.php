<section style="padding: 5rem 0; background: #ffffff;" id="area-jangkauan" aria-labelledby="area-heading">
    <div class="container">
        
        {{-- SECTION HEADER --}}
        <div class="text-center" style="max-width: 750px; margin: 0 auto 3.5rem;">
            <span style="background: rgba(11, 43, 100, 0.08); color: #0b2b64; font-size: 0.8rem; font-weight: 800; padding: 0.35rem 1rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 1rem;">
                📍 COVERAGE HUBS &amp; CABANG
            </span>
            <h2 id="area-heading" style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #0b2b64; margin-bottom: 0.75rem;">
                Jangkauan Cabang <span style="background: linear-gradient(90deg, #0b2b64, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Rootera Plumbing</span>
            </h2>
            <p style="color: #64748b; font-size: 1.02rem; line-height: 1.6; margin: 0;">
                Teknisi profesional kami standby di berbagai kota besar Jabodetabek, Jawa Barat, Jawa Tengah, Yogyakarta, &amp; Jawa Timur.
            </p>
        </div>

        {{-- CITY COVERAGE CARDS GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $cityCards = [
                    ['name' => 'Jakarta (Pusat, Selatan, Barat, Timur, Utara)', 'slug' => 'jakarta-selatan', 'desc' => 'Tim standby 24 jam untuk perumahan, apartemen, mall, & resto.', 'tag' => 'DKI Jakarta'],
                    ['name' => 'Bogor & Sentul', 'slug' => 'bogor', 'desc' => 'Penanganan cepat saluran mampet perumahan & villa kawasan Sentul.', 'tag' => 'Jawa Barat'],
                    ['name' => 'Depok & Margonda', 'slug' => 'depok', 'desc' => 'Layanan fast response untuk usaha kuliner, kosan, & rumah tangga.', 'tag' => 'Jawa Barat'],
                    ['name' => 'Tangerang & BSD City', 'slug' => 'tangerang-selatan', 'desc' => 'Teknisi profesional melayani cluster BSD, Bintaro, Alam Sutera.', 'tag' => 'Banten'],
                    ['name' => 'Bekasi & Cikarang', 'slug' => 'bekasi', 'desc' => 'Hydro-jetting pipa industri MM2100, EJIP, Jababeka & perumahan.', 'tag' => 'Jawa Barat'],
                    ['name' => 'Bandung, Semarang, Surabaya & Kota Lainnya', 'slug' => 'bandung', 'desc' => 'Cabang operasional resmi Rootera Plumbing di kota-kota besar.', 'tag' => 'Jawa & Sumatera'],
                ];
            @endphp

            @foreach($cityCards as $city)
            <a href="{{ url('/jasa-saluran-mampet/' . $city['slug']) }}" style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); border-radius: 20px; padding: 1.75rem; color: #ffffff; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 25px rgba(6,20,52,0.15); transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column;" class="hover:-translate-y-2 hover:shadow-2xl group">
                
                <div style="display: flex; justify-content: space-between; items-center: center; margin-bottom: 1.25rem;">
                    <span style="background: rgba(45, 212, 191, 0.2); border: 1px solid rgba(45, 212, 191, 0.4); color: #2dd4bf; font-size: 0.72rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        📍 {{ $city['tag'] }}
                    </span>
                    <span style="background: rgba(16, 185, 129, 0.2); color: #6ee7cc; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 9999px; display: flex; items-center: center; gap: 0.3rem;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;" class="animate-ping"></span> Siap Berangkat
                    </span>
                </div>

                <h3 style="font-size: 1.2rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem; line-height: 1.3;" class="group-hover:text-teal-300 transition-colors">
                    {{ $city['name'] }}
                </h3>

                <p style="color: rgba(255, 255, 255, 0.75); font-size: 0.85rem; line-height: 1.55; margin-bottom: 1.5rem;">
                    {{ $city['desc'] }}
                </p>

                <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.15); font-size: 0.82rem; font-weight: 700; color: #2dd4bf; display: flex; items-center: center; justify-content: space-between;">
                    <span>Lihat Halaman Area Kota →</span>
                    <span class="group-hover:translate-x-1 transition-transform">➔</span>
                </div>

            </a>
            @endforeach
        </div>

        <div class="text-center" style="margin-top: 3rem;">
            <a href="{{ route('area-layanan') }}" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #0b2b64; text-decoration: none; padding: 0.8rem 1.75rem; border-radius: 12px; font-weight: 800; font-size: 0.9rem; display: inline-flex; items-center: center; gap: 0.4rem;" class="hover:bg-slate-200">
                Eksplorasi Seluruh Direktori Wilayah &amp; Kecamatan →
            </a>
        </div>

    </div>
</section>
