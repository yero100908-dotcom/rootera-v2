@extends('layouts.admin')
@section('title','Kelola Kontak')
@section('page-title','Pesanan & Kontak Masuk')

@section('admin-content')
{{-- Filter Tabs --}}
<div style="display:flex;gap:.5rem;margin-bottom:1.5rem;flex-wrap:wrap">
    @php
    $filters = [''=>'Semua','new'=>'Baru','in_progress'=>'Diproses','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
    @endphp
    @foreach($filters as $val => $label)
    <a href="{{ route('admin.contacts.index',['status'=>$val]) }}"
       style="padding:.45rem 1rem;border-radius:50px;font-size:.85rem;font-weight:600;transition:all .2s;text-decoration:none;
              {{ ($status ?? '') === $val ? 'background:#0A2E78;color:#fff' : 'background:#f1f5f9;color:#374151' }}">
        {{ $label }}
        @if(isset($counts[$val ?: 'all']))
        <span style="background:{{ ($status ?? '') === $val ? 'rgba(255,255,255,.25)' : '#e5e7eb' }};padding:.1rem .45rem;border-radius:50px;font-size:.75rem;margin-left:.25rem">
            {{ $counts[$val ?: 'all'] }}
        </span>
        @endif
    </a>
    @endforeach
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/60">
                <tr>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kontak</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Layanan</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Area</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Status</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Invoice</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Tanggal</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($contacts as $contact)
                <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="px-6 py-4">
                        <strong class="text-slate-900 text-sm font-medium block">{{ $contact->name }}</strong>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-slate-900">{{ $contact->phone }}</div>
                        @if($contact->email)<div class="text-xs text-slate-500">{{ $contact->email }}</div>@endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $contact->service_type ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $contact->area ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($contact->status === 'new')
                            <span class="bg-blue-50 text-blue-700 border border-blue-200/60 text-xs font-medium px-2.5 py-1 rounded-full">Baru</span>
                        @elseif($contact->status === 'in_progress')
                            <span class="bg-amber-50 text-amber-700 border border-amber-200/60 text-xs font-medium px-2.5 py-1 rounded-full">Diproses</span>
                        @elseif($contact->status === 'completed')
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-medium px-2.5 py-1 rounded-full">Selesai</span>
                        @else
                            <span class="bg-slate-50 text-slate-600 border border-slate-200/60 text-xs font-medium px-2.5 py-1 rounded-full">Batal</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $contact->invoice_amount ? 'Rp '.number_format($contact->invoice_amount,0,',','.') : '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $contact->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-slate-500 hover:text-blue-600 font-medium text-sm transition-colors">Detail</a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-600 bg-slate-100 hover:bg-rose-100 hover:text-rose-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data kontak.</td>
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
