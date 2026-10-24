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
        Schema::table('articles', function (Blueprint $table) {
            // Ubah post_type menjadi string(50) agar fleksibel menampung enum baru:
            // 'article', 'promo', 'news', 'case_study', 'press_release' (serta menjaga kompatibilitas 'video_guide')
            $table->string('post_type', 50)->default('article')->change();

            // Kolom pendukung Content Hub
            $table->dateTime('promo_end_date')->nullable()->after('post_type');
            $table->string('location_geo')->nullable()->after('promo_end_date');
            $table->string('client_name')->nullable()->after('location_geo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['promo_end_date', 'location_geo', 'client_name']);
            $table->enum('post_type', ['article', 'video_guide'])->default('article')->change();
        });
    }
};
