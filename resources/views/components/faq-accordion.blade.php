{{--
    KOMPONEN: FAQ Accordion
    Penggunaan: @include('components.faq-accordion', ['faqs' => $faqs])
--}}
@if($faqs->isNotEmpty())
<div class="space-y-3" id="faq-accordion">
    @foreach($faqs as $index => $faq)
    <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
        <button
            class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition-colors"
            onclick="toggleFaqAccordion({{ $index }})"
            aria-expanded="false"
            aria-controls="faq-answer-{{ $index }}"
        >
            <span class="font-semibold text-gray-800 pr-4 text-sm md:text-base">{{ $faq->question }}</span>
            <svg id="faq-icon-{{ $index }}"
                 class="w-5 h-5 text-blue-600 shrink-0 transition-transform duration-300"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div id="faq-answer-{{ $index }}"
             class="hidden px-6 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-50">
            <div class="pt-4">{{ $faq->answer }}</div>
        </div>
    </div>
    @endforeach
</div>

@push('scripts')
<script>
function toggleFaqAccordion(index) {
    const answer = document.getElementById(`faq-answer-${index}`);
    const icon = document.getElementById(`faq-icon-${index}`);
    const isOpen = !answer.classList.contains('hidden');

    // Close all
    document.querySelectorAll('[id^="faq-answer-"]').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('[id^="faq-icon-"]').forEach(el => el.style.transform = 'rotate(0deg)');

    // Open clicked (if was closed)
    if (!isOpen) {
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
@endpush
@else
<p class="text-center text-gray-400 py-8">Belum ada FAQ tersedia.</p>
@endif
