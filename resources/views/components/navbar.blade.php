<nav id="navbar" class="navbar" role="navigation" aria-label="Navigasi utama">
    <div class="nav-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo" aria-label="ROOTERA - Beranda">
            <span class="logo-root">ROOT</span><span class="logo-era">ERA</span>
        </a>

        {{-- Desktop Menu --}}
        <ul class="nav-menu" role="list">
            <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('layanan') }}" class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a></li>
            <li><a href="{{ route('tentang-kami') }}" class="nav-link {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
            <li><a href="{{ route('blog') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Pengetahuan</a></li>
            <li><a href="{{ route('area-layanan') }}" class="nav-link {{ request()->routeIs('area-layanan') ? 'active' : '' }}">Area Layanan</a></li>
        </ul>

        {{-- CTA Button --}}
        <a href="{{ route('kontak') }}" class="nav-cta" id="nav-cta-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.42 2 2 0 0 1 3.62 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/></svg>
            Hubungi Kami
        </a>

        {{-- Mobile Hamburger --}}
        <button class="nav-hamburger" id="hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
            <span></span><span></span><span></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Menu mobile">
        <ul role="list">
            <li><a href="{{ route('home') }}" class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('layanan') }}" class="mobile-link {{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a></li>
            <li><a href="{{ route('tentang-kami') }}" class="mobile-link {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
            <li><a href="{{ route('blog') }}" class="mobile-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Pengetahuan</a></li>
            <li><a href="{{ route('area-layanan') }}" class="mobile-link {{ request()->routeIs('area-layanan') ? 'active' : '' }}">Area Layanan</a></li>
            <li><a href="{{ route('kontak') }}" class="mobile-link mobile-cta">Hubungi Kami</a></li>
        </ul>
    </div>
</nav>
