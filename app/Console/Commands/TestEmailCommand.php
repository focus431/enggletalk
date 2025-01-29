<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Models\ClassSchedule;
use App\Models\User;

class TestEmailCommand extends Command
{
    protected $signature = 'email:test {email}';
    protected $description = '測試郵件發送功能';

    public function handle()
    {
        $email = $this->argument('email');
        
        try {
            // 創建測試數據
            $mentor = User::where('role', 'mentor')->first();
            $this->info("找到導師: " . $mentor->name);
            
            $mentee = User::where('role', 'mentee')->first();
            $this->info("找到學生: " . $mentee->name);
            
            $classSchedule = ClassSchedule::first();
            $this->info("找到課程時間: " . $classSchedule->schedule_date);

            // 發送測試郵件
            $this->info("開始發送郵件...");
            Mail::to($email)->send(new BookingConfirmation(
                $classSchedule,
                $mentor,
                $mentee,
                false
            ));

            $this->info("測試郵件已發送到 {$email}");
        } catch (\Exception $e) {
            $this->error("發送失敗：" . $e->getMessage());
            \Log::error("郵件發送失敗", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
} 