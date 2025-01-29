<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Ledger;
use Illuminate\Support\Carbon;

class UpdateMonthlyLedgers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ledgers:update'; // 設置命令名稱

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and update monthly ledgers for all mentors'; // 設置命令描述

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 獲取所有角色為 mentor 的用戶
        $mentors = User::where('role', 'mentor')->get();

        foreach ($mentors as $mentor) {
            // 獲取當月所有已完成的課程
            $lessons = $mentor->classSchedules()
                              ->where('status', 'Completed')
                              ->whereMonth('schedule_date', Carbon::now()->month)
                              ->get();

            $totalLessons = $lessons->count();
            $totalAmount = $lessons->sum('amount'); // 假設每個課程有一個 `amount` 欄位

            // 確定當前月份
            $month = Carbon::now()->format('F');

            // 更新或創建這個月的帳簿記錄
            Ledger::updateOrCreate(
                ['teacher_id' => $mentor->id, 'month' => $month],
                ['total_lessons' => $totalLessons, 'total_amount' => $totalAmount]
            );
        }

        $this->info('Monthly ledgers updated successfully!'); // 給出操作成功的提示

        return Command::SUCCESS; // 返回成功狀態
    }
}
