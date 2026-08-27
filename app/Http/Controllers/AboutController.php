<?php

namespace App\Http\Controllers;

use App\Models\ServiceSector;

class AboutController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Tentang Kami - Rootera Plumbing | Pionir Jasa Pipa Mampet & Drainase Tanpa Bongkar',
            'description' => 'Mengenal Rootera Plumbing, spesialis pelancaran pipa mampet, saluran air, dan drainase modern tanpa bongkar bergaransi. Didukung teknisi bersertifikasi & teknologi canggih.',
            'keywords'    => 'Jasa pipa mampet tanpa bongkar, hydro jetting profesional, deteksi cctv pipa, teknisi plumbing bergaransi, rootera plumbing',
            'canonical'   => url('/tentang-kami'),
            'og_image'    => asset('images/og-about.jpg'),
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
                'icon' => 'shield-check'
            ],
            [
                'title' => 'Highest Hygiene Standard',
                'description' => 'Bebas Bau & Steril. Peralatan disterilkan secara berkala, area pengerjaan dibersihkan total, dan teknisi dilengkapi APD standar higienis.',
                'badge' => 'Standar Higienis',
                'icon' => 'sparkles'
            ],
            [
                'title' => 'Transparent & Fixed Pricing',
                'description' => 'Tanpa Biaya Siluman. Estimasi jelas di awal sebelum pengerjaan dimulai. Garansi kepuasan penuh sesuai kesepakatan.',
                'badge' => 'Transparan',
                'icon' => 'banknotes'
            ],
            [
                'title' => 'Eco-Friendly & Pipe-Safe Solutions',
                'description' => '100% Bebas Bahan Kimia Asam Keras. Tidak merusak pipa PVC/Besi serta menjaga kelestarian air tanah lingkungan tempat tinggal Anda.',
                'badge' => 'Ramah Lingkungan',
                'icon' => 'leaf'
            ],
        ];

        $isTeamUpdating = true;
        $teamMembers = [];

        $documentationGallery = [
            [
                'title' => 'Pelancaran Saluran Gutter Restoran KAI & Resto',
                'location_tag' => 'Stasiun KAI & Resto Jakarta',
                'category' => 'Hydro Jetting',
                'image_url' => asset('images/dokumentasi/proyek-pelancaran-saluran-stasiun-kai-1.webp'),
                'alt_seo_text' => 'Pelancaran saluran mampet hydro jetting stasiun KAI Jakarta oleh Rootera Plumbing',
                'video_url' => asset('videos/dokumentasi/video-inspeksi-cctv-wastafel.mp4'),
                'is_before_after' => false,
            ],
            [
                'title' => 'Inspeksi Kamera CCTV Pipe Locator Pertamina',
                'location_tag' => 'Pertamina Sunter, Jakarta Utara',
                'category' => 'CCTV Pipe Scan',
                'image_url' => asset('images/dokumentasi/inspeksi-cctv-floor-drain-pertamina-sunter.webp'),
                'alt_seo_text' => 'Inspeksi kamera CCTV saluran kloset mampet Pertamina Sunter Jakarta Utara',
                'video_url' => asset('videos/dokumentasi/video-inspeksi-cctv-wastafel.mp4'),
                'is_before_after' => false,
            ],
            [
                'title' => 'Pembersihan Kerak Lemak Grease Trap Mall',
                'location_tag' => 'Restoran Mall & Cloud Kitchen Jakarta',
                'category' => 'Commercial Grease Trap',
                'image_url' => asset('images/dokumentasi/pembersihan-grease-trap-restoran.webp'),
                'alt_seo_text' => 'Pembersihan lemak grease trap restoran mall Jakarta oleh teknisi Rootera Plumbing',
                'video_url' => null,
                'is_before_after' => false,
            ],
            [
                'title' => 'Pelancaran Floor Drain Wastafel Spiral Rigging',
                'location_tag' => 'Perumahan Warga & Villa Jabodetabek',
                'category' => 'Spiral Rigging',
                'image_url' => asset('images/dokumentasi/pelancar-mesin-ridgid-floor-drain-kamar-mandi.webp'),
                'alt_seo_text' => 'Pelancaran wastafel mampet mesin Ridgid spiral baja perumahan Jabodetabek',
                'video_url' => null,
                'is_before_after' => false,
            ],
            [
                'title' => 'Pembersihan Saluran Gutter (Before vs After)',
                'location_tag' => 'Restoran & Gedung Komersial',
                'category' => 'Hydro Jetting',
                'image_url' => asset('images/dokumentasi/after-pembersihan-talang-gutter-rootera.webp'),
                'alt_seo_text' => 'Hasil pembersihan saluran talang air gutter tanpa bongkar Rootera Plumbing',
                'video_url' => null,
                'is_before_after' => true,
                'before_image' => asset('images/dokumentasi/before-pembersihan-talang-gutter.webp'),
                'after_image' => asset('images/dokumentasi/after-pembersihan-talang-gutter-rootera.webp'),
            ],
            [
                'title' => 'Pelancaran Saluran Kloset Pabrik Manufaktur',
                'location_tag' => 'Kawasan Industri Cikarang & Karawang',
                'category' => 'Commercial Grease Trap',
                'image_url' => asset('images/dokumentasi/pelancaran-kloset-mampet-pabrik-industri.webp'),
                'alt_seo_text' => 'Jasa pelancar saluran mampet kloset pabrik industri Cikarang Karawang',
                'video_url' => null,
                'is_before_after' => false,
            ],
        ];

        $sopSteps = [
            [
                'step' => '01',
                'title' => 'Inspeksi & Diagnosa Awal',
                'description' => 'Tim teknisi memeriksa titik kemampetan, keluhan debit air, dan pemetaan jaringan alur pipa.'
            ],
            [
                'step' => '02',
                'title' => 'Scanning Kamera CCTV',
                'description' => 'Memasukkan mikro kamera waterproof untuk melacak lokasi presisi, retakan, dan jenis endapan mampet.'
            ],
            [
                'step' => '03',
                'title' => 'Pengerjaan Tanpa Bongkar',
                'description' => 'Melancarkan pipa menggunakan Hydro-Jetting bertekanan tinggi atau Spiral Cable Machine secara terukur.'
            ],
            [
                'step' => '04',
                'title' => 'Uji Kelancaran & Sterilisasi',
                'description' => 'Flushing pembilasan debit air maksimal, sterilisasi area kerja, dan pembersihan residu hingga rapi.'
            ],
            [
                'step' => '05',
                'title' => 'Garansi Pasca Servis',
                'description' => 'Penyerahan bukti garansi resmi Rootera dan panduan tips perawatan pipa jangka panjang.'
            ],
        ];

        $technologies = [
            [
                'name' => 'High-Pressure Hydro Jetting',
                'specs' => 'Tekanan Hingga 300 Bar',
                'description' => 'Menyemprotkan air bertekanan ultra-tinggi untuk mengikis kerak minyak padat, sedimen kapur keras, dan endapan lumpur industri.',
                'image' => asset('images/dokumentasi/mesin-drain-cleaner-pelancar-pipa.webp')
            ],
            [
                'name' => 'Spiral Cable Drain Cleaner',
                'specs' => 'Jangkauan s/d 40 Meter',
                'description' => 'Kabel baja fleksibel berotasi cepat untuk memotong lembaran akar, serat kain, dan sampah padat tanpa menggores dinding pipa PVC.',
                'image' => asset('images/dokumentasi/pelancar-mesin-ridgid-floor-drain-kamar-mandi.webp')
            ],
            [
                'name' => 'CCTV Pipe Inspection Camera',
                'specs' => 'Kamera HD Waterproof & Sonde',
                'description' => 'Melakukan inspeksi visual di dalam lorong pipa gelap untuk menemukan titik sumbatan dan kemiringan pipa secara realtime.',
                'image' => asset('images/dokumentasi/inspeksi-kamera-cctv-pipa-tersumbat.webp')
            ]
        ];

        return view('pages.tentang-kami', compact('seo', 'sectors', 'advantages', 'teamMembers', 'isTeamUpdating', 'documentationGallery', 'sopSteps', 'technologies'));
    }

    public function profil()
    {
        $seo = [
            'title'       => 'Profil Perusahaan & Komitmen K3 - Rootera Plumbing',
            'description' => 'Profil resmi Rootera Plumbing (J&J Group), legalitas perusahaan, komitmen keselamatan kerja K3, serta visi misi layanan plumbing profesional.',
            'canonical'   => url('/tentang-kami/profil'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.profil', compact('seo'));
    }

    public function peralatanTeknologi()
    {
        $seo = [
            'title'       => 'Standar Peralatan & Teknologi Modern - Rootera Plumbing',
            'description' => 'Teknologi pelancaran pipa mampet tanpa bongkar Rootera: Mesin Spiral Rotary Ridgid, Kamera CCTV Inspeksi HD, dan Hydro Jetting 300 Bar.',
            'canonical'   => url('/tentang-kami/peralatan-teknologi'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.peralatan-teknologi', compact('seo'));
    }

    public function portofolioKlien()
    {
        $seo = [
            'title'       => 'Klien & Portofolio B2B Komersial - Rootera Plumbing',
            'description' => 'Portofolio pengerjaan pelancaran pipa restoran, mall, gedung perkantoran, hotel, dan kawasan industri oleh Rootera Plumbing.',
            'canonical'   => url('/tentang-kami/portofolio-klien'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        $projects = \App\Models\Gallery::where('is_active', true)->latest()->take(9)->get();

        return view('pages.about.portofolio-klien', compact('seo', 'projects'));
    }

    public function garansiLayanan()
    {
        $seo = [
            'title'       => 'Jaminan & Kebijakan Garansi Pengerjaan 30 Hari - Rootera Plumbing',
            'description' => 'Garansi tuntas 30 hari resmi Rootera Plumbing. Ketentuan jaminan pengerjaan pelancaran pipa tanpa biaya tambahan jika terjadi sumbatan ulang.',
            'canonical'   => url('/tentang-kami/garansi-layanan'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.about.garansi-layanan', compact('seo'));
    }
}


