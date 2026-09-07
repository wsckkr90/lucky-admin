<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chart_entries', function (Blueprint $table) {
            $table->index(
                ['chart_week_id', 'result_date'],
                'chart_entries_week_date_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::table('chart_entries', function (Blueprint $table) {
            $table->dropIndex('chart_entries_week_date_idx');
        });
    }
};
