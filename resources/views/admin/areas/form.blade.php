@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Area' : 'Edit Area')
@section('page-title', $mode === 'create' ? 'Tambah Area Layanan' : 'Edit Area Layanan')

@section('admin-content')
<div class="max-w-4xl mx-auto pb-12">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.service-areas.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
            ← Kembali ke Daftar Area Layanan
        </a>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
        <form action="{{ $mode === 'create' ? route('admin.service-areas.store') : route('admin.service-areas.update', $area) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($mode === 'edit') @method('PUT') @endif

            <h3 class="font-extrabold text-slate-900 text-base mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Informasi Wilayah Operasional
            </h3>

            <div class="space-y-5 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Nama Area / Kota *</label>
                        <input type="text" id="name" name="name" value="{{ old('name',$area->name) }}" placeholder="Contoh: Bekasi, Jakarta Selatan, Solo" required
                               class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-900">
                    </div>
                    <div>
                        <label for="province" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Provinsi</label>
                        <input type="text" id="province" name="province" value="{{ old('province',$area->province) }}" placeholder="Contoh: Jawa Barat, DKI Jakarta, Jawa Tengah"
                               class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-900">
                    </div>
                </div>

                <div>
                    <label for="slug" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Slug URL</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug',$area->slug) }}" placeholder="Otomatis dari nama"
                           class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-mono text-slate-600">
                </div>

                <div>
                    <label for="description" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Deskripsi Wilayah</label>
                    <textarea id="description" name="description" rows="3" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-sm text-slate-800">{{ old('description',$area->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="image" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Gambar Sampul Area</label>
                        @if($area->image)
                            <img src="{{ Storage::url($area->image) }}" alt="" class="w-full h-32 object-cover rounded-2xl mb-3 border border-slate-200">
                        @endif
                        <input type="file" id="image" name="image" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                    </div>

                    <div>
                        <label for="google_maps_embed" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Google Maps Embed URL</label>
                        <input type="text" id="google_maps_embed" name="google_maps_embed" value="{{ old('google_maps_embed',$area->google_maps_embed) }}" placeholder="https://www.google.com/maps/embed?..."
                               class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-800">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center pt-2">
                    <div>
                        <label for="sort_order" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Urutan Tampil</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order',$area->sort_order ?? 0) }}" min="0"
                               class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-900">
                    </div>

                    @if($mode === 'edit')
                    <div class="pt-6">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-extrabold text-slate-800">
                            <input type="checkbox" name="is_active" value="1" {{ $area->is_active ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500">
                            <span>Status Area Aktif Operasional</span>
                        </label>
                    </div>
                    @endif
                </div>
            </div>

            <h3 class="font-extrabold text-slate-900 text-base mb-4 border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                Meta Tags Local SEO
            </h3>

            <div class="space-y-4 mb-8">
                <div>
                    <label for="meta_title" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Meta Title SEO</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title',$area->meta_title) }}"
                           class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm text-slate-900">
                </div>
                <div>
                    <label for="meta_description" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Meta Description SEO</label>
                    <textarea id="meta_description" name="meta_description" rows="3" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-sm text-slate-800">{{ old('meta_description',$area->meta_description) }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm py-3.5 px-6 rounded-xl shadow-md transition-all hover:shadow-emerald-600/30">
                    {{ $mode === 'create' ? '💾 Simpan Area Layanan Baru' : '🔄 Perbarui Data Area' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
