@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); color: #fff; padding: 4rem 0 3rem;">
    <div class="container">
        {{-- BREADCRUMB --}}
        <nav style="font-size: 0.85rem; color: rgba(255,255,255,0.7); margin-bottom: 1.5rem;" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" style="color: #6ee7cc; text-decoration: none;">Beranda</a>
            <span style="margin: 0 0.5rem;">/</span>
            <a href="{{ route('galeri') }}" style="color: #6ee7cc; text-decoration: none;">Galeri &amp; Dokumentasi</a>
            <span style="margin: 0 0.5rem;">/</span>
            <span style="color: #fff;">{{ $project->title }}</span>
        </nav>

        <div style="max-width: 900px;">
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1rem;">
                <span style="background: rgba(45, 212, 191, 0.2); border: 1px solid rgba(45, 212, 191, 0.4); color: #2dd4bf; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 9999px; text-transform: uppercase;">
                    {{ $project->category_label }}
                </span>
                @if($project->media_type === 'video')
                <span style="background: #dc2626; color: #fff; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 9999px;">
                    ▶ Video Riil Pengerjaan
                </span>
                @endif
                @if($project->location_tag)
                <span style="background: rgba(255,255,255,0.15); color: #fff; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px;">
                    📍 {{ $project->location_tag }}
                </span>
                @endif
            </div>

            <h1 style="font-size: 2.2rem; font-weight: 800; line-height: 1.25; margin-bottom: 1rem; color: #fff;">
                {{ $project->title }}
            </h1>
            <p style="color: rgba(255,255,255,0.8); font-size: 1rem; margin: 0;">
                Dipublikasikan pada {{ $project->created_at->format('d F Y') }} • Divisi Operasional Rootera Plumbing
            </p>
        </div>
    </div>
</div>

<section class="section" style="padding: 3.5rem 0 5rem; background: #f8fafc;">
    <div class="container" style="max-width: 1000px;">
        
        {{-- MEDIA DISPLAY --}}
        <div style="background: #0f172a; border-radius: 20px; overflow: hidden; border: 1px solid #e2e8f0; shadow: 0 20px 40px rgba(0,0,0,0.1); margin-bottom: 2.5rem;">
            @if($project->media_type === 'video' && $project->display_media)
                <video controls playsinline preload="metadata" autoplay style="width: 100%; max-height: 520px; object-fit: contain; background: #000;">
                    <source src="{{ $project->display_media }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            @elseif($project->display_before_image)
                <div style="display: grid; grid-template-columns: 1fr; md:grid-template-columns: 1fr 1fr; gap: 1rem; padding: 1.25rem;" class="grid grid-cols-1 md:grid-cols-2">
                    <div style="text-align: center;">
                        <span style="background: #dc2626; color: #fff; font-size: 0.75rem; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 6px; margin-bottom: 0.75rem; display: inline-block;">SEBELUM (BEFORE)</span>
                        <img src="{{ $project->display_before_image }}" alt="Sebelum Pengerjaan" style="width: 100%; height: 350px; object-fit: cover; border-radius: 12px;">
                    </div>
                    <div style="text-align: center;">
                        <span style="background: #10b981; color: #fff; font-size: 0.75rem; font-weight: 800; padding: 0.35rem 0.85rem; border-radius: 6px; margin-bottom: 0.75rem; display: inline-block;">SESUDAH (AFTER)</span>
                        <img src="{{ $project->display_thumbnail }}" alt="Sesudah Pengerjaan" style="width: 100%; height: 350px; object-fit: cover; border-radius: 12px;">
                    </div>
                </div>
            @else
                <img src="{{ $project->display_thumbnail }}" alt="{{ $project->title }}" style="width: 100%; max-height: 520px; object-fit: cover;">
            @endif
        </div>

        {{-- PROJECT DETAILS & DESCRIPTION --}}
        <div style="background: #fff; border-radius: 16px; p-6 md:p-8; border: 1px solid #e2e8f0; margin-bottom: 3rem; padding: 2rem;" class="p-6 md:p-8">
            <h2 style="font-size: 1.4rem; font-weight: 700; color: #0b2b64; margin-bottom: 1rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.75rem;">
                Deskripsi Teknis Pengerjaan
            </h2>
            
            <p style="color: #334155; font-size: 1.02rem; line-height: 1.7; margin-bottom: 2rem; whitespace: pre-line;">
                {{ $project->description }}
            </p>

            <div style="background: #f1f5f9; border-radius: 12px; padding: 1.25rem; display: flex; flex-wrap: wrap; items-center: center; justify-content: space-between; gap: 1rem;">
                <div>
                    <h3 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin: 0 0 0.25rem;">Mengalami Masalah Pipa Tersumbat Serupa?</h3>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 0;">Tim teknisi Rootera Plumbing siap melakukan inspeksi &amp; pelancaran tanpa bongkar.</p>
                </div>
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    @if($project->related_service_url)
                    <a href="{{ url($project->related_service_url) }}" class="btn btn-primary" style="font-size: 0.85rem;">
                        Lihat Layanan Terkait →
                    </a>
                    @endif
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin pesan layanan untuk pengerjaan serupa dengan: ' . $project->title) }}" target="_blank" rel="noopener noreferrer" style="background: #25D366; color: #fff; text-decoration: none; padding: 0.65rem 1.25rem; border-radius: 8px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.4rem;">
                        💬 Hubungi CS WhatsApp 24 Jam
                    </a>
                </div>
            </div>
        </div>

        {{-- RELATED PROJECTS --}}
        @if($relatedProjects->isNotEmpty())
        <div>
            <h3 style="font-size: 1.3rem; font-weight: 700; color: #0b2b64; margin-bottom: 1.5rem;">
                Dokumentasi Proyek Kategori Terkait
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProjects as $rel)
                <div style="background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                    <a href="{{ route('galeri.show', $rel->slug) }}" style="display: block; aspect-ratio: 16/9; overflow: hidden; position: relative;">
                        <img src="{{ $rel->display_thumbnail }}" alt="{{ $rel->title }}" style="width:100%; height:100%; object-fit:cover;">
                    </a>
                    <div style="padding: 1rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <h4 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 0.5rem; line-height: 1.4;">
                            <a href="{{ route('galeri.show', $rel->slug) }}" style="color: #0f172a; text-decoration: none;" class="hover:text-blue-600">
                                {{ $rel->title }}
                            </a>
                        </h4>
                        <a href="{{ route('galeri.show', $rel->slug) }}" style="color: #2563eb; font-size: 0.8rem; font-weight: 700; text-decoration: none; margin-top: auto;">
                            Lihat Detail Proyek →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
