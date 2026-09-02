<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_contents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('game_id')
                ->constrained('games')
                ->cascadeOnDelete();

            $table->string('title')
                ->nullable();

            $table->longText('content')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'game_id',
                'active',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_contents');
    }
};
