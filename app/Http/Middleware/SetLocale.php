<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // 优先使用会话中存储的语言（用户手动选择的语言）
        $locale = Session::get('applocale');

        if (!$locale) {
            // 如果会话中没有语言，则使用浏览器的语言设置
            $browserLang = $request->header('Accept-Language'); // 从请求头中获取语言
            $langs = explode(',', $browserLang); // 分割多个语言

            $availableLangs = ['en', 'zh_TW', 'ja', 'vi', 'ko']; // 你应用支持的语言列表
            $primaryLang = config('app.locale'); // 默认语言

            foreach ($langs as $lang) {
                $lang = explode(';', $lang)[0]; // 去掉质量值
                $lang = str_replace('-', '_', $lang); // 将 "zh-TW" 转换为 "zh_TW"

                // 如果語言是 'zh'，則根據瀏覽器的具體設定決定使用 'zh_TW' 或 'zh_CN'
                if ($lang == 'zh') {
                    // 檢查瀏覽器的具體中文設定
                    $zhLocale = $request->getPreferredLanguage(['zh_CN', 'zh_TW']);
                    $lang = $zhLocale ?: 'zh_TW'; // 如果無法確定，預設使用 'zh_TW'
                }

                if (in_array($lang, $availableLangs)) {
                    $primaryLang = $lang;
                    break;
                }
            }

            // 将最终确定的语言存储到会话中，以便后续使用
            Session::put('applocale', $primaryLang);
            $locale = $primaryLang;
        }

        // 设置应用程序的语言
        App::setLocale($locale);

        return $next($request);
    }
}

