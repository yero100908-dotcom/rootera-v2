@extends('layouts.app')

@section('meta_title', 'Standar SOP & Protokol K3 Pengerjaan Pipa Tanpa Bongkar | Rootera')
@section('meta_description', 'Standar operasional prosedur teknisi Rootera Plumbing: APD lengkap, sterilisasi mesin hydro jetting, tanpa zat kimia berbahaya, dan kebersihan pasca kerja.')
@section('meta_keywords', 'sop pelancaran pipa mampet, k3 teknisi plumbing, keselamatan kerja sanitasi, hydro jetting ramah lingkungan')
@section('canonical', url('/tentang-kami/sop-sanitasi-k3'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => ['Article', 'WebPage'],
            '@id' => url('/tentang-kami/sop-sanitasi-k3#article'),
            'headline' => 'Standar SOP & Protokol K3 Pengerjaan Pipa Tanpa Bongkar',
            'name' => 'Standar SOP & Protokol K3 Pengerjaan Pipa Tanpa Bongkar | Rootera',
            'description' => 'Standar operasional prosedur teknisi Rootera Plumbing: APD lengkap, sterilisasi mesin hydro jetting, tanpa zat kimia berbahaya, dan kebersihan pasca kerja.',
            'url' => url('/tentang-kami/sop-sanitasi-k3'),
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing (J&J Group)',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
                ]
            ],
            'author' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing (J&J Group)'
            ]
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'SOP & Protokol Sanitasi K3', 'item' => url('/tentang-kami/sop-sanitasi-k3')]
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
            <span class="text-emerald-400 font-semibold">SOP &amp; Protokol Sanitasi K3</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🦺 Standard Operating Procedure &amp; Safety First
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                SOP &amp; Protokol <span class="text-emerald-400">Sanitasi K3 Rootera</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Komitmen keselamatan teknisi, kebersihan properti hunian &amp; komersial, sterilisasi alat Ridgid &amp; Hydro-jetting, serta penanganan limbah ramah lingkungan tanpa merusak lingkungan.
            </p>
        </div>
    </div>
</div>

