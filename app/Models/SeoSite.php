<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeoSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'scheme',
        'logo_url',
        'organization_name',
        'same_as',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'same_as' => 'array',
            'active' => 'boolean',
        ];
    }

    public function pages(): HasMany
    {
        return $this->hasMany(SeoPage::class);
    }
}
