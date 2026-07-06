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
        Schema::table('service_categories', function (Blueprint $table) {
            $table->string('price_home')->nullable()->after('description');
            $table->string('price_corporate')->nullable()->after('price_home');
            $table->text('price_description')->nullable()->after('price_corporate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn(['price_home', 'price_corporate', 'price_description']);
        });
    }
};
