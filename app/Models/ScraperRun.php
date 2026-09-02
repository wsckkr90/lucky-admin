<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScraperRun extends Model
{
    use HasFactory;

    protected $fillable = [
        'scraper_source_id',
        'started_at',
        'completed_at',
        'status',
        'games_found',
        'games_updated',
        'error_count',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function source()
    {
        return $this->belongsTo(
            ScraperSource::class,
            'scraper_source_id'
        );
    }
}
