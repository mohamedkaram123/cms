<?php

namespace App\Console\Commands;

use App\BusinessSetting;
use App\Http\Controllers\ReminderBasketController;
use Illuminate\Console\Command;

class ReminderAbondonedBaskets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:baskets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $reminderController = new ReminderBasketController();

        $reminderController->reminders_cron_job_public();

        $reminderController->reminders_cron_job_not_public();
    }
}
