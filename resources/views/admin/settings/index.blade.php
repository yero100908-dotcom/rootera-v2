@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Website')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100">
        <h2 class="text-xl font-bold text-slate-900">Pengaturan Umum</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola gambar dan konfigurasi lainnya di website.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <div class="mb-6 max-w-xl">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Peralatan Modern (Landing Page)</label>
            @php 
                $setting = $settings->get('peralatan_modern_image');
                $imgValue = $setting ? $setting->value : 'images/ridgid.jpeg';
                $imageUrl = Str::startsWith($imgValue, 'images/') ? asset($imgValue) : asset('storage/' . $imgValue);
            @endphp
            
            <div class="mb-3">
                <img src="{{ $imageUrl }}" alt="Peralatan Modern" class="w-full max-w-sm rounded-lg border border-slate-200 shadow-sm object-cover" style="max-height: 250px;">
            </div>
            
            <input type="file" name="peralatan_modern_image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-colors">
            <p class="text-xs text-slate-500 mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</p>
        </div>

        <div class="pt-4 border-t border-slate-100">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-6 py-2.5 rounded-xl transition-colors shadow-sm">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
