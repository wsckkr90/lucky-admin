<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;

    protected $table = 'seo_meta';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'focus_keyword',
        'secondary_keywords',
        'canonical_url',
        'robots',

        'og_title',
        'og_description',
        'og_image',

        'twitter_title',
        'twitter_description',
        'twitter_image',

        'schema_type',
        'schema_json',
    ];

    protected function casts(): array
    {
        return [
            'schema_json' => 'array',
        ];
    }

    public function seoable()
    {
        return $this->morphTo();
    }
}
