<?php

namespace App\Providers;

use App\Console\Commands\SendVaccineReminderCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->commands([
            SendVaccineReminderCommand::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule): void
    {
        $schedule->command('vaccine:reminder')->dailyAt('21:00');
    }
}
