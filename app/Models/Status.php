<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    //指定表名
    protected $table = 'status';
    //指定主键
    protected $primaryKey = 'id';
    //定义不允许更新的字段黑名单
    protected $guarded = ['id'];



    protected $fillable = ['id','status'

    ];




}
