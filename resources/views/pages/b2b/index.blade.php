@extends('layouts.app')

@section('content')
<!-- B2B Master Hero -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #04122C 100%); color: #ffffff; padding: 5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; margin-bottom: 1.5rem;">
            <span>💼 Divisi Commercial &amp; B2B Corporate J&amp;J GROUP</span>
            <span>•</span>
            <span>SLA 24 Jam &amp; Tax Compliance</span>
        </div>

        <h1 style="font-size: clamp(2.2rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.2; margin-bottom: 1.25rem; color: #ffffff;">
            Layanan Plumbing B2B, Komersial &amp; Maintenance Gedung
        </h1>
        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 800px; margin-bottom: 2.25rem; line-height: 1.6;">
            Spesialis penanganan saluran mampet, grease trap, vertical stack riser, &amp; hydro-jetting industri untuk 8 sektor bisnis. Dilengkapi legalitas PT/CV resmi, Faktur Pajak PPN 11%, serta garansi tuntas tanpa merusak bangunan.
        </p>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera B2B Sales (J&J Group), kami ingin mengajukan penawaran / konsultasi maintenance plumbing gedung.') }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2.25rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.25);">
                💬 Konsultasi B2B Sales (WhatsApp 24 Jam)
            </a>
            <a href="#b2b-sectors" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2rem; border-radius: 50px; text-decoration: none;">
                Lihat 8 Sektor Industri ↓
            </a>
        </div>
    </div>
</section>

