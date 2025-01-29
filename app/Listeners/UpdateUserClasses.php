<?php

// app/Listeners/UpdateUserClasses.php
namespace App\Listeners;
               
use App\Events\ClassScheduleStatusChanged;
use App\Models\User;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Log;
class UpdateUserClasses
{
    public function handle(ClassScheduleStatusChanged $event)
    {
        // $schedule = $event->schedule;
        // $userId = $schedule->mentee_id;

        // // 其他的業務邏輯如之前所述
        // $bookedCount = ClassSchedule::where('mentee_id', $userId)->where('status', 'booked')->count();
        // $completedCount = ClassSchedule::where('mentee_id', $userId)->where('status', 'completed')->count();
        // $absentCount = ClassSchedule::where('mentee_id', $userId)->where('status', 'absent')->count();
        // $userClasses = User::where('id', $userId)->pluck('t_classes')->first();

        // $remaining = ($userClasses - $bookedCount - $completedCount - $absentCount);

        // // 更新 User 表
        // User::where('id', $userId)->update(['remaining_classes' => $remaining]);
    }
}

