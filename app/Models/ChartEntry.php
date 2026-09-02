<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'chart_week_id',
        'result_date',
        'day_of_week',
        'open_panna',
        'jodi',
        'close_panna',
        'result',
    ];

    protected $casts = [
        'result_date' => 'date',
        'day_of_week' => 'integer',
    ];

    public function week()
    {
        return $this->belongsTo(
            ChartWeek::class,
            'chart_week_id'
        );
    }
}