<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

// ミドルウェア：'guest'で使用されるクラス
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    // handle():ミドルウェアでするべき処理
    public function handle($request, Closure $next, $guard = null)
    {
        // Auth::guard()：登録済みユーザーを認証する
        // 認証NGならログインへリダイレクトしている
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
        // 認証OKならreturn $next($request);
        return $next($request);
    }
}