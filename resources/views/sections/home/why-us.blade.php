<section class="section relative overflow-hidden text-white" aria-labelledby="why-heading" style="background: linear-gradient(135deg, #051636 0%, #0A2E78 50%, #1a4aa8 100%);">
    
    <!-- Decorative Tech Network Lines / Jaringan Node (z-0) -->
    <div class="pointer-events-none absolute inset-0 z-0 opacity-20" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600" preserveAspectRatio="none" class="absolute left-0 top-0 h-full w-[350px]">
            <defs>
                <linearGradient id="why-us-grad-left" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#1FAF5A" />
                    <stop offset="100%" stop-color="#3b82f6" />
                </linearGradient>
            </defs>
            <g stroke="url(#why-us-grad-left)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M-20,100 H120 V250 H240 V450 H100" stroke-width="2.5" stroke-opacity="0.7" />
                <path d="M-20,180 H80 V320 H180 V500 H50" stroke-width="1.5" stroke-opacity="0.6" class="pipe-flow-dash" />
            </g>
            <g fill="#1FAF5A">
                <circle cx="120" cy="100" r="5" />
                <circle cx="240" cy="250" r="5" />
                <circle cx="180" cy="320" r="5" />
            </g>
        </svg>
    </div>

    <div class="container relative z-10">
        <div class="text-center mb-12">
            <span class="badge bg-white/10 text-white border border-white/20 backdrop-blur-md">Keunggulan Utama Rootera</span>
            <h2 class="section-title text-white mt-3" id="why-heading">
                Profesional, <span class="text-emerald-400">Cepat</span>, & 100% Bergaransi
            </h2>
            <p class="section-sub text-slate-200">
                Solusi pelancar saluran tanpa bongkar dengan teknisi berpengalaman dan jaminan hasil bersih total.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            @php
            $reasons = [
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>','title'=>'Teknisi Bersertifikat','desc'=>'Seluruh tim teknisi terlatih dengan standar sanitasi & pengerjaan efisien.'],
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>','title'=>'Respon Cepat 24 Jam','desc'=>'Siap melayani panggilan darurat saluran mampet 24/7 di seluruh kota jangkauan.'],
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>','title'=>'Garansi Pekerjaan 100%','desc'=>'Jika mampet kembali dalam masa garansi, pengerjaan ulang dilakukan tanpa biaya.'],
                ['icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>','title'=>'Mesin Spiral Non-Bongkar','desc'=>'Menggunakan Rotary Cable & Hydro-jetting bebas asam korosif ramah PVC.'],
            ];
            @endphp
            @foreach($reasons as $i => $r)
            <div class="advantage-card bg-white rounded-2xl p-6 sm:p-8 text-center border border-slate-100 shadow-lg hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-16 h-16 rounded-full bg-emerald-50 text-teal-600 flex items-center justify-center mx-auto mb-6 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300 shadow-md">
                    {!! $r['icon'] !!}
                </div>
                <h3 class="text-slate-900 text-lg font-bold mb-3">{{ $r['title'] }}</h3>
                <p class="text-slate-600 text-sm leading-relaxed">{{ $r['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
