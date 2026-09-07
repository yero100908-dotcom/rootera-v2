<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectGallery;
use App\Models\City;
use App\Models\District;

class ProjectGallerySeeder extends Seeder
{
    /**
     * Run the database seeds for Project Portfolios.
     */
    public function run(): void
    {
        $projects = array (
  0 => 
  array (
    'service_category_id' => 2,
    'city_id' => 1,
    'district_id' => 1,
    'title' => 'Pembersihan Saluran Wastafel Restoran Berlemak Tinggi',
    'slug' => 'pembersihan-saluran-wastafel-restoran-berlemak-tinggi',
    'client_type' => 'Restoran/Cafe',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Pelancaran bak cuci piring komersial dapur restoran yang mampet total akibat akumulasi gumpalan lemak beku 5 meter.',
    'completion_time' => '1.5 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  1 => 
  array (
    'service_category_id' => 3,
    'city_id' => 20,
    'district_id' => NULL,
    'title' => 'Pelancaran Floor Drain Kamar Mandi Rumah Mewah',
    'slug' => 'pelancaran-floor-drain-kamar-mandi-rumah-mewah',
    'client_type' => 'Rumah Tangga',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Pembersihan saringan air kamar mandi mampet akibat rontokan rambut & endapan sabun mengeras tanpa merusak ubin marmer.',
    'completion_time' => '45 Menit',
    'is_active' => true,
    'sort_order' => 0,
  ),
  2 => 
  array (
    'service_category_id' => 7,
    'city_id' => 14,
    'district_id' => NULL,
    'title' => 'Pembersihan Pipa Induk Pembuangan Pabrik Tekstil',
    'slug' => 'pembersihan-pipa-induk-pembuangan-pabrik-tekstil',
    'client_type' => 'Pabrik/Industri',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Penanganan pipa pembuangan limbah cair industri diameter 6 inci tersumbat serat kain dengan mesin rooter heavy duty.',
    'completion_time' => '3 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  3 => 
  array (
    'service_category_id' => 4,
    'city_id' => 30,
    'district_id' => NULL,
    'title' => 'Penanganan Kloset Toilet Mampet Hotel Bintang 4',
    'slug' => 'penanganan-kloset-toilet-mampet-hotel-bintang-4',
    'client_type' => 'Hotel/Apartemen',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Pelancaran kloset duduk kamar hotel meluap tersumbat benda asing tanpa pembongkaran mangkuk toilet.',
    'completion_time' => '1 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  4 => 
  array (
    'service_category_id' => 1,
    'city_id' => 51,
    'district_id' => NULL,
    'title' => 'Pembersihan Pipa Pembuangan Utama Ruko 3 Lantai',
    'slug' => 'pembersihan-pipa-pembuangan-utama-ruko-3-lantai',
    'client_type' => 'Ruko',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Penanganan saluran pipa paralon meluap ke lantai 1 ruko perbankan dengan pembersihan kawat spiral 15 meter.',
    'completion_time' => '2 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  5 => 
  array (
    'service_category_id' => 7,
    'city_id' => 7,
    'district_id' => NULL,
    'title' => 'Maintenance Hydro Jetting Pipa Limbah Pabrik Cikande',
    'slug' => 'maintenance-hydro-jetting-pipa-limbah-pabrik-cikande',
    'client_type' => 'Pabrik/Industri',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Pencucian kerak minyak & kimia cair pipa buang industri 8 inci Kawasan Cikande Serang menggunakan Hydro Jetting High Pressure.',
    'completion_time' => '4 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  6 => 
  array (
    'service_category_id' => 2,
    'city_id' => 1,
    'district_id' => NULL,
    'title' => 'Pembersihan Grease Trap Restoran Mall Grand Indonesia',
    'slug' => 'pembersihan-grease-trap-restoran-mall-grand-indonesia',
    'client_type' => 'Restoran/Cafe',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Night shift maintenance perangkap lemak dapur restoran mall tanpa mengganggu tenant & jam operasional bisnis.',
    'completion_time' => '2 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  7 => 
  array (
    'service_category_id' => 1,
    'city_id' => NULL,
    'district_id' => NULL,
    'title' => 'Pelancaran Pipa Paralon Perumahan Citra Raya Tangerang',
    'slug' => 'pelancaran-pipa-paralon-perumahan-citra-raya-tangerang',
    'client_type' => 'Rumah Tangga',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Panggilan darurat 24 jam penanganan pipa bak kontrol meluap perumahan Citra Raya tanpa bongkar ubin car porch.',
    'completion_time' => '50 Menit',
    'is_active' => true,
    'sort_order' => 0,
  ),
  8 => 
  array (
    'service_category_id' => 3,
    'city_id' => 46,
    'district_id' => NULL,
    'title' => 'Perbaikan Main Stack Pipe Hotel Malioboro Jogja',
    'slug' => 'perbaikan-main-stack-pipe-hotel-malioboro-jogja',
    'client_type' => 'Hotel/Apartemen',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Pembersihan kerak kapur & lemak pada saluran pipa tegak utama hotel 5 lantai kawasan Malioboro Yogyakarta.',
    'completion_time' => '2.5 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
  9 => 
  array (
    'service_category_id' => 1,
    'city_id' => 21,
    'district_id' => NULL,
    'title' => 'Pembersihan Got Pembuangan Ruko Sentra Niaga Bekasi',
    'slug' => 'pembersihan-got-pembuangan-ruko-sentra-niaga-bekasi',
    'client_type' => 'Ruko',
    'before_image' => NULL,
    'after_image' => NULL,
    'description' => 'Pengikisan sedimen pasir & endapan lumpur keras pada saluran buang bawah tanah kompleks ruko bisnis Bekasi.',
    'completion_time' => '2 Jam',
    'is_active' => true,
    'sort_order' => 0,
  ),
);

        foreach ($projects as $item) {
            // FK Safety validation: check if city_id and district_id exist and belong to active regions
            $cityId = $item['city_id'];
            $districtId = $item['district_id'];

            if ($cityId) {
                $validCity = City::where('id', $cityId)->where('is_active', true)->exists();
                if (!$validCity) {
                    $item['city_id'] = null;
                }
            }

            if ($districtId) {
                $validDistrict = District::where('id', $districtId)->whereHas('city', fn($q) => $q->where('is_active', true))->exists();
                if (!$validDistrict) {
                    $item['district_id'] = null;
                }
            }

            ProjectGallery::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
