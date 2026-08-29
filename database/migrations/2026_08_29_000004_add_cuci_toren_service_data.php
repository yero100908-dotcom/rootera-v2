<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Service;
use App\Models\ServiceCategory;

return new class extends Migration
{
    public function up(): void
    {
        $cat = ServiceCategory::where('slug', 'air-bersih-cuci-toren')->first() 
            ?? ServiceCategory::first();

        Service::firstOrCreate(
            ['slug' => 'cuci-toren-tandon-air'],
            [
                'service_category_id' => $cat ? $cat->id : 2,
                'name'               => 'Jasa Cuci Toren & Kuras Tandon Air',
                'title'              => 'Jasa Cuci Toren & Kuras Tandon Air Residensial & Komersial',
                'short_description'  => 'Layanan pembersihan dan pengurasan toren air rumah, ruko, restoran, dan gedung dengan High-Pressure Jet Cleaner food-grade safety.',
                'full_description'   => 'Layanan kuras dan sterilisasi toren air tandon bawah/atas tanpa bahan kimia korosif. Membersihkan lumut padat, endapan lumpur, dan sisa kerak air untuk menjaga pasokan air bersih yang higienis.',
                'content'            => 'Pembersihan profesional toren air berbahan PE (plastik) maupun Stainless Steel menggunakan perlengkapan mini jet washer food-grade safety.',
                'price_start'        => 250000.00,
                'price_residential'  => 'Rp 250.000 - Rp 450.000',
                'price_commercial'   => 'Rp 500.000 - Rp 1.500.000',
                'is_active'          => true,
                'sort_order'         => 99,
                'meta_title'         => 'Jasa Cuci Toren & Kuras Tandon Air Bersih | Rootera Plumbing',
                'meta_description'   => 'Jasa cuci toren air & kuras tandon higienis tanpa kimia berbahaya. Pengurasan lumut, endapan lumpur & sterilisasi tangki bergaransi resmi.',
            ]
        );
    }

    public function down(): void
    {
        Service::where('slug', 'cuci-toren-tandon-air')->delete();
    }
};
