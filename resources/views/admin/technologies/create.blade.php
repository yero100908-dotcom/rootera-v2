@extends('layouts.admin')
@section('title', 'Tambah Peralatan Baru')
@section('page-title', 'Tambah Peralatan & Armada Mesin')

@section('admin-content')
<div class="max-w-6xl mx-auto pb-12">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.technologies.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
            ← Kembali ke Daftar Peralatan
        </a>
    </div>

    <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data" id="techForm">
        @csrf

        {{-- Tab Navigation Bar --}}
        <div class="bg-white rounded-2xl p-2 border border-slate-200/80 shadow-xs mb-6 flex flex-wrap gap-2">
            <button type="button" onclick="switchTab('tab-basic', this)" class="js-tab-btn active bg-slate-900 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-xs">
                📌 1. Dasar &amp; Media
            </button>
            <button type="button" onclick="switchTab('tab-specs', this)" class="js-tab-btn bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition-all">
                ⚙️ 2. Spesifikasi Teknis
            </button>
            <button type="button" onclick="switchTab('tab-safety', this)" class="js-tab-btn bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition-all">
                🛡️ 3. Safety &amp; FAQ Builder
            </button>
            <button type="button" onclick="switchTab('tab-seo', this)" class="js-tab-btn bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl transition-all">
                🔍 4. SEO &amp; SERP Preview
            </button>
        </div>

        {{-- TAB 1: DASAR & MEDIA --}}
        <div id="tab-basic" class="js-tab-content space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                    <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">🛠️ Informasi Utama Alat</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Nama Alat / Mesin *</label>
                            <input type="text" name="tool_name" required value="{{ old('tool_name') }}" placeholder="Contoh: Mesin Rooter Ridgid K-50 & Cable Spiral" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                        </div>

                        <div>
                            <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Tipe &amp; Brand Resmi</label>
                            <input type="text" name="type_brand" value="{{ old('type_brand') }}" placeholder="Contoh: Ridgid K-50 / K-60 (USA)" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                        </div>

                        <div>
                            <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Badge Label</label>
                            <input type="text" name="badge_text" value="{{ old('badge_text', 'ALAT RESMI') }}" placeholder="ALAT RESMI" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-emerald-700">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Deskripsi Singkat</label>
                        <textarea name="description" rows="4" placeholder="Tuliskan keterangan ringkas cara kerja dan keandalan alat ini..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800 leading-relaxed">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Image Box --}}
                <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                    <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">Foto Alat (WebP Format)</h3>

                    <div class="w-full aspect-[4/3] bg-slate-950 rounded-2xl overflow-hidden border border-slate-200/80 relative group shadow-xs">
                        <img id="img-preview" src="{{ asset('images/JnJ.webp') }}" alt="Preview" class="w-full h-full object-cover">
                    </div>

                    <div>
                        <input type="file" name="image_path" accept="image/*" onchange="previewImage(this)" class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                        <p class="text-[11px] text-slate-400 mt-2 font-medium">Sistem otomatis mengompres foto ke format WebP ringan (&lt; 150 KB).</p>
                    </div>

                    <div class="border-t border-slate-100 pt-4 space-y-4">
                        <div>
                            <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1 block">Urutan Prioritas Tampil</label>
                            <input type="number" name="order_priority" value="{{ old('order_priority', 0) }}" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold text-slate-900">
                        </div>

                        <label class="flex items-center gap-2 cursor-pointer pt-1 text-xs font-extrabold text-slate-800">
                            <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500">
                            <span>Status Peralatan Aktif</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 2: SPESIFIKASI TEKNIS --}}
        <div id="tab-specs" class="js-tab-content hidden space-y-6">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">⚙️ Parameter Teknis &amp; Spesifikasi</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Spesifikasi Utama</label>
                        <input type="text" name="main_spec" value="{{ old('main_spec') }}" placeholder="Contoh: Kabel baja fleksibel 5/8', rotasi 400 RPM" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Target Pipa (Peruntukan Utama)</label>
                        <input type="text" name="pipe_target" value="{{ old('pipe_target') }}" placeholder="Contoh: Wastafel, floor drain, kloset, pipa 2-4 inci" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Keunggulan Utama</label>
                        <input type="text" name="main_advantage" value="{{ old('main_advantage') }}" placeholder="Contoh: Memotong akar &amp; rontokkan kerak lemak tanpa merusak pipa PVC" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>
                </div>

                {{-- Feature Highlight Cards --}}
                <div class="border-t border-slate-100 pt-5 space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Chips Fitur Highlight Card</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500">Fitur Highlight 1</span>
                            <input type="text" name="feature_1_value" value="{{ old('feature_1_value') }}" placeholder="Contoh: ⚡ Tanpa Bongkar Keramik" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800">
                        </div>

                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500">Fitur Highlight 2</span>
                            <input type="text" name="feature_2_value" value="{{ old('feature_2_value') }}" placeholder="Contoh: 🔄 Putaran High Torque" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 3: SAFETY & FAQ BUILDER --}}
        <div id="tab-safety" class="js-tab-content hidden space-y-6">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">🛡️ Penjelasan Jaminan Keamanan Pipa (Safety Guarantee)</h3>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Penjelasan Teknis Keamanan Alat bagi Pipa PVC / Cast Iron</label>
                    <textarea name="safety_guarantee_text" rows="4" placeholder="Jelaskan secara teknis mengapa alat mekanis ini 100% aman dan tidak merusak sambungan PVC atau semen rumah..." class="w-full bg-slate-50/50 border border-slate-200 rounded-xl p-3 text-xs text-slate-800 leading-relaxed">{{ old('safety_guarantee_text') }}</textarea>
                </div>

                {{-- Dynamic FAQ Builder --}}
                <div class="border-t border-slate-100 pt-5 space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Dynamic FAQ Builder (Khusus Alat Ini)</h4>
                        <button type="button" onclick="addFaqItem()" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-lg transition-colors border border-emerald-200">
                            + Tambah FAQ
                        </button>
                    </div>

                    <div id="faq-repeater-container" class="space-y-3">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-3 faq-item">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-slate-700">FAQ #1</span>
                                <button type="button" onclick="this.closest('.faq-item').remove()" class="text-xs text-rose-600 font-bold hover:underline">Hapus</button>
                            </div>
                            <input type="text" name="faqs[0][question]" placeholder="Pertanyaan (misal: Apakah kabel spiral berisiko merusak pipa?)" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-900">
                            <textarea name="faqs[0][answer]" rows="2" placeholder="Jawaban penjelasan teknis..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs text-slate-800"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 4: SEO META TAGS & SERP PREVIEW --}}
        <div id="tab-seo" class="js-tab-content hidden space-y-6">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">🔍 Pengaturan SEO &amp; Indexing Google</h3>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Custom Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title_input" oninput="updateSerpPreview()" value="{{ old('meta_title') }}" placeholder="Mesin Rooter Ridgid K-50 - Teknologi Pelancar Pipa Tanpa Bongkar | Rootera" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Custom Meta Description</label>
                    <textarea name="meta_description" id="meta_desc_input" oninput="updateSerpPreview()" rows="3" placeholder="Spesifikasi mesin Ridgid K-50 untuk pelancaran wastafel, floor drain, dan kloset mampet 24 jam bergaransi resmi tanpa bongkar keramik..." class="w-full bg-slate-50/50 border border-slate-200 rounded-xl p-3 text-xs text-slate-800 leading-relaxed">{{ old('meta_description') }}</textarea>
                </div>

                {{-- Live SERP Preview Container --}}
                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-2">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Pratinjau Hasil Pencarian Google (SERP Preview)</span>
                    <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-2xs space-y-1">
                        <div class="text-[12px] text-slate-600 truncate flex items-center gap-1">
                            <span class="text-slate-400">https://rooteraplumbing.id › peralatan-teknologi ›</span>
                            <span id="serp-slug" class="text-slate-600 font-medium">slug-alat</span>
                        </div>
                        <h4 id="serp-title" class="text-base text-blue-700 font-bold hover:underline cursor-pointer line-clamp-1">
                            Judul Alat - Teknologi Pelancar Pipa Tanpa Bongkar | Rootera Plumbing
                        </h4>
                        <p id="serp-desc" class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                            Deskripsi penawaran jasa dan spesifikasi teknis peralatan yang akan tampil di halaman pencarian Google...
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Floating Action Bar --}}
        <div class="mt-8 pt-6 border-t border-slate-200 flex justify-end">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm py-3.5 px-8 rounded-xl shadow-md transition-all hover:shadow-emerald-600/20">
                💾 Simpan Peralatan Baru
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
let faqCount = 1;

