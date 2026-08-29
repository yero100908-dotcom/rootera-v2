<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') – Rootera Plumbing</title>
    <meta name="robots" content="noindex,nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/brand/favicon-rooteraplumbing-jasa-saluran-pipa-mampet.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <style>
        :root {
            --sidebar-w: 265px;
            --primary: #070F1E;
            --primary-dark: #040914;
            --accent: #169F81;
            --accent-light: #34d399;
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

        /* Sidebar Modern Enterprise Style */
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

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.15);
            border-radius: 4px;
        }

        .sidebar-logo {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 0.75rem;
        }

        .sidebar-logo a {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: -0.02em;
        }

        .sidebar-logo span.era {
            color: var(--accent-light);
        }

        .sidebar-label {
            padding: 0.85rem 1.25rem 0.35rem;
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255,255,255,0.4);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.7rem 1rem;
            margin: 0.2rem 0.75rem;
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: var(--radius-sm);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(22,159,129,0.2) 0%, rgba(22,159,129,0.04) 100%);
            color: var(--accent-light);
            font-weight: 700;
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
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            background: rgba(0,0,0,0.2);
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
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 4px 12px -5px rgba(0,0,0,0.03);
        }

        .admin-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.01em;
        }

        .admin-content {
            flex: 1;
        }

        /* Mobile Sidebar Drawer */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            width: 44px;
            height: 44px;
            margin-right: 0.5rem;
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
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-layout">
    <!-- Sidebar Overlay for Mobile Drawer -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- Sidebar Navigation --}}
    <aside class="sidebar" id="adminSidebar" role="navigation" aria-label="Admin navigation">
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}">
                <span class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white text-sm font-extrabold shadow-sm">R</span>
                <span>ROOT<span class="era">ERA</span></span>
            </a>
            <span style="font-size:.72rem;color:rgba(255,255,255,.5);display:block;margin-top:.3rem;font-weight:600">Panel Control &amp; System Management</span>
        </div>

        @php
        $unreadContactsCount = \App\Models\Contact::where('status', 'new')->count();
        @endphp

        <div style="padding:.25rem 0;flex:1">
            {{-- Group 1: Utama --}}
            <div class="sidebar-label">Main System</div>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                <span>Pesanan / Kontak</span>
                @if($unreadContactsCount > 0)
                <span class="ml-auto bg-emerald-500 text-slate-950 text-[10px] font-extrabold px-2 py-0.5 rounded-full shadow-sm">
                    {{ $unreadContactsCount }} BARU
                </span>
                @endif
            </a>

            {{-- Group 2: Content CMS & Local SEO --}}
            <div class="sidebar-label" style="margin-top:.85rem">Konten CMS &amp; SEO</div>

            <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                Artikel / Blog
            </a>

            <a href="{{ route('admin.service-categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-categories.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 10 9 4-9 4"/><path d="m21 10-9 4 9 4"/><path d="m11 2 9 4-9 4-9-4 9-4z"/><path d="m11 22 9-4"/></svg>
                Kategori Layanan
            </a>

            <a href="{{ route('admin.service-areas.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-areas.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                Area Layanan
            </a>

            <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                Galeri Foto &amp; Video
            </a>

            <a href="{{ route('admin.project-galleries.index') }}" class="sidebar-link {{ request()->routeIs('admin.project-galleries.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><polyline points="11 3 11 11 14 8 17 11 17 3"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Portofolio Proyek
            </a>

            <a href="{{ route('admin.cities.index') }}" class="sidebar-link {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                Kota &amp; Wilayah SEO
            </a>

            {{-- Group 3: Company & Settings --}}
            <div class="sidebar-label" style="margin-top:.85rem">Perusahaan &amp; Settings</div>

            <a href="{{ route('admin.service-sectors.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-sectors.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>
                Sektor Layanan
            </a>

            <a href="{{ route('admin.partners.index') }}" class="sidebar-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Mitra Kami
            </a>

            <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                FAQ System
            </a>

            <a href="{{ route('admin.technologies.index') }}" class="sidebar-link {{ request()->routeIs('admin.technologies.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                Teknologi &amp; Alat
            </a>

            <a href="{{ route('admin.seo.index') }}" class="sidebar-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                SEO Central
            </a>

            <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                Pengaturan Web
            </a>
        </div>

        <div class="sidebar-bottom">
            <a href="{{ route('home') }}" class="sidebar-link" target="_blank" rel="noopener">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Lihat Website Utama
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link hover:text-rose-400" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content Area --}}
    <div class="admin-main">
        {{-- Topbar Header --}}
        <header class="admin-topbar">
            <div style="display:flex;align-items:center;">
                <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <h1 class="admin-title">@yield('page-title', 'Dashboard')</h1>
                <span id="realtime-clock" class="text-xs text-slate-400 font-medium hidden sm:inline-block ml-4 pl-4 border-l border-slate-200"></span>
            </div>

            <div style="display:flex;align-items:center;gap:1.25rem">
                {{-- System Health Indicator --}}
                <span class="hidden md:inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-3 py-1 rounded-full shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> DB &amp; System Online
                </span>

                {{-- User Profile Badge --}}
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#0A2E78] text-white flex items-center justify-center font-extrabold text-xs shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="text-xs sm:text-sm text-slate-600 font-medium hidden sm:inline-block">
                        Halo, <strong class="text-slate-900 font-bold">{{ auth()->user()->name }}</strong>
                    </span>
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main class="admin-content p-4 sm:p-6 lg:p-8">
            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold p-4 rounded-2xl mb-6 flex items-center gap-3 shadow-xs" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-600"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(isset($errors) && $errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl mb-6 shadow-xs">
                <div class="font-bold text-sm mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-rose-600"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Terjadi Kesalahan Form:
                </div>
                <ul class="margin-0 padding-left-1.25rem text-xs sm:text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
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
            void overlay.offsetWidth;
            overlay.style.opacity = '1';
        }
    }

    // Realtime Clock JavaScript
    function updateClock() {
        const clock = document.getElementById('realtime-clock');
        if (clock) {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour12: false });
            const dateStr = now.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' });
            clock.textContent = `${dateStr} • ${timeStr} WIB`;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@stack('scripts')
</body>
</html>
