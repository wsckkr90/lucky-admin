<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScraperSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'method',
        'headers',
        'config',
        'active',
        'priority',
    ];

    protected function casts(): array
    {
        return [
            'headers' => 'array',
            'config' => 'array',
            'active' => 'boolean',
        ];
    }
    public function runs()
{
    return $this->hasMany(
        ScraperRun::class
    );
}
}
