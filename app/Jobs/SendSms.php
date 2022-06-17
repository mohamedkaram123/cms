<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $users;
    public $msg;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $msg)
    {
        //
        $this->users = $users;
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        foreach ($this->users as $user) {


            $phone = fullPhoneUser($user);
            $msg =  SMS_Send($phone, $this->msg);
        }
    }
}
