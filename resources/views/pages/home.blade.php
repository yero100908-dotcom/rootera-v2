@extends('layouts.app')
@section('content')

{{-- ===== HERO ===== --}}
<section class="hero" aria-label="Hero section">
    <div class="hero-bg-shape" aria-hidden="true">
        <!-- Geometric Pipe Flow Pattern -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 800" preserveAspectRatio="none" style="position:absolute; inset:0; width:100%; height:100%; pointer-events:none; opacity:0.18;">
            <defs>
                <linearGradient id="hero-pipe-grad-1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#6ee7cc" />
                    <stop offset="100%" stop-color="#3b82f6" />
                </linearGradient>
                <linearGradient id="hero-pipe-grad-2" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#3b82f6" />
                    <stop offset="100%" stop-color="#169F81" />
                </linearGradient>
            </defs>
            
            <!-- Left Piping System -->
            <g stroke="url(#hero-pipe-grad-1)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <!-- Primary pipe -->
                <path d="M-20,120 H180 V320 H340" stroke-width="4" />
                <path d="M-20,120 H180 V320 H340" stroke-width="8" stroke-opacity="0.15" />
                
                <!-- Secondary branches -->
                <path d="M100,120 V220 H260 V400 H140" stroke-width="2" class="pipe-flow-dash" />
                <path d="M180,260 H60 V440 H200" stroke-width="1.5" />
                
                <!-- Thin detailed flowing lines -->
                <path d="M-20,150 H140 V290 H300 V480 H180" stroke-width="1" stroke-opacity="0.5" class="pipe-flow-dash-reverse" />
            </g>
            
            <!-- Left Connection Nodes -->
            <g fill="#6ee7cc">
                <circle cx="180" cy="120" r="5" />
                <circle cx="180" cy="320" r="5" />
                <circle cx="100" cy="120" r="4" />
                <circle cx="260" cy="220" r="4" />
                <circle cx="260" cy="400" r="4" />
                <circle cx="60" cy="260" r="4" />
                <!-- Pressure indicators (pulse circle) -->
                <circle cx="340" cy="320" r="6" fill="#3b82f6" />
                <circle cx="340" cy="320" r="14" stroke="#3b82f6" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 340px 320px;" />
            </g>
            
            <!-- Right Piping System (behind visual card) -->
            <g stroke="url(#hero-pipe-grad-2)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <!-- Primary pipe -->
                <path d="M1460,180 H1240 V360 H1080 V500" stroke-width="4.5" />
                <path d="M1460,180 H1240 V360 H1080 V500" stroke-width="9" stroke-opacity="0.15" />
                
                <!-- Secondary branches -->
                <path d="M1350,180 V280 H1180 V420 H1300" stroke-width="2" class="pipe-flow-dash" />
                <path d="M1240,300 H1380 V460 H1200" stroke-width="1.5" />
                <path d="M1460,220 H1290 V330 H1120 V480 H1050" stroke-width="1" stroke-opacity="0.5" class="pipe-flow-dash-reverse" />
            </g>
            
            <!-- Right Connection Nodes -->
            <g fill="#3b82f6">
                <circle cx="1240" cy="180" r="5" fill="#169F81" />
                <circle cx="1240" cy="360" r="5" fill="#169F81" />
                <circle cx="1350" cy="180" r="4" />
                <circle cx="1180" cy="280" r="4" />
                <circle cx="1180" cy="420" r="4" />
                <circle cx="1380" cy="300" r="4" fill="#169F81" />
                <!-- Pressure indicators -->
                <circle cx="1080" cy="500" r="6" fill="#169F81" />
                <circle cx="1080" cy="500" r="14" stroke="#169F81" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 1080px 500px;" />
            </g>
        </svg>
    </div>
    <div class="hero-container">
        <div class="hero-content">
            <div class="hero-badge fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                Layanan Terpercaya di Indonesia
            </div>
            <h1 class="hero-title">
                Saluran Mampet?<br>
                Kami <span class="highlight">Atasi Tuntas</span><br>
                Tanpa Bongkar!
            </h1>
            <p class="hero-desc">ROOTERA hadir dengan teknologi modern untuk membersihkan pipa dan saluran tersumbat secara profesional, cepat, dan bergaransi — tanpa merusak struktur bangunan Anda.</p>
            <div class="hero-actions">
                <a href="https://wa.me/6281385404000?text=Halo%20ROOTERA%2C%20saya%20butuh%20bantuan%20saluran%20mampet." class="btn btn-primary" target="_blank" rel="noopener">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    Chat WhatsApp
                </a>
                <a href="{{ route('layanan') }}" class="btn btn-white">Lihat Layanan</a>
            </div>
            
        </div>
        <div class="hero-visual" aria-hidden="true">
            <img src="{{ asset('images/JnJ.jpeg') }}" alt="Pengerjaan ROOTERA" style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); object-fit: cover; display: block; border: 4px solid rgba(255,255,255,0.1);" />
            <div class="hero-floating hero-floating-1">
                <div class="dot"></div>
                <span>Respon Cepat 24 Jam</span>
            </div>
            <div class="hero-floating hero-floating-2">
                <div class="dot"></div>
                <span>⭐ 4.9/5 Rating Pelanggan</span>
            </div>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-num" data-counter data-target="2300" data-suffix="+">2300+</div>
                <div class="stat-label">Proyek Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-num" data-counter data-target="6" data-suffix=" Kota">6 Kota</div>
                <div class="stat-label">Area Jangkauan</div>
            </div>
            <div class="stat-item">
                <div class="stat-num" data-counter data-target="100" data-suffix="%">100%</div>
                <div class="stat-label">Bergaransi</div>
            </div>
        </div>
    </div>
    <div class="hero-wave" aria-hidden="true" style="height:100px;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <!-- Layer 4 (Backmost - 15% Opacity) -->
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.15"></path>
            <!-- Layer 3 (Behind Middle - 25% Opacity) -->
            <path d="M0,80 C360,10 720,110 1080,30 C1260,20 1360,70 1440,80 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.25"></path>
            <!-- Layer 2 (Middle - 40% Opacity) -->
            <path d="M0,50 C240,90 480,20 840,90 C1100,130 1280,50 1440,70 L1440,120 L0,120 Z" fill="#ffffff" opacity="0.40"></path>
            <!-- Layer 1 (Front - Full Opacity) -->
            <path d="M0,90 C360,130 720,40 1080,110 C1260,130 1360,100 1440,90 L1440,120 L0,120 Z" fill="#f8fafc"></path>
        </svg>
    </div>
</section>

{{-- ===== LAYANAN ===== --}}
@include('sections.home.services', ['serviceCategories' => $serviceCategories])

{{-- ===== MENGAPA ROOTERA ===== --}}
@include('sections.home.why-us')

{{-- ===== AREA LAYANAN ===== --}}
@include('sections.home.areas', ['serviceAreas' => $serviceAreas])

{{-- ===== MITRA KAMI ===== --}}
@include('sections.home.partners', ['partners' => $partners])

{{-- ===== ARTIKEL TERBARU ===== --}}
@include('sections.home.latest-articles', ['latestArticles' => $latestArticles])

{{-- ===== FAQ ===== --}}
@include('sections.home.faq')

{{-- ===== CTA BANNER ===== --}}
@include('sections.home.cta-banner')

@endsection
