<?php

namespace App\Http\Controllers;

use App\Models\ServiceSector;
use App\Models\Gallery;

class AboutController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Tentang Kami - Rootera Plumbing | Pionir Jasa Pipa Mampet & Drainase Tanpa Bongkar',
            'description' => 'Mengenal Rootera Plumbing, spesialis pelancaran pipa mampet, saluran air, dan drainase modern tanpa bongkar bergaransi. Didukung 50+ teknisi tersertifikasi K3 & teknologi Ridgid & Hydro-Jetting.',
            'keywords'    => 'Jasa pipa mampet tanpa bongkar, hydro jetting profesional, deteksi cctv pipa, teknisi plumbing bergaransi, rootera plumbing, tim teknisi plumbing',
            'canonical'   => url('/tentang-kami'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        $sectors = ServiceSector::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        if ($sectors->isEmpty()) {
            $sectors = collect([
                [
                    'sector_name' => 'Restoran, Cafe, Cloud Kitchen & F&B',
                    'slug' => 'restoran-cafe',
                    'icon' => '🍽️',
                    'badge' => 'Residensial & F&B',
                    'short_description' => 'Penanganan kerak lemak jenuh kitchen sink & grease trap restoran tanpa mengganggu jam operasional.',
                ],
                [
                    'sector_name' => 'Hotel, Resort, Apartemen & Kos Eksklusif',
                    'slug' => 'hotel-apartemen',
                    'icon' => '🏨',
                    'badge' => 'Komersial & Hospitality',
                    'short_description' => 'Maintenance pipa vertical riser stack & drainase kamar mandi bertingkat tanpa getaran & bising.',
                ],
                [
                    'sector_name' => 'Rumah Sakit, Klinik & Fasilitas Kesehatan',
                    'slug' => 'rumah-sakit-klinik',
                    'icon' => '🏥',
                    'badge' => 'Fasilitas Medis',
                    'short_description' => 'Penanganan limbah cair non-infeksius & drainase medis dengan SOP higienis steril bebas kimia korosif.',
                ],
                [
                    'sector_name' => 'Pabrik, Manufaktur & Pergudangan',
                    'slug' => 'pabrik-industri',
                    'icon' => '🏭',
                    'badge' => 'Kawasan Industri',
                    'short_description' => 'Hydro-Jetting tekanan tinggi hingga 300 Bar untuk pipa limbah manufaktur diameter besar.',
                ],
                [
                    'sector_name' => 'Gedung Perkantoran & Coworking Space',
                    'slug' => 'perkantoran-coworking',
                    'icon' => '🏢',
                    'badge' => 'Perkantoran & B2B',
                    'short_description' => 'Preventive maintenance saluran pantry & toilet karyawan office dengan dukungan faktur PPN.',
                ],
                [
                    'sector_name' => 'Instansi Pemerintah, Swasta & Kampus',
                    'slug' => 'instansi-kampus',
                    'icon' => '🏛️',
                    'badge' => 'Institusi & Pendidikan',
                    'short_description' => 'Pengadaan jasa pelancaran drainase gedung publik & institusi dengan kelengkapan tender B2B.',
                ],
                [
                    'sector_name' => 'Mall, Shopping Center & Food Court',
                    'slug' => 'mall-shopping-center',
                    'icon' => '🏬',
                    'badge' => 'Pusat Perbelanjaan',
                    'short_description' => 'Penanganan terpadu drainase mall & grease trap food court dengan penanganan shift malam.',
                ],
                [
                    'sector_name' => 'Kawasan Ruko & Kompleks Bisnis',
                    'slug' => 'ruko-kompleks-bisnis',
                    'icon' => '🏪',
                    'badge' => 'Kompleks Bisnis',
                    'short_description' => 'Solusi cepat perbaikan pipa tersumbat ruko usaha, salon, laundry & bak kontrol bersama.',
                ],
            ]);
        }

        $advantages = [
            [
                'title' => '100% Non-Destructive Method',
                'description' => 'Tanpa Pembongkaran Keramik & Dinding. Menggunakan metode mekanis canggih dan tekanan air presisi yang menjaga struktur properti tetap utuh dan estetis.',
                'badge' => 'Tanpa Bongkar',
                'icon' => '🛡️'
            ],
            [
                'title' => 'Teknologi Spiral & CCTV Pipe Scan',
                'description' => 'Kamera mikro waterproof 1080p melacak posisi sumbatan dengan presisi 99.9%, dikombinasikan mesin Ridgid Amerika fleksibel.',
                'badge' => 'Teknologi Presisi',
                'icon' => '📷'
            ],
            [
                'title' => 'Garansi Resmi 30 Hari (Tuntas Baru Bayar)',
                'description' => 'Perlindungan penuh pengerjaan susulan tanpa biaya tambahan. Pembayaran dilakukan hanya setelah alur debit air teruji lancar.',
                'badge' => 'Garansi 30 Hari',
                'icon' => '💎'
            ],
            [
                'title' => 'Standar Higienis & APD K3 Terverifikasi',
                'description' => '100% Bebas Asam Kimia Korosif. Alat disterilkan berkala, teknisi mengenakan APD K3 standar industri untuk keamanan total.',
                'badge' => 'Standar K3',
                'icon' => '✨'
            ],
        ];

        // Standardized SEO Staff Data
        $teamMembers = [
            [
                'name'  => 'Rafael Abimanyu',
                'role'  => 'Founder & Lead Director',
                'badge' => 'Leadership',
                'image' => asset('assets/staff/rafael-abimanyu-rootera-plumbing.webp'),
                'alt'   => 'Foto Rafael Abimanyu - Founder & Lead Director Rootera Plumbing',
            ],
            [
                'name'  => 'Yero Virdhan',
                'role'  => 'IT & Software Lead',
                'badge' => 'IT & Systems',
                'image' => asset('assets/staff/yero-virdhan-it-rootera-plumbing.webp'),
                'alt'   => 'Foto Yero Virdhan - IT & Software Lead Rootera Plumbing',
            ],
            [
                'name'  => 'Ariana Mikayla',
                'role'  => 'IT & Digital Systems',
                'badge' => 'IT Support',
                'image' => asset('assets/staff/ariana-mikayla-it-rootera-plumbing.webp'),
                'alt'   => 'Foto Ariana Mikayla - IT & Digital Systems Rootera Plumbing',
            ],
            [
                'name'  => 'Ghaitsaa',
                'role'  => 'Customer Service & Dispatcher 24/7',
                'badge' => 'Customer Care',
                'image' => asset('assets/staff/ghaitsaa-customer-service-rootera-plumbing.webp'),
                'alt'   => 'Foto Ghaitsaa - Customer Service & Dispatcher 24/7 Rootera Plumbing',
            ],
            [
                'name'  => 'Maura',
                'role'  => 'Marketing Specialist',
                'badge' => 'Marketing',
                'image' => asset('assets/staff/maura-marketing-rootera-plumbing.webp'),
                'alt'   => 'Foto Maura - Marketing Specialist Rootera Plumbing',
            ],
            [
                'name'  => 'Yoga',
                'role'  => 'Marketing Specialist',
                'badge' => 'Marketing',
                'image' => asset('assets/staff/yoga-marketing-rootera-plumbing.webp'),
                'alt'   => 'Foto Yoga - Marketing Specialist Rootera Plumbing',
            ],
            [
                'name'  => 'Rafa R',
                'role'  => 'Social Media Manager',
                'badge' => 'Social Media',
                'image' => asset('assets/staff/rafa-r-manage-sosmed-rootera-plumbing.webp'),
                'alt'   => 'Foto Rafa R - Social Media Manager Rootera Plumbing',
            ],
            [
                'name'  => 'Aries',
                'role'  => 'Teknisi Plumbing Senior',
                'badge' => 'Teknisi Senior',
                'image' => asset('assets/staff/aries-teknisi-plumbing-senior-rootera-plumbing.webp'),
                'alt'   => 'Foto Aries - Teknisi Plumbing Senior Rootera Plumbing',
            ],
            [
                'name'  => 'Harmoko',
                'role'  => 'Teknisi Plumbing Senior',
                'badge' => 'Teknisi Senior',
                'image' => asset('assets/staff/harmoko-teknisi-plumbing-senior-rootera-plumbing.webp'),
                'alt'   => 'Foto Harmoko - Teknisi Plumbing Senior Rootera Plumbing',
            ],
            [
                'name'  => 'Ikbal Ramadhan',
                'role'  => 'Teknisi Saluran Senior',
                'badge' => 'Teknisi Senior',
                'image' => asset('assets/staff/ikbal-ramadhan-teknisi-saluran-senior-rootera-plumbing.webp'),
                'alt'   => 'Foto Ikbal Ramadhan - Teknisi Saluran Senior Rootera Plumbing',
            ],
            [
                'name'  => 'Andi',
                'role'  => 'Teknisi Inspeksi Kamera CCTV',
                'badge' => 'CCTV Specialist',
                'image' => asset('assets/staff/andi-teknisi-inspeksi-kamera-rootera-plumbing.webp'),
                'alt'   => 'Foto Andi - Teknisi Inspeksi Kamera CCTV Rootera Plumbing',
            ],
            [
                'name'  => 'Ramadhan',
                'role'  => 'Teknisi Instalasi & Perbaikan Pipa',
                'badge' => 'Teknisi Instalasi',
                'image' => asset('assets/staff/ramadhan-teknisi-instalasi-pemasangan-dan-perbaikan-pipa-rootera-plumbing.webp'),
                'alt'   => 'Foto Ramadhan - Teknisi Instalasi Pipa Rootera Plumbing',
            ],
            [
                'name'  => 'Andre',
                'role'  => 'Teknisi Konstruksi Pembangunan',
                'badge' => 'Teknisi Konstruksi',
                'image' => asset('assets/staff/andre-teknisi-konstruksi-pembangunan-rootera-plumbing.webp'),
                'alt'   => 'Foto Andre - Teknisi Konstruksi Rootera Plumbing',
            ],
            [
                'name'  => 'Agus',
                'role'  => 'Teknisi Support',
                'badge' => 'Teknisi Support',
                'image' => asset('assets/staff/agus-teknisi-support-rootera-plumbing.webp'),
                'alt'   => 'Foto Agus - Teknisi Support Rootera Plumbing',
            ],
            [
                'name'  => 'Wendi',
                'role'  => 'Teknisi Junior',
                'badge' => 'Teknisi Junior',
                'image' => asset('assets/staff/wendi-teknisi-junior-rootera-plumbing.webp'),
                'alt'   => 'Foto Wendi - Teknisi Junior Rootera Plumbing',
            ],
        ];

        $documentationGallery = [];
        $sopSteps = [];
        $technologies = [];

        return view('pages.tentang-kami', compact(
            'seo', 'sectors', 'advantages', 'teamMembers', 
            'documentationGallery', 'sopSteps', 'technologies'
        ));
    }

    public function profil()
    {
        $seo = [
            'title'       => 'Profil Perusahaan & Standar K3 - Rootera Plumbing',
            'description' => 'Profil resmi Rootera Plumbing (J&J Group), legalitas usaha, komitmen keselamatan kerja K3, SOP higienis, serta kelengkapan administrasi B2B.',
            'canonical'   => url('/tentang-kami/profil'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.profil', compact('seo'));
    }

    public function peralatanTeknologi()
    {
        $seo = [
            'title'       => 'Peralatan & Teknologi Modern Tanpa Bongkar - Rootera Plumbing',
            'description' => 'Spesifikasi mesin Ridgid K-50/K-60, Kamera Inspeksi CCTV 1080p waterproof, dan Hydro Jetting 300 Bar untuk pelancaran pipa mampet presisi.',
            'canonical'   => url('/tentang-kami/peralatan-teknologi'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.peralatan-teknologi', compact('seo'));
    }

    public function portofolioKlien()
    {
        $seo = [
            'title'       => 'Kemitraan & Portofolio Klien Komersial - Rootera Plumbing',
            'description' => 'Kemitraan dan portofolio pengerjaan pelancaran pipa mampet B2B di restoran F&B, mall, supermarket, transportasi BUMN, dan kawasan industri oleh Rootera Plumbing.',
            'canonical'   => url('/tentang-kami/portofolio-klien'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        $partnerPortfolio = [
            [
                'name' => 'Mie Gacoan',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Outlets & Cloud Kitchen',
                'service_type' => 'Pembersihan Lemak Kitchen Sink & Hydro Jetting',
                'logo' => asset('assets/mitra/gacoan-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pelancar-saluran-gutter-resto-jakarta.webp'),
                'badge' => '⚡ Shift Malam 24 Jam',
                'alt' => 'Logo Mie Gacoan - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pelancaran saluran mampet kitchen sink dan pembersihan kerak minyak padat pada jaringan pipa outlet restoran.',
            ],
            [
                'name' => 'KFC Indonesia',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Fast Food Restaurant',
                'service_type' => 'Maintenance Rutin Pipa Limbah & Grease Trap',
                'logo' => asset('assets/mitra/kfc-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pembersihan-grease-trap-restoran.webp'),
                'badge' => '🛡️ Kontrak Perawatan B2B',
                'alt' => 'Logo KFC Indonesia - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Maintenance pencegahan penyumbatan pipa grease trap dan drainase utama kitchen area.',
            ],
            [
                'name' => 'McDonald\'s',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Drive-Thru & Dine-in Outlet',
                'service_type' => 'Pelancaran Saluran Mampet & CCTV Scan',
                'logo' => asset('assets/mitra/mcd-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/inspeksi-kamera-cctv-pipa-tersumbat.webp'),
                'badge' => '📹 Inspeksi CCTV 1080p',
                'alt' => 'Logo McDonald\'s - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Inspeksi lokasi penyumbatan pipa dengan micro kamera CCTV 1080p dan pelancaran tanpa bongkar.',
            ],
            [
                'name' => 'Pertamina Sunter',
                'category_slug' => 'transportasi-bumn',
                'category_label' => 'Transportasi & BUMN',
                'property_type' => 'Fasilitas SPBU & Perkantoran BUMN',
                'service_type' => 'Pelancaran Floor Drain & Trench Drain',
                'logo' => asset('assets/mitra/pertamina-sunter-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pelancar-saluran-pertamina-sunter-jakarta.webp'),
                'badge' => '🏛️ BUMN & SPK Resmi',
                'alt' => 'Logo Pertamina Sunter - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Penanganan sumbatan saluran air hujan dan floor drain area operasional SPBU Pertamina Sunter.',
            ],
            [
                'name' => 'Restoran Kembang Bawang',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Dine-In Family Restaurant',
                'service_type' => 'Pelancaran Waste Pipe & Grease Trap',
                'logo' => asset('assets/mitra/restoran-kembang-bawang-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pembersihan-lemak-bak-kontrol-resto.webp'),
                'badge' => '✨ 100% Non-Bongkar',
                'alt' => 'Logo Restoran Kembang Bawang - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pembersihan endapan sisa makanan dan lemak pada saluran sink utama dapur restoran.',
            ],
            [
                'name' => 'Restoran Riase',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Authentic Culinary Restaurant',
                'service_type' => 'Spiral Cable Cleaning Ridgid',
                'logo' => asset('assets/mitra/restoran-riase-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/servis-ridgid-gutter-resto-mampet.webp'),
                'badge' => '🔧 Ridgid Machine USA',
                'alt' => 'Logo Restoran Riase - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pelancaran cepat tanpa membongkar lantai dapur dengan mesin kabel spiral fleksibel Ridgid.',
            ],
            [
                'name' => 'Richeese Factory',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Fast Food Chain',
                'service_type' => 'Hydro Jetting & Grease Management',
                'logo' => asset('assets/mitra/richeese-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/after-gutter-resto-bersih-rootera.webp'),
                'badge' => '🌊 Hydro-Jetting 300 Bar',
                'alt' => 'Logo Richeese Factory - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pengikisan kerak lemak saus dan minyak dengan Hydro Jetting air tekanan tinggi 300 Bar.',
            ],
            [
                'name' => 'Stasiun KAI Lempuyangan',
                'category_slug' => 'transportasi-bumn',
                'category_label' => 'Transportasi & BUMN',
                'property_type' => 'Stasiun Kereta Api Publik (BUMN)',
                'service_type' => 'Pelancaran Gutter Drain & Toilet Publik',
                'logo' => asset('assets/mitra/stasiun-kai-lempuyangan-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp'),
                'badge' => '🚉 Fasilitas Publik BUMN',
                'alt' => 'Logo Stasiun KAI Lempuyangan - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Perbaikan dan pembersihan berkala saluran drainase toilet pengunjung dan talang stasiun.',
            ],
            [
                'name' => 'Superindo Supermarket',
                'category_slug' => 'mall-supermarket',
                'category_label' => 'Mall & Supermarket',
                'property_type' => 'Retail Supermarket Chain',
                'service_type' => 'Drainage Maintenance Fresh Food Area',
                'logo' => asset('assets/mitra/superindo-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pelancaran-saluran-mampet-area-resto.webp'),
                'badge' => '🏬 Ritel & Supermarket',
                'alt' => 'Logo Superindo Supermarket - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pelancaran saluran pembuangan air es dan lemak produk segar di area supermarket Superindo.',
            ],
            [
                'name' => 'Sushi Tei',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Japanese Premium Dining',
                'service_type' => 'Preventive Maintenance Pipa Kitchen',
                'logo' => asset('assets/mitra/sushi-tei-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/thumb-video-pelancaran-gutter-lemak-sushi-tei.webp'),
                'badge' => '💎 Premium Dining Care',
                'alt' => 'Logo Sushi Tei - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Kontrak perawatan berkala saluran pipa cuci piring dan kitchen sink bebas bau & mampet.',
            ],
            [
                'name' => 'Sushi Yay!',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Cloud Kitchen & Outlet',
                'service_type' => 'Unclogging Waste Line 24 Jam',
                'logo' => asset('assets/mitra/sushi-yay-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pelancaran-drainase-kitchen-soichiro-steakhouse-jakarta.webp'),
                'badge' => '☁️ Cloud Kitchen SLA',
                'alt' => 'Logo Sushi Yay! - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Respon cepat 24 jam pelancaran saluran tersumbat tanpa menghentikan produksi cloud kitchen.',
            ],
            [
                'name' => 'Honda Service Center',
                'category_slug' => 'otomotif-industri',
                'category_label' => 'Otomotif & Industri',
                'property_type' => 'Bengkel & Showroom Otomotif',
                'service_type' => 'Pembersihan Sedimen Lumpur Pit Bengkel',
                'logo' => asset('assets/mitra/testimoni-honda-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pelancar-bak-kontrol-perumahan-warga.webp'),
                'badge' => '🏎️ Automotive Maintenance',
                'alt' => 'Logo Honda Service Center - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pelancaran saluran parit pit bengkel dari pasir dan sedimen oli tanpa merusak lantai bengkel.',
            ],
            [
                'name' => 'Restoran CFC',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Fast Food Chain',
                'service_type' => 'Pembersihan Kerak Minyak Sink',
                'logo' => asset('assets/mitra/testimoni-restoran-cfc-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/teknisi-pelancar-wastafel-mesin-ridgid.webp'),
                'badge' => '🛡️ Garansi 30 Hari',
                'alt' => 'Logo Restoran CFC - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Penanganan tuntas saluran kitchen sink mampet dengan jaminan garansi 30 hari.',
            ],
            [
                'name' => 'Haka Dimsum Shop',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => '24-Hour Dimsum Restaurant',
                'service_type' => 'Night-Shift Plumbing Maintenance',
                'logo' => asset('assets/mitra/testimoni-restoran-haka-dimsum-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/proses-pelancaran-gutter-restoran-jakarta.webp'),
                'badge' => '🌙 Operations Night Shift',
                'alt' => 'Logo Haka Dimsum Shop - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pengerjaan pelancaran pipa malam hari tanpa suara bising agar operasional resto 24 jam berjalan lancar.',
            ],
            [
                'name' => 'Seporsi Mie Kari',
                'category_slug' => 'restoran-fnb',
                'category_label' => 'Restoran & F&B',
                'property_type' => 'Specialty Culinary Restaurant',
                'service_type' => 'Clearing Heavy Oil & Broth Waste',
                'logo' => asset('assets/mitra/testimoni-restoran-seporsi-mie-kari-mitra-kepercayaan-rootera-plumbing-jasa-saluran-pipa-mampet.webp'),
                'photo' => asset('images/dokumentasi/pelancaran-gutter-seporsi-mie-kari-jakarta.webp'),
                'badge' => '🍜 Heavy Oil Cleaning',
                'alt' => 'Logo Seporsi Mie Kari - Mitra Kepercayaan Rootera Plumbing',
                'description' => 'Pembersihan lemak kuah kental dan kuah kari jenuh pada jaringan drainase utama dapur.',
            ],
        ];

        $projects = Gallery::where('is_active', true)->latest()->take(6)->get();

        return view('pages.about.portofolio-klien', compact('seo', 'partnerPortfolio', 'projects'));
    }

    public function garansiLayanan()
    {
        $seo = [
            'title'       => 'Jaminan & Kebijakan Garansi 30 Hari - Rootera Plumbing',
            'description' => 'Garansi tuntas 30 hari resmi Rootera Plumbing. Ketentuan jaminan pengerjaan pelancaran pipa tanpa biaya tambahan jika terjadi sumbatan ulang.',
            'canonical'   => url('/tentang-kami/garansi-layanan'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.garansi-layanan', compact('seo'));
    }
}
