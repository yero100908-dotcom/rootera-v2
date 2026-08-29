<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            if (!Schema::hasColumn('technologies', 'slug')) {
                $table->string('slug')->nullable()->after('tool_name');
            }
            if (!Schema::hasColumn('technologies', 'type_brand')) {
                $table->string('type_brand')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('technologies', 'main_spec')) {
                $table->text('main_spec')->nullable()->after('type_brand');
            }
            if (!Schema::hasColumn('technologies', 'pipe_target')) {
                $table->string('pipe_target')->nullable()->after('main_spec');
            }
            if (!Schema::hasColumn('technologies', 'main_advantage')) {
                $table->string('main_advantage')->nullable()->after('pipe_target');
            }
            if (!Schema::hasColumn('technologies', 'badge_text')) {
                $table->string('badge_text')->default('ALAT RESMI')->after('main_advantage');
            }
            if (!Schema::hasColumn('technologies', 'badge_color')) {
                $table->string('badge_color')->default('emerald')->after('badge_text');
            }
            if (!Schema::hasColumn('technologies', 'feature_1_label')) {
                $table->string('feature_1_label')->nullable()->after('description');
            }
            if (!Schema::hasColumn('technologies', 'feature_1_value')) {
                $table->string('feature_1_value')->nullable()->after('feature_1_label');
            }
            if (!Schema::hasColumn('technologies', 'feature_2_label')) {
                $table->string('feature_2_label')->nullable()->after('feature_1_value');
            }
            if (!Schema::hasColumn('technologies', 'feature_2_value')) {
                $table->string('feature_2_value')->nullable()->after('feature_2_label');
            }
            if (!Schema::hasColumn('technologies', 'order_priority')) {
                $table->integer('order_priority')->default(0)->after('sort_order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'type_brand', 'main_spec', 'pipe_target', 'main_advantage',
                'badge_text', 'badge_color', 'feature_1_label', 'feature_1_value',
                'feature_2_label', 'feature_2_value', 'order_priority'
            ]);
        });
    }
};
