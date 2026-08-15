<section class="section bg-slate-50" id="layanan" aria-labelledby="layanan-heading">
    <div class="container">
        <div class="text-center mb-12">
            <span class="badge badge-green">Layanan Utama Kami</span>
            <h2 class="section-title" id="layanan-heading">
                Solusi Lengkap <span>Saluran & Pipa</span>
            </h2>
            <p class="section-sub">Layanan pembersihan dan perbaikan pipa profesional bergaransi dengan teknologi modern tanpa membongkar bangunan.</p>
        </div>

        <div class="cards-grid">
            @foreach($serviceCategories as $i => $category)
            @php
                $icons = [
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#169F81" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0A2E78" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6"/><path d="M5.2 5.2l4.24 4.24"/><path d="M2 12h6"/><path d="M5.2 18.8l4.24-4.24"/><path d="M12 22v-6"/><path d="M18.8 18.8l-4.24-4.24"/><path d="M22 12h-6"/><path d="M18.8 5.2l-4.24 4.24"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#1E73D8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
                ];
                $bgColors = ['bg-emerald-50 border-emerald-100', 'bg-blue-50 border-blue-100', 'bg-indigo-50 border-indigo-100'];
                $subItems = [
                    ['Wastafel & Cuci Piring', 'Saluran Kamar Mandi', 'Floor Drain & Talang'],
                    ['Cuci Toren & Tangki Air', 'PemberSIhan Kran Air Mampet', 'Deteksi Kerak Pipa'],
                    ['Instalasi Pipa Air Bersih', 'Instalasi Pipa Air Kotor', 'Kloset Jongkok & Duduk'],
                ];
            @endphp
            <article class="service-card card-elevation group p-6 sm:p-8 flex flex-col justify-between" style="animation-delay:{{ $i * 0.1 }}s">
                <div>
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 border {{ $bgColors[$i % 3] }} transition-transform duration-300 group-hover:scale-110">
                        {!! $icons[$i % 3] !!}
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-600 transition-colors">
                        <a href="{{ route('layanan.show', $category->slug) }}">{{ $category->name }}</a>
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ $category->description }}
                    </p>
                    <div class="service-items space-y-2 mb-6">
                        @foreach($subItems[$i % 3] as $item)
                        <div class="service-item text-xs sm:text-sm text-slate-600 flex items-center gap-2">
                            <span>{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 mt-auto flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-teal-600 bg-teal-50 px-3 py-1 rounded-full border border-teal-100">Tanpa Bongkar</span>
                    <a href="{{ route('layanan.show', $category->slug) }}" class="inline-flex items-center gap-1 text-sm font-bold text-slate-900 group-hover:text-teal-600 transition-all">
                        <span>Detail Layanan</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('layanan') }}" class="btn btn-secondary shadow-sm hover:shadow-md">
                <span>Lihat Semua Detail Layanan & Harga</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
