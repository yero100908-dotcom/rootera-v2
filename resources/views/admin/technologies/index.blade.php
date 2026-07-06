@extends('layouts.admin')
@section('title', 'Kelola Teknologi & Alat')
@section('page-title', 'Kelola Teknologi & Alat')

@section('admin-content')
<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Teknologi & Alat</h1>
            <p class="text-sm text-gray-500 mt-1">Atur peralatan modern yang digunakan ROOTERA</p>
        </div>
        <button onclick="document.getElementById('modal-add-tech').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition">
            + Tambah Alat/Teknologi
        </button>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tech Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600 w-16">Foto</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Nama Alat</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600 w-16">Urutan</th>
                    <th class="text-center px-6 py-3 font-semibold text-gray-600 w-24">Status</th>
                    <th class="text-center px-6 py-3 font-semibold text-gray-600 w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($technologies as $tech)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <img src="{{ $tech->image_url }}" alt="{{ $tech->tool_name }}" class="w-12 h-12 object-cover rounded-lg border">
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $tech->tool_name }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ Str::limit($tech->description, 80) }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-center">{{ $tech->sort_order }}</td>
                    <td class="px-6 py-4 text-center">
                        <button
                            onclick="toggleTech({{ $tech->id }}, this)"
                            data-active="{{ $tech->is_active ? '1' : '0' }}"
                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none
                                   {{ $tech->is_active ? 'bg-green-500' : 'bg-gray-300' }}">
                            <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform
                                         {{ $tech->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                        </button>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button
                                onclick='openEditTech({{ json_encode($tech) }})'
                                class="text-blue-500 hover:text-blue-700 font-medium text-xs px-2 py-1 rounded hover:bg-blue-50 transition">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.technologies.destroy', $tech) }}"
                                  onsubmit="return confirm('Hapus teknologi/alat ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 font-medium text-xs px-2 py-1 rounded hover:bg-red-50 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        Belum ada teknologi. Klik "+ Tambah Alat/Teknologi" untuk memulai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Tech --}}
<div id="modal-add-tech" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-6 border-b">
            <h2 class="text-lg font-bold text-gray-800">Tambah Alat/Teknologi</h2>
            <button onclick="document.getElementById('modal-add-tech').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.technologies.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Alat <span class="text-red-500">*</span></label>
                <input type="text" name="tool_name" required placeholder="Contoh: Rigid Sectional Machine" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Alat</label>
                <textarea name="description" rows="3" placeholder="Tulis deskripsi fungsi alat..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Alat</label>
                <input type="file" name="image_path" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                <input type="number" name="sort_order" value="0" class="w-24 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modal-add-tech').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Tech --}}
<div id="modal-edit-tech" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-6 border-b">
            <h2 class="text-lg font-bold text-gray-800">Edit Alat/Teknologi</h2>
            <button onclick="document.getElementById('modal-edit-tech').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
        </div>
        <form id="edit-tech-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Alat <span class="text-red-500">*</span></label>
                <input type="text" name="tool_name" id="edit-tool-name" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Alat</label>
                <textarea name="description" id="edit-description" rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Alat (Biarkan kosong jika tidak diganti)</label>
                <input type="file" name="image_path" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div class="flex items-center gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="sort_order" id="edit-sort-order" class="w-24 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Aktif</label>
                    <input type="checkbox" name="is_active" id="edit-is-active" value="1" class="w-4 h-4 rounded text-blue-600">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modal-edit-tech').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition">Perbarui</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openEditTech(tech) {
    document.getElementById('edit-tech-form').action = `/admin/technologies/${tech.id}`;
    document.getElementById('edit-tool-name').value = tech.tool_name;
    document.getElementById('edit-description').value = tech.description ?? '';
    document.getElementById('edit-sort-order').value = tech.sort_order;
    document.getElementById('edit-is-active').checked = tech.is_active == 1;
    document.getElementById('modal-edit-tech').classList.remove('hidden');
}

function toggleTech(id, btn) {
    fetch(`/admin/technologies/${id}/toggle`, {
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
