<?php
namespace App\Http\Controllers\Auth;

use App\User; //Authenticatable-User extends Model
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{   
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    // protected $redirectTo = '/home';
    protected $redirectTo = '/todo'; //書き換え

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // 初期設定
    public function __construct()
    {
        // 引数に指定したミドルウェアを適用、ミドルウェア:HTTPリクエスト前後でフィルタリング、認証やバリデーション処理を実行
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // 引数にタイプヒントで変数に入れる型をarray指定
    protected function validator(array $data)
    {
        // 第一引数バリデーションを行うデータ、第二引数ルール、第三引数カスタムメッセ、縦棒、同じ値、バリデーターインスタンス
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // ★11/11 create()=fill()->save():foreachで代入　⇔　insert1回で代入
    protected function create(array $data)
    {
        return User::create([ //上でuseしてるUserクラス(モデル)のcreate()を実行
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //パスワードはそのままDBに保存していけないので、Hashファサードを使用。make()を実行 vendor-Support-Facadesに記載あり
        ]);
    }
}