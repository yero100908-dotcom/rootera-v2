@extends('layouts.app')

@section('schema-markup')
<?php
$webAppSchema = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => "WebApplication",
            "@id" => $canonical . "#webapp",
            "url" => $canonical,
            "name" => "Alat Diagnosa Pipa & Saluran Mampet - Rootera Plumbing",
            "applicationCategory" => "UtilitiesApplication",
            "operatingSystem" => "All",
            "browserRequirements" => "Requires JavaScript",
            "description" => "Alat interaktif mandiri untuk mendiagnosa tingkat keparahan sumbatan pipa air dan saluran mampet secara gratis dan akurat.",
            "provider" => [
                "@type" => ["LocalBusiness", "Plumber"],
                "@id" => url('/') . "#organization",
                "name" => "Rootera Plumbing",
                "url" => url('/'),
                "telephone" => "+6281385404000",
                "priceRange" => "$$",
                "image" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => "Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung",
                    "addressLocality" => "Jakarta Timur",
                    "addressRegion" => "DKI Jakarta",
                    "postalCode" => "13770",
                    "addressCountry" => "ID"
                ]
            ]
        ],
        [
            "@type" => "FAQPage",
            "@id" => $canonical . "#faq",
            "mainEntity" => array_map(function ($faq) {
                return [
                    "@type" => "Question",
                    "name" => $faq['question'],
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => $faq['answer']
                    ]
                ];
            }, $faqs)
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($webAppSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- HERO SECTION & DIAGNOSTIC CONTAINER --}}
<section class="relative bg-gradient-to-b from-slate-950 via-[#07132b] to-slate-900 text-white pt-12 pb-20 px-4 sm:px-6 lg:px-8 border-b-4 border-emerald-500 overflow-hidden">
    {{-- Decorative Background Circles --}}
    <div class="absolute inset-0 pointer-events-none opacity-20">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-emerald-500 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl"></div>
    </div>

    <div class="max-w-4xl mx-auto text-center relative z-10">
        
        {{-- Breadcrumbs --}}
        <div class="flex justify-center mb-4">
            <x-breadcrumbs :items="[
                ['name' => 'Beranda', 'url' => url('/')],
                ['name' => 'Cek Kondisi Pipa', 'url' => '']
            ]" />
        </div>

        <span class="inline-flex items-center gap-2 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider mb-4 backdrop-blur-md">
            🧪 DIAGNOSA MANDIRI PIPAMAMPET — 100% GRATIS &amp; HASIL INSTAN
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4 font-['Plus_Jakarta_Sans',sans-serif] tracking-tight">
            Alat Diagnosa Interaktif <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-300 bg-clip-text text-transparent">Kondisi Pipa &amp; Saluran Mampet</span>
        </h1>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mb-8 leading-relaxed">
            Identifikasi penyebab pasti sumbatan, persentase penyempitan saluran, estimasi perbandingan biaya kerugian, dan metode penanganan tanpa bongkar dari <strong>Rootera Plumbing</strong>.
        </p>

        {{-- INTERACTIVE QUIZ WIDGET (ALPINE.JS STATE MACHINE) --}}
        <div x-data="{
            step: 1,
            selectedQ1: null,
            selectedQ2: null,
            selectedQ3: null,
            selectedQ4: null,
            selectedCity: 'Jakarta Selatan',
            activeFaqCategory: 'all',
            
            cities: [
                'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Pusat', 'Jakarta Utara',
                'Tangerang Kota', 'Tangsel / BSD', 'Bekasi', 'Depok', 'Bogor', 'Semarang', 'Lampung', 'Kota Lainnya'
            ],

            get totalScore() {
                let score = 0;
                if (this.selectedQ1 === 'wastafel') score += 2;
                else if (this.selectedQ1 === 'floordrain') score += 1;
                else if (this.selectedQ1 === 'kloset') score += 3;
                else if (this.selectedQ1 === 'talang') score += 2;
                else if (this.selectedQ1 === 'greasetrap') score += 3;
                else if (this.selectedQ1 === 'got') score += 3;

                if (this.selectedQ2 === 'lambat') score += 1;
                else if (this.selectedQ2 === 'mampet') score += 2;
                else if (this.selectedQ2 === 'meluap') score += 3;

                if (this.selectedQ3 === 'gluk') score += 2;
                else if (this.selectedQ3 === 'bau') score += 2;
                else if (this.selectedQ3 === 'soda') score += 3;
                else if (this.selectedQ3 === 'standar') score += 1;

                if (this.selectedQ4 === 'baru') score += 1;
                else if (this.selectedQ4 === 'kumat') score += 2;
                else if (this.selectedQ4 === 'parah') score += 3;

                return score;
            },

            get severityCategory() {
                let s = this.totalScore;
                if (s <= 4) return 'low';
                if (s <= 8) return 'medium';
                return 'high';
            },

            get severityPercent() {
                let s = this.totalScore;
                if (s <= 4) return 35;
                if (s <= 8) return 70;
                return 95;
            },

            get selectedQ1Label() {
                let map = {
                    'wastafel': 'Wastafel Dapur (Kitchen Sink)',
                    'floordrain': 'Floor Drain Kamar Mandi',
                    'kloset': 'Kloset / WC Toilet',
                    'talang': 'Pipa Talang Air Hujan Rooftop',
                    'greasetrap': 'Grease Trap Restoran / Kafe (B2B)',
                    'got': 'Pipa Utama & Bak Kontrol Luar'
                };
                return map[this.selectedQ1] || 'Saluran Air';
            },

            get waUrl() {
                let phone = '6281385404000';
                let area = this.selectedCity;
                let locMap = { 
                    'wastafel': 'Wastafel Dapur (Kitchen Sink)', 
                    'floordrain': 'Floor Drain Kamar Mandi', 
                    'kloset': 'Kloset Toilet (WC)', 
                    'talang': 'Pipa Talang Air Hujan',
                    'greasetrap': 'Grease Trap Restoran/Kafe (B2B)',
                    'got': 'Pipa Utama & Bak Kontrol Luar' 
                };
                let symMap = { 'lambat': 'Lambat Mengalir', 'mampet': 'Mampet Total', 'meluap': 'Air Meluap Balik' };
                let durMap = { 'baru': 'Baru Hari Ini', 'kumat': '2-7 Hari', 'parah': '>1 Minggu' };
                let score = this.totalScore;

                let loc = locMap[this.selectedQ1] || 'Saluran Air';
                let sym = symMap[this.selectedQ2] || 'Mampet';
                let dur = durMap[this.selectedQ4] || 'Baru';
                let catName = this.severityCategory === 'low' ? '🟢 RINGAN' : (this.severityCategory === 'medium' ? '🟡 SEDANG' : '🔴 PARAH/DARURAT');

                let text = `Halo Rootera Plumbing, saya sudah cek di Alat Diagnosa Online.\n\n- Hasil Diagnosa: ${catName} (Skor ${score}/12)\n- Titik Masalah: ${loc}\n- Gejala: ${sym}\n- Durasi: ${dur}\n- Wilayah Properti: ${area}\n\nMohon jadwal inspeksi teknisi terdekat dan estimasi biayanya?`;

                return 'https://wa.me/' + phone + '?text=' + encodeURIComponent(text);
            },

            resetQuiz() {
                this.step = 1;
                this.selectedQ1 = null;
                this.selectedQ2 = null;
                this.selectedQ3 = null;
                this.selectedQ4 = null;
                this.selectedCity = 'Jakarta Selatan';
            }
        }" class="bg-white rounded-3xl p-5 sm:p-8 text-slate-800 text-left shadow-2xl border border-slate-200/90 relative overflow-hidden">
            
            {{-- Progress Bar Indicator --}}
            <div x-show="step <= 5" x-cloak class="mb-6">
                <div class="flex justify-between items-center text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                    <span x-text="step === 5 ? 'Langkah Terakhir: Konfirmasi Lokasi' : 'Langkah ' + step + ' dari 4'">Langkah 1 dari 4</span>
                    <span x-text="Math.round((step / 5) * 100) + '% Selesai'">20% Selesai</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden p-0.5 border border-slate-200">
                    <div class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 h-2 rounded-full transition-all duration-500 shadow-xs" :style="'width: ' + (step * 20) + '%'"></div>
                </div>
            </div>

            {{-- STEP 1: 6 LOKASI SALURAN (RESIDENSIAL & B2B) --}}
            <div x-show="step === 1" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 font-extrabold flex items-center justify-center text-xs">1</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900">Di mana lokasi titik saluran yang bermasalah?</h3>
                </div>
                <p class="text-slate-500 text-xs sm:text-sm mb-6">Pilih lokasi spesifik saluran air residensial atau komersial B2B yang mengalami gangguan:</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-6">
                    {{-- 1. Wastafel --}}
                    <button type="button" @click="selectedQ1 = 'wastafel'" 
                        :class="selectedQ1 === 'wastafel' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="p-4 border-2 rounded-2xl flex items-start gap-3 transition-all text-left group relative">
                        <span class="text-2xl p-2 bg-emerald-100/70 rounded-xl group-hover:scale-105 transition-transform shrink-0">🚰</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Wastafel Dapur</span>
                                <span x-show="selectedQ1 === 'wastafel'" x-cloak class="text-emerald-600 font-bold text-[10px] bg-emerald-100 px-1.5 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-tight">Penumpukan minyak goreng &amp; ampas leher angsa P-trap</div>
                        </div>
                    </button>

                    {{-- 2. Floor Drain --}}
                    <button type="button" @click="selectedQ1 = 'floordrain'" 
                        :class="selectedQ1 === 'floordrain' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="p-4 border-2 rounded-2xl flex items-start gap-3 transition-all text-left group relative">
                        <span class="text-2xl p-2 bg-blue-100/70 rounded-xl group-hover:scale-105 transition-transform shrink-0">🚿</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Floor Drain Kamar Mandi</span>
                                <span x-show="selectedQ1 === 'floordrain'" x-cloak class="text-emerald-600 font-bold text-[10px] bg-emerald-100 px-1.5 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-tight">Gumpalan serat rambut &amp; kerak endapan sabun benyek</div>
                        </div>
                    </button>

                    {{-- 3. Kloset --}}
                    <button type="button" @click="selectedQ1 = 'kloset'" 
                        :class="selectedQ1 === 'kloset' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="p-4 border-2 rounded-2xl flex items-start gap-3 transition-all text-left group relative">
                        <span class="text-2xl p-2 bg-amber-100/70 rounded-xl group-hover:scale-105 transition-transform shrink-0">🚽</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Kloset Toilet (WC)</span>
                                <span x-show="selectedQ1 === 'kloset'" x-cloak class="text-emerald-600 font-bold text-[10px] bg-emerald-100 px-1.5 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-tight">Air WC meluap, gumpalan tisu basah, / vent pipe mampet</div>
                        </div>
                    </button>

                    {{-- 4. Talang --}}
                    <button type="button" @click="selectedQ1 = 'talang'" 
                        :class="selectedQ1 === 'talang' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="p-4 border-2 rounded-2xl flex items-start gap-3 transition-all text-left group relative">
                        <span class="text-2xl p-2 bg-teal-100/70 rounded-xl group-hover:scale-105 transition-transform shrink-0">🌧️</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Talang Air Hujan Rooftop</span>
                                <span x-show="selectedQ1 === 'talang'" x-cloak class="text-emerald-600 font-bold text-[10px] bg-emerald-100 px-1.5 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-tight">Tumpukan daun kering, lumut atap, &amp; lumpur hujan</div>
                        </div>
                    </button>

                    {{-- 5. Grease Trap B2B --}}
                    <button type="button" @click="selectedQ1 = 'greasetrap'" 
                        :class="selectedQ1 === 'greasetrap' ? 'border-amber-500 bg-amber-50/80 ring-2 ring-amber-500/20' : 'border-slate-200 bg-white hover:border-amber-400 hover:bg-slate-50'"
                        class="p-4 border-2 rounded-2xl flex items-start gap-3 transition-all text-left group relative">
                        <span class="text-2xl p-2 bg-orange-100/70 rounded-xl group-hover:scale-105 transition-transform shrink-0">🍳</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-amber-700 flex items-center justify-between">
                                <span>Grease Trap Restoran (B2B)</span>
                                <span x-show="selectedQ1 === 'greasetrap'" x-cloak class="text-amber-800 font-bold text-[10px] bg-amber-100 px-1.5 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-tight">Lemak jenuh meluap, bau menyengat, &amp; risiko sanksi limbah</div>
                        </div>
                    </button>

                    {{-- 6. Got / Bak Kontrol Utama --}}
                    <button type="button" @click="selectedQ1 = 'got'" 
                        :class="selectedQ1 === 'got' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="p-4 border-2 rounded-2xl flex items-start gap-3 transition-all text-left group relative">
                        <span class="text-2xl p-2 bg-indigo-100/70 rounded-xl group-hover:scale-105 transition-transform shrink-0">🧱</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Pipa Utama &amp; Bak Kontrol</span>
                                <span x-show="selectedQ1 === 'got'" x-cloak class="text-emerald-600 font-bold text-[10px] bg-emerald-100 px-1.5 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-tight">Air kotor meluap balik, pipa amblas, / akar pohon</div>
                        </div>
                    </button>
                </div>

                {{-- Micro-Feedback Technician Tip --}}
                <div x-show="selectedQ1 !== null" x-cloak x-transition class="p-3.5 bg-blue-50 border border-blue-200 rounded-2xl text-blue-900 text-xs sm:text-sm font-medium mb-6 flex items-start gap-2.5">
                    <span class="text-lg shrink-0">👨‍🔧</span>
                    <div class="flex-grow">
                        <span x-show="selectedQ1 === 'wastafel'" x-cloak>💡 <strong>Fakta Teknis:</strong> 85% sumbatan wastafel dapur berasal dari pembekuan minyak goreng &amp; lemak sisa makanan di leher angsa (P-trap).</span>
                        <span x-show="selectedQ1 === 'floordrain'" x-cloak>💡 <strong>Fakta Teknis:</strong> Sumbatan kamar mandi 90% dipicu jepitan gumpalan rambut &amp; sisa busa sabun benyek di saringan bawah.</span>
                        <span x-show="selectedQ1 === 'kloset'" x-cloak>💡 <strong>Fakta Teknis:</strong> Kloset meluap sering kali dipicu oleh gumpalan tisu basah/pembalut atau pipa ventilasi udara (vent pipe) tersumbat.</span>
                        <span x-show="selectedQ1 === 'talang'" x-cloak>💡 <strong>Fakta Teknis:</strong> Talang air hujan sering tersumbat tumpukan daun kering, lumut atap, dan endapan lumpur saat hujan deras.</span>
                        <span x-show="selectedQ1 === 'greasetrap'" x-cloak>⚠️ <strong>BAHAYA B2B:</strong> Penumpukan lemak jenuh restoran memicu bau busuk menyengat, sekat meluap, dan risiko sanksi inspeksi kebersihan lingkungan.</span>
                        <span x-show="selectedQ1 === 'got'" x-cloak>🚨 <strong>RISIKO STRUKTUR:</strong> Air kotor meluap balik ke lantai bawah menandakan pipa utama amblas atau terhambat intrusi akar pohon.</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" :disabled="selectedQ1 === null" @click="step = 2" :class="selectedQ1 !== null ? 'bg-emerald-600 hover:bg-emerald-500 text-white shadow-md cursor-pointer' : 'bg-slate-200 text-slate-400 cursor-not-allowed'" class="px-6 py-3 rounded-full font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                        <span>Lanjut ke Langkah 2</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>

            {{-- STEP 2: KONDISI ALIRAN AIR --}}
            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 font-extrabold flex items-center justify-center text-xs">2</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900">Bagaimana kondisi aliran air saat ini?</h3>
                </div>
                <p class="text-slate-500 text-xs sm:text-sm mb-6">Pilih tingkat hambatan air saat kran dinyalakan atau disiram:</p>

                <div class="space-y-3 mb-6">
                    <button type="button" @click="selectedQ2 = 'lambat'" 
                        :class="selectedQ2 === 'lambat' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-slate-100 rounded-xl shrink-0">🐢</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Lambat Mengalir</span>
                                <span x-show="selectedQ2 === 'lambat'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Air menggenang dulu lalu surut perlahan dalam beberapa menit</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ2 = 'mampet'" 
                        :class="selectedQ2 === 'mampet' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-amber-100 rounded-xl shrink-0">🚫</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Mampet Total</span>
                                <span x-show="selectedQ2 === 'mampet'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Air menggenang penuh dan tidak mau turun sama sekali</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ2 = 'meluap'" 
                        :class="selectedQ2 === 'meluap' ? 'border-red-500 bg-red-50/80 ring-2 ring-red-500/20' : 'border-slate-200 bg-white hover:border-red-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-red-100 text-red-700 rounded-xl shrink-0">🌊</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-red-950 text-sm sm:text-base group-hover:text-red-700 flex items-center justify-between">
                                <span>Meluap Balik (Backflow Danger)</span>
                                <span x-show="selectedQ2 === 'meluap'" x-cloak class="text-red-700 font-bold text-xs bg-red-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-red-700 font-medium mt-0.5">Saat kran lain dinyalakan, air limbah keluar meluap di lubang kamar mandi / bak kontrol</div>
                        </div>
                    </button>
                </div>

                {{-- Micro-Feedback Technician Tip --}}
                <div x-show="selectedQ2 !== null" x-cloak x-transition class="p-3.5 bg-blue-50 border border-blue-200 rounded-2xl text-blue-900 text-xs sm:text-sm font-medium mb-6 flex items-start gap-2.5">
                    <span class="text-lg shrink-0">👨‍🔧</span>
                    <div class="flex-grow">
                        <span x-show="selectedQ2 === 'lambat'" x-cloak>💡 <strong>Catatan Teknisi:</strong> Hambatan awal menandakan ruang pipa mulai terisi 40-60%. Ini momen emas pelancaran sebelum mampet total.</span>
                        <span x-show="selectedQ2 === 'mampet'" x-cloak>💡 <strong>Catatan Teknisi:</strong> Mampet total terjadi ketika rongga pipa tersumbat 100% oleh batuan kerak lemak atau gumpalan benda padat.</span>
                        <span x-show="selectedQ2 === 'meluap'" x-cloak>🚨 <strong>BAHAYA MELUAP BALIK:</strong> Ini menandakan penyumbatan terjadi pada pipa pembuangan utama (main-line line). Segera matikan kran air utama!</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" @click="step = 1" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">&larr; Kembali</button>
                    <button type="button" :disabled="selectedQ2 === null" @click="step = 3" :class="selectedQ2 !== null ? 'bg-emerald-600 hover:bg-emerald-500 text-white shadow-md cursor-pointer' : 'bg-slate-200 text-slate-400 cursor-not-allowed'" class="px-6 py-3 rounded-full font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                        <span>Lanjut ke Langkah 3</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>

            {{-- STEP 3: SUARA, BAU & RIWAYAT SODA API --}}
            <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 font-extrabold flex items-center justify-center text-xs">3</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900">Apakah ada suara aneh atau pernah pakai Soda Api?</h3>
                </div>
                <p class="text-slate-500 text-xs sm:text-sm mb-6">Pilih kondisi khusus yang teramati pada saluran pipa Anda:</p>

                <div class="space-y-3 mb-6">
                    <button type="button" @click="selectedQ3 = 'gluk'" 
                        :class="selectedQ3 === 'gluk' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-slate-100 rounded-xl shrink-0">🔊</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Suara 'Gluk-Gluk' Bergemuruh</span>
                                <span x-show="selectedQ3 === 'gluk'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Terdengar bunyi gelembung udara keluar saat air dibuang</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ3 = 'bau'" 
                        :class="selectedQ3 === 'bau' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-slate-100 rounded-xl shrink-0">🤢</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Bau Busuk / Apek Menyengat</span>
                                <span x-show="selectedQ3 === 'bau'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Aroma sampah atau limbah menyengat naik dari lubang pipa</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ3 = 'soda'" 
                        :class="selectedQ3 === 'soda' ? 'border-amber-500 bg-amber-50/80 ring-2 ring-amber-500/20' : 'border-slate-200 bg-white hover:border-amber-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-amber-100 rounded-xl shrink-0">⚠️</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-amber-950 text-sm sm:text-base group-hover:text-amber-700 flex items-center justify-between">
                                <span>Pernah Disiram Soda Api / Cairan Kimia</span>
                                <span x-show="selectedQ3 === 'soda'" x-cloak class="text-amber-800 font-bold text-xs bg-amber-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-amber-800 font-medium mt-0.5">⚠️ Pernah coba disiram kimia tapi mampet makin parah / tidak mempan</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ3 = 'standar'" 
                        :class="selectedQ3 === 'standar' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-slate-100 rounded-xl shrink-0">✅</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Tidak Ada Suara atau Bau Khusus</span>
                                <span x-show="selectedQ3 === 'standar'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Masalah mampet fisik biasa tanpa riwayat penggunaan bahan kimia</div>
                        </div>
                    </button>
                </div>

                {{-- Micro-Feedback Technician Tip --}}
                <div x-show="selectedQ3 !== null" x-cloak x-transition class="p-3.5 bg-blue-50 border border-blue-200 rounded-2xl text-blue-900 text-xs sm:text-sm font-medium mb-6 flex items-start gap-2.5">
                    <span class="text-lg shrink-0">👨‍🔧</span>
                    <div class="flex-grow">
                        <span x-show="selectedQ3 === 'gluk'" x-cloak>💡 <strong>Fakta Teknis:</strong> Suara bergemuruh (gurgling) terjadi karena udara terperangkap saat air memaksa lewat di celah pipa sempit yang mengerak.</span>
                        <span x-show="selectedQ3 === 'bau'" x-cloak>💡 <strong>Catatan Teknisi:</strong> Bau busuk naik karena perangkap air (water seal) kering atau gas busuk limbah tertahan oleh sumbatan padat.</span>
                        <span x-show="selectedQ3 === 'soda'" x-cloak>⚠️ <strong>PERINGATAN KETAT:</strong> Soda api menghasilkan reaksi panas tinggi yang bisa membengkokkan sambungan pipa PVC dan mengeraskan kerak minyak jadi semen!</span>
                        <span x-show="selectedQ3 === 'standar'" x-cloak>💡 <strong>Catatan Teknisi:</strong> Bagus! Pipa Anda bersih dari kontaminasi kimia korosif sehingga pengerjaan mesin spiral akan sangat lancar.</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" @click="step = 2" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">&larr; Kembali</button>
                    <button type="button" :disabled="selectedQ3 === null" @click="step = 4" :class="selectedQ3 !== null ? 'bg-emerald-600 hover:bg-emerald-500 text-white shadow-md cursor-pointer' : 'bg-slate-200 text-slate-400 cursor-not-allowed'" class="px-6 py-3 rounded-full font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                        <span>Lanjut ke Langkah 4</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>

            {{-- STEP 4: DURASI MASALAH --}}
            <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 font-extrabold flex items-center justify-center text-xs">4</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900">Berapa lama masalah ini sudah berlangsung?</h3>
                </div>
                <p class="text-slate-500 text-xs sm:text-sm mb-6">Pilih perkiraan jangka waktu timbulnya hambatan pipa:</p>

                <div class="space-y-3 mb-6">
                    <button type="button" @click="selectedQ4 = 'baru'" 
                        :class="selectedQ4 === 'baru' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-slate-100 rounded-xl shrink-0">⏱️</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Baru Hari Ini / Baru Terjadi</span>
                                <span x-show="selectedQ4 === 'baru'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Sumbatan mendadak dan belum terakumulasi terlalu lama</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ4 = 'kumat'" 
                        :class="selectedQ4 === 'kumat' ? 'border-emerald-500 bg-emerald-50/80 ring-2 ring-emerald-500/20' : 'border-slate-200 bg-white hover:border-emerald-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-slate-100 rounded-xl shrink-0">📅</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-slate-900 text-sm sm:text-base group-hover:text-emerald-700 flex items-center justify-between">
                                <span>Sudah 2 – 7 Hari (Kumat-kumatan)</span>
                                <span x-show="selectedQ4 === 'kumat'" x-cloak class="text-emerald-600 font-bold text-xs bg-emerald-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-0.5">Kadang lancar sebentar lalu mampet lagi berulang kali</div>
                        </div>
                    </button>

                    <button type="button" @click="selectedQ4 = 'parah'" 
                        :class="selectedQ4 === 'parah' ? 'border-red-500 bg-red-50/80 ring-2 ring-red-500/20' : 'border-slate-200 bg-white hover:border-red-400 hover:bg-slate-50'"
                        class="w-full p-4 border-2 rounded-2xl flex items-center gap-3.5 transition-all text-left group">
                        <span class="text-2xl p-2.5 bg-red-100 text-red-700 rounded-xl shrink-0">🚨</span>
                        <div class="flex-grow">
                            <div class="font-extrabold text-red-950 text-sm sm:text-base group-hover:text-red-700 flex items-center justify-between">
                                <span>Lebih dari 1 Minggu (Parah)</span>
                                <span x-show="selectedQ4 === 'parah'" x-cloak class="text-red-700 font-bold text-xs bg-red-100 px-2 py-0.5 rounded-full">✓ Terpilih</span>
                            </div>
                            <div class="text-xs text-red-700 font-medium mt-0.5">Pipa tersumbat parah dan berisiko merusak instalasi struktur bangunan</div>
                        </div>
                    </button>
                </div>

                {{-- Micro-Feedback Technician Tip --}}
                <div x-show="selectedQ4 !== null" x-cloak x-transition class="p-3.5 bg-blue-50 border border-blue-200 rounded-2xl text-blue-900 text-xs sm:text-sm font-medium mb-6 flex items-start gap-2.5">
                    <span class="text-lg shrink-0">👨‍🔧</span>
                    <div class="flex-grow">
                        <span x-show="selectedQ4 === 'baru'" x-cloak>💡 <strong>Catatan Teknisi:</strong> Sumbatan baru relatif cepat dibersihkan karena endapan lemak belum mengkristal menjadi batuan padat.</span>
                        <span x-show="selectedQ4 === 'kumat'" x-cloak>💡 <strong>Catatan Teknisi:</strong> Sumbatan berulang menandakan adanya penyempitan permanen yang perlu dikikis habis oleh kabel spiral fleksibel.</span>
                        <span x-show="selectedQ4 === 'parah'" x-cloak>🚨 <strong>PERINGATAN:</strong> Kerak yang didiamkan &gt;1 minggu berisiko menyebabkan tekanan balik air merembes ke tembok/plafon bawah!</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" @click="step = 3" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">&larr; Kembali</button>
                    <button type="button" :disabled="selectedQ4 === null" @click="step = 5" :class="selectedQ4 !== null ? 'bg-emerald-600 hover:bg-emerald-500 text-white shadow-md cursor-pointer' : 'bg-slate-200 text-slate-400 cursor-not-allowed'" class="px-6 py-3 rounded-full font-bold text-xs sm:text-sm transition-all flex items-center gap-2">
                        <span>Lanjut Konfirmasi Wilayah</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            </div>

            {{-- STEP 5: PILIHAN KOTA / WILAYAH --}}
            <div x-show="step === 5" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" style="display: none;">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 font-extrabold flex items-center justify-center text-xs">5</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900">Di mana lokasi kota/wilayah properti Anda?</h3>
                </div>
                <p class="text-slate-500 text-xs sm:text-sm mb-6">Pilih wilayah terdekat agar sistem menampilkan estimasi respon armada teknisi siaga:</p>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 mb-8">
                    <template x-for="city in cities" :key="city">
                        <button type="button" @click="selectedCity = city" 
                            :class="selectedCity === city ? 'bg-emerald-600 text-white font-extrabold border-emerald-600 shadow-sm' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                            class="p-3 border rounded-xl text-xs text-center transition-all cursor-pointer">
                            <span x-text="city"></span>
                        </button>
                    </template>
                </div>

                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-900 text-xs font-semibold mb-6 flex items-center gap-2">
                    <span>📍 Armada Siaga:</span>
                    <span>Teknisi terdekat area <strong x-text="selectedCity"></strong> siap meluncur dengan waktu respon 25–40 Menit.</span>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" @click="step = 4" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">&larr; Kembali</button>
                    <button type="button" @click="step = 6" class="px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white rounded-full font-extrabold text-xs sm:text-sm transition-all shadow-lg hover:scale-[1.02] flex items-center gap-2 cursor-pointer">
                        <span>📊 Tampilkan Laporan Diagnosa Lengkap</span>
                    </button>
                </div>
            </div>

            {{-- RESULT CARD REPORT (STEP 6) --}}
            <div x-show="step === 6" x-cloak x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" style="display: none;">
                
                {{-- REPORT HEADER BADGE --}}
                <div class="mb-6 pb-4 border-b border-slate-100 flex flex-wrap justify-between items-center gap-3">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600">Laporan Resmi Diagnosa Pipa</span>
                        <h4 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">Hasil Analisis Kondisi Pipa</h4>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-3.5 py-1 bg-emerald-100 text-emerald-800 font-extrabold text-xs rounded-full border border-emerald-200" x-text="'Skor Kategori: ' + totalScore + '/12'"></span>
                        <span class="px-3.5 py-1 bg-slate-100 text-slate-700 font-bold text-xs rounded-full border border-slate-200" x-text="'Wilayah: ' + selectedCity"></span>
                    </div>
                </div>

                {{-- VISUAL SEVERITY GAUGE BAR WITH PERCENTAGE --}}
                <div class="mb-8 bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <div class="flex justify-between items-center text-xs font-extrabold mb-2">
                        <span class="text-slate-700">PENYEMPITAN RONGGA PIPAMAMPET:</span>
                        <span :class="severityCategory === 'low' ? 'text-emerald-600' : (severityCategory === 'medium' ? 'text-amber-600' : 'text-red-600')" 
                              x-text="severityCategory === 'low' ? '🟢 RINGAN — ' + severityPercent + '% Tersumbat' : (severityCategory === 'medium' ? '🟡 SEDANG — ' + severityPercent + '% Tersumbat' : '🔴 PARAH / DARURAT — ' + severityPercent + '% Total Blockage')"></span>
                    </div>

                    <div class="w-full bg-slate-200 rounded-full h-4 overflow-hidden p-0.5 border border-slate-300">
                        <div class="h-3 rounded-full transition-all duration-1000 shadow-inner" 
                            :class="severityCategory === 'low' ? 'bg-gradient-to-r from-emerald-400 to-emerald-600' : (severityCategory === 'medium' ? 'bg-gradient-to-r from-amber-400 to-amber-600' : 'bg-gradient-to-r from-red-500 to-red-700')"
                            :style="'width: ' + severityPercent + '%'"></div>
                    </div>
                </div>

                {{-- RESULT 1: KATEGORI RINGAN --}}
                <template x-if="severityCategory === 'low'">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Card 1: Analisis Akar Masalah --}}
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-2">
                                <div class="text-emerald-600 font-extrabold text-xs uppercase tracking-wider">🧐 Analisis Akar Masalah</div>
                                <h5 class="font-extrabold text-slate-900 text-sm sm:text-base">Sumbatan Awal Leher Angsa (P-Trap)</h5>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Sumbatan pada <strong class="text-slate-900" x-text="selectedQ1Label"></strong> masih tergolong ringan. Disebabkan akumulasi rontokan rambut, sisa sabun benyek, atau ampas makanan di lekukan leher angsa.
                                </p>
                            </div>

                            {{-- Card 2: Potensi Kerusakan --}}
                            <div class="bg-amber-50/70 p-5 rounded-2xl border border-amber-200/90 space-y-2">
                                <div class="text-amber-800 font-extrabold text-xs uppercase tracking-wider">⚠️ Risiko Didiamkan</div>
                                <h5 class="font-extrabold text-amber-950 text-sm sm:text-base">Penumpukan Kerak Padat</h5>
                                <p class="text-amber-900 text-xs leading-relaxed">
                                    Jika tidak segera dibersihkan, endapan lemak halus akan mengikat debu dan berubah menjadi kerak keras yang menempel permanen di dinding pipa.
                                </p>
                            </div>
                        </div>

                        {{-- Card 3: Rekomendasi Solusi Mekanis --}}
                        <div class="p-6 bg-slate-900 text-white rounded-3xl space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">🛠️</span>
                                <div>
                                    <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Rekomendasi Penanganan Rootera</span>
                                    <h5 class="text-base sm:text-lg font-extrabold text-white">Pembersihan Kabel Spiral Rotary tanpa Bongkar</h5>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                                Penanganan efektif menggunakan mesin kabel spiral fleksibel <em>Ridgid Drain Cleaner</em> yang merontokkan gumpalan rambut &amp; sabun dalam 20–30 menit tanpa membongkar ubin keramik rumah Anda.
                            </p>

                            <a :href="waUrl" target="_blank" rel="noopener" class="w-full py-4 px-6 bg-[#25D366] hover:bg-[#1EBE5A] text-white font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-transform hover:scale-[1.01] flex items-center justify-center gap-2 text-decoration-none">
                                <span>📱 Konsultasi &amp; Panggil Teknisi Area <span x-text="selectedCity"></span> (WA 24 Jam)</span>
                            </a>
                        </div>
                    </div>
                </template>

                {{-- RESULT 2: KATEGORI SEDANG --}}
                <template x-if="severityCategory === 'medium'">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Card 1: Analisis Akar Masalah --}}
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-2">
                                <div class="text-amber-600 font-extrabold text-xs uppercase tracking-wider">🧐 Analisis Akar Masalah</div>
                                <h5 class="font-extrabold text-slate-900 text-sm sm:text-base">Akumulasi Kerak Lemak Beku (Saponifikasi)</h5>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Gejala air menggenang dan suara bergemuruh pada <strong class="text-slate-900" x-text="selectedQ1Label"></strong> mengindikasikan penyempitan rongga pipa akibat batuan kerak minyak yang mengeras.
                                </p>
                            </div>

                            {{-- Card 2: Potensi Kerusakan --}}
                            <div class="bg-red-50/70 p-5 rounded-2xl border border-red-200/90 space-y-2">
                                <div class="text-red-800 font-extrabold text-xs uppercase tracking-wider">🚨 Potensi Bahaya &amp; Kerusakan</div>
                                <h5 class="font-extrabold text-red-950 text-sm sm:text-base">Bahaya Soda Api &amp; Air Meluap</h5>
                                <p class="text-red-900 text-xs leading-relaxed font-medium">
                                    ⚠️ <strong>Dilarang pakai Soda Api!</strong> Reaksi panas soda api akan melengkungkan pipa PVC &amp; membekukan lemak menjadi seperti semen padat.
                                </p>
                            </div>
                        </div>

                        {{-- Card 3: Rekomendasi Solusi Mekanis --}}
                        <div class="p-6 bg-slate-900 text-white rounded-3xl space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">🌀</span>
                                <div>
                                    <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Solusi Spesialis Rootera</span>
                                    <h5 class="text-base sm:text-lg font-extrabold text-white">Pemotongan Kerak Mesin Ridgid Spiral 360°</h5>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                                Kepala pisau pendorong spiral berputar merontokkan batuan lemak beku hingga dinding pipa kembali bersih seperti baru. Pengerjaan 100% tanpa bongkar bergaransi 30 hari.
                            </p>

                            <a :href="waUrl" target="_blank" rel="noopener" class="w-full py-4 px-6 bg-[#25D366] hover:bg-[#1EBE5A] text-white font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-transform hover:scale-[1.01] flex items-center justify-center gap-2 text-decoration-none">
                                <span>📱 Konsultasi &amp; Panggil Teknisi Area <span x-text="selectedCity"></span> (WA 24 Jam)</span>
                            </a>
                        </div>
                    </div>
                </template>

                {{-- RESULT 3: KATEGORI PARAH / DARURAT --}}
                <template x-if="severityCategory === 'high'">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Card 1: Analisis Akar Masalah --}}
                            <div class="bg-red-50 p-5 rounded-2xl border border-red-200 space-y-2">
                                <div class="text-red-700 font-extrabold text-xs uppercase tracking-wider">🚨 Analisis Darurat</div>
                                <h5 class="font-extrabold text-red-950 text-sm sm:text-base">Mampet Total &amp; Resiko Meluap Balik</h5>
                                <p class="text-red-900 text-xs leading-relaxed font-medium">
                                    Saluran pembuangan utama (main-line) tersumbat total. Air limbah kotor berisiko meluap membasahi keramik dan perabotan ruangan.
                                </p>
                            </div>

                            {{-- Card 2: Potensi Kerusakan --}}
                            <div class="bg-amber-50 p-5 rounded-2xl border border-amber-200 space-y-2">
                                <div class="text-amber-800 font-extrabold text-xs uppercase tracking-wider">💥 Risiko Kerusakan Bangunan</div>
                                <h5 class="font-extrabold text-amber-950 text-sm sm:text-base">Rembesan Plafon &amp; Bau Limbah</h5>
                                <p class="text-amber-900 text-xs leading-relaxed">
                                    Tekanan air yang tertahan di dalam dinding berisiko merembes memicu kebocoran di plafon lantai bawah serta menyebarkan gas beracun.
                                </p>
                            </div>
                        </div>

                        {{-- Card 3: Rekomendasi Solusi Mekanis --}}
                        <div class="p-6 bg-slate-900 text-white rounded-3xl space-y-4 border-2 border-red-500/50">
                            <div class="flex items-center gap-3">
                                <span class="text-3xl">🌊</span>
                                <div>
                                    <span class="text-xs font-bold text-red-400 uppercase tracking-wider">Solusi Penanganan Cepat Rootera</span>
                                    <h5 class="text-base sm:text-lg font-extrabold text-white">Hydro-Jetting Tekanan Tinggi &amp; Kamera CCTV Pipa</h5>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                                Penyemprotan air jet bertekanan tinggi merontokkan semua lumpur padat &amp; benda asing, dilanjutkan inspeksi kamera CCTV untuk memastikan instalasi pipa bebas kerusakan.
                            </p>

                            <a :href="waUrl" target="_blank" rel="noopener" class="w-full py-4 px-6 bg-[#25D366] hover:bg-[#1EBE5A] text-white font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-transform hover:scale-[1.01] flex items-center justify-center gap-2 text-decoration-none">
                                <span>🚨 Panggil Tim Darurat Area <span x-text="selectedCity"></span> (WA 24 Jam)</span>
                            </a>
                        </div>
                    </div>
                </template>

                {{-- MODUL PERBANDINGAN BIAYA & RISIKO (RISK COST CALCULATOR) --}}
                <div class="mt-8 pt-6 border-t border-slate-200 space-y-4">
                    <div class="text-center">
                        <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600">Perhitungan Nilai Ekonomis Solusi</span>
                        <h5 class="text-lg font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">Perbandingan Biaya: Penanganan Segera vs Ditunda</h5>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                        {{-- Rootera Immediate Action --}}
                        <div class="p-5 bg-emerald-50/80 border-2 border-emerald-500/80 rounded-2xl space-y-3 relative">
                            <span class="absolute -top-3 right-4 px-3 py-0.5 bg-emerald-600 text-white font-extrabold text-[10px] rounded-full uppercase">Paling Efisien</span>
                            <div class="font-extrabold text-emerald-950 text-sm flex items-center gap-1.5">
                                <span>✅</span>
                                <span>Penanganan Cepat Rootera</span>
                            </div>
                            <ul class="space-y-1.5 text-emerald-900 font-medium">
                                <li class="flex items-center gap-2">⏱️ Waktu Pengerjaan: 45 – 90 Menit</li>
                                <li class="flex items-center gap-2">🛠️ Metode: Mesin Spiral Rotary tanpa bongkar</li>
                                <li class="flex items-center gap-2">🛡️ Hasil: Pipa PVC utuh bergaransi 30 Hari</li>
                                <li class="flex items-center gap-2">💰 Biaya: Pasti, terjangkau, &amp; transparan</li>
                            </ul>
                        </div>

                        {{-- Delayed Action Risk --}}
                        <div class="p-5 bg-red-50/80 border-2 border-red-300 rounded-2xl space-y-3">
                            <div class="font-extrabold text-red-950 text-sm flex items-center gap-1.5">
                                <span>⚠️</span>
                                <span>Risiko Jika Ditunda / Disiram Soda Api</span>
                            </div>
                            <ul class="space-y-1.5 text-red-900 font-medium">
                                <li class="flex items-center gap-2">🔥 Reaksi Soda Api: Pipa PVC membengkok / pecah</li>
                                <li class="flex items-center gap-2">🏚️ Kerusakan Bangunan: Rembesan air di plafon &amp; dinding</li>
                                <li class="flex items-center gap-2">⛏️ Pengerjaan Darurat: Bongkar keramik &amp; ganti pipa</li>
                                <li class="flex items-center gap-2">💸 Potensi Kerugian: Jutaan Rupiah untuk renovasi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- RESTART QUIZ FOOTER --}}
                <div class="pt-6 mt-6 border-t border-slate-100 flex flex-wrap justify-between items-center gap-3 text-xs">
                    <button type="button" @click="resetQuiz()" class="font-extrabold text-slate-600 hover:text-emerald-600 transition flex items-center gap-1.5 p-2 bg-slate-100 hover:bg-slate-200 rounded-xl cursor-pointer">
                        <span>🔄 Ulangi Diagnosa Dari Awal</span>
                    </button>
                    <span class="text-slate-500 font-bold flex items-center gap-1">
                        <span>🛡️</span> Bergaransi Resmi 30 Hari Tanpa Bongkar
                    </span>
                </div>

            </div>

        </div>

    </div>
