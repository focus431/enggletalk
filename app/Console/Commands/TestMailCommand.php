<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestMailCommand extends Command
{
    protected $signature = 'mail:test {email}';
    protected $description = '測試郵件發送功能';

    public function handle()
    {
        $email = $this->argument('email');
        
        try {
            Mail::to($email)->send(new TestMail());
            $this->info("測試郵件已發送到 {$email}");
        } catch (\Exception $e) {
            $this->error("發送失敗：" . $e->getMessage());
        }
    }
} 