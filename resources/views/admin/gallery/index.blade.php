@extends('layouts.admin')
@section('title','Kelola Galeri & Dokumentasi Pekerjaan')
@section('page-title','Kelola Galeri & Dokumentasi Hybrid')

@section('admin-content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Manajemen Galeri Dokumentasi</h2>
        <p class="text-xs text-slate-500">Kelola foto & video pengerjaan riil teknisi, komparasi before/after, dan link ke rute SEO.</p>
    </div>
    <button onclick="openModal()" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Dokumentasi Baru
    </button>
</div>

{{-- Filters --}}
<div class="bg-white p-4 rounded-xl border border-slate-200 mb-6 flex flex-wrap gap-4 items-center justify-between">
    <form method="GET" action="{{ route('admin.gallery.index') }}" class="flex flex-wrap gap-3 items-center w-full md:w-auto">
        <select name="category" onchange="this.form.submit()" class="text-xs border border-slate-300 rounded-lg px-3 py-2 bg-white">
            <option value="">Semua Kategori</option>
            <option value="residential" {{ request('category')=='residential'?'selected':'' }}>Residensial</option>
            <option value="commercial_b2b" {{ request('category')=='commercial_b2b'?'selected':'' }}>Komersial & B2B</option>
            <option value="tools_equipment" {{ request('category')=='tools_equipment'?'selected':'' }}>Alat & Hydro-Jetting</option>
            <option value="team_action" {{ request('category')=='team_action'?'selected':'' }}>Tim & Lapangan</option>
            <option value="before_after" {{ request('category')=='before_after'?'selected':'' }}>Before & After</option>
        </select>
        
        <select name="media_type" onchange="this.form.submit()" class="text-xs border border-slate-300 rounded-lg px-3 py-2 bg-white">
            <option value="">Semua Media</option>
            <option value="image" {{ request('media_type')=='image'?'selected':'' }}>📷 Foto</option>
            <option value="video" {{ request('media_type')=='video'?'selected':'' }}>▶ Video</option>
        </select>

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="text-xs border border-slate-300 rounded-lg px-3 py-2 w-48">
        <button type="submit" class="bg-slate-800 text-white text-xs px-3 py-2 rounded-lg font-semibold">Filter</button>
    </form>
    
    <div class="text-xs text-slate-500">Total: <strong>{{ $galleries->total() }}</strong> Dokumentasi</div>
</div>

<div>
    @if($galleries->isEmpty())
    <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
        <div class="text-6xl mb-4">🖼️</div>
        <p class="text-slate-500 font-medium">Belum ada data galeri / dokumentasi pekerjaan.</p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($galleries as $gallery)
        <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group relative">
            <div class="aspect-video relative overflow-hidden bg-slate-900">
                <img src="{{ $gallery->display_thumbnail }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                
                {{-- Badges --}}
                <div class="absolute top-3 left-3 flex flex-wrap gap-1">
                    <span class="bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-0.5 rounded-md uppercase">{{ $gallery->category_label }}</span>
                    @if($gallery->media_type === 'video')
                        <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-md flex items-center gap-1">▶ Video</span>
                    @endif
                    @if($gallery->is_featured)
                        <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md">⭐ Unggulan</span>
                    @endif
                </div>

                @if($gallery->location_tag)
                <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-sm text-white text-[11px] px-2 py-0.5 rounded flex items-center gap-1">
                    📍 {{ $gallery->location_tag }}
                </div>
                @endif

                @if(!$gallery->is_active)
                <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-[2px] flex items-center justify-center">
                    <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">NONAKTIF</span>
                </div>
                @endif
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <h3 class="font-bold text-slate-800 text-sm mb-1 line-clamp-2" title="{{ $gallery->title }}">{{ $gallery->title }}</h3>
                <p class="text-xs text-slate-500 mb-3 line-clamp-2">{{ $gallery->description }}</p>
                
                @if($gallery->related_service_url)
                <div class="text-[11px] text-blue-600 font-medium mb-3 truncate">
                    🔗 {{ $gallery->related_service_url }}
                </div>
                @endif

                <div class="flex flex-wrap items-center gap-2 mt-auto pt-3 border-t border-slate-100">
                    <button type="button" onclick='openEditModal({!! json_encode($gallery) !!})' class="flex-1 py-1.5 px-2 bg-amber-50 text-amber-700 hover:bg-amber-100 rounded text-xs font-semibold text-center">
                        Edit
                    </button>
                    
                    <form action="{{ route('admin.gallery.featured', $gallery) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="py-1.5 px-2 rounded text-xs font-semibold {{ $gallery->is_featured ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600' }}" title="Toggle Featured">
                            ⭐
                        </button>
                    </form>

                    <form action="{{ route('admin.gallery.toggle', $gallery) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="py-1.5 px-2 rounded text-xs font-semibold {{ $gallery->is_active ? 'bg-slate-100 text-slate-700' : 'bg-blue-50 text-blue-700' }}">
                            {{ $gallery->is_active ? 'Hide' : 'Show' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Hapus galeri ini?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="py-1.5 px-2 bg-red-50 text-red-600 hover:bg-red-100 rounded text-xs font-semibold">
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

{{-- Modal Form --}}
<div id="galleryModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl flex flex-col max-h-[90vh]">
        <div class="p-4 sm:p-5 border-b border-slate-200 flex justify-between items-center bg-slate-50 rounded-t-2xl">
            <h3 id="modal-title" class="text-base font-bold text-slate-800">Tambah Dokumentasi Galeri</h3>
            <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-200 text-lg">&times;</button>
        </div>
        
        <div class="p-5 overflow-y-auto flex-grow">
            <form id="gallery-form" action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method-spoof"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Judul Proyek / Pekerjaan *</label>
                        <input type="text" id="title" name="title" required placeholder="Contoh: Pelancaran Pipa Wastafel Restoran Cilandak" class="w-full text-xs p-2.5 border border-slate-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kategori *</label>
                        <select id="category" name="category" required class="w-full text-xs p-2.5 border border-slate-300 rounded-lg">
                            <option value="residential">Residensial (Rumah/Cluster)</option>
                            <option value="commercial_b2b">Komersial & B2B</option>
                            <option value="tools_equipment">Alat & Hydro-Jetting</option>
                            <option value="team_action">Tim & Lapangan</option>
                            <option value="before_after">Before & After</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tipe Media *</label>
                        <select id="media_type" name="media_type" required class="w-full text-xs p-2.5 border border-slate-300 rounded-lg">
                            <option value="image">📷 Foto Res Tajam / Before After</option>
                            <option value="video">▶ Video Riil (MP4/WebM)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Thumbnail Cover / Gambar *</label>
                        <input type="file" id="thumbnail_file" name="thumbnail_file" accept="image/*" class="w-full text-xs p-1.5 border border-slate-300 rounded-lg">
                        <input type="text" id="thumbnail_path" name="thumbnail_path" placeholder="Atau paste URL Thumbnail CDN..." class="w-full text-xs p-2 border border-slate-300 rounded-lg mt-1">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">File Video / Media Utama (Opsional)</label>
                        <input type="file" id="media_file" name="media_file" accept="video/mp4,video/webm,image/*" class="w-full text-xs p-1.5 border border-slate-300 rounded-lg">
                        <input type="url" id="external_media_url" name="external_media_url" placeholder="Atau paste URL Direct Video MP4/CDN..." class="w-full text-xs p-2 border border-slate-300 rounded-lg mt-1">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Foto Sebelum (Khusus Before & After)</label>
                        <input type="file" id="before_image_file" name="before_image_file" accept="image/*" class="w-full text-xs p-1.5 border border-slate-300 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tag Lokasi Wilayah</label>
                        <input type="text" id="location_tag" name="location_tag" placeholder="Contoh: Jakarta Selatan, Surabaya, BSD" class="w-full text-xs p-2.5 border border-slate-300 rounded-lg">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Link Layanan Terkait (Silo Internal Linking)</label>
                        <input type="text" id="related_service_url" name="related_service_url" placeholder="Contoh: /jasa-saluran-mampet/jakarta-selatan atau /layanan-b2b-komersial" class="w-full text-xs p-2.5 border border-slate-300 rounded-lg">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi & Catatan Teknis</label>
                        <textarea id="description" name="description" rows="3" placeholder="Keterangan alat yang digunakan, tingkat kesulitan pengerjaan..." class="w-full text-xs p-2.5 border border-slate-300 rounded-lg"></textarea>
                    </div>

                    <div class="flex items-center gap-6 col-span-2">
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" class="rounded text-blue-600">
                            ⭐ Tampilkan sebagai Proyek Unggulan (Hero Banner)
                        </label>
                        <div>
                            <label class="text-xs font-bold text-slate-700 mr-2">Urutan:</label>
                            <input type="number" id="sort_order" name="sort_order" value="0" class="w-20 text-xs p-1.5 border border-slate-300 rounded-lg">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="p-4 border-t border-slate-200 flex justify-end gap-3 bg-slate-50 rounded-b-2xl">
            <button type="button" onclick="closeModal()" class="px-4 py-2 border border-slate-300 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
            <button type="submit" form="gallery-form" class="px-5 py-2 rounded-lg bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 shadow-sm">Simpan Data</button>
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
    document.getElementById('modal-title').textContent = 'Edit Data Galeri';
    
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
</script>
@endpush
