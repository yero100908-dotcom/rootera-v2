@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard Control Panel')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('admin-content')
{{-- CMS Stats Metrics 7-Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    @php
    $stats = [
        [
            'label' => 'Pesanan / Kontak',
            'value' => $totalContacts ?? 0,
            'badge' => ($newContactsCount ?? 0) > 0 ? ($newContactsCount . ' BARU') : 'Terkendali',
            'badgeBg' => ($newContactsCount ?? 0) > 0 ? '#10b981' : '#f1f5f9',
            'badgeColor' => ($newContactsCount ?? 0) > 0 ? '#ffffff' : '#64748b',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>',
            'bg' => '#ecfdf5',
            'iconColor' => '#059669',
            'route' => 'admin.contacts.index'
        ],
        [
            'label' => 'Total Artikel',
            'value' => $totalArticles ?? 0,
            'badge' => 'Blog CMS',
            'badgeBg' => '#eff6ff',
            'badgeColor' => '#2563eb',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>',
            'bg' => '#eff6ff',
            'iconColor' => '#2563eb',
            'route' => 'admin.articles.index'
        ],
        [
            'label' => 'Galeri Foto & Video',
            'value' => $totalGallery ?? 0,
            'badge' => 'Media Lapangan',
            'badgeBg' => '#fdf4ff',
            'badgeColor' => '#c026d3',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>',
            'bg' => '#fdf4ff',
            'iconColor' => '#c026d3',
            'route' => 'admin.gallery.index'
        ],
        [
            'label' => 'Kategori Layanan',
            'value' => $totalCategories ?? 0,
            'badge' => 'Layanan Utama',
            'badgeBg' => '#f0fdfa',
            'badgeColor' => '#0d9488',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m2 10 9 4-9 4"/><path d="m21 10-9 4 9 4"/><path d="m11 2 9 4-9 4-9-4 9-4z"/><path d="m11 22 9-4"/></svg>',
            'bg' => '#f0fdfa',
            'iconColor' => '#0d9488',
            'route' => 'admin.service-categories.index'
        ],
        [
            'label' => 'Area Layanan',
            'value' => $totalAreas ?? 0,
            'badge' => 'Jangkauan Wilayah',
            'badgeBg' => '#fef2f2',
            'badgeColor' => '#dc2626',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
            'bg' => '#fef2f2',
            'iconColor' => '#dc2626',
            'route' => 'admin.service-areas.index'
        ],
        [
            'label' => 'Sektor Layanan B2B',
            'value' => $totalSectors ?? 0,
            'badge' => 'Komersial',
            'badgeBg' => '#fffbeb',
            'badgeColor' => '#d97706',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>',
            'bg' => '#fffbeb',
            'iconColor' => '#d97706',
            'route' => 'admin.service-sectors.index'
        ],
        [
            'label' => 'Mitra Komersial',
            'value' => $totalPartners ?? 0,
            'badge' => 'Brand Kepercayaan',
            'badgeBg' => '#f3f4f6',
            'badgeColor' => '#475569',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
            'bg' => '#f3f4f6',
            'iconColor' => '#475569',
            'route' => 'admin.partners.index'
        ],
    ];
    @endphp

    @foreach($stats as $s)
    <a href="{{ route($s['route']) }}" class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-slate-300 transition-all duration-300 group flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between gap-2 mb-2">
                <span class="text-[11px] uppercase tracking-wider text-slate-500 font-extrabold">{{ $s['label'] }}</span>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold" style="background:{{ $s['badgeBg'] }};color:{{ $s['badgeColor'] }}">{{ $s['badge'] }}</span>
            </div>
            <div class="flex items-center justify-between mt-3">
                <div class="text-slate-900 text-3xl font-extrabold tracking-tight font-['Plus_Jakarta_Sans',sans-serif]">{{ $s['value'] }}</div>
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg group-hover:scale-110 transition-transform duration-300" style="background:{{ $s['bg'] }};color:{{ $s['iconColor'] }}">{!! $s['icon'] !!}</div>
            </div>
        </div>
    </a>
    @endforeach
</div>

{{-- Dynamic Interactive Charts (Dual Dataset: Artikel vs Pesanan/Kontak) --}}
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h3 class="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg> 
                Grafik Tren Performa (12 Bulan Terakhir)
            </h3>
            <p class="text-xs text-slate-500 mt-1">Perbandingan pertumbuhan artikel edukasi vs permintaan pesanan/kontak masuk.</p>
        </div>
        <div class="flex items-center gap-3 text-xs font-semibold">
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-emerald-500"></span> Pesanan Masuk</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-indigo-500"></span> Artikel Blog</span>
        </div>
    </div>
    
    <div style="position: relative; width: 100%; height: 320px;">
        <canvas id="performanceChart"></canvas>
    </div>
</div>

{{-- Two-Column Grid: Widgets (Pesanan Terkini + SEO System Health) --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    
    {{-- Widget 1: Pesanan / Kontak Terkini (8 Cols) --}}
    <div class="lg:col-span-8 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                        Pesanan / Kontak Masuk Terkini
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Permintaan layanan terbaru dari formulir website.</p>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 font-bold uppercase border-b border-slate-200">
                            <th class="p-3">Pelanggan</th>
                            <th class="p-3">WhatsApp / Telepon</th>
                            <th class="p-3">Layanan Kendala</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($recentContacts as $c)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-3 font-bold text-slate-900">
                                {{ $c->name ?? 'Pelanggan Anonim' }}
                                <span class="block text-[10px] text-slate-400 font-normal">{{ $c->created_at ? $c->created_at->diffForHumans() : '' }}</span>
                            </td>
                            <td class="p-3 font-medium">
                                {{ $c->phone }}
                            </td>
                            <td class="p-3">
                                <span class="font-medium text-slate-800">{{ $c->service_needed ?? 'Saluran Mampet' }}</span>
                            </td>
                            <td class="p-3">
                                @if($c->status === 'new')
                                    <span class="bg-emerald-100 text-emerald-800 font-extrabold px-2.5 py-0.5 rounded-full text-[10px]">BARU</span>
                                @elseif($c->status === 'in_progress')
                                    <span class="bg-amber-100 text-amber-800 font-extrabold px-2.5 py-0.5 rounded-full text-[10px]">PROSES</span>
                                @elseif($c->status === 'completed')
                                    <span class="bg-blue-100 text-blue-800 font-extrabold px-2.5 py-0.5 rounded-full text-[10px]">SELESAI</span>
                                @else
                                    <span class="bg-slate-100 text-slate-600 font-extrabold px-2.5 py-0.5 rounded-full text-[10px]">{{ strtoupper($c->status) }}</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $c->phone) }}?text={{ urlencode('Halo ' . $c->name . ', saya CS Rootera Plumbing merespon kendala saluran pipa Anda.') }}" 
                                       target="_blank" 
                                       class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-2.5 py-1 rounded-lg text-[11px] transition-colors inline-flex items-center gap-1">
                                        💬 WA
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-400 font-medium">
                                Belum ada kontak atau pesanan masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Widget 2: Status SEO & System Health Check (4 Cols) --}}
    <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
        <div>
            <h3 class="font-extrabold text-slate-900 text-base mb-1 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-blue-600"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                Status SEO &amp; System Health
            </h3>
            <p class="text-xs text-slate-500 mb-5">Verifikasi indeksasi &amp; kesehatan server.</p>

            <div class="space-y-3 text-xs">
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                    <span class="text-slate-600 font-medium">🌐 Database Status</span>
                    <span class="font-bold text-emerald-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> {{ $seoHealth['db_status'] }}
                    </span>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                    <span class="text-slate-600 font-medium">⚡ Application Cache</span>
                    <span class="font-bold text-blue-600">{{ $seoHealth['cache_status'] }}</span>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                    <span class="text-slate-600 font-medium">🗺️ XML Sitemap</span>
                    <span class="font-bold text-emerald-600">{{ $seoHealth['sitemap_xml'] }}</span>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                    <span class="text-slate-600 font-medium">🔗 Est. Terindeks URL</span>
                    <span class="font-bold text-slate-900">{{ $seoHealth['total_urls'] }} Pages</span>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
            <span class="text-[11px] text-slate-400">Standardized SEO Architecture</span>
            <a href="{{ route('sitemap') }}" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-800">
                Buka Sitemap XML →
            </a>
        </div>
    </div>

