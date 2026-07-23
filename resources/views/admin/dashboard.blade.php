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
        ['label'=>'Pesanan Baru','value'=>$newContacts,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>','bg'=>'#eff6ff','iconColor'=>'#2563eb','trend'=>'up'],
        ['label'=>'Total Pemasukan','value'=>'Rp '.number_format($totalRevenue,0,',','.'),'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>','bg'=>'#ecfdf5','iconColor'=>'#059669','trend'=>'up'],
        ['label'=>'Total Pesanan','value'=>$totalContacts,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>','bg'=>'#f3f4f6','iconColor'=>'#475569','trend'=>'neutral'],
        ['label'=>'Pesanan Selesai','value'=>$completedOrders,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>','bg'=>'#ecfdf5','iconColor'=>'#059669','trend'=>'up'],
        ['label'=>'Area Layanan','value'=>$totalAreas,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>','bg'=>'#fef2f2','iconColor'=>'#dc2626','trend'=>'neutral'],
        ['label'=>'Kategori Layanan','value'=>$totalCategories,'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>','bg'=>'#fffbeb','iconColor'=>'#d97706','trend'=>'neutral'],
    ];
    @endphp
    @foreach($stats as $s)
    <div class="stat-card bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $s['label'] }}</span>
            <span class="w-10 h-10 rounded-lg flex items-center justify-center text-lg" style="background:{{ $s['bg'] }};color:{{ $s['iconColor'] }}">{!! $s['icon'] !!}</span>
        </div>
        <div class="flex items-end gap-3">
            <div class="stat-num text-3xl font-extrabold tracking-tight text-slate-800">{{ $s['value'] }}</div>
            @if($s['trend'] == 'up')
            <div class="mb-1.5 flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                +
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <h3 class="font-semibold text-base text-[#0F2A44] mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-500"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg> Pesanan per Bulan
        </h3>
        <div style="position: relative; width: 100%; height: 250px;">
            <canvas id="contactsChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <h3 class="font-semibold text-base text-[#0F2A44] mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-slate-500"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg> Pemasukan per Bulan
        </h3>
        <div style="position: relative; width: 100%; height: 250px;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</div>

{{-- Recent Contacts --}}
<div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
    <div class="flex justify-between items-center mb-5">
        <h3 class="font-semibold text-base text-[#0F2A44]">📥 Pesanan Terbaru</h3>
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
const revenueData = @json($revenueData);

new Chart(document.getElementById('contactsChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Jumlah Pesanan',
            data: contactData,
            backgroundColor: 'rgba(10,46,120,.7)',
            borderRadius: 6,
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#f3f4f6' } }, x: { grid: { display: false } } } }
});

const ctx = document.getElementById('revenueChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, 'rgba(22,159,129,0.35)');
gradient.addColorStop(1, 'rgba(22,159,129,0.0)');

new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Pemasukan (Rp)',
            data: revenueData,
            borderColor: '#169F81',
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#169F81',
            borderWidth: 2,
        }]
    },
    options: { 
        responsive: true, 
        plugins: { legend: { display: false } }, 
        scales: { 
            y: { 
                beginAtZero: true, 
                grid: { color: '#f3f4f6' },
                ticks: {
                    callback: function(value) {
                        if (value >= 1000000) return 'Rp ' + (value / 1000000) + 'M';
                        if (value >= 1000) return 'Rp ' + (value / 1000) + 'k';
                        return 'Rp ' + value;
                    }
                }
            }, 
            x: { grid: { display: false } } 
        } 
    }
});
</script>
@endpush
