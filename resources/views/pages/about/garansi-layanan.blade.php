@extends('layouts.app')

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $seo['title'] ?? 'Jaminan & Kebijakan Garansi 30 Hari - Rootera Plumbing',
    'description' => $seo['description'] ?? '',
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Garansi Layanan', 'item' => url('/tentang-kami/garansi-layanan')]
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
            <span class="text-emerald-400 font-semibold">Garansi &amp; Kebijakan Service</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🛡️ Jaminan Kepuasan &amp; Proteksi Pelanggan
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Garansi Pengerjaan Resmi <span class="text-emerald-400">Hingga 30 Hari</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Kami memberikan garansi tertulis resmi untuk setiap pengerjaan pelancaran pipa tersumbat. Jika terjadi sumbatan ulang pada titik yang sama dalam masa garansi, teknisi kami akan datang kembali tanpa biaya tambahan.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 3 Key Guarantee Pillars --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">100%</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Tuntas Baru Bayar</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Jika saluran air tidak lancar sesuai standar uji alur debit, Anda tidak dikenakan biaya pengerjaan sama sekali.</p>
            </div>
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">30D</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Garansi Pengerjaan 30 Hari</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Masa proteksi garansi pengerjaan ulang gratis jika terjadi mampet susulan di titik saluran yang sama.</p>
            </div>
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">SOP</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Nota &amp; Kartu Garansi Digital</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Setiap pelanggan menerima bukti transaksi digital/fisik berstempel resmi Rootera Plumbing.</p>
            </div>
        </div>

        {{-- Terms & Conditions Box --}}
        <div class="bg-slate-900 text-white rounded-3xl p-8 sm:p-12 shadow-2xl relative overflow-hidden mb-12">
            <h2 class="text-2xl font-bold text-emerald-400 mb-6 font-['Plus_Jakarta_Sans',sans-serif]">Ketentuan &amp; Syarat Klaim Garansi Rootera</h2>
            <ul class="space-y-4 text-slate-300 text-sm sm:text-base">
                <li class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold text-lg">✓</span>
                    <span><strong>Cakupan Garansi:</strong> Berlaku khusus untuk titik pengerjaan pipa &amp; jenis sumbatan yang telah dilancarkan oleh teknisi Rootera.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold text-lg">✓</span>
                    <span><strong>Prosedur Klaim Mudah:</strong> Cukup hubungi customer care WhatsApp dengan menyebutkan nomor WhatsApp terdaftar saat pemesanan awal.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold text-lg">✓</span>
                    <span><strong>Pengecualian Klaim:</strong> Garansi tidak mencakup kerusakan fisik pipa pecah karena kelapukan usia bangunan tua atau sampah padat besar yang disengaja dimasukkan pasca pengerjaan.</span>
                </li>
            </ul>
        </div>

        {{-- Quick Claim CTA --}}
        <div class="text-center bg-emerald-50 border border-emerald-200 rounded-2xl p-8">
            <h3 class="text-xl font-bold text-slate-900 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Ada Kendala Pasca Pengerjaan?</h3>
            <p class="text-slate-600 text-sm mb-6">Tim dispatch kami siap menjadwalkan kedatangan teknisi garansi dalam 1x24 jam.</p>
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin mengklaim garansi pengerjaan pipa') }}" 
               target="_blank" rel="noopener" 
               class="inline-flex items-center gap-2 px-8 py-3.5 bg-emerald-600 text-white font-bold text-sm rounded-xl shadow-md hover:bg-emerald-500 transition-all">
                <span>💬 Ajukan Klaim Garansi via WhatsApp</span>
            </a>
        </div>

    </div>
</section>
@endsection
