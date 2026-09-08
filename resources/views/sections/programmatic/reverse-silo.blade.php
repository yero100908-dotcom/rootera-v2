{{-- Contextual Reverse Silo Callout Box --}}
<section class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm flex items-start gap-4">

            {{-- Icon --}}
            <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-xl shrink-0">
                📍
            </div>

            {{-- Content --}}
            <div class="min-w-0">
                <h4 class="text-sm sm:text-base font-extrabold text-slate-900 mb-1.5">
                    Pusat Layanan Resmi & Jangkauan Operasional {{ $locationShort }}
                </h4>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Layanan pelancaran pipa mampet tanpa bongkar di {{ $locationName }} merupakan bagian dari
                    <a href="{{ url('/jasa-saluran-mampet/' . $city->slug) }}"
                       class="text-emerald-700 font-semibold hover:underline">layanan lengkap jasa saluran pipa mampet {{ $city->name }}</a>.
                    @if(in_array($city->slug, ['jakarta-selatan', 'jakarta-timur', 'jakarta-barat', 'jakarta-pusat', 'jakarta-utara', 'bogor', 'kabupaten-bogor', 'depok', 'tangerang', 'tangerang-selatan', 'kabupaten-tangerang', 'bekasi', 'kabupaten-bekasi']))
                        Tim teknisi disiagakan 24 jam nonstop untuk merespon panggilan darurat
                        <a href="{{ url('/') }}" class="text-emerald-700 font-semibold hover:underline">jasa saluran pipa mampet Jabodetabek</a>
                        dengan garansi 30 hari tuntas tanpa merusak ubin atau struktur bangunan Anda.
                    @else
                        Tim teknisi disiagakan 24 jam nonstop di pos armada siaga {{ $city->name }}, bergaransi tuntas 30 hari.
                    @endif
                </p>
            </div>

        </div>
    </div>
</section>
