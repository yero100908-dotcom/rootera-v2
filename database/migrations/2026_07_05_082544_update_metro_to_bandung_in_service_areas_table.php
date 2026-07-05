<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::table('service_areas')->where('name', 'Metro')->update([
            'name' => 'Bandung',
            'slug' => 'bandung',
            'province' => 'Jawa Barat',
            'description' => 'Tim ROOTERA melayani Kota Bandung dan area sekitar provinsi Jawa Barat.',
            'meta_title' => 'Jasa Pipa Mampet Bandung | ROOTERA',
            'meta_description' => 'ROOTERA Bandung siap bantu atasi masalah pipa dan saluran Anda.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::table('service_areas')->where('name', 'Bandung')->update([
            'name' => 'Metro',
            'slug' => 'metro',
            'province' => 'Lampung',
            'description' => 'Tim ROOTERA melayani Kota Metro dan area sekitar provinsi Lampung.',
            'meta_title' => 'Jasa Pipa Mampet Metro Lampung | ROOTERA',
            'meta_description' => 'ROOTERA Metro Lampung siap bantu atasi masalah pipa dan saluran Anda.',
        ]);
    }
};
