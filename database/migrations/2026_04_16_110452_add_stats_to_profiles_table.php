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
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('projects_completed')->default(0)->after('specialty');
            $table->decimal('rating', 3, 1)->default(0.0)->after('projects_completed');
            $table->integer('response_rate')->default(100)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['specialty', 'projects_completed', 'rating', 'response_rate']);
        });
    }
};
