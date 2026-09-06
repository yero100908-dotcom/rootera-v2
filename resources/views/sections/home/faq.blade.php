<section id="faq-section" class="relative pt-12 sm:pt-16 pb-24 sm:pb-20 md:pb-24 bg-white overflow-hidden scroll-mt-24 sm:scroll-mt-28" aria-labelledby="faq-heading">
    {{-- Ambient Glow Decorative Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-emerald-500/5 blur-[120px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center mb-8 sm:mb-12 max-w-2xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 text-[11px] sm:text-xs font-extrabold uppercase tracking-wider mb-2.5 shadow-2xs">
                ❓ PERTANYAAN UMUM (FAQ)
            </span>
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-[#0b2b64] tracking-tight font-['Plus_Jakarta_Sans',sans-serif] leading-tight" id="faq-heading">
                FAQ Jasa Saluran Pipa Mampet <span class="bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 bg-clip-text text-transparent">Rootera</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                Jawaban cepat seputar metode pengerjaan tanpa bongkar, garansi 30 hari, dan estimasi waktu teknisi tiba.
            </p>
        </div>
        
        {{-- FAQ Accordion List --}}
        <div class="max-w-3xl mx-auto flex flex-col gap-3 sm:gap-4" id="home-faq-container">
            @forelse($faqs ?? [] as $index => $faq)
            <div class="faq-item bg-white border border-slate-200/80 rounded-2xl shadow-2xs hover:shadow-md transition-all duration-300 overflow-hidden">
                <button type="button" 
                        class="faq-question w-full flex items-center justify-between gap-3 px-4 py-3.5 sm:px-6 sm:py-4 bg-transparent border-none cursor-pointer text-left transition-colors" 
                        aria-expanded="false" 
                        onclick="toggleHomeFaq(this)">
                    <span class="faq-text text-sm sm:text-base font-bold text-slate-800 transition-colors font-['Plus_Jakarta_Sans',sans-serif]">
                        {{ $faq->question }}
                    </span>
                    <span class="faq-icon-wrapper w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 transition-all duration-300">
                        <svg class="faq-chevron w-4 h-4 transition-transform duration-300 fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div class="faq-answer-wrapper max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                    <div class="faq-answer-inner px-4 pb-4 sm:px-6 sm:pb-5 pt-1 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100/80 mt-1">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 py-8 text-xs sm:text-sm">Belum ada daftar FAQ yang ditampilkan.</div>
            @endforelse
        </div>

        {{-- Footer CTA Buttons --}}
        <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 max-w-xl mx-auto pb-4 sm:pb-0">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ada pertanyaan mengenai masalah pipa mampet di lokasi saya.') }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 sm:px-6 sm:py-3.5 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all text-xs sm:text-sm text-decoration-none">
                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
                <span>Konsultasi Langsung via WhatsApp</span>
            </a>
            <a href="{{ route('faq.index') }}" 
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 sm:px-6 sm:py-3.5 bg-slate-100 hover:bg-slate-200 active:bg-slate-300 text-slate-800 font-bold rounded-xl border border-slate-300/80 transition-all text-xs sm:text-sm text-decoration-none">
                <span>📖 Lihat Pusat Bantuan FAQ</span>
                <span>→</span>
            </a>
        </div>

    </div>
</section>

<script>
function toggleHomeFaq(btn) {
    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
    const container = document.getElementById('home-faq-container');
    const allButtons = container ? container.querySelectorAll('.faq-question') : [];

    // Single-open (Exclusive Accordion): Close all other active items first
    allButtons.forEach(otherBtn => {
        if (otherBtn !== btn) {
            otherBtn.setAttribute('aria-expanded', 'false');
            const otherWrapper = otherBtn.nextElementSibling;
            const otherCard = otherBtn.closest('.faq-item');
            const otherIconWrap = otherBtn.querySelector('.faq-icon-wrapper');
            const otherChevron = otherBtn.querySelector('.faq-chevron');
            const otherText = otherBtn.querySelector('.faq-text');

            if (otherWrapper) {
                otherWrapper.style.maxHeight = '0px';
                otherWrapper.style.opacity = '0';
            }
            if (otherCard) {
                otherCard.classList.remove('border-emerald-500', 'ring-1', 'ring-emerald-500/40', 'bg-slate-50/50');
                otherCard.classList.add('border-slate-200/80', 'bg-white');
            }
            if (otherIconWrap) {
                otherIconWrap.classList.remove('bg-emerald-500', 'text-white');
                otherIconWrap.classList.add('bg-slate-100', 'text-slate-600');
            }
            if (otherChevron) {
                otherChevron.style.transform = 'rotate(0deg)';
            }
            if (otherText) {
                otherText.classList.remove('text-emerald-700');
                otherText.classList.add('text-slate-800');
            }
        }
    });

    // Toggle current item
    const answerWrapper = btn.nextElementSibling;
    const answerInner = answerWrapper ? answerWrapper.querySelector('.faq-answer-inner') : null;
    const cardItem = btn.closest('.faq-item');
    const iconWrap = btn.querySelector('.faq-icon-wrapper');
    const chevron = btn.querySelector('.faq-chevron');
    const textEl = btn.querySelector('.faq-text');

    if (isExpanded) {
        btn.setAttribute('aria-expanded', 'false');
        if (answerWrapper) {
            answerWrapper.style.maxHeight = '0px';
            answerWrapper.style.opacity = '0';
        }
        if (cardItem) {
            cardItem.classList.remove('border-emerald-500', 'ring-1', 'ring-emerald-500/40', 'bg-slate-50/50');
            cardItem.classList.add('border-slate-200/80', 'bg-white');
        }
        if (iconWrap) {
            iconWrap.classList.remove('bg-emerald-500', 'text-white');
            iconWrap.classList.add('bg-slate-100', 'text-slate-600');
        }
        if (chevron) {
            chevron.style.transform = 'rotate(0deg)';
        }
        if (textEl) {
            textEl.classList.remove('text-emerald-700');
            textEl.classList.add('text-slate-800');
        }
    } else {
        btn.setAttribute('aria-expanded', 'true');
        if (answerWrapper && answerInner) {
            answerWrapper.style.maxHeight = (answerInner.scrollHeight + 30) + 'px';
            answerWrapper.style.opacity = '1';
        }
        if (cardItem) {
            cardItem.classList.remove('border-slate-200/80', 'bg-white');
            cardItem.classList.add('border-emerald-500', 'ring-1', 'ring-emerald-500/40', 'bg-slate-50/50');
        }
        if (iconWrap) {
            iconWrap.classList.remove('bg-slate-100', 'text-slate-600');
            iconWrap.classList.add('bg-emerald-500', 'text-white');
        }
        if (chevron) {
            chevron.style.transform = 'rotate(180deg)';
        }
        if (textEl) {
            textEl.classList.remove('text-slate-800');
            textEl.classList.add('text-emerald-700');
        }
    }
}
</script>
