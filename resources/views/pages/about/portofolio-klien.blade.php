@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-b from-slate-900 via-blue-950 to-slate-900 text-white pt-12 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400">Portofolio & Klien B2B</span>
        </nav>
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                💼 Kepercayaan Klien Komersial & B2B
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6">
                Klien & Portofolio <span class="text-emerald-400">Proyek Komersial & Industri</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Dipercaya oleh ratusan pelaku bisnis F&B, pengelola gedung, kawasan industri, hingga instansi BUMN dalam menjaga kelancaran sistem sanitasi & drainase.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Studi Kasus & Dokumentasi Pekerjaan Terkini</h2>
            <p class="text-slate-600 mt-2">Lihat secara transparan bagaimana tim teknisi Rootera menyelesaikan kendala pipa tersumbat.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($projects as $item)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-md hover:shadow-xl transition-all duration-300">
                <div class="aspect-video overflow-hidden relative">
                    <img src="{{ $item->main_image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    <span class="absolute top-3 left-3 px-3 py-1 bg-emerald-600 text-white text-xs font-bold rounded-full">
                        {{ $item->category }}
                    </span>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-slate-400 text-xs mb-2">
                        <span>📍 {{ $item->city_location ?? 'Jabodetabek' }}</span>
                        <span>•</span>
                        <span>🏢 {{ $item->project_type ?? 'Komersial' }}</span>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg mb-2 line-clamp-2">{{ $item->title }}</h3>
                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $item->problem_statement }}</p>
                    <a href="{{ route('galeri.show', $item->slug) }}" class="inline-flex items-center gap-1.5 text-emerald-600 font-bold text-sm hover:text-emerald-700">
                        Lihat Studi Kasus Selengkapnya &rarr;
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-slate-500">
                <p>Dokumentasi proyek komersial sedang diperbarui.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-slate-900 text-white font-bold rounded-full hover:bg-slate-800 transition-all">
                🖼️ Lihat Seluruh Galeri & Dokumentasi
            </a>
        </div>
    </div>
</section>
@endsection
