@extends('layouts.admin')
@section('title','Kecamatan')
@section('page-title','Manajemen Kecamatan (Districts)')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 border border-sky-100 flex items-center justify-center shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Daftar Kecamatan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-sky-600">{{ $districts->total() }}</strong> kecamatan · Ambang index: skor ≥ <strong>{{ $threshold }}</strong></p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <form method="GET" class="flex flex-wrap items-center gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kecamatan…" class="text-sm rounded-xl border border-slate-200 px-3 py-2 w-44">
                <select name="city_id" class="text-sm rounded-xl border border-slate-200 px-3 py-2">
                    <option value="">Semua Kota</option>
                    @foreach($cities as $c)
                        <option value="{{ $c->id }}" @selected(request('city_id') == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                <select name="indexable" class="text-sm rounded-xl border border-slate-200 px-3 py-2">
                    <option value="">Semua Status</option>
                    <option value="1" @selected(request('indexable') === '1')>INDEX saja</option>
                </select>
                <button class="text-sm font-bold px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50">Filter</button>
            </form>
            <a href="{{ route('admin.districts.create') }}" class="bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl shadow-md flex items-center gap-2">+ Tambah Kecamatan</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kecamatan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kota</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Cluster</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Proyek</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Skor</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Indexing</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($districts as $district)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-extrabold text-slate-900 text-sm">{{ $district->name }}</div>
                        <span class="text-[11px] font-mono text-slate-500">{{ $district->slug }}</span>
                        @if($district->postal_code)
                            <span class="ml-1 text-[10px] font-semibold text-slate-400 bg-slate-100 px-1.5 rounded">{{ $district->postal_code }}</span>
                        @endif
                        @unless($district->is_active)<span class="ml-1 text-[10px] font-bold text-slate-500 bg-slate-100 px-1.5 rounded">nonaktif</span>@endunless
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-600">
                        <div class="font-semibold">{{ $district->city?->name ?? '—' }}</div>
                        @if($district->estimated_arrival)
                            <div class="text-slate-400">🚗 {{ $district->estimated_arrival }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-bold text-slate-700">{{ $district->residential_clusters_count }}</td>
                    <td class="px-6 py-4 text-center text-xs font-bold text-slate-700">{{ $district->project_galleries_count }}</td>
                    <td class="px-6 py-4 text-center">@include('admin.partials.score-badge', ['score' => $district->content_score, 'threshold' => $threshold])</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.districts.indexable', $district) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" title="Toggle index"
                                class="text-xs font-bold px-3 py-1 rounded-full border transition {{ $district->is_indexable ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200' }}">
                                {{ $district->is_indexable ? 'INDEX' : 'NOINDEX' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.districts.edit', $district) }}" class="p-2 rounded-xl text-sky-600 hover:bg-sky-50 border border-slate-200/80" title="Edit">✎</a>
                            <form action="{{ route('admin.districts.destroy', $district) }}" method="POST" onsubmit="return confirm('Hapus kecamatan {{ addslashes($district->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80" title="Hapus">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-6 py-12 text-center text-slate-400 font-medium">Belum ada kecamatan. <a href="{{ route('admin.districts.create') }}" class="text-sky-600 font-bold hover:underline">Tambah sekarang →</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($districts->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">{{ $districts->links() }}</div>
    @endif
</div>
@endsection
