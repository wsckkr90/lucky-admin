<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('game_id')
                ->constrained('games')
                ->cascadeOnDelete();

            $table->date('result_date');

            $table->string('open_panna', 10)
                ->nullable();

            $table->string('jodi', 10)
                ->nullable();

            $table->string('close_panna', 10)
                ->nullable();

            $table->string('result', 20)
                ->nullable();

            $table->enum('source', [
                'manual',
                'scraper',
                'import'
            ])->default('manual');

            $table->enum('status', [
                'pending',
                'published',
                'corrected',
                'cancelled'
            ])->default('published');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->unique([
                'game_id',
                'result_date'
            ]);

            $table->index([
                'result_date',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_results');
    }
};