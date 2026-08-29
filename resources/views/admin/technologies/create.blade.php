@extends('layouts.admin')
@section('title', 'Tambah Peralatan Baru')
@section('page-title', 'Tambah Peralatan & Armada Mesin')

@section('admin-content')
<div class="max-w-5xl mx-auto pb-12">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.technologies.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
            ← Kembali ke Daftar Peralatan
        </a>
    </div>

    <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            {{-- Left Column: Information & Specifications (8 Cols) --}}
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
                <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    🛠️ Data Utama & Spesifikasi Mesin
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Nama Alat / Mesin *</label>
                        <input type="text" name="tool_name" required value="{{ old('tool_name') }}" placeholder="Contoh: Mesin Spiral Cable Ridgid K-50" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Tipe &amp; Brand Resmi</label>
                        <input type="text" name="type_brand" value="{{ old('type_brand') }}" placeholder="Contoh: Ridgid K-50 / K-60 (USA)" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Label Badge Card</label>
                        <input type="text" name="badge_text" value="{{ old('badge_text', 'ALAT RESMI') }}" placeholder="ALAT RESMI" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-bold text-emerald-700">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Spesifikasi Teknis Utama</label>
                    <input type="text" name="main_spec" value="{{ old('main_spec') }}" placeholder="Contoh: Kabel baja fleksibel 5/8', rotasi 400 RPM" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Peruntukan Utama (Target Pipa)</label>
                        <input type="text" name="pipe_target" value="{{ old('pipe_target') }}" placeholder="Contoh: Wastafel, floor drain, pipa 2-4 inci" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>

                    <div>
                        <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Keunggulan Utama</label>
                        <input type="text" name="main_advantage" value="{{ old('main_advantage') }}" placeholder="Contoh: Memotong akar &amp; lemak tanpa merusak PVC" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-900">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5 block">Deskripsi Penjelasan Lengkap</label>
                    <textarea name="description" rows="4" placeholder="Tuliskan keterangan detail cara kerja dan keandalan alat ini..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800 leading-relaxed">{{ old('description') }}</textarea>
                </div>

                {{-- Feature Chips Specs --}}
                <div class="border-t border-slate-100 pt-4 space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-700">Chips Fitur Ringkas Highlight Card</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500">Fitur Highlight 1</span>
                            <input type="text" name="feature_1_value" value="{{ old('feature_1_value') }}" placeholder="Contoh: ⚡ Tanpa Bongkar Keramik" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800">
                        </div>

                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200/80 space-y-2">
                            <span class="text-[11px] font-bold text-slate-500">Fitur Highlight 2</span>
                            <input type="text" name="feature_2_value" value="{{ old('feature_2_value') }}" placeholder="Contoh: 🔄 Putaran High Torque" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Image Upload & Actions (4 Cols) --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
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

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm py-3.5 px-6 rounded-xl shadow-md transition-all hover:shadow-emerald-600/20">
                            💾 Simpan Peralatan Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('img-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
