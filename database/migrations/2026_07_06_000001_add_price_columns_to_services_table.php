<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Rename existing columns to match new schema if not already exist
            if (!Schema::hasColumn('services', 'title')) {
                $table->string('title')->after('id')->nullable();
            }
            if (!Schema::hasColumn('services', 'full_description')) {
                $table->longText('full_description')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('services', 'image_path')) {
                $table->string('image_path')->nullable()->after('full_description');
            }
            if (!Schema::hasColumn('services', 'price_residential')) {
                $table->string('price_residential')->nullable()->after('image_path')
                    ->comment('Contoh: Rp 400.000');
            }
            if (!Schema::hasColumn('services', 'price_commercial')) {
                $table->string('price_commercial')->nullable()->after('price_residential')
                    ->comment('Contoh: Rp 600.000 - Rp 1.000.000');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title', 'full_description', 'image_path', 'price_residential', 'price_commercial']);
        });
    }
};
