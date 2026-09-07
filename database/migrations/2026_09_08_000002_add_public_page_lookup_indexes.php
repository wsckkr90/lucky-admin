<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_contents', function (Blueprint $table) {
            $table->index(['game_id', 'active', 'sort_order'], 'seo_contents_public_lookup_idx');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->index(['game_id', 'active', 'sort_order'], 'faqs_public_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::table('seo_contents', function (Blueprint $table) {
            $table->dropIndex('seo_contents_public_lookup_idx');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex('faqs_public_lookup_idx');
        });
    }
};
