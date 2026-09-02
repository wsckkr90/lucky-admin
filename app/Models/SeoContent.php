<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'title',
        'content',
        'active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function game()
    {
        return $this->belongsTo(
            Game::class
        );
    }
}
