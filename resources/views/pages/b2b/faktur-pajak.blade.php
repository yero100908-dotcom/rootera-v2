@extends('layouts.app')

@section('meta_title', 'Layanan Pipa Mampet dengan Faktur Pajak PPN 11% | Rootera B2B')
@section('meta_description', 'Jasa pelancaran pipa mampet berbadan hukum resmi dengan e-Faktur Pajak PPN 11%. Khusus kebutuhan korporat, resto, hotel, dan pengelola properti.')
@section('meta_keywords', 'jasa pipa mampet faktur pajak, plumbing berbadan hukum, invoice pipa b2b, sertifikat faktur ppn sanitasi')
@section('canonical', url('/layanan-b2b/faktur-pajak'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'ContactPage',
            '@id' => url('/layanan-b2b/faktur-pajak') . '#contactpage',
            'url' => url('/layanan-b2b/faktur-pajak'),
            'name' => 'Layanan Pipa Mampet dengan Faktur Pajak PPN 11% | Rootera B2B',
            'description' => 'Jasa pelancaran pipa mampet berbadan hukum resmi dengan e-Faktur Pajak PPN 11%. Khusus kebutuhan korporat, resto, hotel, dan pengelola properti.',
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Layanan B2B', 'item' => url('/layanan-b2b-komersial')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => 'Permintaan Faktur Pajak', 'item' => url('/layanan-b2b/faktur-pajak')]
                ]
            ]
        ],
        [
            '@type' => 'FinancialService',
            '@id' => url('/layanan-b2b/faktur-pajak') . '#financialService',
            'name' => 'Layanan e-Faktur Pajak PPN 11% Rootera Plumbing (J&J Group)',
            'description' => 'Layanan administrasi perpajakan PPN & e-Faktur resmi J&J Group untuk klien korporasi.',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing (J&J Group)',
                'url' => url('/')
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- Hero Header --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('b2b.index') }}" class="hover:text-emerald-400 transition-colors">Layanan B2B</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Permintaan Faktur Pajak</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                📊 Portal Finance &amp; e-Faktur B2B
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Permintaan Faktur Pajak <span class="text-emerald-400">PPN &amp; e-Faktur</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Layanan pengajuan dokumen perpajakan resmi untuk klien korporasi, restoran, hotel, mall, &amp; pabrik di bawah naungan PT/CV resmi **J&amp;J Group**.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 text-sm font-semibold">
                <span class="text-xl">✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            {{-- Left Column: Information & Document Checklist --}}
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Persyaratan Administrasi</span>
                    <h2 class="text-2xl font-extrabold text-slate-900 mt-1 mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                        Checklist Data Dokumen Faktur Pajak
                    </h2>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Untuk memproses penerbitan e-Faktur PPN 11% secara presisi dan sesuai dengan ketentuan DJP (Direktorat Jenderal Pajak), mohon lengkapi rincian data perusahaan Anda:
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <span class="text-lg">🏢</span>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Nama Resmi Perusahaan (Sesuai SPPKP)</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Nama badan usaha PT, CV, atau Yayasan yang terdaftar resmi pada dokumen pajak.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <span class="text-lg">💳</span>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Nomor NPWP 15/16 Digit</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Nomor Induk Wajib Pajak entitas perusahaan yang aktif.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <span class="text-lg">📍</span>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Alamat Domisili Pajak (KOP Perusahaan)</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Alamat lengkap terdaftar pada SKT / SPPKP perusahaan Anda.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <span class="text-lg">📧</span>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Email Tim Finance &amp; Kontak WA</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Email tujuan untuk pengiriman file PDF e-Faktur &amp; e-SPT XML.</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 bg-blue-50 rounded-2xl border border-blue-200 text-xs text-blue-900 space-y-2">
                    <div class="font-bold text-sm flex items-center gap-1.5">
                        <span>⏱️</span> SLA Pengiriman e-Faktur:
                    </div>
                    <p class="leading-relaxed">
                        e-Faktur PPN diproses oleh tim Accounting Rootera (J&amp;J Group) dalam kurun waktu <strong>1x24 jam kerja</strong> setelah bukti pembayaran pengerjaan tuntas diterima.
                    </p>
                </div>
            </div>

            {{-- Right Column: Interactive Request Form --}}
            <div class="lg:col-span-7">
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-xl">
                    <h3 class="text-xl font-extrabold text-slate-900 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        Formulir Pengajuan Faktur Pajak
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 mb-6">Isi formulir di bawah ini untuk pengiriman e-Faktur secara otomatis ke email finance Anda.</p>

                    <form action="{{ route('b2b.faktur-pajak.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="form-group">
                            <label for="company_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Perusahaan (Sesuai NPWP) *</label>
                            <input type="text" id="company_name" name="company_name" required placeholder="PT. Contoh Maju Bersama" 
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="npwp_number" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor NPWP *</label>
                                <input type="text" id="npwp_number" name="npwp_number" required placeholder="01.234.567.8-901.000" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            </div>

                            <div class="form-group">
                                <label for="invoice_no" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">No. Order / Invoice (Opsional)</label>
                                <input type="text" id="invoice_no" name="invoice_no" placeholder="INV-ROOT-2026-XXXX" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tax_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Domisili Pajak *</label>
                            <textarea id="tax_address" name="tax_address" required rows="3" placeholder="Jl. Sudirman No. 12, Kel. Gelora, Kec. Tanah Abang, Jakarta Pusat" 
                                      class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="finance_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Tim Finance *</label>
                                <input type="email" id="finance_email" name="finance_email" required placeholder="finance@perusahaan.com" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            </div>

                            <div class="form-group">
                                <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">No. Telp / WhatsApp *</label>
                                <input type="text" id="phone" name="phone" required placeholder="081234567890" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full py-3.5 px-6 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-lg transition-all text-sm flex items-center justify-center gap-2">
                                <span>📤 Kirim Permintaan Faktur Pajak</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

{{-- Direct Finance Contact Banner --}}
<section class="py-12 bg-slate-900 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Butuh Bantuan Langsung dari Tim Finance Rootera?</h3>
        <p class="text-slate-300 mb-6 text-sm sm:text-base">Anda juga dapat menghubungi tim accounting J&amp;J Group via email resmi atau WhatsApp hotline B2B.</p>
        <div class="flex flex-wrap justify-center gap-4 text-sm font-semibold">
            <a href="mailto:rootera.plumbing@gmail.com" class="px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white rounded-xl border border-slate-700 flex items-center gap-2">
                ✉️ Email: rootera.plumbing@gmail.com
            </a>
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Tim Finance Rootera, saya ingin menanyakan Faktur Pajak PPN') }}" target="_blank" rel="noopener" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl flex items-center gap-2">
                💬 WA Finance Hotline 24 Jam
            </a>
        </div>
    </div>
</section>
@endsection
