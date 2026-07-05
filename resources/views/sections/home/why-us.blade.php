<section class="section" aria-labelledby="why-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-blue">Mengapa ROOTERA?</span>
            <h2 class="section-title" id="why-heading" style="margin-top:.75rem">
                Profesional, <span>Cepat</span>, Bergaransi
            </h2>
            <p class="section-sub">Kami tidak hanya memperbaiki pipa — kami memastikan Anda tenang dengan layanan berkualitas dan garansi kerja.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.5rem">
            @php
            $reasons = [
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>','title'=>'Teknisi Bersertifikat','desc'=>'Seluruh teknisi kami terlatih dengan standar industri dan berpengalaman dalam berbagai jenis instalasi pipa.'],
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>','title'=>'Respon 24 Jam','desc'=>'Tim kami siap siaga 24 jam sehari, 7 hari seminggu. Darurat saluran mampet bisa langsung ditangani.'],
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>','title'=>'Garansi Pekerjaan','desc'=>'Setiap pekerjaan dilengkapi garansi layanan. Jika masalah muncul kembali, kami kembali tanpa biaya tambahan.'],
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>','title'=>'Peralatan Modern','desc'=>'Menggunakan Hydrojet, CCTV inspection, dan Electric Snake — metode mekanis non-destruktif terkini.'],
            ];
            @endphp
            @foreach($reasons as $i => $r)
            <div class="advantage-card fade-in" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="advantage-icon">{!! $r['icon'] !!}</div>
                <h3>{{ $r['title'] }}</h3>
                <p>{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
