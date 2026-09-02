<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'autoload',
    ];

    protected function casts(): array
    {
        return [
            'autoload' => 'boolean',
        ];
    }

    /**
     * Convert stored value to the configured type.
     */
    public function getTypedValueAttribute(): mixed
    {
        return match ($this->type) {
            'boolean' => filter_var(
                $this->value,
                FILTER_VALIDATE_BOOLEAN
            ),

            'integer' => (int) $this->value,

            'json' => json_decode(
                $this->value,
                true
            ),

            default => $this->value,
        };
    }
}
