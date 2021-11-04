<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QrCode extends Mailable
{
    use Queueable, SerializesModels;
    public $qrcode;
    public $imagename;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qrcode, $imagename)
    {
        $this->qrcode = $qrcode;
        $this->imagename = $imagename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.qr-code')
                    ->attachFromStorage('qr-codes/' .$this->imagename);
    }
}