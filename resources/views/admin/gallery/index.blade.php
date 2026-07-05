@extends('layouts.admin')
@section('title','Galeri Foto')
@section('page-title','Kelola Galeri Foto')

@section('admin-content')
<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start">
    {{-- Gallery Grid --}}
    <div>
        @if($photos->isEmpty())
        <div style="background:#fff;border-radius:16px;padding:4rem;text-align:center;color:#9ca3af;border:1px solid #e5e7eb">
            <div style="font-size:3rem;margin-bottom:1rem">🖼️</div>
            <p>Belum ada foto di galeri.</p>
        </div>
        @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem">
            @foreach($photos as $photo)
            <div style="background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;transition:all .2s" onmouseover="this.style.boxShadow='0 4px 20px rgba(10,46,120,.12)'" onmouseout="this.style.boxShadow='none'">
                <div style="aspect-ratio:1;overflow:hidden;position:relative">
                    <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .3s" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    @if(!$photo->is_active)
                    <div style="position:absolute;inset:0;background:rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.78rem;font-weight:600">NONAKTIF</div>
                    @endif
                </div>
                <div style="padding:.75rem">
                    <p style="font-size:.82rem;font-weight:600;color:#374151;margin-bottom:.25rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $photo->title }}</p>
                    @if($photo->category)
                    <span style="font-size:.72rem;background:#eff6ff;color:#1d4ed8;padding:.15rem .5rem;border-radius:50px">{{ $photo->category }}</span>
                    @endif
                    <div style="display:flex;gap:.4rem;margin-top:.6rem">
                        <form action="{{ route('admin.gallery.toggle',$photo) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-sm {{ $photo->is_active ? 'btn-edit' : 'btn-view' }}" style="font-size:.72rem">{{ $photo->is_active ? 'Sembunyikan' : 'Tampilkan' }}</button>
                        </form>
                        <form action="{{ route('admin.gallery.destroy',$photo) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm btn-del" style="font-size:.72rem">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:1.5rem">{{ $photos->links() }}</div>
        @endif
    </div>

    {{-- Upload Form --}}
    <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb;position:sticky;top:5rem">
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif;color:#0A2E78;margin-bottom:1.25rem;font-size:.95rem">Upload Foto Baru</h3>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Foto *</label>
                <input type="text" id="title" name="title" required placeholder="Deskripsi foto...">
            </div>
            <div class="form-group">
                <label for="image">Pilih Gambar *</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="category">Kategori</label>
                <select id="category" name="category">
                    <option value="">— Pilih Kategori —</option>
                    <option value="before">Before (Sebelum)</option>
                    <option value="after">After (Sesudah)</option>
                    <option value="team">Tim ROOTERA</option>
                    <option value="tools">Alat & Peralatan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Keterangan</label>
                <textarea id="description" name="description" style="min-height:70px" placeholder="Keterangan tambahan..."></textarea>
            </div>
            <div class="form-group">
                <label for="sort_order">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" value="0" min="0">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Upload Foto</button>
        </form>
    </div>
</div>
@endsection
