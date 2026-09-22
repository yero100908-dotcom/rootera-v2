<!-- TEST FAQ BARU -->
<section id="faq-section" class="relative pt-16 sm:pt-20 pb-20 sm:pb-24 bg-gradient-to-b from-slate-50/70 via-white to-slate-50/50 overflow-hidden scroll-mt-24 sm:scroll-mt-28" aria-labelledby="faq-heading">
    {{-- Ambient Glow Decorative Orbs --}}
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gradient-to-tr from-emerald-500/10 via-teal-400/5 to-cyan-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[300px] bg-emerald-500/5 blur-[100px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center mb-10 sm:mb-14 max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/25 text-emerald-700 text-[11px] sm:text-xs font-extrabold uppercase tracking-wider mb-3.5 backdrop-blur-md shadow-xs">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span>PUSAT INFORMASI &amp; FAQ</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-[2.5rem] font-extrabold text-[#0b2b64] tracking-tight font-['Plus_Jakarta_Sans',sans-serif] leading-tight sm:leading-tight" id="faq-heading">
                Pertanyaan Umum Jasa Saluran Mampet <span class="bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 bg-clip-text text-transparent">Rootera</span>
            </h2>
            <p class="text-xs sm:text-base text-slate-600 mt-3 leading-relaxed max-w-2xl mx-auto font-normal">
                Jawaban transparan seputar metode pengerjaan tanpa bongkar, garansi resmi 30 hari, SLA kedatangan teknisi, hingga estimasi biaya.
            </p>
        </div>
        
        {{-- FAQ Accordion List --}}
        <div class="max-w-3xl mx-auto flex flex-col gap-3.5 sm:gap-4" id="home-faq-container" itemscope itemtype="https://schema.org/FAQPage">
            @forelse($faqs ?? [] as $index => $faq)
            <div class="faq-item group bg-white border border-slate-200/80 rounded-2xl shadow-xs hover:shadow-md transition-all duration-300 overflow-hidden" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <button type="button" 
                        class="faq-question w-full text-left px-4 py-4 sm:px-6 sm:py-5 min-h-[52px] flex items-center justify-between gap-4 transition-colors focus:outline-none cursor-pointer select-none" 
                        aria-expanded="false" 
                        aria-controls="faq-answer-{{ $index }}"
                        onclick="toggleHomeFaq(this)">
                    
                    <div class="flex items-center gap-3 sm:gap-4 pr-2">
                        {{-- Badge Nomor Urut --}}
                        <span class="faq-number-badge w-7 h-7 sm:w-8 sm:h-8 rounded-full shrink-0 flex items-center justify-center font-extrabold text-xs transition-all shadow-xs bg-teal-50 text-[#169F81] border border-teal-200/60">
                            {{ sprintf('%02d', $index + 1) }}
                        </span>

                        <div class="space-y-0.5">
                            @if(isset($faq->category))
                            <div class="mb-0.5">
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-700 rounded-full text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1 border border-slate-200/80">
                                    <span>{{ $faq->category->icon ?? '❓' }}</span> <span>{{ $faq->category->name }}</span>
                                </span>
                            </div>
                            @endif
                            <h3 class="faq-text text-sm sm:text-base font-bold text-slate-900 group-hover:text-emerald-700 transition-colors font-['Plus_Jakarta_Sans',sans-serif] leading-snug" itemprop="name">
                                {{ $faq->question }}
                            </h3>
                        </div>
                    </div>
                    
                    {{-- Toggle Chevron Circle --}}
                    <span class="faq-icon-wrapper w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 transition-all duration-300 border border-slate-200/80">
                        <svg class="faq-icon w-4 h-4 fill-current transition-transform duration-300" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </button>

                <div id="faq-answer-{{ $index }}" class="faq-answer-wrapper max-h-0 overflow-hidden transition-all duration-300 ease-in-out opacity-0" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="faq-answer-inner px-4 pb-5 sm:px-6 sm:pb-6 pt-3.5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 bg-white/70" itemprop="text">
                        <div class="prose prose-slate prose-sm max-w-none text-slate-600 leading-relaxed">
                            {!! $faq->answer !!}
                        </div>

                        {{-- Footer Link di Dalam Jawaban --}}
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs flex-wrap gap-2">
                            <a href="{{ isset($faq->slug) ? route('faq.show', $faq->slug) : route('faq.index') }}" class="text-emerald-600 font-bold hover:underline flex items-center gap-1">
                                Lihat Detail FAQ &rarr;
                            </a>
                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin menanyakan lebih lanjut mengenai: ' . $faq->question) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="text-slate-500 hover:text-emerald-600 font-semibold transition-colors flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 fill-current text-emerald-500" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/>
                                </svg>
                                <span>💬 Tanya CS via WA</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 py-10 text-xs sm:text-sm bg-white/60 rounded-2xl border border-dashed border-slate-200">
                Belum ada daftar FAQ yang ditampilkan saat ini.
            </div>
            @endforelse
        </div>

        {{-- Unified Bottom CTA Card (Masih Butuh Bantuan Spesifik?) --}}
        <div class="mt-12 sm:mt-16 max-w-3xl mx-auto">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0b172a] via-[#0f233d] to-[#071324] p-6 sm:p-8 md:p-9 text-white border border-slate-700/60 shadow-2xl shadow-slate-900/10">
                
                {{-- Background Ambient Glow & Glass Orbs --}}
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px] opacity-5 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-8">
                    
                    {{-- Left Info Area --}}
                    <div class="text-center md:text-left space-y-2">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 text-emerald-400 text-xs font-semibold backdrop-blur-md">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Layanan Konsultasi Gratis 24/7</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif] tracking-tight">
                            Masih Butuh Bantuan Spesifik?
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-300 max-w-md leading-relaxed">
                            Tim customer support &amp; teknisi spesialis Rootera siap memberikan rekomendasi penanganan masalah pipa Anda secara instan.
                        </p>
                    </div>

                    {{-- Right Action Buttons --}}
                    <div class="flex flex-col sm:flex-row md:flex-col lg:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto shrink-0">
                        {{-- Primary Action: WhatsApp --}}
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ada pertanyaan mengenai masalah pipa mampet di lokasi saya.') }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="group relative inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 hover:from-emerald-400 hover:to-teal-400 text-white font-extrabold rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-xs sm:text-sm text-decoration-none overflow-hidden">
                            
                            <span class="absolute inset-0 w-full h-full bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out pointer-events-none"></span>
                            
                            <svg class="w-5 h-5 fill-current shrink-0 group-hover:scale-110 transition-transform duration-200" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/>
                            </svg>
                            <span>Konsultasi WhatsApp</span>
                        </a>

                        {{-- Secondary Action: FAQ Center --}}
                        <a href="{{ route('faq.index') }}" 
                           class="group inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-white/10 hover:bg-white/20 active:bg-white/25 text-white font-bold rounded-xl border border-white/20 hover:border-white/30 backdrop-blur-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-xs sm:text-sm text-decoration-none whitespace-nowrap">
                            <span>Lihat Semua FAQ</span>
                            <svg class="w-4 h-4 stroke-current fill-none transition-transform duration-200 group-hover:translate-x-1" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<script>
