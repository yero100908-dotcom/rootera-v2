@extends('layouts.admin')
@section('title', $mode === 'create' ? 'Tambah Artikel' : 'Edit Artikel')
@section('page-title', $mode === 'create' ? 'Tambah Artikel Baru' : 'Edit Artikel')

@section('admin-content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div class="max-w-6xl mx-auto pb-12"
     x-data="{
         postType: '{{ old('post_type', $article->post_type ?? 'article') }}',
         status: '{{ old('status', $article->status ?? 'published') }}',
         metaTitle: '{{ addslashes(old('meta_title', $article->meta_title ?? '')) }}',
         metaDesc: '{{ addslashes(old('meta_description', $article->meta_description ?? '')) }}',
         imageUrl: '{{ $article->thumbnail ? Storage::url($article->thumbnail) : '' }}',
         isDragging: false,
         submitForm(targetStatus) {
             this.status = targetStatus;
             this.$nextTick(() => {
                 this.$refs.mainForm.submit();
             });
         },
         handleFile(event) {
             const file = event.target.files ? event.target.files[0] : (event.dataTransfer ? event.dataTransfer.files[0] : null);
             if (file && file.type.startsWith('image/')) {
                 const reader = new FileReader();
                 reader.onload = (e) => {
                     this.imageUrl = e.target.result;
                 };
                 reader.readAsDataURL(file);
             }
         }
     }">

    {{-- Top Back Navigation & Status Breadcrumb --}}
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.articles.index') }}" 
           class="inline-flex items-center gap-2 text-xs font-black text-slate-500 hover:text-slate-900 transition-colors bg-white px-4 py-2.5 rounded-2xl border border-slate-100 shadow-2xs text-decoration-none">
            <span>←</span>
            <span>Kembali ke Daftar Konten</span>
        </a>

        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-slate-400">Mode:</span>
            <span class="text-xs font-black px-3 py-1 rounded-full {{ $mode === 'create' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                {{ $mode === 'create' ? '✨ Konten Baru' : '📝 Mode Edit' }}
            </span>
        </div>
    </div>

    <form action="{{ $mode === 'create' ? route('admin.articles.store') : route('admin.articles.update', $article) }}" 
          method="POST" 
          enctype="multipart/form-data"
          x-ref="mainForm"
          id="articleAdminForm">
        @csrf
        @if($mode === 'edit') @method('PUT') @endif

        {{-- Hidden Status Controlled by Split Action Buttons --}}
        <input type="hidden" name="status" :value="status">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- Main Content Column (8 Cols) --}}
            <div class="lg:col-span-8 space-y-6">
                
                {{-- 1. Card: Informasi Utama Artikel --}}
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 sm:p-8">
                    <h3 class="font-black text-slate-900 text-base mb-6 border-b border-slate-100 pb-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-base">📄</span>
                            <span>Informasi Utama Artikel</span>
                        </div>
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Editor Utama</span>
                    </h3>

                    <div class="space-y-5">
                        {{-- Title --}}
                        <div>
                            <label for="title" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                Judul Artikel <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" 
                                   placeholder="Judul artikel yang menarik, informatif, dan SEO friendly..." required
                                   class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-900 transition-all">
                            @error('title')<span class="text-rose-500 text-xs mt-1.5 block font-bold">{{ $message }}</span>@enderror
                        </div>

                        {{-- Slug URL --}}
                        <div>
                            <label for="slug" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                Slug URL (Otomatis / Kustom)
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xs font-mono text-slate-400 select-none">/blog/</span>
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" 
                                       placeholder="cara-mengatasi-pipa-mampet-di-rumah"
                                       class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl pl-16 pr-4 py-3 text-xs font-mono text-slate-700 transition-all font-semibold">
                            </div>
                        </div>

                        {{-- Excerpt --}}
                        <div>
                            <label for="excerpt" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                Ringkasan / Excerpt (Pull-Quote Media)
                            </label>
                            <textarea id="excerpt" name="excerpt" rows="3" 
                                      placeholder="Ringkasan singkat artikel yang akan muncul di kartu daftar blog dan pull-quote editorial mewah..."
                                      class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl p-4 text-sm text-slate-800 transition-all leading-relaxed font-medium">{{ old('excerpt', $article->excerpt) }}</textarea>
                        </div>

                        {{-- Content --}}
                        <div>
                            <label for="content" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                Konten Lengkap Artikel (HTML / Teks) <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="content" name="content" rows="16" 
                                      placeholder="Tulis atau tempel konten HTML/Text artikel di sini..." required
                                      class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl p-4 text-sm font-mono text-slate-800 transition-all leading-relaxed">{{ old('content', $article->content) }}</textarea>
                            @error('content')<span class="text-rose-500 text-xs mt-1.5 block font-bold">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                {{-- 2. Card: Smart SEO Character Counter (Alpine.js) --}}
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 sm:p-8">
                    <h3 class="font-black text-slate-900 text-base mb-6 border-b border-slate-100 pb-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-base">🔍</span>
                            <span>Optimasi SEO Meta Tags</span>
                        </div>
                        <span class="text-[11px] font-bold text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-full">Google Search Ready</span>
                    </h3>

                    <div class="space-y-5">
                        {{-- Meta Title with Smart Counter --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="meta_title" class="text-xs font-black uppercase tracking-wider text-slate-700">Meta Title SEO</label>
                                <span class="text-xs font-bold font-mono px-2.5 py-0.5 rounded-lg transition-colors"
                                      :class="metaTitle.length > 60 ? 'bg-rose-100 text-rose-700 border border-rose-200 font-black' : (metaTitle.length >= 45 ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-slate-100 text-slate-600')">
                                    Title: <span x-text="metaTitle.length"></span>/60
                                </span>
                            </div>
                            <input type="text" id="meta_title" name="meta_title" x-model="metaTitle"
                                   placeholder="Judul SEO Google (Optimal 50-60 Karakter)"
                                   class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm font-semibold text-slate-900 transition-all">
                            
                            <p class="text-[11px] mt-1.5 transition-colors" :class="metaTitle.length > 60 ? 'text-rose-600 font-bold' : 'text-slate-400 font-medium'">
                                <span x-show="metaTitle.length <= 60">Panjang judul optimal agar tidak terpotong di hasil penelusuran desktop &amp; mobile Google.</span>
                                <span x-show="metaTitle.length > 60" x-cloak>⚠️ Melebihi 60 karakter! Judul berisiko terpotong (...) oleh algoritma Google SERP.</span>
                            </p>
                        </div>

                        {{-- Meta Description with Smart Counter --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="meta_description" class="text-xs font-black uppercase tracking-wider text-slate-700">Meta Description SEO</label>
                                <span class="text-xs font-bold font-mono px-2.5 py-0.5 rounded-lg transition-colors"
                                      :class="metaDesc.length > 160 ? 'bg-rose-100 text-rose-700 border border-rose-200 font-black' : (metaDesc.length >= 120 ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-slate-100 text-slate-600')">
                                    Desc: <span x-text="metaDesc.length"></span>/160
                                </span>
                            </div>
                            <textarea id="meta_description" name="meta_description" rows="3" x-model="metaDesc"
                                      placeholder="Deskripsi ringkas untuk snippet Google Search (Optimal 120-160 Karakter)"
                                      class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl p-4 text-sm text-slate-800 transition-all leading-relaxed font-medium"></textarea>
                            
                            <p class="text-[11px] mt-1.5 transition-colors" :class="metaDesc.length > 160 ? 'text-rose-600 font-bold' : 'text-slate-400 font-medium'">
                                <span x-show="metaDesc.length <= 160">Ringkasan penjelas yang tampil di bawah judul pada halaman SERP Google.</span>
                                <span x-show="metaDesc.length > 160" x-cloak>⚠️ Melebihi 160 karakter! Cuplikan deskripsi akan terpotong oleh Google.</span>
                            </p>
                        </div>

                        {{-- SEO Tags / Focus Keywords --}}
                        <div>
                            <label for="tags" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                SEO Tags / Kata Kunci Fokus (Opsional)
                            </label>
                            <input type="text" id="tags" name="tags" value="{{ old('tags', $article->tags) }}"
                                   placeholder="Contoh: pipa mampet jakarta, sedot wc, hydro jetting..."
                                   class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-sm font-semibold text-slate-900 transition-all">
                            <p class="text-[11px] text-slate-400 mt-1.5">
                                Pisahkan dengan tanda koma (,). Kata kunci ini akan ditampilkan sebagai pills tag topik di bawah artikel.
                            </p>
                            @error('tags')<span class="text-rose-500 text-xs mt-1 block font-bold">{{ $message }}</span>@enderror
                        </div>

                        {{-- Google SERP Live Simulation --}}
                        <div class="mt-4 p-4 rounded-2xl bg-slate-50/80 border border-slate-200/80">
                            <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-2">Pratinjau Snippet Google SERP</span>
                            <div class="flex items-center gap-2 mb-1.5">
                                <div class="w-4 h-4 rounded-full bg-slate-200 flex items-center justify-center text-[9px] font-black text-slate-600">G</div>
                                <span class="text-[11px] text-slate-500 font-mono truncate">{{ url('/blog') }}/...</span>
                            </div>
                            <div class="text-blue-700 font-bold text-sm hover:underline line-clamp-1 leading-snug cursor-pointer font-sans"
                                 x-text="metaTitle.length > 0 ? metaTitle : (document.getElementById('title')?.value || 'Judul Artikel SEO Friendly - Rootera Plumbing')"></div>
                            <div class="text-xs text-slate-600 line-clamp-2 mt-1 leading-relaxed font-sans"
                                 x-text="metaDesc.length > 0 ? metaDesc : (document.getElementById('excerpt')?.value || 'Deskripsi cuplikan Google Search yang relevan, informatif, dan mengundang klik dari pengunjung...')"></div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- 3. Sticky Sidebar & Split Actions Column (4 Cols) --}}
            <div class="lg:col-span-4 sticky top-6 space-y-6">
                
                {{-- Card: Pengaturan Portal Berita & Publishing --}}
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 sm:p-7">
                    <h3 class="font-black text-slate-900 text-sm mb-5 border-b border-slate-100 pb-3 flex items-center justify-between">
                        <span>Pengaturan Portal</span>
                        <span class="text-xs font-black px-2.5 py-0.5 rounded-full"
                              :class="status === 'published' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'">
                            <span x-text="status === 'published' ? '✅ Siap Terbit' : '⏸️ Mode Draft'"></span>
                        </span>
                    </h3>

                    <div class="space-y-4">
                        {{-- Category --}}
                        <div>
                            <label for="category" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                Pilar Kategori <span class="text-rose-500">*</span>
                            </label>
                            <select id="category" name="category" 
                                    class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-xs sm:text-sm font-bold text-slate-800 transition-all">
                                @foreach(\App\Models\Article::CATEGORIES as $catKey => $catLabel)
                                    <option value="{{ $catKey }}" {{ old('category', $article->category) === $catKey ? 'selected' : '' }}>
                                        📌 {{ $catKey }} ({{ $catLabel }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Post Type Selector --}}
                        <div>
                            <label for="post_type" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">
                                Tipe Postingan (Hub) <span class="text-rose-500">*</span>
                            </label>
                            <select id="post_type" name="post_type" x-model="postType" 
                                    class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-3 text-xs sm:text-sm font-bold text-slate-800 transition-all">
                                @foreach(\App\Models\Article::POST_TYPES as $typeKey => $typeLabel)
                                    <option value="{{ $typeKey }}" {{ old('post_type', $article->post_type ?? 'article') === $typeKey ? 'selected' : '' }}>
                                        @if($typeKey === 'article') 📄 {{ $typeLabel }}
                                        @elseif($typeKey === 'promo') 🏷️ {{ $typeLabel }}
                                        @elseif($typeKey === 'news') 📰 {{ $typeLabel }}
                                        @elseif($typeKey === 'case_study') 💼 {{ $typeLabel }}
                                        @elseif($typeKey === 'press_release') 📢 {{ $typeLabel }}
                                        @elseif($typeKey === 'video_guide') 🎥 {{ $typeLabel }}
                                        @else 📌 {{ $typeLabel }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('post_type')<span class="text-rose-500 text-xs mt-1 block font-bold">{{ $message }}</span>@enderror
                        </div>

                        {{-- Dynamic Field: Promo Khusus --}}
                        <div x-show="postType === 'promo'" x-transition x-cloak class="bg-rose-50/70 p-4 rounded-2xl border border-rose-200/90 space-y-2.5">
                            <div class="flex items-center justify-between">
                                <label for="promo_end_date" class="text-xs font-black uppercase tracking-wider text-rose-950 flex items-center gap-1">
                                    <span>🏷️ Deadline Promo</span>
                                    <span class="text-rose-600">*</span>
                                </label>
                                <span class="text-[10px] bg-rose-100 text-rose-800 font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">Countdown</span>
                            </div>
                            <input type="datetime-local" id="promo_end_date" name="promo_end_date" 
                                   value="{{ old('promo_end_date', $article->promo_end_date?->format('Y-m-d\TH:i')) }}"
                                   :required="postType === 'promo'"
                                   class="w-full bg-white border border-rose-200 focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 transition-all">
                            <p class="text-[11px] text-rose-800/90 leading-tight">
                                Wajib diisi untuk tipe promo. Menentukan tenggat berakhirnya masa diskon/penawaran khusus.
                            </p>
                            @error('promo_end_date')<span class="text-rose-600 text-xs mt-1 block font-bold">{{ $message }}</span>@enderror
                        </div>

                        {{-- Dynamic Field: Case Study B2B & Geo --}}
                        <div x-show="postType === 'case_study'" x-transition x-cloak class="bg-indigo-50/70 p-4 rounded-2xl border border-indigo-200/90 space-y-3">
                            <div class="flex items-center justify-between border-b border-indigo-100 pb-2">
                                <span class="text-xs font-black uppercase tracking-wider text-indigo-950">
                                    💼 Portofolio B2B &amp; Local SEO
                                </span>
                                <span class="text-[10px] bg-indigo-100 text-indigo-700 font-extrabold px-2 py-0.5 rounded-full uppercase">B2B Case</span>
                            </div>
                            <div>
                                <label for="client_name" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-1.5 block">
                                    Nama Klien / Perusahaan
                                </label>
                                <input type="text" id="client_name" name="client_name" 
                                       value="{{ old('client_name', $article->client_name) }}" 
                                       placeholder="Contoh: PT Mayora Indah Tbk"
                                       class="w-full bg-white border border-indigo-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 transition-all">
                            </div>
                            <div>
                                <label for="location_geo" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-1.5 block">
                                    Wilayah / Lokasi (Local SEO)
                                </label>
                                <input type="text" id="location_geo" name="location_geo" 
                                       value="{{ old('location_geo', $article->location_geo) }}" 
                                       placeholder="Contoh: Kawasan Industri Jababeka, Cikarang"
                                       class="w-full bg-white border border-indigo-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 transition-all">
                            </div>
                        </div>

                        {{-- Dynamic Field: Video YouTube --}}
                        <div x-show="postType === 'video_guide'" x-transition x-cloak class="bg-amber-50/60 p-4 rounded-2xl border border-amber-200/80 space-y-2">
                            <label for="youtube_video_id" class="text-xs font-black uppercase tracking-wider text-amber-900 block">
                                🎥 YouTube Video ID / Link URL
                            </label>
                            <input type="text" id="youtube_video_id" name="youtube_video_id" value="{{ old('youtube_video_id', $article->youtube_video_id) }}" placeholder="Contoh: dQw4w9WgXcQ atau link YouTube"
                                   class="w-full bg-white border border-amber-300 focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 rounded-xl px-4 py-2.5 text-xs font-mono font-bold text-slate-800 transition-all">
                            <p class="text-[11px] text-amber-800 leading-tight">
                                Masukkan 11 karakter ID video YouTube atau tempel URL video lengkap.
                            </p>
                        </div>

                        {{-- Portal Positions: Headline & Featured --}}
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/70 space-y-3">
                            <label class="text-xs font-black uppercase tracking-wider text-slate-700 block mb-1">Posisi Layout Portal Hero</label>
                            
                            <label class="flex items-center gap-3 cursor-pointer select-none">
                                <input type="checkbox" name="is_headline" value="1" {{ old('is_headline', $article->is_headline) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                                <div>
                                    <span class="text-xs font-extrabold text-slate-900 block">🔥 Headline Utama</span>
                                    <span class="text-[11px] text-slate-500 block">Tampil sebagai kartu hero besar di portal</span>
                                </div>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer select-none">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                                <div>
                                    <span class="text-xs font-extrabold text-slate-900 block">⚡ Side Headline / Unggulan</span>
                                    <span class="text-[11px] text-slate-500 block">Tampil di kolom highlight samping</span>
                                </div>
                            </label>
                        </div>

                        {{-- Author & Published At --}}
                        <div>
                            <label for="author" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">Penulis / E-E-A-T Signature</label>
                            <input type="text" id="author" name="author" value="{{ old('author', $article->author ?? 'Tim Rootera') }}"
                                   class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 transition-all">
                        </div>

                        <div>
                            <label for="published_at" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-2 block">Jadwal Terbit</label>
                            <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                                   class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 transition-all">
                        </div>

                        {{-- Split Action Buttons: Simpan Draft & Publikasikan --}}
                        <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                            <button type="button" 
                                    @click="submitForm('draft')"
                                    class="flex-1 py-3.5 px-3 rounded-2xl border border-slate-300 hover:bg-slate-100 active:scale-95 text-slate-700 font-extrabold text-xs transition-all text-center flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                                <span>⏸️</span>
                                <span>Simpan Draft</span>
                            </button>

                            <button type="button" 
                                    @click="submitForm('published')"
                                    class="flex-1 py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 active:scale-95 shadow-xl shadow-emerald-500/20 text-white font-black text-xs hover:-translate-y-0.5 transition-all text-center flex items-center justify-center gap-1.5 cursor-pointer">
                                <span>🚀</span>
                                <span>{{ $mode === 'create' ? 'Publikasikan' : 'Simpan Edit' }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- 4. Card: Drag & Drop Image Preview Dropzone --}}
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100/50 p-6 sm:p-7">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                        <h3 class="font-black text-slate-900 text-sm tracking-tight flex items-center gap-2">
                            <span>📸</span>
                            <span>Gambar Thumbnail</span>
                        </h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">WebP / JPG / PNG</span>
                    </div>

                    {{-- Dropzone Area with Live Drag & Drop Preview --}}
                    <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden transition-all duration-200 border-2 border-dashed flex flex-col items-center justify-center cursor-pointer group shadow-2xs"
                         :class="isDragging ? 'border-emerald-500 bg-emerald-50/50 scale-[0.99]' : 'border-slate-300 hover:border-emerald-500 bg-slate-50'"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; handleFile($event); $refs.fileInput.files = $event.dataTransfer.files"
                         @click="$refs.fileInput.click()">
                        
                        {{-- Preview If Image Exists --}}
                        <template x-if="imageUrl">
                            <div class="relative w-full h-full">
                                <img :src="imageUrl" alt="Thumbnail Preview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white p-3 gap-1.5 backdrop-blur-xs">
                                    <span class="text-2xl">🔄</span>
                                    <span class="text-xs font-black tracking-wide">Klik atau Tarik untuk Ganti Gambar</span>
                                </div>
                            </div>
                        </template>

                        {{-- Placeholder If Empty --}}
                        <template x-if="!imageUrl">
                            <div class="p-4 text-center flex flex-col items-center justify-center gap-2">
                                <div class="w-12 h-12 rounded-2xl bg-white shadow-sm border border-slate-200/80 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                                    🖼️
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800">
                                        <span class="text-emerald-600 underline">Klik unggah</span> atau seret file ke sini
                                    </p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Rasio 16:9 disarankan (Maksimal 5MB)</p>
                                </div>
                            </div>
                        </template>

                        {{-- Hidden Real File Input --}}
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" x-ref="fileInput" @change="handleFile($event)" class="hidden">
                    </div>

                    @error('thumbnail')<span class="text-rose-500 text-xs mt-2 block font-bold">{{ $message }}</span>@enderror

                    {{-- Image Alt Text (SEO) --}}
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <label for="thumbnail_alt" class="text-xs font-black uppercase tracking-wider text-slate-700 mb-1.5 block">
                            Alt Text Gambar (SEO)
                        </label>
                        <input type="text" id="thumbnail_alt" name="thumbnail_alt" value="{{ old('thumbnail_alt', $article->thumbnail_alt) }}"
                               placeholder="Contoh: Teknisi Rootera melakukan hydro jetting di pipa mampet Jakarta"
                               class="w-full bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-800 transition-all">
                        <p class="text-[11px] text-slate-400 mt-1.5 leading-tight">
                            Teks alternatif untuk mesin pencari Google Images. Masukkan kata kunci lokal/geo jika relevan.
                        </p>
                        @error('thumbnail_alt')<span class="text-rose-500 text-xs mt-1 block font-bold">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>
@endsection
