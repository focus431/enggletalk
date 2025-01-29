<?php

namespace App\Mail;

use App\Models\ClassSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App; 
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class StatusChangedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $classSchedule;
    public $recipient;
    public $mentee;
    public $localstartTime;
    public $localendTime;

    public function __construct(ClassSchedule $classSchedule, $recipient, $mentee = null, $localstartTime, $localendTime)
    {
        $this->classSchedule = $classSchedule;
        $this->recipient = $recipient;
        $this->mentee = $mentee;
        $this->localstartTime = $localstartTime;
        $this->localendTime = $localendTime;
    }

    public function build()
    {
        App::setLocale($this->recipient->preferred_language ?? 'en');
        Log::info('Current Locale: ' . app()->getLocale());


        $subject = __('emails.class_canceled');

        if ($this->recipient->role === 'mentee') {

            return $this->subject($subject)
                        ->view('emails.statusChangedNotificationMentee')
                        ->with([
                            'classSchedule' => $this->classSchedule,
                            'recipient' => $this->recipient,
                            'mentor' => $this->mentee,
                            'localstartTime' => $this->localstartTime,
                            'localendTime' => $this->localendTime,
                        ]);
        } else {

        

            return $this->subject($subject)
                        ->view('emails.statusChangedNotificationMentor')
                        ->with([
                            'classSchedule' => $this->classSchedule,
                            'recipient' => $this->recipient,
                            'mentee' => $this->mentee,
                            'localstartTime' => $this->localstartTime,
                            'localendTime' => $this->localendTime,
                        ]);
        }
    }
}
