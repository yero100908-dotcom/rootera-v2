@extends('layouts.admin')
@section('title','Kelola Area Layanan')
@section('page-title','Area Layanan')

@section('admin-content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-4 sm:px-6 sm:py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-slate-900">Daftar Area Layanan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong>{{ $areas->total() }}</strong> area terdaftar</p>
            </div>
        </div>
        <a href="{{ route('admin.service-areas.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Area
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Nama Area</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Provinsi</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Slug</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-center">Status</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
            @forelse($areas as $area)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-3 text-sm font-medium text-slate-900">{{ $area->name }}</td>
                    <td class="px-6 py-3 text-sm text-slate-600">{{ $area->province ?? '-' }}</td>
                    <td class="px-6 py-3">
                        <span class="text-xs text-slate-500 font-mono bg-slate-100 px-2 py-1 rounded">{{ $area->slug }}</span>
                    </td>
                    <td class="px-6 py-3 text-center">
                        @if($area->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-50 text-slate-700 ring-1 ring-inset ring-slate-600/20">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.service-areas.edit', $area) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.service-areas.destroy', $area) }}" method="POST" onsubmit="return confirm('Hapus area ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 p-1.5 rounded transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <p class="text-sm font-medium">Belum ada area layanan terdaftar.</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($areas->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 bg-white">
        {{ $areas->links() }}
    </div>
    @endif
</div>
@endsection
