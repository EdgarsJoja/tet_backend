<?php

namespace App\Console;

use App\Console\Commands\RssLoad;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        RssLoad::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // Should be run only on ->weekdays()->at('3:15'), since RSS data is updated every weekday at 3am,
        // but for testing/demonstration purposes it's set to run every 5 min.
        // Cron service itself runs every minute.
        $schedule->command('tet:rss:load')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
