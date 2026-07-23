@extends('layouts.admin')
@section('title','Kelola Artikel')
@section('page-title','Artikel / Blog')

@section('admin-content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-4 sm:px-6 sm:py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-50 p-2 rounded-lg text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
            </div>
            <div>
                <h2 class="text-base font-semibold text-slate-900">Daftar Artikel</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong>{{ $articles->total() }}</strong> artikel diterbitkan</p>
            </div>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Artikel
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Judul Artikel</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-center">Status</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3">Tanggal</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-center">Views</th>
                    <th class="text-xs font-semibold text-slate-600 uppercase tracking-wider px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
            @forelse($articles as $article)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-3 max-w-sm">
                        <div class="flex items-center gap-4">
                            @if($article->thumbnail)
                                <div class="w-16 h-12 flex-shrink-0 rounded bg-slate-100 overflow-hidden border border-slate-200">
                                    <img src="{{ Storage::url($article->thumbnail) }}" alt="" class="w-full h-full object-cover" style="max-width: 64px; max-height: 48px;">
                                </div>
                            @else
                                <div class="w-16 h-12 flex-shrink-0 rounded bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('blog.show', $article->slug) }}" target="_blank" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 truncate block transition-colors" title="{{ $article->title }}">
                                    {{ Str::limit($article->title, 55) }}
                                </a>
                                <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $article->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-center">
                        <form action="{{ route('admin.articles.toggle', $article) }}" method="POST" class="inline-block">
                            @csrf @method('PATCH')
                            <button type="submit" class="focus:outline-none transition-transform active:scale-95">
                                @if($article->is_published)
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Diterbitkan</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">Draft</span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-3">
                        <div class="text-sm text-slate-900">{{ $article->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-slate-500">{{ $article->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td class="px-6 py-3 text-center text-sm text-slate-600 font-medium">
                        {{ number_format($article->views_count ?? 0) }}
                    </td>
                    <td class="px-6 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini secara permanen?')">
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
                        <p class="text-sm font-medium">Belum ada artikel yang diterbitkan.</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
