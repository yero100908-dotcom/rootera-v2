@extends('layouts.app')

@section('schema-markup')
<?php
$contactSchema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'ContactPage',
            '@id' => url('/kontak') . '#webpage',
            'url' => url('/kontak'),
            'name' => $seo['title'] ?? 'Hubungi Rootera Plumbing | Layanan Pelancar Pipa Mampet 24 Jam',
            'description' => $seo['description'] ?? '',
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Hubungi Kami', 'item' => url('/kontak')]
                ]
            ]
        ],
        [
            '@type' => 'Plumber',
            '@id' => url('/') . '#organization',
            'name' => 'Rootera Plumbing',
            'url' => url('/'),
            'logo' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'image' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            'telephone' => '+6281385404000',
            'email' => 'info@rooteraplumbing.id',
            'priceRange' => 'Rp 350.000 - Rp 1.500.000',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Raya Bogor KM 26 No. 8, Cijantung, Pasar Rebo',
                'addressLocality' => 'Jakarta Timur',
                'addressRegion' => 'DKI Jakarta',
                'postalCode' => '13770',
                'addressCountry' => 'ID'
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => '-6.3190',
                'longitude' => '106.8640'
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => '00:00',
                'closes' => '23:59'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+6281385404000',
                'contactType' => 'customer service',
                'contactOption' => 'TollFree',
                'areaServed' => ['ID'],
                'availableLanguage' => ['Indonesian']
            ],
            'sameAs' => [
                'https://www.instagram.com/rootera_plumbing/',
                'https://www.facebook.com/Rootera.id',
                'https://www.tiktok.com/@rootera_plumbing'
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($contactSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- 1. HERO HEADER SECTION --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 overflow-hidden border-b border-slate-800">
    {{-- Ambient Ambient Glow --}}
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Breadcrumbs --}}
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Hubungi Kami</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4 backdrop-blur-md">
                🚨 LAYANAN EMERGENCY 24 JAM NONSTOP
            </span>
            
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-5 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Pusat Bantuan &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Layanan Darurat Pipa Mampet</span>
            </h1>
            
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto mb-8">
                Armada teknisi senior Rootera siap meluncur 24 jam nonstop menangani saluran mampet di Jabodetabek, Jawa Barat, Jawa Tengah, DIY, Jawa Timur, hingga Lampung.
            </p>

            {{-- 3 Quick Info Badges --}}
            <div class="flex flex-wrap justify-center gap-2.5 sm:gap-4">
                <span class="inline-flex items-center gap-1.5 bg-slate-800/80 text-emerald-400 border border-slate-700 text-xs font-bold px-3.5 py-2 rounded-full shadow-xs">
                    🟢 Respon Cepat &lt; 15 Menit
                </span>
                <span class="inline-flex items-center gap-1.5 bg-slate-800/80 text-cyan-400 border border-slate-700 text-xs font-bold px-3.5 py-2 rounded-full shadow-xs">
                    🛠️ Standby 24 Jam Every Day
                </span>
                <span class="inline-flex items-center gap-1.5 bg-slate-800/80 text-teal-300 border border-slate-700 text-xs font-bold px-3.5 py-2 rounded-full shadow-xs">
                    📄 Konsultasi &amp; Estimasi Gratis
                </span>
            </div>
        </div>
    </div>
