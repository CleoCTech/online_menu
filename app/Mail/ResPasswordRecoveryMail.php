<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResPasswordRecoveryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $token;
    public $resetUrl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $token, $resetUrl)
    {
        $this->mail = $mail;
        $this->token = $token;
        $this->resetUrl = $resetUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.res-password-recovery');
    }
}
