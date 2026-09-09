@extends('layouts.app')

@section('meta_title', 'Profil Holding J&J Group & Divisi Sanitasi Rootera Plumbing')
@section('meta_description', 'Mengenal J&J Group sebagai induk holding Rootera Plumbing. Komitmen transparansi harga, standarisasi armada modern, dan kredibilitas legalitas usaha.')
@section('meta_keywords', 'profil jj group, holding rootera plumbing, legalitas pt sanitasi jakarta timur, bengkel pipa cijantung')
@section('canonical', url('/tentang-kami/holding-jj-group'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => ['Organization', 'Corporation'],
            '@id' => url('/tentang-kami/holding-jj-group#organization'),
            'name' => 'J&J Group',
            'legalName' => 'J&J Group Holding',
            'url' => url('/tentang-kami/holding-jj-group'),
            'logo' => asset('images/JnJ.webp'),
            'description' => 'Induk holding enterprise Rootera Plumbing spesialis pelancaran pipa mampet & sanitasi modern.',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Kalisari Lapan No.34, Cijantung, Pasar Rebo',
                'addressLocality' => 'Jakarta Timur',
                'addressRegion' => 'DKI Jakarta',
                'postalCode' => '13780',
                'addressCountry' => 'ID'
            ],
            'subOrganization' => [
                '@type' => 'Plumber',
                '@id' => url('/#organization'),
                'name' => 'Rootera Plumbing',
                'url' => url('/'),
                'logo' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
                'telephone' => '+6285212560867'
            ]
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Profil Holding J&J Group', 'item' => url('/tentang-kami/holding-jj-group')]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- Hero Header --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Holding J&amp;J Group</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🏢 Structuring &amp; Corporate Governance
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Profil Holding <span class="text-emerald-400">J&amp;J Group</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Rootera Plumbing berdiri kokoh sebagai divisi teknikal sanitasi dan pelancaran pipa mampet di bawah naungan ekosistem bisnis **J&amp;J Group** — menghadirkan solusi infrastruktur drainase modern, transparan, dan bergaransi resmi.
            </p>
        </div>
    </div>
</div>

{{-- Content Section 1: Overview & Structure --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-16">
            <div class="lg:col-span-7 space-y-5">
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Divisi Spesialis Sanitasi Modern</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                    Sinergi Infrastruktur Industri &amp; Layanan Residensial Presisi
                </h2>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    Sebagai bagian terintegrasi dari <strong>J&amp;J Group</strong>, Rootera Plumbing memadukan standar tata kelola korporat yang akuntabel dengan keahlian rekayasa sanitasi tingkat tinggi. Kami hadir untuk menyelesaikan permasalahan mampet secara mekanis tanpa membongkar struktur bangunan.
                </p>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base">
                    Dukungan manajemen pusat dari J&amp;J Group memungkinkan Rootera menyedia kan armanda teknisi siaga 24 jam dengan standardisasi APD K3 lengkap, legalitas invoice e-Faktur PPN, serta sistem garansi pengerjaan 30 hari tuntas.
                </p>

                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600">3+</div>
                        <div class="text-xs sm:text-sm text-slate-600 font-medium mt-1">Wilayah Operasional Utama (Jabodetabek, Semarang, Bandar Lampung)</div>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="text-2xl sm:text-3xl font-extrabold text-blue-600">10.000+</div>
                        <div class="text-xs sm:text-sm text-slate-600 font-medium mt-1">Titik Saluran Tuntas Tanpa Bongkar</div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-gradient-to-br from-slate-900 via-[#0B2545] to-slate-900 text-white p-8 rounded-3xl shadow-xl border border-slate-800 relative">
                    <div class="flex items-center gap-4 pb-6 mb-6 border-b border-slate-700/80">
                        <img src="{{ asset('images/JnJ.webp') }}" alt="J&J Group Logo" class="h-14 w-auto object-contain">
                        <div>
                            <h3 class="font-bold text-lg text-white">J&amp;J GROUP</h3>
                            <p class="text-xs text-emerald-400 font-medium">Holding Entity &amp; Parent Company</p>
                        </div>
                    </div>
                    <ul class="space-y-3 text-xs sm:text-sm text-slate-300">
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-400">✓</span> <span>Legalitas PT / CV Pengadaan B2B Terverifikasi</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-400">✓</span> <span>Penerbitan e-Faktur PPN 11% Resmi</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-400">✓</span> <span>SLA Layanan Darurat 24 Jam Nonstop</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="text-emerald-400">✓</span> <span>Standar K3 &amp; APD Keselamatan Lapangan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Core Values Grid --}}
        <div class="mb-16">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Nilai Utam &amp; Komitmen Group</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 font-['Plus_Jakarta_Sans',sans-serif]">
                    4 Pilar Utama Layanan Rootera Plumbing
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Value 1 --}}
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xl mb-4">💰</div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Transparansi Harga Total</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Skema tuntas baru bayar. Tidak ada hidden fees atau biaya siluman. Estimasi biaya diberikan transparan di awal sebelum teknisi bekerja.
                    </p>
                </div>

                {{-- Value 2 --}}
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xl mb-4">🛠️</div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Teknologi Tanpa Bongkar</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Menggunakan mesin Ridgid spiral baja fleksibel USA, kamera mikro CCTV 1080p, dan Hydro-jetting air tekanan tinggi 300 Bar.
                    </p>
                </div>

                {{-- Value 3 --}}
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xl mb-4">🦺</div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Standardisasi K3 &amp; Higienis</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Teknisi dilengkapi APD keselamatan kerja standar K3. Bebas bahan kimia berbahaya korosif yang merusak pipa PVC.
                    </p>
                </div>

                {{-- Value 4 --}}
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200/80 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xl mb-4">📍</div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Jangkauan Luas &amp; Cepat</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Pos armada teknisi siaga melayani wilayah DKI Jakarta, Bodetabek, Kota Semarang, dan Kota Bandar Lampung.
                    </p>
                </div>
            </div>
        </div>

        {{-- Legalities Table & Disclosure --}}
        <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200">
            <div class="max-w-3xl">
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Legalitas Resmi Perusahaan</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                    Kelengkapan Administrasi &amp; Dokumen PT/CV Pendukung
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6">
                    Untuk memenuhi persyaratan pengadaan barang &amp; jasa di sektor B2B, perkantoran, restoran, mall, dan kawasan industri, Rootera Plumbing didukung kelengkapan dokumen resmi:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-xs sm:text-sm">
                <div class="p-4 bg-white rounded-xl border border-slate-200 flex items-center gap-3">
                    <span class="text-lg">📄</span>
                    <div>
                        <div class="font-bold text-slate-900">NIB (Nomor Induk Berusaha)</div>
                        <div class="text-slate-500">Izin Operasional Resmi</div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-xl border border-slate-200 flex items-center gap-3">
                    <span class="text-lg">💳</span>
                    <div>
                        <div class="font-bold text-slate-900">NPWP &amp; SPPKP Perusahaan</div>
                        <div class="text-slate-500">Pajak Resmi Terdaftar</div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-xl border border-slate-200 flex items-center gap-3">
                    <span class="text-lg">📊</span>
                    <div>
                        <div class="font-bold text-slate-900">Faktur Pajak PPN 11%</div>
                        <div class="text-slate-500">Penerbitan e-Faktur B2B</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-12 bg-emerald-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Butuh Konsultasi &amp; Kerjasama B2B dengan J&amp;J Group?</h3>
        <p class="text-emerald-100 mb-6 text-sm sm:text-base">Tim corporate relation kami siap mendiskusikan proposal maintenance dan legalitas pengerjaan gedung Anda.</p>
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera (J&J Group), saya ingin konsultasi penawaran kerja sama B2B') }}" 
           target="_blank" rel="noopener" 
           class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-emerald-800 font-bold rounded-xl shadow-lg hover:bg-slate-100 transition-all text-sm">
            <span>💬 Hubungi Customer Care B2B (WA 24 Jam)</span>
        </a>
    </div>
</section>
@endsection