</div>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Flash Feedback Toast / Alert --}}
        @if(session('success'))
        <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm font-bold flex items-center justify-between shadow-xs" role="alert">
            <div class="flex items-center gap-2.5">
                <span class="text-lg">🎉</span>
                <span>{{ session('success') }}</span>
            </div>
            <span class="text-xs text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-200 font-mono">Tersimpan di Sistem</span>
        </div>
        @endif

        {{-- 2. SPLIT CARD: CONTACT INFO (LEFT 40%) VS FORM (RIGHT 60%) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-16 sm:mb-20">
            
            {{-- SISI KIRI: KARTU INFORMASI KONTAK & HQ (40% / 5 COLS) --}}
            <div class="lg:col-span-5 bg-slate-900 text-white rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-2xl space-y-6 relative overflow-hidden">
                {{-- Subtle Glow Accent --}}
                <div class="absolute -top-12 -left-12 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <div>
                    <span class="text-emerald-400 font-bold text-xs uppercase tracking-wider block mb-1">Informasi Resmi</span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">Kantor Pusat &amp; Call Center</h2>
                    <p class="text-slate-400 text-xs sm:text-sm mt-1">Tim layanan pelanggan kami aktif 24 jam untuk merespon pertanyaan &amp; pemesanan jadwal teknisi.</p>
                </div>

                <div class="space-y-4 pt-2">
                    {{-- WA Line --}}
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin konsultasi penanganan pipa mampet') }}" target="_blank" rel="noopener" class="flex items-start gap-3.5 p-3.5 bg-slate-800/80 hover:bg-slate-800 rounded-2xl border border-slate-700/80 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-[#25D366]/20 text-[#25D366] flex items-center justify-center font-bold shrink-0 text-lg group-hover:scale-110 transition-transform">
                            💬
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 block uppercase">WhatsApp Hotline 24 Jam</span>
                            <span class="text-sm font-extrabold text-white group-hover:text-emerald-400 transition-colors">0813-8540-4000</span>
                        </div>
                    </a>

                    {{-- Email --}}
                    <div class="flex items-start gap-3.5 p-3.5 bg-slate-800/80 rounded-2xl border border-slate-700/80">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center font-bold shrink-0 text-lg">
                            ✉️
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 block uppercase">Email Resmi</span>
                            <a href="mailto:info@rooteraplumbing.id" class="text-xs sm:text-sm font-bold text-white hover:text-emerald-400 transition-colors">info@rooteraplumbing.id</a>
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/rootera_plumbing/" target="_blank" rel="noopener noreferrer" class="flex items-start gap-3.5 p-3.5 bg-slate-800/80 hover:bg-slate-800 rounded-2xl border border-slate-700/80 transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center font-bold shrink-0 text-lg group-hover:scale-110 transition-transform">
                            📸
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 block uppercase">Instagram Resmi</span>
                            <span class="text-xs sm:text-sm font-bold text-white group-hover:text-rose-300 transition-colors">@rootera_plumbing</span>
                        </div>
                    </a>

                    {{-- HQ Address --}}
                    <div class="flex items-start gap-3.5 p-3.5 bg-slate-800/80 rounded-2xl border border-slate-700/80">
                        <div class="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center font-bold shrink-0 text-lg">
                            📍
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 block uppercase">Kantor Pusat &amp; Workshop HQ</span>
                            <p class="text-xs sm:text-sm text-slate-200 leading-relaxed font-medium">
                                Jl. Raya Bogor KM 26 No. 8, Cijantung, Pasar Rebo, Jakarta Timur 13770
                            </p>
                        </div>
                    </div>

                    {{-- Operating Hours --}}
                    <div class="flex items-start gap-3.5 p-3.5 bg-slate-800/80 rounded-2xl border border-slate-700/80">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold shrink-0 text-lg">
                            ⏰
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 block uppercase">Jam Operasional Teknisi</span>
                            <span class="text-xs sm:text-sm font-extrabold text-emerald-400">Buka 24 Jam Nonstop (Setiap Hari)</span>
                        </div>
                    </div>
                </div>

                {{-- Trust Signals --}}
                <div class="pt-4 border-t border-slate-800 grid grid-cols-3 gap-2 text-center">
                    <div class="p-2 bg-slate-950/60 rounded-xl border border-slate-800">
                        <span class="block text-xs font-bold text-emerald-400">Garansi 30H</span>
                        <span class="text-[10px] text-slate-400">Resmi Tertulis</span>
                    </div>
                    <div class="p-2 bg-slate-950/60 rounded-xl border border-slate-800">
                        <span class="block text-xs font-bold text-cyan-400">No Bongkar</span>
                        <span class="text-[10px] text-slate-400">Mesin Ridgid</span>
                    </div>
                    <div class="p-2 bg-slate-950/60 rounded-xl border border-slate-800">
                        <span class="block text-xs font-bold text-teal-300">Sertifikasi</span>
                        <span class="text-[10px] text-slate-400">Teknisi Senior</span>
                    </div>
                </div>
            </div>

            {{-- SISI KANAN: FORM KONSULTASI & PEMESANAN (60% / 7 COLS) --}}
            <div class="lg:col-span-7 bg-slate-50/90 rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm space-y-6">
                <div>
                    <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider block mb-1">Formulir Pesanan Instant</span>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">Kirim Pesan &amp; Jadwal Penanganan</h2>
                    <p class="text-slate-600 text-xs sm:text-sm mt-1">Isi formulir di bawah ini, data akan langsung diproses oleh sistem dispatch teknisi kami.</p>
                </div>

                <form action="{{ route('kontak.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="name" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="Bapak / Ibu ..." class="w-full bg-white border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-xs font-semibold text-slate-900 min-h-[48px]">
                            </div>
                            @error('name')<span class="text-rose-500 text-[11px] font-bold mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        {{-- Nomor WA --}}
                        <div>
                            <label for="phone" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">
                                Nomor WhatsApp Aktif <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" placeholder="0812-xxxx-xxxx" class="w-full bg-white border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-xs font-semibold text-slate-900 min-h-[48px]">
                            </div>
                            @error('phone')<span class="text-rose-500 text-[11px] font-bold mt-1 block">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">
                            Alamat Email (Opsional)
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@properti.com" class="w-full bg-white border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-xs font-semibold text-slate-900 min-h-[48px]">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Dropdown Layanan --}}
                        <div>
                            <label for="service_type" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">
                                Pilihan Jenis Layanan
                            </label>
                            <select id="service_type" name="service_type" class="w-full bg-white border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-xs font-bold text-slate-800 min-h-[48px]">
                                <option value="">— Pilih Layanan —</option>
                                @if(isset($serviceCategories) && $serviceCategories->isNotEmpty())
                                    @foreach($serviceCategories as $srv)
                                        <option value="{{ $srv->name }}" {{ old('service_type') == $srv->name ? 'selected' : '' }}>{{ $srv->name }}</option>
                                    @endforeach
                                @else
                                    <option value="Jasa Cuci Toren & Kuras Tandon Air" {{ old('service_type') == 'Jasa Cuci Toren & Kuras Tandon Air' ? 'selected' : '' }}>Jasa Cuci Toren &amp; Kuras Tandon Air</option>
                                    <option value="Pelancaran Wastafel Dapur" {{ old('service_type') == 'Pelancaran Wastafel Dapur' ? 'selected' : '' }}>Pelancaran Wastafel Dapur Mampet</option>
                                    <option value="Pelancaran Floor Drain" {{ old('service_type') == 'Pelancaran Floor Drain' ? 'selected' : '' }}>Pelancaran Floor Drain Kamar Mandi</option>
                                    <option value="Pelancaran Kloset & WC" {{ old('service_type') == 'Pelancaran Kloset & WC' ? 'selected' : '' }}>Pelancaran Kloset &amp; WC Mampet</option>
                                    <option value="Hydro Jetting Industri" {{ old('service_type') == 'Hydro Jetting Industri' ? 'selected' : '' }}>Hydro Jetting Industri &amp; Restoran</option>
                                    <option value="Inspeksi CCTV Kamera Pipa" {{ old('service_type') == 'Inspeksi CCTV Kamera Pipa' ? 'selected' : '' }}>Inspeksi CCTV Kamera Pipa</option>
                                @endif
                            </select>
                        </div>

                        {{-- Dropdown Area --}}
                        <div>
                            <label for="area" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">
                                Kota / Lokasi Target
                            </label>
                            <select id="area" name="area" class="w-full bg-white border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-xs font-bold text-slate-800 min-h-[48px]">
                                <option value="">— Pilih Kota —</option>
                                @if(isset($cities) && $cities->isNotEmpty())
                                    @foreach($cities as $city)
                                        <option value="{{ $city->name }}" {{ old('area') == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                @else
                                    <option value="Jakarta" {{ old('area') == 'Jakarta' ? 'selected' : '' }}>Jakarta (Selatan/Timur/Pusat/Barat/Utara)</option>
                                    <option value="Bogor" {{ old('area') == 'Bogor' ? 'selected' : '' }}>Bogor &amp; Depok</option>
                                    <option value="Tangerang" {{ old('area') == 'Tangerang' ? 'selected' : '' }}>Tangerang &amp; BSD</option>
                                    <option value="Bekasi" {{ old('area') == 'Bekasi' ? 'selected' : '' }}>Bekasi &amp; Cikarang</option>
                                    <option value="Bandung" {{ old('area') == 'Bandung' ? 'selected' : '' }}>Bandung &amp; Cimahi</option>
                                    <option value="Semarang" {{ old('area') == 'Semarang' ? 'selected' : '' }}>Semarang &amp; Solo</option>
                                    <option value="Yogyakarta" {{ old('area') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta &amp; Sleman</option>
                                    <option value="Lampung" {{ old('area') == 'Lampung' ? 'selected' : '' }}>Bandar Lampung</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi Kendala --}}
                    <div>
                        <label for="message" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">
                            Pesan / Deskripsi Kendala Pipa <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="message" name="message" required rows="4" placeholder="Contoh: Wastafel dapur mampet berlemak di area Cibubur, air meluap sejak kemarin." class="w-full bg-white border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800 leading-relaxed">{{ old('message') }}</textarea>
                        @error('message')<span class="text-rose-500 text-[11px] font-bold mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2 space-y-3">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm py-3.5 px-6 rounded-xl shadow-md hover:shadow-emerald-600/20 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2 min-h-[48px]">
                            <span>🚀 Kirim Pesanan &amp; Jadwalkan Teknisi</span>
                        </button>

                        <div class="text-center">
                            <span class="text-[11px] text-slate-400 font-medium">— atau pesan instan via WhatsApp —</span>
                        </div>

                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin panggil teknisi untuk penanganan pipa mampet') }}" target="_blank" rel="noopener" class="w-full bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm py-3 px-6 rounded-xl transition-all flex items-center justify-center gap-2 min-h-[48px] shadow-xs">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span>Chat Langsung via WhatsApp CS 24 Jam</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- 3. SECTION PETA INTERAKTIF & JANGKAUAN CABANG (GOOGLE MAPS & BRANCH HUBS) --}}
        <div class="mb-12">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-6 gap-4">
                <div>
                    <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Lokasi Kantor Pusat (HQ)</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Peta Navigasi Workshop Rootera</h2>
                </div>

                <a href="https://maps.google.com/?q=Cijantung+Pasar+Rebo+Jakarta+Timur" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-xs font-bold text-slate-700 hover:text-emerald-600 bg-slate-100 hover:bg-slate-200 px-4 py-2.5 rounded-xl transition-colors border border-slate-200 shrink-0">
                    <span>🗺️ Buka Petunjuk Arah Google Maps (HQ Cijantung)</span>
                    <span>→</span>
                </a>
            </div>

            {{-- Google Map Component Container --}}
            <div class="rounded-3xl border border-slate-200 overflow-hidden shadow-xs bg-slate-900">
                <x-google-map-embed />
            </div>

            {{-- Branch Quick Selector Badges --}}
            <div class="mt-8 p-6 bg-slate-50 rounded-3xl border border-slate-200">
                <h3 class="font-extrabold text-slate-900 text-sm mb-3">Jaringan Cabang &amp; Post Standby Teknisi:</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Jakarta Selatan</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Jakarta Timur (HQ)</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Jakarta Barat</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Jakarta Utara</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Jakarta Pusat</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Bogor &amp; Depok</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Tangerang &amp; BSD</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Bekasi &amp; Cikarang</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Bandung &amp; Cimahi</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Cirebon &amp; Indramayu</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Semarang &amp; Surakarta</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Yogyakarta &amp; Sleman</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Surabaya &amp; Sidoarjo</span>
                    <span class="px-3 py-1 bg-white text-slate-700 border border-slate-200 rounded-full text-xs font-bold">📍 Bandar Lampung</span>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
