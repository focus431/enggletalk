<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Services\CurrencyService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CurrencyService::class, function ($app) {
            return new CurrencyService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{

    // 优先检查会话中的语言设置
    $locale = Session::get('applocale');

    if (!$locale) {
        // 如果会话中没有语言设置，再使用浏览器的默认语言
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        // 根据浏览器语言映射到你支持的语言代码
        switch ($locale) {
            case 'zh':
                // 检查浏览器的具体中文设定
                $zhLocale = request()->getPreferredLanguage(['zh_CN', 'zh_TW']);
                $locale = $zhLocale ?: 'zh_TW'; // 如果无法确定，默认使用 'zh_TW'
                break;
            case 'ja':
                $locale = 'ja';
                break;
            case 'ko':
                $locale = 'ko';
                break;
            case 'vi':
                $locale = 'vi';
                break;
            default:
                $locale = config('app.locale'); // 默认语言
        }

        // 将浏览器语言保存到会话中
        Session::put('applocale', $locale);
    } else {
        logger()->info('Session Locale: ' . $locale);
    }

    // 设置应用程序的语言
    App::setLocale($locale);





    View::composer(['search', 'schedule-timings'], function ($view) {
        $view->with('mentors', User::where('role', 'mentor')->get());
    });

    View::composer('*', function ($view) {
        $user = Auth::user();
        if ($user) {
            $completedFields = 0;
    
            // 根据角色设置不同的字段
            if ($user->role == 'mentor') {
                $fields = [
                    'first_name', 'last_name', 'date_of_birth', 'gender', 'email', 
                    'mobile', 'city', 'country',
                    'bank_name', 'branch_name', 'swift_code', 'account_number', 'account_holder_name'
                ];
            } elseif ($user->role == 'mentee') {
                $fields = [
                    'first_name', 'last_name', 'date_of_birth', 'gender', 'email', 
                    'mobile', 'city', 'avatar_path'
                ];
            } else {
                $fields = []; // 若为其他角色，可设为空或其他设置
            }
    
            $totalFields = count($fields);
    
            foreach ($fields as $field) {
                if (!empty($user->$field)) {
                    $completedFields++;
                }
            }
    
            // 计算完成的百分比，确保 totalFields 不为 0
            if ($totalFields > 0) {
                $completionPercentage = round(($completedFields / $totalFields) * 100);
            } else {
                $completionPercentage = 0; // 或者其他逻辑
            }
            
            $view->with('completionPercentage', $completionPercentage);
        } else {
            $view->with('completionPercentage', 0);
        }
    });
    
}

    
}
