<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentSessionId = session()->getId();

            $latestSession = DB::table('user_sessions')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($latestSession && $latestSession->session_id !== $currentSessionId) {
                Auth::logout();
                return redirect('/login')
                    ->withErrors(['message' => __('messages.account_logged_in_elsewhere')])
                    ->with('logout_reason', __('messages.account_login_attempt'));
            }
        }

        return $next($request);
    }
}
