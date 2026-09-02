<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khaiwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'legacy_id',
        'name',
        'top_header',
        'cta_text',
        'whatsapp',
        'telegram',
        'schedule',
        'active',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'schedule' => 'array',
            'active' => 'boolean',
        ];
    }
}
