<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command(
    'scraper:run --all'
)
    ->everyFiveMinutes()
    ->withoutOverlapping();

    Schedule::command(
    'lucky-numbers:scrape'
)
    ->everyFiveMinutes()
    ->withoutOverlapping();
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