</section>

{{-- PUSTAKA VISUAL ENDAPAN PIPAMAMPET (VISUAL DEPOSIT GALLERY) --}}
<section class="py-12 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-wider">Karakteristik Endapan Nyata</span>
            <h2 class="text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Jenis Penyebab Utama Sumbatan Pipa</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 space-y-2 shadow-xs">
                <div class="text-3xl">🧈</div>
                <h3 class="font-extrabold text-slate-900 text-sm">Kerak Lemak Mengeras (Fatberg)</h3>
                <p class="text-slate-600 text-xs leading-relaxed">
                    Minyak goreng sisa masakan menyatu dengan limbah dapur dan mengkristal menjadi batuan padat yang menyumbat 80%+ rongga pipa.
                </p>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 space-y-2 shadow-xs">
                <div class="text-3xl">💇</div>
                <h3 class="font-extrabold text-slate-900 text-sm">Gumpalan Rambut &amp; Sabun</h3>
                <p class="text-slate-600 text-xs leading-relaxed">
                    Serat rontokan rambut kamar mandi terjalin erat dengan busa sabun benyek hingga membentuk jaring serat padat penahan air.
                </p>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 space-y-2 shadow-xs">
                <div class="text-3xl">⚠️</div>
                <h3 class="font-extrabold text-slate-900 text-sm">Pipa PVC Meleyot Kimia</h3>
                <p class="text-slate-600 text-xs leading-relaxed">
                    Efek siraman soda api berlebihan yang menghasilkan panas eksotermis tinggi, menyebabkan lem sambungan pipa PVC bocor &amp; meleyot.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ON-PAGE SEO & ACCORDION SYSTEM FAQ SECTION --}}
