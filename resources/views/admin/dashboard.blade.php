@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('admin-content')
{{-- Stats Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.25rem;margin-bottom:2rem">
    @php
    $stats = [
        ['label'=>'Total Pesanan','value'=>$totalContacts,'icon'=>'📋','color'=>'#0A2E78','bg'=>'rgba(10,46,120,.08)'],
        ['label'=>'Pesanan Baru','value'=>$newContacts,'icon'=>'🆕','color'=>'#1E73D8','bg'=>'rgba(30,115,216,.08)'],
        ['label'=>'Selesai','value'=>$completedOrders,'icon'=>'✅','color'=>'#169F81','bg'=>'rgba(22,159,129,.08)'],
        ['label'=>'Total Pemasukan','value'=>'Rp '.number_format($totalRevenue,0,',','.'),'icon'=>'💰','color'=>'#169F81','bg'=>'rgba(22,159,129,.08)'],
        ['label'=>'Artikel','value'=>$totalArticles,'icon'=>'📰','color'=>'#0A2E78','bg'=>'rgba(10,46,120,.08)'],
        ['label'=>'Kategori Layanan','value'=>$totalCategories,'icon'=>'🗂️','color'=>'#eab308','bg'=>'rgba(234,179,8,.1)'],
        ['label'=>'Area Layanan','value'=>$totalAreas,'icon'=>'📍','color'=>'#ef4444','bg'=>'rgba(239,68,68,.1)'],
        ['label'=>'Galeri','value'=>$totalGalleries,'icon'=>'🖼️','color'=>'#8b5cf6','bg'=>'rgba(139,92,246,.1)'],
        ['label'=>'FAQ','value'=>$totalFaqs,'icon'=>'❓','color'=>'#0ea5e9','bg'=>'rgba(14,165,233,.1)'],
        ['label'=>'Alat & Tech','value'=>$totalTechs,'icon'=>'🔧','color'=>'#f97316','bg'=>'rgba(249,115,22,.1)'],
        ['label'=>'Sektor','value'=>$totalSectors,'icon'=>'🏢','color'=>'#14b8a6','bg'=>'rgba(20,184,166,.1)'],
    ];
    @endphp
    @foreach($stats as $s)
    <div class="stat-card" style="background:#fff;border-radius:12px;padding:1.25rem;border:1px solid #e5e7eb;box-shadow:0 1px 2px rgba(0,0,0,0.05)">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
            <span style="font-size:.75rem;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:.05em">{{ $s['label'] }}</span>
            <span style="width:36px;height:36px;background:{{ $s['bg'] }};border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.1rem">{{ $s['icon'] }}</span>
        </div>
        <div class="stat-num" style="color:{{ $s['color'] }};font-size:1.5rem;font-weight:800;font-family:'Plus Jakarta Sans',sans-serif">{{ $s['value'] }}</div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem">
    <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1rem;color:#0A2E78;margin-bottom:1.25rem">📊 Pesanan per Bulan</h3>
        <canvas id="contactsChart" height="250"></canvas>
    </div>
    <div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1rem;color:#0A2E78;margin-bottom:1.25rem">💰 Pemasukan per Bulan</h3>
        <canvas id="revenueChart" height="250"></canvas>
    </div>
</div>

{{-- Recent Contacts --}}
<div style="background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem">
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1rem;color:#0A2E78">📥 Pesanan Terbaru</h3>
        <a href="{{ route('admin.contacts.index') }}" style="font-size:.85rem;color:#169F81;font-weight:600">Lihat Semua →</a>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead><tr><th>Nama</th><th>Telepon</th><th>Layanan</th><th>Area</th><th>Status</th><th>Tanggal</th></tr></thead>
            <tbody>
            @foreach($recentContacts as $c)
            <tr>
                <td><strong>{{ $c->name }}</strong></td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->service_type ?? '-' }}</td>
                <td>{{ $c->area ?? '-' }}</td>
                <td><span class="status-{{ $c->status }}">{{ $c->status_label }}</span></td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>
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
