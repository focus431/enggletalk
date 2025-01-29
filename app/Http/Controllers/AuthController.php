<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ActivationEmail;
use App\Models\Course;
use App\Helpers\RatingHelper;
use App\Mail\ActivationEmailEN;
use App\Mail\ActivationEmailZH;
use App\Mail\ActivationEmailJA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'showProfileSettingsMentor', 'showProfileSettingsMentee', 'index']]);
    }

    public function index($userId = null)
    {
        // 如果提供了 userId，则从数据库中获取相应的数据
        if ($userId) {
            $schedule = User::where('id', $userId)->firstOrFail();
            Log::info('Schedule:', ['schedule' => $schedule]);

            // 调用辅助函数计算评分
            $averageRatings = RatingHelper::calculateWeightedAverageRatings(collect([$userId]));
            $averageRating = $averageRatings[$userId] ?? 5; // 如果没有评分，默认为 5

            return view('profile', [
                'schedule' => $schedule,
                'averageRating' => $averageRating
            ]);
        }

        // 如果没有提供 userId，则执行原来的逻辑
        // ...
    }



    // 顯示登錄表單
    public function showLoginForm()
    {
        return view('login');
    }

    // Mentee 註冊
    public function menteeRegister(Request $request)
    {
        // 表單驗證
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'browserLang' => 'required' // 確保 browserLang 參數被傳送
        ]);

        // 檢查是否為 Gmail 地址
        if (!Str::endsWith($request->email, '@gmail.com')) {
            return response()->json([
                'message' => __('messages.only_gmail_allowed'),
                'success' => false
            ], 400);
        }

        // 創建新 Mentee
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'mentee';
        // 生成激活碼並發送激活郵件
        $activationCode = Str::random(60);
        $user->activation_code = $activationCode;
        $user->save();

        // 根據瀏覽器語言生成激活郵件的 URL 並發送郵件
        $activationUrl = url('/activate/' . $activationCode);
        $this->sendActivationEmail($user->email, $activationUrl, $request->browserLang);

        return response()->json([
            'message' => __('messages.mentee_registered_successfully'),
            'activation_message' => __('messages.activation_message'),
            'success' => true
        ]);
    }



    private function sendActivationEmail($email, $activationUrl, $browserLang)
    {
        try {
            Log::info('開始發送啟用郵件', [
                'email' => $email,
                'activationUrl' => $activationUrl,
                'browserLang' => $browserLang
            ]);

            // 獲取郵件模板
            $emailView = $this->getEmailTemplate($browserLang);
            Log::info('選擇的郵件模板', ['emailView' => $emailView]);

            // 發送郵件
            Mail::to($email)->send(new ActivationEmail($activationUrl, $emailView));
            
            Log::info('啟用郵件發送成功');
            
        } catch (\Exception $e) {
            Log::error('發送啟用郵件失敗', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }


    private function getEmailClass($browserLang)
    {
        $emailClasses = [
            'en' => ActivationEmailEN::class,
            'zh-TW' => ActivationEmailZH::class,
            'ja' => ActivationEmailJA::class,
            // 其他语言对应的邮件类
        ];

        // 日志：记录选择的邮件模板类
        $emailClass = $emailClasses[$browserLang] ?? ActivationEmailEN::class;
        Log::info('Email Class Selected', ['emailClass' => $emailClass]);

        return $emailClass;
    }


    private function getEmailTemplate($browserLang)
    {
        $templates = [
            'en' => 'emails.activation.en',
            'ja' => 'emails.activation.ja',
            'ko' => 'emails.activation.ko',
            'vi' => 'emails.activation.vi',
            'zh-TW' => 'emails.activation.zh',
            'zh-CN' => 'emails.activation.zh_CN',
            'zh' => 'emails.activation.zh',  // 預設中文使用繁體中文模板
        ];

        // 處理語言代碼
        $lang = strtolower($browserLang);
        $lang = str_replace('_', '-', $lang);
        
        // 特殊處理中文語系
        if (strpos($lang, 'zh') === 0) {
            if (strpos($lang, 'zh-cn') === 0) {
                $lang = 'zh-CN';
            } else {
                $lang = 'zh-TW';  // 預設使用繁體中文
            }
        }

        // 如果找不到對應的模板，使用英文作為預設
        $template = $templates[$lang] ?? 'emails.activation.en';
        
        Log::info('Email Template Selected', [
            'browser_lang' => $browserLang,
            'processed_lang' => $lang,
            'template' => $template
        ]);

        return $template;
    }











    // Mentor 註冊（這裡也可以添加激活碼和郵件驗證）
    public function mentorRegister(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'google_meet_code' => 'nullable',
            ]);

            // 檢查是否為 Gmail 地址
            if (!Str::endsWith($request->email, '@gmail.com')) {
                return response()->json([
                    'message' => __('only_gmail_allowed'),
                    'success' => false
                ], 400);
            }

            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'mentor';
            $user->google_meet_code = $request->input('google_meet_code');

            // 生成激活碼並發送激活郵件
            $activationCode = Str::random(60);
            $user->activation_code = $activationCode;
            $user->save();

            // 根據瀏覽器語言生成激活郵件的 URL 並發送郵件
            $activationUrl = url('/activate/' . $activationCode);
            $browserLang = $request->input('browserLang', 'en'); // 默认语言为英语
            $this->sendActivationEmail($user->email, $activationUrl, $browserLang);

            return response()->json([
                'message' => 'Mentor registered successfully',
                'activation_message' => '激活碼已寄件，請檢查信箱',
                'success' => true
            ]);
        } catch (\Exception $e) {
            // 捕捉例外並返回 JSON 格式的錯誤訊息
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }






    // 新增：帳號激活方法
    public function activateAccount($code)
    {
        $user = User::where('activation_code', $code)->first();
        if (!$user) {
            return redirect('/')->with('error', '無效的激活碼！');
        }

        $user->activated = true; // 標記帳號為已激活
        $user->activation_code = null; // 清除激活碼
        $user->save();

        return redirect('/login')->with('success', '您的帳號已成功激活！');
    }





    // 登錄
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // 檢查是否為 Gmail 地址
        if (!Str::endsWith($credentials['email'], '@gmail.com')) {
            return response()->json([
                'message' => __('only_gmail_allowed'),
                'success' => false
            ], 400);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!$user->activated) {
                Auth::logout();
                return response()->json(['message' => 'Your account is not activated yet', 'success' => false]);
            }

            // 删除其他会话
            DB::table('user_sessions')->where('user_id', $user->id)->delete();

            // 创建新的会话
            DB::table('user_sessions')->insert([
                'user_id' => $user->id,
                'session_id' => session()->getId(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            session()->flash('success', 'Successfully logged in as ' . $user->role);
            return response()->json(['message' => 'Login successful', 'success' => true, 'role' => $user->role, 'user_data' => $user]);
        } else {
            session()->flash('error', 'Invalid credentials');
            return response()->json(['message' => __('messages.login_failed'), 'success' => false]);
        }
    }













    public function showProfileSettingsMentor()
{
    $user = Auth::user();

    if ($user->role !== 'mentor') {
        return redirect('login')->with('message', '您不是 mentor，不能訪問這個頁面！');
    }

    // 从 Course 模型获取前 6 个课程
    $courses = Course::limit(6)->get();  // 获取前 6 个可用的课程

    return view('profile-settings-mentor', [
        'user' => $user,
        'courses' => $courses, // 将课程传递给视图
    ]);
}





    // 顯示 Mentee 設定頁面
    public function showProfileSettingsMentee()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') {
            return redirect('login')->with('message', '您不是 mentee，不能訪問這個頁面！');
        }

        return view('profile-settings-mentee', [
            'user' => $user,
        ]);
    }







    // 登出
    public function logout(Request $request)
{
    $user = Auth::user();
    
    if ($user) {
        \App\Models\UserSession::where('user_id', $user->id)
            ->where('session_id', session()->getId())
            ->delete();
    }

    // 無效化當前 session
    $request->session()->invalidate();

    // 重新生成 CSRF token
    $request->session()->regenerateToken();

    // 登出當前用戶
    Auth::logout();

    return redirect('/index');
}









    // 更新個人資料（這個函數比較長，所以只是示例，您可以根據需要進行調整）
    public function updateProfile(Request $request)
    {
        try {
            // 從 session 中獲取當前登錄的用戶
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => '用戶未登入'
                ], 401);
            }

            // 初始化要更新的數據陣列
            $updateData = [];

            // 驗證基本請求數據
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required|in:Male,Female,Other',
                'date_of_birth' => 'nullable|date',
                'mobile' => 'nullable|string|max:20',
                'city' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'google_meet_code' => 'nullable|string|max:100',
                'about_me' => 'nullable|string',
                'education_background' => 'nullable|string',
                'youtube_link' => 'nullable|string|url',
                'bank_name' => 'nullable|string|max:100',
                'branch_name' => 'nullable|string|max:100',
                'swift_code' => 'nullable|string|max:50',
                'account_number' => 'nullable|string|max:50',
                'account_holder_name' => 'nullable|string|max:100',
                'line_id' => 'nullable|string|max:50|unique:users,line_id,' . $user->id,
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // 處理頭像上傳
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                
                // 生成唯一的檔案名
                $filename = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
                
                // 儲存檔案到 storage/app/public/avatars 目錄
                $path = $avatar->storeAs('avatars', $filename, 'public');
                
                // 如果儲存成功，更新資料庫中的頭像路徑
                if ($path) {
                    $updateData['avatar_path'] = $path;
                    
                    // 刪除舊的頭像檔案（如果存在）
                    if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                        Storage::disk('public')->delete($user->avatar_path);
                    }
                }
            }

            // 合併驗證過的數據到更新數據陣列
            $updateData = array_merge($updateData, $validatedData);
            
            // 移除不需要的欄位
            unset($updateData['avatar']);

            // 更新用戶資料
            $user->update($updateData);

            // 如果請求中有 'courses' 字段，則更新與課程的關聯
            if ($request->has('courses')) {
                $user->courses()->sync($request->input('courses'));
            }

            return response()->json([
                'success' => true,
                'message' => '個人資料更新成功'
            ]);

        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => '更新失敗：' . $e->getMessage()
            ], 500);
        }
    }
}
