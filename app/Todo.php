<?php
// Eloquentモデル : 対応するDBテーブルにクエリできるようにしてくれるクエリビルダ
// Eloquent : DBとモデルオブジェクトを対応付ける機能

namespace App;
use Illuminate\Database\Eloquent\Model;

// Todoクラスの処理に$fillable代入する属性を指定
class Todo extends Model
{
    // ★users tableもあるのになぜtodos tableからデータ取得出来るか：宣言しなければ、toodクラスの複数形のtableを作ってくれる
    // protected $table = 'todos';
    // ★なぜ$idと定義してないのに、$idでデータの編集が可能なのか：宣言しなければ、$primaryKeyをidとして理解してくれる
    // protected $primaryKey = 'id';

    // カラムtitleに代入、protected、クラスとそれを継承した子クラスからのアクセスのみ
    protected $fillable = [
        'title',
        'user_id'
    ];
    // ユーザーに紐づいたデータ取得
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}