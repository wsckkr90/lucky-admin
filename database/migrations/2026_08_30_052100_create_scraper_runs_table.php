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
        Schema::create('scraper_runs', function (Blueprint $table) {
    $table->id();

    $table->timestamp('started_at');

    $table->timestamp('completed_at')
        ->nullable();

    $table->enum('status', [
        'running',
        'success',
        'failed',
        'partial'
    ])->default('running');

    $table->unsignedInteger('games_found')
        ->default(0);

    $table->unsignedInteger('games_updated')
        ->default(0);

    $table->unsignedInteger('error_count')
        ->default(0);

    $table->text('message')
        ->nullable();

    $table->timestamps();

    $table->index([
        'status',
        'started_at'
    ]);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scraper_runs');
    }
};
