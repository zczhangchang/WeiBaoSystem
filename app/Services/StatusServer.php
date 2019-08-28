<?php
namespace App\Services;


class StatusServer
{

    //状态下拉框
    public static function getStatus(){

        return \App\Models\Status::where('status', 2)->get();
    }


}
