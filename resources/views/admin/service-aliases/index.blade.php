@extends('layouts.admin')
@section('title','Service Aliases')
@section('page-title','Manajemen Service Aliases (Kata Kunci Sinonim)')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-600 border border-violet-100 flex items-center justify-center shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Daftar Service Aliases</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-violet-600">{{ $aliases->total() }}</strong> alias kata kunci terdaftar</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <form method="GET" class="flex flex-wrap items-center gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari keyword…" class="text-sm rounded-xl border border-slate-200 px-3 py-2 w-44">
                <select name="service_category_id" class="text-sm rounded-xl border border-slate-200 px-3 py-2">
                    <option value="">Semua Layanan</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('service_category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="usage" class="text-sm rounded-xl border border-slate-200 px-3 py-2">
                    <option value="">Semua Usage</option>
                    <option value="copy_only" @selected(request('usage') === 'copy_only')>Copy Only</option>
                    <option value="landing_page" @selected(request('usage') === 'landing_page')>Landing Page</option>
                </select>
                <button class="text-sm font-bold px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50">Filter</button>
            </form>
            <a href="{{ route('admin.service-aliases.create') }}" class="bg-violet-600 hover:bg-violet-700 text-white text-sm font-bold px-4 py-2.5 rounded-xl shadow-md flex items-center gap-2">+ Tambah Alias</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Keyword / Slug</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kategori Layanan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Usage</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Intent</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Search Vol.</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($aliases as $alias)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-extrabold text-slate-900 text-sm">{{ $alias->keyword }}</div>
                        <span class="text-[11px] font-mono text-slate-500">/{{ $alias->slug }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">
                        <div class="font-semibold">{{ $alias->serviceCategory?->name ?? '—' }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($alias->usage === 'landing_page')
                            <span class="text-[11px] font-bold uppercase px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">Landing Page</span>
                        @else
                            <span class="text-[11px] font-bold uppercase px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200">Copy Only</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $intentColors = [
                                'transactional' => 'bg-rose-100 text-rose-700 border-rose-200',
                                'problem'       => 'bg-amber-100 text-amber-700 border-amber-200',
                                'informational' => 'bg-sky-100 text-sky-700 border-sky-200',
                            ];
                        @endphp
                        <span class="text-[11px] font-bold uppercase px-2.5 py-1 rounded-full border {{ $intentColors[$alias->intent] ?? 'bg-slate-100 text-slate-600 border-slate-200' }}">
                            {{ $alias->intent }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-bold text-slate-700">
                        {{ $alias->search_volume ? number_format($alias->search_volume) : '—' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($alias->is_active)
                            <span class="text-[11px] font-bold uppercase px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">Aktif</span>
                        @else
                            <span class="text-[11px] font-bold uppercase px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 border border-slate-200">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.service-aliases.edit', $alias) }}" class="p-2 rounded-xl text-violet-600 hover:bg-violet-50 border border-slate-200/80" title="Edit">✎</a>
                            <form action="{{ route('admin.service-aliases.destroy', $alias) }}" method="POST" onsubmit="return confirm('Hapus alias &quot;{{ addslashes($alias->keyword) }}&quot;?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80" title="Hapus">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-6 py-12 text-center text-slate-400 font-medium">Belum ada alias. <a href="{{ route('admin.service-aliases.create') }}" class="text-violet-600 font-bold hover:underline">Tambah sekarang →</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($aliases->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">{{ $aliases->links() }}</div>
    @endif
</div>
@endsection
