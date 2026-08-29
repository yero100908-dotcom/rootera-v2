@extends('layouts.app')

@section('schema-markup')
<?php
$techSchema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Peralatan & Teknologi', 'item' => url('/tentang-kami/peralatan-teknologi')],
                ['@type' => 'ListItem', 'position' => 4, 'name' => $technology->tool_name, 'item' => url('/peralatan-teknologi/' . $technology->slug)]
            ]
        ],
        [
            '@type' => 'Product',
            '@id' => url('/peralatan-teknologi/' . $technology->slug) . '#product',
            'name' => $technology->tool_name,
            'image' => [$technology->image_url],
            'description' => $technology->description ?? $technology->main_advantage,
            'brand' => [
                '@type' => 'Brand',
                'name' => $technology->type_brand ?? 'Rootera Plumbing'
            ],
            'offers' => [
                '@type' => 'AggregateOffer',
                'priceCurrency' => 'IDR',
                'lowPrice' => '350000',
                'offerCount' => '1',
                'priceValidUntil' => '2027-12-31',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'Rootera Plumbing'
                ]
            ]
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Apakah ' . $technology->tool_name . ' berisiko merusak pipa PVC?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Sama sekali tidak. ' . $technology->tool_name . ' bekerja dengan metode mekanis presisi yang dirancang khusus fleksibel meliuk di alur pipa tanpa merusak sambungan PVC atau struktur lantai.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Berapa lama estimasi pengerjaan saluran mampet dengan ' . $technology->tool_name . '?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Rata-rata pengerjaan membutuhkan waktu 30 hingga 60 menit tergantung pada tingkat keparahan sumbatan lemak, kerak, atau akar pohon di dalam pipa.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apakah pengerjaan menggunakan ' . $technology->tool_name . ' disertai garansi resmi?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Ya, seluruh pengerjaan oleh teknisi Rootera dilindungi Garansi Tuntas 30 Hari tertulis resmi.'
                    ]
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($techSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- 1. HERO SECTION --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="hover:text-emerald-400 transition-colors">Peralatan &amp; Teknologi</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold line-clamp-1">{{ $technology->tool_name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-12 items-center">
            {{-- Left Content --}}
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider backdrop-blur-md">
                    ✓ {{ $technology->badge_text ?? 'ALAT RESMI ROOTERA' }}
                </div>

                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight font-['Plus_Jakarta_Sans',sans-serif]">
                    {{ $technology->tool_name }}
                </h1>
                
                <p class="text-emerald-400 font-bold text-sm sm:text-lg">
                    Tipe &amp; Brand: <span class="text-white">{{ $technology->type_brand ?? 'Standar Internasional' }}</span>
                </p>

                <p class="text-slate-300 text-xs sm:text-base leading-relaxed">
                    {{ $technology->description ?? ($technology->tool_name . ' merupakan unit spesialis pelancar pipa mampet dengan ' . $technology->main_spec . ' yang bekerja presisi tanpa membongkar keramik.') }}
                </p>

                {{-- Quick Spec Badges --}}
                <div class="pt-4 grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                    <div class="p-3 bg-slate-800/70 rounded-xl border border-slate-700/80">
                        <span class="block text-[10px] text-slate-400 uppercase font-semibold">Target Pipa</span>
                        <span class="text-xs sm:text-sm font-bold text-white line-clamp-1">{{ $technology->pipe_target ?? 'Wastafel & Floor Drain' }}</span>
                    </div>
                    <div class="p-3 bg-slate-800/70 rounded-xl border border-slate-700/80">
                        <span class="block text-[10px] text-slate-400 uppercase font-semibold">Spesifikasi Utm.</span>
                        <span class="text-xs sm:text-sm font-bold text-emerald-400 line-clamp-1">{{ $technology->main_spec ?? 'Unit Mekanis' }}</span>
                    </div>
                    <div class="p-3 bg-slate-800/70 rounded-xl border border-slate-700/80 col-span-2 sm:col-span-1">
                        <span class="block text-[10px] text-slate-400 uppercase font-semibold">Jaminan Keamanan</span>
                        <span class="text-xs sm:text-sm font-bold text-cyan-400 line-clamp-1">100% Tanpa Bongkar</span>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-4 flex flex-col sm:flex-row gap-3">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin konsultasi penanganan pipa mampet menggunakan ' . $technology->tool_name) }}" target="_blank" class="bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm py-3.5 px-7 rounded-full flex items-center justify-center gap-2 transition-all shadow-md hover:-translate-y-0.5">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <span>Konsultasi Penanganan Alat Ini</span>
                    </a>
                    <a href="tel:081385404000" class="bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs sm:text-sm py-3.5 px-6 rounded-full border border-slate-700 transition-all flex items-center justify-center gap-2">
                        📞 Telepon Langsung 24 Jam
                    </a>
                </div>
            </div>

            {{-- Right Photo Frame --}}
            <div class="lg:col-span-5">
                <div class="relative rounded-3xl overflow-hidden border-2 border-slate-700/80 shadow-2xl bg-slate-900 group">
                    <img src="{{ $technology->image_url }}" alt="{{ $technology->tool_name }} - Rootera Plumbing" class="w-full aspect-[4/3] object-cover group-hover:scale-105 transition-transform duration-500" loading="eager" width="600" height="450">
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-transparent p-4 sm:p-5 flex items-center justify-between">
                        <span class="text-xs font-bold text-white flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            Unit Siap Meluncur 24 Jam
                        </span>
                        <span class="text-[11px] font-semibold text-emerald-400 bg-emerald-950/80 px-2.5 py-0.5 rounded-full border border-emerald-500/30">
                            Garansi 30 Hari
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 2. SECTION 1: DATA SHEET & SPESIFIKASI TEKNIS --}}
<section class="py-14 sm:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Spesifikasi Resmi</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Data Sheet Teknis {{ $technology->tool_name }}</h2>
        </div>

        <div class="bg-slate-50 rounded-3xl border border-slate-200 overflow-hidden shadow-xs">
            <table class="w-full text-left text-xs sm:text-sm text-slate-700 border-collapse">
                <tbody class="divide-y divide-slate-200">
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 w-1/3 bg-slate-100/50">Nama Peralatan</td>
                        <td class="p-4 sm:p-5 font-semibold text-slate-900">{{ $technology->tool_name }}</td>
                    </tr>
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Brand &amp; Seri Tipe</td>
                        <td class="p-4 sm:p-5 font-semibold text-emerald-700">{{ $technology->type_brand ?? '-' }}</td>
                    </tr>
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Spesifikasi Utama</td>
                        <td class="p-4 sm:p-5">{{ $technology->main_spec ?? '-' }}</td>
                    </tr>
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Peruntukan Target Pipa</td>
                        <td class="p-4 sm:p-5">{{ $technology->pipe_target ?? '-' }}</td>
                    </tr>
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Keunggulan Utama</td>
                        <td class="p-4 sm:p-5 font-semibold text-emerald-700">{{ $technology->main_advantage ?? '-' }}</td>
                    </tr>
                    @if($technology->feature_1_value)
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Fitur Unggulan 1</td>
                        <td class="p-4 sm:p-5 font-semibold text-slate-800">{{ $technology->feature_1_value }}</td>
                    </tr>
                    @endif
                    @if($technology->feature_2_value)
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Fitur Unggulan 2</td>
                        <td class="p-4 sm:p-5 font-semibold text-slate-800">{{ $technology->feature_2_value }}</td>
                    </tr>
                    @endif
                    <tr class="hover:bg-slate-100/60">
                        <td class="p-4 sm:p-5 font-bold text-slate-900 bg-slate-100/50">Jaminan Struktur Pipa</td>
                        <td class="p-4 sm:p-5 font-bold text-emerald-600">✓ 100% Aman Tanpa Risiko Bocor / Keropos</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- 3. SECTION 2: CARA KERJA & JAMINAN KEAMANAN PIPA --}}
