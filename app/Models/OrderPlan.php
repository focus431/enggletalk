<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Mail\OrderConfirmedMail;

class OrderPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'selected_plan',
        'lessons',       
        'price',         
        'payment_option',
        'payment_proof',
        'status',
        'duration',      
        'expiry_date'
    ];

    // 定义与用户模型的关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 在模型初始化时添加事件监听
    protected static function booted()
    {
        static::updating(function ($orderPlan) {
            $timezoneOffset = request()->input('timezoneOffset', 0);
            $orderPlan->updated_at = Carbon::now()->subMinutes($timezoneOffset);

            $originalStatus = $orderPlan->getOriginal('status');
            $newStatus = $orderPlan->status;
            $user = User::find($orderPlan->user_id);

            if ($user) {
                if ($originalStatus !== 'Confirmed' && $newStatus === 'Confirmed') {
                    $user->remaining_classes += $orderPlan->lessons;
                    $user->t_expired = $orderPlan->expiry_date;

                    // 获取用户的语言（假设语言存储在用户模型中，或从请求中获取）
                    $userLanguage = $user->language ?? request()->getPreferredLanguage(['en', 'zh']); 

                    // 发送确认邮件
                    Mail::to($user->email)->send(new OrderConfirmedMail($orderPlan, $userLanguage));
                } elseif ($originalStatus === 'Confirmed' && $newStatus !== 'Confirmed') {
                    $user->remaining_classes -= $orderPlan->lessons;
                    $user->t_expired = null;
                }
                $user->save();
            }
        });
    }
}
