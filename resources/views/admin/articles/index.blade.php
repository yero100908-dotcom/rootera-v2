@extends('layouts.admin')
@section('title','Kelola Artikel & Content Hub')
@section('page-title','Portal Konten & Artikel Management')

@section('admin-content')
<div class="space-y-6">

    {{-- Top Action & Metrics Bar --}}
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#070F1E] to-[#0B2545] text-white flex items-center justify-center shadow-lg shadow-slate-900/10 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
            </div>
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight">Portal Konten (Content Hub)</h2>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-black bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>CMS Active</span>
                    </span>
                </div>
                <p class="text-xs text-slate-500 mt-1">
                    Kelola dan pantau seluruh publikasi teknis, penawaran promo, studi kasus B2B, dan siaran pers Rootera Plumbing.
                </p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.articles.create') }}" 
               class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-xs sm:text-sm font-black px-5 py-3.5 rounded-2xl transition-all shadow-xl shadow-emerald-500/20 hover:shadow-emerald-500/35 hover:-translate-y-0.5 text-decoration-none">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>Tambah Konten Baru</span>
            </a>
        </div>
    </div>

    {{-- 1. Floating Segmented Control Filter Tabs --}}
    <div class="bg-white rounded-3xl p-3 sm:p-4 border border-slate-100/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        <div class="bg-slate-100/80 p-1.5 rounded-2xl overflow-x-auto no-scrollbar flex items-center gap-1.5">
            @php
                $activeTab = $currentType ?? request('type', 'all');
                $tabs = [
                    'all'           => ['label' => 'Semua', 'icon' => '🌐'],
                    'article'       => ['label' => 'Edukasi Teknis', 'icon' => '📄'],
                    'promo'         => ['label' => 'Promo Khusus', 'icon' => '🏷️'],
                    'news'          => ['label' => 'Kabar Perusahaan', 'icon' => '📰'],
                    'case_study'    => ['label' => 'Studi Kasus B2B', 'icon' => '💼'],
                    'press_release' => ['label' => 'Press Release', 'icon' => '📢'],
                    'video_guide'   => ['label' => 'Video Panduan', 'icon' => '🎥'],
                ];
            @endphp

            @foreach($tabs as $tabKey => $tab)
                @php
                    $isActive = $activeTab === $tabKey;
                    $tabUrl = $tabKey === 'all' ? route('admin.articles.index') : route('admin.articles.index', ['type' => $tabKey]);
                    $tabCount = $counts[$tabKey] ?? null;
                @endphp
                <a href="{{ $tabUrl }}" 
                   class="inline-flex items-center gap-2 px-3.5 sm:px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap {{ $isActive ? 'bg-white text-slate-900 shadow-sm font-black' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}">
                    <span>{{ $tab['icon'] }}</span>
                    <span>{{ $tab['label'] }}</span>
                    @if(isset($tabCount))
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ $isActive ? 'bg-slate-900 text-white' : 'bg-slate-200/80 text-slate-600' }}">
                            {{ $tabCount }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    {{-- 2. Seamless Hoverable Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-separate border-spacing-y-3">
            <thead>
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider px-6 py-2">Artikel &amp; Metadata</th>
                    <th class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider px-6 py-2 text-center">Tipe Postingan</th>
                    <th class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider px-6 py-2 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider px-6 py-2">Waktu Terbit</th>
                    <th class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider px-6 py-2 text-center">Views</th>
                    <th class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider px-6 py-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($articles as $article)
                <tr class="bg-white shadow-[0_4px_20px_rgb(0,0,0,0.02)] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 group">
                    {{-- 3. Quick Copy Slug Column --}}
                    <td class="px-6 py-4 max-w-md first:rounded-l-2xl border-y first:border-l border-slate-100">
                        <div class="flex items-start gap-4">
                            @if($article->thumbnail)
                                <div class="w-16 h-12 flex-shrink-0 rounded-xl bg-slate-100 overflow-hidden border border-slate-200/70 shadow-2xs mt-0.5 group-hover:scale-105 transition-transform duration-300">
                                    <img src="{{ Storage::url($article->thumbnail) }}" alt="" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-16 h-12 flex-shrink-0 rounded-xl bg-slate-100 border border-slate-200/70 flex items-center justify-center text-slate-400 mt-0.5">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('blog.show', $article->slug) }}" target="_blank" class="text-sm font-extrabold text-slate-900 group-hover:text-emerald-600 truncate block transition-colors leading-snug" title="{{ $article->title }}">
                                    {{ Str::limit($article->title, 65) }}
                                </a>
                                
                                {{-- Quick Copy Slug Component --}}
                                <div class="flex items-center gap-1.5 mt-1.5">
                                    <span class="inline-flex items-center gap-1 bg-slate-50 text-slate-500 font-mono text-[11px] px-2 py-0.5 rounded-lg border border-slate-200/70 max-w-[220px] truncate" title="/blog/{{ $article->slug }}">
                                        /blog/{{ $article->slug }}
                                    </span>
                                    <button type="button" 
                                            onclick="copySlugToClipboard('{{ url('/blog/' . $article->slug) }}', this)"
                                            class="p-1 rounded-lg text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 transition-all border border-slate-200/60 shadow-2xs cursor-pointer" 
                                            title="Salin Link Artikel">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </button>
                                </div>

                                {{-- Specific Meta Info for Case Studies (Client & Geo) --}}
                                @if($article->isCaseStudy() && ($article->client_name || $article->location_geo))
                                <div class="flex items-center gap-2 mt-2 text-[11px] font-semibold text-slate-600 flex-wrap">
                                    @if($article->client_name)
                                        <span class="inline-flex items-center gap-1 font-bold text-slate-800 bg-indigo-50 border border-indigo-100 px-2 py-0.5 rounded-md">
                                            🏢 {{ $article->client_name }}
                                        </span>
                                    @endif
                                    @if($article->location_geo)
                                        <span class="inline-flex items-center gap-1 text-slate-600 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md">
                                            📍 {{ $article->location_geo }}
                                        </span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Post Type Visual Badging --}}
                    <td class="px-6 py-4 text-center border-y border-slate-100">
                        @if($article->isPromo())
                            @if($article->promo_end_date)
                                @if($article->promo_end_date->isPast())
                                    <span class="inline-flex flex-col items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-red-50 text-red-700 border border-red-200">
                                        <span>🔴 Promo Berakhir</span>
                                        <span class="text-[9px] font-medium opacity-90">{{ $article->promo_end_date->format('d/m/Y') }}</span>
                                    </span>
                                @elseif($article->promo_end_date->diffInHours(now()) <= 72)
                                    <span class="inline-flex flex-col items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-amber-50 text-amber-800 border border-amber-300 animate-pulse">
                                        <span>🔥 Berakhir Segera</span>
                                        <span class="text-[9px] font-black">{{ $article->promo_end_date->diffForHumans() }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex flex-col items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span>🏷️ Promo Aktif</span>
                                        <span class="text-[9px] font-medium text-rose-600">s/d {{ $article->promo_end_date->format('d M Y') }}</span>
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-rose-50 text-rose-700 border border-rose-200">
                                    🏷️ Promo Khusus
                                </span>
                            @endif
                        @elseif($article->isCaseStudy())
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                💼 Studi Kasus B2B
                            </span>
                        @elseif($article->post_type === 'news')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-blue-50 text-blue-700 border border-blue-200">
                                📰 Kabar Perusahaan
                            </span>
                        @elseif($article->post_type === 'press_release')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-purple-50 text-purple-700 border border-purple-200">
                                📢 Press Release
                            </span>
                        @elseif($article->post_type === 'video_guide')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                🎥 Video Panduan
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[11px] font-extrabold bg-slate-100 text-slate-700 border border-slate-200">
                                📄 Edukasi Teknis
                            </span>
                        @endif
                    </td>

                    {{-- 4. Live Status Badge --}}
                    <td class="px-6 py-4 text-center border-y border-slate-100">
                        @if($article->status === 'published')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-emerald-50 text-emerald-700 border border-emerald-200/80 shadow-2xs">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Terbit</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                <span>Draft</span>
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 border-y border-slate-100">
                        <div class="text-xs font-black text-slate-800">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">{{ $article->published_at ? $article->published_at->format('H:i') : $article->created_at->format('H:i') }} WIB</div>
                    </td>

                    <td class="px-6 py-4 text-center border-y border-slate-100">
                        <div class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-50 border border-slate-200/60 rounded-xl text-xs font-black text-slate-700">
                            <span>👁️</span>
                            <span>{{ number_format($article->views ?? 0) }}</span>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-right last:rounded-r-2xl border-y last:border-r border-slate-100">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('blog.show', $article->slug) }}" target="_blank" class="p-2.5 rounded-xl text-blue-600 hover:bg-blue-50 border border-slate-200/80 transition-all hover:scale-105 shadow-2xs" title="Pratinjau Artikel">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="p-2.5 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105 shadow-2xs" title="Edit Artikel">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus konten ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2.5 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105 shadow-2xs cursor-pointer" title="Hapus Artikel">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-slate-400 font-medium bg-white rounded-3xl border border-slate-100">
                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        <p class="text-sm font-bold text-slate-700">Belum ada konten untuk tipe ini.</p>
                        @if(($currentType ?? 'all') !== 'all')
                            <a href="{{ route('admin.articles.index') }}" class="mt-2 inline-block text-xs font-bold text-emerald-600 hover:underline">
                                ← Lihat Semua Konten
                            </a>
                        @endif
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
    <div class="bg-white rounded-3xl p-6 border border-slate-100/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        {{ $articles->links() }}
    </div>
    @endif

</div>

@push('scripts')
<script>
function copySlugToClipboard(url, btn) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            const originalSvg = btn.innerHTML;
            btn.innerHTML = '✓';
            btn.classList.add('text-emerald-600', 'font-black');
            setTimeout(() => {
                btn.innerHTML = originalSvg;
                btn.classList.remove('text-emerald-600', 'font-black');
            }, 1800);
        });
    } else {
        alert('Tautan: ' + url);
    }
}
</script>
@endpush
@endsection
