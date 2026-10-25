<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update galleries table
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'city_id')) {
                $table->foreignId('city_id')->nullable()->after('before_image_path')->constrained('cities')->nullOnDelete();
            }
            if (!Schema::hasColumn('galleries', 'district_id')) {
                $table->foreignId('district_id')->nullable()->after('city_id')->constrained('districts')->nullOnDelete();
            }

            $table->index(['is_active', 'district_id'], 'idx_galleries_active_district');
            $table->index(['is_active', 'city_id'], 'idx_galleries_active_city');
            $table->index(['is_active', 'location_tag'], 'idx_galleries_active_location');
            $table->index(['is_active', 'is_featured'], 'idx_galleries_active_featured');
            $table->index(['is_active', 'category'], 'idx_galleries_active_category');
        });

        // 2. Update project_galleries table
        Schema::table('project_galleries', function (Blueprint $table) {
            $table->index(['is_active', 'district_id'], 'idx_project_galleries_active_district');
            $table->index(['is_active', 'city_id', 'district_id'], 'idx_project_galleries_active_city_district');
            $table->index(['is_active', 'service_category_id'], 'idx_project_galleries_active_service');
        });

        // 3. Backfill city_id & district_id on galleries from location_tag
        try {
            $cities = DB::table('cities')->select('id', 'name')->get();
            $districts = DB::table('districts')->select('id', 'city_id', 'name')->get();
            $galleries = DB::table('galleries')->whereNotNull('location_tag')->get();

            foreach ($galleries as $g) {
                $tag = strtolower($g->location_tag);
                $matchedDistrict = $districts->first(function ($d) use ($tag) {
                    return str_contains($tag, strtolower($d->name));
                });

                $cityId = null;
                $districtId = null;

                if ($matchedDistrict) {
                    $districtId = $matchedDistrict->id;
                    $cityId = $matchedDistrict->city_id;
                } else {
                    $matchedCity = $cities->first(function ($c) use ($tag) {
                        return str_contains($tag, strtolower($c->name));
                    });
                    if ($matchedCity) {
                        $cityId = $matchedCity->id;
                    }
                }

                if ($cityId || $districtId) {
                    DB::table('galleries')->where('id', $g->id)->update([
                        'city_id' => $cityId,
                        'district_id' => $districtId,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Log without failing migration
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_galleries', function (Blueprint $table) {
            $table->dropIndex('idx_project_galleries_active_district');
            $table->dropIndex('idx_project_galleries_active_city_district');
            $table->dropIndex('idx_project_galleries_active_service');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex('idx_galleries_active_district');
            $table->dropIndex('idx_galleries_active_city');
            $table->dropIndex('idx_galleries_active_location');
            $table->dropIndex('idx_galleries_active_featured');
            $table->dropIndex('idx_galleries_active_category');

            if (Schema::hasColumn('galleries', 'district_id')) {
                $table->dropForeign(['district_id']);
                $table->dropColumn('district_id');
            }
            if (Schema::hasColumn('galleries', 'city_id')) {
                $table->dropForeign(['city_id']);
                $table->dropColumn('city_id');
            }
        });
    }
};
