<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cluster_district', function (Blueprint $table) {
            $table->foreignId('residential_cluster_id')->constrained('residential_clusters')->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('districts')->cascadeOnDelete();
            $table->primary(['residential_cluster_id', 'district_id']);
            $table->index('district_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cluster_district');
    }
};
