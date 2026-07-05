<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – ROOTERA</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        :root{--sidebar-w:260px}
        body{background:#f1f5f9;font-family:'Inter',sans-serif}
        .admin-layout{display:flex;min-height:100vh}
        /* Sidebar */
        .sidebar{width:var(--sidebar-w);background:linear-gradient(180deg,#0A2E78 0%,#0d3a94 100%);position:fixed;top:0;left:0;height:100vh;overflow-y:auto;z-index:100;display:flex;flex-direction:column}
        .sidebar-logo{padding:1.75rem 1.5rem;border-bottom:1px solid rgba(255,255,255,.1)}
        .sidebar-logo a{font-family:'Plus Jakarta Sans',sans-serif;font-size:1.5rem;font-weight:800;color:#fff;display:block}
        .sidebar-logo span.era{color:#6ee7cc}
        .sidebar-label{padding:.75rem 1.5rem .3rem;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.4)}
        .sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.75rem 1.5rem;color:rgba(255,255,255,.75);font-size:.9rem;font-weight:500;transition:all .2s;border-left:3px solid transparent}
        .sidebar-link:hover{background:rgba(255,255,255,.08);color:#fff}
        .sidebar-link.active{background:rgba(22,159,129,.2);color:#6ee7cc;border-left-color:#6ee7cc}
        .sidebar-link svg{flex-shrink:0;opacity:.8}
        .sidebar-bottom{margin-top:auto;padding:1.5rem;border-top:1px solid rgba(255,255,255,.1)}
        /* Main */
        .admin-main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column}
        .admin-topbar{background:#fff;border-bottom:1px solid #e5e7eb;padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
        .admin-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:1.1rem;font-weight:700;color:#0A2E78}
        .admin-content{padding:2rem;flex:1}
        /* Cards */
        .stat-card{background:#fff;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb;transition:all .2s}
        .stat-card:hover{box-shadow:0 4px 20px rgba(10,46,120,.1);transform:translateY(-2px)}
        .stat-num{font-family:'Plus Jakarta Sans',sans-serif;font-size:2rem;font-weight:800;margin:.25rem 0}
        /* Tables */
        .admin-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(10,46,120,.06)}
        .admin-table th{background:#f8fafc;padding:.85rem 1rem;text-align:left;font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#374151;border-bottom:1px solid #e5e7eb}
        .admin-table td{padding:.85rem 1rem;border-bottom:1px solid #f3f4f6;font-size:.9rem;color:#374151;vertical-align:middle}
        .admin-table tr:last-child td{border-bottom:none}
        .admin-table tr:hover td{background:#fafafa}
        /* Status badges */
        .status-new{background:#dbeafe;color:#1d4ed8;padding:.2rem .65rem;border-radius:50px;font-size:.78rem;font-weight:600}
        .status-in_progress{background:#fef3c7;color:#92400e;padding:.2rem .65rem;border-radius:50px;font-size:.78rem;font-weight:600}
        .status-completed{background:#d1fae5;color:#065f46;padding:.2rem .65rem;border-radius:50px;font-size:.78rem;font-weight:600}
        .status-cancelled{background:#fee2e2;color:#991b1b;padding:.2rem .65rem;border-radius:50px;font-size:.78rem;font-weight:600}
        /* Buttons */
        .btn-sm{padding:.35rem .8rem;border-radius:8px;font-size:.8rem;font-weight:600;display:inline-flex;align-items:center;gap:.3rem;cursor:pointer;border:none;transition:all .2s}
        .btn-edit{background:#eff6ff;color:#1d4ed8}.btn-edit:hover{background:#dbeafe}
        .btn-del{background:#fef2f2;color:#dc2626}.btn-del:hover{background:#fee2e2}
        .btn-view{background:#f0fdf4;color:#16a34a}.btn-view:hover{background:#dcfce7}
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-layout">
    {{-- Sidebar --}}
    <aside class="sidebar" role="navigation" aria-label="Admin navigation">
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}">ROOT<span class="era">ERA</span></a>
            <span style="font-size:.75rem;color:rgba(255,255,255,.5);display:block;margin-top:.2rem">Panel Admin</span>
        </div>
        @php
        $nav = [
            ['route'=>'admin.dashboard','label'=>'Dashboard','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>'],
            ['route'=>'admin.articles.index','label'=>'Artikel / Blog','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>'],
            ['route'=>'admin.service-categories.index','label'=>'Kategori Layanan','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>'],
            ['route'=>'admin.service-areas.index','label'=>'Area Layanan','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>'],
            ['route'=>'admin.gallery.index','label'=>'Galeri Foto','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>'],
            ['route'=>'admin.contacts.index','label'=>'Pesanan / Kontak','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>'],
        ];
        @endphp
        <div style="padding:.75rem 0;flex:1">
            <div class="sidebar-label">Menu</div>
            @foreach($nav as $item)
            <a href="{{ route($item['route']) }}" class="sidebar-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                {!! $item['icon'] !!}
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
        <div class="sidebar-bottom">
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Lihat Website
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;color:rgba(255,255,255,.75);border-left:3px solid transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="admin-main">
        <header class="admin-topbar">
            <h1 class="admin-title">@yield('page-title', 'Dashboard')</h1>
            <div style="display:flex;align-items:center;gap:1rem">
                <span style="font-size:.88rem;color:#6b7280">
                    Halo, <strong style="color:#0A2E78">{{ auth()->user()->name }}</strong>
                </span>
            </div>
        </header>

        <main class="admin-content">
            @if(session('success'))
            <div class="alert alert-success alert-auto-dismiss" role="alert" style="margin-bottom:1.5rem">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @yield('admin-content')
        </main>
    </div>
</div>
@vite(['resources/js/app.js'])
@stack('scripts')
</body>
</html>
