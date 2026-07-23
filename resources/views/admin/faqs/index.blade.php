@extends('layouts.admin')
@section('title', 'Kelola FAQ')
@section('page-title', 'Kelola FAQ')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">FAQ (Tanya Jawab)</h2>
            <p class="text-sm text-slate-500 mt-1">Total: <strong>{{ $faqs->count() ?? 0 }}</strong> FAQ</p>
        </div>
        <button onclick="document.getElementById('modal-add-faq').style.display='flex'" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah FAQ
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/60">
                <tr>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Pertanyaan</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Urutan</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Status</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($faqs as $faq)
                <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="px-6 py-4">
                        <strong class="text-slate-900 text-sm font-medium block mb-0.5">{{ Str::limit($faq->question, 50) }}</strong>
                        <div class="text-xs text-slate-500">{{ Str::limit($faq->answer, 60) }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $faq->sort_order }}</td>
                    <td class="px-6 py-4">
                        <button onclick="toggleFaq({{ $faq->id }}, this)" data-active="{{ $faq->is_active ? '1' : '0' }}" class="focus:outline-none transition-transform active:scale-95">
                            @if($faq->is_active)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Aktif</span>
                            @else
                                <span class="bg-slate-50 text-slate-600 border border-slate-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <button type="button" onclick='openEditFaq(@json($faq))' class="text-slate-500 hover:text-emerald-600 font-medium text-sm transition-colors">Edit</button>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-rose-600 font-medium text-sm transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada FAQ.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah FAQ --}}
<div id="modal-add-faq" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem">
    <div style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Tambah FAQ</h2>
            <button type="button" onclick="document.getElementById('modal-add-faq').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.faqs.store') }}" style="padding:1.5rem">
            @csrf
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Pertanyaan <span style="color:#ef4444">*</span></label>
                <input type="text" name="question" required placeholder="Berapa lama pengerjaan?" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Jawaban <span style="color:#ef4444">*</span></label>
                <textarea name="answer" required rows="4" placeholder="Tulis jawaban di sini..." style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>
            <div style="margin-bottom:1.5rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Urutan Tampil</label>
                <input type="number" name="sort_order" value="0" style="width:100px;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-add-faq').style.display='none'" style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer">Batal</button>
                <button type="submit" style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit FAQ --}}
<div id="modal-edit-faq" style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem">
    <div style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Edit FAQ</h2>
            <button type="button" onclick="document.getElementById('modal-edit-faq').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="edit-faq-form" method="POST" style="padding:1.5rem">
            @csrf @method('PUT')
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Pertanyaan <span style="color:#ef4444">*</span></label>
                <input type="text" name="question" id="edit-question" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Jawaban <span style="color:#ef4444">*</span></label>
                <textarea name="answer" id="edit-answer" required rows="4" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>
            <div style="display:flex;gap:1.5rem;margin-bottom:1.5rem">
                <div>
                    <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Urutan</label>
                    <input type="number" name="sort_order" id="edit-sort-order" style="width:100px;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
                </div>
                <div>
                    <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.5rem">Status Aktif</label>
                    <input type="checkbox" name="is_active" id="edit-is-active" value="1" style="width:18px;height:18px;cursor:pointer">
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-edit-faq').style.display='none'" style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer">Batal</button>
                <button type="submit" style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditFaq(faq) {
    document.getElementById('edit-faq-form').action = `/admin/faqs/${faq.id}`;
    document.getElementById('edit-question').value = faq.question;
    document.getElementById('edit-answer').value = faq.answer;
    document.getElementById('edit-sort-order').value = faq.sort_order;
    document.getElementById('edit-is-active').checked = faq.is_active == 1;
    document.getElementById('modal-edit-faq').style.display = 'flex';
}

function toggleFaq(id, btn) {
    fetch(`/admin/faqs/${id}/toggle`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        const isActive = data.is_active;
        btn.dataset.active = isActive ? '1' : '0';
        btn.className = btn.className.replace(isActive ? 'bg-gray-300' : 'bg-green-500', isActive ? 'bg-green-500' : 'bg-gray-300');
        btn.querySelector('span').className = btn.querySelector('span').className.replace(
            isActive ? 'translate-x-1' : 'translate-x-6',
            isActive ? 'translate-x-6' : 'translate-x-1'
        );
    });
}
</script>
@endpush
@endsection
