@extends('layouts.admin')
@section('title', 'Kelola Sektor Layanan')
@section('page-title', 'Kelola Sektor Layanan')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Sektor Layanan</h2>
            <p class="text-sm text-slate-500 mt-1">Total: <strong>{{ $sectors->count() ?? 0 }}</strong> sektor layanan</p>
        </div>
        <button onclick="document.getElementById('modal-add-sector').style.display='flex'" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Sektor
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/60">
                <tr>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Foto</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama Sektor</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Urutan</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Status</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($sectors as $sector)
                <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="px-6 py-4">
                        @if($sector->image_url)
                            <img src="{{ $sector->image_url }}" alt="{{ $sector->sector_name }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200/80">
                        @else
                            <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 border border-slate-200/80">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <strong class="text-slate-900 text-sm font-medium">{{ $sector->sector_name }}</strong>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $sector->sort_order }}</td>
                    <td class="px-6 py-4">
                        <button onclick="toggleSector({{ $sector->id }}, this)" data-active="{{ $sector->is_active ? '1' : '0' }}" class="focus:outline-none transition-transform active:scale-95">
                            @if($sector->is_active)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Aktif</span>
                            @else
                                <span class="bg-slate-50 text-slate-600 border border-slate-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <button type="button" onclick='openEditSector(@json($sector))' class="text-slate-500 hover:text-emerald-600 font-medium text-sm transition-colors">Edit</button>
                            <form action="{{ route('admin.service-sectors.destroy', $sector) }}" method="POST" onsubmit="return confirm('Hapus sektor ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-rose-600 font-medium text-sm transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada sektor layanan.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
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
