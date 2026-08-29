@extends('layouts.admin')
@section('title','Kelola Pesanan & Kontak')
@section('page-title','Pesanan &amp; Kontak Masuk Pelanggan')

@section('admin-content')
{{-- Filter Tabs Bar --}}
<div class="flex items-center gap-2 mb-6 overflow-x-auto no-scrollbar pb-1">
    @php
    $filters = [''=>'Semua Pesanan','new'=>'⚡ Baru','in_progress'=>'⏳ Diproses','completed'=>'✅ Selesai','cancelled'=>'❌ Dibatalkan'];
    @endphp
    @foreach($filters as $val => $label)
    <a href="{{ route('admin.contacts.index',['status'=>$val]) }}"
       class="px-4 py-2 rounded-xl text-xs font-bold transition-all shrink-0 flex items-center gap-2 {{ ($status ?? '') === $val ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200/80' }}">
        <span>{{ $label }}</span>
        @if(isset($counts[$val ?: 'all']))
        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ ($status ?? '') === $val ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
            {{ $counts[$val ?: 'all'] }}
        </span>
        @endif
    </a>
    @endforeach
</div>

{{-- Main Table Container --}}
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama Pelanggan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kontak WA / HP</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Layanan Kendala</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Area Lokasi</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Invoice</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Tanggal</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($contacts as $contact)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <strong class="text-slate-900 text-sm font-extrabold block">{{ $contact->name }}</strong>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs font-bold text-slate-800">{{ $contact->phone }}</div>
                        @if($contact->email)<div class="text-[11px] text-slate-400 font-mono">{{ $contact->email }}</div>@endif
                    </td>
                    <td class="px-6 py-4 text-xs font-semibold text-slate-700">
                        {{ $contact->service_type ?? 'Saluran Mampet' }}
                    </td>
                    <td class="px-6 py-4 text-xs font-semibold text-slate-600">
                        📍 {{ $contact->area ?? 'Jabodetabek' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($contact->status === 'new')
                            <span class="bg-emerald-100 text-emerald-800 border border-emerald-200/80 text-xs font-extrabold px-3 py-1 rounded-full">BARU</span>
                        @elseif($contact->status === 'in_progress')
                            <span class="bg-amber-100 text-amber-800 border border-amber-200/80 text-xs font-extrabold px-3 py-1 rounded-full">PROSES</span>
                        @elseif($contact->status === 'completed')
                            <span class="bg-blue-100 text-blue-800 border border-blue-200/80 text-xs font-extrabold px-3 py-1 rounded-full">SELESAI</span>
                        @else
                            <span class="bg-slate-100 text-slate-600 border border-slate-200/80 text-xs font-extrabold px-3 py-1 rounded-full">BATAL</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-xs font-extrabold text-slate-800">
                        {{ $contact->invoice_amount ? 'Rp '.number_format($contact->invoice_amount,0,',','.') : '-' }}
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-600 font-medium">
                        {{ $contact->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}?text={{ urlencode('Halo ' . $contact->name . ', CS Rootera Plumbing merespon kendala Anda.') }}" 
                               target="_blank" rel="noopener" 
                               class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-1.5 rounded-xl text-xs transition-all shadow-xs inline-flex items-center gap-1">
                                💬 WA
                            </a>
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="p-2 rounded-xl text-blue-600 hover:bg-blue-50 border border-slate-200/80 transition-all hover:scale-105" title="Detail Pesanan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus data pesanan ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-slate-400 font-medium">Belum ada data kontak atau pesanan masuk.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($contacts->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
