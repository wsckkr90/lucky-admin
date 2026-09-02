<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->string('legacy_id')
                ->nullable()
                ->unique();

            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->nullOnDelete();

            $table->string('name');

            $table->string('slug')
                ->unique();

            $table->time('open_time')
                ->nullable();

            $table->time('close_time')
                ->nullable();

            $table->string('chart_url')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->unsignedInteger('display_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'active',
                'display_order'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};