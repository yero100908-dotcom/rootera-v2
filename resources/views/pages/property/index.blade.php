@extends('layouts.app')

@section('content')
<!-- Property Master Hero Header -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #06183B 100%); color: #ffffff; padding: 5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <span style="background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.25rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; display: inline-block; margin-bottom: 1.25rem;">
            🏠 Panggilan Teknisi Pipa Mampet Door-to-Door &amp; Tempat Usaha
        </span>
        <h1 style="font-size: clamp(2.2rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.2; margin-bottom: 1.25rem; color: #ffffff;">
            Jasa Pelancaran Saluran Mampet Berdasarkan Tipe Properti
        </h1>
        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 820px; margin: 0 auto 2.25rem; line-height: 1.6;">
            Pilih kategori bangunan atau tempat tinggal Anda untuk penanganan presisi 1-2 jam selesai, 100% bebas bongkar ubin/dinding, garansi 30 hari, &amp; respon kilat 24 Jam nonstop.
        </p>

        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saluran air di lokasi tempat saya mampet dan butuh panggil teknisi sekarang.') }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-weight: 700; font-size: 1.1rem; padding: 0.95rem 2.5rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.25);">
            ⚡ Panggil Teknisi Sekarang (WhatsApp 24 Jam)
        </a>
    </div>
</section>

<!-- 8 Property Categories Public Grid (MediaService WebP Integration) -->
<?php
  $mediaService = app(\App\Services\MediaService::class);
?>
<section style="padding: 5rem 1.5rem; background: #F8FAFC;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="color: #169F81; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">🏢 Kategori Bangunan</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.3rem;">Solusi Pipa Tersumbat Spesifik Properti Anda</h2>
            <p style="color: #64748B; font-size: 0.95rem; max-width: 700px; margin: 0.4rem auto 0;">Setiap jenis properti ditangani dengan peralatan standar industri yang disesuaikan.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">
            @foreach($properties as $pIdx => $prop)
            <?php
                $propWebpImg = $mediaService->getPropertyImage($prop->slug, $pIdx);
            ?>
            <div style="background: #ffffff; border-radius: 20px; border: 1px solid #E2E8F0; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.3s ease;" class="hover:border-emerald-500 hover:shadow-xl group">
                <div>
                    <!-- Visual WebP Property Image Header -->
                    <div style="position: relative; height: 180px; background: #0B192C; overflow: hidden;">
                        <img src="{{ $propWebpImg }}" alt="Jasa Saluran Pipa Mampet {{ $prop->name }} - Rootera Plumbing" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy" decoding="async">
                        
                        <span style="position: absolute; top: 12px; right: 12px; background: rgba(11, 25, 44, 0.85); color: #34D399; border: 1px solid rgba(52, 211, 153, 0.4); font-size: 0.75rem; font-weight: 800; padding: 0.3rem 0.75rem; border-radius: 50px; backdrop-filter: blur(4px);">
                            ⏱️ Respon 30-90 Menit
                        </span>

                        <span style="position: absolute; bottom: 12px; left: 14px; font-size: 1.8rem; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
                            {{ $prop->icon }}
                        </span>
                    </div>

                    <div style="padding: 1.5rem 1.5rem 1rem;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="background: #F0FDF4; color: #169F81; font-size: 0.78rem; font-weight: 800; padding: 0.25rem 0.7rem; border-radius: 50px;">
                                {{ $prop->estimated_time ?? '1-2 Jam Selesai' }}
                            </span>
                            <div style="color: #0A2E78; font-weight: 800; font-size: 0.92rem;">
                                Mulai {{ $prop->price_starting_from }}
                            </div>
                        </div>

                        <h3 style="color: #0A2E78; font-size: 1.25rem; font-weight: 800; margin-bottom: 0.5rem; line-height: 1.3;" class="group-hover:text-emerald-600 transition">
                            <a href="{{ route('property.show', $prop->slug) }}" style="color: inherit; text-decoration: none;">{{ $prop->name }}</a>
                        </h3>
                        <p style="color: #64748B; font-size: 0.9rem; line-height: 1.5; margin-bottom: 1.25rem;">
                            {{ $prop->hero_headline }}
                        </p>

                        @if(!empty($prop->common_issues))
                        <div style="background: #F8FAFC; border-radius: 12px; padding: 0.9rem; margin-bottom: 1.25rem; border: 1px solid #F1F5F9;">
                            <div style="font-size: 0.78rem; font-weight: 700; color: #475569; margin-bottom: 0.4rem;">Paling Sering Terjadi:</div>
                            <ul style="padding-left: 1.1rem; margin: 0; font-size: 0.85rem; color: #334155; line-height: 1.5;">
                                @foreach(array_slice($prop->common_issues, 0, 2) as $issue)
                                    <li>{{ $issue }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <div style="padding: 0 1.5rem 1.5rem;">
                    <a href="{{ route('property.show', $prop->slug) }}" style="text-align: center; background: #0A2E78; color: #ffffff; font-weight: 700; font-size: 0.92rem; padding: 0.85rem 1rem; border-radius: 12px; text-decoration: none; display: block;" class="hover:bg-[#169F81] transition duration-200">
                        Lihat Solusi {{ $prop->name }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Fast 3-Step Booking Flow -->
<section style="padding: 4.5rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1100px; margin: 0 auto; text-align: center;">
        <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Prosedur Mudah &amp; Cepat</span>
        <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin: 0.3rem 0 3rem;">3 Langkah Praktis Panggil Teknisi Rootera</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem;">
            <div style="background: #F8FAFC; border-radius: 20px; padding: 2.25rem 1.5rem; border: 1px solid #E2E8F0; position: relative;">
                <div style="width: 50px; height: 50px; background: #0A2E78; color: #ffffff; font-weight: 800; font-size: 1.3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">1</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Hubungi CS WhatsApp</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Informasikan lokasi &amp; kendala pipa mampet Anda. CS kami aktif 24 Jam nonstop merespon konsultasi gratis.</p>
            </div>
            <div style="background: #F8FAFC; border-radius: 20px; padding: 2.25rem 1.5rem; border: 1px solid #E2E8F0; position: relative;">
                <div style="width: 50px; height: 50px; background: #169F81; color: #ffffff; font-weight: 800; font-size: 1.3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">2</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Teknisi Meluncur (25-40 Mnt)</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Teknisi terdekat akan meluncur membawa unit alat Spiral Rotary modern tanpa merusak ubin maupun tembok.</p>
            </div>
            <div style="background: #F8FAFC; border-radius: 20px; padding: 2.25rem 1.5rem; border: 1px solid #E2E8F0; position: relative;">
                <div style="width: 50px; height: 50px; background: #25D366; color: #ffffff; font-weight: 800; font-size: 1.3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">3</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Pengerjaan Selesai &amp; Garansi</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Pipa lancar tuntas, area kerja dibersihkan kembali, &amp; Anda menerima nota garansi resmi 30 Hari.</p>
            </div>
        </div>
    </div>
</section>
@endsection
