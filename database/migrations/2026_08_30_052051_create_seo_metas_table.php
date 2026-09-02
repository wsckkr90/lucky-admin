<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_meta', function (Blueprint $table) {
            $table->id();

            $table->morphs('seoable');

            $table->string('meta_title')
                ->nullable();

            $table->text('meta_description')
                ->nullable();

            $table->string('focus_keyword')
                ->nullable();

            $table->text('secondary_keywords')
                ->nullable();

            $table->text('canonical_url')
                ->nullable();

            $table->string('robots')
                ->default('index,follow');

            $table->string('og_title')
                ->nullable();

            $table->text('og_description')
                ->nullable();

            $table->string('og_image')
                ->nullable();

            $table->string('twitter_title')
                ->nullable();

            $table->text('twitter_description')
                ->nullable();

            $table->string('twitter_image')
                ->nullable();

            $table->string('schema_type')
                ->nullable();

            $table->json('schema_json')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_meta');
    }
};