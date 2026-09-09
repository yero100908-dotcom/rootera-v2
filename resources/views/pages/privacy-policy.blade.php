@extends('layouts.app')

@section('meta_title', 'Kebijakan Privasi Data | Rootera Plumbing (J&J Group)')
@section('meta_description', 'Informasi regulasi privasi data pelanggan sesuai UU PDP Indonesia serta ketentuan pemesanan jasa pelancaran saluran pipa Rootera Plumbing.')
@section('meta_keywords', 'kebijakan privasi rootera plumbing, perlindungan data UU PDP 27/2022, data officer rootera, privacy policy sanitasi')
@section('canonical', url('/privacy-policy'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Kebijakan Privasi Data | Rootera Plumbing (J&J Group)',
    'description' => 'Informasi regulasi privasi data pelanggan sesuai UU PDP Indonesia serta ketentuan pemesanan jasa pelancaran saluran pipa Rootera Plumbing.',
    'url' => url('/privacy-policy'),
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Rootera Plumbing (J&J Group)',
        'logo' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
    ],
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Privacy Policy', 'item' => url('/privacy-policy')]
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
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Privacy Policy</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🔒 Perlindungan Data Pribadi Pelanggan
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                Privacy Policy <span class="text-emerald-400">(Kebijakan Privasi)</span>
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Komitmen perlindungan data pribadi &amp; kerahasiaan informasi pelanggan Rootera Plumbing (UU PDP Indonesia No. 27/2022).
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 text-slate-700 text-sm leading-relaxed">
        
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
            <p class="font-medium text-slate-800">
                <strong>Rootera Plumbing</strong> (J&amp;J Group) sangat menghargai privasi dan perlindungan data pribadi pelanggan kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda sesuai dengan ketentuan <strong>Undang-Undang Pelindungan Data Pribadi (UU PDP No. 27 Tahun 2022)</strong> di Republik Indonesia.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">1. Informasi yang Kami Kumpulkan</h2>
            <p class="mb-3">Kami mengumpulkan informasi yang diperlukan untuk pemrosesan order dan pengiriman teknisi ke lokasi Anda, meliputi:</p>
            <ul class="list-disc pl-5 space-y-1.5">
                <li>Nama pemesan / penanggung jawab lokasi.</li>
                <li>Nomor telepon dan WhatsApp aktif.</li>
                <li>Alamat lengkap lokasi pengerjaan (hunian, ruko, restoran, pabrik).</li>
                <li>Data NPWP, SPPKP, dan email finance (khusus permintaan Faktur Pajak B2B).</li>
                <li>Dokumentasi foto/video masalah saluran (bila dikirimkan sukarela oleh pelanggan untuk estimasi).</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">2. Penggunaan Informasi Pelanggan</h2>
            <p class="mb-2">Informasi yang dikumpulkan hanya digunakan untuk kepentingan:</p>
            <ul class="list-disc pl-5 space-y-1.5">
                <li>Menugaskan teknisi terdekat ke alamat pengerjaan pelanggan.</li>
                <li>Penerbitan Digital Invoice, e-Faktur PPN, dan klaim garansi 30 hari.</li>
                <li>Menghubungi pelanggan untuk konfirmasi kedatangan teknisi dan evaluasi kepuasan.</li>
                <li>Pemberitahuan informasi perawatan berkala (hanya jika disetujui pelanggan).</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">3. Kerahasiaan &amp; Perlindungan Data</h2>
            <p class="mb-3">Rootera Plumbing menjamin bahwa <strong>data pribadi Anda TIDAK AKAN PERNAH dijual, disewakan, atau dibagikan kepada pihak ketiga manapun</strong> untuk kepentingan komersial di luar ekosistem operasional Rootera Plumbing &amp; J&amp;J Group.</p>
            <p>Seluruh data transaksi dan alamat tersimpan secara aman dalam database terlindungi dengan sistem keamanan terenkripsi.</p>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">4. Hak Pemilik Data Pribadi</h2>
            <p class="mb-2">Sesuai UU PDP, Anda memiliki hak penuh untuk:</p>
            <ul class="list-disc pl-5 space-y-1.5">
                <li>Mengakses dan memperbarui data kontak yang terdaftar di sistem kami.</li>
                <li>Meminta penghapusan (delete account/data) dari daftar kontak promosi kami.</li>
                <li>Meminta konfirmasi status garansi dan rekapan invoice transaksi Anda.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">5. Kontak Resmi Petugas Data Privasi</h2>
            <p class="mb-2">Apabila Anda memiliki pertanyaan seputar kebijakan privasi data pribadi ini, silakan hubungi tim Data Officer kami:</p>
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-xs sm:text-sm space-y-1 font-medium">
                <div><strong>Rootera Plumbing Data Office (J&amp;J Group)</strong></div>
                <div>Email: rootera.plumbing@gmail.com</div>
                <div>WhatsApp Data Officer: +62 813-8540-4000</div>
                <div>Alamat: Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Jakarta Timur 13770</div>
            </div>
        </div>

    </div>
</section>
@endsection
