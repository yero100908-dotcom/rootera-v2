@extends('layouts.admin')
@section('title', 'Kelola Teknologi & Alat')
@section('page-title', 'Kelola Teknologi & Alat')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Teknologi & Alat</h2>
            <p class="text-sm text-slate-500 mt-1">Total: <strong>{{ $technologies->count() ?? 0 }}</strong> alat/teknologi</p>
        </div>
        <button onclick="document.getElementById('modal-add-tech').style.display='flex'" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Alat
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/60">
                <tr>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Foto</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama Alat</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Urutan</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Status</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($technologies as $tech)
                <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="px-6 py-4">
                        @if($tech->image_url)
                            <img src="{{ $tech->image_url }}" alt="{{ $tech->tool_name }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200/80">
                        @else
                            <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 border border-slate-200/80">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <strong class="text-slate-900 text-sm font-medium block mb-0.5">{{ $tech->tool_name }}</strong>
                        <div class="text-xs text-slate-500">{{ Str::limit($tech->description, 40) }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $tech->sort_order }}</td>
                    <td class="px-6 py-4">
                        <button onclick="toggleTech({{ $tech->id }}, this)" data-active="{{ $tech->is_active ? '1' : '0' }}" class="focus:outline-none transition-transform active:scale-95">
                            @if($tech->is_active)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Aktif</span>
                            @else
                                <span class="bg-slate-50 text-slate-600 border border-slate-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <button type="button" onclick='openEditTech(@json($tech))' class="text-slate-600 bg-slate-100 hover:bg-emerald-100 hover:text-emerald-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg">Edit</button>
                            <form action="{{ route('admin.technologies.destroy', $tech) }}" method="POST" onsubmit="return confirm('Hapus alat ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-600 bg-slate-100 hover:bg-rose-100 hover:text-rose-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada alat/teknologi.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Tech --}}
<div id="modal-add-tech" class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
        <div class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Tambah Alat/Teknologi</h2>
            <button type="button" onclick="document.getElementById('modal-add-tech').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.technologies.store') }}" enctype="multipart/form-data" class="p-4 sm:p-6">
            @csrf
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Alat <span style="color:#ef4444">*</span></label>
                <input type="text" name="tool_name" required placeholder="Contoh: Rigid Sectional Machine" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Deskripsi Alat</label>
                <textarea name="description" rows="3" placeholder="Tulis deskripsi fungsi alat..." style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Foto Alat</label>
                <input type="file" name="image_path" accept="image/*" style="width:100%;font-size:.9rem;color:#6b7280">
            </div>
            <div style="margin-bottom:1.5rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Urutan Tampil</label>
                <input type="number" name="sort_order" value="0" style="width:100px;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-add-tech').style.display='none'" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Tech --}}
<div id="modal-edit-tech" class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
        <div class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Edit Alat/Teknologi</h2>
            <button type="button" onclick="document.getElementById('modal-edit-tech').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="edit-tech-form" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Alat <span style="color:#ef4444">*</span></label>
                <input type="text" name="tool_name" id="edit-tool-name" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Deskripsi Alat</label>
                <textarea name="description" id="edit-description" rows="3" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Foto Alat (Biarkan kosong jika tidak diganti)</label>
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
                <button type="button" onclick="document.getElementById('modal-edit-tech').style.display='none'" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditTech(tech) {
    document.getElementById('edit-tech-form').action = `/admin/technologies/${tech.id}`;
    document.getElementById('edit-tool-name').value = tech.tool_name;
    document.getElementById('edit-description').value = tech.description ?? '';
    document.getElementById('edit-sort-order').value = tech.sort_order;
    document.getElementById('edit-is-active').checked = tech.is_active == 1;
    document.getElementById('modal-edit-tech').style.display='flex';
}

function toggleTech(id, btn) {
    fetch(`/admin/technologies/${id}/toggle`, {
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
