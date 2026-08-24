<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectGallery;
use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Str;

class ProjectGallerySeeder extends Seeder
{
    /**
     * Run the database seeds for Project Portfolios.
     */
    public function run(): void
    {
        $categoryPipa = ServiceCategory::where('slug', 'pipa-mampet')->first();
        $categorySink = ServiceCategory::where('slug', 'wastafel-mampet')->first();
        $categoryBathroom = ServiceCategory::where('slug', 'kamar-mandi-mampet')->first();
        $categoryWC = ServiceCategory::where('slug', 'wc-toilet-mampet')->first();
        $categoryFactory = ServiceCategory::where('slug', 'pipa-industri-pabrik')->first();

        $cityJaksel = City::where('slug', 'jakarta-selatan')->first();
        $cityDepok = City::where('slug', 'depok')->first();
        $cityBandung = City::where('slug', 'bandung')->first();
        $citySemarang = City::where('slug', 'semarang')->first();
        $citySurabaya = City::where('slug', 'surabaya')->first();

        $districtKebayoran = District::where('slug', 'kebayoran-baru')->first();
        $districtMargonda = District::where('slug', 'margonda')->first();
        $districtCoblong = District::where('slug', 'coblong')->first();

        $citySerang = City::where('slug', 'serang')->first();
        $cityTangerang = City::where('slug', 'tangerang-kabupaten')->first();
        $cityJogja = City::where('slug', 'yogyakarta')->first();
        $cityBekasi = City::where('slug', 'bekasi')->first();

        $projects = [
            [
                'title' => 'Pembersihan Saluran Wastafel Restoran Berlemak Tinggi',
                'slug' => 'pembersihan-saluran-wastafel-restoran-berlemak-tinggi',
                'service_category_id' => $categorySink?->id,
                'city_id' => $cityJaksel?->id,
                'district_id' => $districtKebayoran?->id,
                'client_type' => 'Restoran/Cafe',
                'description' => 'Pelancaran bak cuci piring komersial dapur restoran yang mampet total akibat akumulasi gumpalan lemak beku 5 meter.',
                'completion_time' => '1.5 Jam',
            ],
            [
                'title' => 'Pelancaran Floor Drain Kamar Mandi Rumah Mewah',
                'slug' => 'pelancaran-floor-drain-kamar-mandi-rumah-mewah',
                'service_category_id' => $categoryBathroom?->id,
                'city_id' => $cityDepok?->id,
                'district_id' => $districtMargonda?->id,
                'client_type' => 'Rumah Tangga',
                'description' => 'Pembersihan saringan air kamar mandi mampet akibat rontokan rambut & endapan sabun mengeras tanpa merusak ubin marmer.',
                'completion_time' => '45 Menit',
            ],
            [
                'title' => 'Pembersihan Pipa Induk Pembuangan Pabrik Tekstil',
                'slug' => 'pembersihan-pipa-induk-pembuangan-pabrik-tekstil',
                'service_category_id' => $categoryFactory?->id,
                'city_id' => $cityBandung?->id,
                'district_id' => $districtCoblong?->id,
                'client_type' => 'Pabrik/Industri',
                'description' => 'Penanganan pipa pembuangan limbah cair industri diameter 6 inci tersumbat serat kain dengan mesin rooter heavy duty.',
                'completion_time' => '3 Jam',
            ],
            [
                'title' => 'Penanganan Kloset Toilet Mampet Hotel Bintang 4',
                'slug' => 'penanganan-kloset-toilet-mampet-hotel-bintang-4',
                'service_category_id' => $categoryWC?->id,
                'city_id' => $citySemarang?->id,
                'district_id' => null,
                'client_type' => 'Hotel/Apartemen',
                'description' => 'Pelancaran kloset duduk kamar hotel meluap tersumbat benda asing tanpa pembongkaran mangkuk toilet.',
                'completion_time' => '1 Jam',
            ],
            [
                'title' => 'Pembersihan Pipa Pembuangan Utama Ruko 3 Lantai',
                'slug' => 'pembersihan-pipa-pembuangan-utama-ruko-3-lantai',
                'service_category_id' => $categoryPipa?->id,
                'city_id' => $citySurabaya?->id,
                'district_id' => null,
                'client_type' => 'Ruko',
                'description' => 'Penanganan saluran pipa paralon meluap ke lantai 1 ruko perbankan dengan pembersihan kawat spiral 15 meter.',
                'completion_time' => '2 Jam',
            ],
            [
                'title' => 'Maintenance Hydro Jetting Pipa Limbah Pabrik Cikande',
                'slug' => 'maintenance-hydro-jetting-pipa-limbah-pabrik-cikande',
                'service_category_id' => $categoryFactory?->id,
                'city_id' => $citySerang?->id,
                'district_id' => null,
                'client_type' => 'Pabrik/Industri',
                'description' => 'Pencucian kerak minyak & kimia cair pipa buang industri 8 inci Kawasan Cikande Serang menggunakan Hydro Jetting High Pressure.',
                'completion_time' => '4 Jam',
            ],
            [
                'title' => 'Pembersihan Grease Trap Restoran Mall Grand Indonesia',
                'slug' => 'pembersihan-grease-trap-restoran-mall-grand-indonesia',
                'service_category_id' => $categorySink?->id,
                'city_id' => $cityJaksel?->id,
                'district_id' => null,
                'client_type' => 'Restoran/Cafe',
                'description' => 'Night shift maintenance perangkap lemak dapur restoran mall tanpa mengganggu tenant & jam operasional bisnis.',
                'completion_time' => '2 Jam',
            ],
            [
                'title' => 'Pelancaran Pipa Paralon Perumahan Citra Raya Tangerang',
                'slug' => 'pelancaran-pipa-paralon-perumahan-citra-raya-tangerang',
                'service_category_id' => $categoryPipa?->id,
                'city_id' => $cityTangerang?->id,
                'district_id' => null,
                'client_type' => 'Rumah Tangga',
                'description' => 'Panggilan darurat 24 jam penanganan pipa bak kontrol meluap perumahan Citra Raya tanpa bongkar ubin car porch.',
                'completion_time' => '50 Menit',
            ],
            [
                'title' => 'Perbaikan Main Stack Pipe Hotel Malioboro Jogja',
                'slug' => 'perbaikan-main-stack-pipe-hotel-malioboro-jogja',
                'service_category_id' => $categoryBathroom?->id,
                'city_id' => $cityJogja?->id,
                'district_id' => null,
                'client_type' => 'Hotel/Apartemen',
                'description' => 'Pembersihan kerak kapur & lemak pada saluran pipa tegak utama hotel 5 lantai kawasan Malioboro Yogyakarta.',
                'completion_time' => '2.5 Jam',
            ],
            [
                'title' => 'Pembersihan Got Pembuangan Ruko Sentra Niaga Bekasi',
                'slug' => 'pembersihan-got-pembuangan-ruko-sentra-niaga-bekasi',
                'service_category_id' => $categoryPipa?->id,
                'city_id' => $cityBekasi?->id,
                'district_id' => null,
                'client_type' => 'Ruko',
                'description' => 'Pengikisan sedimen pasir & endapan lumpur keras pada saluran buang bawah tanah kompleks ruko bisnis Bekasi.',
                'completion_time' => '2 Jam',
            ],
        ];

        foreach ($projects as $proj) {
            ProjectGallery::updateOrCreate(['slug' => $proj['slug']], array_merge($proj, ['is_active' => true]));
        }
    }
}
