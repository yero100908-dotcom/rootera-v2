@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Cluster' : 'Edit Cluster')
@section('page-title', $mode === 'create' ? 'Tambah Cluster Perumahan' : 'Edit: ' . $cluster->name)

@php
    $input = 'w-full text-sm rounded-xl border border-slate-200 px-3 py-2.5 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500';
    $lbl   = 'block text-xs font-extrabold text-slate-600 uppercase tracking-wide mb-1.5';
@endphp

@section('admin-content')
<form method="POST" action="{{ $mode === 'create' ? route('admin.clusters.store') : route('admin.clusters.update', $cluster) }}" class="grid lg:grid-cols-3 gap-6">
    @csrf
    @if($mode === 'edit') @method('PUT') @endif

    {{-- ── Main column ─────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-6">
        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Identitas Cluster</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div><label class="{{ $lbl }}">Nama Cluster *</label><input name="name" required value="{{ old('name', $cluster->name) }}" class="{{ $input }}" placeholder="Pantai Indah Kapuk"></div>
                <div><label class="{{ $lbl }}">Slug URL</label><input name="slug" value="{{ old('slug', $cluster->slug) }}" class="{{ $input }} font-mono" placeholder="otomatis dari nama"></div>
                <div><label class="{{ $lbl }}">Nama Pendek</label><input name="short_name" value="{{ old('short_name', $cluster->short_name) }}" class="{{ $input }}" placeholder="PIK"></div>
                <div><label class="{{ $lbl }}">Developer</label><input name="developer" value="{{ old('developer', $cluster->developer) }}" class="{{ $input }}" placeholder="Agung Sedayu Group"></div>
                <div>
                    <label class="{{ $lbl }}">Tier *</label>
                    <select name="tier" class="{{ $input }}">
                        @foreach(\App\Models\ResidentialCluster::TIERS as $t)
                            <option value="{{ $t }}" @selected(old('tier', $cluster->tier) === $t)>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label class="{{ $lbl }}">Tahun Dibangun</label><input type="number" name="built_year" value="{{ old('built_year', $cluster->built_year) }}" class="{{ $input }}"></div>
            </div>
            <div><label class="{{ $lbl }}">Profil Properti</label><input name="property_profile" value="{{ old('property_profile', $cluster->property_profile) }}" class="{{ $input }}" placeholder="Ruko kuliner + rumah 2-3 lantai, IPAL komunal"></div>
        </section>

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Data Lokal Unik <span class="text-xs font-semibold text-slate-400">(sumber skor konten)</span></h3>

            @include('admin.partials.repeater', [
                'name' => 'landmarks', 'label' => 'Landmark / Patokan', 'min' => 3,
                'items' => old('landmarks', $cluster->landmarks ?? []),
                'hint' => 'Mall, sekolah, RS, gerbang cluster — dipakai sebagai patokan rute teknisi.',
            ])

            @include('admin.partials.repeater', [
                'name' => 'typical_issues', 'label' => 'Masalah Pipa Khas Kawasan', 'min' => 2,
                'fields' => ['issue' => 'Masalah (mis. grease trap ruko penuh)', 'cause' => 'Penyebab', 'solution' => 'Solusi Rootera'],
                'items' => old('typical_issues', $cluster->typical_issues ?? []),
            ])

            @include('admin.partials.repeater', [
                'name' => 'sub_clusters', 'label' => 'Sub-Cluster',
                'items' => old('sub_clusters', $cluster->sub_clusters ?? []),
                'hint' => 'Contoh: Golf Island, Cluster Ebony, Sektor 9.',
            ])

            <div>
                <label class="{{ $lbl }}">Intro Manual (≥ 80 kata untuk +25 skor)</label>
                <textarea name="intro_override" rows="7" class="{{ $input }}" id="intro_override">{{ old('intro_override', $cluster->intro_override) }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Jumlah kata: <strong id="intro_wc">0</strong></p>
            </div>
        </section>

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">SEO Meta</h3>
            <div><label class="{{ $lbl }}">Meta Title (≤70)</label><input name="meta_title" maxlength="70" value="{{ old('meta_title', $cluster->meta_title) }}" class="{{ $input }}"></div>
            <div><label class="{{ $lbl }}">Meta Description (≤320)</label><textarea name="meta_description" maxlength="320" rows="3" class="{{ $input }}">{{ old('meta_description', $cluster->meta_description) }}</textarea></div>
        </section>
    </div>

    {{-- ── Sidebar column ──────────────────────────────────── --}}
    <div class="space-y-6">
        @if($mode === 'edit')
        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 text-center">
            <p class="text-xs font-extrabold text-slate-500 uppercase mb-2">Skor Konten</p>
            @include('admin.partials.score-badge', ['score' => $cluster->content_score, 'threshold' => $threshold])
            <p class="text-xs text-slate-500 mt-3">Bukti proyek terhubung: <strong>{{ $cluster->projectGalleries->where('is_active', true)->count() }}</strong></p>
            <a href="{{ route('admin.clusters.preview', $cluster) }}" target="_blank" class="inline-block mt-3 text-xs font-bold text-sky-600 hover:underline">Preview halaman publik ↗</a>
        </section>
        @endif

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Lokasi</h3>
            <div>
                <label class="{{ $lbl }}">Kota Utama *</label>
                <select name="city_id" id="city_id" required class="{{ $input }}">
                    <option value="">— Pilih Kota —</option>
                    @foreach($cities as $c)
                        <option value="{{ $c->id }}" @selected(old('city_id', $cluster->city_id) == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="{{ $lbl }}">Kecamatan Utama</label>
                <select name="district_id" id="district_id" class="{{ $input }}">
                    <option value="">— Opsional —</option>
                    @foreach($districts as $d)
                        <option value="{{ $d->id }}" @selected(old('district_id', $cluster->district_id) == $d->id)>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="{{ $lbl }}">Kecamatan Tercakup</label>
                <select name="district_ids[]" id="district_ids" multiple size="6" class="{{ $input }}">
                    @foreach($districts as $d)
                        <option value="{{ $d->id }}" @selected(in_array($d->id, (array) $selectedDistrictIds))>{{ $d->name }}</option>
                    @endforeach
                </select>
                <p class="text-[11px] text-slate-400 mt-1">Ctrl/Cmd + klik untuk memilih lebih dari satu.</p>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div><label class="{{ $lbl }}">Latitude</label><input name="latitude" value="{{ old('latitude', $cluster->latitude) }}" class="{{ $input }}"></div>
                <div><label class="{{ $lbl }}">Longitude</label><input name="longitude" value="{{ old('longitude', $cluster->longitude) }}" class="{{ $input }}"></div>
            </div>
            <div><label class="{{ $lbl }}">Estimasi Kedatangan *</label><input name="estimated_arrival" required value="{{ old('estimated_arrival', $cluster->estimated_arrival) }}" class="{{ $input }}"></div>
        </section>

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-3">
            <h3 class="font-extrabold text-slate-900">Publikasi</h3>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $cluster->is_active))> Aktif</label>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_indexable" value="1" @checked(old('is_indexable', $cluster->is_indexable))> Izinkan Index</label>
            <p class="text-[11px] text-slate-500">Index otomatis dimatikan jika skor &lt; {{ $threshold }}.</p>
            <div><label class="{{ $lbl }}">Urutan</label><input type="number" name="sort_order" value="{{ old('sort_order', $cluster->sort_order ?? 0) }}" class="{{ $input }}"></div>
        </section>

        <div class="flex gap-3">
            <a href="{{ route('admin.clusters.index') }}" class="flex-1 text-center text-sm font-bold px-4 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50">Batal</a>
            <button type="submit" class="flex-1 text-sm font-bold px-4 py-3 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 shadow-md">Simpan</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    const intro = document.getElementById('intro_override');
    const wc = document.getElementById('intro_wc');
    const count = () => { const t = intro.value.trim(); wc.textContent = t ? t.split(/\s+/).length : 0; };
    intro.addEventListener('input', count); count();

    const city = document.getElementById('city_id');
    const primary = document.getElementById('district_id');
    const multi = document.getElementById('district_ids');
    const base = @json(url('/admin/districts/by-city'));
    city.addEventListener('change', async () => {
        primary.innerHTML = '<option value="">— Opsional —</option>';
        multi.innerHTML = '';
        if (!city.value) return;
        const res = await fetch(base + '/' + city.value, { headers: { 'Accept': 'application/json' } });
        const rows = await res.json();
        rows.forEach(d => {
            primary.add(new Option(d.name, d.id));
            multi.add(new Option(d.name, d.id));
        });
    });
})();
</script>
@endpush
