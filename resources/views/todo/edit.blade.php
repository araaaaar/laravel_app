{{-- @extendsディレクティブでlayoutsディレクトリ、ビューのテンプレapp.blade.phpを継承
@sectionを使用、@endsectionまでのセクションのコンテンツをcontentと定義、テンプレapp.blade.phpファイルの@yieldで内容を表示 --}}
@extends ('layouts.app')
@section ('content')
<h2 class="mb-3">ToDo編集</h2>

{{-- 編集ボタンをクリックしたidのtitleを編集するフォームを作成、formタグをformファサードを使用して作成、open()を使用してフォームを開始
更新ボタンを押した時、DBのデータ更新、第一引数post先をルーティング名で指定、ルーティング名はtodo.update指定
クリックされた編集のidを取得、第二引数パラメータには$todo->idでtodoオブジェクトからidを取得、formファサードはデフォルトでpostメソッド
更新する際に使用されるputメソッドに変更、第二引数はmethodダブルアロー演算子で、PUT --}}
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!}
  <div class="form-group">

    {{-- input()を使用、入力フィールドを作成、第一引数のtypeはtext、第二引数のフィールド名はtitle、第三引数の初期値は$todo->titleで
    todoオブジェクトのtitleを取得、第四引数の属性はrequiredで入力必須、classはform-control --}}
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!}
  </div>

  {{-- submit()を使用、送信ボタンを作成、第一引数にvalueとして更新、第二引数に属性を配列で指定、classをbtn,btn-success,float-rightと指定
  close()タグ終了--}}
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}
@endsection