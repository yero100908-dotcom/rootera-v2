@extends('layouts.admin')
@section('title', 'Kelola Kota & Wilayah SEO')
@section('page-title', 'Kota &amp; Wilayah SEO Programmatic')

@section('admin-content')
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    {{-- Header Action Bar --}}
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 border border-cyan-100 flex items-center justify-center font-bold text-lg shadow-xs shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">Daftar Kota &amp; Kecamatan Programmatic SEO</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total <strong class="text-cyan-600 font-bold">{{ $cities->total() }}</strong> kota target terdaftar.</p>
            </div>
        </div>

        <button onclick="openCreateCityModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md hover:shadow-emerald-600/20 flex items-center gap-2">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span>Tambah Kota Baru</span>
        </button>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200/80">
                <tr>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Kota / Kabupaten</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Provinsi</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">WhatsApp Area</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5">Estimasi Tiba</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-center">Kecamatan</th>
                    <th class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider px-6 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($cities as $city)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <strong class="text-sm font-extrabold text-slate-900 block">📍 {{ $city->full_name }}</strong>
                        <span class="text-xs font-mono text-slate-400 mt-0.5 block">/layanan-pipa-mampet/{cat}/{{ $city->slug }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $city->province->name ?? 'Indonesia' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs font-mono font-bold text-emerald-700">
                        +{{ $city->whatsapp_number }}
                    </td>
                    <td class="px-6 py-4 text-xs font-semibold text-slate-600">
                        ⏱️ {{ $city->estimated_arrival }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200/80">
                            {{ $city->districts->count() }} Kecamatan
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openDistrictsModal({{ json_encode($city) }}, {{ json_encode($city->districts) }})" class="p-2 rounded-xl text-blue-600 hover:bg-blue-50 border border-slate-200/80 transition-all hover:scale-105" title="Kelola Kecamatan">
                                🏙️
                            </button>
                            <button onclick="openEditCityModal({{ json_encode($city) }})" class="p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 border border-slate-200/80 transition-all hover:scale-105" title="Edit Kota">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" onsubmit="return confirm('Hapus kota ini beserta seluruh kecamatannya?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-slate-200/80 transition-all hover:scale-105" title="Hapus Kota">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium">
                        Belum ada kota terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($cities->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $cities->links() }}
    </div>
    @endif
</div>

<!-- Modal City Create / Edit -->
<div id="cityModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 backdrop-blur-xs p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 id="cityModalTitle" class="text-base font-extrabold text-slate-900">Tambah Kota Target Baru</h3>
            <button onclick="closeCityModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form id="cityForm" action="{{ route('admin.cities.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="cityFormMethod" name="_method" value="POST">

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Provinsi *</label>
                <select id="cityProvince" name="province_id" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                    @foreach($provinces as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Tipe Wilayah *</label>
                    <select id="cityType" name="type" required class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800">
                        <option value="Kota">Kota</option>
                        <option value="Kabupaten">Kabupaten</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Nama Kota/Kab *</label>
                    <input type="text" id="cityName" name="name" required placeholder="Jakarta Selatan" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">WhatsApp Area</label>
                    <input type="text" id="cityWA" name="whatsapp_number" placeholder="6281385404000" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-mono text-slate-800">
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Estimasi Tiba Teknisi</label>
                    <input type="text" id="cityArrival" name="estimated_arrival" placeholder="25-40 Menit" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-800">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeCityModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">Batal</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-600/20 transition-all">Simpan Kota</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Districts Manager -->
<div id="districtsModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 backdrop-blur-xs p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 shadow-2xl relative border border-slate-100 my-8">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-4">
            <h3 id="districtsModalTitle" class="text-base font-extrabold text-slate-900">Kelola Kecamatan</h3>
            <button onclick="closeDistrictsModal()" class="w-8 h-8 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors">&times;</button>
        </div>

        <form id="addDistrictForm" action="" method="POST" class="mb-6 flex gap-2">
            @csrf
            <input type="text" name="name" required placeholder="Tambah kecamatan baru..." class="flex-1 bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
            <button type="submit" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">
                + Tambah
            </button>
        </form>

        <div class="max-h-64 overflow-y-auto border border-slate-100 rounded-2xl p-4 bg-slate-50">
            <div id="districtsList" class="flex flex-wrap gap-2">
                <!-- JavaScript populated -->
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
        document.getElementById('cityModalTitle').innerText = 'Edit Data Kota Target';
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
            container.innerHTML = '<span class="text-xs text-slate-400 font-medium p-2">Belum ada kecamatan terdaftar.</span>';
        } else {
            districts.forEach(d => {
                const tag = document.createElement('div');
                tag.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-800 shadow-xs';
                tag.innerHTML = `
                    <span>📍 ${d.name}</span>
                    <form action="/admin/districts/${d.id}" method="POST" onsubmit="return confirm('Hapus kecamatan ini?')" style="display:inline;">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" style="background:none;border:none;color:#e11d48;cursor:pointer;font-size:0.9rem;margin-left:4px;">✕</button>
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
