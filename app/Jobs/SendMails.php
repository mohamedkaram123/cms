<?php

namespace App\Jobs;

use App\Mail\SupportMailManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $users;
    public $config;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $config)
    {

        $this->users = $users;
        $this->config = $config;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        foreach ($this->users as $user) {

            \Mail::to($user->email)->send(new SupportMailManager($this->config));
        }
    }
}
