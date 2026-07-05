@extends('layouts.admin')
@section('title','Detail Pesanan')
@section('page-title','Detail Pesanan / Kontak')

@section('admin-content')
<div style="max-width:800px">
    <a href="{{ route('admin.contacts.index') }}" style="display:inline-flex;align-items:center;gap:.4rem;color:#6b7280;font-size:.88rem;margin-bottom:1.5rem">← Kembali</a>

    <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">
        <div style="background:#fff;border-radius:16px;padding:1.75rem;border:1px solid #e5e7eb">
            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;color:#0A2E78;margin-bottom:1.25rem">Informasi Pelanggan</h3>
            @php
            $info = [
                'Nama' => $contact->name,
                'Telepon' => $contact->phone,
                'Email' => $contact->email ?? '-',
                'Jenis Layanan' => $contact->service_type ?? '-',
                'Area' => $contact->area ?? '-',
                'Sumber' => $contact->source,
                'Tanggal Masuk' => $contact->created_at->format('d F Y, H:i'),
            ];
            @endphp
            @foreach($info as $k => $v)
            <div style="display:flex;gap:1rem;padding:.7rem 0;border-bottom:1px solid #f3f4f6">
                <span style="font-weight:600;font-size:.88rem;color:#374151;min-width:140px">{{ $k }}</span>
                <span style="font-size:.88rem;color:#6b7280">{{ $v }}</span>
            </div>
            @endforeach
            <div style="margin-top:1.25rem">
                <strong style="font-size:.88rem;color:#374151;display:block;margin-bottom:.5rem">Pesan:</strong>
                <p style="background:#f9fafb;padding:1rem;border-radius:10px;font-size:.9rem;color:#374151;line-height:1.6">{{ $contact->message }}</p>
            </div>
            @if($contact->admin_notes)
            <div style="margin-top:1rem">
                <strong style="font-size:.88rem;color:#374151;display:block;margin-bottom:.5rem">Catatan Admin:</strong>
                <p style="background:#f0fdf4;padding:1rem;border-radius:10px;font-size:.9rem;color:#374151">{{ $contact->admin_notes }}</p>
            </div>
            @endif
        </div>

        <div style="display:flex;flex-direction:column;gap:1.25rem">
            <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
                <h3 style="font-family:'Plus Jakarta Sans',sans-serif;color:#0A2E78;margin-bottom:1.25rem;font-size:.95rem">Update Status</h3>
                <form action="{{ route('admin.contacts.update',$contact) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="new"          {{ $contact->status==='new'?'selected':'' }}>Baru</option>
                            <option value="in_progress"  {{ $contact->status==='in_progress'?'selected':'' }}>Diproses</option>
                            <option value="completed"    {{ $contact->status==='completed'?'selected':'' }}>Selesai</option>
                            <option value="cancelled"    {{ $contact->status==='cancelled'?'selected':'' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="invoice_amount">Nominal Invoice (Rp)</label>
                        <input type="number" id="invoice_amount" name="invoice_amount" value="{{ $contact->invoice_amount }}" placeholder="0" min="0">
                    </div>
                    <div class="form-group">
                        <label for="admin_notes">Catatan Admin</label>
                        <textarea id="admin_notes" name="admin_notes" style="min-height:80px" placeholder="Catatan internal...">{{ $contact->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">Simpan Perubahan</button>
                </form>
            </div>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$contact->phone) }}" class="btn btn-primary" style="text-align:center;justify-content:center;background:#25D366;border-color:#25D366" target="_blank">
                💬 Hubungi via WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
