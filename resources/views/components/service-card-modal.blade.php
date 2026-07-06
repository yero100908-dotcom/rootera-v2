{{--
    =====================================================================
    KOMPONEN: Service Card dengan Modal Detail & Harga
    Penggunaan: @include('components.service-card-modal', ['services' => $services])
    =====================================================================
--}}

{{-- ===== GRID CARD LAYANAN ===== --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($serviceCategories as $category)
        @foreach($category->services->where('is_active', true) as $service)
        <div
            class="group bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1
                   transition-all duration-300 cursor-pointer overflow-hidden"
            onclick="openServiceModal({{ $service->id }})"
        >
            {{-- Thumbnail --}}
            @if($service->image_path || $service->image)
            <div class="h-48 overflow-hidden">
                <img src="{{ $service->image_url }}"
                     alt="{{ $service->title ?? $service->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            @else
            <div class="h-48 bg-gradient-to-br from-blue-50 to-teal-50 flex items-center justify-center">
                <svg class="w-16 h-16 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                </svg>
            </div>
            @endif

            {{-- Body --}}
            <div class="p-5">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <h3 class="font-bold text-gray-800 text-base leading-snug group-hover:text-blue-700 transition-colors">
                        {{ $service->title ?? $service->name }}
                    </h3>
                    <span class="shrink-0 bg-blue-50 text-blue-600 text-xs font-semibold px-2 py-1 rounded-full">
                        {{ $category->name }}
                    </span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">
                    {{ $service->short_description }}
                </p>

                {{-- Harga Preview --}}
                @if($service->price_residential)
                <div class="mt-3 pt-3 border-t border-gray-50 flex items-center gap-1 text-green-600 font-semibold text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Mulai {{ $service->price_residential }}
                </div>
                @endif

                <div class="mt-4 flex items-center gap-1 text-blue-600 text-sm font-medium group-hover:gap-2 transition-all">
                    <span>Lihat Detail</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
</div>

{{-- ===== MODAL DETAIL LAYANAN ===== --}}
<div id="service-modal-overlay"
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
     onclick="if(event.target===this) closeServiceModal()">

    <div id="service-modal-box"
         class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto
                transform scale-95 opacity-0 transition-all duration-300">

        {{-- Loading state --}}
        <div id="modal-loading" class="flex items-center justify-center h-64">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-blue-600 border-t-transparent"></div>
        </div>

        {{-- Content (diisi via JS) --}}
        <div id="modal-content" class="hidden">

            {{-- Header dengan Gambar --}}
            <div id="modal-image-container" class="relative h-56 overflow-hidden rounded-t-2xl bg-gradient-to-br from-blue-800 to-teal-600 hidden">
                <img id="modal-image" src="" alt="" class="w-full h-full object-cover opacity-80">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <button onclick="closeServiceModal()"
                    class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white w-9 h-9 rounded-full
                           flex items-center justify-center hover:bg-white/40 transition text-xl font-bold">
                    &times;
                </button>
                <div class="absolute bottom-4 left-6 right-16">
                    <span id="modal-category" class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full mb-2 inline-block"></span>
                    <h2 id="modal-title" class="text-white text-2xl font-bold leading-tight"></h2>
                </div>
            </div>

            {{-- Header tanpa gambar --}}
            <div id="modal-no-image-header" class="flex items-start justify-between p-6 pb-4">
                <div>
                    <span id="modal-category-alt" class="bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full inline-block mb-2"></span>
                    <h2 id="modal-title-alt" class="text-gray-800 text-xl font-bold"></h2>
                </div>
                <button onclick="closeServiceModal()"
                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none ml-4 shrink-0">&times;</button>
            </div>

            {{-- Body --}}
            <div class="px-6 pb-6">
                {{-- Deskripsi Singkat --}}
                <p id="modal-short-desc" class="text-gray-600 text-sm leading-relaxed mb-5"></p>

                {{-- Deskripsi Lengkap --}}
                <div id="modal-full-desc-container" class="hidden mb-5">
                    <h4 class="font-semibold text-gray-700 mb-2 text-sm">Detail Layanan</h4>
                    <div id="modal-full-desc" class="text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none"></div>
                </div>

                {{-- ===== TABEL PERBANDINGAN HARGA ===== --}}
                <div id="modal-price-section" class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-xl p-5 mb-5">
                    <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Estimasi Harga
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        {{-- Rumahan --}}
                        <div class="bg-white rounded-xl p-4 border border-blue-100 text-center">
                            <div class="flex items-center justify-center gap-1 mb-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="text-xs font-semibold text-blue-600">Hunian / Rumahan</span>
                            </div>
                            <p id="modal-price-residential" class="text-xl font-bold text-gray-800"></p>
                        </div>
                        {{-- Komersial --}}
                        <div class="bg-white rounded-xl p-4 border border-teal-100 text-center">
                            <div class="flex items-center justify-center gap-1 mb-2">
                                <svg class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="text-xs font-semibold text-teal-600">Ruko / Komersial</span>
                            </div>
                            <p id="modal-price-commercial" class="text-xl font-bold text-gray-800"></p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 text-center mt-3">* Harga dapat berbeda tergantung kondisi lokasi dan tingkat kesulitan</p>
                </div>

                {{-- CTA --}}
                <div class="flex gap-3">
                    <a href="https://wa.me/6281385404000?text=Halo+ROOTERA,+saya+ingin+konsultasi+layanan+__SERVICE__"
                       id="modal-wa-link"
                       target="_blank" rel="noopener"
                       class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center font-semibold py-3 rounded-xl
                              text-sm transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Chat WhatsApp
                    </a>
                    <button onclick="closeServiceModal()"
                        class="px-5 py-3 border border-gray-200 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-50 transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== SCRIPT MODAL ===== --}}
@once
@push('scripts')
<script>
// Data layanan dari PHP (dijadikan JS object)
const servicesData = {
    @foreach($serviceCategories as $category)
        @foreach($category->services->where('is_active', true) as $service)
        {{ $service->id }}: {
            id: {{ $service->id }},
            title: @json($service->title ?? $service->name),
            category: @json($category->name),
            short_description: @json($service->short_description ?? ''),
            full_description: @json($service->full_description ?? ''),
            image_url: @json($service->image_url),
            has_image: {{ ($service->image_path || $service->image) ? 'true' : 'false' }},
            price_residential: @json($service->price_residential ?? 'Hubungi Kami'),
            price_commercial: @json($service->price_commercial ?? 'Hubungi Kami'),
        },
        @endforeach
    @endforeach
};

function openServiceModal(id) {
    const data = servicesData[id];
    if (!data) return;

    const overlay = document.getElementById('service-modal-overlay');
    const box = document.getElementById('service-modal-box');
    const loading = document.getElementById('modal-loading');
    const content = document.getElementById('modal-content');

    // Show overlay
    overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // Reset & show loading
    loading.classList.remove('hidden');
    content.classList.add('hidden');

    setTimeout(() => {
        // Populate data
        if (data.has_image) {
            document.getElementById('modal-image').src = data.image_url;
            document.getElementById('modal-image').alt = data.title;
            document.getElementById('modal-image-container').classList.remove('hidden');
            document.getElementById('modal-no-image-header').classList.add('hidden');
            document.getElementById('modal-category').textContent = data.category;
            document.getElementById('modal-title').textContent = data.title;
        } else {
            document.getElementById('modal-image-container').classList.add('hidden');
            document.getElementById('modal-no-image-header').classList.remove('hidden');
            document.getElementById('modal-category-alt').textContent = data.category;
            document.getElementById('modal-title-alt').textContent = data.title;
        }

        document.getElementById('modal-short-desc').textContent = data.short_description;

        if (data.full_description) {
            document.getElementById('modal-full-desc').innerHTML = data.full_description;
            document.getElementById('modal-full-desc-container').classList.remove('hidden');
        } else {
            document.getElementById('modal-full-desc-container').classList.add('hidden');
        }

        document.getElementById('modal-price-residential').textContent = data.price_residential;
        document.getElementById('modal-price-commercial').textContent = data.price_commercial;
        document.getElementById('modal-wa-link').href =
            `https://wa.me/6281385404000?text=Halo+ROOTERA,+saya+ingin+konsultasi+layanan+${encodeURIComponent(data.title)}`;

        // Switch loading -> content
        loading.classList.add('hidden');
        content.classList.remove('hidden');

        // Animate in
        box.style.transform = 'scale(0.95)';
        box.style.opacity = '0';
        requestAnimationFrame(() => {
            box.style.transition = 'all 0.25s ease';
            box.style.transform = 'scale(1)';
            box.style.opacity = '1';
        });
    }, 200);
}

function closeServiceModal() {
    const overlay = document.getElementById('service-modal-overlay');
    overlay.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeServiceModal();
});
</script>
@endpush
@endonce
