<section class="section bg-offwhite" aria-labelledby="faq-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-blue">Tanya Jawab</span>
            <h2 class="section-title" id="faq-heading" style="margin-top:.75rem">Pertanyaan yang Sering <span>Diajukan</span></h2>
            <p class="section-sub">Informasi cepat mengenai layanan, biaya, dan garansi dari Rooterin.</p>
        </div>
        
        <div class="faq-container" style="max-width:800px;margin:0 auto">
            @forelse($faqs ?? [] as $faq)
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-text">{{ $faq->question }}</span>
                    <span class="faq-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-inner">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 py-8">Belum ada FAQ.</div>
            @endforelse
        </div>
    </div>
</section>
