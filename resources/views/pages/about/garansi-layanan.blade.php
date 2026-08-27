@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-b from-slate-900 via-blue-950 to-slate-900 text-white pt-12 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400">Garansi & Kebijakan Service</span>
        </nav>
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🛡️ Jaminan Kepuasan & Proteksi Pelanggan
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6">
                Garansi Pengerjaan Resmi <span class="text-emerald-400">Hingga 30 Hari</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Kami memberikan garansi tertulis untuk setiap pengerjaan pelancaran pipa tersumbat. Jika terjadi sumbatan ulang pada titik yang sama dalam masa garansi, teknisi kami akan datang kembali tanpa tambahan biaya.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">100%</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2">Tuntas atau Gratis</h3>
                <p class="text-slate-600 text-sm">Jika saluran air tidak lancar sesuai standar uji alur debit, Anda tidak dikenakan biaya pengerjaan.</p>
            </div>
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">30D</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2">Garansi Pengerjaan</h3>
                <p class="text-slate-600 text-sm">Masa proteksi garansi pengerjaan ulang gratis jika terjadi mampet susulan di titik saluran yang sama.</p>
            </div>
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">SOP</div>
                <h3 class="font-bold text-slate-900 text-lg mb-2">Nota & Kartu Garansi Resmi</h3>
                <p class="text-slate-600 text-sm">Setiap pelanggan menerima bukti transaksi digital/fisik berstempel resmi Rootera Plumbing.</p>
            </div>
        </div>

        <div class="bg-slate-900 text-white rounded-3xl p-8 sm:p-12 shadow-2xl relative overflow-hidden">
            <h2 class="text-2xl font-bold text-emerald-400 mb-4">Ketentuan & Syarat Klaim Garansi</h2>
            <ul class="space-y-4 text-slate-300 text-sm sm:text-base">
                <li class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <span>Klaim berlaku untuk titik lokasi pipa dan jenis sumbatan yang telah dikerjakan oleh teknisi Rootera.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <span>Pelanggan dapat menunjukkan bukti invoice/nota digital atau nomor WhatsApp terdaftar saat order awal.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <span>Garansi tidak mencakup kerusakan fisik pipa akibat kelapukan usia pipa bangunan lama atau masukkan sampah padat besar yang disengaja.</span>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection
