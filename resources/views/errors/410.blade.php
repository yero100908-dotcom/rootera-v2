@extends('layouts.app')

@section('title', $title ?? 'Halaman Tidak Tersedia (410 Gone) | Rootera Plumbing')
@section('meta_description', 'Halaman atau layanan ini telah dinonaktifkan secara permanen. Silakan manfaatkan layanan utama pelancaran pipa mampet Rootera Plumbing.')

@section('content')
<meta name="robots" content="noindex, nofollow">

<section class="min-h-[75vh] flex items-center justify-center bg-slate-900 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    {{-- Ambient Radial Glow Background --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/10 blur-[120px] rounded-full pointer-events-none z-0"></div>

    <div class="max-w-2xl mx-auto text-center relative z-10">
        
        {{-- Status Code Badge --}}
        <div class="inline-flex items-center gap-2 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs font-extrabold uppercase tracking-widest px-4 py-1.5 rounded-full mb-6 backdrop-blur-md shadow-inner">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            HTTP STATUS 410 — GONE / PERMANENTLY REMOVED
        </div>

        {{-- Large Visual Icon --}}
        <div class="text-6xl sm:text-7xl mb-4">
            🏛️
        </div>

        {{-- Main Headline --}}
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight mb-4 font-['Plus_Jakarta_Sans',sans-serif] tracking-tight">
            {{ $title ?? 'Halaman / Layanan Ini Telah Dinonaktifkan Permanen' }}
        </h1>

        {{-- Explanation Message --}}
        <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-8 max-w-xl mx-auto">
            {{ $message ?? 'Halaman wilayah atau jenis layanan ini telah dihentikan secara permanen dari operasional Rootera Plumbing. Layanan aktif kami saat ini berfokus 100% pada pelancaran pipa & saluran mampet tanpa bongkar di area Jabodetabek, Semarang, dan Bandar Lampung.' }}
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
            <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-all hover:scale-105">
                <span>🏠 Kembali ke Beranda</span>
            </a>
            <a href="{{ route('area-layanan') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 font-extrabold text-xs sm:text-sm rounded-full transition-all hover:scale-105">
                <span>📍 Lihat Area Layanan Aktif</span>
            </a>
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin bertanya mengenai layanan saluran pipa mampet aktif.') }}" target="_blank" rel="noopener" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-[#25D366] hover:bg-[#1EBE5A] text-white font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-all hover:scale-105">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
                <span>Konsultasi WA 24 Jam</span>
            </a>
        </div>

    </div>
</section>
@endsection
