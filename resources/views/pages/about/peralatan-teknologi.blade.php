@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-b from-slate-900 via-blue-950 to-slate-900 text-white pt-12 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400">Standar Peralatan & Teknologi</span>
        </nav>
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🛠️ Peralatan Modern Tanpa Bongkar
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6">
                Armada Peralatan <span class="text-emerald-400">Teknologi Modern Ridgid & Hydro-Jetting</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Rootera Plumbing mengadopsi standar peralatan plumbing mutakhir berstandar internasional yang dirancang khusus untuk melancarkan saluran mampet tanpa membongkar struktur keramik dan beton.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-equipment-showcase />
    </div>
</section>

{{-- FAQ Peralatan --}}
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Keunggulan Metode Mekanis Modern</h2>
            <p class="text-slate-600 mt-2">Mengapa peralatan modern Rootera jauh lebih unggul dibandingkan metode manual atau kimia korosif.</p>
        </div>
        <div class="space-y-4">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h4 class="font-bold text-slate-900 text-lg">Apakah Kabel Spiral Mesin Ridgid Berisiko Merusak Pipa PVC?</h4>
                <p class="text-slate-600 mt-2 text-sm">Tidak. Kabel spiral baja fleksibel kami dirancang khusus meliuk mengkuti lekukan pipa tanpa merusak atau mengikis lapisan dinding pipa PVC rumah tangga maupun pipa industri.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <h4 class="font-bold text-slate-900 text-lg">Kapan Hydro Jetting Diperlukan?</h4>
                <p class="text-slate-600 mt-2 text-sm">Hydro Jetting (tekanan air hingga 300 Bar) digunakan pada kasus lemak jenuh mengeras di restoran, sedimen pasir/lumpur padat, serta pipa pembuangan diameter besar (4-12 inci) agar bersih 100% seperti pipa baru.</p>
            </div>
        </div>
    </div>
</section>
@endsection