{{-- Main SOP Content --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section 1: Proteksi Teknisi & APD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Standardisasi Proteksi Diri</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                    Perlengkapan APD K3 Teknisi Lapangan
                </h2>
                <p class="text-slate-600 mb-6 leading-relaxed text-sm sm:text-base">
                    Sebelum menginjakkan kaki di area pengerjaan pelanggan (rumah tinggal, restoran, hotel, atau pabrik), setiap teknisi Rootera Plumbing diwajibkan menggunakan Alat Pelindung Diri (APD) standar K3 sesuai prosedur resmi:
                </p>

                <div class="space-y-3">
                    <div class="flex items-start gap-3.5 p-3.5 bg-slate-50 rounded-xl border border-slate-200/80">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm shrink-0">🧤</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Sarung Tangan Heavy-Duty Anti-Slip</h4>
                            <p class="text-xs text-slate-600 mt-0.5">Melindungi tangan dari gesekan kabel mesin spiral Ridgid dan kontak dengan bakteri saluran.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 p-3.5 bg-slate-50 rounded-xl border border-slate-200/80">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm shrink-0">🥾</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Sepatu Boot Safety &amp; Pelindung Alas Footwear</h4>
                            <p class="text-xs text-slate-600 mt-0.5">Memastikan teknisi tidak membawa kotoran luar ke dalam area lantai hunian atau dapur bersih.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5 p-3.5 bg-slate-50 rounded-xl border border-slate-200/80">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm shrink-0">😷</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Masker Respirator &amp; Kacamata Pelindung (Goggles)</h4>
                            <p class="text-xs text-slate-600 mt-0.5">Melindungi teknisi dari cipratan air limbah serta uap gas asam yang terperangkap dalam bak kontrol.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-100">
                    <img src="{{ asset('images/dokumentasi/teknisi-rootera-plumbing-bekerja-lapangan.webp') }}" 
                         alt="Protokol APD Teknisi Rootera Plumbing" 
                         class="w-full h-[420px] object-cover">
                </div>
            </div>
        </div>

        {{-- Section 2: Sterilisasi Alat Mesin --}}
        <div class="mb-16 bg-slate-50 rounded-3xl p-8 border border-slate-200">
            <div class="max-w-3xl mb-8">
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Higiene &amp; Sterilitas Alat</span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 font-['Plus_Jakarta_Sans',sans-serif]">
                    Protokol Desinfeksi Mesin Ridgid &amp; Hydro-Jetting
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2">
                    Kami menjamin bahwa unit mesin spiral baja Ridgid, selang hydro-jetting, dan head nozzle disterilkan secara disiplin sebelum dan sesudah masuk ke lokasi konsumen.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-5 bg-white rounded-2xl border border-slate-200">
                    <div class="text-emerald-600 font-extrabold text-lg mb-2">Step 1: Pre-Wash &amp; High Pressure Clean</div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Pembersihan sisa endapan lemak dan tanah pada kabel spiral baja Ridgid menggunakan semprotan jet air bertekanan pasca pengerjaan di workshop.
                    </p>
                </div>

                <div class="p-5 bg-white rounded-2xl border border-slate-200">
                    <div class="text-emerald-600 font-extrabold text-lg mb-2">Step 2: Desinfeksi Cairan Antiseptik</div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Perendaman dan pembilasan kabel dengan cairan antiseptik ramah lingkungan untuk membasmi kuman, bakteri e-coli, dan bau tidak sedap.
                    </p>
                </div>

                <div class="p-5 bg-white rounded-2xl border border-slate-200">
                    <div class="text-emerald-600 font-extrabold text-lg mb-2">Step 3: Storage &amp; Seal Box Container</div>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penyimpanan mesin dan aksesori nozzle ke dalam wadah box tertutup rapat agar siap digunakan dengan kondisi 100% higienis di lokasi berikutnya.
                    </p>
                </div>
            </div>
        </div>

        {{-- Section 3: Limbah Ramah Lingkungan & Kebersihan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-6 bg-emerald-50/60 rounded-3xl border border-emerald-200/80">
                <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-xl mb-4">🌱</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Penanganan Limbah Lemak Ramah Lingkungan</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Rootera Plumbing **TIDAK MENGGUNAKAN BAHAN KIMIA KOROSIF BERBAHAYA** (seperti Soda Api pekat atau Asam Sulfat) yang dapat melelehkan pipa PVC dan mencemari ekosistem tanah/air sumur. Kotoran lumpur &amp; kerak lemak hasil pengerjaan diangkat dan dibuang ke tempat penampungan limbah khusus.
                </p>
            </div>

            <div class="p-6 bg-blue-50/60 rounded-3xl border border-blue-200/80">
                <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-bold text-xl mb-4">✨</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Garansi Kebersihan Post-Work Cleaning</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Setelah alur debit air dipastikan lancar 100%, teknisi wajib membersihkan lantai kerja, mengelap cipratan air di sekitar area wastafel / floor drain, serta menyemprotkan pengharum karbol sanitasi agar area hunian/restoran kembali bersih &amp; wangi.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-12 bg-emerald-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Percayakan Sanitasi Pipa Anda pada Teknisi Berstandar K3!</h3>
        <p class="text-emerald-100 mb-6 text-sm sm:text-base">Teknisi kami siap melayani pengerjaan tanpa bongkar &amp; bergaransi 30 hari dengan respon cepat.</p>
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin order pelancaran pipa mampet berstandar K3 & bersih') }}" 
           target="_blank" rel="noopener" 
           class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-emerald-800 font-bold rounded-xl shadow-lg hover:bg-slate-100 transition-all text-sm">
            <span>💬 Hubungi Customer Care K3 (WA 24 Jam)</span>
        </a>
    </div>
</section>
@endsection
