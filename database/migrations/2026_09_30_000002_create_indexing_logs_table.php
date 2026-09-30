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
        Schema::create('indexing_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url', 500)->index();
            $table->string('url_type', 50)->index(); // 'pseo_city', 'pseo_district', 'article', 'gallery', 'static', 'b2b_sector', 'property_type', 'faq'
            $table->string('action', 20)->default('URL_UPDATED'); // 'URL_UPDATED', 'URL_DELETED'
            $table->string('status', 20)->default('pending'); // 'success', 'failed', 'skipped', 'pending'
            $table->integer('http_status')->nullable();
            $table->text('response_message')->nullable();
            $table->timestamp('pushed_at')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indexing_logs');
    }
};
