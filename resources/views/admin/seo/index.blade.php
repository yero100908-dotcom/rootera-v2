@extends('layouts.admin')
@section('title', 'SEO Central Dashboard')
@section('page-title', 'SEO Central &amp; Meta Tags Manager')

@section('admin-content')
<div class="mb-6">
    <p class="text-slate-500 text-xs sm:text-sm">Kelola seluruh metadata, Open Graph, dan indexability halaman utama Rootera secara terpusat untuk optimasi mesin pencari.</p>
</div>

{{-- Grid Layout: Editor Form & Live Google Preview --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    
    {{-- Left Column: Edit Form (7 Cols) --}}
    <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
        <h3 class="font-extrabold text-lg text-slate-900 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
            <span>✏️</span> Edit Metadata Halaman
        </h3>
        
        <form action="#" method="POST" id="seoEditForm" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label for="page_id" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Pilih Halaman / Route Target *</label>
                <select name="page_id" id="pageSelector" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-xs font-bold text-slate-800 transition-all">
                    <option value="" disabled selected>-- Pilih Halaman --</option>
                    @forelse($seoPages as $page)
                        <option value="{{ $page->id }}" 
                                data-name="{{ $page->page_name }}"
                                data-route="{{ $page->route_name }}"
                                data-title="{{ $page->meta_title }}"
                                data-desc="{{ $page->meta_description }}"
                                data-canonical="{{ $page->canonical_url }}"
                                data-indexable="{{ $page->is_indexable ? '1' : '0' }}">
                            {{ $page->page_name }} ({{ $page->route_name }})
                        </option>
                    @empty
                        <option value="" disabled>Belum ada data halaman terdaftar.</option>
                    @endforelse
                </select>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Meta Title SEO</label>
                <input type="text" id="metaTitleInput" name="meta_title" placeholder="Masukkan judul halaman..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-900 transition-all">
                <div class="flex justify-between items-center mt-2">
                    <span class="text-xs text-slate-400 font-mono" id="titleCharCount">0 / 60 Karakter</span>
                    <span class="text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600" id="titleStatusBadge">Ideal</span>
                </div>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Meta Description SEO</label>
                <textarea id="metaDescInput" name="meta_description" rows="4" placeholder="Tulis deskripsi ringkas..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-xs text-slate-800 transition-all leading-relaxed"></textarea>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-xs text-slate-400 font-mono" id="descCharCount">0 / 160 Karakter</span>
                    <span class="text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600" id="descStatusBadge">Ideal</span>
                </div>
            </div>

            <div>
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Canonical URL (Optional)</label>
                <input type="url" id="canonicalInput" name="canonical_url" placeholder="https://rooteraplumbing.id/..." class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-mono text-slate-700 transition-all">
            </div>

            <div class="pt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-extrabold text-slate-800">
                    <input type="checkbox" id="indexableCheckbox" name="is_indexable" value="1" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500">
                    <span>Indexable (Search Engine Crawl &amp; Index)</span>
                </label>
            </div>

            <div class="pt-4">
                <button type="submit" id="saveButton" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm py-3.5 px-6 rounded-xl shadow-md transition-all hover:shadow-emerald-600/20 flex items-center justify-center gap-2">
                    💾 Simpan Perubahan SEO Metadata
                </button>
            </div>
        </form>
    </div>

    {{-- Right Column: Live Google Snippet Preview (5 Cols) --}}
    <div class="lg:col-span-5 flex flex-col gap-6">
        
        {{-- Google Search Engine Simulator --}}
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <h3 class="font-extrabold text-base text-slate-900 mb-4 flex items-center gap-2 border-b border-slate-100 pb-3">
                <span>🔍</span> Google Snippet Live Preview
            </h3>
            
            <div class="border border-slate-200/80 rounded-2xl p-4 bg-slate-50/80">
                <div class="text-xs text-slate-800 mb-1 truncate flex items-center gap-1 font-mono">
                    <span>https://rooteraplumbing.id</span>
                    <span class="text-slate-400">›</span>
                    <span class="text-slate-500" id="previewRouteName">home</span>
                </div>
                <h4 class="text-lg text-blue-700 font-bold hover:underline cursor-pointer leading-snug mb-1" id="previewTitle">
                    Rootera – Jasa Pipa &amp; Saluran Mampet
                </h4>
                <p class="text-xs text-slate-600 leading-relaxed break-words" id="previewDesc">
                    Masukkan meta description untuk melihat tampilan simulasi cuplikan pencarian Google secara langsung di sini.
                </p>
            </div>
        </div>

        {{-- Help Card --}}
        <div class="bg-gradient-to-br from-slate-950 to-[#071739] text-white rounded-3xl p-6 shadow-md relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="font-extrabold text-base mb-2 text-emerald-400">💡 Tips Optimization Metadata</h4>
                <ul class="text-xs text-slate-300 space-y-2 list-disc pl-4 leading-relaxed">
                    <li><strong>Meta Title</strong> idealnya antara 50 - 60 karakter agar judul tidak terpotong (truncated) oleh Google.</li>
                    <li><strong>Meta Description</strong> idealnya maksimal 150 - 160 karakter dan menyertakan kata kunci wilayah serta Call to Action (CTA).</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pageSelector = document.getElementById('pageSelector');
    const metaTitleInput = document.getElementById('metaTitleInput');
    const metaDescInput = document.getElementById('metaDescInput');
    const canonicalInput = document.getElementById('canonicalInput');
    const indexableCheckbox = document.getElementById('indexableCheckbox');
    
    // Preview Elements
    const previewTitle = document.getElementById('previewTitle');
    const previewDesc = document.getElementById('previewDesc');
    const previewRouteName = document.getElementById('previewRouteName');
    
    // Status Elements
    const titleCharCount = document.getElementById('titleCharCount');
    const descCharCount = document.getElementById('descCharCount');
    const titleStatusBadge = document.getElementById('titleStatusBadge');
    const descStatusBadge = document.getElementById('descStatusBadge');
    const seoEditForm = document.getElementById('seoEditForm');

    pageSelector.addEventListener('change', function () {
        const option = this.options[this.selectedIndex];
        
        metaTitleInput.value = option.getAttribute('data-title') || '';
        metaDescInput.value = option.getAttribute('data-desc') || '';
        canonicalInput.value = option.getAttribute('data-canonical') || '';
        indexableCheckbox.checked = option.getAttribute('data-indexable') === '1';
        
        previewRouteName.textContent = option.getAttribute('data-route') || 'home';
        seoEditForm.action = `/admin/seo/${option.value}`;
        
        updateLivePreview();
    });

    metaTitleInput.addEventListener('input', updateLivePreview);
    metaDescInput.addEventListener('input', updateLivePreview);

    function updateLivePreview() {
        const titleVal = metaTitleInput.value || 'Rootera – Jasa Pipa & Saluran Mampet';
        const descVal = metaDescInput.value || 'Masukkan meta description untuk melihat tampilan simulasi cuplikan pencarian Google secara langsung di sini.';
        
        previewTitle.textContent = titleVal;
        previewDesc.textContent = descVal;
        
        const titleLen = metaTitleInput.value.length;
        const descLen = metaDescInput.value.length;
        
        titleCharCount.textContent = `${titleLen} / 60 Karakter`;
        descCharCount.textContent = `${descLen} / 160 Karakter`;
        
        if (titleLen === 0) {
            titleStatusBadge.textContent = 'Kosong';
            titleStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600';
        } else if (titleLen > 60) {
            titleStatusBadge.textContent = 'Terlalu Panjang';
            titleStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-700';
        } else if (titleLen >= 45) {
            titleStatusBadge.textContent = 'Ideal';
            titleStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800';
        } else {
            titleStatusBadge.textContent = 'Kurang Panjang';
            titleStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800';
        }

        if (descLen === 0) {
            descStatusBadge.textContent = 'Kosong';
            descStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600';
        } else if (descLen > 160) {
            descStatusBadge.textContent = 'Terlalu Panjang';
            descStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-700';
        } else if (descLen >= 110) {
            descStatusBadge.textContent = 'Ideal';
            descStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800';
        } else {
            descStatusBadge.textContent = 'Kurang Panjang';
            descStatusBadge.className = 'text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800';
        }
    }
});
</script>
@endsection
