<section style="padding: 5rem 0; background: #f8fafc;" id="layanan" aria-labelledby="layanan-heading">
    <div class="container">
        
        {{-- SECTION HEADER --}}
        <div class="text-center" style="max-width: 750px; margin: 0 auto 3.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem;">
                🛠️ INTERACTIVE SERVICE MATRIX
            </div>
            <h2 class="section-title" id="layanan-heading" style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #0b2b64; margin-bottom: 0.75rem;">
                Solusi Lengkap <span style="background: linear-gradient(90deg, #0b2b64, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Pelancaran Pipa &amp; Sanitasi</span>
            </h2>
            <p style="color: #64748b; font-size: 1.02rem; line-height: 1.6; margin: 0;">
                Penanganan cepat tanpa bongkar untuk masalah pipa mampet rumah tangga, restoran B2B, perkantoran, dan gedung bertingkat.
            </p>
        </div>

        {{-- INTERACTIVE CARDS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $serviceItems = [
                    [
                        'icon' => '🚰',
                        'title' => 'Wastafel & Kitchen Sink',
                        'badge' => '⚡ Paling Sering Tersumbat',
                        'desc' => 'Pembersihan endapan lemak padat, sisa makanan, & saringan berkerak pada bak cuci piring dapur.',
                        'tags' => ['Spiral Rotary K-50', 'Bebas Bau', 'Tanpa Bongkar'],
                        'url' => '/layanan/wastafel-mampet',
                    ],
                    [
                        'icon' => '🚽',
                        'title' => 'Kloset & Toilet Meluap',
                        'badge' => '🛡️ Garansi 30 Hari',
                        'desc' => 'Pelancaran WC tersumbat benda asing, tisu padat, atau leher angsa mampet tanpa membongkar keramik.',
                        'tags' => ['Pneumatic Push', 'Rotary Cable', 'Higienis'],
                        'url' => '/layanan/wc-toilet-mampet',
                    ],
                    [
                        'icon' => '🚿',
                        'title' => 'Floor Drain Kamar Mandi',
                        'badge' => '💧 Bebas Genangan',
                        'desc' => 'Pembersihan tumpukan rambut, sisa sabun membeku, & pasir yang membuat air kamar mandi meluap.',
                        'tags' => ['Rotary Spiral', 'Pipa PVC Aman', 'Garansi'],
                        'url' => '/layanan/kamar-mandi-mampet',
                    ],
                    [
                        'icon' => '🌊',
                        'title' => 'Hydro-Jetting Tekanan Tinggi',
                        'badge' => '🔥 Solusi Resto & B2B',
                        'desc' => 'Semprotan air bertekanan hingga 300 Bar untuk menghancurkan kerak lemak keras pada pipa diameter besar.',
                        'tags' => ['Tekanan 300 Bar', 'Pipa Resto & Pabrik', 'SLA Fast'],
                        'url' => '/layanan-b2b-komersial',
                    ],
                    [
                        'icon' => '🏬',
                        'title' => 'Got Utama & Bak Kontrol',
                        'badge' => '🧱 Pengurasan Lumpur',
                        'desc' => 'Pembersihan got luar, bak penampungan, & pipa pembuangan utama perumahan agar air lancar saat hujan.',
                        'tags' => ['Kapasitas Besar', 'Got Kompleks', 'Bebas Banjir'],
                        'url' => '/layanan/got-saluran-pembuangan',
                    ],
                    [
                        'icon' => '🎥',
                        'title' => 'Inspeksi Kamera CCTV Pipa',
                        'badge' => '🔍 Deteksi Titik Presisi',
                        'desc' => 'Audit jaringan pipa vertikal/horisontal menggunakan kamera crawler 30M untuk melacak retakan & lokasi sumbatan.',
                        'tags' => ['CCTV 30 Meter', 'Rekaman Video HD', 'Laporan Teknis'],
                        'url' => '/tentang-kami',
                    ],
                ];
            @endphp

            @foreach($serviceItems as $item)
            <div style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; padding: 1.75rem; box-shadow: 0 4px 20px rgba(0,0,0,0.03); transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; display: flex; flex-direction: column;" class="hover:-translate-y-2 hover:shadow-xl hover:border-emerald-500/40 group">
                
                <div style="display: flex; justify-content: space-between; items-center: center; margin-bottom: 1.25rem;">
                    <div style="width: 54px; height: 54px; border-radius: 16px; background: rgba(16, 185, 129, 0.1); display: flex; items-center: center; justify-content: center; font-size: 1.75rem;" class="group-hover:scale-110 transition-transform">
                        {{ $item['icon'] }}
                    </div>
                    <span style="background: #f1f5f9; color: #0b2b64; font-size: 0.72rem; font-weight: 800; padding: 0.3rem 0.75rem; border-radius: 9999px; height: fit-content;">
                        {{ $item['badge'] }}
                    </span>
                </div>

                <h3 style="font-size: 1.2rem; font-weight: 800; color: #0b2b64; margin-bottom: 0.5rem;" class="group-hover:text-emerald-600 transition-colors">
                    {{ $item['title'] }}
                </h3>

                <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin-bottom: 1.25rem;">
                    {{ $item['desc'] }}
                </p>

                <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1.5rem; margin-top: auto;">
                    @foreach($item['tags'] as $tag)
                        <span style="background: #f8fafc; border: 1px solid #cbd5e1; color: #475569; font-size: 0.72rem; font-weight: 600; padding: 0.2rem 0.55rem; border-radius: 6px;">
                            ✓ {{ $tag }}
                        </span>
                    @endforeach
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid #f1f5f9;">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya membutuhkan jasa pengerjaan untuk: ' . $item['title']) }}" target="_blank" rel="noopener noreferrer" style="color: #10b981; font-weight: 800; font-size: 0.85rem; text-decoration: none; display: inline-flex; items-center: center; gap: 0.4rem;" class="hover:text-emerald-700">
                        <span>Panggil Teknisi untuk Masalah Ini →</span>
                    </a>
                </div>

            </div>
            @endforeach
        </div>

        <div class="text-center" style="margin-top: 3.5rem;">
            <a href="{{ route('layanan') }}" style="background: #0b2b64; color: #ffffff; text-decoration: none; padding: 0.85rem 2rem; border-radius: 12px; font-weight: 800; font-size: 0.95rem; display: inline-flex; items-center: center; gap: 0.5rem; box-shadow: 0 4px 15px rgba(11,43,100,0.25);" class="hover:bg-slate-900 transition-all">
                Lihat Katalog Lengkap &amp; Rincian Harga →
            </a>
        </div>

    </div>
</section>