<!-- 8 Commercial Industry Sectors Grid -->
<section id="b2b-sectors" style="padding: 5rem 1.5rem; background: #F8FAFC;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.88rem; tracking-wider">Cakupan Sektor Industri</span>
            <h2 style="color: #0A2E78; font-size: 2.3rem; font-weight: 800; margin-top: 0.4rem;">Spesialisasi Solusi Plumbing Komersial &amp; Instansi</h2>
            <p style="color: #64748B; font-size: 1rem; max-width: 750px; margin: 0.5rem auto 0;">Setiap sektor industri memiliki tantangan sanitasi berbeda. Pilih sektor bisnis Anda untuk solusi presisi:</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.75rem;">
            @foreach($sectors as $sec)
            <div style="background: #ffffff; border-radius: 20px; border: 1px solid #E2E8F0; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.3s ease;" class="hover:border-[#169F81] hover:shadow-xl">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                        <span style="font-size: 2.8rem;">{{ $sec->icon }}</span>
                        <span style="background: rgba(22, 159, 129, 0.1); color: #169F81; font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.9rem; border-radius: 50px;">
                            SLA: {{ $sec->sla_guarantee ?? 'SLA 24 Jam' }}
                        </span>
                    </div>

                    <h3 style="color: #0A2E78; font-size: 1.35rem; font-weight: 800; margin-bottom: 0.6rem; line-height: 1.3;">
                        <a href="{{ route('b2b.sector', $sec->slug) }}" style="color: inherit; text-decoration: none;">{{ $sec->sector_name }}</a>
                    </h3>
                    <p style="color: #64748B; font-size: 0.93rem; line-height: 1.6; margin-bottom: 1.25rem;">
                        {{ $sec->short_description }}
                    </p>

                    @if(!empty($sec->pain_points))
                    <div style="background: #F1F5F9; border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                        <div style="font-size: 0.8rem; font-weight: 700; color: #475569; uppercase mb-1">Tantangan Umum:</div>
                        <ul style="padding-left: 1.2rem; margin: 0; font-size: 0.86rem; color: #334155; line-height: 1.5;">
                            @foreach(array_slice($sec->pain_points, 0, 2) as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <div style="display: flex; gap: 0.75rem; border-top: 1px solid #F1F5F9; pt-4; padding-top: 1.25rem;">
                    <a href="{{ route('b2b.sector', $sec->slug) }}" style="flex: 1; text-align: center; background: #0A2E78; color: #ffffff; font-weight: 700; font-size: 0.88rem; padding: 0.75rem 1rem; border-radius: 10px; text-decoration: none;">
                        Detail Sektor →
                    </a>
                    <a href="{{ route('b2b.contract', $sec->slug) }}" style="flex: 1; text-align: center; background: #169F81; color: #ffffff; font-weight: 700; font-size: 0.88rem; padding: 0.75rem 1rem; border-radius: 10px; text-decoration: none;">
                        Kontrak B2B
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- B2B Enterprise Real Documentation & APD K3 Showcase -->
<section style="padding: 5rem 1.5rem; background: #061434; color: #ffffff; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="background: rgba(45, 212, 191, 0.15); border: 1px solid rgba(45, 212, 191, 0.3); color: #2dd4bf; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; padding: 0.35rem 1rem; border-radius: 50px; display: inline-block; margin-bottom: 0.75rem;">
                👷 BUKTI PENGERJAAN PROYEK SKALA BESAR &amp; K3
            </span>
            <h2 style="color: #ffffff; font-size: 2.2rem; font-weight: 800; margin-top: 0.4rem;">
                Dokumentasi Proyek Komersial &amp; Instansi Vital
            </h2>
            <p style="color: rgba(255,255,255,0.8); font-size: 1rem; max-width: 750px; margin: 0.5rem auto 0;">
                Aksi nyata tim teknisi profesional Rootera Plumbing berstandar APD K3 lengkap di fasilitas pabrik makanan, stasiun kereta api, kantor BUMN, hingga restoran ternama.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">
            {{-- B2B CARD 1: SUSHI TEI --}}
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); display: flex; flex-direction: column;">
                <div style="position: relative; height: 220px; overflow: hidden; background: #0f172a; cursor: pointer;" onclick="openHomeMediaModal('video', '{{ asset('videos/dokumentasi/video-pelancaran-gutter-lemak-sushi-tei.mp4') }}', 'Pelancaran Saluran Gutter Lemak Restoran Sushi Tei')">
                    <img src="{{ asset('images/dokumentasi/thumb-video-pelancaran-gutter-lemak-sushi-tei.webp') }}" alt="Pelancaran Gutter Restoran Sushi Tei" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center;">
                        <div style="width: 52px; height: 52px; border-radius: 50%; background: #dc2626; color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(220,38,38,0.7);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <span style="position: absolute; top: 0.75rem; left: 0.75rem; background: #dc2626; color: #fff; font-weight: 800; font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        ▶ Video Real
                    </span>
                    <span style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.75); color: #fff; font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 6px;">
                        📍 Restoran Sushi Tei
                    </span>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="color: #fff; font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Pelancaran Gutter Lemak Restoran Sushi Tei
                    </h3>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
                        Video pengerjaan melancarkan pembekuan minyak &amp; lemak pada gutter pembuangan dapur utama outlet Restoran Sushi Tei secara tuntas.
                    </p>
                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.1); color: #2dd4bf; font-size: 0.82rem; font-weight: 700;">
                        🛠️ Peralatan: Mesin Spiral Rotary Ridgid
                    </div>
                </div>
            </div>

            {{-- B2B CARD 2: STASIUN TUGU YOGYAKARTA --}}
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); display: flex; flex-direction: column;">
                <div style="position: relative; height: 220px; overflow: hidden; background: #0f172a; cursor: pointer;" onclick="openHomeMediaModal('video', '{{ asset('videos/dokumentasi/video-pelancaran-saluran-stasiun-tugu-yogyakarta.mp4') }}', 'Pelancaran Saluran Stasiun Tugu Yogyakarta')">
                    <img src="{{ asset('images/dokumentasi/thumb-video-pelancaran-saluran-stasiun-tugu-yogyakarta.webp') }}" alt="Stasiun Tugu Yogyakarta Rootera Plumbing" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center;">
                        <div style="width: 52px; height: 52px; border-radius: 50%; background: #dc2626; color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(220,38,38,0.7);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <span style="position: absolute; top: 0.75rem; left: 0.75rem; background: #2563eb; color: #fff; font-weight: 800; font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        🏛️ Fasilitas Publik
                    </span>
                    <span style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.75); color: #fff; font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 6px;">
                        📍 Stasiun Tugu Yogyakarta
                    </span>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="color: #fff; font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Pelancaran Drainase Stasiun Tugu Yogyakarta
                    </h3>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
                        Video pengerjaan cepat tanggap darurat melancarkan saluran mampet peron penumpang Stasiun Tugu Yogyakarta.
                    </p>
                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.1); color: #2dd4bf; font-size: 0.82rem; font-weight: 700;">
                        🛠️ Peralatan: Mesin Ridgid Heavy Duty Industrial
                    </div>
                </div>
            </div>

            {{-- B2B CARD 3: MALL BANJARMASIN (EKSPANSI LUAR KOTA) --}}
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); display: flex; flex-direction: column;">
                <div style="position: relative; height: 220px; overflow: hidden; background: #0f172a;">
                    <img src="{{ asset('images/dokumentasi/pelancaran-saluran-mampet-mall-banjarmasin-1.webp') }}" alt="Proyek Pelancaran Saluran Mall Banjarmasin" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                    <span style="position: absolute; top: 0.75rem; left: 0.75rem; background: #eab308; color: #000; font-weight: 800; font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        ✈️ Ekspansi Nasional
                    </span>
                    <span style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.75); color: #fff; font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 6px;">
                        📍 Mall Banjarmasin, Kalsel
                    </span>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="color: #fff; font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Proyek Drainase Mall Banjarmasin
                    </h3>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
                        Bukti jangkauan ekspansi tim teknisi spesialis Rootera Plumbing menangani proyek komersial skala besar pusat perbelanjaan di Banjarmasin.
                    </p>
                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.1); color: #2dd4bf; font-size: 0.82rem; font-weight: 700;">
                        🛠️ Peralatan: Ridgid Rotary &amp; Cable Auger Heavy
                    </div>
                </div>
            </div>

            {{-- B2B CARD 4: PABRIK MAKANAN APD --}}
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); display: flex; flex-direction: column;">
                <div style="position: relative; height: 220px; overflow: hidden; background: #0f172a;">
                    <img src="{{ asset('images/dokumentasi/teknisi-apd-lengkap-sink-pabrik-makanan.webp') }}" alt="Teknisi APD K3 Lengkap Rootera Penanganan Sink Pabrik Makanan" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                    <span style="position: absolute; top: 0.75rem; left: 0.75rem; background: #10b981; color: #fff; font-weight: 800; font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        ✅ Standar APD K3 Steril
                    </span>
                    <span style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.75); color: #fff; font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 6px;">
                        📍 Pabrik Makanan Industri
                    </span>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="color: #fff; font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Penanganan Saluran Sink Pabrik Makanan
                    </h3>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
                        Penggunaan APD steril lengkap memenuhi standar food-safety &amp; GMP saat melancarkan sink dapur produksi pabrik.
                    </p>
                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.1); color: #2dd4bf; font-size: 0.82rem; font-weight: 700;">
                        🛠️ Peralatan: Spiral Steel Rotary Cable &amp; APD Steril
                    </div>
                </div>
            </div>

            {{-- B2B CARD 5: KLOSET PABRIK INDUSTRI JABAR --}}
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); display: flex; flex-direction: column;">
                <div style="position: relative; height: 220px; overflow: hidden; background: #0f172a;">
                    <img src="{{ asset('images/dokumentasi/pelancaran-kloset-mampet-pabrik-industri.webp') }}" alt="Pelancaran Kloset Pabrik Industri" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                    <span style="position: absolute; top: 0.75rem; left: 0.75rem; background: #8b5cf6; color: #fff; font-weight: 800; font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        🏭 Industri &amp; Fabrikasi
                    </span>
                    <span style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.75); color: #fff; font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 6px;">
                        📍 Pabrik Jawa Barat
                    </span>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="color: #fff; font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Pelancaran Kloset Toilet Pabrik Jabar
                    </h3>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
                        Penanganan kloset toilet mess karyawan pabrik industri yang tersumbat parah tanpa merusak sanitari porcelain.
                    </p>
                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.1); color: #2dd4bf; font-size: 0.82rem; font-weight: 700;">
                        🛠️ Peralatan: Mesin Ridgid Spiral K-50
                    </div>
                </div>
            </div>

            {{-- B2B CARD 6: PERTAMINA SUNTER --}}
            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); display: flex; flex-direction: column;">
                <div style="position: relative; height: 220px; overflow: hidden; background: #0f172a;">
                    <img src="{{ asset('images/dokumentasi/pelancar-saluran-pertamina-sunter-jakarta.webp') }}" alt="Pengerjaan Saluran Floor Drain Pertamina Sunter Jakarta" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                    <span style="position: absolute; top: 0.75rem; left: 0.75rem; background: #eab308; color: #000; font-weight: 800; font-size: 0.72rem; padding: 0.25rem 0.65rem; border-radius: 6px; text-transform: uppercase;">
                        🏢 Gedung Kantor BUMN
                    </span>
                    <span style="position: absolute; bottom: 0.75rem; left: 0.75rem; background: rgba(0,0,0,0.75); color: #fff; font-weight: 600; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 6px;">
                        📍 Pertamina Sunter, Jakarta
                    </span>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <h3 style="color: #fff; font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Pekerjaan Floor Drain Gedung Pertamina Sunter
                    </h3>
                    <p style="color: rgba(255,255,255,0.75); font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
                        Inspeksi kamera CCTV &amp; pelancaran pipa floor drain di kompleks kantor Pertamina Sunter tanpa bising.
                    </p>
                    <div style="margin-top: auto; padding-top: 0.85rem; border-top: 1px solid rgba(255,255,255,0.1); color: #2dd4bf; font-size: 0.82rem; font-weight: 700;">
                        🛠️ Peralatan: Kamera CCTV Pipa HD &amp; Ridgid Rotary
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Corporate B2B Advantages Section -->
<section style="padding: 5rem 1.5rem; background: #ffffff; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.88rem;">Standar Layanan Perusahaan</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.4rem;">Mengapa Perusahaan Memilih Rootera Plumbing (J&amp;J Group)?</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem;">
            <div style="background: #F8FAFC; border-radius: 16px; padding: 2rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">📄</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Legalitas PT/CV &amp; Faktur Pajak</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Dokumen legalitas sah (NIB, PKP, SKT). Pembayaran dapat menerbitkan Invoice B2B + Faktur Pajak PPN 11% resmi holding J&amp;J Group.</p>
            </div>
            <div style="background: #F8FAFC; border-radius: 16px; padding: 2rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">⚡</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">SLA Emergency Response</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Garansi respon penanganan darurat 24 jam nonstop dengan komitmen teknisi tiba di lokasi dalam 30-45 menit.</p>
            </div>
            <div style="background: #F8FAFC; border-radius: 16px; padding: 2rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">🛠️</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Metode Hydro-Jetting &amp; CCTV</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Peralatan Hydro-Jetting tekanan tinggi (150-300 Bar) &amp; Kamera CCTV pipe inspection pembukti visual pengerjaan tuntas 100%.</p>
            </div>
            <div style="background: #F8FAFC; border-radius: 16px; padding: 2rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">🛡️</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Garansi Resmi &amp; SOP K3</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Seluruh teknisi terverifikasi, menggunakan APD K3 lengkap, menerapkan SOP kebersihan food-grade, &amp; garansi pengerjaan ulang gratis.</p>
            </div>
        </div>
    </div>
</section>

<!-- B2B CTA Emergency Banner -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4.5rem 1.5rem; text-align: center;">
    <div style="max-width: 850px; margin: 0 auto;">
        <h2 style="font-size: 2.3rem; font-weight: 800; margin-bottom: 1rem;">Butuh Penawaran Harga atau Kontrak Routine B2B?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2.25rem; line-height: 1.6;">Tim Sales B2B Corporate Rootera Plumbing (J&amp;J Group) siap memberikan konsultasi gratis, kunjungan audit lokasi, &amp; draft Perjanjian Kerja Sama (PKS).</p>
        
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Sales B2B Rootera (J&J Group), kami ingin meminta draft penawaran kontrak maintenance plumbing perusahaan.') }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-size: 1.15rem; font-weight: 700; padding: 1.1rem 2.5rem; border-radius: 50px; text-decoration: none; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);">
            Hubungi Corporate Sales B2B (WhatsApp 24 Jam)
        </a>
    </div>
</section>
@endsection
