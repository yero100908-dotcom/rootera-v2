@extends('layouts.admin')
@section('title', 'Kelola Teknologi & Peralatan')
@section('page-title', 'Armada Mesin & Teknologi Rootera')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Manajemen Armada Peralatan & Mesin</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-emerald-600 font-bold">{{ $technologies->count() }}</strong> alat / teknologi terdaftar di database.</p>
            </div>
        </div>

        <a href="{{ route('admin.technologies.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2 shrink-0">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Peralatan Baru</span>
        </a>
    </div>

    {{-- Alert Flash --}}
    @if(session('success'))
    <div class="m-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2">
        <span>✅</span> {{ session('success') }}
    </div>
    @endif

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Foto Alat</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama &amp; Brand</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Spesifikasi &amp; Peruntukan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Badge</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($technologies as $tech)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-16 h-14 bg-slate-900 rounded-2xl overflow-hidden border border-slate-200/80 shadow-xs relative">
                            <img src="{{ $tech->image_url }}" alt="{{ $tech->tool_name }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="px-6 py-4 max-w-xs">
                        <strong class="text-slate-900 text-sm font-extrabold block mb-0.5">{{ $tech->tool_name }}</strong>
                        <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100 inline-block font-mono">
                            {{ $tech->type_brand ?? 'Standard Unit' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 max-w-sm">
                        @if($tech->main_spec)
                        <div class="text-xs text-slate-800 font-semibold mb-1 line-clamp-1">⚙️ {{ $tech->main_spec }}</div>
                        @endif
                        @if($tech->pipe_target)
                        <div class="text-[11px] text-slate-500 line-clamp-1">🎯 Target: {{ $tech->pipe_target }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            {{ $tech->badge_text ?? 'ALAT RESMI' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button type="button" onclick="toggleTech({{ $tech->id }}, this)" data-active="{{ $tech->is_active ? '1' : '0' }}" class="focus:outline-none">
                            @if($tech->is_active)
                                <span class="bg-emerald-100 text-emerald-800 border border-emerald-200/80 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                            @else
                                <span class="bg-slate-100 text-slate-600 border border-slate-200/80 text-xs font-bold px-3 py-1 rounded-full">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('technologies.show', $tech->slug) }}" target="_blank" class="p-2 rounded-xl text-blue-600 hover:bg-blue-50 border border-slate-200/80 transition-all hover:scale-105" title="Lihat Halaman Publik (Preview)">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                            <a href="{{ route('admin.technologies.edit', $tech) }}" class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit Data &amp; Rich Content">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.technologies.destroy', $tech) }}" method="POST" onsubmit="return confirm('Hapus peralatan {{ $tech->tool_name }} secara permanen?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Alat">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada peralatan atau teknologi terdaftar. Klik "+ Tambah Peralatan Baru" di atas.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
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
        location.reload();
    });
}
</script>
@endpush
@endsection
