<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\ServiceArea;
use App\Models\Article;
use App\Models\GalleryPhoto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@rootera.id'],
            [
                'name'     => 'Admin ROOTERA',
                'email'    => 'admin@rootera.id',
                'password' => Hash::make('rootera2025'),
            ]
        );

        // Service Categories
        $categories = [
            [
                'name'        => 'Saluran Pembuangan Mampet',
                'slug'        => 'saluran-pembuangan-mampet',
                'description' => 'Pengerjaan profesional menggunakan alat modern tanpa harus membongkar struktur bangunan.',
                'icon'        => 'pipe',
                'sort_order'  => 1,
                'meta_title'  => 'Jasa Saluran Pembuangan Mampet | ROOTERA',
                'meta_description' => 'Atasi saluran pembuangan mampet dengan profesional. ROOTERA menggunakan alat modern tanpa bongkar bangunan. Hubungi kami sekarang!',
            ],
            [
                'name'        => 'Air Bersih & Cuci Toren',
                'slug'        => 'air-bersih-cuci-toren',
                'description' => 'Pengerjaan profesional menggunakan alat modern tanpa harus membongkar struktur bangunan.',
                'icon'        => 'water',
                'sort_order'  => 2,
                'meta_title'  => 'Jasa Cuci Toren & Kran Mampet | ROOTERA',
                'meta_description' => 'Layanan cuci toren, tangki air, dan kran mampet profesional. ROOTERA siap melayani area Jabodetabek, Cirebon, Semarang, dan lebih.',
            ],
            [
                'name'        => 'Instalasi Sanitary & Pipa',
                'slug'        => 'instalasi-sanitary-pipa',
                'description' => 'Pengerjaan profesional menggunakan alat modern tanpa harus membongkar struktur bangunan.',
                'icon'        => 'install',
                'sort_order'  => 3,
                'meta_title'  => 'Jasa Instalasi Pipa & Sanitary | ROOTERA',
                'meta_description' => 'Instalasi pipa air bersih, air kotor, dan kloset profesional. Dikerjakan teknisi berpengalaman ROOTERA.',
            ],
        ];

        foreach ($categories as $cat) {
            ServiceCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Services
        $cat1 = ServiceCategory::where('slug', 'saluran-pembuangan-mampet')->first();
        $cat2 = ServiceCategory::where('slug', 'air-bersih-cuci-toren')->first();
        $cat3 = ServiceCategory::where('slug', 'instalasi-sanitary-pipa')->first();

        $services = [
            ['service_category_id' => $cat1->id, 'name' => 'Saluran Kamar Mandi Mampet', 'slug' => 'saluran-kamar-mandi-mampet', 'short_description' => 'Pembersihan saluran kamar mandi tersumbat dengan teknik hidrolik modern.', 'sort_order' => 1],
            ['service_category_id' => $cat1->id, 'name' => 'Saluran Cuci Piring Mampet', 'slug' => 'saluran-cuci-piring-mampet', 'short_description' => 'Atasi sumbatan lemak dan kotoran di saluran wastafel dapur Anda.', 'sort_order' => 2],
            ['service_category_id' => $cat1->id, 'name' => 'Saluran Cuci Tangan Mampet', 'slug' => 'saluran-cuci-tangan-mampet', 'short_description' => 'Pembersihan wastafel cuci tangan yang tersumbat sabun dan kotoran.', 'sort_order' => 3],
            ['service_category_id' => $cat2->id, 'name' => 'Kran Mampet & Bermasalah', 'slug' => 'kran-mampet', 'short_description' => 'Perbaikan dan pembersihan kran air yang mampet atau bocor.', 'sort_order' => 1],
            ['service_category_id' => $cat2->id, 'name' => 'Cuci Toren / Tangki Air', 'slug' => 'cuci-toren-tangki-air', 'short_description' => 'Pembersihan menyeluruh toren dan tangki air untuk air bersih dan sehat.', 'sort_order' => 2],
            ['service_category_id' => $cat3->id, 'name' => 'Instalasi Pipa Air Bersih', 'slug' => 'instalasi-pipa-air-bersih', 'short_description' => 'Pemasangan jaringan pipa air bersih untuk hunian dan komersial.', 'sort_order' => 1],
            ['service_category_id' => $cat3->id, 'name' => 'Instalasi Pipa Air Kotor', 'slug' => 'instalasi-pipa-air-kotor', 'short_description' => 'Pemasangan sistem drainase dan saluran pembuangan yang tepat.', 'sort_order' => 2],
            ['service_category_id' => $cat3->id, 'name' => 'Instalasi Kloset Jongkok/Duduk', 'slug' => 'instalasi-kloset', 'short_description' => 'Pemasangan dan penggantian kloset jongkok maupun duduk.', 'sort_order' => 3],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(['slug' => $svc['slug']], array_merge($svc, ['is_active' => true]));
        }

        // Service Areas
        $areas = [
            ['name' => 'Jabodetabek', 'slug' => 'jabodetabek', 'province' => 'DKI Jakarta & Jawa Barat', 'description' => 'Melayani seluruh area Jakarta, Bogor, Depok, Tangerang, dan Bekasi.', 'sort_order' => 1, 'meta_title' => 'Jasa Pipa Mampet Jabodetabek | ROOTERA', 'meta_description' => 'ROOTERA melayani area Jabodetabek. Hubungi kami untuk penanganan saluran mampet cepat dan profesional.'],
            ['name' => 'Cirebon',     'slug' => 'cirebon',     'province' => 'Jawa Barat',              'description' => 'Layanan saluran mampet dan pipa profesional di Kota Cirebon dan sekitarnya.', 'sort_order' => 2, 'meta_title' => 'Jasa Pipa Mampet Cirebon | ROOTERA', 'meta_description' => 'ROOTERA hadir di Cirebon. Layanan bersih pipa, cuci toren, dan instalasi sanitary.'],
            ['name' => 'Semarang',    'slug' => 'semarang',    'province' => 'Jawa Tengah',             'description' => 'Tim profesional ROOTERA siap melayani Kota Semarang dan daerah sekitarnya.', 'sort_order' => 3, 'meta_title' => 'Jasa Pipa Mampet Semarang | ROOTERA', 'meta_description' => 'ROOTERA Semarang siap membantu atasi saluran mampet dan masalah pipa Anda.'],
            ['name' => 'Yogyakarta',  'slug' => 'yogyakarta',  'province' => 'DIY Yogyakarta',          'description' => 'Jangkauan layanan ROOTERA di area Kota Yogyakarta dan kabupaten sekitar.', 'sort_order' => 4, 'meta_title' => 'Jasa Pipa Mampet Yogyakarta | ROOTERA', 'meta_description' => 'ROOTERA Yogyakarta siap melayani kebutuhan pipa dan saluran Anda 24 jam.'],
            ['name' => 'Lampung',     'slug' => 'lampung',     'province' => 'Lampung',                 'description' => 'Layanan profesional ROOTERA kini hadir di Bandar Lampung dan sekitarnya.', 'sort_order' => 5, 'meta_title' => 'Jasa Pipa Mampet Lampung | ROOTERA', 'meta_description' => 'ROOTERA Lampung hadir untuk solusi saluran mampet dan instalasi pipa profesional.'],
            ['name' => 'Metro',       'slug' => 'metro',       'province' => 'Lampung',                 'description' => 'Tim ROOTERA melayani Kota Metro dan area sekitar provinsi Lampung.', 'sort_order' => 6, 'meta_title' => 'Jasa Pipa Mampet Metro Lampung | ROOTERA', 'meta_description' => 'ROOTERA Metro Lampung siap bantu atasi masalah pipa dan saluran Anda.'],
        ];

        foreach ($areas as $area) {
            ServiceArea::updateOrCreate(['slug' => $area['slug']], array_merge($area, ['is_active' => true]));
        }

        // Sample Articles
        $articles = [
            [
                'title'            => 'Cara Mengatasi Wastafel Mampet Secara Mandiri di Rumah',
                'slug'             => 'cara-mengatasi-wastafel-mampet-mandiri',
                'excerpt'          => 'Wastafel mampet bisa menjadi masalah yang sangat mengganggu. Berikut panduan lengkap cara mengatasinya sendiri sebelum memanggil teknisi.',
                'content'          => '<h2>Penyebab Wastafel Mampet</h2><p>Wastafel mampet umumnya disebabkan oleh penumpukan lemak, rambut, dan kotoran yang menghambat aliran air. Berikut beberapa langkah yang bisa Anda coba di rumah.</p><h2>Langkah 1: Gunakan Plunger</h2><p>Plunger adalah alat pertama yang harus dicoba. Pastikan ada air yang cukup di wastafel, lalu pompa plunger secara perlahan untuk menciptakan tekanan dan menghilangkan sumbatan.</p><h2>Langkah 2: Baking Soda dan Cuka</h2><p>Tuangkan setengah cangkir baking soda ke dalam saluran, diikuti setengah cangkir cuka putih. Diamkan 30 menit, lalu siram dengan air panas.</p><h2>Langkah 3: Gunakan Drain Snake</h2><p>Jika cara di atas tidak berhasil, drain snake atau pegas spiral bisa membantu mendorong atau menarik keluar sumbatan yang lebih dalam.</p><h2>Kapan Harus Memanggil Profesional?</h2><p>Jika sumbatan persisten meski sudah mencoba semua metode di atas, atau jika ada bau tidak sedap yang menetap, saatnya memanggil tim profesional ROOTERA. Kami menggunakan peralatan modern yang dapat membersihkan saluran tanpa merusak pipa Anda.</p>',
                'author'           => 'Tim ROOTERA',
                'status'           => 'published',
                'published_at'     => now()->subDays(7),
                'meta_title'       => 'Cara Mengatasi Wastafel Mampet Sendiri | ROOTERA',
                'meta_description' => 'Panduan lengkap cara mengatasi wastafel mampet secara mandiri. Ikuti tips dari ROOTERA untuk mengatasi masalah saluran air di rumah Anda.',
                'views'            => 127,
            ],
            [
                'title'            => '5 Tanda Saluran Pipa Rumah Anda Perlu Segera Dibersihkan',
                'slug'             => 'tanda-saluran-pipa-perlu-dibersihkan',
                'excerpt'          => 'Jangan tunggu sampai benar-benar mampet! Kenali 5 tanda awal bahwa saluran pipa rumah Anda membutuhkan perhatian segera.',
                'content'          => '<h2>5 Tanda Pipa Rumah Perlu Dibersihkan</h2><p>Banyak orang baru memanggil tukang pipa ketika saluran sudah benar-benar tersumbat. Padahal ada tanda-tanda awal yang bisa dikenali lebih cepat.</p><h3>1. Air Mengalir Lambat</h3><p>Jika air di wastafel atau bak mandi mengalir sangat lambat, ini adalah tanda pertama adanya penumpukan di dalam pipa.</p><h3>2. Bau Tidak Sedap dari Saluran</h3><p>Bau busuk yang keluar dari saluran air menandakan adanya penumpukan organik atau bahkan masalah pada sistem pembuangan.</p><h3>3. Suara Gurg-Gurgling</h3><p>Suara gelembung udara saat air mengalir menandakan ada udara terjebak akibat partial blockage di dalam pipa.</p><h3>4. Air Meluap ke Belakang</h3><p>Jika air di satu titik meluap ketika Anda menggunakan fixture lain, ini bisa menandakan sumbatan pada main drain.</p><h3>5. Terdapat Genangan Air</h3><p>Genangan air yang tidak mengalir adalah tanda terakhir sebelum completely blocked. Segera hubungi ROOTERA untuk penanganan cepat.</p>',
                'author'           => 'Tim ROOTERA',
                'status'           => 'published',
                'published_at'     => now()->subDays(14),
                'meta_title'       => '5 Tanda Saluran Pipa Perlu Dibersihkan | ROOTERA',
                'meta_description' => 'Kenali 5 tanda saluran pipa rumah Anda butuh dibersihkan. Jangan tunggu sampai mampet total, atasi segera dengan bantuan ROOTERA.',
                'views'            => 89,
            ],
            [
                'title'            => 'Pentingnya Rutin Cuci Toren Air untuk Kesehatan Keluarga',
                'slug'             => 'pentingnya-cuci-toren-air-rutin',
                'excerpt'          => 'Toren air yang kotor bisa menjadi sarang bakteri dan lumut. Pelajari mengapa membersihkan toren secara rutin sangat penting untuk kesehatan.',
                'content'          => '<h2>Mengapa Toren Perlu Rutin Dibersihkan?</h2><p>Air yang tersimpan dalam toren bisa terkontaminasi jika wadahnya jarang dibersihkan. Sedimen, lumut, dan bakteri bisa berkembang biak di dalam tangki air yang gelap dan lembab.</p><h2>Risiko Toren yang Kotor</h2><p>Air dari toren kotor bisa mengandung bakteri E. coli, giardia, dan berbagai patogen lain yang dapat menyebabkan penyakit pencernaan, diare, dan infeksi kulit.</p><h2>Seberapa Sering Harus Dibersihkan?</h2><p>Standar kesehatan merekomendasikan pembersihan toren setiap 6 bulan sekali untuk rumah tangga biasa. Untuk area industri atau restoran, bisa lebih sering.</p><h2>Proses Cuci Toren oleh ROOTERA</h2><p>Tim ROOTERA membersihkan toren dengan langkah sistematis: pengosongan air, penyikatan menyeluruh, disinfeksi dengan cairan khusus, dan pembilasan hingga bersih sempurna.</p>',
                'author'           => 'Tim ROOTERA',
                'status'           => 'published',
                'published_at'     => now()->subDays(21),
                'meta_title'       => 'Pentingnya Cuci Toren Air Rutin | ROOTERA',
                'meta_description' => 'Toren kotor bahaya untuk kesehatan! Pelajari pentingnya cuci toren rutin dan bagaimana ROOTERA bisa membantu menjaga kebersihan tangki air Anda.',
                'views'            => 203,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(['slug' => $article['slug']], $article);
        }

        // Gallery Photos (placeholder paths - will be replaced with real images)
        $photos = [
            ['title' => 'Pembersihan Saluran Kamar Mandi', 'image' => 'gallery/work-1.jpg', 'category' => 'after', 'sort_order' => 1],
            ['title' => 'Alat Profesional Hydrojet',       'image' => 'gallery/tools-1.jpg', 'category' => 'tools',  'sort_order' => 2],
            ['title' => 'Tim Teknisi ROOTERA',             'image' => 'gallery/team-1.jpg',  'category' => 'team',   'sort_order' => 3],
            ['title' => 'Cuci Toren Bersih',               'image' => 'gallery/work-2.jpg',  'category' => 'after',  'sort_order' => 4],
            ['title' => 'Instalasi Pipa Modern',            'image' => 'gallery/work-3.jpg',  'category' => 'after',  'sort_order' => 5],
            ['title' => 'Penanganan Pipa Tersumbat',        'image' => 'gallery/work-4.jpg',  'category' => 'before', 'sort_order' => 6],
        ];

        foreach ($photos as $photo) {
            GalleryPhoto::updateOrCreate(['title' => $photo['title']], array_merge($photo, ['is_active' => true]));
        }
    }
}
