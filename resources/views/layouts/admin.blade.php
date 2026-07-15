<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – ROOTERA</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <style>
        :root {
            --sidebar-w: 260px;
            --primary: #0A2E78;
            --primary-dark: #051438;
            --accent: #169F81;
            --accent-light: #6ee7cc;
            --bg-main: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --shadow-sm: 0 1px 3px 0 rgba(0,0,0,0.05), 0 1px 2px -1px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(10,46,120,0.05), 0 4px 6px -4px rgba(10,46,120,0.05);
        }

        body {
            background: var(--bg-main);
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Modern SaaS Style */
        .sidebar {
            width: var(--sidebar-w);
            background: radial-gradient(circle at top left, var(--primary-dark), var(--primary));
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255,255,255,0.08);
            box-shadow: 4px 0 24px rgba(0,0,0,0.15);
        }

        .sidebar-logo {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 1rem;
        }

        .sidebar-logo a {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: #fff;
            display: block;
            letter-spacing: -0.02em;
        }

        .sidebar-logo span.era {
            color: var(--accent-light);
        }

        .sidebar-label {
            padding: 1rem 1.5rem 0.5rem;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.4);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            margin: 0.2rem 0.75rem;
            color: rgba(255,255,255,0.7);
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: var(--radius-sm);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: none;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(22,159,129,0.15) 0%, rgba(22,159,129,0.03) 100%);
            color: var(--accent-light);
            font-weight: 600;
            box-shadow: inset 3px 0 0 0 var(--accent);
        }

        .sidebar-link svg {
            flex-shrink: 0;
            opacity: 0.85;
            transition: transform 0.2s;
        }

        .sidebar-link:hover svg {
            transform: translateX(1px);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 1.25rem 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            background: rgba(0,0,0,0.15);
        }

        .sidebar-bottom .sidebar-link {
            margin: 0.15rem 0;
        }

        /* Topbar & Header */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .admin-topbar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 4px 12px -5px rgba(0,0,0,0.02);
        }

        .admin-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.01em;
        }

        .admin-content {
            padding: 2.25rem;
            flex: 1;
        }

        /* Mobile Sidebar Overrides */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            padding: 0.2rem;
            margin-right: 0.75rem;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(2px);
            z-index: 90;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .mobile-menu-btn {
                display: flex !important;
            }
            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }
            .admin-topbar {
                padding: 0.85rem 1.25rem;
            }
            .admin-content {
                padding: 1.25rem;
            }
            .stat-num {
                font-size: 1.5rem;
            }
            
            /* Global Fix untuk Inline Grid 2 Kolom (Form, Detail, Charts) */
            div[style*="grid-template-columns:1fr 320px"],
            div[style*="grid-template-columns: 1fr 320px"],
            div[style*="grid-template-columns:1fr 1fr"],
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
            
            /* Global Fix untuk Tabel di Mobile */
            .admin-main {
                margin-left: 0;
                width: 100%;
                max-width: 100%;
                overflow-x: hidden;
                box-sizing: border-box;
            }
            .admin-content {
                padding: 1rem;
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                overflow-x: hidden;
            }
            .admin-table-wrapper {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
                width: 100%;
                max-width: 100%;
                display: block;
            }
            .admin-table th, .admin-table td {
                white-space: nowrap;
            }
        }

        /* Modernized Cards */
        .stat-card {
            background: #fff;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
            border-color: #cbd5e1;
        }

        .stat-num {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.85rem;
            font-weight: 800;
            margin: 0.3rem 0;
            letter-spacing: -0.02em;
        }

        /* Modern Tables */
        .admin-table-wrapper {
            background: #fff;
            border-radius: var(--radius-lg);
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            background: #f8fafc;
            padding: 0.95rem 1.25rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.88rem;
            color: #334155;
            vertical-align: middle;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .admin-table tr:hover td {
            background: #f8fafc;
        }

        /* Clean modern badges */
        .status-new {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-in_progress {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fef3c7;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-completed {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #d1fae5;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-cancelled {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fee2e2;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Reusable UI Buttons */
        .btn-sm {
            padding: 0.4rem 0.85rem;
            border-radius: var(--radius-sm);
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #f0fdfa;
            color: var(--accent);
            border-color: #ccfbf1;
        }
        .btn-edit:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .btn-del {
            background: #fff5f5;
            color: #e53e3e;
            border-color: #fed7d7;
        }
        .btn-del:hover {
            background: #e53e3e;
            color: #fff;
            border-color: #e53e3e;
        }

        .btn-view {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #dbeafe;
        }
        .btn-view:hover {
            background: #1d4ed8;
            color: #fff;
            border-color: #1d4ed8;
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-layout">
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    <aside class="sidebar" id="adminSidebar" role="navigation" aria-label="Admin navigation">
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
            <div class="sidebar-label">Menu Utama</div>
            @foreach($nav as $item)
            <a href="{{ route($item['route']) }}" class="sidebar-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                {!! $item['icon'] !!}
                {{ $item['label'] }}
            </a>
            @endforeach

            <div class="sidebar-label" style="margin-top:.75rem">Konten CMS</div>
            <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                FAQ
            </a>
            <a href="{{ route('admin.technologies.index') }}" class="sidebar-link {{ request()->routeIs('admin.technologies.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                Teknologi & Alat
            </a>
            <a href="{{ route('admin.service-sectors.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-sectors.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                Sektor Layanan
            </a>
            <a href="{{ route('admin.partners.index') }}" class="sidebar-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Mitra Kami
            </a>
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
            <div style="display:flex;align-items:center;">
                <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <h1 class="admin-title">@yield('page-title', 'Dashboard')</h1>
            </div>
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
<script>
    function toggleSidebar() {
        document.getElementById('adminSidebar').classList.toggle('active');
        const overlay = document.getElementById('sidebarOverlay');
        if (overlay.classList.contains('active')) {
            overlay.style.opacity = '0';
            setTimeout(() => overlay.classList.remove('active'), 300);
        } else {
            overlay.classList.add('active');
            // Trigger reflow
            void overlay.offsetWidth;
            overlay.style.opacity = '1';
        }
    }
</script>
@stack('scripts')
</body>
</html>
