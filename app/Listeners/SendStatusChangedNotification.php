<?php

namespace App\Listeners;

use App\Events\ClassScheduleStatusChanged;
use App\Mail\StatusChangedNotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendStatusChangedNotification
{
    public function handle(ClassScheduleStatusChanged $event)
{
    Log::info('SendStatusChangedNotification listener handling event for schedule ID: ' . $event->classSchedule->id);

    // 獲取 ClassSchedule 實例
    $classSchedule = $event->classSchedule;

    // 使用原始 mentee_id 查找對應的 mentee
    $mentee = $event->originalMenteeId ? User::find($event->originalMenteeId) : null;

    // 檢查是否找到了對應的 mentee
    if ($mentee) {
        Log::info('Mentee found: ID = ' . $mentee->id . ', Email = ' . $mentee->email);
    } else {
        Log::warning('Mentee not found for mentee_id: ' . $event->originalMenteeId);
    }

    // 獲取 mentor
    $mentor = $classSchedule->teacher;

    // // 發送郵件給 mentor
    // if ($mentor && $mentor->email) {
    //     Mail::to($mentor->email)->send(new StatusChangedNotification($classSchedule, $mentor, $mentee));
    //     Log::info('Status changed email sent to mentor: ' . $mentor->email);
    // } else {
    //     Log::warning('Mentor email is missing for user_id: ' . $classSchedule->user_id);
    // }

    // // 發送郵件給 mentee
    // if ($mentee && $mentee->email) {
    //     Mail::to($mentee->email)->send(new StatusChangedNotification($classSchedule, $mentee, $mentee));
    //     Log::info('Status changed email sent to mentee: ' . $mentee->email);
    // } else {
    //     Log::warning('Mentee email is missing for mentee_id: ' . $event->originalMenteeId);
    // }
}

}
