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
<div class="btn-header-container">
    <button onclick="openModal()" style="background:#2563eb; color:#fff; border:none; padding:0.75rem 1.5rem; border-radius:8px; font-weight:600; cursor:pointer; box-shadow:0 4px 10px rgba(37,99,235,0.2); display:flex; align-items:center; gap:0.5rem;">
        <svg style="width:1.2rem;height:1.2rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Kategori Baru
    </button>
</div>

<div class="admin-table-wrapper">
    <table class="admin-table" style="width: 100%; min-width: 600px;">
        <thead><tr><th>Nama Kategori</th><th>Slug</th><th>Layanan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($categories as $cat)
        <tr>
            <td><strong>{{ $cat->name }}</strong><div style="font-size:.78rem;color:#9ca3af">{{ Str::limit($cat->description,50) }}</div></td>
            <td style="font-size:.82rem;color:#6b7280">{{ $cat->slug }}</td>
            <td>{{ $cat->services_count }}</td>
            <td><span class="{{ $cat->is_active ? 'status-completed' : 'status-cancelled' }}">{{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div style="display:flex;gap:.4rem">
                    <button onclick="fillForm({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ addslashes($cat->description) }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 1 : 0 }}, '{{ addslashes($cat->price_home) }}', '{{ addslashes($cat->price_corporate) }}', '{{ addslashes($cat->price_description) }}')" class="btn-sm btn-edit">Edit</button>
                    <form action="{{ route('admin.service-categories.destroy',$cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:2rem;color:#9ca3af">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </table>
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
