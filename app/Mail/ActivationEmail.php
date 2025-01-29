<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $activationUrl;
    public $viewTemplate;

    public function __construct($activationUrl, $viewTemplate)
    {
        $this->activationUrl = $activationUrl;
        $this->viewTemplate = $viewTemplate;
    }

    public function build()
    {
        return $this->view($this->viewTemplate)
                    ->with([
                        'activationUrl' => $this->activationUrl,
                    ]);
    }
}

