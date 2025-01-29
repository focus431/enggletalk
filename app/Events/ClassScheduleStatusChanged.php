<?php

namespace App\Events;

use App\Models\ClassSchedule;
use Illuminate\Queue\SerializesModels;

class ClassScheduleStatusChanged
{
    use SerializesModels;

    public $classSchedule;
    public $originalMenteeId;

    public function __construct(ClassSchedule $classSchedule, $originalMenteeId)
    {
        $this->classSchedule = $classSchedule;
        $this->originalMenteeId = $originalMenteeId;
    }
}
