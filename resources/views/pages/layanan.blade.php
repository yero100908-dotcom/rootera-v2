@extends('layouts.app')
@section('content')

{{-- 1. HERO HEADER SECTION (Dark Theme with Ambient Glow & Metrics) --}}
<div class="relative bg-[#070F1E] text-white py-12 sm:py-20 lg:py-24 overflow-hidden border-b border-slate-800" aria-labelledby="page-title">
    {{-- Ambient Gradient Glow Orbs --}}
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[320px] sm:w-[600px] h-[200px] sm:h-[350px] bg-emerald-500/15 blur-[80px] sm:blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute -bottom-10 right-10 w-[250px] sm:w-[400px] h-[150px] sm:h-[250px] bg-cyan-500/10 blur-[70px] sm:blur-[100px] rounded-full pointer-events-none"></div>

    {{-- Subtle Grid Background Pattern --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(rgba(255, 255, 255, 0.2) 1px, transparent 1px); background-size: 24px 24px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        {{-- Badge Pill --}}
        <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs sm:text-sm font-bold tracking-wide mb-5 backdrop-blur-md shadow-xs">
            <span class="animate-pulse">⭐</span>
            <span>SOLUSI TUNTAS TANPA BONGKAR</span>
            <span class="text-emerald-500/50 hidden sm:inline">•</span>
            <span class="text-slate-300 hidden sm:inline">GARANSI 30 HARI</span>
        </div>

        {{-- Headline --}}
        <h1 id="page-title" class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight sm:leading-tight max-w-4xl mx-auto font-['Plus_Jakarta_Sans',sans-serif]">
            Katalog Layanan Spesialis Pelancaran <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Pipa & Saluran Mampet</span>
        </h1>

        {{-- Subheadline --}}
        <p class="mt-4 text-xs sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed font-normal px-2">
            Penanganan cepat 24 jam untuk wastafel, kamar mandi, kloset, dan saluran limbah gedung. Dikerjakan oleh teknisi ahli menggunakan mesin Ridgid & kamera CCTV presisi tinggi.
        </p>

        {{-- Trust Indicators Bar --}}
        <div class="mt-7 pt-6 sm:pt-8 border-t border-slate-800/80 max-w-3xl mx-auto grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4 text-center">
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-emerald-400 font-extrabold text-base sm:text-xl">100%</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Tanpa Bongkar Keramik</span>
            </div>
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-cyan-400 font-extrabold text-base sm:text-xl">30 Hari</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Garansi Resmi Written</span>
            </div>
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-teal-400 font-extrabold text-base sm:text-xl">&lt; 30 Mnt</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Respon Teknisi Standby</span>
            </div>
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-emerald-400 font-extrabold text-base sm:text-xl">HD 1080p</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Inspeksi Kamera CCTV</span>
            </div>
        </div>
    </div>
</div>

{{-- 2. SECTION KATALOG UTAMA (Pilihan Layanan Spesialis - TEPAT SETELAH HERO) --}}
<section class="py-12 sm:py-20 lg:py-24 bg-white" aria-labelledby="service-cats-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <span class="inline-block px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-2 border border-emerald-100">
                🛠️ Katalog Utama
            </span>
            <h2 id="service-cats-heading" class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Pilihan Layanan <span class="text-emerald-600">Spesialis Plumbing</span>
            </h2>
            <p class="text-xs sm:text-base text-slate-600 mt-2">
                Pilih kategori layanan yang Anda butuhkan untuk hunian rumah, bisnis kuliner, hingga jaringan pipa kompleks gedung tinggi.
            </p>

            {{-- Interactive Category Filter Tabs (Horizontal Scrollable on Mobile) --}}
            <div class="mt-6 sm:mt-8 flex items-center justify-start sm:justify-center gap-2 overflow-x-auto pb-2 px-1 scrollbar-none" id="service-filter-tabs">
                <button type="button" data-filter="all" class="js-filter-btn active whitespace-nowrap shrink-0 bg-slate-900 text-white text-xs sm:text-sm font-bold px-4 sm:px-5 py-2.5 rounded-full transition-all shadow-xs">
                    Semua Layanan
                </button>
                <button type="button" data-filter="residensial" class="js-filter-btn whitespace-nowrap shrink-0 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold px-4 sm:px-5 py-2.5 rounded-full transition-all">
                    🏡 Rumah & Residensial
                </button>
                <button type="button" data-filter="komersial" class="js-filter-btn whitespace-nowrap shrink-0 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold px-4 sm:px-5 py-2.5 rounded-full transition-all">
                    🍽️ Resto & Komersial
                </button>
                <button type="button" data-filter="gedung" class="js-filter-btn whitespace-nowrap shrink-0 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold px-4 sm:px-5 py-2.5 rounded-full transition-all">
                    🏢 Gedung & Industri
                </button>
            </div>
        </div>

        {{-- Cards Grid (1-Col Mobile, 2-Col Tablet, 3-Col Desktop) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8">
            @php
            $icons = [
                '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6"/><path d="M5.2 5.2l4.24 4.24"/><path d="M2 12h6"/><path d="M5.2 18.8l4.24-4.24"/><path d="M12 22v-6"/><path d="M18.8 18.8l-4.24-4.24"/><path d="M22 12h-6"/><path d="M18.8 5.2l-4.24 4.24"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
            ];
            $themeColors = [
                'bg-emerald-50 text-emerald-600 border-emerald-200 group-hover:bg-emerald-600 group-hover:text-white',
                'bg-blue-50 text-blue-600 border-blue-200 group-hover:bg-blue-600 group-hover:text-white',
                'bg-cyan-50 text-cyan-700 border-cyan-200 group-hover:bg-cyan-600 group-hover:text-white',
            ];
            $badges = ['Residensial & Hunian', 'Komersial & Bisnis', 'Inspeksi & Heavy Duty'];
            $categoriesTagMap = ['residensial', 'komersial', 'gedung'];
            @endphp

            @foreach($serviceCategories as $i => $category)
            @php
                $catTag = $categoriesTagMap[$i % 3];
            @endphp
            <article class="js-service-card-item group bg-white rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden cursor-pointer relative"
                     data-category-type="{{ $catTag }}"
                     data-name="{{ $category->name }}"
                     data-home="{{ $category->price_home }}"
                     data-corporate="{{ $category->price_corporate }}"
                     data-desc="{{ $category->price_description }}">
                
                {{-- Decorative Gradient Border Header --}}
                <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-400 to-blue-500"></div>

                {{-- Service Image Banner --}}
                <div class="relative h-44 sm:h-48 w-full bg-slate-900 overflow-hidden">
                    <img src="{{ $category->image_url }}" 
                         alt="{{ $category->name }} Rootera Plumbing" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                         loading="lazy"
                         onerror="this.onerror=null;this.src='{{ asset('images/JnJ.webp') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>
                    
                    {{-- Floating Icon & Badge --}}
                    <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between z-10">
                        <div class="w-10 h-10 rounded-xl border flex items-center justify-center shadow-md backdrop-blur-md bg-white/90 text-slate-800 border-white/40">
                            {!! $icons[$i % 3] !!}
                        </div>
                        <span class="bg-slate-900/80 backdrop-blur-md text-emerald-400 font-bold text-[10px] sm:text-[11px] uppercase tracking-wider px-2.5 py-1 rounded-full border border-emerald-500/30 shadow-xs">
                            {{ $badges[$i % 3] }}
                        </span>
                    </div>
                </div>

                <div class="p-5 sm:p-7 flex flex-col flex-grow">
                    {{-- Title & Description --}}
                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        <a href="{{ route('layanan.show', $category->slug) }}" class="hover:underline">
                            {{ $category->name }}
                        </a>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-5">
                        {{ $category->description }}
                    </p>

                    {{-- Feature Checkmarks List --}}
                    <div class="mt-auto space-y-2 pt-4 border-t border-slate-100">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Poin Penanganan Utama:</span>
                        @foreach($category->services->take(4) as $service)
                        <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-800">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-[10px] font-bold shrink-0">✓</span>
                            <span class="line-clamp-1">{{ $service->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Card Action Footer (Thumb-Zone Friendly: Min Height 44px) --}}
                <div class="px-5 sm:px-6 py-3.5 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between group-hover:bg-emerald-50/40 transition-colors min-h-[46px]">
                    <span class="text-xs sm:text-sm font-bold text-emerald-700 group-hover:text-emerald-800">
                        Lihat Detail & Estimasi Harga
                    </span>
                    <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-2xs transform group-hover:translate-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- 3. SECTION ARMADA PERALATAN & TEKNOLOGY MODERN (DURANTE LAYANAN & MEKANISME) --}}
<section class="py-12 sm:py-16 lg:py-20 bg-slate-50 border-y border-slate-200/80" aria-labelledby="tools-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-wider mb-2 border border-blue-100">
                ⚡ Teknologi Terkini
            </span>
            <h2 id="tools-heading" class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">
                Armada Peralatan <span class="text-blue-600">Modern Rootera</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                Kombinasi unit pembersih mekanis fleksibel & kamera endoskopi digital berstandar internasional untuk efisiensi pengerjaan tanpa membongkar struktur bangunan.
            </p>
        </div>

        {{-- Dynamic Equipment Showcase Grid --}}
        <x-equipment-showcase title="" subtitle="" />
    </div>
</section>

{{-- 4. SECTION NILAI TAMBAH & KEUNGGULAN LAYANAN (4 Pilar Keunggulan) --}}
<section class="py-12 sm:py-16 bg-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
            <span class="text-emerald-400 font-bold text-xs uppercase tracking-wider">Komitmen Kualitas Rootera</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1 font-['Plus_Jakarta_Sans',sans-serif]">
                Mengapa Memilih Jasa Pelancar Pipa Rootera?
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            {{-- Pilar 1 --}}
            <div class="bg-slate-800/60 p-5 sm:p-6 rounded-2xl border border-slate-700/60 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center font-bold text-xl mb-3.5">
                    ⚡
                </div>
                <h4 class="font-bold text-base text-white mb-1">Tanpa Bongkar Keramik</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Pengerjaan mekanis fleksibel meliuk di alur PVC tanpa merusak lantai, keramik, atau dinding rumah Anda.
                </p>
            </div>

            {{-- Pilar 2 --}}
            <div class="bg-slate-800/60 p-5 sm:p-6 rounded-2xl border border-slate-700/60 hover:border-cyan-500/50 transition-all duration-300">
                <div class="w-11 h-11 rounded-xl bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 flex items-center justify-center font-bold text-xl mb-3.5">
                    📜
                </div>
                <h4 class="font-bold text-base text-white mb-1">Garansi Tuntas 30 Hari</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Jaminan garansi tertulis resmi. Jika pipa tersumbat kembali dalam masa garansi, teknisi datang tanpa biaya tambahan.
                </p>
            </div>

            {{-- Pilar 3 --}}
            <div class="bg-slate-800/60 p-5 sm:p-6 rounded-2xl border border-slate-700/60 hover:border-teal-500/50 transition-all duration-300">
                <div class="w-11 h-11 rounded-xl bg-teal-500/10 text-teal-400 border border-teal-500/20 flex items-center justify-center font-bold text-xl mb-3.5">
                    ⏱️
                </div>
                <h4 class="font-bold text-base text-white mb-1">Respon Cepat &lt; 30 Menit</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Armada teknisi profesional standby terdekat di Jabodetabek, Bandung, Semarang, Jogja, Solo, & Lampung.
                </p>
            </div>

            {{-- Pilar 4 --}}
            <div class="bg-slate-800/60 p-5 sm:p-6 rounded-2xl border border-slate-700/60 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center font-bold text-xl mb-3.5">
                    🏷️
                </div>
                <h4 class="font-bold text-base text-white mb-1">Harga Transparan Clear</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Estimasi harga diinformasikan transparan di awal pengerjaan. Tanpa biaya tersembunyi atau tambahan tidak jelas.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- 5. BOTTOM CALL-TO-ACTION (High-Conversion Banner) --}}
