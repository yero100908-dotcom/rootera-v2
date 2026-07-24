<section class="section bg-offwhite" id="galeri-kerja-nyata" aria-labelledby="galeri-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:2.5rem">
            <span class="badge badge-green">Portofolio</span>
            <h2 class="section-title" id="galeri-heading" style="margin-top:.75rem">
                Galeri Hasil <span>Kerja Nyata</span>
            </h2>
            <p class="section-sub">Bukti nyata dedikasi dan profesionalisme tim kami di lapangan.</p>
        </div>

        <!-- Tabs Kategori -->
        <div class="gallery-tabs-container">
            <div class="gallery-tabs">
                <button class="gallery-tab active" data-filter="all">TERBARU</button>
                <button class="gallery-tab" data-filter="residential">RESIDENTIAL</button>
                <button class="gallery-tab" data-filter="commercial">COMMERCIAL</button>
            </div>
        </div>

        <!-- Dynamic Grid Layout -->
        <div class="gallery-grid-enhanced" id="gallery-grid">
            @forelse($galleryPhotos as $index => $photo)
            <div class="gallery-item" data-category="{{ strtolower($photo->category ?? 'residential') }}">
                <div class="gallery-img-wrapper" onclick="openLightbox({{ $index }})">
                    <img src="{{ Storage::url($photo->image) }}" alt="{{ $photo->title }}" onerror="this.src='{{ asset('images/JnJ.jpeg') }}'">
                    <div class="gallery-overlay">
                        <svg class="zoom-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                Belum ada foto galeri yang tersedia.
            </div>
            @endforelse
        </div>

        <!-- Tombol CTA Bawah -->
        <div class="text-center" style="margin-top: 3.5rem;">
            <a href="https://wa.me/6281385404000?text=Halo%20Rooterin%2C%20saya%20ingin%20konsultasi%20gratis." class="btn btn-primary" target="_blank" rel="noopener" style="padding: 1rem 2.25rem; font-size: 1.1rem; border-radius: 12px; box-shadow: 0 10px 20px rgba(22, 159, 129, 0.25);">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px; display: inline-block; vertical-align: text-bottom;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            Konsultasi Gratis Sekarang
            </a>
        </div>

        <!-- Lightbox Modal -->
        <div id="gallery-lightbox" class="lightbox-modal">
            <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close Lightbox">&times;</button>
            <button class="lightbox-prev" onclick="prevImage()" aria-label="Previous Image">&#10094;</button>
            <div class="lightbox-content">
                <img id="lightbox-img" src="" alt="Gallery Preview Besar">
            </div>
            <button class="lightbox-next" onclick="nextImage()" aria-label="Next Image">&#10095;</button>
        </div>
    </div>
</section>

<style>
/* Tabs Styling */
.gallery-tabs-container {
    width: 100%;
    overflow-x: auto;
    margin-bottom: 2.5rem;
    padding-bottom: 0.5rem; /* Memberikan ruang untuk scrollbar jika muncul */
    -webkit-overflow-scrolling: touch;
}
.gallery-tabs {
    display: flex;
    justify-content: center;
    gap: 0.75rem;
    min-width: max-content;
    margin: 0 auto;
}
@media (max-width: 640px) {
    .gallery-tabs {
        justify-content: flex-start;
    }
}
.gallery-tab {
    background: #0F2A44; /* Warna Navy untuk state tidak aktif */
    color: #ffffff;
    border: none;
    border-radius: 50px; /* Bentuk pill */
    padding: 0.75rem 2rem;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    opacity: 0.85;
}
.gallery-tab:hover {
    opacity: 1;
    transform: translateY(-2px);
}
.gallery-tab.active {
    background: #1FAF5A; /* Warna Hijau khas untuk state aktif */
    color: #ffffff;
    opacity: 1;
    box-shadow: 0 4px 12px rgba(31, 175, 90, 0.4);
    transform: translateY(-2px);
}

/* Grid Layout Responsif */
.gallery-grid-enhanced {
    display: grid;
    grid-template-columns: 1fr; /* 1 Kolom untuk Mobile */
    gap: 1.5rem;
}
@media (min-width: 768px) {
    .gallery-grid-enhanced {
        grid-template-columns: repeat(2, 1fr); /* 2 Kolom untuk Tablet dan Desktop */
    }
}

/* Gallery Items & Animation */
.gallery-item {
    transition: opacity 0.4s ease, transform 0.4s ease;
    opacity: 1;
    transform: scale(1);
}
.gallery-item.hide {
    display: none;
}

/* Image Wrapper */
.gallery-img-wrapper {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    aspect-ratio: 4/3;
    background: #e2e8f0;
    cursor: pointer;
}
.gallery-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Mencegah gambar teregang (stretch) */
    transition: transform 0.5s ease;
}

