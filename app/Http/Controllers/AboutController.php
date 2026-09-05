<?php

namespace App\Http\Controllers;

use App\Models\ServiceSector;
use App\Models\Gallery;

class AboutController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Tentang Kami — Profil & Tim Ahli | Rootera Plumbing',
            'description' => 'Profil Rootera Plumbing, spesialis saluran pipa mampet tanpa bongkar dipimpin Rafael Abimanyu. Workshop Cijantung Jakarta Timur, bergaransi & 24 jam.',
            'keywords'    => 'Profil Perusahaan & Legalitas Operasional, Workshop & Pusat Logistik Armada Jakarta Timur, Standar Kerja Spesialis Pipa Mampet Tanpa Bongkar Bergaransi, Rafael Abimanyu',
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

        // Standardized Structured Team Data across 3 Tiers
        $teamMembers = $this->getTeamData();

        $documentationGallery = [];
        $sopSteps = [];
        $technologies = [];

        return view('pages.tentang-kami', compact(
            'seo', 'sectors', 'advantages', 'teamMembers', 
            'documentationGallery', 'sopSteps', 'technologies'
        ));
    }

    /**
     * Show detailed profile page for leadership team members.
     */
    public function showTeamMember(string $slug)
    {
        $team = $this->getTeamData();
        $member = collect($team)->firstWhere('slug', $slug);

        if (!$member || empty($member['slug'])) {
            abort(404);
        }

        $seo = [
            'title'       => 'Profil ' . $member['name'] . ' — ' . $member['role'] . ' | Rootera Plumbing',
            'description' => \Illuminate\Support\Str::limit($member['bio'] ?? ($member['name'] . ' adalah ' . $member['role'] . ' di Rootera Plumbing.'), 155),
            'canonical'   => url('/tentang-kami/tim/' . $member['slug']),
            'og_image'    => $member['image'],
        ];

        $relatedArticles = \App\Models\Article::published()->latest()->take(3)->get();

        return view('pages.about.team-detail', compact('member', 'seo', 'relatedArticles'));
    }

    /**
     * Centralized 3-Tier Structured Team Data
     */
    private function getTeamData(): array
    {
        return [
            // Tier 1: THE FOUNDER & LEADER (Solo Showcase — Kartu Tunggal Heroik)
            [
                'slug'          => 'rafael-abimanyu',
                'category'      => 'pimpinan',
                'tier'          => 1,
                'name'          => 'Rafael Abimanyu',
                'role'          => 'Founder & Lead Director',
                'badge'         => 'FOUNDER & EXECUTIVE LEADER',
                'experience'    => '3+ Tahun Mengakar di Lapangan & Rekayasa Sanitasi Modern',
                'quote'         => 'Bagi kami, pipa bukan sekadar saluran air di balik dinding, melainkan urat nadi kenyamanan sebuah hunian. Masalah saluran yang tuntas tanpa merusak adalah bentuk penghormatan tertinggi kami terhadap properti Anda.',
                'image'         => asset('assets/staff/rafael-abimanyu-rootera-plumbing.webp'),
                'alt'           => 'Foto Rafael Abimanyu - Founder & Lead Director Rootera Plumbing',
                'certification' => 'Sertifikasi K3 & Technical Hydro-Jetting Specialist',
                'bio'           => 'Rafael Abimanyu memimpin strategi dan ekspansi operasional Rootera Plumbing dalam menghadirkan solusi pelancaran saluran air modern bebas bongkar. Berbekal pengalaman mendalam dari akar rumput di bidang teknik sanitasi dan manajemen fasilitas, ia memelopori integrasi mesin Ridgid spiral fleksibel serta teknologi Hydro Jetting 300 Bar berstandar K3.',
                'bio_part1_title' => 'Dari Meja Kantor hingga Kotoran Saluran (The Dual Perspective)',
                'bio_part1'       => 'Keunggulan terbesar Rafael Abimanyu bukan diraih dari teori di balik meja kantor, melainkan karena ia mengawali langkahnya langsung dari akar rumput. Dimulai sebagai staf kantor dan admin customer service, ia mendengar langsung kepanikan, rasa frustrasi, dan keluhan masyarakat yang kerap kecewa akibat praktek oknum tukang abal-abal maupun harga yang tidak transparan.' . "\n\n" . 'Tidak berhenti di balik meja admin, Rafael memilih terjun langsung ke lapangan sebagai teknisi. Ia memegang sendiri kabel mesin spiral Ridgid, mencium bau sengatan saluran tersumbat, membersihkan kerak lemak membatu di grease trap restoran komersial, hingga memecahkan kebuntuan pipa gedung bertingkat yang paling rumit.',
                'bio_part2_title' => 'Titik Balik Lahirnya Rootera Plumbing',
                'bio_part2'       => 'Dari pengalaman dwifungsi (kantor & lapangan) tersebut, Rafael melihat celah mendasar dalam industri sanitasi Indonesia: Masyarakat tidak kekurangan tukang, tetapi kekurangan penyedia jasa yang jujur, menguasai sains drainase modern, dan benar-benar menghargai struktur properti pelanggan.' . "\n\n" . 'Dari kesadaran itulah lahir Rootera Plumbing—sebuah brand yang dirancang bukan hanya sebagai pembersih kotoran pipa, melainkan pelindung kenyamanan dan kesehatan sanitasi bangunan modern yang bekerja dengan integritas mutlak, teknologi tanpa bongkar, serta standardisasi layanan korporat.',
                'personal_vision' => 'Membawa peradaban baru pada profesi teknisi drainase di Indonesia—dari yang sebelumnya dianggap sekadar pekerjaan kasar menjadi profesi engineering sanitasi yang presisi, dihormati, dan dipercaya sepenuhnya oleh setiap keluarga dan pemilik bisnis.',
                'personal_mission' => [
                    'Terus mengawal SOP kerja setiap armada teknisi agar tidak ada kompromi pada kualitas dan keramahan.',
                    'Mengembangkan teknologi pelancaran saluran tanpa bongkar ke seluruh penjuru Nusantara.',
                    'Membina teknisi-teknisi muda lokal agar memiliki keahlian teknis tinggi, sertifikasi keselamatan kerja, dan integritas moral yang kuat.',
                ],
                'knows_about'   => ['Diagnostic Plumbing Systems', 'High-Pressure Hydro-Jetting', 'CCTV Pipeline Inspection', 'Grease Trap Engineering', 'Sanitary Risk Assessment'],
                'expertise_badges' => ['Diagnostic Plumbing Systems', 'High-Pressure Hydro-Jetting', 'CCTV Pipeline Inspection', 'Grease Trap Engineering', 'Sanitary Risk Assessment'],
                'metrics' => [
                    ['number' => '3+ Tahun', 'label' => 'Pengalaman Lapangan'],
                    ['number' => '1.000+', 'label' => 'Kasus Saluran Ekstrem'],
                    ['number' => '100%', 'label' => 'Standar Mutu Rootera'],
                ],
                'socials'       => [
                    'email'    => 'rafael@rooteraplumbing.com',
                    'whatsapp' => '6281385404000',
                ]
            ],
            // Tier 2: MANAJEMEN, TEKNOLOGI & CUSTOMER SERVICE
            [
                'slug'          => 'yero-virdhan',
                'category'      => 'staf-cs',
                'tier'          => 2,
                'name'          => 'Yero Virdhan',
                'role'          => 'IT & Software Lead',
                'badge'         => 'Systems & Tech Lead',
                'experience'    => 'Sistem Inspeksi Digital & Automation Dispatch 8+ Tahun',
                'quote'         => 'Mengintegrasikan teknologi inspeksi CCTV digital 1080p dan sistem penjadwalan presisi untuk pengiriman armada teknisi tercepat.',
                'image'         => asset('assets/staff/yero-virdhan-it-rootera-plumbing.webp'),
                'alt'           => 'Foto Yero Virdhan - IT & Software Lead Rootera Plumbing',
                'certification' => 'Digital Systems & Smart Pipe Monitoring Certified',
                'bio'           => 'Yero Virdhan mengomandoi arsitektur sistem IT, inspeksi digital, dan otomasi armada di Rootera Plumbing.',
                'knows_about'   => ['CCTV Pipe Inspection Systems', 'Field Service Dispatch Automation', 'Plumbing Tech Infrastructure'],
                'socials'       => [
                    'email'    => 'yero@rooteraplumbing.com',
                    'whatsapp' => '6281385404000',
                ]
            ],
            [
                'category'      => 'staf-cs',
                'tier'          => 2,
                'name'          => 'Ariana Mikayla',
                'role'          => 'IT & Digital Systems',
                'badge'         => 'System Dispatcher',
                'experience'    => 'Monitoring & Operasional IT Systems',
                'image'         => asset('assets/staff/ariana-mikayla-it-rootera-plumbing.webp'),
                'alt'           => 'Foto Ariana Mikayla - IT & Digital Systems Rootera Plumbing',
            ],
            [
                'category'      => 'staf-cs',
                'tier'          => 2,
                'name'          => 'Ghaitsaa',
                'role'          => 'Customer Service & Dispatcher 24/7',
                'badge'         => 'Fast Response CS (< 3 Mnt)',
                'experience'    => 'Layanan Garansi & Respon Darurat',
                'image'         => asset('assets/staff/ghaitsaa-customer-service-rootera-plumbing.webp'),
                'alt'           => 'Foto Ghaitsaa - Customer Service & Dispatcher 24/7 Rootera Plumbing',
            ],
            [
                'category'      => 'staf-cs',
                'tier'          => 2,
                'name'          => 'Maura',
                'role'          => 'Marketing & Client Relations',
                'badge'         => 'Commercial Support',
                'experience'    => 'Hubungan Klien Restoran & F&B',
                'image'         => asset('assets/staff/maura-marketing-rootera-plumbing.webp'),
                'alt'           => 'Foto Maura - Marketing Specialist Rootera Plumbing',
            ],
            [
                'category'      => 'staf-cs',
                'tier'          => 2,
                'name'          => 'Yoga',
                'role'          => 'Marketing Specialist',
                'badge'         => 'B2B Partnership',
                'experience'    => 'Pengadaan Tender & Kontrak B2B',
                'image'         => asset('assets/staff/yoga-marketing-rootera-plumbing.webp'),
                'alt'           => 'Foto Yoga - Marketing Specialist Rootera Plumbing',
            ],
            [
                'category'      => 'staf-cs',
                'tier'          => 2,
                'name'          => 'Rafa R',
                'role'          => 'Social Media Manager',
                'badge'         => 'Edukasi & Media',
                'experience'    => 'Edukasi Perawatan Pipa & Sanitasi',
                'image'         => asset('assets/staff/rafa-r-manage-sosmed-rootera-plumbing.webp'),
                'alt'           => 'Foto Rafa R - Social Media Manager Rootera Plumbing',
            ],
            // Tier 3: Teknisi Armada Lapangan
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Aries',
                'role'          => 'Teknisi Plumbing Senior',
                'badge'         => 'Rigid Spiral Certified',
                'area'          => 'Area Metro & Lampung Tengah',
                'specialization'=> 'Pipa Mampet Restoran, Kitchen Sink & Riser Vertikal',
                'certification' => 'Ridgid Machine K-50/K-60 Specialist',
                'image'         => asset('assets/staff/aries-teknisi-plumbing-senior-rootera-plumbing.webp'),
                'alt'           => 'Foto Aries - Teknisi Plumbing Senior Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Harmoko',
                'role'          => 'Teknisi Plumbing Senior',
                'badge'         => 'Hydro-Jetting Specialist',
                'area'          => 'Area Bekasi, Depok & Jakarta Timur',
                'specialization'=> 'Hydro Jetting 300 Bar & Bak Kontrol Kerak Lemak',
                'certification' => 'High-Pressure Water Jetting K3',
                'image'         => asset('assets/staff/harmoko-teknisi-plumbing-senior-rootera-plumbing.webp'),
                'alt'           => 'Foto Harmoko - Teknisi Plumbing Senior Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Ikbal Ramadhan',
                'role'          => 'Teknisi Saluran Senior',
                'badge'         => 'K3 Plumbing Safety',
                'area'          => 'Area Bogor & Jakarta Selatan',
                'specialization'=> 'Pelancaran Floor Drain, Closet & Saluran Air Hujan',
                'certification' => 'Sertifikasi K3 Sanitasi & APD',
                'image'         => asset('assets/staff/ikbal-ramadhan-teknisi-saluran-senior-rootera-plumbing.webp'),
                'alt'           => 'Foto Ikbal Ramadhan - Teknisi Saluran Senior Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Andi',
                'role'          => 'Teknisi Inspeksi Kamera CCTV',
                'badge'         => 'CCTV Inspector 1080p',
                'area'          => 'Cover All Metro Area',
                'specialization'=> 'Inspeksi Kamera Flex 1080p IP68 & Deteksi Pipa Pecah',
                'certification' => 'SeeSnake CCTV Diagnostics Certified',
                'image'         => asset('assets/staff/andi-teknisi-inspeksi-kamera-rootera-plumbing.webp'),
                'alt'           => 'Foto Andi - Teknisi Inspeksi Kamera CCTV Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Ramadhan',
                'role'          => 'Teknisi Instalasi & Perbaikan Pipa',
                'badge'         => 'Piping Rig Master',
                'area'          => 'Area Semarang & Jawa Tengah',
                'specialization'=> 'Relokasi & Instalasi Pipa Pembuangan Bebas Bocor',
                'certification' => 'Master Piping Fitter',
                'image'         => asset('assets/staff/ramadhan-teknisi-instalasi-pemasangan-dan-perbaikan-pipa-rootera-plumbing.webp'),
                'alt'           => 'Foto Ramadhan - Teknisi Instalasi Pipa Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Andre',
                'role'          => 'Teknisi Konstruksi Pembangunan',
                'badge'         => 'Civil Sanitation',
                'area'          => 'Area Bandung & Jawa Barat',
                'specialization'=> 'Konstruksi Drainase Industri & Grease Trap Tanaman',
                'certification' => 'Sertifikasi Konstruksi Drainase',
                'image'         => asset('assets/staff/andre-teknisi-konstruksi-pembangunan-rootera-plumbing.webp'),
                'alt'           => 'Foto Andre - Teknisi Konstruksi Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Agus',
                'role'          => 'Teknisi Support Lapangan',
                'badge'         => 'Fast Emergency Unit',
                'area'          => 'Area Surabaya & Jawa Timur',
                'specialization'=> 'Respon Darurat Wastafel & Pendamping Hydro Jetting',
                'certification' => 'Emergency Response Specialist',
                'image'         => asset('assets/staff/agus-teknisi-support-rootera-plumbing.webp'),
                'alt'           => 'Foto Agus - Teknisi Support Rootera Plumbing',
            ],
            [
                'category'      => 'teknisi',
                'tier'          => 3,
                'name'          => 'Wendi',
                'role'          => 'Teknisi Junior',
                'badge'         => 'Spiral Cable Tech',
                'area'          => 'Area Metro & Lampung',
                'specialization'=> 'Pelancaran Saluran Residensial & Pipa Cuci Piring',
                'certification' => 'Standard Rigging Tech',
                'image'         => asset('assets/staff/wendi-teknisi-junior-rootera-plumbing.webp'),
                'alt'           => 'Foto Wendi - Teknisi Junior Rootera Plumbing',
            ],
        ];
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
            'title'       => 'Armada Mesin Rooter & Hydro Jetting Modern Tanpa Bongkar | Rootera',
            'description' => 'Spesifikasi armada mesin Ridgid K-50/K-60, SeeSnake CCTV 1080p IP68, & Hydro Jetting 300 Bar. Jasa pelancar saluran mampet 24 jam bergaransi resmi tanpa bongkar.',
            'canonical'   => url('/tentang-kami/peralatan-teknologi'),
            'og_image'    => asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp'),
        ];

        $technologies = \App\Models\Technology::where('is_active', true)->orderBy('order_priority')->get();

        return view('pages.about.peralatan-teknologi', compact('seo', 'technologies'));
    }

    public function showEquipment(string $slug)
    {
        $technology = \App\Models\Technology::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedTechnologies = \App\Models\Technology::where('is_active', true)
            ->where('id', '!=', $technology->id)
            ->orderBy('order_priority')
            ->take(3)
            ->get();

        $relatedServices = \App\Models\ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $seo = [
            'title'       => $technology->tool_name . ' - Teknologi Pelancar Pipa Tanpa Bongkar | Rootera Plumbing',
            'description' => \Illuminate\Support\Str::limit($technology->description ?? ($technology->tool_name . ' dengan ' . $technology->main_spec . ' untuk pelancaran saluran mampet presisi.'), 155),
            'canonical'   => url('/peralatan-teknologi/' . $technology->slug),
            'og_image'    => $technology->image_url,
        ];

        return view('pages.technology-detail', compact('technology', 'relatedTechnologies', 'relatedServices', 'seo'));
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
            'title'       => 'Garansi Pengerjaan Saluran Mampet 30 Hari | Kebijakan Service Resmi Rootera',
            'description' => 'Komitmen kepuasan Rootera Plumbing: Garansi pelancaran pipa mampet hingga 30 hari, skema tuntas baru bayar, invoice digital resmi, dan bebas biaya kunjungan ulang.',
            'canonical'   => url('/tentang-kami/garansi-layanan'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.garansi-layanan', compact('seo'));
    }
}
