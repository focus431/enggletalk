<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * 顯示重置密碼表單
     */
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    /**
     * 重置密碼
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ], [
            'email.required' => '請輸入電子郵件地址',
            'email.email' => '請輸入有效的電子郵件地址',
            'email.exists' => '此電子郵件地址未註冊',
            'password.required' => '請輸入新密碼',
            'password.min' => '密碼至少需要8個字符',
            'password.confirmed' => '兩次輸入的密碼不一致'
        ]);

        // 檢查令牌是否有效
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return response()->json([
                'success' => false,
                'message' => '無效的重置連結'
            ]);
        }

        // 檢查令牌是否過期（24小時）
        $tokenCreatedAt = Carbon::parse($updatePassword->created_at);
        if ($tokenCreatedAt->diffInHours(Carbon::now()) > 24) {
            return response()->json([
                'success' => false,
                'message' => '重置連結已過期，請重新申請'
            ]);
        }

        // 更新密碼
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // 刪除已使用的令牌
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => '密碼重置成功'
        ]);
    }
} 