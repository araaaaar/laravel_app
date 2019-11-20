<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User;
use Auth;  // 追記　ForgotPasswordController.phpファイルに定義されてる名前空間

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $todo;
    private $user;

    public function __construct(Todo $instanceClass, User $UserinstanceClass)
    {
        // middlewareのauthは、ログイン状態のチェックを行うもの
        // ログイン処理は、Illuminate\Foundation\AuthのAuthenticatesUsersを調査すべし
        // ユーザーが認証されていなければ、ユーザーをログインページへリダイレクトするミドルウェアも存在
        $this->middleware('auth');  // 追記
        $this->todo = $instanceClass;
        $this->user = $UserinstanceClass;
    }

    public function index() 
    {
        // ＊collectionクラスじゃなくて✖、todo〇クラスのallメソッドを使用、返り値がcollectionオブジェクトなだけ
        // 認証されたユーザーのtodoインスタンス取得
        $todos = $this->todo->getByUserId(Auth::id());  // 追記 in Todo.php
        // dd($this->todo);
        $user = $this->user->getUserByUserId(Auth::id());  // 追記 in User.php


        // dd($todos);collectionインスタンス
        return view('todo.index', compact('todos', 'user'));
        // return view('todo.index', ['todos' => $this->todo->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        // 細かくバリデーションで確認したいってなったらここに記載！！
        $input['user_id'] = Auth::id();  // 追記
        // ＊fill():代入されたくないカラムや捏造されたカラムに不正に代入されるのを防ぐ
        $this->todo->fill($input)->save();
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        // dd($todo);

        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();
        // dd($input);

        // ＊sql文：UPDATE todos SET todo = '値' WHERE id = ?
        $this->todo->find($id)->fill($input)->save();
        // ＊一文ずつに分ける：fill()で$recordに代入することになるから最後はsave()のみで大丈夫
        // $record = $this->todo->find($id);
        // $record->fill($input);
        // $record->save();
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();
        return redirect()->route('todo.index');
    }
}