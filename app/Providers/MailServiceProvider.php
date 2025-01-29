<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class MailServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Mail::alwaysFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        Config::set('mail.default', 'smtp');
        Config::set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'host' => 'smtp.sendgrid.net',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'apikey',
            'password' => env('SENDGRID_API_KEY'),
        ]);
    }
} 