<section class="py-14 sm:py-20 bg-gradient-to-br from-slate-900 via-[#0A2E78] to-slate-950 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#20b2aa 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-4 border border-emerald-500/40">
            🚨 PENANGANAN DARURAT 24 JAM
        </span>
        <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
            Saluran Pipa Mampet Meluap Hari Ini? <br class="hidden sm:inline">
            <span class="text-emerald-400">Dapatkan Penanganan Teknisi Standby Terdekat</span>
        </h2>
        <p class="mt-3.5 text-xs sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">
            Jangan biarkan genangan air kotor merusak properti Anda. Konsultasikan kendala pipa Anda secara gratis dengan tim teknisi Rootera Plumbing.
        </p>

        <div class="mt-7 flex flex-col sm:flex-row items-center justify-center gap-3.5">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh penanganan pipa mampet darurat. Bisa minta info estimasi biaya dan kedatangan teknisi?') }}" target="_blank" class="w-full sm:w-auto min-h-[48px] bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-sm sm:text-base py-3.5 px-7 rounded-full flex items-center justify-center gap-2.5 transition-all duration-300 shadow-[0_10px_25px_rgba(37,211,102,0.35)] hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                <span>Hubungi Teknisi via WhatsApp 24 Jam</span>
            </a>
            <a href="tel:081385404000" class="w-full sm:w-auto min-h-[48px] bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-sm sm:text-base py-3.5 px-6 rounded-full border border-slate-700 transition-all flex items-center justify-center">
                📞 Panggilan Direct 24 Jam
            </a>
        </div>
    </div>
