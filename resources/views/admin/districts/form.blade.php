@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Kecamatan' : 'Edit Kecamatan')
@section('page-title', $mode === 'create' ? 'Tambah Kecamatan' : 'Edit: ' . $district->name)

@php
    $input = 'w-full text-sm rounded-xl border border-slate-200 px-3 py-2.5 focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500';
    $lbl   = 'block text-xs font-extrabold text-slate-600 uppercase tracking-wide mb-1.5';
@endphp

@section('admin-content')
<form method="POST" action="{{ $mode === 'create' ? route('admin.districts.store') : route('admin.districts.update', $district) }}" class="grid lg:grid-cols-3 gap-6">
    @csrf
    @if($mode === 'edit') @method('PUT') @endif

    {{-- ── Main column ─────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-6">
        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Identitas Kecamatan</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div><label class="{{ $lbl }}">Nama Kecamatan *</label><input name="name" required value="{{ old('name', $district->name) }}" class="{{ $input }}" placeholder="Penjaringan"></div>
                <div><label class="{{ $lbl }}">Slug URL</label><input name="slug" value="{{ old('slug', $district->slug) }}" class="{{ $input }} font-mono" placeholder="otomatis dari nama"></div>
                <div>
                    <label class="{{ $lbl }}">Kota *</label>
                    <select name="city_id" required class="{{ $input }}">
                        <option value="">— Pilih Kota —</option>
                        @foreach($cities as $c)
                            <option value="{{ $c->id }}" @selected(old('city_id', $district->city_id) == $c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div><label class="{{ $lbl }}">Kode Pos</label><input name="postal_code" value="{{ old('postal_code', $district->postal_code) }}" class="{{ $input }}" placeholder="14450" maxlength="10"></div>
                <div><label class="{{ $lbl }}">Estimasi Kedatangan *</label><input name="estimated_arrival" required value="{{ old('estimated_arrival', $district->estimated_arrival) }}" class="{{ $input }}" placeholder="20-35 Menit"></div>
                <div><label class="{{ $lbl }}">Profil Tanah / Air</label><input name="soil_water_profile" value="{{ old('soil_water_profile', $district->soil_water_profile) }}" class="{{ $input }}" placeholder="Tanah gambut, salinitas tinggi…"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div><label class="{{ $lbl }}">Latitude</label><input type="number" step="any" name="latitude" value="{{ old('latitude', $district->latitude) }}" class="{{ $input }}" placeholder="-6.1234"></div>
                <div><label class="{{ $lbl }}">Longitude</label><input type="number" step="any" name="longitude" value="{{ old('longitude', $district->longitude) }}" class="{{ $input }}" placeholder="106.9876"></div>
            </div>
        </section>

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Data Lokal Unik <span class="text-xs font-semibold text-slate-400">(sumber skor konten)</span></h3>

            @include('admin.partials.repeater', [
                'name'  => 'landmarks',
                'label' => 'Landmark / Patokan',
                'min'   => 3,
                'items' => old('landmarks', $district->landmarks ?? []),
                'hint'  => 'Mall, sekolah, RS, pasar — dipakai sebagai patokan rute teknisi.',
            ])

            @include('admin.partials.repeater', [
                'name'   => 'typical_issues',
                'label'  => 'Masalah Pipa Khas Kecamatan',
                'min'    => 2,
                'fields' => ['issue' => 'Masalah (mis. sedimentasi pipa tua)', 'cause' => 'Penyebab', 'solution' => 'Solusi Rootera'],
                'items'  => old('typical_issues', $district->typical_issues ?? []),
            ])

            <div>
                <label class="{{ $lbl }}">Intro Manual (≥ 80 kata untuk +25 skor)</label>
                <textarea name="intro_override" rows="7" class="{{ $input }}" id="intro_override">{{ old('intro_override', $district->intro_override) }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Jumlah kata: <strong id="intro_wc">0</strong></p>
            </div>
        </section>

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">SEO Meta</h3>
            <div><label class="{{ $lbl }}">Meta Title (≤70)</label><input name="meta_title" maxlength="70" value="{{ old('meta_title', $district->meta_title) }}" class="{{ $input }}"></div>
            <div><label class="{{ $lbl }}">Meta Description (≤320)</label><textarea name="meta_description" maxlength="320" rows="3" class="{{ $input }}">{{ old('meta_description', $district->meta_description) }}</textarea></div>
        </section>
    </div>

    {{-- ── Sidebar column ──────────────────────────────────── --}}
    <div class="space-y-6">
        @if($mode === 'edit')
        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 text-center">
            <p class="text-xs font-extrabold text-slate-500 uppercase mb-2">Skor Konten</p>
            @include('admin.partials.score-badge', ['score' => $district->content_score, 'threshold' => $threshold])
            <p class="text-xs text-slate-500 mt-3">
                Cluster terhubung: <strong>{{ $district->residentialClusters->count() }}</strong>
            </p>
        </section>
        @endif

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-3">
            <h3 class="font-extrabold text-slate-900">Publikasi</h3>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $district->is_active))> Aktif</label>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_indexable" value="1" @checked(old('is_indexable', $district->is_indexable))> Izinkan Index</label>
            <p class="text-[11px] text-slate-500">Index otomatis dimatikan jika skor &lt; {{ $threshold }}.</p>
            <div><label class="{{ $lbl }}">Urutan</label><input type="number" name="sort_order" value="{{ old('sort_order', $district->sort_order ?? 0) }}" class="{{ $input }}"></div>
        </section>

        @if($errors->any())
        <section class="bg-rose-50 rounded-3xl border border-rose-200 p-6">
            <h3 class="font-extrabold text-rose-700 mb-2">Error Validasi</h3>
            <ul class="text-xs text-rose-600 list-disc list-inside space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </section>
        @endif

        <div class="flex gap-3">
            <a href="{{ route('admin.districts.index') }}" class="flex-1 text-center text-sm font-bold px-4 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50">Batal</a>
            <button type="submit" class="flex-1 text-sm font-bold px-4 py-3 rounded-xl bg-sky-600 text-white hover:bg-sky-700 shadow-md">Simpan</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    const intro = document.getElementById('intro_override');
    const wc    = document.getElementById('intro_wc');
    if (intro && wc) {
        const count = () => { const t = intro.value.trim(); wc.textContent = t ? t.split(/\s+/).length : 0; };
        intro.addEventListener('input', count);
        count();
    }
})();
</script>
@endpush
