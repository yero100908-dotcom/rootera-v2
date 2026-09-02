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
      "@type" => "QAPage",
      "mainEntity" => [
        "@type" => "Question",
        "name" => strip_tags($faq->question),
        "text" => strip_tags($faq->question),
        "answerCount" => 1,
        "upvoteCount" => 15,
        "dateCreated" => $faq->created_at ? $faq->created_at->toIso8601String() : date('c'),
        "author" => [
          "@type" => "Organization",
          "name" => "Rootera Plumbing Technical Team"
        ],
        "acceptedAnswer" => [
          "@type" => "Answer",
          "text" => strip_tags($faq->answer),
          "dateCreated" => $faq->updated_at ? $faq->updated_at->toIso8601String() : date('c'),
          "upvoteCount" => 12,
          "url" => route('faq.show', $faq->slug),
          "author" => [
            "@type" => "Organization",
            "name" => "Rootera Plumbing Technical Team"
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
<div class="bg-slate-50 min-h-screen text-slate-800 font-['Inter',sans-serif]">
    
    {{-- Header Banner --}}
    <div class="bg-gradient-to-br from-[#0B192C] via-[#0A2540] to-[#0d3a94] text-white py-10 sm:py-14 border-b border-cyan-500/20 relative overflow-hidden">
        <div class="absolute -top-32 -right-32 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container mx-auto px-4 max-w-6xl relative z-10">
            
            {{-- Breadcrumbs Navigation --}}
            <nav class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-cyan-300 font-semibold mb-4" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:underline text-slate-300 hover:text-white transition-colors">Beranda</a>
                <span class="text-slate-500">/</span>
                <a href="{{ route('faq.index') }}" class="hover:underline text-slate-300 hover:text-white transition-colors">Pusat Bantuan FAQ</a>
                @if($faq->category)
                    <span class="text-slate-500">/</span>
                    <a href="{{ route('faq.category', $faq->category->slug) }}" class="hover:underline text-cyan-300 hover:text-cyan-200">
                        {{ $faq->category->name }}
                    </a>
                @endif
            </nav>

            {{-- Mini Hero Badge & H1 --}}
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-cyan-300 text-xs font-bold mb-3 backdrop-blur-md">
                    <span>{{ $faq->category->icon ?? '❓' }} {{ $faq->category->name ?? 'Panduan Layanan' }}</span>
                </div>

                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] text-white leading-tight mb-4">
                    {{ $faq->question }}
                </h1>

                {{-- Reading Meta Info --}}
                <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-300 font-medium">
                    <span class="flex items-center gap-1.5 bg-white/10 px-3 py-1 rounded-lg border border-white/10">
                        <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Estimasi Waktu Baca: ⏱️ 3 Menit
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3 py-1 rounded-lg border border-white/10">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Ditinjau oleh Tim Spesialis Rootera
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- Main Container (2-Column Desktop Grid) --}}
    <main class="container mx-auto px-4 py-8 sm:py-12 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- LEFT COLUMN: Main Article & Knowledge Content (8 Cols) --}}
            <div class="lg:col-span-8 space-y-8">
                
                {{-- Article Body Card --}}
                <article class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 md:p-10 shadow-sm">
                    
                    {{-- Intro Callout Box --}}
                    <div class="bg-cyan-50/70 border-l-4 border-cyan-500 p-4 rounded-r-2xl mb-6 text-sm text-slate-800 leading-relaxed font-medium">
                        💡 <strong>Ringkasan Solusi:</strong> Halaman panduan ini memberikan rincian teknis, langkah penanganan awal, serta rekomendasi peralatan terbaik dari teknisi Rootera Plumbing.
                    </div>

                    {{-- Main Answer Text --}}
                    <div class="prose max-w-none text-slate-700 text-base sm:text-lg leading-relaxed space-y-4 font-normal">
                        {!! $faq->answer !!}
                    </div>

                    {{-- Step-by-Step Resolution Guide (Rich Content Enhancement) --}}
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <h3 class="text-lg sm:text-xl font-bold font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 mb-4 flex items-center gap-2">
                            <span>📋</span> Panduan Penanganan Langkah Demi Langkah
                        </h3>

                        <ol class="space-y-3 text-sm sm:text-base text-slate-700">
                            <li class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                                <span class="w-7 h-7 rounded-full bg-cyan-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                                <div>
                                    <strong class="text-slate-900 block font-bold mb-0.5">Hentikan Penggunaan Air Sementara</strong>
                                    <span class="text-slate-600 text-xs sm:text-sm">Hindari menyiramkan air tambahan ke wastafel, floor drain, atau kloset yang sedang tersumbat agar air meluap tidak membasahi lantai.</span>
                                </div>
                            </li>

                            <li class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                                <span class="w-7 h-7 rounded-full bg-cyan-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                                <div>
                                    <strong class="text-slate-900 block font-bold mb-0.5">Hindari Bahan Kimia Keras / Soda Api</strong>
                                    <span class="text-slate-600 text-xs sm:text-sm">Jangan memasukkan soda api atau asam sulfat karena reaksi panas tingginya dapat melelehkan sambungan pipa PVC paralon Anda.</span>
                                </div>
                            </li>

                            <li class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                                <span class="w-7 h-7 rounded-full bg-cyan-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                                <div>
                                    <strong class="text-slate-900 block font-bold mb-0.5">Panggil Teknisi Profesional Rootera</strong>
                                    <span class="text-slate-600 text-xs sm:text-sm">Teknisi kami meluncur dalam 30 menit menggunakan kabel flex rotary spiral cable atau Hydro-Jetting tanpa merusak ubin rumah Anda.</span>
                                </div>
                            </li>
                        </ol>
                    </div>

                    {{-- Warning Box (Anti Soda Api & Risk Info) --}}
                    <div class="mt-8 bg-rose-50 border border-rose-200 rounded-2xl p-5 text-rose-900 text-xs sm:text-sm leading-relaxed flex items-start gap-3">
                        <span class="text-2xl shrink-0">⚠️</span>
                        <div>
                            <strong class="font-extrabold text-rose-950 block mb-1">Peringatan Bahaya Bahan Kimia Korosif:</strong>
                            Penggunaan bahan pembersih kimia keras dapat menyebabkan uap beracun, kerusakan permanen pada struktur pipa PVC, serta membeku seperti batu jika gagal melancarkan sumbatan. Selalu gunakan penanganan mekanis rotary yang aman.
                        </div>
                    </div>
                </article>

                {{-- Interactive Feedback Box Component --}}
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm text-center relative overflow-hidden" id="faq-feedback-container">
                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 mb-2">
                        Apakah panduan ini menyelesaikan masalah Anda?
                    </h3>
                    <p class="text-slate-500 text-xs sm:text-sm mb-6">
                        Masukan Anda membantu tim teknis Rootera meningkatkan kualitas informasi layanan.
                    </p>

                    <div class="flex items-center justify-center gap-3" id="feedback-buttons-wrapper">
                        <button type="button" onclick="handleFeedbackClick(true)" 
                                class="px-6 py-3 rounded-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-300 font-bold text-sm transition-all transform hover:scale-105 shadow-sm flex items-center gap-2">
                            <span>👍 Ya, Sangat Membantu</span>
                        </button>
                        
                        <button type="button" onclick="handleFeedbackClick(false)" 
                                class="px-6 py-3 rounded-full bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-300 font-bold text-sm transition-all transform hover:scale-105 shadow-sm flex items-center gap-2">
                            <span>👎 Belum / Butuh Bantuan</span>
                        </button>
                    </div>

                    {{-- Expandable Unhelpful Reason Form (Hidden by default) --}}
                    <div id="unhelpful-form-panel" class="hidden mt-6 pt-6 border-t border-slate-100 text-left bg-slate-50 p-5 rounded-2xl border border-slate-200">
                        <h4 class="font-bold text-slate-900 text-sm mb-1">Beri tahu kami apa yang bisa kami tingkatkan:</h4>
                        <p class="text-slate-500 text-xs mb-3">Pilih alasan atau tuliskan komentar singkat:</p>

                        <div class="space-y-2 mb-4 text-xs sm:text-sm">
                            <label class="flex items-center gap-2 cursor-pointer text-slate-700">
                                <input type="radio" name="feedback_reason" value="Penjelasan kurang jelas" checked class="text-cyan-600 focus:ring-cyan-500">
                                <span>Penjelasan teknis kurang jelas / rumit</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-slate-700">
                                <input type="radio" name="feedback_reason" value="Informasi tidak sesuai masalah saya" class="text-cyan-600 focus:ring-cyan-500">
                                <span>Informasi belum menjawab masalah spesifik saya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-slate-700">
                                <input type="radio" name="feedback_reason" value="Membutuhkan penanganan teknisi langsung" class="text-cyan-600 focus:ring-cyan-500">
                                <span>Membutuhkan penanganan teknisi langsung di lokasi</span>
                            </label>
                        </div>

                        <textarea id="feedback-comment-input" rows="2" placeholder="Catatan tambahan (opsional)..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-cyan-500/30 mb-4"></textarea>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                            <button type="button" onclick="submitDetailedFeedback()" class="w-full sm:w-auto px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition-all">
                                Kirim Masukan
                            </button>
                            
                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh penanganan teknisi untuk artikel: ' . $faq->question) }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="w-full sm:w-auto text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center justify-center gap-1">
                                <span>Hubungi Teknisi untuk Solusi Langsung →</span>
                            </a>
                        </div>
                    </div>

                    {{-- Feedback Success State --}}
                    <div id="feedback-thankyou-panel" class="hidden mt-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                        <div class="text-2xl mb-1">🎉</div>
                        <h4 class="font-extrabold text-sm text-emerald-900 mb-1">Terima Kasih Atas Feedback Anda!</h4>
                        <p class="text-xs text-emerald-700 mb-4">Masukan Anda telah kami catat untuk penyempurnaan layanan.</p>
                        
                        <a href="https://api.whatsapp.com/send?text={{ urlencode('Panduan bermanfaat dari Rootera Plumbing: ' . route('faq.show', $faq->slug)) }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-all shadow-sm">
                            <span>📲 Bagikan Panduan Ini via WhatsApp</span>
                        </a>
                    </div>
                </div>

                {{-- Related FAQs Carousel/Grid --}}
                @if(isset($relatedFaqs) && $relatedFaqs->isNotEmpty())
                <section class="mt-8">
                    <h3 class="text-lg sm:text-xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 mb-4">
                        Pertanyaan Terkait di Kategori Ini
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($relatedFaqs as $rFaq)
                            <a href="{{ route('faq.show', $rFaq->slug) }}" 
                               class="bg-white rounded-2xl border border-slate-200/90 p-4 sm:p-5 hover:border-cyan-500 shadow-sm hover:shadow transition-all group flex flex-col justify-between">
                                <div>
                                    <span class="text-xs text-cyan-600 font-bold block mb-1">{{ $rFaq->category->name ?? 'FAQ' }}</span>
                                    <h4 class="font-bold text-slate-900 text-sm group-hover:text-cyan-700 transition-colors line-clamp-2">
                                        ❓ {{ $rFaq->question }}
                                    </h4>
                                </div>
                                <span class="text-xs font-bold text-cyan-600 mt-3 flex items-center gap-1">
                                    <span>Baca Panduan Selengkapnya</span>
                                    <span>→</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif

            </div>

            {{-- RIGHT COLUMN: Sticky Emergency Assistance Sidebar (4 Cols) --}}
            <aside class="lg:col-span-4 space-y-6">
                <div class="sticky top-[95px] space-y-6">
                    
                    {{-- Emergency Assistance Card --}}
                    <div class="bg-gradient-to-br from-slate-900 via-[#0A2540] to-slate-900 rounded-3xl p-6 text-white shadow-xl border border-cyan-500/30 relative overflow-hidden">
                        <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-cyan-500/20 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="relative z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[11px] font-bold uppercase tracking-wider mb-4">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                Teknisi Standby 24 Jam
                            </span>

                            <h3 class="text-xl font-extrabold font-['Plus_Jakarta_Sans',sans-serif] text-white mb-2 leading-snug">
                                Butuh Bantuan Penanganan Mendesak?
                            </h3>

                            <p class="text-slate-300 text-xs sm:text-sm mb-5 leading-relaxed">
                                Armada teknisi Rootera siap meluncur ke lokasi Anda dengan estimasi tiba <strong class="text-cyan-300">25–40 Menit</strong> (Garansi 30 Hari).
                            </p>

                            <div class="space-y-3 mb-6 bg-white/10 p-3.5 rounded-2xl border border-white/10 text-xs text-slate-200">
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-400 font-bold">✓</span>
                                    <span>Pengerjaan Tanpa Bongkar Keramik</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-400 font-bold">✓</span>
                                    <span>Pencegahan Garansi No Cure No Pay</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-emerald-400 font-bold">✓</span>
                                    <span>Estimasi Biaya Transparan di Awal</span>
                                </div>
                            </div>

                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya membaca artikel FAQ tentang: "' . $faq->question . '" dan butuh pemanggilan teknisi pipa mampet sekarang.') }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-extrabold text-sm rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 2c-5.514 0-9.996 4.477-9.996 9.989 0 1.76.459 3.473 1.332 4.982l-1.367 4.992 5.127-1.34c1.458.797 3.107 1.217 4.898 1.217 5.514 0 9.997-4.477 9.997-9.989 0-5.514-4.483-9.991-9.991-9.991zm5.952 14.182c-.252.709-1.464 1.353-2.02 1.417-.502.057-1.157.085-3.329-.814-2.776-1.15-4.568-3.978-4.707-4.163-.138-.184-1.127-1.503-1.127-2.863 0-1.36.711-2.03.963-2.308.252-.278.553-.347.738-.347.185 0 .37.003.528.01.171.008.4.004.577.433.185.449.63 1.54.685 1.653.055.113.093.245.018.393-.075.148-.113.241-.225.371-.113.13-.237.29-.338.391-.113.113-.231.236-.1.461.131.225.582.96 1.252 1.557.86.767 1.585 1.004 1.81 1.117.225.113.357.094.489-.056.132-.15.568-.663.72-892.152-.228.303-.189.504-.113.225.075 1.503.731 1.765.862.262.131.436.197.498.303.063.107.063.619-.189 1.328z"/></svg>
                                <span>Panggil Teknisi Siaga via WA</span>
                            </a>
                        </div>
                    </div>

                    {{-- Help Category Navigator --}}
                    <div class="bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                        <h4 class="font-bold text-slate-900 text-sm mb-3">Navigasi Pusat Bantuan:</h4>
                        <div class="space-y-2 text-xs">
                            <a href="{{ route('faq.index') }}" class="block p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                                📌 Beranda Pusat Bantuan &amp; FAQ
                            </a>
                            <a href="{{ route('faq.category', $faq->category->slug ?? 'biaya-dan-estimasi-harga') }}" class="block p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                                {{ $faq->category->icon ?? '📁' }} Kategori {{ $faq->category->name ?? 'Layanan' }}
                            </a>
                            <a href="{{ route('layanan') }}" class="block p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 font-semibold text-slate-700 transition-colors">
                                🛠️ Lihat Daftar Katalog Layanan
                            </a>
                        </div>
                    </div>

                </div>
            </aside>

        </div>
    </main>