</section>

{{-- MODAL PRICE DETAILS --}}
<div id="price-modal" class="fixed inset-0 z-[1100] hidden flex items-center justify-center p-4 sm:p-6 transition-all duration-300 opacity-0" style="background:rgba(15,23,42,0.6);backdrop-filter:blur(12px);">
    <div class="bg-white rounded-[24px] sm:rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.2)] w-full max-w-4xl transform scale-95 transition-all duration-300 relative overflow-hidden flex flex-col max-h-[90vh] overflow-y-auto" id="price-modal-content">
        
        {{-- Close Button --}}
        <button type="button" onclick="closePriceModal()" class="absolute top-4 right-4 sm:top-6 sm:right-6 z-30 text-slate-400 hover:text-slate-700 bg-white/80 backdrop-blur hover:bg-slate-100 rounded-full p-2.5 sm:p-3 transition-colors shadow-xs">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        {{-- Header Section (Light Blue Gradient) --}}
        <div class="bg-gradient-to-br from-[#f0f7ff] to-[#e0f2fe] pt-12 pb-16 px-6 sm:px-10 text-center relative flex-shrink-0">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#0A2E78 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>
            
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-2xl sm:rounded-3xl bg-white shadow-md text-[#0A2E78] mb-4 sm:mb-6 relative z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="sm:w-10 sm:h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <h3 id="pm-title" class="text-2xl sm:text-4xl font-extrabold text-[#0A2E78] tracking-tight relative z-10 mb-3">Detail Harga</h3>
            <p class="text-slate-500 text-sm sm:text-base max-w-lg mx-auto relative z-10 leading-relaxed">Estimasi biaya transparan untuk menyelesaikan permasalahan saluran pembuangan Anda.</p>
        </div>

        {{-- Content Section --}}
        <div class="px-5 sm:px-10 pb-10 relative z-10 -mt-10 sm:-mt-12 flex-1 flex flex-col">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                {{-- Harga Rumahan Card --}}
                <div class="bg-white rounded-[24px] p-6 sm:p-8 shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-slate-100 flex flex-col hover:border-[#169F81] hover:shadow-[0_15px_50px_rgba(22,159,129,0.15)] transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center gap-3 sm:gap-4 mb-6">
                        <div class="p-2.5 sm:p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg sm:text-xl">Rumah Hunian</h4>
                    </div>
                    <div class="mt-auto">
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mb-1 uppercase tracking-widest">Mulai dari</p>
                        <p id="pm-home" class="text-3xl sm:text-4xl font-extrabold text-[#0A2E78] tracking-tight">Rp -</p>
                    </div>
                </div>

                {{-- Harga Corporate Card --}}
                <div class="bg-white rounded-[24px] p-6 sm:p-8 shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-slate-100 flex flex-col hover:border-[#0A2E78] hover:shadow-[0_15px_50px_rgba(10,46,120,0.15)] transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-slate-50 rounded-bl-[100%] pointer-events-none"></div>
                    <div class="flex items-center gap-3 sm:gap-4 mb-6 relative z-10">
                        <div class="p-2.5 sm:p-3 bg-slate-100 rounded-xl text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg sm:text-xl">Komersial / Gedung</h4>
                    </div>
                    <div class="mt-auto relative z-10">
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mb-1 uppercase tracking-widest">Estimasi Biaya</p>
                        <p id="pm-corporate" class="text-3xl sm:text-4xl font-extrabold text-[#0A2E78] tracking-tight">Rp -</p>
                    </div>
                </div>

            </div>

            {{-- Services & Note Area --}}
            <div class="mt-auto bg-slate-50 rounded-[20px] sm:rounded-[24px] p-6 sm:p-8 border border-slate-100">
                <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6 lg:gap-8">
                    <div class="flex-1 w-full">
                        <h5 class="text-sm sm:text-base font-bold text-slate-700 mb-3 sm:mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-[#169F81]"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            Layanan Termasuk:
                        </h5>
                        <div id="pm-services" class="flex flex-wrap gap-2 sm:gap-3">
                            {{-- Injected via JS --}}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full border-t lg:border-t-0 lg:border-l border-slate-200 pt-4 lg:pt-0 lg:pl-8 mt-4 lg:mt-0">
                        <p id="pm-desc" class="text-sm text-slate-500 italic leading-relaxed">
                            *Harga dapat berubah sesuai tingkat keparahan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- CTA Button --}}
            <div class="mt-8 flex justify-center">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin pesan layanan pipa mampet.') }}" target="_blank" class="w-full sm:w-auto min-h-[48px] bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-base sm:text-lg py-4 px-8 sm:px-10 rounded-full flex items-center justify-center gap-3 transition-all duration-300 shadow-[0_8px_20px_rgba(37,211,102,0.3)] hover:shadow-[0_12px_25px_rgba(37,211,102,0.4)] hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Konsultasi Gratis via WhatsApp</span>
                </a>
            </div>
            
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Price Modal Trigger
        const cards = document.querySelectorAll('.js-service-card-item');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                const title = this.getAttribute('data-name');
                const home = this.getAttribute('data-home');
                const corporate = this.getAttribute('data-corporate');
                const desc = this.getAttribute('data-desc');
                
                const serviceItems = this.querySelectorAll('.line-clamp-1');
                const services = Array.from(serviceItems).map(item => item.textContent);
                
                openPriceModal(title, home, corporate, desc, services);
            });
        });

        // Category Filter Tabs Trigger
        const filterBtns = document.querySelectorAll('.js-filter-btn');
        const serviceCards = document.querySelectorAll('.js-service-card-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-slate-900', 'text-white');
                    b.classList.add('bg-slate-100', 'text-slate-700');
                });

                this.classList.add('active', 'bg-slate-900', 'text-white');
                this.classList.remove('bg-slate-100', 'text-slate-700');

                const filter = this.getAttribute('data-filter');

                serviceCards.forEach(card => {
                    const cardType = card.getAttribute('data-category-type');
                    if (filter === 'all' || cardType === filter) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });

    function openPriceModal(title, home, corporate, desc, services) {
        document.getElementById('pm-title').textContent = title;
        document.getElementById('pm-home').textContent = home ? 'Rp ' + home : 'Hubungi Kami';
        document.getElementById('pm-corporate').textContent = corporate ? 'Rp ' + corporate : 'Hubungi Kami';
        
        const descEl = document.getElementById('pm-desc');
        descEl.textContent = desc ? '*' + desc : '*Harga dapat menyesuaikan tingkat kesulitan';
        
        const servicesContainer = document.getElementById('pm-services');
        servicesContainer.innerHTML = '';
        if(services && services.length > 0) {
            services.forEach(srv => {
                const pill = document.createElement('div');
                pill.className = 'bg-white border border-slate-200 rounded-full px-3.5 py-1.5 text-xs font-semibold text-slate-700 shadow-2xs';
                pill.textContent = srv;
                servicesContainer.appendChild(pill);
            });
        }
        
        const modal = document.getElementById('price-modal');
        const content = document.getElementById('price-modal-content');
        
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        content.classList.add('scale-100');
    }

    function closePriceModal() {
        const modal = document.getElementById('price-modal');
        const content = document.getElementById('price-modal-content');
        
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>

@endsection
