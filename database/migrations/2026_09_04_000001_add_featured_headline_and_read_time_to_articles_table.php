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
            $table->boolean('is_headline')->default(false)->after('category');
            $table->boolean('is_featured')->default(false)->after('is_headline');
            $table->integer('read_time')->nullable()->after('is_featured')->comment('Reading time in minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['is_headline', 'is_featured', 'read_time']);
        });
    }
};
