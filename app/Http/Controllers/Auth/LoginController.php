<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function __construct()
    {
        // 設置 throttle 中間件，5次嘗試/10分鐘
        $this->middleware('throttle:5,10')->only('login');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 檢查 IP 是否被封鎖
        if ($this->isIpBlocked($request->ip())) {
            return response()->json([
                'success' => false,
                'message' => __('messages.ip_blocked')
            ], 403);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // 清除該用戶的登入失敗次數
            $this->clearLoginAttempts($request);

            // 檢查是否有其他活躍的會話
            $activeSession = DB::table('user_sessions')
                ->where('user_id', $user->id)
                ->where('session_id', '!=', session()->getId())
                ->first();

            if ($activeSession) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => __('messages.account_logged_in_elsewhere')
                ], 403);
            }

            // 儲存當前會話資訊
            DB::table('user_sessions')->updateOrInsert(
                ['user_id' => $user->id],
                ['session_id' => session()->getId(), 'last_activity' => now()]
            );

            return response()->json([
                'success' => true,
                'role' => $user->role,
                'user_data' => $user,
            ]);
        }

        // 記錄登入失敗
        $this->incrementLoginAttempts($request);

        // 檢查是否需要封鎖 IP
        if ($this->shouldBlockIp($request)) {
            $this->blockIp($request->ip());
            return response()->json([
                'success' => false,
                'message' => __('messages.ip_blocked_too_many_attempts')
            ], 403);
        }

        return response()->json([
            'success' => false,
            'message' => __('messages.invalid_credentials'),
            'attempts_left' => $this->retriesLeft($request)
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        // 刪除會話資訊
        DB::table('user_sessions')->where('user_id', $user->id)->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * 獲取剩餘嘗試次數
     */
    protected function retriesLeft(Request $request)
    {
        return RateLimiter::remaining($this->throttleKey($request), 5);
    }

    /**
     * 增加登入失敗次數
     */
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), 600); // 10分鐘 = 600秒
    }

    /**
     * 清除登入失敗次數
     */
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * 生成限制器的鍵值
     */
    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * 檢查是否應該封鎖 IP
     */
    protected function shouldBlockIp(Request $request)
    {
        $attempts = RateLimiter::attempts($this->throttleKey($request));
        return $attempts >= 10; // 10次失敗後封鎖IP
    }

    /**
     * 封鎖 IP
     */
    protected function blockIp($ip)
    {
        Cache::put('blocked_ip_' . $ip, true, now()->addHours(24)); // 封鎖24小時
    }

    /**
     * 檢查 IP 是否被封鎖
     */
    protected function isIpBlocked($ip)
    {
        return Cache::has('blocked_ip_' . $ip);
    }
}
