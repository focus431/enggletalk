<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\OrderPlan;

class OrderConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderPlan;
    public $userLanguage;

    public function __construct(OrderPlan $orderPlan, $userLanguage)
    {
        $this->orderPlan = $orderPlan;
        $this->userLanguage = $userLanguage;
    }

    public function build()
{
    // 根据用户的语言加载不同的视图
    $view = 'emails.order_confirmed_' . $this->userLanguage;

    // 根据语言获取邮件主题
    $subject = __('emails.order_confirmed_subject', [], $this->userLanguage);

    return $this->view($view)
                ->subject($subject)
                ->with([
                    'orderPlan' => $this->orderPlan,
                ]);
}

}





