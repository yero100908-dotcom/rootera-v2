@extends('layouts.admin')
@section('title', 'Kelola Multi-Tier FAQ')
@section('page-title', 'Kelola Multi-Tier FAQ Knowledge Base')

@section('admin-content')
<div class="space-y-6">

    {{-- Navigation Tabs --}}
    <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
        <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-amber-500 text-white shadow-xs">
            📋 Kelola Daftar FAQ
        </a>
        <a href="{{ route('admin.faqs.feedback') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
            💬 Respon &amp; Feedback Pengunjung
        </a>
    </div>

<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Multi-Tier FAQ Knowledge Base</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-amber-600 font-bold">{{ $faqs->total() ?? count($faqs) }}</strong> pertanyaan terdaftar.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="document.getElementById('modal-add-faq').classList.remove('hidden'); document.getElementById('modal-add-faq').classList.add('flex');" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>Tambah FAQ Baru</span>
            </button>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="p-4 sm:px-6 bg-white border-b border-slate-100">
        <form method="GET" action="{{ route('admin.faqs.index') }}" class="flex flex-wrap gap-3 items-center">
            <select name="category_id" onchange="this.form.submit()" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-slate-50/50 focus:bg-white text-slate-700">
                <option value="">Semua Kategori FAQ</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->icon }} {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @if(request('category_id') || request('status') !== null)
                <a href="{{ route('admin.faqs.index') }}" class="text-xs text-rose-600 font-bold hover:underline">Reset Filter</a>
            @endif
        </form>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Pertanyaan &amp; Jawaban</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Beranda</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($faqs as $faq)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 max-w-md">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="bg-slate-100 text-slate-700 font-extrabold text-[10px] px-2.5 py-0.5 rounded-full border border-slate-200">
                                {{ $faq->category->icon ?? '❓' }} {{ $faq->category->name ?? 'Umum' }}
                            </span>
                            @if($faq->is_featured_home)
                                <span class="bg-amber-100 text-amber-800 font-extrabold text-[10px] px-2.5 py-0.5 rounded-full border border-amber-200">
                                    ⭐ Tampil Beranda
                                </span>
                            @endif
                        </div>
                        <strong class="text-slate-900 text-sm font-extrabold block mb-0.5">{{ $faq->question }}</strong>
                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($faq->answer), 110) }}</p>
                    </td>
                    <td class="px-6 py-4 text-center text-xs font-bold">
                        @if($faq->is_featured_home)
                            <span class="text-amber-600">Ya</span>
                        @else
                            <span class="text-slate-400">Tidak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button onclick="toggleFaq({{ $faq->id }}, this)" data-active="{{ $faq->is_active ? '1' : '0' }}" class="focus:outline-none">
                            @if($faq->is_active)
                                <span class="bg-emerald-100 text-emerald-800 border border-emerald-200/80 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                            @else
                                <span class="bg-slate-100 text-slate-600 border border-slate-200/80 text-xs font-bold px-3 py-1 rounded-full">Nonaktif</span>
                            @endif
                        </button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick='openEditFaq(@json($faq))' class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit FAQ">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini secara permanen?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus FAQ">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada data FAQ terdaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($faqs->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $faqs->links() }}
    </div>
    @endif
</div>

{{-- Modal Tambah FAQ --}}
<div id="modal-add-faq" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 class="text-base font-extrabold text-slate-900">Tambah FAQ Baru</h3>
            <button onclick="document.getElementById('modal-add-faq').classList.add('hidden'); document.getElementById('modal-add-faq').classList.remove('flex');" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Kategori FAQ *</label>
                <select name="faq_category_id" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Pertanyaan *</label>
                <input type="text" name="question" required placeholder="Contoh: Berapa lama pengerjaan pipa mampet?" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Jawaban Lengkap *</label>
                <textarea name="answer" required rows="4" placeholder="Tulis penjelasan mendalam..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="0" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-900">
                </div>

                <div class="space-y-2 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                        <input type="checkbox" name="is_featured_home" value="1" class="w-4 h-4 rounded text-emerald-600">
                        ⭐ Tampilkan di Beranda
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded text-emerald-600">
                        <span>Status FAQ Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-faq').classList.add('hidden'); document.getElementById('modal-add-faq').classList.remove('flex');" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Simpan FAQ</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit FAQ --}}
<div id="modal-edit-faq" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 class="text-base font-extrabold text-slate-900">Edit FAQ</h3>
            <button onclick="document.getElementById('modal-edit-faq').classList.add('hidden'); document.getElementById('modal-edit-faq').classList.remove('flex');" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form id="edit-faq-form" method="POST" class="space-y-4">
            @csrf @method('PUT')
            
            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Kategori FAQ *</label>
                <select name="faq_category_id" id="edit-category-id" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Pertanyaan *</label>
                <input type="text" name="question" id="edit-question" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Jawaban Lengkap *</label>
                <textarea name="answer" id="edit-answer" required rows="4" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Urutan Tampil</label>
                    <input type="number" name="sort_order" id="edit-sort-order" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-900">
                </div>

                <div class="space-y-2 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                        <input type="checkbox" name="is_featured_home" value="1" id="edit-is-featured" class="w-4 h-4 rounded text-emerald-600">
                        ⭐ Tampilkan di Beranda
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                        <input type="checkbox" name="is_active" value="1" id="edit-is-active" class="w-4 h-4 rounded text-emerald-600">
                        <span>Status FAQ Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-edit-faq').classList.add('hidden'); document.getElementById('modal-edit-faq').classList.remove('flex');" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Perbarui FAQ</button>
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
    
    const modal = document.getElementById('modal-edit-faq');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
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
}
</script>
@endpush
</div>
@endsection
