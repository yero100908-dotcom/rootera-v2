@extends('layouts.app')
@section('content')

{{-- ===== HERO ===== --}}
<section class="hero" aria-label="Hero section">
    <div class="hero-bg-shape" aria-hidden="true"></div>
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
        <div class="hero-visual" aria-hidden="true">
            <div class="hero-card">
                <div class="hero-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <h3 style="color:#fff;margin-bottom:.5rem">Teknologi Modern</h3>
                <p style="color:rgba(255,255,255,.8);font-size:.9rem">Hydrojet, CCTV Pipe Inspection, Electric Snake — tanpa bongkar dinding!</p>
                <div style="margin-top:1rem;display:flex;gap:.5rem;flex-wrap:wrap">
                    <span style="background:rgba(22,159,129,.3);color:#6ee7cc;padding:.25rem .7rem;border-radius:50px;font-size:.78rem;font-weight:600">✓ Non-Destruktif</span>
                    <span style="background:rgba(30,115,216,.3);color:#93c5fd;padding:.25rem .7rem;border-radius:50px;font-size:.78rem;font-weight:600">✓ Bergaransi</span>
                </div>
            </div>
            <div class="hero-floating hero-floating-1">
                <div class="dot"></div>
                <span>Respon Cepat 24 Jam</span>
            </div>
            <div class="hero-floating hero-floating-2">
                <div class="dot"></div>
                <span>⭐ 4.9/5 Rating Pelanggan</span>
            </div>
        </div>
    </div>
    <div class="hero-wave" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

{{-- ===== LAYANAN ===== --}}
@include('sections.home.services', ['serviceCategories' => $serviceCategories])

{{-- ===== MENGAPA ROOTERA ===== --}}
@include('sections.home.why-us')

{{-- ===== AREA LAYANAN ===== --}}
@include('sections.home.areas', ['serviceAreas' => $serviceAreas])

{{-- ===== ARTIKEL TERBARU ===== --}}
@include('sections.home.latest-articles', ['latestArticles' => $latestArticles])

{{-- ===== FAQ ===== --}}
@include('sections.home.faq')

{{-- ===== CTA BANNER ===== --}}
@include('sections.home.cta-banner')

@endsection
