<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class AbsentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $classSchedule;
    public $mentee;
    public $localstartTime;
    public $localendTime;

    public function __construct($classSchedule, $mentee, $localstartTime, $localendTime)
    {
        $this->classSchedule = $classSchedule;
        $this->mentee = $mentee;
        $this->localstartTime = $localstartTime;
        $this->localendTime = $localendTime;
    }

    public function build()
{
    Log::info('开始构建 AbsentNotification 邮件模板');
    return $this->view('emails.absent_notification')
                ->subject(__('emails.Missed Class Notification'))
                ->with([
                    'classSchedule' => $this->classSchedule,
                    'mentee' => $this->mentee,
                    'localstartTime' => $this->localstartTime,
                    'localendTime' => $this->localendTime,
                ]);
}

}
