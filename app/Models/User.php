<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */


    //指定表名
    protected $table = 'user';
   //指定主键
    protected $primaryKey = 'id';
    //时间变为true
   public $timestamps = false;
   //定制时间戳格式
    protected $dateFormat = 'U';
    //允许添加、更新的字段白名单，不设置则无法添加
    protected $fillable = ['id','role','phone','name','password','address','created_at','updated_at'];
    //定义不允许更新的字段黑名单
    protected $guarded = ['id'];

    const created_at='created_at';
    //const updated_at = null;





   public static function boot(){

    parent::boot();

    static::creating(function($model){

        $model->created_at = $model->freshTimestamp();
        $model->updated_at = $model->freshTimestamp();



    });

}
}
