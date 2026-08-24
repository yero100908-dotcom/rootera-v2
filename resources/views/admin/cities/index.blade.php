@extends('layouts.admin')

@section('title', 'Kelola Kota & Wilayah SEO')
@section('page-title', 'Kota & Wilayah SEO Programmatic')

@section('admin-content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Daftar Kota & Wilayah Target</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola kota, kecamatan, nomor WhatsApp khusus area, dan estimasi waktu penanganan untuk SEO Lokal.</p>
        </div>
        <button onclick="openCreateCityModal()" class="px-5 py-2.5 bg-[#1FAF5A] text-white text-sm font-semibold rounded-xl hover:bg-[#19924b] transition flex items-center gap-2 shadow-md shadow-emerald-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Kota Baru
        </button>
    </div>

    <!-- Table Section -->
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Kota / Kabupaten</th>
                    <th>Provinsi</th>
                    <th>WhatsApp Area</th>
                    <th>Estimasi Tiba</th>
                    <th>Jumlah Kecamatan</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cities as $city)
                <tr>
                    <td>
                        <div class="font-bold text-slate-800">📍 {{ $city->full_name }}</div>
                        <div class="text-xs text-slate-400 font-mono mt-0.5">/layanan/{category}/{{ $city->slug }}</div>
                    </td>
                    <td>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $city->province->name ?? 'Indonesia' }}
                        </span>
                    </td>
                    <td class="text-sm font-mono text-emerald-700">
                        +{{ $city->whatsapp_number }}
                    </td>
                    <td class="text-sm text-slate-600">
                        ⏱️ {{ $city->estimated_arrival }}
                    </td>
                    <td>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                            {{ $city->districts->count() }} Kecamatan
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div class="inline-flex items-center gap-2">
                            <button onclick="openDistrictsModal({{ json_encode($city) }}, {{ json_encode($city->districts) }})" class="btn-sm btn-view">
                                🏙️ Kelola Kecamatan
                            </button>
                            <button onclick="openEditCityModal({{ json_encode($city) }})" class="btn-sm btn-edit">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kota ini beserta seluruh kecamatannya?')" class="inline">
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
                    <td colspan="6" class="text-center py-8 text-slate-400">
                        Belum ada data kota. Klik tombol "Tambah Kota Baru" di atas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-slate-100">
            {{ $cities->links() }}
        </div>
    </div>

</div>

<!-- Modal City Create / Edit -->
<div id="cityModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 id="cityModalTitle" class="text-lg font-bold text-slate-800">Tambah Kota Target Baru</h3>
            <button onclick="closeCityModal()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">✕</button>
        </div>

        <form id="cityForm" action="{{ route('admin.cities.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="cityFormMethod" name="_method" value="POST">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Provinsi *</label>
                <select id="cityProvince" name="province_id" required class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                    @foreach($provinces as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Tipe Wilayah *</label>
                    <select id="cityType" name="type" required class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                        <option value="Kota">Kota</option>
                        <option value="Kabupaten">Kabupaten</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Kota/Kab *</label>
                    <input type="text" id="cityName" name="name" required placeholder="Misal: Jakarta Selatan" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">WhatsApp Area</label>
                    <input type="text" id="cityWA" name="whatsapp_number" placeholder="6281385404000" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Estimasi Tiba Teknisi</label>
                    <input type="text" id="cityArrival" name="estimated_arrival" placeholder="25-40 Menit" class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeCityModal()" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-semibold text-sm hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#1FAF5A] text-white font-semibold text-sm hover:bg-[#19924b] shadow-md shadow-emerald-500/10">
                    Simpan Kota
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Districts Manager -->
<div id="districtsModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 id="districtsModalTitle" class="text-lg font-bold text-slate-800">Kelola Kecamatan</h3>
            <button onclick="closeDistrictsModal()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">✕</button>
        </div>

        <form id="addDistrictForm" action="" method="POST" class="mb-6 flex gap-2">
            @csrf
            <input type="text" name="name" required placeholder="Tambah kecamatan baru..." class="flex-1 rounded-xl border border-slate-300 p-2.5 text-sm focus:ring-2 focus:ring-[#1FAF5A] focus:outline-none">
            <button type="submit" class="px-4 py-2.5 bg-[#1FAF5A] text-white font-semibold text-sm rounded-xl hover:bg-[#19924b]">
                + Tambah
            </button>
        </form>

        <div class="max-h-64 overflow-y-auto border border-slate-100 rounded-xl p-3 bg-slate-50">
            <div id="districtsList" class="flex flex-wrap gap-2">
                <!-- Javascript populated -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openCreateCityModal() {
        document.getElementById('cityModalTitle').innerText = 'Tambah Kota Target Baru';
        document.getElementById('cityForm').action = "{{ route('admin.cities.store') }}";
        document.getElementById('cityFormMethod').value = 'POST';
        document.getElementById('cityName').value = '';
        document.getElementById('cityType').value = 'Kota';
        document.getElementById('cityWA').value = '6281385404000';
        document.getElementById('cityArrival').value = '25-40 Menit';

        document.getElementById('cityModal').classList.remove('hidden');
        document.getElementById('cityModal').classList.add('flex');
    }

    function openEditCityModal(city) {
        document.getElementById('cityModalTitle').innerText = 'Edit Data Kota';
        document.getElementById('cityForm').action = "/admin/cities/" + city.id;
        document.getElementById('cityFormMethod').value = 'PUT';
        document.getElementById('cityProvince').value = city.province_id || '';
        document.getElementById('cityName').value = city.name || '';
        document.getElementById('cityType').value = city.type || 'Kota';
        document.getElementById('cityWA').value = city.whatsapp_number || '6281385404000';
        document.getElementById('cityArrival').value = city.estimated_arrival || '25-40 Menit';

        document.getElementById('cityModal').classList.remove('hidden');
        document.getElementById('cityModal').classList.add('flex');
    }

    function closeCityModal() {
        document.getElementById('cityModal').classList.add('hidden');
        document.getElementById('cityModal').classList.remove('flex');
    }

    function openDistrictsModal(city, districts) {
        document.getElementById('districtsModalTitle').innerText = 'Kecamatan di ' + city.name;
        document.getElementById('addDistrictForm').action = "/admin/cities/" + city.id + "/districts";
        
        const container = document.getElementById('districtsList');
        container.innerHTML = '';

        if (!districts || districts.length === 0) {
            container.innerHTML = '<span class="text-xs text-slate-400 p-2">Belum ada kecamatan registered.</span>';
        } else {
            districts.forEach(d => {
                const tag = document.createElement('div');
                tag.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-700 shadow-sm';
                tag.innerHTML = `
                    <span>📍 ${d.name}</span>
                    <form action="/admin/districts/${d.id}" method="POST" onsubmit="return confirm('Hapus kecamatan ini?')" style="display:inline;">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" style="background:none;border:none;color:#e53e3e;cursor:pointer;font-size:0.9rem;margin-left:4px;">✕</button>
                    </form>
                `;
                container.appendChild(tag);
            });
        }

        document.getElementById('districtsModal').classList.remove('hidden');
        document.getElementById('districtsModal').classList.add('flex');
    }

    function closeDistrictsModal() {
        document.getElementById('districtsModal').classList.add('hidden');
        document.getElementById('districtsModal').classList.remove('flex');
    }
</script>
@endpush
@endsection
