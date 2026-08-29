@extends('layouts.admin')
@section('title','Kelola Galeri & Dokumentasi Pekerjaan')
@section('page-title','Galeri Media & Dokumentasi Hybrid')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden mb-8">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-fuchsia-50 text-fuchsia-600 border border-fuchsia-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Manajemen Galeri &amp; Video Dokumentasi</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-fuchsia-600 font-bold">{{ $galleries->total() }}</strong> media foto &amp; video riil teknisi.</p>
            </div>
        </div>

        <button onclick="openModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Dokumentasi Baru</span>
        </button>
    </div>

    {{-- Filters Bar --}}
    <div class="p-4 sm:px-6 bg-white border-b border-slate-100">
        <form method="GET" action="{{ route('admin.gallery.index') }}" class="flex flex-wrap gap-3 items-center justify-between">
            <div class="flex flex-wrap gap-3 items-center w-full md:w-auto">
                <select name="category" onchange="this.form.submit()" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-slate-50/50 focus:bg-white text-slate-700">
                    <option value="">Semua Kategori</option>
                    <option value="residential" {{ request('category')=='residential'?'selected':'' }}>Residensial (Rumah)</option>
                    <option value="commercial_b2b" {{ request('category')=='commercial_b2b'?'selected':'' }}>Komersial &amp; B2B</option>
                    <option value="tools_equipment" {{ request('category')=='tools_equipment'?'selected':'' }}>Alat &amp; Hydro-Jetting</option>
                    <option value="team_action" {{ request('category')=='team_action'?'selected':'' }}>Tim &amp; Lapangan</option>
                    <option value="before_after" {{ request('category')=='before_after'?'selected':'' }}>Before &amp; After</option>
                </select>
                
                <select name="media_type" onchange="this.form.submit()" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-slate-50/50 focus:bg-white text-slate-700">
                    <option value="">Semua Format</option>
                    <option value="image" {{ request('media_type')=='image'?'selected':'' }}>📷 Foto High-Res</option>
                    <option value="video" {{ request('media_type')=='video'?'selected':'' }}>▶ Video Riil</option>
                </select>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="text-xs border border-slate-200 rounded-xl px-3 py-2 w-48 bg-slate-50/50 focus:bg-white text-slate-800">
                <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white text-xs px-4 py-2 rounded-xl font-bold transition-all">Filter</button>
            </div>
            
            <div class="text-xs text-slate-400 font-semibold hidden lg:block">
                Halaman {{ $galleries->currentPage() }} dari {{ $galleries->lastPage() }}
            </div>
        </form>
    </div>
</div>

