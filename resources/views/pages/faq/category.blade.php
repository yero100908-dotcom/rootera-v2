@extends('layouts.app')

@section('schema-markup')
<?php
$catFaqSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "BreadcrumbList",
      "itemListElement" => [
        [
          "@type" => "ListItem",
          "position" => 1,
          "name" => "Beranda",
          "item" => url('/')
        ],
        [
          "@type" => "ListItem",
          "position" => 2,
          "name" => "Pusat Bantuan & FAQ",
          "item" => route('faq.index')
        ],
        [
          "@type" => "ListItem",
          "position" => 3,
          "name" => $category->name,
          "item" => route('faq.category', $category->slug)
        ]
      ]
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => $category->faqs->map(function($item) {
          return [
            "@type" => "Question",
            "name" => strip_tags($item->question),
            "acceptedAnswer" => [
              "@type" => "Answer",
              "text" => strip_tags($item->answer)
            ]
          ];
      })->toArray()
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($catFaqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800 font-['Inter',sans-serif]">
    
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#0B192C] via-[#0A2540] to-[#0d3a94] text-white py-12 md:py-16 border-b border-cyan-500/20">
        <div class="container mx-auto px-4 max-w-4xl relative z-10">
            
            {{-- Breadcrumb Navigation --}}
            <div class="flex items-center gap-2 text-xs sm:text-sm text-cyan-300 font-semibold mb-4">
                <a href="{{ route('faq.index') }}" class="hover:underline flex items-center gap-1">
                    <span>← Pusat Bantuan FAQ</span>
                </a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-200">Kategori {{ $category->name }}</span>
            </div>

            <div class="flex items-center gap-4 mb-4">
                <span class="text-4xl sm:text-5xl p-3 bg-white/10 rounded-2xl border border-white/15 backdrop-blur-md">
                    {{ $category->icon }}
                </span>
                <div>
                    <h1 class="text-2xl sm:text-4xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] text-white">
                        FAQ {{ $category->name }}
                    </h1>
                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-cyan-500/20 text-cyan-300 border border-cyan-400/30 text-xs font-bold">
                        {{ $category->faqs->count() }} Pertanyaan Terverifikasi
                    </span>
                </div>
            </div>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
                {{ $category->description }}
            </p>
        </div>
    </section>

    {{-- FAQs List Section --}}
    <main class="container mx-auto px-4 py-10 max-w-4xl">
        <div class="space-y-4">
            @forelse($category->faqs as $faq)
                <div class="bg-white rounded-2xl border border-slate-200 p-5 sm:p-6 shadow-sm hover:shadow-md transition-all">
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 mb-3 leading-snug">
                        <a href="{{ route('faq.show', $faq->slug) }}" class="hover:text-cyan-600 transition-colors">
                            ❓ {{ $faq->question }}
                        </a>
                    </h2>

                    <div class="text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3 mb-4 space-y-2">
                        {!! $faq->answer !!}
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-dashed border-slate-200 text-xs sm:text-sm">
                        <a href="{{ route('faq.show', $faq->slug) }}" class="text-cyan-600 hover:text-cyan-700 font-bold flex items-center gap-1">
                            <span>Halaman Pertanyaan Lengkap →</span>
                        </a>
                        
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya membaca FAQ category ' . $category->name . ' tentang: ' . $faq->question) }}" 
                           target="_blank" rel="noopener noreferrer" 
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm w-fit">
                            <span>💬 Tanya CS via WA</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500">
                    Belum ada pertanyaan pada kategori ini.
                </div>
            @endforelse
        </div>
    </main>

    {{-- Other Categories Navigation --}}
    @if(isset($allCategories) && $allCategories->isNotEmpty())
    <section class="bg-slate-100 py-12 border-t border-slate-200">
        <div class="container mx-auto px-4 max-w-4xl">
            <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-6 text-center">Kategori FAQ Lainnya</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($allCategories as $catItem)
                    @if($catItem->id !== $category->id)
                        <a href="{{ route('faq.category', $catItem->slug) }}" 
                           class="bg-white p-4 rounded-xl border border-slate-200 hover:border-cyan-500 shadow-sm hover:shadow transition-all flex items-center gap-3">
                            <span class="text-2xl">{{ $catItem->icon }}</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">{{ $catItem->name }}</h4>
                                <span class="text-[11px] text-slate-500">{{ $catItem->faqs_count }} Pertanyaan</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
