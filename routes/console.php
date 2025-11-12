<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Comment out inspire command untuk avoid conflict
// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// TESTING: Check due bills every minute 
// Schedule::command('bills:check-due')
//     ->everyMinute()
//     ->appendOutputTo(storage_path('logs/scheduler.log'));

// PRODUCTION: Kirim email setiap hari jam 09:00 pagi
Schedule::command('bills:check-due')
    ->dailyAt('09:00')
    ->timezone('Asia/Jakarta')
    ->appendOutputTo(storage_path('logs/scheduler.log'));
