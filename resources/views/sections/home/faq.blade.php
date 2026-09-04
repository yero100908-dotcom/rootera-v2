<section class="section" aria-labelledby="faq-heading" style="position: relative; overflow: hidden; background-color: #ffffff; padding: 5rem 0;">
    <div class="container" style="position: relative; z-index: 10;">
        
        <div class="text-center" style="max-width: 750px; margin: 0 auto 3.5rem;">
            <span style="background: rgba(11, 43, 100, 0.08); color: #0b2b64; font-size: 0.8rem; font-weight: 800; padding: 0.35rem 1rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 1rem;">
                ❓ PERTANYAAN UMUM (FAQ)
            </span>
            <h2 class="section-title" id="faq-heading" style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #0b2b64; margin-bottom: 0.75rem;">
                FAQ Jasa Saluran Pipa Mampet <span style="background: linear-gradient(90deg, #0b2b64, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Rootera</span>
            </h2>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">
                Jawaban cepat seputar metode pengerjaan tanpa bongkar, garansi 30 hari, dan estimasi waktu teknisi tiba.
            </p>
        </div>
        
        <div class="faq-container" style="max-width:820px; margin:0 auto; display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($faqs ?? [] as $faq)
            <div class="faq-item" style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.02); overflow: hidden; transition: all 0.3s ease;">
                <button type="button" class="faq-question" aria-expanded="false" onclick="toggleHomeFaq(this)" style="width: 100%; display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.75rem; background: transparent; border: none; cursor: pointer; text-align: left;">
                    <span class="faq-text" style="font-size: 1.05rem; font-weight: 800; color: #0f172a; padding-right: 1rem;">{{ $faq->question }}</span>
                    <span class="faq-icon-wrapper" style="width: 32px; height: 32px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: transform 0.3s ease;">
                        <svg class="faq-icon-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </span>
                </button>
                <div class="faq-answer-wrapper" style="max-height: 0; overflow: hidden; transition: max-height 0.4s ease, opacity 0.3s ease; opacity: 0;">
                    <div class="faq-answer-inner" style="padding: 0 1.75rem 1.5rem; color: #475569; font-size: 0.95rem; line-height: 1.6;">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 py-8">Belum ada FAQ.</div>
            @endforelse
        </div>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ada pertanyaan mengenai masalah pipa mampet.') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-900/20 transition-all text-sm sm:text-base text-decoration-none">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
                Konsultasi Langsung via WhatsApp
            </a>
            <a href="{{ route('faq.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold rounded-xl border border-slate-300 transition-all text-sm sm:text-base text-decoration-none">
                📖 Lihat Pusat Bantuan FAQ →
            </a>
        </div>

    </div>
</section>

<script>
function toggleHomeFaq(btn) {
    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
    const answerWrapper = btn.nextElementSibling;
    const svgIcon = btn.querySelector('.faq-icon-svg');

    if (isExpanded) {
        btn.setAttribute('aria-expanded', 'false');
        answerWrapper.style.maxHeight = '0';
        answerWrapper.style.opacity = '0';
        if (svgIcon) svgIcon.style.transform = 'rotate(0deg)';
    } else {
        btn.setAttribute('aria-expanded', 'true');
        answerWrapper.style.maxHeight = '500px';
        answerWrapper.style.opacity = '1';
        if (svgIcon) svgIcon.style.transform = 'rotate(45deg)';
    }
}
</script>
