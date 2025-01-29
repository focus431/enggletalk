<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClassSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateClassScheduleStatus extends Command
{
    protected $signature = 'classschedule:update-status';
    protected $description = 'Update status of class schedules';

    public function __construct()
    {
        parent::__construct();
    }


public function handle()
{
    $today = Carbon::today();
    $affectedRows = ClassSchedule::where('schedule_date', '<', $today)
                                 ->where('status', 'booked')
                                 ->update(['status' => 'absent']);

    Log::info("Updated $affectedRows class schedule records to absent.");
    $this->info("Updated $affectedRows class schedule records to absent.");
}

}


