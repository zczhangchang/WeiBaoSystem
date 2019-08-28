<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Address extends Model
{
    //指定表名
    protected $table = 'address';
    //指定主键
    protected $primaryKey = 'id';
    //时间变为true
    public $timestamps = false;
    //定制时间戳格式
    protected $dateFormat = 'U';
    //定义不允许更新的字段黑名单
    protected $guarded = ['id'];



    protected $fillable = [
        'id','name','beizhu','contacts'
    ];




}
