@extends('layouts.admin')
@section('title', 'Kelola FAQ')
@section('page-title', 'Kelola FAQ')

@section('admin-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <p style="color:#6b7280;font-size:.9rem">Total: <strong>{{ $faqs->count() ?? 0 }}</strong> FAQ</p>
    <button onclick="document.getElementById('modal-add-faq').style.display='flex'" class="btn btn-primary" style="border-radius:10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah FAQ
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
                <th>Pertanyaan</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($faqs as $faq)
        <tr>
            <td>
                <strong>{{ Str::limit($faq->question, 50) }}</strong>
                <div style="font-size:.82rem;color:#6b7280;margin-top:4px">{{ Str::limit($faq->answer, 60) }}</div>
            </td>
            <td>{{ $faq->sort_order }}</td>
            <td>
                <button onclick="toggleFaq({{ $faq->id }}, this)" data-active="{{ $faq->is_active ? '1' : '0' }}" style="border:none;background:none;cursor:pointer;padding:0">
                    <span class="{{ $faq->is_active ? 'status-completed' : 'status-cancelled' }}">
                        {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </button>
            </td>
            <td>
                <div style="display:flex;gap:.4rem">
                    <button type="button" onclick='openEditFaq(@json($faq))' class="btn-sm btn-edit">Edit</button>
                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center;padding:2rem;color:#9ca3af">Belum ada FAQ.</td></tr>
        @endforelse
        </tbody>
    </table>
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
