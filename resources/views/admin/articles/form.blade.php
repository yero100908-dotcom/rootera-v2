@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Artikel' : 'Edit Artikel')
@section('page-title', $mode === 'create' ? 'Tambah Artikel Baru' : 'Edit Artikel')

@section('admin-content')
<div style="max-width:900px">
    <a href="{{ route('admin.articles.index') }}" style="display:inline-flex;align-items:center;gap:.4rem;color:#6b7280;font-size:.88rem;margin-bottom:1.5rem">← Kembali</a>

    <form action="{{ $mode === 'create' ? route('admin.articles.store') : route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem">
            {{-- Main Fields --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem">
                <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:.95rem;color:#374151;margin-bottom:1.25rem">Konten Artikel</h3>
                    <div class="form-group">
                        <label for="title">Judul Artikel <span style="color:#ef4444">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" placeholder="Judul artikel yang menarik..." required>
                        @error('title')<span style="color:#ef4444;font-size:.82rem">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug URL</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" placeholder="otomatis dari judul">
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Ringkasan / Excerpt</label>
                        <textarea id="excerpt" name="excerpt" style="min-height:80px" placeholder="Ringkasan singkat artikel...">{{ old('excerpt', $article->excerpt) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Konten Lengkap <span style="color:#ef4444">*</span></label>
                        <textarea id="content" name="content" style="min-height:350px;font-family:monospace" placeholder="Tulis konten artikel (HTML diperbolehkan)...">{{ old('content', $article->content) }}</textarea>
                        @error('content')<span style="color:#ef4444;font-size:.82rem">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:.95rem;color:#374151;margin-bottom:1.25rem">SEO Meta</h3>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}" placeholder="Title SEO (max 60 karakter)">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" style="min-height:80px" placeholder="Deskripsi SEO (max 160 karakter)">{{ old('meta_description', $article->meta_description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Sidebar Fields --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem">
                <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:.95rem;color:#374151;margin-bottom:1.25rem">Publikasi</h3>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="draft" {{ old('status',$article->status) === 'draft' ? 'selected':'' }}>Draft</option>
                            <option value="published" {{ old('status',$article->status) === 'published' ? 'selected':'' }}>Terbit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="published_at">Tanggal Terbit</label>
                        <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div class="form-group">
                        <label for="author">Penulis</label>
                        <input type="text" id="author" name="author" value="{{ old('author', $article->author ?? 'Tim ROOTERA') }}">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem">
                        {{ $mode === 'create' ? 'Simpan Artikel' : 'Perbarui Artikel' }}
                    </button>
                </div>

                <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:.95rem;color:#374151;margin-bottom:1.25rem">Thumbnail</h3>
                    @if($article->thumbnail)
                    <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="thumbnail" style="width:100%;height:140px;object-fit:cover;border-radius:10px;margin-bottom:1rem">
                    @endif
                    <div class="form-group">
                        <label for="thumbnail">Pilih Gambar</label>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
