@extends('layouts.admin')
@section('title', 'Kelola Multi-Tier FAQ')
@section('page-title', 'Kelola Multi-Tier FAQ Knowledge Base')

@section('admin-content')
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-900">FAQ (Tanya Jawab Knowledge Base)</h2>
            <p class="text-sm text-slate-500 mt-1">Total: <strong>{{ $faqs->total() ?? count($faqs) }}</strong> Pertanyaan Terdaftar</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            {{-- Filter Category --}}
            <form method="GET" action="{{ route('admin.faqs.index') }}" class="flex items-center gap-2">
                <select name="category_id" onchange="this.form.submit()" class="text-xs border border-slate-300 rounded-lg px-3 py-2 bg-slate-50 text-slate-700 focus:outline-none">
                    <option value="">-- Semua Kategori FAQ --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @if(request('category_id') || request('status') !== null)
                    <a href="{{ route('admin.faqs.index') }}" class="text-xs text-slate-500 hover:text-rose-600 font-medium">Reset</a>
                @endif
            </form>

            <button onclick="document.getElementById('modal-add-faq').style.display='flex'" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah FAQ Baru
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/60">
                <tr>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Pertanyaan &amp; Kategori</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Unggulan Beranda</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Urutan</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5">Status</th>
                    <th class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($faqs as $faq)
                <tr class="hover:bg-slate-50/60 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="bg-slate-100 text-slate-700 font-semibold text-[0.7rem] px-2 py-0.5 rounded-md border border-slate-200">
                                {{ $faq->category->icon ?? '❓' }} {{ $faq->category->name ?? 'Umum' }}
                            </span>
                            @if($faq->is_featured_home)
                                <span class="bg-amber-50 text-amber-700 font-bold text-[0.68rem] px-2 py-0.5 rounded-md border border-amber-200">
                                    ⭐ Tampil Beranda
                                </span>
                            @endif
                        </div>
                        <strong class="text-slate-900 text-sm font-semibold block mb-0.5">{{ $faq->question }}</strong>
                        <div class="text-xs text-slate-500 line-clamp-2">{{ Str::limit(strip_tags($faq->answer), 110) }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($faq->is_featured_home)
                            <span class="text-emerald-600 font-bold text-xs">Ya</span>
                        @else
                            <span class="text-slate-400 text-xs">Tidak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $faq->sort_order }}</td>
                    <td class="px-6 py-4">
                        <button onclick="toggleFaq({{ $faq->id }}, this)" data-active="{{ $faq->is_active ? '1' : '0' }}" class="focus:outline-none">
                            @if($faq->is_active)
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Aktif</span>
                            @else
                                <span class="bg-slate-50 text-slate-600 border border-slate-200/60 text-xs font-medium px-2.5 py-1 rounded-full block">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick='openEditFaq(@json($faq))' class="text-slate-600 bg-slate-100 hover:bg-emerald-100 hover:text-emerald-700 font-medium text-xs transition-colors px-3 py-2 rounded-lg">Edit</button>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-600 bg-slate-100 hover:bg-rose-100 hover:text-rose-700 font-medium text-xs transition-colors px-3 py-2 rounded-lg">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data FAQ yang sesuai filter.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($faqs->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $faqs->links() }}
        </div>
    @endif
</div>

