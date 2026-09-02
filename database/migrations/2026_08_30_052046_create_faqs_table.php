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
        Schema::create('faqs', function (Blueprint $table) {
    $table->id();

    $table->enum('scope', [
        'global',
        'game',
        'chart',
        'homepage'
    ])->default('global');

    $table->foreignId('game_id')
        ->nullable()
        ->constrained('games')
        ->nullOnDelete();

    $table->text('question');

    $table->longText('answer');

    $table->unsignedInteger('sort_order')
        ->default(0);

    $table->boolean('active')
        ->default(true);

    $table->timestamps();

    $table->index([
        'scope',
        'active',
        'sort_order'
    ]);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
