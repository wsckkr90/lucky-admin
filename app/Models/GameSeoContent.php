<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSeoContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'title',
        'content',
        'sort_order',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}