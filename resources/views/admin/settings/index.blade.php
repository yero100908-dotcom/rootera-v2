@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Web &amp; Media Utama')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden max-w-4xl">
    {{-- Header Bar --}}
    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <div>
            <h2 class="text-lg font-extrabold text-slate-900">Pengaturan Media &amp; Visual Utama</h2>
            <p class="text-xs text-slate-500 mt-0.5">Konfigurasi aset banner dan peralatan modern yang dirender pada Landing Page.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        
        <div>
            <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Gambar Peralatan Modern (Landing Page)</label>
            @php 
                $setting = $settings->get('peralatan_modern_image');
                $imgValue = $setting ? $setting->value : 'images/ridgid.jpeg';
                $imageUrl = Str::startsWith($imgValue, 'images/') ? asset($imgValue) : asset('storage/' . $imgValue);
            @endphp
            
            <div class="mb-4">
                <div class="w-full max-w-md h-56 rounded-2xl border border-slate-200/80 bg-slate-950 overflow-hidden shadow-xs relative group">
                    <img id="setting-img-preview" src="{{ $imageUrl }}" alt="Peralatan Modern" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                        Gambar Aktif Saat Ini
                    </div>
                </div>
            </div>
            
            <input type="file" name="peralatan_modern_image" accept="image/*" onchange="previewSettingImg(this)" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
            <p class="text-[11px] text-slate-400 mt-2 font-medium">Biarkan kosong jika tidak ingin mengubah gambar peralatan modern.</p>
        </div>

        <div class="pt-6 border-t border-slate-100 flex justify-end">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm py-3 px-6 rounded-xl shadow-md transition-all hover:shadow-emerald-600/20">
                💾 Simpan Pengaturan Website
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewSettingImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('setting-img-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
