@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Artikel' : 'Edit Artikel')
@section('page-title', $mode === 'create' ? 'Tambah Artikel Baru' : 'Edit Artikel')

@section('admin-content')
<div class="max-w-6xl mx-auto pb-12">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">
            ← Kembali ke Daftar Artikel
        </a>
    </div>

    <form action="{{ $mode === 'create' ? route('admin.articles.store') : route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            {{-- Main Content Column (8 Cols) --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
                    <h3 class="font-extrabold text-slate-900 text-base mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Informasi Utama Artikel
                    </h3>

                    <div class="space-y-5">
                        <div>
                            <label for="title" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Judul Artikel <span class="text-rose-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" placeholder="Judul artikel yang menarik dan SEO friendly..." required
                                   class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-3 text-sm font-semibold text-slate-900 transition-all">
                            @error('title')<span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="slug" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Slug URL (Otatis / Kustom)</label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" placeholder="contoh: cara-mengatasi-pipa-mampet-di-rumah"
                                   class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs font-mono text-slate-600 transition-all">
                        </div>

                        <div>
                            <label for="excerpt" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Ringkasan / Excerpt</label>
                            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Ringkasan singkat artikel yang akan muncul di kartu daftar blog..."
                                      class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-4 text-sm text-slate-800 transition-all leading-relaxed">{{ old('excerpt', $article->excerpt) }}</textarea>
                        </div>

                        <div>
                            <label for="content" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Konten Lengkap Artikel <span class="text-rose-500">*</span></label>
                            <textarea id="content" name="content" rows="14" placeholder="Tulis atau tempel konten HTML/Text artikel di sini..." required
                                      class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-4 text-sm font-mono text-slate-800 transition-all leading-relaxed">{{ old('content', $article->content) }}</textarea>
                            @error('content')<span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                {{-- SEO Meta Section --}}
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
                    <h3 class="font-extrabold text-slate-900 text-base mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        Optimasi SEO Meta Tags
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Meta Title SEO</label>
                            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}" placeholder="Judul SEO Google (Max 60 Karakter)"
                                   class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm text-slate-900 transition-all">
                        </div>

                        <div>
                            <label for="meta_description" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Meta Description SEO</label>
                            <textarea id="meta_description" name="meta_description" rows="3" placeholder="Deskripsi ringkas untuk snippet Google Search (Max 160 Karakter)"
                                      class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl p-3 text-sm text-slate-800 transition-all leading-relaxed">{{ old('meta_description', $article->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Column (4 Cols) --}}
            <div class="lg:col-span-4 space-y-6">
                {{-- Publish & Portal Media Settings Card --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                    <h3 class="font-extrabold text-slate-900 text-base mb-5 border-b border-slate-100 pb-3 flex items-center justify-between">
                        <span>Pengaturan Portal Berita</span>
                        <span class="text-xs text-emerald-600 font-extrabold bg-emerald-50 px-2 py-0.5 rounded">Rootera News</span>
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <label for="category" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Pilar Kategori Industri <span class="text-rose-500">*</span></label>
                            <select id="category" name="category" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 transition-all">
                                @foreach(\App\Models\Article::CATEGORIES as $catKey => $catLabel)
                                    <option value="{{ $catKey }}" {{ old('category', $article->category) === $catKey ? 'selected' : '' }}>
                                        📌 {{ $catKey }} ({{ $catLabel }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="status" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Status Artikel</label>
                            <select id="status" name="status" class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 transition-all">
                                <option value="published" {{ old('status',$article->status) === 'published' ? 'selected':'' }}>✅ Terbitkan Langsung</option>
                                <option value="draft" {{ old('status',$article->status) === 'draft' ? 'selected':'' }}>⏸️ Simpan Sebagai Draft</option>
                            </select>
                        </div>

                        {{-- Portal Media Positions: Headline & Featured Toggles --}}
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-200/80 space-y-3">
                            <label class="text-xs font-extrabold uppercase tracking-wider text-slate-700 block mb-1">Posisi Layout Hero Portal</label>
                            
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_headline" value="1" {{ old('is_headline', $article->is_headline) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                                <div>
                                    <span class="text-xs font-bold text-slate-900 block">🔥 Set Bagian Headline Utama (60%)</span>
                                    <span class="text-[0.7rem] text-slate-500 block">Akan muncul sebagai kartu besar di hero utama blog</span>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                                <div>
                                    <span class="text-xs font-bold text-slate-900 block">⚡ Set Side Headline / Unggulan (40%)</span>
                                    <span class="text-[0.7rem] text-slate-500 block">Akan muncul di kolom side highlight hero</span>
                                </div>
                            </label>
                        </div>

                        <div>
                            <label for="read_time" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Estimasi Waktu Baca (Menit)</label>
                            <input type="number" id="read_time" name="read_time" min="1" max="300" value="{{ old('read_time', $article->read_time) }}" placeholder="Kosongkan untuk auto-kalkulasi dari total kata"
                                   class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-800 transition-all">
                        </div>

                        <div>
                            <label for="published_at" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Waktu Terbit</label>
                            <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                                   class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-slate-800 transition-all">
                        </div>

                        <div>
                            <label for="author" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Penulis</label>
                            <input type="text" id="author" name="author" value="{{ old('author', $article->author ?? 'Tim Rootera') }}"
                                   class="w-full bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-sm text-slate-800 transition-all">
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm py-3.5 px-6 rounded-xl shadow-md transition-all hover:shadow-emerald-600/30">
                                {{ $mode === 'create' ? '💾 Simpan &amp; Terbitkan' : '🔄 Perbarui Artikel' }}
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Image Thumbnail Card with Instant Live Preview --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                    <h3 class="font-extrabold text-slate-900 text-base mb-4 border-b border-slate-100 pb-3">Gambar Thumbnail</h3>
                    
                    <div class="mb-4">
                        <div id="previewContainer" class="w-full aspect-[16/10] bg-slate-100 rounded-2xl overflow-hidden border border-slate-200/80 relative flex items-center justify-center">
                            @if($article->thumbnail)
                                <img id="thumbnailPreview" src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail" class="w-full h-full object-cover">
                            @else
                                <img id="thumbnailPreview" src="" alt="Thumbnail Preview" class="w-full h-full object-cover hidden">
                                <span id="placeholderText" class="text-xs text-slate-400 font-bold flex flex-col items-center gap-1">
                                    📸 Belum Ada Gambar
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label for="thumbnail" class="text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-2 block">Pilih File Baru</label>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(this)"
                               class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('thumbnailPreview');
    const placeholder = document.getElementById('placeholderText');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
