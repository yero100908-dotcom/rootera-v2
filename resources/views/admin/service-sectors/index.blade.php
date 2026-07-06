@extends('layouts.admin')
@section('title', 'Kelola Sektor Layanan')
@section('page-title', 'Kelola Sektor Layanan')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <p style="color:#6b7280;font-size:.9rem">Total: <strong>{{ $sectors->count() ?? 0 }}</strong> sektor layanan</p>
    <button onclick="document.getElementById('modal-add-sector').style.display='flex'" class="btn btn-primary" style="border-radius:10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Sektor
    </button>
</div>

@if(session('success'))
<div style="background:rgba(22,159,129,.08);border:1px solid rgba(22,159,129,.2);color:#169F81;padding:1rem;border-radius:10px;margin-bottom:1.5rem;font-size:.9rem;font-weight:600">
    {{ session('success') }}
</div>
@endif

<div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Sektor</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($sectors as $sector)
        <tr>
            <td>
                @if($sector->image_url)
                <img src="{{ $sector->image_url }}" alt="{{ $sector->sector_name }}" style="width:60px;height:40px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb">
                @else
                <div style="width:60px;height:40px;background:#f3f4f6;border-radius:6px;border:1px solid #e5e7eb"></div>
                @endif
            </td>
            <td>
                <strong>{{ $sector->sector_name }}</strong>
            </td>
            <td>{{ $sector->sort_order }}</td>
            <td>
                <button onclick="toggleSector({{ $sector->id }}, this)" data-active="{{ $sector->is_active ? '1' : '0' }}" style="border:none;background:none;cursor:pointer;padding:0">
                    <span class="{{ $sector->is_active ? 'status-completed' : 'status-cancelled' }}">
                        {{ $sector->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </button>
            </td>
            <td>
                <div style="display:flex;gap:.4rem">
                    <button type="button" onclick='openEditSector(@json($sector))' class="btn-sm btn-edit">Edit</button>
                    <form action="{{ route('admin.service-sectors.destroy', $sector) }}" method="POST" onsubmit="return confirm('Hapus sektor ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:2rem;color:#9ca3af">Belum ada sektor layanan.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Modal Tambah Sector --}}
<div id="modal-add-sector" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem">
    <div style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Tambah Sektor Layanan</h2>
            <button type="button" onclick="document.getElementById('modal-add-sector').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.service-sectors.store') }}" enctype="multipart/form-data" style="padding:1.5rem">
            @csrf
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Sektor <span style="color:#ef4444">*</span></label>
                <input type="text" name="sector_name" required placeholder="Contoh: Hunian & Rumah Tinggal" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Foto Sektor</label>
                <input type="file" name="image_path" accept="image/*" style="width:100%;font-size:.9rem;color:#6b7280">
            </div>
            <div style="margin-bottom:1.5rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Urutan Tampil</label>
                <input type="number" name="sort_order" value="0" style="width:100px;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-add-sector').style.display='none'" style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer">Batal</button>
                <button type="submit" style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Sector --}}
<div id="modal-edit-sector" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem">
    <div style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Edit Sektor Layanan</h2>
            <button type="button" onclick="document.getElementById('modal-edit-sector').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="edit-sector-form" method="POST" enctype="multipart/form-data" style="padding:1.5rem">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Sektor <span style="color:#ef4444">*</span></label>
                <input type="text" name="sector_name" id="edit-sector-name" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Foto Sektor (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="image_path" accept="image/*" style="width:100%;font-size:.9rem;color:#6b7280">
            </div>
            <div style="display:flex;gap:1.5rem;margin-bottom:1.5rem">
                <div>
                    <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Urutan</label>
                    <input type="number" name="sort_order" id="edit-sort-order" style="width:100px;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
                </div>
                <div>
                    <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Status Aktif</label>
                    <input type="checkbox" name="is_active" id="edit-is-active" value="1" style="width:18px;height:18px;cursor:pointer">
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-edit-sector').style.display='none'" style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer">Batal</button>
                <button type="submit" style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditSector(sector) {
    document.getElementById('edit-sector-form').action = `/admin/service-sectors/${sector.id}`;
    document.getElementById('edit-sector-name').value = sector.sector_name;
    document.getElementById('edit-sort-order').value = sector.sort_order;
    document.getElementById('edit-is-active').checked = sector.is_active == 1;
    document.getElementById('modal-edit-sector').style.display='flex';
}

function toggleSector(id, btn) {
    fetch(`/admin/service-sectors/${id}/toggle`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        const isActive = data.is_active;
        btn.dataset.active = isActive ? '1' : '0';
        btn.className = btn.className.replace(isActive ? 'bg-gray-300' : 'bg-green-500', isActive ? 'bg-green-500' : 'bg-gray-300');
        btn.querySelector('span').className = btn.querySelector('span').className.replace(
            isActive ? 'translate-x-1' : 'translate-x-6',
            isActive ? 'translate-x-6' : 'translate-x-1'
        );
    });
}
</script>
@endpush
@endsection
