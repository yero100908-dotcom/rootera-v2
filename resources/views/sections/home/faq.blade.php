<section class="section" aria-labelledby="faq-heading" style="position: relative; overflow: hidden; background-color: #ffffff;">
    <!-- Background Grid Pattern -->
    <div style="position: absolute; inset: 0; background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 50px 50px; z-index: 0; pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 10;">
        <div class="text-center" style="margin-bottom:4rem">
            <h2 class="section-title" id="faq-heading" style="margin-top:.75rem; font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 900; color: #0A2E78; line-height: 1.15; letter-spacing: -0.02em;">
                Pertanyaan Yang <span style="color: #169F81; font-style: italic;">Sering<br>Diajukan.</span>
            </h2>
            <div style="width: 50px; height: 4px; background-color: #169F81; margin: 1.25rem auto 0; border-radius: 2px;"></div>
        </div>
        
        <div class="faq-container" style="max-width:760px; margin:0 auto; display: flex; flex-direction: column; gap: 1.25rem;">
            @forelse($faqs ?? [] as $faq)
            <div class="faq-item" style="background: #ffffff; border-radius: 28px; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); overflow: hidden; transition: box-shadow 0.3s ease;">
                <button class="faq-question" aria-expanded="false" style="width: 100%; display: flex; align-items: center; justify-content: space-between; padding: 1.5rem 2rem; background: transparent; border: none; cursor: pointer; text-align: left;">
                    <span class="faq-text" style="font-size: 1.15rem; font-weight: 800; color: #0f172a; padding-right: 1rem;">{{ $faq->question }}</span>
                    <span class="faq-icon-wrapper" style="width: 32px; height: 32px; border-radius: 50%; background: #ffffff; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; flex-shrink: 0; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                        <svg class="faq-icon-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#169F81" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </span>
                </button>
                <div class="faq-answer-wrapper">
                    <div class="faq-answer-inner" style="padding: 0 2rem 1.5rem; color: #334155; font-size: 1.05rem; font-weight: 500; line-height: 1.6;">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-500 py-8">Belum ada FAQ.</div>
            @endforelse
        </div>

        <!-- Call to Action below FAQ -->
        <div class="text-center" style="margin-top: 5rem;">
            <p style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.15em; color: #94a3b8; text-transform: uppercase; margin-bottom: 1.5rem;">
                Punya pertanyaan lain yang belum terjawab?
            </p>
            <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20ada%20pertanyaan%20lain." target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.75rem; background-color: #0A2E78; color: #ffffff; padding: 1.1rem 2.5rem; border-radius: 50px; font-weight: 800; font-size: 0.9rem; text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(10, 46, 120, 0.15);">
                Tanya Via WhatsApp
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="#169F81"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            </a>
        </div>
    </div>
</section>

<style>
/* Reset basic faq-answer styles if there are any from app.css */
.faq-answer-wrapper {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
}
.faq-question[aria-expanded="true"] + .faq-answer-wrapper {
    max-height: 500px;
    opacity: 1;
}
.faq-question[aria-expanded="true"] .faq-icon-svg {
    transform: rotate(45deg);
    stroke: #94a3b8; /* Change to gray X */
}
.faq-question:hover .faq-icon-wrapper {
    border-color: #cbd5e1;
    background: #f8fafc;
}
.faq-item:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.04) !important;
}
</style>
