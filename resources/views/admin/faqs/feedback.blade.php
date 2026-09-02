@extends('layouts.admin')
@section('title', 'Respon & Feedback FAQ')
@section('page-title', 'Analistik & Respon Feedback FAQ')

@section('admin-content')
<div class="space-y-6">

    {{-- Navigation Tabs --}}
    <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
        <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
            📋 Kelola Daftar FAQ
        </a>
        <a href="{{ route('admin.faqs.feedback') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-amber-500 text-white shadow-xs">
            💬 Respon &amp; Feedback Pengunjung
            @if($unreviewedCount > 0)
                <span class="ml-1.5 bg-white text-amber-700 text-[10px] font-extrabold px-2 py-0.5 rounded-full">
                    {{ $unreviewedCount }} BARU
                </span>
            @endif
        </a>
    </div>

    {{-- Analytics Dashboard Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Feedback --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-semibold block mb-1">Total Respon Masuk</span>
                <span class="text-2xl font-extrabold text-slate-900">{{ number_format($totalFeedbackCount) }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shrink-0">
                💬
            </div>
        </div>

        {{-- Satisfaction Ratio --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-semibold block mb-1">Rasio Kepuasan Pembaca</span>
                <span class="text-2xl font-extrabold text-emerald-600">{{ $satisfactionRate }}%</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg shrink-0">
                ⭐
            </div>
        </div>

        {{-- Positive Helpful --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-semibold block mb-1">Masukan Membantu (👍)</span>
                <span class="text-2xl font-extrabold text-emerald-600">{{ number_format($helpfulCount) }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg shrink-0">
                👍
            </div>
        </div>

        {{-- Needs Revision / Unhelpful --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-xs text-slate-500 font-semibold block mb-1">Masukan Perbaikan (👎)</span>
                <span class="text-2xl font-extrabold text-rose-600">{{ number_format($unhelpfulCount) }}</span>
                @if($unreviewedCount > 0)
                    <span class="text-[10px] text-amber-600 font-bold block mt-0.5">{{ $unreviewedCount }} belum ditinjau</span>
                @endif
            </div>
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg shrink-0">
                👎
            </div>
        </div>
    </div>

    {{-- Feedback List Table Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        {{-- Header & Filter Bar --}}
        <div class="p-4 sm:p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Daftar Feedback &amp; Evaluasi FAQ</h3>
                <p class="text-xs text-slate-500 mt-0.5">Menampilkan masukan dari pengunjung web.</p>
            </div>

            {{-- Filters Form --}}
            <form method="GET" action="{{ route('admin.faqs.feedback') }}" class="flex flex-wrap gap-2 items-center">
                <select name="status" onchange="this.form.submit()" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-white text-slate-700">
                    <option value="">Semua Status Feedback</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>👍 Membantu (Ya)</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>👎 Belum Membantu</option>
                </select>

                <select name="reviewed" onchange="this.form.submit()" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-white text-slate-700">
                    <option value="">Semua Status Tinjauan</option>
                    <option value="0" {{ request('reviewed') === '0' ? 'selected' : '' }}>⏳ Belum Ditinjau</option>
                    <option value="1" {{ request('reviewed') === '1' ? 'selected' : '' }}>✓ Selesai Ditinjau</option>
                </select>

                <select name="category_id" onchange="this.form.submit()" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-white text-slate-700">
                    <option value="">Semua Kategori FAQ</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                @if(request('status') !== null || request('reviewed') !== null || request('category_id'))
                    <a href="{{ route('admin.faqs.feedback') }}" class="text-xs text-rose-600 font-bold hover:underline px-2">Reset</a>
                @endif
            </form>
        </div>

        {{-- Table Container --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 border-b border-slate-200/80">
                    <tr>
                        <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Tanggal &amp; FAQ</th>
                        <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                        <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Alasan / Komentar User</th>
                        <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Review</th>
                        <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                @forelse($feedbacks as $fb)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 max-w-sm">
                            <span class="text-[11px] text-slate-400 font-semibold block mb-1">
                                🗓️ {{ $fb->created_at ? $fb->created_at->format('d M Y, H:i') : '-' }} WIB
                            </span>
                            @if($fb->faq)
                                <div class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md mb-1">
                                    <span>{{ $fb->faq->category->icon ?? '❓' }} {{ $fb->faq->category->name ?? 'FAQ' }}</span>
                                </div>
                                <a href="{{ route('faq.show', $fb->faq->slug ?? $fb->faq->id) }}" target="_blank" class="text-slate-900 font-bold text-xs sm:text-sm hover:text-cyan-600 line-clamp-2 block">
                                    {{ $fb->faq->question }}
                                </a>
                            @else
                                <span class="text-xs text-slate-400 italic">[FAQ sudah dihapus]</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($fb->is_helpful)
                                <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs font-extrabold px-3 py-1 rounded-full">
                                    👍 Membantu
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-rose-100 text-rose-800 border border-rose-200 text-xs font-extrabold px-3 py-1 rounded-full">
                                    👎 Kurang Membantu
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 max-w-md">
                            @if($fb->reason)
                                <span class="bg-slate-100 text-slate-700 font-bold text-xs px-2.5 py-1 rounded-lg inline-block mb-1 border border-slate-200">
                                    🏷️ {{ $fb->reason }}
                                </span>
                            @endif

                            @if($fb->comment)
                                <p class="text-xs text-slate-800 bg-amber-50/60 p-2.5 rounded-xl border border-amber-200/60 leading-relaxed font-medium">
                                    "{{ $fb->comment }}"
                                </p>
                            @elseif(!$fb->reason)
                                <span class="text-xs text-slate-400 italic">Tanpa catatan tambahan</span>
                            @endif

                            <span class="text-[10px] text-slate-400 block mt-1">IP: {{ $fb->ip_address ?? 'N/A' }}</span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.faqs.feedback.toggle', $fb) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="focus:outline-none" title="Klik untuk mengubah status tinjauan">
                                    @if($fb->is_reviewed)
                                        <span class="bg-cyan-100 text-cyan-800 border border-cyan-200 text-[11px] font-bold px-3 py-1 rounded-full">
                                            ✓ Selesai Ditinjau
                                        </span>
                                    @else
                                        <span class="bg-amber-100 text-amber-800 border border-amber-200 text-[11px] font-bold px-3 py-1 rounded-full animate-pulse">
                                            ⏳ Belum Ditinjau
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.faqs.feedback.destroy', $fb) }}" method="POST" onsubmit="return confirm('Hapus respon feedback ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200 transition-all" title="Hapus Feedback">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                            Belum ada feedback / masukan pengunjung yang masuk.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($feedbacks->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $feedbacks->links() }}
        </div>
        @endif

    </div>

</div>
@endsection
