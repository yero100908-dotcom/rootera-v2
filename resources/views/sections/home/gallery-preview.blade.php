<style>
    .showcase-container {
        background: linear-gradient(rgba(241, 245, 249, 0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(241, 245, 249, 0.08) 1px, transparent 1px), linear-gradient(135deg, #051636 0%, #0A2E78 50%, #1a4aa8 100%);
        background-size: 20px 20px, 20px 20px, auto;
        border-radius: 24px;
        padding: 3.5rem;
        box-shadow: 0 20px 50px rgba(10, 46, 120, 0.25);
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        color: #fff;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .showcase-bg-shape {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }
    .showcase-slider {
        position: relative;
        width: 100%;
        aspect-ratio: 4/3;
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
        transform: scale(1.08); /* Efek zoom lambat yang mewah */
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
    .showcase-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(22, 159, 129, 0.15);
        color: #1FAF5A;
        border: 1px solid rgba(22, 159, 129, 0.3);
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1.5rem;
    }
    .showcase-badge-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #1FAF5A;
        box-shadow: 0 0 10px rgba(31, 175, 90, 0.5);
    }
    .showcase-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.25rem;
        line-height: 1.15;
    }
    .showcase-title span {
        color: #1FAF5A;
    }
    .showcase-desc {
        color: rgba(255, 255, 255, 0.75);
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }
    .showcase-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 2.5rem;
    }
    .showcase-tab {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.8);
        padding: 0.6rem 1.25rem;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .showcase-tab:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
    }
    .showcase-tab.active-tab {
        background: #1FAF5A;
        border-color: #1FAF5A;
        color: #fff;
        box-shadow: 0 4px 15px rgba(22, 159, 129, 0.3);
    }
    .showcase-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: #fff;
        color: #0A2E78;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    .showcase-cta:hover {
        background: #1FAF5A;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(31, 175, 90, 0.4);
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
        background: #1FAF5A;
        width: 24px;
        border-radius: 4px;
    }
    .slider-progress {
        position: absolute;
        top: 0;
        left: 0;
        height: 4px;
        background: #1FAF5A;
        width: 0%;
        z-index: 20;
    }
    @media (max-width: 992px) {
        .showcase-container {
            grid-template-columns: 1fr;
            padding: 2.5rem 1.5rem;
            gap: 2.5rem;
        }
        .showcase-title {
            font-size: 2rem;
        }
    }
</style>

