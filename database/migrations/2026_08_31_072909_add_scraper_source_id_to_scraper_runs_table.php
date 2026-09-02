<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scraper_runs', function (Blueprint $table) {
            $table->foreignId('scraper_source_id')
                ->nullable()
                ->after('id')
                ->constrained('scraper_sources')
                ->nullOnDelete();

            $table->index('scraper_source_id');
        });
    }

    public function down(): void
    {
        Schema::table('scraper_runs', function (Blueprint $table) {
            $table->dropConstrainedForeignId(
                'scraper_source_id'
            );
        });
    }
};