<section class="py-14 sm:py-20 bg-slate-900 text-white border-y border-slate-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="text-emerald-400 font-bold text-xs uppercase tracking-wider">Metode Mekanis Presisi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1 mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                    Mengapa {{ $technology->tool_name }} Sangat Aman Bagi Pipa Properti Anda?
                </h2>
                <div class="space-y-4 text-xs sm:text-sm text-slate-300 leading-relaxed">
                    @if(!empty($technology->safety_guarantee_text))
                        {!! nl2br(e($technology->safety_guarantee_text)) !!}
                    @else
                        <p>
                            Penggunaan cairan asam atau soda api konvensional sering kali memperparah kerusakan karena sifatnya yang memanaskan pipa PVC hingga melengkung, merusak sambungan lem, bahkan melumerkan plastik.
                        </p>
                        <p>
                            Dengan unit <strong>{{ $technology->tool_name }}</strong>, teknisi Rootera mengaplikasikan metode mekanis non-destruktif. Alat ini mampu menjangkau lekukan pipa leher angsa (P-trap / S-trap) untuk mengikis lemak, memotong rambut, dan memenstrasi sumbatan tanpa merusak struktur internal pipa.
                        </p>
                    @endif
                </div>

                <div class="mt-6 space-y-2">
                    <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-emerald-400">
                        <span class="w-5 h-5 rounded-full bg-emerald-500/20 flex items-center justify-center text-xs">✓</span>
                        Bebas Asam Korosif Berbahaya
                    </div>
                    <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-emerald-400">
                        <span class="w-5 h-5 rounded-full bg-emerald-500/20 flex items-center justify-center text-xs">✓</span>
                        Meliuk Fleksibel Mengikuti Alur PVC
                    </div>
                    <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-emerald-400">
                        <span class="w-5 h-5 rounded-full bg-emerald-500/20 flex items-center justify-center text-xs">✓</span>
                        Hasil Bersih Tuntas Bergaransi Resmi
                    </div>
                </div>
            </div>

            <div class="bg-slate-800/80 p-6 sm:p-8 rounded-3xl border border-slate-700">
                <h3 class="font-extrabold text-lg text-white mb-4">Kasus Penggunaan Ideal (Use Cases):</h3>
                <div class="space-y-3">
                    <div class="p-3.5 bg-slate-900/80 rounded-xl border border-slate-700/80 flex items-start gap-3">
                        <span class="text-lg">🏡</span>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-white">Rumah &amp; Cluster Perumahan</h4>
                            <p class="text-[11px] text-slate-400">Wastafel dapur mampet lemak sabun &amp; floor drain kamar mandi tersumbat rambut.</p>
                        </div>
                    </div>
                    <div class="p-3.5 bg-slate-900/80 rounded-xl border border-slate-700/80 flex items-start gap-3">
                        <span class="text-lg">🍽️</span>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-white">Restoran &amp; Cloud Kitchen</h4>
                            <p class="text-[11px] text-slate-400">Penanganan gumpalan lemak minyak jenuh pada grease trap &amp; gutter dapur commercial.</p>
                        </div>
                    </div>
                    <div class="p-3.5 bg-slate-900/80 rounded-xl border border-slate-700/80 flex items-start gap-3">
                        <span class="text-lg">🏢</span>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-white">Gedung, Mall &amp; Industri</h4>
                            <p class="text-[11px] text-slate-400">Pembersihan jaringan pipa pembuangan utama diameter 4-12 inci yang tertimbun kerak padat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. SECTION 3: FAQ KHUSUS ALAT --}}
