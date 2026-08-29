@extends('layouts.admin')
@section('title', 'Kelola Mitra Kami')
@section('page-title', 'Mitra &amp; Klien Komersial')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Logo Mitra &amp; Brand Kepercayaan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-emerald-600 font-bold">{{ $partners->count() ?? 0 }}</strong> logo mitra terdaftar.</p>
            </div>
        </div>

        <button onclick="document.getElementById('modal-add-partner').classList.remove('hidden'); document.getElementById('modal-add-partner').classList.add('flex');" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Mitra Baru</span>
        </button>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Logo Brand</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama Perusahaan / Mitra</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($partners as $partner)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        @if($partner->logo_url)
                            <div class="bg-slate-50 border border-slate-200/80 p-2.5 rounded-2xl w-32 h-16 flex items-center justify-center">
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->nama_mitra }}" class="max-h-full max-w-full object-contain">
                            </div>
                        @else
                            <div class="w-32 h-16 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-400 border border-slate-200/80 text-xs font-bold">
                                🖼️ No Logo
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <strong class="text-slate-900 text-sm font-extrabold block">{{ $partner->nama_mitra }}</strong>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick='openEditPartner(@json($partner))' class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit Mitra">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Hapus mitra ini secara permanen?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Mitra">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada mitra terdaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Partner --}}
<div id="modal-add-partner" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 class="text-base font-extrabold text-slate-900">Tambah Mitra Baru</h3>
            <button onclick="document.getElementById('modal-add-partner').classList.add('hidden'); document.getElementById('modal-add-partner').classList.remove('flex');" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Nama Perusahaan / Mitra *</label>
                <input type="text" name="nama_mitra" required placeholder="Contoh: PT Bangun Persada" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">File Logo Mitra *</label>
                <input type="file" name="logo" required accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-partner').classList.add('hidden'); document.getElementById('modal-add-partner').classList.remove('flex');" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Simpan Mitra</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Partner --}}
<div id="modal-edit-partner" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 class="text-base font-extrabold text-slate-900">Edit Data Mitra</h3>
            <button onclick="document.getElementById('modal-edit-partner').classList.add('hidden'); document.getElementById('modal-edit-partner').classList.remove('flex');" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form id="edit-partner-form" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            
            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Nama Perusahaan / Mitra *</label>
                <input type="text" name="nama_mitra" id="edit-nama-mitra" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">File Logo (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="logo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-edit-partner').classList.add('hidden'); document.getElementById('modal-edit-partner').classList.remove('flex');" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Perbarui Mitra</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditPartner(partner) {
    document.getElementById('edit-partner-form').action = `/admin/partners/${partner.id}`;
    document.getElementById('edit-nama-mitra').value = partner.nama_mitra;
    
    const modal = document.getElementById('modal-edit-partner');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
</script>
@endpush
@endsection
