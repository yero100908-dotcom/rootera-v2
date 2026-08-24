@extends('layouts.app')

@section('schema-markup')
<?php
$singleFaqSchema = [
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
          "name" => $faq->category->name ?? 'FAQ',
          "item" => route('faq.category', $faq->category->slug ?? 'biaya-dan-estimasi-harga')
        ],
        [
          "@type" => "ListItem",
          "position" => 4,
          "name" => $faq->question,
          "item" => route('faq.show', $faq->slug)
        ]
      ]
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => [
        [
          "@type" => "Question",
          "name" => strip_tags($faq->question),
          "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => strip_tags($faq->answer)
          ]
        ]
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($singleFaqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<section style="padding: 4.5rem 1.5rem; max-width: 900px; margin: 0 auto;">
    
    {{-- Breadcrumb --}}
    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; color: #64748B; font-size: 0.88rem; margin-bottom: 2rem; align-items: center;">
        <a href="{{ url('/') }}" style="color: #64748B; text-decoration: none;">Beranda</a>
        <span>/</span>
        <a href="{{ route('faq.index') }}" style="color: #64748B; text-decoration: none;">Pusat Bantuan FAQ</a>
        @if($faq->category)
            <span>/</span>
            <a href="{{ route('faq.category', $faq->category->slug) }}" style="color: #169F81; font-weight: 700; text-decoration: none;">{{ $faq->category->name }}</a>
        @endif
    </div>

    {{-- Main Question Card --}}
    <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 24px; padding: 2.5rem; box-shadow: 0 4px 25px rgba(0,0,0,0.04); margin-bottom: 3rem;">
        
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: #F0FDF4; border: 1px solid #BBF7D0; color: #169F81; font-size: 0.82rem; font-weight: 700; padding: 0.35rem 0.9rem; border-radius: 50px; margin-bottom: 1.25rem;">
            <span>{{ $faq->category->icon ?? '❓' }} {{ $faq->category->name ?? 'Informasi Layanan' }}</span>
        </div>

        <h1 style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #0A2E78; line-height: 1.25; margin-bottom: 1.5rem;">
            {{ $faq->question }}
        </h1>

        <div style="color: #334155; font-size: 1.1rem; line-height: 1.8; border-top: 1px solid #F1F5F9; padding-top: 1.5rem; margin-bottom: 2rem;">
            {!! $faq->answer !!}
        </div>

        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 16px; padding: 1.5rem; display: flex; flex-col; sm:flex-row; justify-content: space-between; align-items: center; gap: 1rem;">
            <div>
                <div style="font-weight: 700; color: #0A2E78; font-size: 0.95rem;">Butuh Penanganan Teknisi Pipa Mampet?</div>
                <div style="color: #64748B; font-size: 0.85rem;">Teknisi Rootera Plumbing siap meluncur ke lokasi Anda (Garansi 30 Hari).</div>
            </div>
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin order teknisi untuk masalah: ' . $faq->question) }}" target="_blank" style="background: #25D366; color: #ffffff; font-weight: 700; font-size: 0.92rem; padding: 0.75rem 1.5rem; border-radius: 50px; text-decoration: none; white-space: nowrap;">
                💬 Hubungi CS via WhatsApp
            </a>
        </div>
    </div>

    {{-- Related FAQs --}}
    @if(isset($relatedFaqs) && $relatedFaqs->isNotEmpty())
    <div>
        <h3 style="color: #0A2E78; font-size: 1.35rem; font-weight: 800; margin-bottom: 1.25rem;">Pertanyaan Terkait di Kategori Ini</h3>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($relatedFaqs as $rFaq)
                <a href="{{ route('faq.show', $rFaq->slug) }}" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.25rem; text-decoration: none; color: #0A2E78; display: flex; justify-content: space-between; align-items: center;" class="hover:border-[#169F81]">
                    <span style="font-weight: 700; font-size: 1rem;">❓ {{ $rFaq->question }}</span>
                    <span style="color: #169F81; font-weight: 700; font-size: 0.85rem;">Lihat →</span>
                </a>
            @endforeach
        </div>
    </div>
    @endif

</section>
@endsection
