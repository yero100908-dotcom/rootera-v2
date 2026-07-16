@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('admin-content')
{{-- Stats Grid --}}
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
    @php
    $stats = [
        ['label'=>'Total Pesanan','value'=>$totalContacts,'icon'=>'📋','color'=>'#0F2A44','bg'=>'rgba(15,42,68,.08)'],
        ['label'=>'Pesanan Baru','value'=>$newContacts,'icon'=>'🆕','color'=>'#1E73D8','bg'=>'rgba(30,115,216,.08)'],
        ['label'=>'Selesai','value'=>$completedOrders,'icon'=>'✅','color'=>'#1FAF5A','bg'=>'rgba(31,175,90,.08)'],
        ['label'=>'Total Pemasukan','value'=>'Rp '.number_format($totalRevenue,0,',','.'),'icon'=>'💰','color'=>'#1FAF5A','bg'=>'rgba(31,175,90,.08)'],
        ['label'=>'Artikel','value'=>$totalArticles,'icon'=>'📰','color'=>'#0F2A44','bg'=>'rgba(15,42,68,.08)'],
        ['label'=>'Kategori Layanan','value'=>$totalCategories,'icon'=>'🗂️','color'=>'#eab308','bg'=>'rgba(234,179,8,.1)'],
        ['label'=>'Area Layanan','value'=>$totalAreas,'icon'=>'📍','color'=>'#ef4444','bg'=>'rgba(239,68,68,.1)'],
        ['label'=>'Galeri','value'=>$totalGalleries,'icon'=>'🖼️','color'=>'#8b5cf6','bg'=>'rgba(139,92,246,.1)'],
        ['label'=>'FAQ','value'=>$totalFaqs,'icon'=>'❓','color'=>'#0ea5e9','bg'=>'rgba(14,165,233,.1)'],
        ['label'=>'Alat & Tech','value'=>$totalTechs,'icon'=>'🔧','color'=>'#f97316','bg'=>'rgba(249,115,22,.1)'],
        ['label'=>'Sektor','value'=>$totalSectors,'icon'=>'🏢','color'=>'#14b8a6','bg'=>'rgba(20,184,166,.1)'],
        ['label'=>'Mitra','value'=>$totalPartners,'icon'=>'🤝','color'=>'#ec4899','bg'=>'rgba(236,72,153,.1)'],
    ];
    @endphp
    @foreach($stats as $s)
    <div class="stat-card bg-white rounded-xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition duration-300">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $s['label'] }}</span>
            <span class="w-9 h-9 rounded-lg flex items-center justify-center text-lg" style="background:{{ $s['bg'] }}">{{ $s['icon'] }}</span>
        </div>
        <div class="stat-num text-2xl font-extrabold tracking-tight" style="color:{{ $s['color'] }}">{{ $s['value'] }}</div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <h3 class="font-semibold text-base text-[#0F2A44] mb-4 flex items-center gap-2">
            <span>📊</span> Pesanan per Bulan
        </h3>
        <div style="position: relative; width: 100%; height: 250px;">
            <canvas id="contactsChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
        <h3 class="font-semibold text-base text-[#0F2A44] mb-4 flex items-center gap-2">
            <span>💰</span> Pemasukan per Bulan
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

new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Pemasukan (Rp)',
            data: revenueData,
            borderColor: '#169F81',
            backgroundColor: 'rgba(22,159,129,.1)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#169F81',
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: '#f3f4f6' } }, x: { grid: { display: false } } } }
});
</script>
@endpush
