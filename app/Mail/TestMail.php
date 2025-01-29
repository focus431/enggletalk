<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TestMail extends Mailable
{
    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('emails.test')
                    ->subject('測試郵件');
    }
} 