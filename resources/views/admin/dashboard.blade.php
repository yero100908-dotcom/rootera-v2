@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('admin-content')
{{-- CMS Stats Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @php
    $stats = [
        ['label'=>'Total Artikel','value'=>$totalArticles ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>','bg'=>'#eff6ff','iconColor'=>'#2563eb'],
        ['label'=>'Galeri Foto','value'=>$totalGallery ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>','bg'=>'#fdf4ff','iconColor'=>'#c026d3'],
        ['label'=>'Kategori Layanan','value'=>$totalCategories ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m2 10 9 4-9 4"/><path d="m21 10-9 4 9 4"/><path d="m11 2 9 4-9 4-9-4 9-4z"/><path d="m11 22 9-4"/></svg>','bg'=>'#f0fdfa','iconColor'=>'#0d9488'],
        ['label'=>'Area Layanan','value'=>$totalAreas ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>','bg'=>'#fef2f2','iconColor'=>'#dc2626'],
        ['label'=>'Sektor Layanan','value'=>$totalSectors ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>','bg'=>'#fffbeb','iconColor'=>'#d97706'],
        ['label'=>'Mitra / Klien','value'=>$totalPartners ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>','bg'=>'#f3f4f6','iconColor'=>'#475569'],
    ];
    @endphp
    @foreach($stats as $s)
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs uppercase tracking-wider text-slate-500 font-bold">{{ $s['label'] }}</span>
            <span class="w-12 h-12 rounded-xl flex items-center justify-center text-lg" style="background:{{ $s['bg'] }};color:{{ $s['iconColor'] }}">{!! $s['icon'] !!}</span>
        </div>
        <div class="flex items-end gap-3 mt-4">
            <div class="text-slate-800 text-4xl font-bold tracking-tight">{{ $s['value'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm mb-8">
    <h3 class="font-bold text-slate-900 text-lg mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-indigo-500"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg> 
        Tren Publikasi Artikel
    </h3>
    <div style="position: relative; width: 100%; height: 320px;">
        <canvas id="articlesChart"></canvas>
    </div>
</div>

{{-- Quick Actions CMS --}}
<div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm mb-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-slate-900 text-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-500"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/><path d="M12 18v-6"/><path d="M9 15h6"/></svg>
            Aksi Cepat Manajemen CMS
        </h3>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.articles.create') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 hover:bg-indigo-50 border border-slate-100 hover:border-indigo-100 rounded-xl transition-all group text-center">
            <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center text-indigo-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <span class="font-semibold text-slate-800 text-sm">Buat Artikel Baru</span>
        </a>
        
        <a href="{{ route('admin.gallery.index') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-100 rounded-xl transition-all group text-center">
            <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center text-emerald-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <span class="font-semibold text-slate-800 text-sm">Tambah Foto Galeri</span>
        </a>
        
        <a href="{{ route('admin.seo.index') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 hover:bg-blue-50 border border-slate-100 hover:border-blue-100 rounded-xl transition-all group text-center">
            <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center text-blue-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </div>
            <span class="font-semibold text-slate-800 text-sm">Kelola SEO Central</span>
        </a>
        
        <a href="{{ route('home') }}" target="_blank" class="flex flex-col items-center justify-center p-6 bg-slate-50 hover:bg-slate-100 border border-slate-100 hover:border-slate-300 rounded-xl transition-all group text-center">
            <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center text-slate-600 mb-3 group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </div>
            <span class="font-semibold text-slate-800 text-sm">Pratinjau Website Utama</span>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
const labels = @json($chartLabels);
const articleData = @json($articleData);

new Chart(document.getElementById('articlesChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Publikasi Artikel',
            data: articleData,
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            borderColor: '#6366f1',
            borderWidth: 2,
            pointBackgroundColor: '#fff',
            pointBorderColor: '#6366f1',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            fill: true,
            tension: 0.3
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: { 
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1e293b',
                titleFont: { size: 13, family: 'Inter' },
                bodyFont: { size: 13, family: 'Inter' },
                padding: 12,
                cornerRadius: 8,
                displayColors: false
            }
        }, 
        scales: { 
            y: { 
                beginAtZero: true, 
                suggestedMax: 5,
                grid: { color: '#f1f5f9', drawBorder: false },
                ticks: { precision: 0, color: '#64748b', font: { family: 'Inter' } } 
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

