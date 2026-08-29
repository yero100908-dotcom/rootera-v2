@extends('layouts.admin')
@section('title', 'Kelola Portofolio Proyek')
@section('page-title', 'Portofolio &amp; Dokumentasi Proyek B2B')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><polyline points="11 3 11 11 14 8 17 11 17 3"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Portofolio Pekerjaan Nyata Lapangan</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-emerald-600 font-bold">{{ $projects->total() }}</strong> proyek terdokumentasi.</p>
            </div>
        </div>

        <button onclick="openCreateModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Proyek Baru</span>
        </button>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Judul Proyek</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kategori</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Wilayah Kota</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Jenis Klien</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Status</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($projects as $proj)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 max-w-sm">
                        <strong class="text-sm font-extrabold text-slate-900 block truncate">{{ $proj->title }}</strong>
                        <span class="text-xs text-slate-400 font-mono block mt-0.5">Alt: {{ $proj->image_alt }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $proj->serviceCategory->name ?? 'Umum' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs font-bold text-slate-800">
                            📍 {{ $proj->city->name ?? 'Nasional' }}
                        </div>
                        @if($proj->district)
                        <div class="text-[11px] text-slate-400">Kec. {{ $proj->district->name }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                            {{ $proj->client_type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.project-galleries.toggle', $proj->id) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="px-3 py-1 rounded-full text-xs font-bold transition-all {{ $proj->is_active ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-rose-100 text-rose-800 border border-rose-200' }}">
                                {{ $proj->is_active ? 'Aktif' : 'Draft' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openEditModal({{ json_encode($proj) }})" class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit Proyek">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.project-galleries.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Hapus proyek ini secara permanen?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Proyek">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada portofolio proyek terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($projects->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $projects->links() }}
    </div>
    @endif
</div>

<!-- Modal Form Create / Edit -->
<div id="projectModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 backdrop-blur-xs p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 id="modalTitle" class="text-base font-extrabold text-slate-900">Tambah Portofolio Proyek Baru</h3>
            <button onclick="closeModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form id="projectForm" action="{{ route('admin.project-galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Judul Proyek *</label>
                <input type="text" id="projectTitle" name="title" required placeholder="Misal: Pembersihan Saluran Wastafel Restoran Berlemak" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Kategori Layanan</label>
                    <select id="projectCategory" name="service_category_id" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Jenis Klien *</label>
                    <select id="projectClientType" name="client_type" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                        <option value="Rumah Tangga">Rumah Tangga</option>
                        <option value="Restoran/Cafe">Restoran/Cafe</option>
                        <option value="Ruko">Ruko</option>
                        <option value="Pabrik/Industri">Pabrik/Industri</option>
                        <option value="Hotel/Apartemen">Hotel/Apartemen</option>
                        <option value="Instansi">Instansi</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Kota Target</label>
                    <select id="projectCity" name="city_id" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                        <option value="">-- Nasional / Pilih Kota --</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Estimasi Waktu Pengerjaan</label>
                    <input type="text" id="projectCompletionTime" name="completion_time" placeholder="Misal: 1-2 Jam" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                </div>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Deskripsi Pengerjaan</label>
                <textarea id="projectDescription" name="description" rows="3" placeholder="Tuliskan ringkasan proses pelancaran..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Foto Hasil (After Image)</label>
                    <input type="file" name="after_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Foto Sebelum (Before Image)</label>
                    <input type="file" name="before_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-600/20 transition-all">Simpan Proyek</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Portofolio Proyek Baru';
        document.getElementById('projectForm').action = "{{ route('admin.project-galleries.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('projectTitle').value = '';
        document.getElementById('projectCategory').value = '';
        document.getElementById('projectClientType').value = 'Rumah Tangga';
        document.getElementById('projectCity').value = '';
        document.getElementById('projectCompletionTime').value = '1-2 Jam';
        document.getElementById('projectDescription').value = '';
        
        document.getElementById('projectModal').classList.remove('hidden');
        document.getElementById('projectModal').classList.add('flex');
    }

    function openEditModal(project) {
        document.getElementById('modalTitle').innerText = 'Edit Portofolio Proyek';
        document.getElementById('projectForm').action = "/admin/project-galleries/" + project.id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('projectTitle').value = project.title || '';
        document.getElementById('projectCategory').value = project.service_category_id || '';
        document.getElementById('projectClientType').value = project.client_type || 'Rumah Tangga';
        document.getElementById('projectCity').value = project.city_id || '';
        document.getElementById('projectCompletionTime').value = project.completion_time || '';
        document.getElementById('projectDescription').value = project.description || '';

        document.getElementById('projectModal').classList.remove('hidden');
        document.getElementById('projectModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('projectModal').classList.add('hidden');
        document.getElementById('projectModal').classList.remove('flex');
    }
</script>
@endpush
@endsection