{{-- Media Grid --}}
<div>
    @if($galleries->isEmpty())
    <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-xs">
        <div class="text-5xl mb-3">🖼️</div>
        <p class="text-slate-700 font-bold text-sm">Belum ada data galeri / dokumentasi pekerjaan.</p>
        <p class="text-slate-400 text-xs mt-1">Klik tombol "+ Tambah Dokumentasi Baru" untuk mengunggah media baru.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($galleries as $gallery)
        <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-xl hover:border-slate-300 transition-all duration-300 flex flex-col group relative">
            <div class="aspect-video relative overflow-hidden bg-slate-950">
                <img src="{{ $gallery->display_thumbnail }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                
                {{-- Badges --}}
                <div class="absolute top-3 left-3 flex flex-wrap gap-1 z-10">
                    <span class="bg-slate-950/80 backdrop-blur-md text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full uppercase border border-white/10">{{ $gallery->category_label }}</span>
                    @if($gallery->media_type === 'video')
                        <span class="bg-rose-600 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full flex items-center gap-1 shadow-sm">▶ Video</span>
                    @endif
                    @if($gallery->is_featured)
                        <span class="bg-amber-500 text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-sm">⭐ Unggulan</span>
                    @endif
                </div>

                @if($gallery->location_tag)
                <div class="absolute bottom-2 left-2 bg-slate-950/80 backdrop-blur-md text-slate-200 text-[11px] font-semibold px-2.5 py-0.5 rounded-md border border-white/10 z-10">
                    📍 {{ $gallery->location_tag }}
                </div>
                @endif

                @if(!$gallery->is_active)
                <div class="absolute inset-0 bg-slate-950/75 backdrop-blur-xs flex items-center justify-center z-20">
                    <span class="bg-rose-600 text-white text-xs font-extrabold px-3.5 py-1 rounded-full shadow-md">NONAKTIF</span>
                </div>
                @endif
            </div>

            <div class="p-5 flex flex-col flex-grow justify-between">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-sm mb-1.5 line-clamp-2 leading-snug" title="{{ $gallery->title }}">{{ $gallery->title }}</h3>
                    <p class="text-xs text-slate-500 mb-3 line-clamp-2 leading-relaxed">{{ $gallery->description }}</p>
                    
                    @if($gallery->related_service_url)
                    <div class="text-[11px] text-emerald-700 font-extrabold mb-3 truncate font-mono bg-emerald-50 px-2 py-1 rounded-md border border-emerald-100">
                        🔗 {{ $gallery->related_service_url }}
                    </div>
                    @endif
                </div>

                <div class="flex items-center justify-between gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick='openEditModal({!! json_encode($gallery) !!})' class="flex-1 py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-800 rounded-xl text-xs font-bold text-center transition-colors">
                        ✏️ Edit Data
                    </button>
                    
                    <form action="{{ route('admin.gallery.featured', $gallery) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="p-2 rounded-xl text-xs font-bold transition-colors {{ $gallery->is_featured ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}" title="Toggle Unggulan">
                            ⭐
                        </button>
                    </form>

                    <form action="{{ route('admin.gallery.toggle', $gallery) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="py-2 px-3 rounded-xl text-xs font-bold transition-colors {{ $gallery->is_active ? 'bg-slate-100 text-slate-700 hover:bg-slate-200' : 'bg-emerald-100 text-emerald-800' }}">
                            {{ $gallery->is_active ? 'Sembunyi' : 'Aktifkan' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus galeri ini secara permanen?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200/80 rounded-xl text-xs font-bold transition-colors">
                            🗑️
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8 flex justify-center">{{ $galleries->links() }}</div>
    @endif
</div>

{{-- Modal Pop-up Form --}}
<div id="galleryModal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 id="modal-title" class="font-extrabold text-slate-900 text-base">Tambah Dokumentasi Galeri</h3>
            <button type="button" onclick="closeModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>
        
        <div class="p-6 overflow-y-auto flex-grow space-y-4">
            <form id="gallery-form" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method-spoof"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Judul Pekerjaan *</label>
                        <input type="text" id="title" name="title" required placeholder="Contoh: Pelancaran Pipa Wastafel Restoran Cilandak" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Kategori *</label>
                        <select id="category" name="category" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                            <option value="residential">Residensial (Rumah)</option>
                            <option value="commercial_b2b">Komersial &amp; B2B</option>
                            <option value="tools_equipment">Alat &amp; Hydro-Jetting</option>
                            <option value="team_action">Tim &amp; Lapangan</option>
                            <option value="before_after">Before &amp; After</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Format Media *</label>
                        <select id="media_type" name="media_type" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                            <option value="image">📷 Foto High-Res</option>
                            <option value="video">▶ Video Riil (MP4/WebM)</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">File Gambar Thumbnail *</label>
                        <input type="file" id="thumbnail_file" name="thumbnail_file" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                        <input type="text" id="thumbnail_path" name="thumbnail_path" placeholder="Atau simpan path/URL gambar WebP..." class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-mono text-slate-600 mt-1">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">File Video (Opsional)</label>
                        <input type="file" id="media_file" name="media_file" accept="video/mp4,video/webm,image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                        <input type="url" id="external_media_url" name="external_media_url" placeholder="Atau paste URL Direct Video MP4..." class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-mono text-slate-600 mt-1">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Tag Wilayah Lokasi</label>
                        <input type="text" id="location_tag" name="location_tag" placeholder="Jakarta Selatan, Surabaya, BSD" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-900">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Link Layanan (Internal Linking)</label>
                        <input type="text" id="related_service_url" name="related_service_url" placeholder="/layanan-pipa-mampet/bekasi" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-mono text-slate-600">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Deskripsi &amp; Catatan Pekerjaan</label>
                        <textarea id="description" name="description" rows="3" placeholder="Keterangan mesin RGGID yang digunakan..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
                    </div>

                    <div class="flex items-center gap-6 md:col-span-2 pt-2">
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-extrabold text-slate-800">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500">
                            ⭐ Tampilkan sebagai Proyek Unggulan (Hero Banner)
                        </label>
                        <div class="flex items-center gap-2">
                            <label class="text-xs font-bold text-slate-700">Urutan:</label>
                            <input type="number" id="sort_order" name="sort_order" value="0" class="w-20 bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs text-slate-900">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
            <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">Batal</button>
            <button type="submit" form="gallery-form" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-600/20 transition-all">Simpan Data Media</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const modal = document.getElementById('galleryModal');

function openModal() {
    document.getElementById('gallery-form').reset();
    document.getElementById('gallery-form').action = "{{ route('admin.gallery.store') }}";
    document.getElementById('method-spoof').innerHTML = '';
    document.getElementById('modal-title').textContent = 'Tambah Dokumentasi Galeri Baru';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

function openEditModal(data) {
    document.getElementById('gallery-form').reset();
    document.getElementById('gallery-form').action = `/admin/gallery/${data.id}`;
    document.getElementById('method-spoof').innerHTML = '@method("PUT")';
    document.getElementById('modal-title').textContent = 'Edit Data Galeri Media';
    
    document.getElementById('title').value = data.title || '';
    document.getElementById('category').value = data.category || 'residential';
    document.getElementById('media_type').value = data.media_type || 'image';
    document.getElementById('thumbnail_path').value = data.thumbnail_path || '';
    document.getElementById('external_media_url').value = data.external_media_url || '';
    document.getElementById('location_tag').value = data.location_tag || '';
    document.getElementById('related_service_url').value = data.related_service_url || '';
    document.getElementById('description').value = data.description || '';
    document.getElementById('sort_order').value = data.sort_order || 0;
    document.getElementById('is_featured').checked = !!data.is_featured;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

modal.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
});
</script>
@endpush
