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
        <div style="display: flex; justify-content: center; gap: 0.75rem; margin-bottom: 2.5rem; flex-wrap: wrap;">
            <button class="btn" style="background: var(--primary); color: #fff; border-radius: 50px; padding: 0.5rem 1.5rem; font-weight: 600; border: none;">TERBARU</button>
            <button class="btn" style="background: #fff; color: #475569; border-radius: 50px; padding: 0.5rem 1.5rem; font-weight: 600; border: 1px solid #cbd5e1;">RESIDENTIAL</button>
            <button class="btn" style="background: #fff; color: #475569; border-radius: 50px; padding: 0.5rem 1.5rem; font-weight: 600; border: 1px solid #cbd5e1;">COMMERCIAL</button>
        </div>

        <!-- 2x2 Grid Layout -->
        <style>
            .gallery-grid-2x2 {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            @media (min-width: 640px) {
                .gallery-grid-2x2 {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
            .gallery-img-wrapper {
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                aspect-ratio: 4/3;
                background: #e2e8f0;
            }
            .gallery-img-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }
            .gallery-img-wrapper:hover img {
                transform: scale(1.05);
            }
        </style>

        <div class="gallery-grid-2x2">
            <!-- Foto 1 (Yang sudah ada - Dokumentasi1) -->
            <div class="gallery-img-wrapper">
                <img src="{{ asset('images/Dokumentasi1.jpg') }}" alt="Hasil Kerja 1" onerror="this.src='{{ asset('images/JnJ.jpeg') }}'">
            </div>
            <!-- Foto 2 (Baru - pengerjaan1) -->
            <div class="gallery-img-wrapper">
                <img src="{{ asset('images/pengerjaan1.jpg') }}" alt="Hasil Kerja 2" onerror="this.src='{{ asset('images/Dokumentasi2.jpg') }}'">
            </div>
            <!-- Foto 3 (Baru - pengerjaan2) -->
            <div class="gallery-img-wrapper">
                <img src="{{ asset('images/pengerjaan2.jpg') }}" alt="Hasil Kerja 3" onerror="this.src='{{ asset('images/Dokumentasi3.jpg') }}'">
            </div>
            <!-- Foto 4 (Baru - pengerjaan3) -->
            <div class="gallery-img-wrapper">
                <img src="{{ asset('images/pengerjaan3.jpg') }}" alt="Hasil Kerja 4" onerror="this.src='{{ asset('images/JnJ.webp') }}'">
            </div>
        </div>

        <!-- Tombol CTA Bawah -->
        <div class="text-center" style="margin-top: 3rem;">
            <a href="https://wa.me/6281385404000?text=Halo%20ROOTERA%2C%20saya%20ingin%20konsultasi%20gratis." class="btn btn-primary" target="_blank" rel="noopener" style="padding: 1rem 2rem; font-size: 1.1rem; border-radius: 12px; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-right: 8px; display: inline-block; vertical-align: text-bottom;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
53:                 Konsultasi Gratis Sekarang
54:             </a>
55:         </div>
56:     </div>
57: </section>
