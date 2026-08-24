<section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #051636 0%, #0A2E78 50%, #0b2b64 100%); padding: 5.5rem 0;" aria-labelledby="why-heading">
    
    {{-- Ambient Light Orb --}}
    <div style="position: absolute; top: -100px; right: -100px; width: 600px; height: 600px; background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, transparent 70%); pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 10;">
        
        {{-- SECTION HEADER --}}
        <div class="text-center" style="max-width: 750px; margin: 0 auto 4rem;">
            <span style="background: rgba(255, 255, 255, 0.12); color: #2dd4bf; border: 1px solid rgba(45, 212, 191, 0.3); font-size: 0.8rem; font-weight: 800; padding: 0.35rem 1rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; backdrop-filter: blur(8px);">
                🏆 KEUNGGULAN &amp; PROTOKOL KERJA
            </span>
            <h2 id="why-heading" style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #ffffff; margin-top: 1rem; margin-bottom: 0.75rem;">
                Mengapa Memilih <span style="background: linear-gradient(90deg, #2dd4bf, #6ee7cc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Rootera Plumbing?</span>
            </h2>
            <p style="color: rgba(255, 255, 255, 0.82); font-size: 1.05rem; line-height: 1.6; margin: 0;">
                Kami menerapkan standar kerja kelas industri dengan peralatan mekanis modern tanpa membongkar lantai atau merusak struktur bangunan Anda.
            </p>
        </div>

        {{-- 4 PILLARS GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $reasons = [
                [
                    'number' => '01',
                    'icon'   => '🌀',
                    'title'  => 'Rotary Spiral & Hydro-Jetting',
                    'desc'   => 'Metode pembersihan mekanis berkecepatan tinggi & semprotan air 300 Bar. 100% tanpa membongkar ubin atau keramik rumah.',
                ],
                [
                    'number' => '02',
                    'icon'   => '📹',
                    'title'  => 'Inspeksi Kamera CCTV 30M',
                    'desc'   => 'Deteksi presisi lokasi kerak & keretakan pipa secara visual melalui layar HD sebelum & sesudah pengerjaan.',
                ],
                [
                    'number' => '03',
                    'icon'   => '🛡️',
                    'title'  => 'Garansi Resmi 30 Hari',
                    'desc'   => 'Jaminan garansi penuh tanpa syarat rumit. Jika pipa mampet kembali dalam masa garansi, teknisi datang gratis.',
                ],
                [
                    'number' => '04',
                    'icon'   => '✨',
                    'title'  => 'Standar Sanitasi & Bebas Bau',
                    'desc'   => 'Teknisi bekerja bersih memakai cover sepatu, sarung tangan steril K3, & meninggalkan area lokasi selalu bersih pasca kerja.',
                ],
            ];
            @endphp

            @foreach($reasons as $r)
            <div style="background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 20px; padding: 2rem 1.5rem; backdrop-filter: blur(12px); box-shadow: 0 15px 35px rgba(0,0,0,0.2); transition: transform 0.3s ease, border-color 0.3s ease;" class="hover:-translate-y-2 hover:border-teal-400/50 group">
                <div style="display: flex; justify-content: space-between; items-center: center; margin-bottom: 1.25rem;">
                    <div style="font-size: 2rem;">{{ $r['icon'] }}</div>
                    <span style="font-size: 1.5rem; font-weight: 800; color: rgba(255, 255, 255, 0.2); font-family: monospace;">{{ $r['number'] }}</span>
                </div>
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #ffffff; margin-bottom: 0.6rem;" class="group-hover:text-teal-300 transition-colors">
                    {{ $r['title'] }}
                </h3>
                <p style="color: rgba(255, 255, 255, 0.75); font-size: 0.88rem; line-height: 1.6; margin: 0;">
                    {{ $r['desc'] }}
                </p>
            </div>
            @endforeach
        </div>

    </div>
</section>
