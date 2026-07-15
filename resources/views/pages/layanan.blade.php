@extends('layouts.app')
@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden" aria-labelledby="page-title">
    {{-- Bottom Wave --}}
    <div style="position:absolute;bottom:0;left:0;width:100%;height:60px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#ffffff"></path>
        </svg>
    </div>

    {{-- Fluid Smooth Wavy Lines (Rich Pattern) --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:1;opacity:0.1" aria-hidden="true">
        <defs>
            <linearGradient id="hero-fluid-wave-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#20b2aa" />
                <stop offset="100%" stop-color="#6495ed" />
            </linearGradient>
        </defs>
        <!-- Line 1: Thick continuous path -->
        <path d="M-100,80 C300,260 600,-40 1000,180 C1200,290 1400,120 1600,220" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="3"></path>
        <!-- Line 2: Medium continuous path -->
        <path d="M-50,140 C350,300 650,40 950,220 C1150,320 1350,160 1550,260" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="2"></path>
        <!-- Line 3: Thin continuous path -->
        <path d="M-120,200 C200,80 500,280 800,100 C1100,20 1300,240 1600,120" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="1"></path>
        <!-- Line 4: Dash pattern 1 -->
        <path d="M-150,30 C250,170 550,-100 900,120 C1100,220 1300,80 1500,170" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="1.5" stroke-dasharray="5,5"></path>
        <!-- Line 5: Dash pattern 2 -->
        <path d="M-80,240 C280,360 620,120 920,280 C1220,400 1380,180 1580,290" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="2" stroke-dasharray="8,4"></path>
        <!-- Line 6: Diagonal intersecting sweep -->
        <path d="M-200,280 C100,80 400,20 800,180 C1100,300 1300,120 1650,50" fill="none" stroke="url(#hero-fluid-wave-grad)" stroke-width="1.5"></path>
    </svg>

    <div class="container text-center" style="position:relative;z-index:2">
        <h1 id="page-title" style="color:#fff;margin-bottom:.75rem">Layanan <span style="color:#6ee7cc">ROOTERA</span></h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:550px;margin:0 auto">Solusi lengkap untuk semua masalah pipa, saluran, dan sanitasi menggunakan peralatan modern tanpa merusak bangunan.</p>
    </div>
</div>

{{-- Alat Modern --}}
<section class="section bg-offwhite" aria-labelledby="tools-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-blue">Teknologi Terkini</span>
            <h2 class="section-title" id="tools-heading" style="margin-top:.75rem">Peralatan <span>Modern</span> Kami</h2>
            <p class="section-sub">Metode mekanis non-destruktif — saluran bersih tanpa harus membongkar dinding atau lantai.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
            @foreach($tools as $i => $tool)
            @php
                $toolIcons = [
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 2v6"/><path d="M5.2 5.2l4.24 4.24"/><path d="M2 12h6"/><path d="M5.2 18.8l4.24-4.24"/><path d="M12 22v-6"/><path d="M18.8 18.8l-4.24-4.24"/><path d="M22 12h-6"/><path d="M18.8 5.2l-4.24 4.24"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M20.188 10.934c.2.646.312 1.329.312 2.066s-.112 1.42-.312 2.066l2.679 1.546-2 3.464-2.679-1.546A8.007 8.007 0 0 1 14 19.938V23h-4v-3.062a8.007 8.007 0 0 1-4.188-1.408L3.133 20.08l-2-3.464 2.679-1.546A8.185 8.185 0 0 1 3.5 13c0-.737.112-1.42.312-2.066L1.133 9.388l2-3.464 2.679 1.546A8.007 8.007 0 0 1 10 6.062V3h4v3.062a8.007 8.007 0 0 1 4.188 1.408l2.679-1.546 2 3.464-2.679 1.546z"/></svg>',
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
                ];
            @endphp
            <div class="tool-card fade-in" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="tool-icon">
                    @if($tool->image_path)
                        <img src="{{ $tool->image_url }}" alt="{{ $tool->tool_name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">
                    @else
                        {!! $toolIcons[$i % 4] !!}
                    @endif
                </div>
                <div class="tool-info">
                    <h4>{{ $tool->tool_name }}</h4>
                    <p>{{ $tool->description }}</p>
                    @if(!empty($tool->benefit))
                        <span class="tool-badge">{{ $tool->benefit }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Kategori Layanan --}}
<section class="section" aria-labelledby="service-cats-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-green">Kategori Layanan</span>
            <h2 class="section-title" id="service-cats-heading" style="margin-top:.75rem">Semua <span>Layanan</span> Kami</h2>
            <p class="section-sub">Tiga kategori layanan komprehensif dengan teknisi berpengalaman dan peralatan modern.</p>
        </div>
        <div class="cards-grid">
            @php
            $icons = [
                '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v6"/><path d="M5.2 5.2l4.24 4.24"/><path d="M2 12h6"/><path d="M5.2 18.8l4.24-4.24"/><path d="M12 22v-6"/><path d="M18.8 18.8l-4.24-4.24"/><path d="M22 12h-6"/><path d="M18.8 5.2l-4.24 4.24"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
            ];
            $colors = ['service-icon-blue','service-icon-green','service-icon-accent'];
            @endphp
            @foreach($serviceCategories as $i => $category)
            <article class="service-card fade-in cursor-pointer relative overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 js-service-card"
                     data-name="{{ $category->name }}"
                     data-home="{{ $category->price_home }}"
                     data-corporate="{{ $category->price_corporate }}"
                     data-desc="{{ $category->price_description }}">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity transform group-hover:scale-110 duration-500">
                    {!! $icons[$i % 3] !!}
                </div>
                <div class="service-icon {{ $colors[$i % 3] }} relative z-10 transition-transform duration-300 group-hover:scale-110">{!! $icons[$i % 3] !!}</div>
                <h3 class="relative z-10 group-hover:text-[#1E73D8] transition-colors">{{ $category->name }}</h3>
                <p class="relative z-10">{{ $category->description }}</p>
                <div class="service-items relative z-10">
                    @foreach($category->services->take(4) as $service)
                    <div class="service-item">{{ $service->name }}</div>
                    @endforeach
                </div>
                <div class="mt-6 flex items-center gap-2 text-sm text-[#1E73D8] font-bold opacity-80 group-hover:opacity-100 transition-opacity">
                    Lihat Detail Harga
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- Price Details Modal (Tailwind/Modern UI) --}}
{{-- Price Details Modal (Tailwind/Modern UI) --}}
{{-- Price Details Modal (Tailwind/Modern UI) --}}
<div id="price-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6 transition-all duration-300 opacity-0" style="background:rgba(15,23,42,0.6);backdrop-filter:blur(12px)">
    <div class="bg-white rounded-[24px] sm:rounded-[32px] shadow-[0_20px_60px_rgba(0,0,0,0.2)] w-full max-w-4xl transform scale-95 transition-all duration-300 relative overflow-hidden flex flex-col max-h-[90vh] overflow-y-auto" id="price-modal-content">
        
        {{-- Close Button --}}
        <button type="button" onclick="closePriceModal()" class="absolute top-4 right-4 sm:top-6 sm:right-6 z-30 text-slate-400 hover:text-slate-700 bg-white/80 backdrop-blur hover:bg-slate-100 rounded-full p-2.5 sm:p-3 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>

        {{-- Header Section (Light Blue Gradient) --}}
        <div class="bg-gradient-to-br from-[#f0f7ff] to-[#e0f2fe] pt-12 pb-16 px-6 sm:px-10 text-center relative flex-shrink-0">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#0A2E78 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>
            
            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-2xl sm:rounded-3xl bg-white shadow-md text-[#0A2E78] mb-4 sm:mb-6 relative z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="sm:w-10 sm:h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <h3 id="pm-title" class="text-2xl sm:text-4xl font-extrabold text-[#0A2E78] tracking-tight relative z-10 mb-3">Detail Harga</h3>
            <p class="text-slate-500 text-sm sm:text-base max-w-lg mx-auto relative z-10 leading-relaxed">Estimasi biaya transparan untuk menyelesaikan permasalahan saluran pembuangan Anda.</p>
        </div>

        {{-- Content Section (Pulled up to overlap header) --}}
        <div class="px-5 sm:px-10 pb-10 relative z-10 -mt-10 sm:-mt-12 flex-1 flex flex-col">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                
                {{-- Harga Rumahan Card --}}
                <div class="bg-white rounded-[24px] p-6 sm:p-8 shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-slate-100 flex flex-col hover:border-[#169F81] hover:shadow-[0_15px_50px_rgba(22,159,129,0.15)] transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center gap-3 sm:gap-4 mb-6">
                        <div class="p-2.5 sm:p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg sm:text-xl">Rumah Hunian</h4>
                    </div>
                    <div class="mt-auto">
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mb-1 uppercase tracking-widest">Mulai dari</p>
                        <p id="pm-home" class="text-3xl sm:text-4xl font-extrabold text-[#0A2E78] tracking-tight">Rp -</p>
                    </div>
                </div>

                {{-- Harga Corporate Card --}}
                <div class="bg-white rounded-[24px] p-6 sm:p-8 shadow-[0_10px_40px_rgba(0,0,0,0.08)] border border-slate-100 flex flex-col hover:border-[#0A2E78] hover:shadow-[0_15px_50px_rgba(10,46,120,0.15)] transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-slate-50 rounded-bl-[100%] pointer-events-none"></div>
                    <div class="flex items-center gap-3 sm:gap-4 mb-6 relative z-10">
                        <div class="p-2.5 sm:p-3 bg-slate-100 rounded-xl text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg sm:text-xl">Komersial / Gedung</h4>
                    </div>
                    <div class="mt-auto relative z-10">
                        <p class="text-xs sm:text-sm text-slate-500 font-medium mb-1 uppercase tracking-widest">Estimasi Biaya</p>
                        <p id="pm-corporate" class="text-3xl sm:text-4xl font-extrabold text-[#0A2E78] tracking-tight">Rp -</p>
                    </div>
                </div>

            </div>

            {{-- Services & Note Area --}}
            <div class="mt-auto bg-slate-50 rounded-[20px] sm:rounded-[24px] p-6 sm:p-8 border border-slate-100">
                <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6 lg:gap-8">
                    <div class="flex-1 w-full">
                        <h5 class="text-sm sm:text-base font-bold text-slate-700 mb-3 sm:mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-[#169F81]"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            Layanan Termasuk:
                        </h5>
                        <div id="pm-services" class="flex flex-wrap gap-2 sm:gap-3">
                            {{-- Injected via JS --}}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full border-t lg:border-t-0 lg:border-l border-slate-200 pt-4 lg:pt-0 lg:pl-8 mt-4 lg:mt-0">
                        <p id="pm-desc" class="text-sm text-slate-500 italic leading-relaxed">
                            *Harga dapat berubah sesuai tingkat keparahan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- CTA Button --}}
            <div class="mt-8 flex justify-center">
                <a href="https://wa.me/6281234567890" target="_blank" class="w-full sm:w-auto bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-base sm:text-lg py-4 px-8 sm:px-10 rounded-full flex items-center justify-center gap-3 transition-all duration-300 shadow-[0_8px_20px_rgba(37,211,102,0.3)] hover:shadow-[0_12px_25px_rgba(37,211,102,0.4)] hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Konsultasi Gratis via WhatsApp
                </a>
            </div>
            
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.js-service-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                const title = this.getAttribute('data-name');
                const home = this.getAttribute('data-home');
                const corporate = this.getAttribute('data-corporate');
                const desc = this.getAttribute('data-desc');
                
                // Get services list from the card's child elements
                const serviceItems = this.querySelectorAll('.service-item');
                const services = Array.from(serviceItems).map(item => item.textContent);
                
                openPriceModal(title, home, corporate, desc, services);
            });
        });
    });

    function openPriceModal(title, home, corporate, desc, services) {
        document.getElementById('pm-title').textContent = title;
        
        // Format harga (kalau ada isinya, tambahkan Rp, kalau tidak biarkan kosong atau Hubungi Kami)
        document.getElementById('pm-home').textContent = home ? 'Rp. ' + home : 'Hubungi Kami';
        document.getElementById('pm-corporate').textContent = corporate ? 'Rp. ' + corporate : 'Hubungi Kami';
        
        const descEl = document.getElementById('pm-desc');
        if(desc) {
            descEl.textContent = '*' + desc;
        } else {
            descEl.textContent = '*Harga dapat menyesuaikan tingkat kesulitan';
        }
        
        // Populate services pills
        const servicesContainer = document.getElementById('pm-services');
        servicesContainer.innerHTML = '';
        if(services && services.length > 0) {
            services.forEach(srv => {
                const pill = document.createElement('div');
                pill.className = 'bg-white border border-slate-200 rounded-full px-4 py-1.5 text-sm font-semibold text-slate-600 shadow-sm';
                pill.textContent = srv;
                servicesContainer.appendChild(pill);
            });
        }
        
        const modal = document.getElementById('price-modal');
        const content = document.getElementById('price-modal-content');
        
        modal.classList.remove('hidden');
        // trigger reflow
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        content.classList.add('scale-100');
    }

    function closePriceModal() {
        const modal = document.getElementById('price-modal');
        const content = document.getElementById('price-modal-content');
        
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>

@include('sections.home.cta-banner')
@endsection
