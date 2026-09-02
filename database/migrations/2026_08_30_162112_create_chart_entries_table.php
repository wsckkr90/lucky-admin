<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chart_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('chart_week_id')
                ->constrained('chart_weeks')
                ->cascadeOnDelete();

            $table->date('result_date');

            $table->unsignedTinyInteger('day_of_week');

            $table->string('open_panna', 10)
                ->nullable();

            $table->string('jodi', 10)
                ->nullable();

            $table->string('close_panna', 10)
                ->nullable();

            $table->string('result', 20)
                ->nullable();

            $table->timestamps();

            $table->unique([
                'chart_week_id',
                'result_date',
            ]);

            $table->index([
                'result_date',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chart_entries');
    }
};