<section class="section" id="galeri-kerja-nyata" style="padding-top: 2rem; padding-bottom: 5rem;">
    <div class="container">
        <!-- Banner Showcase Card -->
        <div class="showcase-container">
            <!-- Decorative Tech Network Lines / Jaringan Node dari Mengapa Rooterin -->
            <div class="showcase-bg-shape">
                <!-- Left Tech Network Lines -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600" preserveAspectRatio="none" style="position: absolute; left: 0; top: 0; height: 100%; width: 350px; pointer-events: none; opacity: 0.22;">
                    <defs>
                        <linearGradient id="gal-grad-left" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#38bdf8" />
                            <stop offset="100%" stop-color="#0ea5e9" />
                        </linearGradient>
                    </defs>
                    <g stroke="url(#gal-grad-left)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M-20,100 H120 V250 H240 V450 H100" stroke-width="2.5" stroke-opacity="0.7" />
                        <path d="M-20,100 H120 V250 H240 V450 H100" stroke-width="6" stroke-opacity="0.15" />
                        <path d="M-20,180 H80 V320 H180 V500 H50" stroke-width="1.5" stroke-opacity="0.6" class="pipe-flow-dash" />
                        <path d="M-20,240 H150 V150 H280 V380 H140" stroke-width="1.2" stroke-opacity="0.4" class="pipe-flow-dash-reverse" />
                    </g>
                    <g fill="#38bdf8" opacity="0.8">
                        <circle cx="120" cy="100" r="4.5" />
                        <circle cx="120" cy="250" r="4.5" />
                        <circle cx="240" cy="250" r="4.5" />
                        <circle cx="240" cy="450" r="5" />
                        <circle cx="80" cy="180" r="4" />
                        <circle cx="180" cy="320" r="4" />
                        <circle cx="280" cy="150" r="5" fill="#38bdf8" />
                        <circle cx="280" cy="150" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 280px 150px;" />
                        <circle cx="140" cy="380" r="5" fill="#38bdf8" />
                        <circle cx="140" cy="380" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 140px 380px;" />
                    </g>
                </svg>

                <!-- Right Tech Network Lines -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 600" preserveAspectRatio="none" style="position: absolute; right: 0; top: 0; height: 100%; width: 350px; pointer-events: none; opacity: 0.22;">
                    <defs>
                        <linearGradient id="gal-grad-right" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#38bdf8" />
                            <stop offset="100%" stop-color="#0ea5e9" />
                        </linearGradient>
                    </defs>
                    <g stroke="url(#gal-grad-right)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M420,150 H280 V300 H160 V100 H40" stroke-width="2.5" stroke-opacity="0.7" />
                        <path d="M420,150 H280 V300 H160 V100 H40" stroke-width="6" stroke-opacity="0.15" />
                        <path d="M420,220 H320 V400 H220 V250 H300" stroke-width="1.5" stroke-opacity="0.6" class="pipe-flow-dash" />
                        <path d="M420,80 H200 V200 H90 V380 H180" stroke-width="1.2" stroke-opacity="0.4" class="pipe-flow-dash-reverse" />
                    </g>
                    <g fill="#38bdf8" opacity="0.8">
                        <circle cx="280" cy="150" r="4.5" />
                        <circle cx="160" cy="300" r="4.5" />
                        <circle cx="160" cy="100" r="4.5" />
                        <circle cx="40" cy="100" r="5" />
                        <circle cx="320" cy="220" r="4" />
                        <circle cx="220" cy="400" r="4" />
                        <circle cx="90" cy="200" r="5" fill="#38bdf8" />
                        <circle cx="90" cy="200" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 90px 200px;" />
                        <circle cx="180" cy="380" r="5" fill="#38bdf8" />
                        <circle cx="180" cy="380" r="12" stroke="#38bdf8" stroke-width="1.5" fill="none" class="pipe-pulse-node" style="transform-origin: 180px 380px;" />
                    </g>
                </svg>
            </div>
            
            <!-- LEFT: Image Auto Slider -->
            <div class="showcase-slider" id="showcase-slider-frame" onmouseenter="pauseSlider()" onmouseleave="resumeSlider()">
                <div class="slider-progress" id="slider-progress"></div>
                
                @forelse($galleryPhotos as $index => $photo)
                <div class="showcase-slide" data-category="{{ strtolower($photo->category ?? 'residential') }}" data-index="{{ $index }}">
                    <img src="{{ Storage::url($photo->image) }}" alt="{{ $photo->title }}" onerror="this.src='{{ asset('images/JnJ.jpeg') }}'">
                    
                    <!-- Caption Foto -->
                    <div class="showcase-info">
                        <h4 style="font-size: 1.35rem; font-weight: 700; margin-bottom: 0.3rem;">{{ $photo->title }}</h4>
                        <span style="color: #1FAF5A; font-size: 0.85rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.08em;">
                            {{ $photo->category ?? 'Portofolio' }}
                        </span>
                    </div>
                </div>
                @empty
                <!-- Tampilan kosong jika belum ada foto -->
                <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; height:100%; color:rgba(255,255,255,0.4);">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Belum ada dokumentasi galeri.
                </div>
                @endforelse
                
                <div class="slider-dots" id="slider-dots"></div>
            </div>

            <!-- RIGHT: Teks Konten & Filter -->
            <div class="showcase-content" style="position: relative; z-index: 10;">
                <div class="showcase-badge">
                    <span class="showcase-badge-dot"></span>
                    Portofolio
                </div>
                
                <h2 class="showcase-title">Bukti Nyata <br><span>Cara Kami Bekerja</span></h2>
                
                <p class="showcase-desc">
                    Melihat adalah percaya. Lihat langsung bagaimana tim profesional Rooterin menyelesaikan berbagai masalah saluran, dari residensial rumit hingga komersial berskala besar dengan alat canggih tanpa bongkar lantai.
                </p>

                <!-- Interactive Filters -->
                <div class="showcase-tabs" id="gallery-tabs-slider">
                    <button class="showcase-tab active-tab" data-filter="all">Terkini</button>
                    <button class="showcase-tab" data-filter="residential">Residential</button>
                    <button class="showcase-tab" data-filter="commercial">Commercial</button>
                </div>

                <!-- Call To Action -->
                <a href="{{ route('galeri') }}" class="showcase-cta">
                    Lihat Portofolio Lengkap
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
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
            progressBar.style.width = (currentWidth / parentWidth * 100) + '%';
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
