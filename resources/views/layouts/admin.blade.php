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
            --primary: #0A111E;
            --primary-dark: #060B14;
            --accent: #1FAF5A;
            --accent-light: #a3f0c2;
            --bg-main: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --shadow-sm: 0 1px 3px 0 rgba(0,0,0,0.05), 0 1px 2px -1px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(15,42,68,0.05), 0 4px 6px -4px rgba(15,42,68,0.05);
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
            background: var(--primary);
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
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0.75rem;
            color: rgba(255,255,255,0.85);
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
            flex: 1;
        }

        /* Mobile Sidebar Overrides & Touch Friendly Targets */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            width: 44px;
            height: 44px;
            margin-right: 0.75rem;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            transition: background 0.2s;
        }

        .mobile-menu-btn:active {
            background: rgba(15, 42, 68, 0.08);
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 42, 68, 0.4);
            backdrop-filter: blur(4px);
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
                width: 100%;
                max-width: 100%;
                overflow-x: hidden;
            }
            .mobile-menu-btn {
                display: flex !important;
            }
            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }
            .admin-topbar {
                padding: 0.75rem 1rem;
            }
            .admin-content {
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                overflow-x: hidden;
            }
            .stat-num {
                font-size: 1.5rem;
            }
            
            /* Touch Friendly Targets on Mobile */
            .sidebar-link {
                padding: 0.85rem 1.25rem; /* Larger tap targets */
                margin: 0.3rem 0.75rem;
            }

            .btn-sm {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
                min-height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .form-group input, 
            .form-group select, 
            .form-group textarea {
                padding: 0.85rem 1rem;
                font-size: 16px !important; /* Prevents auto-zoom on iOS */
            }

            /* Global Fix untuk Inline Grid 2 Kolom (Form, Detail, Charts, dll.) */
            div[style*="grid-template-columns:1fr 320px"],
            div[style*="grid-template-columns: 1fr 320px"],
            div[style*="grid-template-columns:1fr 1fr"],
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            /* Global responsive table support */
            .admin-table-wrapper {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
                width: 100%;
                max-width: 100%;
                display: block;
                border-radius: var(--radius-md);
            }
            
            .admin-table th, .admin-table td {
                white-space: nowrap;
            }

            /* Alternative Card-Based Table Layout on Mobile */
            .table-responsive-card thead {
                display: none;
            }
            .table-responsive-card, 
            .table-responsive-card tbody, 
            .table-responsive-card tr, 
            .table-responsive-card td {
                display: block;
                width: 100%;
            }
            .table-responsive-card tr {
                background: #fff;
                border: 1px solid #e2e8f0;
                border-radius: var(--radius-md);
                padding: 1.25rem;
                margin-bottom: 1rem;
                box-shadow: var(--shadow-sm);
            }
            .table-responsive-card tr:last-child {
                margin-bottom: 0;
            }
            .table-responsive-card td {
                text-align: right;
                padding: 0.65rem 0;
                border-bottom: 1px solid #f1f5f9;
                font-size: 0.88rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                white-space: normal !important; /* Wrap content on mobile card */
            }
            .table-responsive-card td:last-child {
                border-bottom: none;
                padding-top: 0.85rem;
                justify-content: flex-end;
            }
            .table-responsive-card td::before {
                content: attr(data-label);
                font-weight: 700;
                text-transform: uppercase;
                font-size: 0.72rem;
                color: var(--text-muted);
                margin-right: 1.5rem;
                text-align: left;
                flex-shrink: 0;
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
            ['route'=>'admin.dashboard','label'=>'Dashboard','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>'],
            ['route'=>'admin.articles.index','label'=>'Artikel / Blog','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>'],
            ['route'=>'admin.service-categories.index','label'=>'Kategori Layanan','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 10 9 4-9 4"/><path d="m21 10-9 4 9 4"/><path d="m11 2 9 4-9 4-9-4 9-4z"/><path d="m11 22 9-4"/></svg>'],
            ['route'=>'admin.service-areas.index','label'=>'Area Layanan','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>'],
            ['route'=>'admin.gallery.index','label'=>'Galeri Foto','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>'],
            ['route'=>'admin.contacts.index','label'=>'Pesanan / Kontak','icon'=>'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>'],
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
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                FAQ
            </a>
            <a href="{{ route('admin.technologies.index') }}" class="sidebar-link {{ request()->routeIs('admin.technologies.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                Teknologi & Alat
            </a>
            <a href="{{ route('admin.service-sectors.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-sectors.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>
                Sektor Layanan
            </a>
            <a href="{{ route('admin.partners.index') }}" class="sidebar-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Mitra Kami
            </a>
            <a href="{{ route('admin.seo.index') }}" class="sidebar-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                SEO Central
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

        <main class="admin-content p-4 sm:p-6 lg:p-8">
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
