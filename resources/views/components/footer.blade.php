<footer class="footer" role="contentinfo">
    {{-- Wave SVG top --}}
    <div class="footer-wave" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#0A2E78"/>
        </svg>
    </div>

    <div class="footer-body">
        <div class="footer-container">
            {{-- Brand --}}
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo" aria-label="ROOTERA Beranda">
                    <img src="{{ asset('images/dark mode-notag.png') }}" alt="ROOTERA Logo" style="height: 220px; width: auto; object-fit: contain;">
                </a>
                <p class="footer-tagline">Solusi profesional untuk pipa dan saluran mampet. Cepat, tepat, bergaransi.</p>
                {{-- Social Links --}}
                <div class="footer-social" role="list" aria-label="Media sosial ROOTERA">
                    <a href="https://instagram.com/rootera.id" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram ROOTERA">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://facebook.com/rootera.id" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook ROOTERA">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="https://tiktok.com/@rootera.id" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="TikTok ROOTERA">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.84 4.84 0 0 1-1.01-.07z"/></svg>
                    </a>
                    <a href="https://wa.me/6281385404000" class="social-link" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp ROOTERA">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Navigation --}}
            <nav class="footer-nav" aria-label="Navigasi cepat footer">
                <h3 class="footer-heading">Navigasi</h3>
                <ul role="list">
                    <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                    <li><a href="{{ route('layanan') }}" class="footer-link">Layanan</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="footer-link">Tentang Kami</a></li>
                    <li><a href="{{ route('blog') }}" class="footer-link">Blog & Tips</a></li>
                    <li><a href="{{ route('area-layanan') }}" class="footer-link">Area Layanan</a></li>
                    <li><a href="{{ route('kontak') }}" class="footer-link">Kontak</a></li>
                </ul>
            </nav>

            {{-- Contact Info --}}
            <div class="footer-contact" aria-label="Informasi kontak">
                <h3 class="footer-heading">Kontak</h3>
                <address class="footer-address">
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.42 2 2 0 0 1 3.62 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/></svg>
                        <a href="tel:+6281385404000" class="footer-link">0813-8540-4000</a>
                    </div>
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:info@rootera.id" class="footer-link">info@rootera.id</a>
                    </div>
                    <div class="contact-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Jabodetabek, Cirebon, Semarang,<br>Yogyakarta, Lampung & Bandung</span>
                    </div>
                </address>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} <strong>ROOTERA</strong>. Hak cipta dilindungi undang-undang.</p>
            <p>Dibuat dengan ❤️ untuk pelanggan setia kami</p>
        </div>
    </div>
</footer>
