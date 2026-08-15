<section class="section bg-slate-50 relative overflow-hidden" aria-labelledby="faq-heading">
    <div class="container relative z-10">
        <div class="text-center mb-12">
            <span class="badge badge-green">FAQ & Jawaban</span>
            <h2 class="section-title" id="faq-heading">
                Pertanyaan Yang <span>Sering Diajukan</span>
            </h2>
            <p class="section-sub">Informasi lengkap seputar estimasi pengerjaan, keamanan pipa PVC, garansi resmi, dan metode pelancaran mampet Rootera.</p>
        </div>
        
        <div class="faq-container max-w-3xl mx-auto space-y-4">
            @forelse($faqs ?? [] as $faq)
            <div class="faq-item bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300">
                <button class="faq-question w-full flex items-center justify-between p-6 text-left focus:outline-none" aria-expanded="false">
                    <span class="faq-text text-base sm:text-lg font-bold text-slate-900 pr-4">{{ $faq->question }}</span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 transition-transform duration-300">
                        <svg class="faq-icon-svg w-4 h-4 text-teal-600 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                </button>
                <div class="faq-answer-wrapper max-h-0 overflow-hidden opacity-0 transition-all duration-400 ease-in-out">
                    <div class="faq-answer-inner px-6 pb-6 text-slate-600 text-sm sm:text-base leading-relaxed">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 py-8">Belum ada FAQ terdaftar.</div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">
                Punya Pertanyaan Lain yang Belum Terjawab?
            </p>
            <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20ada%20pertanyaan%20seputar%20saluran%20mampet." target="_blank" rel="noopener noreferrer" class="btn btn-primary shadow-lg hover:shadow-xl inline-flex items-center gap-2">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                <span>Konsultasi Gratis via WhatsApp</span>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(btn => {
        btn.addEventListener('click', function () {
            const isExpanded = btn.getAttribute('aria-expanded') === 'true';
            const wrapper = btn.nextElementSibling;
            const iconSvg = btn.querySelector('.faq-icon-svg');
            
            // Close all other items
            faqQuestions.forEach(otherBtn => {
                if (otherBtn !== btn) {
                    otherBtn.setAttribute('aria-expanded', 'false');
                    if (otherBtn.nextElementSibling) {
                        otherBtn.nextElementSibling.style.maxHeight = '0';
                        otherBtn.nextElementSibling.style.opacity = '0';
                    }
                    const otherSvg = otherBtn.querySelector('.faq-icon-svg');
                    if (otherSvg) otherSvg.style.transform = 'rotate(0deg)';
                }
            });

            if (!isExpanded) {
                btn.setAttribute('aria-expanded', 'true');
                wrapper.style.maxHeight = wrapper.scrollHeight + 'px';
                wrapper.style.opacity = '1';
                if (iconSvg) iconSvg.style.transform = 'rotate(45deg)';
            } else {
                btn.setAttribute('aria-expanded', 'false');
                wrapper.style.maxHeight = '0';
                wrapper.style.opacity = '0';
                if (iconSvg) iconSvg.style.transform = 'rotate(0deg)';
            }
        });
    });
});
</script>
