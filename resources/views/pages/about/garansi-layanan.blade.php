@extends('layouts.app')

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => url('/tentang-kami/garansi-layanan') . '#webpage',
            'url' => url('/tentang-kami/garansi-layanan'),
            'name' => $seo['title'] ?? 'Garansi Pengerjaan Saluran Mampet 30 Hari | Kebijakan Service Resmi Rootera',
            'description' => $seo['description'] ?? '',
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => 'Garansi & Kebijakan Service', 'item' => url('/tentang-kami/garansi-layanan')]
                ]
            ]
        ],
        [
            '@type' => 'Service',
            '@id' => url('/tentang-kami/garansi-layanan') . '#service',
            'name' => 'Jaminan & Kebijakan Garansi Pelancaran Pipa Rootera Plumbing',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Rootera Plumbing',
                'url' => url('/'),
                'telephone' => '+6281385404000'
            ],
            'termsOfService' => url('/tentang-kami/garansi-layanan'),
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Katalog Proteksi & Garansi Service',
                'itemListElement' => [
                    ['@type' => 'Offer', 'name' => 'Garansi Pengerjaan 30 Hari Gratis Kunjungan Ulang'],
                    ['@type' => 'Offer', 'name' => '100% No Result No Pay (Tuntas Baru Bayar)']
                ]
            ]
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Berapa lama masa aktif garansi pengerjaan Rootera?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Seluruh pengerjaan pelancaran pipa mampet Rootera dilindungi garansi tertulis resmi hingga 30 hari kalender sejak tanggal pengerjaan selesai dilakukan.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apakah ada biaya transportasi saat mengajukan klaim garansi?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Tidak ada biaya tambahan sama sekali. Jika mampet terjadi di titik saluran yang sama selama masa garansi, teknisi kami akan datang dan mengerjakan ulang tanpa biaya transportasi maupun biaya jasa.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apakah klaim garansi membutuhkan nota cetak fisik?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Tidak wajib. Sistem Rootera menggunakan Digital Invoice berbasis nomor WhatsApp terdaftar. Cukup sebutkan nomor WA Anda saat mengajukan klaim.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Bagaimana jika saluran mampet kembali di hari libur atau akhir pekan?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Tim customer care dan tim teknisi dispatch Rootera beroperasi 24 jam nonstop 7 hari seminggu, termasuk tanggal merah dan hari libur nasional.'
                    ]
                ]
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
{{-- 1. HERO HEADER SECTION --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 overflow-hidden border-b border-slate-800">
    {{-- Ambient Radial Glow --}}
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Breadcrumbs --}}
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Garansi &amp; Kebijakan Service</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4 backdrop-blur-md">
                🛡️ JAMINAN PROTEKSI PIPA &amp; KEPUASAN PELANGGAN 100% BEBAS KHAWATIR
            </span>
            
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-5 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Garansi Resmi Hingga 30 Hari: <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Tuntas Dulu, Baru Bayar</span>
            </h1>
            
            <p class="text-slate-300 text-xs sm:text-base sm:leading-relaxed leading-normal max-w-2xl mx-auto">
                Rootera Plumbing memberikan kepastian hasil dengan uji alir debit air di depan pelanggan, invoice &amp; sertifikat garansi digital resmi berstempel, serta kunjungan ulang tanpa biaya jika terjadi kendala pada titik yang sama selama masa garansi.
            </p>
        </div>
    </div>
