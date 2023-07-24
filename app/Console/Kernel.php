<?php

namespace App\Console;

use App\Http\Controllers\Website\HomePageController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        # Perform an artisan command Task
        // $schedule->command('inspire')->everyMinute();
        $schedule->command('check:deals')->hourly();
        
        # Perform a task from a Closure(anonymous function- written to be used just once).
        // $schedule->call(function () {
        //     // Print the output in the Log file...
        //     logger('Helloooooo, Mohamed');    
        // })->everyMinute();

        # Perform a task from a method in a invokable object
        // $schedule->call(new HomePageController)->daily();



        #To Know what are the current schedules: 
            // php artisan schedule:list
        #To Run the schedule: 
            // In the Real Server: 
                // * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
            // In your Local Host:
                // php artisan schedule:work
        #To Stop the schedule: 
            // Ctrl + c in the terminal
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