{{-- Modal Tambah FAQ --}}
<div id="modal-add-faq" class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl mx-auto overflow-hidden">
        <div class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Tambah FAQ Baru</h2>
            <button type="button" onclick="document.getElementById('modal-add-faq').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.faqs.store') }}" class="p-4 sm:p-6">
            @csrf
            
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.4rem">Kategori FAQ <span style="color:#ef4444">*</span></label>
                <select name="faq_category_id" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.4rem">Pertanyaan <span style="color:#ef4444">*</span></label>
                <input type="text" name="question" required placeholder="Contoh: Berapa lama pengerjaan pipa mampet?" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>

            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.4rem">Jawaban Lengkap <span style="color:#ef4444">*</span></label>
                <textarea name="answer" required rows="4" placeholder="Tulis penjelasan mendalam di sini..." style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>

            <div style="display:flex;gap:1.5rem;margin-bottom:1.5rem;align-items:center">
                <div>
                    <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.3rem">Urutan</label>
                    <input type="number" name="sort_order" value="0" style="width:100px;padding:.5rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none">
                </div>

                <div style="display:flex;align-items:center;gap:.5rem;margin-top:1.2rem">
                    <input type="checkbox" name="is_featured_home" value="1" id="add_is_featured">
                    <label for="add_is_featured" style="font-size:.85rem;font-weight:600;color:#0A2E78;cursor:pointer">⭐ Tampilkan di Beranda (Featured)</label>
                </div>

                <div style="display:flex;align-items:center;gap:.5rem;margin-top:1.2rem">
                    <input type="checkbox" name="is_active" value="1" id="add_is_active" checked>
                    <label for="add_is_active" style="font-size:.85rem;font-weight:600;color:#374151;cursor:pointer">Aktif</label>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-add-faq').style.display='none'" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors">Simpan FAQ</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit FAQ --}}
<div id="modal-edit-faq" class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl mx-auto overflow-hidden">
        <div class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200">
            <h2 style="font-size:1.15rem;font-weight:bold;color:#0A2E78;margin:0">Edit FAQ</h2>
            <button type="button" onclick="document.getElementById('modal-edit-faq').style.display='none'" style="font-size:1.5rem;color:#9ca3af;background:none;border:none;cursor:pointer;line-height:1">&times;</button>
        </div>
        <form id="edit-faq-form" method="POST" class="p-4 sm:p-6">
            @csrf @method('PUT')
            
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.4rem">Kategori FAQ <span style="color:#ef4444">*</span></label>
                <select name="faq_category_id" id="edit-category-id" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.4rem">Pertanyaan <span style="color:#ef4444">*</span></label>
                <input type="text" name="question" id="edit-question" required style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box">
            </div>

            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.4rem">Jawaban Lengkap <span style="color:#ef4444">*</span></label>
                <textarea name="answer" id="edit-answer" required rows="4" style="width:100%;padding:.6rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none;box-sizing:border-box;resize:vertical"></textarea>
            </div>

            <div style="display:flex;gap:1.5rem;margin-bottom:1.5rem;align-items:center">
                <div>
                    <label style="display:block;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:.3rem">Urutan</label>
                    <input type="number" name="sort_order" id="edit-sort-order" style="width:100px;padding:.5rem .8rem;border:1px solid #e5e7eb;border-radius:8px;font-size:.9rem;outline:none">
                </div>

                <div style="display:flex;align-items:center;gap:.5rem;margin-top:1.2rem">
                    <input type="checkbox" name="is_featured_home" value="1" id="edit-is-featured">
                    <label for="edit-is-featured" style="font-size:.85rem;font-weight:600;color:#0A2E78;cursor:pointer">⭐ Tampilkan di Beranda</label>
                </div>

                <div style="display:flex;align-items:center;gap:.5rem;margin-top:1.2rem">
                    <input type="checkbox" name="is_active" value="1" id="edit-is-active">
                    <label for="edit-is-active" style="font-size:.85rem;font-weight:600;color:#374151;cursor:pointer">Aktif</label>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:.75rem">
                <button type="button" onclick="document.getElementById('modal-edit-faq').style.display='none'" class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors">Perbarui FAQ</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditFaq(faq) {
    document.getElementById('edit-faq-form').action = `/admin/faqs/${faq.id}`;
    document.getElementById('edit-category-id').value = faq.faq_category_id || '';
    document.getElementById('edit-question').value = faq.question;
    document.getElementById('edit-answer').value = faq.answer;
    document.getElementById('edit-sort-order').value = faq.sort_order;
    document.getElementById('edit-is-featured').checked = faq.is_featured_home == 1;
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
        location.reload();
    });
}
</script>
@endpush
@endsection
