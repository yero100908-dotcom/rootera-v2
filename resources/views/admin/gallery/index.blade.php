@extends('layouts.admin')
@section('title','Galeri Foto')
@section('page-title','Kelola Galeri Foto')

@section('admin-content')
<style>
    /* Responsive Adjustments */
    .btn-header-container {
        margin-bottom: 1.5rem; 
        display: flex; 
        justify-content: flex-end;
    }
    @media (max-width: 640px) {
        .btn-header-container {
            justify-content: stretch;
        }
        .btn-header-container button {
            width: 100%;
            justify-content: center;
        }
        .gallery-grid {
            grid-template-columns: 1fr !important;
            gap: 1.25rem !important;
        }
    }
</style>
<div class="btn-header-container">
    <button onclick="openModal()" style="background:#2563eb; color:#fff; border:none; padding:0.75rem 1.5rem; border-radius:8px; font-weight:600; cursor:pointer; box-shadow:0 4px 10px rgba(37,99,235,0.2); display:flex; align-items:center; gap:0.5rem;">
        <svg style="width:1.2rem;height:1.2rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Foto Gallery Baru
    </button>
</div>

<div>
    @if($photos->isEmpty())
    <div style="background:#fff;border-radius:16px;padding:4rem;text-align:center;color:#9ca3af;border:1px solid #e5e7eb">
        <div style="font-size:3rem;margin-bottom:1rem">🖼️</div>
        <p>Belum ada foto di galeri.</p>
    </div>
    @else
    <div class="gallery-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1.25rem">
        @foreach($photos as $photo)
        <div style="background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;transition:all .2s;display:flex;flex-direction:column;" onmouseover="this.style.boxShadow='0 4px 20px rgba(10,46,120,.12)'" onmouseout="this.style.boxShadow='none'">
            <div style="aspect-ratio:1;overflow:hidden;position:relative">
                <img src="{{ Storage::url($photo->image) }}" alt="{{ $photo->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .3s" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @if(!$photo->is_active)
                <div style="position:absolute;inset:0;background:rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.78rem;font-weight:600">NONAKTIF</div>
                @endif
            </div>
            <div style="padding:1rem;display:flex;flex-direction:column;flex-grow:1;">
                <p style="font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $photo->title }}">{{ $photo->title }}</p>
                @if($photo->category)
                <div style="margin-bottom:0.75rem">
                    <span style="font-size:.72rem;background:#eff6ff;color:#1d4ed8;padding:.2rem .6rem;border-radius:50px;font-weight:500;">{{ $photo->category }}</span>
                </div>
                @endif
                <div style="display:flex;gap:.5rem;margin-top:auto">
                    <form action="{{ route('admin.gallery.toggle',$photo) }}" method="POST" style="flex:1;">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-sm {{ $photo->is_active ? 'btn-edit' : 'btn-view' }}" style="font-size:.72rem;width:100%;justify-content:center;">{{ $photo->is_active ? 'Sembunyikan' : 'Tampilkan' }}</button>
                    </form>
                    <form action="{{ route('admin.gallery.destroy',$photo) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')" style="flex:1;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del" style="font-size:.72rem;width:100%;justify-content:center;">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div style="margin-top:2rem;display:flex;justify-content:center;">{{ $photos->links() }}</div>
    @endif
</div>