</div>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 2. SECTION 1: 4 PILAR KOMITMEN LAYANAN ROOTERA --}}
        <div class="mb-16 sm:mb-20">
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Komitmen Kepuasan Konsumen</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">4 Pilar Jaminan Layanan Rootera</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Pilar 1 --}}
                <div class="group bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between hover:border-emerald-500/40">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center font-extrabold text-lg mb-4 group-hover:scale-110 transition-transform">
                            💯
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base mb-2 font-['Plus_Jakarta_Sans',sans-serif] group-hover:text-emerald-600 transition-colors">
                            100% No Result No Pay
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Jika saluran air tidak lancar sempurna sesuai standar uji alir debit air di depan Anda, Anda <strong>bebas biaya pengerjaan sama sekali</strong>.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4">
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">
                            ✓ Tanpa Uang Muka (DP)
                        </span>
                    </div>
                </div>

                {{-- Pilar 2 --}}
                <div class="group bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between hover:border-blue-500/40">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center font-extrabold text-lg mb-4 group-hover:scale-110 transition-transform">
                            🛡️
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base mb-2 font-['Plus_Jakarta_Sans',sans-serif] group-hover:text-blue-600 transition-colors">
                            Masa Proteksi 30 Hari
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Jaminan pelancaran ulang <strong>gratis tanpa biaya tambahan</strong> jika saluran yang sama kembali mampet dalam masa garansi resmi 30 hari.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4">
                        <span class="text-[11px] font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-100">
                            ✓ Proteksi Penuh 30 Hari
                        </span>
                    </div>
                </div>

                {{-- Pilar 3 --}}
                <div class="group bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between hover:border-purple-500/40">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center font-extrabold text-lg mb-4 group-hover:scale-110 transition-transform">
                            📄
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base mb-2 font-['Plus_Jakarta_Sans',sans-serif] group-hover:text-purple-600 transition-colors">
                            Invoice &amp; Stempel Resmi
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Setiap pengerjaan dilengkapi <strong>Digital Invoice resmi berstempel Rootera</strong> yang tersimpan aman di database sistem kami.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4">
                        <span class="text-[11px] font-bold text-purple-700 bg-purple-50 px-2.5 py-1 rounded-full border border-purple-100">
                            ✓ Bukti Legalitas Sah
                        </span>
                    </div>
                </div>

                {{-- Pilar 4 --}}
                <div class="group bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between hover:border-amber-500/40">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center font-extrabold text-lg mb-4 group-hover:scale-110 transition-transform">
                            ⚡
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base mb-2 font-['Plus_Jakarta_Sans',sans-serif] group-hover:text-amber-600 transition-colors">
                            Respon Klaim &lt; 24 Jam
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Prosedur klaim mudah tanpa birokrasi rumit. Tim teknisi dispatch segera dijadwalkan ulang dalam kurun waktu <strong>kurang dari 24 jam</strong>.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 mt-4">
                        <span class="text-[11px] font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-100">
                            ✓ Layanan Prioritas Fast Track
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. SECTION 2: SYARAT & KETENTUAN KLAIM GARANSI (3 CATEGORIES GRID) --}}
        <div class="mb-16 sm:mb-20">
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Transparansi Kebijakan</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Syarat &amp; Ketentuan Klaim Garansi</h2>
                <p class="text-slate-600 mt-2 text-xs sm:text-sm">Seluruh ketentuan dirancang terbuka untuk memberikan rasa aman penuh kepada setiap pelanggan.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Category 1: Cakupan Garansi --}}
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-200/90 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg">
                            ✓
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">1. Cakupan Garansi</h3>
                    </div>
                    <ul class="space-y-3 text-xs sm:text-sm text-slate-600">
                        <li class="flex items-start gap-2.5">
                            <span class="text-emerald-600 font-bold shrink-0">✓</span>
                            <span>Berlaku khusus untuk titik lokasi pipa dan jalur pembuangan yang telah dikerjakan teknisi.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-emerald-600 font-bold shrink-0">✓</span>
                            <span>Mencakup sumbatan ulang akibat gumpalan lemak sisa pengerjaan atau sedimen yang mengendap kembali dalam 30 hari.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-emerald-600 font-bold shrink-0">✓</span>
                            <span>Bebas biaya kunjungan ulang teknisi (tanpa biaya kurir/transpor).</span>
                        </li>
                    </ul>
                </div>

                {{-- Category 2: Alur Prosedur Klaim --}}
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-200/90 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
                            📋
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">2. Prosedur Klaim</h3>
                    </div>
                    <ul class="space-y-3 text-xs sm:text-sm text-slate-600">
                        <li class="flex items-start gap-2.5">
                            <span class="text-blue-600 font-bold shrink-0">1.</span>
                            <span>Hubungi Customer Service WhatsApp resmi Rootera Plumbing.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-blue-600 font-bold shrink-0">2.</span>
                            <span>Sebutkan nomor WhatsApp yang terdaftar pada transaksi pemesanan awal.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-blue-600 font-bold shrink-0">3.</span>
                            <span>Tim admin akan memverifikasi digital invoice dan mendispatch teknisi sesuai jadwal kesepakatan.</span>
                        </li>
                    </ul>
                </div>

                {{-- Category 3: Pengecualian & Batasan --}}
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-200/90 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg">
                            ⚠️
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">3. Pengecualian / Batasan</h3>
                    </div>
                    <ul class="space-y-3 text-xs sm:text-sm text-slate-600">
                        <li class="flex items-start gap-2.5">
                            <span class="text-slate-400 font-bold shrink-0">✕</span>
                            <span>Kerusakan fisik pipa PVC tua yang pecah/ambles akibat usia struktur bangunan lama.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-slate-400 font-bold shrink-0">✕</span>
                            <span>Sumbatan baru yang disengaja dimasukkan pasca pengerjaan (seperti sisa puing semen, kain, atau mainan anak).</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-slate-400 font-bold shrink-0">✕</span>
                            <span>Jalur pipa baru yang tidak termasuk dalam kesepakatan SPK/Invoice pengerjaan awal.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 4. SECTION 3: STEP-BY-STEP VISUAL TIMELINE "CARA KLAIM GARANSI 3 LANGKAH" --}}
        <div class="mb-16 sm:mb-20 bg-slate-900 text-white rounded-3xl p-8 sm:p-12 border border-slate-800 shadow-2xl relative overflow-hidden">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-emerald-400 font-bold text-xs uppercase tracking-wider">Prosedur Praktis</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif] mt-1">Cara Klaim Garansi dalam 3 Langkah Mudah</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                {{-- Step 1 --}}
                <div class="bg-slate-800/80 p-6 rounded-2xl border border-slate-700/80 space-y-3 relative">
                    <span class="w-9 h-9 rounded-full bg-emerald-500 text-slate-950 font-extrabold flex items-center justify-center text-sm shadow-md mb-2">1</span>
                    <h3 class="font-extrabold text-base text-white">Kirim Foto / Invoice via WA</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Hubungi Customer Care WhatsApp kami dan sebutkan nomor WA terdaftar saat pemesanan awal.
                    </p>
                </div>

                {{-- Step 2 --}}
                <div class="bg-slate-800/80 p-6 rounded-2xl border border-slate-700/80 space-y-3 relative">
                    <span class="w-9 h-9 rounded-full bg-emerald-500 text-slate-950 font-extrabold flex items-center justify-center text-sm shadow-md mb-2">2</span>
                    <h3 class="font-extrabold text-base text-white">Verifikasi Data Sistem</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Tim dispatch Rootera memverifikasi tanggal pengerjaan &amp; histori digital invoice Anda secara instan.
                    </p>
                </div>

                {{-- Step 3 --}}
                <div class="bg-slate-800/80 p-6 rounded-2xl border border-slate-700/80 space-y-3 relative">
                    <span class="w-9 h-9 rounded-full bg-emerald-500 text-slate-950 font-extrabold flex items-center justify-center text-sm shadow-md mb-2">3</span>
                    <h3 class="font-extrabold text-base text-white">Teknisi Datang ke Lokasi</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Teknisi senior segera diluncurkan ke alamat Anda untuk melakukan pelancaran ulang tanpa biaya.
                    </p>
                </div>
            </div>
        </div>

        {{-- 5. SECTION 4: ACCORDION INTERAKTIF FAQ GARANSI --}}
        <div class="mb-16 sm:mb-20 max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Pertanyaan Populer</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">FAQ Kebijakan Garansi &amp; Service</h2>
            </div>

            <div class="space-y-4" x-data="{ activeFaq: null }">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Berapa lama masa aktif garansi pengerjaan Rootera?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 1 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Seluruh pengerjaan pelancaran pipa mampet Rootera dilindungi garansi tertulis resmi hingga 30 hari kalender sejak tanggal pengerjaan selesai dilakukan.
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Apakah ada biaya transportasi saat mengajukan klaim garansi?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 2 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Tidak ada biaya tambahan sama sekali. Jika mampet terjadi di titik saluran yang sama selama masa garansi, teknisi kami akan datang dan mengerjakan ulang tanpa biaya transportasi maupun biaya jasa.
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Apakah klaim garansi membutuhkan nota cetak fisik?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 3 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Tidak wajib. Sistem Rootera menggunakan Digital Invoice berbasis nomor WhatsApp terdaftar. Cukup sebutkan nomor WA Anda saat mengajukan klaim.
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 4 ? null : 4)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Bagaimana jika saluran mampet kembali di hari libur atau akhir pekan?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 4 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Tim customer care dan tim teknisi dispatch Rootera beroperasi 24 jam nonstop 7 hari seminggu, termasuk tanggal merah dan hari libur nasional.
                    </div>
                </div>
            </div>
        </div>

        {{-- 6. SECTION 5: HIGH-CONVERSION EMERGENCY CLAIM BANNER --}}
        <div class="bg-gradient-to-r from-slate-900 via-slate-950 to-slate-900 text-white rounded-3xl p-8 sm:p-12 border border-slate-800 shadow-2xl relative overflow-hidden text-center">
            <div class="max-w-2xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                    🟢 LAYANAN DISPATCH KLAIM 24 JAM
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">
                    Ada Kendala Pasca Pengerjaan Saluran?
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Tim dispatch Rootera siap meluncurkan teknisi garansi ke alamat Anda dalam waktu kurang dari 24 jam.
                </p>
                <div class="pt-4 flex flex-col sm:flex-row justify-center gap-3">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin mengklaim garansi pengerjaan pipa') }}" 
                       target="_blank" rel="noopener" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#25D366] hover:bg-[#1EBE5A] text-white font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-all hover:-translate-y-0.5 min-h-[48px]">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <span>Ajukan Klaim Garansi Cepat via WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
