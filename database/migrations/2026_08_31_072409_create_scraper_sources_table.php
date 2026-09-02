<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scraper_sources', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('url');

            $table->string('method')
                ->default('GET');

            $table->json('headers')
                ->nullable();

            $table->json('config')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->unsignedInteger('priority')
                ->default(0);

            $table->timestamps();

            $table->index([
                'active',
                'priority',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scraper_sources');
    }
};
