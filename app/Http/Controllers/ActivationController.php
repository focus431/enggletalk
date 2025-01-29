<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ActivationController extends Controller
{
    public function activateAccount($activationCode)
    {
        // 檢查激活碼，並激活用戶帳戶
        // 這裡需要您根據具體情況來實現相應的邏輯
        // 例如，查找與激活碼相匹配的用戶，然後設置其帳戶為激活狀態

        // 假設您的用戶模型是 User，並且它有一個 activation_code 欄位
        $user = User::where('activation_code', $activationCode)->first();

        if (!$user) {
            // 激活碼無效
            return redirect('/')->with('error', 'Invalid activation code.');
        }

        // 激活帳戶
        $user->activated = true;
        $user->activation_code = null; // 清除激活碼
        $user->save();

        // 重定向到登錄頁面或首頁，並顯示激活成功的消息
        return redirect('/login')->with('success', 'Account activated successfully.');
    }
}

