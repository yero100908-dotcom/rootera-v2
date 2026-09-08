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
        Schema::table('cities', function (Blueprint $table) {
            $table->index(['is_active', 'sort_order'], 'idx_cities_active_sort');
            $table->index(['province_id', 'is_active'], 'idx_cities_province_active');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->index(['city_id', 'is_active', 'sort_order'], 'idx_districts_city_active_sort');
        });

        Schema::table('project_galleries', function (Blueprint $table) {
            $table->index(['is_active', 'city_id'], 'idx_project_galleries_active_city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropIndex('idx_cities_active_sort');
            $table->dropIndex('idx_cities_province_active');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropIndex('idx_districts_city_active_sort');
        });

        Schema::table('project_galleries', function (Blueprint $table) {
            $table->dropIndex('idx_project_galleries_active_city');
        });
    }
};
