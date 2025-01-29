<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmailEN extends Mailable
{
    use Queueable, SerializesModels;

    public $activationUrl;

    public function __construct($activationUrl)
    {
        $this->activationUrl = $activationUrl;
    }

    public function build()
    {
        return $this->view('emails.activation.en')
                    ->with(['activationUrl' => $this->activationUrl]);
    }
}
