<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->boolean('has_physical_branch')->default(false)->after('estimated_arrival');
            $table->string('street_address')->nullable()->after('has_physical_branch');
            $table->string('district_locality')->nullable()->after('street_address');
            $table->string('postal_code')->nullable()->after('district_locality');
            $table->string('branch_phone')->nullable()->after('postal_code');
            $table->decimal('rating_value', 3, 2)->default(4.90)->after('branch_phone');
            $table->integer('review_count')->default(85)->after('rating_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn([
                'has_physical_branch',
                'street_address',
                'district_locality',
                'postal_code',
                'branch_phone',
                'rating_value',
                'review_count'
            ]);
        });
    }
};
