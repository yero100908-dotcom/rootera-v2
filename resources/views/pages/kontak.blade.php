@extends('layouts.app')
@section('content')

<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 4rem">
    <div class="container text-center">
        <h1 style="color:#fff;margin-bottom:.75rem">Hubungi <span style="color:#6ee7cc">Kami</span></h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:550px;margin:0 auto">Ada pertanyaan atau butuh layanan segera? Tim ROOTERA siap membantu Anda 24 jam sehari.</p>
    </div>
</div>

<section class="section" aria-labelledby="contact-heading">
    <div class="container">
        <h2 id="contact-heading" class="sr-only">Formulir Kontak</h2>

        @if(session('success'))
        <div class="alert alert-success alert-auto-dismiss" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="contact-grid">
            {{-- Info Card --}}
            <div class="contact-info-card">   
                <h3>Informasi Kontak</h3>
                <p>Kami siap membantu Anda menemukan solusi terbaik untuk masalah pipa dan saluran Anda.</p>
                <div class="ci-item">
                    <div class="ci-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </div>
                    <div class="ci-text">
                        <strong>WhatsApp (Utama)</strong>
                        <a href="https://wa.me/6281385404000" target="_blank" rel="noopener">0813-8540-4000</a>
                    </div>
                </div>
                <div class="ci-item">
                    <div class="ci-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="ci-text">
                        <strong>Email</strong>
                        <a href="mailto:info@rootera.id">info@rootera.id</a>
                    </div>
                </div>
                <div class="ci-item">
                    <div class="ci-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="ci-text">
                        <strong>Area Layanan</strong>
                        <span>Jabodetabek, Cirebon, Semarang,<br>Yogyakarta, Lampung & Bandung</span>
                    </div>
                </div>
                <div class="ci-item">
                    <div class="ci-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="ci-text">
                        <strong>Jam Operasional</strong>
                        <span>24 Jam / 7 Hari Seminggu</span>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="form-card">
                <h3 style="color:#0A2E78;margin-bottom:1.5rem;font-size:1.3rem">Kirim Pesan</h3>
                <form action="{{ route('kontak.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span style="color:#ef4444">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Anda" required>
                            @error('name')<span style="color:#ef4444;font-size:.82rem">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor WhatsApp <span style="color:#ef4444">*</span></label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx" required>
                            @error('phone')<span style="color:#ef4444;font-size:.82rem">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email (Opsional)</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="service_type">Jenis Layanan</label>
                            <select id="service_type" name="service_type">
                                <option value="">— Pilih Layanan —</option>
                                <option value="Saluran Kamar Mandi Mampet" {{ old('service_type')=='Saluran Kamar Mandi Mampet'?'selected':'' }}>Saluran Kamar Mandi Mampet</option>
                                <option value="Saluran Cuci Piring Mampet" {{ old('service_type')=='Saluran Cuci Piring Mampet'?'selected':'' }}>Saluran Cuci Piring Mampet</option>
                                <option value="Cuci Toren / Tangki Air"    {{ old('service_type')=='Cuci Toren / Tangki Air'?'selected':'' }}>Cuci Toren / Tangki Air</option>
                                <option value="Instalasi Pipa"              {{ old('service_type')=='Instalasi Pipa'?'selected':'' }}>Instalasi Pipa</option>
                                <option value="Lainnya"                     {{ old('service_type')=='Lainnya'?'selected':'' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="area">Kota / Area</label>
                            <select id="area" name="area">
                                <option value="">— Pilih Kota —</option>
                                <option value="Jabodetabek" {{ old('area')=='Jabodetabek'?'selected':'' }}>Jabodetabek</option>
                                <option value="Cirebon"     {{ old('area')=='Cirebon'?'selected':'' }}>Cirebon</option>
                                <option value="Semarang"    {{ old('area')=='Semarang'?'selected':'' }}>Semarang</option>
                                <option value="Yogyakarta"  {{ old('area')=='Yogyakarta'?'selected':'' }}>Yogyakarta</option>
                                <option value="Lampung"     {{ old('area')=='Lampung'?'selected':'' }}>Lampung</option>
                                <option value="Bandung"       {{ old('area')=='Bandung'?'selected':'' }}>Bandung</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan / Deskripsi Masalah <span style="color:#ef4444">*</span></label>
                        <textarea id="message" name="message" placeholder="Ceritakan masalah pipa Anda..." required>{{ old('message') }}</textarea>
                        @error('message')<span style="color:#ef4444;font-size:.82rem">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('styles')
<style>.sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0)}</style>
@endpush
