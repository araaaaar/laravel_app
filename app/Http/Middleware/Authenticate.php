<?php

namespace App\Http\Middleware;
// 認証NGならログインへリダイレクトしている
// 認証OKならreturn $next($request);
// $nextは、本来のrouteが設定される(たとえば/とか)と理解。

// vendorのAuthenticate.phpファイルのAuthenticateクラスを使用する宣言
use Illuminate\Auth\Middleware\Authenticate as Middleware;

// ミドルウェア：'auth'
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    //ログイン画面にリダイレクトされる　$requestどこからきた？？？
    
    protected function redirectTo($request)
    {
        return route('login');
    }
}
