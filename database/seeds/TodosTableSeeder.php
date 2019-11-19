<?php
//php artisan db:seed → Seeding: TodosTableSeeder
//名前空間がIlluminate\DatabaseのSeederクラスを参照
use Illuminate\Database\Seeder;

//Carbon : PHPで使える日付操作ライブラリで、Laravelに標準装備
//日付データを扱う、日付のデータをcarbonインスタンスに入れ、操作
use Carbon\Carbon;

// TodosTableSeederを使用する為、同じ階層に存在する DatabaseSeederに追記、runメソッドの中に先ほど手を加えたClass名を記載、なんで？？？ららべるdatabaseしかよめない
class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // データベースにデータ挿入
    public function run()
    {
        //全レコードの取得
        //クエリビルダ：DBとやりとりするためのメソッド
        //クエリを書くにはDB::(ファサード)のtableメソッドを使用。
        //tableメソッドの返り値：指定したテーブルに対するクエリビルダインスタンス。
        //クエリビルダインスタンスを使用しクエリに制約を加え、最終的な結果を取得するチェーンを繋げます。
        //クエリを書くにはDBファサードのtableメソッドを使います。tableメソッドは指定したテーブルに対するクエリビルダインスタンスを返す

        //truncateメソッド : 全レコードを削除し、自動増分のIDを0にリセットするためにテーブルをTRUNCATE(訳：切り詰める、切り捨てる) 
        DB::table('todos')->truncate();

        //insert():テーブルにレコードを挿入、引数にはカラム名と値の配列
        // ★foreachを1000回まわしてcreate()を実行するのをinsertなら1回で済む
        DB::table('todos')->insert([
            [
                'title'      => 'Laravel Lessonを終わらせる',
                //モデルの保存
                //createメソッド : モデルインスタンスを生成、Eloquentのsaveメソッドを使用しデータベースへ保存。
                'created_at' => Carbon::create(2018, 1, 1),
                'updated_at' => Carbon::create(2018, 1, 4),
            ],
            [
                'title'      => 'レビューに向けて理解を深める',
                'created_at' => Carbon::create(2018, 2, 1),
                'updated_at' => Carbon::create(2018, 2, 5),
            ],
        ]);
    }
}