<section class="py-14 sm:py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">FAQ Peralatan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Pertanyaan Umum Mengenai {{ $technology->tool_name }}</h2>
        </div>

        <div class="space-y-4">
            @if(!empty($technology->faqs) && is_array($technology->faqs))
                @foreach($technology->faqs as $faqItem)
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base">{{ $faqItem['question'] ?? '' }}</h3>
                    <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">{{ $faqItem['answer'] ?? '' }}</p>
                </div>
                @endforeach
            @else
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base">Apakah {{ $technology->tool_name }} berisiko merusak pipa PVC?</h3>
                    <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Sama sekali tidak. {{ $technology->tool_name }} bekerja dengan metode mekanis presisi yang dirancang khusus fleksibel meliuk di alur pipa tanpa merusak sambungan PVC atau struktur lantai.</p>
                </div>
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base">Berapa lama estimasi pengerjaan saluran mampet dengan {{ $technology->tool_name }}?</h3>
                    <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Rata-rata pengerjaan membutuhkan waktu 30 hingga 60 menit tergantung pada tingkat keparahan sumbatan lemak, kerak, atau akar pohon di dalam pipa.</p>
                </div>
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base">Apakah pengerjaan menggunakan {{ $technology->tool_name }} disertai garansi resmi?</h3>
                    <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Ya, seluruh pengerjaan oleh teknisi Rootera dilindungi Garansi Tuntas 30 Hari tertulis resmi.</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- 5. SECTION 4: RELATED EQUIPMENT & STICKY CTA BAR --}}
@if(isset($relatedTechnologies) && $relatedTechnologies->isNotEmpty())
<section class="py-14 sm:py-18 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Armada Lainnya</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Teknologi Pelancar Pipa Lainnya</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($relatedTechnologies as $relTech)
            <div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden flex flex-col justify-between hover:shadow-lg transition-all duration-300">
                <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden">
                    <img src="{{ $relTech->image_url }}" alt="{{ $relTech->tool_name }}" class="w-full h-full object-cover" loading="lazy" width="300" height="225">
                </div>
                <div class="p-4 flex flex-col flex-grow justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1 line-clamp-1">{{ $relTech->tool_name }}</h3>
                        <p class="text-xs text-slate-500 line-clamp-2 mb-3">{{ $relTech->main_advantage ?? $relTech->description }}</p>
                    </div>
                    <a href="{{ route('technologies.show', $relTech->slug) }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800">Lihat Detail →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Sticky Bottom CTA Bar --}}
<div class="sticky bottom-0 z-50 bg-slate-900/95 backdrop-blur-md border-t border-slate-800 py-3.5 px-4 shadow-2xl">
    <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-center sm:text-left">
            <span class="text-xs font-bold text-emerald-400 block">Butuh Penanganan Pipa Mampet?</span>
            <span class="text-xs text-slate-300">Teknisi siap datang membawa unit {{ $technology->tool_name }}</span>
        </div>
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin panggil teknisi membawa ' . $technology->tool_name) }}" target="_blank" class="bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm py-2.5 px-6 rounded-full flex items-center justify-center gap-2 shadow-md hover:-translate-y-0.5 transition-all">
            <span>Panggil Teknisi via WhatsApp 24 Jam</span>
        </a>
    </div>
</div>
@endsection
