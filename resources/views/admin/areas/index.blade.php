@extends('layouts.admin')
@section('title','Kelola Area Layanan')
@section('page-title','Area Layanan')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <p style="color:#6b7280;font-size:.9rem">Total: <strong>{{ $areas->total() }}</strong> area</p>
    <a href="{{ route('admin.service-areas.create') }}" class="btn btn-primary" style="border-radius:10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Area
    </a>
</div>
<div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden">
    <table class="admin-table">
        <thead><tr><th>Nama Area</th><th>Provinsi</th><th>Slug</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($areas as $area)
        <tr>
            <td><strong>{{ $area->name }}</strong></td>
            <td>{{ $area->province ?? '-' }}</td>
            <td style="font-size:.82rem;color:#6b7280">{{ $area->slug }}</td>
            <td><span class="{{ $area->is_active ? 'status-completed' : 'status-cancelled' }}">{{ $area->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div style="display:flex;gap:.4rem">
                    <a href="{{ route('admin.service-areas.edit',$area) }}" class="btn-sm btn-edit">Edit</a>
                    <form action="{{ route('admin.service-areas.destroy',$area) }}" method="POST" onsubmit="return confirm('Hapus area ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:2rem;color:#9ca3af">Belum ada area layanan.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6">{{ $areas->links() }}</div>
</div>
@endsection
