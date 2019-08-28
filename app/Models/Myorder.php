<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    //指定表名
    protected $table = 'order';
    //指定主键
    protected $primaryKey = 'id';
    //时间变为true
    public $timestamps = false;
    //定制时间戳格式
    protected $dateFormat = 'U';
    //定义不允许更新的字段黑名单
    protected $guarded = ['id'];



    protected $fillable = [
        'id','name_order','applicant','place','fault','date_application',
        'maintenance_personnel','designated_personel','departments_applicants',
        'state'
    ];




}
