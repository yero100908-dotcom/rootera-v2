<header id="navbar" class="glass-nav" role="banner">
    <div class="nav-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo flex items-center gap-2" aria-label="Rootera Plumbing - Beranda">
            <img src="{{ asset('images/logo-hijau.png') }}" alt="Logo Rootera Jasa Pipa Mampet" class="nav-logo-img" width="180" height="48" decoding="async">
        </a>

        {{-- Desktop Navigation Menu --}}
        <nav class="hidden lg:flex items-center" aria-label="Navigasi Utama">
            <ul class="nav-menu" role="list">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('layanan') }}" class="nav-link {{ request()->routeIs('layanan*') ? 'active' : '' }}">Layanan</a></li>
                <li><a href="{{ route('tentang-kami') }}" class="nav-link {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
                <li><a href="{{ route('galeri') }}" class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a></li>
                <li><a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Pengetahuan</a></li>
                <li><a href="{{ route('area-layanan') }}" class="nav-link {{ request()->routeIs('area-layanan*') ? 'active' : '' }}">Area Layanan</a></li>
            </ul>
        </nav>

        {{-- Desktop 24/7 Emergency Call CTA --}}
        <div class="hidden lg:flex items-center gap-3">
            <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20bantuan%20saluran%20mampet." class="nav-cta" target="_blank" rel="noopener noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.42 2 2 0 0 1 3.62 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/>
                </svg>
                <span>Hubungi Teknisi 24 Jam</span>
            </a>
        </div>

        {{-- Mobile Hamburger Trigger --}}
        <button class="nav-hamburger lg:hidden" id="hamburger-btn" aria-label="Buka Menu Navigasi" aria-expanded="false" aria-controls="mobile-drawer">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

{{-- Mobile Slide-out Drawer Overlay & Modal --}}
<div class="mobile-drawer-overlay" id="mobile-drawer-overlay" aria-hidden="true"></div>

<aside class="mobile-drawer" id="mobile-drawer" aria-label="Menu Mobile" aria-hidden="true">
    <div class="mobile-drawer-header">
        <a href="{{ route('home') }}" class="flex items-center gap-2" aria-label="Rootera Beranda">
            <img src="{{ asset('images/logo-hijau.png') }}" alt="Logo Rootera" style="height: 40px; width: auto;" decoding="async">
        </a>
        <button id="drawer-close-btn" class="p-2 text-slate-500 hover:text-slate-900 transition-colors" aria-label="Tutup Menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <div class="mobile-drawer-body">
        <ul class="mobile-drawer-menu" role="list">
            <li>
                <a href="{{ route('home') }}" class="mobile-drawer-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span>Beranda</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
            <li>
                <a href="{{ route('layanan') }}" class="mobile-drawer-link {{ request()->routeIs('layanan*') ? 'active' : '' }}">
                    <span>Layanan</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
            <li>
                <a href="{{ route('tentang-kami') }}" class="mobile-drawer-link {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">
                    <span>Tentang Kami</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
            <li>
                <a href="{{ route('galeri') }}" class="mobile-drawer-link {{ request()->routeIs('galeri') ? 'active' : '' }}">
                    <span>Galeri & Portofolio</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
            <li>
                <a href="{{ route('blog') }}" class="mobile-drawer-link {{ request()->routeIs('blog*') ? 'active' : '' }}">
                    <span>Pengetahuan & Blog</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
            <li>
                <a href="{{ route('area-layanan') }}" class="mobile-drawer-link {{ request()->routeIs('area-layanan*') ? 'active' : '' }}">
                    <span>Area Layanan Kota</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
            <li>
                <a href="{{ route('kontak') }}" class="mobile-drawer-link {{ request()->routeIs('kontak') ? 'active' : '' }}">
                    <span>Kontak Resmi</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </li>
        </ul>
    </div>

    <div class="mobile-drawer-footer">
        <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20bantuan%20saluran%20mampet." class="btn btn-primary w-full text-center py-3 flex items-center justify-center gap-2" target="_blank" rel="noopener noreferrer">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            <span>Chat WhatsApp 24 Jam</span>
        </a>
    </div>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const drawerOverlay = document.getElementById('mobile-drawer-overlay');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const drawerCloseBtn = document.getElementById('drawer-close-btn');

    // Scroll Header Shadow
    window.addEventListener('scroll', function () {
        if (window.scrollY > 20) {
            navbar?.classList.add('scrolled');
        } else {
            navbar?.classList.remove('scrolled');
        }
    });

    // Toggle Drawer
    function openDrawer() {
        hamburgerBtn?.classList.add('open');
        hamburgerBtn?.setAttribute('aria-expanded', 'true');
        drawerOverlay?.classList.add('open');
        mobileDrawer?.classList.add('open');
        mobileDrawer?.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        hamburgerBtn?.classList.remove('open');
        hamburgerBtn?.setAttribute('aria-expanded', 'false');
        drawerOverlay?.classList.remove('open');
        mobileDrawer?.classList.remove('open');
        mobileDrawer?.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    hamburgerBtn?.addEventListener('click', function () {
        if (mobileDrawer?.classList.contains('open')) {
            closeDrawer();
        } else {
            openDrawer();
        }
    });

    drawerCloseBtn?.addEventListener('click', closeDrawer);
    drawerOverlay?.addEventListener('click', closeDrawer);
});
</script>
