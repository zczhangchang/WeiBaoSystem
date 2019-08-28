<?php

namespace App\Http\Controllers\Admin;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use DB;

class OrderStatusController extends Controller{


    /*
   * 数据库中数据,工单列表显示status列表
  */
    public function getStatus(request $request)
    {

        $status = $request->input('status');

        //dd($status);


        $where = new \App\Models\Status;
        //dd($where);
        if ($status) {
            $where = $where->where('status',$status);
        }
        $statuses = Status::all();

        //dd($order);

        return view('admin.order.dispach-list',compact(['statuses','status']));
    }



}
