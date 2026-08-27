@extends('layouts.app')

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $seo['title'] ?? 'Peralatan & Teknologi Modern - Rootera Plumbing',
    'description' => $seo['description'] ?? '',
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Peralatan & Teknologi', 'item' => url('/tentang-kami/peralatan-teknologi')]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Peralatan &amp; Teknologi</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🛠️ Peralatan Modern Tanpa Bongkar
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Armada Peralatan &amp; <span class="text-emerald-400">Teknologi Ridgid &amp; Hydro Jetting</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Katalog spesifikasi resmi teknologi pelancaran pipa tersumbat berstandar internasional yang aman bagi saluran PVC, cast iron, dan struktur semen properti Anda.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Technical Specs Comparison Table --}}
        <div class="mb-16">
            <div class="text-center max-w-2xl mx-auto mb-8">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Perbandingan Alat Utama</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Spesifikasi Teknis Peralatan Rootera</h2>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm">
                <table class="w-full text-left text-xs sm:text-sm text-slate-700 border-collapse">
                    <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                        <tr>
                            <th class="p-4">Jenis Peralatan</th>
                            <th class="p-4">Tipe &amp; Brand</th>
                            <th class="p-4">Spesifikasi Utama</th>
                            <th class="p-4">Peruntukan Utama</th>
                            <th class="p-4">Keunggulan Utama</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-bold text-slate-900 flex items-center gap-2">
                                <span>🌀</span> Mesin Spiral Cable
                            </td>
                            <td class="p-4 font-semibold text-emerald-700">Ridgid K-50 / K-60 (USA)</td>
                            <td class="p-4">Kabel baja fleksibel 5/8"-7/8", rotasi 400 RPM</td>
                            <td class="p-4">Wastafel, floor drain, kloset, pipa 2-4 inci</td>
                            <td class="p-4 text-emerald-700 font-semibold">Memotong akar &amp; rambut tanpa merusak PVC</td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-bold text-slate-900 flex items-center gap-2">
                                <span>📷</span> Micro CCTV Pipe Camera
                            </td>
                            <td class="p-4 font-semibold text-blue-700">SeeSnake Flex HD 1080p</td>
                            <td class="p-4">Lensa IP68 Waterproof + Sonde frequency locator</td>
                            <td class="p-4">Inspeksi awal &amp; deteksi kebocoran dalam dinding</td>
                            <td class="p-4 text-blue-700 font-semibold">Akurasi posisi mampet 99.9% tanpa galian</td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-bold text-slate-900 flex items-center gap-2">
                                <span>🌊</span> High Pressure Hydro Jetting
                            </td>
                            <td class="p-4 font-semibold text-purple-700">Jet-Clean Pro 300 Bar</td>
                            <td class="p-4">Nozzle jetting rotasi 360°, debit 40L/menit</td>
                            <td class="p-4">Grease trap restoran, pipa industri 4-12 inci</td>
                            <td class="p-4 text-purple-700 font-semibold">Mengikis kerak lemak jenuh &amp; pasir 100% bersih</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Equipment Showcase Component --}}
        <x-equipment-showcase />
    </div>
</section>

{{-- FAQ Peralatan --}}
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">Keunggulan Metode Mekanis Modern</h2>
            <p class="text-slate-600 mt-2 text-sm sm:text-base">Mengapa peralatan modern Rootera jauh lebih unggul dibandingkan metode manual atau kimia korosif.</p>
        </div>
        <div class="space-y-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-900 text-base sm:text-lg">Apakah Kabel Spiral Mesin Ridgid Berisiko Merusak Pipa PVC?</h3>
                <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Tidak. Kabel spiral baja fleksibel kami dirancang khusus meliuk mengikuti lekukan pipa tanpa merusak atau mengikis lapisan dinding pipa PVC rumah tangga maupun pipa industri.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-900 text-base sm:text-lg">Kapan Hydro Jetting Diperlukan?</h3>
                <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Hydro Jetting (tekanan air hingga 300 Bar) digunakan pada kasus lemak jenuh mengeras di restoran, sedimen pasir/lumpur padat, serta pipa pembuangan diameter besar (4-12 inci) agar bersih 100% seperti pipa baru.</p>
            </div>
        </div>
    </div>
</section>
@endsection
