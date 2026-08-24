<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_sectors', function (Blueprint $table) {
            if (!Schema::hasColumn('service_sectors', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('sector_name');
            }
            if (!Schema::hasColumn('service_sectors', 'hero_headline')) {
                $table->string('hero_headline')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('service_sectors', 'short_description')) {
                $table->text('short_description')->nullable()->after('hero_headline');
            }
            if (!Schema::hasColumn('service_sectors', 'pain_points')) {
                $table->json('pain_points')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('service_sectors', 'solutions_offered')) {
                $table->json('solutions_offered')->nullable()->after('pain_points');
            }
            if (!Schema::hasColumn('service_sectors', 'sla_guarantee')) {
                $table->string('sla_guarantee')->nullable()->after('solutions_offered');
            }
            if (!Schema::hasColumn('service_sectors', 'recommended_methods')) {
                $table->json('recommended_methods')->nullable()->after('sla_guarantee');
            }
            if (!Schema::hasColumn('service_sectors', 'service_contract_options')) {
                $table->json('service_contract_options')->nullable()->after('recommended_methods');
            }
        });
    }

    public function down(): void
    {
        Schema::table('service_sectors', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'hero_headline',
                'short_description',
                'pain_points',
                'solutions_offered',
                'sla_guarantee',
                'recommended_methods',
                'service_contract_options',
            ]);
        });
    }
};
