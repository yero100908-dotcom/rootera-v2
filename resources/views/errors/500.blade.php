@extends('layouts.app')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; background: #f8fafc; padding: 4rem 1.5rem; text-align: center;">
    <div style="max-width: 600px;">
        <div style="display: inline-block; padding: 0.5rem 1.25rem; background: rgba(220, 38, 38, 0.08); color: #dc2626; border-radius: 50px; font-weight: 700; font-size: 0.9rem; margin-bottom: 1.5rem;">
            Error 500
        </div>
        <h1 style="font-size: clamp(3rem, 8vw, 5.5rem); font-weight: 900; color: #0A2E78; margin: 0; line-height: 1; letter-spacing: -0.03em;">
            500
        </h1>
        <h2 style="font-size: clamp(1.35rem, 4vw, 1.85rem); font-weight: 700; color: #1e293b; margin: 1rem 0 0.75rem;">
            Terjadi Kesalahan Server
        </h2>
        <p style="color: #64748b; font-size: 1.05rem; line-height: 1.6; margin-bottom: 2rem;">
            Maaf, terjadi gangguan sementara pada server kami. Silakan coba muat ulang halaman beberapa saat lagi atau hubungi kami langsung via WhatsApp.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ url('/') }}" class="btn btn-primary" style="background: #0A2E78; border-color: #0A2E78; padding: 0.85rem 2rem; border-radius: 50px; color: #fff; text-decoration: none; font-weight: 700; font-size: 1rem;">
                Kembali ke Beranda
            </a>
            <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20mengalami%20kendala%20saat%20mengakses%20website." class="btn btn-secondary" style="background: #25D366; border-color: #25D366; padding: 0.85rem 2rem; border-radius: 50px; color: #fff; text-decoration: none; font-weight: 700; font-size: 1rem;" target="_blank" rel="noopener">
                Hubungi Tim Rootera
            </a>
        </div>
    </div>
</div>
@endsection
