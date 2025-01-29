<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ForgotPasswordController extends Controller
{
    /**
     * 顯示忘記密碼表單
     */
    public function showLinkRequestForm()
    {
        return view('forgot-password');
    }

    /**
     * 發送重置密碼郵件
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.required' => __('validation.required', ['attribute' => __('Email')]),
            'email.email' => __('validation.email', ['attribute' => __('Email')]),
            'email.exists' => __('validation.exists', ['attribute' => __('Email')])
        ]);

        // 生成重置令牌
        $token = Str::random(64);
        
        // 儲存令牌到資料庫
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // 使用當前系統設置的語言
        $locale = App::getLocale();
        
        // 根據語言代碼選擇對應的郵件模板
        $template = match($locale) {
            'zh-TW' => 'emails.zh_TW.forgot-password',
            'zh-CN' => 'emails.zh_CN.forgot-password',
            'ja' => 'emails.ja.forgot-password',
            'ko' => 'emails.ko.forgot-password',
            'vi' => 'emails.vi.forgot-password',
            default => 'emails.en.forgot-password'
        };

        // 發送重置郵件
        try {
            Mail::send($template, ['token' => $token], function($message) use($request) {
                $message->to($request->email);
                $message->subject(__('auth.reset_password'));
            });

            return response()->json([
                'success' => true,
                'message' => __('auth.password_reset_sent')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('auth.failed_to_send')
            ]);
        }
    }
} 