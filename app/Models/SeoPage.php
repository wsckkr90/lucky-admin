<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_site_id', 'page_key', 'label', 'path',
        'meta_title', 'meta_description', 'focus_keyword', 'secondary_keywords',
        'canonical_url', 'robots', 'author', 'published_at',
        'og_title', 'og_description', 'og_image',
        'twitter_title', 'twitter_description', 'twitter_image',
        'schema_type', 'schema_json', 'extra_head',
    ];

    protected function casts(): array
    {
        return [
            'schema_json' => 'array',
            'published_at' => 'datetime',
        ];
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(SeoSite::class, 'seo_site_id');
    }
}