</div>

@push('scripts')
<script>
    let isHelpfulChoice = true;

    function handleFeedbackClick(helpful) {
        isHelpfulChoice = helpful;
        const btnWrapper = document.getElementById('feedback-buttons-wrapper');
        const unhelpfulPanel = document.getElementById('unhelpful-form-panel');

        if (helpful) {
            // Directly submit positive feedback
            submitFeedbackApi(true, null, null);
        } else {
            // Show reason form
            if (unhelpfulPanel) {
                unhelpfulPanel.classList.remove('hidden');
                unhelpfulPanel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    }

    function submitDetailedFeedback() {
        const reasonInput = document.querySelector('input[name="feedback_reason"]:checked');
        const commentInput = document.getElementById('feedback-comment-input');

        const reason = reasonInput ? reasonInput.value : 'Belum/Butuh Bantuan';
        const comment = commentInput ? commentInput.value.trim() : '';

        submitFeedbackApi(false, reason, comment);
    }

    function submitFeedbackApi(isHelpful, reason, comment) {
        const faqId = {{ $faq->id }};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        fetch(`/faq/${faqId}/feedback`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                is_helpful: isHelpful,
                reason: reason,
                comment: comment
            })
        })
        .then(res => res.json())
        .then(data => {
            const btnWrapper = document.getElementById('feedback-buttons-wrapper');
            const unhelpfulPanel = document.getElementById('unhelpful-form-panel');
            const thankYouPanel = document.getElementById('feedback-thankyou-panel');

            if (btnWrapper) btnWrapper.classList.add('hidden');
            if (unhelpfulPanel) unhelpfulPanel.classList.add('hidden');
            if (thankYouPanel) thankYouPanel.classList.remove('hidden');
        })
        .catch(err => {
            console.error('Feedback submission error:', err);
            // Fallback display
            const thankYouPanel = document.getElementById('feedback-thankyou-panel');
            if (thankYouPanel) thankYouPanel.classList.remove('hidden');
        });
    }
</script>
@endpush
@endsection
