<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain')->unique();
            $table->string('scheme', 10)->default('https');
            $table->string('logo_url')->nullable();
            $table->string('organization_name')->nullable();
            $table->json('same_as')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seo_site_id')->constrained('seo_sites')->cascadeOnDelete();
            $table->string('page_key');
            $table->string('label');
            $table->string('path')->default('/');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('focus_keyword')->nullable();
            $table->text('secondary_keywords')->nullable();
            $table->text('canonical_url')->nullable();
            $table->string('robots')->default('index,follow');
            $table->string('author')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('schema_type')->nullable();
            $table->json('schema_json')->nullable();
            $table->longText('extra_head')->nullable();
            $table->timestamps();

            $table->unique(['seo_site_id', 'page_key']);
            $table->index(['seo_site_id', 'path']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_pages');
        Schema::dropIfExists('seo_sites');
    }
};
