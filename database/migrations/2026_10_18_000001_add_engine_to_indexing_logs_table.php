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
        Schema::table('indexing_logs', function (Blueprint $table) {
            $table->string('engine', 20)->default('google')->after('url')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indexing_logs', function (Blueprint $table) {
            $table->dropColumn('engine');
        });
    }
};
