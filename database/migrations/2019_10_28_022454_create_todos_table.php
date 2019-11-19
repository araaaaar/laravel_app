<?php
//Migration!!!!!
//php artisan make:migration create_todos_table --create=todos
//マイグレーションファイル : SQLではなくPHPのソースコードでテーブル定義を表現
//マイグレーション実行によって作成されたファイル
//Schemaファサードは、テーブルの作成や操作をサポートしてるデータベースシステム全部に対しサポートします。

//名前空間Illuminate\Support\FacadesのSchemaクラスを参照
use Illuminate\Support\Facades\Schema;
//名前空間Illuminate\Database\SchemaのBlueprintクラスを参照
use Illuminate\Database\Schema\Blueprint;
//名前空間Illuminate\Database\MigrationsのMigrationクラスを参照
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //createメソッド : モデルインスタンス生成、Eloquentのsaveメソッドを使用しデータベースへ保存、レコード挿入
        //Eloquentでモデルインスタンスを作成して保存
        Schema::create('todos', function (Blueprint $table) {
            //tableに対してカラムを生成、引数にカラム名
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    //migrate : 未実行のmigration fileがあればそのfileのupメソッドを実行
    //rollback : 最後に実行されたfileのdownメソッドを実行
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
