@extends('layouts.admin')

@section('title', 'Kelola Portofolio Proyek')
@section('page-title', 'Portofolio & Galeri Proyek')

@section('admin-content')
<div class="space-y-6">

    <!-- Header Actions & Stat Summary -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Portofolio Pekerjaan Nyata</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola dokumentasi pengerjaan proyek Before/After di berbagai kota untuk mendongkrak reputasi & Image SEO.</p>
        </div>
        <button onclick="openCreateModal()" class="px-5 py-2.5 bg-[#1FAF5A] text-white text-sm font-semibold rounded-xl hover:bg-[#19924b] transition flex items-center gap-2 shadow-md shadow-emerald-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Proyek Baru
        </button>
    </div>

    <!-- Table Section -->
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Judul Proyek</th>
                    <th>Kategori Layanan</th>
                    <th>Wilayah (Kota / Kec)</th>
                    <th>Jenis Klien</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $proj)
                <tr>
                    <td>
                        <div class="font-bold text-slate-800">{{ $proj->title }}</div>
                        <div class="text-xs text-slate-400 mt-0.5 font-mono">Alt: {{ $proj->image_alt }}</div>
                    </td>
                    <td>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $proj->serviceCategory->name ?? 'Umum' }}
                        </span>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-slate-700">
                            📍 {{ $proj->city->name ?? 'Nasional' }}
                        </div>
                        @if($proj->district)
                        <div class="text-xs text-slate-400">Kec. {{ $proj->district->name }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            {{ $proj->client_type }}
                        </span>
                    </td>
                    <td class="text-slate-600 text-sm">
                        ⏱️ {{ $proj->completion_time }}
                    </td>
                    <td>
                        <form action="{{ route('admin.project-galleries.toggle', $proj->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-3 py-1 rounded-full text-xs font-semibold transition {{ $proj->is_active ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 hover:bg-rose-200' }}">
                                {{ $proj->is_active ? 'Aktif' : 'Draft' }}
                            </button>
                        </form>
                    </td>
                    <td style="text-align: right;">
                        <div class="inline-flex items-center gap-2">
                            <button onclick="openEditModal({{ json_encode($proj) }})" class="btn-sm btn-edit">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('admin.project-galleries.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm btn-del">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-slate-400">
                        Belum ada portofolio proyek. Klik tombol "Tambah Proyek Baru" di atas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-slate-100">
            {{ $projects->links() }}
        </div>
    </div>

</div>

<!-- Modal Form Create / Edit -->
<div id="projectModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 id="modalTitle" class="text-lg font-bold text-slate-800">Tambah Portofolio Proyek Baru</h3>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">✕</button>
        </div>

        <form id="projectForm" action="{{ route('admin.project-galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Judul Proyek *</label>
                <input type="text" id="projectTitle" name="title" required placeholder="Misal: Pembersihan Saluran Wastafel Restoran Berlemak" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kategori Layanan</label>
                    <select id="projectCategory" name="service_category_id" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Jenis Klien *</label>
                    <select id="projectClientType" name="client_type" required class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
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
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kota Target</label>
                    <select id="projectCity" name="city_id" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                        <option value="">-- Nasional / Pilih Kota --</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Estimasi Waktu Pengerjaan</label>
                    <input type="text" id="projectCompletionTime" name="completion_time" placeholder="Misal: 1-2 Jam" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Deskripsi Pengerjaan</label>
                <textarea id="projectDescription" name="description" rows="3" placeholder="Tuliskan ringkasan proses pelancaran atau masalah pipa..." class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Foto Hasil (After Image)</label>
                    <input type="file" name="after_image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Foto Sebelum (Before Image)</label>
                    <input type="file" name="before_image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-semibold text-sm hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#1FAF5A] text-white font-semibold text-sm hover:bg-[#19924b] shadow-md shadow-emerald-500/10">
                    Simpan Proyek
                </button>
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
