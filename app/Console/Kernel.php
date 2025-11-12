<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\CheckDueBillsCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Laravel 11: Scheduler dipindahkan ke routes/console.php
        // Method ini tetap ada untuk compatibility, tapi tidak digunakan lagi
        // Lihat: routes/console.php untuk scheduler definition
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
