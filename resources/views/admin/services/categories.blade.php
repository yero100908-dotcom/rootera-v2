@extends('layouts.admin')
@section('title','Kelola Kategori Layanan')
@section('page-title','Kategori Layanan')

@section('admin-content')
<style>
    /* Responsive Adjustments */
    .btn-header-container {
        margin-bottom: 1.5rem; 
        display: flex; 
        justify-content: flex-end;
    }
    .price-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }
    @media (max-width: 640px) {
        .btn-header-container {
            justify-content: stretch;
        }
        .btn-header-container button {
            width: 100%;
            justify-content: center;
        }
        .price-grid {
            grid-template-columns: 1fr;
        }
        .admin-table th, .admin-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }
    }
</style>
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-4 sm:px-6 sm:py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
        <div class="flex items-center gap-3">
            <div class="bg-emerald-50 p-2 rounded-lg text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 10 9 4-9 4"/><path d="m21 10-9 4 9 4"/><path d="m11 2 9 4-9 4-9-4 9-4z"/><path d="m11 22 9-4"/></svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-slate-900">Daftar Kategori Layanan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong>{{ count($categories) }}</strong> kategori terdaftar</p>
            </div>
        </div>
        <button onclick="openModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Kategori Baru
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Nama Kategori</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Slug</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-center">Layanan</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-center">Status</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
            @forelse($categories as $category)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-3 max-w-xs">
                        <strong class="text-sm font-medium text-slate-900 block truncate">{{ $category->name }}</strong>
                        <div class="text-xs text-slate-500 mt-0.5 truncate">{{ Str::limit($category->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-3">
                        <span class="text-xs text-slate-500 font-mono">{{ $category->slug }}</span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 text-xs font-semibold ring-1 ring-inset ring-blue-600/20">
                            {{ $category->services_count ?? 0 }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <button onclick="toggleCategory({{ $category->id }}, this)" class="focus:outline-none transition-transform active:scale-95">
                            @if($category->is_active)
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-slate-50 text-slate-700 ring-1 ring-inset ring-slate-600/20">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick="fillForm({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->slug }}', '{{ addslashes($category->description) }}', {{ $category->sort_order }}, {{ $category->is_active ? 1 : 0 }}, '{{ addslashes($category->price_home) }}', '{{ addslashes($category->price_corporate) }}', '{{ addslashes($category->price_description) }}')" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.service-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 p-1.5 rounded transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <p class="text-sm font-medium">Belum ada kategori layanan terdaftar.</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pop-up -->
<div id="categoryModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center; padding:1rem; opacity:0; transition:opacity 0.3s ease;">
    <!-- Modal Content -->
    <div style="background:#fff; width:100%; max-width:600px; border-radius:16px; box-shadow:0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); display:flex; flex-direction:column; max-height:90vh; transform:scale(0.95); transition:transform 0.3s ease;" id="modalContent">
        <!-- Modal Header -->
        <div style="padding:1.5rem; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center;">
            <h3 id="form-title" style="font-family:'Plus Jakarta Sans',sans-serif;color:#0A2E78;font-size:1.15rem;margin:0;font-weight:700;">Tambah Kategori Baru</h3>
            <button type="button" onclick="closeModal()" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:#9ca3af;display:flex;align-items:center;justify-content:center;line-height:1;width:32px;height:32px;border-radius:50%; transition:background 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='none'">&times;</button>
        </div>
        
        <!-- Modal Body (Scrollable) -->
        <div style="padding:1.5rem; overflow-y:auto; flex-grow:1;">
            <form id="cat-form" action="{{ route('admin.service-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="form-method" name="_method" value="">
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="cat-name" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Nama Kategori *</label>
                    <input type="text" id="cat-name" name="name" required style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                </div>
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="cat-slug" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Slug</label>
                    <input type="text" id="cat-slug" name="slug" placeholder="otomatis dari nama" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;background:#f9fafb;outline:none;">
                </div>
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="cat-desc" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Deskripsi</label>
                    <textarea id="cat-desc" name="description" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;min-height:90px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'"></textarea>
                </div>
                
                <div style="padding-top:1.5rem; border-top:1px dashed #e5e7eb; margin-top:1.5rem; margin-bottom:1.25rem;">
                    <label style="color:#0A2E78; font-weight:700;font-size:0.95rem;">Detail Harga (Opsional)</label>
                </div>
                
                <div class="price-grid">
                    <div class="form-group">
                        <label for="cat-price-home" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Harga Rumahan</label>
                        <input type="text" id="cat-price-home" name="price_home" placeholder="Contoh: 400.000" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                    </div>
                    <div class="form-group">
                        <label for="cat-price-corporate" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Harga Perusahaan/Gedung</label>
                        <input type="text" id="cat-price-corporate" name="price_corporate" placeholder="Contoh: 600.000 - 1.000.000" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                    </div>
                </div>
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label for="cat-price-desc" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Deskripsi Harga</label>
                    <textarea id="cat-price-desc" name="price_description" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;min-height:70px;font-family:inherit;outline:none;transition:border-color 0.2s;" placeholder="Contoh: Harga dapat menyesuaikan tingkat keparahan..." onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'"></textarea>
                </div>
                
                <div class="form-group" style="padding-top:1.5rem; border-top:1px dashed #e5e7eb; margin-top:1.5rem; margin-bottom:1.25rem;">
                    <label for="cat-order" style="display:block;margin-bottom:.5rem;font-weight:600;font-size:0.9rem;color:#374151;">Urutan</label>
                    <input type="number" id="cat-order" name="sort_order" value="0" min="0" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;outline:none;transition:border-color 0.2s;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#d1d5db'">
                </div>
                <div class="form-group" id="active-group" style="display:none; margin-bottom:0;">
                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-weight:600;font-size:0.9rem;color:#374151;">
                        <input type="checkbox" id="cat-active" name="is_active" value="1" style="width:1.1rem;height:1.1rem;accent-color:#169F81">
                        Status Aktif
                    </label>
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div style="padding:1.25rem 1.5rem; border-top:1px solid #e5e7eb; display:flex; justify-content:flex-end; gap:1rem; background:#f9fafb; border-bottom-left-radius:16px; border-bottom-right-radius:16px;">
            <button type="button" onclick="closeModal()" style="padding:0.6rem 1.2rem; border-radius:8px; border:1px solid #d1d5db; background:#fff; color:#374151; font-weight:600; cursor:pointer; transition:background 0.2s;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='#fff'">Batal</button>
            <button type="submit" form="cat-form" style="background:#2563eb; color:#fff; border:none; padding:0.6rem 1.5rem; border-radius:8px; font-weight:600; cursor:pointer; box-shadow:0 4px 6px -1px rgba(37, 99, 235, 0.2); transition:background 0.2s;" onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">Simpan Kategori</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const modal = document.getElementById('categoryModal');
const modalContent = document.getElementById('modalContent');

function openModal() {
    document.getElementById('form-title').textContent = 'Tambah Kategori Baru';
    document.getElementById('cat-form').action = '{{ route("admin.service-categories.store") }}';
    document.getElementById('form-method').value = '';
    document.getElementById('cat-form').reset();
    document.getElementById('active-group').style.display = 'none';
    
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

function fillForm(id, name, slug, desc, order, active, priceHome, priceCorporate, priceDesc) {
    document.getElementById('form-title').textContent = 'Edit Kategori';
    document.getElementById('cat-form').action = '/admin/service-categories/' + id;
    document.getElementById('form-method').value = 'PUT';
    document.getElementById('cat-name').value = name;
    document.getElementById('cat-slug').value = slug;
    document.getElementById('cat-desc').value = desc;
    document.getElementById('cat-price-home').value = priceHome || '';
    document.getElementById('cat-price-corporate').value = priceCorporate || '';
    document.getElementById('cat-price-desc').value = priceDesc || '';
    document.getElementById('cat-order').value = order;
    document.getElementById('cat-active').checked = active;
    document.getElementById('active-group').style.display = 'flex';
    
    // Open modal after filling form
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
