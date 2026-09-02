<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khaiwals', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Legacy ID
            |--------------------------------------------------------------------------
            */

            $table->string('legacy_id')
                ->nullable()
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Display information
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            $table->text('top_header')
                ->nullable();

            $table->text('cta_text')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            $table->string('whatsapp')
                ->nullable();

            $table->string('telegram')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Schedule
            |--------------------------------------------------------------------------
            |
            | Stored as JSON because the legacy source already represents
            | the schedule as an ordered array.
            |
            |--------------------------------------------------------------------------
            */

            $table->json('schedule')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status / ordering
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')
                ->default(true);

            $table->unsignedInteger('display_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'active',
                'display_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khaiwals');
    }
};