function toggleHomeFaq(btn) {
    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
    const container = document.getElementById('home-faq-container');
    const allButtons = container ? container.querySelectorAll('.faq-question') : [];

    // Exclusive Accordion: Close all other active items first
    allButtons.forEach(otherBtn => {
        if (otherBtn !== btn) {
            otherBtn.setAttribute('aria-expanded', 'false');
            const otherWrapper = otherBtn.nextElementSibling;
            const otherCard = otherBtn.closest('.faq-item');
            const otherNumBadge = otherBtn.querySelector('.faq-number-badge');
            const otherIconWrap = otherBtn.querySelector('.faq-icon-wrapper');

            if (otherWrapper) {
                otherWrapper.style.maxHeight = '0px';
                otherWrapper.style.opacity = '0';
            }
            if (otherCard) {
                otherCard.classList.remove('border-l-4', 'border-l-[#169F81]', 'border-emerald-500/80', 'bg-emerald-50/20', 'shadow-md');
                otherCard.classList.add('border-slate-200/80', 'bg-white', 'shadow-xs');
            }
            if (otherNumBadge) {
                otherNumBadge.classList.remove('bg-[#169F81]', 'text-white', 'ring-2', 'ring-emerald-200', 'border-[#169F81]');
                otherNumBadge.classList.add('bg-teal-50', 'text-[#169F81]', 'border', 'border-teal-200/60');
            }
            if (otherIconWrap) {
                otherIconWrap.classList.remove('rotate-180', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-300');
                otherIconWrap.classList.add('rotate-0', 'bg-slate-100', 'text-slate-500', 'border-slate-200/80');
            }
        }
    });

    // Toggle current item
    const answerWrapper = btn.nextElementSibling;
    const answerInner = answerWrapper ? answerWrapper.querySelector('.faq-answer-inner') : null;
    const cardItem = btn.closest('.faq-item');
    const numBadge = btn.querySelector('.faq-number-badge');
    const iconWrap = btn.querySelector('.faq-icon-wrapper');

    if (isExpanded) {
        btn.setAttribute('aria-expanded', 'false');
        if (answerWrapper) {
            answerWrapper.style.maxHeight = '0px';
            answerWrapper.style.opacity = '0';
        }
        if (cardItem) {
            cardItem.classList.remove('border-l-4', 'border-l-[#169F81]', 'border-emerald-500/80', 'bg-emerald-50/20', 'shadow-md');
            cardItem.classList.add('border-slate-200/80', 'bg-white', 'shadow-xs');
        }
        if (numBadge) {
            numBadge.classList.remove('bg-[#169F81]', 'text-white', 'ring-2', 'ring-emerald-200', 'border-[#169F81]');
            numBadge.classList.add('bg-teal-50', 'text-[#169F81]', 'border', 'border-teal-200/60');
        }
        if (iconWrap) {
            iconWrap.classList.remove('rotate-180', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-300');
            iconWrap.classList.add('rotate-0', 'bg-slate-100', 'text-slate-500', 'border-slate-200/80');
        }
    } else {
        btn.setAttribute('aria-expanded', 'true');
        if (answerWrapper && answerInner) {
            answerWrapper.style.maxHeight = (answerInner.scrollHeight + 50) + 'px';
            answerWrapper.style.opacity = '1';
        }
        if (cardItem) {
            cardItem.classList.remove('border-slate-200/80', 'bg-white', 'shadow-xs');
            cardItem.classList.add('border-l-4', 'border-l-[#169F81]', 'border-emerald-500/80', 'bg-emerald-50/20', 'shadow-md');
        }
        if (numBadge) {
            numBadge.classList.remove('bg-teal-50', 'text-[#169F81]', 'border', 'border-teal-200/60');
            numBadge.classList.add('bg-[#169F81]', 'text-white', 'ring-2', 'ring-emerald-200', 'border-[#169F81]');
        }
        if (iconWrap) {
            iconWrap.classList.remove('rotate-0', 'bg-slate-100', 'text-slate-500', 'border-slate-200/80');
            iconWrap.classList.add('rotate-180', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-300');
        }
    }
}
</script>


