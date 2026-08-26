<style>
    .showcase-slider {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        min-height: 300px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        background: #0f172a;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .showcase-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease, visibility 0.8s ease;
        z-index: 0;
    }
    .showcase-slide.active-slide {
        opacity: 1;
        visibility: visible;
        z-index: 10;
    }
    .showcase-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1);
        transition: transform 7s linear;
    }
    .showcase-slide.active-slide img {
        transform: scale(1.08); /* Slow luxurious zoom */
    }
    .showcase-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 2.5rem 1.5rem 1.5rem;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.5) 50%, transparent 100%);
        color: #fff;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.5s ease 0.3s;
    }
    .showcase-slide.active-slide .showcase-info {
        transform: translateY(0);
        opacity: 1;
    }
    .slider-dots {
        position: absolute;
        bottom: 1.25rem;
        right: 1.5rem;
        display: flex;
        gap: 6px;
        z-index: 20;
    }
    .slider-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .slider-dot.active-dot {
        background: #10b981;
        width: 24px;
        border-radius: 4px;
    }
    .slider-progress {
        position: absolute;
        top: 0;
        left: 0;
        height: 4px;
        background: #10b981;
        width: 0%;
        z-index: 20;
    }
    #galeri-kerja-nyata {
        scroll-margin-top: 100px;
    }
</style>

