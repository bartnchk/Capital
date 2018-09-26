<?php

namespace App\Console;

use App\Models\Common\Achievement;
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
        \App\Console\Commands\ReindexCommand::class,
        \App\Console\Commands\IncreaseCounter::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('counter:increase')
//            ->everyMinute();
        $schedule->call(function () {
            $achievements = Achievement::firstOrFail();
            $achievements->update([
                'clients' => $achievements->clients + 100,
                'credits' => $achievements->credits + 100
            ]);
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
