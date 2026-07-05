@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Area' : 'Edit Area')
@section('page-title', $mode === 'create' ? 'Tambah Area Layanan' : 'Edit Area Layanan')

@section('admin-content')
<div style="max-width:700px">
    <a href="{{ route('admin.service-areas.index') }}" style="display:inline-flex;align-items:center;gap:.4rem;color:#6b7280;font-size:.88rem;margin-bottom:1.5rem">← Kembali</a>
    <div style="background:#fff;border-radius:16px;padding:2rem;border:1px solid #e5e7eb">
        <form action="{{ $mode === 'create' ? route('admin.service-areas.store') : route('admin.service-areas.update', $area) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($mode === 'edit') @method('PUT') @endif
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Nama Area *</label>
                    <input type="text" id="name" name="name" value="{{ old('name',$area->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="province">Provinsi</label>
                    <input type="text" id="province" name="province" value="{{ old('province',$area->province) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="slug">Slug URL</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug',$area->slug) }}" placeholder="otomatis dari nama">
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" style="min-height:100px">{{ old('description',$area->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Gambar Area</label>
                @if($area->image)
                    <img src="{{ Storage::url($area->image) }}" alt="" style="width:120px;height:80px;object-fit:cover;border-radius:8px;margin-bottom:.75rem">
                @endif
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="google_maps_embed">Google Maps Embed URL</label>
                <input type="text" id="google_maps_embed" name="google_maps_embed" value="{{ old('google_maps_embed',$area->google_maps_embed) }}" placeholder="https://www.google.com/maps/embed?...">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="sort_order">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order',$area->sort_order ?? 0) }}" min="0">
                </div>
                @if($mode === 'edit')
                <div class="form-group">
                    <label style="display:flex;align-items:center;gap:.5rem;margin-top:1.8rem;cursor:pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $area->is_active ? 'checked' : '' }} style="accent-color:#169F81">
                        Aktif
                    </label>
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="meta_title">Meta Title SEO</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title',$area->meta_title) }}">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description SEO</label>
                <textarea id="meta_description" name="meta_description" style="min-height:80px">{{ old('meta_description',$area->meta_description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                {{ $mode === 'create' ? 'Tambah Area' : 'Perbarui Area' }}
            </button>
        </form>
    </div>
</div>
@endsection
