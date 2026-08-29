@extends('layouts.admin')
@section('title','Kelola Kategori Layanan')
@section('page-title','Kategori Layanan')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m2 10 9 4-9 4"/><path d="m21 10-9 4 9 4"/><path d="m11 2 9 4-9 4-9-4 9-4z"/><path d="m11 22 9-4"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Daftar Kategori Layanan Utama</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-teal-600 font-bold">{{ count($categories) }}</strong> kategori terdaftar.</p>
            </div>
        </div>

        <button onclick="openModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Kategori Baru</span>
        </button>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Nama Kategori &amp; Deskripsi</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Slug URL</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($categories as $category)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 max-w-sm">
                        <strong class="text-sm font-extrabold text-slate-900 block">{{ $category->name }}</strong>
                        <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-mono text-slate-600 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/80">/layanan-pipa-mampet/{{ $category->slug }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($category->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200/80">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200/80">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" onclick="fillForm({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ $category->slug }}', '{{ addslashes($category->description) }}', {{ $category->sort_order }}, {{ $category->is_active ? 1 : 0 }}, '{{ addslashes($category->price_home) }}', '{{ addslashes($category->price_corporate) }}', '{{ addslashes($category->price_description) }}')" class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit Kategori">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.service-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Kategori">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada kategori layanan terdaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pop-up Modern -->
<div id="categoryModal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="modalContent" class="bg-white w-full max-w-xl rounded-3xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 flex flex-col max-h-[90vh]">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 id="form-title" class="font-extrabold text-slate-900 text-base">Tambah Kategori Layanan Baru</h3>
            <button type="button" onclick="closeModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <div class="p-6 overflow-y-auto space-y-4 flex-grow">
            <form id="cat-form" action="{{ route('admin.service-categories.store') }}" method="POST">
                @csrf
                <input type="hidden" id="form-method" name="_method" value="">

                <div>
                    <label for="cat-name" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Nama Kategori *</label>
                    <input type="text" id="cat-name" name="name" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-900">
                </div>

                <div>
                    <label for="cat-slug" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Slug URL</label>
                    <input type="text" id="cat-slug" name="slug" placeholder="Otomatis dari nama" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-mono text-slate-600">
                </div>

                <div>
                    <label for="cat-desc" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Deskripsi Layanan</label>
                    <textarea id="cat-desc" name="description" rows="3" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cat-price-home" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Harga Rumahan</label>
                        <input type="text" id="cat-price-home" name="price_home" placeholder="400.000" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-900">
                    </div>
                    <div>
                        <label for="cat-price-corporate" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Harga Gedung B2B</label>
                        <input type="text" id="cat-price-corporate" name="price_corporate" placeholder="600.000 - 1.000.000" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-900">
                    </div>
                </div>

                <div>
                    <label for="cat-price-desc" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Deskripsi Estimasi Biaya</label>
                    <textarea id="cat-price-desc" name="price_description" rows="2" placeholder="Harga menyesuaikan tingkat keparahan..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cat-order" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Urutan Tampil</label>
                        <input type="number" id="cat-order" name="sort_order" value="0" min="0" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-900">
                    </div>
                    <div id="active-group" class="hidden items-center pt-6">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                            <input type="checkbox" id="cat-active" name="is_active" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500">
                            <span>Status Kategori Aktif</span>
                        </label>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
            <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">Batal</button>
            <button type="submit" form="cat-form" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-600/20 transition-all">Simpan Kategori</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const modal = document.getElementById('categoryModal');
const modalContent = document.getElementById('modalContent');

function openModal() {
    document.getElementById('form-title').textContent = 'Tambah Kategori Layanan Baru';
    document.getElementById('cat-form').action = '{{ route("admin.service-categories.store") }}';
    document.getElementById('form-method').value = '';
    document.getElementById('cat-form').reset();
    document.getElementById('active-group').classList.add('hidden');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modalContent.classList.remove('scale-95');
    }, 10);
}

function closeModal() {
    modal.classList.add('opacity-0');
    modalContent.classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

function fillForm(id, name, slug, desc, order, active, priceHome, priceCorporate, priceDesc) {
    document.getElementById('form-title').textContent = 'Edit Kategori Layanan';
    document.getElementById('cat-form').action = '/admin/service-categories/' + id;
    document.getElementById('form-method').value = 'PUT';
    document.getElementById('cat-name').value = name;
    document.getElementById('cat-slug').value = slug;
    document.getElementById('cat-desc').value = desc;
    document.getElementById('cat-price-home').value = priceHome || '';
    document.getElementById('cat-price-corporate').value = priceCorporate || '';
    document.getElementById('cat-price-desc').value = priceDesc || '';
    document.getElementById('cat-order').value = order;
    document.getElementById('cat-active').checked = active;
    document.getElementById('active-group').classList.remove('hidden');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modalContent.classList.remove('scale-95');
    }, 10);
}

modal.addEventListener('click', function(e) {
    if (e.target === modal) closeModal();
});
</script>
@endpush
