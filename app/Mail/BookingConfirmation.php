<?php

namespace App\Mail;

use App\Models\ClassSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $classSchedule;
    public $mentor;
    public $mentee;
    public $isMentor;
    public $localstartTime;
    public $localendTime;
    public $timezoneLabel;
    private $currentLocale;

    public function __construct(ClassSchedule $classSchedule, $mentor, $mentee = null, $isMentor = false)
    {
        // 保存當前系統語言設定
        $this->currentLocale = App::getLocale();
        
        $this->classSchedule = $classSchedule;
        $this->mentor = $mentor;
        $this->mentee = $mentee;
        $this->isMentor = $isMentor;
        
        // 設定時區
        $timezone = $isMentor ? $mentor->timezone : ($mentee ? $mentee->timezone : 'Asia/Taipei');
        
        $this->localstartTime = Carbon::parse($classSchedule->start_time)
            ->setTimezone($timezone)
            ->format('H:i');

        $this->localendTime = Carbon::parse($classSchedule->end_time)
            ->setTimezone($timezone)
            ->format('H:i');

        $this->timezoneLabel = $timezone;
    }

    public function build()
    {
        try {
            // 取得收件人
            $recipient = $this->isMentor ? $this->mentor : $this->mentee;
            
            // 設定語言
            $locale = $this->getValidLocale($recipient);
            App::setLocale($locale);

            $subject = $this->isMentor ? 
                __('emails.new_booking_notice') :    // 老師收到的標題：新預約通知
                __('emails.booking_confirmation');    // 學生收到的標題：預約確認

            return $this->view('emails.booking.confirmation')
                       ->subject($subject);
        } finally {
            // 確保在郵件發送後恢復原本的語言設定
            App::setLocale($this->currentLocale);
        }
    }

    /**
     * 取得有效的語言設定
     */
    private function getValidLocale($user): string
    {
        if (!$user) {
            return config('app.fallback_locale');
        }

        $locale = $user->preferred_language;

        // 確認語言檔是否存在
        if ($locale && in_array($locale, array_keys(config('app.languages')))) {
            return $locale;
        }

        // 如果語言設定無效，返回預設語言
        return config('app.fallback_locale');
    }

    /**
     * 標準化中文語言代碼
     * @param string|null $locale 原始語言代碼
     * @return string 標準化後的語言代碼
     */
    private function normalizeChineseLocale(?string $locale): string
    {
        if (!$locale) {
            return config('app.fallback_locale');
        }

        // 處理各種可能的中文語言代碼格式
        switch (strtolower($locale)) {
            case 'zh':
            case 'zh-tw':
            case 'zh_tw':
            case 'zhtw':
                return 'zh_TW';
            
            case 'zh-cn':
            case 'zh_cn':
            case 'zhcn':
                return 'zh_CN';
            
            default:
                return $locale;
        }
    }
} 