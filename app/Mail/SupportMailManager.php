<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportMailManager extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($array);
        return $this->view($this->array['view'])
            ->from($this->array['from'], env('MAIL_FROM_NAME'))
            ->subject($this->array['subject'])
            ->with([
                'content' => empty($this->array['content']) ? "" : $this->array['content'],
                'link' => empty($this->array['link']) ? "" : $this->array['link'],
                'sender' => empty($this->array['sender']) ? "" : $this->array['sender'],
                'details' => empty($this->array['details']) ? "" : $this->array['details'],
                'data' => empty($this->array['data']) ? "" : $this->array['data'],


            ]);
    }
}
