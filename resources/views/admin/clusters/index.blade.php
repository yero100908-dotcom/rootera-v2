@extends('layouts.admin')
@section('title','Cluster Perumahan')
@section('page-title','Cluster Perumahan (Hyper-Local pSEO)')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Daftar Cluster Perumahan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-emerald-600">{{ $clusters->total() }}</strong> cluster · Ambang index: skor ≥ <strong>{{ $threshold }}</strong></p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <form method="GET" class="flex flex-wrap items-center gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari cluster…" class="text-sm rounded-xl border border-slate-200 px-3 py-2 w-44">
                <select name="city_id" class="text-sm rounded-xl border border-slate-200 px-3 py-2">
                    <option value="">Semua Kota</option>
                    @foreach($cities as $c)
                        <option value="{{ $c->id }}" @selected(request('city_id') == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                <button class="text-sm font-bold px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50">Filter</button>
            </form>
            <a href="{{ route('admin.clusters.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl shadow-md flex items-center gap-2">+ Tambah Cluster</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Cluster</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kota / Kecamatan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Tier</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Bukti</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Skor</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Indexing</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($clusters as $cluster)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-extrabold text-slate-900 text-sm">{{ $cluster->name }}</div>
                        <span class="text-[11px] font-mono text-slate-500">/area-perumahan/{{ $cluster->slug }}</span>
                        @unless($cluster->is_active)<span class="ml-1 text-[10px] font-bold text-slate-500 bg-slate-100 px-1.5 rounded">nonaktif</span>@endunless
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-600">
                        <div class="font-semibold">{{ $cluster->city?->name ?? '—' }}</div>
                        <div>{{ $cluster->district?->name ?? '—' }} @if($cluster->districts_count > 1)<span class="text-slate-400">(+{{ $cluster->districts_count - 1 }})</span>@endif</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-[11px] font-bold uppercase px-2 py-0.5 rounded-full {{ $cluster->tier === 'elite' ? 'bg-violet-100 text-violet-700' : ($cluster->tier === 'premium' ? 'bg-sky-100 text-sky-700' : 'bg-slate-100 text-slate-600') }}">{{ $cluster->tier }}</span>
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-bold text-slate-700">{{ $cluster->project_galleries_count }} proyek</td>
                    <td class="px-6 py-4 text-center">@include('admin.partials.score-badge', ['score' => $cluster->content_score, 'threshold' => $threshold])</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.clusters.indexable', $cluster) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" title="Toggle index"
                                class="text-xs font-bold px-3 py-1 rounded-full border transition {{ $cluster->is_indexable ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200' }}">
                                {{ $cluster->is_indexable ? 'INDEX' : 'NOINDEX' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.clusters.preview', $cluster) }}" target="_blank" class="p-2 rounded-xl text-sky-600 hover:bg-sky-50 border border-slate-200/80" title="Preview">👁</a>
                            <a href="{{ route('admin.clusters.edit', $cluster) }}" class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80" title="Edit">✎</a>
                            <form action="{{ route('admin.clusters.destroy', $cluster) }}" method="POST" onsubmit="return confirm('Hapus cluster ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80" title="Hapus">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-6 py-12 text-center text-slate-400 font-medium">Belum ada cluster perumahan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($clusters->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">{{ $clusters->links() }}</div>
    @endif
</div>
@endsection
