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
                        @php
                        $icons = [
                            'home' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
                            'building' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>',
                            'store' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><line x1="9" y1="22" x2="9" y2="12"/><line x1="15" y1="22" x2="15" y2="12"/><line x1="9" y1="12" x2="15" y2="12"/></svg>',
                            'office' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
                            'factory' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                            'cafe' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>',
                        ];
                        @endphp
                        <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600 border border-emerald-100">
                            {!! $icons[$sector->icon] ?? $icons['home'] !!}
                        </div>
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
                            <button type="button" onclick='openEditSector(@json($sector))' class="text-slate-600 bg-slate-100 hover:bg-emerald-100 hover:text-emerald-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg">Edit</button>
                            <form action="{{ route('admin.service-sectors.destroy', $sector) }}" method="POST" onsubmit="return confirm('Hapus sektor ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-600 bg-slate-100 hover:bg-rose-100 hover:text-rose-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg">Hapus</button>
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
<div id="modal-add-sector" class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
        <div class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Tambah Sektor Layanan</h2>
            <button type="button" onclick="document.getElementById('modal-add-sector').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.service-sectors.store') }}" enctype="multipart/form-data" class="p-4 sm:p-6">
            @csrf
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Sektor <span style="color:#ef4444">*</span></label>
                <input type="text" name="sector_name" required placeholder="Contoh: Hunian & Rumah Tinggal" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Deskripsi Sektor</label>
                <textarea name="description" rows="3" placeholder="Contoh: Penanganan cepat dan efisien untuk unit apartemen..." style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Pilih Ikon Sektor</label>
                <select name="icon" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
                    <option value="home">Hunian Rumah (Home)</option>
                    <option value="building">Apartemen (Building)</option>
                    <option value="store">Ruko Bisnis (Store)</option>
                    <option value="office">Gedung Kantor (Office)</option>
                    <option value="factory">Area Industri (Factory)</option>
                    <option value="cafe">Resto & Cafe (Cafe)</option>
                </select>
            </div>
            <div style="margin-bottom:1.5rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Urutan Tampil</label>
                <input type="number" name="sort_order" value="0" style="width:100px;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-add-sector').style.display='none'" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Sector --}}
<div id="modal-edit-sector" class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
        <div class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Edit Sektor Layanan</h2>
            <button type="button" onclick="document.getElementById('modal-edit-sector').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="edit-sector-form" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Sektor <span style="color:#ef4444">*</span></label>
                <input type="text" name="sector_name" id="edit-sector-name" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Deskripsi Sektor</label>
                <textarea name="description" id="edit-sector-description" rows="3" placeholder="Contoh: Penanganan cepat dan efisien untuk unit apartemen..." style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Pilih Ikon Sektor</label>
                <select name="icon" id="edit-sector-icon" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
                    <option value="home">Hunian Rumah (Home)</option>
                    <option value="building">Apartemen (Building)</option>
                    <option value="store">Ruko Bisnis (Store)</option>
                    <option value="office">Gedung Kantor (Office)</option>
                    <option value="factory">Area Industri (Factory)</option>
                    <option value="cafe">Resto & Cafe (Cafe)</option>
                </select>
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
                <button type="button" onclick="document.getElementById('modal-edit-sector').style.display='none'" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditSector(sector) {
    document.getElementById('edit-sector-form').action = `/admin/service-sectors/${sector.id}`;
    document.getElementById('edit-sector-name').value = sector.sector_name;
    document.getElementById('edit-sector-description').value = sector.description || '';
    document.getElementById('edit-sector-icon').value = sector.icon || 'home';
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
