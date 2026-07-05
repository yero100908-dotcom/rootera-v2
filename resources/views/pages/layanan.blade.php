@extends('layouts.app')
@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 4rem;position:relative;overflow:hidden" aria-labelledby="page-title">
    <div style="position:absolute;inset:0" aria-hidden="true">
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(22,159,129,.15);top:-100px;right:-80px"></div>
    </div>
    <div class="container text-center" style="position:relative;z-index:1">
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
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem">
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
                <div class="tool-icon">{!! $toolIcons[$i % 4] !!}</div>
                <div class="tool-info">
                    <h4>{{ $tool['name'] }}</h4>
                    <p>{{ $tool['description'] }}</p>
                    <span class="tool-badge">{{ $tool['benefit'] }}</span>
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
            <article class="service-card fade-in">
                <div class="service-icon {{ $colors[$i % 3] }}">{!! $icons[$i % 3] !!}</div>
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
                <div class="service-items">
                    @foreach($category->services->take(4) as $service)
                    <div class="service-item">{{ $service->name }}</div>
                    @endforeach
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

@include('sections.home.cta-banner')
@endsection
