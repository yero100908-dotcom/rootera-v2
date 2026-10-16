<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('postal_code');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->json('landmarks')->nullable()->after('longitude');
            $table->json('typical_issues')->nullable()->after('landmarks');
            $table->string('soil_water_profile')->nullable()->after('typical_issues');
            $table->text('intro_override')->nullable()->after('soil_water_profile');
            $table->unsignedSmallInteger('content_score')->default(0)->after('meta_description');
            $table->boolean('is_indexable')->default(false)->after('content_score');

            $table->index(['is_active', 'is_indexable'], 'districts_active_indexable_idx');
        });
    }

    public function down(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->dropIndex('districts_active_indexable_idx');
            $table->dropColumn([
                'latitude', 'longitude', 'landmarks', 'typical_issues', 'soil_water_profile',
                'intro_override', 'content_score', 'is_indexable',
            ]);
        });
    }
};