</div>

{{-- Ergonomic Quick Actions CMS Shortcut Bar --}}
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs mb-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-extrabold text-slate-900 text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/><path d="M12 18v-6"/><path d="M9 15h6"/></svg>
                Aksi Cepat Manajemen Control Panel
            </h3>
            <p class="text-xs text-slate-500 mt-1">Pintasan praktis untuk menambah konten dan mengelola sistem.</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.articles.create') }}" class="flex flex-col items-center justify-center p-5 bg-slate-50 hover:bg-indigo-50 border border-slate-200/80 hover:border-indigo-200 rounded-2xl transition-all duration-300 group text-center shadow-xs hover:-translate-y-1">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-indigo-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <span class="font-bold text-slate-800 text-sm">Buat Artikel Baru</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Tambah konten blog</span>
        </a>
        
        <a href="{{ route('admin.gallery.index') }}" class="flex flex-col items-center justify-center p-5 bg-slate-50 hover:bg-emerald-50 border border-slate-200/80 hover:border-emerald-200 rounded-2xl transition-all duration-300 group text-center shadow-xs hover:-translate-y-1">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-emerald-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <span class="font-bold text-slate-800 text-sm">Tambah Foto Galeri</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Unggah bukti pengerjaan</span>
        </a>

        <a href="{{ route('admin.contacts.index') }}" class="flex flex-col items-center justify-center p-5 bg-slate-50 hover:bg-teal-50 border border-slate-200/80 hover:border-teal-200 rounded-2xl transition-all duration-300 group text-center shadow-xs hover:-translate-y-1">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-teal-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
            </div>
            <span class="font-bold text-slate-800 text-sm">Kelola Pesanan &amp; WA</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Respon pelanggan</span>
        </a>
        
        <a href="{{ route('admin.seo.index') }}" class="flex flex-col items-center justify-center p-5 bg-slate-50 hover:bg-blue-50 border border-slate-200/80 hover:border-blue-200 rounded-2xl transition-all duration-300 group text-center shadow-xs hover:-translate-y-1">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-blue-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </div>
            <span class="font-bold text-slate-800 text-sm">Kelola SEO Central</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Optimasi meta tags</span>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
