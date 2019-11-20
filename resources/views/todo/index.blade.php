{{-- ビュー、bladeテンプレートエンジン組み込み、ビューの中に直接phpの記述が可能、構文やコマンドは@で始める --}}
{{-- @extendsディレクティブで、ビューのテンプレapp.blade.phpを継承
@sectionを使用、@endsectionまでセクション、コンテンツをcontentと定義、テンプレapp.blade.phpファイルの@yieldで内容を表示 --}}
@extends ('layouts.app')
@section ('content')

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">

  {{-- ボタンをクリック、href、uri /todo/createに遷移 --}}
  <a class="btn btn-success" href="/todo/create">新規作成</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>ID</th>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    {{-- ＠foreachを使用一覧表示、コントローラからビューに渡ってきた$todosにはcollectionオブジェクトが格納
    itemsプロパティには配列、配列の中にレコードを表すtodoオブジェクトが複数、オブジェクトを引数の$todoに格納され
    foreachをまわす --}}
    @foreach ($todos as $todo)
      <tr>  

        {{-- collectionは要素の省略操作可能、todoオブジェクトの中、プロパティoriginalに格納されている連想配列のキーで
        バリューを取得、{{ 波括弧二つで }}エスケープ処理、{!! 波括弧、エクスクラメーションマーク !!}でエスケープ処理しない
        それぞれ$todoからtitle,created_at,updated_atにアクセス --}}
        {{-- {{ dd($todo) }} --}}
        <td class="align-middle">{{ $todo->id }}</td>
        <td class="align-middle">{{ $todo->title }}</td>
        <td class="align-middle">{{ $todo->created_at }}</td>
        <td class="align-middle">{{ $todo->updated_at }}</td>

        {{-- 編集したいtodoの編集をクリック、aタグhref属性で指定、urlに遷移、urlはroute()を使用して生成、第一引数にルート名todo.editを指定、第二引数にパラメータ
        クリックされたtodoのidを取得する為、パラメータには$todo->idでtodoオブジェクトからidを取得、route()で完全なurlを返す --}}
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>
        <td>

          {{-- 削除したいtodoの削除ボタンをクリック、todo一覧画面から削除、削除ボタンを作成、formタグをformファサードのopen()を使用し開始
          ボタンを押した時、DBから物理削除、post先をルーティングで指定、ルーティング名todo.destroy、パラメータ、クリックされた削除のidを取得
          $todo->idでtodoオブジェクトからidを取得、formファサードはデフォルトpostメソッド、削除する際に使用されるdeleteメソッドに変更、第二引数methodダブルアロー演算子で、DELETE代入 --}}
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}

            {{-- submit()を使用、削除ボタンを作成、第一引数にvalue削除、第二引数に属性を配列で指定
            classをbtn,btn-dangerと指定、最後はclose()でformタグを終了 --}}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection