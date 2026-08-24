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
<!-- Hero Category Section -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #04122C 100%); color: #ffffff; padding: 4rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1000px; margin: 0 auto;">
        
        <div style="display: flex; items-center; gap: 0.5rem; color: #2dd4bf; font-size: 0.88rem; font-weight: 700; margin-bottom: 1rem;">
            <a href="{{ route('faq.index') }}" style="color: #2dd4bf; text-decoration: none;">← Pusat Bantuan FAQ</a>
            <span>/</span>
            <span>Kategori {{ $category->name }}</span>
        </div>

        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <span style="font-size: 3rem;">{{ $category->icon }}</span>
            <h1 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: #ffffff; margin: 0;">
                FAQ {{ $category->name }}
            </h1>
        </div>

        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.9); max-width: 800px; line-height: 1.6; margin-bottom: 2rem;">
            {{ $category->description }}
        </p>

        <span style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #ffffff; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700;">
            Daftar {{ $category->faqs->count() }} Pertanyaan &amp; Jawaban Mendalam
        </span>
    </div>
</section>

<!-- FAQs List Section -->
<section style="padding: 4.5rem 1.5rem; max-width: 1000px; margin: 0 auto;">
    
    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        @forelse($category->faqs as $faq)
            <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 18px; padding: 1.75rem; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <h2 style="color: #0A2E78; font-size: 1.25rem; font-weight: 800; margin-bottom: 0.85rem;">
                    <a href="{{ route('faq.show', $faq->slug) }}" style="color: inherit; text-decoration: none;">
                        ❓ {{ $faq->question }}
                    </a>
                </h2>

                <div style="color: #475569; font-size: 1rem; line-height: 1.7; border-top: 1px solid #F1F5F9; padding-top: 1rem; margin-bottom: 1.25rem;">
                    {!! $faq->answer !!}
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed #E2E8F0; padding-top: 0.85rem;">
                    <a href="{{ route('faq.show', $faq->slug) }}" style="color: #169F81; font-weight: 700; font-size: 0.88rem; text-decoration: none;">
                        Direct Link Halaman Pertanyaan →
                    </a>
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin menanyakan hal ini: ' . $faq->question) }}" target="_blank" style="color: #25D366; font-weight: 700; font-size: 0.85rem; text-decoration: none;">
                        💬 Tanya CS via WA
                    </a>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 3rem; color: #94A3B8;">
                Belum ada pertanyaan pada kategori ini.
            </div>
        @endforelse
    </div>

</section>

<!-- Related Categories Navigation Grid -->
@if(isset($allCategories) && $allCategories->isNotEmpty())
<section style="padding: 4rem 1.5rem; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1100px; margin: 0 auto;">
        <h3 style="color: #0A2E78; font-size: 1.4rem; font-weight: 800; margin-bottom: 1.5rem; text-align: center;">Kategori FAQ Lainnya</h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.25rem;">
            @foreach($allCategories as $catItem)
                @if($catItem->id !== $category->id)
                    <a href="{{ route('faq.category', $catItem->slug) }}" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.25rem; color: #0A2E78; text-decoration: none; display: flex; align-items: center; gap: 0.85rem;" class="hover:border-[#169F81]">
                        <span style="font-size: 1.8rem;">{{ $catItem->icon }}</span>
                        <div>
                            <div style="font-weight: 700; font-size: 0.95rem;">{{ $catItem->name }}</div>
                            <div style="font-size: 0.78rem; color: #64748B;">{{ $catItem->faqs_count }} Pertanyaan</div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
