<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {

        if (!Auth::check()) {
            // 使用本地化訊息，用於未登入的用戶
            Session::flash('alert', trans('messages.not_logged_in'));
            return redirect('/');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            // 使用本地化訊息，用於角色不匹配的情況
            Session::flash('alert', trans('messages.unauthorized'));
            return redirect('/');
        }

        return $next($request);
    }
}
