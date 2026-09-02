<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();

            $table->string('legacy_id')
                ->nullable()
                ->unique();

            $table->string('name');

            $table->string('slug')
                ->unique();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();
            $table->unsignedInteger('display_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};