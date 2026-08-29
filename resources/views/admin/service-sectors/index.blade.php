@extends('layouts.admin')
@section('title', 'Kelola Sektor Layanan')
@section('page-title', 'Sektor Layanan Komersial &amp; B2B')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Sektor Layanan Komersial</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-amber-600 font-bold">{{ $sectors->count() ?? 0 }}</strong> sektor target terdaftar.</p>
            </div>
        </div>

        <button onclick="document.getElementById('modal-add-sector').classList.remove('hidden'); document.getElementById('modal-add-sector').classList.add('flex');" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Sektor Baru</span>
        </button>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Ikon Sektor</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama &amp; Deskripsi Sektor</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Urutan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($sectors as $sector)
                <tr class="hover:bg-slate-50/80 transition-colors">
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
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 border border-amber-100 shadow-xs">
                            {!! $icons[$sector->icon] ?? $icons['home'] !!}
                        </div>
                    </td>
                    <td class="px-6 py-4 max-w-sm">
                        <strong class="text-slate-900 text-sm font-extrabold block mb-0.5">{{ $sector->sector_name }}</strong>
                        <p class="text-xs text-slate-500 line-clamp-1 leading-relaxed">{{ $sector->description }}</p>
                    </td>
                    <td class="px-6 py-4 text-xs font-extrabold text-slate-800">{{ $sector->sort_order }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($sector->is_active)
                            <span class="bg-emerald-100 text-emerald-800 border border-emerald-200/80 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                        @else
                            <span class="bg-slate-100 text-slate-600 border border-slate-200/80 text-xs font-bold px-3 py-1 rounded-full">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick='openEditSector(@json($sector))' class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit Sektor">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.service-sectors.destroy', $sector) }}" method="POST" onsubmit="return confirm('Hapus sektor ini secara permanen?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Sektor">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada sektor layanan terdaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Sector --}}
<div id="modal-add-sector" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 class="text-base font-extrabold text-slate-900">Tambah Sektor Layanan Baru</h3>
            <button onclick="document.getElementById('modal-add-sector').classList.add('hidden'); document.getElementById('modal-add-sector').classList.remove('flex');" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.service-sectors.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Nama Sektor *</label>
                <input type="text" name="sector_name" required placeholder="Contoh: Hunian &amp; Rumah Tinggal" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Deskripsi Sektor</label>
                <textarea name="description" rows="3" placeholder="Penanganan cepat dan efisien..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Ikon Sektor *</label>
                <select name="icon" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                    <option value="home">Hunian Rumah (Home)</option>
                    <option value="building">Apartemen (Building)</option>
                    <option value="store">Ruko Bisnis (Store)</option>
                    <option value="office">Gedung Kantor (Office)</option>
                    <option value="factory">Area Industri (Factory)</option>
                    <option value="cafe">Resto &amp; Cafe (Cafe)</option>
                </select>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Urutan Tampil</label>
                <input type="number" name="sort_order" value="0" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-900">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-sector').classList.add('hidden'); document.getElementById('modal-add-sector').classList.remove('flex');" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Simpan Sektor</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Sector --}}
<div id="modal-edit-sector" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 class="text-base font-extrabold text-slate-900">Edit Sektor Layanan</h3>
            <button onclick="document.getElementById('modal-edit-sector').classList.add('hidden'); document.getElementById('modal-edit-sector').classList.remove('flex');" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form id="edit-sector-form" method="POST" class="space-y-4">
            @csrf @method('PUT')
            
            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Nama Sektor *</label>
                <input type="text" name="sector_name" id="edit-sector-name" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Deskripsi Sektor</label>
                <textarea name="description" id="edit-sector-description" rows="3" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Ikon Sektor *</label>
                <select name="icon" id="edit-sector-icon" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                    <option value="home">Hunian Rumah (Home)</option>
                    <option value="building">Apartemen (Building)</option>
                    <option value="store">Ruko Bisnis (Store)</option>
                    <option value="office">Gedung Kantor (Office)</option>
                    <option value="factory">Area Industri (Factory)</option>
                    <option value="cafe">Resto &amp; Cafe (Cafe)</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="edit-sort-order" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-900">
                </div>

                <div class="pt-4">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                        <input type="checkbox" name="is_active" id="edit-is-active" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500">
                        <span>Status Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-edit-sector').classList.add('hidden'); document.getElementById('modal-edit-sector').classList.remove('flex');" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Perbarui Sektor</button>
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
    
    const modal = document.getElementById('modal-edit-sector');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
</script>
@endpush
@endsection
