<?php

namespace App\Services;

use Illuminate\Support\Str;

class LegacyGameKeyService
{
    public function fromName(string $name): string
    {
        $name = trim(
            strtoupper($name)
        );

        $replacements = [
            'SITARA MORNING' => 'sitara-morning',
            'DL SUPER DAY' => 'dl-super-day',
            'SRIDEVI' => 'sridevi',
            'TIME BAZAR' => 'time-bazar',
            'MADHUR DAY' => 'madhur-day',
            'SITARA DAY' => 'sitara-day',
            'SWASTIK DAY' => 'swastik-day',
            'RAJDHANI DAY' => 'rajdhani-day',
            'MILAN DAY' => 'milan-day',
            'SUPREME DAY' => 'supreme-day',
            'KALYAN' => 'kalyan',
            'SRIDEVI NIGHT' => 'sridevi-night',
            'DL SUPER NIGHT' => 'dl-super-night',
            'SITARA NIGHT' => 'sitara-night',
            'MADHUR NIGHT' => 'madhur-night',
            'SWASTIK NIGHT' => 'swastik-night',
            'SUPREME NIGHT' => 'supreme-night',
            'MILAN NIGHT' => 'milan-night',
            'RAJDHANI NIGHT' => 'rajdhani-night',
            'KALYAN NIGHT' => 'kalyan-night',
            'MAIN BAZAR' => 'main-bazar',
        ];

        return $replacements[$name]
            ?? Str::of($name)
                ->replaceMatches(
                    '/[^a-zA-Z0-9]+/',
                    '-'
                )
                ->lower()
                ->trim('-')
                ->value();
    }
}
