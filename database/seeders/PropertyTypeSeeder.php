<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;
use Illuminate\Support\Str;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $propertyTypes = [
            [
                'name' => 'Rumah Tinggal & Cluster Perumahan',
                'slug' => 'rumah-tinggal',
                'icon' => '🏡',
                'hero_headline' => 'Jasa Pelancaran Saluran Mampet Rumah Tinggal Tanpa Bongkar Keramik',
                'meta_title' => 'Pelancar Pipa Mampet Rumah Tinggal & Cluster Perumahan - Rootera',
                'meta_description' => 'Solusi cepat & bersih pelancaran wastafel dapur, kamar mandi, WC meluap, & got rumah tinggal. Pengerjaan 1-2 jam bebas kimia & garansi 30 hari.',
                'common_issues' => [
                    'Wastafel dapur mampet tersumbat lemak cuci piring & sisa makanan.',
                    'Floor drain kamar mandi menggenang akibat rontokan rambut & kerak sabun.',
                    'Kloset WC meluap & tidak bisa disiram saat dibutuhkan keluarga.',
                    'Pipa pembuangan got rumah meluap air kotor ke dalam teras.'
                ],
                'fast_solutions' => [
                    'Pengerjaan cepat 1-2 jam langsung lancar tuntas tanpa bongkar ubin.',
                    'Menggunakan mesin Spiral Rotary Cable modern 100% bebas kimia asam korosif.',
                    'Teknisi berseragam resmi, terverifikasi identitasnya, & menerapkan protokol kebersihan.',
                    'Garansi resmi 30 hari pengerjaan ulang gratis jika saluran mampet kembali.'
                ],
                'price_starting_from' => 'Rp 350.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cafe, Restoran & Cloud Kitchen',
                'slug' => 'cafe-restoran',
                'icon' => '☕',
                'hero_headline' => 'Jasa Pelancar Pipa Mampet & Pembersihan Sink Dapur Cafe / Resto',
                'meta_title' => 'Tukang Pipa Mampet Cafe, Restoran & Cloud Kitchen - Rootera',
                'meta_description' => 'Atasi saluran grease trap & sink cuci piring mampet di cafe & restoran. Penanganan cepat steril tanpa mengganggu jam buka tempat usaha.',
                'common_issues' => [
                    'Bak cuci piring (sink) meluap saat jam buka ramai pelanggan.',
                    'Pipa grease trap penuh kerak lemak membandel & menimbulkan bau kotor.',
                    'Floor sink area bar & kitchen tersumbat ampas kopi, teh, atau minyak goreng.',
                    'Air pembuangan lambat surut mengganggu kebersihan operasional dapur.'
                ],
                'fast_solutions' => [
                    'Respon panggil cepat 25-40 menit teknisi tiba di lokasi usaha Anda.',
                    'Metode pengerjaan higienis food-grade tanpa menyebarkan bau ke area makan.',
                    'Layanan jadwal fleksibel saat tempat usaha tutup (Night Shift Solution).',
                    'Diberikan kwitansi / invoice pembayaran resmi usaha & garansi 30 hari.'
                ],
                'price_starting_from' => 'Rp 400.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 2,
            ],
            [
                'name' => 'Kos-Kosan, Homestay, Apartemen & Hotel',
                'slug' => 'hotel-apartemen',
                'icon' => '🏢',
                'hero_headline' => 'Solusi Saluran Mampet Kos-Kosan, Homestay & Unit Apartemen',
                'short_description' => 'Penanganan cepat saluran kamar mandi kos, kloset meluap, & pipa riser apartemen tanpa bising yang mengganggu penghuni.',
                'meta_title' => 'Pelancar Saluran Mampet Kos-Kosan & Unit Apartemen - Rootera',
                'meta_description' => 'Layanan panggil teknisi pipa mampet untuk kos-kosan & apartemen. Bebas bongkar lantai, alat tidak bising, garansi 30 hari.',
                'common_issues' => [
                    'Kamar mandi penyewa kos meluap akibat akumulasi pembuangan tumpuk.',
                    'Kloset toilet unit apartemen meluap air kotor ke dalam lantai.',
                    'Pipa buang laundry & sink dapur kos tersumbat endapan detergen.',
                    'Keluhan penghuni kos akibat bau tidak sedap dari leher angsa floor drain.'
                ],
                'fast_solutions' => [
                    'Mesin rotasi silent tanpa kebisingan ekstrem yang mengganggu kamar tetangga.',
                    'Bebas dari perusakan keramik/dinding beton (100% Non-Destructive).',
                    'Pembersihan saringan & leher angsa saluran tuntas hingga ke pipa utama.',
                    'Garansi 30 hari penuh demi kenyamanan usaha tempat tinggal sewa Anda.'
                ],
                'price_starting_from' => 'Rp 350.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 3,
            ],
            [
                'name' => 'Tenant Mall & Kios Foodcourt',
                'slug' => 'mall-shopping-center',
                'icon' => '🏬',
                'hero_headline' => 'Jasa Servis Pipa Mampet Tenant Mall & Stand Kios Foodcourt',
                'meta_title' => 'Servis Saluran Mampet Kios Foodcourt & Tenant Mall - Rootera',
                'meta_description' => 'Pembersihan pipa mampet tenant mall & foodcourt. Sesuai prosedur Building Management (BM) mall & pengerjaan malam hari.',
                'common_issues' => [
                    'Air sink tenant meluap saat jam buka operasional mall.',
                    'Persyaratan izin kerja ketat dari Building Management (BM) Mall.',
                    'Penumpukan kerak sisa minuman / makanan di jalur pipa pembuangan meliuk.',
                    'Potensi denda dari manajemen mall jika air kotor menggenangi lorong publik.'
                ],
                'fast_solutions' => [
                    'Kepatuhan SOP kerja safety & kebersihan dari manajemen gedung mall.',
                    'Tim siap melayani pengerjaan malam setelah operasional mall tutup.',
                    'Alat Spiral Rotary fleksibel mampu menjangkau rute pipa meliuk panjang.',
                    'Invoice legal lengkap & garansi pengerjaan tuntas 30 hari.'
                ],
                'price_starting_from' => 'Rp 450.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kantor Ruko, Coworking & Studio Kerja',
                'slug' => 'perkantoran',
                'icon' => '💼',
                'hero_headline' => 'Pelancaran Pipa Toilet & Pantry Kantor Ruko / Coworking Space',
                'meta_title' => 'Jasa Pipa Mampet Kantor Ruko & Coworking Space - Rootera',
                'meta_description' => 'Solusi cepat pipa pantry & toilet kantor tersumbat. Pengerjaan rapi, ramah lingkungan, & teknisi cepat datang 24 Jam.',
                'common_issues' => [
                    'Wastafel pantry kantor tersumbat ampas teh, kopi, & minyak bekas makan siang.',
                    'Toilet karyawan mampet meluap saat jam kerja aktif.',
                    'Saluran pembuangan AC kantor tersumbat lumut & meneteskan air ke plafon.',
                    'Bau kotor dari toilet mengganggu kenyamanan kerja tim kantor.'
                ],
                'fast_solutions' => [
                    'Pengerjaan rapi & bersih tanpa mengotori lantai carpet/vinyl kantor.',
                    'Respon teknisi kilat 25-40 menit tiba di kantor Anda.',
                    'Pembersihan 100% mekanis tanpa bahan kimia berbau tajam.',
                    'Laporan pembayaran transparan dengan invoice resmi.'
                ],
                'price_starting_from' => 'Rp 400.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 5,
            ],
            [
                'name' => 'Kawasan Ruko, Toko & Kompleks Niaga',
                'slug' => 'kawasan-ruko',
                'icon' => '🏪',
                'hero_headline' => 'Tukang Pipa Mampet Ruko 2-4 Lantai & Toko Kompleks Niaga',
                'meta_title' => 'Tukang Pipa Mampet Kawasan Ruko & Kompleks Niaga - Rootera',
                'meta_description' => 'Servis pelancar saluran ruko tersumbat, got depan ruko, & bak kontrol pembuangan. Garansi 30 hari & pengerjaan cepat.',
                'common_issues' => [
                    'Got pembuangan bersama depan ruko meluap air hitam berbau.',
                    'Saluran pipa lantai 1 & 2 ruko tersumbat sampah / kain perca salon.',
                    'Bak kontrol ruko penuh endapan pasir & sampah plastik.',
                    'Toilet lantai dasar ruko meluap saat hujan deras.'
                ],
                'fast_solutions' => [
                    'Pembersihan total rute pipa dari lantai atas hingga bak kontrol luar.',
                    'Penggunaan kabel jangkauan panjang merontokkan kerak di pipa ruko.',
                    'Tarif terjangkau tanpa biaya tersembunyi + garansi 30 hari.',
                    'Penanganan profesional hanya membutuhkan waktu 1-2 jam.'
                ],
                'price_starting_from' => 'Rp 400.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 6,
            ],
            [
                'name' => 'Sekolah, Yayasan, Klinik Pribadi & Tempat Ibadah',
                'slug' => 'instansi-pemerintah-swasta',
                'icon' => '🏫',
                'hero_headline' => 'Servis Pipa Sanitasi Sekolah, Klinik Pribadi & Gedung Yayasan',
                'meta_title' => 'Servis Pipa Mampet Gedung Sekolah, Klinik & Yayasan - Rootera',
                'meta_description' => 'Jasa pelancaran saluran air mampet fasilitas umum, sekolah, & klinik. Pengerjaan cepat, higienis, garansi resmi 30 hari.',
                'common_issues' => [
                    'Toilet murid / pengunjung klinik mampet tersumbat tisu & kemasan plastik.',
                    'Wastafel cuci tangan sekolah menggenang air kotor.',
                    'Tempat wudhu / toilet tempat ibadah meluap air bekas pangkas.',
                    'Saluran pembuangan umum meluap mengganggu aktivitas publik.'
                ],
                'fast_solutions' => [
                    'Penanganan higienis & ramah anak (bebas bau kimia asam soda api).',
                    'Dukungan armada teknisi siap meluncur setiap saat 24 Jam nonstop.',
                    'Garansi 30 hari pengerjaan tuntas untuk kenyamanan bersama.',
                    'Nota & invoice pembayaran resmi sesuai standar pengurus yayasan.'
                ],
                'price_starting_from' => 'Rp 400.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 7,
            ],
            [
                'name' => 'Gudang Logistik, Workshop & Bengkel',
                'slug' => 'industri-pergudangan',
                'icon' => '📦',
                'hero_headline' => 'Jasa Pelancaran Drainase Gudang Logistik, Workshop & Bengkel',
                'meta_title' => 'Pelancar Saluran Mampet Gudang Logistik & Workshop - Rootera',
                'meta_description' => 'Atasi saluran mampet area pergudangan, bengkel & workshop. Mesin rotasi spiral & hydro-jetting rontokkan endapan lumpur.',
                'common_issues' => [
                    'Drainase lantai gudang meluap air hujan & mengancam stok barang.',
                    'Saluran cuci sparepart / alat bengkel tersumbat endapan lumpur & tanah.',
                    'Toilet & kamar mandi staf gudang meluap air kotor.',
                    'Endapan pasir tebal menyumbat jalur pembuangan utama gudang.'
                ],
                'fast_solutions' => [
                    'Penggunaan unit mesin rotasi bertenaga tinggi untuk rontokkan lumpur padat.',
                    'Teknisi sigap & tanggap darurat mencegah kerusakan aset barang di gudang.',
                    'Garansi 30 hari resmi pengerjaan lancar tanpa kendala.',
                    'Tersedia kwitansi & bukti pembayaran legal usaha.'
                ],
                'price_starting_from' => 'Rp 450.000',
                'estimated_time' => '1-2 Jam Selesai',
                'guarantee_days' => 30,
                'sort_order' => 8,
            ],
        ];

        foreach ($propertyTypes as $data) {
            PropertyType::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'icon' => $data['icon'],
                    'hero_headline' => $data['hero_headline'],
                    'meta_title' => $data['meta_title'],
                    'meta_description' => $data['meta_description'],
                    'common_issues' => $data['common_issues'],
                    'fast_solutions' => $data['fast_solutions'],
                    'price_starting_from' => $data['price_starting_from'],
                    'estimated_time' => $data['estimated_time'],
                    'guarantee_days' => $data['guarantee_days'],
                    'sort_order' => $data['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
