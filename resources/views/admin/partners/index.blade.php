@extends('layouts.admin')
@section('title', 'Kelola Mitra Kami')
@section('page-title', 'Kelola Mitra Kami')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <p style="color:#6b7280;font-size:.9rem">Total: <strong>{{ $partners->count() ?? 0 }}</strong> mitra</p>
    <button onclick="document.getElementById('modal-add-partner').style.display='flex'" class="btn btn-primary" style="border-radius:10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Mitra
    </button>
</div>

@if(session('success'))
<div style="background:rgba(22,159,129,.08);border:1px solid rgba(22,159,129,.2);color:#169F81;padding:1rem;border-radius:10px;margin-bottom:1.5rem;font-size:.9rem;font-weight:600">
    {{ session('success') }}
</div>
@endif

<div style="background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Nama Mitra</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($partners as $partner)
        <tr>
            <td>
                @if($partner->logo_url)
                <img src="{{ $partner->logo_url }}" alt="{{ $partner->nama_mitra }}" style="height:40px;max-width:120px;object-fit:contain;border-radius:6px;border:1px solid #e5e7eb;background:#f9fafb;padding:4px">
                @else
                <div style="width:80px;height:40px;background:#f3f4f6;border-radius:6px;border:1px solid #e5e7eb"></div>
                @endif
            </td>
            <td>
                <strong>{{ $partner->nama_mitra }}</strong>
            </td>
            <td>
                <div style="display:flex;gap:.4rem">
                    <button type="button" onclick='openEditPartner(@json($partner))' class="btn-sm btn-edit">Edit</button>
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Hapus mitra ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;padding:2rem;color:#9ca3af">Belum ada mitra.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- Modal Tambah Partner --}}
<div id="modal-add-partner" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem">
    <div style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Tambah Mitra</h2>
            <button type="button" onclick="document.getElementById('modal-add-partner').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data" style="padding:1.5rem">
            @csrf
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Mitra <span style="color:#ef4444">*</span></label>
                <input type="text" name="nama_mitra" required placeholder="Contoh: PT Bangun Persada" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1.5rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Logo Mitra <span style="color:#ef4444">*</span></label>
                <input type="file" name="logo" required accept="image/*" style="width:100%;font-size:.9rem;color:#6b7280">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-add-partner').style.display='none'" style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer">Batal</button>
                <button type="submit" style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Partner --}}
<div id="modal-edit-partner" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem">
    <div style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Edit Mitra</h2>
            <button type="button" onclick="document.getElementById('modal-edit-partner').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="edit-partner-form" method="POST" enctype="multipart/form-data" style="padding:1.5rem">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Nama Mitra <span style="color:#ef4444">*</span></label>
                <input type="text" name="nama_mitra" id="edit-nama-mitra" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1.5rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Logo Mitra (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="logo" accept="image/*" style="width:100%;font-size:.9rem;color:#6b7280">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-edit-partner').style.display='none'" style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer">Batal</button>
                <button type="submit" style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditPartner(partner) {
    document.getElementById('edit-partner-form').action = `/admin/partners/${partner.id}`;
    document.getElementById('edit-nama-mitra').value = partner.nama_mitra;
    document.getElementById('modal-edit-partner').style.display = 'flex';
}
</script>
@endpush
@endsection
