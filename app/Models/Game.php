<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Faq;
use App\Models\SeoContent;
use App\Models\SeoMeta;
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'legacy_id',
        'city_id',
        'name',
        'slug',
        'open_time',
        'close_time',
        'chart_url',
        'active',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'open_time' => 'datetime:H:i',
            'close_time' => 'datetime:H:i',
        ];
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function results()
    {
        return $this->hasMany(GameResult::class);
    }

    public function faqs()
{
    return $this->hasMany(
        Faq::class
    )->orderBy('sort_order')
    ->orderBy('id');
}



    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }
    public function chartWeeks()
{
    return $this->hasMany(
        ChartWeek::class
    );
}

public function seoContents()
{
    return $this->hasMany(
        SeoContent::class
    )->orderBy('sort_order')
    ->orderBy('id');
}
}
