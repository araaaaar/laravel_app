<?php
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
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    
    }

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