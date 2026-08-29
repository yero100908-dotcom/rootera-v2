<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $techs = [
            [
                'tool_name'       => 'Mesin Rooter Ridgid K-50 & Cable Spiral',
                'slug'            => 'mesin-rooter-ridgid-k50-cable-spiral',
                'type_brand'      => 'Ridgid K-50 / K-60 (USA)',
                'main_spec'       => 'Kabel baja fleksibel 5/8" - 7/8", rotasi 400 RPM',
                'pipe_target'     => 'Wastafel, floor drain, kloset, pipa 2-4 inci',
                'main_advantage'   => 'Memotong akar & rontokkan kerak lemak tanpa merusak pipa PVC',
                'badge_text'      => 'ALAT RESMI',
                'badge_color'     => 'emerald',
                'image_path'      => 'assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp',
                'description'     => 'Unit pembersih mampet mekanis bertenaga motor listrik dengan kabel spiral baja fleksibel yang meliuk mengikuti alur pipa.',
                'feature_1_label' => 'Fitur 1',
                'feature_1_value' => '⚡ Tanpa Bongkar Keramik',
                'feature_2_label' => 'Fitur 2',
                'feature_2_value' => '🔄 Putaran High Torque',
                'order_priority'  => 1,
                'sort_order'      => 1,
                'is_active'       => true,
            ],
            [
                'tool_name'       => 'Inspeksi Kamera CCTV Pipa Saluran',
                'slug'            => 'inspeksi-kamera-cctv-pipa-saluran',
                'type_brand'      => 'SeeSnake Flex HD 1080p',
                'main_spec'       => 'Lensa IP68 Waterproof + Sonde frequency locator & self-leveling',
                'pipe_target'     => 'Inspeksi visual presisi, deteksi kebocoran & pipa pecah dalam tanah/dinding',
                'main_advantage'   => 'Akurasi posisi mampet 99.8% tanpa tebak-tebak & tanpa bobok semen',
                'badge_text'      => 'TEKNOLOGI DIGITAL',
                'badge_color'     => 'blue',
                'image_path'      => 'assets/TOOLKIT/inspeksi-cctv-set-lengkap-rootera.webp',
                'description'     => 'Kamera endoskopi pipa tahan air beresolusi HD 1080p untuk memetakan lokasi dan penyebab sumbatan secara akurat.',
                'feature_1_label' => 'Fitur 1',
                'feature_1_value' => '📹 Endoskopi Waterproof',
                'feature_2_label' => 'Fitur 2',
                'feature_2_value' => '🔎 Deteksi Visual HD 1080p',
                'order_priority'  => 2,
                'sort_order'      => 2,
                'is_active'       => true,
            ],
            [
                'tool_name'       => 'High-Pressure Hydro Jetting Unit',
                'slug'            => 'high-pressure-hydro-jetting-unit',
                'type_brand'      => 'Jet-Clean Pro 250–300 Bar',
                'main_spec'       => 'Nozzle jetting rotasi 360°, debit 40L/menit bertekanan tinggi',
                'pipe_target'     => 'Grease trap restoran, saluran limbah hotel & pipa industri 4-12 inci',
                'main_advantage'   => 'Mengikis kerak lemak jenuh, pasir, & semen beku 100% bersih seperti pipa baru',
                'badge_text'      => 'HEAVY DUTY',
                'badge_color'     => 'purple',
                'image_path'      => 'assets/TOOLKIT/hydro-jetting-high-pressure-hose.webp',
                'description'     => 'Mesin pembersih hidro presisi tinggi menggunakan semprotan air bertekanan ekstrem hingga 300 Bar.',
                'feature_1_label' => 'Fitur 1',
                'feature_1_value' => '🌊 Tekanan 300 Bar',
                'feature_2_label' => 'Fitur 2',
                'feature_2_value' => '🧪 100% Bebas Bahan Kimia',
                'order_priority'  => 3,
                'sort_order'      => 3,
                'is_active'       => true,
            ],
            [
                'tool_name'       => 'Mata Pisau Cutter Head Spiral Baja',
                'slug'            => 'mata-pisau-cutter-head-spiral-baja',
                'type_brand'      => 'Heavy Duty Steel Cutting Heads',
                'main_spec'       => 'Spade cutter, grease cutter, & root saw attachments',
                'pipe_target'     => 'Aksesoris pemotong sumbatan akar pohon, endapan kapur, & lemak keras',
                'main_advantage'   => 'Penghancur sumbatan mekanis terberat tanpa risiko selip',
                'badge_text'      => 'ALAT RESMI',
                'badge_color'     => 'emerald',
                'image_path'      => 'assets/TOOLKIT/mata-pisau-cutter-head-spiral-baja.webp',
                'description'     => 'Aksesoris mata pisau spiral baja pemotong kapur, kerak lemak keras, dan akar pohon pembobol pipa.',
                'feature_1_label' => 'Fitur 1',
                'feature_1_value' => '🔪 Pemotong Kerak & Lemak',
                'feature_2_label' => 'Fitur 2',
                'feature_2_value' => '💪 Spiral Baja Tahan Karat',
                'order_priority'  => 4,
                'sort_order'      => 4,
                'is_active'       => true,
            ],
            [
                'tool_name'       => 'Kabel Spiral Flexible Rotary',
                'slug'            => 'kabel-spiral-flexible-rotary',
                'type_brand'      => 'Heavy Duty Inner Core Cable',
                'main_spec'       => 'Spiral baja tahan korosi penembus belokan leher angsa (P-trap / S-trap)',
                'pipe_target'     => 'Saluran kamar mandi, sink dapur, & talang air berbelok',
                'main_advantage'   => 'Fleksibilitas tinggi mengikuti kelokan pipa tanpa patah',
                'badge_text'      => 'ALAT RESMI',
                'badge_color'     => 'emerald',
                'image_path'      => 'assets/TOOLKIT/kabel-spiral-baja-flexible-rotary.webp',
                'description'     => 'Kabel spiral baja berinti fleksibel berdaya lentur tinggi penembus lekukan leher angsa saluran pembuangan.',
                'feature_1_label' => 'Fitur 1',
                'feature_1_value' => '🌀 Tembus P-Trap/S-Trap',
                'feature_2_label' => 'Fitur 2',
                'feature_2_value' => '📐 Jangkauan 30 Meter',
                'order_priority'  => 5,
                'sort_order'      => 5,
                'is_active'       => true,
            ],
            [
                'tool_name'       => 'Mesin Rooter Komersial Heavy-Duty',
                'slug'            => 'mesin-rooter-komersial-heavy-duty',
                'type_brand'      => 'Industrial Drain Cleaner 1.5 HP',
                'main_spec'       => 'Kabel diameter besar untuk pembersihan pipa limbah industri & restoran',
                'pipe_target'     => 'Pipa utama pembuangan gedung, mall, apartemen, & pabrik',
                'main_advantage'   => 'Daya torsi ekstra untuk sumbatan berskala industri masif',
                'badge_text'      => 'HEAVY DUTY',
                'badge_color'     => 'purple',
                'image_path'      => 'assets/TOOLKIT/mesin-rooter-komersial-heavy-duty.webp',
                'description'     => 'Mesin pelancar pipa skala industri bertenaga tinggi untuk pembersihan saluran pembuangan gedung dan kawasan pabrik.',
                'feature_1_label' => 'Fitur 1',
                'feature_1_value' => '🏢 Skala Gedung & Pabrik',
                'feature_2_label' => 'Fitur 2',
                'feature_2_value' => '⛓️ Pipa Diameter 4-12 Inci',
                'order_priority'  => 6,
                'sort_order'      => 6,
                'is_active'       => true,
            ],
        ];

        // Clean existing & seed fresh
        Technology::query()->delete();

        foreach ($techs as $t) {
            Technology::create($t);
        }
    }
}
