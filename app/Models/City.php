<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'legacy_id',
        'name',
        'slug',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_cities'
        )->withTimestamps();
    }
}