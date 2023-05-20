<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetSuccessFront extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $obj;
    public $site_url2;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($obj)
    {
        $this->obj = $obj;
        $this->site_url2=env('SITE_URL_FRONT');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->to('oyslans@gmail.com')
            ->replyTo($this->obj->email)
            ->view('email.reset-password-success-front')
            ->subject($this->subject);

    }
}