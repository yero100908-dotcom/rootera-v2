<section class="section" aria-labelledby="why-heading" style="position: relative; overflow: hidden; background: linear-gradient(rgba(241, 245, 249, 0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(241, 245, 249, 0.08) 1px, transparent 1px), linear-gradient(135deg, #051636 0%, #0A2E78 50%, #1a4aa8 100%); background-size: 20px 20px, 20px 20px, auto;">
    
    <!-- Decorative Tech Network Lines / Jaringan Node (z-0) -->
    <div class="pointer-events-none" style="position: absolute; inset: 0; z-index: 0; pointer-events: none;">
        <!-- Left Tech Network Lines -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600" preserveAspectRatio="none" style="position: absolute; left: 0; top: 0; height: 100%; width: 350px; pointer-events: none; opacity: 0.22;">
            <defs>
                <linearGradient id="why-us-grad-left" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#38bdf8" />
                    <stop offset="100%" stop-color="#0ea5e9" />
                </linearGradient>
            </defs>
            <g stroke="url(#why-us-grad-left)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <!-- Primary network lines -->
                <path d="M-20,100 H120 V250 H240 V450 H100" stroke-width="2.5" stroke-opacity="0.7" />
                <path d="M-20,100 H120 V250 H240 V450 H100" stroke-width="6" stroke-opacity="0.15" />
                
                <!-- Detailed flowing lines with animations -->
                <path d="M-20,180 H80 V320 H180 V500 H50" stroke-width="1.5" stroke-opacity="0.6" class="pipe-flow-dash" />
                <path d="M-20,240 H150 V150 H280 V380 H140" stroke-width="1.2" stroke-opacity="0.4" class="pipe-flow-dash-reverse" />
            </g>
            <!-- Connection nodes -->
            <g fill="#38bdf8" opacity="0.8">
                <circle cx="120" cy="100" r="4.5" />
                <circle cx="120" cy="250" r="4.5" />
                <circle cx="240" cy="250" r="4.5" />
                <circle cx="240" cy="450" r="5" />
                <circle cx="80" cy="180" r="4" />
                <circle cx="180" cy="320" r="4" />
                
                <!-- Glowing Pulse Nodes -->
                <circle cx="280" cy="150" r="5" fill="#38bdf8" />
                <circle cx="280" cy="150" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 280px 150px;" />
                
                <circle cx="140" cy="380" r="5" fill="#38bdf8" />
                <circle cx="140" cy="380" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 140px 380px;" />
            </g>
        </svg>

        <!-- Right Tech Network Lines -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600" preserveAspectRatio="none" style="position: absolute; right: 0; top: 0; height: 100%; width: 350px; pointer-events: none; opacity: 0.22;">
            <defs>
                <linearGradient id="why-us-grad-right" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#38bdf8" />
                    <stop offset="100%" stop-color="#0ea5e9" />
                </linearGradient>
            </defs>
            <g stroke="url(#why-us-grad-right)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <!-- Primary network lines -->
                <path d="M420,150 H280 V300 H160 V100 H40" stroke-width="2.5" stroke-opacity="0.7" />
                <path d="M420,150 H280 V300 H160 V100 H40" stroke-width="6" stroke-opacity="0.15" />
                
                <!-- Detailed flowing lines with animations -->
                <path d="M420,220 H320 V400 H220 V250 H300" stroke-width="1.5" stroke-opacity="0.6" class="pipe-flow-dash" />
                <path d="M420,80 H200 V200 H90 V380 H180" stroke-width="1.2" stroke-opacity="0.4" class="pipe-flow-dash-reverse" />
            </g>
            <!-- Connection nodes -->
            <g fill="#38bdf8" opacity="0.8">
                <circle cx="280" cy="150" r="4.5" />
                <circle cx="160" cy="300" r="4.5" />
                <circle cx="160" cy="100" r="4.5" />
                <circle cx="40" cy="100" r="5" />
                <circle cx="320" cy="220" r="4" />
                <circle cx="220" cy="400" r="4" />
                
                <!-- Glowing Pulse Nodes -->
                <circle cx="90" cy="200" r="5" fill="#38bdf8" />
                <circle cx="90" cy="200" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 90px 200px;" />
                
                <circle cx="180" cy="380" r="5" fill="#38bdf8" />
                <circle cx="180" cy="380" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 180px 380px;" />
            </g>
        </svg>
    </div>

    <div class="container" style="position: relative; z-index: 10;">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #fff; border: 1px solid rgba(255, 255, 255, 0.25); backdrop-filter: blur(8px)">Mengapa Rooterin?</span>
            <h2 class="section-title" id="why-heading" style="margin-top:.75rem; color: #ffffff;">
                Profesional, <span style="color: var(--green-light);">Cepat</span>, Bergaransi
            </h2>
            <p class="section-sub" style="color: rgba(255, 255, 255, 0.85);">Kami tidak hanya memperbaiki pipa — kami memastikan Anda tenang dengan layanan berkualitas dan garansi kerja.</p>
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
            <div class="advantage-card fade-in" style="animation-delay:{{ $i * 0.1 }}s; background: #ffffff;">
                <div class="advantage-icon">{!! $r['icon'] !!}</div>
                <h3>{{ $r['title'] }}</h3>
                <p>{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