function switchTab(tabId, btn) {
    document.querySelectorAll('.js-tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.js-tab-btn').forEach(el => {
        el.classList.remove('bg-slate-900', 'text-white', 'active');
        el.classList.add('bg-slate-100', 'text-slate-700');
    });

    document.getElementById(tabId).classList.remove('hidden');
    btn.classList.add('bg-slate-900', 'text-white', 'active');
    btn.classList.remove('bg-slate-100', 'text-slate-700');
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('img-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addFaqItem() {
    const container = document.getElementById('faq-repeater-container');
    const div = document.createElement('div');
    div.className = 'p-4 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-3 faq-item';
    div.innerHTML = `
        <div class="flex justify-between items-center">
            <span class="text-xs font-bold text-slate-700">FAQ #${faqCount + 1}</span>
            <button type="button" onclick="this.closest('.faq-item').remove()" class="text-xs text-rose-600 font-bold hover:underline">Hapus</button>
        </div>
        <input type="text" name="faqs[${faqCount}][question]" placeholder="Pertanyaan FAQ..." class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-900">
        <textarea name="faqs[${faqCount}][answer]" rows="2" placeholder="Jawaban FAQ..." class="w-full bg-white border border-slate-200 rounded-xl p-3 text-xs text-slate-800"></textarea>
    `;
    container.appendChild(div);
    faqCount++;
}

function updateSerpPreview() {
    const titleVal = document.getElementById('meta_title_input').value || document.querySelector('input[name="tool_name"]').value || 'Judul Alat';
    const descVal = document.getElementById('meta_desc_input').value || document.querySelector('textarea[name="description"]').value || 'Deskripsi spesifikasi teknis peralatan...';
    
    document.getElementById('serp-title').textContent = titleVal;
    document.getElementById('serp-desc').textContent = descVal;
}
</script>
@endpush
