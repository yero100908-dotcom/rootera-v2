<section class="section bg-offwhite" id="layanan" aria-labelledby="layanan-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-green">Layanan Kami</span>
            <h2 class="section-title" id="layanan-heading" style="margin-top:.75rem">
                Solusi Lengkap <span>Saluran & Pipa</span>
            </h2>
            <p class="section-sub">Tiga kategori layanan profesional yang dirancang untuk menyelesaikan semua masalah pipa dan sanitasi Anda.</p>
        </div>
        <div class="cards-grid">
            @foreach($serviceCategories as $i => $category)
            @php
                $icons = [
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6"/><path d="M5.2 5.2l4.24 4.24"/><path d="M2 12h6"/><path d="M5.2 18.8l4.24-4.24"/><path d="M12 22v-6"/><path d="M18.8 18.8l-4.24-4.24"/><path d="M22 12h-6"/><path d="M18.8 5.2l-4.24 4.24"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
                ];
                $iconColors = ['service-icon-blue', 'service-icon-green', 'service-icon-accent'];
                $subItems = [
                    ['Sal. Kamar Mandi', 'Cuci Piring', 'Cuci Tangan'],
                    ['Kran Mampet', 'Cuci Toren', 'Tangki Air'],
                    ['Pipa Air Bersih', 'Pipa Air Kotor', 'Kloset Jongkok/Duduk'],
                ];
            @endphp
            <article class="service-card fade-in" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="service-icon {{ $iconColors[$i % 3] }}">
                    {!! $icons[$i % 3] !!}
                </div>
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
                <div class="service-items">
                    @foreach($subItems[$i % 3] as $item)
                    <div class="service-item">{{ $item }}</div>
                    @endforeach
                </div>
            </article>
            @endforeach
        </div>
        <div class="text-center" style="margin-top:2.5rem">
            <a href="{{ route('layanan') }}" class="btn btn-secondary">Lihat Semua Layanan</a>
        </div>
    </div>
</section>
