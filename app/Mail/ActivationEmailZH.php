<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmailZH extends Mailable
{
    use Queueable, SerializesModels;

    public $activationUrl;

    public function __construct($activationUrl)
    {
        $this->activationUrl = $activationUrl;
    }

    public function build()
    {
        return $this->view('emails.activation.zh');
    }
}
