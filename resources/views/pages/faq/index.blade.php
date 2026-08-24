@extends('layouts.app')

@section('schema-markup')
<?php
$faqSchema = [
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
        ]
      ]
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => $featuredFaqs->map(function($item) {
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
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<!-- Hero Knowledge Base Section -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #04122C 100%); color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1000px; margin: 0 auto; text-align: center;">
        <span style="background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.25rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; display: inline-block; margin-bottom: 1rem;">
            📖 Pusat Bantuan &amp; Knowledge Base Rootera
        </span>

        <h1 style="font-size: clamp(2rem, 4vw, 3.25rem); font-weight: 800; color: #ffffff; margin-bottom: 1.25rem; line-height: 1.2;">
            Pusat Bantuan &amp; Tanya Jawab Saluran Pipa Mampet
        </h1>

        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 780px; margin: 0 auto 2.5rem; line-height: 1.6;">
            Temukan jawaban komprehensif seputar estimasi biaya, teknologi alat spiral &amp; hydro-jetting, jaminan garansi 30 hari, dan panduan perawatan pipa air.
        </p>

        {{-- Live Search Form --}}
        <form method="GET" action="{{ route('faq.index') }}" style="max-width: 680px; margin: 0 auto; position: relative;">
            <div style="display: flex; gap: 0.5rem; background: #ffffff; padding: 0.4rem; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Cari pertanyaan... (contoh: biaya, garansi, hydro jetting, soda api)" style="flex: 1; border: none; padding: 0.85rem 1.5rem; border-radius: 50px; font-size: 1rem; color: #0f172a; outline: none;">
                <button type="submit" style="background: #169F81; color: #ffffff; font-weight: 700; border: none; padding: 0.85rem 2rem; border-radius: 50px; cursor: pointer; font-size: 0.95rem;">
                    🔍 Cari FAQ
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Search Results Notification if active -->
@if(!empty($searchQuery))
<section style="padding: 3rem 1.5rem; max-width: 1100px; margin: 0 auto;">
    <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem;">
        <h2 style="color: #0A2E78; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">Hasil Pencarian untuk: "{{ $searchQuery }}"</h2>
        <p style="color: #475569; font-size: 0.9rem;">Ditemukan <strong>{{ $searchResults->count() }}</strong> pertanyaan yang sesuai.</p>
    </div>

    @if($searchResults->isNotEmpty())
        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @foreach($searchResults as $faq)
                <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                    <div style="font-size: 0.78rem; font-weight: 700; color: #169F81; margin-bottom: 0.4rem;">
                        {{ $faq->category->icon ?? '❓' }} {{ $faq->category->name ?? 'Umum' }}
                    </div>
                    <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.6rem;">
                        <a href="{{ route('faq.show', $faq->slug) }}" style="color: inherit; text-decoration: none;">{{ $faq->question }}</a>
                    </h3>
                    <p style="color: #475569; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">{!! $faq->answer !!}</p>
                    <a href="{{ route('faq.show', $faq->slug) }}" style="color: #169F81; font-weight: 700; font-size: 0.88rem; text-decoration: none;">Lihat Jawaban Selengkapnya →</a>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endif

<!-- Categories Taxonomy Grid -->
<section style="padding: 4.5rem 1.5rem; max-width: 1200px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Kategori Informasi</span>
        <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.3rem;">Jelajahi FAQ Berdasarkan Kategori Topik</h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
        @foreach($categories as $cat)
            <a href="{{ route('faq.category', $cat->slug) }}" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem; text-decoration: none; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 20px rgba(0,0,0,0.03); transition: all 0.3s ease;" class="hover:border-[#169F81] hover:shadow-xl">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span style="font-size: 2.5rem;">{{ $cat->icon }}</span>
                        <span style="background: #F1F5F9; color: #0A2E78; font-size: 0.8rem; font-weight: 700; padding: 0.3rem 0.8rem; border-radius: 50px;">
                            {{ $cat->faqs_count }} Pertanyaan
                        </span>
                    </div>

                    <h3 style="color: #0A2E78; font-size: 1.3rem; font-weight: 800; margin-bottom: 0.5rem;">{{ $cat->name }}</h3>
                    <p style="color: #64748B; font-size: 0.9rem; line-height: 1.5; margin-bottom: 1.25rem;">{{ $cat->description }}</p>
                </div>

                <div style="color: #169F81; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.3rem;">
                    Buka Kategori FAQ ini →
                </div>
            </a>
        @endforeach
    </div>
</section>

<!-- Featured FAQs Accordion -->
@if($featuredFaqs->isNotEmpty())
<section style="padding: 4.5rem 1.5rem; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Paling Sering Ditanyakan</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.3rem;">FAQ Unggulan Pelanggan Rootera</h2>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($featuredFaqs as $faq)
                <details style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 1.25rem 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                    <summary style="font-size: 1.1rem; font-weight: 700; color: #0A2E78; cursor: pointer; user-select: none; display: flex; justify-content: space-between; align-items: center;">
                        <span>❓ {{ $faq->question }}</span>
                        <span style="font-size: 0.8rem; background: #F1F5F9; color: #64748B; padding: 0.2rem 0.6rem; border-radius: 6px; font-weight: 600;">
                            {{ $faq->category->name ?? 'FAQ' }}
                        </span>
                    </summary>
                    <div style="margin-top: 1rem; color: #475569; font-size: 0.98rem; line-height: 1.6; border-top: 1px solid #F1F5F9; padding-top: 1rem;">
                        {!! $faq->answer !!}
                        <div style="margin-top: 0.85rem;">
                            <a href="{{ route('faq.show', $faq->slug) }}" style="color: #169F81; font-weight: 700; font-size: 0.85rem; text-decoration: none;">Tautan Halaman FAQ →</a>
                        </div>
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Need Direct Help CTA -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4.5rem 1.5rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem;">Tidak Menemukan Jawaban Pertanyaan Anda?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2.25rem; line-height: 1.6;">Tim konsultan teknis Rootera Plumbing (J&amp;J Group) siap menjawab pertanyaan dan berkonsultasi gratis via WhatsApp 24 jam nonstop.</p>
        
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya memiliki pertanyaan seputar jasa pipa mampet.') }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-size: 1.1rem; font-weight: 700; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);">
            💬 Konsultasi Bebas Biaya Via WhatsApp (24 Jam)
        </a>
    </div>
</section>
@endsection
