<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_galleries', function (Blueprint $table) {
            $table->foreignId('residential_cluster_id')
                ->nullable()
                ->after('district_id')
                ->constrained('residential_clusters')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('project_galleries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('residential_cluster_id');
        });
    }
};
