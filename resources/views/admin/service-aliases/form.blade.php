@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Service Alias' : 'Edit Alias')
@section('page-title', $mode === 'create' ? 'Tambah Service Alias' : 'Edit Alias: ' . $alias->keyword)

@php
    $input = 'w-full text-sm rounded-xl border border-slate-200 px-3 py-2.5 focus:ring-2 focus:ring-violet-500/30 focus:border-violet-500';
    $lbl   = 'block text-xs font-extrabold text-slate-600 uppercase tracking-wide mb-1.5';
@endphp

@section('admin-content')
<form method="POST" action="{{ $mode === 'create' ? route('admin.service-aliases.store') : route('admin.service-aliases.update', $alias) }}" class="grid lg:grid-cols-3 gap-6">
    @csrf
    @if($mode === 'edit') @method('PUT') @endif

    {{-- ── Main column ─────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-6">
        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Identitas Alias</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="{{ $lbl }}">Keyword *</label>
                    <input name="keyword" required value="{{ old('keyword', $alias->keyword) }}" class="{{ $input }}" placeholder="paralon mampet" autocomplete="off">
                    <p class="text-[11px] text-slate-400 mt-1">Huruf kecil semua. Slug otomatis dibuat dari keyword.</p>
                </div>
                <div>
                    <label class="{{ $lbl }}">Slug (opsional — diisi otomatis)</label>
                    <input name="slug" value="{{ old('slug', $alias->slug) }}" class="{{ $input }} font-mono" placeholder="otomatis dari keyword">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="{{ $lbl }}">Kategori Layanan *</label>
                    <select name="service_category_id" required class="{{ $input }}">
                        <option value="">— Pilih Kategori —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('service_category_id', $alias->service_category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="{{ $lbl }}">Volume Pencarian (est. / bulan)</label>
                    <input type="number" name="search_volume" min="0" value="{{ old('search_volume', $alias->search_volume) }}" class="{{ $input }}" placeholder="1500">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="{{ $lbl }}">Usage *</label>
                    <select name="usage" required class="{{ $input }}">
                        @foreach(\App\Models\ServiceAlias::USAGES as $u)
                            <option value="{{ $u }}" @selected(old('usage', $alias->usage) === $u)>{{ ucfirst(str_replace('_', ' ', $u)) }}</option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1"><strong>copy_only</strong>: hanya variasi teks. <strong>landing_page</strong>: punya URL tersendiri.</p>
                </div>
                <div>
                    <label class="{{ $lbl }}">Intent *</label>
                    <select name="intent" required class="{{ $input }}">
                        @foreach(\App\Models\ServiceAlias::INTENTS as $i)
                            <option value="{{ $i }}" @selected(old('intent', $alias->intent) === $i)>{{ ucfirst($i) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-4">
            <h3 class="font-extrabold text-slate-900">Konten Override <span class="text-xs font-semibold text-slate-400">(opsional — untuk landing_page)</span></h3>

            <div>
                <label class="{{ $lbl }}">Intro Override (≥ 80 kata disarankan)</label>
                <textarea name="intro_override" rows="6" class="{{ $input }}" id="intro_override">{{ old('intro_override', $alias->intro_override) }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Jumlah kata: <strong id="intro_wc">0</strong></p>
            </div>

            {{-- FAQ Overrides --}}
            <div>
                <label class="{{ $lbl }}">FAQ Override (maks. 10 item)</label>
                <div id="faq-list" class="space-y-3">
                    @php $faqItems = old('faq_overrides', $alias->faq_overrides ?? []); @endphp
                    @forelse($faqItems as $fIdx => $fItem)
                    <div class="faq-row grid md:grid-cols-2 gap-3 bg-slate-50/60 p-3 rounded-xl border border-slate-200">
                        <div>
                            <label class="{{ $lbl }}">Pertanyaan *</label>
                            <input name="faq_overrides[{{ $fIdx }}][question]" value="{{ $fItem['question'] ?? '' }}" class="{{ $input }}" required maxlength="200" placeholder="Berapa biaya {{ $alias->keyword ?? 'layanan' }} ini?">
                        </div>
                        <div>
                            <label class="{{ $lbl }}">Jawaban *</label>
                            <textarea name="faq_overrides[{{ $fIdx }}][answer]" class="{{ $input }}" rows="2" required maxlength="1000">{{ $fItem['answer'] ?? '' }}</textarea>
                        </div>
                    </div>
                    @empty
                    {{-- empty state handled by JS --}}
                    @endforelse
                </div>
                <button type="button" id="add-faq"
                    class="mt-3 text-xs font-bold text-violet-600 hover:text-violet-800 flex items-center gap-1">
                    + Tambah FAQ
                </button>
            </div>
        </section>
    </div>

    {{-- ── Sidebar column ──────────────────────────────────── --}}
    <div class="space-y-6">
        @if($mode === 'edit')
        <section class="bg-white rounded-3xl border border-slate-200/80 p-6">
            <p class="text-xs font-extrabold text-slate-500 uppercase mb-2">Info</p>
            <p class="text-xs text-slate-500 mt-1">Kategori: <strong>{{ $alias->serviceCategory?->name ?? '—' }}</strong></p>
            <p class="text-xs text-slate-500 mt-1">Dibuat: <strong>{{ $alias->created_at?->format('d M Y') }}</strong></p>
            <p class="text-xs text-slate-500 mt-1">Diperbarui: <strong>{{ $alias->updated_at?->format('d M Y H:i') }}</strong></p>
        </section>
        @endif

        <section class="bg-white rounded-3xl border border-slate-200/80 p-6 space-y-3">
            <h3 class="font-extrabold text-slate-900">Publikasi</h3>
            <label class="flex items-center gap-2 text-sm font-semibold">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $alias->is_active))>
                Aktif
            </label>
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
            <a href="{{ route('admin.service-aliases.index') }}" class="flex-1 text-center text-sm font-bold px-4 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50">Batal</a>
            <button type="submit" class="flex-1 text-sm font-bold px-4 py-3 rounded-xl bg-violet-600 text-white hover:bg-violet-700 shadow-md">Simpan</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    // Word count for intro_override
    const intro = document.getElementById('intro_override');
    const wc    = document.getElementById('intro_wc');
    if (intro && wc) {
        const count = () => { const t = intro.value.trim(); wc.textContent = t ? t.split(/\s+/).length : 0; };
        intro.addEventListener('input', count);
        count();
    }

    // FAQ repeater
    const faqList = document.getElementById('faq-list');
    const addFaq  = document.getElementById('add-faq');
    let faqIdx    = {{ count(old('faq_overrides', $alias->faq_overrides ?? [])) }};

    const inputCls  = @json('w-full text-sm rounded-xl border border-slate-200 px-3 py-2.5 focus:ring-2 focus:ring-violet-500/30 focus:border-violet-500');
    const lblCls    = @json('block text-xs font-extrabold text-slate-600 uppercase tracking-wide mb-1.5');

    addFaq.addEventListener('click', () => {
        const row = document.createElement('div');
        row.className = 'faq-row grid md:grid-cols-2 gap-3 bg-slate-50/60 p-3 rounded-xl border border-slate-200';
        row.innerHTML = `
            <div>
                <label class="${lblCls}">Pertanyaan *</label>
                <input name="faq_overrides[${faqIdx}][question]" class="${inputCls}" required maxlength="200" placeholder="Pertanyaan…">
            </div>
            <div>
                <label class="${lblCls}">Jawaban *</label>
                <textarea name="faq_overrides[${faqIdx}][answer]" class="${inputCls}" rows="2" required maxlength="1000" placeholder="Jawaban…"></textarea>
            </div>`;
        faqList.appendChild(row);
        faqIdx++;
    });
})();
</script>
@endpush
