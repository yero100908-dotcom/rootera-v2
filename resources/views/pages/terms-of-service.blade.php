@extends('layouts.app')

@section('meta_title', 'Syarat & Ketentuan Layanan | Rootera Plumbing (J&J Group)')
@section('meta_description', 'Informasi regulasi privasi data pelanggan sesuai UU PDP Indonesia serta ketentuan pemesanan jasa pelancaran saluran pipa Rootera Plumbing.')
@section('meta_keywords', 'syarat ketentuan rootera plumbing, terms of service pelancaran pipa, garansi tuntas 30 hari, regulasi jasa pipa mampet')
@section('canonical', url('/terms-of-service'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Syarat & Ketentuan Layanan | Rootera Plumbing (J&J Group)',
    'description' => 'Informasi regulasi privasi data pelanggan sesuai UU PDP Indonesia serta ketentuan pemesanan jasa pelancaran saluran pipa Rootera Plumbing.',
    'url' => url('/terms-of-service'),
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Rootera Plumbing (J&J Group)',
        'logo' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
    ],
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Terms of Service', 'item' => url('/terms-of-service')]
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
            <span class="text-emerald-400 font-semibold">Terms of Service</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                📜 Regulasi &amp; Syarat Operasional
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                Terms of Service <span class="text-emerald-400">(Ketentuan Layanan)</span>
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                Syarat dan ketentuan operasional pengerjaan jasa pelancaran pipa mampet Rootera Plumbing (J&amp;J Group).
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 text-slate-700 text-sm leading-relaxed">
        
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
            <p class="font-medium text-slate-800">
                Selamat datang di situs resmi <strong>Rootera Plumbing</strong> (divisi teknikal sanitasi di bawah naungan <strong>J&amp;J Group</strong>). Dengan mengakses, memesan, atau menggunakan jasa pelancaran pipa mampet kami, Anda dianggap telah membaca, memahami, dan menyetujui seluruh Ketentuan Layanan di bawah ini.
            </p>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">1. Cakupan Layanan &amp; Metode Pengerjaan</h2>
            <p class="mb-3">Rootera Plumbing menyediakan jasa perbaikan dan pelancaran pipa mampet (wastafel, kloset/WC, floor drain kamar mandi, got pembuangan, serta riser vertikal) menggunakan metode mekanis non-konstruksi (tanpa bongkar keramik/dinding) seperti mesin kabel spiral baja Ridgid, kamera inspeksi CCTV 1080p, dan Hydro-jetting air bertekanan tinggi 300 Bar.</p>
            <p>Seluruh pengerjaan dilakukan oleh teknisi resmi berkualifikasi dengan standar APD K3 dan prinsip bebas penggunaan bahan kimia korosif berbahaya.</p>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">2. Prosedur Pemesanan (Booking) &amp; Estimasi Harga</h2>
            <ul class="list-disc pl-5 space-y-2">
                <li>Pemesanan jasa dilakukan melalui Customer Service resmi via telepon atau WhatsApp ke nomor <strong>+62 813-8540-4000</strong>.</li>
                <li>Estimasi harga pengerjaan disampaikan secara transparan sebelum teknisi meluncur atau saat inspeksi awal di lokasi.</li>
                <li>Rootera mengusung skema <strong>Tuntas Baru Bayar (No Result No Pay)</strong>. Jika saluran gagal dilancarkan sesuai standar uji air, pelanggan tidak dikenakan biaya pengerjaan.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">3. Ketentuan Pembayaran &amp; Invoice Digital</h2>
            <ul class="list-disc pl-5 space-y-2">
                <li>Pembayaran dapat dilakukan secara tunai kepada teknisi di lokasi atau transfer bank resmi atas nama PT/CV J&amp;J Group / rekening resmi perusahaan yang terkonfirmasi oleh CS.</li>
                <li>Setiap transaksi yang tuntas akan diterbitkan <strong>Digital Invoice resmi berstempel Rootera</strong> yang dikirimkan ke nomor WhatsApp terdaftar.</li>
                <li>Untuk klien B2B/Korporat, permintaan Faktur Pajak PPN 11% dapat diajukan melampirkan NPWP &amp; SPPKP perusahaan.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">4. Ketentuan Garansi Resmi 30 Hari</h2>
            <ul class="list-disc pl-5 space-y-2">
                <li>Pengerjaan Rootera dilindungi garansi resmi hingga <strong>30 hari kalender</strong> sejak tanggal pengerjaan selesai.</li>
                <li>Klaim garansi berlaku apabila saluran yang dikerjakan mengalami mampet kembali pada titik lokasi pipa yang sama.</li>
                <li>Garansi tidak berlaku jika mampet disebabkan oleh pergeseran/kerusakan fisik struktur tanah (pipa pecah/ambles) atau benda asing keras baru yang sengaja dimasukkan pasca pengerjaan.</li>
                <li>Klaim garansi diajukan melalui CS WA dengan menyebutkan nomor WA / invoice terdaftar. Respon kedatangan kunjungan ulang teknisi dijadwalkan &lt; 24 jam kerja.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">5. Pembatalan Order (Cancellation Policy)</h2>
            <p>Pelanggan berhak melakukan pembatalan order pemesanan tanpa denda dengan mengonfirmasikan kepada CS minimal 1 jam sebelum jadwal armada teknisi berangkat ke lokasi.</p>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">6. Kontak Resmi &amp; Penanganan Keluhan</h2>
            <p class="mb-2">Jika Anda memiliki pertanyaan atau keluhan mengenai Ketentuan Layanan ini, silakan hubungi pusat bantuan kami:</p>
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 text-xs sm:text-sm space-y-1 font-medium">
                <div><strong>Rootera Plumbing (J&amp;J Group)</strong></div>
                <div>Alamat: Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Pasar Rebo, Jakarta Timur 13770</div>
                <div>WhatsApp CS 24 Jam: +62 813-8540-4000</div>
                <div>Email: rootera.plumbing@gmail.com</div>
            </div>
        </div>

    </div>
</section>
@endsection
