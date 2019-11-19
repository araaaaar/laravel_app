{{-- @extendsディレクティブでビューのテンプレapp.blade.phpを継承
@sectionを使用して、@endsectionまでのセクションのコンテンツをcontent、ビューのテンプレapp.blade.phpファイルの@yieldで内容を表示 --}}
@extends ('layouts.app')
@section ('content')
<h2 class="mb-3">ToDo作成</h2>

{{-- 文字列入力の為のFormタグ、Formファサードを使用して作成、laravelcollective/htmlパッケージcomposerを使用してインストール、ヘルパー関数を使用
open()を使用フォームを開始、デフォルトでformタグとinputタグが生成、formはpostメソッド、post先urlは現在のurl、inputにはtype:hddenでtokenが生成されcsrf対策
追加したい属性を配列の形で指定、文字列入力送信ボタンを押した際、データが保存されるようpost先をルーティング名todo.store指定、配列に代入、ダブルアロー
★formファサードを使う理由：HTMLを書かなくてもphpだけ知ってれば書けるようにする為 --}}
{!! Form::open(['route' => 'todo.store']) !!}
  <div class="form-group">

  {{-- input()を使用、入力フィールドを作成、第一引数はtype、第二引数はフィールド名name、第三引数は初期値
  ★第三引数：入力フォームの初期値
  value、第四引数はoption、追加したい属性配列の形指定
  typeはtext、フィールド名はtitle、初期値はnull、属性はまずrequiredで入力必須 --}}
  {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
  </div>
  
  {{-- submit()を使用、送信ボタンを作成、第一引数にvalue追加、第二引数に追加したい属性を配列で指定
  close()でフォームタグを終了 --}}
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}
@endsection