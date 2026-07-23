@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('admin-content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @php
    $stats = [
        ['label'=>'Pesanan Baru','value'=>$newContacts ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>','bg'=>'#eff6ff','iconColor'=>'#2563eb'],
        ['label'=>'Total Artikel','value'=>$totalArticles ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10l6 6v10a2 2 0 0 1-2 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>','bg'=>'#f0fdfa','iconColor'=>'#0d9488'],
        ['label'=>'Total Pesanan','value'=>$totalContacts ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>','bg'=>'#f3f4f6','iconColor'=>'#475569'],
        ['label'=>'Pesanan Selesai','value'=>$completedOrders ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>','bg'=>'#ecfdf5','iconColor'=>'#059669'],
        ['label'=>'Area Layanan','value'=>$totalAreas ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>','bg'=>'#fef2f2','iconColor'=>'#dc2626'],
        ['label'=>'Kategori Layanan','value'=>$totalCategories ?? 0,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>','bg'=>'#fffbeb','iconColor'=>'#d97706'],
    ];
    @endphp
    @foreach($stats as $s)
    <div class="stat-card" style="background:#ffffff;border-radius:1rem;padding:1.5rem;border:1px solid rgba(226,232,240,0.8);box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs uppercase tracking-wider" style="color:#64748b;font-weight:700;">{{ $s['label'] }}</span>
            <span class="w-12 h-12 rounded-xl flex items-center justify-center text-lg" style="background:{{ $s['bg'] }};color:{{ $s['iconColor'] }}">{!! $s['icon'] !!}</span>
        </div>
        <div class="flex items-end gap-3 mt-4">
            <div class="stat-num tracking-tight" style="color:#1e293b;font-size:2rem;font-weight:800;line-height:1;">{{ $s['value'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 gap-6 mb-8">
    <div style="background:#ffffff;border-radius:1.25rem;padding:1.5rem;border:1px solid rgba(226,232,240,0.8);box-shadow:0 1px 3px rgba(0,0,0,0.05);">
        <h3 class="font-semibold text-base mb-5 flex items-center gap-2" style="color:#0f172a;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#64748b;"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg> 
            Grafik Pesanan per Bulan
        </h3>
        <div style="position: relative; width: 100%; height: 300px;">
            <canvas id="contactsChart"></canvas>
        </div>
    </div>
</div>

{{-- Recent Contacts --}}
{{-- Recent Contacts --}}
<div style="background:#ffffff;border-radius:1.25rem;padding:1.5rem;border:1px solid rgba(226,232,240,0.8);box-shadow:0 1px 3px rgba(0,0,0,0.05);">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-semibold text-base flex items-center gap-2" style="color:#0f172a;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:#64748b;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            Pesanan Terbaru
        </h3>
        <a href="{{ route('admin.contacts.index') }}" class="text-sm font-semibold text-[#1FAF5A] hover:text-[#178544] transition-colors">Lihat Semua →</a>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table table-responsive-card">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Layanan</th>
                    <th>Area</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($recentContacts as $c)
            <tr>
                <td data-label="Nama"><strong>{{ $c->name }}</strong></td>
                <td data-label="Telepon">{{ $c->phone }}</td>
                <td data-label="Layanan">{{ $c->service_type ?? '-' }}</td>
                <td data-label="Area">{{ $c->area ?? '-' }}</td>
                <td data-label="Status"><span class="status-{{ $c->status }}">{{ $c->status_label }}</span></td>
                <td data-label="Tanggal">{{ $c->created_at->format('d/m/Y') }}</td>
                <td data-label="Aksi" style="text-align: right;">
                    <a href="{{ route('admin.contacts.show', $c->id) }}" class="btn-sm btn-view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        Detail
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
const labels = @json($chartLabels);
const contactData = @json($contactData);

new Chart(document.getElementById('contactsChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Jumlah Pesanan',
            data: contactData,
            backgroundColor: 'rgba(37,99,235,0.8)',
            borderRadius: 6,
            barThickness: 24,
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: { legend: { display: false } }, 
        scales: { 
            y: { 
                beginAtZero: true, 
                suggestedMax: 10,
                grid: { color: '#f1f5f9', drawBorder: false },
                ticks: { precision: 0, color: '#64748b' } 
            }, 
            x: { 
                grid: { display: false },
                ticks: { color: '#64748b' }
            } 
        } 
    }
});
</script>
@endpush
