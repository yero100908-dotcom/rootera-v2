<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::truncate();

        Faq::create([
            'question' => 'Berapa estimasi biaya untuk perbaikan saluran mampet?',
            'answer' => 'Biaya perbaikan sangat bervariasi tergantung pada tingkat keparahan masalah dan metode yang digunakan. Kami akan melakukan inspeksi terlebih dahulu dan memberikan estimasi transparan sebelum pekerjaan dimulai.',
            'sort_order' => 1,
            'is_active' => true
        ]);

        Faq::create([
            'question' => 'Wilayah mana saja yang masuk dalam area jangkauan layanan Anda?',
            'answer' => 'Saat ini kami melayani seluruh area Jabodetabek, Bandung, Cirebon, Semarang, Yogyakarta, Solo, dan Lampung. Hubungi admin kami untuk memastikan jangkauan di lokasi spesifik Anda.',
            'sort_order' => 2,
            'is_active' => true
        ]);

        Faq::create([
            'question' => 'Apakah ada jaminan garansi untuk hasil pengerjaan pipa mampet?',
            'answer' => 'Tentu! Kami memberikan jaminan garansi untuk setiap pekerjaan kami. Jika saluran kembali mampet dalam masa garansi akibat masalah yang sama, kami akan memperbaikinya tanpa biaya tambahan.',
            'sort_order' => 3,
            'is_active' => true
        ]);
    }
}
