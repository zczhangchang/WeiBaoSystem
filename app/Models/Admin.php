<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    //指定表名
    protected $table = 'user';
    protected $fillable = [
        'id', 'name', 'password', 'role', 'phone','address','name_order',
    ];
}
