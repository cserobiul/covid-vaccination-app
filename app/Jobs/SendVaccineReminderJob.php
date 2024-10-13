<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\VaccineReminderNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVaccineReminderJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::whereDate('scheduled_date', Carbon::tomorrow())->get();

        foreach ($users as $user) {
            $user->notify(new VaccineReminderNotification($user,$user->scheduled_date->format('d F Y'),$user->vaccineCenter->name.', '.$user->vaccineCenter->address));
        }
    }
}
