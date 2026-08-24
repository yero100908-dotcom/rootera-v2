@props([
    'height' => '350',
    'class' => '',
])

<div class="w-full rounded-xl overflow-hidden shadow-sm border border-slate-200/80 bg-white {{ $class }}">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5128341974773!2d106.8627791!3d-6.3275261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed006e00b8b5%3A0xde36fb02cfc2b7a5!2sRootera%20Plumbing%20-%20Jasa%20Saluran%20Pipa%20Mampet!5e0!3m2!1sid!2sid!4v1787559252154!5m2!1sid!2sid" 
        width="100%" 
        height="{{ $height }}" 
        style="border:0; border-radius: 12px; display: block;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="strict-origin-when-cross-origin"
        title="Google Maps Lokasi Resmi Rootera Plumbing">
    </iframe>
</div>