const labels = @json($chartLabels);
const articleData = @json($articleData);
const contactData = @json($contactData);

const ctx = document.getElementById('performanceChart').getContext('2d');

const gradientEmerald = ctx.createLinearGradient(0, 0, 0, 300);
gradientEmerald.addColorStop(0, 'rgba(16, 185, 129, 0.25)');
gradientEmerald.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

const gradientIndigo = ctx.createLinearGradient(0, 0, 0, 300);
gradientIndigo.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
gradientIndigo.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

new Chart(ctx, {
    type: 'line',
    data: {
        labels,
        datasets: [
            {
                label: 'Pesanan / Kontak Masuk',
                data: contactData,
                backgroundColor: gradientEmerald,
                borderColor: '#10b981',
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                fill: true,
                tension: 0.35
            },
            {
                label: 'Publikasi Artikel',
                data: articleData,
                backgroundColor: gradientIndigo,
                borderColor: '#6366f1',
                borderWidth: 2,
                borderDash: [4, 4],
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6366f1',
                pointBorderWidth: 2,
                pointRadius: 3,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.35
            }
        ]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: { 
            legend: { display: false },
            tooltip: {
                backgroundColor: '#0f172a',
                titleFont: { size: 13, family: 'Inter', weight: 'bold' },
                bodyFont: { size: 13, family: 'Inter' },
                padding: 12,
                cornerRadius: 12,
                displayColors: true
            }
        }, 
        scales: { 
            y: { 
                beginAtZero: true, 
                suggestedMax: 5,
                grid: { color: '#f1f5f9', drawBorder: false },
                ticks: { precision: 0, color: '#64748b', font: { family: 'Inter', weight: 'bold' } } 
            }, 
            x: { 
                grid: { display: false },
                ticks: { color: '#64748b', font: { family: 'Inter' } }
            } 
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
    }
});
</script>
@endpush
