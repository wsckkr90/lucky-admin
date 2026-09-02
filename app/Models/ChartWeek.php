<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartWeek extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'week_start',
        'week_end',
    ];

    protected $casts = [
        'week_start' => 'date',
        'week_end' => 'date',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function entries()
{
    return $this->hasMany(
        ChartEntry::class,
        'chart_week_id'
    )->orderBy('result_date');
}
}
