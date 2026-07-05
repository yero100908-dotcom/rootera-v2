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

<div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden">
    <table class="admin-table">
        <thead><tr><th>Nama</th><th>Kontak</th><th>Layanan</th><th>Area</th><th>Status</th><th>Invoice</th><th>Tanggal</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($contacts as $contact)
        <tr>
            <td><strong>{{ $contact->name }}</strong></td>
            <td>
                <div style="font-size:.85rem">{{ $contact->phone }}</div>
                @if($contact->email)<div style="font-size:.78rem;color:#9ca3af">{{ $contact->email }}</div>@endif
            </td>
            <td style="font-size:.85rem">{{ $contact->service_type ?? '-' }}</td>
            <td style="font-size:.85rem">{{ $contact->area ?? '-' }}</td>
            <td><span class="status-{{ $contact->status }}">{{ $contact->status_label }}</span></td>
            <td style="font-size:.85rem">{{ $contact->invoice_amount ? 'Rp '.number_format($contact->invoice_amount,0,',','.') : '-' }}</td>
            <td style="font-size:.82rem">{{ $contact->created_at->format('d/m/Y') }}</td>
            <td>
                <div style="display:flex;gap:.4rem">
                    <a href="{{ route('admin.contacts.show',$contact) }}" class="btn-sm btn-view">Detail</a>
                    <form action="{{ route('admin.contacts.destroy',$contact) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:3rem;color:#9ca3af">Belum ada data kontak.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6">{{ $contacts->appends(request()->query())->links() }}</div>
</div>
@endsection