<section class="py-16 bg-white border-t border-slate-100" x-data="{ activeFaq: null, faqTab: 'all' }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-8">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-wider">Pusat Edukasi &amp; Tanya-Jawab</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Pertanyaan Populer Seputar Pipa Mampet</h2>
            <p class="text-slate-600 text-sm max-w-xl mx-auto mt-2">Temukan jawaban teknis profesional untuk mengatasi gangguan saluran air di properti Anda.</p>
        </div>

        {{-- FAQ CATEGORY FILTER TABS --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button type="button" @click="faqTab = 'all'" :class="faqTab === 'all' ? 'bg-emerald-600 text-white font-extrabold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer">Semua FAQ</button>
            <button type="button" @click="faqTab = 'wastafel'" :class="faqTab === 'wastafel' ? 'bg-emerald-600 text-white font-extrabold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer">Wastafel</button>
            <button type="button" @click="faqTab = 'kloset'" :class="faqTab === 'kloset' ? 'bg-emerald-600 text-white font-extrabold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer">Kloset WC</button>
            <button type="button" @click="faqTab = 'greasetrap'" :class="faqTab === 'greasetrap' ? 'bg-emerald-600 text-white font-extrabold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer">Grease Trap B2B</button>
            <button type="button" @click="faqTab = 'talang'" :class="faqTab === 'talang' ? 'bg-emerald-600 text-white font-extrabold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer">Talang Hujan</button>
        </div>

        {{-- ACCORDION FAQ SYSTEM (ALPINE.JS) --}}
        <div class="space-y-3.5">
            @foreach($faqs as $idx => $faq)
            <div x-show="faqTab === 'all' || faqTab === '{{ $faq['category'] ?? 'general' }}'" x-cloak class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden transition-all duration-200 hover:border-emerald-300">
                <button type="button" @click="activeFaq = (activeFaq === {{ $idx }} ? null : {{ $idx }})" 
                    class="w-full p-4 sm:p-5 text-left font-extrabold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-100/70 transition-colors focus:outline-none min-h-[52px] cursor-pointer">
                    <span class="flex items-center gap-2.5">
                        <span class="text-emerald-600">❓</span>
                        <span>{{ $faq['question'] }}</span>
                    </span>
                    <span class="w-7 h-7 rounded-full bg-white border border-slate-200 text-emerald-600 font-extrabold text-lg flex items-center justify-center shrink-0 transition-transform duration-200" 
                        :class="activeFaq === {{ $idx }} ? 'rotate-180 bg-emerald-50' : ''">
                        ↓
                    </span>
                </button>

                <div x-show="activeFaq === {{ $idx }}" x-cloak x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200/60 pt-4 bg-white">
                    {{ $faq['answer'] }}
                </div>
            </div>
            @endforeach
        </div>

        {{-- Trust Proposition Badges --}}
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
            <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="text-3xl mb-1.5">🛠️</div>
                <div class="font-extrabold text-slate-900 text-sm">100% Tanpa Bongkar</div>
                <div class="text-xs text-slate-500 mt-0.5">Lantai keramik &amp; dinding rumah tetap utuh</div>
            </div>
            <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="text-3xl mb-1.5">⚡</div>
                <div class="font-extrabold text-slate-900 text-sm">Respon Cepat 25-40 Menit</div>
                <div class="text-xs text-slate-500 mt-0.5">Armada teknisi siaga meluncur ke lokasi</div>
            </div>
            <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200/90 shadow-xs">
                <div class="text-3xl mb-1.5">🛡️</div>
                <div class="font-extrabold text-slate-900 text-sm">Garansi Resmi 30 Hari</div>
                <div class="text-xs text-slate-500 mt-0.5">Jaminan tuntas pengerjaan ulang gratis</div>
            </div>
        </div>

    </div>
</section>

@endsection
