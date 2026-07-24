@extends('layouts.admin')
@section('title','Galeri Foto')
@section('page-title','Kelola Galeri Foto')

@section('admin-content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h2 class="text-xl font-bold text-slate-800">Manajemen Galeri</h2>
    <button onclick="openModal()" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Foto Baru
    </button>
</div>

<div>
    @if($photos->isEmpty())
    <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
        <div class="text-6xl mb-4">🖼️</div>
        <p class="text-slate-500 font-medium">Belum ada foto di galeri.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($photos as $photo)
        <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
            <div class="aspect-video relative overflow-hidden bg-slate-100 flex items-center justify-center">
                <img src="{{ Storage::url($photo->image) }}" alt="{{ $photo->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <svg class="w-12 h-12 text-slate-300 hidden absolute" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                
                @if($photo->category)
                <div class="absolute top-3 left-3">
                    <span class="bg-slate-900/70 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">{{ $photo->category }}</span>
                </div>
                @endif
                
                @if(!$photo->is_active)
                <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-[2px] flex items-center justify-center">
                    <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">NONAKTIF</span>
                </div>
                @endif
            </div>
            <div class="p-4 flex flex-col flex-grow">
                <p class="font-semibold text-slate-800 text-sm mb-4 line-clamp-2 leading-snug flex-grow" title="{{ $photo->title }}">{{ $photo->title }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-auto">
                    <button type="button" onclick="openEditModal({{ $photo->id }}, '{{ addslashes($photo->title) }}', '{{ $photo->category }}', '{{ addslashes($photo->description) }}', {{ $photo->sort_order ?? 0 }})" class="flex-1 min-w-[30%] py-2 px-2 bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 rounded-md text-xs font-semibold flex justify-center items-center gap-1 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg> Edit
                    </button>
                    <form action="{{ route('admin.gallery.toggle',$photo) }}" method="POST" class="flex-1 min-w-[30%]">
                        @csrf @method('PATCH')
                        <button type="submit" class="w-full py-2 px-3 rounded-md text-xs font-semibold flex justify-center items-center gap-1 transition-colors {{ $photo->is_active ? 'bg-slate-100 text-slate-700 hover:bg-slate-200' : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}">
                            @if($photo->is_active)
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg> Hide
                            @else
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg> Show
                            @endif
                        </button>
                    </form>
                    <form action="{{ route('admin.gallery.destroy',$photo) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')" class="flex-1 min-w-[30%]">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full py-2 px-3 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 rounded-md text-xs font-semibold flex justify-center items-center gap-1 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8 flex justify-center">{{ $photos->links() }}</div>
    @endif
</div>

<!-- Modal Pop-up Gallery -->
<div id="galleryModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <!-- Modal Content -->
    <div id="modalContent" class="bg-white w-full max-w-lg rounded-2xl shadow-xl flex flex-col max-h-[90vh] transform scale-95 transition-transform duration-300">
        <!-- Modal Header -->
        <div class="p-4 sm:p-6 border-b border-slate-200 flex justify-between items-center">
            <h3 id="modal-title" class="text-xl font-bold text-slate-800 m-0">Tambah Foto Gallery Baru</h3>
            <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors">&times;</button>
        </div>
        
        <!-- Modal Body (Scrollable) -->
        <div class="p-4 sm:p-6 overflow-y-auto flex-grow">
            <form id="gallery-form" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method-spoof"></div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="title" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Judul Foto / Caption *</label>
                    <input type="text" id="title" name="title" required placeholder="Contoh: Tim Sedang Bekerja" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                </div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="category" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Kategori Layanan</label>
                    <select id="category" name="category" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;background:#fff;transition:border-color 0.2s;appearance:none;cursor:pointer;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                        <option value="">— Pilih Kategori —</option>
                        <option value="residential">Residential (Perumahan)</option>
                        <option value="commercial">Commercial (Komersial)</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="image" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Upload File Gambar <span id="image-asterisk">*</span></label>
                    <div style="font-size: 0.8rem; color: #6b7280; margin-bottom: 0.5rem;" id="image-hint"></div>
                    
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
        <div class="p-4 sm:p-6 border-t border-slate-200 flex justify-end gap-3 bg-slate-50 rounded-b-2xl">
            <button type="button" onclick="closeModal()" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-600 hover:bg-slate-100 font-medium transition-colors">Batal</button>
            <button type="submit" form="gallery-form" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition-colors shadow-sm">Simpan</button>
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
    document.getElementById('gallery-form').action = "{{ route('admin.gallery.store') }}";
    document.getElementById('method-spoof').innerHTML = '';
    document.getElementById('modal-title').textContent = 'Tambah Foto Gallery Baru';
    document.getElementById('image').required = true;
    document.getElementById('image-asterisk').style.display = 'inline';
    document.getElementById('image-hint').textContent = '';
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

function openEditModal(id, title, category, description, sort_order) {
    document.getElementById('gallery-form').reset();
    document.getElementById('gallery-form').action = `/admin/gallery/${id}`;
    document.getElementById('method-spoof').innerHTML = '@method("PUT")';
    document.getElementById('modal-title').textContent = 'Edit Foto Gallery';
    
    document.getElementById('title').value = title;
    document.getElementById('category').value = category;
    document.getElementById('description').value = description || '';
    document.getElementById('sort_order').value = sort_order;
    
    document.getElementById('image').required = false;
    document.getElementById('image-asterisk').style.display = 'none';
    document.getElementById('image-hint').textContent = 'Biarkan kosong jika tidak ingin mengubah gambar.';
    document.getElementById('file-name').textContent = 'Pilih gambar baru (opsional)';
    
    modal.style.display = 'flex';
    void modal.offsetWidth;
    modal.style.opacity = '1';
    modalContent.style.transform = 'scale(1)';
}

// Close modal when clicking outside of it
modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        closeModal();
    }
});
</script>
@endpush