/* Hover Overlay */
.gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 42, 68, 0.6); /* Navy dengan transparansi */
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.zoom-icon {
    color: white;
    transform: scale(0.5);
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.gallery-img-wrapper:hover img {
    transform: scale(1.08); /* Efek zoom-in halus */
}
.gallery-img-wrapper:hover .gallery-overlay {
    opacity: 1;
}
.gallery-img-wrapper:hover .zoom-icon {
    transform: scale(1); /* Efek membesar untuk ikon */
}

/* Lightbox Modal */
.lightbox-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(15, 23, 42, 0.95); /* Backdrop gelap elegan */
    backdrop-filter: blur(8px);
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.lightbox-modal.show {
    display: flex;
    opacity: 1;
}
.lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 85vh;
}
.lightbox-modal img {
    max-width: 100%;
    max-height: 85vh;
    border-radius: 12px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    transform: scale(0.95);
    transition: transform 0.3s ease;
    object-fit: contain;
}
.lightbox-modal.show img {
    transform: scale(1);
}
.lightbox-close {
    position: absolute;
    top: 25px;
    right: 35px;
    color: #cbd5e1;
    font-size: 45px;
    font-weight: 300;
    background: none;
    border: none;
    cursor: pointer;
    transition: color 0.3s, transform 0.3s;
    line-height: 1;
    z-index: 10;
}
.lightbox-close:hover {
    color: #ffffff;
    transform: scale(1.1);
}
.lightbox-prev, .lightbox-next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: 56px;
    height: 56px;
    transform: translateY(-50%);
    color: white;
    font-size: 20px;
    transition: all 0.3s ease;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
    z-index: 10;
}
.lightbox-prev:hover, .lightbox-next:hover {
    background: #1FAF5A; /* Hijau brand */
    border-color: #1FAF5A;
    transform: translateY(-50%) scale(1.05);
}
.lightbox-prev {
    left: 40px;
}
.lightbox-next {
    right: 40px;
}
@media (max-width: 640px) {
    .lightbox-prev {
        left: 10px;
        width: 44px;
        height: 44px;
    }
    .lightbox-next {
        right: 10px;
        width: 44px;
        height: 44px;
    }
    .lightbox-close {
        top: 15px;
        right: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.gallery-tab');
    const items = document.querySelectorAll('.gallery-item');
    
    // --- 1. FILTERING LOGIC ---
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Reset active classes
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            const filterValue = tab.getAttribute('data-filter');
            
            items.forEach(item => {
                // Jika 'all' atau kategori cocok
                if(filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.classList.remove('hide');
                    // Transisi smooth untuk kemunculan (scale-in)
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    // Transisi smooth untuk menghilangkan
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                    // Sembunyikan sepenuhnya setelah transisi selesai
                    setTimeout(() => {
                        item.classList.add('hide');
                    }, 400); 
                }
            });
            
            // Update list gambar untuk navigasi lightbox berdasarkan foto yang aktif
            setTimeout(() => {
                updateLightboxImages();
            }, 450);
        });
    });

    // --- 2. LIGHTBOX LOGIC ---
    let currentImages = [];
    let currentIndex = 0;
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    function updateLightboxImages() {
        currentImages = [];
        const visibleItems = document.querySelectorAll('.gallery-item:not(.hide) img');
        visibleItems.forEach((img, index) => {
            currentImages.push(img.src);
            // Update onclick agar index sesuai dengan array yang sudah di-filter
            img.closest('.gallery-img-wrapper').setAttribute('onclick', `openLightbox(${index})`);
        });
    }

    // Inisialisasi daftar gambar saat pertama load
    updateLightboxImages();

    window.openLightbox = function(index) {
        currentIndex = index;
        lightboxImg.src = currentImages[currentIndex];
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden'; // Kunci scroll di body
    }

    window.closeLightbox = function() {
        lightbox.classList.remove('show');
        document.body.style.overflow = ''; // Lepas kunci scroll
    }

    window.prevImage = function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : currentImages.length - 1;
        animateLightboxChange();
    }

    window.nextImage = function() {
        currentIndex = (currentIndex < currentImages.length - 1) ? currentIndex + 1 : 0;
        animateLightboxChange();
    }
    
    function animateLightboxChange() {
        lightboxImg.style.opacity = '0.3';
        lightboxImg.style.transform = 'scale(0.97)';
        setTimeout(() => {
            lightboxImg.src = currentImages[currentIndex];
            lightboxImg.style.opacity = '1';
            lightboxImg.style.transform = 'scale(1)';
        }, 200);
    }

    // Event Listener: Tutup saat area luar gambar diklik
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
    
    // Event Listener: Navigasi menggunakan Keyboard
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('show')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
});
</script>
