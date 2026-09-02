@props([
    'url' => null,
    'videoId' => null,
    'title' => 'Video Panduan Rootera Plumbing',
    'poster' => null,
    'autoplay' => true,
    'class' => '',
    'id' => null,
    'isShorts' => null,
    'aspect' => null
])

@php
    use App\Helpers\YouTubeHelper;

    $idInput = $videoId ?? $url;
    $extractedId = YouTubeHelper::extractId($idInput);
    $embedUrl = YouTubeHelper::getEmbedUrl($extractedId, ['autoplay' => 1, 'rel' => 0]);
    
    // Auto-detect shorts mode if not explicitly specified
    $isShortsMode = $isShorts ?? ($aspect === '9/16' || YouTubeHelper::isShorts($idInput));
    
    $thumbnailQuality = $isShortsMode ? 'hqdefault' : 'maxresdefault';
    $thumbnailUrl = $poster ?: (YouTubeHelper::getThumbnailUrl($extractedId, $thumbnailQuality, true) ?: YouTubeHelper::getThumbnailUrl($extractedId, 'hqdefault', false));
    $elementId = $id ?? 'yt-player-' . uniqid();
@endphp

@if($extractedId)
@if($isShortsMode)
{{-- VERTICAL 9:16 YOUTUBE SHORTS CONTAINER --}}
<div class="youtube-embed-wrapper relative w-full max-w-[340px] sm:max-w-[360px] mx-auto overflow-hidden rounded-2xl border border-slate-200/80 shadow-2xl bg-slate-950 my-6 transition-all duration-300 {{ $class }}"
     style="aspect-ratio: 9 / 16;"
     id="{{ $elementId }}">
    
    {{-- Facade / Lite Embed Thumbnail & Play Button --}}
    <div class="youtube-facade group absolute inset-0 w-full h-full cursor-pointer flex items-center justify-center transition-all duration-300"
         onclick="loadYouTubeIframe('{{ $elementId }}', '{{ $embedUrl }}', '{{ e($title) }}')"
         role="button"
         tabindex="0"
         onkeydown="if(event.key==='Enter'||event.key===' '){ loadYouTubeIframe('{{ $elementId }}', '{{ $embedUrl }}', '{{ e($title) }}'); }"
         aria-label="Putar YouTube Shorts: {{ $title }}">
        
        {{-- Thumbnail WebP --}}
        <img src="{{ $thumbnailUrl }}"
             alt="{{ $title }}"
             loading="lazy"
             decoding="async"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 opacity-90 group-hover:opacity-100"
             onerror="this.onerror=null; this.src='https://i.ytimg.com/vi/{{ $extractedId }}/hqdefault.jpg';">

        {{-- Dark Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-slate-950/20 pointer-events-none transition-opacity duration-300 group-hover:opacity-70"></div>

        {{-- Center Glassmorphism Play Button --}}
        <div class="relative z-10 flex flex-col items-center gap-3 px-4 text-center">
            <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-[0_0_30px_rgba(220,38,38,0.7)] backdrop-blur-md transition-all duration-300 group-hover:scale-110 group-hover:bg-red-600 group-hover:shadow-[0_0_40px_rgba(220,38,38,0.9)] border border-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="currentColor" class="ml-1 text-white"><path d="M8 5v14l11-7z"/></svg>
            </div>
            
            <span class="bg-slate-900/80 backdrop-blur-md border border-white/10 text-white text-xs font-extrabold px-3.5 py-1.5 rounded-full shadow-md transition-transform duration-300 group-hover:scale-105 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                Putar Shorts (9:16)
            </span>
        </div>

        {{-- Top Left Shorts Badge --}}
        <div class="absolute top-3 left-3 z-10 flex items-center gap-2">
            <span class="bg-red-600/95 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-lg uppercase tracking-wider shadow-md flex items-center gap-1.5">
                ⚡ YouTube Shorts
            </span>
        </div>
    </div>

    {{-- Fallback iframe --}}
    <noscript>
        <iframe src="https://www.youtube-nocookie.com/embed/{{ $extractedId }}"
                title="{{ $title }}"
                class="w-full h-full border-0 absolute inset-0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy">
        </iframe>
    </noscript>
</div>
@else
{{-- HORIZONTAL 16:9 REGULAR VIDEO CONTAINER --}}
<div class="youtube-embed-wrapper relative w-full overflow-hidden rounded-2xl border border-slate-200/80 shadow-lg bg-slate-950 my-6 transition-all duration-300 {{ $class }}"
     style="aspect-ratio: 16 / 9;"
     id="{{ $elementId }}">
    
    {{-- Facade / Lite Embed Thumbnail & Play Button --}}
    <div class="youtube-facade group absolute inset-0 w-full h-full cursor-pointer flex items-center justify-center transition-all duration-300"
         onclick="loadYouTubeIframe('{{ $elementId }}', '{{ $embedUrl }}', '{{ e($title) }}')"
         role="button"
         tabindex="0"
         onkeydown="if(event.key==='Enter'||event.key===' '){ loadYouTubeIframe('{{ $elementId }}', '{{ $embedUrl }}', '{{ e($title) }}'); }"
         aria-label="Putar Video YouTube: {{ $title }}">
        
        {{-- Thumbnail WebP --}}
        <img src="{{ $thumbnailUrl }}"
             alt="{{ $title }}"
             loading="lazy"
             decoding="async"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 opacity-90 group-hover:opacity-100"
             onerror="this.onerror=null; this.src='https://i.ytimg.com/vi/{{ $extractedId }}/hqdefault.jpg';">

        {{-- Dark Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent pointer-events-none transition-opacity duration-300 group-hover:opacity-60"></div>

        {{-- Center Glassmorphism Play Button --}}
        <div class="relative z-10 flex flex-col items-center gap-3">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-[0_0_30px_rgba(220,38,38,0.6)] backdrop-blur-md transition-all duration-300 group-hover:scale-110 group-hover:bg-red-600 group-hover:shadow-[0_0_40px_rgba(220,38,38,0.8)] border border-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" class="ml-1 text-white"><path d="M8 5v14l11-7z"/></svg>
            </div>
            
            <span class="bg-slate-900/80 backdrop-blur-md border border-white/10 text-white text-xs sm:text-sm font-extrabold px-4 py-1.5 rounded-full shadow-md transition-transform duration-300 group-hover:scale-105 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                Tonton Video
            </span>
        </div>

        {{-- Top Left Brand Badge --}}
        <div class="absolute top-3 left-3 z-10 flex items-center gap-2">
            <span class="bg-red-600/95 text-white text-[11px] font-extrabold px-3 py-1 rounded-lg uppercase tracking-wider shadow-md flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                YouTube HD
            </span>
        </div>
    </div>

    {{-- Fallback iframe for crawlers / SEO / no-JS --}}
    <noscript>
        <iframe src="https://www.youtube-nocookie.com/embed/{{ $extractedId }}"
                title="{{ $title }}"
                class="w-full h-full border-0 absolute inset-0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy">
        </iframe>
    </noscript>
</div>
@endif

@once
@push('scripts')
<script>
if (typeof window.loadYouTubeIframe === 'undefined') {
    window.loadYouTubeIframe = function(wrapperId, embedUrl, title) {
        const wrapper = document.getElementById(wrapperId);
        if (!wrapper) return;

        const iframe = document.createElement('iframe');
        iframe.src = embedUrl;
        iframe.title = title;
        iframe.className = 'w-full h-full border-0 absolute inset-0 rounded-2xl';
        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
        iframe.setAttribute('allowfullscreen', 'true');
        iframe.setAttribute('loading', 'lazy');
        
        wrapper.innerHTML = '';
        wrapper.appendChild(iframe);
    };
}
</script>
@endpush
@endonce
@endif
