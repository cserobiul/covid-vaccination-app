<?php

namespace App\Console\Commands;

use App\Jobs\SendVaccineReminderJob;
use Illuminate\Console\Command;

class SendVaccineReminderCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send vaccine reminder emails to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendVaccineReminderJob::dispatch();
        $this->info('Vaccine reminder emails sent successfully.');
    }
}
