<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
    $table->id();

    $table->string('title');

    $table->string('slug')
        ->unique();

    $table->text('excerpt')
        ->nullable();

    $table->longText('content');

    $table->foreignId('author_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->string('cover_text')
        ->nullable();

    $table->string('cover_image')
        ->nullable();

    $table->enum('status', [
        'draft',
        'published'
    ])->default('draft');

    $table->boolean('featured')
        ->default(false);

    $table->timestamp('published_at')
        ->nullable();

    $table->timestamps();

    $table->index([
        'status',
        'published_at'
    ]);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
