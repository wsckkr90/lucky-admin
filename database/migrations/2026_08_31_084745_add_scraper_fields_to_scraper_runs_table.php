<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Schema::table('scraper_runs', function (Blueprint $table) {
        //     // $table->unsignedInteger('records_found')->default(0);
        //     $table->unsignedInteger('records_accepted')->default(0);
        //     $table->unsignedInteger('records_rejected')->default(0);
        //     $table->unsignedInteger('records_changed')->default(0);

        //     $table->text('response_error')->nullable();
        // });
    }

    public function down(): void
    {
        Schema::table('scraper_runs', function (Blueprint $table) {
            $table->dropColumn([
                'records_found',
                'records_accepted',
                'records_rejected',
                'records_changed',
                'response_error',
            ]);
        });
    }
};