<section id="galeri-kerja-nyata" class="w-full relative py-16 sm:py-24 overflow-hidden bg-gradient-to-b from-white via-slate-50 to-emerald-50/20">
    
    <!-- Subtle Grid Watermark -->
    <div class="absolute inset-0 pointer-events-none opacity-5" style="background-image: linear-gradient(#0f172a 1px, transparent 1px), linear-gradient(90deg, #0f172a 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <!-- Inner Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header Section -->
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs sm:text-sm font-semibold uppercase tracking-wider mb-4">
                <span class="w-2 h-2 rounded-full bg-[#10b981] animate-pulse"></span>
                Tentang Kami Dari Customers
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0f172a] tracking-tight leading-tight">
                Galeri Hasil <span class="text-[#10b981]">Kerja Nyata Kami!</span>
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto">
                Melihat adalah percaya. Lihat langsung bagaimana tim profesional Rootera menyelesaikan berbagai masalah saluran dengan alat canggih tanpa membongkar struktur bangunan.
            </p>
        </div>

        <!-- Banner Showcase Card -->
        <div class="bg-[#0d1b2a] border border-slate-800 rounded-3xl p-6 sm:p-10 shadow-2xl grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-24 relative overflow-hidden">
            
            <!-- LEFT: Image Auto Slider -->
            <div class="showcase-slider" id="showcase-slider-frame" onmouseenter="pauseSlider()" onmouseleave="resumeSlider()">
                <div class="slider-progress" id="slider-progress"></div>
                
                @forelse($galleryPhotos as $index => $photo)
                <div class="showcase-slide" data-category="{{ strtolower($photo->category ?? 'residential') }}" data-index="{{ $index }}">
                    <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" onerror="this.src='{{ asset('images/JnJ.jpeg') }}'">
                    
                    @if($photo->youtube_id)
                    <!-- Play Icon Overay for Video Thumbnail -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10 pb-10">
                        <div class="w-14 h-14 rounded-full bg-teal-500/80 text-white flex items-center justify-center shadow-lg shadow-teal-500/30 backdrop-blur-sm">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 ml-1"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Caption Foto -->
                    <div class="showcase-info">
                        <h3 class="text-lg font-bold mb-1 text-white">{{ $photo->title }}</h3>
                        <span class="text-[#10b981] text-xs uppercase font-extrabold tracking-wider">
                            {{ $photo->category ?? 'Portofolio' }}
                        </span>
                    </div>
                </div>
                @empty
                <!-- Empty Showcase fallback -->
                <div class="flex flex-col items-center justify-center w-full h-full text-white/40">
                    <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Belum ada dokumentasi galeri.
                </div>
                @endforelse
                
                <div class="slider-dots" id="slider-dots"></div>
            </div>

            <!-- RIGHT: Teks Konten & Filter -->
            <div class="relative z-10 flex flex-col justify-center">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/15 border border-[#10b981]/30 text-[#10b981] text-xs font-semibold uppercase tracking-wider mb-4 w-fit">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#10b981]"></span>
                    Portofolio
                </span>
                
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight mb-4">
                    Bukti Nyata <span class="text-[#10b981]">Cara Kami Bekerja</span>
                </h3>
                
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6">
                    Lihat langsung bagaimana tim profesional Rootera menyelesaikan berbagai masalah saluran, dari residensial rumit hingga komersial berskala besar dengan alat canggih tanpa membongkar lantai keramik Anda.
                </p>

                <!-- Interactive Filters -->
                <div class="flex flex-wrap gap-2 mb-6" id="gallery-tabs-slider">
                    <button class="showcase-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white transition-all cursor-pointer" data-filter="all">Terkini</button>
                    <button class="showcase-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white transition-all cursor-pointer" data-filter="residential">Residential</button>
                    <button class="showcase-tab px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white transition-all cursor-pointer" data-filter="commercial">Commercial</button>
                </div>

                <!-- Call To Action -->
                <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-[#0d1b2a] font-bold text-sm sm:text-base w-fit transition-all duration-300 hover:bg-[#10b981] hover:text-white hover:-translate-y-0.5 hover:shadow-lg hover:shadow-emerald-500/20">
                    Lihat Portofolio Lengkap
                    <svg class="w-4 h-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>



    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.showcase-slide');
    const tabs = document.querySelectorAll('.showcase-tab');
    const progressBar = document.getElementById('slider-progress');
    const dotsContainer = document.getElementById('slider-dots');
    
    if(slides.length === 0) return;

    let currentIndex = 0;
    let timer;
    let isPaused = false;
    const intervalTime = 3000;
    let activeFilter = 'all';

    function getFilteredSlides() {
        if(activeFilter === 'all') return Array.from(slides);
        return Array.from(slides).filter(slide => slide.getAttribute('data-category') === activeFilter);
    }

    function renderDots(filteredSlides) {
        if(!dotsContainer) return;
        dotsContainer.innerHTML = '';
        if (filteredSlides.length <= 1) return;

        filteredSlides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = `slider-dot ${index === currentIndex ? 'active-dot' : ''}`;
            dot.addEventListener('click', () => {
                stopSlider();
                showSlide(index);
                startSlider();
            });
            dotsContainer.appendChild(dot);
        });
    }

    function showSlide(index) {
        const filteredSlides = getFilteredSlides();
        
        if(filteredSlides.length === 0) {
            slides.forEach(s => s.classList.remove('active-slide'));
            if(progressBar) { progressBar.style.transition = 'none'; progressBar.style.width = '0%'; }
            if(dotsContainer) dotsContainer.innerHTML = '';
            return;
        }

        if(index >= filteredSlides.length) currentIndex = 0;
        else if(index < 0) currentIndex = filteredSlides.length - 1;
        else currentIndex = index;

        // Hide all
        slides.forEach(s => s.classList.remove('active-slide'));
        
        // Show active
        filteredSlides[currentIndex].classList.add('active-slide');

        renderDots(filteredSlides);

        if(progressBar) {
            progressBar.style.transition = 'none';
            progressBar.style.width = '0%';
            
            // Force layout recalculation
            void progressBar.offsetWidth;
            
            if(!isPaused && filteredSlides.length > 1) {
                progressBar.style.transition = `width ${intervalTime}ms linear`;
                progressBar.style.width = '100%';
            }
        }
    }

    function startSlider() {
        stopSlider();
        const filteredSlides = getFilteredSlides();
        if(filteredSlides.length > 1) {
            timer = setInterval(() => {
                if(!isPaused) {
                    showSlide(currentIndex + 1);
                }
            }, intervalTime);
        }
    }
    
    function stopSlider() {
        clearInterval(timer);
    }

    // Hover event logic for progress bar pause/resume
    window.pauseSlider = function() {
        isPaused = true;
        if(progressBar) {
            const currentWidth = progressBar.offsetWidth;
            const parentWidth = progressBar.parentElement.offsetWidth;
            progressBar.style.transition = 'none';
            progressBar.style.width = (parentWidth > 0 ? (currentWidth / parentWidth * 100) : 0) + '%';
        }
    }
    
    window.resumeSlider = function() {
        isPaused = false;
        if(progressBar) {
            const currentWidth = progressBar.offsetWidth;
            const parentWidth = progressBar.parentElement.offsetWidth;
            if (parentWidth === 0) return;
            const remainingPercent = 100 - (currentWidth / parentWidth * 100);
            const remainingTime = (remainingPercent / 100) * intervalTime;
            
            progressBar.style.transition = `width ${remainingTime}ms linear`;
            progressBar.style.width = '100%';
        }
    }

    // Filter Logic
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active-tab'));
            tab.classList.add('active-tab');

            activeFilter = tab.getAttribute('data-filter');
            currentIndex = 0;
            
            showSlide(0);
            startSlider();
        });
    });

    // Start everything
    showSlide(0);
    startSlider();
});
</script>
