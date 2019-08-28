<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DispachController extends Controller{

    /*
     * 派单管理 特派工单
     *
     * */
    public function getDispach(request $request){

        $id = $request->input('id');
        //dd($id);

        $where = new \App\Models\Order;
       // dd($where);
        if ($id) {
            $where = $where->where('id',$id);
        }
        $orders =Order::where('id','>=','1')->paginate(5);

        //dd($order);

        return view('admin.order.specialOrder',compact(['orders','id']));

    }

/*
 *
 * 特派工单查询
 * */
    public function postSelect(Request $request)
    {
        $params = [];
        $search = $request->input('Order');
        if(!empty($search['applicant'])) {
            $conditions[] = ' applicant = :applicant ';
            $params[':applicant'] = $search['applicant'];
        }
        if(!empty($search['maintenance_personnel'])) {
            $conditions[] = ' maintenance_personnel = :maintenance_personnel ';
            $params[':maintenance_personnel'] = $search['maintenance_personnel'];
        }


        // dd($applicant);
         //$orders = Order::where('applicant','=', '小张')->paginate(3);
        $orders = Order::whereRaw(implode('and', $conditions), $params)->paginate(4);

        //dd($orders);

        return view('admin.order.specialOrder',
            ['orders' => $orders,
            ]);

    }






}
