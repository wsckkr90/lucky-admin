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
        Schema::table('scraper_runs', function (Blueprint $table) {
    $table->unsignedInteger('records_found')->default(0);
    $table->unsignedInteger('records_accepted')->default(0);
    $table->unsignedInteger('records_rejected')->default(0);
    $table->unsignedInteger('records_changed')->default(0);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scraper_runs', function (Blueprint $table) {
            //
        });
    }
};
