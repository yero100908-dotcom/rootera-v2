@extends('layouts.admin')
@section('title','Detail Pesanan')
@section('page-title','Detail Pesanan Pelanggan')

@section('admin-content')
<div class="max-w-5xl mx-auto pb-12">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
            ← Kembali ke Daftar Pesanan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- Customer Info Column (8 Cols) --}}
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
            <h3 class="font-extrabold text-slate-900 text-base mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Informasi Detail Pelanggan
            </h3>

            @php
            $info = [
                'Nama Lengkap' => $contact->name,
                'Nomor Telepon/WA' => $contact->phone,
                'Alamat Email' => $contact->email ?? '-',
                'Jenis Kendala' => $contact->service_type ?? '-',
                'Lokasi / Area' => $contact->area ?? '-',
                'Sumber Formulir' => $contact->source ?? 'Landing Page Website',
                'Waktu Pengajuan' => $contact->created_at->format('d F Y, H:i') . ' WIB',
            ];
            @endphp

            <div class="divide-y divide-slate-100 mb-6">
                @foreach($info as $k => $v)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between py-3">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $k }}</span>
                    <span class="text-sm font-extrabold text-slate-900 mt-1 sm:mt-0">{{ $v }}</span>
                </div>
                @endforeach
            </div>

            <div class="mb-6">
                <strong class="text-xs font-extrabold uppercase tracking-wider text-slate-700 block mb-2">Pesan Kendala Pelanggan:</strong>
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80 text-sm text-slate-800 leading-relaxed">
                    {{ $contact->message ?? 'Tidak ada pesan khusus.' }}
                </div>
            </div>

            @if($contact->admin_notes)
            <div>
                <strong class="text-xs font-extrabold uppercase tracking-wider text-emerald-700 block mb-2">Catatan Internal Admin:</strong>
                <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-200/80 text-sm text-emerald-900 leading-relaxed">
                    {{ $contact->admin_notes }}
                </div>
            </div>
            @endif
        </div>

        {{-- Status Update Column (4 Cols) --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                <h3 class="font-extrabold text-slate-900 text-base mb-5 border-b border-slate-100 pb-3">Update Status Pesanan</h3>
                
                <form action="{{ route('admin.contacts.update',$contact) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label for="status" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Status Pengerjaan</label>
                        <select id="status" name="status" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-extrabold text-slate-800">
                            <option value="new" {{ $contact->status==='new'?'selected':'' }}>⚡ Pesanan Baru</option>
                            <option value="in_progress" {{ $contact->status==='in_progress'?'selected':'' }}>⏳ Sedang Diproses Teknisi</option>
                            <option value="completed" {{ $contact->status==='completed'?'selected':'' }}>✅ Selesai Dikerjakan</option>
                            <option value="cancelled" {{ $contact->status==='cancelled'?'selected':'' }}>❌ Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label for="invoice_amount" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Nominal Invoice (Rp)</label>
                        <input type="number" id="invoice_amount" name="invoice_amount" value="{{ $contact->invoice_amount }}" placeholder="0" min="0"
                               class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-extrabold text-slate-900">
                    </div>

                    <div>
                        <label for="admin_notes" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Catatan Admin</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3" placeholder="Catatan internal tim teknisi..."
                                  class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800">{{ $contact->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs py-3 px-6 rounded-xl shadow-md transition-all">
                        Simpan Perubahan Status
                    </button>
                </form>
            </div>

            <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$contact->phone) }}?text={{ urlencode('Halo ' . $contact->name . ', saya CS Rootera Plumbing merespon pesanan Anda.') }}" 
               target="_blank" rel="noopener"
               class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs py-3.5 px-6 rounded-2xl shadow-md flex items-center justify-center gap-2 transition-all">
                💬 Respon Pelanggan via WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
