@extends('layouts.admin')
@section('title','Kelola Kategori Layanan')
@section('page-title','Kategori Layanan')

@section('admin-content')
<div style="display:grid;grid-template-columns:1fr 360px;gap:1.5rem;align-items:start">
    {{-- List --}}
    <div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden">
        <table class="admin-table">
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
                        <button onclick="fillForm({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ addslashes($cat->description) }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 1 : 0 }})" class="btn-sm btn-edit">Edit</button>
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

    {{-- Form --}}
    <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb;position:sticky;top:5rem">
        <h3 id="form-title" style="font-family:'Plus Jakarta Sans',sans-serif;color:#0A2E78;margin-bottom:1.25rem;font-size:.95rem">Tambah Kategori Baru</h3>
        <form id="cat-form" action="{{ route('admin.service-categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="">
            <div class="form-group">
                <label for="cat-name">Nama Kategori *</label>
                <input type="text" id="cat-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="cat-slug">Slug</label>
                <input type="text" id="cat-slug" name="slug" placeholder="otomatis dari nama">
            </div>
            <div class="form-group">
                <label for="cat-desc">Deskripsi</label>
                <textarea id="cat-desc" name="description" style="min-height:80px"></textarea>
            </div>
            <div class="form-group">
                <label for="cat-order">Urutan</label>
                <input type="number" id="cat-order" name="sort_order" value="0" min="0">
            </div>
            <div class="form-group" id="active-group" style="display:none">
                <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer">
                    <input type="checkbox" id="cat-active" name="is_active" value="1" style="accent-color:#169F81">
                    Aktif
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Simpan</button>
            <button type="button" onclick="resetForm()" style="width:100%;margin-top:.5rem;padding:.6rem;border-radius:8px;border:1px solid #e5e7eb;font-weight:500;font-size:.9rem;color:#6b7280;cursor:pointer">Reset</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function fillForm(id, name, slug, desc, order, active) {
    document.getElementById('form-title').textContent = 'Edit Kategori';
    document.getElementById('cat-form').action = '/admin/service-categories/' + id;
    document.getElementById('form-method').value = 'PUT';
    document.getElementById('cat-name').value = name;
    document.getElementById('cat-slug').value = slug;
    document.getElementById('cat-desc').value = desc;
    document.getElementById('cat-order').value = order;
    document.getElementById('cat-active').checked = active;
    document.getElementById('active-group').style.display = 'block';
    document.getElementById('cat-form').scrollIntoView({behavior:'smooth'});
}
function resetForm() {
    document.getElementById('form-title').textContent = 'Tambah Kategori Baru';
    document.getElementById('cat-form').action = '{{ route("admin.service-categories.store") }}';
    document.getElementById('form-method').value = '';
    document.getElementById('cat-form').reset();
    document.getElementById('active-group').style.display = 'none';
}
</script>
@endpush
