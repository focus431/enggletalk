<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    private const ROLE_SESSION_KEY = 'social_auth_role';
    private const DEFAULT_ROLE = 'mentee';
    
    /**
     * 重定向到社交平台的 OAuth 服務
     */
    public function redirectToProvider(Request $request, string $provider)
    {
        $role = $request->input('role', self::DEFAULT_ROLE);
        session([self::ROLE_SESSION_KEY => $role]);
        
        Log::info("重定向到 {$provider}", ['intended_role' => $role]);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * 處理社交平台的 OAuth 回調
     */
    public function handleProviderCallback(string $provider)
    {
        try {
            $intendedRole = session(self::ROLE_SESSION_KEY, self::DEFAULT_ROLE);
            Log::info("{$provider} 登錄回調開始", ['intended_role' => $intendedRole]);

            $socialiteUser = Socialite::driver($provider)->user();
            $user = $this->findOrCreateUser($socialiteUser, $provider, $intendedRole);
            
            Auth::login($user, true);
            
            return $this->handleRedirect($user);

        } catch (Exception $e) {
            Log::error("{$provider}登錄失敗", ['error' => $e->getMessage()]);
            return redirect('/login')->with('error', "使用 {$provider} 登錄失敗，請重試。");
        } finally {
            session()->forget(self::ROLE_SESSION_KEY);
        }
    }

    /**
     * 查找或創建用戶
     */
    private function findOrCreateUser($socialiteUser, string $provider, string $intendedRole): User
    {
        $user = User::where('email', $socialiteUser->getEmail())->first();

        if ($user) {
            Log::info('用戶已存在', [
                'user_id' => $user->id, 
                'existing_role' => $user->role, 
                'intended_role' => $intendedRole
            ]);
            return $user;
        }

        $userData = [
            'email' => $socialiteUser->getEmail(),
            'name' => $socialiteUser->getName(),
            'password' => bcrypt(Str::random(16)),
            'role' => $intendedRole,
            'activated' => ($intendedRole === 'mentor') ? 0 : 1,
        ];

        $user = User::create($userData);
        Log::info('新用戶創建', ['user_id' => $user->id, 'role' => $user->role]);
        
        return $user;
    }

    /**
     * 處理用戶登錄後的重定向
     */
    private function handleRedirect(User $user)
    {
        Log::info('用戶登錄後', [
            'user_id' => $user->id,
            'role' => $user->role,
            'activated' => $user->activated,
        ]);

        if ($user->activated !== 1) {
            Log::info('重定向到等待激活頁面');
            return redirect('/awaiting-activation');
        }

        $redirectPath = match($user->role) {
            'mentor' => '/profile-settings-mentor',
            'mentee' => '/profile-settings-mentee',
            default => '/login'
        };

        Log::info("重定向到 {$user->role} 設置頁面");
        return redirect($redirectPath);
    }

    // 路由方法
    public function redirectToGoogle(Request $request)
    {
        return $this->redirectToProvider($request, 'google');
    }

    public function handleGoogleCallback()
    {
        return $this->handleProviderCallback('google');
    }

    public function redirectToMicrosoft(Request $request)
    {
        return $this->redirectToProvider($request, 'microsoft');
    }

    public function handleMicrosoftCallback()
    {
        return $this->handleProviderCallback('microsoft');
    }
}