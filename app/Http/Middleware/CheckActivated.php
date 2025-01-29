<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 检查用户是否已登录且已激活
        if (Auth::check() && Auth::user()->activated == 0) {
            // 如果用户未激活，重定向到等待激活页面
            return redirect('/awaiting-activation');
        }

        return $next($request);
    }
}
