<section style="position: relative; overflow: hidden; background: linear-gradient(135deg, #0b132b 0%, #0f172a 50%, #061434 100%); padding: 5.5rem 0;" aria-labelledby="why-heading">
    
    {{-- Ambient Light Orb --}}
    <div style="position: absolute; top: -100px; right: -100px; width: 600px; height: 600px; background: radial-gradient(circle, rgba(16, 185, 129, 0.14) 0%, transparent 70%); pointer-events: none;"></div>

    <div class="container relative z-10">
        
        {{-- SECTION HEADER --}}
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span style="background: rgba(16, 185, 129, 0.12); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); font-size: 0.8rem; font-weight: 800; padding: 0.35rem 1rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; backdrop-filter: blur(8px);">
                🏆 KEUNGGULAN TEKNOLOGI &amp; PROTOKOL KERJA
            </span>
            <h2 id="why-heading" style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #ffffff; margin-top: 1rem; margin-bottom: 0.75rem;">
                Keunggulan Jasa Saluran Pipa Mampet <span style="background: linear-gradient(90deg, #10b981, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Rootera Plumbing</span>
            </h2>
            <p style="color: rgba(255, 255, 255, 0.82); font-size: 1.05rem; line-height: 1.6; margin: 0;">
                Kami menerapkan standar kerja kelas profesional menggunakan peralatan canggih tanpa membongkar keramik lantai atau merusak struktur bangunan Anda.
            </p>
        </div>

        {{-- 4 PILLARS GRID / MOBILE CAROUSEL --}}
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 no-scrollbar md:grid md:grid-cols-2 lg:grid-cols-4 md:pb-0">
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
            <div style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 20px; padding: 2rem 1.5rem; backdrop-filter: blur(12px); box-shadow: 0 15px 35px rgba(0,0,0,0.2); transition: transform 0.3s ease, border-color 0.3s ease;" class="w-[280px] sm:w-[320px] md:w-auto shrink-0 snap-start hover:-translate-y-2 hover:border-emerald-400/50 group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <div style="font-size: 2rem;">{{ $r['icon'] }}</div>
                    <span style="font-size: 1.5rem; font-weight: 800; color: rgba(255, 255, 255, 0.2); font-family: monospace;">{{ $r['number'] }}</span>
                </div>
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #ffffff; margin-bottom: 0.6rem;" class="group-hover:text-emerald-300 transition-colors">
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
