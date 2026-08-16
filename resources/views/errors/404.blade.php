@extends('layouts.app')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; background: #f8fafc; padding: 4rem 1.5rem; text-align: center;">
    <div style="max-width: 600px;">
        <div style="display: inline-block; padding: 0.5rem 1.25rem; background: rgba(10, 46, 120, 0.08); color: #0A2E78; border-radius: 50px; font-weight: 700; font-size: 0.9rem; margin-bottom: 1.5rem;">
            Error 404
        </div>
        <h1 style="font-size: clamp(3rem, 8vw, 5.5rem); font-weight: 900; color: #0A2E78; margin: 0; line-height: 1; letter-spacing: -0.03em;">
            404
        </h1>
        <h2 style="font-size: clamp(1.35rem, 4vw, 1.85rem); font-weight: 700; color: #1e293b; margin: 1rem 0 0.75rem;">
            Halaman Tidak Ditemukan
        </h2>
        <p style="color: #64748b; font-size: 1.05rem; line-height: 1.6; margin-bottom: 2rem;">
            Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan. Tim teknisi Rootera siap membantu kebutuhan saluran air Anda.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ url('/') }}" class="btn btn-primary" style="background: #0A2E78; border-color: #0A2E78; padding: 0.85rem 2rem; border-radius: 50px; color: #fff; text-decoration: none; font-weight: 700; font-size: 1rem;">
                Kembali ke Beranda
            </a>
            <a href="{{ route('layanan') }}" class="btn btn-secondary" style="background: #169F81; border-color: #169F81; padding: 0.85rem 2rem; border-radius: 50px; color: #fff; text-decoration: none; font-weight: 700; font-size: 1rem;">
                Lihat Layanan Kami
            </a>
        </div>
    </div>
</div>
@endsection
