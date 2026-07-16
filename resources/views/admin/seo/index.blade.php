@extends('layouts.admin')
@section('title', 'SEO Central Dashboard')
@section('page-title', 'SEO Central Settings')

@section('admin-content')
<div style="margin-bottom: 2rem;">
    <p class="text-slate-500 text-sm">Kelola seluruh metadata, Open Graph, dan indexability halaman utama Rooterin secara terpusat untuk optimasi mesin pencari.</p>
</div>

{{-- Grid Layout: Editor Form & Live Google Preview --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    
    {{-- Left Column: Edit Form (7 Cols) --}}
    <div class="lg:col-span-7 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <h3 class="font-semibold text-lg text-slate-800 mb-5 flex items-center gap-2">
            <span>✏️</span> Edit Metadata Halaman
        </h3>
        
        <form action="#" method="POST" id="seoEditForm">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-4">
                <label for="page_id" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Halaman / Route</label>
                <select name="page_id" id="pageSelector" class="w-full rounded-lg border border-slate-300 p-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1FAF5A] focus:border-[#1FAF5A]">
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

            <div class="form-group mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Title</label>
                <input type="text" id="metaTitleInput" name="meta_title" placeholder="Masukkan judul halaman..." class="w-full rounded-lg border border-slate-300 p-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1FAF5A] focus:border-[#1FAF5A]">
                <div class="flex justify-between items-center mt-2">
                    <span class="text-xs text-slate-500" id="titleCharCount">0 / 60 Karakter</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full" id="titleStatusBadge">Ideal</span>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Meta Description</label>
                <textarea id="metaDescInput" name="meta_description" rows="4" placeholder="Tulis deskripsi ringkas..." class="w-full rounded-lg border border-slate-300 p-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1FAF5A] focus:border-[#1FAF5A]"></textarea>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-xs text-slate-500" id="descCharCount">0 / 160 Karakter</span>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full" id="descStatusBadge">Ideal</span>
                </div>
            </div>

            <div class="form-group mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Canonical URL (Optional)</label>
                <input type="url" id="canonicalInput" name="canonical_url" placeholder="https://rootera.id/..." class="w-full rounded-lg border border-slate-300 p-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1FAF5A] focus:border-[#1FAF5A]">
            </div>

            <div class="flex items-center gap-6 mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="indexableCheckbox" name="is_indexable" value="1" checked class="w-4 h-4 rounded text-[#1FAF5A] focus:ring-[#1FAF5A] border-slate-300">
                    <span class="text-sm font-medium text-slate-700">Indexable (Search Engine Crawl)</span>
                </label>
            </div>

            <button type="submit" id="saveButton" class="btn btn-primary w-full py-3 rounded-lg font-semibold flex items-center justify-center gap-2" style="background-color: var(--primary);">
                💾 Simpan Perubahan SEO
            </button>
        </form>
    </div>

    {{-- Right Column: Live Google Snippet Preview (5 Cols) --}}
    <div class="lg:col-span-5 flex flex-col gap-6">
        
        {{-- Google Search Engine Simulator --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
            <h3 class="font-semibold text-base text-slate-800 mb-4 flex items-center gap-2">
                <span>🔍</span> Google Snippet Live Preview
            </h3>
            
            <div class="border border-slate-100 rounded-xl p-4 bg-slate-50">
                <div class="text-xs text-[#202124] mb-1 truncate flex items-center gap-1">
                    <span>https://rootera.id</span>
                    <span class="text-slate-400">›</span>
                    <span class="text-slate-500" id="previewRouteName">home</span>
                </div>
                <h4 class="text-xl text-[#1a0dab] font-medium hover:underline cursor-pointer leading-snug mb-1" id="previewTitle">
                    ROOTERA – Jasa Pipa &amp; Saluran Mampet
                </h4>
                <p class="text-sm text-[#4d5156] leading-relaxed break-words" id="previewDesc">
                    Silakan masukkan meta description untuk melihat tampilan simulasi cuplikan pencarian Google di sini secara langsung.
                </p>
            </div>
        </div>

        {{-- Help Card --}}
        <div class="bg-[#0F2A44] text-white rounded-2xl p-6 shadow-sm relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="font-semibold text-lg mb-2">Tips Metadata SEO</h4>
                <ul class="text-sm text-slate-300 space-y-2 list-disc pl-4">
                    <li><strong>Meta Title</strong> idealnya berdurasi antara 50 - 60 karakter agar tidak terpotong (truncate) oleh Google.</li>
                    <li><strong>Meta Description</strong> idealnya maksimal 150 - 160 karakter dan harus menyertakan kata kunci strategis serta Call to Action (CTA).</li>
                </ul>
            </div>
            <div class="absolute -right-8 -bottom-8 opacity-10 text-9xl">💡</div>
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

    // Trigger update on page selection
    pageSelector.addEventListener('change', function () {
        const option = this.options[this.selectedIndex];
        
        metaTitleInput.value = option.getAttribute('data-title') || '';
        metaDescInput.value = option.getAttribute('data-desc') || '';
        canonicalInput.value = option.getAttribute('data-canonical') || '';
        indexableCheckbox.checked = option.getAttribute('data-indexable') === '1';
        
        // Update URL/Route Preview
        previewRouteName.textContent = option.getAttribute('data-route') || 'home';
        
        // Update action URL dynamically
        seoEditForm.action = `/admin/seo/${option.value}`;
        
        updateLivePreview();
    });

    // Event listeners for real-time preview
    metaTitleInput.addEventListener('input', updateLivePreview);
    metaDescInput.addEventListener('input', updateLivePreview);

    function updateLivePreview() {
        const titleVal = metaTitleInput.value || 'ROOTERA – Jasa Pipa & Saluran Mampet';
        const descVal = metaDescInput.value || 'Silakan masukkan meta description untuk melihat tampilan simulasi cuplikan pencarian Google di sini secara langsung.';
        
        // Live Preview Render
        previewTitle.textContent = titleVal;
        previewDesc.textContent = descVal;
        
        // Character Counting & Badges
        const titleLen = metaTitleInput.value.length;
        const descLen = metaDescInput.value.length;
        
        titleCharCount.textContent = `${titleLen} / 60 Karakter`;
        descCharCount.textContent = `${descLen} / 160 Karakter`;
        
        // Title Status
        if (titleLen === 0) {
            titleStatusBadge.textContent = 'Kosong';
            titleStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600';
        } else if (titleLen > 60) {
            titleStatusBadge.textContent = 'Terlalu Panjang';
            titleStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-600';
        } else if (titleLen >= 45) {
            titleStatusBadge.textContent = 'Ideal';
            titleStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-green-100 text-green-600';
        } else {
            titleStatusBadge.textContent = 'Kurang Panjang';
            titleStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-600';
        }

        // Description Status
        if (descLen === 0) {
            descStatusBadge.textContent = 'Kosong';
            descStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600';
        } else if (descLen > 160) {
            descStatusBadge.textContent = 'Terlalu Panjang';
            descStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-600';
        } else if (descLen >= 110) {
            descStatusBadge.textContent = 'Ideal';
            descStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-green-100 text-green-600';
        } else {
            descStatusBadge.textContent = 'Kurang Panjang';
            descStatusBadge.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-600';
        }
    }
});
</script>
@endsection
