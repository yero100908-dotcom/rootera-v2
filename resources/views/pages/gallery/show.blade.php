@extends('layouts.app')

@php
    $plumbingSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'PlumbingService',
        'name' => 'Rootera Plumbing',
        'image' => $project->display_thumbnail,
        'url' => route('galeri.show', $project->slug),
        'telephone' => '+6281385404000',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Gg. Mawar No.6B.1, Cijantung',
            'addressLocality' => 'Jakarta Timur',
            'addressRegion' => 'DKI Jakarta',
            'postalCode' => '13770',
            'addressCountry' => 'ID',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => -6.3134,
            'longitude' => 106.8625,
        ],
        'areaServed' => $project->related_area_name,
        'description' => $seo['description'] ?? $project->title,
    ];

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Beranda',
                'item' => route('home'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Galeri & Dokumentasi',
                'item' => route('galeri'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $project->title,
                'item' => route('galeri.show', $project->slug),
            ],
        ],
    ];

    $faqSchema = [];
    if (!empty($project->faq_items)) {
        $mainEntity = [];
        foreach ($project->faq_items as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ];
        }
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
        ];
    }
@endphp

@push('head')
<script type="application/ld+json">
{!! json_encode($plumbingSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@if(!empty($faqSchema))
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
@endpush

@section('content')
{{-- HERO & BREADCRUMB HEADER --}}
<div class="relative overflow-hidden bg-gradient-to-br from-[#061434] via-[#081d48] to-[#0b2b64] text-white py-8 sm:py-14">
    {{-- Background Glow Orbs --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        {{-- BREADCRUMBS --}}
        <nav class="text-xs sm:text-sm text-slate-300 mb-4 sm:mb-6 flex flex-wrap items-center gap-1.5" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-teal-300 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('galeri') }}" class="hover:text-teal-300 transition-colors">Galeri & Dokumentasi</a>
            <span class="text-slate-500">/</span>
            <span class="text-white font-medium truncate max-w-[200px] sm:max-w-md">{{ $project->title }}</span>
        </nav>

        {{-- BADGES & METADATA --}}
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="bg-teal-500/20 border border-teal-400/40 text-teal-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                {{ $project->category_label }}
            </span>
            <span class="bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold px-3 py-1 rounded-full">
                ✅ Selesai 100% Bergaransi
            </span>
            <span class="bg-white/10 border border-white/20 text-white text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                📍 {{ $project->related_area_name }}
            </span>
            <span class="bg-amber-500/20 border border-amber-400/30 text-amber-300 text-xs font-medium px-3 py-1 rounded-full">
                🏢 {{ $project->project_client_type }}
            </span>
        </div>

        {{-- TITLE & SUBTITLE --}}
        <h1 class="text-xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight mb-3">
            {{ $project->title }}
        </h1>
        <div class="text-xs sm:text-sm text-slate-300 flex flex-wrap items-center gap-4">
            <span>📅 Dipublikasikan: {{ $project->created_at ? $project->created_at->format('d F Y') : 'Terbaru' }}</span>
            <span>🛡️ Tim Operasional Spesialis Rootera Plumbing</span>
        </div>
    </div>
</div>

{{-- MAIN CONTENT SECTION --}}
<section class="py-8 sm:py-14 bg-slate-50">
    <div class="container max-w-5xl mx-auto px-4 sm:px-6">
        
        {{-- SECTION 1: MEDIA SHOWCASE (VIDEO / COMPARATIVE BEFORE-AFTER / PHOTO) --}}
        <div class="bg-slate-950 rounded-2xl sm:rounded-3xl overflow-hidden border border-slate-800 shadow-2xl mb-8 sm:mb-12">
            @if($project->media_type === 'video' && $project->display_media)
                <div class="relative aspect-video max-h-[520px] bg-black flex items-center justify-center">
                    <video controls playsinline preload="metadata" poster="{{ $project->display_thumbnail }}" class="w-full h-full object-contain">
                        <source src="{{ $project->display_media }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                </div>
            @elseif($project->display_before_image)
                <div class="p-3 sm:p-5 grid grid-cols-1 md:grid-cols-2 gap-4 bg-slate-900">
                    <div class="text-center bg-slate-950 p-2 sm:p-3 rounded-2xl border border-red-500/30">
                        <span class="bg-red-600 text-white text-xs font-extrabold px-3 py-1 rounded-md uppercase mb-2 inline-block shadow">SEBELUM (BEFORE)</span>
                        <div class="aspect-[4/3] overflow-hidden rounded-xl">
                            <img src="{{ $project->display_before_image }}" alt="Sebelum Pengerjaan - {{ $project->title }}" class="w-full h-full object-cover">
                        </div>
                        <p class="text-xs text-slate-400 mt-2 font-medium">Kondisi pipa tersumbat sebelum tindakan</p>
                    </div>
                    <div class="text-center bg-slate-950 p-2 sm:p-3 rounded-2xl border border-emerald-500/30">
                        <span class="bg-emerald-600 text-white text-xs font-extrabold px-3 py-1 rounded-md uppercase mb-2 inline-block shadow">SESUDAH (AFTER)</span>
                        <div class="aspect-[4/3] overflow-hidden rounded-xl">
                            <img src="{{ $project->display_thumbnail }}" alt="Sesudah Pengerjaan - {{ $project->title }}" class="w-full h-full object-cover">
                        </div>
                        <p class="text-xs text-slate-400 mt-2 font-medium">Hasil akhir pembersihan 100% lancar</p>
                    </div>
                </div>
            @else
                <div class="relative aspect-video max-h-[520px] overflow-hidden bg-black flex items-center justify-center">
                    <img src="{{ $project->display_thumbnail }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                </div>
            @endif
        </div>

        {{-- SECTION 2: STUDI KASUS & DETAIL PENANGANAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 sm:mb-12">
            {{-- Tantangan Masalah --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 text-rose-600 font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                        Tantangan Masalah (Problem Statement)
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Kendala Sumbatan di Lapangan</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed whitespace-pre-line">
                        {{ $project->problem_statement }}
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs text-rose-700 bg-rose-50 p-3 rounded-xl font-medium">
                    <span>⚠️</span> Berpotensi meluap & merusak struktur jika tidak ditangani segera.
                </div>
            </div>

            {{-- Solusi & Hasil --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 text-emerald-600 font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        Solusi & Eksekusi Teknisi (Solution & Action)
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Tindakan Tanpa Bongkar</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ $project->solution_and_action }}
                    </p>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs text-emerald-700 bg-emerald-50 p-3 rounded-xl font-medium">
                    <span>✅</span> Hasil akhir: Aliran pipa kembali normal 100% lancar & teruji garansi 30 hari.
                </div>
            </div>
        </div>

        {{-- SECTION 3: STANDAR TEKNOLOGI & PERALATAN CANGGIH --}}
        <x-equipment-showcase class="mb-8 sm:mb-12" />

        {{-- SECTION 4: SPESIALISASI TIPE PROPERTI --}}
        <div class="bg-gradient-to-r from-slate-900 to-[#0b2b64] text-white p-6 sm:p-8 rounded-2xl shadow-xl mb-8 sm:mb-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="max-w-xl">
                <span class="bg-teal-400/20 text-teal-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2 inline-block">
                    🏢 Kompatibilitas Properti
                </span>
                <h3 class="text-lg sm:text-2xl font-bold mb-2 text-white">Spesialis Penanganan {{ $project->project_client_type }}</h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Kami melayani perbaikan pipa mampet untuk skala hunian pribadi, bisnis F&B restoran, ruko perkantoran, hingga kawasan industri manufaktur di seluruh wilayah operasional.
                </p>
            </div>
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh penanganan pelancar pipa untuk tipe bangunan: ' . $project->project_client_type) }}" target="_blank" rel="noopener noreferrer" class="shrink-0 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm px-6 py-3.5 rounded-xl shadow-lg transition-all hover:scale-105">
                💬 Konsultasi Properti Anda →
            </a>
        </div>

        {{-- SECTION 5: INTERNAL LINK AREA - PANGGIL TEKNISI TERDEKAT --}}
        <div class="bg-blue-50 border border-blue-200/80 p-6 sm:p-8 rounded-2xl mb-8 sm:mb-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-md">
                    📍
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-slate-900 mb-1">
                        Butuh Teknisi Pelancar Pipa di Area {{ $project->related_area_name }}?
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Tim teknisi Rootera Plumbing siap meluncur ke lokasi Anda di {{ $project->related_area_name }} dengan respon cepat 24 jam & garansi resmi 30 hari.
                    </p>
                </div>
            </div>
            <a href="{{ $project->related_area_url }}" class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm px-5 py-3 rounded-xl transition-all shadow-md flex items-center gap-1.5">
                <span>Lihat Area {{ $project->related_area_name }}</span> →
            </a>
        </div>

        {{-- SECTION 6: LAYANAN TERKAIT LAINNYA (INTERNAL LINK SERVICE) --}}
        <div class="mb-8 sm:mb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900">🛠️ Layanan Pipa & Sanitasi Terkait</h3>
                    <p class="text-xs sm:text-sm text-slate-500">Solusi tuntas masalah saluran pembuangan lainnya dari Rootera Plumbing.</p>
                </div>
                <a href="{{ route('layanan') }}" class="text-xs sm:text-sm text-blue-600 hover:text-blue-800 font-bold hidden sm:block">
                    Lihat Semua Layanan →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-2">🚰</div>
                        <h4 class="text-sm font-bold text-slate-900 mb-1">Jasa Pipa Wastafel & Sink</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Pelancaran afur cuci piring & wastafel dapur dari gumpalan lemak membeku.</p>
                    </div>
                    <a href="{{ route('layanan.show', 'wastafel-mampet') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        <span>Selengkapnya</span> →
                    </a>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-2">🚿</div>
                        <h4 class="text-sm font-bold text-slate-900 mb-1">Floor Drain Kamar Mandi</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Pembersihan saringan & saluran pembuangan mandi tersumbat rambut & sabun.</p>
                    </div>
                    <a href="{{ route('layanan.show', 'kamar-mandi-mampet') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        <span>Selengkapnya</span> →
                    </a>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <div class="text-2xl mb-2">🚽</div>
                        <h4 class="text-sm font-bold text-slate-900 mb-1">Pelancaran Kloset & Toilet</h4>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Penanganan kloset meluap atau tersumbat tisu/benda asing tanpa bongkar mangkuk.</p>
                    </div>
                    <a href="{{ route('layanan.show', 'wc-toilet-mampet') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        <span>Selengkapnya</span> →
                    </a>
                </div>
            </div>
        </div>

        {{-- SECTION 7: 🏷️ TAG WILAYAH & KATA KUNCI TERKAIT (DYNAMIC INTERNAL LINKING) --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm mb-8 sm:mb-12">
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl">🏷️</span>
                <h3 class="text-base sm:text-lg font-bold text-slate-900">Tag Wilayah & Kata Kunci Pencarian Populer</h3>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mb-4 leading-relaxed">
                Eksplorasi jangkauan area & kata kunci terkait di kawasan <span class="font-bold text-slate-700">{{ $project->related_area_name }}</span>:
            </p>
            <div class="flex flex-wrap gap-2">
                @foreach($project->popular_tags as $tag)
                <a href="{{ $tag['url'] }}" class="rounded-full border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium px-3.5 py-1.5 shadow-sm hover:border-emerald-500 hover:text-emerald-600 hover:bg-emerald-50/50 transition-all duration-200 inline-flex items-center gap-1">
                    <span>📍</span> {{ $tag['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- SECTION 8: FAQ RELEVAN --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm mb-8 sm:mb-12">
            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-4">❓ Pertanyaan Sering Diajukan (FAQ)</h3>
            <div class="space-y-3" id="faq-accordion">
                @foreach($project->faq_items as $index => $faq)
                <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors">
                    <button type="button" onclick="toggleFaq({{ $index }})" class="w-full p-4 text-left font-bold text-xs sm:text-sm text-slate-800 flex items-center justify-between bg-slate-50 hover:bg-slate-100 transition-colors">
                        <span>{{ $faq['q'] }}</span>
                        <span id="faq-icon-{{ $index }}" class="text-base font-semibold text-slate-500 ml-2">+</span>
                    </button>
                    <div id="faq-body-{{ $index }}" class="hidden p-4 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 bg-white">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- SECTION 9: RELATED PROJECTS (DOKUMENTASI KATEGORI TERKAIT) --}}
        @if($relatedProjects->isNotEmpty())
        <div>
            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-4">📸 Dokumentasi Proyek Terkait Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProjects as $rel)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-lg transition-all flex flex-col h-full group">
                    <a href="{{ route('galeri.show', $rel->slug) }}" class="block aspect-[16/9] overflow-hidden relative bg-slate-950">
                        <img src="{{ $rel->display_thumbnail }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="p-4 flex flex-col flex-grow justify-between">
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 line-clamp-2 mb-2 leading-snug group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('galeri.show', $rel->slug) }}">
                                {{ $rel->title }}
                            </a>
                        </h4>
                        <a href="{{ route('galeri.show', $rel->slug) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 mt-auto">
                            <span>Detail Proyek</span> →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

{{-- STICKY FLOATING CTA (MOBILE-FRIENDLY) --}}
<div class="fixed bottom-4 left-4 right-4 z-50 md:hidden">
    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi mengenai pengerjaan proyek serupa: ' . $project->title) }}" target="_blank" rel="noopener noreferrer" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm py-3 px-4 rounded-2xl shadow-2xl flex items-center justify-center gap-2 backdrop-blur-md">
        <span class="text-lg">💬</span>
        <span>Konsultasi Kasus Serupa via WhatsApp</span>
    </a>
</div>
@endsection

@push('scripts')
<script>
function toggleFaq(index) {
    const body = document.getElementById(`faq-body-${index}`);
    const icon = document.getElementById(`faq-icon-${index}`);
    
    if (body.classList.contains('hidden')) {
        body.classList.remove('hidden');
        icon.textContent = '−';
    } else {
        body.classList.add('hidden');
        icon.textContent = '+';
    }
}
</script>
@endpush