<!-- Modal Pop-up Gallery -->
<div id="galleryModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center; padding:1rem; opacity:0; transition:opacity 0.3s ease;">
    <!-- Modal Content -->
    <div style="background:#fff; width:100%; max-width:550px; border-radius:16px; box-shadow:0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); display:flex; flex-direction:column; max-height:90vh; transform:scale(0.95); transition:transform 0.3s ease;" id="modalContent">
        <!-- Modal Header -->
        <div style="padding:1.5rem; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center;">
            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;color:#0A2E78;font-size:1.15rem;margin:0;font-weight:700;">Tambah Foto Gallery Baru</h3>
            <button type="button" onclick="closeModal()" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:#9ca3af;display:flex;align-items:center;justify-content:center;line-height:1;width:32px;height:32px;border-radius:50%; transition:background 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='none'">&times;</button>
        </div>
        
        <!-- Modal Body (Scrollable) -->
        <div style="padding:1.5rem; overflow-y:auto; flex-grow:1;">
            <form id="gallery-form" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="title" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Judul Foto / Caption *</label>
                    <input type="text" id="title" name="title" required placeholder="Contoh: Tim Sedang Bekerja" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                </div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="category" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Kategori Layanan</label>
                    <select id="category" name="category" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;background:#fff;transition:border-color 0.2s;appearance:none;cursor:pointer;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                        <option value="">— Pilih Kategori —</option>
                        <option value="before">Before (Sebelum)</option>
                        <option value="after">After (Sesudah)</option>
                        <option value="team">Tim ROOTERA</option>
                        <option value="tools">Alat & Peralatan</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="image" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Upload File Gambar *</label>
                    
                    <!-- Area Drag and Drop Semu -->
                    <div style="border:2px dashed #d1d5db; border-radius:8px; padding:2rem; text-align:center; background:#f9fafb; transition:all 0.2s; cursor:pointer; position:relative;" onmouseover="this.style.borderColor='#2563eb'; this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb'">
                        <input type="file" id="image" name="image" accept="image/*" required style="position:absolute; inset:0; width:100%; height:100%; opacity:0; cursor:pointer;" onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'Belum ada file dipilih'">
                        
                        <div style="display:flex; flex-direction:column; align-items:center; gap:0.5rem; pointer-events:none;">
                            <svg style="width:2.5rem;height:2.5rem;color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span style="font-weight:600; color:#374151; font-size:0.95rem;">Drag & Drop atau Klik di sini</span>
                            <span style="font-size:0.8rem; color:#6b7280;" id="file-name">Mendukung format JPG, PNG, WEBP</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="description" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Deskripsi Singkat</label>
                    <textarea id="description" name="description" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;min-height:80px;font-family:inherit;outline:none;transition:border-color 0.2s;" placeholder="Keterangan tambahan (opsional)..." onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'"></textarea>
                </div>
                
                <div class="form-group" style="margin-bottom:0;">
                    <label for="sort_order" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Urutan (Sort Order)</label>
                    <input type="number" id="sort_order" name="sort_order" value="0" min="0" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div style="padding:1.25rem 1.5rem; border-top:1px solid #e5e7eb; display:flex; justify-content:flex-end; gap:1rem; background:#f9fafb; border-bottom-left-radius:16px; border-bottom-right-radius:16px;">
            <button type="button" onclick="closeModal()" style="padding:0.6rem 1.2rem; border-radius:8px; border:1px solid #d1d5db; background:#fff; color:#374151; font-weight:600; cursor:pointer; transition:background 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#fff'">Batal</button>
            <button type="submit" form="gallery-form" style="background:#2563eb; color:#fff; border:none; padding:0.6rem 1.5rem; border-radius:8px; font-weight:600; cursor:pointer; box-shadow:0 4px 6px -1px rgba(37, 99, 235, 0.2); transition:background 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">Simpan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const modal = document.getElementById('galleryModal');
const modalContent = document.getElementById('modalContent');

function openModal() {
    document.getElementById('gallery-form').reset();
    document.getElementById('file-name').textContent = 'Mendukung format JPG, PNG, WEBP';
    
    // Show modal with animation
    modal.style.display = 'flex';
    // Trigger reflow
    void modal.offsetWidth;
    modal.style.opacity = '1';
    modalContent.style.transform = 'scale(1)';
}

function closeModal() {
    modal.style.opacity = '0';
    modalContent.style.transform = 'scale(0.95)';
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Close modal when clicking outside of it
modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        closeModal();
    }
});
</script>
@endpush
