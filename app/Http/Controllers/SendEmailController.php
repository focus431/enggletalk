<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderPlan;

class SendEmailController extends Controller
{
    /**
     * 发送测试邮件
     */
    public function sendTestEmail()
    {
        // 获取测试订单和用户
        $orderPlan = OrderPlan::first(); // 获取一个订单（仅用于测试）
        if (!$orderPlan) {
            return response()->json(['message' => 'No order found'], 404);
        }
        
        $user = $orderPlan->user;
        if (!$user || !$user->email) {
            return response()->json(['message' => 'No user email found'], 404);
        }

        // 获取用户的语言，假设没有语言信息则默认为浏览器语言或 'en'
        $userLanguage = $user->language ?? request()->getPreferredLanguage(['en', 'zh']);

        // 发送测试邮件
        Mail::to($user->email)->send(new OrderConfirmedMail($orderPlan, $userLanguage));

        // 返回响应
        return response()->json(['message' => '123!']);
    }
}
