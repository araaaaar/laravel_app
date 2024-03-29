<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model
{
    use SoftDeletes;
    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'user_id'
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}